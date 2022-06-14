	<div id="SatCodigoPostalesContabilidadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_sat_codigos_postales_contabilidad" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_sat_codigos_postales_contabilidad" 
								   name="strBusqueda_sat_codigos_postales_contabilidad"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_sat_codigos_postales_contabilidad"
										onclick="paginacion_sat_codigos_postales_contabilidad();" title="Buscar coincidencias" 
										tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_sat_codigos_postales_contabilidad" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_sat_codigos_postales_contabilidad"
									onclick="reporte_sat_codigos_postales_contabilidad('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_sat_codigos_postales_contabilidad"
									onclick="reporte_sat_codigos_postales_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Código postal"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Estado"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Municipio"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_sat_codigos_postales_contabilidad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código postal</th>
							<th class="movil">Código estado</th>
							<th class="movil">Código municipio</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_sat_codigos_postales_contabilidad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{codigo_postal}}</td>
							<td class="movil">{{codigo_estado}}</td>
							<td class="movil">{{codigo_municipio}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_sat_codigos_postales_contabilidad({{codigo_postal_id}},'id','Editar')" 
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_sat_codigos_postales_contabilidad({{codigo_postal_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_sat_codigos_postales_contabilidad({{codigo_postal_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_sat_codigos_postales_contabilidad({{codigo_postal_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_sat_codigos_postales_contabilidad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_sat_codigos_postales_contabilidad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="SatCodigoPostalesContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_sat_codigos_postales_contabilidad"  class="ModalBodyTitle">
			<h1>Códigos Postales</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmSatCodigoPostalesContabilidad" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmSatCodigoPostalesContabilidad" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Código postal-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCodigoPostalID_sat_codigos_postales_contabilidad" 
										   name="intCodigoPostalID_sat_codigos_postales_contabilidad" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el código postal anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código postal-->
									<input id="txtCodigoPostalAnterior_sat_codigos_postales_contabilidad" 
										   name="strCodigoPostalAnterior_sat_codigos_postales_contabilidad" type="hidden" value="">
									</input>
									<label for="txtCodigoPostal_sat_codigos_postales_contabilidad">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigoPostal_sat_codigos_postales_contabilidad" 
											name="strCodigoPostal_sat_codigos_postales_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese código postal" maxlength="5">
									</input>
								</div>
							</div>
						</div>
						<!--Código del estado-->
                  		<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCodigoEstado_sat_codigos_postales_contabilidad">Código estado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigoEstado_sat_codigos_postales_contabilidad" 
											name="strCodigoEstado_sat_codigos_postales_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese código del estado" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Código del municipio-->
                  		<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCodigoMunicipio_sat_codigos_postales_contabilidad">Código municipio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigoMunicipio_sat_codigos_postales_contabilidad" 
											name="strCodigoMunicipio_sat_codigos_postales_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese código del municipio" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Código de la localidad-->
                  		<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCodigoLocalidad_sat_codigos_postales_contabilidad">Código localidad</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigoLocalidad_sat_codigos_postales_contabilidad" 
											name="strCodigoLocalidad_sat_codigos_postales_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese código de la localidad" maxlength="2">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Autocomplete que contiene los municipios activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del municipio seleccionado-->
									<input id="txtMunicipioID_sat_codigos_postales_contabilidad" 
										   name="intMunicipioID_sat_codigos_postales_contabilidad" type="hidden" value="">
									</input>
									<label for="txtMunicipio_sat_codigos_postales_contabilidad">Municipio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMunicipio_sat_codigos_postales_contabilidad" 
											name="strMunicipio_sat_codigos_postales_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese municipio" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    	<!--Estado-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtEstado_sat_codigos_postales_contabilidad">Estado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEstado_sat_codigos_postales_contabilidad" 
											name="strEstado_sat_codigos_postales_contabilidad" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_sat_codigos_postales_contabilidad"  
									onclick="validar_sat_codigos_postales_contabilidad();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_sat_codigos_postales_contabilidad"  
									onclick="cambiar_estatus_sat_codigos_postales_contabilidad('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_sat_codigos_postales_contabilidad"  
									onclick="cambiar_estatus_sat_codigos_postales_contabilidad('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_sat_codigos_postales_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_sat_codigos_postales_contabilidad();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#SatCodigoPostalesContabilidadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaSatCodigoPostalesContabilidad = 0;
		var strUltimaBusquedaSatCodigoPostalesContabilidad = "";
		//Variable que se utiliza para asignar objeto del modal
		var objSatCodigoPostalesContabilidad = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_sat_codigos_postales_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/sat_codigos_postales/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_sat_codigos_postales_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosSatCodigoPostalesContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosSatCodigoPostalesContabilidad = strPermisosSatCodigoPostalesContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosSatCodigoPostalesContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosSatCodigoPostalesContabilidad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_sat_codigos_postales_contabilidad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosSatCodigoPostalesContabilidad[i]=='GUARDAR') || (arrPermisosSatCodigoPostalesContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_sat_codigos_postales_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatCodigoPostalesContabilidad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_sat_codigos_postales_contabilidad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_sat_codigos_postales_contabilidad();
						}
						else if(arrPermisosSatCodigoPostalesContabilidad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_sat_codigos_postales_contabilidad').removeAttr('disabled');
							$('#btnRestaurar_sat_codigos_postales_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatCodigoPostalesContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_sat_codigos_postales_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatCodigoPostalesContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_sat_codigos_postales_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_sat_codigos_postales_contabilidad() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_sat_codigos_postales_contabilidad').val() != strUltimaBusquedaSatCodigoPostalesContabilidad)
			{
				intPaginaSatCodigoPostalesContabilidad = 0;
				strUltimaBusquedaSatCodigoPostalesContabilidad = $('#txtBusqueda_sat_codigos_postales_contabilidad').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('contabilidad/sat_codigos_postales/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_sat_codigos_postales_contabilidad').val(),
						intPagina:intPaginaSatCodigoPostalesContabilidad,
						strPermisosAcceso: $('#txtAcciones_sat_codigos_postales_contabilidad').val()
					},
					function(data){
						$('#dg_sat_codigos_postales_contabilidad tbody').empty();
						var tmpSatCodigoPostalesContabilidad = Mustache.render($('#plantilla_sat_codigos_postales_contabilidad').html(),data);
						$('#dg_sat_codigos_postales_contabilidad tbody').html(tmpSatCodigoPostalesContabilidad);
						$('#pagLinks_sat_codigos_postales_contabilidad').html(data.paginacion);
						$('#numElementos_sat_codigos_postales_contabilidad').html(data.total_rows);
						intPaginaSatCodigoPostalesContabilidad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_sat_codigos_postales_contabilidad(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/sat_codigos_postales/';

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
										'strBusqueda': $('#txtBusqueda_sat_codigos_postales_contabilidad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}

		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_sat_codigos_postales_contabilidad()
		{
			//Incializar formulario
			$('#frmSatCodigoPostalesContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sat_codigos_postales_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmSatCodigoPostalesContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_sat_codigos_postales_contabilidad');
			//Habilitar todos los elementos del formulario
			$('#frmSatCodigoPostalesContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar caja de texto
			$('#txtEstado_sat_codigos_postales_contabilidad').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_sat_codigos_postales_contabilidad").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_sat_codigos_postales_contabilidad").hide();
			$("#btnRestaurar_sat_codigos_postales_contabilidad").hide();
		}

		//Función para inicializar elementos del municipio
		function inicializar_municipio_sat_codigos_postales_contabilidad()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$("#txtEstado_sat_codigos_postales_contabilidad").val('');
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_sat_codigos_postales_contabilidad()
		{
			try {
				//Cerrar modal
				objSatCodigoPostalesContabilidad.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_sat_codigos_postales_contabilidad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_sat_codigos_postales_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sat_codigos_postales_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmSatCodigoPostalesContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigoPostal_sat_codigos_postales_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba un código postal'},
												stringLength: {
													min: 5,
													message: 'El código postal debe tener 5 caracteres de longitud'
												}
											}
										},
										strCodigoEstado_sat_codigos_postales_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba el código del estado'}
											}
										},
										strCodigoMunicipio_sat_codigos_postales_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba el código del municipio'}
											}
										},
										strMunicipio_sat_codigos_postales_contabilidad: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del municipio
					                                    if(value !== '' && $('#txtMunicipioID_sat_codigos_postales_contabilidad').val() === '')
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
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_sat_codigos_postales_contabilidad = $('#frmSatCodigoPostalesContabilidad').data('bootstrapValidator');
			bootstrapValidator_sat_codigos_postales_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_sat_codigos_postales_contabilidad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_sat_codigos_postales_contabilidad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_sat_codigos_postales_contabilidad()
		{
			try
			{
				$('#frmSatCodigoPostalesContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_sat_codigos_postales_contabilidad()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('contabilidad/sat_codigos_postales/guardar',
					{ 
						intCodigoPostalID: $('#txtCodigoPostalID_sat_codigos_postales_contabilidad').val(),
						strCodigoPostal: $('#txtCodigoPostal_sat_codigos_postales_contabilidad').val(),
						strCodigoPostalAnterior: $('#txtCodigoPostalAnterior_sat_codigos_postales_contabilidad').val(),
						strCodigoEstado: $('#txtCodigoEstado_sat_codigos_postales_contabilidad').val(),
						strCodigoMunicipio: $('#txtCodigoMunicipio_sat_codigos_postales_contabilidad').val(),
						strCodigoLocalidad: $('#txtCodigoLocalidad_sat_codigos_postales_contabilidad').val(),
						intMunicipioID: $('#txtMunicipioID_sat_codigos_postales_contabilidad').val()

					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_sat_codigos_postales_contabilidad();
							//Hacer un llamado a la función para cerrar modal
							cerrar_sat_codigos_postales_contabilidad();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_sat_codigos_postales_contabilidad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_sat_codigos_postales_contabilidad(tipoMensaje, mensaje)
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
		function cambiar_estatus_sat_codigos_postales_contabilidad(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCodigoPostalID_sat_codigos_postales_contabilidad').val();

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
				              'title':    'Códigos Postales',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_sat_codigos_postales_contabilidad(intID, strTipo, 'INACTIVO');
				                             
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_sat_codigos_postales_contabilidad(intID, strTipo, 'ACTIVO');

		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_sat_codigos_postales_contabilidad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('contabilidad/sat_codigos_postales/set_estatus',
			      {intCodigoPostalID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_sat_codigos_postales_contabilidad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_sat_codigos_postales_contabilidad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_sat_codigos_postales_contabilidad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_sat_codigos_postales_contabilidad(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/sat_codigos_postales/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_sat_codigos_postales_contabilidad();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				          	
				          	//Recuperar valores
				            $('#txtCodigoPostalID_sat_codigos_postales_contabilidad').val(data.row.codigo_postal_id);
				            $('#txtCodigoPostal_sat_codigos_postales_contabilidad').val(data.row.codigo_postal);
				            $('#txtCodigoPostalAnterior_sat_codigos_postales_contabilidad').val(data.row.codigo_postal);
				            $('#txtCodigoEstado_sat_codigos_postales_contabilidad').val(data.row.codigo_estado);
				            $('#txtCodigoMunicipio_sat_codigos_postales_contabilidad').val(data.row.codigo_municipio);
				            $('#txtCodigoLocalidad_sat_codigos_postales_contabilidad').val(data.row.codigo_localidad);
				            $('#txtMunicipioID_sat_codigos_postales_contabilidad').val(data.row.municipio_id);
				            $('#txtMunicipio_sat_codigos_postales_contabilidad').val(data.row.municipio);
				            $('#txtEstado_sat_codigos_postales_contabilidad').val(data.row.estado);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_sat_codigos_postales_contabilidad').addClass("estatus-"+strEstatus);
				           	
				           	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_sat_codigos_postales_contabilidad").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmSatCodigoPostalesContabilidad').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_sat_codigos_postales_contabilidad").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_sat_codigos_postales_contabilidad").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objSatCodigoPostalesContabilidad = $('#SatCodigoPostalesContabilidadBox').bPopup({
					            									 appendTo: '#SatCodigoPostalesContabilidadContent', 
                                                                     contentContainer: 'SatCodigoPostalesContabilidadM', 
                                                                     zIndex: 2, 
                                                                     modalClose: false, 
                                                                     modal: true, 
                                                                     follow: [true,false], 
                                                                     followEasing : "linear", 
                                                                     easing: "linear", 
                                                                     modalColor: ('#F0F0F0')});
					            //Enfocar caja de texto
								$('#txtCodigoPostal_sat_codigos_postales_contabilidad').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Función para regresar y obtener los datos de un municipio
		function get_datos_municipio_sat_codigos_postales_contabilidad()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos del municipio
             $.post('crm/municipios/get_datos',
	                  { 
	                  	strBusqueda:$("#txtMunicipioID_sat_codigos_postales_contabilidad").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtMunicipio_sat_codigos_postales_contabilidad").val(data.row.municipio);
	                       $("#txtEstado_sat_codigos_postales_contabilidad").val(data.row.estado);
	                    }
	                  }
	                 ,
	                'json');

		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtCodigoPostal_sat_codigos_postales_contabilidad').numeric({decimal: false, negative: false});
        	$('#txtCodigoMunicipio_sat_codigos_postales_contabilidad').numeric({decimal: false, negative: false});
        	$('#txtCodigoLocalidad_sat_codigos_postales_contabilidad').numeric({decimal: false, negative: false});
        	//Validar campo para introducir solamente letras
			$('#txtCodigoEstado_sat_codigos_postales_contabilidad').letras();

			//Comprobar la existencia del código postal en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigoPostal_sat_codigos_postales_contabilidad').focusout(function(e){
				//Si no existe id, verificar la existencia del código postal
				if ($('#txtCodigoPostalID_sat_codigos_postales_contabilidad').val() == '' && $('#txtCodigoPostal_sat_codigos_postales_contabilidad').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código postal
					editar_sat_codigos_postales_contabilidad($('#txtCodigoPostal_sat_codigos_postales_contabilidad').val(), 'codigo_postal', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de un municipio 
	        $('#txtMunicipio_sat_codigos_postales_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMunicipioID_sat_codigos_postales_contabilidad').val('');
	               //Hacer un llamado a la función para inicializar elementos del municipio
	                inicializar_municipio_sat_codigos_postales_contabilidad();
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
	             $('#txtMunicipioID_sat_codigos_postales_contabilidad').val(ui.item.data);
	             //Hacer un llamado a la función para regresar los datos del municipio
	             get_datos_municipio_sat_codigos_postales_contabilidad();
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
	        $('#txtMunicipio_sat_codigos_postales_contabilidad').focusout(function(e){
	            //Si no existe id del municipio
	            if($('#txtMunicipioID_sat_codigos_postales_contabilidad').val() == '' || $('#txtMunicipio_sat_codigos_postales_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMunicipioID_sat_codigos_postales_contabilidad').val('');
	               $('#txtMunicipio_sat_codigos_postales_contabilidad').val('');
	                //Hacer un llamado a la función para inicializar elementos del municipio
	                inicializar_municipio_sat_codigos_postales_contabilidad();
	            }
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_sat_codigos_postales_contabilidad').on('click','a',function(event){
				event.preventDefault();
				intPaginaSatCodigoPostalesContabilidad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_sat_codigos_postales_contabilidad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_sat_codigos_postales_contabilidad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_sat_codigos_postales_contabilidad();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_sat_codigos_postales_contabilidad').addClass("estatus-NUEVO");
				//Abrir modal
				objSatCodigoPostalesContabilidad= $('#SatCodigoPostalesContabilidadBox').bPopup({
													appendTo: '#SatCodigoPostalesContabilidadContent', 
	                                                contentContainer: 'SatCodigoPostalesContabilidadnM', 
	                                                zIndex: 2, 
	                                                modalClose: false, 
	                                                modal: true, 
	                                                follow: [true,false], 
	                                                followEasing : "linear", 
	                                                easing: "linear", 
	                                                modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigoPostal_sat_codigos_postales_contabilidad').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_sat_codigos_postales_contabilidad').focus();    
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_sat_codigos_postales_contabilidad();
		});
	</script>