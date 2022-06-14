<div id="RepMovimientosRefaccionesRefaccionesContent">  
	<!--Diseño del formulario-->
	<form id="frmRepMovimientosRefaccionesRefacciones" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepMovimientosRefaccionesRefacciones" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_rep_movimientos_refacciones_refacciones"
								onclick="validar_rep_movimientos_refacciones_refacciones('PDF');" 
								title="Imprimir reporte general en PDF" 
								tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_rep_movimientos_refacciones_refacciones"
								onclick="validar_rep_movimientos_refacciones_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
							<label for="txtFechaInicial_rep_movimientos_refacciones_refacciones">Fecha inicial</label>
						</div>
						<div id="divFechaMsjValidacion" class="col-md-12">
							<div class='input-group date' id='dteFechaInicial_rep_movimientos_refacciones_refacciones'>
			                    <input class="form-control" 
			                    		id="txtFechaInicial_rep_movimientos_refacciones_refacciones"
			                    		name= "strFechaInicial_rep_movimientos_refacciones_refacciones" 
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
							<label for="txtFechaFinal_rep_movimientos_refacciones_refacciones">Fecha final</label>
						</div>
						<div id="divFechaMsjValidacion" class="col-md-12">
							<div class='input-group date' id='dteFechaFinal_rep_movimientos_refacciones_refacciones'>
			                    <input class="form-control" 
			                    		id="txtFechaFinal_rep_movimientos_refacciones_refacciones"
			                    		name= "strFechaFinal_rep_movimientos_refacciones_refacciones" 
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
							<input id="txtRefaccionID_rep_movimientos_refacciones_refacciones" 
								   name="intRefaccionID_rep_movimientos_refacciones_refacciones" 
								   type="hidden" 
								   value="" />	
							<label for="txtRefaccion_rep_movimientos_refacciones_refacciones">Refacción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
								id="txtRefaccion_rep_movimientos_refacciones_refacciones" 
								name="strRefaccion_rep_movimientos_refacciones_refacciones" 
								type="text" 
								placeholder="Ingrese refacción" />
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
						<div class="col-md-12" id="chkSucursales_rep_movimientos_refacciones_refacciones"></div>
					</div>	
				</div>		
			</div>	
		</div><!--Cierre del contenedor del formulario-->
	</form><!--Cierre del formulario-->
</div><!--#RepMovimientosRefaccionesRefaccionesContent -->


