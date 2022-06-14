	<div id="EstrategiasCRMContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_estrategias_crm" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_estrategias_crm" 
								   name="strBusqueda_estrategias_crm"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_estrategias_crm"
										onclick="paginacion_estrategias_crm();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_estrategias_crm" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_estrategias_crm"
									onclick="reporte_estrategias_crm('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_estrategias_crm"
									onclick="reporte_estrategias_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Módulo"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Estrategia de venta"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_estrategias_crm">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Módulo</th>
							<th class="movil">Estrategia de venta</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_estrategias_crm" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{modulo}}</td>
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_estrategias_crm({{estrategia_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_estrategias_crm({{estrategia_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_estrategias_crm({{estrategia_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_estrategias_crm({{estrategia_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_estrategias_crm"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_estrategias_crm">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="EstrategiasCRMBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_estrategias_crm"  class="ModalBodyTitle">
			<h1>Estrategias de Venta</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEstrategiasCRM" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmEstrategiasCRM"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Módulo-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtEstrategiaID_estrategias_crm" 
										   name="intEstrategiaID_estrategias_crm" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el módulo anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción en el módulo-->
									<input id="txtModuloIDAnterior_estrategias_crm" 
										   name="intModuloIDAnterior_estrategias_crm" type="hidden" value="">
									</input>
									<input id="txtModuloID_estrategias_crm" 
										   name="intModuloID_estrategias_crm" type="hidden" value="">
									</input>
									<label for="txtModuloID_estrategias_crm">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModulo_estrategias_crm" 
											name="strModulo_estrategias_crm" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					    <!--Descripción-->
						<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción en el módulo-->
									<input id="txtDescripcionAnterior_estrategias_crm" name="strDescripcionAnterior_estrategias_crm" type="hidden" value="">
									</input>
									<label for="txtDescripcion_estrategias_crm">Estrategia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_estrategias_crm" 
											name="strDescripcion_estrategias_crm" type="text" value="" 
											tabindex="1" placeholder="Ingrese estrategia" maxlength="50">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_estrategias_crm"  
									onclick="validar_estrategias_crm();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_estrategias_crm"  
									onclick="cambiar_estatus_estrategias_crm('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_estrategias_crm"  
									onclick="cambiar_estatus_estrategias_crm('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_estrategias_crm"
									type="reset" aria-hidden="true" onclick="cerrar_estrategias_crm();" 
									title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#EstrategiasCRMContent -->
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaEstrategiasCRM = 0;
		var strUltimaBusquedaEstrategiasCRM = "";
		//Variable que se utiliza para asignar objeto del modal
		var objEstrategiasCRM = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_estrategias_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/estrategias/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_estrategias_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosEstrategiasCRM = data.row;
					//Separar la cadena 
					var arrPermisosEstrategiasCRM = strPermisosEstrategiasCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosEstrategiasCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosEstrategiasCRM[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_estrategias_crm').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosEstrategiasCRM[i]=='GUARDAR') || (arrPermisosEstrategiasCRM[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_estrategias_crm').removeAttr('disabled');
						}
						else if(arrPermisosEstrategiasCRM[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_estrategias_crm').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_estrategias_crm();
						}
						else if(arrPermisosEstrategiasCRM[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_estrategias_crm').removeAttr('disabled');
							$('#btnRestaurar_estrategias_crm').removeAttr('disabled');
						}
						else if(arrPermisosEstrategiasCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_estrategias_crm').removeAttr('disabled');
						}
						else if(arrPermisosEstrategiasCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_estrategias_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_estrategias_crm() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_estrategias_crm').val() != strUltimaBusquedaEstrategiasCRM)
			{
				intPaginaEstrategiasCRM = 0;
				strUltimaBusquedaEstrategiasCRM = $('#txtBusqueda_estrategias_crm').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('crm/estrategias/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_estrategias_crm').val(),
						intPagina:intPaginaEstrategiasCRM,
						strPermisosAcceso: $('#txtAcciones_estrategias_crm').val()
					},
					function(data){
						$('#dg_estrategias_crm tbody').empty();
						var tmpEstrategiasCRM = Mustache.render($('#plantilla_estrategias_crm').html(),data);
						$('#dg_estrategias_crm tbody').html(tmpEstrategiasCRM);
						$('#pagLinks_estrategias_crm').html(data.paginacion);
						$('#numElementos_estrategias_crm').html(data.total_rows);
						intPaginaEstrategiasCRM = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_estrategias_crm(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/estrategias/';

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
										'strBusqueda': $('#txtBusqueda_estrategias_crm').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_estrategias_crm()
		{
			//Incializar formulario
			$('#frmEstrategiasCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_estrategias_crm();
			//Limpiar cajas de texto ocultas
			$('#frmEstrategiasCRM').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_estrategias_crm');
			//Habilitar todos los elementos del formulario
			$('#frmEstrategiasCRM').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_estrategias_crm").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_estrategias_crm").hide();
			$("#btnRestaurar_estrategias_crm").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_estrategias_crm()
		{
			try {
				//Cerrar modal
				objEstrategiasCRM.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_estrategias_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_estrategias_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_estrategias_crm();
			//Validación del formulario de campos obligatorios
			$('#frmEstrategiasCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_estrategias_crm: {
											validators: {
												notEmpty: {message: 'Escriba una estrategia'}
											}
										},
										strModuloID_estrategias_crm: {
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
										}

									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_estrategias_crm = $('#frmEstrategiasCRM').data('bootstrapValidator');
			bootstrapValidator_estrategias_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_estrategias_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_estrategias_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_estrategias_crm()
		{
			try
			{
				$('#frmEstrategiasCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_estrategias_crm()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/estrategias/guardar',
					{ 
						intEstrategiaID: $('#txtEstrategiaID_estrategias_crm').val(),
						strDescripcion: $('#txtDescripcion_estrategias_crm').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_estrategias_crm').val(),
						intModuloID: $('#txtModuloID_estrategias_crm').val(),
						intModuloAnteriorID: $('#txtModuloIDAnterior_estrategias_crm').val()
					},
					function(data) {										
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_estrategias_crm();
							//Hacer un llamado a la función para cerrar modal
							cerrar_estrategias_crm();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_estrategias_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_estrategias_crm(tipoMensaje, mensaje)
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
		function cambiar_estatus_estrategias_crm(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtEstrategiaID_estrategias_crm').val();

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
				              'title':    'Estrategias de Venta',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_estrategias_crm(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_estrategias_crm(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_estrategias_crm(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('crm/estrategias/set_estatus',
			      {intEstrategiaID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_estrategias_crm();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_estrategias_crm();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_estrategias_crm(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_estrategias_crm(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/estrategias/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_estrategias_crm();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtEstrategiaID_estrategias_crm').val(data.row.estrategia_id);
				            $('#txtDescripcion_estrategias_crm').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_estrategias_crm').val(data.row.descripcion);
				            $('#txtModuloID_estrategias_crm').val(data.row.modulo_id);
						    $('#txtModuloIDAnterior_estrategias_crm').val(data.row.modulo_id);
						    $('#txtModulo_estrategias_crm').val(data.row.modulo);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_estrategias_crm').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_estrategias_crm").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmEstrategiasCRM').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_estrategias_crm").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_estrategias_crm").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objEstrategiasCRM = $('#EstrategiasCRMBox').bPopup({
															  appendTo: '#EstrategiasCRMContent', 
								                              contentContainer: 'EstrategiasCRMM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtModulo_estrategias_crm').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_estrategias_crm()
		{
			//Si no existe id, verificar la existencia de la descripción
			if ($('#txtEstrategiaID_estrategias_crm').val() == '' && $('#txtDescripcion_estrategias_crm').val() != '')
			{
				//Concatenar criterios de búsqueda (para poder verificar la existencia de la descripción en el módulo)
				var strCriteriosBusqEstrategiasCRM = $('#txtModuloID_estrategias_crm').val()+'|'+$('#txtDescripcion_estrategias_crm').val();
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con los criterios de búsqueda  
				editar_estrategias_crm(strCriteriosBusqEstrategiasCRM, 'descripcion', 'Nuevo');
			}
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Comprobar la existencia de la descripción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_estrategias_crm').focusout(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_estrategias_crm();
			});

			//Autocomplete para recuperar los datos de un módulo 
	        $('#txtModulo_estrategias_crm').autocomplete({
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
		            $('#txtModuloID_estrategias_crm').val(ui.item.data);
		            //Hacer un llamado a la función para verificar la existencia del registro
		            verificar_existencia_estrategias_crm();
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
	        $('#txtModulo_estrategias_crm').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModulo_estrategias_crm').val() == '' ||
	               $('#txtModuloID_estrategias_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtModulo_estrategias_crm').val('');
	               $('#txtModuloID_estrategias_crm').val('');
	            }
	            
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_estrategias_crm').on('click','a',function(event){
				event.preventDefault();
				intPaginaEstrategiasCRM = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_estrategias_crm();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_estrategias_crm').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_estrategias_crm();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_estrategias_crm').addClass("estatus-NUEVO");
				//Abrir modal
				 objEstrategiasCRM = $('#EstrategiasCRMBox').bPopup({
											   appendTo: '#EstrategiasCRMContent', 
				                               contentContainer: 'EstrategiasCRMM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtModulo_estrategias_crm').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_estrategias_crm').focus();   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_estrategias_crm();
		});
	</script>