	<div id="ModulosCRMContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_modulos_crm" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_modulos_crm" 
								   name="strBusqueda_modulos_crm"  type="text" value="" tabindex="1" 
								   placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_modulos_crm"
										onclick="paginacion_modulos_crm();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_modulos_crm" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_modulos_crm"
									onclick="reporte_modulos_crm('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_modulos_crm"
									onclick="reporte_modulos_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(2):before {content: "Tipo de factura"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_modulos_crm">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Módulo</th>
							<th class="movil">Tipo de factura</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_modulos_crm" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{factura}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_modulos_crm({{modulo_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_modulos_crm({{modulo_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_modulos_crm({{modulo_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_modulos_crm({{modulo_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_modulos_crm"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_modulos_crm">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ModulosCRMBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_modulos_crm"  class="ModalBodyTitle">
			<h1>Módulos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmModulosCRM" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmModulosCRM" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtModuloID_modulos_crm" name="intModuloID_modulos_crm"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_modulos_crm" 
										   name="strDescripcionAnterior_modulos_crm" type="hidden" value="">
									</input>
									<label for="txtDescripcion_modulos_crm">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_modulos_crm" 
											name="strDescripcion_modulos_crm" type="text" value="" 
											tabindex="1" placeholder="Ingrese módulo" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--factura-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbFactura_modulos_crm">Tipo de factura</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select id="cmbFactura_modulos_crm" 
											name="strFactura_modulos_crm" 
											class="form-control" tabindex="1" >
									    <option value="">Seleccione una opción</option>
										<option value="MAQUINARIA">MAQUINARIA</option>
										<option value="REFACCIONES">REFACCIONES</option>
										<option value="SERVICIO">SERVICIO</option>
									</select>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_modulos_crm"  
									onclick="validar_modulos_crm();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_modulos_crm"  
									onclick="cambiar_estatus_modulos_crm('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_modulos_crm"  
									onclick="cambiar_estatus_modulos_crm('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_modulos_crm"
									type="reset" aria-hidden="true" onclick="cerrar_modulos_crm();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ModulosCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaModulosCRM = 0;
		var strUltimaBusquedaModulosCRM = "";
		//Variable que se utiliza para asignar objeto del modal
		var objModulosCRM = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_modulos_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/modulos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_modulos_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosModulosCRM = data.row;
					//Separar la cadena 
					var arrPermisosModulosCRM = strPermisosModulosCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosModulosCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosModulosCRM[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_modulos_crm').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosModulosCRM[i]=='GUARDAR') || (arrPermisosModulosCRM[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_modulos_crm').removeAttr('disabled');
						}
						else if(arrPermisosModulosCRM[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_modulos_crm').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_modulos_crm();
						}
						else if(arrPermisosModulosCRM[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_modulos_crm').removeAttr('disabled');
							$('#btnRestaurar_modulos_crm').removeAttr('disabled');
						}
						else if(arrPermisosModulosCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_modulos_crm').removeAttr('disabled');
						}
						else if(arrPermisosModulosCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_modulos_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_modulos_crm() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_modulos_crm').val() != strUltimaBusquedaModulosCRM)
			{
				intPaginaModulosCRM = 0;
				strUltimaBusquedaModulosCRM = $('#txtBusqueda_modulos_crm').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('crm/modulos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_modulos_crm').val(),
						intPagina:intPaginaModulosCRM,
						strPermisosAcceso: $('#txtAcciones_modulos_crm').val()
					},
					function(data){
						$('#dg_modulos_crm tbody').empty();
						var tmpModulosCRM = Mustache.render($('#plantilla_modulos_crm').html(),data);
						$('#dg_modulos_crm tbody').html(tmpModulosCRM);
						$('#pagLinks_modulos_crm').html(data.paginacion);
						$('#numElementos_modulos_crm').html(data.total_rows);
						intPaginaModulosCRM = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_modulos_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/modulos/';

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
										'strBusqueda': $('#txtBusqueda_modulos_crm').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_modulos_crm()
		{
			//Incializar formulario
			$('#frmModulosCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_modulos_crm();
			//Limpiar cajas de texto ocultas
			$('#frmModulosCRM').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_modulos_crm');
			//Habilitar todos los elementos del formulario
			$('#frmModulosCRM').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_modulos_crm").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_modulos_crm").hide();
			$("#btnRestaurar_modulos_crm").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_modulos_crm()
		{
			try {
				//Cerrar modal
				objModulosCRM.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_modulos_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_modulos_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_modulos_crm();
			//Validación del formulario de campos obligatorios
			$('#frmModulosCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_modulos_crm: {
											validators: {
												notEmpty: {message: 'Escriba un módulo'}
											}
										},
										strFactura_modulos_crm: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo de factura'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_modulos_crm = $('#frmModulosCRM').data('bootstrapValidator');
			bootstrapValidator_modulos_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_modulos_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_modulos_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_modulos_crm()
		{
			try
			{
				$('#frmModulosCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_modulos_crm()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/modulos/guardar',
					{ 
						intModuloID: $('#txtModuloID_modulos_crm').val(),
						strDescripcion: $('#txtDescripcion_modulos_crm').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_modulos_crm').val(),
						strTipoFactura: $('#cmbFactura_modulos_crm').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_modulos_crm();
							//Hacer un llamado a la función para cerrar modal
							cerrar_modulos_crm();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_modulos_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_modulos_crm(tipoMensaje, mensaje)
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
		function cambiar_estatus_modulos_crm(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtModuloID_modulos_crm').val();

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
				              'title':    'Módulos',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_modulos_crm(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_modulos_crm(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_modulos_crm(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('crm/modulos/set_estatus',
			      {intModuloID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_modulos_crm();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_modulos_crm();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_modulos_crm(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_modulos_crm(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/modulos/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_modulos_crm();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtModuloID_modulos_crm').val(data.row.modulo_id);
				            $('#txtDescripcion_modulos_crm').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_modulos_crm').val(data.row.descripcion);
				            $('#cmbFactura_modulos_crm').val(data.row.factura);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_modulos_crm').addClass("estatus-"+strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_modulos_crm").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmModulosCRM').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_modulos_crm").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_modulos_crm").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objModulosCRM = $('#ModulosCRMBox').bPopup({
															  appendTo: '#ModulosCRMContent', 
								                              contentContainer: 'ModulosCRMM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_modulos_crm').focus();
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
			$('#txtDescripcion_modulos_crm').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtModuloID_modulos_crm').val() == '' && $('#txtDescripcion_modulos_crm').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_modulos_crm($('#txtDescripcion_modulos_crm').val(), 'descripcion', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_modulos_crm').on('click','a',function(event){
				event.preventDefault();
				intPaginaModulosCRM = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_modulos_crm();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_modulos_crm').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_modulos_crm();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_modulos_crm').addClass("estatus-NUEVO");
				//Abrir modal
				 objModulosCRM = $('#ModulosCRMBox').bPopup({
											   appendTo: '#ModulosCRMContent', 
				                               contentContainer: 'ModulosCRMM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_modulos_crm').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_modulos_crm').focus();   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_modulos_crm();
		});
	</script>