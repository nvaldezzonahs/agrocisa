<div id="RepVigenciasControlVehiculosContent">  
	<!--Diseño del formulario-->
	<form id="frmRepVigenciasControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepVigenciasControlVehiculos" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_rep_vigencias_control_vehiculos"
								onclick="reporte_rep_vigencias_control_vehiculos();" title="Imprimir reporte general en PDF" 
								tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_rep_vigencias_control_vehiculos"
								onclick="descargar_xls_rep_vigencias_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
							<span class="fa fa-file-excel-o"></span>
						</button> 
					</div>
				</div>
			</div>
		</div><!--Cierre de barra de herramientas-->
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
		    <div class="row">
		    	<!--Tipo-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbTipo_rep_vigencias_control_vehiculos">Tipo</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbTipo_rep_vigencias_control_vehiculos" 
							 		name="strTipo_rep_vigencias_control_vehiculos" tabindex="1">
							 	<option value="LICENCIAS">LICENCIAS</option>
                        		<option value="POLIZAS">PÓLIZAS DE SEGURO</option>
                        		<option value="VERIFICACIONES">VERIFICACIONES</option>
             				</select>
						</div>
					</div>
				</div>
			</div>
		</div><!--Cierre del contenedor del formulario--> 
	</form><!--Cierre del formulario-->
</div><!--#RepVigenciasControlVehiculosContent -->

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">
	/*******************************************************************************************************************
	Funciones del formulario
	*********************************************************************************************************************/
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_vigencias_control_vehiculos()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('control_vehiculos/rep_vigencias/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_vigencias_control_vehiculos').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepVigenciasControlVehiculos = data.row;
				//Separar la cadena 
				var arrPermisosRepVigenciasControlVehiculos = strPermisosRepVigenciasControlVehiculos.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepVigenciasControlVehiculos.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepVigenciasControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_vigencias_control_vehiculos').removeAttr('disabled');
					}
					else if(arrPermisosRepVigenciasControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_vigencias_control_vehiculos').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para cargar el reporte general en PDF
	function reporte_rep_vigencias_control_vehiculos() 
	{
		var strTipo = $('#cmbTipo_rep_vigencias_control_vehiculos').val();
		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("control_vehiculos/rep_vigencias/get_reporte/" + strTipo);
		
	}

	//Función para descargar el reporte general en XLS
	function descargar_xls_rep_vigencias_control_vehiculos() 
	{
		//Asignar valores para la búsqueda de registros
		var strTipo = $('#cmbTipo_rep_vigencias_control_vehiculos').val();
		//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
     	window.open("control_vehiculos/rep_vigencias/get_xls/" + strTipo);

	}

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{	
		/********************************************************************************************************************
		Controles correspondientes al formulario
		*********************************************************************************************************************/
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_rep_vigencias_control_vehiculos();

	});
</script>