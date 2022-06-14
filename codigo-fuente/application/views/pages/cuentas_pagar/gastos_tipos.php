	<div id="GastosTiposCuentasPagarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_gastos_tipos_cuentas_pagar" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_gastos_tipos_cuentas_pagar" 
								   name="strBusqueda_gastos_tipos_cuentas_pagar"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_gastos_tipos_cuentas_pagar"
										onclick="paginacion_gastos_tipos_cuentas_pagar();" 
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
							<button class="btn btn-info" id="btnNuevo_gastos_tipos_cuentas_pagar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_gastos_tipos_cuentas_pagar"
									onclick="reporte_gastos_tipos_cuentas_pagar();" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_gastos_tipos_cuentas_pagar"
									onclick="descargar_xls_gastos_tipos_cuentas_pagar();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(2):before {content: "Tipo"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Prefijo"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Parque vehicular"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_gastos_tipos_cuentas_pagar">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Descripción</th>
							<th class="movil">Tipo</th>
							<th class="movil">Prefijo</th>
							<th class="movil">Parque vehicular</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_gastos_tipos_cuentas_pagar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{tipo_gasto}}</td>
							<td class="movil">{{prefijo}}</td>
							<td class="movil">{{parque_vehicular}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_gastos_tipos_cuentas_pagar({{gasto_tipo_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_gastos_tipos_cuentas_pagar({{gasto_tipo_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_gastos_tipos_cuentas_pagar({{gasto_tipo_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_gastos_tipos_cuentas_pagar({{gasto_tipo_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_gastos_tipos_cuentas_pagar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_gastos_tipos_cuentas_pagar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="GastosTiposCuentasPagarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_gastos_tipos_cuentas_pagar"  class="ModalBodyTitle">
			<h1>Tipos de Gastos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmGastosTiposCuentasPagar" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmGastosTiposCuentasPagar"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtGastoTipoID_gastos_tipos_cuentas_pagar" 
										   name="intGastoTipoID_gastos_tipos_cuentas_pagar" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_gastos_tipos_cuentas_pagar" 
										   name="strDescripcionAnterior_gastos_tipos_cuentas_pagar" type="hidden" value="">
									</input>
									<label for="txtDescripcion_gastos_tipos_cuentas_pagar">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_gastos_tipos_cuentas_pagar" 
											name="strDescripcion_gastos_tipos_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese descripción" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Tipo de gasto-->
				    	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
				    		<div class="form-group">
				    			<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el tipo de gasto anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción en el tipo de gasto-->
									<input id="txtTipoGastoAnterior_gastos_tipos_cuentas_pagar" 
										   name="strTipoGastoAnterior_gastos_tipos_cuentas_pagar" type="hidden" value="">
									</input>
									<label for="cmbTipoGasto_gastos_tipos_cuentas_pagar">Tipo</label>
								</div>
				    			<div id="divCmbMsjValidacion" class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
				    				<select class="form-control" id="cmbTipoGasto_gastos_tipos_cuentas_pagar" 
											name="strTipoGasto_gastos_tipos_cuentas_pagar" tabindex="1">
										<option value="">Seleccione una opción</option>
		                  				<option value="GASTOS DE VENTA">GASTOS DE VENTA</option>
		                  				<option value="GASTOS DE ADMINISTRACION">GASTOS DE ADMINISTRACION</option>
		                  				<option value="GASTOS CORPORATIVOS">GASTOS CORPORATIVOS</option>
		                  				<option value="GASTOS FINANCIEROS">GASTOS FINANCIEROS</option>	
		             				</select>

				    			</div>
				    		</div>
				    	</div>
				    	 <!--Prefijo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPrefijo_gastos_tipos_cuentas_pagar">Prefijo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPrefijo_gastos_tipos_cuentas_pagar" 
											name="strPrefijo_gastos_tipos_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese prefijo" maxlength="5">
									</input>
								</div>
							</div>
						</div>
				    	<!--Parque vehicular-->
				    	<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
				    		<div class="form-group">
				    			<div class="col-md-12">
											<label for="cmbParqueVehicular_gastos_tipos_cuentas_pagar">Parque vehicular</label>
										</div>
				    			<div id="divCmbMsjValidacion" class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
				    				<select class="form-control" id="cmbParqueVehicular_gastos_tipos_cuentas_pagar" 
											 		name="strParqueVehicular_gastos_tipos_cuentas_pagar" tabindex="1">
										<option value="">Seleccione una opción</option>
		                  				<option value="SI">SI</option>
		                  				<option value="NO">NO</option>	
		             				</select>

				    			</div>
				    		</div>
				    	</div>
				    </div>
				    <div class="row">
				    	<!--Orden de compra--> 
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="checkbox">
		                    	<label id="label-checkbox">
		                        	<input class="form-control" id="chbOrdenCompra_gastos_tipos_cuentas_pagar" 
										   name="strOrdenCompra_gastos_tipos_cuentas_pagar" type="checkbox"
										   value="" tabindex="1">
									</input>
									<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
									Orden de compra
		                    	</label>
		                  	</div>
						</div>
					    <!--Retención de ISR--> 
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="checkbox">
		                    	<label id="label-checkbox">
		                        	<input class="form-control" id="chbRetencionIsr_gastos_tipos_cuentas_pagar" 
										   name="strRetencionIsr_gastos_tipos_cuentas_pagar" type="checkbox"
										   value="" tabindex="1">
									</input>
									<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
									Retención de ISR
		                    	</label>
		                  	</div>
						</div>
						 <!--Retención de IVA--> 
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="checkbox">
		                    	<label id="label-checkbox">
		                        	<input class="form-control" id="chbRetencionIva_gastos_tipos_cuentas_pagar" 
										   name="strRetencionIva_gastos_tipos_cuentas_pagar" type="checkbox"
										   value="" tabindex="1">
									</input>
									<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
									Retención de IVA
		                    	</label>
		                  	</div>
						</div>
				    </div>
					</br>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_gastos_tipos_cuentas_pagar"  
									onclick="validar_gastos_tipos_cuentas_pagar();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_gastos_tipos_cuentas_pagar"  
									onclick="cambiar_estatus_gastos_tipos_cuentas_pagar('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_gastos_tipos_cuentas_pagar"  
									onclick="cambiar_estatus_gastos_tipos_cuentas_pagar('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_gastos_tipos_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_gastos_tipos_cuentas_pagar();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#GastosTiposCuentasPagarContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaGastosTiposCuentasPagar = 0;
		var strUltimaBusquedaGastosTiposCuentasPagar = "";
		//Variable que se utiliza para asignar objeto del modal
		var objGastosTiposCuentasPagar = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_gastos_tipos_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_pagar/gastos_tipos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_gastos_tipos_cuentas_pagar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosGastosTiposCuentasPagar = data.row;
					//Separar la cadena 
					var arrPermisosGastosTiposCuentasPagar = strPermisosGastosTiposCuentasPagar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosGastosTiposCuentasPagar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosGastosTiposCuentasPagar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_gastos_tipos_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosGastosTiposCuentasPagar[i]=='GUARDAR') || (arrPermisosGastosTiposCuentasPagar[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_gastos_tipos_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosGastosTiposCuentasPagar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_gastos_tipos_cuentas_pagar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_gastos_tipos_cuentas_pagar();
						}
						else if(arrPermisosGastosTiposCuentasPagar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_gastos_tipos_cuentas_pagar').removeAttr('disabled');
							$('#btnRestaurar_gastos_tipos_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosGastosTiposCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_gastos_tipos_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosGastosTiposCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_gastos_tipos_cuentas_pagar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_gastos_tipos_cuentas_pagar() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_gastos_tipos_cuentas_pagar').val() != strUltimaBusquedaGastosTiposCuentasPagar)
			{
				intPaginaGastosTiposCuentasPagar = 0;
				strUltimaBusquedaGastosTiposCuentasPagar = $('#txtBusqueda_gastos_tipos_cuentas_pagar').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_pagar/gastos_tipos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_gastos_tipos_cuentas_pagar').val(),
						intPagina:intPaginaGastosTiposCuentasPagar,
						strPermisosAcceso: $('#txtAcciones_gastos_tipos_cuentas_pagar').val()
					},
					function(data){
						$('#dg_gastos_tipos_cuentas_pagar tbody').empty();
						var tmpGastosTiposCuentasPagar = Mustache.render($('#plantilla_gastos_tipos_cuentas_pagar').html(),data);
						$('#dg_gastos_tipos_cuentas_pagar tbody').html(tmpGastosTiposCuentasPagar);
						$('#pagLinks_gastos_tipos_cuentas_pagar').html(data.paginacion);
						$('#numElementos_gastos_tipos_cuentas_pagar').html(data.total_rows);
						intPaginaGastosTiposCuentasPagar = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_gastos_tipos_cuentas_pagar() 
		{
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("cuentas_pagar/gastos_tipos/get_reporte/"+$('#txtBusqueda_gastos_tipos_cuentas_pagar').val());
		}
		
		//Función para descargar el reporte general en XLS
		function descargar_xls_gastos_tipos_cuentas_pagar() 
		{
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("cuentas_pagar/gastos_tipos/get_xls/"+$('#txtBusqueda_gastos_tipos_cuentas_pagar').val());
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_gastos_tipos_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmGastosTiposCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_gastos_tipos_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmGastosTiposCuentasPagar').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_gastos_tipos_cuentas_pagar').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_gastos_tipos_cuentas_pagar').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_gastos_tipos_cuentas_pagar').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmGastosTiposCuentasPagar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_gastos_tipos_cuentas_pagar").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_gastos_tipos_cuentas_pagar").hide();
			$("#btnRestaurar_gastos_tipos_cuentas_pagar").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_gastos_tipos_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objGastosTiposCuentasPagar.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_gastos_tipos_cuentas_pagar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_gastos_tipos_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_gastos_tipos_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmGastosTiposCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_gastos_tipos_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										strTipoGasto_gastos_tipos_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo de gasto'}
											}
										},
										strPrefijo_gastos_tipos_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un prefijo'}
											}
										},
										strParqueVehicular_gastos_tipos_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione si tiene o no parque vehicular'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_gastos_tipos_cuentas_pagar = $('#frmGastosTiposCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_gastos_tipos_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_gastos_tipos_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_gastos_tipos_cuentas_pagar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_gastos_tipos_cuentas_pagar()
		{
			try
			{
				$('#frmGastosTiposCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_gastos_tipos_cuentas_pagar()
		{
			//Si el checkbox orden de compra se encuentra seleccionado
			if ($('#chbOrdenCompra_gastos_tipos_cuentas_pagar').is(':checked')) 
			{
			    //Asignar SI 
			    $('#chbOrdenCompra_gastos_tipos_cuentas_pagar').val('SI');
			}
			else
			{ 
			   //Asignar NO
			   $('#chbOrdenCompra_gastos_tipos_cuentas_pagar').val('NO');
			}

	
			//Si el checkbox retención de ISR se encuentra seleccionado
			if ($('#chbRetencionIsr_gastos_tipos_cuentas_pagar').is(':checked')) 
			{
			    //Asignar SI 
			    $('#chbRetencionIsr_gastos_tipos_cuentas_pagar').val('SI');
			}
			else
			{ 
			   //Asignar NO
			   $('#chbRetencionIsr_gastos_tipos_cuentas_pagar').val('NO');
			}

			//Si el checkbox retención de IVA se encuentra seleccionado
			if ($('#chbRetencionIva_gastos_tipos_cuentas_pagar').is(':checked')) 
			{
			    //Asignar SI 
			    $('#chbRetencionIva_gastos_tipos_cuentas_pagar').val('SI');
			}
			else
			{ 
			   //Asignar NO
			   $('#chbRetencionIva_gastos_tipos_cuentas_pagar').val('NO');
			}


			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_pagar/gastos_tipos/guardar',
					{ 
						intGastoTipoID: $('#txtGastoTipoID_gastos_tipos_cuentas_pagar').val(),
						strTipoGasto: $('#cmbTipoGasto_gastos_tipos_cuentas_pagar').val(),
						strTipoGastoAnterior: $('#txtTipoGastoAnterior_gastos_tipos_cuentas_pagar').val(),
						strDescripcion: $('#txtDescripcion_gastos_tipos_cuentas_pagar').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_gastos_tipos_cuentas_pagar').val(),
						strPrefijo: $('#txtPrefijo_gastos_tipos_cuentas_pagar').val(),
						strParqueVehicular: $('#cmbParqueVehicular_gastos_tipos_cuentas_pagar').val(),
						strOrdenCompra: $('#chbOrdenCompra_gastos_tipos_cuentas_pagar').val(),
						strRetencionIsr: $('#chbRetencionIsr_gastos_tipos_cuentas_pagar').val(),
						strRetencionIva: $('#chbRetencionIva_gastos_tipos_cuentas_pagar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_gastos_tipos_cuentas_pagar();
							//Hacer un llamado a la función para cerrar modal
							cerrar_gastos_tipos_cuentas_pagar();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_gastos_tipos_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_gastos_tipos_cuentas_pagar(tipoMensaje, mensaje)
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
		function cambiar_estatus_gastos_tipos_cuentas_pagar(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtGastoTipoID_gastos_tipos_cuentas_pagar').val();

			}
			else
			{
				intID = id;
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
						             {'type':     'question',
						              'title':    'Tipos de Gastos',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
						                              $.post('cuentas_pagar/gastos_tipos/set_estatus',
						                                     {intGastoTipoID: intID,
						                                      strEstatus: estatus
						                                     },
						                                     function(data) {
						                                        if(data.resultado)
						                                        {
						                                        	//Hacer llamado a la función  para cargar  los registros en el grid
						                                          	paginacion_gastos_tipos_cuentas_pagar();

						                                          	//Si el id del registro se obtuvo del modal
																	if(id == '')
																	{
																		//Hacer un llamado a la función para cerrar modal
																		cerrar_gastos_tipos_cuentas_pagar();     
																	}
						                                        }
						                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						                                        mensaje_gastos_tipos_cuentas_pagar(data.tipo_mensaje, data.mensaje);
						                                     },
						                                    'json');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('cuentas_pagar/gastos_tipos/set_estatus',
				     {intGastoTipoID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_gastos_tipos_cuentas_pagar();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_gastos_tipos_cuentas_pagar();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_gastos_tipos_cuentas_pagar(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_gastos_tipos_cuentas_pagar(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_pagar/gastos_tipos/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_gastos_tipos_cuentas_pagar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtGastoTipoID_gastos_tipos_cuentas_pagar').val(data.row.gasto_tipo_id);
				            $('#cmbTipoGasto_gastos_tipos_cuentas_pagar').val(data.row.tipo_gasto);
				            $('#txtTipoGastoAnterior_gastos_tipos_cuentas_pagar').val(data.row.tipo_gasto);
				            $('#txtDescripcion_gastos_tipos_cuentas_pagar').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_gastos_tipos_cuentas_pagar').val(data.row.descripcion);
				            $('#txtPrefijo_gastos_tipos_cuentas_pagar').val(data.row.prefijo);
				            $('#cmbParqueVehicular_gastos_tipos_cuentas_pagar').val(data.row.parque_vehicular);
				           
				            //Si el gasto tiene orden de compra
				           	if(data.row.orden_compra == 'SI')
				           	{
				           		//Marcar (Seleccionar) checkbox para indicar que el gasto cuenta con orden de compra
				            	$('#chbOrdenCompra_gastos_tipos_cuentas_pagar').prop('checked', true);
				            }


				            //Si el gasto tiene retención de ISR
				           	if(data.row.retencion_isr == 'SI')
				           	{
				           		//Marcar (Seleccionar) checkbox para indicar que el gasto cuenta con retención de ISR
				            	$('#chbRetencionIsr_gastos_tipos_cuentas_pagar').prop('checked', true);
				            }


				            //Si el gasto tiene retención de IVA
				           	if(data.row.retencion_iva == 'SI')
				           	{
				           		//Marcar (Seleccionar) checkbox para indicar que el gasto cuenta con retención de IVA
				            	$('#chbRetencionIva_gastos_tipos_cuentas_pagar').prop('checked', true);
				            }


				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_gastos_tipos_cuentas_pagar').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_gastos_tipos_cuentas_pagar").show();
							}
							else 
							{	
								//Si el tipo de acción corresponde a Ver
								if(tipoAccion == 'Ver')
								{
									//Deshabilitar todos los elementos del formulario
				            		$('#frmGastosTiposCuentasPagar').find('input, textarea, select').attr('disabled','disabled');
				            		//Ocultar botón Guardar
					           		$("#btnGuardar_gastos_tipos_cuentas_pagar").hide(); 
								}
								
								//Mostrar botón Restaurar
								$("#btnRestaurar_gastos_tipos_cuentas_pagar").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objGastosTiposCuentasPagar = $('#GastosTiposCuentasPagarBox').bPopup({
															  appendTo: '#GastosTiposCuentasPagarContent', 
								                              contentContainer: 'GastosTiposCuentasPagarM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_gastos_tipos_cuentas_pagar').focus();
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
			$('#txtPrefijo_gastos_tipos_cuentas_pagar').numeric({decimal: false, negative: false});

			//Comprobar la existencia de la descripción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_gastos_tipos_cuentas_pagar').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtGastoTipoID_gastos_tipos_cuentas_pagar').val() == '' && $('#txtDescripcion_gastos_tipos_cuentas_pagar').val() != '')
				{
					//Concatenar criterios de búsqueda (para poder verificar la existencia de la descripción en el tipo de gasto)
					var strCriteriosBusqGastosTiposCuentasPagar = $('#cmbTipoGasto_gastos_tipos_cuentas_pagar').val()+'|'+$('#txtDescripcion_gastos_tipos_cuentas_pagar').val();

					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_gastos_tipos_cuentas_pagar(strCriteriosBusqGastosTiposCuentasPagar, 'descripcion', 'Nuevo');
				}
			});


			//Comprobar la existencia de la descripción en la BD cuando cambie la opción del combobox
	        $('#cmbTipoGasto_gastos_tipos_cuentas_pagar').change(function(e){ 
	        	//Verificar si existe información en la BD
				if ($('#txtGastoTipoID_gastos_tipos_cuentas_pagar').val() == '' && $('#cmbTipoGasto_gastos_tipos_cuentas_pagar').val() != '')
				{
					//Concatenar criterios de búsqueda (para poder verificar la existencia de la descripción en el tipo de gasto)
					var strCriteriosBusqGastosTiposCuentasPagar = $('#cmbTipoGasto_gastos_tipos_cuentas_pagar').val()+'|'+$('#txtDescripcion_gastos_tipos_cuentas_pagar').val();
					
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_gastos_tipos_cuentas_pagar(strCriteriosBusqGastosTiposCuentasPagar, 'descripcion', 'Nuevo');
				}

	        });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_gastos_tipos_cuentas_pagar').on('click','a',function(event){
				event.preventDefault();
				intPaginaGastosTiposCuentasPagar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_gastos_tipos_cuentas_pagar();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_gastos_tipos_cuentas_pagar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_gastos_tipos_cuentas_pagar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_gastos_tipos_cuentas_pagar').addClass("estatus-NUEVO");
				//Abrir modal
				 objGastosTiposCuentasPagar = $('#GastosTiposCuentasPagarBox').bPopup({
											   appendTo: '#GastosTiposCuentasPagarContent', 
				                               contentContainer: 'GastosTiposCuentasPagarM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_gastos_tipos_cuentas_pagar').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_gastos_tipos_cuentas_pagar').focus(); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_gastos_tipos_cuentas_pagar();
		});
	</script>