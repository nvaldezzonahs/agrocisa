	<div id="RepSaldoBancosCuentasPagarContent">  
		<!--Diseño del formulario-->
		<form id="frmRepSaldoBancosCuentasPagar" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepSaldoBancosCuentasPagar" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_saldo_bancos_cuentas_pagar"
									onclick="validar_rep_saldo_bancos_cuentas_pagar('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_saldo_bancos_cuentas_pagar"
									onclick="validar_rep_saldo_bancos_cuentas_pagar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaInicial_rep_saldo_bancos_cuentas_pagar">Fecha inicial</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_saldo_bancos_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaInicial_rep_saldo_bancos_cuentas_pagar"
				                    		name= "strFechaInicial_rep_saldo_bancos_cuentas_pagar" 
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
								<label for="txtFechaFinal_rep_saldo_bancos_cuentas_pagar">Fecha final</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_saldo_bancos_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaFinal_rep_saldo_bancos_cuentas_pagar"
				                    		name= "strFechaFinal_rep_saldo_bancos_cuentas_pagar" 
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
					<!--Autocomplete que contiene las cuentas bancarias activas-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta bancaria seleccionada-->
								<input id="txtCuentaBancariaID_rep_saldo_bancos_cuentas_pagar" name="intCuentaBancariaID_rep_saldo_bancos_cuentas_pagar"  
									   type="hidden" value="">
								</input>
								<label for="txtCuentaBancaria_rep_saldo_bancos_cuentas_pagar">Cuenta</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtCuentaBancaria_rep_saldo_bancos_cuentas_pagar" 
										name="strCuentaBancaria_rep_saldo_bancos_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese cuenta bancaria" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepSaldoBancosCuentasPagarContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_saldo_bancos_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_pagar/rep_saldo_bancos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_saldo_bancos_cuentas_pagar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepSaldoBancosCuentasPagar = data.row;
					//Separar la cadena 
					var arrPermisosRepSaldoBancosCuentasPagar = strPermisosRepSaldoBancosCuentasPagar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepSaldoBancosCuentasPagar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepSaldoBancosCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_saldo_bancos_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosRepSaldoBancosCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_saldo_bancos_cuentas_pagar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_saldo_bancos_cuentas_pagar(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_saldo_bancos_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmRepSaldoBancosCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaInicial_rep_saldo_bancos_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_rep_saldo_bancos_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_saldo_bancos_cuentas_pagar = $('#frmRepSaldoBancosCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_rep_saldo_bancos_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_saldo_bancos_cuentas_pagar.isValid())
			{
			 	//Hacer un llamado a la función para generar reporte en PDF/XLS
			 	reporte_rep_saldo_bancos_cuentas_pagar(strTipo);
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_saldo_bancos_cuentas_pagar()
		{
			try
			{
				$('#frmRepSaldoBancosCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_saldo_bancos_cuentas_pagar(strTipo) 
		{

         	//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_pagar/rep_saldo_bancos/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_rep_saldo_bancos_cuentas_pagar').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_saldo_bancos_cuentas_pagar').val()),
										'intCuentaBancariaID': $('#txtCuentaBancariaID_rep_saldo_bancos_cuentas_pagar').val()

									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicial_rep_saldo_bancos_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_saldo_bancos_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_saldo_bancos_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_saldo_bancos_cuentas_pagar').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_saldo_bancos_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_saldo_bancos_cuentas_pagar').data('DateTimePicker').maxDate(e.date);
			});

			
			//Autocomplete para recuperar los datos de un cuenta bancaria 
	        $('#txtCuentaBancaria_rep_saldo_bancos_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaBancariaID_rep_saldo_bancos_cuentas_pagar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/cuentas_bancarias/autocomplete",
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
	             $('#txtCuentaBancariaID_rep_saldo_bancos_cuentas_pagar').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del cuenta bancaria cuando pierda el enfoque la caja de texto
	        $('#txtCuentaBancaria_rep_saldo_bancos_cuentas_pagar').focusout(function(e){
	            //Si no existe id del cuenta bancaria
	            if($('#txtCuentaBancariaID_rep_saldo_bancos_cuentas_pagar').val() == '' ||
	               $('#txtCuentaBancaria_rep_saldo_bancos_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCuentaBancariaID_rep_saldo_bancos_cuentas_pagar').val('');
	               $('#txtCuentaBancaria_rep_saldo_bancos_cuentas_pagar').val('');
	            }
	            
	        });
			
			//Enfocar caja de texto
			$('#txtFechaInicial_rep_saldo_bancos_cuentas_pagar').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_saldo_bancos_cuentas_pagar();
		});
	</script>