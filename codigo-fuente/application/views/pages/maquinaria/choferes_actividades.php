	<div id="ChoferesActividadesMaquinariaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_choferes_actividades_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_choferes_actividades_maquinaria" 
								   name="strBusqueda_choferes_actividades_maquinaria"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_choferes_actividades_maquinaria"
										onclick="paginacion_choferes_actividades_maquinaria();" 
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
							<button class="btn btn-info" id="btnNuevo_choferes_actividades_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_choferes_actividades_maquinaria"
									onclick="reporte_choferes_actividades_maquinaria('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_choferes_actividades_maquinaria"
									onclick="reporte_choferes_actividades_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Actividad"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Comisión"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_choferes_actividades_maquinaria">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Actividad</th>
							<th class="movil">Comisión</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_choferes_actividades_maquinaria" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{comision}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_choferes_actividades_maquinaria({{chofer_actividad_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_choferes_actividades_maquinaria({{chofer_actividad_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_choferes_actividades_maquinaria({{chofer_actividad_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_choferes_actividades_maquinaria({{chofer_actividad_id}},'{{estatus}}')"  
										title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_choferes_actividades_maquinaria"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_choferes_actividades_maquinaria">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ChoferesActividadesMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_choferes_actividades_maquinaria"  class="ModalBodyTitle">
			<h1>Actividades de los Choferes</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmChoferesActividadesMaquinaria" method="post" action="#" class="form-horizontal" role="form"
					  name="frmChoferesActividadesMaquinaria"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtChoferActividadID_choferes_actividades_maquinaria" 
										   name="intChoferActividadID_choferes_actividades_maquinaria"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_choferes_actividades_maquinaria" 
										   name="strDescripcionAnterior_choferes_actividades_maquinaria" 
										   type="hidden" value="">
									</input>
									<label for="txtDescripcion_choferes_actividades_maquinaria">Actividad</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_choferes_actividades_maquinaria" 
											name="strDescripcion_choferes_actividades_maquinaria" type="text" 
											value="" tabindex="1" placeholder="Ingrese actividad" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Comisión-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtComision_choferes_actividades_maquinaria">Comisión</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_choferes_actividades_maquinaria" id="txtComision_choferes_actividades_maquinaria" 
												name="intComision_choferes_actividades_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese comisión" maxlength="12">
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
							<button class="btn btn-success" id="btnGuardar_choferes_actividades_maquinaria"  
									onclick="validar_choferes_actividades_maquinaria();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_choferes_actividades_maquinaria"  
									onclick="cambiar_estatus_choferes_actividades_maquinaria('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_choferes_actividades_maquinaria"  
									onclick="cambiar_estatus_choferes_actividades_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_choferes_actividades_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_choferes_actividades_maquinaria();" title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ChoferesActividadesMaquinariaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaChoferesActividadesMaquinaria = 0;
		var strUltimaBusquedaChoferesActividadesMaquinaria = "";
		//Variable que se utiliza para asignar objeto del modal
		var objChoferesActividadesMaquinaria = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_choferes_actividades_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/choferes_actividades/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_choferes_actividades_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosChoferesActividadesMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosChoferesActividadesMaquinaria = strPermisosChoferesActividadesMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosChoferesActividadesMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosChoferesActividadesMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_choferes_actividades_maquinaria').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosChoferesActividadesMaquinaria[i]=='GUARDAR') || (arrPermisosChoferesActividadesMaquinaria[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_choferes_actividades_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosChoferesActividadesMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_choferes_actividades_maquinaria').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_choferes_actividades_maquinaria();
						}
						else if(arrPermisosChoferesActividadesMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_choferes_actividades_maquinaria').removeAttr('disabled');
							$('#btnRestaurar_choferes_actividades_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosChoferesActividadesMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_choferes_actividades_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosChoferesActividadesMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_choferes_actividades_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_choferes_actividades_maquinaria() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_choferes_actividades_maquinaria').val() != strUltimaBusquedaChoferesActividadesMaquinaria)
			{
				intPaginaChoferesActividadesMaquinaria = 0;
				strUltimaBusquedaChoferesActividadesMaquinaria = $('#txtBusqueda_choferes_actividades_maquinaria').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('maquinaria/choferes_actividades/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_choferes_actividades_maquinaria').val(),
						intPagina:intPaginaChoferesActividadesMaquinaria,
						strPermisosAcceso: $('#txtAcciones_choferes_actividades_maquinaria').val()
					},
					function(data){
						$('#dg_choferes_actividades_maquinaria tbody').empty();
						var tmpChoferesActividadesMaquinaria = Mustache.render($('#plantilla_choferes_actividades_maquinaria').html(),data);
						$('#dg_choferes_actividades_maquinaria tbody').html(tmpChoferesActividadesMaquinaria);
						$('#pagLinks_choferes_actividades_maquinaria').html(data.paginacion);
						$('#numElementos_choferes_actividades_maquinaria').html(data.total_rows);
						intPaginaChoferesActividadesMaquinaria = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_choferes_actividades_maquinaria(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/choferes_actividades/';

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
										'strBusqueda': $('#txtBusqueda_choferes_actividades_maquinaria').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_choferes_actividades_maquinaria()
		{
			//Incializar formulario
			$('#frmChoferesActividadesMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_choferes_actividades_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmChoferesActividadesMaquinaria').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_choferes_actividades_maquinaria');
			//Habilitar todos los elementos del formulario
			$('#frmChoferesActividadesMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_choferes_actividades_maquinaria").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_choferes_actividades_maquinaria").hide();
			$("#btnRestaurar_choferes_actividades_maquinaria").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_choferes_actividades_maquinaria()
		{
			try {
				//Cerrar modal
				objChoferesActividadesMaquinaria.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_choferes_actividades_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_choferes_actividades_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_choferes_actividades_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmChoferesActividadesMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_choferes_actividades_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba una actividad'}
											}
										},
										intComision_choferes_actividades_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba una comisión'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_choferes_actividades_maquinaria = $('#frmChoferesActividadesMaquinaria').data('bootstrapValidator');
			bootstrapValidator_choferes_actividades_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_choferes_actividades_maquinaria.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_choferes_actividades_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_choferes_actividades_maquinaria()
		{
			try
			{
				$('#frmChoferesActividadesMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_choferes_actividades_maquinaria()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('maquinaria/choferes_actividades/guardar',
					{ 
						intChoferActividadID: $('#txtChoferActividadID_choferes_actividades_maquinaria').val(),
						strDescripcion: $('#txtDescripcion_choferes_actividades_maquinaria').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_choferes_actividades_maquinaria').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intComision: $.reemplazar($('#txtComision_choferes_actividades_maquinaria').val(), ",", "")
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_choferes_actividades_maquinaria();
							//Hacer un llamado a la función para cerrar modal
							cerrar_choferes_actividades_maquinaria();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_choferes_actividades_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_choferes_actividades_maquinaria(tipoMensaje, mensaje)
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
		function cambiar_estatus_choferes_actividades_maquinaria(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtChoferActividadID_choferes_actividades_maquinaria').val();

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
						              'title':    'Actividades de los Choferes',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                            	//Hacer un llamado a la función para modificar el estatus del registro
													  	set_estatus_choferes_actividades_maquinaria(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_choferes_actividades_maquinaria(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_choferes_actividades_maquinaria(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('maquinaria/choferes_actividades/set_estatus',
			      {intChoferActividadID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_choferes_actividades_maquinaria();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_choferes_actividades_maquinaria();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_choferes_actividades_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_choferes_actividades_maquinaria(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/choferes_actividades/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_choferes_actividades_maquinaria();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtChoferActividadID_choferes_actividades_maquinaria').val(data.row.chofer_actividad_id);
				            $('#txtDescripcion_choferes_actividades_maquinaria').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_choferes_actividades_maquinaria').val(data.row.descripcion);
				            $('#txtComision_choferes_actividades_maquinaria').val(data.row.comision)
				            //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtComision_choferes_actividades_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
				            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
				            $('#divEncabezadoModal_choferes_actividades_maquinaria').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_choferes_actividades_maquinaria").show();
							}
							else 
							{	

								//Deshabilitar todos los elementos del formulario
			            		$('#frmChoferesActividadesMaquinaria').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_choferes_actividades_maquinaria").hide(); 
								
								//Mostrar botón Restaurar
								$("#btnRestaurar_choferes_actividades_maquinaria").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objChoferesActividadesMaquinaria = $('#ChoferesActividadesMaquinariaBox').bPopup({
															  appendTo: '#ChoferesActividadesMaquinariaContent', 
								                              contentContainer: 'ChoferesActividadesMaquinariaM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_choferes_actividades_maquinaria').focus();
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
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtComision_choferes_actividades_maquinaria').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_choferes_actividades_maquinaria').blur(function(){
				$('.moneda_choferes_actividades_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Comprobar la existencia de la descripción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_choferes_actividades_maquinaria').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtChoferActividadID_choferes_actividades_maquinaria').val() == '' && $('#txtDescripcion_choferes_actividades_maquinaria').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_choferes_actividades_maquinaria($('#txtDescripcion_choferes_actividades_maquinaria').val(), 'descripcion', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_choferes_actividades_maquinaria').on('click','a',function(event){
				event.preventDefault();
				intPaginaChoferesActividadesMaquinaria = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_choferes_actividades_maquinaria();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_choferes_actividades_maquinaria').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_choferes_actividades_maquinaria();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_choferes_actividades_maquinaria').addClass("estatus-NUEVO");
				//Abrir modal
				 objChoferesActividadesMaquinaria = $('#ChoferesActividadesMaquinariaBox').bPopup({
											   appendTo: '#ChoferesActividadesMaquinariaContent', 
				                               contentContainer: 'ChoferesActividadesMaquinariaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_choferes_actividades_maquinaria').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_choferes_actividades_maquinaria').focus();      
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_choferes_actividades_maquinaria();
		});
	</script>