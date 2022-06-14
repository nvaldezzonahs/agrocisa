	<div id="VerificacionesFederalesControlVehiculosContent">  
		<!--Barra de vehiculos-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_verificaciones_federales_control_vehiculos" action="#" method="post" 
				  tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_verificaciones_federales_control_vehiculos" 
								   name="strBusqueda_verificaciones_federales_control_vehiculos"  type="text" value="" tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" 
										id="btnBuscar_verificaciones_federales_control_vehiculos"
										onclick="paginacion_verificaciones_federales_control_vehiculos();" 
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
							<button class="btn btn-info" id="btnNuevo_verificaciones_federales_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_verificaciones_federales_control_vehiculos"
									onclick="reporte_verificaciones_federales_control_vehiculos();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_verificaciones_federales_control_vehiculos"
									onclick="descargar_xls_verificaciones_federales_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Dígito"; font-weight: bold;}
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
				<table class="table-hover movil" id="dg_verificaciones_federales_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Dígito</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_verificaciones_federales_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil">{{digito}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_verificaciones_federales_control_vehiculos({{digito}}, 'id', 'Editar')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_verificaciones_federales_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_verificaciones_federales_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="VerificacionesFederalesControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_verificaciones_federales_control_vehiculos"  class="ModalBodyTitle">
			<h1>Verificaciones federales</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmVerificacionesFederalesControlVehiculos" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmVerificacionesFederalesControlVehiculos"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
					    <!--Estado-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para indicar la existencia del presupuesto y así poder actualizar los registros-->
									<input id="txtNuevoID_verificaciones_federales_control_vehiculos" 
									   name="strNuevoID_verificaciones_federales_control_vehiculos"  
									   type="hidden" value="" />	   
									<label for="txtDigito_verificaciones_federales_control_vehiculos">Dígito</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtDigito_verificaciones_federales_control_vehiculos" 
											name="intDigito_verificaciones_federales_control_vehiculos" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="Ingrese dígito" 
											maxlength="1" />
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Enero-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbEnero_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbEnero_verificaciones_federales_control_vehiculos" 
												   name="strEnero_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Enero
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
						<!--Febrero-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbFebrero_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbFebrero_verificaciones_federales_control_vehiculos" 
												   name="strFebrero_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Febrero
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
						<!--Marzo-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbMarzo_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbMarzo_verificaciones_federales_control_vehiculos" 
												   name="strMarzo_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Marzo
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
						<!--Abril-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbAbril_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbAbril_verificaciones_federales_control_vehiculos" 
												   name="strAbril_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Abril
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
						<!--Mayo-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbMayo_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbMayo_verificaciones_federales_control_vehiculos" 
												   name="strMayo_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Mayo
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
						<!--Junio-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbJunio_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbJunio_verificaciones_federales_control_vehiculos" 
												   name="strJunio_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Junio
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
				    </div>
				    <br>
				    <div class="row">
						<!--Julio-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbJulio_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbJulio_verificaciones_federales_control_vehiculos" 
												   name="strJulio_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Julio
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
						<!--Agosto-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbAgosto_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbAgosto_verificaciones_federales_control_vehiculos" 
												   name="strAgosto_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Agosto
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
						<!--Septiembre-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbSeptiembre_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbSeptiembre_verificaciones_federales_control_vehiculos" 
												   name="strSeptiembre_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Septiembre
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
						<!--Octubre-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbOctubre_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbOctubre_verificaciones_federales_control_vehiculos" 
												   name="strOctubre_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Octubre
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
						<!--Noviembre-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbNoviembre_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbNoviembre_verificaciones_federales_control_vehiculos" 
												   name="strNoviembre_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Noviembre
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
						<!--Diciembre-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbDiciembre_verificaciones_federales_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" 
				                        		   id="chbDiciembre_verificaciones_federales_control_vehiculos" 
												   name="strDiciembre_verificaciones_federales_control_vehiculos" 
												   type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Diciembre
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
				    </div>
				    <br>	
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_verificaciones_federales_control_vehiculos"  
									onclick="validar_verificaciones_federales_control_vehiculos();"  title="Guardar" tabindex="1" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_verificaciones_federales_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_verificaciones_federales_control_vehiculos();" title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#VerificacionesFederalesControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaVerificacionesFederalesControlVehiculos = 0;
		var strUltimaBusquedaVerificacionesFederalesControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objVerificacionesFederalesControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_verificaciones_federales_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/verificaciones_estatales/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_verificaciones_federales_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosVerificacionesFederalesControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosVerificacionesFederalesControlVehiculos = strPermisosVerificacionesFederalesControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosVerificacionesFederalesControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosVerificacionesFederalesControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_verificaciones_federales_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosVerificacionesFederalesControlVehiculos[i]=='GUARDAR') || (arrPermisosVerificacionesFederalesControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_verificaciones_federales_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosVerificacionesFederalesControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_verificaciones_federales_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_verificaciones_federales_control_vehiculos();
						}
						else if(arrPermisosVerificacionesFederalesControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_verificaciones_federales_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosVerificacionesFederalesControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_verificaciones_federales_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_verificaciones_federales_control_vehiculos() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_verificaciones_federales_control_vehiculos').val() != strUltimaBusquedaVerificacionesFederalesControlVehiculos)
			{
				intPaginaVerificacionesFederalesControlVehiculos = 0;
				strUltimaBusquedaVerificacionesFederalesControlVehiculos = $('#txtBusqueda_verificaciones_federales_control_vehiculos').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/verificaciones_federales/get_paginacion',
					{	
						strBusqueda:$('#txtBusqueda_verificaciones_federales_control_vehiculos').val(),
						intPagina:intPaginaVerificacionesFederalesControlVehiculos,
						strPermisosAcceso: $('#txtAcciones_verificaciones_federales_control_vehiculos').val()
					},
					function(data){
						$('#dg_verificaciones_federales_control_vehiculos tbody').empty();
						var tmpVerificacionesFederalesControlVehiculos = Mustache.render($('#plantilla_verificaciones_federales_control_vehiculos').html(),data);
						$('#dg_verificaciones_federales_control_vehiculos tbody').html(tmpVerificacionesFederalesControlVehiculos);
						$('#pagLinks_verificaciones_federales_control_vehiculos').html(data.paginacion);
						$('#numElementos_verificaciones_federales_control_vehiculos').html(data.total_rows);
						intPaginaVerificacionesFederalesControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_verificaciones_federales_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/verificaciones_federales/get_reporte/"+$('#txtBusqueda_verificaciones_federales_control_vehiculos').val());
		}
		
		//Función para descargar el reporte general en XLS
		function descargar_xls_verificaciones_federales_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("control_vehiculos/verificaciones_federales/get_xls/"+$('#txtBusqueda_verificaciones_federales_control_vehiculos').val());
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_verificaciones_federales_control_vehiculos()
		{
			//Incializar formulario
			$('#frmVerificacionesFederalesControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_verificaciones_federales_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmVerificacionesFederalesControlVehiculos').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_verificaciones_federales_control_vehiculos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_verificaciones_federales_control_vehiculos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_verificaciones_federales_control_vehiculos').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmVerificacionesFederalesControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_verificaciones_federales_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_verificaciones_federales_control_vehiculos").hide();
			$("#btnRestaurar_verificaciones_federales_control_vehiculos").hide();
			//Deshabilitar los siguientes componentes
			$('#txtLicencia_verificaciones_federales_control_vehiculos').attr('disabled','-1');
			$('#txtTipoLicencia_verificaciones_federales_control_vehiculos').attr('disabled','-1');
			$('#txtVigenciaLicencia_verificaciones_federales_control_vehiculos').attr('disabled','-1');  
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_verificaciones_federales_control_vehiculos()
		{
			try {
				//Cerrar modal
				objVerificacionesFederalesControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_verificaciones_federales_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_verificaciones_federales_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_verificaciones_federales_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmVerificacionesFederalesControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intDigito_verificaciones_federales_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba un dígito'}
											}
										}
									}
				});

			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_verificaciones_federales_control_vehiculos = $('#frmVerificacionesFederalesControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_verificaciones_federales_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_verificaciones_federales_control_vehiculos.isValid())
			{
				//Variable para meses seleccionados
				var meses_seleccionados = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

				if ($('#chbEnero_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[0] = 1;
				}
				else{
					meses_seleccionados[0] = 0;
				}
				if ($('#chbFebrero_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[1] = 1;
				}
				else{
					meses_seleccionados[1] = 0;
				}
				if ($('#chbMarzo_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[2] = 1;
				}
				else{
					meses_seleccionados[2] = 0;
				}
				if ($('#chbAbril_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[3] = 1;
				}
				else{
					meses_seleccionados[3] = 0;
				}
				if ($('#chbMayo_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[4] = 1;
				}
				else{
					meses_seleccionados[4] = 0;
				}
				if ($('#chbJunio_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[5] = 1;
				}
				else{
					meses_seleccionados[5] = 0;
				}
				if ($('#chbJulio_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[6] = 1;
				}
				else{
					meses_seleccionados[6] = 0;
				}
				if ($('#chbAgosto_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[7] = 1;
				}
				else{
					meses_seleccionados[7] = 0;
				}
				if ($('#chbSeptiembre_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[8] = 1;
				}
				else{
					meses_seleccionados[8] = 0;
				}
				if ($('#chbOctubre_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[9] = 1;
				}
				else{
					meses_seleccionados[9] = 0;
				}
				if ($('#chbNoviembre_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[10] = 1;
				}
				else{
					meses_seleccionados[10] = 0;
				}
				if ($('#chbDiciembre_verificaciones_federales_control_vehiculos').is(':checked')) {
				    meses_seleccionados[11] = 1;
				}
				else{
					meses_seleccionados[11] = 0;
				}


				//Bloque de código para obtener de manera la cantidad de checkboxes que han sido seleccionados
				var maximo_meses = 0;
				for (i = 0; i < meses_seleccionados.length; i++) { 
				    if( meses_seleccionados[i] == 1 ){
				    	maximo_meses++;
				    }
				}

				if(maximo_meses < 1){
					//Indicar al usuario que debe ingresar al menos un importe
					new $.Zebra_Dialog('Debe seleccionar mínimo 1 mes.', {
							'type': 'error',
							'title': 'Error',
							'buttons': [{caption: 'Aceptar',
										 callback: function () {
										 	//Hacer un llamado a la función para limpiar los mensajes de error 
											limpiar_mensajes_verificaciones_federales_control_vehiculos();
											//Enfocar caja de texto
											$('#txtDigito_verificaciones_federales_control_vehiculos').focus();
										 }
										}]
						});
				}
				else{

					if(maximo_meses > 4){
						//Indicar al usuario que debe ingresar al menos un importe
						new $.Zebra_Dialog('Solo puede seleccionar máximo 4 meses diferentes.', {
								'type': 'error',
								'title': 'Error',
								'buttons': [{caption: 'Aceptar',
											 callback: function () {
											 	//Hacer un llamado a la función para limpiar los mensajes de error 
												limpiar_mensajes_verificaciones_federales_control_vehiculos();
												//Enfocar caja de texto
												$('#txtDigito_verificaciones_federales_control_vehiculos').focus();
											 }
											}]
							});
					}
					else
					{
						//Hacer un llamado a la función para guardar los datos del registro
						guardar_verificaciones_federales_control_vehiculos(meses_seleccionados);
					}

				}	
				
			}
			else 
				return;


		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_verificaciones_federales_control_vehiculos()
		{
			try
			{
				$('#frmVerificacionesFederalesControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_verificaciones_federales_control_vehiculos(meses_seleccionados)
		{
			
			//Inicializamos la variable que obtendrá los meses seleccionados
			var arrMesesSeleccionados = [];
			
			//Crear el arreglo con los meses seleccionados en el formato: 01|02|03|04
			for (var i = 0; i < meses_seleccionados.length; i++) { 
			    if( meses_seleccionados[i] == 1 ){
			    	var intMes = i + 1;
					var mesFormateado = ("0" + intMes).slice(-2);
					arrMesesSeleccionados.push(mesFormateado);
			    }
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/verificaciones_federales/guardar',
			{ 
				strNuevoID: $('#txtNuevoID_verificaciones_federales_control_vehiculos').val(),
				intDigito: $('#txtDigito_verificaciones_federales_control_vehiculos').val(),
				strMesesSeleccionados: arrMesesSeleccionados.join('|')
			},
			function(data) {
				if (data.resultado)
				{
					//Hacer llamado a la función  para cargar los registros en el grid
					paginacion_verificaciones_federales_control_vehiculos();
					//Hacer un llamado a la función para cerrar modal
					cerrar_verificaciones_federales_control_vehiculos();                  
				}
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_verificaciones_federales_control_vehiculos(data.tipo_mensaje, data.mensaje);
			},
			'json');
						
			
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_verificaciones_federales_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_verificaciones_federales_control_vehiculos(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtVehiculoID_verificaciones_federales_control_vehiculos').val();

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
				                                         	paginacion_verificaciones_federales_control_vehiculos();
				                                          	
				                                          	//Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_verificaciones_federales_control_vehiculos();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_verificaciones_federales_control_vehiculos(data.tipo_mensaje, data.mensaje);
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
				     {
				     	intVehiculoID: intID,
				      	strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_verificaciones_federales_control_vehiculos();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_verificaciones_federales_control_vehiculos();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_verificaciones_federales_control_vehiculos(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_verificaciones_federales_control_vehiculos(busqueda, tipoBusqueda, tipoAccion)
		{				
		   //Hacer un llamado al método del controlador para regresar los datos del registro
		   $.post('control_vehiculos/verificaciones_federales/get_datos',
	       {
	       		intDigito: busqueda,
	       		strTipo: tipoBusqueda
	       },
	       function(data) {	       		
	        	//Si hay datos del registro
	            if(data.row)
	            {

	            	//Hacer un llamado a la función para limpiar los campos del formulario
					nuevo_verificaciones_federales_control_vehiculos();
				   
		          	//Recuperar valores
		       		//NuevoID y Dígito
		       		$('#txtNuevoID_verificaciones_federales_control_vehiculos').val(data.row[0].digito);
		       		$('#txtDigito_verificaciones_federales_control_vehiculos').val(data.row[0].digito);

		       		//Meses seleccionados
		       		var meses_seleccionados = data.row[0].meses.split("|");

		       		for (var i = 0; i < meses_seleccionados.length; i++) { 
					    
					    switch ( meses_seleccionados[i] ) {
						    case '01':
						        $('#chbEnero_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;
						    case '02':
						        $('#chbFebrero_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;
						    case '03':
						        $('#chbMarzo_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;
						    case '04':
						        $('#chbAbril_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;
						    case '05':
						        $('#chbMayo_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;
						    case '06':
						        $('#chbJunio_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;
						    case '07':
						        $('#chbJulio_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;
						    case '08':
						        $('#chbAgosto_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;
						    case '09':
						        $('#chbSeptiembre_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;
						    case '10':
						        $('#chbOctubre_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;
						    case '11':
						        $('#chbNoviembre_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;
						    case '12':
						        $('#chbDiciembre_verificaciones_federales_control_vehiculos').prop('checked', true);
						        break;                    
						}

					}

		            //Dependiendo del estatus cambiar el color del encabezado 
		            $('#divEncabezadoModal_verificaciones_federales_control_vehiculos').removeClass('estatus-NUEVO').addClass("estatus-ACTIVO");
		            //Si el tipo de acción es diferente de Nuevo
		            if(tipoAccion != 'Nuevo')
		            {
		            	//Abrir modal
			            objVerificacionesFederalesControlVehiculos = $('#VerificacionesFederalesControlVehiculosBox').bPopup({
													  appendTo: '#VerificacionesFederalesControlVehiculosContent', 
						                              contentContainer: 'VerificacionesFederalesControlVehiculosM', 
						                              zIndex: 2, 
						                              modalClose: false, 
						                              modal: true, 
						                              follow: [true,false], 
						                              followEasing : "linear", 
						                              easing: "linear", 
						                              modalColor: ('#F0F0F0')});

			            //Enfocar caja de texto
						$('#txtDigito_verificaciones_federales_control_vehiculos').focus();
			        }			        
			        
	       	    }else{

	       	    	//Dependiendo del estatus cambiar el color del encabezado 
		            $('#divEncabezadoModal_verificaciones_federales_control_vehiculos').removeClass('estatus-ACTIVO').addClass("estatus-NUEVO");
		            $('#frmVerificacionesFederalesControlVehiculos input[type=checkbox]').prop('checked', false);
		              $('#txtNuevoID_verificaciones_federales_control_vehiculos').val('');
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
			$('#txtDigito_verificaciones_federales_control_vehiculos').numeric();
			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_verificaciones_federales_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaVerificacionesFederalesControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_verificaciones_federales_control_vehiculos();
			});

				//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtDigito_verificaciones_federales_control_vehiculos').change(function(e){				
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código
				if ($('#txtDigito_verificaciones_federales_control_vehiculos').val()){
					editar_verificaciones_federales_control_vehiculos($('#txtDigito_verificaciones_federales_control_vehiculos').val(), 'codigo', 'Nuevo');
				}
				
			});

			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtDigito_verificaciones_federales_control_vehiculos').focusout(function(e){			
				//Si no existe id, verificar la existencia del código 
				if ($('#txtNuevoID_verificaciones_federales_control_vehiculos').val() == '' && $('#txtDigito_verificaciones_federales_control_vehiculos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código
					editar_verificaciones_federales_control_vehiculos($('#txtDigito_verificaciones_federales_control_vehiculos').val(), 'codigo', 'Nuevo');
				}
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_verificaciones_federales_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_verificaciones_federales_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_verificaciones_federales_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				 objVerificacionesFederalesControlVehiculos = $('#VerificacionesFederalesControlVehiculosBox').bPopup({
											   appendTo: '#VerificacionesFederalesControlVehiculosContent', 
				                               contentContainer: 'VerificacionesFederalesControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_verificaciones_federales_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_verificaciones_federales_control_vehiculos').focus();   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_verificaciones_federales_control_vehiculos();
		});
	</script>