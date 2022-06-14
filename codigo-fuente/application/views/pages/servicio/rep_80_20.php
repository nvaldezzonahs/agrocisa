	<div id="Rep8020ServicioContent">  
		<!--Diseño del formulario-->
		<form id="frmRep8020Servicio" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRep8020Servicio" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_80_20_servicio"
									onclick="validar_rep_80_20_servicio('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_80_20_servicio"
									onclick="validar_rep_80_20_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaInicial_rep_80_20_servicio">Fecha inicial</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_80_20_servicio'>
				                    <input class="form-control" id="txtFechaInicial_rep_80_20_servicio"
				                    		name= "strFechaInicial_rep_80_20_servicio" 
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
								<label for="txtFechaFinal_rep_80_20_servicio">Fecha final</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_80_20_servicio'>
				                    <input class="form-control" id="txtFechaFinal_rep_80_20_servicio"
				                    		name= "strFechaFinal_rep_80_20_servicio" 
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
			    	<!--Tipo-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbTipo_rep_80_20_servicio">Tipo</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select class="form-control" id="cmbTipo_rep_80_20_servicio" 
								 		name="strTipo_rep_80_20_servicio" tabindex="1">
								 	<option value="">Seleccione una opción</option>	
								 	<option value="CLIENTES">CLIENTES</option>
                            		<option value="SERVICIO">SERVICIO</option>
                 				</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Sucursales:</label>
							</div>
							<div class="col-md-12" id="chkSucursales_rep_80_20_servicio"></div>
						</div>	
					</div>		
				</div>	
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#Rep8020ServicioContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="sucursales_rep_80_20_servicio" type="text/template">
		{{#sucursales}}
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" id="chkSucursal{{value}}_rep_80_20_servicio" 
		  		 name="chkSucursales_rep_80_20_servicio[]"  value="{{value}}" checked>
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
		function permisos_rep_80_20_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/rep_80_20/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_80_20_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRep8020Servicio = data.row;
					//Separar la cadena 
					var arrPermisosRep8020Servicio = strPermisosRep8020Servicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRep8020Servicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRep8020Servicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_80_20_servicio').removeAttr('disabled');
						}
						else if(arrPermisosRep8020Servicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_80_20_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}


		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_80_20_servicio(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_80_20_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmRep8020Servicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFechaInicial_rep_80_20_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_rep_80_20_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strTipo_rep_80_20_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_80_20_servicio = $('#frmRep8020Servicio').data('bootstrapValidator');
			bootstrapValidator_rep_80_20_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_80_20_servicio.isValid())
			{
				//Arreglo para obtener sucursales seleccionadas
				var chkSucursalesArray = [];
				chkSucursalesArray = sucursales_seleccionadas_rep_80_20_servicio();

				//Verificamos que al menos se encuentre una sucursal
				if(chkSucursalesArray.length > 0)
				{
					//Array que se utiliza para agregar sucursales
					var arrSucursales = chkSucursalesArray.join('|');
					
				 	//Hacer un llamado a la función para generar reporte en PDF/XLS
				 	reporte_rep_80_20_servicio(strTipo, arrSucursales);
					
				}
				else
				{
					//Indicar al usuario el mensaje de error
					new $.Zebra_Dialog('Es necesario seleccionar al menos una sucursal.',
								   {'type': 'error', 
								   'title': 'Error'});
				}
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_80_20_servicio()
		{
			try
			{
				$('#frmRep8020Servicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_80_20_servicio(strTipo, arrSucursales) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/rep_80_20/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_rep_80_20_servicio').val()), 
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_80_20_servicio').val()),
										'strTipo': $('#cmbTipo_rep_80_20_servicio').val(), 
										'strSucursales': arrSucursales			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
		function cargar_sucursales_rep_80_20_servicio()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box/home', {},
				function(data)
				{
					$('#chkSucursales_rep_80_20_servicio').empty();
					var temp = Mustache.render($('#sucursales_rep_80_20_servicio').html(), data)
					$('#chkSucursales_rep_80_20_servicio').html(temp);
				},
				'json');
		}


		//Función para obtener las sucursales seleccionadas
		function sucursales_seleccionadas_rep_80_20_servicio(){

			//Declaramos el arreglo para que contendrá las sucursales seleccionadas
			var chkSucursalesArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkSucursales_rep_80_20_servicio[]"]:checked').each(function() {
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
			$('#dteFechaInicial_rep_80_20_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_80_20_servicio').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_80_20_servicio').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_80_20_servicio').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_80_20_servicio').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_80_20_servicio').data('DateTimePicker').maxDate(e.date);
			});

			//Enfocar caja de texto
			$('#txtFechaInicial_rep_80_20_servicio').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_80_20_servicio();
			
			//Hacer un llamado a la función para cargar sucursales y armar los checklist
  			cargar_sucursales_rep_80_20_servicio();

		});
	</script>