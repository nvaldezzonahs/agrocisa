	<div id="RepRastreoSeriesMaquinariaContent">  
		<!--Diseño del formulario-->
		<form id="frmRepRastreoSeriesMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepRastreoSeriesMaquinaria" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_rastreo_series_maquinaria"
									onclick="validar_rep_rastreo_series_maquinaria('PDF')" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_rastreo_series_maquinaria"
									onclick="validar_rep_rastreo_series_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				<div class="row">
					<!--Autocomplete que contiene las series de la descripción de maquinaria-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtSerie_rep_rastreo_series_maquinaria">Serie</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtSerie_rep_rastreo_series_maquinaria" 
										name="strSerie_rep_rastreo_series_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese serie" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepRastreoSeriesMaquinariaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_rastreo_series_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/rep_rastreo_series/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_rastreo_series_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepRastreoSeriesMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosRepRastreoSeriesMaquinaria = strPermisosRepRastreoSeriesMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepRastreoSeriesMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepRastreoSeriesMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_rastreo_series_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosRepRastreoSeriesMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_rastreo_series_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

			//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_rastreo_series_maquinaria(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_rastreo_series_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmRepRastreoSeriesMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strSerie_rep_rastreo_series_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba una serie'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_rastreo_series_maquinaria = $('#frmRepRastreoSeriesMaquinaria').data('bootstrapValidator');
			bootstrapValidator_rep_rastreo_series_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_rastreo_series_maquinaria.isValid())
			{
			 	//Hacer un llamado a la función para generar reporte en PDF/XLS
			 	reporte_rep_rastreo_series_maquinaria(strTipo);
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_rastreo_series_maquinaria()
		{
			try
			{
				$('#frmRepRastreoSeriesMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_rastreo_series_maquinaria(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/rep_rastreo_series/';

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
										'strSerie': $('#txtSerie_rep_rastreo_series_maquinaria').val()
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
			//Enfocar caja de texto
			$('#txtSerie_rep_rastreo_series_maquinaria').focus();
			
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_rastreo_series_maquinaria();
		});
	</script>