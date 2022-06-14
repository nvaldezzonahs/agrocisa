	<div id="ConceptosTiposContabilidadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_conceptos_tipos_contabilidad" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_conceptos_tipos_contabilidad" 
								   name="strBusqueda_conceptos_tipos_contabilidad"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_conceptos_tipos_contabilidad"
										onclick="paginacion_conceptos_tipos_contabilidad();" 
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
							<button class="btn btn-info" id="btnNuevo_conceptos_tipos_contabilidad" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_conceptos_tipos_contabilidad"
									onclick="reporte_conceptos_tipos_contabilidad('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_conceptos_tipos_contabilidad"
									onclick="reporte_conceptos_tipos_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Descripción"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_conceptos_tipos_contabilidad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Descripción</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_conceptos_tipos_contabilidad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_conceptos_tipos_contabilidad({{concepto_tipo_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_conceptos_tipos_contabilidad({{concepto_tipo_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_conceptos_tipos_contabilidad({{concepto_tipo_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_conceptos_tipos_contabilidad({{concepto_tipo_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_conceptos_tipos_contabilidad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_conceptos_tipos_contabilidad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ConceptosTiposContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_conceptos_tipos_contabilidad"  class="ModalBodyTitle">
			<h1>Tipos de Conceptos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmConceptosTiposContabilidad" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmConceptosTiposContabilidad"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtConceptoTipoID_conceptos_tipos_contabilidad" 
										   name="intConceptoTipoID_conceptos_tipos_contabilidad" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_conceptos_tipos_contabilidad" 
										   name="strDescripcionAnterior_conceptos_tipos_contabilidad" type="hidden" value="">
									</input>
									<label for="txtDescripcion_conceptos_tipos_contabilidad">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_conceptos_tipos_contabilidad" 
											name="strDescripcion_conceptos_tipos_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese descripción" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_conceptos_tipos_contabilidad"  
									onclick="validar_conceptos_tipos_contabilidad();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_conceptos_tipos_contabilidad"  
									onclick="cambiar_estatus_conceptos_tipos_contabilidad('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_conceptos_tipos_contabilidad"  
									onclick="cambiar_estatus_conceptos_tipos_contabilidad('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_conceptos_tipos_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_conceptos_tipos_contabilidad();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ConceptosTiposContabilidadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaConceptosTiposContabilidad = 0;
		var strUltimaBusquedaConceptosTiposContabilidad = "";
		//Variable que se utiliza para asignar objeto del modal
		var objConceptosTiposContabilidad = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_conceptos_tipos_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/conceptos_tipos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_conceptos_tipos_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosConceptosTiposContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosConceptosTiposContabilidad = strPermisosConceptosTiposContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosConceptosTiposContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosConceptosTiposContabilidad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_conceptos_tipos_contabilidad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosConceptosTiposContabilidad[i]=='GUARDAR') || (arrPermisosConceptosTiposContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_conceptos_tipos_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosConceptosTiposContabilidad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_conceptos_tipos_contabilidad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_conceptos_tipos_contabilidad();
						}
						else if(arrPermisosConceptosTiposContabilidad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_conceptos_tipos_contabilidad').removeAttr('disabled');
							$('#btnRestaurar_conceptos_tipos_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosConceptosTiposContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_conceptos_tipos_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosConceptosTiposContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_conceptos_tipos_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_conceptos_tipos_contabilidad() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_conceptos_tipos_contabilidad').val() != strUltimaBusquedaConceptosTiposContabilidad)
			{
				intPaginaConceptosTiposContabilidad = 0;
				strUltimaBusquedaConceptosTiposContabilidad = $('#txtBusqueda_conceptos_tipos_contabilidad').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('contabilidad/conceptos_tipos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_conceptos_tipos_contabilidad').val(),
						intPagina:intPaginaConceptosTiposContabilidad,
						strPermisosAcceso: $('#txtAcciones_conceptos_tipos_contabilidad').val()
					},
					function(data){
						$('#dg_conceptos_tipos_contabilidad tbody').empty();
						var tmpConceptosTiposContabilidad = Mustache.render($('#plantilla_conceptos_tipos_contabilidad').html(),data);
						$('#dg_conceptos_tipos_contabilidad tbody').html(tmpConceptosTiposContabilidad);
						$('#pagLinks_conceptos_tipos_contabilidad').html(data.paginacion);
						$('#numElementos_conceptos_tipos_contabilidad').html(data.total_rows);
						intPaginaConceptosTiposContabilidad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_conceptos_tipos_contabilidad(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/conceptos_tipos/';

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
										'strBusqueda': $('#txtBusqueda_conceptos_tipos_contabilidad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		
		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_conceptos_tipos_contabilidad()
		{
			//Incializar formulario
			$('#frmConceptosTiposContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_conceptos_tipos_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmConceptosTiposContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_conceptos_tipos_contabilidad');
			//Habilitar todos los elementos del formulario
			$('#frmConceptosTiposContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_conceptos_tipos_contabilidad").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_conceptos_tipos_contabilidad").hide();
			$("#btnRestaurar_conceptos_tipos_contabilidad").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_conceptos_tipos_contabilidad()
		{
			try {
				//Cerrar modal
				objConceptosTiposContabilidad.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_conceptos_tipos_contabilidad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_conceptos_tipos_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_conceptos_tipos_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmConceptosTiposContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_conceptos_tipos_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_conceptos_tipos_contabilidad = $('#frmConceptosTiposContabilidad').data('bootstrapValidator');
			bootstrapValidator_conceptos_tipos_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_conceptos_tipos_contabilidad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_conceptos_tipos_contabilidad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_conceptos_tipos_contabilidad()
		{
			try
			{
				$('#frmConceptosTiposContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_conceptos_tipos_contabilidad()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('contabilidad/conceptos_tipos/guardar',
					{ 
						intConceptoTipoID: $('#txtConceptoTipoID_conceptos_tipos_contabilidad').val(),
						strDescripcion: $('#txtDescripcion_conceptos_tipos_contabilidad').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_conceptos_tipos_contabilidad').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_conceptos_tipos_contabilidad();
							//Hacer un llamado a la función para cerrar modal
							cerrar_conceptos_tipos_contabilidad();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_conceptos_tipos_contabilidad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_conceptos_tipos_contabilidad(tipoMensaje, mensaje)
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
		function cambiar_estatus_conceptos_tipos_contabilidad(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtConceptoTipoID_conceptos_tipos_contabilidad').val();

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
				              'title':    'Tipos de Conceptos',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_conceptos_tipos_contabilidad(intID, strTipo, 'INACTIVO');

				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_conceptos_tipos_contabilidad(intID, strTipo, 'ACTIVO');

		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_conceptos_tipos_contabilidad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('contabilidad/conceptos_tipos/set_estatus',
			      {intConceptoTipoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_conceptos_tipos_contabilidad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_conceptos_tipos_contabilidad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_conceptos_tipos_contabilidad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}



		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_conceptos_tipos_contabilidad(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/conceptos_tipos/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_conceptos_tipos_contabilidad();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtConceptoTipoID_conceptos_tipos_contabilidad').val(data.row.concepto_tipo_id);
				            $('#txtDescripcion_conceptos_tipos_contabilidad').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_conceptos_tipos_contabilidad').val(data.row.descripcion);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_conceptos_tipos_contabilidad').addClass("estatus-"+strEstatus);
				           	
				           	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_conceptos_tipos_contabilidad").show();
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmConceptosTiposContabilidad').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_conceptos_tipos_contabilidad").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_conceptos_tipos_contabilidad").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objConceptosTiposContabilidad = $('#ConceptosTiposContabilidadBox').bPopup({
															  appendTo: '#ConceptosTiposContabilidadContent', 
								                              contentContainer: 'ConceptosTiposContabilidadM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_conceptos_tipos_contabilidad').focus();
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
			$('#txtDescripcion_conceptos_tipos_contabilidad').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtConceptoTipoID_conceptos_tipos_contabilidad').val() == '' && $('#txtDescripcion_conceptos_tipos_contabilidad').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_conceptos_tipos_contabilidad($('#txtDescripcion_conceptos_tipos_contabilidad').val(), 'descripcion', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_conceptos_tipos_contabilidad').on('click','a',function(event){
				event.preventDefault();
				intPaginaConceptosTiposContabilidad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_conceptos_tipos_contabilidad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_conceptos_tipos_contabilidad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_conceptos_tipos_contabilidad();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_conceptos_tipos_contabilidad').addClass("estatus-NUEVO");
				//Abrir modal
				 objConceptosTiposContabilidad = $('#ConceptosTiposContabilidadBox').bPopup({
											   appendTo: '#ConceptosTiposContabilidadContent', 
				                               contentContainer: 'ConceptosTiposContabilidadM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_conceptos_tipos_contabilidad').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_conceptos_tipos_contabilidad').focus();    
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_conceptos_tipos_contabilidad();
		});
	</script>