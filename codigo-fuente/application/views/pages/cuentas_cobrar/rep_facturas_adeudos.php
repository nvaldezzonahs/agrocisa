	<div id="RepFacturasAdeudosCuentasCobrarContent">  
		<!--Diseño del formulario-->
		<form id="frmRepFacturasAdeudosCuentasCobrar" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepFacturasAdeudosCuentasCobrar" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_facturas_adeudos_cuentas_cobrar"
									onclick="validar_rep_facturas_adeudos_cuentas_cobrar('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_facturas_adeudos_cuentas_cobrar"
									onclick="validar_rep_facturas_adeudos_cuentas_cobrar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaCorte_rep_facturas_adeudos_cuentas_cobrar">Fecha de corte</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaCorte_rep_facturas_adeudos_cuentas_cobrar'>
				                    <input class="form-control" id="txtFechaCorte_rep_facturas_adeudos_cuentas_cobrar"
				                    		name= "strFechaCorte_rep_facturas_adeudos_cuentas_cobrar" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los clientes activos-->
					<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
								<input id="txtProspectoID_rep_facturas_adeudos_cuentas_cobrar" name="intProspectoID_rep_facturas_adeudos_cuentas_cobrar"  
									   type="hidden" value="" />
								<label for="txtRazonSocial_rep_facturas_adeudos_cuentas_cobrar">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocial_rep_facturas_adeudos_cuentas_cobrar" 
										name="strRazonSocial_rep_facturas_adeudos_cuentas_cobrar" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250" />
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
							<div class="col-md-12" id="chkSucursales_rep_facturas_adeudos_cuentas_cobrar"></div>
						</div>	
					</div>
					<!--Lista de modulos-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Módulos:</label>
							</div>
							<div class="col-md-12">
								<!--Facturas de maquinaria-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloMaquinaria_rep_facturas_adeudos_cuentas_cobrar" 
									name="chkModulos_rep_facturas_adeudos_cuentas_cobrar[]" 
									value="MAQUINARIA" checked>
									<label class="form-check-label" for="MAQUINARIA">MAQUINARIA</label>
								</div>
								<!--Facturas de refacciones-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloRefacciones_rep_facturas_adeudos_cuentas_cobrar" 
									name="chkModulos_rep_facturas_adeudos_cuentas_cobrar[]"
									value="REFACCIONES" checked>
									<label class="form-check-label" for="REFACCIONES">REFACCIONES</label>
								</div>
								<!--Facturas de servicio-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloServicio_rep_facturas_adeudos_cuentas_cobrar" 
									name="chkModulos_rep_facturas_adeudos_cuentas_cobrar[]"
									value="SERVICIO" checked>
									<label class="form-check-label" for="SERVICIO">SERVICIO</label>
								</div>
								<!--Facturas de conceptos-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloConceptos_rep_facturas_adeudos_cuentas_cobrar" 
									name="chkModulos_rep_facturas_adeudos_cuentas_cobrar[]"
									value="CONCEPTOS" checked>
									<label class="form-check-label" for="CONCEPTOS">CONCEPTOS</label>
								</div>
							</div>	
						</div>	
					</div>	
				</div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepFacturasAdeudosCuentasCobrarContent -->

	<!-- /.Plantilla para cargar las sucursales-->  
	<script id="sucursales_rep_facturas_adeudos_cuentas_cobrar" type="text/template">
		{{#sucursales}}
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" id="chkSucursal{{value}}_rep_facturas_adeudos_cuentas_cobrar"  
		  	     name="chkSucursales_rep_facturas_adeudos_cuentas_cobrar[]" value="{{value}}" checked>
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
		function permisos_rep_facturas_adeudos_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_cobrar/rep_facturas_adeudos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_facturas_adeudos_cuentas_cobrar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepFacturasAdeudosCuentasCobrar = data.row;
					//Separar la cadena 
					var arrPermisosRepFacturasAdeudosCuentasCobrar = strPermisosRepFacturasAdeudosCuentasCobrar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepFacturasAdeudosCuentasCobrar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepFacturasAdeudosCuentasCobrar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_facturas_adeudos_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosRepFacturasAdeudosCuentasCobrar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_facturas_adeudos_cuentas_cobrar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_facturas_adeudos_cuentas_cobrar(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_facturas_adeudos_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmRepFacturasAdeudosCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaCorte_rep_facturas_adeudos_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_facturas_adeudos_cuentas_cobrar = $('#frmRepFacturasAdeudosCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_rep_facturas_adeudos_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_facturas_adeudos_cuentas_cobrar.isValid())
			{
				//Arreglo para obtener sucursales seleccionadas
				var chkSucursalesArray = [];
				chkSucursalesArray = sucursales_seleccionadas_rep_facturas_adeudos_cuentas_cobrar();

				//Arreglo para obtener módulos seleccionados
				var chkModulosArray = [];
				chkModulosArray = modulos_seleccionados_rep_facturas_adeudos_cuentas_cobrar();

				//Verificamos que al menos se encuentre una sucursal y un modulo seleccionado
				if(chkSucursalesArray.length > 0 && chkModulosArray.length > 0)
				{
					//Array que se utiliza para agregar sucursales
					var arrSucursales = chkSucursalesArray.join('|');
					//Array que se utiliza para agregar módulos
					var arrModulos = chkModulosArray.join('|');

					//Hacer un llamado a la función para generar reporte en PDF/XLS
					reporte_rep_facturas_adeudos_cuentas_cobrar(strTipo, arrSucursales, arrModulos);
					
				}
				else
				{
					//Indicar al usuario el mensaje de error
					new $.Zebra_Dialog('Es necesario seleccionar al menos una sucursal y un módulo.',
									   {'type': 'error', 
									   'title': 'Error'});
				}
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_facturas_adeudos_cuentas_cobrar()
		{
			try
			{
				$('#frmRepFacturasAdeudosCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_facturas_adeudos_cuentas_cobrar(strTipo, arrSucursales, arrModulos) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_cobrar/rep_facturas_adeudos/';

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
										'dteFechaCorte': $.formatFechaMysql($('#txtFechaCorte_rep_facturas_adeudos_cuentas_cobrar').val()),
										'intProspectoID': $('#txtProspectoID_rep_facturas_adeudos_cuentas_cobrar').val(),
										'strSucursales': arrSucursales, 
										'strModulos': arrModulos

									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
		function cargar_sucursales_rep_facturas_adeudos_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box/home', {},
				function(data)
				{
					$('#chkSucursales_rep_facturas_adeudos_cuentas_cobrar').empty();
					var temp = Mustache.render($('#sucursales_rep_facturas_adeudos_cuentas_cobrar').html(), data)
					$('#chkSucursales_rep_facturas_adeudos_cuentas_cobrar').html(temp);
				},
				'json');
		}


		//Función para obtener las sucursales seleccionadas
		function sucursales_seleccionadas_rep_facturas_adeudos_cuentas_cobrar(){

			//Declaramos el arreglo que contendrá las sucursales seleccionadas
			var chkSucursalesArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkSucursales_rep_facturas_adeudos_cuentas_cobrar[]"]:checked').each(function() {
				chkSucursalesArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkSucursalesArray.join('|');
			
			//Regresar array con las sucursales seleccionadas
			return chkSucursalesArray;

		}


		//Función para obtener los módulos seleccionados
		function modulos_seleccionados_rep_facturas_adeudos_cuentas_cobrar(){

			//Declaramos el arreglo que contendrá los módulos seleccionados
			var chkModulosArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkModulos_rep_facturas_adeudos_cuentas_cobrar[]"]:checked').each(function() {

				 chkModulosArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkModulosArray.join('|');

			//Regresar array con los módulos seleccionados
			return chkModulosArray;
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaCorte_rep_facturas_adeudos_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});
		
			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_rep_facturas_adeudos_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_rep_facturas_adeudos_cuentas_cobrar').val('');
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
	             $('#txtProspectoID_rep_facturas_adeudos_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtRazonSocial_rep_facturas_adeudos_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_rep_facturas_adeudos_cuentas_cobrar').val() == '' ||
	               $('#txtRazonSocial_rep_facturas_adeudos_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_rep_facturas_adeudos_cuentas_cobrar').val('');
	               $('#txtRazonSocial_rep_facturas_adeudos_cuentas_cobrar').val('');
	            }
	            
	        });
			

			//Asignar la fecha actual
       		$('#txtFechaCorte_rep_facturas_adeudos_cuentas_cobrar').val(fechaActual()); 
			//Enfocar caja de texto
			$('#txtRazonSocial_rep_facturas_adeudos_cuentas_cobrar').focus();
			
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_facturas_adeudos_cuentas_cobrar();
			//Hacer un llamado a la función para cargar sucursales y armar los checklist
  			cargar_sucursales_rep_facturas_adeudos_cuentas_cobrar();

		});
	</script>