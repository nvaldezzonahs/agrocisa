<div id="RepPresupuestosGastosInventariosFisicos">  
		<!--Diseño del formulario-->
		<form id="frmRepPresupuestosGastosInventariosFisicos" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepPresupuestosGastosInventariosFisicos" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_presupuestos_gastos_inventarios_fisicos"
									onclick="validar_rep_presupuestos_gastos_inventarios_fisicos('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" >
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_presupuestos_gastos_inventarios_fisicos"
									onclick="validar_rep_presupuestos_gastos_inventarios_fisicos('XLS');" title="Descargar reporte general en XLS" tabindex="1" >
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				<div class="row">
					<!--Autocomplete que contiene los sucursales activos-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">

								<!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
								<input id="txtSucursalID_rep_presupuestos_gastos_inventarios_fisicos" 
								       name="intSucursalID_rep_presupuestos_gastos_inventarios_fisicos" type="hidden" value="">
								</input>
								<label for="txtSucursal_rep_presupuestos_gastos_inventarios_fisicos">Sucursal</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtSucursal_rep_presupuestos_gastos_inventarios_fisicos" 
										name="strSucursal_rep_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
										tabindex="1" placeholder="Ingrese sucursal" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los departamentos activos-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del departamento seleccionado-->
								<input id="txtDepartamentoID_rep_presupuestos_gastos_inventarios_fisicos" 
									   name="intDepartamentoID_rep_presupuestos_gastos_inventarios_fisicos"  
									   type="hidden" value="">
								</input>
								<label for="txtDepartamento_rep_presupuestos_gastos_inventarios_fisicos">Departamento</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtDepartamento_rep_presupuestos_gastos_inventarios_fisicos" 
										name="strDepartamento_rep_presupuestos_gastos_inventarios_fisicos" type="text" value="" tabindex="1" placeholder="Ingrese departamento" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Año-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtAnio_rep_presupuestos_gastos_inventarios_fisicos">Año</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtAnio_rep_presupuestos_gastos_inventarios_fisicos" 
										name="strAnio_rep_presupuestos_gastos_inventarios_fisicos" type="number" value=""
										tabindex="1" placeholder="Ingrese año" maxlength="4">
								</input>
							</div>
						</div>
					</div>
			    </div>
			  			    
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepCarteraVencimientoCuentasPagarContent -->
	<!-- /.Plantilla para cargar las sucursales-->  
	
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_presupuestos_gastos_inventarios_fisicos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('inventarios_fisicos/Rep_presupuesto_gastos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_presupuestos_gastos_inventarios_fisicos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepPresupuestosGastosInventariosFisicos = data.row;
					//Separar la cadena 
					var arrPermisosRepPresupuestosGastosInventariosFisicos = strPermisosRepPresupuestosGastosInventariosFisicos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepPresupuestosGastosInventariosFisicos.length; i++)
					{	//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepPresupuestosGastosInventariosFisicos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_presupuestos_gastos_inventarios_fisicos').removeAttr('disabled');
						}				
						else if(arrPermisosRepPresupuestosGastosInventariosFisicos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_presupuestos_gastos_inventarios_fisicos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para descargar el reporte general en XLS
		function validar_rep_presupuestos_gastos_inventarios_fisicos(strTipo) 
		{	//Hacer un llamado a la función para limpiar los mensajes de error 
				limpiar_mensajes_rep_presupuestos_gastos_inventarios_fisicos();
				//Validación del formulario de campos obligatorios
				$('#frmRepPresupuestosGastosInventariosFisicos')
					.bootstrapValidator({excluded: [':disabled'],
										 container: 'popover',
										 feedbackIcons: {
										 	valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
										  },
										  fields: {
											strAnio_rep_presupuestos_contabilidad: {
												validators: {
													notEmpty: {message: 'Escriba un año'}
												}
											}
										}
					});
				//Variable que se utiliza para asignar el objeto bootstrapValidator
				var bootstrapValidator_rep_presupuestos_gastos_inventarios_fisicos = $('#frmRepPresupuestosGastosInventariosFisicos').data('bootstrapValidator');
				bootstrapValidator_rep_presupuestos_gastos_inventarios_fisicos.validate();
				//Si se cumplen las reglas de validación
				if(bootstrapValidator_rep_presupuestos_gastos_inventarios_fisicos.isValid())
				{					
					//Si el tipo de reporte es PDF
					if(strTipo == 'PDF')
					{
					 	//Hacer un llamado a la función para generar reporte en PDF
					 	reporte_rep_presupuestos_gastos_inventarios_fisicos();
					}
					else
					{ 
					 	//Hacer un llamado a la función para generar  y descargar el archivo XLS
					 	descargar_xls_rep_presupuestos_gastos_inventarios_fisicos()
					}
				}
				else 
					return;
			

		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_presupuestos_gastos_inventarios_fisicos()
		{
			try
			{
				$('#frmRepPresupuestosGastosInventariosFisicos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar el reporte general en PDF
		function reporte_rep_presupuestos_gastos_inventarios_fisicos() 
		{
			//Asignar valores para la búsqueda de registros
			var intSucursalID = $('#txtSucursalID_rep_presupuestos_gastos_inventarios_fisicos').val();
			var intDepartamentoID = $('#txtDepartamentoID_rep_presupuestos_gastos_inventarios_fisicos').val();
			var intAnio = $('#txtAnio_rep_presupuestos_gastos_inventarios_fisicos').val();
			if(!intSucursalID){
				intSucursalID = 0;
			}		

			if(!intDepartamentoID){
				intDepartamentoID = 0;
			}	
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
			if(intAnio){
	     		window.open("inventarios_fisicos/rep_presupuesto_gastos/get_reporte/"+intSucursalID+"/"+ intDepartamentoID+"/"+ intAnio);
	     	}
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_rep_presupuestos_gastos_inventarios_fisicos() 
		{
			
			//Asignar valores para la búsqueda de registros
			var intSucursalID = $('#txtSucursalID_rep_presupuestos_gastos_inventarios_fisicos').val();
			var intDepartamentoID = $('#txtDepartamentoID_rep_presupuestos_gastos_inventarios_fisicos').val();
			var intAnio = $('#txtAnio_rep_presupuestos_gastos_inventarios_fisicos').val();

			if(!intSucursalID){
				intSucursalID = 0;
			}		

			if(!intDepartamentoID){
				intDepartamentoID = 0;
			}	
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
			if(intAnio){
				window.open("inventarios_fisicos/rep_presupuesto_gastos/get_xls/"+intSucursalID+"/"+ intDepartamentoID+"/"+ intAnio);
			}
	     	

		}
		

		//Controles o Eventos del Modal
		$(document).ready(function() {
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Asignar el año actual			
			$('#txtAnio_rep_presupuestos_gastos_inventarios_fisicos').val(anioActual());

			//Comprobar la existencia del presupuesto en la BD cuando cambie el año
			$('#txtAnio_rep_presupuestos_gastos_inventarios_fisicos').change(function(e){
				//Verificar la existencia del presupuesto
				if ($('#txtSucursalID_rep_presupuestos_gastos_inventarios_fisicos').val() != '' && $('#txtDepartamentoID_rep_presupuestos_gastos_inventarios_fisicos').val() != '' &&
					$('#txtAnio_rep_presupuestos_gastos_inventarios_fisicos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del presupuesto que coincide con los id´s 
					editar_departamentos_presupuestos_gastos_inventarios_fisicos();
				}
			});


			//Comprobar la existencia del presupuesto en la BD cuando pierda el enfoque la caja de texto
			$('#txtSucursal_rep_presupuestos_gastos_inventarios_fisicos').focusout(function(e){
				//Verificar la existencia del presupuesto
				if ($('#txtSucursalID_rep_presupuestos_gastos_inventarios_fisicos').val() != '' && $('#txtDepartamentoID_rep_presupuestos_gastos_inventarios_fisicos').val() != '' &&
					$('#txtAnio_rep_presupuestos_gastos_inventarios_fisicos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del presupuesto que coincide con los id´s 
					editar_departamentos_presupuestos_gastos_inventarios_fisicos();
				}
			});

			//Comprobar la existencia del presupuesto en la BD cuando pierda el enfoque la caja de texto
			$('#txtDepartamento_rep_presupuestos_gastos_inventarios_fisicos').focusout(function(e){
				//Verificar la existencia del presupuesto
				if ($('#txtSucursalID_rep_presupuestos_gastos_inventarios_fisicos').val() != '' &&  $('#txtDepartamentoID_rep_presupuestos_gastos_inventarios_fisicos').val() != '' &&
					$('#txtAnio_rep_presupuestos_gastos_inventarios_fisicos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del presupuesto que coincide con los id´s 
					editar_departamentos_presupuestos_gastos_inventarios_fisicos();
				}
			});
			//Autocomplete para recuperar los datos de una sucursal
	        $('#txtSucursal_rep_presupuestos_gastos_inventarios_fisicos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSucursalID_rep_presupuestos_gastos_inventarios_fisicos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "administracion/sucursales/autocomplete",
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
	             $('#txtSucursalID_rep_presupuestos_gastos_inventarios_fisicos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la sucursal cuando pierda el enfoque la caja de texto
	        $('#txtSucursal_rep_presupuestos_gastos_inventarios_fisicos').focusout(function(e){
	            //Si no existe id de la sucursal
	            if($('#txtSucursalID_rep_presupuestos_gastos_inventarios_fisicos').val() == '' ||
	               $('#txtSucursal_rep_presupuestos_gastos_inventarios_fisicos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSucursalID_rep_presupuestos_gastos_inventarios_fisicos').val('');
	               $('#txtSucursal_rep_presupuestos_gastos_inventarios_fisicos').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un departamento
	        $('#txtDepartamento_rep_presupuestos_gastos_inventarios_fisicos').autocomplete({
	            source: function( request, response ) {	            	
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtDepartamentoID_rep_presupuestos_gastos_inventarios_fisicos').val('');
	      
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/departamentos/autocomplete",
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
	             $('#txtDepartamentoID_rep_presupuestos_gastos_inventarios_fisicos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id del departamento cuando pierda el enfoque la caja de texto
	        $('#txtDepartamento_rep_presupuestos_gastos_inventarios_fisicos').focusout(function(e){
	        	//Si no existe id del departamento
	            if($('#txtDepartamentoID_rep_presupuestos_gastos_inventarios_fisicos').val() == '' ||
	               $('#txtDepartamento_rep_presupuestos_gastos_inventarios_fisicos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtDepartamentoID_rep_presupuestos_gastos_inventarios_fisicos').val('');
	               $('#txtDepartamento_rep_presupuestos_gastos_inventarios_fisicos').val('');
	            }
	            
	        });

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_presupuestos_gastos_inventarios_fisicos();
			

		});
	</script>
	