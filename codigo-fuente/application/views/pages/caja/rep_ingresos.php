<div id="RepIngresosCajaContent">  
	<!--Diseño del formulario-->
	<form id="frmRepIngresosCaja" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepIngresosCaja" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_rep_ingresos_caja"
								onclick="validar_rep_ingresos_caja('PDF');" title="Imprimir reporte general en PDF" 
								tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_rep_ingresos_caja"
								onclick="validar_rep_ingresos_caja('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
							<span class="fa fa-file-excel-o"></span>
						</button> 
					</div>
				</div>
			</div>
		</div><!--Cierre de barra de herramientas-->
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<div class="row">
				<!--Fecha-->
				<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFecha_rep_ingresos_caja">Fecha</label>
						</div>
						<div id="divFechaMsjValidacion" class="col-md-12">
							<div class='input-group date' id='dteFecha_rep_ingresos_caja'>
			                    <input class="form-control" id="txtFecha_rep_ingresos_caja"
			                    		name= "strFecha_rep_ingresos_caja" 
			                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
						</div>
					</div>
				</div>
				<!--Autocomplete que contiene las formas de pago activas-->
				<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta para recuperar el id de la forma de pago seleccionada-->
							<input id="txtFormaPagoID_rep_ingresos_caja" 
												   name="intFormaPagoID_rep_ingresos_caja" 
												   type="hidden" value="" />
							<label for="txtFormaPago_rep_ingresos_caja">
												Forma de pago
							</label>
						</div>
						<div class="col-md-12">
								<input  class="form-control" id="txtFormaPago_rep_ingresos_caja" 
												name="strFormaPago_rep_ingresos_caja" type="text" value=""  
												tabindex="1" placeholder="Ingrese forma de pago" maxlength="250" />
						</div>
					</div>
				</div>
			</div>
			 <div class="row">
			    	<!--Lista de sucursales activas a las que tiene acceso el usuario-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Sucursales:</label>
							</div>
							<div class="col-md-12" id="chkSucursales_rep_ingresos_caja"></div>
						</div>	
					</div>
					<!--Lista de modulos-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Módulos:</label>
							</div>
							<div class="col-md-12">
								<!--Facturas de maquinaria-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloMaquinaria_rep_ingresos_caja" 
									name="chkModulos_rep_ingresos_caja[]" 
									value="MAQUINARIA" checked>
									<label class="form-check-label" for="MAQUINARIA">MAQUINARIA</label>
								</div>
								<!--Facturas de refacciones-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloRefacciones_rep_ingresos_caja"
									name="chkModulos_rep_ingresos_caja[]" 
									value="REFACCIONES" checked>
									<label class="form-check-label" for="REFACCIONES">REFACCIONES</label>
								</div>
								<!--Facturas de servicio-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloServicio_rep_ingresos_caja" 
									name="chkModulos_rep_ingresos_caja[]"
									value="SERVICIO" checked>
									<label class="form-check-label" for="SERVICIO">SERVICIO</label>
								</div>
								<!--Facturas de conceptos-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloConceptos_rep_ingresos_caja" 
									name="chkModulos_rep_ingresos_caja[]" 
									value="CONCEPTOS" checked>
									<label class="form-check-label" for="CONCEPTOS">CONCEPTOS</label>
								</div>
							</div>	
						</div>	
					</div>
			</div>
		</div>
	</form>
</div><!--#RepIngresosCajaContent -->

