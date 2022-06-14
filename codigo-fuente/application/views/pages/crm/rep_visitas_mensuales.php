	<div id="RepVisitasMensualesCRMContent">  
		<!--Diseño del formulario-->
		<form id="frmRepVisitasMensualesCRM" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepVisitasMensualesCRM" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_visitas_mensuales_crm"
									onclick="validar_rep_visitas_mensuales_crm('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_visitas_mensuales_crm"
									onclick="validar_rep_visitas_mensuales_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				 <div class="row">
			    	<!--Mes-->
					<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbMes_rep_visitas_mensuales_crm">Mes</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select class="form-control" id="cmbMes_rep_visitas_mensuales_crm" 
								 		name="strMes_rep_visitas_mensuales_crm" tabindex="1">
                      				<option value="">Seleccione una opción</option>
                      				<option value="01">ENERO</option>
									<option value="02">FEBRERO</option>
									<option value="03">MARZO</option>
									<option value="04">ABRIL</option>
									<option value="05">MAYO</option>
									<option value="06">JUNIO</option>
									<option value="07">JULIO</option>
									<option value="08">AGOSTO</option>
									<option value="09">SEPTIEMBRE</option>
									<option value="10">OCTUBRE</option>
									<option value="11">NOVIEMBRE</option>
									<option value="12">DICIEMBRE</option>
                 				</select>
							</div>
						</div>
					</div>
					<!--Año-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtAnio_rep_visitas_mensuales_crm">Año</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtAnio_rep_visitas_mensuales_crm" 
										name="strAnio_rep_visitas_mensuales_crm" type="number" value="" tabindex="1" placeholder="Ingrese año" maxlength="4">
								</input>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
			    	<!--Autocomplete que contiene los módulos activos-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
								<input id="txtModuloID_rep_visitas_mensuales_crm" 
									   name="intModuloID_rep_visitas_mensuales_crm"  type="hidden" 
									   value="">
								</input>
								<label for="txtModulo_rep_visitas_mensuales_crm">Módulo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtModulo_rep_visitas_mensuales_crm" 
										name="strModulo_rep_visitas_mensuales_crm" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepVisitasMensualesCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_visitas_mensuales_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/rep_visitas_mensuales/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_visitas_mensuales_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepVisitasMensualesCRM = data.row;
					//Separar la cadena 
					var arrPermisosRepVisitasMensualesCRM = strPermisosRepVisitasMensualesCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepVisitasMensualesCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepVisitasMensualesCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_visitas_mensuales_crm').removeAttr('disabled');
						}
						else if(arrPermisosRepVisitasMensualesCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_visitas_mensuales_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_visitas_mensuales_crm(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_visitas_mensuales_crm();
			//Validación del formulario de campos obligatorios
			$('#frmRepVisitasMensualesCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strMes_rep_visitas_mensuales_crm: {
											validators: {
												notEmpty: {message: 'Seleccione un mes'}
											}
										},
										strAnio_rep_visitas_mensuales_crm: {
											validators: {
												notEmpty: {message: 'Escriba un año'},
												stringLength: {
													min: 4,
													message: 'El año debe tener 4 caracteres de longitud'
												}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_visitas_mensuales_crm = $('#frmRepVisitasMensualesCRM').data('bootstrapValidator');
			bootstrapValidator_rep_visitas_mensuales_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_visitas_mensuales_crm.isValid())
			{
				//Hacer un llamado a la función para generar reporte
				reporte_rep_visitas_mensuales_crm(strTipo);

			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_visitas_mensuales_crm()
		{
			try
			{
				$('#frmRepVisitasMensualesCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_visitas_mensuales_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/rep_visitas_mensuales/';

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
										'intMes': $('#cmbMes_rep_visitas_mensuales_crm').val(), 
										'strMes': $("#cmbMes_rep_visitas_mensuales_crm option:selected").text(), 
										'strAnio': $('#txtAnio_rep_visitas_mensuales_crm').val(), 
										'intModuloID': $('#txtModuloID_rep_visitas_mensuales_crm').val(),
										'strModulo': $('#txtModulo_rep_visitas_mensuales_crm').val()	
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
			//Asignar el año actual
       		$('#txtAnio_rep_visitas_mensuales_crm').val(anioActual()); 
       		//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtAnio_rep_visitas_mensuales_crm').numeric({decimal: false, negative: false});
			

			//Autocomplete para recuperar los datos de un módulo 
	        $('#txtModulo_rep_visitas_mensuales_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloID_rep_visitas_mensuales_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/modulos/autocomplete",
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
	              $('#txtModuloID_rep_visitas_mensuales_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del módulo cuando pierda el enfoque la caja de texto
	        $('#txtModulo_rep_visitas_mensuales_crm').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloID_rep_visitas_mensuales_crm').val() == '' ||
	               $('#txtModulo_rep_visitas_mensuales_crm').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtModuloID_rep_visitas_mensuales_crm').val('');
	                $('#txtModulo_rep_visitas_mensuales_crm').val('');
	                
	            }
	            
	        });

	        //Enfocar caja de texto
			$('#cmbMes_rep_visitas_mensuales_crm').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_visitas_mensuales_crm();
		});
	</script>