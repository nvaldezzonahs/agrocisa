	<div id="RepFlujoEfectivoCuentasPagarContent">  
		<!--Diseño del formulario-->
		<form id="frmRepFlujoEfectivoCuentasPagar" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepFlujoEfectivoCuentasPagar" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_flujo_efectivo_cuentas_pagar"
									onclick="validar_rep_flujo_efectivo_cuentas_pagar('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_flujo_efectivo_cuentas_pagar"
									onclick="validar_rep_flujo_efectivo_cuentas_pagar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				<div class="row">
					<!--Fecha de corte (fecha inicial en caso de seleccionar la opción imprimir detalles)-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label id="lblFechaCorte_rep_flujo_efectivo_cuentas_pagar" for="txtFechaCorte_rep_flujo_efectivo_cuentas_pagar">Fecha de corte</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaCorte_rep_flujo_efectivo_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaCorte_rep_flujo_efectivo_cuentas_pagar"
				                    		name= "strFechaCorte_rep_flujo_efectivo_cuentas_pagar" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Fecha final-->
					<div id="divFechaFinal_rep_flujo_efectivo_cuentas_pagar" class="col-sm-6 col-md-6 col-lg-6 col-xs-12 no-mostrar">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaFinal_rep_flujo_efectivo_cuentas_pagar">Fecha final</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_flujo_efectivo_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaFinal_rep_flujo_efectivo_cuentas_pagar"
				                    		name= "strFechaFinal_rep_flujo_efectivo_cuentas_pagar" 
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
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_rep_flujo_efectivo_cuentas_pagar" 
									   name="strImprimirDetalles_rep_flujo_efectivo_cuentas_pagar" type="checkbox"
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
	</div><!--#RepFlujoEfectivoCuentasPagarContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_flujo_efectivo_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_pagar/rep_flujo_efectivo/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_flujo_efectivo_cuentas_pagar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepFlujoEfectivoCuentasPagar = data.row;
					//Separar la cadena 
					var arrPermisosRepFlujoEfectivoCuentasPagar = strPermisosRepFlujoEfectivoCuentasPagar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepFlujoEfectivoCuentasPagar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepFlujoEfectivoCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_flujo_efectivo_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosRepFlujoEfectivoCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_flujo_efectivo_cuentas_pagar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_flujo_efectivo_cuentas_pagar(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_flujo_efectivo_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmRepFlujoEfectivoCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaCorte_rep_flujo_efectivo_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_rep_flujo_efectivo_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista fecha final
														if ($('#chbImprimirDetalles_rep_flujo_efectivo_cuentas_pagar').is(':checked') && value == '') 
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
			var bootstrapValidator_rep_flujo_efectivo_cuentas_pagar = $('#frmRepFlujoEfectivoCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_rep_flujo_efectivo_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_flujo_efectivo_cuentas_pagar.isValid())
			{
				
				//Hacer un llamado a la función para generar reporte en PDF/XLS
				reporte_rep_flujo_efectivo_cuentas_pagar(strTipo);
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_flujo_efectivo_cuentas_pagar()
		{
			try
			{
				$('#frmRepFlujoEfectivoCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_flujo_efectivo_cuentas_pagar(strTipo) 
		{

         	//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_pagar/rep_flujo_efectivo/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaCorte_rep_flujo_efectivo_cuentas_pagar').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_flujo_efectivo_cuentas_pagar').val())

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
			$('#dteFechaCorte_rep_flujo_efectivo_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_flujo_efectivo_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaCorte_rep_flujo_efectivo_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_flujo_efectivo_cuentas_pagar').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_flujo_efectivo_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaCorte_rep_flujo_efectivo_cuentas_pagar').data('DateTimePicker').maxDate(e.date);
			});


			//Mostrar u ocultar fecha final cuando cambie la opción del checkbox
	        $('#chbImprimirDetalles_rep_flujo_efectivo_cuentas_pagar').click(function(e){   
              	//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
				if ($('#chbImprimirDetalles_rep_flujo_efectivo_cuentas_pagar').is(':checked')) {

					//Quitar clase no-mostrar para mostrar fecha final
	   				$('#divFechaFinal_rep_flujo_efectivo_cuentas_pagar').removeClass("no-mostrar");
       				//Cambiar la etiqueta de la fecha
       				$('#lblFechaCorte_rep_flujo_efectivo_cuentas_pagar').text('Fecha inicial'); 
				   
				}
				else
				{ 
				    //Agregar clase no-mostrar para ocultar fecha final
	   				$('#divFechaFinal_rep_flujo_efectivo_cuentas_pagar').addClass("no-mostrar");
       				//Cambiar la etiqueta de la fecha
       				$('#lblFechaCorte_rep_flujo_efectivo_cuentas_pagar').text('Fecha de corte'); 
       				//Limpiar fecha final
       				$('#txtFechaFinal_rep_flujo_efectivo_cuentas_pagar').val(''); 
				}
	        });


			//Asignar la fecha actual
       		$('#txtFechaCorte_rep_flujo_efectivo_cuentas_pagar').val(fechaActual()); 
			//Enfocar caja de texto
			$('#txtProveedor_rep_flujo_efectivo_cuentas_pagar').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_flujo_efectivo_cuentas_pagar();
		});
	</script>