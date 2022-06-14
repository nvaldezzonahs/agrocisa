<div id="RepRepExistenciaControlVehiculosContent">  
	<!--Diseño del formulario-->
	<form id="frmRepRepExistenciaControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepRepExistenciaControlVehiculos" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_rep_existencia_control_vehiculos"
								onclick="validar_rep_existencia_control_vehiculos('PDF');" 
								title="Imprimir reporte en PDF" 
								tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  
								id="btnDescargarXLS_rep_existencia_control_vehiculos"
								onclick="validar_rep_existencia_control_vehiculos('XLS');" 
								title="Descargar reporte en XLS" tabindex="1" disabled>
							<span class="fa fa-file-excel-o"></span>
						</button>  
					</div>
				</div>
			</div>
		</div><!--Cierre de barra de herramientas-->
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<form id="frmRepExistenciaControlVehiculos" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmRepExistenciaControlVehiculos"  onsubmit="return(false)" 
					  autocomplete="off">	  	
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicial_rep_existencia_control_vehiculos">Fecha inicial</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_existencia_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaInicial_rep_existencia_control_vehiculos"
				                    		name= "strFechaInicial_rep_existencia_control_vehiculos" 
				                    		type="text" 
				                    		value="" 
				                    		tabindex="1" 
				                    		placeholder="Ingrese fecha" 
				                    		maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>	
						</div>
					</div>
					<!--Fecha final-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaFinal_rep_existencia_control_vehiculos">Fecha final</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_existencia_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaFinal_rep_existencia_control_vehiculos"
				                    		name= "strFechaFinal_rep_existencia_control_vehiculos" 
				                    		type="text" 
				                    		value="" 
				                    		tabindex="1" 
				                    		placeholder="Ingrese fecha" 
				                    		maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>	
						</div>
					</div>
					<!--Combobox que contiene las Sucursales activas-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbSucursalIDrep_existencia_control_vehiculos">Sucursal</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" 
										id="cmbSucursalIDrep_existencia_control_vehiculos"
								        name="intSucursalIDrep_existencia_control_vehiculos" 
								        tabindex="1">
	             				</select>
							</div>
						</div>
					</div>
				</div>	
				<br>
				<div class="row">
					<div class="col-md-12">
						<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
						<input id="txtRefaccionID_rep_existencia_control_vehiculos" 
							   name="intRefaccionID_rep_existencia_control_vehiculos" 
							   type="hidden" 
							   value="" />	
						<label for="txtRefaccionDescripcion_rep_existencia_control_vehiculos">Refacción</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input  class="form-control" 
								id="txtRefaccionDescripcion_rep_existencia_control_vehiculos" 
								name="strRefaccionDescripcion_rep_existencia_control_vehiculos" 
								type="text" 
								placeholder="Ingrese refacción" />
					</div>
				</div>
			</form>
		</div>
	</form>
</div><!--#RepRepExistenciaControlVehiculosContent -->

