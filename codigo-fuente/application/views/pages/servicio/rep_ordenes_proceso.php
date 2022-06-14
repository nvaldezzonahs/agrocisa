	<div id="RepOrdenesProcesoServicioContent">  
		<!--Diseño del formulario-->
		<form id="frmRepOrdenesProcesoServicio" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepOrdenesProcesoServicio" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_ordenes_proceso_servicio"
									onclick="validar_rep_ordenes_proceso_servicio('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_ordenes_proceso_servicio"
									onclick="validar_rep_ordenes_proceso_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				<div class="row">
					<!--Fecha de corte-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaCorte_rep_ordenes_proceso_servicio">Fecha de corte</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaCorte_rep_ordenes_proceso_servicio'>
				                    <input class="form-control" id="txtFechaCorte_rep_ordenes_proceso_servicio"
				                    		name= "strFechaCorte_rep_ordenes_proceso_servicio" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene los prospectos y clientes activos-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del prospecto/cliente seleccionado-->
								<input id="txtProspectoID_rep_ordenes_proceso_servicio" 
									   name="intProspectoID_rep_ordenes_proceso_servicio"  type="hidden" 
									   value="">
								</input>
								<label for="txtProspecto_rep_ordenes_proceso_servicio">Cliente</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProspecto_rep_ordenes_proceso_servicio" 
										name="strProspecto_rep_ordenes_proceso_servicio" type="text" value="" tabindex="1" placeholder="Ingrese cliente" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene los mecánicos activos-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del mecánico seleccionado-->
								<input id="txtMecanicoID_rep_ordenes_proceso_servicio" 
									   name="intMecanicoID_rep_ordenes_proceso_servicio"  type="hidden" 
									   value="">
								</input>
								<label for="txtMecanico_rep_ordenes_proceso_servicio">Mecánico</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMecanico_rep_ordenes_proceso_servicio" 
										name="strMecanico_rep_ordenes_proceso_servicio" type="text" value="" tabindex="1" placeholder="Ingrese mecánico" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Lista de sucursales activas a las que tiene acceso el usuario-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Sucursales:</label>
							</div>
							<div class="col-md-12" id="chkSucursales_rep_ordenes_proceso_servicio"></div>
						</div>	
					</div>
					<!--Lista de tipos de servicios activos-->
					<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Tipos de servicios:</label>
							</div>
							<div class="col-md-12" id="chkServiciosTipos_rep_ordenes_proceso_servicio"></div>
						</div>	
					</div>
				</div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepOrdenesProcesoServicioContent -->

	<!-- /.Plantilla para cargar los tipos de servicio-->  
	<script id="servicios_tipos_rep_ordenes_proceso_servicio" type="text/template">
		{{#tipos}}
		<div class="form-check form-check-inline">
		  <input class="form-check-input-chk" type="checkbox" id="chkServicioTipo{{value}}_rep_ordenes_proceso_servicio" 
		  		 name="chkServiciosTipos_rep_ordenes_proceso_servicio[]" value="{{value}}" checked>
		  <label class="form-check-label" for="{{value}}">{{nombre}}</label>
		</div>
		{{/tipos}} 
	</script>
	<!-- /.Plantilla para cargar las sucursales-->  
	<script id="sucursales_rep_ordenes_proceso_servicio" type="text/template">
		{{#sucursales}}
		<div class="form-check form-check-inline">
		  <input class="form-check-input-chk" type="checkbox" id="chkSucursal{{value}}_rep_ordenes_proceso_servicio" 
		  		 name="chkSucursales_rep_ordenes_proceso_servicio[]" value="{{value}}" checked>
		  <label class="form-check-label" for="{{value}}">{{nombre}}</label>
		</div>
		{{/sucursales}} 
	</script>
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_ordenes_proceso_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/rep_ordenes_proceso/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_ordenes_proceso_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepOrdenesProcesoServicio = data.row;
					//Separar la cadena 
					var arrPermisosRepOrdenesProcesoServicio = strPermisosRepOrdenesProcesoServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepOrdenesProcesoServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepOrdenesProcesoServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_ordenes_proceso_servicio').removeAttr('disabled');
						}
						else if(arrPermisosRepOrdenesProcesoServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_ordenes_proceso_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_ordenes_proceso_servicio(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_ordenes_proceso_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmRepOrdenesProcesoServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaCorte_rep_ordenes_proceso_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strProspecto_rep_ordenes_proceso_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del prospecto
					                                    if(value !== '' && $('#txtProspectoID_rep_ordenes_proceso_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un prospecto existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMecanico_rep_ordenes_proceso_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del mecánico
					                                    if(value !== '' && $('#txtMecanicoID_rep_ordenes_proceso_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un mecánico existente'
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
			var bootstrapValidator_rep_ordenes_proceso_servicio = $('#frmRepOrdenesProcesoServicio').data('bootstrapValidator');
			bootstrapValidator_rep_ordenes_proceso_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_ordenes_proceso_servicio.isValid())
			{
				//Arreglo para obtener sucursales seleccionadas
				var chkSucursalesArray = [];
				chkSucursalesArray = sucursales_seleccionadas_rep_ordenes_proceso_servicio();

				//Arreglo para obtener tipos de servicios seleccionados
				var chkServiciosTiposArray = [];
				chkServiciosTiposArray = servicios_tipos_seleccionados_rep_ordenes_proceso_servicio();

				//Verificamos que al menos se encuentre una sucursal y un tipo de servicio seleccionado
				if(chkSucursalesArray.length > 0 && chkServiciosTiposArray.length > 0)
				{
					//Array que se utiliza para agregar sucursales
					var arrSucursales = chkSucursalesArray.join('|');
					//Array que se utiliza para agregar tipos de servicios
					var arrServiciosTipos = chkServiciosTiposArray.join('|');
					//Hacer un llamado a la función para generar reporte en PDF/XLS
					reporte_rep_ordenes_proceso_servicio(strTipo, arrSucursales, arrServiciosTipos);
				}
				else
				{
					//Indicar al usuario el mensaje de error
					new $.Zebra_Dialog('Es necesario seleccionar al menos una sucursal y un tipo de servicio.',
									   {'type': 'error', 
									   'title': 'Error'});
				}

			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_ordenes_proceso_servicio()
		{
			try
			{
				$('#frmRepOrdenesProcesoServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_ordenes_proceso_servicio(strTipo, arrSucursales, arrServiciosTipos) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/rep_ordenes_proceso/';

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
										'dteFechaCorte': $.formatFechaMysql($('#txtFechaCorte_rep_ordenes_proceso_servicio').val()), 
										'strSucursales': arrSucursales, 		
										'strServiciosTipos': arrServiciosTipos,
										'intProspectoID': $('#txtProspectoID_rep_ordenes_proceso_servicio').val(), 
										'intMecanicoID': $('#txtMecanicoID_rep_ordenes_proceso_servicio').val()
										
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		//Regresar tipos de servicios activos para cargarlas en el combobox
		function cargar_servicios_tipos_rep_ordenes_proceso_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los tipos de servicios que se encuentran activas 
			$.post('servicio/servicios_tipos/get_combo_box', {},
				function(data)
				{
					$('#chkServiciosTipos_rep_ordenes_proceso_servicio').empty();
					var temp = Mustache.render($('#servicios_tipos_rep_ordenes_proceso_servicio').html(), data);
					$('#chkServiciosTipos_rep_ordenes_proceso_servicio').html(temp);
				},
				'json');
		}

		//Función para obtener los tipos de servicios seleccionados
		function servicios_tipos_seleccionados_rep_ordenes_proceso_servicio(){

			//Declaramos el arreglo que contendrá los tipos de servicios seleccionados
			var chkServiciosTiposArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkServiciosTipos_rep_ordenes_proceso_servicio[]"]:checked').each(function() {
				chkServiciosTiposArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkServiciosTiposArray.join('|');

			//Regresar array con los tipos de servicios seleccionados
			return chkServiciosTiposArray;
		}


		//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
		function cargar_sucursales_rep_ordenes_proceso_servicio()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box/home', {},
				function(data)
				{
					$('#chkSucursales_rep_ordenes_proceso_servicio').empty();
					var temp = Mustache.render($('#sucursales_rep_ordenes_proceso_servicio').html(), data)
					$('#chkSucursales_rep_ordenes_proceso_servicio').html(temp);
				},
				'json');
		}


		//Función para obtener las sucursales seleccionadas
		function sucursales_seleccionadas_rep_ordenes_proceso_servicio(){

			//Declaramos el arreglo  que contendrá las sucursales seleccionadas
			var chkSucursalesArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkSucursales_rep_ordenes_proceso_servicio[]"]:checked').each(function() {
				chkSucursalesArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkSucursalesArray.join('|');
			
			//Regresar array con las sucursales seleccionadas
			return chkSucursalesArray;

		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaCorte_rep_ordenes_proceso_servicio').datetimepicker({format: 'DD/MM/YYYY'});

			//Autocomplete para recuperar los datos de un prospecto o cliente
	        $('#txtProspecto_rep_ordenes_proceso_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_rep_ordenes_proceso_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/prospectos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'referencias'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtProspectoID_rep_ordenes_proceso_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del prospecto cuando pierda el enfoque la caja de texto
	        $('#txtProspecto_rep_ordenes_proceso_servicio').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoID_rep_ordenes_proceso_servicio').val() == '' ||
	               $('#txtProspecto_rep_ordenes_proceso_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_rep_ordenes_proceso_servicio').val('');
	               $('#txtProspecto_rep_ordenes_proceso_servicio').val('');
	            }

	        });
			
			//Autocomplete para recuperar los datos de un mecánico 
	        $('#txtMecanico_rep_ordenes_proceso_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMecanicoID_rep_ordenes_proceso_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/mecanicos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'acumulados'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar valores del registro seleccionado
	             $('#txtMecanicoID_rep_ordenes_proceso_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del mecánico cuando pierda el enfoque la caja de texto
	        $('#txtMecanico_rep_ordenes_proceso_servicio').focusout(function(e){
	            //Si no existe id del mecánico
	            if($('#txtMecanicoID_rep_ordenes_proceso_servicio').val() == '' ||
	               $('#txtMecanico_rep_ordenes_proceso_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMecanicoID_rep_ordenes_proceso_servicio').val('');
	               $('#txtMecanico_rep_ordenes_proceso_servicio').val('');
	            }
	            
	        });
			
			//Asignar la fecha actual
       		$('#txtFechaCorte_rep_ordenes_proceso_servicio').val(fechaActual()); 
			//Enfocar caja de texto
			$('#txtProspecto_rep_ordenes_proceso_servicio').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_ordenes_proceso_servicio();
			//Hacer un llamado a la función para cargar sucursales y armar los checklist
  			cargar_sucursales_rep_ordenes_proceso_servicio();
  			//Hacer un llamado a la función para cargar tipos de servicios en el combobox del modal
            cargar_servicios_tipos_rep_ordenes_proceso_servicio();

		});
	</script>
	