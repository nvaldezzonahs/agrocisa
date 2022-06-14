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
						<button class="btn btn-default"  id="btnImprimir_rep_rendimiento_gasolinas_control_vehiculos"
								onclick="reporte_rep_rendimiento_gasolinas_control_vehiculos();" title="Imprimir reporte general en PDF" 
								tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_rep_rendimiento_gasolinas_control_vehiculos"
								onclick="descargar_xls_rep_rendimiento_gasolinas_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
							<span class="fa fa-file-excel-o"></span>
						</button> 
					</div>
				</div>
			</div>
		</div><!--Cierre de barra de herramientas-->
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
		    <div class="row">
		    	<!--Tipo de reporte-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<label>Seleccione el tipo de reporte:</label>
					<div class="custom-control custom-radio">
						<input type="radio" 
						  	   class="custom-control-input" 
						  	   id="bgOpcion1_rep_rendimiento_gasolinas_control_vehiculos" 
						  	   name="strRadios_rep_rendimiento_gasolinas_control_vehiculos" id="rbtComparativoMensual" value="Comparativo"  checked />
						<label class="custom-control-label" for="bgOpcion1_rep_rendimiento_gasolinas_control_vehiculos">Comparativo mensual</label>
					</div>
					<div class="custom-control custom-radio">
						<input type="radio" 
						  	   class="custom-control-input" 
						  	   id="bgOpcion2_rep_rendimiento_gasolinas_control_vehiculos" 
						  	   name="strRadios_rep_rendimiento_gasolinas_control_vehiculos" id="rbtReporteMes" value="Mensual"  />
						<label class="custom-control-label" for="bgOpcion2_rep_rendimiento_gasolinas_control_vehiculos">Reporte mensual</label>
					</div>
				</div>	
		    </div>
		    <br/>
		    <div class="row">
		    	<!--Mes-->
				<div class="col-sm-8 col-md-8 col-lg-8 col-xs-8">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbMeses_rep_rendimiento_gasolinas_control_vehiculos">Seleccione mes:</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" 
									id="cmbMeses_rep_rendimiento_gasolinas_control_vehiculos" 
							 		name="strMeses_rep_rendimiento_gasolinas_control_vehiculos" 
									tabindex="1">
							 	<option value="01">ENERO</option>
                        		<option value="02">FEBRERO</option>
                        		<option value="03">MARZO</option>
                        		<option value="04">ABRIL</option>
                        		<option value="05">MAYO</option>
                        		<option value="06">JUNIO</option>
                        		<option value="07">JULIO</option>
                        		<option value="08">AGOSTO</option>
                        		<option value="09">SEPTIEMBRE</option>
                        		<option value="10">OCTUBRE</option>
                        		<option value="11">NOVIEMBRE</option>
                        		<option value="12">DICIEMBRE</option>
             				</select>
						</div>	
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtAnio_rep_rendimiento_gasolinas_control_vehiculos">Seleccione año:</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtAnio_rep_rendimiento_gasolinas_control_vehiculos" 
									name="intAnio_rep_rendimiento_gasolinas_control_vehiculos" type="number" value="2018" />
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
	function permisos_rep_rendimiento_gasolinas_control_vehiculos()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('control_vehiculos/rep_rendimiento_gasolinas/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_rendimiento_gasolinas_control_vehiculos').val()
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
						$('#btnImprimir_rep_rendimiento_gasolinas_control_vehiculos').removeAttr('disabled');
					}
					else if(arrPermisosRepVigenciasControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_rendimiento_gasolinas_control_vehiculos').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para cargar el reporte general en PDF
	function reporte_rep_rendimiento_gasolinas_control_vehiculos() 
	{
		
		//Validamos que se encuentre seleccionado un año
		if( $('#txtAnio_rep_rendimiento_gasolinas_control_vehiculos').val() == '' ){
			$('#txtAnio_rep_rendimiento_gasolinas_control_vehiculos').focus();
		}
		else{

			var tipoReporte = $("input:radio[name='strRadios_rep_rendimiento_gasolinas_control_vehiculos']:checked").val();	
			var mes = $('#cmbMeses_rep_rendimiento_gasolinas_control_vehiculos').val();
			var anio = $('#txtAnio_rep_rendimiento_gasolinas_control_vehiculos').val();
			
			//Verificamos que tipo de reporte queremos generar
			window.open("control_vehiculos/rep_rendimiento_gasolinas/get_reporte/" + tipoReporte + "/" + mes + "/" + anio);
			
		}

	}

	//Función para descargar el reporte general en XLS
	function descargar_xls_rep_rendimiento_gasolinas_control_vehiculos() 
	{
		//Validamos que se encuentre seleccionado un año
		if( $('#txtAnio_rep_rendimiento_gasolinas_control_vehiculos').val() == '' ){
			$('#txtAnio_rep_rendimiento_gasolinas_control_vehiculos').focus();
		}
		else{

			var tipoReporte = $("input:radio[name='strRadios_rep_rendimiento_gasolinas_control_vehiculos']:checked").val();	
			var mes = $('#cmbMeses_rep_rendimiento_gasolinas_control_vehiculos').val();
			var anio = $('#txtAnio_rep_rendimiento_gasolinas_control_vehiculos').val();
			
			//Verificamos que tipo de reporte queremos generar
			window.open("control_vehiculos/rep_rendimiento_gasolinas/get_xls/" + tipoReporte + "/" + mes + "/" + anio);
			
		}

	}

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{	
		/********************************************************************************************************************
		Controles correspondientes al formulario
		*********************************************************************************************************************/ 
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_rep_rendimiento_gasolinas_control_vehiculos();

	});
</script>