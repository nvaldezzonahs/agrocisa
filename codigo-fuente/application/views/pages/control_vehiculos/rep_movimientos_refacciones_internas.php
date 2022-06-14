<div id="RepMovimientosRefaccionesInternasControlVehiculosContent">  
	<!--Diseño del formulario-->
	<form id="frmRepMovimientosRefaccionesInternasControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepMovimientosRefaccionesInternasControlVehiculos" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_rep_movimientos_refacciones_internas_control_vehiculos"
								onclick="validar_rep_movimientos_refacciones_internas_control_vehiculos('PDF');" 
								title="Imprimir reporte general en PDF" 
								tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_rep_movimientos_refacciones_internas_control_vehiculos"
								onclick="validar_rep_movimientos_refacciones_internas_control_vehiculos('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
							<label for="txtFechaInicial_rep_movimientos_refacciones_internas_control_vehiculos">Fecha inicial</label>
						</div>
						<div id="divFechaMsjValidacion" class="col-md-12">
							<div class='input-group date' id='dteFechaInicial_rep_movimientos_refacciones_internas_control_vehiculos'>
			                    <input class="form-control" 
			                    		id="txtFechaInicial_rep_movimientos_refacciones_internas_control_vehiculos"
			                    		name= "strFechaInicial_rep_movimientos_refacciones_internas_control_vehiculos" 
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
				<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaFinal_rep_movimientos_refacciones_internas_control_vehiculos">Fecha final</label>
						</div>
						<div id="divFechaMsjValidacion" class="col-md-12">
							<div class='input-group date' id='dteFechaFinal_rep_movimientos_refacciones_internas_control_vehiculos'>
			                    <input class="form-control" 
			                    		id="txtFechaFinal_rep_movimientos_refacciones_internas_control_vehiculos"
			                    		name= "strFechaFinal_rep_movimientos_refacciones_internas_control_vehiculos" 
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
			</div>
			<div class="row">
		        <!--Autocomplete que contiene las refacciones activas-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id de la refacción seleccionada-->
							<input id="txtRefaccionID_rep_movimientos_refacciones_internas_control_vehiculos" 
								   name="intRefaccionID_rep_movimientos_refacciones_internas_control_vehiculos" 
								   type="hidden" 
								   value="" />	
							<label for="txtRefaccion_rep_movimientos_refacciones_internas_control_vehiculos">Refacción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
								id="txtRefaccion_rep_movimientos_refacciones_internas_control_vehiculos" 
								name="strRefaccion_rep_movimientos_refacciones_internas_control_vehiculos" 
								type="text" 
								placeholder="Ingrese refacción" maxlength="250"/>
						</div>
					</div>
				</div>
		    </div>
		    <div class="row">
		    	<!--Lista de sucursales activas a las que tiene acceso el usuario-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label>Sucursales:</label>
						</div>
						<div class="col-md-12" id="chkSucursales_rep_movimientos_refacciones_internas_control_vehiculos"></div>
					</div>	
				</div>		
			</div>	
		</div><!--Cierre del contenedor del formulario-->
	</form><!--Cierre del formulario-->
</div><!--#RepMovimientosRefaccionesInternasControlVehiculosContent -->


