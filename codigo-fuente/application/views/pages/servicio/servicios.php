	<div id="ServiciosServicioContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_servicios_servicio" action="#" method="post" 
				  tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_servicios_servicio" 
								   name="strBusqueda_servicios_servicio"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_servicios_servicio"
										onclick="paginacion_servicios_servicio();" 
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
							<button class="btn btn-info" id="btnNuevo_servicios_servicio" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_servicios_servicio"
									onclick="reporte_servicios_servicio('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_servicios_servicio"
									onclick="reporte_servicios_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Código SAT"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Unidad SAT"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_servicios_servicio">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Descripción</th>
							<th class="movil">Código SAT</th>
							<th class="movil">Unidad SAT</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_servicios_servicio" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{codigo}}</td>
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{producto_servicio}}</td>
							<td class="movil">{{unidad}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_servicios_servicio({{servicio_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_servicios_servicio({{servicio_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_servicios_servicio({{servicio_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_servicios_servicio({{servicio_id}},'{{estatus}}')"  
										title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="4"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_servicios_servicio"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_servicios_servicio">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ServiciosServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_servicios_servicio"  class="ModalBodyTitle">
			<h1>Servicios</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmServiciosServicio" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmServiciosServicio"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
					    <!--Código-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtServicioID_servicios_servicio" name="intServicioID_servicios_servicio"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
									<input id="txtCodigoAnterior_servicios_servicio" 
										   name="strCodigoAnterior_servicios_servicio" 
											type="hidden" value="">
									</input>
									<label for="txtCodigo_servicios_servicio">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_servicios_servicio" 
											name="strCodigo_servicios_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese código" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Descripción-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_servicios_servicio">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_servicios_servicio" 
											name="strDescripcion_servicios_servicio" type="text" value=""
											tabindex="1" placeholder="Ingrese descripción" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				   	    <!--Autocomplete que contiene los productos y servicios activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del producto/servicio seleccionado-->
									<input id="txtProductoServicioID_servicios_servicio" 
										   name="intProductoServicioID_servicios_servicio"  
										   type="hidden" 
										   value="" />
									<label for="txtProductoServicio_servicios_servicio">Código SAT</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProductoServicio_servicios_servicio" 
											name="strProductoServicio_servicios_servicio" type="text"
											value="" tabindex="1"  placeholder="Ingrese código SAT" 
											maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las unidades activas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la unidad seleccionada-->
									<input id="txtUnidadID_servicios_servicio" 
										   name="intUnidadID_servicios_servicio"  
										   type="hidden" 
										   value="" />
									<label for="txtUnidad_servicios_servicio">Unidad SAT</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUnidad_servicios_servicio" 
											name="strUnidad_servicios_servicio" type="text" 
											value=""  tabindex="1"  placeholder="Ingrese unidad SAT" 
											maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
				    	<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
				    		<div class="form-group">
								<div class="col-md-12">					
									<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
									<input id="txtTasaCuotaIva_servicios_servicio" 
										   name="intTasaCuotaIva_servicios_servicio" 
										   type="hidden" value="">
									</input>
									<label for="txtPorcentajeIva_servicios_servicio">IVA %</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPorcentajeIva_servicios_servicio" 
											name="intPorcentajeIva_servicios_servicio" type="text" value="" tabindex="1" placeholder="Ingrese IVA" maxlength="250">
									</input>
								</div>
							</div>
				    	</div>
				    	<!--Autocomplete que contiene los objetos de impuesto-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObjetoImpuesto_servicios_servicio">Objeto de impuesto SAT</label>
								</div>
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del objeto de impuesto seleccionado-->
									<input id="txtObjetoImpuestoID_servicios_servicio" 
										   name="intObjetoImpuestoID_servicios_servicio"  
										   type="hidden" value="">
								    </input>
									<input  class="form-control" id="txtObjetoImpuesto_servicios_servicio" 
											name="strObjetoImpuesto_servicios_servicio" type="text" 
											value="" tabindex="1" placeholder="Ingrese objeto de impuesto SAT" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    	<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
				    	<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
				    		<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
									<input id="txtTasaCuotaIeps_servicios_servicio" 
										   name="intTasaCuotaIeps_servicios_servicio" 
										   type="hidden" value="">
									</input>
									<label for="txtPorcentajeIeps_servicios_servicio">IEPS %</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPorcentajeIeps_servicios_servicio" 
											name="intPorcentajeIeps_servicios_servicio" type="text" value="" tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
									</input>
								</div>
							</div>
				    	</div>
				    	<!--Horas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHoras_servicios_servicio">Tiempo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtHoras_servicios_servicio" 
											name="intHoras_servicios_servicio" type="text" 
											value="" tabindex="1" placeholder="Ingrese tiempo" maxlength="12">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_servicios_servicio"  
									onclick="validar_servicios_servicio();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_servicios_servicio"  
									onclick="cambiar_estatus_servicios_servicio('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_servicios_servicio"  
									onclick="cambiar_estatus_servicios_servicio('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_servicios_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_servicios_servicio();" title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ServiciosServicioContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaServiciosServicio = 0;
		var strUltimaBusquedaServiciosServicio = "";
		//Variable que se utiliza para asignar el id del objeto de impuesto base
		var intObjetoImpuestoBaseIDServiciosServicio = <?php echo OBJETOIMP_BASE ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objServiciosServicio = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_servicios_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/servicios/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_servicios_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosServiciosServicio = data.row;
					//Separar la cadena 
					var arrPermisosServiciosServicio = strPermisosServiciosServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosServiciosServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosServiciosServicio[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_servicios_servicio').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosServiciosServicio[i]=='GUARDAR') || (arrPermisosServiciosServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_servicios_servicio').removeAttr('disabled');
						}
						else if(arrPermisosServiciosServicio[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_servicios_servicio').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_servicios_servicio();
						}
						else if(arrPermisosServiciosServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_servicios_servicio').removeAttr('disabled');
							$('#btnRestaurar_servicios_servicio').removeAttr('disabled');
						}
						else if(arrPermisosServiciosServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_servicios_servicio').removeAttr('disabled');
						}
						else if(arrPermisosServiciosServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_servicios_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_servicios_servicio() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_servicios_servicio').val() != strUltimaBusquedaServiciosServicio)
			{
				intPaginaServiciosServicio = 0;
				strUltimaBusquedaServiciosServicio = $('#txtBusqueda_servicios_servicio').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/servicios/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_servicios_servicio').val(),
						intPagina:intPaginaServiciosServicio,
						strPermisosAcceso: $('#txtAcciones_servicios_servicio').val()
					},
					function(data){
						$('#dg_servicios_servicio tbody').empty();
						var tmpServiciosServicio = Mustache.render($('#plantilla_servicios_servicio').html(),data);
						$('#dg_servicios_servicio tbody').html(tmpServiciosServicio);
						$('#pagLinks_servicios_servicio').html(data.paginacion);
						$('#numElementos_servicios_servicio').html(data.total_rows);
						intPaginaServiciosServicio = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_servicios_servicio(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/servicios/';

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
										'strBusqueda': $('#txtBusqueda_servicios_servicio').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		//Regresar el impuesto de objeto base
		function cargar_objeto_impuesto_base_servicios_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.ajax({
			        url: 'contabilidad/sat_objeto_impuesto/get_datos',
			        method:'post',
			        dataType: 'json',
			        async: false,
			        data: {
			        	strBusqueda:intObjetoImpuestoBaseIDServiciosServicio,
			       		strTipo: 'id'
			        },
			        success: function (data) {
			          	//Si no se encuentra código 
			        	if(data.row)
			        	{
			        		//Recuperar valores
				            $('#txtObjetoImpuestoID_servicios_servicio').val(data.row.objeto_impuesto_id);
				            $('#txtObjetoImpuesto_servicios_servicio').val(data.row.codigo+' - '+data.row.descripcion);

			        	}
			        }
			    });
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_servicios_servicio()
		{
			//Incializar formulario
			$('#frmServiciosServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicios_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmServiciosServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_servicios_servicio');
			//Habilitar todos los elementos del formulario
			$('#frmServiciosServicio').find('input, textarea, select').removeAttr('disabled','disabled');	
			//Mostrar botón Guardar
			$("#btnGuardar_servicios_servicio").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_servicios_servicio").hide();
			$("#btnRestaurar_servicios_servicio").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_servicios_servicio()
		{
			try {
				//Cerrar modal
				objServiciosServicio.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_servicios_servicio').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_servicios_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicios_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmServiciosServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_servicios_servicio: {
											validators: {
												notEmpty: {message: 'Escriba el código para este servicio'}
											}
										},
										strDescripcion_servicios_servicio: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										strProductoServicio_servicios_servicio: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del producto/servicio
					                                    if($('#txtProductoServicioID_servicios_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un código SAT existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strUnidad_servicios_servicio: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la unidad
					                                    if($('#txtUnidadID_servicios_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una unidad SAT existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strObjetoImpuesto_servicios_servicio: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del objeto de impuesto
					                                    if($('#txtObjetoImpuestoID_servicios_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un objeto de impuesto SAT existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intPorcentajeIva_servicios_servicio: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del sat_unidades
					                                    if($('#txtTasaCuotaIva_servicios_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una tasa o cuota de IVA existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intPorcentajeIeps_servicios_servicio: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del sat_unidades
					                                    if($('#txtTasaCuotaIeps_servicios_servicio').val() === '' && $("#txtPorcentajeIeps_servicios_servicio").val())
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una tasa o cuota de IEPS existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intHoras_servicios_servicio: {
											validators: {
												notEmpty: {message: 'Escriba el número de horas'},
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del sat_unidades
					                                    if(parseFloat(value) <= 0)
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'El número de horas tiene que ser distinto de cero'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_servicios_servicio = $('#frmServiciosServicio').data('bootstrapValidator');
			bootstrapValidator_servicios_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_servicios_servicio.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_servicios_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_servicios_servicio()
		{
			try
			{
				$('#frmServiciosServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_servicios_servicio()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('servicio/servicios/guardar',
					{ 
						intServicioID: $('#txtServicioID_servicios_servicio').val(),
						strCodigo: $('#txtCodigo_servicios_servicio').val(),
						strCodigoAnterior: $('#txtCodigoAnterior_servicios_servicio').val(),
			            intProductoServicioID: $('#txtProductoServicioID_servicios_servicio').val(),
			            intUnidadID: $('#txtUnidadID_servicios_servicio').val(),
			            intObjetoImpuestoID: $('#txtObjetoImpuestoID_servicios_servicio').val(),
			            strDescripcion: $('#txtDescripcion_servicios_servicio').val(),
			            intHoras: $('#txtHoras_servicios_servicio').val(),
			            intTasaCuotaIva: $('#txtTasaCuotaIva_servicios_servicio').val(),
			            intTasaCuotaIeps: $('#txtTasaCuotaIeps_servicios_servicio').val()
			           
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_servicios_servicio();
							//Hacer un llamado a la función para cerrar modal
							cerrar_servicios_servicio();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_servicios_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_servicios_servicio(tipoMensaje, mensaje)
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
		function cambiar_estatus_servicios_servicio(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtServicioID_servicios_servicio').val();

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
				              'title':    'Servicios',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                                //Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_servicios_servicio(intID, strTipo, 'INACTIVO');

				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_servicios_servicio(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_servicios_servicio(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('servicio/servicios/set_estatus',
			      {intServicioID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_servicios_servicio();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_servicios_servicio();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_servicios_servicio(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_servicios_servicio(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/servicios/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {			   
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_servicios_servicio();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtServicioID_servicios_servicio').val(data.row.servicio_id);
				            $('#txtCodigo_servicios_servicio').val(data.row.codigo);
				            $('#txtCodigoAnterior_servicios_servicio').val(data.row.codigo);
				            $('#txtProductoServicioID_servicios_servicio').val(data.row.producto_servicio_id);
			                $('#txtProductoServicio_servicios_servicio').val(data.row.producto_servicio);
			                $('#txtUnidadID_servicios_servicio').val(data.row.unidad_id);
			                $('#txtUnidad_servicios_servicio').val(data.row.unidad);
			                $('#txtObjetoImpuestoID_servicios_servicio').val(data.row.objeto_impuesto_id);
				            $('#txtObjetoImpuesto_servicios_servicio').val(data.row.objeto_impuesto);
			                $('#txtDescripcion_servicios_servicio').val(data.row.descripcion);
			                $('#txtHoras_servicios_servicio').val(data.row.horas);
			                $('#txtTasaCuotaIva_servicios_servicio').val(data.row.tasa_cuota_iva);
			            	$('#txtTasaCuotaIeps_servicios_servicio').val(data.row.tasa_cuota_ieps);
			            	$('#txtPorcentajeIva_servicios_servicio').val(data.row.porcentaje_iva);
							$('#txtPorcentajeIeps_servicios_servicio').val(data.row.porcentaje_ieps);
				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_servicios_servicio').addClass("estatus-"+strEstatus);
				           	
				           	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_servicios_servicio").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmServiciosServicio').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_servicios_servicio").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_servicios_servicio").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objServiciosServicio = $('#ServiciosServicioBox').bPopup({
															  appendTo: '#ServiciosServicioContent', 
								                              contentContainer: 'ServiciosServicioM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCodigo_servicios_servicio').focus();
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
	        //Validar campos decimales (no hay necesidad de poner '.')
	        $('#txtHoras_servicios_servicio').numeric();
        	
			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo_servicios_servicio').focusout(function(e){
				//Si no existe id, verificar la existencia del código
				if ($('#txtServicioID_servicios_servicio').val() == '' && $('#txtCodigo_servicios_servicio').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código 
					editar_servicios_servicio($('#txtCodigo_servicios_servicio').val(), 'codigo', 'Nuevo');
				}
			});

			 //Autocomplete para recuperar los datos de un producto o servicio
	        $('#txtProductoServicio_servicios_servicio').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtProductoServicioID_servicios_servicio').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_productos_servicios/autocomplete",
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
	               $('#txtProductoServicioID_servicios_servicio').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del producto cuando pierda el enfoque la caja de texto
	        $('#txtProductoServicio_servicios_servicio').focusout(function(e){
	            //Si no existe id del producto
	            if($('#txtProductoServicioID_servicios_servicio').val() == '' ||
	               $('#txtProductoServicio_servicios_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProductoServicioID_servicios_servicio').val('');
	               $('#txtProductoServicio_servicios_servicio').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una unidad
	        $('#txtUnidad_servicios_servicio').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtUnidadID_servicios_servicio').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_unidades/autocomplete",
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
	               $('#txtUnidadID_servicios_servicio').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la unidad cuando pierda el enfoque la caja de texto
	        $('#txtUnidad_servicios_servicio').focusout(function(e){
	            //Si no existe id de la unidad
	            if($('#txtUnidadID_servicios_servicio').val() == '' ||
	               $('#txtUnidad_servicios_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUnidadID_servicios_servicio').val('');
	               $('#txtUnidad_servicios_servicio').val('');
	            }
	            
	        });

	         //Autocomplete para recuperar los datos de un objeto de impuesto
	        $('#txtObjetoImpuesto_servicios_servicio').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtObjetoImpuestoID_servicios_servicio').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_objeto_impuesto/autocomplete",
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
	               $('#txtObjetoImpuestoID_servicios_servicio').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del objeto de impuesto cuando pierda el enfoque la caja de texto
	        $('#txtObjetoImpuesto_servicios_servicio').focusout(function(e){
	            //Si no existe id del objeto de impuesto
	            if($('#txtObjetoImpuestoID_servicios_servicio').val() == '' ||
	               $('#txtObjetoImpuesto_servicios_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtObjetoImpuestoID_servicios_servicio').val('');
	               $('#txtObjetoImpuesto_servicios_servicio').val('');
	            }
	            
	        });

	         //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_servicios_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_servicios_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_tasa_cuota/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strImpuesto: 'IVA'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtTasaCuotaIva_servicios_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la tasa o cuota del impuesto de IVA cuando pierda el enfoque la caja de texto
	        $('#txtPorcentajeIva_servicios_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_servicios_servicio').val() == '' ||
	               $('#txtPorcentajeIva_servicios_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_servicios_servicio').val('');
	               $('#txtPorcentajeIva_servicios_servicio').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_servicios_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_servicios_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_tasa_cuota/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strImpuesto: 'IEPS'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtTasaCuotaIeps_servicios_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la tasa o cuota del impuesto de IEPS cuando pierda el enfoque la caja de texto
	        $('#txtPorcentajeIeps_servicios_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_servicios_servicio').val() == '' ||
	               $('#txtPorcentajeIeps_servicios_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_servicios_servicio').val('');
	               $('#txtPorcentajeIeps_servicios_servicio').val('');
	            }
	            
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_servicios_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaServiciosServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_servicios_servicio();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_servicios_servicio').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_servicios_servicio();
				//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
				cargar_objeto_impuesto_base_servicios_servicio();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_servicios_servicio').addClass("estatus-NUEVO");
				//Abrir modal
				 objServiciosServicio = $('#ServiciosServicioBox').bPopup({
											   appendTo: '#ServiciosServicioContent', 
				                               contentContainer: 'ServiciosServicioM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_servicios_servicio').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_servicios_servicio').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_servicios_servicio();
		});
	</script>