	<div id="RepProspectosCRMContent">  
		<!--Diseño del formulario-->
		<form id="frmRepProspectosCRM" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepProspectosCRM" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_prospectos_crm"
									onclick="reporte_rep_prospectos_crm('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_prospectos_crm"
									onclick="reporte_rep_prospectos_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
			    <div class="row">
					<!--Autocomplete que contiene los módulos activos-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
								<input id="txtModuloID_rep_prospectos_crm" 
									   name="intModuloID_rep_prospectos_crm"  type="hidden" 
									   value="">
								</input>
								<label for="txtModulo_rep_prospectos_crm">Módulo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtModulo_rep_prospectos_crm" 
										name="strModulo_rep_prospectos_crm" type="text" value="" 
										tabindex="1" placeholder="Ingrese módulo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los vendedores activos-->
					<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del vendedor seleccionado-->
								<input id="txtVendedorID_rep_prospectos_crm" name="intVendedorID_rep_prospectos_crm"  
									   type="hidden" value="">
								</input>
								<label for="txtVendedor_rep_prospectos_crm">Vendedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVendedor_rep_prospectos_crm" 
										name="strVendedor_rep_prospectos_crm" type="text" value="" tabindex="1" placeholder="Ingrese vendedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Madurez-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbMadurez_rep_prospectos_crm">Madurez</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbMadurez_rep_prospectos_crm" 
								 		name="strMadurez_rep_prospectos_crm" tabindex="1">
                      				<option value="">Seleccione una opción</option>
                          			<option value="1">1</option>
                         			<option value="2">2</option>
                          			<option value="3">3</option>
                         			<option value="4">4</option>
                 				</select>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene las localidades activas-->
					<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la localidad seleccionada-->
								<input id="txtLocalidadID_rep_prospectos_crm" 
								       name="intLocalidadID_rep_prospectos_crm" type="hidden" value="">
								</input>
								<label for="txtLocalidad_rep_prospectos_crm">Localidad</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtLocalidad_rep_prospectos_crm" 
										name="strLocalidad_rep_prospectos_crm" type="text" value="" 
										tabindex="1" placeholder="Ingrese localidad" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepProspectosCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_prospectos_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/rep_prospectos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_prospectos_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepProspectosCRM = data.row;
					//Separar la cadena 
					var arrPermisosRepProspectosCRM = strPermisosRepProspectosCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepProspectosCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepProspectosCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_prospectos_crm').removeAttr('disabled');
						}
						else if(arrPermisosRepProspectosCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_prospectos_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_prospectos_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/rep_prospectos/';

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
										'intModuloID': $('#txtModuloID_rep_prospectos_crm').val(), 
										'strModulo': $('#txtModulo_rep_prospectos_crm').val(), 
										'intVendedorID': $('#txtVendedorID_rep_prospectos_crm').val(),
										'intLocalidadID': $('#txtLocalidadID_rep_prospectos_crm').val(),
										'strMadurez': $('#cmbMadurez_rep_prospectos_crm').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para inicializar elementos del módulo
		function inicializar_modulo_rep_prospectos_crm()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtVendedorID_rep_prospectos_crm').val('');
			$('#txtVendedor_rep_prospectos_crm').val('');
			//Limpiar contenido del combobox
			$('#cmbMadurez_rep_prospectos_crm').val('');
			//Deshabilitar combobox de madurez
	        $('#cmbMadurez_rep_prospectos_crm').attr('disabled','disabled');

		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Autocomplete para recuperar los datos de un módulo 
	        $('#txtModulo_rep_prospectos_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloID_rep_prospectos_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del módulo
	               inicializar_modulo_rep_prospectos_crm();
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
	              $('#txtModuloID_rep_prospectos_crm').val(ui.item.data);
	              //Habilitar combobox de madurez
				  $('#cmbMadurez_rep_prospectos_crm').removeAttr('disabled');
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
	        $('#txtModulo_rep_prospectos_crm').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloID_rep_prospectos_crm').val() == '' ||
	               $('#txtModulo_rep_prospectos_crm').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtModuloID_rep_prospectos_crm').val('');
	                $('#txtModulo_rep_prospectos_crm').val('');
	                //Hacer un llamado a la función para inicializar elementos del módulo
	                inicializar_modulo_rep_prospectos_crm();
	            }
	            
	        });

			//Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_rep_prospectos_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_rep_prospectos_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: $('#txtModuloID_rep_prospectos_crm').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_rep_prospectos_crm').val(ui.item.data);
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
	        $('#txtVendedor_rep_prospectos_crm').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_rep_prospectos_crm').val() == '' ||
	               $('#txtVendedor_rep_prospectos_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_rep_prospectos_crm').val('');
	               $('#txtVendedor_rep_prospectos_crm').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una localidad 
	        $('#txtLocalidad_rep_prospectos_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtLocalidadID_rep_prospectos_crm').val('');
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
	             $('#txtLocalidadID_rep_prospectos_crm').val(ui.item.data);
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
	        $('#txtLocalidad_rep_prospectos_crm').focusout(function(e){
	            //Si no existe id de la localidad
	            if($('#txtLocalidadID_rep_prospectos_crm').val() == '' || 
	               $('#txtLocalidad_rep_prospectos_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtLocalidadID_rep_prospectos_crm').val('');
	               $('#txtLocalidad_rep_prospectos_crm').val('');
	            }

	        });
			
			//Enfocar caja de texto
			$('#txtModulo_rep_prospectos_crm').focus();
			//Deshabilitar combobox de madurez
	        $('#cmbMadurez_rep_prospectos_crm').attr('disabled','disabled');
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_prospectos_crm();
		});
	</script>