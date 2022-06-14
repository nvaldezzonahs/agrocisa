	<div id="RepListadoPolizasContabilidadContent">  
		<!--Diseño del formulario-->
		<form id="frmRepListadoPolizasContabilidad" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepListadoPolizasContabilidad" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_listado_polizas_contabilidad"
									onclick="validar_rep_listado_polizas_contabilidad('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_listado_polizas_contabilidad"
									onclick="validar_rep_listado_polizas_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaInicial_rep_listado_polizas_contabilidad">Fecha inicial</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_listado_polizas_contabilidad'>
				                    <input class="form-control" 
				                    		id="txtFechaInicial_rep_listado_polizas_contabilidad"
				                    		name= "strFechaInicial_rep_listado_polizas_contabilidad" 
				                    		type="text"  value="" tabindex="1" 
				                    		placeholder="Ingrese fecha" maxlength="10"/>
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
								<label for="txtFechaFinal_rep_listado_polizas_contabilidad">Fecha final</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_listado_polizas_contabilidad'>
				                    <input class="form-control" 
				                    		id="txtFechaFinal_rep_listado_polizas_contabilidad"
				                    		name= "strFechaFinal_rep_listado_polizas_contabilidad" 
				                    		type="text" value="" tabindex="1" 
				                    		placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>	
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			    		<div class="form-group">
							<div class="col-md-12">
								
								<label for="txtFolioInicial_rep_listado_polizas_contabilidad">Folio inicial</label>
							</div>
							<div class="col-md-12">
								<input class="form-control" id="txtFolioInicial_rep_listado_polizas_contabilidad" name="strFolioInicial_rep_listado_polizas_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese folio" maxlength="10">
								
							</div>
						</div>
			    	</div>
			    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			    		<div class="form-group">
							<div class="col-md-12">
								
								<label for="txtFolioFinal_rep_listado_polizas_contabilidad">Folio final</label>
							</div>
							<div class="col-md-12">
								<input class="form-control" id="txtFolioFinal_rep_listado_polizas_contabilidad" name="strFolioFinal_rep_listado_polizas_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese folio" maxlength="10">
								
							</div>
						</div>
			    	</div>
			    </div>
			    <div class="row">
					<!--Tipo-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipo_rep_listado_polizas_contabilidad">Tipo de póliza</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbTipo_rep_listado_polizas_contabilidad" 
									 		name="strTipoPoliza_rep_listado_polizas_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="DIARIO">DIARIO</option>
                          				<option value="INGRESO">INGRESO</option>
                          				<option value="EGRESO">EGRESO</option>
                     				</select>
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
							<div class="col-md-12" id="chkSucursales_rep_listado_polizas_contabilidad"></div>
						</div>	
					</div>
				</div>    
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepListadoPolizasContabilidadContent-->
	<!-- /.Plantilla para cargar las sucursales-->  
	<script id="sucursales_rep_listado_polizas_contabilidad" type="text/template">
		{{#sucursales}}
		<div class="form-check form-check-inline">
		  <input class="form-check-input-chk" type="checkbox" id="chkSucursal{{value}}_rep_listado_polizas_contabilidad" 
		  		 name="chkSucursales_rep_listado_polizas_contabilidad[]" value="{{value}}" checked>
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
		function permisos_rep_listado_polizas_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/rep_listado_polizas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_listado_polizas_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepListadoPolizasContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosRepListadoPolizasContabilidad = strPermisosRepListadoPolizasContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepListadoPolizasContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepListadoPolizasContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_listado_polizas_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosRepListadoPolizasContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_listado_polizas_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}


		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_listado_polizas_contabilidad(strTipo)
		{
			//Arreglo para obtener sucursales seleccionadas
			var chkSucursalesArray = [];
			chkSucursalesArray = sucursales_seleccionadas_rep_listado_polizas_contabilidad();

			//Verificamos que al menos se encuentre una sucursal
			if(chkSucursalesArray.length > 0 )
			{
				//Array que se utiliza para agregar sucursales
				var arrSucursales = chkSucursalesArray.join('|');

				//Hacer un llamado a la función para generar reporte en PDF/XLS
				reporte_rep_listado_polizas_contabilidad(strTipo, arrSucursales);
				
			}
			else
			{
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog('Es necesario seleccionar al menos una sucursal.',
								   {'type': 'error', 
								   'title': 'Error'});
			}

		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_listado_polizas_contabilidad(strTipo, arrSucursales) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/rep_listado_polizas/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_rep_listado_polizas_contabilidad').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_listado_polizas_contabilidad').val()),
										'strFolioInicial': $('#txtFolioInicial_rep_listado_polizas_contabilidad').val(),
										'strFolioFinal': $('#txtFolioFinal_rep_listado_polizas_contabilidad').val(),
										'strTipoPoliza': $('#cmbTipo_rep_listado_polizas_contabilidad').val(),
										'strSucursales': arrSucursales

									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		
		//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
		function cargar_sucursales_rep_listado_polizas_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box/home', {},
				function(data)
				{
					$('#chkSucursales_rep_listado_polizas_contabilidad').empty();
					var temp = Mustache.render($('#sucursales_rep_listado_polizas_contabilidad').html(), data)
					$('#chkSucursales_rep_listado_polizas_contabilidad').html(temp);
				},
				'json');
		}


		//Función para obtener las sucursales seleccionadas
		function sucursales_seleccionadas_rep_listado_polizas_contabilidad(){

			//Declaramos el arreglo  que contendrá las sucursales seleccionadas
			var chkSucursalesArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkSucursales_rep_listado_polizas_contabilidad[]"]:checked').each(function() {
				chkSucursalesArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkSucursalesArray.join('|');
			
			//Regresar array con las sucursales seleccionadas
			return chkSucursalesArray;

		}


		//Controles o Eventos del Modal
		$(document).ready(function() {
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicial_rep_listado_polizas_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_listado_polizas_contabilidad').datetimepicker({format: 'DD/MM/YYYY', 
																				 useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_listado_polizas_contabilidad').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_listado_polizas_contabilidad').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_listado_polizas_contabilidad').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_listado_polizas_contabilidad').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un folio de póliza 
	        $('#txtFolioInicial_rep_listado_polizas_contabilidad').autocomplete({
	            source: function( request, response ) {
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/polizas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intSucursalID: $('#cmbSucursalID_rep_listado_polizas_contabilidad').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Autocomplete para recuperar los datos de un folio de póliza 
	        $('#txtFolioFinal_rep_listado_polizas_contabilidad').autocomplete({
	            source: function( request, response ) {
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/polizas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intSucursalID: $('#cmbSucursalID_rep_listado_polizas_contabilidad').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_listado_polizas_contabilidad();
			//Hacer un llamado a la función para cargar sucursales y armar los checklist
  			cargar_sucursales_rep_listado_polizas_contabilidad();

		});
	</script>
	