<div id="RepInventarioMercadotecniaContent">  
	<!--Diseño del formulario-->
	<form id="frmRepInventarioMercadotecnia" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepInventarioMercadotecnia" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_inventario_mercadotecnia"
								onclick="reporte_inventario_mercadotecnia();" 
								title="Imprimir reporte en PDF" 
								tabindex="1">
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  
								id="btnDescargarXLS_inventario_mercadotecnia"
								onclick="descargar_xls_inventario_mercadotecnia();" 
								title="Descargar reporte en XLS" tabindex="1">
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
							<label for="txtFechaCorte_rep_inventario_mercadotecnia">Fecha de corte</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaCorte_rep_inventario_mercadotecnia'>
			                    <input class="form-control" 
			                    		id="txtFechaCorte_rep_inventario_mercadotecnia"
			                    		name= "strFechaCorte_rep_inventario_mercadotecnia" 
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
		</div>
	</form>
</div><!--#RepInventarioMercadotecniaContent -->

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">
	
	/*******************************************************************************************************************
	Funciones del formulario
	*********************************************************************************************************************/
	//Variable que se utilizan para la búsqueda de registros
	var dteFechaCorteInventarioMercadotecnia = "";

	//Función para crear el reporte PDF
	function reporte_inventario_mercadotecnia(){
		
		//Validar que se encuentre una fecha seleccionada	
		if($('#txtFechaCorte_rep_inventario_mercadotecnia').val() != ''){
			
			//Hacer un llamado al método del controlador para generar reporte PDF
			dteFechaCorteInventarioMercadotecnia =  $.formatFechaMysql($('#txtFechaCorte_rep_inventario_mercadotecnia').val());
			window.open("mercadotecnia/rep_inventario/get_reporte/"+dteFechaCorteInventarioMercadotecnia );
		}
		else{
			$('#txtFechaCorte_rep_inventario_mercadotecnia').focus();	
		}
	
	}

	//Función para descargar el reporte en XLS
	function descargar_xls_inventario_mercadotecnia() {
			//Validar que se encuentre una fecha seleccionada	
		if($('#txtFechaCorte_rep_inventario_mercadotecnia').val() != ''){
			
			//Hacer un llamado al método del controlador para generar reporte PDF
			dteFechaCorteInventarioMercadotecnia =  $.formatFechaMysql($('#txtFechaCorte_rep_inventario_mercadotecnia').val());
			window.open("mercadotecnia/rep_inventario/get_xls/"+dteFechaCorteInventarioMercadotecnia );
		}
		else{
			$('#txtFechaCorte_rep_inventario_mercadotecnia').focus();	
		}
		
	}	

	

	$(document).ready(function() 
	{	

		/*******************************************************************************************************************
		Controles correspondientes al formulario
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaCorte_rep_inventario_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});

	});

</script>				