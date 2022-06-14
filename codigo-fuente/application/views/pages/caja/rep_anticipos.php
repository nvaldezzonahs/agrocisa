	<div id="RepAnticiposCajaContent">  
		<!--Diseño del formulario-->
		<form id="frmRepAnticiposCaja" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepAnticiposCaja" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_anticipos_caja"
									onclick="validar_rep_anticipos_caja('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_anticipos_caja"
									onclick="validar_rep_anticipos_caja('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
			    <div class="row">
			    	<!--Fecha de corte (fecha inicial en caso de seleccionar la opción anticipos y aplicaciones)-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label  id="lblFechaCorte_rep_anticipos_caja" for="txtFechaCorte_rep_anticipos_caja">Fecha de corte</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaCorte_rep_anticipos_caja'>
				                    <input class="form-control" id="txtFechaCorte_rep_anticipos_caja"
				                    		name= "strFechaCorte_rep_anticipos_caja" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Fecha final-->
					<div id="divFechaFinal_rep_anticipos_caja" class="col-sm-6 col-md-6 col-lg-6 col-xs-12 no-mostrar">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaFinal_rep_anticipos_caja">Fecha final</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_anticipos_caja'>
				                    <input class="form-control" id="txtFechaFinal_rep_anticipos_caja"
				                    		name= "strFechaFinal_rep_anticipos_caja" 
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
					<!--Autocomplete que contiene los clientes activos-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
								<input id="txtProspectoID_rep_anticipos_caja" 
									   name="intProspectoID_rep_anticipos_caja"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocial_rep_anticipos_caja">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocial_rep_anticipos_caja" 
										name="strRazonSocial_rep_anticipos_caja" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			     <div class="row">
			     	<!--Tipo de reporte-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<label>Seleccione el tipo de reporte:</label>
						<div class="custom-control custom-radio">
							<input type="radio" 
							  	   class="custom-control-input" 
							  	   id="rbtSoloSaldo_rep_anticipos_caja" 
							  	   name="strTipoReporte_rep_anticipos_caja"  value="Saldo"  checked />
							<label class="custom-control-label" for="rbtSoloSaldo_rep_anticipos_caja">Sólo saldo</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" 
							  	   class="custom-control-input" 
							  	   id="rbtAnticiposAplicaciones_rep_anticipos_caja" 
							  	   name="strTipoReporte_rep_anticipos_caja" value="Aplicaciones"  />
							<label class="custom-control-label" for="rbtAnticiposAplicaciones_rep_anticipos_caja">Anticipos y aplicaciones</label>
						</div>
					</div>
					<!--Tipo de anticipo-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Seleccione el tipo de anticipo:</label>
							</div>
							<div class="col-md-12">
								<!--Fiscal-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkAnticipoFiscal_rep_anticipos_caja" 
									name="chkTiposAnticipos_rep_anticipos_caja[]" 
									value="FISCALES" checked>
									<label class="form-check-label" for="FISCALES">FISCAL</label>
								</div>
								<!--No fiscal-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkAnticipoNoFiscal_rep_anticipos_caja"
									name="chkTiposAnticipos_rep_anticipos_caja[]" 
									value="NO FISCALES" checked>
									<label class="form-check-label" for="NO FISCALES">NO FISCAL</label>
								</div>
							</div>	
						</div>	
					</div>		
			    	<!--Lista de sucursales activas a las que tiene acceso el usuario-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Sucursales:</label>
							</div>
							<div class="col-md-12" id="chkSucursales_rep_anticipos_caja"></div>
						</div>	
					</div>
					
				</div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepAnticiposCajaContent -->

	<!-- /.Plantilla para cargar las sucursales-->  
	<script id="sucursales_rep_anticipos_caja" type="text/template">
		{{#sucursales}}
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" id="chkSucursal{{value}}_rep_anticipos_caja" 
		  		 name="chkSucursales_rep_anticipos_caja[]" value="{{value}}" checked>
		  <label class="form-check-label" for="{{value}}">{{nombre}}</label>
		</div>
		{{/sucursales}} 
	</script>

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Variables que se utilizan para la búsqueda de registros
		var strTipoReporteRepAnticiposCaja = "";
		var dteFechaCorteRepAnticiposCaja = "";
		var dteFechaFinalRepAnticiposCaja = "";
		var intProspectoIDRepAnticiposCaja = "";
		
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_anticipos_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/rep_anticipos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_anticipos_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepAnticiposCaja = data.row;
					//Separar la cadena 
					var arrPermisosRepAnticiposCaja = strPermisosRepAnticiposCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepAnticiposCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepAnticiposCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_anticipos_caja').removeAttr('disabled');
						}
						else if(arrPermisosRepAnticiposCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_anticipos_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_anticipos_caja(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_anticipos_caja();
			//Validación del formulario de campos obligatorios
			$('#frmRepAnticiposCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaCorte_rep_anticipos_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_rep_anticipos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                   //Variable que se utiliza para asignar el tipo de reporte 
					                                   var strTipoReporte = $("input:radio[name='strTipoReporte_rep_anticipos_caja']:checked").val();
					                                    //Verificar que exista fecha final
														if (strTipoReporte == 'Aplicaciones' && value == '') 
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Seleccione una fecha'
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
			var bootstrapValidator_rep_anticipos_caja = $('#frmRepAnticiposCaja').data('bootstrapValidator');
			bootstrapValidator_rep_anticipos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_anticipos_caja.isValid())
			{
				//Arreglo para obtener sucursales seleccionadas
				var chkSucursalesArray = [];
				chkSucursalesArray = sucursales_seleccionadas_rep_anticipos_caja();

				//Arreglo para obtener tipos de anticipos seleccionados
				var chkTiposAnticiposArray = [];
				chkTiposAnticiposArray = tipos_anticipos_seleccionados_rep_anticipos_caja();

				//Verificamos que al menos se encuentre una sucursal y un tipo de anticipo seleccionado
				if(chkSucursalesArray.length > 0 && chkTiposAnticiposArray.length > 0)
				{
					//Array que se utiliza para agregar sucursales
					var arrSucursales = chkSucursalesArray.join('|');
					//Array que se utiliza para agregar tipos de anticipos
					var arrTiposAnticipos = chkTiposAnticiposArray.join('|');
					
				 	//Hacer un llamado a la función para generar reporte en PDF/XLS
				 	reporte_rep_anticipos_caja(strTipo, arrSucursales, arrTiposAnticipos);
				
				}
				else
				{
					//Indicar al usuario el mensaje de error
					new $.Zebra_Dialog('Es necesario seleccionar al menos una sucursal y un tipo de anticipo.',
								   {'type': 'error', 
								   'title': 'Error'});
				}
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_anticipos_caja()
		{
			try
			{
				$('#frmRepAnticiposCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_anticipos_caja(strTipo, arrSucursales, arrTiposAnticipos) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'caja/rep_anticipos/';

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
										'strTipoReporte': $("input:radio[name='strTipoReporte_rep_anticipos_caja']:checked").val(),
										'strSucursales': arrSucursales,
										'strTiposAnticipos': arrTiposAnticipos,
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaCorte_rep_anticipos_caja').val()), 
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_anticipos_caja').val()),
										'intProspectoID': $('#txtProspectoID_rep_anticipos_caja').val()

									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}

		

		//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
		function cargar_sucursales_rep_anticipos_caja()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box/home', {},
				function(data)
				{
					$('#chkSucursales_rep_anticipos_caja').empty();
					var temp = Mustache.render($('#sucursales_rep_anticipos_caja').html(), data)
					$('#chkSucursales_rep_anticipos_caja').html(temp);
				},
				'json');
		}


		//Función para obtener las sucursales seleccionadas
		function sucursales_seleccionadas_rep_anticipos_caja(){

			//Declaramos el arreglo para que contendrá las sucursales seleccionadas
			var chkSucursalesArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkSucursales_rep_anticipos_caja[]"]:checked').each(function() {
				chkSucursalesArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkSucursalesArray.join('|');
			
			//Regresar array con las sucursales seleccionadas
			return chkSucursalesArray;

		}

		//Función para obtener los tipos de anticipos seleccionados
		function tipos_anticipos_seleccionados_rep_anticipos_caja(){

			//Declaramos el arreglo que contendrá los tipos de anticipos seleccionados
			var chkTiposAnticiposArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkTiposAnticipos_rep_anticipos_caja[]"]:checked').each(function() {
				chkTiposAnticiposArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkTiposAnticiposArray.join('|');

			//Regresar array con los tipos de anticipos seleccionados
			return chkTiposAnticiposArray;
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaCorte_rep_anticipos_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_anticipos_caja').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});


			//Mostrar u ocultar fecha final cuando cambie la opción del radio button
	        $("input[name=strTipoReporte_rep_anticipos_caja]").click(function(e){   

	        	//Variable que se utiliza para asignar el tipo de reporte 
			    var strTipoReporte = $("input:radio[name='strTipoReporte_rep_anticipos_caja']:checked").val();

			    //Si el radio button Anticipos y aplicaciones se encuentra seleccionado (marcado)
			    if(strTipoReporte == 'Aplicaciones')
			    {
			    	//Quitar clase no-mostrar para mostrar fecha final
	   				$('#divFechaFinal_rep_anticipos_caja').removeClass("no-mostrar");
       				//Cambiar la etiqueta de la fecha
       				$('#lblFechaCorte_rep_anticipos_caja').text('Fecha inicial');
       				
			    }
			    else
			    {
			    	//Agregar clase no-mostrar para ocultar fecha final
	   				$('#divFechaFinal_rep_anticipos_caja').addClass("no-mostrar");
       				//Cambiar la etiqueta de la fecha
       				$('#lblFechaCorte_rep_anticipos_caja').text('Fecha de corte'); 
       				//Limpiar fecha final
       				$('#txtFechaFinal_rep_anticipos_caja').val(''); 
			    }

			    //Enfocar caja de texto
       		    $('#txtFechaCorte_rep_anticipos_caja').focus(); 

	        });
		
			
			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_rep_anticipos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_rep_anticipos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete",
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
	             $('#txtProspectoID_rep_anticipos_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del cliente cuando pierda el enfoque la caja de texto
	        $('#txtRazonSocial_rep_anticipos_caja').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_rep_anticipos_caja').val() == '' ||
	               $('#txtRazonSocial_rep_anticipos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_rep_anticipos_caja').val('');
	               $('#txtRazonSocial_rep_anticipos_caja').val('');
	            }
	            
	        });

			//Asignar la fecha actual
       		$('#txtFechaCorte_rep_anticipos_caja').val(fechaActual()); 
			//Enfocar caja de texto
			$('#txtFechaCorte_rep_anticipos_caja').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_anticipos_caja();
			//Hacer un llamado a la función para cargar sucursales y armar los checklist
  			cargar_sucursales_rep_anticipos_caja();
		});
	</script>