	<div id="SatMaterialPeligrosoContabilidadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_sat_material_peligroso_contabilidad" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_sat_material_peligroso_contabilidad" 
								   name="strBusqueda_sat_material_peligroso_contabilidad"  type="text" value=""
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_sat_material_peligroso_contabilidad"
										onclick="paginacion_sat_material_peligroso_contabilidad();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_sat_material_peligroso_contabilidad" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_sat_material_peligroso_contabilidad"
									onclick="reporte_sat_material_peligroso_contabilidad('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_sat_material_peligroso_contabilidad"
									onclick="reporte_sat_material_peligroso_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(2):before {content: "Clase o div."; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_sat_material_peligroso_contabilidad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Descripción</th>
							<th class="movil">Clase o div.</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_sat_material_peligroso_contabilidad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{codigo}}</td>
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{clase}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_sat_material_peligroso_contabilidad({{material_peligroso_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_sat_material_peligroso_contabilidad({{material_peligroso_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_sat_material_peligroso_contabilidad({{material_peligroso_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_sat_material_peligroso_contabilidad({{material_peligroso_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_sat_material_peligroso_contabilidad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_sat_material_peligroso_contabilidad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="SatMaterialPeligrosoContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_sat_material_peligroso_contabilidad"  class="ModalBodyTitle">
			<h1>Materiales Peligrosos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmSatMaterialPeligrosoContabilidad" method="post" action="#"  class="form-horizontal" role="form" 
					  name="frmSatMaterialPeligrosoContabilidad" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Código-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMaterialPeligrosoID_sat_material_peligroso_contabilidad" 
										   name="intMaterialPeligrosoID_sat_material_peligroso_contabilidad" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
									<input id="txtCodigoAnterior_sat_material_peligroso_contabilidad" 
											name="strCodigoAnterior_sat_material_peligroso_contabilidad" type="hidden" value="">
									</input>
									<label for="txtCodigo_sat_material_peligroso_contabilidad">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_sat_material_peligroso_contabilidad" 
											name="strCodigo_sat_material_peligroso_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese código" maxlength="4">
									</input>
								</div>
							</div>
						</div>
						<!--Descripción-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_sat_material_peligroso_contabilidad">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_sat_material_peligroso_contabilidad" 
											name="strDescripcion_sat_material_peligroso_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese descripción" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Clase-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtClase_sat_material_peligroso_contabilidad">Clase o div.</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtClase_sat_material_peligroso_contabilidad" 
											name="strClase_sat_material_peligroso_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese clase" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Peligro secundario-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPeligroSecundario_sat_material_peligroso_contabilidad">Peligro secundario</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPeligroSecundario_sat_material_peligroso_contabilidad" 
											name="strPeligroSecundario_sat_material_peligroso_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese peligro secundario" maxlength="10">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Nombre técnico-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNombreTecnico_sat_material_peligroso_contabilidad">Nombre técnico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNombreTecnico_sat_material_peligroso_contabilidad" 
											name="strNombreTecnico_sat_material_peligroso_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese nombre técnico" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_sat_material_peligroso_contabilidad"  
									onclick="validar_sat_material_peligroso_contabilidad();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_sat_material_peligroso_contabilidad"  
									onclick="cambiar_estatus_sat_material_peligroso_contabilidad('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_sat_material_peligroso_contabilidad"  
									onclick="cambiar_estatus_sat_material_peligroso_contabilidad('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_sat_material_peligroso_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_sat_material_peligroso_contabilidad();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#SatMaterialPeligrosoContabilidadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaSatMaterialPeligrosoContabilidad = 0;
		var strUltimaBusquedaSatMaterialPeligrosoContabilidad = "";
		//Variable que se utiliza para asignar objeto del modal
		var objSatMaterialPeligrosoContabilidad = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_sat_material_peligroso_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/sat_material_peligroso/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_sat_material_peligroso_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosSatMaterialPeligrosoContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosSatMaterialPeligrosoContabilidad = strPermisosSatMaterialPeligrosoContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosSatMaterialPeligrosoContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosSatMaterialPeligrosoContabilidad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_sat_material_peligroso_contabilidad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosSatMaterialPeligrosoContabilidad[i]=='GUARDAR') || (arrPermisosSatMaterialPeligrosoContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_sat_material_peligroso_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatMaterialPeligrosoContabilidad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_sat_material_peligroso_contabilidad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_sat_material_peligroso_contabilidad();
						}
						else if(arrPermisosSatMaterialPeligrosoContabilidad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_sat_material_peligroso_contabilidad').removeAttr('disabled');
							$('#btnRestaurar_sat_material_peligroso_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatMaterialPeligrosoContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_sat_material_peligroso_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatMaterialPeligrosoContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_sat_material_peligroso_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_sat_material_peligroso_contabilidad() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_sat_material_peligroso_contabilidad').val() != strUltimaBusquedaSatMaterialPeligrosoContabilidad)
			{
				intPaginaSatMaterialPeligrosoContabilidad = 0;
				strUltimaBusquedaSatMaterialPeligrosoContabilidad = $('#txtBusqueda_sat_material_peligroso_contabilidad').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('contabilidad/sat_material_peligroso/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_sat_material_peligroso_contabilidad').val(),
						intPagina:intPaginaSatMaterialPeligrosoContabilidad,
						strPermisosAcceso: $('#txtAcciones_sat_material_peligroso_contabilidad').val()
					},
					function(data){
						$('#dg_sat_material_peligroso_contabilidad tbody').empty();
						var tmpSatMaterialPeligrosoContabilidad = Mustache.render($('#plantilla_sat_material_peligroso_contabilidad').html(),data);
						$('#dg_sat_material_peligroso_contabilidad tbody').html(tmpSatMaterialPeligrosoContabilidad);
						$('#pagLinks_sat_material_peligroso_contabilidad').html(data.paginacion);
						$('#numElementos_sat_material_peligroso_contabilidad').html(data.total_rows);
						intPaginaSatMaterialPeligrosoContabilidad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_sat_material_peligroso_contabilidad(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/sat_material_peligroso/';

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
										'strBusqueda': $('#txtBusqueda_sat_material_peligroso_contabilidad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_sat_material_peligroso_contabilidad()
		{
			//Incializar formulario
			$('#frmSatMaterialPeligrosoContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sat_material_peligroso_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmSatMaterialPeligrosoContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_sat_material_peligroso_contabilidad');
			//Habilitar todos los elementos del formulario
			$('#frmSatMaterialPeligrosoContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_sat_material_peligroso_contabilidad").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_sat_material_peligroso_contabilidad").hide();
			$("#btnRestaurar_sat_material_peligroso_contabilidad").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_sat_material_peligroso_contabilidad()
		{
			try {
				//Cerrar modal
				objSatMaterialPeligrosoContabilidad.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_sat_material_peligroso_contabilidad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_sat_material_peligroso_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sat_material_peligroso_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmSatMaterialPeligrosoContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_sat_material_peligroso_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba el código para este material peligroso'},
												stringLength: {
													min: 4,
													message: 'El código debe tener 4 caracteres de longitud'
												}
											}
										},
										strDescripcion_sat_material_peligroso_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										}, 
										strClase_sat_material_peligroso_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba una clase'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_sat_material_peligroso_contabilidad = $('#frmSatMaterialPeligrosoContabilidad').data('bootstrapValidator');
			bootstrapValidator_sat_material_peligroso_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_sat_material_peligroso_contabilidad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_sat_material_peligroso_contabilidad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_sat_material_peligroso_contabilidad()
		{
			try
			{
				$('#frmSatMaterialPeligrosoContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_sat_material_peligroso_contabilidad()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('contabilidad/sat_material_peligroso/guardar',
					{ 
						intMaterialPeligrosoID: $('#txtMaterialPeligrosoID_sat_material_peligroso_contabilidad').val(),
						strCodigo: $('#txtCodigo_sat_material_peligroso_contabilidad').val(),
						strCodigoAnterior: $('#txtCodigoAnterior_sat_material_peligroso_contabilidad').val(),
						strDescripcion: $('#txtDescripcion_sat_material_peligroso_contabilidad').val(), 
						strClase: $('#txtClase_sat_material_peligroso_contabilidad').val(), 
						strPeligroSecundario: $('#txtPeligroSecundario_sat_material_peligroso_contabilidad').val(), 
						strNombreTecnico: $('#txtNombreTecnico_sat_material_peligroso_contabilidad').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_sat_material_peligroso_contabilidad();
							//Hacer un llamado a la función para cerrar modal
							cerrar_sat_material_peligroso_contabilidad();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_sat_material_peligroso_contabilidad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_sat_material_peligroso_contabilidad(tipoMensaje, mensaje)
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
		function cambiar_estatus_sat_material_peligroso_contabilidad(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMaterialPeligrosoID_sat_material_peligroso_contabilidad').val();

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
				              'title':    'Materiales Peligrosos',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                                //Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_sat_material_peligroso_contabilidad(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_sat_material_peligroso_contabilidad(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_sat_material_peligroso_contabilidad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('contabilidad/sat_material_peligroso/set_estatus',
			      {intMaterialPeligrosoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_sat_material_peligroso_contabilidad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_sat_material_peligroso_contabilidad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_sat_material_peligroso_contabilidad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_sat_material_peligroso_contabilidad(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/sat_material_peligroso/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_sat_material_peligroso_contabilidad();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtMaterialPeligrosoID_sat_material_peligroso_contabilidad').val(data.row.material_peligroso_id);
				            $('#txtCodigo_sat_material_peligroso_contabilidad').val(data.row.codigo);
				            $('#txtCodigoAnterior_sat_material_peligroso_contabilidad').val(data.row.codigo);
				            $('#txtDescripcion_sat_material_peligroso_contabilidad').val(data.row.descripcion);
				            $('#txtClase_sat_material_peligroso_contabilidad').val(data.row.clase);
				            $('#txtPeligroSecundario_sat_material_peligroso_contabilidad').val(data.row.peligro_secundario);
				            $('#txtNombreTecnico_sat_material_peligroso_contabilidad').val(data.row.nombre_tecnico);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_sat_material_peligroso_contabilidad').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_sat_material_peligroso_contabilidad").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
				            	$('#frmSatMaterialPeligrosoContabilidad').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					           	$("#btnGuardar_sat_material_peligroso_contabilidad").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_sat_material_peligroso_contabilidad").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objSatMaterialPeligrosoContabilidad = $('#SatMaterialPeligrosoContabilidadBox').bPopup({
															  appendTo: '#SatMaterialPeligrosoContabilidadContent', 
								                              contentContainer: 'SatMaterialPeligrosoContabilidadM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCodigo_sat_material_peligroso_contabilidad').focus();
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
        	$('#txtCodigo_sat_material_peligroso_contabilidad').numeric({decimal: false, negative: false});
			
			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo_sat_material_peligroso_contabilidad').focusout(function(e){
				//Si no existe id, verificar la existencia del código
				if ($('#txtMaterialPeligrosoID_sat_material_peligroso_contabilidad').val() == '' && $('#txtCodigo_sat_material_peligroso_contabilidad').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código 
					editar_sat_material_peligroso_contabilidad($('#txtCodigo_sat_material_peligroso_contabilidad').val(), 'codigo', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_sat_material_peligroso_contabilidad').on('click','a',function(event){
				event.preventDefault();
				intPaginaSatMaterialPeligrosoContabilidad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_sat_material_peligroso_contabilidad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_sat_material_peligroso_contabilidad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_sat_material_peligroso_contabilidad();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_sat_material_peligroso_contabilidad').addClass("estatus-NUEVO");
				//Abrir modal
				 objSatMaterialPeligrosoContabilidad = $('#SatMaterialPeligrosoContabilidadBox').bPopup({
											   appendTo: '#SatMaterialPeligrosoContabilidadContent', 
				                               contentContainer: 'SatMaterialPeligrosoContabilidadM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_sat_material_peligroso_contabilidad').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_sat_material_peligroso_contabilidad').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_sat_material_peligroso_contabilidad();
		});
	</script>