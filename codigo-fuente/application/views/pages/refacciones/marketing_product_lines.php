	<div id="MarketingProductLinesRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_marketing_product_lines_refacciones" action="#" method="post" tabindex="-5"
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_marketing_product_lines_refacciones" 
								   name="strBusqueda_marketing_product_lines_refacciones"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_marketing_product_lines_refacciones"
										onclick="paginacion_marketing_product_lines_refacciones();" 
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
							<button class="btn btn-info" id="btnNuevo_marketing_product_lines_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_marketing_product_lines_refacciones"
									onclick="reporte_marketing_product_lines_refacciones('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_marketing_product_lines_refacciones"
									onclick="reporte_marketing_product_lines_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_marketing_product_lines_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Descripción</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_marketing_product_lines_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{codigo}}</td>
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_marketing_product_lines_refacciones({{mpl_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_marketing_product_lines_refacciones({{mpl_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_marketing_product_lines_refacciones({{mpl_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_marketing_product_lines_refacciones({{mpl_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_marketing_product_lines_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_marketing_product_lines_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MarketingProductLinesRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_marketing_product_lines_refacciones"  class="ModalBodyTitle">
			<h1>Marketing Product Line</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMarketingProductLinesRefacciones" method="post" action="#" class="form-horizontal" role="form"
					  name="frmMarketingProductLinesRefacciones"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Código-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMplID_marketing_product_lines_refacciones" 
										   name="intMplID_marketing_product_lines_refacciones" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
									<input id="txtCodigoAnterior_marketing_product_lines_refacciones" 
										   name="strCodigoAnterior_marketing_product_lines_refacciones" type="hidden" value="">
									</input>
									<label for="txtCodigo_marketing_product_lines_refacciones">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_marketing_product_lines_refacciones" 
											name="strCodigo_marketing_product_lines_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese código" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Descripción-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_marketing_product_lines_refacciones">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_marketing_product_lines_refacciones" 
											name="strDescripcion_marketing_product_lines_refacciones" type="text" value=""
											tabindex="1" placeholder="Ingrese descripción" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene las MCD (Descripciones de Código de Marketing) activas-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMcd_marketing_product_lines_refacciones">MCD</label>
								</div>
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la MCD seleccionada-->
									<input id="txtMcdID_marketing_product_lines_refacciones" 
										   name="intMcdID_marketing_product_lines_refacciones"  
										   type="hidden" value="">
								    </input>
									<input  class="form-control" id="txtMcd_marketing_product_lines_refacciones" 
											name="strMcd_marketing_product_lines_refacciones" type="text" 
											value="" tabindex="1" placeholder="Ingrese MCD" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_marketing_product_lines_refacciones"  
									onclick="validar_marketing_product_lines_refacciones();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_marketing_product_lines_refacciones"  
									onclick="cambiar_estatus_marketing_product_lines_refacciones('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_marketing_product_lines_refacciones"  
									onclick="cambiar_estatus_marketing_product_lines_refacciones('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_marketing_product_lines_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_marketing_product_lines_refacciones();" title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MarketingProductLinesRefaccionesContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMarketingProductLinesRefacciones = 0;
		var strUltimaBusquedaMarketingProductLinesRefacciones = "";
		//Variable que se utiliza para asignar objeto del modal
		var objMarketingProductLinesRefacciones = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_marketing_product_lines_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/marketing_product_lines/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_marketing_product_lines_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMarketingProductLinesRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosMarketingProductLinesRefacciones = strPermisosMarketingProductLinesRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMarketingProductLinesRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMarketingProductLinesRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_marketing_product_lines_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMarketingProductLinesRefacciones[i]=='GUARDAR') || (arrPermisosMarketingProductLinesRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_marketing_product_lines_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMarketingProductLinesRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_marketing_product_lines_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_marketing_product_lines_refacciones();
						}
						else if(arrPermisosMarketingProductLinesRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_marketing_product_lines_refacciones').removeAttr('disabled');
							$('#btnRestaurar_marketing_product_lines_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMarketingProductLinesRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_marketing_product_lines_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMarketingProductLinesRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_marketing_product_lines_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_marketing_product_lines_refacciones() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_marketing_product_lines_refacciones').val() != strUltimaBusquedaMarketingProductLinesRefacciones)
			{
				intPaginaMarketingProductLinesRefacciones = 0;
				strUltimaBusquedaMarketingProductLinesRefacciones = $('#txtBusqueda_marketing_product_lines_refacciones').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/marketing_product_lines/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_marketing_product_lines_refacciones').val(),
						intPagina:intPaginaMarketingProductLinesRefacciones,
						strPermisosAcceso: $('#txtAcciones_marketing_product_lines_refacciones').val()
					},
					function(data){
						$('#dg_marketing_product_lines_refacciones tbody').empty();
						var tmpMarketingProductLinesRefacciones = Mustache.render($('#plantilla_marketing_product_lines_refacciones').html(),data);
						$('#dg_marketing_product_lines_refacciones tbody').html(tmpMarketingProductLinesRefacciones);
						$('#pagLinks_marketing_product_lines_refacciones').html(data.paginacion);
						$('#numElementos_marketing_product_lines_refacciones').html(data.total_rows);
						intPaginaMarketingProductLinesRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_marketing_product_lines_refacciones(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/marketing_product_lines/';

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
										'strBusqueda': $('#txtBusqueda_marketing_product_lines_refacciones').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_marketing_product_lines_refacciones()
		{
			//Incializar formulario
			$('#frmMarketingProductLinesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_marketing_product_lines_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmMarketingProductLinesRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_marketing_product_lines_refacciones');
			//Habilitar todos los elementos del formulario
			$('#frmMarketingProductLinesRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_marketing_product_lines_refacciones").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_marketing_product_lines_refacciones").hide();
			$("#btnRestaurar_marketing_product_lines_refacciones").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_marketing_product_lines_refacciones()
		{
			try {
				//Cerrar modal
				objMarketingProductLinesRefacciones.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_marketing_product_lines_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_marketing_product_lines_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_marketing_product_lines_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmMarketingProductLinesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_marketing_product_lines_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba el código para esta MPL'},
											}
										},
										strDescripcion_marketing_product_lines_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										strMcd_marketing_product_lines_refacciones: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la MCD
					                                    if($('#txtMcdID_marketing_product_lines_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una MCD existente'
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
			var bootstrapValidator_marketing_product_lines_refacciones = $('#frmMarketingProductLinesRefacciones').data('bootstrapValidator');
			bootstrapValidator_marketing_product_lines_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_marketing_product_lines_refacciones.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_marketing_product_lines_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_marketing_product_lines_refacciones()
		{
			try
			{
				$('#frmMarketingProductLinesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_marketing_product_lines_refacciones()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/marketing_product_lines/guardar',
					{ 
						intMplID: $('#txtMplID_marketing_product_lines_refacciones').val(),
						intMcdID: $('#txtMcdID_marketing_product_lines_refacciones').val(),
						strCodigo: $('#txtCodigo_marketing_product_lines_refacciones').val(),
						strCodigoAnterior: $('#txtCodigoAnterior_marketing_product_lines_refacciones').val(),
						strDescripcion: $('#txtDescripcion_marketing_product_lines_refacciones').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_marketing_product_lines_refacciones();
							//Hacer un llamado a la función para cerrar modal
							cerrar_marketing_product_lines_refacciones();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_marketing_product_lines_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_marketing_product_lines_refacciones(tipoMensaje, mensaje)
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
		function cambiar_estatus_marketing_product_lines_refacciones(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMplID_marketing_product_lines_refacciones').val();

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
						              'title':    'Marketing Product Line',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado a la función para modificar el estatus del registro
													  set_estatus_marketing_product_lines_refacciones(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_marketing_product_lines_refacciones(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_marketing_product_lines_refacciones(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('refacciones/marketing_product_lines/set_estatus',
			      {intMplID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_marketing_product_lines_refacciones();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_marketing_product_lines_refacciones();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_marketing_product_lines_refacciones(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_marketing_product_lines_refacciones(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/marketing_product_lines/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_marketing_product_lines_refacciones();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtMplID_marketing_product_lines_refacciones').val(data.row.mpl_id);
				            $('#txtCodigo_marketing_product_lines_refacciones').val(data.row.codigo);
				            $('#txtCodigoAnterior_marketing_product_lines_refacciones').val(data.row.codigo);
				            $('#txtDescripcion_marketing_product_lines_refacciones').val(data.row.descripcion);
				            $('#txtMcdID_marketing_product_lines_refacciones').val(data.row.mcd_id);
				            $('#txtMcd_marketing_product_lines_refacciones').val(data.row.marketing_code_description);
				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_marketing_product_lines_refacciones').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_marketing_product_lines_refacciones").show();
							}
							else 
							{	
							
								//Deshabilitar todos los elementos del formulario
			            		$('#frmMarketingProductLinesRefacciones').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_marketing_product_lines_refacciones").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_marketing_product_lines_refacciones").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objMarketingProductLinesRefacciones = $('#MarketingProductLinesRefaccionesBox').bPopup({
															  appendTo: '#MarketingProductLinesRefaccionesContent', 
								                              contentContainer: 'MarketingProductLinesRefaccionesM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCodigo_marketing_product_lines_refacciones').focus();
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
			//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtCodigo_marketing_product_lines_refacciones').numeric({decimal: false, negative: false});
        	
			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo_marketing_product_lines_refacciones').focusout(function(e){
				//Si no existe id, verificar la existencia del código
				if ($('#txtMplID_marketing_product_lines_refacciones').val() == '' && $('#txtCodigo_marketing_product_lines_refacciones').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código 
					editar_marketing_product_lines_refacciones($('#txtCodigo_marketing_product_lines_refacciones').val(), 'codigo', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de una MCD (Descripción de Código de Marketing)
	        $('#txtMcd_marketing_product_lines_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtMcdID_marketing_product_lines_refacciones').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/marketing_code_descriptions/autocomplete",
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
	               $('#txtMcdID_marketing_product_lines_refacciones').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la MCD cuando pierda el enfoque la caja de texto
	        $('#txtMcd_marketing_product_lines_refacciones').focusout(function(e){
	            //Si no existe id de la MCD
	            if($('#txtMcdID_marketing_product_lines_refacciones').val() == '' ||
	               $('#txtMcd_marketing_product_lines_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMcdID_marketing_product_lines_refacciones').val('');
	               $('#txtMcd_marketing_product_lines_refacciones').val('');
	            }

	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_marketing_product_lines_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaMarketingProductLinesRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_marketing_product_lines_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_marketing_product_lines_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_marketing_product_lines_refacciones();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_marketing_product_lines_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				 objMarketingProductLinesRefacciones = $('#MarketingProductLinesRefaccionesBox').bPopup({
											   appendTo: '#MarketingProductLinesRefaccionesContent', 
				                               contentContainer: 'MarketingProductLinesRefaccionesM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_marketing_product_lines_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_marketing_product_lines_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_marketing_product_lines_refacciones();
		});
	</script>