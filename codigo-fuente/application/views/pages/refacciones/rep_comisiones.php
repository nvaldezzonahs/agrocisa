	<div id="RepComisionesRefaccionesContent">  
		<!--Diseño del formulario-->
		<form id="frmRepComisionesRefacciones" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepComisionesRefacciones" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_comisiones_refacciones"
									onclick="validar_rep_comisiones_refacciones('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_comisiones_refacciones"
									onclick="validar_rep_comisiones_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaInicial_rep_comisiones_refacciones">Fecha inicial</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_comisiones_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaInicial_rep_comisiones_refacciones"
				                    		name= "strFechaInicial_rep_comisiones_refacciones" 
				                    		type="text" 
				                    		value="" 
				                    		tabindex="1" 
				                    		placeholder="Ingrese fecha" 
				                    		maxlength="10"/>
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
								<label for="txtFechaFinal_rep_comisiones_refacciones">Fecha final</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_comisiones_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaFinal_rep_comisiones_refacciones"
				                    		name= "strFechaFinal_rep_comisiones_refacciones" 
				                    		type="text" 
				                    		value="" 
				                    		tabindex="1" 
				                    		placeholder="Ingrese fecha" 
				                    		maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>	
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepComisionesRefaccionesContent -->

	
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_comisiones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/rep_comisiones/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_comisiones_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepComisionesRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosRepComisionesRefacciones = strPermisosRepComisionesRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepComisionesRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepComisionesRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_comisiones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRepComisionesRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_comisiones_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_comisiones_refacciones(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_comisiones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmRepComisionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaInicial_rep_comisiones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_rep_comisiones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_comisiones_refacciones = $('#frmRepComisionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_rep_comisiones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_comisiones_refacciones.isValid())
			{
				
				//Hacer un llamado a la función para generar reporte en PDF/XLS
				reporte_rep_comisiones_refacciones(strTipo);

			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_comisiones_refacciones()
		{
			try
			{
				$('#frmRepComisionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_comisiones_refacciones(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/rep_comisiones/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_rep_comisiones_refacciones').val()), 
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_comisiones_refacciones').val())
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
			$('#dteFechaInicial_rep_comisiones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_comisiones_refacciones').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_comisiones_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_comisiones_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_comisiones_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_comisiones_refacciones').data('DateTimePicker').maxDate(e.date);
			});
			
			
			//Enfocar caja de texto
			$('#txtFechaInicial_rep_comisiones_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_comisiones_refacciones();

		});
	</script>