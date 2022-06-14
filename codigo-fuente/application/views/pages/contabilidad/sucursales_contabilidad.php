	<div id="SucursalesContabilidadContabilidadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_sucursales_contabilidad_contabilidad" action="#" method="post" tabindex="-5"
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_sucursales_contabilidad_contabilidad" 
								   name="strBusqueda_sucursales_contabilidad_contabilidad"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_sucursales_contabilidad_contabilidad"
										onclick="paginacion_sucursales_contabilidad_contabilidad();" 
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
							<button class="btn btn-info" id="btnNuevo_sucursales_contabilidad_contabilidad" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_sucursales_contabilidad_contabilidad"
									onclick="reporte_sucursales_contabilidad_contabilidad('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_sucursales_contabilidad_contabilidad"
									onclick="reporte_sucursales_contabilidad_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Sucursal"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Cuenta contable"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_sucursales_contabilidad_contabilidad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Sucursal</th>
							<th class="movil">Cuenta contable</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_sucursales_contabilidad_contabilidad" type="text/template"> 
					{{#rows}}
						<tr class="movil">    
							<td class="movil">{{sucursal}}</td>
							<td class="movil">{{cuenta_contable}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_sucursales_contabilidad_contabilidad({{sucursal_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Eliminar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEliminar}}"  
										onclick="eliminar_sucursales_contabilidad_contabilidad({{sucursal_id}})"  title="Eliminar">
									<span class="glyphicon glyphicon-trash"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_sucursales_contabilidad_contabilidad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_sucursales_contabilidad_contabilidad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="SucursalesContabilidadContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_sucursales_contabilidad_contabilidad"  class="ModalBodyTitle">
			<h1>Configuraciones Contables</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmSucursalesContabilidadContabilidad" method="post" action="#" class="form-horizontal" role="form"
					  name="frmSucursalesContabilidadContabilidad"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Cuenta contable-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar la cuenta contable anterior y así evitar duplicidad en caso de que exista otro registro con la misma cuenta-->
									<input id="txtCuentaContableAnterior_sucursales_contabilidad_contabilidad" 
										   name="strCuentaContableAnterior_sucursales_contabilidad_contabilidad" type="hidden" value="">
									</input>
									<label for="txtCuentaContable_sucursales_contabilidad_contabilidad">Cuenta contable</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuentaContable_sucursales_contabilidad_contabilidad" 
											name="strCuentaContable_sucursales_contabilidad_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese cuenta contable" maxlength="2">
									</input>
								</div>
							</div>
						</div>
					   <!--Autocomplete que contiene las sucursales activas-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
									<input id="txtSucursalID_sucursales_contabilidad_contabilidad" 
										   name="intSucursalID_sucursales_contabilidad_contabilidad"  
										   type="hidden" 
										   value="">
									</input>
								    <!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal anterior, de esta manera podremos saber si se trata de un registro existente-->
									<input id="txtSucursalIDAnterior_sucursales_contabilidad_contabilidad" 
										   name="intSucursalIDAnterior_sucursales_contabilidad_contabilidad" type="hidden" value="">
									</input>
									<label for="txtSucursal_sucursales_contabilidad_contabilidad">Sucursal</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSucursal_sucursales_contabilidad_contabilidad" 
											name="strSucursal_sucursales_contabilidad_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese sucursal" maxlength="250" />
								</div>
							</div>
						</div>
					
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_sucursales_contabilidad_contabilidad"  
									onclick="validar_sucursales_contabilidad_contabilidad();"  title="Guardar" 
									tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Eliminar registro-->
							<button class="btn btn-default" id="btnEliminar_sucursales_contabilidad_contabilidad"  
									onclick="eliminar_sucursales_contabilidad_contabilidad('','');"  title="Eliminar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-trash"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_sucursales_contabilidad_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_sucursales_contabilidad_contabilidad();" 
									title="Cerrar"  tabindex="4">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#SucursalesContabilidadContabilidadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaSucursalesContabilidadContabilidad = 0;
		var strUltimaBusquedaSucursalesContabilidadContabilidad = "";
		//Variable que se utiliza para asignar objeto del modal
		var objSucursalesContabilidadContabilidad = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_sucursales_contabilidad_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/sucursales_contabilidad/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_sucursales_contabilidad_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosSucursalesContabilidadContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosSucursalesContabilidadContabilidad = strPermisosSucursalesContabilidadContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosSucursalesContabilidadContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosSucursalesContabilidadContabilidad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_sucursales_contabilidad_contabilidad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosSucursalesContabilidadContabilidad[i]=='GUARDAR') || (arrPermisosSucursalesContabilidadContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_sucursales_contabilidad_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSucursalesContabilidadContabilidad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_sucursales_contabilidad_contabilidad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_sucursales_contabilidad_contabilidad();
						}
						else if(arrPermisosSucursalesContabilidadContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_sucursales_contabilidad_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSucursalesContabilidadContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_sucursales_contabilidad_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSucursalesContabilidadContabilidad[i]=='ELIMINAR')//Si el indice es ELIMINAR
						{
							//Habilitar el control (botón eliminar)
							$('#btnEliminar_sucursales_contabilidad_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_sucursales_contabilidad_contabilidad() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_sucursales_contabilidad_contabilidad').val() != strUltimaBusquedaSucursalesContabilidadContabilidad)
			{
				intPaginaSucursalesContabilidadContabilidad = 0;
				strUltimaBusquedaSucursalesContabilidadContabilidad = $('#txtBusqueda_sucursales_contabilidad_contabilidad').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('contabilidad/sucursales_contabilidad/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_sucursales_contabilidad_contabilidad').val(),
						intPagina:intPaginaSucursalesContabilidadContabilidad,
						strPermisosAcceso: $('#txtAcciones_sucursales_contabilidad_contabilidad').val()
					},
					function(data){
						$('#dg_sucursales_contabilidad_contabilidad tbody').empty();
						var tmpSucursalesContabilidadContabilidad = Mustache.render($('#plantilla_sucursales_contabilidad_contabilidad').html(),data);
						$('#dg_sucursales_contabilidad_contabilidad tbody').html(tmpSucursalesContabilidadContabilidad);
						$('#pagLinks_sucursales_contabilidad_contabilidad').html(data.paginacion);
						$('#numElementos_sucursales_contabilidad_contabilidad').html(data.total_rows);
						intPaginaSucursalesContabilidadContabilidad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_sucursales_contabilidad_contabilidad(strTipo) 
		{
			
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/sucursales_contabilidad/';

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
										'strBusqueda': $('#txtBusqueda_sucursales_contabilidad_contabilidad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_sucursales_contabilidad_contabilidad()
		{
			//Incializar formulario
			$('#frmSucursalesContabilidadContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sucursales_contabilidad_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmSucursalesContabilidadContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_sucursales_contabilidad_contabilidad');
			//Ocultar botón Eliminar
			$("#btnEliminar_sucursales_contabilidad_contabilidad").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_sucursales_contabilidad_contabilidad()
		{
			try {
				//Cerrar modal
				objSucursalesContabilidadContabilidad.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_sucursales_contabilidad_contabilidad').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_sucursales_contabilidad_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sucursales_contabilidad_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmSucursalesContabilidadContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strSucursal_sucursales_contabilidad_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del sucursal
					                                    if($('#txtSucursalID_sucursales_contabilidad_contabilidad').val() === '')
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
										strCuentaContable_sucursales_contabilidad_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba una cuenta contable'},
												stringLength: {
													min: 2,
													message: 'La cuenta contable debe tener 2 caracteres de longitud'
												}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_sucursales_contabilidad_contabilidad = $('#frmSucursalesContabilidadContabilidad').data('bootstrapValidator');
			bootstrapValidator_sucursales_contabilidad_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_sucursales_contabilidad_contabilidad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_sucursales_contabilidad_contabilidad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_sucursales_contabilidad_contabilidad()
		{
			try
			{
				$('#frmSucursalesContabilidadContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_sucursales_contabilidad_contabilidad()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('contabilidad/sucursales_contabilidad/guardar',
					{ 
						intSucursalID: $('#txtSucursalID_sucursales_contabilidad_contabilidad').val(),
						intSucursalIDAnterior: $('#txtSucursalIDAnterior_sucursales_contabilidad_contabilidad').val(),
						strCuentaContable: $('#txtCuentaContable_sucursales_contabilidad_contabilidad').val(),
						strCuentaContableAnterior: $('#txtCuentaContableAnterior_sucursales_contabilidad_contabilidad').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_sucursales_contabilidad_contabilidad();
							//Hacer un llamado a la función para cerrar modal
							cerrar_sucursales_contabilidad_contabilidad();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_sucursales_contabilidad_contabilidad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_sucursales_contabilidad_contabilidad(tipoMensaje, mensaje)
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

		//Función para eliminar los datos del registro seleccionado
		function eliminar_sucursales_contabilidad_contabilidad(id)
		{
			//Variables que se utilizan para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtSucursalID_sucursales_contabilidad_contabilidad').val();

			}
			else
			{
				intID = id;
			}


			//Preguntar al usuario si desea eliminar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea eliminar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Configuraciones Contables',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para eliminar los datos del registro
			                              $.post('contabilidad/sucursales_contabilidad/eliminar',
			                                     {intSucursalID: intID
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
				                                        //Hacer llamado a la función  para cargar  los registros en el grid
				                                        paginacion_sucursales_contabilidad_contabilidad();
			                                          	
			                                          	//Si el id del registro pertenecen al modal
														if(id == '')
														{
															//Hacer un llamado a la función para cerrar modal
															cerrar_sucursales_contabilidad_contabilidad();     
														}
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_sucursales_contabilidad_contabilidad(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}
		

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_sucursales_contabilidad_contabilidad(busqueda, tipoBusqueda, tipoAccion)
		{	

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/sucursales_contabilidad/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_sucursales_contabilidad_contabilidad();
							
				          	//Recuperar valores
				            $('#txtSucursalID_sucursales_contabilidad_contabilidad').val(data.row.sucursal_id);
				            $('#txtSucursalIDAnterior_sucursales_contabilidad_contabilidad').val(data.row.sucursal_id);
				            $('#txtSucursal_sucursales_contabilidad_contabilidad').val(data.row.sucursal);
				            $('#txtCuentaContable_sucursales_contabilidad_contabilidad').val(data.row.cuenta_contable);
				            $('#txtCuentaContableAnterior_sucursales_contabilidad_contabilidad').val(data.row.cuenta_contable);
				            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
				            $('#divEncabezadoModal_sucursales_contabilidad_contabilidad').addClass("estatus-ACTIVO");
				            //Mostrar botón Eliminar
						    $("#btnEliminar_sucursales_contabilidad_contabilidad").show();

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objSucursalesContabilidadContabilidad = $('#SucursalesContabilidadContabilidadBox').bPopup({
															  appendTo: '#SucursalesContabilidadContabilidadContent', 
								                              contentContainer: 'SucursalesContabilidadContabilidadM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCuentaContable_sucursales_contabilidad_contabilidad').focus();
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
			//Comprobar la existencia de la cuenta contable en la BD cuando pierda el enfoque la caja de texto
			$('#txtCuentaContable_sucursales_contabilidad_contabilidad').focusout(function(e){
				//Si no existe id, verificar la existencia del código
				if ($('#txtSucursalIDAnterior_sucursales_contabilidad_contabilidad').val() == '' && $('#txtCuentaContable_sucursales_contabilidad_contabilidad').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la cuenta contable
					editar_sucursales_contabilidad_contabilidad($('#txtCuentaContable_sucursales_contabilidad_contabilidad').val(), 'cuenta_contable', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de una sucursal
	        $('#txtSucursal_sucursales_contabilidad_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSucursalID_sucursales_contabilidad_contabilidad').val('');
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
	             $('#txtSucursalID_sucursales_contabilidad_contabilidad').val(ui.item.data);
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
	        $('#txtSucursal_sucursales_contabilidad_contabilidad').focusout(function(e){
	            //Si no existe id de la sucursal
	            if($('#txtSucursalID_sucursales_contabilidad_contabilidad').val() == '' ||
	               $('#txtSucursal_sucursales_contabilidad_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSucursalID_sucursales_contabilidad_contabilidad').val('');
	               $('#txtSucursal_sucursales_contabilidad_contabilidad').val('');
	            }

	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_sucursales_contabilidad_contabilidad').on('click','a',function(event){
				event.preventDefault();
				intPaginaSucursalesContabilidadContabilidad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_sucursales_contabilidad_contabilidad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_sucursales_contabilidad_contabilidad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_sucursales_contabilidad_contabilidad();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_sucursales_contabilidad_contabilidad').addClass("estatus-NUEVO");
				//Abrir modal
				 objSucursalesContabilidadContabilidad = $('#SucursalesContabilidadContabilidadBox').bPopup({
											   appendTo: '#SucursalesContabilidadContabilidadContent', 
				                               contentContainer: 'SucursalesContabilidadContabilidadM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCuentaContable_sucursales_contabilidad_contabilidad').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_sucursales_contabilidad_contabilidad').focus();    
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_sucursales_contabilidad_contabilidad();
		});
	</script>