	<div id="Rep8020RefaccionesContent">  
		<!--Diseño del formulario-->
		<form id="frmRep8020Refacciones" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRep8020Refacciones" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_80_20_refacciones"
									onclick="validar_rep_80_20_refacciones('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_80_20_refacciones"
									onclick="validar_rep_80_20_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaInicial_rep_80_20_refacciones">Fecha inicial</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_80_20_refacciones'>
				                    <input class="form-control" id="txtFechaInicial_rep_80_20_refacciones"
				                    		name= "strFechaInicial_rep_80_20_refacciones" 
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
								<label for="txtFechaFinal_rep_80_20_refacciones">Fecha final</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_80_20_refacciones'>
				                    <input class="form-control" id="txtFechaFinal_rep_80_20_refacciones"
				                    		name= "strFechaFinal_rep_80_20_refacciones" 
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
								<label for="cmbTipo_rep_80_20_refacciones">Tipo</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select class="form-control" id="cmbTipo_rep_80_20_refacciones" 
								 		name="strTipo_rep_80_20_refacciones" tabindex="1">
									<option value="">Seleccione una opción</option>
								 	<option value="CLIENTES">CLIENTES</option>
                            		<option value="REFACCIONES">REFACCIONES</option>
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
							<div class="col-md-12" id="chkSucursales_rep_80_20_refacciones"></div>
						</div>	
					</div>		
				</div>	
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#Rep8020RefaccionesContent -->

	<!-- /.Plantilla para cargar las sucursales-->  
	<script id="sucursales_rep_80_20_refacciones" type="text/template">
		{{#sucursales}}
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" id="chkSucursal{{value}}_rep_80_20_refacciones" 
		  		 name="chkSucursales_rep_80_20_refacciones[]" value="{{value}}" checked>
		  <label class="form-check-label" for="{{value}}">{{nombre}}</label>
		</div>
		{{/sucursales}} 
	</script>
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Variables que se utilizan para la búsqueda de registros
		var dteFechaInicialRep8020Refacciones = "";
		var dteFechaFinalRep8020Refacciones = "";

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_80_20_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/rep_80_20/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_80_20_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRep8020Refacciones = data.row;
					//Separar la cadena 
					var arrPermisosRep8020Refacciones = strPermisosRep8020Refacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRep8020Refacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRep8020Refacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_80_20_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRep8020Refacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_80_20_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_80_20_refacciones(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_80_20_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmRep8020Refacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFechaInicial_rep_80_20_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_rep_80_20_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strTipo_rep_80_20_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_80_20_refacciones = $('#frmRep8020Refacciones').data('bootstrapValidator');
			bootstrapValidator_rep_80_20_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_80_20_refacciones.isValid())
			{
				//Arreglo para obtener sucursales seleccionadas
				var chkSucursalesArray = [];
				chkSucursalesArray = sucursales_seleccionadas_rep_80_20_refacciones();

				//Verificamos que al menos se encuentre una sucursal
				if(chkSucursalesArray.length > 0)
				{
					//Array que se utiliza para agregar sucursales
					var arrSucursales = chkSucursalesArray.join('|');
					//Si el tipo de reporte es PDF
					if(strTipo == 'PDF')
					{
					 	//Hacer un llamado a la función para generar reporte en PDF
					 	reporte_rep_80_20_refacciones(arrSucursales);
					}
					else
					{ 
					 	//Hacer un llamado a la función para generar  y descargar el archivo XLS
					 	descargar_xls_rep_80_20_refacciones(arrSucursales)
					}
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
		function limpiar_mensajes_rep_80_20_refacciones()
		{
			try
			{
				$('#frmRep8020Refacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar el reporte general en PDF
		function reporte_rep_80_20_refacciones(arrSucursales) 
		{

			//Asignar valores para la búsqueda de registros
			dteFechaInicialRep8020Refacciones =  $.formatFechaMysql($('#txtFechaInicial_rep_80_20_refacciones').val());
			dteFechaFinalRep8020Refacciones =  $.formatFechaMysql($('#txtFechaFinal_rep_80_20_refacciones').val());

			//Si no existe fecha inicial
			if(dteFechaInicialRep8020Refacciones == '')
			{
				dteFechaInicialRep8020Refacciones = '0000-00-00';
			}
			//Si no existe fecha final
			if(dteFechaFinalRep8020Refacciones == '')
			{
				dteFechaFinalRep8020Refacciones =  '0000-00-00';
			}
			
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("refacciones/rep_80_20/get_reporte/"+
						arrSucursales+"/"+
						dteFechaInicialRep8020Refacciones+"/"+
						dteFechaFinalRep8020Refacciones+"/"+
						$('#cmbTipo_rep_80_20_refacciones').val());

		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_rep_80_20_refacciones(arrSucursales) 
		{

			//Asignar valores para la búsqueda de registros
			dteFechaInicialRep8020Refacciones =  $.formatFechaMysql($('#txtFechaInicial_rep_80_20_refacciones').val());
			dteFechaFinalRep8020Refacciones =  $.formatFechaMysql($('#txtFechaFinal_rep_80_20_refacciones').val());

			//Si no existe fecha inicial
			if(dteFechaInicialRep8020Refacciones == '')
			{
				dteFechaInicialRep8020Refacciones = '0000-00-00';
			}
			//Si no existe fecha final
			if(dteFechaFinalRep8020Refacciones == '')
			{
				dteFechaFinalRep8020Refacciones =  '0000-00-00';
			}
			
			//Hacer un llamado al método del controlador para generar reporte XLS
			window.open("refacciones/rep_80_20/get_xls/"+
						arrSucursales+"/"+
						dteFechaInicialRep8020Refacciones+"/"+
						dteFechaFinalRep8020Refacciones+"/"+
						$('#cmbTipo_rep_80_20_refacciones').val());
		}

		//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
		function cargar_sucursales_rep_80_20_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box/home', {},
				function(data)
				{
					$('#chkSucursales_rep_80_20_refacciones').empty();
					var temp = Mustache.render($('#sucursales_rep_80_20_refacciones').html(), data)
					$('#chkSucursales_rep_80_20_refacciones').html(temp);
				},
				'json');
		}


		//Función para obtener las sucursales seleccionadas
		function sucursales_seleccionadas_rep_80_20_refacciones(){

			//Declaramos el arreglo para que contendrá las sucursales seleccionadas
			var chkSucursalesArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkSucursales_rep_80_20_refacciones[]"]:checked').each(function() {
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
			$('#dteFechaInicial_rep_80_20_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_80_20_refacciones').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_80_20_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_80_20_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_80_20_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_80_20_refacciones').data('DateTimePicker').maxDate(e.date);
			});

			//Enfocar caja de texto
			$('#txtFechaInicial_rep_80_20_refacciones').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_80_20_refacciones();
			//Hacer un llamado a la función para cargar sucursales y armar los checklist
  			cargar_sucursales_rep_80_20_refacciones();

		});
	</script>