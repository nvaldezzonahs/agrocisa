	<div id="EmpresasAdministracionContent">
		<!--Panel que contiene formulario-->
    	<div class="panel-modal-sin-barra">
			<!--Diseño del formulario-->
			<form id="frmEmpresasAdministracion" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmEmpresasAdministracion" onsubmit="return(false)" autocomplete="off">
				<div class="row">
				   	<!--Razón social-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtRazonSocial_empresas_administracion">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocial_empresas_administracion" 
										name="strRazonSocial_empresas_administracion" type="text" value="" 
										tabindex="1" placeholder="Ingrese razón social" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
				   	<!--Nombre comercial-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtNombreComercial_empresas_administracion">Nombre comercial</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtNombreComercial_empresas_administracion" 
										name="strNombreComercial_empresas_administracion" type="text" value="" 
										tabindex="1" placeholder="Ingrese nombre comercial" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
				   	<!--RFC-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtRfc_empresas_administracion">RFC</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRfc_empresas_administracion" 
										name="strRfc_empresas_administracion" type="text" value="" 
										tabindex="1" placeholder="Ingrese RFC" maxlength="13">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene los regímenes fiscales activos-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtRegimenFiscal_empresas_administracion">Régimen fiscal</label>
							</div>
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del régimen fiscal seleccionado-->
								<input id="txtRegimenFiscalID_empresas_administracion" 
									   name="intRegimenFiscalID_empresas_administracion"  
									   type="hidden" value="">
							    </input>
								<input  class="form-control" id="txtRegimenFiscal_empresas_administracion" 
										name="strRegimenFiscal_empresas_administracion" type="text" 
										value="" tabindex="1" placeholder="Ingrese régimen fiscal" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_empresas_administracion"  
								onclick="validar_empresas_administracion();" title="Guardar" tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button> 
						<!--Generar PDF con los datos del registro-->
                    	<button class="btn btn-default" type="button" id="btnImprimir_empresas_administracion" 
                    			onclick="reporte_empresas_administracion('PDF');" title="Imprimir reporte general en PDF" tabindex="3" disabled>
                    		<span class="glyphicon glyphicon-print"></span>
                    	</button>
                    	<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-default"  id="btnDescargarXLS_empresas_administracion"
								onclick="reporte_empresas_administracion('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
							<span class="fa fa-file-excel-o"></span>
						</button>  
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenedor del formulario--> 
	</div><!--#EmpresasAdministracionContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaEmpresasAdministracion = 0;
		var strUltimaBusquedaEmpresasAdministracion = "";

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_empresas_administracion()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('administracion/empresas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_empresas_administracion').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosEmpresasAdministracion = data.row;
					//Separar la cadena 
					var arrPermisosEmpresasAdministracion = strPermisosEmpresasAdministracion.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosEmpresasAdministracion.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if((arrPermisosEmpresasAdministracion[i]=='GUARDAR') || (arrPermisosEmpresasAdministracion[i]=='EDITAR'))
						{
							//Hacer un llamado a la función para recuperar los datos del registro
							editar_empresas_administracion();

							//Habilitar el control (botón guardar)
							$('#btnGuardar_empresas_administracion').removeAttr('disabled');
						}
						else if(arrPermisosEmpresasAdministracion[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_empresas_administracion').removeAttr('disabled');
						}
						else if(arrPermisosEmpresasAdministracion[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_empresas_administracion').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_empresas_administracion(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'administracion/empresas/';

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

			//Hacer un llamado al método del controlador para generar el reporte
         	window.open(strUrl);
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_empresas_administracion()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_empresas_administracion();
			//Validación del formulario de campos obligatorios
			$('#frmEmpresasAdministracion')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strRazonSocial_empresas_administracion: {
											validators: {
												notEmpty: {message: 'Escriba una razón social'}
											}
										},
										strNombreComercial_empresas_administracion: {
											validators: {
												notEmpty: {message: 'Escriba un nombre comercial'}
											}
										},
										strRfc_empresas_administracion: {
											validators: {
												notEmpty: {message: 'Escriba un RFC'}
											}
										},
										strRegimenFiscal_empresas_administracion: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del régimen fiscal
					                                    if($('#txtRegimenFiscalID_empresas_administracion').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un régimen fiscal existente'
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
			var bootstrapValidator_empresas_administracion = $('#frmEmpresasAdministracion').data('bootstrapValidator');
			bootstrapValidator_empresas_administracion.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_empresas_administracion.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_empresas_administracion();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_empresas_administracion()
		{
			try
			{
				$('#frmEmpresasAdministracion').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para modificar los datos del registro
		function guardar_empresas_administracion()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('administracion/empresas/modificar',
					{ 
						strRazonSocial: $('#txtRazonSocial_empresas_administracion').val(),
						strNombreComercial: $('#txtNombreComercial_empresas_administracion').val(),
						strRfc: $('#txtRfc_empresas_administracion').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_empresas_administracion').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para limpiar los mensajes de error 
							limpiar_mensajes_empresas_administracion();   
							//Hacer un llamado a la función para recuperar los datos del registro
							editar_empresas_administracion();            
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_empresas_administracion(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_empresas_administracion(tipoMensaje, mensaje)
		{
			//Si el tipo de mensaje es error 
			if(tipoMensaje == 'error')
			{ 
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog(mensaje, 
							  {'type': 'error',
							   'title': 'Error'
				    		  });
			}
			else
			{
			    //Indicar al usuario el mensaje de éxito
				new $.Zebra_Dialog(mensaje, 
							  {'type': 'confirmation',
							   'title': 'Éxito',
							   'buttons': false,
						       'modal': false,
						       'auto_close': 2000
					    	  });
			}
		}

		//Función para regresar los datos (al formulario) del registro
		function editar_empresas_administracion()
		{	
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_empresas_administracion();
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('administracion/empresas/get_datos',
			       {
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				            $('#txtRazonSocial_empresas_administracion').val(data.row.razon_social);
				            $('#txtNombreComercial_empresas_administracion').val(data.row.nombre_comercial);
						    $('#txtRfc_empresas_administracion').val(data.row.rfc);
				            $('#txtRegimenFiscalID_empresas_administracion').val(data.row.regimen_fiscal_id);
				            $('#txtRegimenFiscal_empresas_administracion').val(data.row.regimen_fiscal);
			       	    }
			       },
			       'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Autocomplete para recuperar los datos de un régimen fiscal 
	        $('#txtRegimenFiscal_empresas_administracion').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRegimenFiscalID_empresas_administracion').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_regimen_fiscal/autocomplete",
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
	               $('#txtRegimenFiscalID_empresas_administracion').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del régimen fiscal cuando pierda el enfoque la caja de texto
	        $('#txtRegimenFiscal_empresas_administracion').focusout(function(e){
	            //Si no existe id del régimen fiscal 
	            if($('#txtRegimenFiscalID_empresas_administracion').val() == '' || 
	               $('#txtRegimenFiscal_empresas_administracion').val() == '')
	            { 
	               //Limpiar contenido de la caja de texto
	               $('#txtRegimenFiscalID_empresas_administracion').val('');
	               $('#txtRegimenFiscal_empresas_administracion').val('');
	            }
	            
	        });

			//Enfocar caja de texto
			$('#txtRazonSocial_empresas_administracion').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_empresas_administracion();
		});
	</script>