<div id="RepInventarioRefaccionesContent">  
	<!--Diseño del formulario-->
	<form id="frmRepInventarioRefacciones" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepInventarioRefacciones" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_rep_inventario_refacciones"
								onclick="validar_rep_inventario_refacciones('PDF');" 
								title="Imprimir reporte general en PDF" 
								tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_rep_inventario_refacciones"
								onclick="validar_rep_inventario_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
							<span class="fa fa-file-excel-o"></span>
						</button> 
					</div>
				</div>
			</div>
		</div><!--Cierre de barra de herramientas-->
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<div class="row">
				<!--Fecha de corte-->
				<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaCorte_rep_inventario_refacciones">Fecha de corte</label>
						</div>
						<div id="divFechaMsjValidacion" class="col-md-12">
							<div class='input-group date' id='dteFechaCorte_rep_inventario_refacciones'>
			                    <input class="form-control" 
			                    		id="txtFechaCorte_rep_inventario_refacciones"
			                    		name= "strFechaCorte_rep_inventario_refacciones" 
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
				<!--Mostrar sólo refacciones con existencia--> 
				<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12 btn-toolBtns">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" id="chbExistencia_rep_inventario_refacciones" 
								   name="strRefaccionesExistencia_rep_inventario_refacciones" type="checkbox"
								   value="" tabindex="1">
							</input>
							<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							Sólo refacciones con existencia
                    	</label>
                  	</div>
				</div>
			</div>
			<div class="row">
		        <!--Autocomplete que contiene las líneas de refacciones activas-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id de la línea de refacciones seleccionada-->
							<input id="txtRefaccionesLineaID_rep_inventario_refacciones" 
								   name="intRefaccionesLineaID_rep_inventario_refacciones"  
								   type="hidden" value="">
						    </input>
							<label for="txtRefaccionesLinea_rep_inventario_refacciones">Línea</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtRefaccionesLinea_rep_inventario_refacciones" 
									name="strRefaccionesLinea_rep_inventario_refacciones" type="text" 
									value="" tabindex="1" placeholder="Ingrese línea" maxlength="250">
							</input>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<!--Autocomplete que contiene las marcas de refacciones activas-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id de la marca de refacciones seleccionada-->
							<input id="txtRefaccionesMarcaID_rep_inventario_refacciones" 
								   name="intRefaccionesMarcaID_rep_inventario_refacciones"  
								   type="hidden" value="">
						    </input>
							<label for="txtRefaccionesMarca_rep_inventario_refacciones">Marca</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtRefaccionesMarca_rep_inventario_refacciones" 
									name="strRefaccionesMarca_rep_inventario_refacciones" type="text" 
									value="" tabindex="1" placeholder="Ingrese marca" maxlength="250">
							</input>
						</div>
					</div>
				</div>
		    </div>
		    <div class="row">
		    	<!--Localización Inicial-->
				<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtLocalizacionInicial_rep_inventario_refacciones">Localización inicial</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtLocalizacionInicial_rep_inventario_refacciones" 
									name="strLocalizacionInicial_rep_inventario_refacciones" type="text" value="" 
									tabindex="1" placeholder="Ingrese localización">
							</input>
						</div>
					</div>
				</div>
				<!--Localización Final-->
				<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtLocalizacionFinal_rep_inventario_refacciones">Localización final</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtLocalizacionFinal_rep_inventario_refacciones" 
									name="strLocalizacionFinal_rep_inventario_refacciones" type="text" value="" 
									tabindex="1" placeholder="Ingrese localización">
							</input>
						</div>
					</div>
				</div>
				<!--Ordenamiento-->
				<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbTipoOrdenamiento_rep_inventario_refacciones">Ordenar los datos por</label>
						</div>
						<div id="divCmbMsjValidacion" class="col-md-12">
							<select class="form-control" id="cmbTipoOrdenamiento_rep_inventario_refacciones" 
							 		name="strTipoOrdenamiento_rep_inventario_refacciones" tabindex="1">
                  				<option value="">Seleccione una opción</option>
                  				<option value="LOCALIZACION">LOCALIZACIÓN</option>
                  				<option value="DESCRIPCION">DESCRIPCIÓN</option>
                  				<option value="CODIGO">CÓDIGO</option>
                  				<option value="LINEA">LÍNEA</option>
             				</select>
						</div>
					</div>
				</div>
		    </div>
		</div><!--Cierre del contenedor del formulario-->
	</form><!--Cierre del formulario-->
</div><!--#RepInventarioRefaccionesContent -->



