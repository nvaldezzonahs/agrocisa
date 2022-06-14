	<div id="RepFacturacionServicioContent">  
		<!--Diseño del formulario-->
		<form id="frmRepFacturacionServicio" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepFacturacionServicio" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_facturacion_servicio"
									onclick="validar_rep_facturacion_servicio('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_facturacion_servicio"
									onclick="validar_rep_facturacion_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicial_rep_facturacion_servicio">Fecha inicial</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_facturacion_servicio'>
				                    <input class="form-control" id="txtFechaInicial_rep_facturacion_servicio"
				                    		name= "strFechaInicial_rep_facturacion_servicio" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Fecha final-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaFinal_rep_facturacion_servicio">Fecha final</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_facturacion_servicio'>
				                    <input class="form-control" id="txtFechaFinal_rep_facturacion_servicio"
				                    		name= "strFechaFinal_rep_facturacion_servicio" 
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
					<div class="col-md-12">
						<label for="txtIncluirApartados_rep_facturacion_servicio">Incluir:</label>
					</div>
					<!--Lista de tipos de servicios a facturar-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						 <div class="form-group row">
							<div class="checkbox" id="chkServiciosTipos_rep_facturacion_servicio"></div>
						</div>
					</div>
				</div>
			    <div class="row">
			    	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			    		<!--Tipo de reporte -->							
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbTipoReporte_rep_facturacion_servicio">Tipo de reporte</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select class="form-control" id="cmbTipoReporte_rep_facturacion_servicio" 
								 		name="strTipoReporte_rep_facturacion_servicio" tabindex="1">
                      				<option value="">Seleccione una opción</option>                  
									<option value="SEPARADO_SERVICIO_TIPO">Separado por tipo de servicio</option>
									<option value="ORDENADO_CONSECUTIVO">Ordenado por consecutivo</option>
									<option value="ACUMULADO_FACTURACION">Acumulado de facturación</option>
                 				</select>
							</div>
						</div>
			    	</div>
			    	<!--Incluir detalles-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbIncluirDetalleFras_rep_facturacion_servicio" 
									   name="strIncluirDetalleFras_rep_facturacion_servicio" type="checkbox"
									   value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Incluir detalle de facturas
	                    	</label>
	                  	</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene los clientes activos-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
								<input id="txtProspectoID_rep_facturacion_servicio" name="intProspectoID_rep_facturacion_servicio"  
									   type="hidden" value="" />
								<label for="txtRazonSocial_rep_facturacion_servicio">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocial_rep_facturacion_servicio" 
										name="strRazonSocial_rep_facturacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250" />
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Lista de sucursales activas a las que tiene acceso el usuario-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Sucursales:</label>
							</div>
							<div class="col-md-12" id="chkSucursales_rep_facturacion_servicio"></div>
						</div>	
					</div>	
				</div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepFacturacionServicioContent -->

	<!-- /.Plantilla para cargar las sucursales-->  
	<script id="sucursales_rep_facturacion_servicio" type="text/template">
		{{#sucursales}}
		<div class="form-check form-check-inline">
		  <input class="form-check-input-chk" type="checkbox" id="chkSucursal{{value}}_rep_facturacion_servicio" 
		  		 name="chkSucursales_rep_facturacion_servicio[]" value="{{value}}" checked>
		  <label class="form-check-label" for="{{value}}">{{nombre}}</label>
		</div>
		{{/sucursales}} 
	</script>
	<!-- /.Plantilla para cargar los tipos de servicios-->  
	<script id="servicios_tipos_rep_facturacion_servicio" type="text/template">
		{{#row}}
			<label>
		      <input class="form-check-input" type="checkbox" id="chkServicioTipo{{servicio_tipo_id}}_rep_facturacion_servicio"  name="chkServiciosTipos_rep_facturacion_servicio[]" value="{{servicio_tipo_id}}">
		      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
		      {{descripcion}}
		    </label>
		{{/row}}
	    <!--Costos-->
	    <label class="col-md-12">
	      <input class="form-check-input" type="checkbox" id="chbIncluirCostos_rep_facturacion_servicio"  name="strIncluirCostos_rep_facturacion_servicio" value="">
	      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
	      COSTOS
	    </label>
	    <!--Notas de crédito-->
	    <label class="col-md-12">
	      <input class="form-check-input" type="checkbox" id="chbIncluirNotasCredito_rep_facturacion_servicio"  name="strIncluirNotasCredito_rep_facturacion_servicio" value="">
	      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
	      NOTAS DE CRÉDITO
	    </label>
	    <!--Devoluciones-->
	    <label class="col-md-12">
	      <input class="form-check-input" type="checkbox" id="chbIncluirDevoluciones_rep_facturacion_servicio"  name="strIncluirDevoluciones_rep_facturacion_servicio" value="">
	      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
	      DEVOLUCIONES
	    </label>
	</script>

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_facturacion_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/rep_facturacion/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_facturacion_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepFacturacionServicio = data.row;
					//Separar la cadena 
					var arrPermisosRepFacturacionServicio = strPermisosRepFacturacionServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepFacturacionServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepFacturacionServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_facturacion_servicio').removeAttr('disabled');
						}
						else if(arrPermisosRepFacturacionServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_facturacion_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_facturacion_servicio(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_facturacion_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmRepFacturacionServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaInicial_rep_facturacion_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_rep_facturacion_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										}, 
										strTipoReporte_rep_facturacion_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo de reporte'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_facturacion_servicio = $('#frmRepFacturacionServicio').data('bootstrapValidator');
			bootstrapValidator_rep_facturacion_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_facturacion_servicio.isValid())
			{
				//Arreglo para obtener sucursales seleccionadas
				var chkSucursalesArray = [];
				chkSucursalesArray = sucursales_seleccionadas_rep_facturacion_servicio();

				//Arreglo para obtener tipos de servicios seleccionados
				var chkServiciosTiposArray = [];
				chkServiciosTiposArray = servicios_tipos_seleccionados_rep_facturacion_servicio();

				//Verificamos que al menos se encuentre una sucursal  y un tipo de servicio seleccionado
				if(chkSucursalesArray.length > 0 && chkServiciosTiposArray.length > 0)
				{
					//Array que se utiliza para agregar sucursales
					var arrSucursales = chkSucursalesArray.join('|');
					//Array que se utiliza para agregar tipos de servicios
					var arrServiciosTipos = chkServiciosTiposArray.join('|');

				 	//Hacer un llamado a la función para generar reporte en PDF/XLS
				 	reporte_rep_facturacion_servicio(strTipo, arrSucursales, arrServiciosTipos);
					
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
		function limpiar_mensajes_rep_facturacion_servicio()
		{
			try
			{
				$('#frmRepFacturacionServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_facturacion_servicio(strTipo, arrSucursales, arrServiciosTipos) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/rep_facturacion/';

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

			
			//Si el checkbox incluir costos se encuentra seleccionado (marcado)
			if ($('#chbIncluirCostos_rep_facturacion_servicio').is(':checked')) {
			    //Asignar SI para incluir costos en el reporte
			    $('#chbIncluirCostos_rep_facturacion_servicio').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir costos en el reporte
			   $('#chbIncluirCostos_rep_facturacion_servicio').val('NO');
			}


			//Si el checkbox incluir notas de crédito se encuentra seleccionado (marcado)
			if ($('#chbIncluirNotasCredito_rep_facturacion_servicio').is(':checked')) {
			    //Asignar SI para incluir notas de crédito en el reporte
			    $('#chbIncluirNotasCredito_rep_facturacion_servicio').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir notas de crédito en el reporte
			   $('#chbIncluirNotasCredito_rep_facturacion_servicio').val('NO');
			}

			//Si el checkbox incluir devoluciones se encuentra seleccionado (marcado)
			if ($('#chbIncluirDevoluciones_rep_facturacion_servicio').is(':checked')) {
			    //Asignar SI para incluir devoluciones en el reporte
			    $('#chbIncluirDevoluciones_rep_facturacion_servicio').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir devoluciones en el reporte
			   $('#chbIncluirDevoluciones_rep_facturacion_servicio').val('NO');
			}

			//Si el checkbox incluir detalle de facturas se encuentra seleccionado (marcado)
			if ($('#chbIncluirDetalleFras_rep_facturacion_servicio').is(':checked')) {
			    //Asignar SI para incluir detalle de facturas en el reporte
			    $('#chbIncluirDetalleFras_rep_facturacion_servicio').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalle de facturas en el reporte
			   $('#chbIncluirDetalleFras_rep_facturacion_servicio').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_rep_facturacion_servicio').val()), 
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_facturacion_servicio').val()), 
										'intProspectoID': $('#txtProspectoID_rep_facturacion_servicio').val(),
										'strSucursales': arrSucursales,
										'strServiciosTipos': arrServiciosTipos,
										'strTipoReporte': $('#cmbTipoReporte_rep_facturacion_servicio').val(), 
										'strIncluirCostos': $('#chbIncluirCostos_rep_facturacion_servicio').val(),
										'strIncluirNotasCredito': $('#chbIncluirNotasCredito_rep_facturacion_servicio').val(),
										'strIncluirDevoluciones': $('#chbIncluirDevoluciones_rep_facturacion_servicio').val(),
										'strIncluirDetalleFras': $('#chbIncluirDetalleFras_rep_facturacion_servicio').val()

									 }
						   };

			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}


		//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
		function cargar_sucursales_rep_facturacion_servicio()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box/home', {},
				function(data)
				{
					$('#chkSucursales_rep_facturacion_servicio').empty();
					var temp = Mustache.render($('#sucursales_rep_facturacion_servicio').html(), data)
					$('#chkSucursales_rep_facturacion_servicio').html(temp);
				},
				'json');
		}

		

		//Función para obtener las sucursales seleccionadas
		function sucursales_seleccionadas_rep_facturacion_servicio(){

			//Declaramos el arreglo  que contendrá las sucursales seleccionadas
			var chkSucursalesArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkSucursales_rep_facturacion_servicio[]"]:checked').each(function() {
				chkSucursalesArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkSucursalesArray.join('|');
			
			//Regresar array con las sucursales seleccionadas
			return chkSucursalesArray;

		}


		//Función para cargar los tipos de servicios a facturar 
		function cargar_servicios_tipos_rep_facturacion_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los tipos de servicios a facturar
			$.post('servicio/servicios_tipos/get_datos', {
			       	strTipo: 'checkboxes'
				},
				function(data)
				{
					$('#chkServiciosTipos_rep_facturacion_servicio').empty();
					var temp = Mustache.render($('#servicios_tipos_rep_facturacion_servicio').html(), data)
					$('#chkServiciosTipos_rep_facturacion_servicio').html(temp);
				},
				'json');
		}

		//Función para obtener los tipos de servicios seleccionados
		function servicios_tipos_seleccionados_rep_facturacion_servicio(){

			//Declaramos el arreglo  que contendrá los tipos de servicios seleccionados
			var chkServiciosTiposArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkServiciosTipos_rep_facturacion_servicio[]"]:checked').each(function() {
				chkServiciosTiposArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkServiciosTiposArray.join('|');
			
			//Regresar array con los tipos de servicios seleccionados
			return chkServiciosTiposArray;

		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicial_rep_facturacion_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_facturacion_servicio').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_facturacion_servicio').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_facturacion_servicio').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_facturacion_servicio').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_facturacion_servicio').data('DateTimePicker').maxDate(e.date);
			});

			
			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_rep_facturacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_rep_facturacion_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strTipo: 'saldos'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtProspectoID_rep_facturacion_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del cliente cuando pierda el enfoque la caja de texto
	        $('#txtRazonSocial_rep_facturacion_servicio').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_rep_facturacion_servicio').val() == '' ||
	               $('#txtRazonSocial_rep_facturacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_rep_facturacion_servicio').val('');
	               $('#txtRazonSocial_rep_facturacion_servicio').val('');
	            }
	            
	        });
			
			
			//Enfocar caja de texto
			$('#txtFechaInicial_rep_facturacion_servicio').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_facturacion_servicio();
			//Hacer un llamado a la función para cargar sucursales y armar los checklist
  			cargar_sucursales_rep_facturacion_servicio();
  			//Hacer un llamado a la función para cargar los módulos
			cargar_servicios_tipos_rep_facturacion_servicio();

		});
	</script>