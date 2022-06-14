<div id="RepExistenciasGlobalesRefaccionesContent">  
	<!--Diseño del formulario-->
	<form id="frmRepExistenciasGlobalesRefacciones" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepExistenciasGlobalesRefacciones" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_rep_existencias_globales_refacciones"
								onclick="validar_rep_existencias_globales_refacciones('PDF');" 
								title="Imprimir reporte en PDF" 
								tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_rep_existencias_globales_refacciones"
								onclick="validar_rep_existencias_globales_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
							<span class="fa fa-file-excel-o"></span>
						</button> 
					</div>
				</div>
			</div>
		</div><!--Cierre de barra de herramientas-->
		<!--Estilo que se utiliza para mostrar los nombres de las columnas de la tabla en el dispositivo móvil -->
		<style>
			@media (max-width: 480px) 
			{
			    /*
				Definir columnas
				*/
				td.movil:nth-of-type(1):before {content: "Sucursal"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Localización"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Existencia"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Disponible"; font-weight: bold;}
				/*td.movil:nth-of-type(5):before {content: "Costo"; font-weight: bold;}*/
			}
		</style>
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<div class="row">
				<!--Refacción-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						 <!--Autocomplete que contiene las refacciones activas-->
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtRefaccionID_rep_existencias_globales_refacciones" 
										   name="intRefaccionID_rep_existencias_globales_refacciones" 
										   type="hidden" 
										   value="" />	
									<label for="txtCodigo_rep_existencias_globales_refacciones">Refacción</label>
								</div>
							</div>
							<div class="row">
								<!--Código-->
								<div class="col-md-3">
									<input  class="form-control" 
											id="txtCodigo_rep_existencias_globales_refacciones" 
											name="strCodigo_rep_existencias_globales_refacciones" 
											type="text" 
											value="" tabindex="1"
											placeholder="Ingrese código" maxlength="250"/>
								</div>
								<!--Descripción-->
								<div class="col-md-9">
									<input  class="form-control" 
											id="txtDescripcion_rep_existencias_globales_refacciones" 
											name="strRefaccionDescripcion_rep_existencias_globales_refacciones" 
											type="text" disabled />
								</div>
							</div>
							<br>
							<div class="row">
								<div class="panel panel-default">
									<div class="panel-body">
										<!--Div que contiene la tabla con los detalles encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<div class="row">
												<!-- Diseño de la tabla-->
												<table class="table-hover movil" id="dg_detalles_rep_existencias_globales_refacciones">
													<thead class="movil">
														<tr class="movil">
															<th class="movil">Sucursal</th>
															<th class="movil">Localización</th>
															<th class="movil">Existencia</th>
															<th class="movil">Disponible</th>
															<th class="movil no-mostrar">Costo</th>
														</tr>
													</thead>
													<tbody class="movil"></tbody>
												</table>
												<br>
												<!--Diseño de la paginación-->
												<div class="row">
													<!--Número de registros encontrados-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<button class="btn btn-default btn-sm disabled pull-right">
															<strong id="numElementos_detalles_rep_existencias_globales_refacciones">0</strong> encontrados
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>		
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</form>
</div><!--#RepExistenciasGlobalesRefaccionesContent -->

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario
	*******************************************************************************************************************/
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_existencias_globales_refacciones()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('refacciones/rep_existencias_globales/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_existencias_globales_refacciones').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepExistenciasGlobalesControlVehiculos = data.row;
				//Separar la cadena 
				var arrPermisosRepExistenciasGlobalesControlVehiculos = strPermisosRepExistenciasGlobalesControlVehiculos.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepExistenciasGlobalesControlVehiculos.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepExistenciasGlobalesControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_existencias_globales_refacciones').removeAttr('disabled');
					}
					else if(arrPermisosRepExistenciasGlobalesControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_existencias_globales_refacciones').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}
	

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_rep_existencias_globales_refacciones(strTipo)
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_rep_existencias_globales_refacciones();
		//Validación del formulario de campos obligatorios
		$('#frmRepExistenciasGlobalesRefacciones')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strCodigo_rep_existencias_globales_refacciones: {
										validators: {
											callback: {
				                            	callback: function(value, validator, $field) {
				                                    //Verificar que exista id de la refacción
				                                    if($('#txtRefaccionID_rep_existencias_globales_refacciones').val() === '')
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
		var bootstrapValidator_rep_existencias_globales_refacciones = $('#frmRepExistenciasGlobalesRefacciones').data('bootstrapValidator');
		bootstrapValidator_rep_existencias_globales_refacciones.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_rep_existencias_globales_refacciones.isValid())
		{
			
			//Hacer un llamado a la función para generar el reporte
			reporte_rep_existencias_globales_refacciones(strTipo);
			
		}
		else 
			return;
	}
	

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_rep_existencias_globales_refacciones()
	{
		try
		{
			$('#frmRepExistenciasGlobalesRefacciones').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_rep_existencias_globales_refacciones(strTipo)
	{

		//Variable que se utiliza para asignar URL (ruta del controlador)
		var strUrl = 'refacciones/rep_existencias_globales/';

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
									'intRefaccionID': $('#txtRefaccionID_rep_existencias_globales_refacciones').val()			
								 }
					   };


		//Hacer un llamado a la función para imprimir/descargar el reporte
		$.imprimirReporte(objReporte);
	}



	//Función para inicializar elementos de la tablas detalles
	function inicializar_detalles_rep_existencias_globales_refacciones()
	{
		//Eliminar los datos de la tabla detalles
		$('#dg_detalles_rep_existencias_globales_refacciones tbody').empty();
		$('#numElementos_detalles_rep_existencias_globales_refacciones').html(0);
		//Limpiar contenido de la caja de texto
		$('#txtDescripcion_rep_existencias_globales_refacciones').val('');
		
	}

	//Función para regresar obtener los datos de una refacción
	function get_datos_refaccion_rep_existencias_globales_refacciones(codigo)
	{
		 //Hacer un llamado al método del controlador para regresar los datos de la refacción
          $.post('refacciones/refacciones/get_datos',
              { 
              	strBusqueda: codigo
              },
              function(data) {
               
                if(data.row){ 

                	//Recuperar valores
                	$("#txtCodigo_rep_existencias_globales_refacciones").val(data.row.codigo_01);
                	$("#txtDescripcion_rep_existencias_globales_refacciones").val(data.row.descripcion);

                	//Hacer un llamado al método del controlador para regresar los datos del registro
					$.post('refacciones/rep_existencias_globales/get_existencia',
			       	{
			       		intRefaccionID:$('#txtRefaccionID_rep_existencias_globales_refacciones').val()
			       	},
			       	function(data2) {
			        	//Si hay datos del registro
			            if(data2.row)
			            {
				           	//Mostramos los detalles del registro
				           	for (var intCon in data2.row) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_rep_existencias_globales_refacciones').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaSucursal = objRenglon.insertCell(0);
								var objCeldaLocalizacion = objRenglon.insertCell(1);
								var objCeldaExistencia = objRenglon.insertCell(2);
								var objCeldaDisponible = objRenglon.insertCell(3);
								var objCeldaCosto = objRenglon.insertCell(4);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data2.row[intCon].sucursal);
								objCeldaSucursal.setAttribute('class', 'movil');
								objCeldaSucursal.innerHTML = data2.row[intCon].sucursal;
								objCeldaLocalizacion.setAttribute('class', 'movil');
								objCeldaLocalizacion.innerHTML = data2.row[intCon].localizacion;
								objCeldaExistencia.setAttribute('class', 'movil');
								objCeldaExistencia.innerHTML = data2.row[intCon].actual_existencia;
								objCeldaDisponible.setAttribute('class', 'movil');
								objCeldaDisponible.innerHTML = data2.row[intCon].disponible_existencia;
								objCeldaCosto.setAttribute('class', 'movil no-mostrar');
								objCeldaCosto.innerHTML =  formatMoney(data2.row[intCon].actual_costo, 4, '');
								
				            }

				            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_rep_existencias_globales_refacciones tr").length - 1;
							$('#numElementos_detalles_rep_existencias_globales_refacciones').html(intFilas);
			            }
			        }
			        ,'json');

                }

            }
             ,
            'json');
	}

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{
		//Autocomplete para recuperar los datos de una refacción 
        $('#txtCodigo_rep_existencias_globales_refacciones').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtRefaccionID_rep_existencias_globales_refacciones').val('');
                //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    	inicializar_detalles_rep_existencias_globales_refacciones();
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
           	  $('#txtRefaccionID_rep_existencias_globales_refacciones').val(ui.item.data);
           	  //Elegir código desde el valor devuelto en el autocomplete
           	  var strCodigo = ui.item.value.split(" - ")[0];
           	  //Hacer un llamado a la función para regresar los datos de la refacción
           	  get_datos_refaccion_rep_existencias_globales_refacciones(strCodigo);
             
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });
	});

	//Verificar que exista id de la refaccion cuando pierda el enfoque la caja de texto
    $('#txtCodigo_rep_existencias_globales_refacciones').focusout(function(e){
        //Si no existe id de la factura
        if($('#txtRefaccionID_rep_existencias_globales_refacciones').val() == '' ||
           $('#txtCodigo_rep_existencias_globales_refacciones').val() == '')
        { 
           //Limpiar contenido de las siguientes cajas de texto
           $('#txtRefaccionID_rep_existencias_globales_refacciones').val('');
           $('#txtCodigo_rep_existencias_globales_refacciones').val('');
           //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		   inicializar_detalles_rep_existencias_globales_refacciones();
           
        }

    });

    //Enfocar caja de texto
  	$('#txtCodigo_rep_existencias_globales_refacciones').focus();  

    //Hacer un llamado a la función para obtener los permisos de acceso
	permisos_rep_existencias_globales_refacciones();

</script>	