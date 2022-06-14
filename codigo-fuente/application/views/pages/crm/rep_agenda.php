	<div id="RepAgendaCRMContent">  
		<!--Diseño del formulario-->
		<form id="frmRepAgendaCRM" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepAgendaCRM" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_agenda_crm"
									onclick="reporte_rep_agenda_crm('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_agenda_crm"
									onclick="reporte_rep_agenda_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaInicial_rep_agenda_crm">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div  class='input-group date' id='dteFechaInicial_rep_agenda_crm'>
				                    <input class="form-control" id="txtFechaInicial_rep_agenda_crm"
				                    		name= "strFechaInicial_rep_agenda_crm" 
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
								<label for="txtFechaFinal_rep_agenda_crm">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_agenda_crm'>
				                    <input class="form-control" id="txtFechaFinal_rep_agenda_crm"
				                    		name= "strFechaFinal_rep_agenda_crm" 
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
			    	<!--Autocomplete que contiene los módulos activos-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
								<input id="txtModuloID_rep_agenda_crm" 
									   name="intModuloID_rep_agenda_crm"  type="hidden" 
									   value="">
								</input>
								<label for="txtModulo_rep_agenda_crm">Módulo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtModulo_rep_agenda_crm" 
										name="strModulo_rep_agenda_crm" type="text" value="" 
										tabindex="1" placeholder="Ingrese módulo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los vendedotes activos-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del vendedor seleccionado-->
								<input id="txtVendedorID_rep_agenda_crm" name="intVendedorID_rep_agenda_crm"  
									   type="hidden" value="">
								</input>
								<label for="txtVendedor_rep_agenda_crm">Vendedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVendedor_rep_agenda_crm" 
										name="strVendedor_rep_agenda_crm" type="text" value="" tabindex="1" placeholder="Ingrese vendedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepAgendaCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_agenda_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/rep_agenda/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_agenda_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepAgendaCRM = data.row;
					//Separar la cadena 
					var arrPermisosRepAgendaCRM = strPermisosRepAgendaCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepAgendaCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepAgendaCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_agenda_crm').removeAttr('disabled');
						}
						else if(arrPermisosRepAgendaCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_agenda_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_agenda_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/rep_agenda/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_rep_agenda_crm').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_agenda_crm').val()),
										'intModuloID': $('#txtModuloID_rep_agenda_crm').val(),
										'strModulo': $('#txtModulo_rep_agenda_crm').val(),
										'intVendedorID': $('#txtVendedorID_rep_agenda_crm').val()	
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para inicializar elementos del módulo
		function inicializar_modulo_rep_agenda_crm()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtVendedorID_rep_agenda_crm').val('');
			$('#txtVendedor_rep_agenda_crm').val('');
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicial_rep_agenda_crm').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_agenda_crm').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_agenda_crm').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_agenda_crm').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_agenda_crm').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_agenda_crm').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un módulo 
	        $('#txtModulo_rep_agenda_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloID_rep_agenda_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del módulo
	               inicializar_modulo_rep_agenda_crm();
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
	              $('#txtModuloID_rep_agenda_crm').val(ui.item.data);
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
	        $('#txtModulo_rep_agenda_crm').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloID_rep_agenda_crm').val() == '' ||
	               $('#txtModulo_rep_agenda_crm').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtModuloID_rep_agenda_crm').val('');
	                $('#txtModulo_rep_agenda_crm').val('');
	                //Hacer un llamado a la función para inicializar elementos del módulo
	                inicializar_modulo_rep_agenda_crm();
	            }
	            
	        });

			//Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_rep_agenda_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_rep_agenda_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: $('#txtModuloID_rep_agenda_crm').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_rep_agenda_crm').val(ui.item.data);
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
	        $('#txtVendedor_rep_agenda_crm').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_rep_agenda_crm').val() == '' ||
	               $('#txtVendedor_rep_agenda_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_rep_agenda_crm').val('');
	               $('#txtVendedor_rep_agenda_crm').val('');
	            }
	            
	        });
			
			//Enfocar caja de texto
			$('#txtFechaInicial_rep_agenda_crm').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_agenda_crm();
		});
	</script>