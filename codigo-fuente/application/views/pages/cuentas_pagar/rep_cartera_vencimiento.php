	<div id="RepCarteraVencimientoCuentasPagarContent">  
		<!--Diseño del formulario-->
		<form id="frmRepCarteraVencimientoCuentasPagar" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepCarteraVencimientoCuentasPagar" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_cartera_vencimiento_cuentas_pagar"
									onclick="validar_rep_cartera_vencimiento_cuentas_pagar('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_cartera_vencimiento_cuentas_pagar"
									onclick="validar_rep_cartera_vencimiento_cuentas_pagar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaCorte_rep_cartera_vencimiento_cuentas_pagar">Fecha de corte</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaCorte_rep_cartera_vencimiento_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaCorte_rep_cartera_vencimiento_cuentas_pagar"
				                    		name= "strFechaCorte_rep_cartera_vencimiento_cuentas_pagar" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los proveedores activos-->
					<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
								<input id="txtProveedorID_rep_cartera_vencimiento_cuentas_pagar" name="intProveedorID_rep_cartera_vencimiento_cuentas_pagar"  
									   type="hidden" value="">
								</input>
								<label for="txtProveedor_rep_cartera_vencimiento_cuentas_pagar">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedor_rep_cartera_vencimiento_cuentas_pagar" 
										name="strProveedor_rep_cartera_vencimiento_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_rep_cartera_vencimiento_cuentas_pagar" 
									   name="strImprimirDetalles_rep_cartera_vencimiento_cuentas_pagar" type="checkbox"
									   value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
				</div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepCarteraVencimientoCuentasPagarContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_cartera_vencimiento_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_pagar/rep_cartera_vencimiento/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_cartera_vencimiento_cuentas_pagar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepCarteraVencimientoCuentasPagar = data.row;
					//Separar la cadena 
					var arrPermisosRepCarteraVencimientoCuentasPagar = strPermisosRepCarteraVencimientoCuentasPagar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepCarteraVencimientoCuentasPagar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepCarteraVencimientoCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_cartera_vencimiento_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosRepCarteraVencimientoCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_cartera_vencimiento_cuentas_pagar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_cartera_vencimiento_cuentas_pagar(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_cartera_vencimiento_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmRepCarteraVencimientoCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaCorte_rep_cartera_vencimiento_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_cartera_vencimiento_cuentas_pagar = $('#frmRepCarteraVencimientoCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_rep_cartera_vencimiento_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_cartera_vencimiento_cuentas_pagar.isValid())
			{
			 	//Hacer un llamado a la función para generar reporte en PDF/XLS
			 	reporte_rep_cartera_vencimiento_cuentas_pagar(strTipo);
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_cartera_vencimiento_cuentas_pagar()
		{
			try
			{
				$('#frmRepCarteraVencimientoCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_cartera_vencimiento_cuentas_pagar(strTipo) 
		{
         	//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_pagar/rep_cartera_vencimiento/';

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

			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_rep_cartera_vencimiento_cuentas_pagar').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_rep_cartera_vencimiento_cuentas_pagar').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_rep_cartera_vencimiento_cuentas_pagar').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : { 
										'dteFechaCorte': $.formatFechaMysql($('#txtFechaCorte_rep_cartera_vencimiento_cuentas_pagar').val()),
										'intProveedorID': $('#txtProveedorID_rep_cartera_vencimiento_cuentas_pagar').val(), 
										'strDetalles':$('#chbImprimirDetalles_rep_cartera_vencimiento_cuentas_pagar').val()

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
			$('#dteFechaCorte_rep_cartera_vencimiento_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
		
			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_rep_cartera_vencimiento_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorID_rep_cartera_vencimiento_cuentas_pagar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/proveedores/autocomplete",
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
	             $('#txtProveedorID_rep_cartera_vencimiento_cuentas_pagar').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del proveedor cuando pierda el enfoque la caja de texto
	        $('#txtProveedor_rep_cartera_vencimiento_cuentas_pagar').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_rep_cartera_vencimiento_cuentas_pagar').val() == '' ||
	               $('#txtProveedor_rep_cartera_vencimiento_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorID_rep_cartera_vencimiento_cuentas_pagar').val('');
	               $('#txtProveedor_rep_cartera_vencimiento_cuentas_pagar').val('');
	            }
	            
	        });
			

			//Asignar la fecha actual
       		$('#txtFechaCorte_rep_cartera_vencimiento_cuentas_pagar').val(fechaActual()); 
			//Enfocar caja de texto
			$('#txtProveedor_rep_cartera_vencimiento_cuentas_pagar').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_cartera_vencimiento_cuentas_pagar();
		});
	</script>