<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*******************************************************************************************************************/
	//Variable que se utilizan para la búsqueda de registros
	var dteFechaCorteInventarioRefacciones = "";
	var intRefaccionesLineaIDInventarioRefacciones = "";
	var intRefaccionesMarcaIDInventarioRefacciones = "";

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_inventario_refacciones()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('refacciones/rep_inventario/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_inventario_refacciones').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepInventarioRefacciones = data.row;
				//Separar la cadena 
				var arrPermisosRepInventarioRefacciones = strPermisosRepInventarioRefacciones.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepInventarioRefacciones.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepInventarioRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_inventario_refacciones').removeAttr('disabled');
					}
					else if(arrPermisosRepInventarioRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_inventario_refacciones').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}
	

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_rep_inventario_refacciones(strTipo)
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_rep_inventario_refacciones();
		//Validación del formulario de campos obligatorios
		$('#frmRepInventarioRefacciones')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strFechaCorte_rep_inventario_refacciones: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha'}
										}
									},
									strRefaccionesLinea_rep_inventario_refacciones: {
										validators: {
											callback: {
				                            	callback: function(value, validator, $field) {
				                                    //Verificar que exista id de la línea de refacción
				                                    if(value !== '' && $('#txtRefaccionesLineaID_rep_inventario_refacciones').val() === '')
				                                    {
			                                      		return {
				                                            valid: false,
				                                            message: 'Escriba una línea existente'
				                                        };
				                                    }
				                                    return true;
				                                }
				                            }
										}
									},
									strRefaccionesMarca_rep_inventario_refacciones: {
										validators: {
											callback: {
				                            	callback: function(value, validator, $field) {
				                                    //Verificar que exista id de la marca de refacción
				                                    if(value !== '' && $('#txtRefaccionesMarcaID_rep_inventario_refacciones').val() === '')
				                                    {
			                                      		return {
				                                            valid: false,
				                                            message: 'Escriba una marca existente'
				                                        };
				                                    }
				                                    return true;
				                                }
				                            }
										}
									},
									strTipoOrdenamiento_rep_inventario_refacciones: {
										validators: {
											notEmpty: {message: 'Seleccione el tipo de ordenamiento'}
										}
									}
								}
			});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_rep_inventario_refacciones = $('#frmRepInventarioRefacciones').data('bootstrapValidator');
		bootstrapValidator_rep_inventario_refacciones.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_rep_inventario_refacciones.isValid())
		{
			//Si el tipo de reporte es PDF
			if(strTipo == 'PDF')
			{
				//Hacer un llamado a la función para generar el reporte
				reporte_rep_inventario_refacciones();
			}
			else
			{
				//Hacer un llamado a la función para generar y descargar el archivo XLS
			 	descargar_xls_rep_inventario_refacciones();
			}
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_rep_inventario_refacciones()
	{
		try
		{
			$('#frmRepInventarioRefacciones').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para crear el reporte en PDF de movimientos de un insumo
	function reporte_rep_inventario_refacciones()
	{
		//Asignar valores para la búsqueda de registros	
		dteFechaCorteInventarioRefacciones =  $.formatFechaMysql($('#txtFechaCorte_rep_inventario_refacciones').val());	
		intRefaccionesLineaIDInventarioRefacciones =  $('#txtRefaccionesLineaID_rep_inventario_refacciones').val();
		intRefaccionesMarcaIDInventarioRefacciones =  $('#txtRefaccionesMarcaID_rep_inventario_refacciones').val();
		
		//Si no existe id de la línea de refacciones
		if(intRefaccionesLineaIDInventarioRefacciones == '')
		{
			intRefaccionesLineaIDInventarioRefacciones = 0;
		}

		//Si no existe id de la marca de refacciones
		if(intRefaccionesMarcaIDInventarioRefacciones == '')
		{
			intRefaccionesMarcaIDInventarioRefacciones = 0;
		}

		//Si el checkbox incluir existencia se encuentra seleccionado (marcado)
		if ($('#chbExistencia_rep_inventario_refacciones').is(':checked')) {
		    //Asignar SI para incluir sólo las refacciones con existencia en el reporte
		    $('#chbExistencia_rep_inventario_refacciones').val('SI');
		}
		else
		{ 
		   //Asignar NO para mostrar todas las refacciones en el reporte
		   $('#chbExistencia_rep_inventario_refacciones').val('NO');
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("refacciones/rep_inventario/get_reporte/"+
					dteFechaCorteInventarioRefacciones+"/"+
					intRefaccionesLineaIDInventarioRefacciones+"/"+
					intRefaccionesMarcaIDInventarioRefacciones+"/"+
					$('#cmbTipoOrdenamiento_rep_inventario_refacciones').val()+"/"+
					$('#chbExistencia_rep_inventario_refacciones').val()+"/"+
					$('#txtLocalizacionInicial_rep_inventario_refacciones').val()+"/"+
					$('#txtLocalizacionFinal_rep_inventario_refacciones').val());

	}

	//Función para descargar el reporte general en XLS
	function descargar_xls_rep_inventario_refacciones() 
	{
		//Asignar valores para la búsqueda de registros	
		dteFechaCorteInventarioRefacciones =  $.formatFechaMysql($('#txtFechaCorte_rep_inventario_refacciones').val());	
		intRefaccionesLineaIDInventarioRefacciones =  $('#txtRefaccionesLineaID_rep_inventario_refacciones').val();
		intRefaccionesMarcaIDInventarioRefacciones =  $('#txtRefaccionesMarcaID_rep_inventario_refacciones').val();
			
		//Si no existe id de la línea de refacciones
		if(intRefaccionesLineaIDInventarioRefacciones == '')
		{
			intRefaccionesLineaIDInventarioRefacciones = 0;
		}

		//Si no existe id de la marca de refacciones
		if(intRefaccionesMarcaIDInventarioRefacciones == '')
		{
			intRefaccionesMarcaIDInventarioRefacciones = 0;
		}

		//Si el checkbox incluir existencia se encuentra seleccionado (marcado)
		if ($('#chbExistencia_rep_inventario_refacciones').is(':checked')) {
		    //Asignar SI para incluir sólo las refacciones con existencia en el reporte
		    $('#chbExistencia_rep_inventario_refacciones').val('SI');
		}
		else
		{ 
		   //Asignar NO para mostrar todas las refacciones en el reporte
		   $('#chbExistencia_rep_inventario_refacciones').val('NO');
		}

		//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
        window.open("refacciones/rep_inventario/get_xls/"+
					dteFechaCorteInventarioRefacciones+"/"+
					intRefaccionesLineaIDInventarioRefacciones+"/"+
					intRefaccionesMarcaIDInventarioRefacciones+"/"+
					$('#cmbTipoOrdenamiento_rep_inventario_refacciones').val()+"/"+
					$('#chbExistencia_rep_inventario_refacciones').val()+"/"+
					$('#txtLocalizacionInicial_rep_inventario_refacciones').val()+"/"+
					$('#txtLocalizacionFinal_rep_inventario_refacciones').val());
	}


	//Controles o Eventos del Modal
	$(document).ready(function() 
	{
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaCorte_rep_inventario_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

        //Autocomplete para recuperar los datos de una línea de refacciones 
        $('#txtRefaccionesLinea_rep_inventario_refacciones').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtRefaccionesLineaID_rep_inventario_refacciones').val('');
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
             $('#txtRefaccionesLineaID_rep_inventario_refacciones').val(ui.item.data);
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });
        
        //Verificar que exista id de la línea de refacciones cuando pierda el enfoque la caja de texto
        $('#txtRefaccionesLinea_rep_inventario_refacciones').focusout(function(e){
            //Si no existe id de la línea de refacciones
            if($('#txtRefaccionesLineaID_rep_inventario_refacciones').val() == '' ||
               $('#txtRefaccionesLinea_rep_inventario_refacciones').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtRefaccionesLineaID_rep_inventario_refacciones').val('');
               $('#txtRefaccionesLinea_rep_inventario_refacciones').val('');
            }
            
        });

        //Autocomplete para recuperar los datos de una marca de refacciones
        $('#txtRefaccionesMarca_rep_inventario_refacciones').autocomplete({
              source: function( request, response ) {
              	 //Limpiar caja de texto que hace referencia al id del registro 
                 $('#txtRefaccionesMarcaID_rep_inventario_refacciones').val('');
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
               $('#txtRefaccionesMarcaID_rep_inventario_refacciones').val(ui.item.data);
             },
             open: function() {
                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
               },
               close: function() {
                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
               },
             minLength: 1
        });

        //Verificar que exista id de la marca de refacciones cuando pierda el enfoque la caja de texto
        $('#txtRefaccionesMarca_rep_inventario_refacciones').focusout(function(e){
            //Si no existe id de la marca de refacciones
            if($('#txtRefaccionesMarcaID_rep_inventario_refacciones').val() == '' ||
               $('#txtRefaccionesMarca_rep_inventario_refacciones').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtRefaccionesMarcaID_rep_inventario_refacciones').val('');
               $('#txtRefaccionesMarca_rep_inventario_refacciones').val('');
            }

        });


        //Asignar la fecha actual
       	$('#txtFechaCorte_rep_inventario_refacciones').val(fechaActual()); 

        //Hacer un llamado a la función para obtener los permisos de acceso
		permisos_rep_inventario_refacciones();
	});

</script>	