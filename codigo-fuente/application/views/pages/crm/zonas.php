	<div id="ZonasCRMContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_zonas_crm" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_zonas_crm" 
								   name="strBusqueda_zonas_crm"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_zonas_crm"
										onclick="paginacion_zonas_crm();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_zonas_crm" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_zonas_crm"
									onclick="reporte_zonas_crm('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_zonas_crm"
									onclick="reporte_zonas_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(2):before {content: "Zona"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Vendedor"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_zonas_crm">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Módulo</th>
							<th class="movil">Zona</th>
							<th class="movil">Vendedor</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_zonas_crm" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{modulo}}</td>
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{vendedor}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_zonas_crm({{zona_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_zonas_crm({{zona_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_zonas_crm({{zona_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_zonas_crm({{zona_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_zonas_crm"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_zonas_crm">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ZonasCRMBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_zonas_crm"  class="ModalBodyTitle">
			<h1>Zonas</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmZonasCRM" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmZonasCRM"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Autocomplete que contiene los módulos activos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtZonaID_zonas_crm" 
										   name="intZonaID_zonas_crm" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
									<input id="txtModuloID_zonas_crm" 
										   name="intModuloID_zonas_crm"  type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el módulo anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción en el módulo-->
									<input id="txtModuloIDAnterior_zonas_crm" 
										   name="intModuloIDAnterior_zonas_crm" type="hidden" value="">
									</input>
									<label for="txtModulo_zonas_crm">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModulo_zonas_crm" 
											name="strModulo_zonas_crm" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					    <!--Descripción-->
						<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción en el módulo-->
									<input id="txtDescripcionAnterior_zonas_crm" name="strDescripcionAnterior_zonas_crm" type="hidden" value="">
									</input>
									<label for="txtDescripcion_zonas_crm">Zona</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_zonas_crm" 
											name="strDescripcion_zonas_crm" type="text" value="" 
											tabindex="1" placeholder="Ingrese zona" maxlength="50">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Autocomplete que contiene los vendedores activos-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del vendedor seleccionado-->
									<input id="txtVendedorID_zonas_crm" name="intVendedorID_zonas_crm"  
										   type="hidden" value="">
									</input>
									<label for="txtVendedor_zonas_crm">Vendedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtVendedor_zonas_crm" 
											name="strVendedor_zonas_crm" type="text" value="" tabindex="1" placeholder="Ingrese vendedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Botón seleccionar localidades-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbLocalidades_zonas_crm">
										Agregar o quitar localidades
									</label>
								</div>
								<div class="col-md-12">
									<label for="chbLocalidades_zonas_crm" class="btn btn-info">
										Seleccionar todas
										<input type="checkbox" id="chbLocalidades_zonas_crm" 
											   class="badgebox" tabindex="1">
										</input>
										<span title="Seleccionar o deseleccionar todos los permisos de acceso"
											  class="badge">
											&check;
										</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta para asignar las localidades de la zona--> 
									<input id="txtLocalidades_zonas_crm"  name="strLocalidades_zonas_crm" 
										   type="hidden"  value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Localidades que integran la zona</h4>
										</div>
										<div class="panel-body">
											<div id="treeLocalidades_zonas_crm" class="md-list-item-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_zonas_crm" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 	
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_zonas_crm"  
									onclick="validar_zonas_crm();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_zonas_crm"  
									onclick="cambiar_estatus_zonas_crm('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_zonas_crm"  
									onclick="cambiar_estatus_zonas_crm('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_zonas_crm"
									type="reset" aria-hidden="true" onclick="cerrar_zonas_crm();" 
									title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ZonasCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaZonasCRM = 0;
		var strUltimaBusquedaZonasCRM = "";
		//Variable que se utiliza para asignar objeto del modal
		var objZonasCRM = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_zonas_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/zonas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_zonas_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosZonasCRM = data.row;
					//Separar la cadena 
					var arrPermisosZonasCRM = strPermisosZonasCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosZonasCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosZonasCRM[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_zonas_crm').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosZonasCRM[i]=='GUARDAR') || (arrPermisosZonasCRM[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_zonas_crm').removeAttr('disabled');
						}
						else if(arrPermisosZonasCRM[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_zonas_crm').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_zonas_crm();
						}
						else if(arrPermisosZonasCRM[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_zonas_crm').removeAttr('disabled');
							$('#btnRestaurar_zonas_crm').removeAttr('disabled');
						}
						else if(arrPermisosZonasCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_zonas_crm').removeAttr('disabled');
						}
						else if(arrPermisosZonasCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_zonas_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_zonas_crm() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_zonas_crm').val() != strUltimaBusquedaZonasCRM)
			{
				intPaginaZonasCRM = 0;
				strUltimaBusquedaZonasCRM = $('#txtBusqueda_zonas_crm').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('crm/zonas/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_zonas_crm').val(),
						intPagina:intPaginaZonasCRM,
						strPermisosAcceso: $('#txtAcciones_zonas_crm').val()
					},
					function(data){
						$('#dg_zonas_crm tbody').empty();
						var tmpZonasCRM = Mustache.render($('#plantilla_zonas_crm').html(),data);
						$('#dg_zonas_crm tbody').html(tmpZonasCRM);
						$('#pagLinks_zonas_crm').html(data.paginacion);
						$('#numElementos_zonas_crm').html(data.total_rows);
						intPaginaZonasCRM = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_zonas_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/zonas/';

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
										'strBusqueda': $('#txtBusqueda_zonas_crm').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_zonas_crm()
		{
			//Incializar formulario
			$('#frmZonasCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_zonas_crm();
			//Limpiar cajas de texto ocultas
			$('#frmZonasCRM').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_zonas_crm');
			//Habilitar todos los elementos del formulario
			$('#frmZonasCRM').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_zonas_crm").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_zonas_crm").hide();
			$("#btnRestaurar_zonas_crm").hide();
		}

		//Función para inicializar elementos del módulo
		function inicializar_modulo_zonas_crm()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtVendedorID_zonas_crm').val('');
			$('#txtVendedor_zonas_crm').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_zonas_crm()
		{
			try {
				//Cerrar modal
				objZonasCRM.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_zonas_crm();
				//Eliminar datos del treeview
				$("#treeLocalidades_zonas_crm").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtBusqueda_zonas_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_zonas_crm()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosZonasCRM = [];

			//Recorremos el treeview
			$("#treeLocalidades_zonas_crm").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosZonasCRM.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtLocalidades_zonas_crm").val(arrSeleccionadosZonasCRM.join('|'));

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_zonas_crm();
			//Validación del formulario de campos obligatorios
			$('#frmZonasCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strModulo_zonas_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del módulo
					                                    if($('#txtModuloID_zonas_crm').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un módulo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strDescripcion_zonas_crm: {
											validators: {
												notEmpty: {message: 'Escriba una zona'}
											}
										},
										strVendedor_zonas_crm: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vendedor
					                                    if($('#txtVendedorID_zonas_crm').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un vendedor existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strLocalidades_zonas_crm: {
											validators: {
												notEmpty: {message: 'Seleccione al menos una localidad para esta zona.'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_zonas_crm = $('#frmZonasCRM').data('bootstrapValidator');
			bootstrapValidator_zonas_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_zonas_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_zonas_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_zonas_crm()
		{
			try
			{
				$('#frmZonasCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_zonas_crm()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_zonas_crm();
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/zonas/guardar',
					{ 
						//Datos de la zona
						intZonaID: $('#txtZonaID_zonas_crm').val(),
						strDescripcion: $('#txtDescripcion_zonas_crm').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_zonas_crm').val(),
						intModuloID: $('#txtModuloID_zonas_crm').val(),
						intModuloIDAnterior: $('#txtModuloIDAnterior_zonas_crm').val(),
						intVendedorID: $('#txtVendedorID_zonas_crm').val(),
						//Datos de las localidades
						strLocalidades:$('#txtLocalidades_zonas_crm').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_zonas_crm();
							//Hacer un llamado a la función para cerrar modal
							cerrar_zonas_crm();                
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_zonas_crm();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_zonas_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_zonas_crm(tipoMensaje, mensaje)
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
		function cambiar_estatus_zonas_crm(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtZonaID_zonas_crm').val();

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
				              'title':    'Zonas',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_zonas_crm(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_zonas_crm(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_zonas_crm(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('crm/zonas/set_estatus',
			      {intZonaID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_zonas_crm();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_zonas_crm();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_zonas_crm(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_zonas_crm(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/zonas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_zonas_crm();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtZonaID_zonas_crm').val(data.row.zona_id);
				            $('#txtModuloID_zonas_crm').val(data.row.modulo_id);
						    $('#txtModuloIDAnterior_zonas_crm').val(data.row.modulo_id);
						    $('#txtModulo_zonas_crm').val(data.row.modulo);
				            $('#txtDescripcion_zonas_crm').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_zonas_crm').val(data.row.descripcion);
				            $('#txtVendedorID_zonas_crm').val(data.row.vendedor_id);
				            $('#txtVendedor_zonas_crm').val(data.row.vendedor);
						    //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_zonas_crm').addClass("estatus-"+strEstatus);
						   
						    //Si el tipo de acción corresponde a Nuevo
						    if(tipoAccion == 'Nuevo')
						    {
						    	//Eliminar datos del treeview
								$("#treeLocalidades_zonas_crm").fancytree("destroy");
						    }
						    //Cargar el treeview
						    get_treeview_localidades_zonas_crm();
				         
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_zonas_crm").show();
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmZonasCRM').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_zonas_crm").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_zonas_crm").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objZonasCRM = $('#ZonasCRMBox').bPopup({
															  appendTo: '#ZonasCRMContent', 
								                              contentContainer: 'ZonasCRMM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtModulo_zonas_crm').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Función que se utiliza para definir tree view de localidades, municipios, estados y países
		function get_treeview_localidades_zonas_crm()
		{
			//Variable que se utiliza para asignar el id de la zona
			var intZonaIDZonasCRM = 0;
			
			//Si existe id de la zona
			if($('#txtZonaID_zonas_crm').val() != '')
			{
				intZonaIDZonasCRM = $('#txtZonaID_zonas_crm').val();
			}

			$('#treeLocalidades_zonas_crm').fancytree({
				source: {
					url: "crm/localidades/get_treeview/Zona/" + intZonaIDZonasCRM+'/'+ $('#txtModuloID_zonas_crm').val(),
					cache: false
				},
				checkbox: true,
				selectMode: 3
			});
		}


		//Función para verificar la existencia de un registro
		function verificar_existencia_zonas_crm()
		{
			//Si no existe id, verificar la existencia de la descripción
			if ($('#txtZonaID_zonas_crm').val() == '' && $('#txtModuloID_zonas_crm').val() != '' && 
				$('#txtDescripcion_zonas_crm').val() != '')
			{
				//Concatenar criterios de búsqueda (para poder verificar la existencia de la descripción en el módulo)
				var strCriteriosBusqZonasCRM = $('#txtModuloID_zonas_crm').val()+'|'+$('#txtDescripcion_zonas_crm').val();
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
				editar_zonas_crm(strCriteriosBusqZonasCRM, 'descripcion', 'Nuevo');
			}

		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_zonas_crm()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_zonas_crm").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_zonas_crm()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_zonas_crm").addClass('no-mostrar');
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Comprobar la existencia de la descripción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_zonas_crm').focusout(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_zonas_crm();
			});

			//Autocomplete para recuperar los datos de un módulo 
	        $('#txtModulo_zonas_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloID_zonas_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del módulo
	               inicializar_modulo_zonas_crm();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/modulos/autocomplete",
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
		            $('#txtModuloID_zonas_crm').val(ui.item.data);
		         	//Hacer un llamado a la función para verificar la existencia del registro
					verificar_existencia_zonas_crm();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del módulo cuando pierda el enfoque la caja de texto
	        $('#txtModulo_zonas_crm').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloID_zonas_crm').val() == '' ||
	               $('#txtModulo_zonas_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtModuloID_zonas_crm').val('');
	               $('#txtModulo_zonas_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del módulo
	               inicializar_modulo_zonas_crm();
	               
	            }
	            
	        });

			//Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_zonas_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_zonas_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: $('#txtModuloID_zonas_crm').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	           	 //Recortar el nombre de vendedor y modulo
	           	 ui.item.value = ui.item.value.split(' MOD')[0];
	             //Asignar id del registro seleccionado	    	             	             
	             $('#txtVendedorID_zonas_crm').val(ui.item.data);
	             $('#txtModulo_zonas_crm').val(ui.item.modulo);
	             $('#txtModuloID_zonas_crm').val(ui.item.modulo_id);	              
	             $("#txtVendedor_zonas_crm").val(ui.item.value);
	             //Hacer un llamado a la función para verificar la existencia del registro
				 verificar_existencia_zonas_crm();	
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vendedor cuando pierda el enfoque la caja de texto
	        $('#txtVendedor_zonas_crm').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_zonas_crm').val() == '' ||
	               $('#txtVendedor_zonas_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_zonas_crm').val('');
	               $('#txtVendedor_zonas_crm').val('');
	            }
	            
	        });

	        //Seleccionar o deseleccionar todos los nodos del tree view (árbol) cuando se de clic en el checkbox
			$('#chbLocalidades_zonas_crm').click(function(event) {
				//Si el checkbox se encuentra seleccionado
				if( $('#chbLocalidades_zonas_crm').is(':checked') ) {
					$("#treeLocalidades_zonas_crm").fancytree("getTree").visit(function(node){
						node.setSelected(true);
					});
				}
				else
				{
					$("#treeLocalidades_zonas_crm").fancytree("getTree").visit(function(node){
						node.setSelected(false);
					});
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_zonas_crm').on('click','a',function(event){
				event.preventDefault();
				intPaginaZonasCRM = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_zonas_crm();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_zonas_crm').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_zonas_crm();
				//Cargar el treeview
			    get_treeview_localidades_zonas_crm();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_zonas_crm').addClass("estatus-NUEVO");
				//Abrir modal
				 objZonasCRM = $('#ZonasCRMBox').bPopup({
											   appendTo: '#ZonasCRMContent', 
				                               contentContainer: 'ZonasCRMM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtModulo_zonas_crm').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_zonas_crm').focus();			
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_zonas_crm();
		});
	</script>