	<div id="RepInventarioMaquinariaContent">  
		<!--Diseño del formulario-->
		<form id="frmRepInventarioMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepInventarioMaquinaria" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_inventario_maquinaria"
									onclick="validar_rep_inventario_maquinaria('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_inventario_maquinaria"
									onclick="validar_rep_inventario_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaCorte_rep_inventario_maquinaria">Fecha de corte</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaCorte_rep_inventario_maquinaria'>
				                    <input class="form-control" id="txtFechaCorte_rep_inventario_maquinaria"
				                    		name= "strFechaCorte_rep_inventario_maquinaria" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
			    	<!--Incluir-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbConsignacion_rep_inventario_maquinaria">Incluir</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbConsignacion_rep_inventario_maquinaria" 
								 		name="strConsignacion_rep_inventario_maquinaria" tabindex="1">
								 	<option value="TODOS">TODOS</option>
                      				<option value="NO">COMPRA</option>
                      				<option value="SI">CONSIGNACIÓN</option>
                 				</select>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene las líneas de maquinaria activas-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la línea de maquinaria seleccionada-->
								<input id="txtMaquinariaLineaID_rep_inventario_maquinaria" name="intMaquinariaLineaID_rep_inventario_maquinaria"  
									   type="hidden" value="">
								</input>
								<label for="txtMaquinariaLinea_rep_inventario_maquinaria">Línea</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMaquinariaLinea_rep_inventario_maquinaria" 
										name="strMaquinariaLinea_rep_inventario_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese línea" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene las marcas de maquinaria activas-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la marca de maquinaria seleccionada-->
								<input id="txtMaquinariaMarcaID_rep_inventario_maquinaria" name="intMaquinariaMarcaID_rep_inventario_maquinaria"  
								   type="hidden" value="">
								</input>
								<label for="txtMaquinariaMarca_rep_inventario_maquinaria">Marca</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMaquinariaMarca_rep_inventario_maquinaria" 
										name="strMaquinariaMarca_rep_inventario_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese marca" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene los modelos de maquinaria activos-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del modelo de maquinaria seleccionado-->
								<input id="txtMaquinariaModeloID_rep_inventario_maquinaria" name="intMaquinariaModeloID_rep_inventario_maquinaria"  
									   type="hidden" value="">
								</input>
								<label for="txtMaquinariaModelo_rep_inventario_maquinaria">Modelo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMaquinariaModelo_rep_inventario_maquinaria" 
										name="strMaquinariaModelo_rep_inventario_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese modelo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepInventarioMaquinariaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_inventario_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/rep_inventario/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_inventario_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepInventarioMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosRepInventarioMaquinaria = strPermisosRepInventarioMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepInventarioMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepInventarioMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_inventario_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosRepInventarioMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_inventario_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_inventario_maquinaria(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_inventario_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmRepInventarioMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaCorte_rep_inventario_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_inventario_maquinaria = $('#frmRepInventarioMaquinaria').data('bootstrapValidator');
			bootstrapValidator_rep_inventario_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_inventario_maquinaria.isValid())
			{
				
			 	//Hacer un llamado a la función para generar reporte en PDF/XLS
			 	reporte_rep_inventario_maquinaria(strTipo);
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_inventario_maquinaria()
		{
			try
			{
				$('#frmRepInventarioMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_inventario_maquinaria(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/rep_inventario/';

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
										'dteFechaCorte': $.formatFechaMysql($('#txtFechaCorte_rep_inventario_maquinaria').val()), 
										'strConsignacion': $('#cmbConsignacion_rep_inventario_maquinaria').val(),
									    'intMaquinariaLineaID': $('#txtMaquinariaLineaID_rep_inventario_maquinaria').val(),
									    'intMaquinariaMarcaID': $('#txtMaquinariaMarcaID_rep_inventario_maquinaria').val(),
									    'intMaquinariaModeloID': $('#txtMaquinariaModeloID_rep_inventario_maquinaria').val()
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
			$('#dteFechaCorte_rep_inventario_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});

			//Autocomplete para recuperar los datos de una línea de maquinaria
	        $('#txtMaquinariaLinea_rep_inventario_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro  
	                 $('#txtMaquinariaLineaID_rep_inventario_maquinaria').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "maquinaria/maquinaria_lineas/autocomplete",
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
	               $('#txtMaquinariaLineaID_rep_inventario_maquinaria').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la línea de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMaquinariaLinea_rep_inventario_maquinaria').focusout(function(e){
	            //Si no existe id  de la línea de maquinaria
	            if($('#txtMaquinariaLineaID_rep_inventario_maquinaria').val() == '' ||
	               $('#txtMaquinariaLinea_rep_inventario_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaLineaID_rep_inventario_maquinaria').val('');
	               $('#txtMaquinariaLinea_rep_inventario_maquinaria').val('');
	            }
	        });

			//Autocomplete para recuperar los datos de una marca de maquinaria
	        $('#txtMaquinariaMarca_rep_inventario_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro  
	                 $('#txtMaquinariaMarcaID_rep_inventario_maquinaria').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "maquinaria/maquinaria_marcas/autocomplete",
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
	               $('#txtMaquinariaMarcaID_rep_inventario_maquinaria').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la marca de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMaquinariaMarca_rep_inventario_maquinaria').focusout(function(e){
	            //Si no existe id  de la marca de maquinaria
	            if($('#txtMaquinariaMarcaID_rep_inventario_maquinaria').val() == '' ||
	               $('#txtMaquinariaMarca_rep_inventario_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaMarcaID_rep_inventario_maquinaria').val('');
	               $('#txtMaquinariaMarca_rep_inventario_maquinaria').val('');
	            }
	        });

			//Autocomplete para recuperar los datos de un modelo de maquinaria
	        $('#txtMaquinariaModelo_rep_inventario_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro  
	                 $('#txtMaquinariaModeloID_rep_inventario_maquinaria').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "maquinaria/maquinaria_modelos/autocomplete",
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
	               $('#txtMaquinariaModeloID_rep_inventario_maquinaria').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del modelo de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMaquinariaModelo_rep_inventario_maquinaria').focusout(function(e){
	            //Si no existe id  del modelo de maquinaria
	            if($('#txtMaquinariaModeloID_rep_inventario_maquinaria').val() == '' ||
	               $('#txtMaquinariaModelo_rep_inventario_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaModeloID_rep_inventario_maquinaria').val('');
	               $('#txtMaquinariaModelo_rep_inventario_maquinaria').val('');
	            }
	        });
			
			//Asignar la fecha actual
       		$('#txtFechaCorte_rep_inventario_maquinaria').val(fechaActual()); 


			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_inventario_maquinaria();
		});
	</script>