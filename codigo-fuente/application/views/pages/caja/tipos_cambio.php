	<div id="TiposCambioCajaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_tipos_cambio_caja" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_tipos_cambio_caja" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_tipos_cambio_caja">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_tipos_cambio_caja'>
				                    <input class="form-control" id="txtFechaInicialBusq_tipos_cambio_caja"
				                    		name= "strFechaInicialBusq_tipos_cambio_caja" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Fecha final-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaFinalBusq_tipos_cambio_caja">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_tipos_cambio_caja'>
				                    <input class="form-control" id="txtFechaFinalBusq_tipos_cambio_caja"
				                    		name= "strFechaFinalBusq_tipos_cambio_caja" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene las monedas activas-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la moneda seleccionada-->
								<input id="txtMonedaIDBusq_tipos_cambio_caja" 
									   name="intMonedaIDBusq_tipos_cambio_caja"  type="hidden" 
									   value="">
								</input>
								<label for="txtMonedaBusq_tipos_cambio_caja">Moneda</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMonedaBusq_tipos_cambio_caja" 
										name="strMonedaBusq_tipos_cambio_caja" type="text" value="" tabindex="1" placeholder="Ingrese moneda" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_tipos_cambio_caja"
									onclick="paginacion_tipos_cambio_caja();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_tipos_cambio_caja" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_tipos_cambio_caja"
									onclick="reporte_tipos_cambio_caja('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_tipos_cambio_caja"
									onclick="reporte_tipos_cambio_caja('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Fecha"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Moneda"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Tipo de cambio venta"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Tipo de cambio SAT"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_tipos_cambio_caja">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Fecha</th>
							<th class="movil">Moneda</th>
							<th class="movil">Tipo de cambio venta</th>
							<th class="movil">Tipo de cambio SAT</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_tipos_cambio_caja" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{moneda}}</td>
							<td class="movil">{{tipo_cambio_venta}}</td>
							<td class="movil">{{tipo_cambio_sat}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_tipos_cambio_caja({{tipo_cambio_id}},'id','Editar')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_tipos_cambio_caja"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_tipos_cambio_caja">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="TiposCambioCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_tipos_cambio_caja"  class="ModalBodyTitle">
			<h1>Tipos de Cambio</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmTiposCambioCaja" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmTiposCambioCaja" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtTipoCambioID_tipos_cambio_caja" name="intTipoCambioID_tipos_cambio_caja"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la fecha anterior y así evitar duplicidad en caso de que exista otro registro con la misma fecha-->
									<input id="txtFechaAnterior_tipos_cambio_caja" 
										   name="strFechaAnterior_tipos_cambio_caja" type="hidden" value="">
									</input>
									<label for="txtFecha_tipos_cambio_caja">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_tipos_cambio_caja'>
					                    <input class="form-control" id="txtFecha_tipos_cambio_caja"
					                    		name= "strFecha_tipos_cambio_caja" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
				    	<!--Combobox que contiene las monedas activas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar la moneda anterior y así evitar duplicidad en caso de que exista otro registro con la misma moneda-->
									<input id="txtMonedaIDAnterior_tipos_cambio_caja" 
										   name="intMonedaIDAnterior_tipos_cambio_caja" type="hidden" value="">
									</input>
									<label for="cmbMonedaID_tipos_cambio_caja">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_tipos_cambio_caja" 
									 		name="intMonedaID_tipos_cambio_caja" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio de la venta-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambioVenta_tipos_cambio_caja">Tipo de cambio venta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_tipos_cambio_caja" id="txtTipoCambioVenta_tipos_cambio_caja" 
											name="intTipoCambioVenta_tipos_cambio_caja" type="text" value="" 
											tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="12">
									</input>
								</div>
							</div>
						</div>
						<!--Tipo de cambio del SAT-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambioSat_tipos_cambio_caja">Tipo de cambio SAT</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_tipos_cambio_caja" id="txtTipoCambioSat_tipos_cambio_caja" 
											name="intTipoCambioSat_tipos_cambio_caja" type="text" value="" 
											tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="12">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_tipos_cambio_caja"  
									onclick="validar_tipos_cambio_caja();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_tipos_cambio_caja"
									type="reset" aria-hidden="true" onclick="cerrar_tipos_cambio_caja();" 
									title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#TiposCambioCajaContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_tipos_cambio_caja" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaTiposCambioCaja = 0;
		var strUltimaBusquedaTiposCambioCaja = "";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDTiposCambioCaja = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseTiposCambioCaja = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoTiposCambioCaja = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objTiposCambioCaja = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_tipos_cambio_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/tipos_cambio/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_tipos_cambio_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosTiposCambioCaja = data.row;
					//Separar la cadena 
					var arrPermisosTiposCambioCaja = strPermisosTiposCambioCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosTiposCambioCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosTiposCambioCaja[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_tipos_cambio_caja').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosTiposCambioCaja[i]=='GUARDAR') || (arrPermisosTiposCambioCaja[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_tipos_cambio_caja').removeAttr('disabled');
						}
						else if(arrPermisosTiposCambioCaja[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_tipos_cambio_caja').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_tipos_cambio_caja();
						}
						else if(arrPermisosTiposCambioCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_tipos_cambio_caja').removeAttr('disabled');
						}
						else if(arrPermisosTiposCambioCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_tipos_cambio_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_tipos_cambio_caja() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaTiposCambioCaja = ($('#txtFechaInicialBusq_tipos_cambio_caja').val()+$('#txtFechaFinalBusq_tipos_cambio_caja').val()+$('#txtMonedaIDBusq_tipos_cambio_caja').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaTiposCambioCaja != strUltimaBusquedaTiposCambioCaja)
			{
				intPaginaTiposCambioCaja = 0;
				strUltimaBusquedaTiposCambioCaja = strNuevaBusquedaTiposCambioCaja;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/tipos_cambio/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_tipos_cambio_caja').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_tipos_cambio_caja').val()),
						intMonedaID: $('#txtMonedaIDBusq_tipos_cambio_caja').val(),
						intPagina:intPaginaTiposCambioCaja,
						strPermisosAcceso: $('#txtAcciones_tipos_cambio_caja').val()
					},
					function(data){
						$('#dg_tipos_cambio_caja tbody').empty();
						var tmpTiposCambioCaja = Mustache.render($('#plantilla_tipos_cambio_caja').html(),data);
						$('#dg_tipos_cambio_caja tbody').html(tmpTiposCambioCaja);
						$('#pagLinks_tipos_cambio_caja').html(data.paginacion);
						$('#numElementos_tipos_cambio_caja').html(data.total_rows);
						intPaginaTiposCambioCaja = data.pagina;
					},
			'json');
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_tipos_cambio_caja(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'caja/tipos_cambio/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_tipos_cambio_caja').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_tipos_cambio_caja').val()), 
										'intMonedaID': $('#txtMonedaIDBusq_tipos_cambio_caja').val()
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_tipos_cambio_caja()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_tipos_cambio_caja').empty();
					var temp = Mustache.render($('#monedas_tipos_cambio_caja').html(), data);
					$('#cmbMonedaID_tipos_cambio_caja').html(temp);
				},
				'json');
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_tipos_cambio_caja()
		{
			//Incializar formulario
			$('#frmTiposCambioCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_tipos_cambio_caja();
			//Limpiar cajas de texto ocultas
			$('#frmTiposCambioCaja').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_tipos_cambio_caja').val(fechaActual()); 
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_tipos_cambio_caja');
			//Habilitar todos los elementos del formulario
			$('#frmTiposCambioCaja').find('input, textarea, select').removeAttr('disabled','disabled');
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_tipos_cambio_caja()
		{
			try {
				//Cerrar modal
				objTiposCambioCaja.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_tipos_cambio_caja').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_tipos_cambio_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_tipos_cambio_caja();
			//Validación del formulario de campos obligatorios
			$('#frmTiposCambioCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_tipos_cambio_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_tipos_cambio_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambioVenta_tipos_cambio_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_tipos_cambio_caja').val()) !== intMonedaBaseIDTiposCambioCaja)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoTiposCambioCaja)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoTiposCambioCaja
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										intTipoCambioSat_tipos_cambio_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_tipos_cambio_caja').val()) !== intMonedaBaseIDTiposCambioCaja)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoTiposCambioCaja)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoTiposCambioCaja
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_tipos_cambio_caja = $('#frmTiposCambioCaja').data('bootstrapValidator');
			bootstrapValidator_tipos_cambio_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_tipos_cambio_caja.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_tipos_cambio_caja();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_tipos_cambio_caja()
		{
			try
			{
				$('#frmTiposCambioCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_tipos_cambio_caja()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('caja/tipos_cambio/guardar',
					{ 
						intTipoCambioID: $('#txtTipoCambioID_tipos_cambio_caja').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					    dteFecha: $.formatFechaMysql($('#txtFecha_tipos_cambio_caja').val()),
					    dteFechaAnterior: $.formatFechaMysql($('#txtFechaAnterior_tipos_cambio_caja').val()),
						intMonedaID: $('#cmbMonedaID_tipos_cambio_caja').val(),
						intMonedaIDAnterior: $('#txtMonedaIDAnterior_tipos_cambio_caja').val(),
						intTipoCambioVenta: $('#txtTipoCambioVenta_tipos_cambio_caja').val(),
						intTipoCambioSat: $('#txtTipoCambioSat_tipos_cambio_caja').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_tipos_cambio_caja();
							//Hacer un llamado a la función para cerrar modal
							cerrar_tipos_cambio_caja();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_tipos_cambio_caja(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_tipos_cambio_caja(tipoMensaje, mensaje)
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

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_tipos_cambio_caja(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/tipos_cambio/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_tipos_cambio_caja();
				          	//Recuperar valores
				            $('#txtTipoCambioID_tipos_cambio_caja').val(data.row.tipo_cambio_id);
				            $('#txtFecha_tipos_cambio_caja').val(data.row.fecha);
				            $('#txtFechaAnterior_tipos_cambio_caja').val(data.row.fecha);
				            $('#cmbMonedaID_tipos_cambio_caja').val(data.row.moneda_id);
				            $('#txtMonedaIDAnterior_tipos_cambio_caja').val(data.row.moneda_id);
				            $('#txtTipoCambioVenta_tipos_cambio_caja').val(data.row.tipo_cambio_venta);
				            $('#txtTipoCambioSat_tipos_cambio_caja').val(data.row.tipo_cambio_sat);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_tipos_cambio_caja').addClass("estatus-ACTIVO");

				            //Si el id de la moneda no corresponde al peso mexicano
						    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDTiposCambioCaja)
						    {
								//Habilitar las siguientes cajas de texto
								$("#txtTipoCambioVenta_tipos_cambio_caja").removeAttr('disabled');
								$("#txtTipoCambioSat_tipos_cambio_caja").removeAttr('disabled');
						    }
						    else
						    {
						    	//Deshabilitar las siguientes cajas de texto
							    $("#txtTipoCambioVenta_tipos_cambio_caja").attr('disabled','disabled');
							    $("#txtTipoCambioSat_tipos_cambio_caja").attr('disabled','disabled');
						    }

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objTiposCambioCaja = $('#TiposCambioCajaBox').bPopup({
															  appendTo: '#TiposCambioCajaContent', 
								                              contentContainer: 'TiposCambioCajaM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtFecha_tipos_cambio_caja').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_tipos_cambio_caja()
		{
			//Si no existe id, verificar la existencia de la fecha y la moneda
			if ($('#txtTipoCambioID_tipos_cambio_caja').val() == '' && $('#cmbMonedaID_tipos_cambio_caja').val() != '')
			{
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_tipos_cambio_caja').val());

				//Concatenar criterios de búsqueda (para poder verificar la existencia de la fecha y la moneda)
				var strCriteriosBusqTiposCambioCaja = dteFecha+'|'+$('#cmbMonedaID_tipos_cambio_caja').val();
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con los criterios de búsqueda  
				editar_tipos_cambio_caja(strCriteriosBusqTiposCambioCaja, 'fecha', 'Nuevo');
			}
		}


		//Función para verificar el valor del tipo de cambio (no debe ser mayor al valor máximo permitido)
		function verificar_tipo_cambio_tipos_cambio_caja(campoID)
		{
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambio = parseFloat($.reemplazar($('#'+campoID).val(), ",", ""));

			//Si el tipo de cambio es mayor que el valor máximo permitido
        	if(intTipoCambio > intTipoCambioMaximoTiposCambioCaja)
        	{
        		$('#'+campoID).val(intTipoCambioMaximoTiposCambioCaja);
        	}
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_tipos_cambio_caja').numeric();

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_tipos_cambio_caja').blur(function(){
                $('.tipo-cambio_tipos_cambio_caja').formatCurrency({ roundToDecimalPlace: 4 });
            });

            //Agregar datepicker para seleccionar fecha
			$('#dteFecha_tipos_cambio_caja').datetimepicker({format: 'DD/MM/YYYY'});

			//Comprobar la existencia de la fecha y la moneda en la BD cuando cambie la fecha
			$('#dteFecha_tipos_cambio_caja').on('dp.change', function (e) {
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_tipos_cambio_caja();
			});


	        //Habilitar o deshabilitar tipo de cambio y comprobar la existencia de la moneda en la BD
	        //cuando cambie la opción del combobox
	        $('#cmbMonedaID_tipos_cambio_caja').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_tipos_cambio_caja').val()) === intMonedaBaseIDTiposCambioCaja)
             	{
             		//Deshabilitar las siguientes cajas de texto
					$("#txtTipoCambioVenta_tipos_cambio_caja").attr('disabled','disabled');
					$("#txtTipoCambioSat_tipos_cambio_caja").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambioVenta_tipos_cambio_caja').val(intTipoCambioMonedaBaseTiposCambioCaja);
					$('#txtTipoCambioSat_tipos_cambio_caja').val(intTipoCambioMonedaBaseTiposCambioCaja);
				    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambioVenta_tipos_cambio_caja').formatCurrency({ roundToDecimalPlace: 4 }); 
					$('#txtTipoCambioSat_tipos_cambio_caja').formatCurrency({ roundToDecimalPlace: 4 }); 
             	}
             	else
             	{
             		//Habilitar las siguientes cajas de texto
					$("#txtTipoCambioVenta_tipos_cambio_caja").removeAttr('disabled');
					$("#txtTipoCambioSat_tipos_cambio_caja").removeAttr('disabled');
					//Limpiar contenido de las cajas de texto
					$('#txtTipoCambioVenta_tipos_cambio_caja').val(''); 
					$('#txtTipoCambioSat_tipos_cambio_caja').val(''); 
             	}

             	//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_tipos_cambio_caja();
				
	        });


	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambioVenta_tipos_cambio_caja').focusout(function(e){
	        	//Hacer un llamado a la función para verificar el tipo de cambio
	        	verificar_tipo_cambio_tipos_cambio_caja('txtTipoCambioVenta_tipos_cambio_caja');

		    });

		    //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambioSat_tipos_cambio_caja').focusout(function(e){

	        	//Hacer un llamado a la función para verificar el tipo de cambio
	        	verificar_tipo_cambio_tipos_cambio_caja('txtTipoCambioSat_tipos_cambio_caja');

		    });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_tipos_cambio_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_tipos_cambio_caja').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_tipos_cambio_caja').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_tipos_cambio_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_tipos_cambio_caja').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_tipos_cambio_caja').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de una moneda 
	        $('#txtMonedaBusq_tipos_cambio_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMonedaIDBusq_tipos_cambio_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_monedas/autocomplete",
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
	             $('#txtMonedaIDBusq_tipos_cambio_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la moneda cuando pierda el enfoque la caja de texto
	        $('#txtMonedaBusq_tipos_cambio_caja').focusout(function(e){
	            //Si no existe id de la moneda
	            if($('#txtMonedaIDBusq_tipos_cambio_caja').val() == '' ||
	            	$('#txtMonedaBusq_tipos_cambio_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMonedaIDBusq_tipos_cambio_caja').val('');
	               $('#txtMonedaBusq_tipos_cambio_caja').val('');
	            }
	            
	        });

			//Paginación de registros
			$('#pagLinks_tipos_cambio_caja').on('click','a',function(event){
				event.preventDefault();
				intPaginaTiposCambioCaja = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_tipos_cambio_caja();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_tipos_cambio_caja').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_tipos_cambio_caja();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_tipos_cambio_caja').addClass("estatus-NUEVO");
				//Abrir modal
				 objTiposCambioCaja = $('#TiposCambioCajaBox').bPopup({
											   appendTo: '#TiposCambioCajaContent', 
				                               contentContainer: 'TiposCambioCajaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtFecha_tipos_cambio_caja').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_tipos_cambio_caja').focus(); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_tipos_cambio_caja();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_tipos_cambio_caja();
		});
	</script>