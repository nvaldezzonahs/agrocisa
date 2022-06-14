	<div id="LocalidadesCRMContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_localidades_crm" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_localidades_crm" 
								   name="strBusqueda_localidades_crm"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_localidades_crm"
										onclick="paginacion_localidades_crm();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_localidades_crm" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_localidades_crm"
									onclick="reporte_localidades_crm('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_localidades_crm"
									onclick="reporte_localidades_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Localidad"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Municipio"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Estado"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "País"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_localidades_crm">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Localidad</th>
			                <th class="movil">Municipio</th>
			                <th class="movil">Estado</th>
			                <th class="movil">País</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_localidades_crm" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil">{{localidad}}</td>
							<td class="movil">{{municipio}}</td>
							<td class="movil">{{estado}}</td>
							<td class="movil">{{pais}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_localidades_crm({{localidad_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_localidades_crm({{localidad_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_localidades_crm({{localidad_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_localidades_crm({{localidad_id}},'{{estatus}}')"  
										title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td  class="movil" colspan="3"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_localidades_crm"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_localidades_crm">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="LocalidadesCRMBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_localidades_crm"  class="ModalBodyTitle">
			<h1>Localidades</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmLocalidadesCRM" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmLocalidadesCRM"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtLocalidadID_localidades_crm"
										   name="intLocalidadID_localidades_crm" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción en el municipio-->
									<input id="txtDescripcionAnterior_localidades_crm" 
										   name="strDescripcionAnterior_localidades_crm" type="hidden" value="">
									</input>
									<label for="txtDescripcion_localidades_crm">Localidad</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_localidades_crm" 
											name="strDescripcion_localidades_crm" type="text" value="" tabindex="1" placeholder="Ingrese localidad" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene los municipios activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del municipio seleccionado-->
									<input id="txtMunicipioID_localidades_crm" 
										   name="intMunicipioID_localidades_crm" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el municipio anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción en el municipio-->
									<input id="txtMunicipioIDAnterior_localidades_crm" 
										   name="strMunicipioIDAnterior_localidades_crm" type="hidden" value="">
									</input>
									<label for="txtMunicipio_localidades_crm">Municipio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMunicipio_localidades_crm" 
											name="strMunicipio_localidades_crm" type="text" value="" 
											tabindex="1" placeholder="Ingrese municipio" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Estado-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtEstado_localidades_crm">Estado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEstado_localidades_crm" 
											name="strEstado_localidades_crm" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--País-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPais_localidades_crm">País</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPais_localidades_crm" 
											name="strPais_localidades_crm" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_localidades_crm"  
									onclick="validar_localidades_crm();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_localidades_crm"  
									onclick="cambiar_estatus_localidades_crm('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_localidades_crm"  
									onclick="cambiar_estatus_localidades_crm('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_localidades_crm"
									type="reset" aria-hidden="true" onclick="cerrar_localidades_crm();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#LocalidadesCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaLocalidadesCRM = 0;
		var strUltimaBusquedaLocalidadesCRM = "";
		//Variable que se utiliza para asignar objeto del modal
		var objLocalidadesCRM = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_localidades_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/localidades/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_localidades_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosLocalidadesCRM = data.row;
					//Separar la cadena 
					var arrPermisosLocalidadesCRM = strPermisosLocalidadesCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosLocalidadesCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosLocalidadesCRM[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_localidades_crm').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosLocalidadesCRM[i]=='GUARDAR') || (arrPermisosLocalidadesCRM[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_localidades_crm').removeAttr('disabled');
						}
						else if(arrPermisosLocalidadesCRM[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_localidades_crm').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_localidades_crm();
						}
						else if(arrPermisosLocalidadesCRM[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_localidades_crm').removeAttr('disabled');
							$('#btnRestaurar_localidades_crm').removeAttr('disabled');
						}
						else if(arrPermisosLocalidadesCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_localidades_crm').removeAttr('disabled');
						}
						else if(arrPermisosLocalidadesCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_localidades_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_localidades_crm() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_localidades_crm').val() != strUltimaBusquedaLocalidadesCRM)
			{
				intPaginaLocalidadesCRM = 0;
				strUltimaBusquedaLocalidadesCRM = $('#txtBusqueda_localidades_crm').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('crm/localidades/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_localidades_crm').val(),
						intPagina:intPaginaLocalidadesCRM,
						strPermisosAcceso: $('#txtAcciones_localidades_crm').val()
					},
					function(data){
						$('#dg_localidades_crm tbody').empty();
						var tmpLocalidadesCRM = Mustache.render($('#plantilla_localidades_crm').html(),data);
						$('#dg_localidades_crm tbody').html(tmpLocalidadesCRM);
						$('#pagLinks_localidades_crm').html(data.paginacion);
						$('#numElementos_localidades_crm').html(data.total_rows);
						intPaginaLocalidadesCRM = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_localidades_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/localidades/';

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
										'strBusqueda': $('#txtBusqueda_localidades_crm').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_localidades_crm()
		{
			//Incializar formulario
			$('#frmLocalidadesCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_localidades_crm();
			//Limpiar cajas de texto ocultas
			$('#frmLocalidadesCRM').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_localidades_crm');
			//Habilitar todos los elementos del formulario
			$('#frmLocalidadesCRM').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtEstado_localidades_crm').attr("disabled", "disabled");
			$('#txtPais_localidades_crm').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_localidades_crm").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_localidades_crm").hide();
			$("#btnRestaurar_localidades_crm").hide();
		}
		

		//Función para inicializar elementos del municipio
		function inicializar_municipio_localidades_crm()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtEstado_localidades_crm').val('');
	        $('#txtPais_localidades_crm').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_localidades_crm()
		{
			try {
				//Cerrar modal
				objLocalidadesCRM.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_localidades_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_localidades_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_localidades_crm();
			//Validación del formulario de campos obligatorios
			$('#frmLocalidadesCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_localidades_crm: {
											validators: {
												notEmpty: {message: 'Escriba un localidad'}
											}
										},
										strMunicipio_localidades_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del municipio
					                                    if($('#txtMunicipioID_localidades_crm').val() === '')
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
			var bootstrapValidator_localidades_crm = $('#frmLocalidadesCRM').data('bootstrapValidator');
			bootstrapValidator_localidades_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_localidades_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_localidades_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_localidades_crm()
		{
			try
			{
				$('#frmLocalidadesCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_localidades_crm()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/localidades/guardar',
					{ 
						intLocalidadID: $('#txtLocalidadID_localidades_crm').val(),
						intMunicipioID: $('#txtMunicipioID_localidades_crm').val(),
						intMunicipioIDAnterior: $('#txtMunicipioIDAnterior_localidades_crm').val(),
						strDescripcion: $('#txtDescripcion_localidades_crm').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_localidades_crm').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_localidades_crm();
							//Hacer un llamado a la función para cerrar modal
							cerrar_localidades_crm();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_localidades_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_localidades_crm(tipoMensaje, mensaje)
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
		function cambiar_estatus_localidades_crm(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtLocalidadID_localidades_crm').val();

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
				              'title':    'Localidades',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_localidades_crm(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_localidades_crm(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_localidades_crm(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('crm/localidades/set_estatus',
			      {intLocalidadID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_localidades_crm();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_localidades_crm();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_localidades_crm(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_localidades_crm(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/localidades/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_localidades_crm();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtLocalidadID_localidades_crm').val(data.row.localidad_id);
				            $('#txtMunicipioID_localidades_crm').val(data.row.municipio_id);
				            $('#txtMunicipioIDAnterior_localidades_crm').val(data.row.municipio_id);
				            $('#txtMunicipio_localidades_crm').val(data.row.municipio);
				            $('#txtDescripcion_localidades_crm').val(data.row.localidad);
				            $('#txtDescripcionAnterior_localidades_crm').val(data.row.localidad);
				            $('#txtEstado_localidades_crm').val(data.row.estado);
				            $('#txtPais_localidades_crm').val(data.row.pais);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_localidades_crm').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_localidades_crm").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmLocalidadesCRM').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_localidades_crm").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_localidades_crm").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objLocalidadesCRM = $('#LocalidadesCRMBox').bPopup({
															  appendTo: '#LocalidadesCRMContent', 
								                              contentContainer: 'LocalidadesCRMM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_localidades_crm').focus();
					        }
			       	    }
			       },
			       'json');
		}


		//Función para regresar y obtener los datos de un municipio
		function get_datos_municipio_localidades_crm()
		{
			//Hacer un llamado al método del controlador para regresar los datos del municipio
             $.post('crm/municipios/get_datos',
                  { 
                  	strBusqueda:$("#txtMunicipioID_localidades_crm").val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtMunicipio_localidades_crm").val(data.row.municipio);
                       $("#txtEstado_localidades_crm").val(data.row.estado);
                       $("#txtPais_localidades_crm").val(data.row.pais);
                    }
                  }
                 ,
                'json');

		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_localidades_crm()
		{
			//Si no existe id, verificar la existencia de la descripción
			if ($('#txtLocalidadID_localidades_crm').val() == '' && $('#txtDescripcion_localidades_crm').val() != '' && $('#txtMunicipioID_localidades_crm').val() != '')
			{
				//Concatenar criterios de búsqueda (para poder verificar la existencia de la descripción en el municipio)
				var strCriteriosBusqLocalidadesCRM = $('#txtMunicipioID_localidades_crm').val()+'|'+$('#txtDescripcion_localidades_crm').val();
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con los criterios de búsqueda  
				editar_localidades_crm(strCriteriosBusqLocalidadesCRM, 'descripcion', 'Nuevo');
			}
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Comprobar la existencia de la descripción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_localidades_crm').focusout(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_localidades_crm();
			});

			//Autocomplete para recuperar los datos de un municipio 
	        $('#txtMunicipio_localidades_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMunicipioID_localidades_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del municipio
	               inicializar_municipio_localidades_crm();
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
	             $('#txtMunicipioID_localidades_crm').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos del municipio
	              get_datos_municipio_localidades_crm();
	              //Hacer un llamado a la función para verificar la existencia del registro
				  verificar_existencia_localidades_crm();
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
	        $('#txtMunicipio_localidades_crm').focusout(function(e){
	            //Si no existe id del municipio
	            if($('#txtMunicipioID_localidades_crm').val() == '' ||  $('#txtMunicipio_localidades_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMunicipioID_localidades_crm').val('');
	               $('#txtMunicipio_localidades_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del municipio
	               inicializar_municipio_localidades_crm();
	            }
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_localidades_crm').on('click','a',function(event){
				event.preventDefault();
				intPaginaLocalidadesCRM = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_localidades_crm();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_localidades_crm').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_localidades_crm();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_localidades_crm').addClass("estatus-NUEVO");
				//Abrir modal
				 objLocalidadesCRM = $('#LocalidadesCRMBox').bPopup({
											   appendTo: '#LocalidadesCRMContent', 
				                               contentContainer: 'LocalidadesCRMM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_localidades_crm').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_localidades_crm').focus();   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_localidades_crm();
		});
	</script>