	<div id="MaquinariaMarcasMaquinariaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_maquinaria_marcas_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_maquinaria_marcas_maquinaria" 
								   name="strBusqueda_maquinaria_marcas_maquinaria"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_maquinaria_marcas_maquinaria"
										onclick="paginacion_maquinaria_marcas_maquinaria();" 
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
							<button class="btn btn-info" id="btnNuevo_maquinaria_marcas_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_maquinaria_marcas_maquinaria"
									onclick="reporte_maquinaria_marcas_maquinaria('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_maquinaria_marcas_maquinaria"
									onclick="reporte_maquinaria_marcas_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Marca"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_maquinaria_marcas_maquinaria">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Marca</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_maquinaria_marcas_maquinaria" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_maquinaria_marcas_maquinaria({{maquinaria_marca_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_maquinaria_marcas_maquinaria({{maquinaria_marca_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_maquinaria_marcas_maquinaria({{maquinaria_marca_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_maquinaria_marcas_maquinaria({{maquinaria_marca_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_maquinaria_marcas_maquinaria"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_maquinaria_marcas_maquinaria">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MaquinariaMarcasMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_maquinaria_marcas_maquinaria"  class="ModalBodyTitle">
			<h1>Marcas de Maquinaria</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMaquinariaMarcasMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMaquinariaMarcasMaquinaria"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMaquinariaMarcaID_maquinaria_marcas_maquinaria" 
										   name="intMaquinariaMarcaID_maquinaria_marcas_maquinaria" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_maquinaria_marcas_maquinaria" 
										   name="strDescripcionAnterior_maquinaria_marcas_maquinaria" type="hidden" value="">
									</input>
									<label for="txtDescripcion_maquinaria_marcas_maquinaria">Marca</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_maquinaria_marcas_maquinaria" 
											name="strDescripcion_maquinaria_marcas_maquinaria" type="text" value="" 
											tabindex="1" placeholder="Ingrese marca" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_maquinaria_marcas_maquinaria"  
									onclick="validar_maquinaria_marcas_maquinaria();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_maquinaria_marcas_maquinaria"  
									onclick="cambiar_estatus_maquinaria_marcas_maquinaria('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_maquinaria_marcas_maquinaria"  
									onclick="cambiar_estatus_maquinaria_marcas_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_maquinaria_marcas_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_maquinaria_marcas_maquinaria();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MaquinariaMarcasMaquinariaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMaquinariaMarcasMaquinaria = 0;
		var strUltimaBusquedaMaquinariaMarcasMaquinaria = "";
		//Variable que se utiliza para asignar objeto del modal
		var objMaquinariaMarcasMaquinaria = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_maquinaria_marcas_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/maquinaria_marcas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_maquinaria_marcas_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMaquinariaMarcasMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosMaquinariaMarcasMaquinaria = strPermisosMaquinariaMarcasMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMaquinariaMarcasMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMaquinariaMarcasMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_maquinaria_marcas_maquinaria').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMaquinariaMarcasMaquinaria[i]=='GUARDAR') || (arrPermisosMaquinariaMarcasMaquinaria[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_maquinaria_marcas_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosMaquinariaMarcasMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_maquinaria_marcas_maquinaria').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_maquinaria_marcas_maquinaria();
						}
						else if(arrPermisosMaquinariaMarcasMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_maquinaria_marcas_maquinaria').removeAttr('disabled');
							$('#btnRestaurar_maquinaria_marcas_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosMaquinariaMarcasMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_maquinaria_marcas_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosMaquinariaMarcasMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_maquinaria_marcas_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_maquinaria_marcas_maquinaria() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_maquinaria_marcas_maquinaria').val() != strUltimaBusquedaMaquinariaMarcasMaquinaria)
			{
				intPaginaMaquinariaMarcasMaquinaria = 0;
				strUltimaBusquedaMaquinariaMarcasMaquinaria = $('#txtBusqueda_maquinaria_marcas_maquinaria').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('maquinaria/maquinaria_marcas/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_maquinaria_marcas_maquinaria').val(),
						intPagina:intPaginaMaquinariaMarcasMaquinaria,
						strPermisosAcceso: $('#txtAcciones_maquinaria_marcas_maquinaria').val()
					},
					function(data){
						$('#dg_maquinaria_marcas_maquinaria tbody').empty();
						var tmpMaquinariaMarcasMaquinaria = Mustache.render($('#plantilla_maquinaria_marcas_maquinaria').html(),data);
						$('#dg_maquinaria_marcas_maquinaria tbody').html(tmpMaquinariaMarcasMaquinaria);
						$('#pagLinks_maquinaria_marcas_maquinaria').html(data.paginacion);
						$('#numElementos_maquinaria_marcas_maquinaria').html(data.total_rows);
						intPaginaMaquinariaMarcasMaquinaria = data.pagina;
					},
			'json');
		}

		
		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_maquinaria_marcas_maquinaria(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/maquinaria_marcas/';

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
										'strBusqueda': $('#txtBusqueda_maquinaria_marcas_maquinaria').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_maquinaria_marcas_maquinaria()
		{
			//Incializar formulario
			$('#frmMaquinariaMarcasMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_maquinaria_marcas_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmMaquinariaMarcasMaquinaria').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_maquinaria_marcas_maquinaria');
			//Habilitar todos los elementos del formulario
			$('#frmMaquinariaMarcasMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_maquinaria_marcas_maquinaria").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_maquinaria_marcas_maquinaria").hide();
			$("#btnRestaurar_maquinaria_marcas_maquinaria").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_maquinaria_marcas_maquinaria()
		{
			try {
				//Cerrar modal
				objMaquinariaMarcasMaquinaria.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_maquinaria_marcas_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_maquinaria_marcas_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_maquinaria_marcas_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmMaquinariaMarcasMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_maquinaria_marcas_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba una marca'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_maquinaria_marcas_maquinaria = $('#frmMaquinariaMarcasMaquinaria').data('bootstrapValidator');
			bootstrapValidator_maquinaria_marcas_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_maquinaria_marcas_maquinaria.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_maquinaria_marcas_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_maquinaria_marcas_maquinaria()
		{
			try
			{
				$('#frmMaquinariaMarcasMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_maquinaria_marcas_maquinaria()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('maquinaria/maquinaria_marcas/guardar',
					{ 
						intMaquinariaMarcaID: $('#txtMaquinariaMarcaID_maquinaria_marcas_maquinaria').val(),
						strDescripcion: $('#txtDescripcion_maquinaria_marcas_maquinaria').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_maquinaria_marcas_maquinaria').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_maquinaria_marcas_maquinaria();
							//Hacer un llamado a la función para cerrar modal
							cerrar_maquinaria_marcas_maquinaria();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_maquinaria_marcas_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_maquinaria_marcas_maquinaria(tipoMensaje, mensaje)
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
		function cambiar_estatus_maquinaria_marcas_maquinaria(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMaquinariaMarcaID_maquinaria_marcas_maquinaria').val();

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
						              'title':    'Marcas de Maquinaria',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                               //Hacer un llamado a la función para modificar el estatus del registro
													  set_estatus_maquinaria_marcas_maquinaria(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_maquinaria_marcas_maquinaria(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_maquinaria_marcas_maquinaria(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('maquinaria/maquinaria_marcas/set_estatus',
			      {intMaquinariaMarcaID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_maquinaria_marcas_maquinaria();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_maquinaria_marcas_maquinaria();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_maquinaria_marcas_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_maquinaria_marcas_maquinaria(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/maquinaria_marcas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_maquinaria_marcas_maquinaria();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtMaquinariaMarcaID_maquinaria_marcas_maquinaria').val(data.row.maquinaria_marca_id);
				            $('#txtDescripcion_maquinaria_marcas_maquinaria').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_maquinaria_marcas_maquinaria').val(data.row.descripcion);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_maquinaria_marcas_maquinaria').addClass("estatus-"+strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_maquinaria_marcas_maquinaria").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmMaquinariaMarcasMaquinaria').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_maquinaria_marcas_maquinaria").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_maquinaria_marcas_maquinaria").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objMaquinariaMarcasMaquinaria = $('#MaquinariaMarcasMaquinariaBox').bPopup({
															  appendTo: '#MaquinariaMarcasMaquinariaContent', 
								                              contentContainer: 'MaquinariaMarcasMaquinariaM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_maquinaria_marcas_maquinaria').focus();
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
			$('#txtDescripcion_maquinaria_marcas_maquinaria').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtMaquinariaMarcaID_maquinaria_marcas_maquinaria').val() == '' && $('#txtDescripcion_maquinaria_marcas_maquinaria').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_maquinaria_marcas_maquinaria($('#txtDescripcion_maquinaria_marcas_maquinaria').val(), 'descripcion', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_maquinaria_marcas_maquinaria').on('click','a',function(event){
				event.preventDefault();
				intPaginaMaquinariaMarcasMaquinaria = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_maquinaria_marcas_maquinaria();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_maquinaria_marcas_maquinaria').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_maquinaria_marcas_maquinaria();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_maquinaria_marcas_maquinaria').addClass("estatus-NUEVO");
				//Abrir modal
				 objMaquinariaMarcasMaquinaria = $('#MaquinariaMarcasMaquinariaBox').bPopup({
											   appendTo: '#MaquinariaMarcasMaquinariaContent', 
				                               contentContainer: 'MaquinariaMarcasMaquinariaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_maquinaria_marcas_maquinaria').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_maquinaria_marcas_maquinaria').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_maquinaria_marcas_maquinaria();
		});
	</script>