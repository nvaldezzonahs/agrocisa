<div id="RepOrdenesProcesoControlVehiculosContent">  
	<!--Diseño del formulario-->
	<form id="frmRepOrdenesProcesoControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepOrdenesProcesoControlVehiculos" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_rep_ordenes_proceso_control_vehiculos"
								onclick="validar_rep_ordenes_proceso_control_vehiculos();" 
								title="Imprimir reporte en PDF" 
								tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  
								id="btnDescargarXLS_rep_ordenes_proceso_control_vehiculos"
								onclick="descargar_xls_rep_ordenes_proceso_control_vehiculos();" 
								title="Descargar reporte en XLS" tabindex="1" disabled>
							<span class="fa fa-file-excel-o"></span>
						</button>  
					</div>
				</div>
			</div>
		</div><!--Cierre de barra de herramientas-->
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<form id="frmOrdenesProcesoControlVehiculos" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmOrdenesProcesoControlVehiculos"  onsubmit="return(false)" 
					  autocomplete="off">	  	
				<div class="row">
					<!--Fecha corte-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaCorte_rep_ordenes_proceso_control_vehiculos">Fecha corte</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaCorte_rep_ordenes_proceso_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaCorte_rep_ordenes_proceso_control_vehiculos"
				                    		name= "strFechaCorte_rep_ordenes_proceso_control_vehiculos" 
				                    		type="text" 
				                    		value="" 
				                    		tabindex="1" 
				                    		placeholder="Ingrese fecha de corte" 
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
						
					</div>
					<!--Combobox que contiene las Sucursales activas-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbSucursalID_rep_existencia_control_vehiculos">Sucursal</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" 
										id="cmbSucursalID_rep_existencia_control_vehiculos"
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
						<!-- Caja de texto oculta que se utiliza para recuperar el id del vehículo seleccionado-->
						<input id="txtVehiculoID_rep_ordenes_proceso_control_vehiculos" 
							   name="intVehiculoID_rep_ordenes_proceso_control_vehiculos" 
							   type="hidden" 
							   value="" />	
						<label for="txtVehiculoDescripcion_rep_ordenes_proceso_control_vehiculos">Vehículo</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input  class="form-control" 
								id="txtVehiculoDescripcion_rep_ordenes_proceso_control_vehiculos" 
								name="strVehiculoDescripcion_rep_ordenes_proceso_control_vehiculos" 
								type="text" 
								placeholder="Ingrese vehículo" />
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<!-- Caja de texto oculta que se utiliza para recuperar el id del mecánico seleccionado-->
						<input id="txtMecanicoID_rep_ordenes_proceso_control_vehiculos" 
							   name="intMecanicoID_rep_ordenes_proceso_control_vehiculos" 
							   type="hidden" 
							   value="" />	
						<label for="txtMecanicoDescripcion_rep_ordenes_proceso_control_vehiculos">Mecánico</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input  class="form-control" 
								id="txtMecanicoDescripcion_rep_ordenes_proceso_control_vehiculos" 
								name="strMecanicoDescripcion_rep_ordenes_proceso_control_vehiculos" 
								type="text" 
								placeholder="Ingrese mecánico" />
					</div>
				</div>
			</form>
		</div>
	</form>
</div><!--#RepOrdenesProcesoControlVehiculosContent -->

