<div id="PolizasCierreContabilidadContent">  
	<!--Diseño del formulario-->
	<form id="frmPolizasCierreContablidad" method="post" action="#" class="form-horizontal" role="form" name="frmPolizasCierreContablidad" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_polizas_cierre_contabilidad" onclick="validar_polizas_cierre_contabilidad();"  title="Guardar" tabindex="1" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF del registro-->
						<button class="btn btn-default"  id="btnImprimirRegistro_polizas_cierre_contabilidad" onclick="reporte_registro_polizas_cierre_contabilidad();" title="Imprimir registro en PDF" tabindex="2" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
					</div>
				</div>
			</div>
		</div><!--Cierre de barra de herramientas-->
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<div class="row">
				<!--Folio-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
							<input id="txtPolizaID_polizas_cierre_contabilidad" name="intPolizaID_polizas_cierre_contabilidad" type="hidden" value=""></input>
							<label for="txtFolio_polizas_cierre_contabilidad">Folio</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtFolio_polizas_cierre_contabilidad" name="strFolio_polizas_cierre_contabilidad" type="text" value="" placeholder="Autogenerado" disabled></input>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<!--Año-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtAnio_polizas_cierre_contabilidad">Año a cerrar</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtAnio_polizas_cierre_contabilidad" name="strAnio_polizas_cierre_contabilidad" type="number" value="" maxlength="4"></input>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<!--Concepto-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtConcepto_polizas_cierre_contabilidad">Concepto</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtConcepto_polizas_cierre_contabilidad" name="strConcepto_polizas_cierre_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese concepto" maxlength="250"></input>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<!--Autocomplete que contiene las cuentas activas-->
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar los datos (primer_nivel, segundo_nivel,tercer_nivel y cuarto_nivel) concatenados de la cuenta seleccionada-->
							<input id="txtCuentaID_polizas_cierre_contabilidad" name="strCuentaID_polizas_cierre_contabilidad" type="hidden" value=""></input>
							<label for="txtCuenta_polizas_cierre_contabilidad">Cuenta</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtCuenta_polizas_cierre_contabilidad" name="strCuenta_polizas_cierre_contabilidad" type="text" value=""tabindex="1" placeholder="Ingrese cuenta" maxlength="250"></input>
						</div>
					</div>
				</div>
			</div>
			<!--Circulo de progreso-->
			<div id="divCirculoBarProgreso_polizas_cierre_contabilidad" class="load-container load5 circulo_bar no-mostrar">
				<div class="loader">Loading...</div>
				<br><br>
				<div align=center><b>Espere un momento por favor.</b></div>
			</div> 					  			    
		</div><!--Cierre del contenedor del formulario--> 
	</form><!--Cierre del formulario-->
