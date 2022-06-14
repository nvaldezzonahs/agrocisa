<div id="RepExistenciaRefaccionesContent">  
	<!--Diseño del formulario-->
	<form id="frmRepExistenciaRefacciones" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepExistenciaRefacciones" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimirrep_existencia_refacciones"
								onclick="validar_rep_existencia_refacciones();" 
								title="Imprimir reporte en PDF" 
								tabindex="1">
							<span class="glyphicon glyphicon-print"></span>
						</button>  
					</div>
				</div>
			</div>
		</div><!--Cierre de barra de herramientas-->
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<form id="frmExistenciaRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmExistenciaRefacciones"  onsubmit="return(false)" 
					  autocomplete="off">	  	
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicial_rep_existencia_refacciones">Fecha inicial</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_existencia_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaInicial_rep_existencia_refacciones"
				                    		name= "strFechaInicial_rep_existencia_refacciones" 
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
								<label for="txtFechaFinal_rep_existencia_refacciones">Fecha final</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_existencia_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaFinal_rep_existencia_refacciones"
				                    		name= "strFechaFinal_rep_existencia_refacciones" 
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
								<label for="cmbSucursalIDrep_existencia_refacciones">Sucursal</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" 
										id="cmbSucursalIDrep_existencia_refacciones"
								        name="intSucursalIDrep_existencia_refacciones" 
								        tabindex="1">
	             				</select>
							</div>
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
						<input id="txtMarcaID_rep_existencia_refacciones" 
							   name="intMarcaID_rep_existencia_refacciones" 
							   type="hidden" 
							   value="" />	
						<label for="txtMarcaCodigo_rep_existencia_refacciones">Marca</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input  class="form-control" 
								id="txtMarcaDescripcion_rep_existencia_refacciones" 
								name="strMarcaDescripcion_rep_existencia_refacciones" 
								type="text" 
								placeholder="Ingrese marca" />
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
						<input id="txtLineaID_rep_existencia_refacciones" 
							   name="intLineaID_rep_existencia_refacciones" 
							   type="hidden" 
							   value="" />	
						<label for="txtLineaDescripcion_rep_existencia_refacciones">Línea</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input  class="form-control" 
								id="txtLineaDescripcion_rep_existencia_refacciones" 
								name="strLineaDescripcion_rep_existencia_refacciones" 
								type="text" 
								placeholder="Ingrese línea" />
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
						<input id="txtRefaccionID_rep_existencia_refacciones" 
							   name="intRefaccionID_rep_existencia_refacciones" 
							   type="hidden" 
							   value="" />	
						<label for="txtRefaccionDescripcion_rep_existencia_refacciones">Refacción</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input  class="form-control" 
								id="txtRefaccionDescripcion_rep_existencia_refacciones" 
								name="strRefaccionDescripcion_rep_existencia_refacciones" 
								type="text" 
								placeholder="Ingrese refacción" />
					</div>
				</div>
			</form>
		</div>
	</form>
</div><!--#RepExistenciaRefaccionesContent -->

