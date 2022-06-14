<div id="RepEstadisticasRefaccionesContent">  
	<!--Diseño del formulario-->
	<form id="frmRepEstadisticasRefacciones" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepEstadisticasRefacciones" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_rep_estadisticas_refacciones"
								onclick="validar_rep_estadisticas_refacciones('PDF');" 
								title="Imprimir reporte general en PDF" 
								tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_rep_estadisticas_refacciones"
								onclick="validar_rep_estadisticas_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
							<label for="txtFechaInicial_rep_estadisticas_refacciones">Fecha inicial</label>
						</div>
						<div id="divFechaMsjValidacion" class="col-md-12">
							<div class='input-group date' id='dteFechaInicial_rep_estadisticas_refacciones'>
			                    <input class="form-control" 
			                    		id="txtFechaInicial_rep_estadisticas_refacciones"
			                    		name= "strFechaInicial_rep_estadisticas_refacciones" 
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
							<label for="txtFechaFinal_rep_estadisticas_refacciones">Fecha final</label>
						</div>
						<div id="divFechaMsjValidacion" class="col-md-12">
							<div class='input-group date' id='dteFechaFinal_rep_estadisticas_refacciones'>
			                    <input class="form-control" 
			                    		id="txtFechaFinal_rep_estadisticas_refacciones"
			                    		name= "strFechaFinal_rep_estadisticas_refacciones" 
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
		    	<!--Lista de sucursales activas a las que tiene acceso el usuario-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label>Sucursales:</label>
						</div>
						<div class="col-md-12" id="chkSucursales_rep_estadisticas_refacciones"></div>
					</div>	
				</div>		
			</div>	
		</div><!--Cierre del contenedor del formulario-->
	</form><!--Cierre del formulario-->
</div><!--#RepEstadisticasRefaccionesContent -->


<!-- /.Plantilla para cargar las sucursales-->  
<script id="sucursales_rep_estadisticas_refacciones" type="text/template">
	{{#sucursales}}
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="chkSucursal{{value}}_rep_estadisticas_refacciones" 
	  		 name="chkSucursales_rep_estadisticas_refacciones[]" value="{{value}}" checked>
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
	function permisos_rep_estadisticas_refacciones()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('refacciones/rep_estadisticas/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_estadisticas_refacciones').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepEstadisticasRefacciones = data.row;
				//Separar la cadena 
				var arrPermisosRepEstadisticasRefacciones = strPermisosRepEstadisticasRefacciones.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepEstadisticasRefacciones.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepEstadisticasRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_estadisticas_refacciones').removeAttr('disabled');
					}
					else if(arrPermisosRepEstadisticasRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_estadisticas_refacciones').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}
	

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_rep_estadisticas_refacciones(strTipo)
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_rep_estadisticas_refacciones();
		//Validación del formulario de campos obligatorios
		$('#frmRepEstadisticasRefacciones')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strFechaInicial_rep_estadisticas_refacciones: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha'}
										}
									},
									strFechaFinal_rep_estadisticas_refacciones: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha'}
										}
									}
								}
			});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_rep_estadisticas_refacciones = $('#frmRepEstadisticasRefacciones').data('bootstrapValidator');
		bootstrapValidator_rep_estadisticas_refacciones.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_rep_estadisticas_refacciones.isValid())
		{
			//Arreglo para obtener sucursales seleccionadas
			var chkSucursalesArray = [];
			chkSucursalesArray = sucursales_seleccionadas_rep_estadisticas_refacciones();
			//Verificamos que al menos se encuentre una sucursal seleccionada
			if(chkSucursalesArray.length > 0)
			{
				//Array que se utiliza para agregar sucursales
				var arrSucursales = chkSucursalesArray.join('|');

				//Hacer un llamado a la función para generar el reporte
				reporte_rep_estadisticas_refacciones(arrSucursales, strTipo);
				
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
	function limpiar_mensajes_rep_estadisticas_refacciones()
	{
		try
		{
			$('#frmRepEstadisticasRefacciones').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}


	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_rep_estadisticas_refacciones(arrSucursales, strTipo)
	{

	 	//Variable que se utiliza para asignar URL (ruta del controlador)
        var strUrl = 'refacciones/rep_estadisticas/';

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
                                    'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_rep_estadisticas_refacciones').val()),
                                    'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_estadisticas_refacciones').val()),
                                    'arrSucursales': arrSucursales           
                                 }
                       };


        //Hacer un llamado a la función para imprimir/descargar el reporte
        $.imprimirReporte(objReporte);
	}


	//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
	function cargar_sucursales_rep_estadisticas_refacciones()
	{
		//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
		$.post('administracion/sucursales/get_combo_box/home', {},
			function(data)
			{
				$('#chkSucursales_rep_estadisticas_refacciones').empty();
				var temp = Mustache.render($('#sucursales_rep_estadisticas_refacciones').html(), data)
				$('#chkSucursales_rep_estadisticas_refacciones').html(temp);
			},
			'json');
	}

	//Función para obtener las Sucursales seleccionadas
	function sucursales_seleccionadas_rep_estadisticas_refacciones()
	{
		//Declaramos el arreglo que contendrá las sucursales seleccionadas
		var chkSucursalesArray = [];
		
		//Buscamos todos los checkboxes seleccionados
		$('[name="chkSucursales_rep_estadisticas_refacciones[]"]:checked').each(function() {
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
		$('#dteFechaInicial_rep_estadisticas_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaFinal_rep_estadisticas_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

        //Hacer un llamado a la función para obtener los permisos de acceso
		permisos_rep_estadisticas_refacciones();
        //Hacer un llamado a la función para cargar sucursales y armar los checklist
  		cargar_sucursales_rep_estadisticas_refacciones();
	});

</script>	