<!-- /.Plantilla para cargar las sucursales-->  
<script id="sucursales_rep_movimientos_refacciones_internas_control_vehiculos" type="text/template">
	{{#sucursales}}
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="chkSucursal{{value}}_rep_movimientos_refacciones_internas_control_vehiculos" 
	  		 name="chkSucursales_rep_movimientos_refacciones_internas_control_vehiculos[]" value="{{value}}" checked>
	  <label class="form-check-label" for="{{value}}">{{nombre}}</label>
	</div>
	{{/sucursales}} 
</script>

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*******************************************************************************************************************/
	//Variable que se utilizan para la búsqueda de registros
	var dteFechaInicialRepMovimientosRefaccionesInternasControlVehiculos = "";
	var dteFechaFinalRepMovimientosRefaccionesInternasControlVehiculos = "";
	var intRefaccionIDRepMovimientosRefaccionesInternasControlVehiculos = "";

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_movimientos_refacciones_internas_control_vehiculos()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('control_vehiculos/rep_movimientos_refacciones_internas/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_movimientos_refacciones_internas_control_vehiculos').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepMovimientosRefaccionesInternasControlVehiculos = data.row;
				//Separar la cadena 
				var arrPermisosRepMovimientosRefaccionesInternasControlVehiculos = strPermisosRepMovimientosRefaccionesInternasControlVehiculos.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepMovimientosRefaccionesInternasControlVehiculos.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepMovimientosRefaccionesInternasControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_movimientos_refacciones_internas_control_vehiculos').removeAttr('disabled');
					}
					else if(arrPermisosRepMovimientosRefaccionesInternasControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_movimientos_refacciones_internas_control_vehiculos').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}
	

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_rep_movimientos_refacciones_internas_control_vehiculos(strTipo)
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_rep_movimientos_refacciones_internas_control_vehiculos();
		//Validación del formulario de campos obligatorios
		$('#frmRepMovimientosRefaccionesInternasControlVehiculos')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strFechaInicial_rep_movimientos_refacciones_internas_control_vehiculos: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha'}
										}
									},
									strFechaFinal_rep_movimientos_refacciones_internas_control_vehiculos: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha'}
										}
									},
									strRefaccion_rep_movimientos_refacciones_internas_control_vehiculos: {
										validators: {
											callback: {
				                            	callback: function(value, validator, $field) {
				                                    //Verificar que exista id de la refacción
				                                    if($('#txtRefaccionID_rep_movimientos_refacciones_internas_control_vehiculos').val() === '')
				                                    {
			                                      		return {
				                                            valid: false,
				                                            message: 'Escriba una refacción existente'
				                                        };
				                                    }
				                                    return true;
				                                }
				                            }
										}
									}
								}
			});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_rep_movimientos_refacciones_internas_control_vehiculos = $('#frmRepMovimientosRefaccionesInternasControlVehiculos').data('bootstrapValidator');
		bootstrapValidator_rep_movimientos_refacciones_internas_control_vehiculos.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_rep_movimientos_refacciones_internas_control_vehiculos.isValid())
		{
			//Arreglo para obtener sucursales seleccionadas
			var chkSucursalesArray = [];
			chkSucursalesArray = sucursales_seleccionadas_rep_movimientos_refacciones_internas_control_vehiculos();
			//Verificamos que al menos se encuentre una sucursal seleccionada
			if(chkSucursalesArray.length > 0)
			{
				//Array que se utiliza para agregar sucursales
				var arrSucursales = chkSucursalesArray.join('|');

				//Si el tipo de reporte es PDF
				if(strTipo == 'PDF')
				{
					//Hacer un llamado a la función para generar el reporte
					reporte_rep_movimientos_refacciones_internas_control_vehiculos(arrSucursales);
				}
				else
				{
					//Hacer un llamado a la función para generar y descargar el archivo XLS
				 	descargar_xls_rep_movimientos_refacciones_internas_control_vehiculos(arrSucursales);
				}
			}
			else
			{
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog('Es necesario seleccionar al menos una sucursal', {'type': 'error', 'title': 'Error'});
			}
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_rep_movimientos_refacciones_internas_control_vehiculos()
	{
		try
		{
			$('#frmRepMovimientosRefaccionesInternasControlVehiculos').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para crear el reporte en PDF de movimientos de un insumo
	function reporte_rep_movimientos_refacciones_internas_control_vehiculos(arrSucursales)
	{
		//Asignar valores para la búsqueda de registros	
		dteFechaInicialRepMovimientosRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaInicial_rep_movimientos_refacciones_internas_control_vehiculos').val());
		dteFechaFinalRepMovimientosRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaFinal_rep_movimientos_refacciones_internas_control_vehiculos').val());
		intRefaccionIDRepMovimientosRefaccionesInternasControlVehiculos =  $('#txtRefaccionID_rep_movimientos_refacciones_internas_control_vehiculos').val();

		//Si no existe fecha inicial
		if(dteFechaInicialRepMovimientosRefaccionesInternasControlVehiculos == '')
		{
			dteFechaInicialRepMovimientosRefaccionesInternasControlVehiculos = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalRepMovimientosRefaccionesInternasControlVehiculos == '')
		{
			dteFechaFinalRepMovimientosRefaccionesInternasControlVehiculos =  '0000-00-00';
		}
		
		//Si no existe id de la refacción
		if(intRefaccionIDRepMovimientosRefaccionesInternasControlVehiculos == '')
		{
			intRefaccionIDRepMovimientosRefaccionesInternasControlVehiculos = 0;
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("control_vehiculos/rep_movimientos_refacciones_internas/get_reporte/"+
					dteFechaInicialRepMovimientosRefaccionesInternasControlVehiculos+"/"+
					dteFechaFinalRepMovimientosRefaccionesInternasControlVehiculos+"/"+
					intRefaccionIDRepMovimientosRefaccionesInternasControlVehiculos+"/"+
					arrSucursales);

	}

	//Función para descargar el reporte general en XLS
	function descargar_xls_rep_movimientos_refacciones_internas_control_vehiculos(arrSucursales) 
	{
		//Asignar valores para la búsqueda de registros	
		dteFechaInicialRepMovimientosRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaInicial_rep_movimientos_refacciones_internas_control_vehiculos').val());
		dteFechaFinalRepMovimientosRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaFinal_rep_movimientos_refacciones_internas_control_vehiculos').val());
		intRefaccionIDRepMovimientosRefaccionesInternasControlVehiculos =  $('#txtRefaccionID_rep_movimientos_refacciones_internas_control_vehiculos').val();

		//Si no existe fecha inicial
		if(dteFechaInicialRepMovimientosRefaccionesInternasControlVehiculos == '')
		{
			dteFechaInicialRepMovimientosRefaccionesInternasControlVehiculos = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalRepMovimientosRefaccionesInternasControlVehiculos == '')
		{
			dteFechaFinalRepMovimientosRefaccionesInternasControlVehiculos =  '0000-00-00';
		}
		
		//Si no existe id de la refacción
		if(intRefaccionIDRepMovimientosRefaccionesInternasControlVehiculos == '')
		{
			intRefaccionIDRepMovimientosRefaccionesInternasControlVehiculos = 0;
		}

		//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
        window.open("control_vehiculos/rep_movimientos_refacciones_internas/get_xls/"+
					dteFechaInicialRepMovimientosRefaccionesInternasControlVehiculos+"/"+
					dteFechaFinalRepMovimientosRefaccionesInternasControlVehiculos+"/"+
					intRefaccionIDRepMovimientosRefaccionesInternasControlVehiculos+"/"+
					arrSucursales);
	}

	//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
	function cargar_sucursales_rep_movimientos_refacciones_internas_control_vehiculos()
	{
		//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
		$.post('administracion/sucursales/get_combo_box/home', {},
			function(data)
			{
				$('#chkSucursales_rep_movimientos_refacciones_internas_control_vehiculos').empty();
				var temp = Mustache.render($('#sucursales_rep_movimientos_refacciones_internas_control_vehiculos').html(), data)
				$('#chkSucursales_rep_movimientos_refacciones_internas_control_vehiculos').html(temp);
			},
			'json');
	}

	//Función para obtener las Sucursales seleccionadas
	function sucursales_seleccionadas_rep_movimientos_refacciones_internas_control_vehiculos()
	{
		//Declaramos el arreglo que contendrá las sucursales seleccionadas
		var chkSucursalesArray = [];
		
		//Buscamos todos los checkboxes seleccionados
		$('[name="chkSucursales_rep_movimientos_refacciones_internas_control_vehiculos[]"]:checked').each(function() {
			chkSucursalesArray.push($(this).val());
		});
		
		//Unimos los valores seleccionados con un '|'
		chkSucursalesArray.join('|');

		//Regresar array con las sucursales seleccionadas
		return chkSucursalesArray;
	}


	//Controles o Eventos del Modal
	$(document).ready(function() 
	{
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicial_rep_movimientos_refacciones_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaFinal_rep_movimientos_refacciones_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});

        //Autocomplete para recuperar los datos de una refacción 
        $('#txtRefaccion_rep_movimientos_refacciones_internas_control_vehiculos').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtRefaccionID_rep_movimientos_refacciones_internas_control_vehiculos').val('');
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
           	 $('#txtRefaccionID_rep_movimientos_refacciones_internas_control_vehiculos').val(ui.item.data);

           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

       	//Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
        $('#txtRefaccion_rep_movimientos_refacciones_internas_control_vehiculos').focusout(function(e){
            //Si no existe id de la refacción
            if($('#txtRefaccionID_rep_movimientos_refacciones_internas_control_vehiculos').val() == '' ||
               $('#txtRefaccion_rep_movimientos_refacciones_internas_control_vehiculos').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtRefaccionID_rep_movimientos_refacciones_internas_control_vehiculos').val('');
               $('#txtRefaccion_rep_movimientos_refacciones_internas_control_vehiculos').val('');
            }

        });


        //Hacer un llamado a la función para obtener los permisos de acceso
		permisos_rep_movimientos_refacciones_internas_control_vehiculos();
        //Hacer un llamado a la función para cargar sucursales y armar los checklist
  		cargar_sucursales_rep_movimientos_refacciones_internas_control_vehiculos();
	});

</script>	