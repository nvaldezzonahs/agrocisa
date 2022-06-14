	<div id="RefaccionesReclasificacionRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmRefaccionesReclasificacionRefacciones" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmRefaccionesReclasificacionRefacciones" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Tipo-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtRefaccionesReclasificacionID_refacciones_reclasificacion_refacciones" 
									   name="intRefaccionesReclasificacionID_refacciones_reclasificacion_refacciones" 
									   type="hidden" value="">
								</input>
								<!-- Caja de texto oculta que se utiliza para recuperar el tipo anterior y así evitar duplicidad en caso de que exista otro registro con la misma clasificación en el tipo-->
								<input id="txtTipoAnterior_refacciones_reclasificacion_refacciones" 
									   name="strTipoAnterior_refacciones_reclasificacion_refacciones" type="hidden" value="">
								</input>
								<label for="cmbTipo_refacciones_reclasificacion_refacciones">Tipo</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbTipo_refacciones_reclasificacion_refacciones" 
								 		name="strTipo_refacciones_reclasificacion_refacciones" tabindex="1">
                      				<option value="PLANTA">PLANTA</option>
                      				<option value="EMPRESA">EMPRESA</option>
                 				</select>
							</div>
						</div>
					</div>
				    <!--Clasificación-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar la clasificación anterior y así evitar duplicidad en caso de que exista otro registro con la misma clasificación en el tipo-->
								<input id="txtClasificacionAnterior_refacciones_reclasificacion_refacciones" 
									   name="strClasificacionAnterior_refacciones_reclasificacion_refacciones" 
									   type="hidden" value="">
								</input>
								<label for="txtClasificacion_refacciones_reclasificacion_refacciones">Clasificación</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtClasificacion_refacciones_reclasificacion_refacciones" 
										name="strClasificacion_refacciones_reclasificacion_refacciones" type="text" value="" 
										tabindex="1" placeholder="Ingrese clasificación" maxlength="1">
								</input>
							</div>
						</div>
					</div>
					<!--Mínimo-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtMinimo_refacciones_reclasificacion_refacciones">Mínimo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMinimo_refacciones_reclasificacion_refacciones" 
										name="intMinimo_refacciones_reclasificacion_refacciones" type="text" value="" 
										tabindex="1" placeholder="Ingrese mínimo" maxlength="11">
								</input>
							</div>
						</div>
					</div>
					<!--Máximo-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtMaximo_refacciones_reclasificacion_refacciones">Máximo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMaximo_refacciones_reclasificacion_refacciones" 
										name="intMaximo_refacciones_reclasificacion_refacciones" type="text" value="" 
										tabindex="1" placeholder="Ingrese máximo" maxlength="11">
								</input>
							</div>
						</div>
					</div>
					<!--Días de venta-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtDiasVenta_refacciones_reclasificacion_refacciones">Días de venta</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtDiasVenta_refacciones_reclasificacion_refacciones" 
										name="intDiasVenta_refacciones_reclasificacion_refacciones" type="text" value="" 
										tabindex="1" placeholder="Ingrese días de venta" maxlength="11">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-primary" id="btnGuardar_refacciones_reclasificacion_refacciones"
									onclick="validar_refacciones_reclasificacion_refacciones();"  
									title="Agregar" tabindex="1" disabled> 
								<span id="IconoBtnGuardar_refacciones_reclasificacion_refacciones" 
									  class="glyphicon glyphicon-plus"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_refacciones_reclasificacion_refacciones"
									onclick="reporte_refacciones_reclasificacion_refacciones('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_refacciones_reclasificacion_refacciones"
									onclick="reporte_refacciones_reclasificacion_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button>
						</div>
					</div>
			    </div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre de barra de herramientas-->
		<!--Estilo que se utiliza para mostrar los nombres de las columnas de la tabla en el dispositivo móvil -->
		<style>
			@media (max-width: 480px) 
			{
			    /*
				Definir columnas
				*/
				td.movil:nth-of-type(1):before {content: "Clasificación"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Mínimo"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Máximo"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Días venta"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_refacciones_reclasificacion_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Clasificación</th>
							<th class="movil">Mínimo</th>
							<th class="movil">Máximo</th>
							<th class="movil">Días de venta</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_refacciones_reclasificacion_refacciones" type="text/template">
					{{#rows}}
						<tr class="movil">    
							<td class="movil">{{clasificacion}}</td>
							<td class="movil">{{minimo}}</td>
							<td class="movil">{{maximo}}</td>
							<td class="movil">{{dias_venta}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_refacciones_reclasificacion_refacciones({{refacciones_reclasificacion_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="5"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_refacciones_reclasificacion_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_refacciones_reclasificacion_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
	</div><!--#RefaccionesReclasificacionRefaccionesContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaRefaccionesReclasificacionRefacciones = 0;
		var strUltimaBusquedaRefaccionesReclasificacionRefacciones = "";

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_refacciones_reclasificacion_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/refacciones_reclasificacion/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_refacciones_reclasificacion_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRefaccionesReclasificacionRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosRefaccionesReclasificacionRefacciones = strPermisosRefaccionesReclasificacionRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRefaccionesReclasificacionRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if((arrPermisosRefaccionesReclasificacionRefacciones[i]=='GUARDAR') || (arrPermisosRefaccionesReclasificacionRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_refacciones_reclasificacion_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesReclasificacionRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_refacciones_reclasificacion_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_refacciones_reclasificacion_refacciones();
						}
						else if(arrPermisosRefaccionesReclasificacionRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_refacciones_reclasificacion_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesReclasificacionRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_refacciones_reclasificacion_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_refacciones_reclasificacion_refacciones() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#cmbTipo_refacciones_reclasificacion_refacciones').val() != strUltimaBusquedaRefaccionesReclasificacionRefacciones)
			{
				intPaginaRefaccionesReclasificacionRefacciones = 0;
				strUltimaBusquedaRefaccionesReclasificacionRefacciones = $('#cmbTipo_refacciones_reclasificacion_refacciones').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/refacciones_reclasificacion/get_paginacion',
					{	strTipo:$('#cmbTipo_refacciones_reclasificacion_refacciones').val(),
						intPagina:intPaginaRefaccionesReclasificacionRefacciones,
						strPermisosAcceso: $('#txtAcciones_refacciones_reclasificacion_refacciones').val()
					},
					function(data){
						$('#dg_refacciones_reclasificacion_refacciones tbody').empty();
						var tmpRefaccionesReclasificacionRefacciones = Mustache.render($('#plantilla_refacciones_reclasificacion_refacciones').html(),data);
						$('#dg_refacciones_reclasificacion_refacciones tbody').html(tmpRefaccionesReclasificacionRefacciones);
						$('#pagLinks_refacciones_reclasificacion_refacciones').html(data.paginacion);
						$('#numElementos_refacciones_reclasificacion_refacciones').html(data.total_rows);
						intPaginaRefaccionesReclasificacionRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_refacciones_reclasificacion_refacciones(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/refacciones_reclasificacion/';

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
										'strTipo': $('#cmbTipo_refacciones_reclasificacion_refacciones').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		//Función para limpiar los campos del formulario
		function nuevo_refacciones_reclasificacion_refacciones()
		{
			//Incializar formulario
			$('#frmRefaccionesReclasificacionRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_reclasificacion_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmRefaccionesReclasificacionRefacciones').find('input[type=hidden]').val('');
			//Hacer los siguientes cambios en el botón Guardar para darle apariencia de un nuevo registro
			$('#btnGuardar_refacciones_reclasificacion_refacciones').prop('title', 'Agregar');
			//Agregar clase glyphicon-plus (para guardar nuevo registro)
			$('#IconoBtnGuardar_refacciones_reclasificacion_refacciones').addClass("glyphicon-plus");
			//Quitar clase glyphicon-pencil (para editar registro)
		    $('#IconoBtnGuardar_refacciones_reclasificacion_refacciones').removeClass("glyphicon-pencil");

		}
		
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_refacciones_reclasificacion_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_reclasificacion_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmRefaccionesReclasificacionRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strClasificacion_refacciones_reclasificacion_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba una clasificación'}
											}
										},
										intMinimo_refacciones_reclasificacion_refacciones: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                  	  //Asignar valor mínimo	
					                                      var intMinimoRefaccionesReclasificacionRefacciones = $('#txtMinimo_refacciones_reclasificacion_refacciones').val();
					                                      //Asignar valor máximo
					                                      var intMaximoRefaccionesReclasificacionRefacciones = $('#txtMaximo_refacciones_reclasificacion_refacciones').val();

					                                      //Verificar que el mínimo no sea mayor que el máximo
					                                      if(parseInt(intMinimoRefaccionesReclasificacionRefacciones) > parseInt(intMaximoRefaccionesReclasificacionRefacciones))
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El mínimo debe ser menor que el máximo'
					                                          };
					                                      }
					                                      else if(intMinimoRefaccionesReclasificacionRefacciones === '')//Verificar que exista el mínimo
					                                      {
					                                      	return {
					                                              valid: false,
					                                              message: 'Escriba un mínimo'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intMaximo_refacciones_reclasificacion_refacciones: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                  	  //Asignar valor mínimo	
					                                      var intMinimoRefaccionesReclasificacionRefacciones = $('#txtMinimo_refacciones_reclasificacion_refacciones').val();
					                                      //Asignar valor máximo
					                                      var intMaximoRefaccionesReclasificacionRefacciones = $('#txtMaximo_refacciones_reclasificacion_refacciones').val();

					                                      //Verificar que el máximo no sea menor que el mínimo
					                                      if(parseInt(intMinimoRefaccionesReclasificacionRefacciones) > parseInt(intMaximoRefaccionesReclasificacionRefacciones))
					                                      {
				                                      		return {
					                                              valid: false,
					                                              message: 'El máximo debe ser mayor que el mínimo'
					                                          };
					                                      }
					                                      else if(intMinimoRefaccionesReclasificacionRefacciones === '')//Verificar que exista el máximo
					                                      {
					                                      	return {
					                                              valid: false,
					                                              message: 'Escriba un máximo'
					                                          };
					                                      }
					                                      return true;
					                                  }
					                            }
											}
										},
										intDiasVenta_refacciones_reclasificacion_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba los días de venta'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_refacciones_reclasificacion_refacciones = $('#frmRefaccionesReclasificacionRefacciones').data('bootstrapValidator');
			bootstrapValidator_refacciones_reclasificacion_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_refacciones_reclasificacion_refacciones.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_refacciones_reclasificacion_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_refacciones_reclasificacion_refacciones()
		{
			try
			{
				$('#frmRefaccionesReclasificacionRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_refacciones_reclasificacion_refacciones()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/refacciones_reclasificacion/guardar',
					{ 
						intRefaccionesReclasificacionID: $('#txtRefaccionesReclasificacionID_refacciones_reclasificacion_refacciones').val(),
						strTipo: $('#cmbTipo_refacciones_reclasificacion_refacciones').val(),
						strTipoAnterior: $('#txtTipoAnterior_refacciones_reclasificacion_refacciones').val(),
						strClasificacion: $('#txtClasificacion_refacciones_reclasificacion_refacciones').val(),
						strClasificacionAnterior: $('#txtClasificacionAnterior_refacciones_reclasificacion_refacciones').val(),
						intMinimo: $('#txtMinimo_refacciones_reclasificacion_refacciones').val(),
						intMaximo: $('#txtMaximo_refacciones_reclasificacion_refacciones').val(),
						intDiasVenta: $('#txtDiasVenta_refacciones_reclasificacion_refacciones').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_refacciones_reclasificacion_refacciones();
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_refacciones_reclasificacion_refacciones();                 
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_refacciones_reclasificacion_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_refacciones_reclasificacion_refacciones(tipoMensaje, mensaje)
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

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_refacciones_reclasificacion_refacciones(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones_reclasificacion/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_refacciones_reclasificacion_refacciones();
				          	//Recuperar valores
				            $('#txtRefaccionesReclasificacionID_refacciones_reclasificacion_refacciones').val(data.row.refacciones_reclasificacion_id);
				            $('#cmbTipo_refacciones_reclasificacion_refacciones').val(data.row.tipo);
						    $('#txtTipoAnterior_refacciones_reclasificacion_refacciones').val(data.row.tipo);
				            $('#txtClasificacion_refacciones_reclasificacion_refacciones').val(data.row.clasificacion);
				            $('#txtClasificacionAnterior_refacciones_reclasificacion_refacciones').val(data.row.clasificacion);
				            $('#txtMinimo_refacciones_reclasificacion_refacciones').val(data.row.minimo);
				            $('#txtMaximo_refacciones_reclasificacion_refacciones').val(data.row.maximo);
				            $('#txtDiasVenta_refacciones_reclasificacion_refacciones').val(data.row.dias_venta);
				           	//Hacer los siguientes cambios en el botón Guardar para darle apariencia de un registro existente
				            $('#btnGuardar_refacciones_reclasificacion_refacciones').prop('title', 'Modificar');
				            //Quitar clase glyphicon-plus (para guardar nuevo registro)
				            $('#IconoBtnGuardar_refacciones_reclasificacion_refacciones').removeClass("glyphicon-plus");
				            //Agregar clase glyphicon-pencil (para editar registro)
				            $('#IconoBtnGuardar_refacciones_reclasificacion_refacciones').addClass("glyphicon-pencil");
				            //Si el tipo de acción corresponde a Editar
				            if(tipoAccion == 'Editar')
				            {
					            //Enfocar caja de texto
								$('#txtClasificacion_refacciones_reclasificacion_refacciones').focus();
					        }
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
			//Validar campo para introducir solamente letras
			$('#txtClasificacion_refacciones_reclasificacion_refacciones').letras();
			//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtMinimo_refacciones_reclasificacion_refacciones').numeric({decimal: false, negative: false});
        	$('#txtMaximo_refacciones_reclasificacion_refacciones').numeric({decimal: false, negative: false});
        	$('#txtDiasVenta_refacciones_reclasificacion_refacciones').numeric({decimal: false, negative: false});

			//Comprobar la existencia de la clasificación en la BD cuando pierda el enfoque la caja de texto
			$('#txtClasificacion_refacciones_reclasificacion_refacciones').focusout(function(e){
				//Si no existe id, verificar la existencia de la clasificación
				if ($('#txtRefaccionesReclasificacionID_refacciones_reclasificacion_refacciones').val() == '' && $('#txtClasificacion_refacciones_reclasificacion_refacciones').val() != '')
				{
					//Concatenar criterios de búsqueda (para poder verificar la existencia de la clasificación en el tipo)
					var strCriteriosBusqRefaccionesReclasificacionRefacciones = $('#cmbTipo_refacciones_reclasificacion_refacciones').val()+'|'+$('#txtClasificacion_refacciones_reclasificacion_refacciones').val();
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la clasificación 
					editar_refacciones_reclasificacion_refacciones(strCriteriosBusqRefaccionesReclasificacionRefacciones, 'clasificacion', 'Nuevo');
				}
			});

			//Realizar búsqueda de reclasificaciones cuando se cambie la opción del tipo
	        $('#cmbTipo_refacciones_reclasificacion_refacciones').change(function(e){
	        	//Hacer llamado a la función  para cargar los registros en el grid
				paginacion_refacciones_reclasificacion_refacciones();    
	        });

		    //Paginación de registros
			$('#pagLinks_refacciones_reclasificacion_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaRefaccionesReclasificacionRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_refacciones_reclasificacion_refacciones();
			});

			//Enfocar caja de texto
			$('#txtClasificacion_refacciones_reclasificacion_refacciones').focus();		
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_refacciones_reclasificacion_refacciones();
		});
	</script>