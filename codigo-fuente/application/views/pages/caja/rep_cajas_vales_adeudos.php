	<div id="RepCajasValesAdeudosCajaContent">  
		<!--Diseño del formulario-->
		<form id="frmRepCajasValesAdeudosCaja" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepCajasValesAdeudosCaja" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_cajas_vales_adeudos_caja"
									onclick="validar_rep_cajas_vales_adeudos_caja('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_cajas_vales_adeudos_caja"
									onclick="validar_rep_cajas_vales_adeudos_caja('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaCorte_rep_cajas_vales_adeudos_caja">Fecha de corte</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaCorte_rep_cajas_vales_adeudos_caja'>
				                    <input class="form-control" id="txtFechaCorte_rep_cajas_vales_adeudos_caja"
				                    		name= "strFechaCorte_rep_cajas_vales_adeudos_caja" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los empleados activos-->
					<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
								<input id="txtEmpleadoID_rep_cajas_vales_adeudos_caja" 
									   name="intEmpleadoID_rep_cajas_vales_adeudos_caja" type="hidden" value="">
								</input>
								<label for="txtEmpleado_rep_cajas_vales_adeudos_caja">Empleado</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtEmpleado_rep_cajas_vales_adeudos_caja" 
										name="strEmpleado_rep_cajas_vales_adeudos_caja" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepCajasValesAdeudosCajaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Variables que se utilizan para la búsqueda de registros
		var intEmpleadoIDRepCajasValesAdeudosCaja = "";
		var dteFechaCorteRepCajasValesAdeudosCaja = "";

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_cajas_vales_adeudos_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/rep_cajas_vales_adeudos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_cajas_vales_adeudos_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepCajasValesAdeudosCaja = data.row;
					//Separar la cadena 
					var arrPermisosRepCajasValesAdeudosCaja = strPermisosRepCajasValesAdeudosCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepCajasValesAdeudosCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepCajasValesAdeudosCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_cajas_vales_adeudos_caja').removeAttr('disabled');
						}
						else if(arrPermisosRepCajasValesAdeudosCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_cajas_vales_adeudos_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_cajas_vales_adeudos_caja(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_cajas_vales_adeudos_caja();
			//Validación del formulario de campos obligatorios
			$('#frmRepCajasValesAdeudosCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaCorte_rep_cajas_vales_adeudos_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_cajas_vales_adeudos_caja = $('#frmRepCajasValesAdeudosCaja').data('bootstrapValidator');
			bootstrapValidator_rep_cajas_vales_adeudos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_cajas_vales_adeudos_caja.isValid())
			{
				//Si el tipo de reporte es PDF
				if(strTipo == 'PDF')
				{
				 	//Hacer un llamado a la función para generar reporte en PDF
				 	reporte_rep_cajas_vales_adeudos_caja();
				}
				else
				{ 
				 	//Hacer un llamado a la función para generar  y descargar el archivo XLS
				 	descargar_xls_rep_cajas_vales_adeudos_caja()
				}
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_cajas_vales_adeudos_caja()
		{
			try
			{
				$('#frmRepCajasValesAdeudosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar el reporte general en PDF
		function reporte_rep_cajas_vales_adeudos_caja() 
		{
			//Asignar valores para la búsqueda de registros
			intEmpleadoIDRepCajasValesAdeudosCaja =  $('#txtEmpleadoID_rep_cajas_vales_adeudos_caja').val();
			dteFechaCorteRepCajasValesAdeudosCaja =  $.formatFechaMysql($('#txtFechaCorte_rep_cajas_vales_adeudos_caja').val());

			//Si no existe id del empleado
			if(intEmpleadoIDRepCajasValesAdeudosCaja == '')
			{
				intEmpleadoIDRepCajasValesAdeudosCaja = 0;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
         	window.open("caja/rep_cajas_vales_adeudos/get_reporte/"+dteFechaCorteRepCajasValesAdeudosCaja+"/"+intEmpleadoIDRepCajasValesAdeudosCaja);
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_rep_cajas_vales_adeudos_caja() 
		{
			//Asignar valores para la búsqueda de registros
			intEmpleadoIDRepCajasValesAdeudosCaja =  $('#txtEmpleadoID_rep_cajas_vales_adeudos_caja').val();
			dteFechaCorteRepCajasValesAdeudosCaja =  $.formatFechaMysql($('#txtFechaCorte_rep_cajas_vales_adeudos_caja').val());
			
			//Si no existe id del empleado
			if(intEmpleadoIDRepCajasValesAdeudosCaja == '')
			{
				intEmpleadoIDRepCajasValesAdeudosCaja = 0;
			}

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("caja/rep_cajas_vales_adeudos/get_xls/"+dteFechaCorteRepCajasValesAdeudosCaja+"/"+intEmpleadoIDRepCajasValesAdeudosCaja);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaCorte_rep_cajas_vales_adeudos_caja').datetimepicker({format: 'DD/MM/YYYY'});
		
			//Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleado_rep_cajas_vales_adeudos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEmpleadoID_rep_cajas_vales_adeudos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/empleados/autocomplete",
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
	             $('#txtEmpleadoID_rep_cajas_vales_adeudos_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del empleado cuando pierda el enfoque la caja de texto
	        $('#txtEmpleado_rep_cajas_vales_adeudos_caja').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoID_rep_cajas_vales_adeudos_caja').val() == '' ||
	               $('#txtEmpleado_rep_cajas_vales_adeudos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoID_rep_cajas_vales_adeudos_caja').val('');
	               $('#txtEmpleado_rep_cajas_vales_adeudos_caja').val('');
	            }
	            
	        });
			

			//Asignar la fecha actual
       		$('#txtFechaCorte_rep_cajas_vales_adeudos_caja').val(fechaActual()); 
			//Enfocar caja de texto
			$('#txtEmpleado_rep_cajas_vales_adeudos_caja').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_cajas_vales_adeudos_caja();
		});
	</script>