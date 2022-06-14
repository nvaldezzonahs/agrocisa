<div id="RepMovimientoInsumosMercadotecniaContent">  
	<!--Diseño del formulario-->
	<form id="frmRepMovimientoInsumosMercadotecnia" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepMovimientoInsumosMercadotecnia" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_movimiento_insumos_mercadotecnia"
								onclick="reporte_movimiento_insumos_mercadotecnia();" 
								title="Imprimir reporte en PDF" 
								tabindex="1">
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  
								id="btnDescargarXLS_movimiento_insumos_mercadotecnia"
								onclick="descargar_xls_movimiento_insumos_mercadotecnia();" 
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
				<!--Insumo-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
							<input id="txtInsumoID_rep_movimiento_insumos_mercadotecnia" 
								   name="intInsumoID_rep_movimiento_insumos_mercadotecnia" 
								   type="hidden" value="" />	
							<label for="txtInsumo_rep_movimiento_insumos_mercadotecnia">Insumo</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtInsumo_rep_movimiento_insumos_mercadotecnia" 
									name="strInsumo_rep_movimiento_insumos_mercadotecnia" type="text" value="" 
									placeholder="Ingrese descripción de insumo" />
						</div>
					</div>
				</div>
			</div>	
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicial_rep_movimiento_insumos_mercadotecnia">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicial_rep_movimiento_insumos_mercadotecnia'>
			                    <input class="form-control" 
			                    		id="txtFechaInicial_rep_movimiento_insumos_mercadotecnia"
			                    		name= "strFechaInicial_rep_movimiento_insumos_mercadotecnia" 
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
							<label for="txtFechaFinal_rep_movimiento_insumos_mercadotecnia">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinal_rep_movimiento_insumos_mercadotecnia'>
			                    <input class="form-control" 
			                    		id="txtFechaFinal_rep_movimiento_insumos_mercadotecnia"
			                    		name= "strFechaFinal_rep_movimiento_insumos_mercadotecnia" 
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
</div><!--#RepMovimientoInsumosMercadotecniaContent -->

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*******************************************************************************************************************/
	//Variable que se utilizan para la búsqueda de registros
	var intInsumoIDMovimientoInsumosMercadotecnia = "";
	var dteFechaInicialMovimientoInsumosMercadotecnia = "";
	var dteFechaFinalMovimientoInsumosMercadotecnia = "";

	//Función para crear el reporte en PDF de movimientos de un insumo
	function reporte_movimiento_insumos_mercadotecnia(){
		
		//Validar los elementos para el reporte cuenten con información
		if($('#txtInsumoID_rep_movimiento_insumos_mercadotecnia').val() == ''){
			$('#txtInsumo_rep_movimiento_insumos_mercadotecnia').focus();	
			return;
		}	
		if($('#txtFechaInicial_rep_movimiento_insumos_mercadotecnia').val() == ''){
			$('#txtFechaInicial_rep_movimiento_insumos_mercadotecnia').focus();	
			return;
		}
		if($('#txtFechaFinal_rep_movimiento_insumos_mercadotecnia').val() == ''){
			$('#txtFechaFinal_rep_movimiento_insumos_mercadotecnia').focus();
			return;	
		}

		if($('#txtFechaInicial_rep_movimiento_insumos_mercadotecnia').val() != '' &&
			$('#txtFechaFinal_rep_movimiento_insumos_mercadotecnia').val() != ''){

			//Hacer un llamado al método del controlador para generar reporte PDF
			intInsumoIDMovimientoInsumosMercadotecnia = $('#txtInsumoID_rep_movimiento_insumos_mercadotecnia').val();
			dteFechaInicialMovimientoInsumosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicial_rep_movimiento_insumos_mercadotecnia').val());
			dteFechaFinalMovimientoInsumosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinal_rep_movimiento_insumos_mercadotecnia').val());

			window.open("mercadotecnia/rep_movimiento_insumos/get_reporte/"
						+intInsumoIDMovimientoInsumosMercadotecnia+"/"
						+dteFechaInicialMovimientoInsumosMercadotecnia+"/"
						+dteFechaFinalMovimientoInsumosMercadotecnia);

		}		
	
	}

	//Función para descargar el reporte en XLS
	function descargar_xls_movimiento_insumos_mercadotecnia() {
		
		//Validar los elementos para el reporte cuenten con información
		if($('#txtInsumoID_rep_movimiento_insumos_mercadotecnia').val() == ''){
			$('#txtInsumo_rep_movimiento_insumos_mercadotecnia').focus();	
			return;
		}	
		if($('#txtFechaInicial_rep_movimiento_insumos_mercadotecnia').val() == ''){
			$('#txtFechaInicial_rep_movimiento_insumos_mercadotecnia').focus();	
			return;
		}
		if($('#txtFechaFinal_rep_movimiento_insumos_mercadotecnia').val() == ''){
			$('#txtFechaFinal_rep_movimiento_insumos_mercadotecnia').focus();
			return;	
		}

		if($('#txtFechaInicial_rep_movimiento_insumos_mercadotecnia').val() != '' &&
			$('#txtFechaFinal_rep_movimiento_insumos_mercadotecnia').val() != ''){

			//Hacer un llamado al método del controlador para generar reporte PDF
			intInsumoIDMovimientoInsumosMercadotecnia = $('#txtInsumoID_rep_movimiento_insumos_mercadotecnia').val();
			dteFechaInicialMovimientoInsumosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicial_rep_movimiento_insumos_mercadotecnia').val());
			dteFechaFinalMovimientoInsumosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinal_rep_movimiento_insumos_mercadotecnia').val());

			window.open("mercadotecnia/rep_movimiento_insumos/get_xls/"
						+intInsumoIDMovimientoInsumosMercadotecnia+"/"
						+dteFechaInicialMovimientoInsumosMercadotecnia+"/"
						+dteFechaFinalMovimientoInsumosMercadotecnia);

		}
		
	}	

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{

		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicial_rep_movimiento_insumos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaFinal_rep_movimiento_insumos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});

		//Autocomplete para recuperar los datos de una encuesta 
        $('#txtInsumo_rep_movimiento_insumos_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtInsumoID_rep_movimiento_insumos_mercadotecnia').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "mercadotecnia/insumos/autocomplete",
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

             $('#txtInsumoID_rep_movimiento_insumos_mercadotecnia').val(ui.item.insumo_id);
             $('#txtInsumo_rep_movimiento_insumos_mercadotecnia').val(ui.item.value);

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

</script>	