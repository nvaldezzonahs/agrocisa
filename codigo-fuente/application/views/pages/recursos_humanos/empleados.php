	<div id="EmpleadosRecursosHumanosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_empleados_recursos_humanos" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_empleados_recursos_humanos" 
								   name="strBusqueda_empleados_recursos_humanos"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_empleados_recursos_humanos"
										onclick="paginacion_empleados_recursos_humanos();" 
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
							<button class="btn btn-info" id="btnNuevo_empleados_recursos_humanos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_empleados_recursos_humanos"
									onclick="reporte_empleados_recursos_humanos('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_empleados_recursos_humanos"
									onclick="reporte_empleados_recursos_humanos('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla empleados
				*/
				td.movil.a1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Nombre"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Corporativo"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Sucursal"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Departamento"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Puesto"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Estatus"; font-weight: bold;}
				td.movil.a8:nth-of-type(8):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla dependientes
				*/
				td.movil.b1:nth-of-type(1):before {content: "Nombre"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Sexo"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Fecha de Nac."; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Parentesco"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla documentos
				*/
				td.movil.c1:nth-of-type(1):before {content: "Documento"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla incidencias
				*/
				td.movil.d1:nth-of-type(1):before {content: "Fecha"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Comentario"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_empleados_recursos_humanos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Nombre</th>
							<th class="movil">Corporativo</th>
							<th class="movil">Sucursal</th>
							<th class="movil">Departamento</th>
							<th class="movil">Puesto</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_empleados_recursos_humanos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">
							<td class="movil a1">{{codigo}}</td>
							<td class="movil a2">{{nombre}}</td>
							<td class="movil a3">{{corporativo}}</td>
							<td class="movil a4">{{sucursal}}</td>
							<td class="movil a5">{{departamento}}</td>
							<td class="movil a6">{{puesto}}</td>
							<td class="movil a7">{{estatus}}</td>
							<td class="movil a8 td-center"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_empleados_recursos_humanos({{empleado_id}},'id','Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_empleados_recursos_humanos({{empleado_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Impresión de formato (reporte del registro)-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="impresion_formato_empleados_recursos_humanos({{empleado_id}},'{{estatus}}');"  title="Impresión de formato">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_empleados_recursos_humanos({{empleado_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_empleados_recursos_humanos({{empleado_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_empleados_recursos_humanos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_empleados_recursos_humanos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Impresión de Formato-->
		<div id="FormatoEmpleadosRecursosHumanosBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_formato_empleados_recursos_humanos" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Impresión de Formato</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmFormatoEmpleadosRecursosHumanos" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmFormatoEmpleadosRecursosHumanos"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Tipo de formato--> 
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtEmpleadoID_formato_empleados_recursos_humanos" 
										   name="intEmpleadoID_formato_empleados_recursos_humanos" 
										   type="hidden" value="">
									</input>
									<label for="cmbTipo_formato_empleados_recursos_humanos">Seleccione el formato a imprimir</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbTipo_formato_empleados_recursos_humanos" 
									 		name="strFormato_formato_empleados_recursos_humanos" tabindex="1">
                          				<option value="HOJA DE DATOS">HOJA DE DATOS</option>
                          				<option value="CARTA DE RECOMENDACION">CARTA DE RECOMENDACION</option>
                          				<option value="CONSTANCIA LABORAL">CONSTANCIA LABORAL</option>
                       					<option value="CONTRATO">CONTRATO</option>
                     				</select>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Incluir o no membrete de la empresa--> 
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<div class="checkbox">
			                        	<label id="label-checkbox">
				                        	<input class="form-control" id="chbMembrete_formato_empleados_recursos_humanos" 
												   name="strMembrete_formato_empleados_recursos_humanos" type="checkbox"
												   value="" tabindex="1">
											</input>
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Incluir membrete de la empresa
			                        	</label>
			                      	</div>
								</div>
							</div>
						</div>
				    </div>
				    <!--Div que contiene los datos del formato contrato-->
				    <div id="divValoresContrato_formato_empleados_recursos_humanos" class="no-mostrar">
				    	<div class="row">
				    		<!--Sueldo-->
							<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtSueldo_formato_empleados_recursos_humanos">Sueldo</label>
									</div>
									<div class="col-md-12">
										<div class='input-group'>
											<span class="input-group-addon">$</span>
											<input class="form-control moneda_empleados_recursos_humanos" id="txtSueldo_formato_empleados_recursos_humanos" 
												   name="intSueldo_formato_empleados_recursos_humanos" type="text" value="" 
												   tabindex="1" placeholder="Ingrese sueldo" maxlength="12">
											</input>
											
										</div>
									</div>
								</div>
							</div>
							<!--Tiempo-->
							<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="cmbTiempo_formato_empleados_recursos_humanos">Tiempo</label>
									</div>
									<div id="divCmbMsjValidacion" class="col-md-12">
										<select class="form-control" id="cmbTiempo_formato_empleados_recursos_humanos" 
										 		name="strTiempo_formato_empleados_recursos_humanos" tabindex="1">
	                          				<option value="">Seleccione una opción</option>
	                          				<option value="1 mes">1 MES</option>
	                          				<option value="2 meses">2 MESES</option>
	                          				<option value="3 meses">3 MESES</option>
	                       					<option value="INDETERMINADO">INDETERMINADO</option>
	                     				</select>
									</div>
								</div>
							</div>
							<!--Fecha de vencimiento-->
							<div id="divFechaVencimiento_formato_empleados_recursos_humanos"   
								  class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtFechaVencimiento_formato_empleados_recursos_humanos">Fecha de vencimiento</label>
									</div>
									<div id="divFechaMsjValidacion" class="col-md-12">
										<div class='input-group date' id='dteFechaVencimiento_formato_empleados_recursos_humanos'>
						                    <input class="form-control" id="txtFechaVencimiento_formato_empleados_recursos_humanos"
						                    		name= "strFechaVencimiento_formato_empleados_recursos_humanos" 
						                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
						                    <span class="input-group-addon">
						                        <span class="glyphicon glyphicon-calendar"></span>
						                    </span>
						                </div>
									</div>
								</div>
							</div>
				    	</div>
				    	<div class="row">
					    	<!--Junta de conciliación -->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtJuntaConciliacion_formato_empleados_recursos_humanos">Junta de conciliación </label>
									</div>
									<div class="col-md-12">
										<textarea  class="form-control" id="txtJuntaConciliacion_formato_empleados_recursos_humanos" 
												   name="strJuntaConciliacion_formato_empleados_recursos_humanos" rows="5" value="" tabindex="1" placeholder="Ingrese junta de conciliación"></textarea>
									</div>
								</div>
							</div>
					    </div>
					    <div id="divActividades_formato_empleados_recursos_humanos" class="row">
					    	<!--Actividades-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtActividades_formato_empleados_recursos_humanos">Actividades</label>
									</div>
									<div class="col-md-12">
										<textarea  class="form-control" id="txtActividades_formato_empleados_recursos_humanos" 
												   name="strActividades_formato_empleados_recursos_humanos" rows="5" value="" tabindex="1" placeholder="Ingrese actividades"></textarea>
									</div>
								</div>
							</div>
					    </div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Imprimir reporte-->
							<button class="btn btn-success" id="btnImprimir_formato_empleados_recursos_humanos"  
									onclick="validar_formato_empleados_recursos_humanos();"  title="Imprimir registro en PDF" tabindex="2">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_formato_empleados_recursos_humanos"
									type="reset" aria-hidden="true" onclick="cerrar_formato_empleados_recursos_humanos();" 
									title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Impresión de Formato-->

		<!-- Diseño del modal Empleados-->
		<div id="EmpleadosRecursosHumanosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_empleados_recursos_humanos" class="ModalBodyTitle">
				<h1>Empleados</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_empleados_recursos_humanos" role="tablist">
								<!--Tab que contiene la información personal-->
								<li id="tabDatosPersonales_empleados_recursos_humanos" class="active">
									<a data-toggle="tab" href="#datos_personales_empleados_recursos_humanos">Datos Personales</a>
								</li>
								<!--Tab que contiene la información laboral-->
								<li id="tabDatosLaborales_empleados_recursos_humanos">
									<a data-toggle="tab" href="#datos_laborales_empleados_recursos_humanos">Datos Laborales</a>
								</li>
								<!--Tab que contiene la información académica-->
								<li id="tabDatosAcademicos_empleados_recursos_humanos">
									<a data-toggle="tab" href="#datos_academicos_empleados_recursos_humanos">Datos Académicos</a>
								</li>
								<!--Tab que contiene la información de los dependientes (familiares)-->
								<li id="tabDependientes_empleados_recursos_humanos">
									<a data-toggle="tab" href="#dependientes_empleados_recursos_humanos">Dependientes</a>
								</li>
								<!--Tab que contiene la información del expediente (documentos)-->
								<li id="tabExpediente_empleados_recursos_humanos">
									<a data-toggle="tab" href="#expediente_empleados_recursos_humanos">Expediente</a>
								</li>
								<!--Tab que contiene la información de las incidencias-->
								<li id="tabIncidencias_empleados_recursos_humanos">
									<a data-toggle="tab" href="#incidencias_empleados_recursos_humanos">Incidencias</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmEmpleadosRecursosHumanos" method="post" action="#" class="form-horizontal" role="form" name="frmEmpleadosRecursosHumanos" 
					  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Datos Personales-->
						<div id="datos_personales_empleados_recursos_humanos" class="tab-pane fade in active">
							<div class="row">
								<!--Código-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtEmpleadoID_empleados_recursos_humanos" 
												   name="intEmpleadoID_empleados_recursos_humanos" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_empleados_recursos_humanos" 
												   name="strEstatus_empleados_recursos_humanos" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
											<input id="txtCodigoAnterior_empleados_recursos_humanos" 
												   name="strCodigoAnterior_empleados_recursos_humanos" 
												   type="hidden" value="">
											</input>
											<label for="txtCodigo_empleados_recursos_humanos">Código</label>
										</div>
										<div class="col-md-12">
											<input class="form-control agregar-ceros_empleados_recursos_humanos" id="txtCodigo_empleados_recursos_humanos"
												   name="strCodigo_empleados_recursos_humanos" 
												   type="text" value="" tabindex="1" placeholder="Ingrese código" maxlength="5">
											</input>
										</div>
									</div>
								</div>
								<!--Nombre-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNombre_empleados_recursos_humanos">Nombre (s)</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtNombre_empleados_recursos_humanos"
												   name="strNombre_empleados_recursos_humanos" 
												   type="text" value="" tabindex="1" placeholder="Ingrese nombre (s)" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Apellido paterno-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtApellidoPaterno_empleados_recursos_humanos">Apellido paterno</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtApellidoPaterno_empleados_recursos_humanos"
												   name="strApellidoPaterno_empleados_recursos_humanos" 
												   type="text" value="" tabindex="1" placeholder="Ingrese apellido paterno" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Apellido materno-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtApellidoMaterno_empleados_recursos_humanos">Apellido materno</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtApellidoMaterno_empleados_recursos_humanos"
												   name="strApellidoMaterno_empleados_recursos_humanos" 
												   type="text" value="" tabindex="1" placeholder="Ingrese apellido materno" maxlength="50">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--RFC-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el rfc anterior y así evitar duplicidad en caso de que exista otro registro con el mismo rfc-->
											<input id="txtRfcAnterior_empleados_recursos_humanos" 
												   name="strRfcAnterior_empleados_recursos_humanos" 
												   type="hidden" value="">
											</input>
											<label for="txtRfc_empleados_recursos_humanos">RFC</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRfc_empleados_recursos_humanos"
												   name="strRfc_empleados_recursos_humanos" 
												   type="text" value="" tabindex="1" placeholder="Ingrese RFC" maxlength="13">
											</input>
										</div>
									</div>
								</div>
								<!--CURP-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el curp anterior y así evitar duplicidad en caso de que exista otro registro con el mismo curp-->
											<input id="txtCurpAnterior_empleados_recursos_humanos" 
												   name="strCurpAnterior_empleados_recursos_humanos" 
												   type="hidden" value="">
											</input>
											<label for="txtCurp_empleados_recursos_humanos">CURP</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtCurp_empleados_recursos_humanos"
												   name="strCurp_empleados_recursos_humanos" 
												   type="text" value="" tabindex="1" placeholder="Ingrese CURP" maxlength="18">
											</input>
										</div>
									</div>
								</div>
								<!--Estado civil-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtEstadoCivil_empleados_recursos_humanos">Estado civil</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtEstadoCivil_empleados_recursos_humanos"
												   name="strEstadoCivil_empleados_recursos_humanos" 
												   type="text" value="" tabindex="1" placeholder="Ingrese estado civil" maxlength="30">
											</input>
										</div>
									</div>
								</div>
								<!--Sexo-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbSexo_empleados_recursos_humanos">Sexo</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select id="cmbSexo_empleados_recursos_humanos" 
													name="strSexo_empleados_recursos_humanos" 
													class="form-control" tabindex="1" >
											    <option value="">Seleccione una opción</option>
												<option value="MASCULINO">MASCULINO</option>
												<option value="FEMENINO">FEMENINO</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Fecha de nacimiento-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFechaNacimiento_empleados_recursos_humanos">Fecha de nacimiento</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFechaNacimiento_empleados_recursos_humanos'>
							                    <input class="form-control" id="txtFechaNacimiento_empleados_recursos_humanos"
							                    		name= "strFechaNacimiento_empleados_recursos_humanos" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Lugar de nacimiento-->
                          		<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
                          			<!--Div que contiene los campos del lugar de nacimiento-->
		                            <div class="form-group row">
		                                <!--Etiqueta del encabezado-->
		                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                                    <label for="txtMunicipioNacimiento_empleados_recursos_humanos">Lugar de nacimiento</label>
		                                </div>
		                                <!--Autocomplete que contiene los municipios activos-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                	 <!-- Caja de texto oculta que se utiliza para recuperar el id del municipio seleccionado--> 
		                                	<input id="txtMunicipioNacimientoID_empleados_recursos_humanos"
										   			name="intMunicipioNacimientoID_empleados_recursos_humanos" type="hidden" value="">
											</input>
		                                    <input  class="form-control" id="txtMunicipioNacimiento_empleados_recursos_humanos" 
		                                     		name="strMunicipioNacimiento_empleados_recursos_humanos" 
		                                     		type="text" value="" tabindex="1" placeholder="Ingrese municipio"  maxlength="250">
		                                    </input>
		                                </div>
		                                <!--Estado-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control" id="txtEstadoNacimiento_empleados_recursos_humanos" 
		                                      		name="strEstadoNacimiento_empleados_recursos_humanos" 
		                                      		type="text" value="" placeholder="Estado" disabled>
		                                	</input>
		                                </div>
		                                 <!--País-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control" id="txtPaisNacimiento_empleados_recursos_humanos" 	        name="strPaisNacimiento_empleados_recursos_humanos" type="text" value=""        placeholder="País" disabled>
		                                    </input>
		                                </div>
		                            </div>
                          		</div>
							</div>
							<div class="row">
				    			<!--Domicilio-->
                       			<h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Domicilio</h4>
                       			<!--Calle-->
								<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCalle_empleados_recursos_humanos">Calle</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCalle_empleados_recursos_humanos" 
													name="strCalle_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese calle" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Número exterior-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNumeroExterior_empleados_recursos_humanos">Número exterior</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNumeroExterior_empleados_recursos_humanos" 
													name="strNumeroExterior_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese número" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Número interior-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNumeroInterior_empleados_recursos_humanos">Número interior</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNumeroInterior_empleados_recursos_humanos" 
													name="strNumeroInterior_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese número" maxlength="10">
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
				    			<!--Autocomplete que contiene los códigos postales activos-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del código postal seleccionado-->
											<input id="txtCodigoPostalID_empleados_recursos_humanos" 
											       name="intCodigoPostalID_empleados_recursos_humanos" type="hidden" value="">
											</input>
											<label for="txtCodigoPostal_empleados_recursos_humanos">Código postal</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigoPostal_empleados_recursos_humanos" 
													name="strCodigoPostal_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese código postal" maxlength="5">
											</input>
										</div>
									</div>
								</div>
								<!--Colonia-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtColonia_empleados_recursos_humanos">Colonia</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtColonia_empleados_recursos_humanos" 
													name="strColonia_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese colonia" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Localidad-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtLocalidad_empleados_recursos_humanos">Localidad</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtLocalidad_empleados_recursos_humanos" 
													name="strLocalidad_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese localidad" maxlength="50">
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
				    			<!--Autocomplete que contiene los municipios activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del municipio seleccionado-->
											<input id="txtMunicipioID_empleados_recursos_humanos" 
											       name="intMunicipioID_empleados_recursos_humanos" type="hidden" value="">
											</input>
											<label for="txtMunicipio_empleados_recursos_humanos">Municipio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMunicipio_empleados_recursos_humanos" 
													name="strMunicipio_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese municipio" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Estado-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtEstado_empleados_recursos_humanos">Estado</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtEstado_empleados_recursos_humanos" 
													name="strEstado_empleados_recursos_humanos" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--País-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPais_empleados_recursos_humanos">País</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPais_empleados_recursos_humanos" 
													name="strPais_empleados_recursos_humanos" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
				    			<!--Teléfono particular-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTelefonoParticular_empleados_recursos_humanos">Teléfono particular</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTelefonoParticular_empleados_recursos_humanos" 
													name="strTelefonoParticular_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese teléfono" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Correo electrónico-->
								<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCorreoElectronico_empleados_recursos_humanos">Correo electrónico</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCorreoElectronico_empleados_recursos_humanos" 
													name="strCorreoElectronico_empleados_recursos_humanos" type="text" value="" tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
				    			<!--Datos de emergencia-->
                       			<h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">En caso de emergencia llamar</h4>
                       			<!--Nombre-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtEmergenciaNombre_empleados_recursos_humanos">Nombre</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtEmergenciaNombre_empleados_recursos_humanos" 
													name="strEmergenciaNombre_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese nombre" maxlength="150">
											</input>
										</div>
									</div>
								</div>
								<!--Teléfono-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtEmergenciaTelefono_empleados_recursos_humanos">Teléfono</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtEmergenciaTelefono_empleados_recursos_humanos" 
													name="strEmergenciaTelefono_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese teléfono" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Parentesco-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtEmergenciaParentesco_empleados_recursos_humanos">Parentesco</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtEmergenciaParentesco_empleados_recursos_humanos" 
													name="strEmergenciaParentesco_empleados_recursos_humanos" type="text" 
													value="" tabindex="1" placeholder="Ingrese parentesco" maxlength="30">
											</input>
										</div>
									</div>
								</div>
                       		</div>
						</div><!--Cierre del contenido del tab - Datos Personales-->
						<!--Tab - Datos Laborales-->
						<div id="datos_laborales_empleados_recursos_humanos" class="tab-pane fade">
							<div class="row">
								<!--Fecha de ingreso-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFechaIngreso_empleados_recursos_humanos">Fecha de ingreso</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFechaIngreso_empleados_recursos_humanos'>
							                    <input class="form-control" id="txtFechaIngreso_empleados_recursos_humanos"
							                    		name= "strFechaIngreso_empleados_recursos_humanos" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Corporativo (tipo de empleado que no pertenece a una sucursal)--> 
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" id="chbCorporativo_empleados_recursos_humanos" 
												   name="strCorporativo_empleados_recursos_humanos" type="checkbox"
												   value="" tabindex="1">
											</input>
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Corporativo
				                    	</label>
				                  	</div>
								</div>
								<!--Autocomplete que contiene las sucursales activas-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
											<input id="txtSucursalID_empleados_recursos_humanos" 
											       name="intSucursalID_empleados_recursos_humanos" type="hidden" value="">
											</input>
											<label for="txtSucursal_empleados_recursos_humanos">Sucursal</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtSucursal_empleados_recursos_humanos" 
													name="strSucursal_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese sucursal" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los departamentos activos-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del departamento seleccionado-->
											<input id="txtDepartamentoID_empleados_recursos_humanos" 
											       name="intDepartamentoID_empleados_recursos_humanos" type="hidden" value="">
											</input>
											<label for="txtDepartamento_empleados_recursos_humanos">Departamento</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtDepartamento_empleados_recursos_humanos" 
													name="strDepartamento_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese departamento" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los puestos activos-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del puesto seleccionado-->
											<input id="txtPuestoID_empleados_recursos_humanos" 
											       name="intPuestoID_empleados_recursos_humanos" type="hidden" value="">
											</input>
											<label for="txtDepartamento_empleados_recursos_humanos">Puesto</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPuesto_empleados_recursos_humanos" 
													name="strPuesto_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese puesto" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Licencia de manejo-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtLicenciaManejo_empleados_recursos_humanos">Licencia de manejo</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtLicenciaManejo_empleados_recursos_humanos" 
													name="strLicenciaManejo_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese licencia de manejo" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Tipo de licencia-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbLicenciaTipo_empleados_recursos_humanos">Tipo de licencia</label>
										</div>
										<div class="col-md-12">
											<select id="cmbLicenciaTipo_empleados_recursos_humanos" 
													name="strLicenciaTipo_empleados_recursos_humanos" 
													class="form-control" tabindex="1" >
												<option value="">Seleccione una opción</option>
												<option value="TIPO A">TIPO A</option>
												<option value="TIPO B">TIPO B</option>
												<option value="TIPO C">TIPO C</option>
												<option value="TIPO D">TIPO D</option>
												<option value="MENORES">MENORES</option>
											</select>
										</div>
									</div>
								</div>
								<!--Fecha de expedición-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtLicenciaExpedicion_empleados_recursos_humanos">Fecha de expedición</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteLicenciaExpedicion_empleados_recursos_humanos'>
							                    <input class="form-control" id="txtLicenciaExpedicion_empleados_recursos_humanos"
							                    		name= "strLicenciaExpedicion_empleados_recursos_humanos" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Fecha de vigencia-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtLicenciaVigencia_empleados_recursos_humanos">Fecha de vigencia</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteLicenciaVigencia_empleados_recursos_humanos'>
							                    <input class="form-control" id="txtLicenciaVigencia_empleados_recursos_humanos"
							                    		name= "strLicenciaVigencia_empleados_recursos_humanos" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Cuenta bancaria-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCuentaBancaria_empleados_recursos_humanos">Cuenta</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCuentaBancaria_empleados_recursos_humanos" 
													name="strCuentaBancaria_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese cuenta" maxlength="20">
											</input>
										</div>
									</div>
								</div>
								<!--Clabe-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtClabe_empleados_recursos_humanos">CLABE</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtClabe_empleados_recursos_humanos" 
													name="strClabe_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese CLABE" maxlength="18">
											</input>
										</div>
									</div>
								</div>
								<!--Número de seguridad social-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNss_empleados_recursos_humanos">Número de seguridad social</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNss_empleados_recursos_humanos" 
													name="strNss_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese número de seguridad social" maxlength="11">
											</input>
										</div>
									</div>
								</div>
								<!--Clínica-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtClinica_empleados_recursos_humanos">Clínica</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtClinica_empleados_recursos_humanos" 
													name="strClinica_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese clínica" maxlength="30">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Número de Infonavit-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtInfonavit_empleados_recursos_humanos">Número de Infonavit</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtInfonavit_empleados_recursos_humanos" 
													name="strInfonavit_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese número de Infonavit" maxlength="30">
											</input>
										</div>
									</div>
								</div>
								<!--Tipo de retención-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbTipoRetencion_empleados_recursos_humanos">Tipo de retención</label>
										</div>
										<div class="col-md-12">
											<select id="cmbTipoRetencion_empleados_recursos_humanos" 
													name="strTipoRetencion_empleados_recursos_humanos" 
													class="form-control" tabindex="1" >
												<option value="NO TIENE">NO TIENE</option>
												<option value="PORCENTAJE">PORCENTAJE</option>
												<option value="CUOTA FIJA">CUOTA FIJA</option>
												<option value="VSM">VSM</option>
											</select>
										</div>
									</div>
								</div>
								<!--Importe-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtImporte_empleados_recursos_humanos">Importe</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control moneda_empleados_recursos_humanos" id="txtImporte_empleados_recursos_humanos" 
													name="intImporte_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese importe" maxlength="16">
											</input>
										</div>
									</div>
								</div>
								<!--Fecha de Infonavit-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFechaInfonavit_empleados_recursos_humanos">Fecha de inicio</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFechaInfonavit_empleados_recursos_humanos'>
							                    <input class="form-control" id="txtFechaInfonavit_empleados_recursos_humanos"
							                    		name= "strFechaInfonavit_empleados_recursos_humanos" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Tipo de sangre-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTipoSangre_empleados_recursos_humanos">Tipo de sangre</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTipoSangre_empleados_recursos_humanos" 
													name="strTipoSangre_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese tipo de sangre" maxlength="4">
											</input>
										</div>
									</div>
								</div>
								<!--Talla de camisa-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTallaCamisa_empleados_recursos_humanos">Talla de camisa</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTallaCamisa_empleados_recursos_humanos" 
													name="strTallaCamisa_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese talla de camisa" maxlength="4">
											</input>
										</div>
									</div>
								</div>
								<!--Talla de pantalón-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTallaPantalon_empleados_recursos_humanos">Talla de pantalón</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTallaPantalon_empleados_recursos_humanos" 
													name="strTallaPantalon_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese talla de pantalón" maxlength="2">
											</input>
										</div>
									</div>
								</div>
								<!--Talla de zapatos-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTallaZapatos_empleados_recursos_humanos">Talla de zapatos</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTallaZapatos_empleados_recursos_humanos" 
													name="strTallaZapatos_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese talla de zapatos" maxlength="4">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Número de Afore-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNumeroAfore_empleados_recursos_humanos">Número de Afore</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNumeroAfore_empleados_recursos_humanos" 
													name="strNumeroAfore_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese número de Afore" maxlength="20">
											</input>
										</div>
									</div>
								</div>
								<!--Institución de Afore-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtAfore_empleados_recursos_humanos">Institución de Afore</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtAfore_empleados_recursos_humanos" 
													name="strAfore_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese institución de Afore" maxlength="30">
											</input>
										</div>
									</div>
								</div>
						    </div>
						</div><!--Cierre del contenido del tab - Datos Laborales-->
						<!--Tab - Datos Académicos-->
						<div id="datos_academicos_empleados_recursos_humanos" class="tab-pane fade">
							<div class="row">
								<!--Grado de estudios-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtGradoEstudios_empleados_recursos_humanos">Grado de estudios</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtGradoEstudios_empleados_recursos_humanos" 
													name="strGradoEstudios_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese grado de estudios" maxlength="30">
											</input>
										</div>
									</div>
								</div>
								<!--Nivel de licenciatura-->
                          		<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
                          			<!--Div que contiene los campos del nivel licenciatura-->
		                            <div class="form-group row">
		                                <!--Etiqueta del encabezado-->
		                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                                    <label for="txtLicenciaturaTitulo_empleados_recursos_humanos">Nivel Licenciatura</label>
		                                </div>
		                                <!--Título-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control" id="txtLicenciaturaTitulo_empleados_recursos_humanos" 
		                                     		name="strLicenciaturaTitulo_empleados_recursos_humanos" 
		                                     		type="text" value="" tabindex="1" placeholder="Ingrese título obtenido"  maxlength="50">
		                                    </input>
		                                </div>
		                                <!--Institución-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control" id="txtLicenciaturaInstitucion_empleados_recursos_humanos" 
		                                      		name="strLicenciaturaInstitucion_empleados_recursos_humanos" 
		                                      		type="text" value="" tabindex="1" placeholder="Ingrese institución"  maxlength="50">
		                                	</input>
		                                </div>
		                                <!--Fecha-->
										<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
											<div class="form-group">
												<div id="divFechaMsjValidacion" class="col-md-12">
													<div class='input-group date' id='dteLicenciaturaFecha_empleados_recursos_humanos'>
									                    <input class="form-control" id="txtLicenciaturaFecha_empleados_recursos_humanos"
									                    		name= "strLicenciaturaFecha_empleados_recursos_humanos" 
									                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
									                    <span class="input-group-addon">
									                        <span class="glyphicon glyphicon-calendar"></span>
									                    </span>
									                </div>
												</div>
											</div>
										</div>
		                            </div>
                          		</div>
							</div>
							<div class="row">
								<!--Nivel de maestría-->
                          		<div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-9 col-lg-offset-3 col-xs-12">
                          			<!--Div que contiene los campos del nivel maestría-->
		                            <div class="form-group row">
		                                <!--Etiqueta del encabezado-->
		                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                                    <label for="txtMaestriaTitulo_empleados_recursos_humanos">Nivel Maestría</label>
		                                </div>
		                                <!--Título-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control" id="txtMaestriaTitulo_empleados_recursos_humanos" 
		                                     		name="strMaestriaTitulo_empleados_recursos_humanos" 
		                                     		type="text" value="" tabindex="1" placeholder="Ingrese título obtenido"  maxlength="50">
		                                    </input>
		                                </div>
		                                <!--Institución-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control" id="txtMaestriaInstitucion_empleados_recursos_humanos" 
		                                      		name="strMaestriaInstitucion_empleados_recursos_humanos" 
		                                      		type="text" value="" tabindex="1" placeholder="Ingrese institución"  maxlength="50">
		                                	</input>
		                                </div>
		                                <!--Fecha-->
										<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
											<div class="form-group">
												<div id="divFechaMsjValidacion" class="col-md-12">
													<div class='input-group date' id='dteMaestriaFecha_empleados_recursos_humanos'>
									                    <input class="form-control" id="txtMaestriaFecha_empleados_recursos_humanos"
									                    		name= "strMaestriaFecha_empleados_recursos_humanos" 
									                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
									                    <span class="input-group-addon">
									                        <span class="glyphicon glyphicon-calendar"></span>
									                    </span>
									                </div>
												</div>
											</div>
										</div>
		                            </div>
                          		</div>
							</div>
							<div class="row">
								<!--Inglés-->
                          		<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                          			<!--Div que contiene los campos del idioma inglés-->
		                            <div class="form-group row">
		                                <!--Etiqueta del encabezado-->
		                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                                    <label for="txtInglesComprension_empleados_recursos_humanos">Inglés</label>
		                                </div>
		                                <!--Comprensión-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control porcentaje_empleados_recursos_humanos" id="txtInglesComprension_empleados_recursos_humanos" 
		                                     		name="intInglesComprension_empleados_recursos_humanos" 
		                                     		type="text" value="" tabindex="1" placeholder="Comprensión" maxlength="8">
		                                    </input>
		                                </div>
		                                <!--Lectura-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control porcentaje_empleados_recursos_humanos" id="txtInglesLectura_empleados_recursos_humanos" 
		                                      		name="intInglesLectura_empleados_recursos_humanos" 
		                                      		type="text" value="" tabindex="1" placeholder="Lectura" maxlength="8">
		                                	</input>
		                                </div>
		                                <!--Escritura-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control porcentaje_empleados_recursos_humanos" id="txtInglesEscritura_empleados_recursos_humanos" 
		                                      		name="intInglesEscritura_empleados_recursos_humanos" 
		                                      		type="text" value="" tabindex="1" placeholder="Escritura" maxlength="8">
		                                	</input>
		                                </div>
		                            </div>
                          		</div>
								<!--Francés-->
                          		<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                          			<!--Div que contiene los campos del idioma francés-->
		                            <div class="form-group row">
		                                <!--Etiqueta del encabezado-->
		                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                                    <label for="txtFrancesComprension_empleados_recursos_humanos">Francés</label>
		                                </div>
		                                <!--Comprensión-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control porcentaje_empleados_recursos_humanos" id="txtFrancesComprension_empleados_recursos_humanos" 
		                                     		name="intFrancesComprension_empleados_recursos_humanos" 
		                                     		type="text" value="" tabindex="1" placeholder="Comprensión" maxlength="8">
		                                    </input>
		                                </div>
		                                <!--Lectura-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control porcentaje_empleados_recursos_humanos" id="txtFrancesLectura_empleados_recursos_humanos" 
		                                      		name="intFrancesLectura_empleados_recursos_humanos" 
		                                      		type="text" value="" tabindex="1" placeholder="Lectura" maxlength="8">
		                                	</input>
		                                </div>
		                                <!--Escritura-->
		                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
		                                    <input  class="form-control porcentaje_empleados_recursos_humanos" id="txtFrancesEscritura_empleados_recursos_humanos" 
		                                      		name="intFrancesEscritura_empleados_recursos_humanos" 
		                                      		type="text" value="" tabindex="1" placeholder="Escritura" maxlength="8">
		                                	</input>
		                                </div>
		                            </div>
                          		</div>
							</div>
							<div class="row">
								<!--Otro idioma-->
                          		<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                          			<!--Div que contiene los campos del Otro idioma-->
		                            <div class="form-group row">
		                                <!--Etiqueta del encabezado-->
		                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                                    <label for="txtOtroIdioma_empleados_recursos_humanos">Otro</label>
		                                </div>
		                                <!--Otro idioma-->
		                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
		                                    <input  class="form-control" id="txtOtroIdioma_empleados_recursos_humanos" 
		                                     		name="strOtroIdioma_empleados_recursos_humanos" 
		                                     		type="text" value="" tabindex="1" placeholder="Especifique" maxlength="20">
		                                    </input>
		                                </div>
		                                <!--Comprensión-->
		                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
		                                    <input  class="form-control porcentaje_empleados_recursos_humanos" id="txtOtroComprension_empleados_recursos_humanos" 
		                                     		name="intOtroComprension_empleados_recursos_humanos" 
		                                     		type="text" value="" tabindex="1" placeholder="Comprensión" maxlength="8">
		                                    </input>
		                                </div>
		                                <!--Lectura-->
		                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
		                                    <input  class="form-control porcentaje_empleados_recursos_humanos" id="txtOtroLectura_empleados_recursos_humanos" 
		                                      		name="intOtroLectura_empleados_recursos_humanos" 
		                                      		type="text" value="" tabindex="1" placeholder="Lectura" maxlength="8">
		                                	</input>
		                                </div>
		                                <!--Escritura-->
		                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
		                                    <input  class="form-control porcentaje_empleados_recursos_humanos" id="txtOtroEscritura_empleados_recursos_humanos" 
		                                      		name="intOtroEscritura_empleados_recursos_humanos" 
		                                      		type="text" value="" tabindex="1" placeholder="Escritura" maxlength="8">
		                                	</input>
		                                </div>
		                            </div>
                          		</div>
							</div>
							<div class="row">
								<!--Excel-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtExcel_empleados_recursos_humanos">Excel</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control porcentaje_empleados_recursos_humanos" id="txtExcel_empleados_recursos_humanos" 
													name="intExcel_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese porcentaje" maxlength="8">
											</input>
										</div>
									</div>
								</div>
								<!--Word-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtWord_empleados_recursos_humanos">Word</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control porcentaje_empleados_recursos_humanos" id="txtWord_empleados_recursos_humanos" 
													name="intWord_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese porcentaje" maxlength="8">
											</input>
										</div>
									</div>
								</div>
								<!--Power point-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPowerPoint_empleados_recursos_humanos">Power point</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control porcentaje_empleados_recursos_humanos" id="txtPowerPoint_empleados_recursos_humanos" 
													name="intPowerPoint_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese porcentaje" maxlength="8">
											</input>
										</div>
									</div>
								</div>
								<!--Access-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtAccess_empleados_recursos_humanos">Access</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control porcentaje_empleados_recursos_humanos" id="txtAccess_empleados_recursos_humanos" 
													name="intAccess_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese porcentaje" maxlength="8">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Otras habilidades-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtOtrasHabilidades_empleados_recursos_humanos">Otras habilidades</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtOtrasHabilidades_empleados_recursos_humanos" 
													name="strOtrasHabilidades_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese otras habilidades" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Datos Académicos-->
						<!--Tab - Dependientes-->
						<div id="dependientes_empleados_recursos_humanos" class="tab-pane fade">
							<div class="row">
								<!--Nombre-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNombre_dependientes_empleados_recursos_humanos">Nombre</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNombre_dependientes_empleados_recursos_humanos" 
													name="strNombre_dependientes_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese nombre" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Sexo-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbSexo_dependientes_empleados_recursos_humanos">Sexo</label>
										</div>
										<div class="col-md-12">
											<select id="cmbSexo_dependientes_empleados_recursos_humanos" 
													name="strSexo_dependientes_empleados_recursos_humanos" 
													class="form-control" tabindex="1" >
												<option value="">Seleccione una opción</option>
												<option value="MASCULINO">MASCULINO</option>
												<option value="FEMENINO">FEMENINO</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Fecha de nacimiento-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFechaNacimiento_dependientes_empleados_recursos_humanos">Fecha de nacimiento</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFechaNacimiento_dependientes_empleados_recursos_humanos'>
							                    <input class="form-control" id="txtFechaNacimiento_dependientes_empleados_recursos_humanos"
							                    		name= "strFechaNacimiento_dependientes_empleados_recursos_humanos" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Parentesco-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtParentesco_dependientes_empleados_recursos_humanos">Parentesco</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtParentesco_dependientes_empleados_recursos_humanos" 
													name="strParentesco_dependientes_empleados_recursos_humanos" type="text" value="" 
													tabindex="1" placeholder="Ingrese parentesco" maxlength="30">
											</input>
										</div>
									</div>
								</div>
								<!--Botón agregar-->
                              	<div class="col-sm-3 col-md-3 col-lg-3 col-xs-2">
                                	<button class="btn btn-primary btn-toolBtns" 
                                			id="btnAgregar_dependientes_empleados_recursos_humanos" 
                                			onclick="agregar_renglon_dependientes_empleados_recursos_humanos();" 
                                	     	title="Agregar" tabindex="1"> 
                                		<span class="glyphicon glyphicon-plus"></span>
                                	</button>
                             	</div>
							</div>
							<div class="form-group row">
								<!--Div que contiene la tabla con los dependientes encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_dependientes_empleados_recursos_humanos">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Nombre</th>
												<th class="movil">Sexo</th>
												<th class="movil">Fecha de Nac.</th>
												<th class="movil">Parentesco</th>
												<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
									</table>
									<br>
									<div class="row">
										<!--Número de registros encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_dependientes_empleados_recursos_humanos">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Dependientes-->
						<!--Tab - Expediente-->
						<div id="expediente_empleados_recursos_humanos" class="tab-pane fade">
							<div class="form-group row">
								<!--Div que contiene la tabla con los documentos encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_expediente_empleados_recursos_humanos">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Documento</th>
												<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_expediente_empleados_recursos_humanos" type="text/template"> 
											{{#rows}}
												<tr class="movil">
													<td class="movil c1">{{descripcion}}</td>
													<td class="td-center movil c2"> 
														<!--Subir archivo-->
														<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
															<span class="btn  btn-default btn-xs fileinput-button ">
														    	<span class="fa fa-upload"></span>
																<input type="file" name="archivo_expediente_empleados_recursos_humanos{{documento_empleado_id}}" id="archivo_expediente_empleados_recursos_humanos{{documento_empleado_id}}"  
																	   onchange="subir_archivo_expediente_empleados_recursos_humanos({{documento_empleado_id}})">
														  		</input>
														    </span>
														</span>
						                            	<!--Descargar archivo-->
						                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
						                            			 onmousedown="descargar_archivo_expediente_empleados_recursos_humanos({{documento_empleado_id}})" title="Descargar archivo">
						                            		<span class="glyphicon glyphicon-download-alt"></span>
						                            	</button>
						                            	<!--Eliminar archivo-->
														<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}"  
																onclick="eliminar_archivo_expediente_empleados_recursos_humanos({{documento_empleado_id}})"  title="Eliminar archivo">
															<span class="glyphicon glyphicon-export"></span>
														</button>
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
									<br>
									<div class="row">
										<!--Número de registros encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_expediente_empleados_recursos_humanos">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Expediente-->
						<!--Tab - Incidencias-->
						<div id="incidencias_empleados_recursos_humanos" class="tab-pane fade">
							<div class="form-group row">
								<!--Div que contiene la tabla con las incidencias encontradas-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_incidencias_empleados_recursos_humanos">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Fecha</th>
												<th class="movil">Comentario</th>
												<th class="movil">Estatus</th>
												<th class="movil" id="th-acciones" style="width:6em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_incidencias_empleados_recursos_humanos" type="text/template"> 
										{{#rows}}
											<tr class="movil {{estiloRegistro}}">   
												<td class="movil d1">{{fecha}}</td>
												<td class="movil d2">{{comentario}}</td>
												<td class="movil d3">{{estatus}}</td>
												<td class="movil d4 td-center"> 
													<!--Descargar archivo-->
					                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
					                            			 onmousedown="descargar_archivo_incidencias_empleados_recursos_humanos({{incidencia_id}});" title="Descargar archivo">
					                            		<span class="glyphicon glyphicon-download-alt"></span>
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
										<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_incidencias_empleados_recursos_humanos"></div>
										<!--Número de registros encontrados-->
										<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_incidencias_empleados_recursos_humanos">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Incidencias-->
					</div><!--Cierre del contenedor de tabs-->
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_empleados_recursos_humanos"  
									onclick="validar_empleados_recursos_humanos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Impresión de formato (reporte del registro)-->
							<button class="btn btn-default" id="btnImprimirRegistro_empleados_recursos_humanos"  
									onclick="impresion_formato_empleados_recursos_humanos('','');"  title="Impresión de formato" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_empleados_recursos_humanos"  
									onclick="cambiar_estatus_empleados_recursos_humanos('','ACTIVO');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_empleados_recursos_humanos"  
									onclick="cambiar_estatus_empleados_recursos_humanos('','INACTIVO');"  title="Restaurar" tabindex="5" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_empleados_recursos_humanos"
									type="reset" aria-hidden="true" onclick="cerrar_empleados_recursos_humanos();" title="Cerrar"  tabindex="6">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Empleados-->
	</div><!--#EmpleadosRecursosHumanosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros de empleados
		var intPaginaEmpleadosRecursosHumanos = 0;
		var strUltimaBusquedaEmpleadosRecursosHumanos = "";
		//Variables que se utilizan para la paginación de registros de incidencias
		var intPaginaIncidenciasEmpleadosRecursosHumanos = 0;
		var strUltimaBusquedaIncidenciasEmpleadosRecursosHumanos = "";
		/*Variable que se utiliza para asignar las actividades del empleado (contrato)*/
		var strActividadesFormatoEmpleadosRecursosHumanos = "realizar todas las actividades";
		//Variable que se utiliza para asignar objeto del modal Impresión de Formato
		var objFormatoEmpleadosRecursosHumanos = null;

		//Variable que se utiliza para asignar objeto del modal Empleados
		var objEmpleadosRecursosHumanos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_empleados_recursos_humanos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('recursos_humanos/empleados/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_empleados_recursos_humanos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosEmpleadosRecursosHumanos = data.row;
					//Separar la cadena 
					var arrPermisosEmpleadosRecursosHumanos = strPermisosEmpleadosRecursosHumanos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosEmpleadosRecursosHumanos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosEmpleadosRecursosHumanos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_empleados_recursos_humanos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosEmpleadosRecursosHumanos[i]=='GUARDAR') || (arrPermisosEmpleadosRecursosHumanos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_empleados_recursos_humanos').removeAttr('disabled');
						}
						else if(arrPermisosEmpleadosRecursosHumanos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_empleados_recursos_humanos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_empleados_recursos_humanos();
						}
						else if(arrPermisosEmpleadosRecursosHumanos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_empleados_recursos_humanos').removeAttr('disabled');
							$('#btnRestaurar_empleados_recursos_humanos').removeAttr('disabled');
						}
						else if(arrPermisosEmpleadosRecursosHumanos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_empleados_recursos_humanos').removeAttr('disabled');
						}
						else if(arrPermisosEmpleadosRecursosHumanos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_empleados_recursos_humanos').removeAttr('disabled');
						}
						else if(arrPermisosEmpleadosRecursosHumanos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_empleados_recursos_humanos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_empleados_recursos_humanos() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_empleados_recursos_humanos').val() != strUltimaBusquedaEmpleadosRecursosHumanos)
			{
				intPaginaEmpleadosRecursosHumanos = 0;
				strUltimaBusquedaEmpleadosRecursosHumanos = $('#txtBusqueda_empleados_recursos_humanos').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('recursos_humanos/empleados/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_empleados_recursos_humanos').val(),
						intPagina:intPaginaEmpleadosRecursosHumanos,
						strPermisosAcceso: $('#txtAcciones_empleados_recursos_humanos').val()
					},
					function(data){
						$('#dg_empleados_recursos_humanos tbody').empty();
						var tmpEmpleadosRecursosHumanos = Mustache.render($('#plantilla_empleados_recursos_humanos').html(),data);
						$('#dg_empleados_recursos_humanos tbody').html(tmpEmpleadosRecursosHumanos);
						$('#pagLinks_empleados_recursos_humanos').html(data.paginacion);
						$('#numElementos_empleados_recursos_humanos').html(data.total_rows);
						intPaginaEmpleadosRecursosHumanos = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_empleados_recursos_humanos(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'recursos_humanos/empleados/';

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
										'strBusqueda': $('#txtBusqueda_empleados_recursos_humanos').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal Impresión de Formato
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_formato_empleados_recursos_humanos()
		{
			//Incializar formulario
			$('#frmFormatoEmpleadosRecursosHumanos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_formato_empleados_recursos_humanos();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_formato_empleados_recursos_humanos');
			//Agregar clase no-mostrar para ocultar div que contiene los datos del formato contrato
    		$('#divValoresContrato_formato_empleados_recursos_humanos').addClass('no-mostrar');
			
		}


		//Función para inicializar elementos del contrato
		function inicializar_contrato_formato_empleados_recursos_humanos()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#txtSueldo_formato_empleados_recursos_humanos").val('');
            $("#txtFechaVencimiento_formato_empleados_recursos_humanos").val('');
            $("#txtJuntaConciliacion_formato_empleados_recursos_humanos").val('');
            $('#txtActividades_formato_empleados_recursos_humanos').val(strActividadesFormatoEmpleadosRecursosHumanos);
            //Limpiar contenido de los siguientes combobox
            $("#cmbTiempo_formato_empleados_recursos_humanos").val('');
            //Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_formato_empleados_recursos_humanos();
            //Agregar clase no-mostrar para ocultar div que contiene los datos del formato contrato
	        $('#divValoresContrato_formato_empleados_recursos_humanos').addClass('no-mostrar');
		}

		

		//Función que se utiliza para abrir el modal
		function impresion_formato_empleados_recursos_humanos(id, estatus)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_formato_empleados_recursos_humanos();
			//Variables que se utilizan para los valores del registro
			var intID = 0;
			var strEstatus = '';
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtEmpleadoID_empleados_recursos_humanos').val();
				strEstatus = $('#txtEstatus_empleados_recursos_humanos').val();
			}
			else
			{
				intID = id;
				strEstatus = estatus;
			}

			//Asignar el id del registro seleccionado
			$('#txtEmpleadoID_formato_empleados_recursos_humanos').val(intID);
			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_formato_empleados_recursos_humanos').addClass("estatus-"+strEstatus);
			$('#txtActividades_formato_empleados_recursos_humanos').val(strActividadesFormatoEmpleadosRecursosHumanos);
		    
			//Abrir modal
			objFormatoEmpleadosRecursosHumanos = $('#FormatoEmpleadosRecursosHumanosBox').bPopup({
															  appendTo: '#EmpleadosRecursosHumanosContent', 
								                              contentContainer: 'EmpleadosRecursosHumanosM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_formato_empleados_recursos_humanos()
		{
			try {
				//Cerrar modal
				objFormatoEmpleadosRecursosHumanos.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_formato_empleados_recursos_humanos()
		{
			//Si el tipo de formato es contrato
	        if($('#cmbTipo_formato_empleados_recursos_humanos').val() == 'CONTRATO')
	        {
				//Hacer un llamado a la función para limpiar los mensajes de error 
				limpiar_formato_empleados_recursos_humanos();
				//Validación del formulario de campos obligatorios
				$('#frmFormatoEmpleadosRecursosHumanos')
					.bootstrapValidator({excluded: [':disabled'],
										 container: 'popover',
										 feedbackIcons: {
										 	valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
										  },
										  fields: {
											intSueldo_formato_empleados_recursos_humanos: {
												validators: {
													notEmpty: {message: 'Escriba un sueldo'}
												}
											},
											strTiempo_formato_empleados_recursos_humanos: {
												validators: {
													notEmpty: {message: 'Seleccione el tiempo'}
												}
											},
											strFechaVencimiento_formato_empleados_recursos_humanos: {
											validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista fecha de vencimiento
						                                    if(value === '' && $('#cmbTiempo_formato_empleados_recursos_humanos').val() !== 'INDETERMINADO')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Seleccione una fecha'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
											strJuntaConciliacion_formato_empleados_recursos_humanos: {
												validators: {
													notEmpty: {message: 'Escriba una junta de conciliación'}
												}
											},
											strActividades_formato_empleados_recursos_humanos: {
											validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que existan actividades
						                                    if(value === '' && $('#cmbTiempo_formato_empleados_recursos_humanos').val() !== 'INDETERMINADO')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba las actividades'
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
				var bootstrapValidator_formato_empleados_recursos_humanos = $('#frmFormatoEmpleadosRecursosHumanos').data('bootstrapValidator');
				bootstrapValidator_formato_empleados_recursos_humanos.validate();
				//Si se cumplen las reglas de validación
				if(bootstrapValidator_formato_empleados_recursos_humanos.isValid())
				{
					//Hacer un llamado a la función para imprimir los datos del registro
					reporte_formato_empleados_recursos_humanos();
				}
				else 
					return;
			}
			else
	        {
	        	//Hacer un llamado a la función para imprimir los datos del registro
	       		reporte_formato_empleados_recursos_humanos();
	        }
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_formato_empleados_recursos_humanos()
		{
			try
			{
				$('#frmFormatoEmpleadosRecursosHumanos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_formato_empleados_recursos_humanos() 
		{
			//Si el checkbox incluir membrete de la empresa se encuentra seleccionado (marcado)
			if ($('#chbMembrete_formato_empleados_recursos_humanos').is(':checked')) {
			    //Asignar SI para incluir membrete de la empresa en la hoja del reporte
			    $('#chbMembrete_formato_empleados_recursos_humanos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir membrete de la empresa en la hoja del reporte
			   $('#chbMembrete_formato_empleados_recursos_humanos').val('NO');
			}

			
			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'recursos_humanos/empleados/get_reporte_formato',
							'data' : {
										'strFormato': $('#cmbTipo_formato_empleados_recursos_humanos').val(),
										'strMembrete': $('#chbMembrete_formato_empleados_recursos_humanos').val(),
										'intEmpleadoID': $('#txtEmpleadoID_formato_empleados_recursos_humanos').val(),
										'intSueldo': $.reemplazar($('#txtSueldo_formato_empleados_recursos_humanos').val(), ",", ""),
										'strTiempo': $('#cmbTiempo_formato_empleados_recursos_humanos').val(),
										'dteFechaVencimiento': $.formatFechaMysql($('#txtFechaVencimiento_formato_empleados_recursos_humanos').val()),
										'strJuntaConciliacion': $('#txtJuntaConciliacion_formato_empleados_recursos_humanos').val(),
										'strActividades': $('#txtActividades_formato_empleados_recursos_humanos').val()
									 }
						   };


			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal Empleados
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_empleados_recursos_humanos()
		{
			//Incializar formulario
			$('#frmEmpleadosRecursosHumanos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_empleados_recursos_humanos();
			//Limpiar cajas de texto ocultas
			$('#frmEmpleadosRecursosHumanos').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_empleados_recursos_humanos');
			//Seleccionar tab que contiene la información personal
		    $('a[href="#datos_personales_empleados_recursos_humanos"]').click();
		    //Eliminar los datos de la tabla dependientes
			$('#dg_dependientes_empleados_recursos_humanos tbody').empty();
			$('#numElementos_dependientes_empleados_recursos_humanos').html(0);
			//Eliminar los datos de la tabla incidencias
			$('#dg_incidencias_empleados_recursos_humanos tbody').empty();
			$('#pagLinks_incidencias_empleados_recursos_humanos').html('');
			$('#numElementos_incidencias_empleados_recursos_humanos').html(0);
			//Habilitar todos los elementos del formulario
			$('#frmEmpleadosRecursosHumanos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtEstadoNacimiento_empleados_recursos_humanos').attr("disabled", "disabled");
			$('#txtPaisNacimiento_empleados_recursos_humanos').attr("disabled", "disabled");
			$('#txtEstado_empleados_recursos_humanos').attr("disabled", "disabled");
			$('#txtPais_empleados_recursos_humanos').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_empleados_recursos_humanos").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_empleados_recursos_humanos").hide();
			$("#btnDesactivar_empleados_recursos_humanos").hide();
			$("#btnRestaurar_empleados_recursos_humanos").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_empleados_recursos_humanos()
		{
			try {

				//Hacer un llamado a la función para cerrar modal Impresión de Formato
				cerrar_formato_empleados_recursos_humanos();

				//Si no existe id del empleado, significa que es un nuevo registro
				if($('#txtEmpleadoID_empleados_recursos_humanos').val() == '')
				{
					//Hacer un llamado a la función para eliminar la carpeta temporal
					eliminar_carpeta_temp_empleados_recursos_humanos('Cerrar');
				}
				else
				{
					//Cerrar modal
					objEmpleadosRecursosHumanos.close();
								
				}

				//Enfocar caja de texto 
				$('#txtBusqueda_empleados_recursos_humanos').focus();
				
			}
			catch(err) {}
		}


		//Función que se utiliza para eliminar la carpeta temporal que contiene archivos e imagenes del empleado que no se registro 
		function eliminar_carpeta_temp_empleados_recursos_humanos(tipoAccion)
		{

			//Hacer un llamado al método del controlador para eliminar la carpeta temporal que contiene archivos e imagenes del empleado, debido a que se cerro el modal antes de realizar el registro
			$.post('recursos_humanos/empleados/eliminar_carpeta_temporal',
			     {
			     },
			     function(data) {
				    //Si el tipo de mensaje es un error
					if(data.tipo_mensaje == 'error')
					{
					   	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_empleados_recursos_humanos(data.tipo_mensaje, data.mensaje);
					}
					else
					{	

						//Si el tipo de acción corresponde a Cerrar
						if(tipoAccion == 'Cerrar')
						{
							//Cerrar modal
							objEmpleadosRecursosHumanos.close();
						}
						
					}
			     },
			     'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_empleados_recursos_humanos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_empleados_recursos_humanos();
			//Validación del formulario de campos obligatorios
			$('#frmEmpleadosRecursosHumanos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba el código para este empleado'}
											}
										},
									  	strNombre_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba un nombre'}
											}
										},
										strApellidoPaterno_empleados_recursos_humanos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista al menos un apellido
					                                    if(value === '' && $('#txtApellidoMaterno_empleados_recursos_humanos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba al menos un apellido'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strApellidoMaterno_empleados_recursos_humanos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista al menos un apellido
					                                    if(value === '' && $('#txtApellidoPaterno_empleados_recursos_humanos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba al menos un apellido'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strRfc_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba un RFC'}
											}
										},
										strSexo_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Seleccione un sexo'}
											}
										},
										strMunicipioNacimiento_empleados_recursos_humanos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del municipio
					                                    if(value !== '' && $('#txtMunicipioNacimientoID_empleados_recursos_humanos').val() === '')
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
										strCalle_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba una calle'}
											}
										},
										strNumeroExterior_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba un número exterior'}
											}
										},
										strCodigoPostal_empleados_recursos_humanos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if($('#txtCodigoPostalID_empleados_recursos_humanos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un código postal existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strColonia_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba una colonia'}
											}
										},
										strMunicipio_empleados_recursos_humanos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del municipio
					                                    if($('#txtMunicipioID_empleados_recursos_humanos').val() === '')
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
									    strTelefonoParticular_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba un número telefónico'},
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strCorreoElectronico_empleados_recursos_humanos: {
				                        	validators: {
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strEmergenciaNombre_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba un nombre'}
											}
										},
					                    strEmergenciaTelefono_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba un número telefónico'},
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strEmergenciaParentesco_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba el parentesco'}
											}
										},
										strFechaIngreso_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strSucursal_empleados_recursos_humanos: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la sucursal cuando el empleado no sea corporativo
					                                    if(!$('#chbCorporativo_empleados_recursos_humanos').is(':checked') && $('#txtSucursalID_empleados_recursos_humanos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una sucursal existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strDepartamento_empleados_recursos_humanos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del departamento
					                                    if($('#txtDepartamentoID_empleados_recursos_humanos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un departamento existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strPuesto_empleados_recursos_humanos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del puesto
					                                    if($('#txtPuestoID_empleados_recursos_humanos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un puesto existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strNss_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba un número de seguridad social'}
											}
										},
										strTipoSangre_empleados_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba un tipo de sangre'}
											}
										},
										intImporte_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                  	//Verificar si el tipo de retención es porcentaje
				                                      	if($('#cmbTipoRetencion_empleados_recursos_humanos').val() === 'PORCENTAJE')
				                                     	{
			                                      			//Verificar que el porcentaje no sea mayor que 100
						                                    if(parseFloat($.reemplazar(value, ",", "")) > 100)
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'El porcentaje no debe ser mayor que 100'
						                                        };
						                                    }
					                                    } 
					                                    return true;
					                                  }
					                            }
											}
										},
										intInglesComprension_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intInglesLectura_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intInglesEscritura_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intFrancesComprension_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intFrancesLectura_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intFrancesEscritura_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intOtroComprension_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intOtroLectura_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intOtroEscritura_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intExcel_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intWord_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intPowerPoint_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intAccess_empleados_recursos_humanos: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El porcentaje no debe ser mayor que 100'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_empleados_recursos_humanos = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_empleados_recursos_humanos = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_empleados_recursos_humanos.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_empleados_recursos_humanos.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_empleados_recursos_humanos = $('#frmEmpleadosRecursosHumanos').data('bootstrapValidator');
			bootstrapValidator_empleados_recursos_humanos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_empleados_recursos_humanos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_empleados_recursos_humanos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_empleados_recursos_humanos()
		{
			try
			{
				$('#frmEmpleadosRecursosHumanos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_empleados_recursos_humanos()
		{
			//Obtenemos el objeto de la tabla dependientes
			var objTabla = document.getElementById('dg_dependientes_empleados_recursos_humanos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla 
			var arrNombres = [];
			var arrSexos = [];
			var arrFechasNacimiento = [];
			var arrParentescos = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				arrNombres.push(objRen.getAttribute('id'));
				arrSexos.push(objRen.cells[1].innerHTML);
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				arrFechasNacimiento.push($.formatFechaMysql(objRen.cells[2].innerHTML));
				arrParentescos.push(objRen.cells[3].innerHTML);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('recursos_humanos/empleados/guardar',
					{   
						//Datos del empleado
						intEmpleadoID: $('#txtEmpleadoID_empleados_recursos_humanos').val(),
						strCodigo: $('#txtCodigo_empleados_recursos_humanos').val(),
						strCodigoAnterior: $('#txtCodigoAnterior_empleados_recursos_humanos').val(),
						strNombre: $('#txtNombre_empleados_recursos_humanos').val(),
						strApellidoPaterno: $('#txtApellidoPaterno_empleados_recursos_humanos').val(),
						strApellidoMaterno: $('#txtApellidoMaterno_empleados_recursos_humanos').val(),
						strRfc: $('#txtRfc_empleados_recursos_humanos').val(),
						strRfcAnterior: $('#txtRfcAnterior_empleados_recursos_humanos').val(),
						strCurp: $('#txtCurp_empleados_recursos_humanos').val(),
						strCurpAnterior: $('#txtCurpAnterior_empleados_recursos_humanos').val(),
						strEstadoCivil: $('#txtEstadoCivil_empleados_recursos_humanos').val(),
						strSexo: $('#cmbSexo_empleados_recursos_humanos').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaNacimiento: $.formatFechaMysql($('#txtFechaNacimiento_empleados_recursos_humanos').val()),
						intMunicipioNacimientoID: $('#txtMunicipioNacimientoID_empleados_recursos_humanos').val(),
						strCalle: $('#txtCalle_empleados_recursos_humanos').val(),
						strNumeroExterior: $('#txtNumeroExterior_empleados_recursos_humanos').val(),
						strNumeroInterior: $('#txtNumeroInterior_empleados_recursos_humanos').val(),
						intCodigoPostalID: $('#txtCodigoPostalID_empleados_recursos_humanos').val(),
						strColonia: $('#txtColonia_empleados_recursos_humanos').val(),
						strLocalidad: $('#txtLocalidad_empleados_recursos_humanos').val(),
						intMunicipioID: $('#txtMunicipioID_empleados_recursos_humanos').val(),
						strTelefonoParticular: $('#txtTelefonoParticular_empleados_recursos_humanos').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_empleados_recursos_humanos').val(),
						strEmergenciaNombre: $('#txtEmergenciaNombre_empleados_recursos_humanos').val(),
						strEmergenciaTelefono: $('#txtEmergenciaTelefono_empleados_recursos_humanos').val(),
						strEmergenciaParentesco: $('#txtEmergenciaParentesco_empleados_recursos_humanos').val(),
						dteFechaIngreso: $.formatFechaMysql($('#txtFechaIngreso_empleados_recursos_humanos').val()),
						intSucursalID: $('#txtSucursalID_empleados_recursos_humanos').val(),
						intDepartamentoID: $('#txtDepartamentoID_empleados_recursos_humanos').val(),
						intPuestoID: $('#txtPuestoID_empleados_recursos_humanos').val(),
						strLicenciaManejo: $('#txtLicenciaManejo_empleados_recursos_humanos').val(),
						strLicenciaTipo: $('#cmbLicenciaTipo_empleados_recursos_humanos').val(),
						dteLicenciaExpedicion: $.formatFechaMysql($('#txtLicenciaExpedicion_empleados_recursos_humanos').val()),
						dteLicenciaVigencia: $.formatFechaMysql($('#txtLicenciaVigencia_empleados_recursos_humanos').val()),
						strCuentaBancaria: $('#txtCuentaBancaria_empleados_recursos_humanos').val(),
						strClabe: $('#txtClabe_empleados_recursos_humanos').val(),
						strNss: $('#txtNss_empleados_recursos_humanos').val(),
						strClinica: $('#txtClinica_empleados_recursos_humanos').val(),
						strInfonavit: $('#txtInfonavit_empleados_recursos_humanos').val(),
						strTipoRetencion: $('#cmbTipoRetencion_empleados_recursos_humanos').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intImporte: $.reemplazar($('#txtImporte_empleados_recursos_humanos').val(), ",", ""),
						dteFechaInfonavit: $.formatFechaMysql($('#txtFechaInfonavit_empleados_recursos_humanos').val()),
						strTipoSangre: $('#txtTipoSangre_empleados_recursos_humanos').val(),
						strTallaCamisa: $('#txtTallaCamisa_empleados_recursos_humanos').val(),
						strTallaPantalon: $('#txtTallaPantalon_empleados_recursos_humanos').val(),
						strTallaZapatos: $('#txtTallaZapatos_empleados_recursos_humanos').val(),
						strNumeroAfore: $('#txtNumeroAfore_empleados_recursos_humanos').val(),
						strAfore: $('#txtAfore_empleados_recursos_humanos').val(),
						strGradoEstudios: $('#txtGradoEstudios_empleados_recursos_humanos').val(),
						strLicenciaturaTitulo: $('#txtLicenciaturaTitulo_empleados_recursos_humanos').val(),
						strLicenciaturaInstitucion: $('#txtLicenciaturaInstitucion_empleados_recursos_humanos').val(),
						dteLicenciaturaFecha: $.formatFechaMysql($('#txtLicenciaturaFecha_empleados_recursos_humanos').val()),
						strMaestriaTitulo: $('#txtMaestriaTitulo_empleados_recursos_humanos').val(),
						strMaestriaInstitucion: $('#txtMaestriaInstitucion_empleados_recursos_humanos').val(),
						dteMaestriaFecha: $.formatFechaMysql($('#txtMaestriaFecha_empleados_recursos_humanos').val()),
						intInglesComprension: $('#txtInglesComprension_empleados_recursos_humanos').val(),
						intInglesLectura: $('#txtInglesLectura_empleados_recursos_humanos').val(),
						intInglesEscritura: $('#txtInglesEscritura_empleados_recursos_humanos').val(),
						intFrancesComprension: $('#txtFrancesComprension_empleados_recursos_humanos').val(),
						intFrancesLectura: $('#txtFrancesLectura_empleados_recursos_humanos').val(),
						intFrancesEscritura: $('#txtFrancesEscritura_empleados_recursos_humanos').val(),
						strOtroIdioma: $('#txtOtroIdioma_empleados_recursos_humanos').val(),
						intOtroComprension: $('#txtOtroComprension_empleados_recursos_humanos').val(),
						intOtroLectura: $('#txtOtroLectura_empleados_recursos_humanos').val(),
						intOtroEscritura: $('#txtOtroEscritura_empleados_recursos_humanos').val(),
						intExcel: $('#txtExcel_empleados_recursos_humanos').val(),
						intWord: $('#txtWord_empleados_recursos_humanos').val(),
						intPowerPoint: $('#txtPowerPoint_empleados_recursos_humanos').val(),
						intAccess: $('#txtAccess_empleados_recursos_humanos').val(),
						strOtrasHabilidades: $('#txtOtrasHabilidades_empleados_recursos_humanos').val(),
						//Datos de los dependientes
						strNombres: arrNombres.join('|'),
					    strSexos: arrSexos.join('|'),
					    strParentescos: arrParentescos.join('|'),
					    strFechasNacimiento: arrFechasNacimiento.join('|')
					   
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_empleados_recursos_humanos();
							//Hacer un llamado a la función para cerrar modal
							cerrar_empleados_recursos_humanos();   
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_empleados_recursos_humanos(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_empleados_recursos_humanos(tipoMensaje, mensaje)
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
		function cambiar_estatus_empleados_recursos_humanos(id, estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtEmpleadoID_empleados_recursos_humanos').val();

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
						              'title':    'Empleados',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                            	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_empleados_recursos_humanos(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_empleados_recursos_humanos(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_empleados_recursos_humanos(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('recursos_humanos/empleados/set_estatus',
			      {intEmpleadoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_empleados_recursos_humanos();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_empleados_recursos_humanos();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_empleados_recursos_humanos(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_empleados_recursos_humanos(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('recursos_humanos/empleados/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_empleados_recursos_humanos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				            
				          	//Recuperar valores
				            $('#txtEmpleadoID_empleados_recursos_humanos').val(data.row.empleado_id);
				            $('#txtCodigo_empleados_recursos_humanos').val(data.row.codigo);
				            $('#txtCodigoAnterior_empleados_recursos_humanos').val(data.row.codigo);
				            $('#txtNombre_empleados_recursos_humanos').val(data.row.nombre);
						    $('#txtApellidoPaterno_empleados_recursos_humanos').val(data.row.apellido_paterno);
						    $('#txtApellidoMaterno_empleados_recursos_humanos').val(data.row.apellido_materno);
						    $('#txtRfc_empleados_recursos_humanos').val(data.row.rfc);
						    $('#txtRfcAnterior_empleados_recursos_humanos').val(data.row.rfc);
						    $('#txtCurp_empleados_recursos_humanos').val(data.row.curp);
						    $('#txtCurpAnterior_empleados_recursos_humanos').val(data.row.curp);
						    $('#txtEstadoCivil_empleados_recursos_humanos').val(data.row.estado_civil);
						    $('#cmbSexo_empleados_recursos_humanos').val(data.row.sexo);
						    $('#txtFechaNacimiento_empleados_recursos_humanos').val(data.row.fecha_nacimiento);
						    $('#txtMunicipioNacimientoID_empleados_recursos_humanos').val(data.row.municipio_nacimiento_id);
						    $('#txtMunicipioNacimiento_empleados_recursos_humanos').val(data.row.municipio_nacimiento);
						    $('#txtEstadoNacimiento_empleados_recursos_humanos').val(data.row.estado_nacimiento);
						    $('#txtPaisNacimiento_empleados_recursos_humanos').val(data.row.pais_nacimiento);
						    $('#txtCalle_empleados_recursos_humanos').val(data.row.calle);
						    $('#txtNumeroExterior_empleados_recursos_humanos').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_empleados_recursos_humanos').val(data.row.numero_interior);
						    $('#txtCodigoPostalID_empleados_recursos_humanos').val(data.row.codigo_postal_id);
						    $('#txtCodigoPostal_empleados_recursos_humanos').val(data.row.codigo_postal);
						    $('#txtColonia_empleados_recursos_humanos').val(data.row.colonia);
						    $('#txtLocalidad_empleados_recursos_humanos').val(data.row.localidad);
						    $('#txtMunicipioID_empleados_recursos_humanos').val(data.row.municipio_id);
						    $('#txtMunicipio_empleados_recursos_humanos').val(data.row.municipio);
						    $('#txtEstado_empleados_recursos_humanos').val(data.row.estado);
						    $('#txtPais_empleados_recursos_humanos').val(data.row.pais);
						    $('#txtTelefonoParticular_empleados_recursos_humanos').val(data.row.telefono_particular);
						    $('#txtCorreoElectronico_empleados_recursos_humanos').val(data.row.correo_electronico);
						    $('#txtEmergenciaNombre_empleados_recursos_humanos').val(data.row.emergencia_nombre);
						    $('#txtEmergenciaTelefono_empleados_recursos_humanos').val(data.row.emergencia_telefono);
						    $('#txtEmergenciaParentesco_empleados_recursos_humanos').val(data.row.emergencia_parentesco);
						    $('#txtFechaIngreso_empleados_recursos_humanos').val(data.row.fecha_ingreso);

						    //Si existe id de la sucursal
						    if(data.row.sucursal_id > 0)
						    {
						    	$('#txtSucursalID_empleados_recursos_humanos').val(data.row.sucursal_id);
						    	$('#txtSucursal_empleados_recursos_humanos').val(data.row.sucursal);
						    }
						    else
						    {
						    	//Marcar (Seleccionar) checkbox para indicar que el empleado no pertenece a una sucursal
           					    $('#chbCorporativo_empleados_recursos_humanos').prop("checked", true);
						    	//Deshabilitar caja de texto
								$("#txtSucursal_empleados_recursos_humanos").attr('disabled','disabled');
						    }
						    
						    $('#txtDepartamentoID_empleados_recursos_humanos').val(data.row.departamento_id);
						    $('#txtDepartamento_empleados_recursos_humanos').val(data.row.departamento);
						    $('#txtPuestoID_empleados_recursos_humanos').val(data.row.puesto_id);
						    $('#txtPuesto_empleados_recursos_humanos').val(data.row.puesto);
						    $('#txtLicenciaManejo_empleados_recursos_humanos').val(data.row.licencia_manejo);
						    $('#cmbLicenciaTipo_empleados_recursos_humanos').val(data.row.licencia_tipo);
						    $('#txtLicenciaExpedicion_empleados_recursos_humanos').val(data.row.licencia_expedicion);
						    $('#txtLicenciaVigencia_empleados_recursos_humanos').val(data.row.licencia_vigencia);
						    $('#txtCuentaBancaria_empleados_recursos_humanos').val(data.row.cuenta_bancaria);
						    $('#txtClabe_empleados_recursos_humanos').val(data.row.clabe);
						    $('#txtNss_empleados_recursos_humanos').val(data.row.nss);
						    $('#txtClinica_empleados_recursos_humanos').val(data.row.clinica);
						    $('#txtInfonavit_empleados_recursos_humanos').val(data.row.infonavit);
						    $('#cmbTipoRetencion_empleados_recursos_humanos').val(data.row.tipo_retencion);
						    $('#txtImporte_empleados_recursos_humanos').val(data.row.importe);
                     		//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
			   			    $('#txtImporte_empleados_recursos_humanos').formatCurrency();
						    $('#txtFechaInfonavit_empleados_recursos_humanos').val(data.row.fecha_infonavit);
						    $('#txtTipoSangre_empleados_recursos_humanos').val(data.row.tipo_sangre);
						    $('#txtTallaCamisa_empleados_recursos_humanos').val(data.row.talla_camisa);
						    $('#txtTallaPantalon_empleados_recursos_humanos').val(data.row.talla_pantalon);
						    $('#txtTallaZapatos_empleados_recursos_humanos').val(data.row.talla_zapatos);
						    $('#txtNumeroAfore_empleados_recursos_humanos').val(data.row.numero_afore);
						    $('#txtAfore_empleados_recursos_humanos').val(data.row.afore);
						    $('#txtGradoEstudios_empleados_recursos_humanos').val(data.row.grado_estudios);
						    $('#txtLicenciaturaTitulo_empleados_recursos_humanos').val(data.row.licenciatura_titulo);
						    $('#txtLicenciaturaInstitucion_empleados_recursos_humanos').val(data.row.licenciatura_institucion);
						    $('#txtLicenciaturaFecha_empleados_recursos_humanos').val(data.row.licenciatura_fecha);
						    $('#txtMaestriaTitulo_empleados_recursos_humanos').val(data.row.maestria_titulo);
						    $('#txtMaestriaInstitucion_empleados_recursos_humanos').val(data.row.maestria_institucion);
						    $('#txtMaestriaFecha_empleados_recursos_humanos').val(data.row.maestria_fecha);
						    $('#txtInglesComprension_empleados_recursos_humanos').val(data.row.ingles_comprension);
						    $('#txtInglesLectura_empleados_recursos_humanos').val(data.row.ingles_lectura);
						    $('#txtInglesEscritura_empleados_recursos_humanos').val(data.row.ingles_escritura);
						    $('#txtFrancesComprension_empleados_recursos_humanos').val(data.row.frances_comprension);
						    $('#txtFrancesLectura_empleados_recursos_humanos').val(data.row.frances_lectura);
						    $('#txtFrancesEscritura_empleados_recursos_humanos').val(data.row.frances_escritura);
						    $('#txtOtroIdioma_empleados_recursos_humanos').val(data.row.otro_idioma);
						    $('#txtOtroComprension_empleados_recursos_humanos').val(data.row.otro_comprension);
						    $('#txtOtroLectura_empleados_recursos_humanos').val(data.row.otro_lectura);
						    $('#txtOtroEscritura_empleados_recursos_humanos').val(data.row.otro_escritura);
						    $('#txtExcel_empleados_recursos_humanos').val(data.row.excel);
						    $('#txtWord_empleados_recursos_humanos').val(data.row.word);
						    $('#txtPowerPoint_empleados_recursos_humanos').val(data.row.power_point);
						    $('#txtAccess_empleados_recursos_humanos').val(data.row.access);
						    $('#txtOtrasHabilidades_empleados_recursos_humanos').val(data.row.otras_habilidades);
						    $('#txtEstatus_empleados_recursos_humanos').val(strEstatus);
				            //Quitar clase disabled disabledTab para habilitar tab de expediente
				            $('#tabExpediente_empleados_recursos_humanos').removeClass("disabled disabledTab");
				            //Quitar clase disabled disabledTab para habilitar tab de incidencias
				            $('#tabIncidencias_empleados_recursos_humanos').removeClass("disabled disabledTab");
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_empleados_recursos_humanos').addClass("estatus-"+strEstatus);

				            //Mostrar botón Imprimir
							$("#btnImprimirRegistro_empleados_recursos_humanos").show();

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_empleados_recursos_humanos").show();

				            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
										 		   "   onclick='editar_renglon_dependientes_empleados_recursos_humanos(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button> " + 
												   "<button class='btn btn-default btn-xs' title='Eliminar'" +
										 		   "  onclick='eliminar_renglon_dependientes_empleados_recursos_humanos(this)'>" + 
										 		   "<span class='glyphicon glyphicon-trash'></span></button>";
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmEmpleadosRecursosHumanos').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_empleados_recursos_humanos").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_empleados_recursos_humanos").show();
							}

							//Mostramos los dependientes del registro
				            for (var intCon in data.dependientes) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_dependientes_empleados_recursos_humanos').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaNombre = objRenglon.insertCell(0);
								var objCeldaSexo = objRenglon.insertCell(1);
								var objCeldaFechaNacimiento = objRenglon.insertCell(2);
								var objCeldaParentesco = objRenglon.insertCell(3);
								var objCeldaAcciones = objRenglon.insertCell(4);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.dependientes[intCon].nombre);
								objCeldaNombre.innerHTML = data.dependientes[intCon].nombre;
								objCeldaNombre.setAttribute('class', 'movil b1');
								objCeldaSexo.innerHTML = data.dependientes[intCon].sexo;
								objCeldaSexo.setAttribute('class', 'movil b2');
								objCeldaFechaNacimiento.innerHTML = data.dependientes[intCon].fecha_nacimiento;
								objCeldaFechaNacimiento.setAttribute('class', 'movil b3');
								objCeldaParentesco.innerHTML = data.dependientes[intCon].parentesco;
								objCeldaParentesco.setAttribute('class', 'movil b4');
								objCeldaAcciones.setAttribute('class', 'td-center movil b5');
								objCeldaAcciones.innerHTML = strAccionesTabla;
							
							}

							//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_dependientes_empleados_recursos_humanos tr").length - 1;
							$('#numElementos_dependientes_empleados_recursos_humanos').html(intFilas);

							//Hacer llamado a la función  para cargar las incidencias en el grid
				            paginacion_incidencias_empleados_recursos_humanos();
				            //Hacer llamado a la función  para cargar los documentos activos en el grid
							documentos_expediente_empleados_recursos_humanos();
	

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objEmpleadosRecursosHumanos = $('#EmpleadosRecursosHumanosBox').bPopup({
															  appendTo: '#EmpleadosRecursosHumanosContent', 
								                              contentContainer: 'EmpleadosRecursosHumanosM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCodigo_empleados_recursos_humanos').focus();
					        }
			       	    }
			       },
			       'json');
		}

		/*******************************************************************************************************************
		Funciones del Tab - Dependientes
		*********************************************************************************************************************/
		/*******************************************************************************************************************
		Funciones de la tabla dependientes
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_dependientes_empleados_recursos_humanos()
		{
			//Obtenemos los datos de las cajas de texto
			var strNombre = $('#txtNombre_dependientes_empleados_recursos_humanos').val();
			var strSexo = $('#cmbSexo_dependientes_empleados_recursos_humanos').val();
			var dteFechaNacimiento = $('#txtFechaNacimiento_dependientes_empleados_recursos_humanos').val();
			var strParentesco = $('#txtParentesco_dependientes_empleados_recursos_humanos').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_dependientes_empleados_recursos_humanos').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (strNombre == '')
			{
				//Enfocar caja de texto
				$('#txtNombre_dependientes_empleados_recursos_humanos').focus();
			}
			else if (strSexo == '')
			{
				//Enfocar caja de texto
				$('#cmbSexo_dependientes_empleados_recursos_humanos').focus();
			}
			else if (dteFechaNacimiento == '')
			{
				//Enfocar caja de texto
				$('#txtFechaNacimiento_dependientes_empleados_recursos_humanos').focus();
			}
			else if (strParentesco == '')
			{
				//Enfocar caja de texto
				$('#txtParentesco_dependientes_empleados_recursos_humanos').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtNombre_dependientes_empleados_recursos_humanos').val('');
				$('#cmbSexo_dependientes_empleados_recursos_humanos').val('');
				$('#txtFechaNacimiento_dependientes_empleados_recursos_humanos').val('');
				$('#txtParentesco_dependientes_empleados_recursos_humanos').val('');

				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strNombre = strNombre.toUpperCase();
				strParentesco = strParentesco.toUpperCase();

				//Revisamos si existe el nombre proporcionado, si es así, editamos los datos
				if (objTabla.rows.namedItem(strNombre))
				{
					objTabla.rows.namedItem(strNombre).cells[1].innerHTML = strSexo;
					objTabla.rows.namedItem(strNombre).cells[2].innerHTML = dteFechaNacimiento;
					objTabla.rows.namedItem(strNombre).cells[3].innerHTML = strParentesco;
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaNombre = objRenglon.insertCell(0);
					var objCeldaSexo = objRenglon.insertCell(1);
					var objCeldaFechaNacimiento = objRenglon.insertCell(2);
					var objCeldaParentesco = objRenglon.insertCell(3);
					var objCeldaAcciones = objRenglon.insertCell(4);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strNombre);
					objCeldaNombre.setAttribute('class', 'movil b1');
					objCeldaNombre.innerHTML = strNombre;
					objCeldaSexo.setAttribute('class', 'movil b2');
					objCeldaSexo.innerHTML = strSexo;
					objCeldaFechaNacimiento.setAttribute('class', 'movil b3');
					objCeldaFechaNacimiento.innerHTML = dteFechaNacimiento;
					objCeldaParentesco.setAttribute('class', 'movil b4');
					objCeldaParentesco.innerHTML = strParentesco;
					objCeldaAcciones.setAttribute('class', 'td-center movil b5');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_dependientes_empleados_recursos_humanos(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button> " + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_dependientes_empleados_recursos_humanos(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>";
				}
				//Enfocar caja de texto
				$('#txtNombre_dependientes_empleados_recursos_humanos').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_dependientes_empleados_recursos_humanos tr").length - 1;
			$('#numElementos_dependientes_empleados_recursos_humanos').html(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_dependientes_empleados_recursos_humanos(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtNombre_dependientes_empleados_recursos_humanos').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#cmbSexo_dependientes_empleados_recursos_humanos').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtFechaNacimiento_dependientes_empleados_recursos_humanos').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtParentesco_dependientes_empleados_recursos_humanos').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			
			//Enfocar caja de texto
			$('#txtNombre_dependientes_empleados_recursos_humanos').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_dependientes_empleados_recursos_humanos(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_dependientes_empleados_recursos_humanos").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_dependientes_empleados_recursos_humanos tr").length - 1;
			$('#numElementos_dependientes_empleados_recursos_humanos').html(intFilas);

			//Enfocar caja de texto
			$('#txtNombre_dependientes_empleados_recursos_humanos').focus();
		}


		/*******************************************************************************************************************
		Funciones del Tab - Expediente
		*********************************************************************************************************************/
		//Función para la búsqueda de documentos activos
		function documentos_expediente_empleados_recursos_humanos() 
		{
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('recursos_humanos/documentos_empleados/get_activos',
					{	strTipo: 'Empleado',
						intEmpleadoID: $('#txtEmpleadoID_empleados_recursos_humanos').val(),
						strEstatus: $('#txtEstatus_empleados_recursos_humanos').val(),
						strPermisosAcceso: $('#txtAcciones_empleados_recursos_humanos').val()
					},
					function(data){
						$('#dg_expediente_empleados_recursos_humanos tbody').empty();
						var tmpExpedienteEmpleadosRecursosHumanos = Mustache.render($('#plantilla_expediente_empleados_recursos_humanos').html(),data);
						$('#dg_expediente_empleados_recursos_humanos tbody').html(tmpExpedienteEmpleadosRecursosHumanos);
						$('#numElementos_expediente_empleados_recursos_humanos').html(data.total_rows);
					},
			'json');
		}

		//Función para subir archivo (o imagen) de un registro desde el grid view
		function subir_archivo_expediente_empleados_recursos_humanos(documentoID)
		{
			//Variable que se utiliza para asignar archivo
			var strBotonArchivoIDExpedienteEmpleadosRecursosHumanos="archivo_expediente_empleados_recursos_humanos"+documentoID;
			//Obtenemos un array con los datos del archivo
	        var file = $("#"+strBotonArchivoIDExpedienteEmpleadosRecursosHumanos)[0].files[0];
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
			  				$('#'+strBotonArchivoIDExpedienteEmpleadosRecursosHumanos).val('');
						   	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_empleados_recursos_humanos('error', data.mensaje);
						}
						else
						{	
							//Hacer un llamado al método del controlador para subir archivo del registro
							$('#'+strBotonArchivoIDExpedienteEmpleadosRecursosHumanos).upload('recursos_humanos/empleados/subir_archivo',
									{ intDocumentoID:documentoID,
						      		  intEmpleadoID:$('#txtEmpleadoID_empleados_recursos_humanos').val(),
						      		  strBotonArchivoID: strBotonArchivoIDExpedienteEmpleadosRecursosHumanos
									},
									function(data) {
										//Limpia ruta del archivo cargado
						         		$('#'+strBotonArchivoIDExpedienteEmpleadosRecursosHumanos).val('');
										
										//Si existe id del empleado
										if($('#txtEmpleadoID_empleados_recursos_humanos').val() != '')
										{
											//Subida finalizada.
											if (data.resultado)
											{
							         			//Hacer llamado a la función  para cargar  los registros de los documentos (expediente) en el grid
							          	        documentos_expediente_empleados_recursos_humanos();
											}
											//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
											mensaje_empleados_recursos_humanos(data.tipo_mensaje, data.mensaje);
										}
										
									});
						}
				     },
				     'json');
		}

		//Función que se utiliza para descargar el archivo (o imagen) del registro seleccionado
		function descargar_archivo_expediente_empleados_recursos_humanos(documentoID)
		{
		
			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'recursos_humanos/empleados/descargar_archivo',
							'data' : {
										'intEmpleadoID': $('#txtEmpleadoID_empleados_recursos_humanos').val(),
										'intDocumentoID': documentoID				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}


		//Función que se utiliza para eliminar el archivo (o imagen) del registro seleccionado
		function eliminar_archivo_expediente_empleados_recursos_humanos(documentoID)
		{
			//Hacer un llamado al método del controlador para eliminar el archivo del registro
			$.post('recursos_humanos/empleados/eliminar_archivo',
			     {intEmpleadoID: $('#txtEmpleadoID_empleados_recursos_humanos').val(),
			      intDocumentoID: documentoID
			     },
			     function(data) {
			        if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros de los documentos (expediente) en el grid
		          	    documentos_expediente_empleados_recursos_humanos();
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_empleados_recursos_humanos(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*******************************************************************************************************************
		Funciones del Tab - Incidencias
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_incidencias_empleados_recursos_humanos() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtEmpleadoID_empleados_recursos_humanos').val() != strUltimaBusquedaIncidenciasEmpleadosRecursosHumanos)
			{
				intPaginaIncidenciasEmpleadosRecursosHumanos = 0;
				strUltimaBusquedaIncidenciasEmpleadosRecursosHumanos = $('#txtEmpleadoID_empleados_recursos_humanos').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('recursos_humanos/empleados_incidencias/get_paginacion',
					{	intEmpleadoID:$('#txtEmpleadoID_empleados_recursos_humanos').val(),
						strEstatus:'TODOS',
						intPagina:intPaginaIncidenciasEmpleadosRecursosHumanos,
						strPermisosAcceso: $('#txtAcciones_empleados_recursos_humanos').val()
					},
					function(data){
						$('#dg_incidencias_empleados_recursos_humanos tbody').empty();
						var tmpIncidenciasEmpleadosRecursosHumanos = Mustache.render($('#plantilla_incidencias_empleados_recursos_humanos').html(),data);
						$('#dg_incidencias_empleados_recursos_humanos tbody').html(tmpIncidenciasEmpleadosRecursosHumanos);
						$('#pagLinks_incidencias_empleados_recursos_humanos').html(data.paginacion);
						$('#numElementos_incidencias_empleados_recursos_humanos').html(data.total_rows);
						intPaginaIncidenciasEmpleadosRecursosHumanos = data.pagina;
					},
			'json');
		}

		//Función que se utiliza para descargar el archivo (o imagen) del registro seleccionado
		function descargar_archivo_incidencias_empleados_recursos_humanos(incidenciaID)
		{
			
			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'recursos_humanos/empleados_incidencias/descargar_archivo',
							'data' : {
										'intEmpleadoID': $('#txtEmpleadoID_empleados_recursos_humanos').val(),
										'intIncidenciaID': incidenciaID				
									 }
						   };

			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Impresión de Formato
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtSueldo_formato_empleados_recursos_humanos').numeric();
        	//Agregar datepicker para seleccionar fecha
			$('#dteFechaVencimiento_formato_empleados_recursos_humanos').datetimepicker({format: 'DD/MM/YYYY'});
			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_empleados_recursos_humanos').blur(function(){
				$('.moneda_empleados_recursos_humanos').formatCurrency({ roundToDecimalPlace: 2 });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
			* por ejemplo: 10 será 10.00*/
			$('.porcentaje_empleados_recursos_humanos').blur(function(){
				$('.porcentaje_empleados_recursos_humanos').formatCurrency({ roundToDecimalPlace: 2 });
			});
			
        	//Mostrar u ocultar div que contiene los valores del formato contrato cuando se cambie la opción del combobox 
	        $('#cmbTipo_formato_empleados_recursos_humanos').change(function(e){
	        	//Si el tipo de formato es contrato
	            if($('#cmbTipo_formato_empleados_recursos_humanos').val() == 'CONTRATO')
	            {
	                //Quitar clase no-mostrar para mostrar div que contiene los datos del formato contrato
	                $('#divValoresContrato_formato_empleados_recursos_humanos').removeClass('no-mostrar');
	                //Enfocar caja de texto
					$('#txtSueldo_formato_empleados_recursos_humanos').focus();
	            }
	            else
	            {
	            	//Hacer un llamado a la función para inicializar elementos del contrato
	                inicializar_contrato_formato_empleados_recursos_humanos();
	            }
	         });


	        //Mostrar u ocultar div´s que contienen los valores del contrato determinado cuando se cambie la opción del combobox 
	        $('#cmbTiempo_formato_empleados_recursos_humanos').change(function(e){
	        	//Si el tiempo del contrato es indeterminado
	            if($('#cmbTiempo_formato_empleados_recursos_humanos').val() == 'INDETERMINADO')
	            {
	                //Agregar clase no-mostrar para ocultar div´s correspondientes al contrato determinado
	                $('#divFechaVencimiento_formato_empleados_recursos_humanos').addClass('no-mostrar');
	                $('#divActividades_formato_empleados_recursos_humanos').addClass('no-mostrar');
	               
	            }
	            else
	            {
	            	//Quitar clase no-mostrar para mostrar div´s correspondientes al contrato determinado
	                $('#divFechaVencimiento_formato_empleados_recursos_humanos').removeClass('no-mostrar');
	                $('#divActividades_formato_empleados_recursos_humanos').removeClass('no-mostrar');
	            }

	         });


			/*******************************************************************************************************************
			Controles correspondientes al modal Empleados
			*********************************************************************************************************************/
			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Datos Personales
        	*********************************************************************************************************************/
        	//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtCodigo_empleados_recursos_humanos').numeric({decimal: false, negative: false});
        	$('#txtCodigoPostal_empleados_recursos_humanos').numeric({decimal: false, negative: false});
        	$('#txtTelefonoParticular_empleados_recursos_humanos').numeric({decimal: false, negative: false});
        	$('#txtEmergenciaTelefono_empleados_recursos_humanos').numeric({decimal: false, negative: false});

        	/*Asignar agregarCeros a la clase para añadir ceros a la izquierda del número
        	 * por ejemplo: 1 será 00001*/
        	$('.agregar-ceros_empleados_recursos_humanos').blur(function(){
				$.agregarCeros('txtCodigo_empleados_recursos_humanos', 5);
				//Si no existe id, verificar la existencia del código
				if ($('#txtEmpleadoID_empleados_recursos_humanos').val() == '' && $('#txtCodigo_empleados_recursos_humanos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código 
					editar_empleados_recursos_humanos($('#txtCodigo_empleados_recursos_humanos').val(), 'codigo', 'Nuevo');
				}
			});

        	//Agregar datepicker para seleccionar fecha
			$('#dteFechaNacimiento_empleados_recursos_humanos').datetimepicker({format: 'DD/MM/YYYY'});

			//Comprobar la existencia del rfc en la BD cuando pierda el enfoque la caja de texto
			$('#txtRfc_empleados_recursos_humanos').focusout(function(e){
				//Si no existe id, verificar la existencia del rfc
				if ($('#txtEmpleadoID_empleados_recursos_humanos').val() == '' && $('#txtRfc_empleados_recursos_humanos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el rfc 
					editar_empleados_recursos_humanos($('#txtRfc_empleados_recursos_humanos').val(), 'rfc', 'Nuevo');
				}
			});

			//Comprobar la existencia del curp en la BD cuando pierda el enfoque la caja de texto
			$('#txtCurp_empleados_recursos_humanos').focusout(function(e){
				//Si no existe id, verificar la existencia del curp
				if ($('#txtEmpleadoID_empleados_recursos_humanos').val() == '' && $('#txtCurp_empleados_recursos_humanos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el curp 
					editar_empleados_recursos_humanos($('#txtCurp_empleados_recursos_humanos').val(), 'curp', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de un municipio (lugar de nacimiento)
	        $('#txtMunicipioNacimiento_empleados_recursos_humanos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMunicipioNacimientoID_empleados_recursos_humanos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/municipios/autocomplete",
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
	             $('#txtMunicipioNacimientoID_empleados_recursos_humanos').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/municipios/get_datos',
	                  { 
	                  	strBusqueda:$("#txtMunicipioNacimientoID_empleados_recursos_humanos").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtMunicipioNacimiento_empleados_recursos_humanos").val(data.row.municipio);
	                       $("#txtEstadoNacimiento_empleados_recursos_humanos").val(data.row.estado);
	                       $("#txtPaisNacimiento_empleados_recursos_humanos").val(data.row.pais);
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
	        $('#txtMunicipioNacimiento_empleados_recursos_humanos').focusout(function(e){
	            //Si no existe id del municipio
	            if($('#txtMunicipioNacimientoID_empleados_recursos_humanos').val() == '' ||
	               $('#txtMunicipioNacimiento_empleados_recursos_humanos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMunicipioNacimientoID_empleados_recursos_humanos').val('');
	               $('#txtMunicipioNacimiento_empleados_recursos_humanos').val('');
	               $('#txtEstadoNacimiento_empleados_recursos_humanos').val('');
	               $('#txtPaisNacimiento_empleados_recursos_humanos').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un código postal 
	        $('#txtCodigoPostal_empleados_recursos_humanos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCodigoPostalID_empleados_recursos_humanos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_codigos_postales/autocomplete",
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
	             $('#txtCodigoPostalID_empleados_recursos_humanos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del código postal cuando pierda el enfoque la caja de texto
	        $('#txtCodigoPostal_empleados_recursos_humanos').focusout(function(e){
	            //Si no existe id del código postal
	            if($('#txtCodigoPostalID_empleados_recursos_humanos').val() == '' ||
	               $('#txtCodigoPostal_empleados_recursos_humanos').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtCodigoPostalID_empleados_recursos_humanos').val('');
	                $('#txtCodigoPostal_empleados_recursos_humanos').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un municipio (domicilio)
	        $('#txtMunicipio_empleados_recursos_humanos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMunicipioID_empleados_recursos_humanos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/municipios/autocomplete",
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
	             $('#txtMunicipioID_empleados_recursos_humanos').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/municipios/get_datos',
	                  { 
	                  	strBusqueda:$("#txtMunicipioID_empleados_recursos_humanos").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtMunicipio_empleados_recursos_humanos").val(data.row.municipio);
	                       $("#txtEstado_empleados_recursos_humanos").val(data.row.estado);
	                       $("#txtPais_empleados_recursos_humanos").val(data.row.pais);
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
	        $('#txtMunicipio_empleados_recursos_humanos').focusout(function(e){
	            //Si no existe id del municipio
	            if($('#txtMunicipioID_empleados_recursos_humanos').val() == '' || 
	               $('#txtMunicipio_empleados_recursos_humanos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMunicipioID_empleados_recursos_humanos').val('');
	               $('#txtMunicipio_empleados_recursos_humanos').val('');
	               $('#txtEstado_empleados_recursos_humanos').val('');
	               $('#txtPais_empleados_recursos_humanos').val('');
	            }
	            
	        });

	        /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Datos Laborales
        	*********************************************************************************************************************/
        	//Validar campos númericos (solamente valores enteros y positivos)
            $('#txtCuentaBancaria_empleados_recursos_humanos').numeric({decimal: false, negative: false});
            $('#txtClabe_empleados_recursos_humanos').numeric({decimal: false, negative: false});
            $('#txtNss_empleados_recursos_humanos').numeric({decimal: false, negative: false});
            $('#txtInfonavit_empleados_recursos_humanos').numeric({decimal: false, negative: false});
            $('#txtNumeroAfore_empleados_recursos_humanos').numeric({decimal: false, negative: false});
            //Validar campos decimales (no hay necesidad de poner '.')
            $('#txtImporte_empleados_recursos_humanos').numeric();
        	//Agregar datepicker para seleccionar fecha
			$('#dteFechaIngreso_empleados_recursos_humanos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteLicenciaExpedicion_empleados_recursos_humanos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteLicenciaVigencia_empleados_recursos_humanos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaInfonavit_empleados_recursos_humanos').datetimepicker({format: 'DD/MM/YYYY'});


			//Habilitar o deshabilitar sucursal, cuando se de click en el checkbox
		    $("#chbCorporativo_empleados_recursos_humanos").click(function() { 
		     	//Si el checkbox corporativo se encuentra seleccionado (marcado)
				if ($('#chbCorporativo_empleados_recursos_humanos').is(':checked')) 
		        {
		            //Deshabilitar caja de texto
					$("#txtSucursal_empleados_recursos_humanos").attr('disabled','disabled');
					//Limpiar contenido de las siguientes cajas de texto
		            $('#txtSucursalID_empleados_recursos_humanos').val('');
		            $('#txtSucursal_empleados_recursos_humanos').val('');
		        }
		        else
		        {
		          	//Habilitar caja de texto
					$("#txtSucursal_empleados_recursos_humanos").removeAttr('disabled');
		        }
		    
		    }); 

			//Cambiar formato del importe cuando cambie la opción del combobox
			$('#cmbTipoRetencion_empleados_recursos_humanos').change(function(e){
				//Dependiendo del tipo de retención cambiar el formato del importe
              	if($('#cmbTipoRetencion_empleados_recursos_humanos').val() === 'PORCENTAJE')
             	{
             		//Hacer un llamado a la función para reemplazar ',' por cadena vacia
					intImporteEmpleadosRecursosHumanos  = $.reemplazar($("#txtImporte_empleados_recursos_humanos").val(), ",", "");
					$("#txtImporte_empleados_recursos_humanos").val(intImporteEmpleadosRecursosHumanos);
             	}
             	else
             	{
             		//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
				    $('#txtImporte_empleados_recursos_humanos').formatCurrency();
             	}
			});


			//Autocomplete para recuperar los datos de una sucursal
	        $('#txtSucursal_empleados_recursos_humanos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSucursalID_empleados_recursos_humanos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "administracion/sucursales/autocomplete",
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
	             $('#txtSucursalID_empleados_recursos_humanos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la sucursal cuando pierda el enfoque la caja de texto
	        $('#txtSucursal_empleados_recursos_humanos').focusout(function(e){
	            //Si no existe id de la sucursal
	            if($('#txtSucursalID_empleados_recursos_humanos').val() == '' ||
	               $('#txtSucursal_empleados_recursos_humanos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSucursalID_empleados_recursos_humanos').val('');
	               $('#txtSucursal_empleados_recursos_humanos').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un departamento
	        $('#txtDepartamento_empleados_recursos_humanos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtDepartamentoID_empleados_recursos_humanos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/departamentos/autocomplete",
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
	             $('#txtDepartamentoID_empleados_recursos_humanos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del departamento cuando pierda el enfoque la caja de texto
	        $('#txtDepartamento_empleados_recursos_humanos').focusout(function(e){
	            //Si no existe id del departamento
	            if($('#txtDepartamentoID_empleados_recursos_humanos').val() == '' ||
	               $('#txtDepartamento_empleados_recursos_humanos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtDepartamentoID_empleados_recursos_humanos').val('');
	               $('#txtDepartamento_empleados_recursos_humanos').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un puesto
	        $('#txtPuesto_empleados_recursos_humanos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtPuestoID_empleados_recursos_humanos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/puestos/autocomplete",
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
	             $('#txtPuestoID_empleados_recursos_humanos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del puesto cuando pierda el enfoque la caja de texto
	        $('#txtPuesto_empleados_recursos_humanos').focusout(function(e){
	            //Si no existe id del puesto
	            if($('#txtPuestoID_empleados_recursos_humanos').val() == '' ||
	               $('#txtPuesto_empleados_recursos_humanos').val() == '' )
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtPuestoID_empleados_recursos_humanos').val('');
	               $('#txtPuesto_empleados_recursos_humanos').val('');
	            }
	            
	        });

	        /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Datos Académicos
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtInglesComprension_empleados_recursos_humanos').numeric();
			$('#txtInglesLectura_empleados_recursos_humanos').numeric();
			$('#txtInglesEscritura_empleados_recursos_humanos').numeric();
			$('#txtFrancesComprension_empleados_recursos_humanos').numeric();
			$('#txtFrancesLectura_empleados_recursos_humanos').numeric();
			$('#txtFrancesEscritura_empleados_recursos_humanos').numeric();
			$('#txtOtroComprension_empleados_recursos_humanos').numeric();
			$('#txtOtroLectura_empleados_recursos_humanos').numeric();
			$('#txtOtroEscritura_empleados_recursos_humanos').numeric();
			$('#txtExcel_empleados_recursos_humanos').numeric();
			$('#txtWord_empleados_recursos_humanos').numeric();
			$('#txtPowerPoint_empleados_recursos_humanos').numeric();
			$('#txtAccess_empleados_recursos_humanos').numeric();
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
            $('#dteLicenciaturaFecha_empleados_recursos_humanos').datetimepicker({ format: 'DD/MM/YYYY'});
            $('#dteMaestriaFecha_empleados_recursos_humanos').datetimepicker({ format: 'DD/MM/YYYY'});

            /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Dependientes
        	*********************************************************************************************************************/
        	//Agregar datepicker para seleccionar fecha
			$('#dteFechaNacimiento_dependientes_empleados_recursos_humanos').datetimepicker({format: 'DD/MM/YYYY'});

			//Validar que exista nombre cuando se pulse la tecla enter 
			$('#txtNombre_dependientes_empleados_recursos_humanos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe nombre
		            if($('#txtNombre_dependientes_empleados_recursos_humanos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtNombre_dependientes_empleados_recursos_humanos').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#cmbSexo_dependientes_empleados_recursos_humanos').focus();
			   	    }
		        }
		    });


			//Enfocar fecha de nacimiento cuando cambie la opción del combobox
	        $('#cmbSexo_dependientes_empleados_recursos_humanos').change(function(e){   
	            //Enfocar caja de texto
				$('#txtFechaNacimiento_dependientes_empleados_recursos_humanos').focus();
	        });


		    //Validar que exista fecha de nacimiento cuando se pulse la tecla enter 
			$('#txtFechaNacimiento_dependientes_empleados_recursos_humanos').on('keypress', function (e) {
				if(e.which === 13 )
		        {
		         	//Si no existe fecha de nacimiento
		            if($('#txtFechaNacimiento_dependientes_empleados_recursos_humanos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtFechaNacimiento_dependientes_empleados_recursos_humanos').focus();
			   	    }
		        }
		    });

			//Enfocar parentesco cuando cambie la fecha de nacimiento
		    $('#dteFechaNacimiento_dependientes_empleados_recursos_humanos').on('dp.change', function (e) {
				//Enfocar caja de texto
				$('#txtParentesco_dependientes_empleados_recursos_humanos').focus();
			});

		    //Validar que exista parentesco cuando se pulse la tecla enter 
			$('#txtParentesco_dependientes_empleados_recursos_humanos').on('keypress', function (e) {
				if(e.which === 13 )
		        {
		         	//Si no existe parentesco
		            if($('#txtParentesco_dependientes_empleados_recursos_humanos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtParentesco_dependientes_empleados_recursos_humanos').focus();
			   	    }
			   	    else
			   	    {	

			   	    	if (!$('#cmbSexo_dependientes_empleados_recursos_humanos').val() == '0'){
			   	    		//Hacer un llamado a la función para agregar renglón a la tabla
		    				agregar_renglon_dependientes_empleados_recursos_humanos();	
			   	    	}
			   	    	
			   	    }
		        }
		    });

		   

            /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Incidencias
        	*********************************************************************************************************************/
        	//Paginación de registros
			$('#pagLinks_incidencias_empleados_recursos_humanos').on('click','a',function(event){
				event.preventDefault();
				intPaginaIncidenciasEmpleadosRecursosHumanos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar las incidencias en el grid
				paginacion_incidencias_empleados_recursos_humanos();
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_empleados_recursos_humanos').on('click','a',function(event){
				event.preventDefault();
				intPaginaEmpleadosRecursosHumanos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_empleados_recursos_humanos();
			});

			//Abrir modal Empleados cuando se de clic en el botón
			$('#btnNuevo_empleados_recursos_humanos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_empleados_recursos_humanos();
				//Hacer llamado a la función  para cargar los documentos activos en el grid
				documentos_expediente_empleados_recursos_humanos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_empleados_recursos_humanos').addClass("estatus-NUEVO");
				//Abrir modal
				 objEmpleadosRecursosHumanos = $('#EmpleadosRecursosHumanosBox').bPopup({
											   appendTo: '#EmpleadosRecursosHumanosContent', 
				                               contentContainer: 'EmpleadosRecursosHumanosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_empleados_recursos_humanos').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_empleados_recursos_humanos').focus(); 
			//Hacer un llamado a la función para eliminar la carpeta temporal
			eliminar_carpeta_temp_empleados_recursos_humanos('Nuevo');
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_empleados_recursos_humanos();
		});
	</script>