<!-- /.Plantilla para cargar las sucursales-->  
<script id="sucursales_rep_existencia_refacciones" type="text/template">
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
	var dteFechaInicialExistenciaRefacciones = "";
	var dteFechaFinalExistenciaRefacciones = "";
	var intSucursalExistenciaRefacciones = "";
	var intMarcaIDExistenciaRefacciones = "";
	var intLineaIDExistenciaRefacciones = "";
	var intRefaccionIDExistenciaRefacciones = "";
	
	//Regresar sucursales activas para cargarlas en el combobox
	function cargar_sucursales_rep_existencia_refacciones()
	{
		//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
		$.post('administracion/sucursales/get_combo_box', {},
			function(data)
			{
				$('#cmbSucursalIDrep_existencia_refacciones').empty();
				var temp = Mustache.render($('#sucursales_rep_existencia_refacciones').html(), data);
				var todas = '<option value="0">TODAS</option>';
				res = todas.concat(temp);
				$('#cmbSucursalIDrep_existencia_refacciones').html(res);
			},
			'json');
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_rep_existencia_refacciones()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_rep_existencia_refacciones();
		//Validación del formulario de campos obligatorios
		$('#frmRepExistenciaRefacciones')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strFechaInicial_rep_existencia_refacciones: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha inicial'}
										}
									},
									strFechaFinal_rep_existencia_refacciones: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha final'}
										}
									}
								}
			}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
	            var $form_rep_existencia_refacciones = $(e.target),
									                   validator = data.bv,
									                   $tabPane  = data.element.parents('.tab-pane'),
									                   tabId     = $tabPane.attr('id');
	            if (tabId) 
	            {
	            	var $icon_rep_existencia_refacciones = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
	                //Agregar una clase personalizada a la pestaña que contiene el campo
	                if (data.status == validator.STATUS_INVALID) {
	                    $icon_rep_existencia_refacciones.removeClass('fa-check').addClass('fa-times');
	                } else if (data.status == validator.STATUS_VALID) {
	                    var isValidTab = validator.isValidContainer($tabPane);
	                    $icon_rep_existencia_refacciones.removeClass('fa-check fa-times')
	                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
	                }
	            }
	        });
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_rep_existencia_refacciones = $('#frmRepExistenciaRefacciones').data('bootstrapValidator');
		bootstrapValidator_rep_existencia_refacciones.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_rep_existencia_refacciones.isValid())
		{
			//Hacer un llamado a la función para generar el reporte
			reporte_rep_existencia_refacciones();
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_rep_existencia_refacciones()
	{
		try
		{
			$('#frmRepExistenciaRefacciones').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para crear el reporte en PDF de movimientos de un insumo
	function reporte_rep_existencia_refacciones(){
		//Asignar valores para la búsqueda de registros	
		dteFechaInicialExistenciaRefacciones =  $.formatFechaMysql($('#txtFechaInicial_rep_existencia_refacciones').val());
		dteFechaFinalExistenciaRefacciones =  $.formatFechaMysql($('#txtFechaFinal_rep_existencia_refacciones').val());
		intSucursalExistenciaRefacciones = $('#cmbSucursalIDrep_existencia_refacciones').val();
		intMarcaIDExistenciaRefacciones =  $('#txtMarcaID_rep_existencia_refacciones').val();
		intLineaIDExistenciaRefacciones =  $('#txtLineaID_rep_existencia_refacciones').val();
		intRefaccionIDExistenciaRefacciones =  $('#txtRefaccionID_rep_existencia_refacciones').val();

		//Si no existe fecha inicial
		if(dteFechaInicialExistenciaRefacciones == '')
		{
			dteFechaInicialExistenciaRefacciones = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalExistenciaRefacciones == '')
		{
			dteFechaFinalExistenciaRefacciones =  '0000-00-00';
		}
		
		//Si no existe id de la marca
		if(intMarcaIDExistenciaRefacciones == '')
		{
			intMarcaIDExistenciaRefacciones = 0;
		}

		//Si no existe id de la línea
		if(intLineaIDExistenciaRefacciones == '')
		{
			intLineaIDExistenciaRefacciones = 0;
		}

		//Si no existe id de la refacción
		if(intRefaccionIDExistenciaRefacciones == '')
		{
			intRefaccionIDExistenciaRefacciones = 0;
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("refacciones/rep_existencia/get_reporte/"+
					dteFechaInicialExistenciaRefacciones+"/"+
					dteFechaFinalExistenciaRefacciones+"/"+
					intSucursalExistenciaRefacciones+"/"+
					intMarcaIDExistenciaRefacciones+"/"+
					intLineaIDExistenciaRefacciones+"/"+
					intRefaccionIDExistenciaRefacciones);

	}

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicial_rep_existencia_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaFinal_rep_existencia_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

		//Autocomplete para recuperar los datos de una marca 
        $('#txtMarcaDescripcion_rep_existencia_refacciones').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtMarcaID_rep_existencia_refacciones').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "refacciones/refacciones_marcas/autocomplete",
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
           	 $('#txtMarcaID_rep_existencia_refacciones').val(ui.item.data);
           	 $('#txtMarcaDescripcion_rep_existencia_refacciones').val(ui.item.descripcion);

           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

        //Autocomplete para recuperar los datos de una línea 
        $('#txtLineaDescripcion_rep_existencia_refacciones').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtLineaID_rep_existencia_refacciones').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "refacciones/refacciones_lineas/autocomplete",
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
           	 $('#txtLineaID_rep_existencia_refacciones').val(ui.item.data);
           	 $('#txtLineaDescripcion_rep_existencia_refacciones').val(ui.item.descripcion);

           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

        //Autocomplete para recuperar los datos de una refacción 
        $('#txtRefaccionDescripcion_rep_existencia_refacciones').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtRefaccionID_rep_existencia_refacciones').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "refacciones/refacciones/autocomplete",
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
           	 $('#txtRefaccionID_rep_existencia_refacciones').val(ui.item.data);
           	 $('#txtRefaccionDescripcion_rep_existencia_refacciones').val(ui.item.descripcion);

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
  		cargar_sucursales_rep_existencia_refacciones();

	});

</script>	