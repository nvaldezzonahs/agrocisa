<div id="RepVentasMercadotecniaContent">  
	<!--Diseño del formulario-->
	<form id="frmRepVentasMercadotecnia" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepVentasMercadotecnia" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_ventas_mercadotecnia"
								onclick="reporte_ventas_mercadotecnia();" 
								title="Imprimir reporte en PDF" 
								tabindex="1">
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  
								id="btnDescargarXLS_ventas_mercadotecnia"
								onclick="descargar_xls_ventas_mercadotecnia();" 
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
							<label for="txtFechaInicial_rep_ventas_mercadotecnia">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicial_rep_ventas_mercadotecnia'>
			                    <input class="form-control" 
			                    		id="txtFechaInicial_rep_ventas_mercadotecnia"
			                    		name= "strFechaInicial_rep_ventas_mercadotecnia" 
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
							<label for="txtFechaFinal_rep_ventas_mercadotecnia">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinal_rep_ventas_mercadotecnia'>
			                    <input class="form-control" 
			                    		id="txtFechaFinal_rep_ventas_mercadotecnia"
			                    		name= "strFechaFinal_rep_ventas_mercadotecnia" 
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
				<!--Módulo-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
							<input id="txtModuloID_rep_ventas_mercadotecnia" 
								   name="intModuloID_rep_ventas_mercadotecnia" 
								   type="hidden" value="" />	
							<label for="txtModulo_rep_ventas_mercadotecnia">Módulo</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtModulo_rep_ventas_mercadotecnia" 
									name="strModulo_rep_ventas_mercadotecnia" type="text" value="" 
									placeholder="Ingrese módulo" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div><!--#RepVentasMercadotecniaContent -->

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*******************************************************************************************************************/
	//Variable que se utilizan para la búsqueda de registros
	var intModuloIDVentasMercadotecnia = "";
	var dteFechaInicialVentasMercadotecnia = "";
	var dteFechaFinalVentasMercadotecnia = "";

	//Función para crear el reporte en PDF de movimientos de un Modulo
	function reporte_ventas_mercadotecnia(){
		
		//Validar los elementos para el reporte cuenten con información	
		if($('#txtFechaInicial_rep_ventas_mercadotecnia').val() == ''){
			$('#txtFechaInicial_rep_ventas_mercadotecnia').focus();	
			return;
		}
		if($('#txtFechaFinal_rep_ventas_mercadotecnia').val() == ''){
			$('#txtFechaFinal_rep_ventas_mercadotecnia').focus();
			return;	
		}
		if($('#txtModuloID_rep_ventas_mercadotecnia').val() == ''){
			$('#txtModulo_rep_ventas_mercadotecnia').focus();	
			return;
		}

		if($('#txtFechaInicial_rep_ventas_mercadotecnia').val() != '' &&
			$('#txtFechaFinal_rep_ventas_mercadotecnia').val() != ''){

			//Hacer un llamado al método del controlador para generar reporte PDF
			intModuloIDVentasMercadotecnia = $('#txtModuloID_rep_ventas_mercadotecnia').val();
			dteFechaInicialVentasMercadotecnia =  $.formatFechaMysql($('#txtFechaInicial_rep_ventas_mercadotecnia').val());
			dteFechaFinalVentasMercadotecnia =  $.formatFechaMysql($('#txtFechaFinal_rep_ventas_mercadotecnia').val());

			window.open("mercadotecnia/rep_ventas/get_reporte/"
						+dteFechaInicialVentasMercadotecnia+"/"
						+dteFechaFinalVentasMercadotecnia+"/"
						+intModuloIDVentasMercadotecnia);

		}		
	
	}

	//Función para descargar el reporte en XLS
	function descargar_xls_ventas_mercadotecnia() {
		
		//Validar los elementos para el reporte cuenten con información	
		if($('#txtFechaInicial_rep_ventas_mercadotecnia').val() == ''){
			$('#txtFechaInicial_rep_ventas_mercadotecnia').focus();	
			return;
		}
		if($('#txtFechaFinal_rep_ventas_mercadotecnia').val() == ''){
			$('#txtFechaFinal_rep_ventas_mercadotecnia').focus();
			return;	
		}
		if($('#txtModuloID_rep_ventas_mercadotecnia').val() == ''){
			$('#txtModulo_rep_ventas_mercadotecnia').focus();	
			return;
		}

		if($('#txtFechaInicial_rep_ventas_mercadotecnia').val() != '' &&
			$('#txtFechaFinal_rep_ventas_mercadotecnia').val() != ''){

			//Hacer un llamado al método del controlador para generar reporte PDF
			intModuloIDVentasMercadotecnia = $('#txtModuloID_rep_ventas_mercadotecnia').val();
			dteFechaInicialVentasMercadotecnia =  $.formatFechaMysql($('#txtFechaInicial_rep_ventas_mercadotecnia').val());
			dteFechaFinalVentasMercadotecnia =  $.formatFechaMysql($('#txtFechaFinal_rep_ventas_mercadotecnia').val());

			window.open("mercadotecnia/rep_ventas/get_xls/"
						+dteFechaInicialVentasMercadotecnia+"/"
						+dteFechaFinalVentasMercadotecnia+"/"
						+intModuloIDVentasMercadotecnia);

		}
		
	}	

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{

		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicial_rep_ventas_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaFinal_rep_ventas_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});

		//Autocomplete para recuperar los datos de una encuesta 
        $('#txtModulo_rep_ventas_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtModuloID_rep_ventas_mercadotecnia').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "crm/modulos/autocomplete",
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

             $('#txtModuloID_rep_ventas_mercadotecnia').val(ui.item.data);
             $('#txtModulo_rep_ventas_mercadotecnia').val(ui.item.value);

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