<!-- /.Plantilla para cargar las sucursales-->  
<script id="sucursales_rep_ordenes_proceso_control_vehiculos" type="text/template">
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
	var dteFechaCorteRepOrdenesProcesoControlVehiculos = "";
	var intSucursalRepOrdenesProcesoControlVehiculos = "";
	var intVehiculoIDRepOrdenesProcesoControlVehiculos = "";
	var intMecanicoIDRepOrdenesProcesoControlVehiculos = "";
	
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_ordenes_proceso_control_vehiculos()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('control_vehiculos/rep_ordenes_en_proceso/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_ordenes_en_proceso_control_vehiculos').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepOrdenesProcesoControlVehiculos = data.row;
				//Separar la cadena 
				var arrPermisosRepOrdenesProcesoControlVehiculos = strPermisosRepOrdenesProcesoControlVehiculos.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepOrdenesProcesoControlVehiculos.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepOrdenesProcesoControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_ordenes_proceso_control_vehiculos').removeAttr('disabled');
					}
					else if(arrPermisosRepOrdenesProcesoControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_ordenes_proceso_control_vehiculos').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}		

	//Regresar sucursales activas para cargarlas en el combobox
	function cargar_sucursales_rep_ordenes_proceso_control_vehiculos()
	{
		//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
		$.post('administracion/sucursales/get_combo_box', {},
			function(data)
			{
				$('#cmbSucursalID_rep_existencia_control_vehiculos').empty();
				var temp = Mustache.render($('#sucursales_rep_ordenes_proceso_control_vehiculos').html(), data);
				var todas = '<option value="0">TODAS</option>';
				res = todas.concat(temp);
				$('#cmbSucursalID_rep_existencia_control_vehiculos').html(res);
			},
			'json');
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_rep_ordenes_proceso_control_vehiculos()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_rep_ordenes_proceso_control_vehiculos();
		//Validación del formulario de campos obligatorios
		$('#frmRepOrdenesProcesoControlVehiculos')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strFechaCorte_rep_ordenes_proceso_control_vehiculos: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha de corte'}
										}
									}
								}
			}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
	            var $form_rep_ordenes_proceso_control_vehiculos = $(e.target),
									                   validator = data.bv,
									                   $tabPane  = data.element.parents('.tab-pane'),
									                   tabId     = $tabPane.attr('id');
	            if (tabId) 
	            {
	            	var $icon_rep_ordenes_proceso_control_vehiculos = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
	                //Agregar una clase personalizada a la pestaña que contiene el campo
	                if (data.status == validator.STATUS_INVALID) {
	                    $icon_rep_ordenes_proceso_control_vehiculos.removeClass('fa-check').addClass('fa-times');
	                } else if (data.status == validator.STATUS_VALID) {
	                    var isValidTab = validator.isValidContainer($tabPane);
	                    $icon_rep_ordenes_proceso_control_vehiculos.removeClass('fa-check fa-times')
	                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
	                }
	            }
	        });
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_rep_ordenes_proceso_control_vehiculos = $('#frmRepOrdenesProcesoControlVehiculos').data('bootstrapValidator');
		bootstrapValidator_rep_ordenes_proceso_control_vehiculos.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_rep_ordenes_proceso_control_vehiculos.isValid())
		{
			//Hacer un llamado a la función para generar el reporte
			reporte_rep_ordenes_proceso_control_vehiculos();
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_rep_ordenes_proceso_control_vehiculos()
	{
		try
		{
			$('#frmRepOrdenesProcesoControlVehiculos').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para crear el reporte en PDF de movimientos de un insumo
	function reporte_rep_ordenes_proceso_control_vehiculos(){
		//Asignar valores para la búsqueda de registros	
		dteFechaCorteRepOrdenesProcesoControlVehiculos =  $.formatFechaMysql($('#txtFechaCorte_rep_ordenes_proceso_control_vehiculos').val());
		intSucursalRepOrdenesProcesoControlVehiculos = $('#cmbSucursalID_rep_existencia_control_vehiculos').val();
		intVehiculoIDRepOrdenesProcesoControlVehiculos =  $('#txtVehiculoID_rep_ordenes_proceso_control_vehiculos').val();
		intMecanicoIDRepOrdenesProcesoControlVehiculos =  $('#txtMecanicoID_rep_ordenes_proceso_control_vehiculos').val();

		//Si no existe fecha de corte
		if(dteFechaCorteRepOrdenesProcesoControlVehiculos == '')
		{
			dteFechaCorteRepOrdenesProcesoControlVehiculos = '0000-00-00';
		}

		//Si no existe id de la sucursal
		if(intSucursalRepOrdenesProcesoControlVehiculos == '')
		{
			intSucursalRepOrdenesProcesoControlVehiculos = 0;
		}

		//Si no existe id del vehículo
		if(intVehiculoIDRepOrdenesProcesoControlVehiculos == '')
		{
			intVehiculoIDRepOrdenesProcesoControlVehiculos = 0;
		}

		//Si no existe id del mecánico
		if(intMecanicoIDRepOrdenesProcesoControlVehiculos == '')
		{
			intMecanicoIDRepOrdenesProcesoControlVehiculos = 0;
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("control_vehiculos/rep_ordenes_en_proceso/get_reporte/"+
					dteFechaCorteRepOrdenesProcesoControlVehiculos+"/"+
					intSucursalRepOrdenesProcesoControlVehiculos+"/"+
					intVehiculoIDRepOrdenesProcesoControlVehiculos+"/"+
					intMecanicoIDRepOrdenesProcesoControlVehiculos);

	}

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaCorte_rep_ordenes_proceso_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});

        //Autocomplete para recuperar los datos de un vehículo
        $('#txtVehiculoDescripcion_rep_ordenes_proceso_control_vehiculos').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtVehiculoID_rep_ordenes_proceso_control_vehiculos').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "control_vehiculos/vehiculos/autocomplete",
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
           	 $('#txtVehiculoID_rep_ordenes_proceso_control_vehiculos').val(ui.item.data);
           	 $('#txtVehiculoDescripcion_rep_ordenes_proceso_control_vehiculos').val(ui.item.descripcion);

           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

        //Verificar que exista id del vehículo cuando pierda el enfoque la caja de texto
        $('#txtVehiculoDescripcion_rep_ordenes_proceso_control_vehiculos').focusout(function(e){
            //Si no existe id del vehículo
            if($('#txtVehiculoID_rep_ordenes_proceso_control_vehiculos').val() == '' ||
               $('#txtVehiculoDescripcion_rep_ordenes_proceso_control_vehiculos').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtVehiculoID_rep_ordenes_proceso_control_vehiculos').val('');
               $('#txtVehiculoDescripcion_rep_ordenes_proceso_control_vehiculos').val('');
            }

        });

        //Autocomplete para recuperar los datos de un mecánico
        $('#txtMecanicoDescripcion_rep_ordenes_proceso_control_vehiculos').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtMecanicoID_rep_ordenes_proceso_control_vehiculos').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "control_vehiculos/mecanicos/autocomplete",
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
           	 $('#txtMecanicoID_rep_ordenes_proceso_control_vehiculos').val(ui.item.data);
           	 $('#txtMecanicoDescripcion_rep_ordenes_proceso_control_vehiculos').val(ui.item.descripcion);

           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

        //Verificar que exista id del mecánico cuando pierda el enfoque la caja de texto
        $('#txtMecanicoDescripcion_rep_ordenes_proceso_control_vehiculos').focusout(function(e){
            //Si no existe id del vehículo
            if($('#txtMecanicoID_rep_ordenes_proceso_control_vehiculos').val() == '' ||
               $('#txtMecanicoDescripcion_rep_ordenes_proceso_control_vehiculos').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtMecanicoID_rep_ordenes_proceso_control_vehiculos').val('');
               $('#txtMecanicoDescripcion_rep_ordenes_proceso_control_vehiculos').val('');
            }

        });

        //Hacer un llamado a la función para cargar sucursales en el combobox del modal
  		cargar_sucursales_rep_ordenes_proceso_control_vehiculos();
  		//Hacer un llamado a la función para obtener los permisos de acceso
  		permisos_rep_ordenes_proceso_control_vehiculos();

	});

</script>	