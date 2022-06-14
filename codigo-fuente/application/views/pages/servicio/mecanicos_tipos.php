	<div id="MecanicosTiposServicioContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_mecanicos_tipos_servicio" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_mecanicos_tipos_servicio" 
								   name="strBusqueda_mecanicos_tipos_servicio"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_mecanicos_tipos_servicio"
										onclick="paginacion_mecanicos_tipos_servicio();" 
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
							<button class="btn btn-info" id="btnNuevo_mecanicos_tipos_servicio" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_mecanicos_tipos_servicio"
									onclick="reporte_mecanicos_tipos_servicio('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_mecanicos_tipos_servicio"
									onclick="reporte_mecanicos_tipos_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				<table class="table-hover movil" id="dg_mecanicos_tipos_servicio">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Descripción</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_mecanicos_tipos_servicio" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil">{{codigo}}</td>
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_mecanicos_tipos_servicio({{mecanico_tipo_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_mecanicos_tipos_servicio({{mecanico_tipo_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_mecanicos_tipos_servicio({{mecanico_tipo_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_mecanicos_tipos_servicio({{mecanico_tipo_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_mecanicos_tipos_servicio"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_mecanicos_tipos_servicio">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MecanicosTiposServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_mecanicos_tipos_servicio"  class="ModalBodyTitle">
			<h1>Tipos de Mecánicos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMecanicosTiposServicio" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMecanicosTiposServicio"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Código-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMecanicoTipoID_mecanicos_tipos_servicio" 
										   name="intMecanicoTipoID_mecanicos_tipos_servicio" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
									<input id="txtCodigoAnterior_mecanicos_tipos_servicio" 
										   name="strCodigoAnterior_mecanicos_tipos_servicio" type="hidden" value="">
									</input>
									<label for="txtCodigo_mecanicos_tipos_servicio">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_mecanicos_tipos_servicio" 
											name="strCodigo_mecanicos_tipos_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese código" maxlength="2">
									</input>
								</div>
							</div>
						</div>
						<!--Descripción-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_mecanicos_tipos_servicio">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_mecanicos_tipos_servicio" 
											name="strDescripcion_mecanicos_tipos_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese descripción" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Costo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCosto_mecanicos_tipos_servicio">Costo</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_mecanicos_tipos_servicio" id="txtCosto_mecanicos_tipos_servicio" 
												name="intCosto_mecanicos_tipos_servicio" type="text" value="" 
												tabindex="1" placeholder="Ingrese costo" maxlength="12">
										</input>
										
									</div>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_mecanicos_tipos_servicio"  
									onclick="validar_mecanicos_tipos_servicio();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_mecanicos_tipos_servicio"  
									onclick="cambiar_estatus_mecanicos_tipos_servicio('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_mecanicos_tipos_servicio"  
									onclick="cambiar_estatus_mecanicos_tipos_servicio('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_mecanicos_tipos_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_mecanicos_tipos_servicio();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MecanicosTiposServicioContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMecanicosTiposServicio = 0;
		var strUltimaBusquedaMecanicosTiposServicio = "";
		//Variable que se utiliza para asignar objeto del modal
		var objMecanicosTiposServicio = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_mecanicos_tipos_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/mecanicos_tipos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_mecanicos_tipos_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMecanicosTiposServicio = data.row;
					//Separar la cadena 
					var arrPermisosMecanicosTiposServicio = strPermisosMecanicosTiposServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMecanicosTiposServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMecanicosTiposServicio[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_mecanicos_tipos_servicio').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMecanicosTiposServicio[i]=='GUARDAR') || (arrPermisosMecanicosTiposServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_mecanicos_tipos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosMecanicosTiposServicio[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_mecanicos_tipos_servicio').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_mecanicos_tipos_servicio();
						}
						else if(arrPermisosMecanicosTiposServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_mecanicos_tipos_servicio').removeAttr('disabled');
							$('#btnRestaurar_mecanicos_tipos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosMecanicosTiposServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_mecanicos_tipos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosMecanicosTiposServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_mecanicos_tipos_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_mecanicos_tipos_servicio() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_mecanicos_tipos_servicio').val() != strUltimaBusquedaMecanicosTiposServicio)
			{
				intPaginaMecanicosTiposServicio = 0;
				strUltimaBusquedaMecanicosTiposServicio = $('#txtBusqueda_mecanicos_tipos_servicio').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/mecanicos_tipos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_mecanicos_tipos_servicio').val(),
						intPagina:intPaginaMecanicosTiposServicio,
						strPermisosAcceso: $('#txtAcciones_mecanicos_tipos_servicio').val()
					},
					function(data){
						$('#dg_mecanicos_tipos_servicio tbody').empty();
						var tmpMecanicosTiposServicio = Mustache.render($('#plantilla_mecanicos_tipos_servicio').html(),data);
						$('#dg_mecanicos_tipos_servicio tbody').html(tmpMecanicosTiposServicio);
						$('#pagLinks_mecanicos_tipos_servicio').html(data.paginacion);
						$('#numElementos_mecanicos_tipos_servicio').html(data.total_rows);
						intPaginaMecanicosTiposServicio = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_mecanicos_tipos_servicio(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/mecanicos_tipos/';

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
										'strBusqueda': $('#txtBusqueda_mecanicos_tipos_servicio').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_mecanicos_tipos_servicio()
		{
			//Incializar formulario
			$('#frmMecanicosTiposServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_mecanicos_tipos_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmMecanicosTiposServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_mecanicos_tipos_servicio');
			//Habilitar todos los elementos del formulario
			$('#frmMecanicosTiposServicio').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_mecanicos_tipos_servicio").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_mecanicos_tipos_servicio").hide();
			$("#btnRestaurar_mecanicos_tipos_servicio").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_mecanicos_tipos_servicio()
		{
			try {
				//Cerrar modal
				objMecanicosTiposServicio.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_mecanicos_tipos_servicio').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_mecanicos_tipos_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_mecanicos_tipos_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmMecanicosTiposServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_mecanicos_tipos_servicio: {
											validators: {
												notEmpty: {message: 'Escriba el código para este tipo de mecánico'}
											}
										},
										strDescripcion_mecanicos_tipos_servicio: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										intCosto_mecanicos_tipos_servicio: {
											validators: {
												notEmpty: {message: 'Escriba un costo'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_mecanicos_tipos_servicio = $('#frmMecanicosTiposServicio').data('bootstrapValidator');
			bootstrapValidator_mecanicos_tipos_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_mecanicos_tipos_servicio.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_mecanicos_tipos_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_mecanicos_tipos_servicio()
		{
			try
			{
				$('#frmMecanicosTiposServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_mecanicos_tipos_servicio()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('servicio/mecanicos_tipos/guardar',
					{ 
						intMecanicoTipoID: $('#txtMecanicoTipoID_mecanicos_tipos_servicio').val(),
						strCodigo: $('#txtCodigo_mecanicos_tipos_servicio').val(),
						strCodigoAnterior: $('#txtCodigoAnterior_mecanicos_tipos_servicio').val(),
						strDescripcion: $('#txtDescripcion_mecanicos_tipos_servicio').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intCosto: $.reemplazar($('#txtCosto_mecanicos_tipos_servicio').val(), ",", "")
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_mecanicos_tipos_servicio();
							//Hacer un llamado a la función para cerrar modal
							cerrar_mecanicos_tipos_servicio();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_mecanicos_tipos_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_mecanicos_tipos_servicio(tipoMensaje, mensaje)
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
		function cambiar_estatus_mecanicos_tipos_servicio(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMecanicoTipoID_mecanicos_tipos_servicio').val();

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
						              'title':    'Tipos de Mecánicos',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {

						                            	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_mecanicos_tipos_servicio(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_mecanicos_tipos_servicio(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_mecanicos_tipos_servicio(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('servicio/mecanicos_tipos/set_estatus',
			      {intMecanicoTipoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_mecanicos_tipos_servicio();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_mecanicos_tipos_servicio();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_mecanicos_tipos_servicio(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_mecanicos_tipos_servicio(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/mecanicos_tipos/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_mecanicos_tipos_servicio();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtMecanicoTipoID_mecanicos_tipos_servicio').val(data.row.mecanico_tipo_id);
				            $('#txtCodigo_mecanicos_tipos_servicio').val(data.row.codigo);
				            $('#txtCodigoAnterior_mecanicos_tipos_servicio').val(data.row.codigo);
				            $('#txtDescripcion_mecanicos_tipos_servicio').val(data.row.descripcion);
				            $('#txtCosto_mecanicos_tipos_servicio').val(data.row.costo);
				             //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtCosto_mecanicos_tipos_servicio').formatCurrency({ roundToDecimalPlace: 2 });
				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_mecanicos_tipos_servicio').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_mecanicos_tipos_servicio").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmMecanicosTiposServicio').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_mecanicos_tipos_servicio").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_mecanicos_tipos_servicio").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objMecanicosTiposServicio = $('#MecanicosTiposServicioBox').bPopup({
															  appendTo: '#MecanicosTiposServicioContent', 
								                              contentContainer: 'MecanicosTiposServicioM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCodigo_mecanicos_tipos_servicio').focus();
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
			//Validar campo para introducir solamente letras
			$('#txtCodigo_mecanicos_tipos_servicio').letras();
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtCosto_mecanicos_tipos_servicio').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_mecanicos_tipos_servicio').blur(function(){
				$('.moneda_mecanicos_tipos_servicio').formatCurrency({ roundToDecimalPlace: 2 });
			});
        	
			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo_mecanicos_tipos_servicio').focusout(function(e){
				//Si no existe id, verificar la existencia del código
				if ($('#txtMecanicoTipoID_mecanicos_tipos_servicio').val() == '' && $('#txtCodigo_mecanicos_tipos_servicio').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código 
					editar_mecanicos_tipos_servicio($('#txtCodigo_mecanicos_tipos_servicio').val(), 'codigo', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_mecanicos_tipos_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaMecanicosTiposServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_mecanicos_tipos_servicio();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_mecanicos_tipos_servicio').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_mecanicos_tipos_servicio();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_mecanicos_tipos_servicio').addClass("estatus-NUEVO");
				//Abrir modal
				 objMecanicosTiposServicio = $('#MecanicosTiposServicioBox').bPopup({
											   appendTo: '#MecanicosTiposServicioContent', 
				                               contentContainer: 'MecanicosTiposServicioM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_mecanicos_tipos_servicio').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_mecanicos_tipos_servicio').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_mecanicos_tipos_servicio();
		});
	</script>