</div><!--#PolizasCierreContabilidadContent -->
<!--Javascript con las funciones del formulario-->
<script type="text/javascript">
	/*******************************************************************************************************************
	Funciones del formulario
	*********************************************************************************************************************/
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_polizas_cierre_contabilidad()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('contabilidad/polizas_cierre/get_permisos_acceso',
				{ 
					strPermisosAcceso: $('#txtAcciones_polizas_cierre_contabilidad').val()
				},
				function(data){
					//Si existen permisos de acceso del usuario para este proceso
					if (data.row)
					{
						//Asignar a la variable la cadena concatenada con los permisos de acceso
						//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
						var strPermisosPolizasCierreContabilidad = data.row;
						//Separar la cadena 
						var arrPermisosPolizasCierreContabilidad = strPermisosPolizasCierreContabilidad.split('|');

						//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
						for (var i=0; i < arrPermisosPolizasCierreContabilidad.length; i++)
						{	//Habilitar Acción si se cuenta con  permiso de acceso
							//Si el indice es GUARDAR ó EDITAR (modificar)
							if (arrPermisosPolizasCierreContabilidad[i]=='GUARDAR')
							{
								//Habilitar el control (botón guardar)
								$('#btnGuardar_polizas_cierre_contabilidad').removeAttr('disabled');
							}
							else if(arrPermisosPolizasCierreContabilidad[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
							{
								//Habilitar el control (botón imprimir)
								$('#btnImprimirRegistro_polizas_cierre_contabilidad').removeAttr('disabled');
							}
						}//Cerrar for
					}
				},
			'json');
	}


	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_polizas_cierre_contabilidad()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_polizas_cierre_contabilidad();

		if ($('#txtPolizaID_polizas_cierre_contabilidad').val() != '')
		{
			mensaje_polizas_cierre_contabilidad('error', 'La póliza ya ha sido generada');
			return;
		}
		else
		{
			//Validación del formulario de campos obligatorios
			$('#frmPolizasCierreContablidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
										valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									 },
									 fields: {
									 	strAnio_polizas_cierre_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione un año'}
											}
										},
										strConcepto_polizas_cierre_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba un concepto'}
											}
										},
										strCuenta_polizas_cierre_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una cuenta contable'}
											}
										}
									 }
									});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_polizas_cierre_contabilidad = $('#frmPolizasCierreContablidad').data('bootstrapValidator');
			
			bootstrapValidator_polizas_cierre_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_polizas_cierre_contabilidad.isValid())
			{
				guardar_polizas_cierre_contabilidad();
			}
			else 
				return;
		}
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_polizas_cierre_contabilidad()
	{
		try
		{
			$('#frmPolizasCierreContablidad').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}


	//Función para guardar los datos de un registro
	function guardar_polizas_cierre_contabilidad()
	{
		//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
		mostrar_circulo_carga_polizas_cierre_contabilidad();
		//Hacer un llamado al método del controlador para guardar los datos del registro
		$.post('contabilidad/polizas_cierre/guardar',
			{ 
				//Datos de la póliza
				intAnio: $('#txtAnio_polizas_cierre_contabilidad').val(),
				strConcepto: $('#txtConcepto_polizas_cierre_contabilidad').val(),
				intCuentaID: $('#txtCuentaID_polizas_cierre_contabilidad').val(),
				intProcesoMenuID: $('#txtProcesoMenuID_polizas_cierre_contabilidad').val()
			},
			function(data) {
				if (data.resultado)
				{
					$('#txtPolizaID_polizas_cierre_contabilidad').val(data.poliza_id);
					$('#txtFolio_polizas_cierre_contabilidad').val(data.folio);
				}

				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	           	ocultar_circulo_carga_polizas_cierre_contabilidad();
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_polizas_cierre_contabilidad(data.tipo_mensaje, data.mensaje);
			},
			'json');
	}

	//Función para cargar el reporte de un registro en PDF
	function reporte_registro_polizas_cierre_contabilidad() 
	{
		if ($('#txtPolizaID_polizas_cierre_contabilidad').val() != '')
		{
			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'contabilidad/polizas/get_reporte_registro',
						  'data' : {'intPolizaID': $('#txtPolizaID_polizas_cierre_contabilidad').val()}
			};
			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}
		else
		{
			mensaje_polizas_cierre_contabilidad('error', 'No existe una póliza cargada');
		}
		
	}

	//Función para mostrar mensaje de éxito o error
	function mensaje_polizas_cierre_contabilidad(tipoMensaje, mensaje)
	{
		//Si el tipo de mensaje es error 
		if(tipoMensaje == 'error')
		{ 
			//Indicar al usuario el mensaje de error
			new $.Zebra_Dialog(mensaje, 
				{
					'type': 'error',
					'title': 'Error'
				}
			);
		}
		else
		{
			//Indicar al usuario el mensaje de éxito
			new $.Zebra_Dialog(mensaje, 
				{
					'type': 'confirmation',
					'title': 'Éxito',
					'buttons': false,
					'modal': false,
					'auto_close': 2000
				}
			);
		}
	}

	//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
	//al momento de guardar el registro
	function mostrar_circulo_carga_polizas_cierre_contabilidad()
	{
		//Remover clase para mostrar div que contiene la barra de carga
		$("#divCirculoBarProgreso_polizas_cierre_contabilidad").removeClass('no-mostrar');
	}

	//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
	//al momento de enviar correo electrónico
	function ocultar_circulo_carga_polizas_cierre_contabilidad()
	{
		//Agregar clase para ocultar div que contiene la barra de carga
		$("#divCirculoBarProgreso_polizas_cierre_contabilidad").addClass('no-mostrar');
	}


	//Controles o Eventos del Modal
	$(document).ready(function() {
		//Autocomplete para recuperar los datos de una cuenta
		$('#txtCuenta_polizas_cierre_contabilidad').autocomplete({
			source: function(request, response) {
				$.ajax({
					//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
					url: "contabilidad/catalogo_cuentas/autocomplete",
					type: "post",
					dataType: "json",
					data: {
						strDescripcion: request.term
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				$('#txtCuentaID_polizas_cierre_contabilidad').val(ui.item.data);
			},
			open: function() {
				$(this).removeClass("ui-corner-all").addClass("ui-corner-top");
			},
			close: function() {
				$(this).removeClass("ui-corner-top").addClass("ui-corner-all");
			},
			minLength: 1
		});

		//Verificar y concatenar datos de la cuenta cuando pierda el enfoque la caja de texto
		$('#txtCuenta_polizas_cierre_contabilidad').focusout(function(e){
			if ($('#txtCuentaID_polizas_cierre_contabilidad').val() == '')
			{
				$('#txtCuenta_polizas_cierre_contabilidad').val('');
			}
		});

		//Inicializar el campo de año
		var intAnio = new Date().getFullYear();
		$('#txtAnio_polizas_cierre_contabilidad').val(intAnio - 1);

		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_polizas_cierre_contabilidad();
	});
</script>