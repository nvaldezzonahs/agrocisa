<div id="RepPresupuestosVentasMaquinariaContent">  
	<!--Diseño del formulario-->
	<form id="frmRepPresupuestosVentasMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepPresupuestosVentasMaquinaria" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_rep_presupuestos_ventas_maquinaria"
								onclick="descargar_xls_rep_presupuestos_ventas_maquinaria();" title="Descargar reporte general en XLS" tabindex="1" disabled>
							<span class="fa fa-file-excel-o"></span>
						</button> 
					</div>
				</div>
			</div>
		</div><!--Cierre de barra de herramientas-->
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
		    <div class="row">
		    	<!--Año-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtAnio_rep_presupuestos_ventas_maquinaria">Año</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtAnio_rep_presupuestos_ventas_maquinaria" 
									name="strAnio_rep_presupuestos_ventas_maquinaria" type="number" value=""
									tabindex="1" placeholder="Ingrese año" maxlength="4" />
						</div>
					</div>
				</div>
			</div>
		</div><!--Cierre del contenedor del formulario--> 
	</form><!--Cierre del formulario-->
</div><!--#RepPresupuestosVentasMaquinariaContent -->

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">
	/*******************************************************************************************************************
	Funciones del formulario
	*********************************************************************************************************************/
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_presupuestos_ventas_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('maquinaria/rep_presupuestos_ventas/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_presupuestos_ventas_maquinaria').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepPresupuestosVentasMaquinaria = data.row;
				//Separar la cadena 
				var arrPermisosRepPresupuestosVentasMaquinaria = strPermisosRepPresupuestosVentasMaquinaria.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepPresupuestosVentasMaquinaria.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepPresupuestosVentasMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_presupuestos_ventas_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosRepPresupuestosVentasMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_presupuestos_ventas_maquinaria').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para descargar el reporte general en XLS
	function descargar_xls_rep_presupuestos_ventas_maquinaria() 
	{
		//Asignar valores para la búsqueda de registros
		var intAnio = $('#txtAnio_rep_presupuestos_ventas_maquinaria').val();
		//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
     	window.open("maquinaria/rep_presupuestos_ventas/get_xls/" + intAnio);

	}

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{	
		/********************************************************************************************************************
		Controles correspondientes al formulario
		*********************************************************************************************************************/
		//Asignar el año actual
       	$('#txtAnio_rep_presupuestos_ventas_maquinaria').val(anioActual()); 
       	//Validar campos númericos (solamente valores enteros y positivos)
       	$('#txtAnio_rep_presupuestos_ventas_maquinaria').numeric({decimal: false, negative: false});
		//Deshabilitar los siguientes botones (funciones de permisos de acceso)
		$('#btnImprimir_rep_presupuestos_ventas_maquinaria').attr('disabled','-1');		
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_rep_presupuestos_ventas_maquinaria();

	});
</script>