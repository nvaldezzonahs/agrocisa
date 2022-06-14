	<div id="RepFacturasMaquinariaContent">  
		<!--Diseño del formulario-->
		<form id="frmRepFacturasMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepFacturasMaquinaria" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_facturas_maquinaria"
									onclick="reporte_rep_facturas_maquinaria();" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_facturas_maquinaria"
									onclick="descargar_xls_rep_facturas_maquinaria();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaInicial_rep_facturas_maquinaria">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_facturas_maquinaria'>
				                    <input class="form-control" id="txtFechaInicial_rep_facturas_maquinaria"
				                    		name= "strFechaInicial_rep_facturas_maquinaria" 
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
								<label for="txtFechaFinal_rep_facturas_maquinaria">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_facturas_maquinaria'>
				                    <input class="form-control" id="txtFechaFinal_rep_facturas_maquinaria"
				                    		name= "strFechaFinal_rep_facturas_maquinaria" 
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
					<!--Autocomplete que contiene los vendedores activos-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del vendedor seleccionado-->
								<input id="txtVendedorID_rep_facturas_maquinaria" name="intVendedorID_rep_facturas_maquinaria"  
									   type="hidden" value="">
								</input>
								<label for="txtVendedor_rep_facturas_maquinaria">Vendedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVendedor_rep_facturas_maquinaria" 
										name="strVendedor_rep_facturas_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese vendedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los clientes activos-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
								<input id="txtProspectoID_rep_facturas_maquinaria" 
									   name="intProspectoID_rep_facturas_maquinaria" type="hidden" value="">
								</input>
								<label for="txtCliente_rep_facturas_maquinaria">Cliente</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtCliente_rep_facturas_maquinaria" 
										name="strCliente_rep_facturas_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese cliente" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene las localidades activas-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la localidad seleccionada-->
								<input id="txtLocalidadID_rep_facturas_maquinaria" 
								       name="intLocalidadID_rep_facturas_maquinaria" type="hidden" value="">
								</input>
								<label for="txtLocalidad_rep_facturas_maquinaria">Localidad</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtLocalidad_rep_facturas_maquinaria" 
										name="strLocalidad_rep_facturas_maquinaria" type="text" value="" 
										tabindex="1" placeholder="Ingrese localidad" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene las líneas de maquinaria activas-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la línea de maquinaria seleccionada-->
								<input id="txtMaquinariaLineaID_rep_facturas_maquinaria" name="intMaquinariaLineaID_rep_facturas_maquinaria"  
									   type="hidden" value="">
								</input>
								<label for="txtMaquinariaLinea_rep_facturas_maquinaria">Línea</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMaquinariaLinea_rep_facturas_maquinaria" 
										name="strMaquinariaLinea_rep_facturas_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese línea" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene las marcas de maquinaria activas-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la marca de maquinaria seleccionada-->
								<input id="txtMaquinariaMarcaID_rep_facturas_maquinaria" name="intMaquinariaMarcaID_rep_facturas_maquinaria"  
								   type="hidden" value="">
								</input>
								<label for="txtMaquinariaMarca_rep_facturas_maquinaria">Marca</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMaquinariaMarca_rep_facturas_maquinaria" 
										name="strMaquinariaMarca_rep_facturas_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese marca" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los modelos de maquinaria activos-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del modelo de maquinaria seleccionado-->
								<input id="txtMaquinariaModeloID_rep_facturas_maquinaria" name="intMaquinariaModeloID_rep_facturas_maquinaria"  
									   type="hidden" value="">
								</input>
								<label for="txtMaquinariaModelo_rep_facturas_maquinaria">Modelo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMaquinariaModelo_rep_facturas_maquinaria" 
										name="strMaquinariaModelo_rep_facturas_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese modelo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepFacturasMaquinariaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Variable que se utiliza para asignar el id del módulo de maquinaria
		var intModuloIDRepFacturasMaquinaria = <?php echo MODULO_MAQUINARIA ?>;
		//Variables que se utilizan para la búsqueda de registros
		var intVendedorIDRepFacturasMaquinaria = "";
		var dteFechaInicialRepFacturasMaquinaria = "";
		var dteFechaFinalRepFacturasMaquinaria = "";

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_facturas_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/rep_facturas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_facturas_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepFacturasMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosRepFacturasMaquinaria = strPermisosRepFacturasMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepFacturasMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepFacturasMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_facturas_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosRepFacturasMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_facturas_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_rep_facturas_maquinaria() 
		{			
			//Asignar valores para la búsqueda de registros
			intVendedorIDRepFacturasMaquinaria =  $('#txtVendedorID_rep_facturas_maquinaria').val();
			dteFechaInicialRepFacturasMaquinaria =  $.formatFechaMysql($('#txtFechaInicial_rep_facturas_maquinaria').val());
			dteFechaFinalRepFacturasMaquinaria =  $.formatFechaMysql($('#txtFechaFinal_rep_facturas_maquinaria').val());

			//Si no existe id del vendedor
			if(intVendedorIDRepFacturasMaquinaria == '')
			{
				intVendedorIDRepFacturasMaquinaria = 0;
			}

			//Si no existe fecha inicial
			if(dteFechaInicialRepFacturasMaquinaria == '')
			{
				dteFechaInicialRepFacturasMaquinaria = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalRepFacturasMaquinaria == '')
			{
				dteFechaFinalRepFacturasMaquinaria =  '0000-00-00';
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			/*window.open("maquinaria/rep_facturas/get_reporte/"+$('#cmbModulo_rep_facturas_maquinaria').val()+"/"+intVendedorIDRepFacturasMaquinaria+'/'+dteFechaInicialRepFacturasMaquinaria+"/"+dteFechaFinalRepFacturasMaquinaria);*/
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_rep_facturas_maquinaria() 
		{
			//Asignar valores para la búsqueda de registros
			intVendedorIDRepFacturasMaquinaria =  $('#txtVendedorID_rep_facturas_maquinaria').val();
			dteFechaInicialRepFacturasMaquinaria =  $.formatFechaMysql($('#txtFechaInicial_rep_facturas_maquinaria').val());
			dteFechaFinalRepFacturasMaquinaria =  $.formatFechaMysql($('#txtFechaFinal_rep_facturas_maquinaria').val());

			//Si no existe id del vendedor
			if(intVendedorIDRepFacturasMaquinaria == '')
			{
				intVendedorIDRepFacturasMaquinaria = 0;
			}

			//Si no existe fecha inicial
			if(dteFechaInicialRepFacturasMaquinaria == '')
			{
				dteFechaInicialRepFacturasMaquinaria = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalRepFacturasMaquinaria == '')
			{
				dteFechaFinalRepFacturasMaquinaria =  '0000-00-00';
			}
			
			/*//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("maquinaria/rep_facturas/get_xls/"+$('#cmbModulo_rep_facturas_maquinaria').val()+"/"+intVendedorIDRepFacturasMaquinaria+'/'+dteFechaInicialRepFacturasMaquinaria+"/"+dteFechaFinalRepFacturasMaquinaria);*/
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicial_rep_facturas_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_facturas_maquinaria').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_facturas_maquinaria').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_facturas_maquinaria').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_facturas_maquinaria').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_facturas_maquinaria').data('DateTimePicker').maxDate(e.date);
			});


			//Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_rep_facturas_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_rep_facturas_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intModuloID: intModuloIDRepFacturasMaquinaria
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_rep_facturas_maquinaria').val(ui.item.data);
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
	        $('#txtVendedor_rep_facturas_maquinaria').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_rep_facturas_maquinaria').val() == '' ||
	               $('#txtVendedor_rep_facturas_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_rep_facturas_maquinaria').val('');
	               $('#txtVendedor_rep_facturas_maquinaria').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un cliente 
	        $('#txtCliente_rep_facturas_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_rep_facturas_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete",
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
	             //Asignar valores del registro seleccionado
	             $('#txtProspectoID_rep_facturas_maquinaria').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del cliente cuando pierda el enfoque la caja de texto
	        $('#txtCliente_rep_facturas_maquinaria').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_rep_facturas_maquinaria').val() == '' ||
	               $('#txtCliente_rep_facturas_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_rep_facturas_maquinaria').val('');
	               $('#txtCliente_rep_facturas_maquinaria').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una localidad 
	        $('#txtLocalidad_rep_facturas_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtLocalidadID_rep_facturas_maquinaria').val('');
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
	             $('#txtLocalidadID_rep_facturas_maquinaria').val(ui.item.data);
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
	        $('#txtLocalidad_rep_facturas_maquinaria').focusout(function(e){
	            //Si no existe id de la localidad
	            if($('#txtLocalidadID_rep_facturas_maquinaria').val() == '' || 
	               $('#txtLocalidad_rep_facturas_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtLocalidadID_rep_facturas_maquinaria').val('');
	               $('#txtLocalidad_rep_facturas_maquinaria').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una línea de maquinaria
	        $('#txtMaquinariaLinea_rep_facturas_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro  
	                 $('#txtMaquinariaLineaID_rep_facturas_maquinaria').val('');
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
	               $('#txtMaquinariaLineaID_rep_facturas_maquinaria').val(ui.item.data);
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
	        $('#txtMaquinariaLinea_rep_facturas_maquinaria').focusout(function(e){
	            //Si no existe id  de la línea de maquinaria
	            if($('#txtMaquinariaLineaID_rep_facturas_maquinaria').val() == '' ||
	               $('#txtMaquinariaLinea_rep_facturas_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaLineaID_rep_facturas_maquinaria').val('');
	               $('#txtMaquinariaLinea_rep_facturas_maquinaria').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una marca de maquinaria
	        $('#txtMaquinariaMarca_rep_facturas_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro  
	                 $('#txtMaquinariaMarcaID_rep_facturas_maquinaria').val('');
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
	               $('#txtMaquinariaMarcaID_rep_facturas_maquinaria').val(ui.item.data);
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
	        $('#txtMaquinariaMarca_rep_facturas_maquinaria').focusout(function(e){
	            //Si no existe id  de la marca de maquinaria
	            if($('#txtMaquinariaMarcaID_rep_facturas_maquinaria').val() == '' ||
	               $('#txtMaquinariaMarca_rep_facturas_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaMarcaID_rep_facturas_maquinaria').val('');
	               $('#txtMaquinariaMarca_rep_facturas_maquinaria').val('');
	            }
	        });

			//Autocomplete para recuperar los datos de un modelo de maquinaria
	        $('#txtMaquinariaModelo_rep_facturas_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro  
	                 $('#txtMaquinariaModeloID_rep_facturas_maquinaria').val('');
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
	               $('#txtMaquinariaModeloID_rep_facturas_maquinaria').val(ui.item.data);
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
	        $('#txtMaquinariaModelo_rep_facturas_maquinaria').focusout(function(e){
	            //Si no existe id  del modelo de maquinaria
	            if($('#txtMaquinariaModeloID_rep_facturas_maquinaria').val() == '' ||
	               $('#txtMaquinariaModelo_rep_facturas_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaModeloID_rep_facturas_maquinaria').val('');
	               $('#txtMaquinariaModelo_rep_facturas_maquinaria').val('');
	            }
	        });
			
			//Enfocar caja de texto
			$('#txtFechaInicial_rep_facturas_maquinaria').focus();				
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_facturas_maquinaria();
		});
	</script>