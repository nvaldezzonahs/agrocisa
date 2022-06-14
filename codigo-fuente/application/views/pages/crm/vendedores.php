	<div id="VendedoresCRMContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_vendedores_crm" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_vendedores_crm" 
								   name="strBusqueda_vendedores_crm"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_vendedores_crm"
										onclick="paginacion_vendedores_crm();" 
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
							<button class="btn btn-info" id="btnNuevo_vendedores_crm" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_vendedores_crm"
									onclick="reporte_vendedores_crm('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_vendedores_crm"
									onclick="reporte_vendedores_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla vendedores
				*/
				td.movil.a1:nth-of-type(1):before {content: "Módulo"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Nombre"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla prospectos
				*/
				td.movil.b1:nth-of-type(1):before {content: "Prospecto"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_vendedores_crm">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Módulo</th>
							<th class="movil">Nombre</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_vendedores_crm" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil a1">{{modulo}}</td>
							<td class="movil a2">{{empleado}}</td>
							<td class="movil a3">{{estatus}}</td>
							<td class="td-center movil a4"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_vendedores_crm({{vendedor_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_vendedores_crm({{vendedor_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
                            	<!--Prospectos del vendedor-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_prospectos_vendedores_crm({{vendedor_id}});"  title="Prospectos">
									<span class="fa fa-users"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_vendedores_crm({{vendedor_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_vendedores_crm({{vendedor_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_vendedores_crm"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_vendedores_crm">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Vendedores-->
		<div id="VendedoresCRMBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_vendedores_crm"  class="ModalBodyTitle">
			<h1>Vendedores</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmVendedoresCRM" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmVendedoresCRM"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Autocomplete que contiene los módulos activos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtVendedorID_vendedores_crm" 
										   name="intVendedorID_vendedores_crm" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
									<input id="txtModuloID_vendedores_crm" 
										   name="intModuloID_vendedores_crm"  type="hidden" value="">
									</input>
										<!-- Caja de texto oculta que se utiliza para recuperar el módulo anterior y así evitar duplicidad en caso de que exista otro registro con la mismo empleado en el módulo-->
									<input id="txtModuloIDAnterior_vendedores_crm" 
										   name="intModuloIDAnterior_vendedores_crm" type="hidden" 
										   value="">
									</input>
									<label for="txtModulo_vendedores_crm">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModulo_vendedores_crm" 
											name="strModulo_vendedores_crm" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los empleados activos-->
						<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
									<input id="txtEmpleadoID_vendedores_crm" 
										   name="intEmpleadoID_vendedores_crm"  type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el empleado anterior y así evitar duplicidad en caso de que exista otro registro con la mismo empleado en el módulo-->
									<input id="txtEmpleadoIDAnterior_vendedores_crm" 
										   name="intEmpleadoIDAnterior_vendedores_crm" type="hidden" value="">
									</input>
									<label for="txtEmpleado_vendedores_crm">Empleado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEmpleado_vendedores_crm" 
											name="strEmpleado_vendedores_crm" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_vendedores_crm"  
									onclick="validar_vendedores_crm();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Prospectos del vendedor-->
							<button class="btn btn-default" id="btnAutorizar_vendedores_crm"  
									onclick="abrir_prospectos_vendedores_crm('');"  title="Prospectos" tabindex="3" disabled>
								<span class="fa fa-users"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_vendedores_crm"  
									onclick="cambiar_estatus_vendedores_crm('','ACTIVO');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_vendedores_crm"  
									onclick="cambiar_estatus_vendedores_crm('','INACTIVO');"  title="Restaurar" tabindex="5" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_vendedores_crm"
									type="reset" aria-hidden="true" onclick="cerrar_vendedores_crm();" 
									title="Cerrar"  tabindex="6">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Vendedores-->

		<!-- Diseño del modal Prospectos del Vendedor-->
		<div id="ProspectosVendedoresCRMBox" class="ModalBody" tabindex="-1">
			<!--Título-->
			<div id="divEncabezadoModal_prospectos_vendedores_crm" class="ModalBodyTitle">
				<h1>Prospectos del Vendedor</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">	
				<!--Diseño del formulario-->
				<form id="frmProspectosVendedoresCRM" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmProspectosVendedoresCRM" onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Módulo-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtVendedorID_prospectos_vendedores_crm" 
										   name="intVendedorID_prospectos_vendedores_crm" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el número de prospectos que tiene el vendedor (de esta manera validaremos cuando se trate de un nuevo registro)-->
									<input id="txtTotalProspectosVendedor_prospectos_vendedores_crm" 
										   name="intTotalProspectosVendedor_prospectos_vendedores_crm" type="hidden" value="">
									</input>
									<label for="txtModulo_prospectos_vendedores_crm">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModulo_prospectos_vendedores_crm" 
											name="strModulo_prospectos_vendedores_crm" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Empleado-->
						<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtEmpleado_prospectos_vendedores_crm">Empleado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEmpleado_prospectos_vendedores_crm" 
											name="strEmpleado_prospectos_vendedores_crm" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el número de registros de la tabla prospectos--> 
									<input id="txtNumProspectos_prospectos_vendedores_crm" 
										   name="intNumProspectos_prospectos_vendedores_crm" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Lista de prospectos</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene los prospectos activos-->
													<div class="col-sm-11 col-md-11 col-lg-11 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id del prospecto seleccionado-->
																<input id="txtProspectoID_prospectos_vendedores_crm" 
																	   name="intProspectoID_prospectos_vendedores_crm" 
																	   type="hidden" value="">
																</input>
																<label for="txtProspecto_prospectos_vendedores_crm">
																	Prospecto
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtProspecto_prospectos_vendedores_crm" 
																		name="strProspecto_prospectos_vendedores_crm" type="text" value=""  tabindex="1" placeholder="Ingrese prospecto" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_prospectos_vendedores_crm" 
					                                			onclick="agregar_renglon_prospectos_vendedores_crm();" 
					                                	     	title="Agregar" tabindex="1"> 
					                                		<span class="glyphicon glyphicon-plus"></span>
					                                	</button>
					                             	</div>
												</div>
											</div>
											<!--Div que contiene la tabla con los asistentes encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_prospectos_vendedores_crm">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Prospecto</th>
																<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
													</table>
													<br>
													<div class="row">
														<!--Número de registros encontrados-->
														<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
															<button class="btn btn-default btn-sm disabled pull-right">
																<strong id="numElementos_prospectos_vendedores_crm">0</strong> encontrados
															</button>
														</div>
													</div>
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
							<button class="btn btn-success" id="btnGuardar_prospectos_vendedores_crm"  
									onclick="validar_prospectos_vendedores_crm();"  title="Guardar"  tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_prospectos_vendedores_crm"
									type="reset" aria-hidden="true" onclick="cerrar_prospectos_vendedores_crm();" title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Prospectos del Vendedor-->
	</div><!--#VendedoresCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaVendedoresCRM = 0;
		var strUltimaBusquedaVendedoresCRM = "";
		//Variable que se utiliza para asignar objeto del modal Vendedores
		var objVendedoresCRM = null;
		//Variable que se utiliza para asignar objeto del modal Prospectos del Vendedor
		var objProspectosVendedoresCRM = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_vendedores_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/vendedores/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_vendedores_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosVendedoresCRM = data.row;
					//Separar la cadena 
					var arrPermisosVendedoresCRM = strPermisosVendedoresCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosVendedoresCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosVendedoresCRM[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_vendedores_crm').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosVendedoresCRM[i]=='GUARDAR') || (arrPermisosVendedoresCRM[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_vendedores_crm').removeAttr('disabled');
						}
						else if(arrPermisosVendedoresCRM[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_vendedores_crm').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_vendedores_crm();
						}
						else if(arrPermisosVendedoresCRM[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_vendedores_crm').removeAttr('disabled');
							$('#btnRestaurar_vendedores_crm').removeAttr('disabled');
						}
						else if(arrPermisosVendedoresCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_vendedores_crm').removeAttr('disabled');
						}
						else if(arrPermisosVendedoresCRM[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_vendedores_crm').removeAttr('disabled');
						}
						else if(arrPermisosVendedoresCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_vendedores_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_vendedores_crm() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_vendedores_crm').val() != strUltimaBusquedaVendedoresCRM)
			{
				intPaginaVendedoresCRM = 0;
				strUltimaBusquedaVendedoresCRM = $('#txtBusqueda_vendedores_crm').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('crm/vendedores/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_vendedores_crm').val(),
						intPagina:intPaginaVendedoresCRM,
						strPermisosAcceso: $('#txtAcciones_vendedores_crm').val()
					},
					function(data){
						$('#dg_vendedores_crm tbody').empty();
						var tmpVendedoresCRM = Mustache.render($('#plantilla_vendedores_crm').html(),data);
						$('#dg_vendedores_crm tbody').html(tmpVendedoresCRM);
						$('#pagLinks_vendedores_crm').html(data.paginacion);
						$('#numElementos_vendedores_crm').html(data.total_rows);
						intPaginaVendedoresCRM = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_vendedores_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/vendedores/';

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
										'strBusqueda': $('#txtBusqueda_vendedores_crm').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal Vendedores
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_vendedores_crm()
		{
			//Incializar formulario
			$('#frmVendedoresCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_vendedores_crm();
			//Limpiar cajas de texto ocultas
			$('#frmVendedoresCRM').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_vendedores_crm');
			//Habilitar todos los elementos del formulario
			$('#frmVendedoresCRM').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_vendedores_crm").show();
			//Ocultar los siguientes botones
			$("#btnAutorizar_vendedores_crm").hide();
			$("#btnDesactivar_vendedores_crm").hide();
			$("#btnRestaurar_vendedores_crm").hide();
		}
	

		//Función que se utiliza para cerrar el modal
		function cerrar_vendedores_crm()
		{
			try {

				//Hacer un llamado a la función para cerrar modal Prospectos del Vendedor
				cerrar_prospectos_vendedores_crm();
				//Cerrar modal
				objVendedoresCRM.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_vendedores_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_vendedores_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_vendedores_crm();
			//Validación del formulario de campos obligatorios
			$('#frmVendedoresCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strModulo_vendedores_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del módulo
					                                    if($('#txtModuloID_vendedores_crm').val() === '')
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
										strEmpleado_vendedores_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtEmpleadoID_vendedores_crm').val() === '')
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
			var bootstrapValidator_vendedores_crm = $('#frmVendedoresCRM').data('bootstrapValidator');
			bootstrapValidator_vendedores_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_vendedores_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_vendedores_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_vendedores_crm()
		{
			try
			{
				$('#frmVendedoresCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_vendedores_crm()
		{	
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/vendedores/guardar',
					{ 
						intVendedorID: $('#txtVendedorID_vendedores_crm').val(),
						intEmpleadoID: $('#txtEmpleadoID_vendedores_crm').val(),
						intEmpleadoIDAnterior: $('#txtEmpleadoIDAnterior_vendedores_crm').val(),
						intModuloID: $('#txtModuloID_vendedores_crm').val(),
						intModuloIDAnterior: $('#txtModuloIDAnterior_vendedores_crm').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_vendedores_crm();
							//Hacer un llamado a la función para cerrar modal
							cerrar_vendedores_crm();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_vendedores_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_vendedores_crm(tipoMensaje, mensaje)
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
		function cambiar_estatus_vendedores_crm(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtVendedorID_vendedores_crm').val();

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
				              'title':    'Vendedores',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_vendedores_crm(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_vendedores_crm(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_vendedores_crm(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('crm/vendedores/set_estatus',
			      {intVendedorID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_vendedores_crm();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_vendedores_crm();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_vendedores_crm(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_vendedores_crm(busqueda, tipoBusqueda, tipoAccion)
		{				
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/vendedores/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro			        	
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_vendedores_crm();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

				          	//Recuperar valores
				            $('#txtVendedorID_vendedores_crm').val(data.row.vendedor_id);
				            $('#txtEmpleadoID_vendedores_crm').val(data.row.empleado_id);
				            $('#txtEmpleadoIDAnterior_vendedores_crm').val(data.row.empleado_id);
				            $('#txtEmpleado_vendedores_crm').val(data.row.empleado);
				            $('#txtModuloID_vendedores_crm').val(data.row.modulo_id);
				            $('#txtModuloIDAnterior_vendedores_crm').val(data.row.modulo_id);
				            $('#txtModulo_vendedores_crm').val(data.row.modulo);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_vendedores_crm').addClass("estatus-"+strEstatus);
				            
				           	//Mostrar botón Autorizar
				            $("#btnAutorizar_vendedores_crm").show();				         
				          
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_vendedores_crm").show();
				            	
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmVendedoresCRM').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_vendedores_crm").hide(); 								
				           		//Mostrar botón Restaurar
								$("#btnRestaurar_vendedores_crm").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {					    
				            	//Abrir modal
					            objVendedoresCRM = $('#VendedoresCRMBox').bPopup({
													  appendTo: '#VendedoresCRMContent', 
						                              contentContainer: 'VendedoresCRMM', 
						                              zIndex: 2, 
						                              modalClose: false, 
						                              modal: true, 
						                              follow: [true,false], 
						                              followEasing : "linear", 
						                              easing: "linear", 
						                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtModulo_vendedores_crm').focus();
					        }
			       	    }
			       	    
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_vendedores_crm()
		{
			//Si no existe id, verificar la existencia del vendedor
			if ($('#txtVendedorID_vendedores_crm').val() == '' && $('#txtModuloID_vendedores_crm').val() != '' && $('#txtEmpleadoID_vendedores_crm').val() != '')
			{	
				//Concatenar criterios de búsqueda (para poder verificar la existencia del empleado en el módulo)
				var strCriteriosBusqVendedoresCRM =$('#txtEmpleadoID_vendedores_crm').val() + '|' + $('#txtModuloID_vendedores_crm').val();
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con los criterios de búsqueda  
				editar_vendedores_crm(strCriteriosBusqVendedoresCRM, 'empleado', 'Nuevo');
			}
		}

		/*******************************************************************************************************************
		Funciones del modal Prospectos del Vendedor
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_prospectos_vendedores_crm()
		{
			//Incializar formulario
			$('#frmProspectosVendedoresCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospectos_vendedores_crm();
			//Limpiar cajas de texto ocultas
			$('#frmProspectosVendedoresCRM').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_prospectos_vendedores_crm');
			//Eliminar los datos de la tabla prospectos
			$('#dg_prospectos_vendedores_crm tbody').empty();
			$('#numElementos_prospectos_vendedores_crm').html(0);
			//Mostrar botón Guardar
			$("#btnGuardar_prospectos_vendedores_crm").show();
		}

		//Función que se utiliza para abrir el modal
		function abrir_prospectos_vendedores_crm(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_prospectos_vendedores_crm();
			//Variables que se utilizan para asignar los datos del registro
			var intID = 0;

		    //Si no existe id, significa que se realizará el registro de prospectos desde el modal
			if(id == '')
			{
				intID = $('#txtVendedorID_vendedores_crm').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/vendedores/get_datos',
			       {strBusqueda:intID,
			       	strTipo: 'id'
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				            
			            	//Asignar datos del registro seleccionado
							$('#txtVendedorID_prospectos_vendedores_crm').val(data.row.vendedor_id);
							$('#txtEmpleado_prospectos_vendedores_crm').val(data.row.empleado);
							$('#txtModulo_prospectos_vendedores_crm').val(data.row.modulo);		
							$('#txtTotalProspectosVendedor_prospectos_vendedores_crm').val(data.total_prospectos);		

							//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Si el vendedor tiene prospectos
				            	if(data.total_prospectos > 0)
				            	{
				            		//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
									$('#divEncabezadoModal_prospectos_vendedores_crm').addClass("estatus-ACTIVO");
				            	}
				            	else
				            	{
				            		//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
								    $('#divEncabezadoModal_prospectos_vendedores_crm').addClass("estatus-NUEVO");
				            	}

				            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_prospectos_vendedores_crm(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>";

								//Habilitar botón Agregar prospecto
				            	$('#btnAgregar_prospectos_vendedores_crm').removeAttr('disabled');
				            	
							}
							else
							{
								//Dependiendo del estatus cambiar el color del encabezado
								$('#divEncabezadoModal_prospectos_vendedores_crm').addClass("estatus-"+strEstatus);
								//Ocultar botón Guardar
								$("#btnGuardar_prospectos_vendedores_crm").hide();
								//Deshabilitar botón Agregar prospecto
			            		$('#btnAgregar_prospectos_vendedores_crm').attr("disabled", "disabled");
							}
							
							//Mostramos los prospector del registro
				            for (var intCon in data.prospectos) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_prospectos_vendedores_crm').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaProspecto = objRenglon.insertCell(0);
								var objCeldaAcciones = objRenglon.insertCell(1);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.prospectos[intCon].prospecto_id);
								objCeldaProspecto.setAttribute('class', 'movil b1');
								objCeldaProspecto.innerHTML = data.prospectos[intCon].prospecto;
								objCeldaAcciones.setAttribute('class', 'td-center movil b2');
								objCeldaAcciones.innerHTML = strAccionesTabla;

				            }

				            //Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_prospectos_vendedores_crm tr").length - 1;
							$('#numElementos_prospectos_vendedores_crm').html(intFilas);
							$('#txtNumProspectos_prospectos_vendedores_crm').val(intFilas);

						    //Abrir modal
							objProspectosVendedoresCRM = $('#ProspectosVendedoresCRMBox').bPopup({
															   appendTo: '#VendedoresCRMContent', 
									                           contentContainer: 'VendedoresCRMM', 
									                           zIndex: 2, 
									                           modalClose: false, 
									                           modal: true, 
									                           follow: [true,false], 
									                           followEasing : "linear", 
									                           easing: "linear", 
									                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtProspecto_prospectos_vendedores_crm').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_prospectos_vendedores_crm()
		{
			try {
				//Cerrar modal
				objProspectosVendedoresCRM.close();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_prospectos_vendedores_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospectos_vendedores_crm();
			//Validación del formulario de campos obligatorios
			$('#frmProspectosVendedoresCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumProspectos_prospectos_vendedores_crm: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan prospectos cuando se trate de un nuevo registro
					                                    if(parseInt($('#txtTotalProspectosVendedor_prospectos_vendedores_crm').val()) === 0 && (parseInt(value) === 0 || value === ''))
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un prospecto para este vendedor.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strProspecto_prospectos_vendedores_crm: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_prospectos_vendedores_crm = $('#frmProspectosVendedoresCRM').data('bootstrapValidator');
			bootstrapValidator_prospectos_vendedores_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_prospectos_vendedores_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_prospectos_vendedores_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_prospectos_vendedores_crm()
		{
			try
			{
				$('#frmProspectosVendedoresCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Método para guardar los datos de un registro
		function guardar_prospectos_vendedores_crm()
		{
			//Obtenemos el objeto de la tabla asistentes
			var objTabla = document.getElementById('dg_prospectos_vendedores_crm').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrProspectoID = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				arrProspectoID.push(objRen.getAttribute('id'));
				
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/vendedores/guardar_prospectos',
					{ 
						intVendedorID: $('#txtVendedorID_prospectos_vendedores_crm').val(),
						strProspectoID: arrProspectoID.join('|')
					
					},
					function(data) {
						if (data.resultado)
						{
			                //Hacer un llamado a la función para cerrar modal
			                cerrar_prospectos_vendedores_crm();         
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_vendedores_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
			
		}

		/*******************************************************************************************************************
		Funciones de la tabla prospectos
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_prospectos_vendedores_crm()
		{
			//Obtenemos los datos de las cajas de texto
			var intProspectoID = $('#txtProspectoID_prospectos_vendedores_crm').val();
			var strProspecto = $('#txtProspecto_prospectos_vendedores_crm').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_prospectos_vendedores_crm').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intProspectoID == '' || strProspecto == '')
			{
				//Enfocar caja de texto
				$('#txtProspecto_prospectos_vendedores_crm').focus();
			}
			else
			{

				//Limpiamos las cajas de texto
				$('#txtProspectoID_prospectos_vendedores_crm').val('');
				$('#txtProspecto_prospectos_vendedores_crm').val('');

				//Revisamos si no existe el ID proporcionado, si es así, agregamos al prospecto
				if (!objTabla.rows.namedItem(intProspectoID))
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaProspecto = objRenglon.insertCell(0);
					var objCeldaAcciones = objRenglon.insertCell(1);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intProspectoID);
					objCeldaProspecto.setAttribute('class', 'movil b1');
					objCeldaProspecto.innerHTML = strProspecto;
					objCeldaAcciones.setAttribute('class', 'td-center movil b2');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_prospectos_vendedores_crm(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>";
				}
				//Enfocar caja de texto
				$('#txtProspecto_prospectos_vendedores_crm').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_prospectos_vendedores_crm tr").length - 1;
			$('#numElementos_prospectos_vendedores_crm').html(intFilas);
			$('#txtNumProspectos_prospectos_vendedores_crm').val(intFilas);
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_prospectos_vendedores_crm(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_prospectos_vendedores_crm").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_prospectos_vendedores_crm tr").length - 1;
			$('#numElementos_prospectos_vendedores_crm').html(intFilas);
			$('#txtNumProspectos_prospectos_vendedores_crm').val(intFilas);

			//Enfocar caja de texto
			$('#txtProspecto_prospectos_vendedores_crm').focus();
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Vendedores
			*********************************************************************************************************************/
			//Autocomplete para recuperar los datos de un módulo 
	        $('#txtModulo_vendedores_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloID_vendedores_crm').val('');
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
		            $('#txtModuloID_vendedores_crm').val(ui.item.data);
		            //Hacer un llamado a la función para verificar la existencia del registro
					verificar_existencia_vendedores_crm();
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
	        $('#txtModulo_vendedores_crm').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloID_vendedores_crm').val() == '' ||
	               $('#txtModulo_vendedores_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtModuloID_vendedores_crm').val('');
	               $('#txtModulo_vendedores_crm').val('');
	            }
	            
	        });

			//Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleado_vendedores_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEmpleadoID_vendedores_crm').val('');
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
		            $('#txtEmpleadoID_vendedores_crm').val(ui.item.data);
		           //Hacer un llamado a la función para verificar la existencia del registro
					verificar_existencia_vendedores_crm();
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
	        $('#txtEmpleado_vendedores_crm').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoID_vendedores_crm').val() == '' ||
	               $('#txtEmpleado_vendedores_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoID_vendedores_crm').val('');
	               $('#txtEmpleado_vendedores_crm').val('');
	            }
	            
	        });

			/*******************************************************************************************************************
			Controles correspondientes al modal Prospectos del Vendedor
			*********************************************************************************************************************/
			//Autocomplete para recuperar los datos de un prospecto 
	        $('#txtProspecto_prospectos_vendedores_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtProspectoID_prospectos_vendedores_crm').val('');
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
	             $('#txtProspectoID_prospectos_vendedores_crm').val(ui.item.data);
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
	        $('#txtProspecto_prospectos_vendedores_crm').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoID_prospectos_vendedores_crm').val() == '' ||
	               $('#txtProspecto_prospectos_vendedores_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_prospectos_vendedores_crm').val('');
	               $('#txtProspecto_prospectos_vendedores_crm').val('');
	            }

	        });

	        //Validar que exista prospecto cuando se pulse la tecla enter 
			$('#txtProspecto_prospectos_vendedores_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe prospecto
		            if($('#txtProspectoID_prospectos_vendedores_crm').val() == '' || $('#txtProspecto_prospectos_vendedores_crm').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtProspecto_prospectos_vendedores_crm').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_prospectos_vendedores_crm();
			   	    }
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_vendedores_crm').on('click','a',function(event){
				event.preventDefault();
				intPaginaVendedoresCRM = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_vendedores_crm();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_vendedores_crm').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_vendedores_crm();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_vendedores_crm').addClass("estatus-NUEVO");
				//Abrir modal
				 objVendedoresCRM = $('#VendedoresCRMBox').bPopup({
											   appendTo: '#VendedoresCRMContent', 
				                               contentContainer: 'VendedoresCRMM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtModulo_vendedores_crm').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_vendedores_crm').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_vendedores_crm();
		});
	</script>