	<div id="SucursalesAdministracionContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_sucursales_administracion" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_sucursales_administracion" 
								   name="strBusqueda_sucursales_administracion"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_sucursales_administracion"
										onclick="paginacion_sucursales_administracion();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_sucursales_administracion" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_sucursales_administracion"
									onclick="reporte_sucursales_administracion('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_sucursales_administracion"
									onclick="reporte_sucursales_administracion('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Sucursal"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Teléfono"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Domicilio"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_sucursales_administracion">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Sucursal</th>
							<th class="movil">Teléfono</th>
							<th class="movil">Domicilio</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_sucursales_administracion" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{nombre}}</td>
							<td class="movil">{{telefono_01}}</td>
							<td class="movil">{{domicilio}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_sucursales_administracion({{sucursal_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_sucursales_administracion({{sucursal_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_sucursales_administracion({{sucursal_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_sucursales_administracion({{sucursal_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_sucursales_administracion"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_sucursales_administracion">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Sucursales-->
		<div id="SucursalesAdministracionBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_sucursales_administracion"  class="ModalBodyTitle">
			<h1>Sucursales</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmSucursalesAdministracion" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmSucursalesAdministracion" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Nombre-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtSucursalID_sucursales_administracion" 
										   name="intSucursalID_sucursales_administracion" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el nombre anterior y así evitar duplicidad en caso de que exista otro registro con el mismo nombre-->
									<input id="txtNombreAnterior_sucursales_administracion" 
										   name="strNombreAnterior_sucursales_administracion" type="hidden" value="">
									</input>
									<label for="txtNombre_sucursales_administracion">Sucursal</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNombre_sucursales_administracion" 
											name="strNombre_sucursales_administracion" type="text" value="" 
											tabindex="1" placeholder="Ingrese sucursal" maxlength="50">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Domicilio-->
                        <h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Domicilio</h4>
                        <!--Calle-->
						<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCalle_sucursales_administracion">Calle</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCalle_sucursales_administracion" 
											name="strCalle_sucursales_administracion" type="text" value="" 
											tabindex="1" placeholder="Ingrese calle" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Número exterior-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNumeroExterior_sucursales_administracion">Número exterior</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNumeroExterior_sucursales_administracion" 
											name="strNumeroExterior_sucursales_administracion" type="text" value="" 
											tabindex="1" placeholder="Ingrese número" maxlength="15">
									</input>
								</div>
							</div>
						</div>
						<!--Número interior-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNumeroInterior_sucursales_administracion">Número interior</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNumeroInterior_sucursales_administracion" 
											name="strNumeroInterior_sucursales_administracion" type="text" value="" 
											tabindex="1" placeholder="Ingrese número" maxlength="15">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Código postal-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCodigoPostal_sucursales_administracion">Código postal</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigoPostal_sucursales_administracion" 
											name="strCodigoPostal_sucursales_administracion" type="text" value="" 
											tabindex="1" placeholder="Ingrese código postal" maxlength="5">
									</input>
								</div>
							</div>
						</div>
						<!--Colonia-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtColonia_sucursales_administracion">Colonia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtColonia_sucursales_administracion" 
											name="strColonia_sucursales_administracion" type="text" value="" tabindex="1" placeholder="Ingrese colonia" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las localidades activas-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la localidad seleccionada-->
									<input id="txtLocalidadID_sucursales_administracion" 
									       name="intLocalidadID_sucursales_administracion" type="hidden" value="">
									</input>
									<label for="txtLocalidad_sucursales_administracion">Localidad</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtLocalidad_sucursales_administracion" 
											name="strLocalidad_sucursales_administracion" type="text" value="" 
											tabindex="1" placeholder="Ingrese localidad" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Municipio-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMunicipio_sucursales_administracion">Municipio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMunicipio_sucursales_administracion" 
											name="strMunicipio_sucursales_administracion" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
				    	<!--Estado-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtEstado_sucursales_administracion">Estado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEstado_sucursales_administracion" 
											name="strEstado_sucursales_administracion" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
				    	<!--País-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPais_sucursales_administracion">País</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPais_sucursales_administracion" 
											name="strPais_sucursales_administracion" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Teléfono 01-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTelefono01_sucursales_administracion">Teléfono 01</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTelefono01_sucursales_administracion" 
											name="strTelefono01_sucursales_administracion" type="text" value="" 
											tabindex="1" placeholder="Ingrese teléfono" maxlength="10">
									</input>
								</div>
							</div>
						</div>
				    	<!--Teléfono 02-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTelefono02_sucursales_administracion">Teléfono 02</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTelefono02_sucursales_administracion" 
											name="strTelefono02_sucursales_administracion" type="text" value="" 
											tabindex="1" placeholder="Ingrese teléfono" maxlength="10">
									</input>
								</div>
							</div>
						</div>
				    	<!--Correo electrónico-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCorreoElectronico_sucursales_administracion">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_sucursales_administracion" 
											name="strCorreoElectronico_sucursales_administracion" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_sucursales_administracion"  
									onclick="validar_sucursales_administracion();" title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_sucursales_administracion"  
									onclick="cambiar_estatus_sucursales_administracion('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_sucursales_administracion"  
									onclick="cambiar_estatus_sucursales_administracion('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_sucursales_administracion"
									type="reset" aria-hidden="true" onclick="cerrar_sucursales_administracion();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Sucursales-->
	</div><!--#SucursalesAdministracionContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaSucursalesAdministracion = 0;
		var strUltimaBusquedaSucursalesAdministracion = "";
		//Variable que se utiliza para asignar objeto del modal
		var objSucursalesAdministracion = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_sucursales_administracion()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('administracion/sucursales/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_sucursales_administracion').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosSucursalesAdministracion = data.row;
					//Separar la cadena 
					var arrPermisosSucursalesAdministracion = strPermisosSucursalesAdministracion.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosSucursalesAdministracion.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosSucursalesAdministracion[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_sucursales_administracion').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosSucursalesAdministracion[i]=='GUARDAR') || (arrPermisosSucursalesAdministracion[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_sucursales_administracion').removeAttr('disabled');
						}
						else if(arrPermisosSucursalesAdministracion[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_sucursales_administracion').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_sucursales_administracion();
						}
						else if(arrPermisosSucursalesAdministracion[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_sucursales_administracion').removeAttr('disabled');
							$('#btnRestaurar_sucursales_administracion').removeAttr('disabled');
						}
						else if(arrPermisosSucursalesAdministracion[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_sucursales_administracion').removeAttr('disabled');
						}
						else if(arrPermisosSucursalesAdministracion[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_sucursales_administracion').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_sucursales_administracion() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_sucursales_administracion').val() != strUltimaBusquedaSucursalesAdministracion)
			{
				intPaginaSucursalesAdministracion = 0;
				strUltimaBusquedaSucursalesAdministracion = $('#txtBusqueda_sucursales_administracion').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('administracion/sucursales/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_sucursales_administracion').val(),
						intPagina:intPaginaSucursalesAdministracion,
						strPermisosAcceso: $('#txtAcciones_sucursales_administracion').val()
					},
					function(data){
						$('#dg_sucursales_administracion tbody').empty();
						var tmpSucursalesAdministracion = Mustache.render($('#plantilla_sucursales_administracion').html(),data);
						$('#dg_sucursales_administracion tbody').html(tmpSucursalesAdministracion);
						$('#pagLinks_sucursales_administracion').html(data.paginacion);
						$('#numElementos_sucursales_administracion').html(data.total_rows);
						intPaginaSucursalesAdministracion = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_sucursales_administracion(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'administracion/sucursales/';

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
										'strBusqueda': $('#txtBusqueda_sucursales_administracion').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		/*******************************************************************************************************************
		Funciones del modal Sucursales
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_sucursales_administracion()
		{
			//Incializar formulario
			$('#frmSucursalesAdministracion')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sucursales_administracion();
			//Limpiar cajas de texto ocultas
			$('#frmSucursalesAdministracion').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_sucursales_administracion');
			//Habilitar todos los elementos del formulario
			$('#frmSucursalesAdministracion').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtMunicipio_sucursales_administracion').attr("disabled", "disabled");
			$('#txtEstado_sucursales_administracion').attr("disabled", "disabled");
			$('#txtPais_sucursales_administracion').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_sucursales_administracion").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_sucursales_administracion").hide();
			$("#btnRestaurar_sucursales_administracion").hide();
		}

		//Función para inicializar elementos de la localidad
		function inicializar_localidad_sucursales_administracion()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtMunicipio_sucursales_administracion').val('');
	        $('#txtEstado_sucursales_administracion').val('');
	        $('#txtPais_sucursales_administracion').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_sucursales_administracion()
		{
			try {
				//Cerrar modal
				objSucursalesAdministracion.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_sucursales_administracion').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_sucursales_administracion()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_sucursales_administracion();
			//Validación del formulario de campos obligatorios
			$('#frmSucursalesAdministracion')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strNombre_sucursales_administracion: {
											validators: {
												notEmpty: {message: 'Escriba el nombre para esta sucursal'}
											}
										},
										strCalle_sucursales_administracion: {
											validators: {
												notEmpty: {message: 'Escriba una calle'}
											}
										},
										strNumeroExterior_sucursales_administracion: {
											validators: {
												notEmpty: {message: 'Escriba un número exterior'}
											}
										},
										strCodigoPostal_sucursales_administracion: {
											validators: {
												notEmpty: {message: 'Escriba un código postal'},
												stringLength: {
													min: 5,
													message: 'El código postal debe tener 5 caracteres de longitud'
												}
											}
										},
										strTelefono01_sucursales_administracion: {
											validators: {
												notEmpty: {message: 'Escriba un número telefónico'},
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strTelefono02_sucursales_administracion: {
											validators: {
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strLocalidad_sucursales_administracion: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la localidad
					                                    if($('#txtLocalidadID_sucursales_administracion').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una localidad existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCorreoElectronico_sucursales_administracion: {
				                        	validators: {
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    }
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_sucursales_administracion = $('#frmSucursalesAdministracion').data('bootstrapValidator');
			bootstrapValidator_sucursales_administracion.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_sucursales_administracion.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_sucursales_administracion();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_sucursales_administracion()
		{
			try
			{
				$('#frmSucursalesAdministracion').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_sucursales_administracion()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('administracion/sucursales/guardar',
					{ 
						intSucursalID: $('#txtSucursalID_sucursales_administracion').val(),
						strNombre: $('#txtNombre_sucursales_administracion').val(),
						strNombreAnterior: $('#txtNombreAnterior_sucursales_administracion').val(),
						strCalle: $('#txtCalle_sucursales_administracion').val(),
						strNumeroExterior: $('#txtNumeroExterior_sucursales_administracion').val(),
						strNumeroInterior: $('#txtNumeroInterior_sucursales_administracion').val(),
						strCodigoPostal: $('#txtCodigoPostal_sucursales_administracion').val(),
						strColonia: $('#txtColonia_sucursales_administracion').val(),
						intLocalidadID: $('#txtLocalidadID_sucursales_administracion').val(),
						strTelefono01: $('#txtTelefono01_sucursales_administracion').val(),
						strTelefono02: $('#txtTelefono02_sucursales_administracion').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_sucursales_administracion').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_sucursales_administracion();
							//Hacer un llamado a la función para cerrar modal
							cerrar_sucursales_administracion();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_sucursales_administracion(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_sucursales_administracion(tipoMensaje, mensaje)
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
		function cambiar_estatus_sucursales_administracion(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtSucursalID_sucursales_administracion').val();

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
				              'title':    'Sucursales',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_sucursales_administracion(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_sucursales_administracion(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_sucursales_administracion(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('administracion/sucursales/set_estatus',
			      {intSucursalID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_sucursales_administracion();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_sucursales_administracion();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_sucursales_administracion(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_sucursales_administracion(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('administracion/sucursales/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			         
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_sucursales_administracion();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				          	//Recuperar valores
				            $('#txtSucursalID_sucursales_administracion').val(data.row.sucursal_id);
				            $('#txtNombre_sucursales_administracion').val(data.row.nombre);
				            $('#txtNombreAnterior_sucursales_administracion').val(data.row.nombre);
				            $('#txtCalle_sucursales_administracion').val(data.row.calle);
						    $('#txtNumeroExterior_sucursales_administracion').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_sucursales_administracion').val(data.row.numero_interior);
						    $('#txtCodigoPostal_sucursales_administracion').val(data.row.codigo_postal);
						    $('#txtColonia_sucursales_administracion').val(data.row.colonia);
						    $('#txtLocalidadID_sucursales_administracion').val(data.row.localidad_id);
						    $('#txtLocalidad_sucursales_administracion').val(data.row.localidad);
						    $('#txtMunicipio_sucursales_administracion').val(data.row.municipio);
						    $('#txtEstado_sucursales_administracion').val(data.row.estado);
						    $('#txtPais_sucursales_administracion').val(data.row.pais);
						    $('#txtTelefono01_sucursales_administracion').val(data.row.telefono_01);
						    $('#txtTelefono02_sucursales_administracion').val(data.row.telefono_02);
						    $('#txtCorreoElectronico_sucursales_administracion').val(data.row.correo_electronico);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_sucursales_administracion').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_sucursales_administracion").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmSucursalesAdministracion').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_sucursales_administracion").hide(); 
							
								//Mostrar botón Restaurar
								$("#btnRestaurar_sucursales_administracion").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
					      
				            	//Abrir modal
					            objSucursalesAdministracion = $('#SucursalesAdministracionBox').bPopup({
															  appendTo: '#SucursalesAdministracionContent', 
								                              contentContainer: 'SucursalesAdministracionM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtNombre_sucursales_administracion').focus();
					        }
			       	    }
			       },
			       'json');
		}


		//Función para regresar y obtener los datos de una localidad
		function get_datos_localidad_sucursales_administracion()
		{
			//Hacer un llamado al método del controlador para regresar los datos de la localidad
             $.post('crm/localidades/get_datos',
                  { 
                  	strBusqueda:$("#txtLocalidadID_sucursales_administracion").val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtLocalidad_sucursales_administracion").val(data.row.localidad);
                       $("#txtMunicipio_sucursales_administracion").val(data.row.municipio);
                       $("#txtEstado_sucursales_administracion").val(data.row.estado);
                       $("#txtPais_sucursales_administracion").val(data.row.pais);
                    }
                  }
                 ,
                'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Sucursales
			*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtTelefono01_sucursales_administracion').numeric({decimal: false, negative: false});
        	$('#txtTelefono02_sucursales_administracion').numeric({decimal: false, negative: false});
        	$('#txtCodigoPostal_sucursales_administracion').numeric({decimal: false, negative: false});
        	
			//Comprobar la existencia del nombre en la BD cuando pierda el enfoque la caja de texto
			$('#txtNombre_sucursales_administracion').focusout(function(e){
				//Si no existe id, verificar la existencia del nombre
				if ($('#txtSucursalID_sucursales_administracion').val() == '' && $('#txtNombre_sucursales_administracion').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el nombre 
					editar_sucursales_administracion($('#txtNombre_sucursales_administracion').val(), 'nombre', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de una localidad 
	        $('#txtLocalidad_sucursales_administracion').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtLocalidadID_sucursales_administracion').val('');
	               //Hacer un llamado a la función para inicializar elementos de la localidad
	               inicializar_localidad_sucursales_administracion();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/localidades/autocomplete",
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
	             $('#txtLocalidadID_sucursales_administracion').val(ui.item.data);
	             //Hacer un llamado a la función para regresar los datos de la localidad
	             get_datos_localidad_sucursales_administracion();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la localidad cuando pierda el enfoque la caja de texto
	        $('#txtLocalidad_sucursales_administracion').focusout(function(e){
	            //Si no existe id de la localidad
	            if($('#txtLocalidadID_sucursales_administracion').val() == '' ||
	               $('#txtLocalidad_sucursales_administracion').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtLocalidadID_sucursales_administracion').val('');
	               $('#txtLocalidad_sucursales_administracion').val('');
	               //Hacer un llamado a la función para inicializar elementos de la localidad
	               inicializar_localidad_sucursales_administracion();
	            }
	            
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_sucursales_administracion').on('click','a',function(event){
				event.preventDefault();
				intPaginaSucursalesAdministracion = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_sucursales_administracion();
			});

			//Abrir modal Sucursales cuando se de clic en el botón
			$('#btnNuevo_sucursales_administracion').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_sucursales_administracion();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_sucursales_administracion').addClass("estatus-NUEVO");
				//Abrir modal
				 objSucursalesAdministracion = $('#SucursalesAdministracionBox').bPopup({
											   appendTo: '#SucursalesAdministracionContent', 
				                               contentContainer: 'SucursalesAdministracionM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtNombre_sucursales_administracion').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_sucursales_administracion').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_sucursales_administracion();
		});
	</script>