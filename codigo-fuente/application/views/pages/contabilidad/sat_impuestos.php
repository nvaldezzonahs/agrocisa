	<div id="SatImpuestosContabilidadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_sat_impuestos_contabilidad" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_sat_impuestos_contabilidad" 
								   name="strBusqueda_sat_impuestos_contabilidad"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_sat_impuestos_contabilidad"
										onclick="paginacion_sat_impuestos_contabilidad();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_sat_impuestos_contabilidad" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_sat_impuestos_contabilidad"
									onclick="reporte_sat_impuestos_contabilidad('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_sat_impuestos_contabilidad"
									onclick="reporte_sat_impuestos_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				<table class="table-hover movil" id="dg_sat_impuestos_contabilidad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Descripción</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_sat_impuestos_contabilidad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{codigo}}</td>
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_sat_impuestos_contabilidad({{impuesto_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_sat_impuestos_contabilidad({{impuesto_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_sat_impuestos_contabilidad({{impuesto_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_sat_impuestos_contabilidad({{impuesto_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_sat_impuestos_contabilidad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_sat_impuestos_contabilidad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="SatImpuestosContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_sat_impuestos_contabilidad"  class="ModalBodyTitle">
			<h1>Impuestos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmSatImpuestosContabilidad" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmSatImpuestosContabilidad" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Código-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtImpuestoID_sat_impuestos_contabilidad" 
										   name="intImpuestoID_sat_impuestos_contabilidad" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
									<input id="txtCodigoAnterior_sat_impuestos_contabilidad" 
										  name="strCodigoAnterior_sat_impuestos_contabilidad" type="hidden" value="">
									</input>
									<label for="txtCodigo_sat_impuestos_contabilidad">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_sat_impuestos_contabilidad" 
											name="strCodigo_sat_impuestos_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese código" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Retención-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbRetencion_sat_impuestos_contabilidad">Retención</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbRetencion_sat_impuestos_contabilidad" 
											name="strRetencion_sat_impuestos_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="SI">SI</option>
                          				<option value="NO">NO</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Traslado-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTraslado_sat_impuestos_contabilidad">Traslado</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTraslado_sat_impuestos_contabilidad"
											name="strTraslado_sat_impuestos_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="SI">SI</option>
                          				<option value="NO">NO</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipo_sat_impuestos_contabilidad">Tipo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipo_sat_impuestos_contabilidad"
											name="strTipo_sat_impuestos_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="FEDERAL">FEDERAL</option>
                          				<option value="LOCAL">LOCAL</option>
                     				</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_sat_impuestos_contabilidad">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_sat_impuestos_contabilidad"
											name="strDescripcion_sat_impuestos_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese descripción" maxlength="10">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_sat_impuestos_contabilidad"  
									onclick="validar_sat_impuestos_contabilidad();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_sat_impuestos_contabilidad"  
									onclick="cambiar_estatus_sat_impuestos_contabilidad('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_sat_impuestos_contabilidad"  
									onclick="cambiar_estatus_sat_impuestos_contabilidad('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_sat_impuestos_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_sat_impuestos_contabilidad();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#SatImpuestosContabilidadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaSatImpuestosContabilidad = 0;
		var strUltimaBusquedaSatImpuestosContabilidad = "";
		//Variable que se utiliza para asignar objeto del modal
		var objSatImpuestosContabilidad = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_sat_impuestos_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/sat_impuestos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_sat_impuestos_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosSatImpuestosContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosSatImpuestosContabilidad = strPermisosSatImpuestosContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosSatImpuestosContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosSatImpuestosContabilidad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_sat_impuestos_contabilidad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosSatImpuestosContabilidad[i]=='GUARDAR') || (arrPermisosSatImpuestosContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_sat_impuestos_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatImpuestosContabilidad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_sat_impuestos_contabilidad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_sat_impuestos_contabilidad();
						}
						else if(arrPermisosSatImpuestosContabilidad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_sat_impuestos_contabilidad').removeAttr('disabled');
							$('#btnRestaurar_sat_impuestos_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatImpuestosContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_sat_impuestos_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatImpuestosContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_sat_impuestos_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_sat_impuestos_contabilidad() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_sat_impuestos_contabilidad').val() != strUltimaBusquedaSatImpuestosContabilidad)
			{
				intPaginaSatImpuestosContabilidad = 0;
				strUltimaBusquedaSatImpuestosContabilidad = $('#txtBusqueda_sat_impuestos_contabilidad').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('contabilidad/sat_impuestos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_sat_impuestos_contabilidad').val(),
						intPagina:intPaginaSatImpuestosContabilidad,
						strPermisosAcceso: $('#txtAcciones_sat_impuestos_contabilidad').val()
					},
					function(data){
						$('#dg_sat_impuestos_contabilidad tbody').empty();
						var tmpSatImpuestosContabilidad = Mustache.render($('#plantilla_sat_impuestos_contabilidad').html(),data);
						$('#dg_sat_impuestos_contabilidad tbody').html(tmpSatImpuestosContabilidad);
						$('#pagLinks_sat_impuestos_contabilidad').html(data.paginacion);
						$('#numElementos_sat_impuestos_contabilidad').html(data.total_rows);
						intPaginaSatImpuestosContabilidad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_sat_impuestos_contabilidad(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/sat_impuestos/';

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
										'strBusqueda': $('#txtBusqueda_sat_impuestos_contabilidad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}

		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_sat_impuestos_contabilidad()
		{
			//Incializar formulario
			$('#frmSatImpuestosContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sat_impuestos_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmSatImpuestosContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_sat_impuestos_contabilidad');
			//Habilitar todos los elementos del formulario
			$('#frmSatImpuestosContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_sat_impuestos_contabilidad").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_sat_impuestos_contabilidad").hide();
			$("#btnRestaurar_sat_impuestos_contabilidad").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_sat_impuestos_contabilidad()
		{
			try {
				//Cerrar modal
				objSatImpuestosContabilidad.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_sat_impuestos_contabilidad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_sat_impuestos_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sat_impuestos_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmSatImpuestosContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_sat_impuestos_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba el código para este impuesto'},
												stringLength: {
													min: 3,
													message: 'El código debe tener 3 caracteres de longitud'
												}
											}
										},
										strDescripcion_sat_impuestos_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										}, 
										strRetencion_sat_impuestos_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una retención'}
											}
										},
										strTraslado_sat_impuestos_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione un traslado'}
											}
										},
										strTipo_sat_impuestos_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_sat_impuestos_contabilidad = $('#frmSatImpuestosContabilidad').data('bootstrapValidator');
			bootstrapValidator_sat_impuestos_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_sat_impuestos_contabilidad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_sat_impuestos_contabilidad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_sat_impuestos_contabilidad()
		{
			try
			{
				$('#frmSatImpuestosContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_sat_impuestos_contabilidad()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('contabilidad/sat_impuestos/guardar',
					{ 
						intImpuestoID: $('#txtImpuestoID_sat_impuestos_contabilidad').val(),
						strCodigo: $('#txtCodigo_sat_impuestos_contabilidad').val(),
						strCodigoAnterior: $('#txtCodigoAnterior_sat_impuestos_contabilidad').val(),
						strDescripcion: $('#txtDescripcion_sat_impuestos_contabilidad').val(),
						strRetencion: $('#cmbRetencion_sat_impuestos_contabilidad').val(),
						strTraslado: $('#cmbTraslado_sat_impuestos_contabilidad').val(),
						strTipo: $('#cmbTipo_sat_impuestos_contabilidad').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_sat_impuestos_contabilidad();
							//Hacer un llamado a la función para cerrar modal
							cerrar_sat_impuestos_contabilidad();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_sat_impuestos_contabilidad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_sat_impuestos_contabilidad(tipoMensaje, mensaje)
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
		function cambiar_estatus_sat_impuestos_contabilidad(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtImpuestoID_sat_impuestos_contabilidad').val();

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
				              'title':    'Impuestos',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_sat_impuestos_contabilidad(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_sat_impuestos_contabilidad(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_sat_impuestos_contabilidad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('contabilidad/sat_impuestos/set_estatus',
			      {intImpuestoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_sat_impuestos_contabilidad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_sat_impuestos_contabilidad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_sat_impuestos_contabilidad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_sat_impuestos_contabilidad(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/sat_impuestos/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_sat_impuestos_contabilidad();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtImpuestoID_sat_impuestos_contabilidad').val(data.row.impuesto_id);
				            $('#txtCodigo_sat_impuestos_contabilidad').val(data.row.codigo);
				            $('#txtCodigoAnterior_sat_impuestos_contabilidad').val(data.row.codigo);
				            $('#txtDescripcion_sat_impuestos_contabilidad').val(data.row.descripcion);
				            $('#cmbRetencion_sat_impuestos_contabilidad').val(data.row.retencion);
				            $('#cmbTraslado_sat_impuestos_contabilidad').val(data.row.traslado);
				            $('#cmbTipo_sat_impuestos_contabilidad').val(data.row.tipo);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_sat_impuestos_contabilidad').addClass("estatus-"+strEstatus);
				            
				          	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_sat_impuestos_contabilidad").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmSatImpuestosContabilidad').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_sat_impuestos_contabilidad").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_sat_impuestos_contabilidad").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objSatImpuestosContabilidad = $('#SatImpuestosContabilidadBox').bPopup({
															  appendTo: '#SatImpuestosContabilidadContent', 
								                              contentContainer: 'SatImpuestosContabilidadM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCodigo_sat_impuestos_contabilidad').focus();
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
        	$('#txtCodigo_sat_impuestos_contabilidad').numeric({decimal: false, negative: false});
        	
			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo_sat_impuestos_contabilidad').focusout(function(e){
				//Si no existe id, verificar la existencia del código
				if ($('#txtImpuestoID_sat_impuestos_contabilidad').val() == '' && $('#txtCodigo_sat_impuestos_contabilidad').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código 
					editar_sat_impuestos_contabilidad($('#txtCodigo_sat_impuestos_contabilidad').val(), 'codigo', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_sat_impuestos_contabilidad').on('click','a',function(event){
				event.preventDefault();
				intPaginaSatImpuestosContabilidad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_sat_impuestos_contabilidad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_sat_impuestos_contabilidad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_sat_impuestos_contabilidad();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_sat_impuestos_contabilidad').addClass("estatus-NUEVO");
				//Abrir modal
				 objSatImpuestosContabilidad = $('#SatImpuestosContabilidadBox').bPopup({
											   appendTo: '#SatImpuestosContabilidadContent', 
				                               contentContainer: 'SatImpuestosContabilidadM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_sat_impuestos_contabilidad').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_sat_impuestos_contabilidad').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_sat_impuestos_contabilidad();
		});
	</script>