<!-- /.Plantilla para cargar las sucursales-->  
<script id="sucursales_rep_movimientos_refacciones_refacciones" type="text/template">
	{{#sucursales}}
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="chkSucursal{{value}}_rep_movimientos_refacciones_refacciones" 
	  		 name="chkSucursales_rep_movimientos_refacciones_refacciones[]" value="{{value}}" checked>
	  <label class="form-check-label" for="{{value}}">{{nombre}}</label>
	</div>
	{{/sucursales}} 
</script>

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*******************************************************************************************************************/
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_movimientos_refacciones_refacciones()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('refacciones/rep_movimientos_refacciones/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_movimientos_refacciones_refacciones').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepMovimientosRefaccionesRefacciones = data.row;
				//Separar la cadena 
				var arrPermisosRepMovimientosRefaccionesRefacciones = strPermisosRepMovimientosRefaccionesRefacciones.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepMovimientosRefaccionesRefacciones.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepMovimientosRefaccionesRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_movimientos_refacciones_refacciones').removeAttr('disabled');
					}
					else if(arrPermisosRepMovimientosRefaccionesRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_movimientos_refacciones_refacciones').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}
	

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_rep_movimientos_refacciones_refacciones(strTipo)
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_rep_movimientos_refacciones_refacciones();
		//Validación del formulario de campos obligatorios
		$('#frmRepMovimientosRefaccionesRefacciones')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strFechaInicial_rep_movimientos_refacciones_refacciones: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha'}
										}
									},
									strFechaFinal_rep_movimientos_refacciones_refacciones: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha'}
										}
									},
									strRefaccion_rep_movimientos_refacciones_refacciones: {
										validators: {
											callback: {
				                            	callback: function(value, validator, $field) {
				                                    //Verificar que exista id de la refacción
				                                    if($('#txtRefaccionID_rep_movimientos_refacciones_refacciones').val() === '')
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
		var bootstrapValidator_rep_movimientos_refacciones_refacciones = $('#frmRepMovimientosRefaccionesRefacciones').data('bootstrapValidator');
		bootstrapValidator_rep_movimientos_refacciones_refacciones.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_rep_movimientos_refacciones_refacciones.isValid())
		{
			//Arreglo para obtener sucursales seleccionadas
			var chkSucursalesArray = [];
			chkSucursalesArray = sucursales_seleccionadas_rep_movimientos_refacciones_refacciones();
			//Verificamos que al menos se encuentre una sucursal seleccionada
			if(chkSucursalesArray.length > 0)
			{
				//Array que se utiliza para agregar sucursales
				var arrSucursales = chkSucursalesArray.join('|');

				
			    //Hacer un llamado a la función para generar el reporte
				reporte_rep_movimientos_refacciones_refacciones(arrSucursales, strTipo);
				
			}
			else
			{
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog('Es necesario seleccionar al menos una sucursal', 
									{'type': 'error', 
									 'title': 'Error'});
			}
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_rep_movimientos_refacciones_refacciones()
	{
		try
		{
			$('#frmRepMovimientosRefaccionesRefacciones').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_rep_movimientos_refacciones_refacciones(arrSucursales, strTipo)
	{
		//Variable que se utiliza para asignar URL (ruta del controlador)
        var strUrl = 'refacciones/rep_movimientos_refacciones/';

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
                                    'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_rep_movimientos_refacciones_refacciones').val()),
                                    'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_movimientos_refacciones_refacciones').val()),
                                    'intRefaccionID':  $('#txtRefaccionID_rep_movimientos_refacciones_refacciones').val(),  
                                    'strSucursales': arrSucursales           
                                 }
                       };


        //Hacer un llamado a la función para imprimir/descargar el reporte
        $.imprimirReporte(objReporte);
	}

	

	//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
	function cargar_sucursales_rep_movimientos_refacciones_refacciones()
	{
		//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
		$.post('administracion/sucursales/get_combo_box/home', {},
			function(data)
			{
				$('#chkSucursales_rep_movimientos_refacciones_refacciones').empty();
				var temp = Mustache.render($('#sucursales_rep_movimientos_refacciones_refacciones').html(), data)
				$('#chkSucursales_rep_movimientos_refacciones_refacciones').html(temp);
			},
			'json');
	}

	//Función para obtener las Sucursales seleccionadas
	function sucursales_seleccionadas_rep_movimientos_refacciones_refacciones()
	{
		//Declaramos el arreglo que contendrá las sucursales seleccionadas
		var chkSucursalesArray = [];
		
		//Buscamos todos los checkboxes seleccionados
		$('[name="chkSucursales_rep_movimientos_refacciones_refacciones[]"]:checked').each(function() {
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
		$('#dteFechaInicial_rep_movimientos_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaFinal_rep_movimientos_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

        //Autocomplete para recuperar los datos de una refacción 
        $('#txtRefaccion_rep_movimientos_refacciones_refacciones').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtRefaccionID_rep_movimientos_refacciones_refacciones').val('');
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
           	 $('#txtRefaccionID_rep_movimientos_refacciones_refacciones').val(ui.item.data);

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
        $('#txtRefaccion_rep_movimientos_refacciones_refacciones').focusout(function(e){
            //Si no existe id de la refacción
            if($('#txtRefaccionID_rep_movimientos_refacciones_refacciones').val() == '' ||
               $('#txtRefaccion_rep_movimientos_refacciones_refacciones').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtRefaccionID_rep_movimientos_refacciones_refacciones').val('');
               $('#txtRefaccion_rep_movimientos_refacciones_refacciones').val('');
            }

        });


        //Hacer un llamado a la función para obtener los permisos de acceso
		permisos_rep_movimientos_refacciones_refacciones();
        //Hacer un llamado a la función para cargar sucursales y armar los checklist
  		cargar_sucursales_rep_movimientos_refacciones_refacciones();
	});

</script>	