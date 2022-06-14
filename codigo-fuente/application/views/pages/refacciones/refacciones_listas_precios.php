	<div id="RefaccionesListasPreciosRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_refacciones_listas_precios_refacciones" action="#" method="post" tabindex="-5"
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_refacciones_listas_precios_refacciones" 
								   name="strBusqueda_refacciones_listas_precios_refacciones"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_refacciones_listas_precios_refacciones"
										onclick="paginacion_refacciones_listas_precios_refacciones();" 
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
							<button class="btn btn-info" id="btnNuevo_refacciones_listas_precios_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_refacciones_listas_precios_refacciones"
									onclick="reporte_refacciones_listas_precios_refacciones('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_refacciones_listas_precios_refacciones"
									onclick="reporte_refacciones_listas_precios_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Lista de precios"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_refacciones_listas_precios_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Lista de precios</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_refacciones_listas_precios_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_refacciones_listas_precios_refacciones({{refacciones_lista_precio_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_refacciones_listas_precios_refacciones({{refacciones_lista_precio_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_refacciones_listas_precios_refacciones({{refacciones_lista_precio_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_refacciones_listas_precios_refacciones({{refacciones_lista_precio_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_refacciones_listas_precios_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_refacciones_listas_precios_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="RefaccionesListasPreciosRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_refacciones_listas_precios_refacciones"  class="ModalBodyTitle">
			<h1>Listas de Precios Venta</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRefaccionesListasPreciosRefacciones" method="post" action="#" class="form-horizontal" role="form"
					  name="frmRefaccionesListasPreciosRefacciones"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtRefaccionesListaPrecioID_refacciones_listas_precios_refacciones" 
										   name="intRefaccionesListaPrecioID_refacciones_listas_precios_refacciones"
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_refacciones_listas_precios_refacciones" 
										   name="strDescripcionAnterior_refacciones_listas_precios_refacciones" type="hidden" value="">
									</input>
									<label for="txtDescripcion_refacciones_listas_precios_refacciones">Lista de precios</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_refacciones_listas_precios_refacciones" 
											name="strDescripcion_refacciones_listas_precios_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese lista de precios" maxlength="50">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_refacciones_listas_precios_refacciones"  
									onclick="validar_refacciones_listas_precios_refacciones();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_refacciones_listas_precios_refacciones"  
									onclick="cambiar_estatus_refacciones_listas_precios_refacciones('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_refacciones_listas_precios_refacciones"  
									onclick="cambiar_estatus_refacciones_listas_precios_refacciones('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_refacciones_listas_precios_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_refacciones_listas_precios_refacciones();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#RefaccionesListasPreciosRefaccionesContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaRefaccionesListasPreciosRefacciones = 0;
		var strUltimaBusquedaRefaccionesListasPreciosRefacciones = "";
		//Variable que se utiliza para asignar objeto del modal
		var objRefaccionesListasPreciosRefacciones = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_refacciones_listas_precios_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/refacciones_listas_precios/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_refacciones_listas_precios_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRefaccionesListasPreciosRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosRefaccionesListasPreciosRefacciones = strPermisosRefaccionesListasPreciosRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRefaccionesListasPreciosRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRefaccionesListasPreciosRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_refacciones_listas_precios_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosRefaccionesListasPreciosRefacciones[i]=='GUARDAR') || (arrPermisosRefaccionesListasPreciosRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_refacciones_listas_precios_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesListasPreciosRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_refacciones_listas_precios_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_refacciones_listas_precios_refacciones();
						}
						else if(arrPermisosRefaccionesListasPreciosRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_refacciones_listas_precios_refacciones').removeAttr('disabled');
							$('#btnRestaurar_refacciones_listas_precios_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesListasPreciosRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_refacciones_listas_precios_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesListasPreciosRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_refacciones_listas_precios_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_refacciones_listas_precios_refacciones() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_refacciones_listas_precios_refacciones').val() != strUltimaBusquedaRefaccionesListasPreciosRefacciones)
			{
				intPaginaRefaccionesListasPreciosRefacciones = 0;
				strUltimaBusquedaRefaccionesListasPreciosRefacciones = $('#txtBusqueda_refacciones_listas_precios_refacciones').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/refacciones_listas_precios/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_refacciones_listas_precios_refacciones').val(),
						intPagina:intPaginaRefaccionesListasPreciosRefacciones,
						strPermisosAcceso: $('#txtAcciones_refacciones_listas_precios_refacciones').val()
					},
					function(data){
						$('#dg_refacciones_listas_precios_refacciones tbody').empty();
						var tmpRefaccionesListasPreciosRefacciones = Mustache.render($('#plantilla_refacciones_listas_precios_refacciones').html(),data);
						$('#dg_refacciones_listas_precios_refacciones tbody').html(tmpRefaccionesListasPreciosRefacciones);
						$('#pagLinks_refacciones_listas_precios_refacciones').html(data.paginacion);
						$('#numElementos_refacciones_listas_precios_refacciones').html(data.total_rows);
						intPaginaRefaccionesListasPreciosRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_refacciones_listas_precios_refacciones(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/refacciones_listas_precios/';

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
										'strBusqueda': $('#txtBusqueda_refacciones_listas_precios_refacciones').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_refacciones_listas_precios_refacciones()
		{
			//Incializar formulario
			$('#frmRefaccionesListasPreciosRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_listas_precios_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmRefaccionesListasPreciosRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_refacciones_listas_precios_refacciones');
			//Habilitar todos los elementos del formulario
			$('#frmRefaccionesListasPreciosRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_refacciones_listas_precios_refacciones").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_refacciones_listas_precios_refacciones").hide();
			$("#btnRestaurar_refacciones_listas_precios_refacciones").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_refacciones_listas_precios_refacciones()
		{
			try {
				//Cerrar modal
				objRefaccionesListasPreciosRefacciones.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_refacciones_listas_precios_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_refacciones_listas_precios_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_listas_precios_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmRefaccionesListasPreciosRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_refacciones_listas_precios_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba una lista de precios'}
											}
										},
										intUtilidad_refacciones_listas_precios_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba un porcentaje'},
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
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_refacciones_listas_precios_refacciones = $('#frmRefaccionesListasPreciosRefacciones').data('bootstrapValidator');
			bootstrapValidator_refacciones_listas_precios_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_refacciones_listas_precios_refacciones.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_refacciones_listas_precios_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_refacciones_listas_precios_refacciones()
		{
			try
			{
				$('#frmRefaccionesListasPreciosRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_refacciones_listas_precios_refacciones()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/refacciones_listas_precios/guardar',
					{ 
						intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioID_refacciones_listas_precios_refacciones').val(),
						strDescripcion: $('#txtDescripcion_refacciones_listas_precios_refacciones').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_refacciones_listas_precios_refacciones').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_refacciones_listas_precios_refacciones();
							//Hacer un llamado a la función para cerrar modal
							cerrar_refacciones_listas_precios_refacciones();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_refacciones_listas_precios_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_refacciones_listas_precios_refacciones(tipoMensaje, mensaje)
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
		function cambiar_estatus_refacciones_listas_precios_refacciones(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtRefaccionesListaPrecioID_refacciones_listas_precios_refacciones').val();

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
						              'title':    'Listas de Precios Venta',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado a la función para modificar el estatus del registro
													  set_estatus_refacciones_listas_precios_refacciones(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_refacciones_listas_precios_refacciones(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_refacciones_listas_precios_refacciones(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('refacciones/refacciones_listas_precios/set_estatus',
			      {intRefaccionesListaPrecioID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_refacciones_listas_precios_refacciones();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_refacciones_listas_precios_refacciones();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_refacciones_listas_precios_refacciones(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_refacciones_listas_precios_refacciones(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones_listas_precios/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_refacciones_listas_precios_refacciones();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtRefaccionesListaPrecioID_refacciones_listas_precios_refacciones').val(data.row.refacciones_lista_precio_id);
				            $('#txtDescripcion_refacciones_listas_precios_refacciones').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_refacciones_listas_precios_refacciones').val(data.row.descripcion);
				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_refacciones_listas_precios_refacciones').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_refacciones_listas_precios_refacciones").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmRefaccionesListasPreciosRefacciones').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_refacciones_listas_precios_refacciones").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_refacciones_listas_precios_refacciones").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objRefaccionesListasPreciosRefacciones = $('#RefaccionesListasPreciosRefaccionesBox').bPopup({
															  appendTo: '#RefaccionesListasPreciosRefaccionesContent', 
								                              contentContainer: 'RefaccionesListasPreciosRefaccionesM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_refacciones_listas_precios_refacciones').focus();
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
			//Comprobar la existencia de la descripción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_refacciones_listas_precios_refacciones').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtRefaccionesListaPrecioID_refacciones_listas_precios_refacciones').val() == '' && $('#txtDescripcion_refacciones_listas_precios_refacciones').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_refacciones_listas_precios_refacciones($('#txtDescripcion_refacciones_listas_precios_refacciones').val(), 'descripcion', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_refacciones_listas_precios_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaRefaccionesListasPreciosRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_refacciones_listas_precios_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_refacciones_listas_precios_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_refacciones_listas_precios_refacciones();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_refacciones_listas_precios_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				 objRefaccionesListasPreciosRefacciones = $('#RefaccionesListasPreciosRefaccionesBox').bPopup({
											   appendTo: '#RefaccionesListasPreciosRefaccionesContent', 
				                               contentContainer: 'RefaccionesListasPreciosRefaccionesM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_refacciones_listas_precios_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_refacciones_listas_precios_refacciones').focus();    
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_refacciones_listas_precios_refacciones();
		});
	</script>