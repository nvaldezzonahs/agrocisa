<div id="DocumentosPagosCuentasCobrarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_documentos_pagos_cuentas_cobrar" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_documentos_pagos_cuentas_cobrar" 
								   name="strBusqueda_documentos_pagos_cuentas_cobrar"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_documentos_pagos_cuentas_cobrar"
										onclick="paginacion_documentos_pagos_cuentas_cobrar();" 
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
							<button class="btn btn-info" id="btnNuevo_documentos_pagos_cuentas_cobrar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_documentos_pagos_cuentas_cobrar"
									onclick="reporte_documentos_pagos_cuentas_cobrar();" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_documentos_pagos_cuentas_cobrar"
									onclick="descargar_xls_documentos_pagos_cuentas_cobrar();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Documento"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Genera pagare"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_documentos_pagos_cuentas_cobrar">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Documento</th>
							<th class="movil">Genera pagare</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_documentos_pagos_cuentas_cobrar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{genera_pagare}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_documentos_pagos_cuentas_cobrar({{documento_pago_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_documentos_pagos_cuentas_cobrar({{documento_pago_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_documentos_pagos_cuentas_cobrar({{documento_pago_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_documentos_pagos_cuentas_cobrar({{documento_pago_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_documentos_pagos_cuentas_cobrar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_documentos_pagos_cuentas_cobrar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal -->
		<div id="DocumentosClientesCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_documentos_pagos_cuentas_cobrar"  class="ModalBodyTitle">
			<h1>Documentos por pagar</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmDocumentosPagosCuentasCobrar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmDocumentosPagosCuentasCobrar"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtDocumentoClienteID_documentos_pagos_cuentas_cobrar" 
										   name="intDocumentos_pagosID_documentos_pagos_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_documentos_pagos_cuentas_cobrar" 
										   name="strDescripcionAnterior_documentos_pagos_cuentas_cobrar" 
										   type="hidden" value="" />
									<label for="txtDescripcion_documentos_pagos_cuentas_cobrar">Documento</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_documentos_pagos_cuentas_cobrar" 
											name="strDescripcion_documentos_pagos_cuentas_cobrar" 
											type="text" value=""  tabindex="1" placeholder="Ingrese documento" 
											maxlength="250" />
								</div>
							</div>
						</div>
						<!--A quien solicitar este documento-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div  class="col-md-12">
									<label for="cmbGenera_pagare_pagos_cuentas_cobrar">Genera pagare</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbGenera_pagare_pagos_cuentas_cobrar" name="strGenera_pagare_pagos_cuentas_cobrar" tabindex="1">
										<option value="">Seleccione una opción</option>
									 	<option value="SI">SI</option>
									 	<option value="NO">NO</option>            			
                     				</select>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_documentos_pagos_cuentas_cobrar"  
									onclick="validar_documentos_pagos_cuentas_cobrar();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_documentos_pagos_cuentas_cobrar"  
									onclick="cambiar_estatus_documentos_pagos_cuentas_cobrar('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_documentos_pagos_cuentas_cobrar"  
									onclick="cambiar_estatus_documentos_pagos_cuentas_cobrar('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_documentos_pagos_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_documentos_pagos_cuentas_cobrar();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal -->
	</div><!--#DocumentosPagosCuentasCobrarContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaDocumentosClientesCuentasCobrar = 0;
		var strUltimaBusquedaDocumentosClientesCuentasCobrar = "";
		//Variable que se utiliza para asignar objeto del modal
		var objDocumentosClientesCuentasCobrar = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_documentos_pagos_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_cobrar/documentos_pagos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_documentos_pagos_cuentas_cobrar').val()
			},
			function(data){				
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosDocumentosClientesCuentasCobrar = data.row;
					//Separar la cadena 
					var arrPermisosDocumentosClientesCuentasCobrar = strPermisosDocumentosClientesCuentasCobrar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosDocumentosClientesCuentasCobrar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosDocumentosClientesCuentasCobrar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_documentos_pagos_cuentas_cobrar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosDocumentosClientesCuentasCobrar[i]=='GUARDAR') || (arrPermisosDocumentosClientesCuentasCobrar[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_documentos_pagos_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosDocumentosClientesCuentasCobrar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_documentos_pagos_cuentas_cobrar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_documentos_pagos_cuentas_cobrar();
						}
						else if(arrPermisosDocumentosClientesCuentasCobrar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_documentos_pagos_cuentas_cobrar').removeAttr('disabled');
							$('#btnRestaurar_documentos_pagos_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosDocumentosClientesCuentasCobrar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_documentos_pagos_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosDocumentosClientesCuentasCobrar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_documentos_pagos_cuentas_cobrar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_documentos_pagos_cuentas_cobrar() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_documentos_pagos_cuentas_cobrar').val() != strUltimaBusquedaDocumentosClientesCuentasCobrar)
			{
				intPaginaDocumentosClientesCuentasCobrar = 0;
				strUltimaBusquedaDocumentosClientesCuentasCobrar = $('#txtBusqueda_documentos_pagos_cuentas_cobrar').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/documentos_pagos/get_paginacion',
					{	
						strBusqueda:$('#txtBusqueda_documentos_pagos_cuentas_cobrar').val(),
						intPagina:intPaginaDocumentosClientesCuentasCobrar,
						strPermisosAcceso: $('#txtAcciones_documentos_pagos_cuentas_cobrar').val()
					},
					function(data){
						$('#dg_documentos_pagos_cuentas_cobrar tbody').empty();
						var tmpDocumentosClientesCuentasCobrar = Mustache.render($('#plantilla_documentos_pagos_cuentas_cobrar').html(),data);
						$('#dg_documentos_pagos_cuentas_cobrar tbody').html(tmpDocumentosClientesCuentasCobrar);
						$('#pagLinks_documentos_pagos_cuentas_cobrar').html(data.paginacion);
						$('#numElementos_documentos_pagos_cuentas_cobrar').html(data.total_rows);
						intPaginaDocumentosClientesCuentasCobrar = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_documentos_pagos_cuentas_cobrar() 
		{
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("cuentas_cobrar/documentos_pagos/get_reporte/"+$('#txtBusqueda_documentos_pagos_cuentas_cobrar').val());
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_documentos_pagos_cuentas_cobrar() 
		{
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("cuentas_cobrar/documentos_pagos/get_xls/"+$('#txtBusqueda_documentos_pagos_cuentas_cobrar').val());
		}

		/*******************************************************************************************************************
		Funciones del modal 
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_documentos_pagos_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmDocumentosPagosCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_documentos_pagos_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmDocumentosPagosCuentasCobrar').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_documentos_pagos_cuentas_cobrar').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_documentos_pagos_cuentas_cobrar').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_documentos_pagos_cuentas_cobrar').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmDocumentosPagosCuentasCobrar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_documentos_pagos_cuentas_cobrar").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_documentos_pagos_cuentas_cobrar").hide();
			$("#btnRestaurar_documentos_pagos_cuentas_cobrar").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_documentos_pagos_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objDocumentosClientesCuentasCobrar.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_documentos_pagos_cuentas_cobrar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_documentos_pagos_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_documentos_pagos_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmDocumentosPagosCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_documentos_pagos_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba un documento'}
											}
										},
										strGenera_pagare_pagos_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Seleccione si genera o no pagare '}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_documentos_pagos_cuentas_cobrar = $('#frmDocumentosPagosCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_documentos_pagos_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_documentos_pagos_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_documentos_pagos_cuentas_cobrar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_documentos_pagos_cuentas_cobrar()
		{
			try
			{
				$('#frmDocumentosPagosCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_documentos_pagos_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_cobrar/documentos_pagos/guardar',
					{ 
						intDocumentoPagoID: $('#txtDocumentoClienteID_documentos_pagos_cuentas_cobrar').val(),
						strDescripcion: $('#txtDescripcion_documentos_pagos_cuentas_cobrar').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_documentos_pagos_cuentas_cobrar').val(),
						strGeneraPagare: $('#cmbGenera_pagare_pagos_cuentas_cobrar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_documentos_pagos_cuentas_cobrar();
							//Hacer un llamado a la función para cerrar modal
							cerrar_documentos_pagos_cuentas_cobrar();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_documentos_pagos_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_documentos_pagos_cuentas_cobrar(tipoMensaje, mensaje)
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
		function cambiar_estatus_documentos_pagos_cuentas_cobrar(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtDocumentoClienteID_documentos_pagos_cuentas_cobrar').val();

			}
			else
			{
				intID = id;
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
				             {'type':     'question',
				              'title':    'Documentos ',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('cuentas_cobrar/documentos_pagos/set_estatus',
				                                     {intDocumentos_pagosID: intID,
				                                      strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                          	//Hacer llamado a la función  para cargar  los registros en el grid
				                                          	paginacion_documentos_pagos_cuentas_cobrar();

				                                          	//Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_documentos_pagos_cuentas_cobrar();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_documentos_pagos_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('cuentas_cobrar/documentos_pagos/set_estatus',
				     {intDocumentos_pagosID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_documentos_pagos_cuentas_cobrar();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_documentos_pagos_cuentas_cobrar();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_documentos_pagos_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_documentos_pagos_cuentas_cobrar(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/documentos_pagos/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_documentos_pagos_cuentas_cobrar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtDocumentoClienteID_documentos_pagos_cuentas_cobrar').val(data.row.documento_pago_id);
				            $('#txtDescripcion_documentos_pagos_cuentas_cobrar').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_documentos_pagos_cuentas_cobrar').val(data.row.descripcion);
				            $('#cmbGenera_pagare_pagos_cuentas_cobrar').val(data.row.genera_pagare);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_documentos_pagos_cuentas_cobrar').addClass("estatus-"+strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_documentos_pagos_cuentas_cobrar").show();
							}
							else 
							{	
								//Si el tipo de acción corresponde a Ver
								if(tipoAccion == 'Ver')
								{
									//Deshabilitar todos los elementos del formulario
				            		$('#frmDocumentosPagosCuentasCobrar').find('input, textarea, select').attr('disabled','disabled');
				            		//Ocultar botón Guardar
					           		$("#btnGuardar_documentos_pagos_cuentas_cobrar").hide(); 
								}
								
								//Mostrar botón Restaurar
								$("#btnRestaurar_documentos_pagos_cuentas_cobrar").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objDocumentosClientesCuentasCobrar = $('#DocumentosClientesCuentasCobrarBox').bPopup({
															  appendTo: '#DocumentosPagosCuentasCobrarContent', 
								                              contentContainer: 'DocumentosClientesCuentasCobrarM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_documentos_pagos_cuentas_cobrar').focus();
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
			$('#txtDescripcion_documentos_pagos_cuentas_cobrar').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtDocumentoClienteID_documentos_pagos_cuentas_cobrar').val() == '' && 
					$('#txtDescripcion_documentos_pagos_cuentas_cobrar').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_documentos_pagos_cuentas_cobrar($('#txtDescripcion_documentos_pagos_cuentas_cobrar').val(), 'descripcion', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_documentos_pagos_cuentas_cobrar').on('click','a',function(event){
				event.preventDefault();
				intPaginaDocumentosClientesCuentasCobrar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_documentos_pagos_cuentas_cobrar();
			});

			//Abrir modal  cuando se de clic en el botón
			$('#btnNuevo_documentos_pagos_cuentas_cobrar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_documentos_pagos_cuentas_cobrar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_documentos_pagos_cuentas_cobrar').addClass("estatus-NUEVO");
				//Abrir modal
				 objDocumentosClientesCuentasCobrar = $('#DocumentosClientesCuentasCobrarBox').bPopup({
											   appendTo: '#DocumentosPagosCuentasCobrarContent', 
				                               contentContainer: 'DocumentosClientesCuentasCobrarM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_documentos_pagos_cuentas_cobrar').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_documentos_pagos_cuentas_cobrar').focus();
 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_documentos_pagos_cuentas_cobrar();
		});
	</script>