<!-- /.Plantilla para cargar las sucursales-->  
<script id="sucursales_rep_existencia_control_vehiculos" type="text/template">
	{{#sucursales}}
	<option value="{{value}}">{{nombre}}</option>
	{{/sucursales}} 
</script>
<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*******************************************************************************************************************/
	//Variable que se utilizan para la búsqueda de registros
	var dteFechaInicialRepExistenciaControlVehiculos = "";
	var dteFechaFinalRepExistenciaControlVehiculos = "";
	var intSucursalRepExistenciaControlVehiculos = "";
	var intRefaccionIDRepExistenciaControlVehiculos = "";
	
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_existencia_control_vehiculos()
	{
		console.log( $('#txtAcciones_rep_existencia_control_vehiculos').val() );
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('control_vehiculos/rep_existencia/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_existencia_control_vehiculos').val()
		},
		function(data){

			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepExistenciaControlVehiculos = data.row;
				//Separar la cadena 
				var arrPermisosRepExistenciaControlVehiculos = strPermisosRepExistenciaControlVehiculos.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepExistenciaControlVehiculos.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepExistenciaControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_existencia_control_vehiculos').removeAttr('disabled');
					}
					else if(arrPermisosRepExistenciaControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_existencia_control_vehiculos').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}


	//Regresar sucursales activas para cargarlas en el combobox
	function cargar_sucursales_rep_existencia_control_vehiculos()
	{
		//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
		$.post('administracion/sucursales/get_combo_box', {},
			function(data)
			{
				$('#cmbSucursalIDrep_existencia_control_vehiculos').empty();
				var temp = Mustache.render($('#sucursales_rep_existencia_control_vehiculos').html(), data);
				var todas = '<option value="0">TODAS</option>';
				res = todas.concat(temp);
				$('#cmbSucursalIDrep_existencia_control_vehiculos').html(res);
			},
			'json');
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_rep_existencia_control_vehiculos($strTipoReporte)
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_rep_existencia_control_vehiculos();
		//Validación del formulario de campos obligatorios
		$('#frmRepRepExistenciaControlVehiculos')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strFechaInicial_rep_existencia_control_vehiculos: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha inicial'}
										}
									},
									strFechaFinal_rep_existencia_control_vehiculos: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha final'}
										}
									}
								}
			}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
	            var $form_rep_existencia_control_vehiculos = $(e.target),
									                   validator = data.bv,
									                   $tabPane  = data.element.parents('.tab-pane'),
									                   tabId     = $tabPane.attr('id');
	            if (tabId) 
	            {
	            	var $icon_rep_existencia_control_vehiculos = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
	                //Agregar una clase personalizada a la pestaña que contiene el campo
	                if (data.status == validator.STATUS_INVALID) {
	                    $icon_rep_existencia_control_vehiculos.removeClass('fa-check').addClass('fa-times');
	                } else if (data.status == validator.STATUS_VALID) {
	                    var isValidTab = validator.isValidContainer($tabPane);
	                    $icon_rep_existencia_control_vehiculos.removeClass('fa-check fa-times')
	                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
	                }
	            }
	        });
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_rep_existencia_control_vehiculos = $('#frmRepRepExistenciaControlVehiculos').data('bootstrapValidator');
		bootstrapValidator_rep_existencia_control_vehiculos.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_rep_existencia_control_vehiculos.isValid())
		{
			//Hacer un llamado a la función para generar el reporte
			if($strTipoReporte == 'PDF'){
				reporte_rep_existencia_control_vehiculos();
			}
			else{
				reporte_xls_rep_existencia_control_vehiculos();
			}			
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_rep_existencia_control_vehiculos()
	{
		try
		{
			$('#frmRepRepExistenciaControlVehiculos').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para crear el reporte en PDF de Movimientos
	function reporte_rep_existencia_control_vehiculos(){

		console.log($('#txtFechaInicial_rep_existencia_control_vehiculos').val());

		//Asignar valores para la búsqueda de registros	
		dteFechaInicialRepExistenciaControlVehiculos =  $.formatFechaMysql($('#txtFechaInicial_rep_existencia_control_vehiculos').val());
		dteFechaFinalRepExistenciaControlVehiculos =  $.formatFechaMysql($('#txtFechaFinal_rep_existencia_control_vehiculos').val());
		intSucursalRepExistenciaControlVehiculos = $('#cmbSucursalIDrep_existencia_control_vehiculos').val();
		intRefaccionIDRepExistenciaControlVehiculos =  $('#txtRefaccionID_rep_existencia_control_vehiculos').val();

		//Si no existe fecha inicial
		if(dteFechaInicialRepExistenciaControlVehiculos == '')
		{
			dteFechaInicialRepExistenciaControlVehiculos = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalRepExistenciaControlVehiculos == '')
		{
			dteFechaFinalRepExistenciaControlVehiculos =  '0000-00-00';
		}

		//Si no existe id de la refacción
		if(intRefaccionIDRepExistenciaControlVehiculos == '')
		{
			intRefaccionIDRepExistenciaControlVehiculos = 0;
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("control_vehiculos/rep_existencia/get_reporte/"+
					dteFechaInicialRepExistenciaControlVehiculos+"/"+
					dteFechaFinalRepExistenciaControlVehiculos+"/"+
					intSucursalRepExistenciaControlVehiculos+"/"+
					intRefaccionIDRepExistenciaControlVehiculos);
	}

	//Función para crear el reporte en XLS de Movimientos
	function reporte_xls_rep_existencia_control_vehiculos(){
		//Asignar valores para la búsqueda de registros	
		dteFechaInicialRepExistenciaControlVehiculos =  $.formatFechaMysql($('#txtFechaInicial_rep_existencia_control_vehiculos').val());
		dteFechaFinalRepExistenciaControlVehiculos =  $.formatFechaMysql($('#txtFechaFinal_rep_existencia_control_vehiculos').val());
		intSucursalRepExistenciaControlVehiculos = $('#cmbSucursalIDrep_existencia_control_vehiculos').val();
		intRefaccionIDRepExistenciaControlVehiculos =  $('#txtRefaccionID_rep_existencia_control_vehiculos').val();

		//Si no existe fecha inicial
		if(dteFechaInicialRepExistenciaControlVehiculos == '')
		{
			dteFechaInicialRepExistenciaControlVehiculos = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalRepExistenciaControlVehiculos == '')
		{
			dteFechaFinalRepExistenciaControlVehiculos =  '0000-00-00';
		}

		//Si no existe id de la refacción
		if(intRefaccionIDRepExistenciaControlVehiculos == '')
		{
			intRefaccionIDRepExistenciaControlVehiculos = 0;
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("control_vehiculos/rep_existencia/get_xls/"+
					dteFechaInicialRepExistenciaControlVehiculos+"/"+
					dteFechaFinalRepExistenciaControlVehiculos+"/"+
					intSucursalRepExistenciaControlVehiculos+"/"+
					intRefaccionIDRepExistenciaControlVehiculos);
	}

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicial_rep_existencia_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaFinal_rep_existencia_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});

        //Autocomplete para recuperar los datos de una refacción interna
        $('#txtRefaccionDescripcion_rep_existencia_control_vehiculos').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtRefaccionID_rep_existencia_control_vehiculos').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "control_vehiculos/refacciones_internas/autocomplete",
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
           	 $('#txtRefaccionID_rep_existencia_control_vehiculos').val(ui.item.data);
           	 $('#txtRefaccionDescripcion_rep_existencia_control_vehiculos').val(ui.item.descripcion);

           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

        //Hacer un llamado a la función para cargar sucursales en el combobox del modal
  		cargar_sucursales_rep_existencia_control_vehiculos();
  		//Cargar permisos de acceso para la vista
  		permisos_rep_existencia_control_vehiculos();

	});

</script>	