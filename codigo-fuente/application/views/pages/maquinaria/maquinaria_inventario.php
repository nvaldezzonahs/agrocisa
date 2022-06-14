	<div id="MaquinariaInventarioMaquinariaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_maquinaria_inventario_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_maquinaria_inventario_maquinaria" 
								   name="strBusqueda_maquinaria_inventario_maquinaria"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_maquinaria_inventario_maquinaria"
										onclick="paginacion_maquinaria_inventario_maquinaria();" 
										title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_maquinaria_inventario_maquinaria"
									onclick="reporte_maquinaria_inventario_maquinaria('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_maquinaria_inventario_maquinaria"
									onclick="reporte_maquinaria_inventario_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Serie"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Motor"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Código"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Descripción"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Consignación"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_maquinaria_inventario_maquinaria">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Serie</th>
							<th class="movil">Motor</th>
							<th class="movil">Código</th>
							<th class="movil">Descripción</th>
							<th class="movil">Consignación</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_maquinaria_inventario_maquinaria" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{serie}}</td>
							<td class="movil">{{motor}}</td>
							<td class="movil">{{codigo}}</td>
							<td class="movil">{{descripcion_corta}}</td>
							<td class="movil">{{consignacion}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_maquinaria_inventario_maquinaria({{maquinaria_descripcion_id}},'{{serie}}','{{consignacion}}')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_maquinaria_inventario_maquinaria"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_maquinaria_inventario_maquinaria">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MaquinariaInventarioMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_maquinaria_inventario_maquinaria"  class="ModalBodyTitle">
			<h1>Inventario de Maquinaria</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMaquinariaInventarioMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMaquinariaInventarioMaquinaria"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Autocomplete que contiene las series de la descripción de maquinaria-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del inventario (correspondiente a la descripción de maquinaria) seleccionado-->
									<input id="txtInventarioMaquinariaDescripcionID_maquinaria_inventario_maquinaria" 
										   name="intInventarioMaquinariaDescripcionID_maquinaria_inventario_maquinaria"  
										   type="hidden" value="">
									</input>
									<label for="txtSerie_maquinaria_inventario_maquinaria">
										Serie
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtSerie_maquinaria_inventario_maquinaria" 
											name="strSerie_maquinaria_inventario_maquinaria" 
											type="text" value="" tabindex="1" 
											placeholder="Ingrese serie" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los motores de la descripción de maquinaria-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMotor_maquinaria_inventario_maquinaria">
										Motor
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtMotor_maquinaria_inventario_maquinaria" 
											name="strMotor_maquinaria_inventario_maquinaria" 
											type="text" value="" tabindex="1" 
											placeholder="Ingrese motor" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Consignación-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtConsignacion_maquinaria_inventario_maquinaria">Consignación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtConsignacion_maquinaria_inventario_maquinaria" 
											name="strConsignacion_maquinaria_inventario_maquinaria" 
											type="text" value="" disabled />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Código-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la descripción de maquinaria-->
									<input id="txtMaquinariaDescripcionID_maquinaria_inventario_maquinaria" 
										   name="intMaquinariaDescripcionID_maquinaria_inventario_maquinaria"  
										   type="hidden" value="">
									</input>
									<label for="txtCodigo_maquinaria_inventario_maquinaria">
										Código
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtCodigo_maquinaria_inventario_maquinaria" 
											name="strCodigo_maquinaria_inventario_maquinaria" 
											type="text" value="" disabled />
								</div>
							</div>
						</div>
						<!--Descripción corta-->
						<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcionCorta_maquinaria_inventario_maquinaria">Descripción corta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcionCorta_maquinaria_inventario_maquinaria" 
											name="strDescripcionCorta_maquinaria_inventario_maquinaria" type="text"  value="" disabled />
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Folio de entrada-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFolioEntrada_maquinaria_inventario_maquinaria">Entrada</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolioEntrada_maquinaria_inventario_maquinaria" 
											name="strFolioEntrada_maquinaria_inventario_maquinaria" type="text" 
											value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de entrada-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaEntrada_maquinaria_inventario_maquinaria">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaEntrada_maquinaria_inventario_maquinaria'>
					                    <input class="form-control" id="txtFechaEntrada_maquinaria_inventario_maquinaria"
					                    		name= "strFechaEntrada_maquinaria_inventario_maquinaria" 
					                    		type="text" value="" disabled />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Folio de salida-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFolioSalida_maquinaria_inventario_maquinaria">Salida</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolioSalida_maquinaria_inventario_maquinaria" 
											name="strFolioSalida_maquinaria_inventario_maquinaria" type="text" 
											value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de salida-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaSalida_maquinaria_inventario_maquinaria">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaSalida_maquinaria_inventario_maquinaria'>
					                    <input class="form-control" id="txtFechaSalida_maquinaria_inventario_maquinaria"
					                    		name= "strFechaSalida_maquinaria_inventario_maquinaria" 
					                    		type="text" value="" disabled />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene los vendedores activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group ">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id del vendedor seleccionado-->
									<input id="txtVendedorID_maquinaria_inventario_maquinaria" 
										   name="intVendedorID_maquinaria_inventario_maquinaria" 
										   type="hidden" value="">
									</input>
									<label for="txtVendedor_maquinaria_inventario_maquinaria">
										Vendedor
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtVendedor_maquinaria_inventario_maquinaria" 
											name="strVendedor_maquinaria_inventario_maquinaria" type="text" value=""  
											tabindex="1" placeholder="Ingrese vendedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los prospectos activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id del prospecto seleccionado-->
									<input id="txtProspectoID_maquinaria_inventario_maquinaria" 
										   name="intProspectoID_maquinaria_inventario_maquinaria" 
										   type="hidden" value="">
									</input>
									<label for="txtProspecto_maquinaria_inventario_maquinaria">
										Prospecto
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProspecto_maquinaria_inventario_maquinaria" 
											name="strProspecto_maquinaria_inventario_maquinaria" type="text" value="" 
											tabindex="1"  placeholder="Ingrese prospecto" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
					   <!--Observaciones-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_maquinaria_inventario_maquinaria">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_maquinaria_inventario_maquinaria" 
											name="strObservaciones_maquinaria_inventario_maquinaria" type="text" value="" 
											tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_maquinaria_inventario_maquinaria"  
									onclick="validar_maquinaria_inventario_maquinaria();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_maquinaria_inventario_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_maquinaria_inventario_maquinaria();" 
									title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MaquinariaInventarioMaquinariaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMaquinariaInventarioMaquinaria = 0;
		var strUltimaBusquedaMaquinariaInventarioMaquinaria = "";
		//Variable que se utiliza para asignar el id del módulo de maquinaria
		var intModuloIDMaquinariaInventarioMaquinaria = <?php echo MODULO_MAQUINARIA ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objMaquinariaInventarioMaquinaria = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_maquinaria_inventario_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/maquinaria_inventario/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_maquinaria_inventario_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMaquinariaInventarioMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosMaquinariaInventarioMaquinaria = strPermisosMaquinariaInventarioMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMaquinariaInventarioMaquinaria.length; i++)
					{
						//Si el indice es EDITAR (modificar)
						if(arrPermisosMaquinariaInventarioMaquinaria[i]=='EDITAR')
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_maquinaria_inventario_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosMaquinariaInventarioMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_maquinaria_inventario_maquinaria').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_maquinaria_inventario_maquinaria();
						}
						else if(arrPermisosMaquinariaInventarioMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_maquinaria_inventario_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosMaquinariaInventarioMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_maquinaria_inventario_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_maquinaria_inventario_maquinaria() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_maquinaria_inventario_maquinaria').val() != strUltimaBusquedaMaquinariaInventarioMaquinaria)
			{
				intPaginaMaquinariaInventarioMaquinaria = 0;
				strUltimaBusquedaMaquinariaInventarioMaquinaria = $('#txtBusqueda_maquinaria_inventario_maquinaria').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('maquinaria/maquinaria_inventario/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_maquinaria_inventario_maquinaria').val(),
						intPagina:intPaginaMaquinariaInventarioMaquinaria,
						strPermisosAcceso: $('#txtAcciones_maquinaria_inventario_maquinaria').val()
					},
					function(data){
						$('#dg_maquinaria_inventario_maquinaria tbody').empty();
						var tmpMaquinariaInventarioMaquinaria = Mustache.render($('#plantilla_maquinaria_inventario_maquinaria').html(),data);
						$('#dg_maquinaria_inventario_maquinaria tbody').html(tmpMaquinariaInventarioMaquinaria);
						$('#pagLinks_maquinaria_inventario_maquinaria').html(data.paginacion);
						$('#numElementos_maquinaria_inventario_maquinaria').html(data.total_rows);
						intPaginaMaquinariaInventarioMaquinaria = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_maquinaria_inventario_maquinaria(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/maquinaria_inventario/';

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
										'strBusqueda': $('#txtBusqueda_maquinaria_inventario_maquinaria').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_maquinaria_inventario_maquinaria()
		{
			//Incializar formulario
			$('#frmMaquinariaInventarioMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_maquinaria_inventario_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmMaquinariaInventarioMaquinaria').find('input[type=hidden]').val('');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro existente)
			$('#divEncabezadoModal_maquinaria_inventario_maquinaria').addClass("estatus-ACTIVO");
			//Mostrar botón Guardar
			$("#btnGuardar_maquinaria_inventario_maquinaria").show();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_maquinaria_inventario_maquinaria()
		{
			try {
				//Cerrar modal
				objMaquinariaInventarioMaquinaria.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_maquinaria_inventario_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_maquinaria_inventario_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_maquinaria_inventario_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmMaquinariaInventarioMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strVendedor_maquinaria_inventario_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vendedor
					                                    if(value !== '' && $('#txtVendedorID_maquinaria_inventario_maquinaria').val() === '')
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
										},
										strProspecto_maquinaria_inventario_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del prospecto
					                                    if(value !== '' && $('#txtProspectoID_maquinaria_inventario_maquinaria').val() === '')
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
										strSerie_maquinaria_inventario_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de inventario de la descripción de maquinaria
					                                    if($('#txtInventarioMaquinariaDescripcionID_maquinaria_inventario_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una serie existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMotor_maquinaria_inventario_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de inventario de la descripción de maquinaria
					                                    if(value !== '' && $('#txtInventarioMaquinariaDescripcionID_maquinaria_inventario_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una motor existente'
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
			var bootstrapValidator_maquinaria_inventario_maquinaria = $('#frmMaquinariaInventarioMaquinaria').data('bootstrapValidator');
			bootstrapValidator_maquinaria_inventario_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_maquinaria_inventario_maquinaria.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_maquinaria_inventario_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_maquinaria_inventario_maquinaria()
		{
			try
			{
				$('#frmMaquinariaInventarioMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para  modificar los datos de un registro
		function guardar_maquinaria_inventario_maquinaria()
		{
			//Hacer un llamado al método del controlador para modificar los datos del registro
			$.post('maquinaria/maquinaria_inventario/guardar',
					{ 
						intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_maquinaria_inventario_maquinaria').val(),
						strSerie: $('#txtSerie_maquinaria_inventario_maquinaria').val(),
						strConsignacion: $('#txtConsignacion_maquinaria_inventario_maquinaria').val(),
						intVendedorID: $('#txtVendedorID_maquinaria_inventario_maquinaria').val(),
						intProspectoID: $('#txtProspectoID_maquinaria_inventario_maquinaria').val(),
						strObservaciones: $('#txtObservaciones_maquinaria_inventario_maquinaria').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_maquinaria_inventario_maquinaria();
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_maquinaria_inventario_maquinaria();
							//Enfocar caja de texto
							$('#txtSerie_maquinaria_inventario_maquinaria').focus();   
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_maquinaria_inventario_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_maquinaria_inventario_maquinaria(tipoMensaje, mensaje)
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
		function editar_maquinaria_inventario_maquinaria(maquinariaDescripcionID, serie, consignacion)
		{	

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/maquinaria_inventario/get_datos',
			       {intMaquinariaDescripcionID: maquinariaDescripcionID,
			       	strSerie: serie,
			       	strConsignacion: consignacion
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_maquinaria_inventario_maquinaria();
				          	//Recuperar valores
				            $('#txtMaquinariaDescripcionID_maquinaria_inventario_maquinaria').val(data.row.maquinaria_descripcion_id);
				          	$('#txtInventarioMaquinariaDescripcionID_maquinaria_inventario_maquinaria').val(data.row.serie);
	                        $("#txtSerie_maquinaria_inventario_maquinaria").val(data.row.serie);
	                        $("#txtMotor_maquinaria_inventario_maquinaria").val(data.row.motor);
	                        $('#txtCodigo_maquinaria_inventario_maquinaria').val(data.row.codigo);
						    $('#txtDescripcionCorta_maquinaria_inventario_maquinaria').val(data.row.descripcion_corta);
						    $('#txtConsignacion_maquinaria_inventario_maquinaria').val(data.row.consignacion);
						    $('#txtFolioEntrada_maquinaria_inventario_maquinaria').val(data.row.folio_entrada);
						    $('#txtFechaEntrada_maquinaria_inventario_maquinaria').val(data.row.fecha_entrada);
						    $('#txtFolioSalida_maquinaria_inventario_maquinaria').val(data.row.folio_salida);
						    $('#txtFechaSalida_maquinaria_inventario_maquinaria').val(data.row.fecha_salida);
						    $("#txtVendedorID_maquinaria_inventario_maquinaria").val(data.row.vendedor_id);
	                        $("#txtVendedor_maquinaria_inventario_maquinaria").val(data.row.vendedor);
	                        $("#txtProspectoID_maquinaria_inventario_maquinaria").val(data.row.prospecto_id);
	                        $("#txtProspecto_maquinaria_inventario_maquinaria").val(data.row.prospecto);
	                        $("#txtObservaciones_maquinaria_inventario_maquinaria").val(data.row.observaciones);
				           
			            	//Abrir modal
				            objMaquinariaInventarioMaquinaria = $('#MaquinariaInventarioMaquinariaBox').bPopup({
														  appendTo: '#MaquinariaInventarioMaquinariaContent', 
							                              contentContainer: 'MaquinariaInventarioMaquinariaM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtSerie_maquinaria_inventario_maquinaria').focus();
					        
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
			//Autocomplete para recuperar los datos de inventario de la descripción de maquinaria
			$('#txtSerie_maquinaria_inventario_maquinaria').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtInventarioMaquinariaDescripcionID_maquinaria_inventario_maquinaria').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "maquinaria/maquinaria_inventario/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term, 
							strTipo: 'serie'
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con los id´s
					editar_maquinaria_inventario_maquinaria(ui.item.maquinaria_descripcion_id, ui.item.serie, ui.item.consignacion);
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

		    //Verificar que exista id del inventario de la descripción de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtSerie_maquinaria_inventario_maquinaria').focusout(function(e){
	            //Si no existe id del inventario de la descripción de maquinaria
	            if($('#txtInventarioMaquinariaDescripcionID_maquinaria_inventario_maquinaria').val() == '' ||
	               $('#txtSerie_maquinaria_inventario_maquinaria').val() == '')
	            { 
	               //Hacer un llamado a la función para limpiar los campos del formulario
					nuevo_maquinaria_inventario_maquinaria();
	            }
	        });

	        //Autocomplete para recuperar los datos de inventario de la descripción de maquinaria
			$('#txtMotor_maquinaria_inventario_maquinaria').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtInventarioMaquinariaDescripcionID_maquinaria_inventario_maquinaria').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "maquinaria/maquinaria_inventario/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term,
							strTipo: 'motor'
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con los id´s
					editar_maquinaria_inventario_maquinaria(ui.item.maquinaria_descripcion_id, ui.item.serie, ui.item.consignacion);
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});


			//Verificar que exista id del inventario de la descripción de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMotor_maquinaria_inventario_maquinaria').focusout(function(e){
	            //Si no existe id del inventario de la descripción de maquinaria
	            if($('#txtInventarioMaquinariaDescripcionID_maquinaria_inventario_maquinaria').val() == '' ||
	               $('#txtMotor_maquinaria_inventario_maquinaria').val() == '')
	            { 
	                //Hacer un llamado a la función para limpiar los campos del formulario
					nuevo_maquinaria_inventario_maquinaria();
	            }
	        });

	        //Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_maquinaria_inventario_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_maquinaria_inventario_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDMaquinariaInventarioMaquinaria
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_maquinaria_inventario_maquinaria').val(ui.item.data);
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
	        $('#txtVendedor_maquinaria_inventario_maquinaria').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_maquinaria_inventario_maquinaria').val() == '' ||
	               $('#txtVendedor_maquinaria_inventario_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_maquinaria_inventario_maquinaria').val('');
	               $('#txtVendedor_maquinaria_inventario_maquinaria').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un prospecto
	        $('#txtProspecto_maquinaria_inventario_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_maquinaria_inventario_maquinaria').val('');
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
	             $('#txtProspectoID_maquinaria_inventario_maquinaria').val(ui.item.data);
	             
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
	        $('#txtProspecto_maquinaria_inventario_maquinaria').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoID_maquinaria_inventario_maquinaria').val() == '' ||
	               $('#txtProspecto_maquinaria_inventario_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_maquinaria_inventario_maquinaria').val('');
	               $('#txtProspecto_maquinaria_inventario_maquinaria').val('');
	            }
	        });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_maquinaria_inventario_maquinaria').on('click','a',function(event){
				event.preventDefault();
				intPaginaMaquinariaInventarioMaquinaria = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_maquinaria_inventario_maquinaria();
			});

		
			//Enfocar caja de texto
			$('#txtBusqueda_maquinaria_inventario_maquinaria').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_maquinaria_inventario_maquinaria();
		});
	</script>