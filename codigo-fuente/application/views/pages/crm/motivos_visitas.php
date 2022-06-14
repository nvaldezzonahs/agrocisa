	<div id="MotivosVisitasCRMContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_motivos_visitas_crm" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_motivos_visitas_crm" 
								   name="strBusqueda_motivos_visitas_crm"  type="text" value="" tabindex="1" 
								   placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_motivos_visitas_crm"
										onclick="paginacion_motivos_visitas_crm();" title="Buscar coincidencias" tabindex="1"> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_motivos_visitas_crm" title="Nuevo registro" tabindex="1"> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_motivos_visitas_crm"
									onclick="reporte_motivos_visitas_crm('PDF');" title="Imprimir reporte general en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_motivos_visitas_crm"
									onclick="reporte_motivos_visitas_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1">
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
				td.movil:nth-of-type(1):before {content: "Motivo"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_motivos_visitas_crm">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Motivo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_motivos_visitas_crm" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_motivos_visitas_crm({{motivo_visita_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_motivos_visitas_crm({{motivo_visita_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_motivos_visitas_crm({{motivo_visita_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_motivos_visitas_crm({{motivo_visita_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_motivos_visitas_crm"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_motivos_visitas_crm">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MotivosVisitasCRMBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_motivos_visitas_crm"  class="ModalBodyTitle">
			<h1>Motivos de Visita</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMotivosVisitasCRM" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMotivosVisitasCRM" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMotivoVisitaID_motivos_visitas_crm" name="intMotivoVisitaID_motivos_visitas_crm"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_motivos_visitas_crm" 
										   name="strDescripcionAnterior_motivos_visitas_crm" type="hidden" value="">
									</input>
									<label for="txtDescripcion_motivos_visitas_crm">Motivo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_motivos_visitas_crm" 
											name="strDescripcion_motivos_visitas_crm" type="text" value="" 
											tabindex="1" placeholder="Ingrese motivo" maxlength="50">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_motivos_visitas_crm"  
									onclick="validar_motivos_visitas_crm();"  title="Guardar" tabindex="2">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_motivos_visitas_crm"  
									onclick="cambiar_estatus_motivos_visitas_crm('','ACTIVO');"  title="Desactivar" tabindex="3">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_motivos_visitas_crm"  
									onclick="cambiar_estatus_motivos_visitas_crm('','INACTIVO');"  title="Restaurar" tabindex="4">
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_motivos_visitas_crm"
									type="reset" aria-hidden="true" onclick="cerrar_motivos_visitas_crm();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MotivosVisitasCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMotivosVisitasCRM = 0;
		var strUltimaBusquedaMotivosVisitasCRM = "";
		//Variable que se utiliza para asignar objeto del modal
		var objMotivosVisitasCRM = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_motivos_visitas_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/motivos_visitas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_motivos_visitas_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMotivosVisitasCRM = data.row;
					//Separar la cadena 
					var arrPermisosMotivosVisitasCRM = strPermisosMotivosVisitasCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMotivosVisitasCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMotivosVisitasCRM[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_motivos_visitas_crm').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMotivosVisitasCRM[i]=='GUARDAR') || (arrPermisosMotivosVisitasCRM[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_motivos_visitas_crm').removeAttr('disabled');
						}
						else if(arrPermisosMotivosVisitasCRM[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_motivos_visitas_crm').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_motivos_visitas_crm();
						}
						else if(arrPermisosMotivosVisitasCRM[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_motivos_visitas_crm').removeAttr('disabled');
							$('#btnRestaurar_motivos_visitas_crm').removeAttr('disabled');
						}
						else if(arrPermisosMotivosVisitasCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_motivos_visitas_crm').removeAttr('disabled');
						}
						else if(arrPermisosMotivosVisitasCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_motivos_visitas_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_motivos_visitas_crm() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_motivos_visitas_crm').val() != strUltimaBusquedaMotivosVisitasCRM)
			{
				intPaginaMotivosVisitasCRM = 0;
				strUltimaBusquedaMotivosVisitasCRM = $('#txtBusqueda_motivos_visitas_crm').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('crm/motivos_visitas/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_motivos_visitas_crm').val(),
						intPagina:intPaginaMotivosVisitasCRM,
						strPermisosAcceso: $('#txtAcciones_motivos_visitas_crm').val()
					},
					function(data){
						$('#dg_motivos_visitas_crm tbody').empty();
						var tmpMotivosVisitasCRM = Mustache.render($('#plantilla_motivos_visitas_crm').html(),data);
						$('#dg_motivos_visitas_crm tbody').html(tmpMotivosVisitasCRM);
						$('#pagLinks_motivos_visitas_crm').html(data.paginacion);
						$('#numElementos_motivos_visitas_crm').html(data.total_rows);
						intPaginaMotivosVisitasCRM = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_motivos_visitas_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/motivos_visitas/';

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
										'strBusqueda': $('#txtBusqueda_motivos_visitas_crm').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_motivos_visitas_crm()
		{
			//Incializar formulario
			$('#frmMotivosVisitasCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_motivos_visitas_crm();
			//Limpiar cajas de texto ocultas
			$('#frmMotivosVisitasCRM').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_motivos_visitas_crm');
			//Habilitar todos los elementos del formulario
			$('#frmMotivosVisitasCRM').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_motivos_visitas_crm").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_motivos_visitas_crm").hide();
			$("#btnRestaurar_motivos_visitas_crm").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_motivos_visitas_crm()
		{
			try {
				//Cerrar modal
				objMotivosVisitasCRM.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_motivos_visitas_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_motivos_visitas_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_motivos_visitas_crm();
			//Validación del formulario de campos obligatorios
			$('#frmMotivosVisitasCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_motivos_visitas_crm: {
											validators: {
												notEmpty: {message: 'Escriba un motivo de visita'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_motivos_visitas_crm = $('#frmMotivosVisitasCRM').data('bootstrapValidator');
			bootstrapValidator_motivos_visitas_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_motivos_visitas_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_motivos_visitas_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_motivos_visitas_crm()
		{
			try
			{
				$('#frmMotivosVisitasCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_motivos_visitas_crm()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/motivos_visitas/guardar',
					{ 
						intMotivoVisitaID: $('#txtMotivoVisitaID_motivos_visitas_crm').val(),
						strDescripcion: $('#txtDescripcion_motivos_visitas_crm').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_motivos_visitas_crm').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_motivos_visitas_crm();
							//Hacer un llamado a la función para cerrar modal
							cerrar_motivos_visitas_crm();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_motivos_visitas_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_motivos_visitas_crm(tipoMensaje, mensaje)
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
		function cambiar_estatus_motivos_visitas_crm(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMotivoVisitaID_motivos_visitas_crm').val();

			}
			else
			{
				intID = id;
				strTipo = 'gridView';
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
				             {'type':     'question',
				              'title':    'Motivos de Visita',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_motivos_visitas_crm(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_motivos_visitas_crm(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_motivos_visitas_crm(id, tipo, estatus)
		{

			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('crm/motivos_visitas/set_estatus',
			     {intMotivoVisitaID: id,
			      strEstatus: estatus
			     },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_motivos_visitas_crm();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_motivos_visitas_crm();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_motivos_visitas_crm(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_motivos_visitas_crm(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/motivos_visitas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_motivos_visitas_crm();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtMotivoVisitaID_motivos_visitas_crm').val(data.row.motivo_visita_id);
				            $('#txtDescripcion_motivos_visitas_crm').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_motivos_visitas_crm').val(data.row.descripcion);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_motivos_visitas_crm').addClass("estatus-"+strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_motivos_visitas_crm").show();
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmMotivosVisitasCRM').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_motivos_visitas_crm").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_motivos_visitas_crm").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objMotivosVisitasCRM = $('#MotivosVisitasCRMBox').bPopup({
															  appendTo: '#MotivosVisitasCRMContent', 
								                              contentContainer: 'MotivosVisitasCRMM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_motivos_visitas_crm').focus();
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
			$('#txtDescripcion_motivos_visitas_crm').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtMotivoVisitaID_motivos_visitas_crm').val() == '' && $('#txtDescripcion_motivos_visitas_crm').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_motivos_visitas_crm($('#txtDescripcion_motivos_visitas_crm').val(), 'descripcion', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_motivos_visitas_crm').on('click','a',function(event){
				event.preventDefault();
				intPaginaMotivosVisitasCRM = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_motivos_visitas_crm();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_motivos_visitas_crm').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_motivos_visitas_crm();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_motivos_visitas_crm').addClass("estatus-NUEVO");
				//Abrir modal
				 objMotivosVisitasCRM = $('#MotivosVisitasCRMBox').bPopup({
											   appendTo: '#MotivosVisitasCRMContent', 
				                               contentContainer: 'MotivosVisitasCRMM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_motivos_visitas_crm').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_motivos_visitas_crm').focus();

			//Deshabilitar los siguientes botones (funciones de permisos de acceso)
			$('#btnNuevo_motivos_visitas_crm').attr('disabled','-1');  
			$('#btnImprimir_motivos_visitas_crm').attr('disabled','-1');
			$('#btnDescargarXLS_motivos_visitas_crm').attr('disabled','-1');
			$('#btnBuscar_motivos_visitas_crm').attr('disabled','-1');
			$('#btnGuardar_motivos_visitas_crm').attr('disabled','-1');
			$('#btnDesactivar_motivos_visitas_crm').attr('disabled','-1');
			$('#btnRestaurar_motivos_visitas_crm').attr('disabled','-1');   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_motivos_visitas_crm();
		});
	</script>