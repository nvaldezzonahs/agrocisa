	<div id="VerificacionesEstatalesControlVehiculosContent">  
		<!--Barra de vehiculos-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_verificaciones_estatales_control_vehiculos" action="#" method="post" 
				  tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_verificaciones_estatales_control_vehiculos" 
								   name="strBusqueda_verificaciones_estatales_control_vehiculos"  type="text" value="" tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" 
										id="btnBuscar_verificaciones_estatales_control_vehiculos"
										onclick="paginacion_verificaciones_estatales_control_vehiculos();" 
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
							<button class="btn btn-info" id="btnNuevo_verificaciones_estatales_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_verificaciones_estatales_control_vehiculos"
									onclick="reporte_verificaciones_estatales_control_vehiculos();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_verificaciones_estatales_control_vehiculos"
									onclick="descargar_xls_verificaciones_estatales_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre de barra de vehiculos-->
		<!--Estilo que se utiliza para mostrar los nombres de las columnas de la tabla en el dispositivo móvil -->
		<style>
			@media (max-width: 480px) 
			{
			    /*Definir columnas*/
				td.movil:nth-of-type(1):before {content: "Estado"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}
			}

			.input-group-addon {
		    	min-width:100px;
		    	text-align:left;
			}	

		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_verificaciones_estatales_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Estado</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_verificaciones_estatales_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil">{{verificacion_estado}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_verificaciones_estatales_control_vehiculos({{estado_id}}, 'id', 'Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_verificaciones_estatales_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_verificaciones_estatales_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="VerificacionesEstatalesControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_verificaciones_estatales_control_vehiculos"  class="ModalBodyTitle">
			<h1>Verificaciones estatales</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmVerificacionesEstatalesControlVehiculos" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmVerificacionesEstatalesControlVehiculos"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
					    <!--Estado-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para indicar la existencia del presupuesto y así poder actualizar los registros-->
									<input id="txtNuevoID_verificaciones_estatales_control_vehiculos" 
									   name="strNuevoID_verificaciones_estatales_control_vehiculos"  
									   type="hidden" value="" />	   
									<!-- Caja de texto oculta que se utiliza almacenar el ID del estado elegido en el autocomplete-->
									<input id="txtEstadoID_verificaciones_estatales_control_vehiculos" 
										   name="intEstadoID_verificaciones_estatales_control_vehiculos"  
										   type="hidden" value="" />
									<label for="txtEstado_verificaciones_estatales_control_vehiculos">Estado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtEstado_verificaciones_estatales_control_vehiculos" 
											name="strEstado_verificaciones_estatales_control_vehiculos" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="Ingrese estado" />
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Enero-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Enero</span>
							    <input 	id="txtEneroDigito1_verificaciones_estatales_control_vehiculos" 
										name="intEneroDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtEneroDigito2_verificaciones_estatales_control_vehiculos" 
										name="intEneroDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
						<!--Febrero-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Febrero</span>
							    <input 	id="txtFebreroDigito1_verificaciones_estatales_control_vehiculos" 
										name="intFebreroDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtFebreroDigito2_verificaciones_estatales_control_vehiculos" 
										name="intFebreroDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
						<!--Marzo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Marzo</span>
							    <input 	id="txtMarzoDigito1_verificaciones_estatales_control_vehiculos" 
										name="intMarzoDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtMarzoDigito2_verificaciones_estatales_control_vehiculos" 
										name="intMarzoDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
						<!--Abril-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Abril</span>
							    <input 	id="txtAbrilDigito1_verificaciones_estatales_control_vehiculos" 
										name="intAbrilDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtAbrilDigito2_verificaciones_estatales_control_vehiculos" 
										name="intAbrilDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
				    </div>
				    <br>
				    <div class="row">
						<!--Mayo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Mayo</span>
							    <input 	id="txtMayoDigito1_verificaciones_estatales_control_vehiculos" 
										name="intMayoDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtMayoDigito2_verificaciones_estatales_control_vehiculos" 
										name="intMayoDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
						<!--Junio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Junio</span>
							    <input 	id="txtJunioDigito1_verificaciones_estatales_control_vehiculos" 
										name="intJunioDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtJunioDigito2_verificaciones_estatales_control_vehiculos" 
										name="intJunioDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
						<!--Julio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Julio</span>
							    <input 	id="txtJulioDigito1_verificaciones_estatales_control_vehiculos" 
										name="intJulioDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtJulioDigito2_verificaciones_estatales_control_vehiculos" 
										name="intJulioDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
						<!--Agosto-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Agosto</span>
							    <input 	id="txtAgostoDigito1_verificaciones_estatales_control_vehiculos" 
										name="intAgostoDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtAgostoDigito2_verificaciones_estatales_control_vehiculos" 
										name="intAgostoDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
				    </div>
				    <br>	
				    <div class="row">
						<!--Septiembre-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Septiembre</span>
							    <input 	id="txtSeptiembreDigito1_verificaciones_estatales_control_vehiculos" 
										name="intSeptiembreDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtSeptiembreDigito2_verificaciones_estatales_control_vehiculos" 
										name="intSeptiembreDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
						<!--Octubre-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Octubre</span>
							    <input 	id="txtOctubreDigito1_verificaciones_estatales_control_vehiculos" 
										name="intOctubreDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtOctubreDigito2_verificaciones_estatales_control_vehiculos" 
										name="intOctubreDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
						<!--Noviembre-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Noviembre</span>
							    <input 	id="txtNoviembreDigito1_verificaciones_estatales_control_vehiculos" 
										name="intNoviembreDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtNoviembreDigito2_verificaciones_estatales_control_vehiculos" 
										name="intNoviembreDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
						<!--Diciembre-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="input-group">
							    <span class="input-group-addon">Diciembre</span>
							    <input 	id="txtDiciembreDigito1_verificaciones_estatales_control_vehiculos" 
										name="intDiciembreDigito1_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 1" />
							    <input 	id="txtDiciembreDigito2_verificaciones_estatales_control_vehiculos" 
										name="intDiciembreDigito2_verificaciones_estatales_control_vehiculos"  
						    			type="text" maxlength="1" value="" class="form-control" 
										placeholder="Dígito 2" />
							</div>
						</div>
				    </div>
				    <br>	
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_verificaciones_estatales_control_vehiculos"  
									onclick="validar_verificaciones_estatales_control_vehiculos();"  title="Guardar" tabindex="1" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_verificaciones_estatales_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_verificaciones_estatales_control_vehiculos();" title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#VerificacionesEstatalesControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaVerificacionesEstatalesControlVehiculos = 0;
		var strUltimaBusquedaVerificacionesEstatalesControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objVerificacionesEstatalesControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_verificaciones_estatales_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/verificaciones_estatales/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_verificaciones_estatales_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosVerificacionesEstatalesControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosVerificacionesEstatalesControlVehiculos = strPermisosVerificacionesEstatalesControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosVerificacionesEstatalesControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosVerificacionesEstatalesControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_verificaciones_estatales_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosVerificacionesEstatalesControlVehiculos[i]=='GUARDAR') || (arrPermisosVerificacionesEstatalesControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_verificaciones_estatales_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosVerificacionesEstatalesControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_verificaciones_estatales_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_verificaciones_estatales_control_vehiculos();
						}
						else if(arrPermisosVerificacionesEstatalesControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_verificaciones_estatales_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosVerificacionesEstatalesControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_verificaciones_estatales_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_verificaciones_estatales_control_vehiculos() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_verificaciones_estatales_control_vehiculos').val() != strUltimaBusquedaVerificacionesEstatalesControlVehiculos)
			{
				intPaginaVerificacionesEstatalesControlVehiculos = 0;
				strUltimaBusquedaVerificacionesEstatalesControlVehiculos = $('#txtBusqueda_verificaciones_estatales_control_vehiculos').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/verificaciones_estatales/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_verificaciones_estatales_control_vehiculos').val(),
						intPagina:intPaginaVerificacionesEstatalesControlVehiculos,
						strPermisosAcceso: $('#txtAcciones_verificaciones_estatales_control_vehiculos').val()
					},
					function(data){
						$('#dg_verificaciones_estatales_control_vehiculos tbody').empty();
						var tmpVerificacionesEstatalesControlVehiculos = Mustache.render($('#plantilla_verificaciones_estatales_control_vehiculos').html(),data);
						$('#dg_verificaciones_estatales_control_vehiculos tbody').html(tmpVerificacionesEstatalesControlVehiculos);
						$('#pagLinks_verificaciones_estatales_control_vehiculos').html(data.paginacion);
						$('#numElementos_verificaciones_estatales_control_vehiculos').html(data.total_rows);
						intPaginaVerificacionesEstatalesControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_verificaciones_estatales_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/verificaciones_estatales/get_reporte/"+$('#txtBusqueda_verificaciones_estatales_control_vehiculos').val());
		}
		
		//Función para descargar el reporte general en XLS
		function descargar_xls_verificaciones_estatales_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("control_vehiculos/verificaciones_estatales/get_xls/"+$('#txtBusqueda_verificaciones_estatales_control_vehiculos').val());
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_verificaciones_estatales_control_vehiculos()
		{
			//Incializar formulario
			$('#frmVerificacionesEstatalesControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_verificaciones_estatales_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmVerificacionesEstatalesControlVehiculos').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_verificaciones_estatales_control_vehiculos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_verificaciones_estatales_control_vehiculos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_verificaciones_estatales_control_vehiculos').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmVerificacionesEstatalesControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_verificaciones_estatales_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_verificaciones_estatales_control_vehiculos").hide();
			$("#btnRestaurar_verificaciones_estatales_control_vehiculos").hide();
			//Deshabilitar los siguientes componentes
			$('#txtLicencia_verificaciones_estatales_control_vehiculos').attr('disabled','-1');
			$('#txtTipoLicencia_verificaciones_estatales_control_vehiculos').attr('disabled','-1');
			$('#txtVigenciaLicencia_verificaciones_estatales_control_vehiculos').attr('disabled','-1');  
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_verificaciones_estatales_control_vehiculos()
		{
			try {
				//Cerrar modal
				objVerificacionesEstatalesControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_verificaciones_estatales_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_verificaciones_estatales_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_verificaciones_estatales_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmVerificacionesEstatalesControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intEstadoID_verificaciones_estatales_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba un estado'}
											}
										},
										strEstado_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intEneroDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intEneroDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intFebreroDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intFebreroDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intMarzoDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intMarzoDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intAbrilDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intAbrilDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intMayoDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intMayoDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intJunioDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intJunioDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intJulioDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intJulioDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intAgostoDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intAgostoDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intSeptiembreDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intSeptiembreDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intOctubreDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intOctubreDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intNoviembreDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intNoviembreDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intDiciembreDigito1_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intDiciembreDigito2_verificaciones_estatales_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										}
									}
				});

			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_verificaciones_estatales_control_vehiculos = $('#frmVerificacionesEstatalesControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_verificaciones_estatales_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_verificaciones_estatales_control_vehiculos.isValid())
			{
				//Verificar que exista al menos un importe
				if($('#txtEneroDigito1_verificaciones_estatales_control_vehiculos').val() == '' && 
				   $('#txtFebreroDigito1_verificaciones_estatales_control_vehiculos').val() == '' &&
				   $('#txtMarzoDigito1_verificaciones_estatales_control_vehiculos').val() == '' &&
				   $('#txtAbrilDigito1_verificaciones_estatales_control_vehiculos').val() == '' &&
				   $('#txtMayoDigito1_verificaciones_estatales_control_vehiculos').val() == '' &&
				   $('#txtJunioDigito1_verificaciones_estatales_control_vehiculos').val() == '' &&
				   $('#txtJulioDigito1_verificaciones_estatales_control_vehiculos').val() == '' &&
				   $('#txtAgostoDigito1_verificaciones_estatales_control_vehiculos').val() == '' &&
				   $('#txtSeptiembreDigito1_verificaciones_estatales_control_vehiculos').val() == '' &&
				   $('#txtOctubreDigito1_verificaciones_estatales_control_vehiculos').val() == '' &&
				   $('#txtNoviembreDigito1_verificaciones_estatales_control_vehiculos').val() == '' &&
				   $('#txtDiciembreDigito1_verificaciones_estatales_control_vehiculos').val() == '')
				{
					//Indicar al usuario que debe ingresar al menos un importe
					new $.Zebra_Dialog('Escriba al menos un dígito para un mes.', {
										'type': 'error',
										'title': 'Error',
										'buttons': [{caption: 'Aceptar',
													 callback: function () {
													 	//Hacer un llamado a la función para limpiar los mensajes de error 
														limpiar_mensajes_verificaciones_estatales_control_vehiculos();
														//Enfocar caja de texto
														$('#txtEneroDigito1_verificaciones_estatales_control_vehiculos').focus();
													 }
													}]
									});
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_verificaciones_estatales_control_vehiculos();
				}
				
			}
			else 
				return;


		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_verificaciones_estatales_control_vehiculos()
		{
			try
			{
				$('#frmVerificacionesEstatalesControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_verificaciones_estatales_control_vehiculos()
		{
			
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/verificaciones_estatales/guardar',
					{ 
						strNuevoID: $('#txtNuevoID_verificaciones_estatales_control_vehiculos').val(),
						intEstadoID: $('#txtEstadoID_verificaciones_estatales_control_vehiculos').val(),
						intDigitos01: $('#txtEneroDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtEneroDigito2_verificaciones_estatales_control_vehiculos').val(),
						intDigitos02: $('#txtFebreroDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtFebreroDigito2_verificaciones_estatales_control_vehiculos').val(),
						intDigitos03: $('#txtMarzoDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtMarzoDigito2_verificaciones_estatales_control_vehiculos').val(),
						intDigitos04: $('#txtAbrilDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtAbrilDigito2_verificaciones_estatales_control_vehiculos').val(),
						intDigitos05: $('#txtMayoDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtMayoDigito2_verificaciones_estatales_control_vehiculos').val(),
						intDigitos06: $('#txtJunioDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtJunioDigito2_verificaciones_estatales_control_vehiculos').val(),
						intDigitos07: $('#txtJulioDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtJulioDigito2_verificaciones_estatales_control_vehiculos').val(),
						intDigitos08: $('#txtAgostoDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtAgostoDigito2_verificaciones_estatales_control_vehiculos').val(),
						intDigitos09: $('#txtSeptiembreDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtSeptiembreDigito2_verificaciones_estatales_control_vehiculos').val(),
						intDigitos10: $('#txtOctubreDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtOctubreDigito2_verificaciones_estatales_control_vehiculos').val(),
						intDigitos11: $('#txtNoviembreDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtNoviembreDigito2_verificaciones_estatales_control_vehiculos').val(),
						intDigitos12: $('#txtDiciembreDigito1_verificaciones_estatales_control_vehiculos').val() + '|' + $('#txtDiciembreDigito2_verificaciones_estatales_control_vehiculos').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_verificaciones_estatales_control_vehiculos();
							//Hacer un llamado a la función para cerrar modal
							cerrar_verificaciones_estatales_control_vehiculos();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_verificaciones_estatales_control_vehiculos(data.tipo_mensaje, data.mensaje);
					},
			'json');			
			
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_verificaciones_estatales_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_verificaciones_estatales_control_vehiculos(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtVehiculoID_verificaciones_estatales_control_vehiculos').val();

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
				              'title':    'Vehículos',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('control_vehiculos/vehiculos/set_estatus',
				                                     {intVehiculoID: intID,
				                                      strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                          	//Hacer llamado a la función  para cargar  los registros en el grid
				                                         	paginacion_verificaciones_estatales_control_vehiculos();
				                                          	
				                                          	//Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_verificaciones_estatales_control_vehiculos();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_verificaciones_estatales_control_vehiculos(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('control_vehiculos/vehiculos/set_estatus',
				     {intVehiculoID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_verificaciones_estatales_control_vehiculos();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_verificaciones_estatales_control_vehiculos();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_verificaciones_estatales_control_vehiculos(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_verificaciones_estatales_control_vehiculos(busqueda, tipoBusqueda, tipoAccion)
		{	
		   //Hacer un llamado al método del controlador para regresar los datos del registro
		   $.post('control_vehiculos/verificaciones_estatales/get_datos',
	       {
	       		intEstadoID: busqueda,
	       		strTipo: tipoBusqueda
	       },
	       function(data) {

	        	//Si hay datos del registro
	            if(data.row)
	            {
	        		
	            	//Hacer un llamado a la función para limpiar los campos del formulario
					nuevo_verificaciones_estatales_control_vehiculos();
				   
		          	//Recuperar valores
		       		//EstadoID y Descripción de Estado
		       		$('#txtNuevoID_verificaciones_estatales_control_vehiculos').val(data.row[0].estado_id);
		       		$('#txtEstadoID_verificaciones_estatales_control_vehiculos').val(data.row[0].estado_id);
		       		$('#txtEstado_verificaciones_estatales_control_vehiculos').val(data.row[0].verificacion_estado);

		       		//Meses
		       		var digitos_enero = data.row[0].digitos.split("|");
		       		$('#txtEneroDigito1_verificaciones_estatales_control_vehiculos').val(digitos_enero[0]);
		            $('#txtEneroDigito2_verificaciones_estatales_control_vehiculos').val(digitos_enero[1]);
		            var digitos_febrero = data.row[1].digitos.split("|");
		       		$('#txtFebreroDigito1_verificaciones_estatales_control_vehiculos').val(digitos_febrero[0]);
		            $('#txtFebreroDigito2_verificaciones_estatales_control_vehiculos').val(digitos_febrero[1]);
		            var digitos_marzo = data.row[2].digitos.split("|");
		       		$('#txtMarzoDigito1_verificaciones_estatales_control_vehiculos').val(digitos_marzo[0]);
		            $('#txtMarzoDigito2_verificaciones_estatales_control_vehiculos').val(digitos_marzo[1]);
		            var digitos_abril = data.row[3].digitos.split("|");
		       		$('#txtAbrilDigito1_verificaciones_estatales_control_vehiculos').val(digitos_abril[0]);
		            $('#txtAbrilDigito2_verificaciones_estatales_control_vehiculos').val(digitos_abril[1]);
		            var digitos_mayo = data.row[4].digitos.split("|");
		       		$('#txtMayoDigito1_verificaciones_estatales_control_vehiculos').val(digitos_mayo[0]);
		            $('#txtMayoDigito2_verificaciones_estatales_control_vehiculos').val(digitos_mayo[1]);
		            var digitos_junio = data.row[5].digitos.split("|");
		       		$('#txtJunioDigito1_verificaciones_estatales_control_vehiculos').val(digitos_junio[0]);
		            $('#txtJunioDigito2_verificaciones_estatales_control_vehiculos').val(digitos_junio[1]);
		            var digitos_julio = data.row[6].digitos.split("|");
		       		$('#txtJulioDigito1_verificaciones_estatales_control_vehiculos').val(digitos_julio[0]);
		            $('#txtJulioDigito2_verificaciones_estatales_control_vehiculos').val(digitos_julio[1]);
		            var digitos_agosto = data.row[7].digitos.split("|");
		       		$('#txtAgostoDigito1_verificaciones_estatales_control_vehiculos').val(digitos_agosto[0]);
		            $('#txtAgostoDigito2_verificaciones_estatales_control_vehiculos').val(digitos_agosto[1]);
		            var digitos_septiembre = data.row[8].digitos.split("|");
		       		$('#txtSeptiembreDigito1_verificaciones_estatales_control_vehiculos').val(digitos_septiembre[0]);
		            $('#txtSeptiembreDigito2_verificaciones_estatales_control_vehiculos').val(digitos_septiembre[1]);
		            var digitos_octubre = data.row[9].digitos.split("|");
		       		$('#txtOctubreDigito1_verificaciones_estatales_control_vehiculos').val(digitos_octubre[0]);
		            $('#txtOctubreDigito2_verificaciones_estatales_control_vehiculos').val(digitos_octubre[1]);
		            var digitos_noviembre = data.row[10].digitos.split("|");
		       		$('#txtNoviembreDigito1_verificaciones_estatales_control_vehiculos').val(digitos_noviembre[0]);
		            $('#txtNoviembreDigito2_verificaciones_estatales_control_vehiculos').val(digitos_noviembre[1]);
		            var digitos_diciembre = data.row[11].digitos.split("|");
		       		$('#txtDiciembreDigito1_verificaciones_estatales_control_vehiculos').val(digitos_diciembre[0]);
		            $('#txtDiciembreDigito2_verificaciones_estatales_control_vehiculos').val(digitos_diciembre[1]);

		            //Dependiendo del estatus cambiar el color del encabezado 
		            $('#divEncabezadoModal_verificaciones_estatales_control_vehiculos').addClass("estatus-"+data.row.estatus);

		            //Si el tipo de acción es diferente de Nuevo
		            if(tipoAccion != 'Nuevo')
		            {
		            	//Abrir modal
			            objVerificacionesEstatalesControlVehiculos = $('#VerificacionesEstatalesControlVehiculosBox').bPopup({
													  appendTo: '#VerificacionesEstatalesControlVehiculosContent', 
						                              contentContainer: 'VerificacionesEstatalesControlVehiculosM', 
						                              zIndex: 2, 
						                              modalClose: false, 
						                              modal: true, 
						                              follow: [true,false], 
						                              followEasing : "linear", 
						                              easing: "linear", 
						                              modalColor: ('#F0F0F0')});

			            //Enfocar caja de texto
						$('#txtCodigo_verificaciones_estatales_control_vehiculos').focus();
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
			//Validamos que solo puedan aceptarse números en los siguientes inputs:
			$('#txtEneroDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtEneroDigito2_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtFebreroDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtFebreroDigito2_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtMarzoDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtMarzoDigito2_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtAbrilDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtAbrilDigito2_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtMayoDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtMayoDigito2_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtJunioDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtJunioDigito2_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtJulioDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtJulioDigito2_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtAgostoDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtAgostoDigito2_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtSeptiembreDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtSeptiembreDigito2_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtOctubreDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtOctubreDigito2_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtNoviembreDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtNoviembreDigito2_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtDiciembreDigito1_verificaciones_estatales_control_vehiculos').numeric();
			$('#txtDiciembreDigito2_verificaciones_estatales_control_vehiculos').numeric();

			//Autocomplete para recuperar los datos de un estado (catálogo SAT)
	        $('#txtEstado_verificaciones_estatales_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtEstadoID_verificaciones_estatales_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_estados/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strEstatus: 'ACTIVO'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEstadoID_verificaciones_estatales_control_vehiculos').val(ui.item.data);
	             //Limpiar el cajo de texto
	             $('#txtNuevoID_verificaciones_estatales_control_vehiculos').val('');
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('contabilidad/sat_estados/get_datos',
	              { 
	              	strBusqueda:$("#txtEstadoID_verificaciones_estatales_control_vehiculos").val(),
		       		strTipo: 'id'
	              },
	              function(data) {
	                if(data.row){
	                   $("#txtEstado_verificaciones_estatales_control_vehiculos").val(data.row.codigo + ' - ' + data.row.descripcion);  
	                }
	              }
	             ,
	            'json');
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtEstado_verificaciones_estatales_control_vehiculos').focusout(function(e){
				//Si no existe estadoID elegido
				if ($('#txtEstadoID_verificaciones_estatales_control_vehiculos').val() == '' || $('#txtEstado_verificaciones_estatales_control_vehiculos').val() == '')
				{
					//Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstadoID_verificaciones_estatales_control_vehiculos').val('');
	               $('#txtEstado_verificaciones_estatales_control_vehiculos').val('');

				}
			});



			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_verificaciones_estatales_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaVerificacionesEstatalesControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_verificaciones_estatales_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_verificaciones_estatales_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_verificaciones_estatales_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_verificaciones_estatales_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				 objVerificacionesEstatalesControlVehiculos = $('#VerificacionesEstatalesControlVehiculosBox').bPopup({
											   appendTo: '#VerificacionesEstatalesControlVehiculosContent', 
				                               contentContainer: 'VerificacionesEstatalesControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_verificaciones_estatales_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_verificaciones_estatales_control_vehiculos').focus();     
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_verificaciones_estatales_control_vehiculos();
		});
	</script>