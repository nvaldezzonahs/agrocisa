	<div id="SatTasaCuotaContabilidadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_sat_tasa_cuota_contabilidad" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_sat_tasa_cuota_contabilidad" 
								   name="strBusqueda_sat_tasa_cuota_contabilidad"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_sat_tasa_cuota_contabilidad"
										onclick="paginacion_sat_tasa_cuota_contabilidad();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_sat_tasa_cuota_contabilidad" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_sat_tasa_cuota_contabilidad"
									onclick="reporte_sat_tasa_cuota_contabilidad('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_sat_tasa_cuota_contabilidad"
									onclick="reporte_sat_tasa_cuota_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Tipo"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Valor mínimo"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Valor máximo"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Impuesto"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Factor"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_sat_tasa_cuota_contabilidad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Tipo</th>
							<th class="movil">Valor mínimo</th>
							<th class="movil">Valor máximo</th>
							<th class="movil">Impuesto</th>
							<th class="movil">Factor</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_sat_tasa_cuota_contabilidad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{tipo}}</td>
							<td class="movil">{{valor_minimo}}</td>
							<td class="movil">{{valor_maximo}}</td>
							<td class="movil">{{impuesto}}</td>
							<td class="movil">{{factor}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_sat_tasa_cuota_contabilidad({{tasa_cuota_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_sat_tasa_cuota_contabilidad({{tasa_cuota_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_sat_tasa_cuota_contabilidad({{tasa_cuota_id}},'{{estatus}}')"
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_sat_tasa_cuota_contabilidad({{tasa_cuota_id}},'{{estatus}}')"
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_sat_tasa_cuota_contabilidad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_sat_tasa_cuota_contabilidad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="SatTasaCuotaContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_sat_tasa_cuota_contabilidad"  class="ModalBodyTitle">
			<h1>Tasas o Cuotas</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmSatTasaCuotaContabilidad" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmSatTasaCuotaContabilidad" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					   <!--Autocomplete que contiene los impuestos activos-->
					   <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtTasaCuotaID_sat_tasa_cuota_contabilidad" 
										   name="intTasaCuotaID_sat_tasa_cuota_contabilidad" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el id de la forma de pago seleccionada-->
									<input id="txtImpuestoID_sat_tasa_cuota_contabilidad" 
										   name="intImpuestoID_sat_tasa_cuota_contabilidad" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el impuesto anterior y así evitar duplicidad en caso de que exista otro registro con la mismo impuesto, tipo y valor máximo -->
									<input id="txtImpuestoIDAnterior_sat_tasa_cuota_contabilidad" 
										   name="intImpuestoIDAnterior_sat_tasa_cuota_contabilidad" type="hidden" value="">
									</input>
									<label for="txtImpuesto_sat_tasa_cuota_contabilidad">
										Impuesto
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtImpuesto_sat_tasa_cuota_contabilidad" 
											name="strImpuesto_sat_tasa_cuota_contabilidad" type="text" value=""  
											tabindex="1" placeholder="Ingrese impuesto" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Factor-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbFactor_sat_tasa_cuota_contabilidad">Factor</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbFactor_sat_tasa_cuota_contabilidad"
											name="strFactor_sat_tasa_cuota_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="Tasa">TASA</option>
                          				<option value="Cuota">CUOTA</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Traslado-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTraslado_sat_tasa_cuota_contabilidad">Traslado</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTraslado_sat_tasa_cuota_contabilidad"
											name="strTraslado_sat_tasa_cuota_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="SI">SI</option>
                          				<option value="NO">NO</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Retención-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbRetencion_sat_tasa_cuota_contabilidad">Retención</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbRetencion_sat_tasa_cuota_contabilidad"
											name="strRetencion_sat_tasa_cuota_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="SI">SI</option>
                          				<option value="NO">NO</option>
                     				</select>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Tipo-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el tipo anterior y así evitar duplicidad en caso de que exista otro registro con la mismo impuesto, tipo y valor máximo -->
									<input id="txtTipoAnterior_sat_tasa_cuota_contabilidad" 
										   name="strTipoAnterior_sat_tasa_cuota_contabilidad" type="hidden" value="">
									</input>
									<label for="cmbTipo_sat_tasa_cuota_contabilidad">Tipo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipo_sat_tasa_cuota_contabilidad"
											name="strTipo_sat_tasa_cuota_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="FIJO">FIJO</option>
                          				<option value="RANGO">RANGO</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Valor mínimo-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtValorMinimo_sat_tasa_cuota_contabilidad">Valor mínimo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control moneda_sat_tasa_cuota_contabilidad" id="txtValorMinimo_sat_tasa_cuota_contabilidad" 
											name="intValorMinimo_sat_tasa_cuota_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese valor mínimo" maxlength="15">
									</input>
								</div>
							</div>
						</div>
						<!--Valor máximo-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el valor máximo anterior y así evitar duplicidad en caso de que exista otro registro con la mismo impuesto, tipo y valor máximo -->
									<input id="txtValorMaximoAnterior_sat_tasa_cuota_contabilidad" 
										   name="intValorMaximoAnterior_sat_tasa_cuota_contabilidad" type="hidden" value="">
									</input>
									<label for="txtValorMaximo_sat_tasa_cuota_contabilidad">Valor máximo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control moneda_sat_tasa_cuota_contabilidad" id="txtValorMaximo_sat_tasa_cuota_contabilidad" 
											name="intValorMaximo_sat_tasa_cuota_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese valor máximo" maxlength="15">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_sat_tasa_cuota_contabilidad"  
									onclick="validar_sat_tasa_cuota_contabilidad();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_sat_tasa_cuota_contabilidad"  
									onclick="cambiar_estatus_sat_tasa_cuota_contabilidad('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_sat_tasa_cuota_contabilidad"  
									onclick="cambiar_estatus_sat_tasa_cuota_contabilidad('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_sat_tasa_cuota_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_sat_tasa_cuota_contabilidad();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#SatTasaCuotaContabilidadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaSatTasaCuotaContabilidad = 0;
		var strUltimaBusquedaSatTasaCuotaContabilidad = "";
		//Variable que se utiliza para asignar objeto del modal
		var objSatTasaCuotaContabilidad = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_sat_tasa_cuota_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/sat_tasa_cuota/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_sat_tasa_cuota_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosSatTasaCuotaContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosSatTasaCuotaContabilidad = strPermisosSatTasaCuotaContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosSatTasaCuotaContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosSatTasaCuotaContabilidad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_sat_tasa_cuota_contabilidad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosSatTasaCuotaContabilidad[i]=='GUARDAR') || (arrPermisosSatTasaCuotaContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_sat_tasa_cuota_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatTasaCuotaContabilidad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_sat_tasa_cuota_contabilidad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_sat_tasa_cuota_contabilidad();
						}
						else if(arrPermisosSatTasaCuotaContabilidad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_sat_tasa_cuota_contabilidad').removeAttr('disabled');
							$('#btnRestaurar_sat_tasa_cuota_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatTasaCuotaContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_sat_tasa_cuota_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosSatTasaCuotaContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_sat_tasa_cuota_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_sat_tasa_cuota_contabilidad() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_sat_tasa_cuota_contabilidad').val() != strUltimaBusquedaSatTasaCuotaContabilidad)
			{
				intPaginaSatTasaCuotaContabilidad = 0;
				strUltimaBusquedaSatTasaCuotaContabilidad = $('#txtBusqueda_sat_tasa_cuota_contabilidad').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('contabilidad/sat_tasa_cuota/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_sat_tasa_cuota_contabilidad').val(),
						intPagina:intPaginaSatTasaCuotaContabilidad,
						strPermisosAcceso: $('#txtAcciones_sat_tasa_cuota_contabilidad').val()
					},
					function(data){
						$('#dg_sat_tasa_cuota_contabilidad tbody').empty();
						var tmpSatTasaCuotaContabilidad = Mustache.render($('#plantilla_sat_tasa_cuota_contabilidad').html(),data);
						$('#dg_sat_tasa_cuota_contabilidad tbody').html(tmpSatTasaCuotaContabilidad);
						$('#pagLinks_sat_tasa_cuota_contabilidad').html(data.paginacion);
						$('#numElementos_sat_tasa_cuota_contabilidad').html(data.total_rows);
						intPaginaSatTasaCuotaContabilidad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_sat_tasa_cuota_contabilidad(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/sat_tasa_cuota/';

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
										'strBusqueda': $('#txtBusqueda_sat_tasa_cuota_contabilidad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}



		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_sat_tasa_cuota_contabilidad()
		{
			//Incializar formulario
			$('#frmSatTasaCuotaContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sat_tasa_cuota_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmSatTasaCuotaContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_sat_tasa_cuota_contabilidad');
			//Habilitar todos los elementos del formulario
			$('#frmSatTasaCuotaContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar caja de texto
			$('#txtValorMinimo_sat_tasa_cuota_contabilidad').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_sat_tasa_cuota_contabilidad").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_sat_tasa_cuota_contabilidad").hide();
			$("#btnRestaurar_sat_tasa_cuota_contabilidad").hide();
		}
		

		//Función para inicializar elementos del impuesto
		function inicializar_impuesto_sat_tasa_cuota_contabilidad()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#cmbTraslado_sat_tasa_cuota_contabilidad').val('');
	        $('#cmbRetencion_sat_tasa_cuota_contabilidad').val('');
		}


		//Función que se utiliza para cerrar el modal
		function cerrar_sat_tasa_cuota_contabilidad()
		{
			try {
				//Cerrar modal
				objSatTasaCuotaContabilidad.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_sat_tasa_cuota_contabilidad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_sat_tasa_cuota_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sat_tasa_cuota_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmSatTasaCuotaContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strImpuesto_sat_tasa_cuota_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del impuesto
					                                    if($('#txtImpuestoID_sat_tasa_cuota_contabilidad').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un impuesto existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}, 
										strFactor_sat_tasa_cuota_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione un factor'}
											}
										},
										strTraslado_sat_tasa_cuota_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione un traslado'}
											}
										},
										strRetencion_sat_tasa_cuota_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una retención'}
											}
										},
										strTipo_sat_tasa_cuota_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										},
										intValorMinimo_sat_tasa_cuota_contabilidad: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                  	//Verificar que exista valor mínimo
					                                  	if($('#cmbTipo_sat_tasa_cuota_contabilidad').val() == 'RANGO')
					                                  	{
					                                  		var intValorMinimo = parseFloat($.reemplazar(value, ",", ""));
					                                  		var intValorMaximo = parseFloat($.reemplazar($('#txtValorMaximo_sat_tasa_cuota_contabilidad').val(), ",", ""));

					                                  		//Si no existe valor mínimo
						                                    if(value == '')
						                                    {
					                                      		return {
					                                               valid: false,
					                                               message: 'Escriba un valor'
					                                            };
						                                    }
															else if(intValorMinimo > 100)//Verificar que el valor mínimo no sea mayor que 100
															{
																return {
															       valid: false,
															       message: 'El valor no debe ser mayor que 100'
															 	};
															}
															else if(intValorMinimo > intValorMaximo)
															{
																return {
															       valid: false,
															       message: 'El valor mínimo no debe ser mayor que el valor máximo'
															 	};
															}
					                                  	}
					                                      
					                                    return true;
					                                  }
					                            }
											}
										},
										intValorMaximo_sat_tasa_cuota_contabilidad: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                  	var intValorMaximo = parseFloat($.reemplazar(value, ",", ""));
					                                  	var intValorMinimo = parseFloat($.reemplazar($('#txtValorMinimo_sat_tasa_cuota_contabilidad').val(), ",", ""));

					                                  	  //Si no existe valor máximo
					                                      if(value == '')
					                                      {
					                                      		return {
					                                               valid: false,
					                                               message: 'Escriba un valor'
					                                            };
					                                      }
					                                      else if(intValorMaximo > 100)//Verificar que el  valor máximo no sea mayor que 100
					                                      {
				                                      			return {
					                                               valid: false,
					                                               message: 'El valor no debe ser mayor que 100'
					                                            };
					                                      }
					                                      else if(intValorMinimo > intValorMaximo)
					                                      {
					                                      	    return {
															       valid: false,
															       message: 'El valor mínimo no debe ser mayor que el valor máximo'
															 	};
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_sat_tasa_cuota_contabilidad = $('#frmSatTasaCuotaContabilidad').data('bootstrapValidator');
			bootstrapValidator_sat_tasa_cuota_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_sat_tasa_cuota_contabilidad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_sat_tasa_cuota_contabilidad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_sat_tasa_cuota_contabilidad()
		{
			try
			{
				$('#frmSatTasaCuotaContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_sat_tasa_cuota_contabilidad()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('contabilidad/sat_tasa_cuota/guardar',
					{ 
						intTasaCuotaID: $('#txtTasaCuotaID_sat_tasa_cuota_contabilidad').val(),
						intImpuestoID: $('#txtImpuestoID_sat_tasa_cuota_contabilidad').val(),
						intImpuestoIDAnterior: $('#txtImpuestoIDAnterior_sat_tasa_cuota_contabilidad').val(),
						strTipo: $('#cmbTipo_sat_tasa_cuota_contabilidad').val(),
						strTipoAnterior: $('#txtTipoAnterior_sat_tasa_cuota_contabilidad').val(),
						strFactor: $('#cmbFactor_sat_tasa_cuota_contabilidad').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intValorMinimo: $.reemplazar($('#txtValorMinimo_sat_tasa_cuota_contabilidad').val(), ",", ""),
						intValorMaximo: $.reemplazar($('#txtValorMaximo_sat_tasa_cuota_contabilidad').val(), ",", ""),
						intValorMaximoAnterior: $.reemplazar($('#txtValorMaximoAnterior_sat_tasa_cuota_contabilidad').val(), ",", ""),
						strRetencion: $('#cmbRetencion_sat_tasa_cuota_contabilidad').val(),
						strTraslado: $('#cmbTraslado_sat_tasa_cuota_contabilidad').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_sat_tasa_cuota_contabilidad();
							//Hacer un llamado a la función para cerrar modal
							cerrar_sat_tasa_cuota_contabilidad();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_sat_tasa_cuota_contabilidad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_sat_tasa_cuota_contabilidad(tipoMensaje, mensaje)
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
		function cambiar_estatus_sat_tasa_cuota_contabilidad(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtTasaCuotaID_sat_tasa_cuota_contabilidad').val();

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
				              'title':    'Tasas o Cuotas',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                              	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_sat_tasa_cuota_contabilidad(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {	

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_sat_tasa_cuota_contabilidad(intID, strTipo, 'ACTIVO');

		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_sat_tasa_cuota_contabilidad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('contabilidad/sat_tasa_cuota/set_estatus',
			      {intTasaCuotaID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_sat_tasa_cuota_contabilidad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_sat_tasa_cuota_contabilidad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_sat_tasa_cuota_contabilidad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_sat_tasa_cuota_contabilidad(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/sat_tasa_cuota/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_sat_tasa_cuota_contabilidad();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtTasaCuotaID_sat_tasa_cuota_contabilidad').val(data.row.tasa_cuota_id);
				            $('#txtImpuestoID_sat_tasa_cuota_contabilidad').val(data.row.impuesto_id);
				            $('#txtImpuestoIDAnterior_sat_tasa_cuota_contabilidad').val(data.row.impuesto_id);
				            $('#txtImpuesto_sat_tasa_cuota_contabilidad').val(data.row.impuesto);
				            $('#cmbTipo_sat_tasa_cuota_contabilidad').val(data.row.tipo);
				            $('#txtTipoAnterior_sat_tasa_cuota_contabilidad').val(data.row.tipo);
				            $('#cmbFactor_sat_tasa_cuota_contabilidad').val(data.row.factor);
				            $('#txtValorMinimo_sat_tasa_cuota_contabilidad').val(data.row.valor_minimo);
				            $('#txtValorMaximo_sat_tasa_cuota_contabilidad').val(data.row.valor_maximo);
				            $('#txtValorMaximoAnterior_sat_tasa_cuota_contabilidad').val(data.row.valor_maximo);
				            $('#cmbRetencion_sat_tasa_cuota_contabilidad').val(data.row.retencion);
				            $('#cmbTraslado_sat_tasa_cuota_contabilidad').val(data.row.traslado);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_sat_tasa_cuota_contabilidad').addClass("estatus-"+strEstatus);
				            
				           	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_sat_tasa_cuota_contabilidad").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmSatTasaCuotaContabilidad').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_sat_tasa_cuota_contabilidad").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_sat_tasa_cuota_contabilidad").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objSatTasaCuotaContabilidad = $('#SatTasaCuotaContabilidadBox').bPopup({
															  appendTo: '#SatTasaCuotaContabilidadContent', 
								                              contentContainer: 'SatTasaCuotaContabilidadM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtImpuesto_sat_tasa_cuota_contabilidad').focus();
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
        	$('#txtValorMinimo_sat_tasa_cuota_contabilidad').numeric();
        	$('#txtValorMaximo_sat_tasa_cuota_contabilidad').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.000000*/
        	$('.moneda_sat_tasa_cuota_contabilidad').blur(function(){
				$('.moneda_sat_tasa_cuota_contabilidad').formatCurrency({ roundToDecimalPlace: 6 });
			});

        	
			//Comprobar la existencia del impuesto, tipo y valor máximo en la BD cuando pierda el enfoque la caja de texto
			$('#txtValorMaximo_sat_tasa_cuota_contabilidad').focusout(function(e){
				//Si no existe id, verificar la existencia del impuesto, tipo y valor máximo
				if ($('#txtTasaCuotaID_sat_tasa_cuota_contabilidad').val() == '' && $('#txtValorMaximo_sat_tasa_cuota_contabilidad').val() != '')
				{
					//Concatenar criterios de búsqueda (para poder verificar la existencia del impuesto, tipo y valor máximo)
					var strCriteriosBusqSatTasaCuotaContabilidad = $('#txtImpuestoID_sat_tasa_cuota_contabilidad').val()+'|'+$('#cmbTipo_sat_tasa_cuota_contabilidad').val()+'|'+$('#txtValorMaximo_sat_tasa_cuota_contabilidad').val();

					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el impuesto, tipo y valor máximo 
					editar_sat_tasa_cuota_contabilidad(strCriteriosBusqSatTasaCuotaContabilidad, 'impuesto', 'Nuevo');
				}
			});

			//Habilitar o deshabilitar valor mínimo cuando cambie la opción del combobox
	        $('#cmbTipo_sat_tasa_cuota_contabilidad').change(function(e){   
	            //Dependiendo del tipo habilitar o deshabilitar valor mínimo
              	if($('#cmbTipo_sat_tasa_cuota_contabilidad').val() === 'RANGO')
             	{
             		//Habilitar caja de texto
					$("#txtValorMinimo_sat_tasa_cuota_contabilidad").removeAttr('disabled');
             	}
             	else
             	{
             		//Deshabilitar caja de texto
					$("#txtValorMinimo_sat_tasa_cuota_contabilidad").attr('disabled','disabled');
					//Limpiar contenido de la caja de texto
					$('#txtValorMinimo_sat_tasa_cuota_contabilidad').val(''); 
             	}
	        });

	        //Autocomplete para recuperar los datos de un impuesto 
	        $('#txtImpuesto_sat_tasa_cuota_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtImpuestoID_sat_tasa_cuota_contabilidad').val('');
	               //Hacer un llamado a la función para inicializar elementos del impuesto
	               inicializar_impuesto_sat_tasa_cuota_contabilidad();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_impuestos/autocomplete",
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
	             //Asignar valores del registro seleccionado
	             $('#txtImpuestoID_sat_tasa_cuota_contabilidad').val(ui.item.data);
	             $('#cmbTraslado_sat_tasa_cuota_contabilidad').val(ui.item.traslado);
	             $('#cmbRetencion_sat_tasa_cuota_contabilidad').val(ui.item.retencion);

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del impuesto cuando pierda el enfoque la caja de texto
	        $('#txtImpuesto_sat_tasa_cuota_contabilidad').focusout(function(e){
	            //Si no existe id del impuesto
	            if($('#txtImpuestoID_sat_tasa_cuota_contabilidad').val() == '' ||
	               $('#txtImpuesto_sat_tasa_cuota_contabilidad').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtImpuestoID_sat_tasa_cuota_contabilidad').val('');
	                $('#txtImpuesto_sat_tasa_cuota_contabilidad').val('');
	                //Hacer un llamado a la función para inicializar elementos del impuesto
	                inicializar_impuesto_sat_tasa_cuota_contabilidad();
	            }
	            
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_sat_tasa_cuota_contabilidad').on('click','a',function(event){
				event.preventDefault();
				intPaginaSatTasaCuotaContabilidad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_sat_tasa_cuota_contabilidad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_sat_tasa_cuota_contabilidad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_sat_tasa_cuota_contabilidad();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_sat_tasa_cuota_contabilidad').addClass("estatus-NUEVO");
				//Abrir modal
				 objSatTasaCuotaContabilidad = $('#SatTasaCuotaContabilidadBox').bPopup({
											   appendTo: '#SatTasaCuotaContabilidadContent', 
				                               contentContainer: 'SatTasaCuotaContabilidadM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtImpuesto_sat_tasa_cuota_contabilidad').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_sat_tasa_cuota_contabilidad').focus();    
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_sat_tasa_cuota_contabilidad();
		});
	</script>