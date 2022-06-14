	<div id="CultivosCRMContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_cultivos_crm" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_cultivos_crm" 
								   name="strBusqueda_cultivos_crm"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_cultivos_crm"
										onclick="paginacion_cultivos_crm();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_cultivos_crm" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_cultivos_crm"
									onclick="reporte_cultivos_crm('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_cultivos_crm"
									onclick="reporte_cultivos_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla cultivos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Cultivo"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Estatus"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla temporadas del cultivo
				*/
				td.movil.b1:nth-of-type(1):before {content: "Siembra"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Cosecha"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_cultivos_crm">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Cultivo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_cultivos_crm" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{descripcion}}</td>
							<td class="movil a2">{{estatus}}</td>
							<td class="td-center movil a3"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_cultivos_crm({{cultivo_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_cultivos_crm({{cultivo_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_cultivos_crm({{cultivo_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_cultivos_crm({{cultivo_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_cultivos_crm"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_cultivos_crm">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="CultivosCRMBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_cultivos_crm"  class="ModalBodyTitle">
			<h1>Cultivos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCultivosCRM" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmCultivosCRM" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCultivoID_cultivos_crm" name="intCultivoID_cultivos_crm"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_cultivos_crm" 
										   name="strDescripcionAnterior_cultivos_crm" type="hidden" value="">
									</input>
									<label for="txtDescripcion_cultivos_crm">Cultivo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_cultivos_crm" 
											name="strDescripcion_cultivos_crm" type="text" value="" 
											tabindex="1" placeholder="Ingrese cultivo" maxlength="50">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Temporadas del cultivo</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Siembra-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbSiembra_temporadas_cultivos_crm">Siembra</label>
															</div>
															<div class="col-md-12">
																<select class="form-control" id="cmbSiembra_temporadas_cultivos_crm" 
																 		name="strSiembra_temporadas_cultivos_crm" tabindex="1">
							                          				<option value="ENERO">ENERO</option>
							                          				<option value="FEBRERO">FEBRERO</option>
							                          				<option value="MARZO">MARZO</option>
							                          				<option value="ABRIL">ABRIL</option>
							                          				<option value="MAYO">MAYO</option>
							                          				<option value="JUNIO">JUNIO</option>
							                          				<option value="JULIO">JULIO</option>
							                          				<option value="AGOSTO">AGOSTO</option>
							                          				<option value="SEPTIEMBRE">SEPTIEMBRE</option>
							                          				<option value="OCTUBRE">OCTUBRE</option>
							                          				<option value="NOVIEMBRE">NOVIEMBRE</option>
							                          				<option value="DICIEMBRE">DICIEMBRE</option>
							                     				</select>
															</div>
														</div>
													</div>
													<!--Cosecha-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbCosecha_temporadas_cultivos_crm">Cosecha</label>
															</div>
															<div class="col-md-12">
																<select class="form-control" id="cmbCosecha_temporadas_cultivos_crm" 
																 		name="strCosecha_temporadas_cultivos_crm" tabindex="1">
							                          				<option value="ENERO">ENERO</option>
							                          				<option value="FEBRERO">FEBRERO</option>
							                          				<option value="MARZO">MARZO</option>
							                          				<option value="ABRIL">ABRIL</option>
							                          				<option value="MAYO">MAYO</option>
							                          				<option value="JUNIO">JUNIO</option>
							                          				<option value="JULIO">JULIO</option>
							                          				<option value="AGOSTO">AGOSTO</option>
							                          				<option value="SEPTIEMBRE">SEPTIEMBRE</option>
							                          				<option value="OCTUBRE">OCTUBRE</option>
							                          				<option value="NOVIEMBRE">NOVIEMBRE</option>
							                          				<option value="DICIEMBRE">DICIEMBRE</option>
							                     				</select>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns" 
					                                			id="btnAgregar_cultivos_crm"
					                                			onclick="agregar_renglon_temporadas_cultivos_crm();" 
					                                	     	title="Agregar" tabindex="1"> 
					                                		<span class="glyphicon glyphicon-plus"></span>
					                                	</button>
					                             	</div>
												</div>
											</div>
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row ">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_temporadas_cultivos_crm">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Siembra</th>
																<th class="movil">Cosecha</th>
																<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
													</table>
													<br>
													<div class="row">
														<!--Número de registros encontrados-->
														<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
															<button class="btn btn-default btn-sm disabled pull-right">
																<strong id="numElementos_temporadas_cultivos_crm">0</strong> encontrados
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_cultivos_crm"  
									onclick="validar_cultivos_crm();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_cultivos_crm"  
									onclick="cambiar_estatus_cultivos_crm('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_cultivos_crm"  
									onclick="cambiar_estatus_cultivos_crm('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cultivos_crm"
									type="reset" aria-hidden="true" onclick="cerrar_cultivos_crm();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#CultivosCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaCultivosCRM = 0;
		var strUltimaBusquedaCultivosCRM = "";
		//Variable que se utiliza para asignar objeto del modal
		var objCultivosCRM = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_cultivos_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/cultivos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_cultivos_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCultivosCRM = data.row;
					//Separar la cadena 
					var arrPermisosCultivosCRM = strPermisosCultivosCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCultivosCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCultivosCRM[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_cultivos_crm').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosCultivosCRM[i]=='GUARDAR') || (arrPermisosCultivosCRM[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_cultivos_crm').removeAttr('disabled');
						}
						else if(arrPermisosCultivosCRM[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_cultivos_crm').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_cultivos_crm();
						}
						else if(arrPermisosCultivosCRM[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_cultivos_crm').removeAttr('disabled');
							$('#btnRestaurar_cultivos_crm').removeAttr('disabled');
						}
						else if(arrPermisosCultivosCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_cultivos_crm').removeAttr('disabled');
						}
						else if(arrPermisosCultivosCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_cultivos_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_cultivos_crm() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_cultivos_crm').val() != strUltimaBusquedaCultivosCRM)
			{
				intPaginaCultivosCRM = 0;
				strUltimaBusquedaCultivosCRM = $('#txtBusqueda_cultivos_crm').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('crm/cultivos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_cultivos_crm').val(),
						intPagina:intPaginaCultivosCRM,
						strPermisosAcceso: $('#txtAcciones_cultivos_crm').val()
					},
					function(data){
						$('#dg_cultivos_crm tbody').empty();
						var tmpCultivosCRM = Mustache.render($('#plantilla_cultivos_crm').html(),data);
						$('#dg_cultivos_crm tbody').html(tmpCultivosCRM);
						$('#pagLinks_cultivos_crm').html(data.paginacion);
						$('#numElementos_cultivos_crm').html(data.total_rows);
						intPaginaCultivosCRM = data.pagina;
					},
			'json');
		}

		
		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_cultivos_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/cultivos/';

			//Si el tipo de reporte es PDF
			if(strTipo == 'PDF')
			{
				//Concatenar nombre de la función que genera el reporte PDF
				strUrl += 'get_reporte';
			}
			else
			{
				//Concatenar nombre de la función que genera el archivo XLS
				strUrl += "get_xls";
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'strBusqueda': $('#txtBusqueda_cultivos_crm').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_cultivos_crm()
		{
			//Incializar formulario
			$('#frmCultivosCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cultivos_crm();
			//Limpiar cajas de texto ocultas
			$('#frmCultivosCRM').find('input[type=hidden]').val('');
			//Eliminar los datos de la tabla temporadas del cultivo
			$('#dg_temporadas_cultivos_crm tbody').empty();
			$('#numElementos_temporadas_cultivos_crm').html(0);
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cultivos_crm');
			//Habilitar todos los elementos del formulario
			$('#frmCultivosCRM').find('input, textarea, select').removeAttr('disabled','disabled');
			//Habilitar botón Agregar
			$('#btnAgregar_cultivos_crm').prop('disabled', false);
			//Mostrar botón Guardar
			$("#btnGuardar_cultivos_crm").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_cultivos_crm").hide();
			$("#btnRestaurar_cultivos_crm").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_cultivos_crm()
		{
			try {
				//Cerrar modal
				objCultivosCRM.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_cultivos_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cultivos_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cultivos_crm();
			//Validación del formulario de campos obligatorios
			$('#frmCultivosCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_cultivos_crm: {
											validators: {
												notEmpty: {message: 'Escriba un cultivo'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cultivos_crm = $('#frmCultivosCRM').data('bootstrapValidator');
			bootstrapValidator_cultivos_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cultivos_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_cultivos_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cultivos_crm()
		{
			try
			{
				$('#frmCultivosCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_cultivos_crm()
		{
			//Obtenemos el objeto de la tabla temporadas
			var objTabla = document.getElementById('dg_temporadas_cultivos_crm').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrSiembras = [];
			var arrCosechas = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				
				//Asignar valores a los arrays
				arrSiembras.push(objRen.getAttribute('id'));
				arrCosechas.push(objRen.cells[1].innerHTML);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/cultivos/guardar',
					{ 
						//Datos del cultivo
						intCultivoID: $('#txtCultivoID_cultivos_crm').val(),
						strDescripcion: $('#txtDescripcion_cultivos_crm').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_cultivos_crm').val(),
						//Datos de las temporadas
						strSiembras: arrSiembras.join('|'),
						strCosechas: arrCosechas.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_cultivos_crm();
							//Hacer un llamado a la función para cerrar modal
							cerrar_cultivos_crm();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cultivos_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cultivos_crm(tipoMensaje, mensaje)
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
		function cambiar_estatus_cultivos_crm(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCultivoID_cultivos_crm').val();

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
				              'title':    'Cultivos',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_cultivos_crm(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_cultivos_crm(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_cultivos_crm(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('crm/cultivos/set_estatus',
			      {intCultivoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_cultivos_crm();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cultivos_crm();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_cultivos_crm(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_cultivos_crm(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/cultivos/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cultivos_crm();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				            
				          	//Recuperar valores
				            $('#txtCultivoID_cultivos_crm').val(data.row.cultivo_id);
				            $('#txtDescripcion_cultivos_crm').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_cultivos_crm').val(data.row.descripcion);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_cultivos_crm').addClass("estatus-"+strEstatus);
				            

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_cultivos_crm").show();
				            	//Habilitar botón Agregar 
				            	$('#btnAgregar_cultivos_crm').prop('disabled', false);

				            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_temporadas_cultivos_crm(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_temporadas_cultivos_crm(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				            	
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmCultivosCRM').find('input, textarea, select').attr('disabled','disabled');
			            		//Deshabilitar el boton 
			            		$('#btnAgregar_cultivos_crm').prop('disabled', true);
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_cultivos_crm").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_cultivos_crm").show();
							}


				            //Mostramos las temporadas del registro
				            for (var intCon in data.temporadas) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_temporadas_cultivos_crm').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaSiembra = objRenglon.insertCell(0);
								var objCeldaCosecha = objRenglon.insertCell(1);
								var objCeldaAcciones = objRenglon.insertCell(2);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.temporadas[intCon].siembra);
								objCeldaSiembra.setAttribute('class', 'movil b1');
								objCeldaSiembra.innerHTML = data.temporadas[intCon].siembra;
								objCeldaCosecha.setAttribute('class', 'movil b2');
								objCeldaCosecha.innerHTML = data.temporadas[intCon].cosecha;
								objCeldaAcciones.setAttribute('class', 'td-center movil b3');
								objCeldaAcciones.innerHTML = strAccionesTabla;
							
							}

							//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_temporadas_cultivos_crm tr").length - 1;
							$('#numElementos_temporadas_cultivos_crm').html(intFilas);

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objCultivosCRM = $('#CultivosCRMBox').bPopup({
															  appendTo: '#CultivosCRMContent', 
								                              contentContainer: 'CultivosCRMM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_cultivos_crm').focus();
					        }
			       	    }
			       },
			       'json');
		}

		/*******************************************************************************************************************
		Funciones de la tabla temporadas
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_temporadas_cultivos_crm()
		{
			//Obtenemos los datos de las cajas de texto
			var strSiembra = $('#cmbSiembra_temporadas_cultivos_crm').val();
			var strCosecha = $('#cmbCosecha_temporadas_cultivos_crm').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_temporadas_cultivos_crm').getElementsByTagName('tbody')[0];

			//Limpiamos los combobox
			$('#cmbSiembra_temporadas_cultivos_crm').val('ENERO');
			$('#cmbCosecha_temporadas_cultivos_crm').val('ENERO')

			//Revisamos si existe la siembra proporcionada, si es así, editamos los datos
			if (objTabla.rows.namedItem(strSiembra))
			{
				objTabla.rows.namedItem(strSiembra).cells[1].innerHTML = strCosecha;
			}
			else
			{
				//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaSiembra = objRenglon.insertCell(0);
				var objCeldaCosecha = objRenglon.insertCell(1);
				var objCeldaAcciones = objRenglon.insertCell(2);

				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', strSiembra);
				objCeldaSiembra.setAttribute('class', 'movil b1');
				objCeldaSiembra.innerHTML = strSiembra;
				objCeldaCosecha.setAttribute('class', 'movil b2');
				objCeldaCosecha.innerHTML = strCosecha;
				objCeldaAcciones.setAttribute('class', 'td-center movil b3');
				objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_temporadas_cultivos_crm(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
											 " onclick='eliminar_renglon_temporadas_cultivos_crm(this)'>" + 
											 "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
			}

			//Enfocar combobox
			$('#cmbSiembra_temporadas_cultivos_crm').focus();

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_temporadas_cultivos_crm tr").length - 1;
			$('#numElementos_temporadas_cultivos_crm').html(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_temporadas_cultivos_crm(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#cmbSiembra_temporadas_cultivos_crm').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#cmbCosecha_temporadas_cultivos_crm').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);

			//Enfocar combobox
			$('#cmbSiembra_temporadas_cultivos_crm').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_temporadas_cultivos_crm(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_temporadas_cultivos_crm").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_temporadas_cultivos_crm tr").length - 1;
			$('#numElementos_temporadas_cultivos_crm').html(intFilas);

			//Enfocar caja de texto
			$('#cmbSiembra_temporadas_cultivos_crm').focus();
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Comprobar la existencia de la descripción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_cultivos_crm').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtCultivoID_cultivos_crm').val() == '' && $('#txtDescripcion_cultivos_crm').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_cultivos_crm($('#txtDescripcion_cultivos_crm').val(), 'descripcion', 'Nuevo');
				}
			});

			//Enfocar al control (combobox) cosecha cuando cambie la opción del combobox
			$('#cmbSiembra_temporadas_cultivos_crm').change(function(e){
	            
	            //Enfocar combobox
	            $('#cmbCosecha_temporadas_cultivos_crm').focus();

	        });

	        //Enfocar al botón Agregar cuando cambie la opción del combobox
	        $('#cmbCosecha_temporadas_cultivos_crm').change(function(e){   
	            
	           	//Enfocar botón Agregar
	            $('#btnAgregar_cultivos_crm').focus();
			    
	        });

			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_temporadas_cultivos_crm').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Pasar al renglón de arriba
	            	row.prev().before(row);
	            }
				
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_cultivos_crm').on('click','a',function(event){
				event.preventDefault();
				intPaginaCultivosCRM = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_cultivos_crm();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_cultivos_crm').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_cultivos_crm();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_cultivos_crm').addClass("estatus-NUEVO");
				//Abrir modal
				 objCultivosCRM = $('#CultivosCRMBox').bPopup({
											   appendTo: '#CultivosCRMContent', 
				                               contentContainer: 'CultivosCRMM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_cultivos_crm').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_cultivos_crm').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_cultivos_crm();
		});
	</script>