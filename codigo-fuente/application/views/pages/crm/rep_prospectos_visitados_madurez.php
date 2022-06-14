	<div id="RepProspectosVisitadosMadurezCRMContent">  
		<!--Diseño del formulario-->
		<form id="frmRepProspectosVisitadosMadurezCRM" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepProspectosVisitadosMadurezCRM" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_prospectos_visitados_madurez_crm"
									onclick="validar_rep_prospectos_visitados_madurez_crm('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_prospectos_visitados_madurez_crm"
									onclick="validar_rep_prospectos_visitados_madurez_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaCorte_rep_prospectos_visitados_madurez_crm">Fecha de corte</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaCorte_rep_prospectos_visitados_madurez_crm'>
				                    <input class="form-control" id="txtFechaCorte_rep_prospectos_visitados_madurez_crm"
				                    		name= "strFechaCorte_rep_prospectos_visitados_madurez_crm" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los módulos activos-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
								<input id="txtModuloID_rep_prospectos_visitados_madurez_crm" 
									   name="intModuloID_rep_prospectos_visitados_madurez_crm"  type="hidden" 
									   value="">
								</input>
								<label for="txtModulo_rep_prospectos_visitados_madurez_crm">Módulo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtModulo_rep_prospectos_visitados_madurez_crm" 
										name="strModulo_rep_prospectos_visitados_madurez_crm" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Autocomplete que contiene los vendedores activos-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del vendedor seleccionado-->
								<input id="txtVendedorID_rep_prospectos_visitados_madurez_crm" name="intVendedorID_rep_prospectos_visitados_madurez_crm"  
									   type="hidden" value="">
								</input>
								<label for="txtVendedor_rep_prospectos_visitados_madurez_crm">Vendedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVendedor_rep_prospectos_visitados_madurez_crm" 
										name="strVendedor_rep_prospectos_visitados_madurez_crm" type="text" value="" tabindex="1" placeholder="Ingrese vendedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene las localidades activas-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la localidad seleccionada-->
								<input id="txtLocalidadID_rep_prospectos_visitados_madurez_crm" 
								       name="intLocalidadID_rep_prospectos_visitados_madurez_crm" type="hidden" value="">
								</input>
								<label for="txtLocalidad_rep_prospectos_visitados_madurez_crm">Localidad</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtLocalidad_rep_prospectos_visitados_madurez_crm" 
										name="strLocalidad_rep_prospectos_visitados_madurez_crm" type="text" value="" 
										tabindex="1" placeholder="Ingrese localidad" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepProspectosVisitadosMadurezCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_prospectos_visitados_madurez_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/rep_prospectos_visitados_madurez/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_prospectos_visitados_madurez_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepProspectosVisitadosMadurezCRM = data.row;
					//Separar la cadena 
					var arrPermisosRepProspectosVisitadosMadurezCRM = strPermisosRepProspectosVisitadosMadurezCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepProspectosVisitadosMadurezCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepProspectosVisitadosMadurezCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_prospectos_visitados_madurez_crm').removeAttr('disabled');
						}
						else if(arrPermisosRepProspectosVisitadosMadurezCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_prospectos_visitados_madurez_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_prospectos_visitados_madurez_crm(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_prospectos_visitados_madurez_crm();
			//Validación del formulario de campos obligatorios
			$('#frmRepProspectosVisitadosMadurezCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaCorte_rep_prospectos_visitados_madurez_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_prospectos_visitados_madurez_crm = $('#frmRepProspectosVisitadosMadurezCRM').data('bootstrapValidator');
			bootstrapValidator_rep_prospectos_visitados_madurez_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_prospectos_visitados_madurez_crm.isValid())
			{			
				//Hacer un llamado a la función para generar reporte
				reporte_rep_prospectos_visitados_madurez_crm(strTipo);
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_prospectos_visitados_madurez_crm()
		{
			try
			{
				$('#frmRepProspectosVisitadosMadurezCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_prospectos_visitados_madurez_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/rep_prospectos_visitados_madurez/';

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
										'dteFechaCorte': $.formatFechaMysql($('#txtFechaCorte_rep_prospectos_visitados_madurez_crm').val()), 
										'intModuloID': $('#txtModuloID_rep_prospectos_visitados_madurez_crm').val(),
										'strModulo': $('#txtModulo_rep_prospectos_visitados_madurez_crm').val(),
										'intVendedorID': $('#txtVendedorID_rep_prospectos_visitados_madurez_crm').val(),
										'intLocalidadID': $('#txtLocalidadID_rep_prospectos_visitados_madurez_crm').val()
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para inicializar elementos del módulo
		function inicializar_modulo_rep_prospectos_visitados_madurez_crm()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtVendedorID_rep_prospectos_visitados_madurez_crm').val('');
			$('#txtVendedor_rep_prospectos_visitados_madurez_crm').val('');
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a la siguiente caja de texto el datepicker para seleccionar fecha
         	$('#dteFechaCorte_rep_prospectos_visitados_madurez_crm').datetimepicker({format: 'DD/MM/YYYY'});

         	//Autocomplete para recuperar los datos de un módulo 
	        $('#txtModulo_rep_prospectos_visitados_madurez_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloID_rep_prospectos_visitados_madurez_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del módulo
	               inicializar_modulo_rep_prospectos_visitados_madurez_crm();
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
	              $('#txtModuloID_rep_prospectos_visitados_madurez_crm').val(ui.item.data);
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
	        $('#txtModulo_rep_prospectos_visitados_madurez_crm').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloID_rep_prospectos_visitados_madurez_crm').val() == '' ||
	               $('#txtModulo_rep_prospectos_visitados_madurez_crm').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtModuloID_rep_prospectos_visitados_madurez_crm').val('');
	                $('#txtModulo_rep_prospectos_visitados_madurez_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del módulo
	               inicializar_modulo_rep_prospectos_visitados_madurez_crm();
	            }
	            
	        });

			//Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_rep_prospectos_visitados_madurez_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_rep_prospectos_visitados_madurez_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: $('#txtModuloID_rep_prospectos_visitados_madurez_crm').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_rep_prospectos_visitados_madurez_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vendedor cuando pierda el enfoque la caja de texto
	        $('#txtVendedor_rep_prospectos_visitados_madurez_crm').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_rep_prospectos_visitados_madurez_crm').val() == '' ||
	               $('#txtVendedor_rep_prospectos_visitados_madurez_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_rep_prospectos_visitados_madurez_crm').val('');
	               $('#txtVendedor_rep_prospectos_visitados_madurez_crm').val('');
	            }
	            
	        });

	        
	        //Autocomplete para recuperar los datos de una localidad 
	        $('#txtLocalidad_rep_prospectos_visitados_madurez_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtLocalidadID_rep_prospectos_visitados_madurez_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/localidades/autocomplete",
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
	             $('#txtLocalidadID_rep_prospectos_visitados_madurez_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la localidad cuando pierda el enfoque la caja de texto
	        $('#txtLocalidad_rep_prospectos_visitados_madurez_crm').focusout(function(e){
	            //Si no existe id de la localidad
	            if($('#txtLocalidadID_rep_prospectos_visitados_madurez_crm').val() == '' ||
	               $('#txtLocalidad_rep_prospectos_visitados_madurez_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtLocalidadID_rep_prospectos_visitados_madurez_crm').val('');
	               $('#txtLocalidad_rep_prospectos_visitados_madurez_crm').val('');
	            }
	            
	        });

			//Asignar la fecha actual
       		$('#txtFechaCorte_rep_prospectos_visitados_madurez_crm').val(fechaActual()); 
			//Enfocar caja de texto
			$('#txtModulo_rep_prospectos_visitados_madurez_crm').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_prospectos_visitados_madurez_crm();
		});
	</script>