<!-- /.Plantilla para cargar las sucursales-->  
<script id="sucursales_rep_ingresos_caja" type="text/template">
	{{#sucursales}}
	<div class="form-check form-check-inline">
	  <input class="form-check-input-chk" type="checkbox" id="chkSucursal{{value}}_rep_ingresos_caja" 
	  		 name="chkSucursales_rep_ingresos_caja[]" value="{{value}}" checked>
	  <label class="form-check-label" for="{{value}}">{{nombre}}</label>
	</div>
	{{/sucursales}} 
</script>

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">
	/*******************************************************************************************************************
	Funciones del formulario
	*********************************************************************************************************************/
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_ingresos_caja()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('caja/rep_ingresos/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_ingresos_caja').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepIngresosCaja = data.row;
				//Separar la cadena 
				var arrPermisosRepIngresosCaja = strPermisosRepIngresosCaja.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepIngresosCaja.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepIngresosCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_ingresos_caja').removeAttr('disabled');
					}
					else if(arrPermisosRepIngresosCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_ingresos_caja').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_rep_ingresos_caja(strTipo)
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_rep_ingresos_caja();
		//Validación del formulario de campos obligatorios
		$('#frmRepIngresosCaja')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strFecha_rep_ingresos_caja: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha'}
										}
									}
								}
			});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_rep_ingresos_caja = $('#frmRepIngresosCaja').data('bootstrapValidator');
		bootstrapValidator_rep_ingresos_caja.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_rep_ingresos_caja.isValid())
		{

			//Arreglo para obtener sucursales seleccionadas
				var chkSucursalesArray = [];
				chkSucursalesArray = sucursales_seleccionadas_rep_ingresos_caja();

				//Arreglo para obtener módulos seleccionados
				var chkModulosArray = [];
				chkModulosArray = modulos_seleccionados_rep_ingresos_caja();



				//Verificamos que al menos se encuentre una sucursal y un modulo seleccionado
				if(chkSucursalesArray.length > 0  && chkModulosArray.length > 0)
				{
					//Array que se utiliza para agregar sucursales
					var arrSucursales = chkSucursalesArray.join('|');
					//Array que se utiliza para agregar módulos
					var arrModulos = chkModulosArray.join('|');

					//Hacer un llamado a la función para generar reporte en PDF/XLS
					reporte_rep_ingresos_caja(strTipo, arrSucursales, arrModulos);
					
				}
				else
				{
					//Indicar al usuario el mensaje de error
					new $.Zebra_Dialog('Es necesario seleccionar al menos una sucursal y un módulo.',
									   {'type': 'error', 
									   'title': 'Error'});
				}
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_rep_ingresos_caja()
	{
		try
		{
			$('#frmRepIngresosCaja').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}



	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_rep_ingresos_caja(strTipo, arrSucursales, arrModulos) 
	{
		
		   //Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'caja/rep_ingresos/';

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
										'dteFecha': $.formatFechaMysql($('#txtFecha_rep_ingresos_caja').val()),
										'intFormaPagoID': $('#txtFormaPagoID_rep_ingresos_caja').val(),
										'strSucursales': arrSucursales, 
										'strModulos': arrModulos
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
	}


	//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
	function cargar_sucursales_rep_ingresos_caja()
	{
		//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
		$.post('administracion/sucursales/get_combo_box/home', {},
			function(data)
			{
				$('#chkSucursales_rep_ingresos_caja').empty();
				var temp = Mustache.render($('#sucursales_rep_ingresos_caja').html(), data)
				$('#chkSucursales_rep_ingresos_caja').html(temp);
			},
			'json');
	}


	//Función para obtener las sucursales seleccionadas
	function sucursales_seleccionadas_rep_ingresos_caja(){

		//Declaramos el arreglo  que contendrá las sucursales seleccionadas
		var chkSucursalesArray = [];
		
		//Buscamos todos los checkboxes seleccionados
		$('[name="chkSucursales_rep_ingresos_caja[]"]:checked').each(function() {
			chkSucursalesArray.push($(this).val());
		});
		
		//Unimos los valores seleccionados con un '|'
		chkSucursalesArray.join('|');
		
		//Regresar array con las sucursales seleccionadas
		return chkSucursalesArray;

	}

	//Función para obtener los módulos seleccionados
		function modulos_seleccionados_rep_ingresos_caja(){

			//Declaramos el arreglo que contendrá los módulos seleccionados
			var chkModulosArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkModulos_rep_ingresos_caja[]"]:checked').each(function() {
				chkModulosArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkModulosArray.join('|');

			//Regresar array con los módulos seleccionados
			return chkModulosArray;
		}

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{	
		/*******************************************************************************************************************
		Controles correspondientes al formulario
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFecha_rep_ingresos_caja').datetimepicker({format: 'DD/MM/YYYY'});
		//Asignar la fecha actual
       	$('#txtFecha_rep_ingresos_caja').val(fechaActual()); 

       	//Autocomplete para recuperar los datos de una forma de pago
        $('#txtFormaPago_rep_ingresos_caja').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtFormaPagoID_rep_ingresos_caja').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "contabilidad/sat_forma_pago/autocomplete",
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
             $('#txtFormaPagoID_rep_ingresos_caja').val(ui.item.data);
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });
        
        //Verificar que exista id de la forma de pago cuando pierda el enfoque la caja de texto
        $('#txtFormaPago_rep_ingresos_caja').focusout(function(e){
            //Si no existe id de la forma de pago
            if($('#txtFormaPagoID_rep_ingresos_caja').val() == '' ||
               $('#txtFormaPago_rep_ingresos_caja').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtFormaPagoID_rep_ingresos_caja').val('');
               $('#txtFormaPago_rep_ingresos_caja').val('');
            }
            
        });


		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_rep_ingresos_caja();
		//Hacer un llamado a la función para cargar sucursales y armar los checklist
  		cargar_sucursales_rep_ingresos_caja();
	});
</script>	