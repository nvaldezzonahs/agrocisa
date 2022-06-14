	<div id="RepProspectosLocalidadCRMContent">  
		<!--Diseño del formulario-->
		<form id="frmRepProspectosLocalidadCRM" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepProspectosLocalidadCRM" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_prospectos_localidad_crm"
									onclick="validar_rep_prospectos_localidad_crm('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_prospectos_localidad_crm"
									onclick="validar_rep_prospectos_localidad_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
			    <div class="row">
			    	<!--Tipo de reporte-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbTipoReporte_rep_prospectos_localidad_crm">Información a mostrar</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select class="form-control" id="cmbTipoReporte_rep_prospectos_localidad_crm" 
								 		name="strTipoReporte_rep_prospectos_localidad_crm" tabindex="1">
                      				<option value="">Seleccione una opción</option>
                      				<option value="ACTIVIDADES">ACTIVIDAD</option>
                          			<option value="CULTIVOS">CULTIVO</option>
                        			<option value="HECTAREAS">TIPO DE HECTÁREAS</option>
                         		    <option value="TERRENO">TIPO DE TERRENO</option>
                 				</select>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene los estados activos-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del estado seleccionado-->
								<input id="txtEstadoID_rep_prospectos_localidad_crm" 
								       name="intEstadoID_rep_prospectos_localidad_crm" type="hidden" value="">
								</input>
								<label for="txtEstado_rep_prospectos_localidad_crm">Estado</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtEstado_rep_prospectos_localidad_crm" 
										name="strEstado_rep_prospectos_localidad_crm" type="text" value="" 
										tabindex="1" placeholder="Ingrese estado" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los municipios activos-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del municipio seleccionado-->
								<input id="txtMunicipioID_rep_prospectos_localidad_crm" 
								       name="intMunicipioID_rep_prospectos_localidad_crm" type="hidden" value="">
								</input>
								<label for="txtMunicipio_rep_prospectos_localidad_crm">Municipio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMunicipio_rep_prospectos_localidad_crm" 
										name="strMunicipio_rep_prospectos_localidad_crm" type="text" 
										value="" tabindex="1" placeholder="Ingrese municipio" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepProspectosLocalidadCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_prospectos_localidad_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/rep_prospectos_localidad/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_prospectos_localidad_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepProspectosLocalidadCRM = data.row;
					//Separar la cadena 
					var arrPermisosRepProspectosLocalidadCRM = strPermisosRepProspectosLocalidadCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepProspectosLocalidadCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepProspectosLocalidadCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_prospectos_localidad_crm').removeAttr('disabled');
						}
						else if(arrPermisosRepProspectosLocalidadCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_prospectos_localidad_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}


		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_prospectos_localidad_crm(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_prospectos_localidad_crm();
			//Validación del formulario de campos obligatorios
			$('#frmRepProspectosLocalidadCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strTipoReporte_rep_prospectos_localidad_crm: {
											validators: {
												notEmpty: {message: 'Seleccione el tipo de reporte'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_prospectos_localidad_crm = $('#frmRepProspectosLocalidadCRM').data('bootstrapValidator');
			bootstrapValidator_rep_prospectos_localidad_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_prospectos_localidad_crm.isValid())
			{
			 	//Hacer un llamado a la función para generar reporte 
			 	reporte_rep_prospectos_localidad_crm(strTipo);
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_prospectos_localidad_crm()
		{
			try
			{
				$('#frmRepProspectosLocalidadCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_prospectos_localidad_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/rep_prospectos_localidad/';

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
										'strTipoReporte': $('#cmbTipoReporte_rep_prospectos_localidad_crm').val(),
										'intMunicipioID': $('#txtMunicipioID_rep_prospectos_localidad_crm').val(),
										'intEstadoID': $('#txtEstadoID_rep_prospectos_localidad_crm').val()
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		//Función para inicializar elementos del estado
		function inicializar_estado_rep_prospectos_localidad_crm()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$("#txtMunicipioID_rep_prospectos_localidad_crm").val('');
			$("#txtMunicipio_rep_prospectos_localidad_crm").val('');
		}

		//Función para regresar y obtener los datos de un municipio
		function get_datos_municipio_rep_prospectos_localidad_crm()
		{
			//Hacer un llamado al método del controlador para regresar los datos del municipio
             $.post('crm/municipios/get_datos',
                  { 
                  	strBusqueda:$("#txtMunicipioID_rep_prospectos_localidad_crm").val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtMunicipio_rep_prospectos_localidad_crm").val(data.row.municipio);
	                   $("#txtEstadoID_rep_prospectos_localidad_crm").val(data.row.estado_id);
	                   $("#txtEstado_rep_prospectos_localidad_crm").val(data.row.estado);
                    }
                  }
                 ,
                'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Autocomplete para recuperar los datos de un municipio 
	        $('#txtMunicipio_rep_prospectos_localidad_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtMunicipioID_rep_prospectos_localidad_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/municipios/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intEstadoID: $('#txtEstadoID_rep_prospectos_localidad_crm').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtMunicipioID_rep_prospectos_localidad_crm').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos del municipio
	              get_datos_municipio_rep_prospectos_localidad_crm();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	         //Verificar que exista id del municipio cuando pierda el enfoque la caja de texto
	        $('#txtMunicipio_rep_prospectos_localidad_crm').focusout(function(e){
	            //Si no existe id del municipio
	            if($('#txtMunicipioID_rep_prospectos_localidad_crm').val() == '' || 
	               $('#txtMunicipio_rep_prospectos_localidad_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMunicipioID_rep_prospectos_localidad_crm').val('');
	               $('#txtMunicipio_rep_prospectos_localidad_crm').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de un estado 
	        $('#txtEstado_rep_prospectos_localidad_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtEstadoID_rep_prospectos_localidad_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del estado
			       inicializar_estado_rep_prospectos_localidad_crm();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_estados/autocomplete",
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
	             $('#txtEstadoID_rep_prospectos_localidad_crm').val(ui.item.data);
	              //Elegir estado desde el valor devuelto en el autocomplete
                  ui.item.value = ui.item.value.split(",")[0];
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del estado cuando pierda el enfoque la caja de texto
	        $('#txtEstado_rep_prospectos_localidad_crm').focusout(function(e){
	            //Si no existe id del estado
	            if($('#txtEstadoID_rep_prospectos_localidad_crm').val() == '' ||
	               $('#txtEstado_rep_prospectos_localidad_crm').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtEstadoID_rep_prospectos_localidad_crm').val('');
	                $('#txtEstado_rep_prospectos_localidad_crm').val('');
	                //Hacer un llamado a la función para inicializar elementos del estado
			        inicializar_estado_rep_prospectos_localidad_crm();
	            }
	            
	        });

	        //Enfocar caja de texto
			$('#cmbTipoReporte_rep_prospectos_localidad_crm').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_prospectos_localidad_crm();

		});
	</script>