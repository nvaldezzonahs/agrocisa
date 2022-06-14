<div id="RepInventarioHerramientasInventariosFisicosContent">  
	<!--Diseño del formulario-->
	<form id="frmRepInventarioHerramientasInventariosFisicos" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepInventarioHerramientasInventariosFisicos" onsubmit="return(false)" autocomplete="off">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_inventario_herramientas_inventarios_fisicos"
								onclick="reporte_inventario_herramientas_inventarios_fisicos();" 
								title="Imprimir reporte en PDF" 
								tabindex="1">
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  
								id="btnDescargarXLS_inventario_herramientas_inventarios_fisicos"
								onclick="descargar_xls_inventario_herramientas_inventarios_fisicos();" 
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
				<!--Fecha de corte-->
				<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaCorte_rep_inventario_herramientas_inventarios_fisicos">Fecha de corte</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaCorte_rep_inventario_herramientas_inventarios_fisicos'>
			                    <input class="form-control" 
			                    		id="txtFechaCorte_rep_inventario_herramientas_inventarios_fisicos"
			                    		name= "strFechaCorte_rep_inventario_herramientas_inventarios_fisicos" 
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
				<!--Mecánico-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtMecanico_rep_inventario_herramientas_inventarios_fisicos">Mecánico</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtMecanicoID_rep_inventario_herramientas_inventarios_fisicos" 
									name="strMecanicoID_rep_inventario_herramientas_inventarios_fisicos" 
									type="hidden" />
							<input  class="form-control" 
									id="txtMecanico_rep_inventario_herramientas_inventarios_fisicos" 
									name="strMecanico_rep_inventario_herramientas_inventarios_fisicos" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese mecánico" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div><!--#RepInventarioHerramientasInventariosFisicosContent -->

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">
	
	/*******************************************************************************************************************
	Funciones del formulario
	*********************************************************************************************************************/
	//Variable que se utilizan para la búsqueda de registros
	var dteFechaCorteInventarioHerramientasInventariosFisicos = "";
	var intMecanicoIDInventarioHerramientasInventariosFisicos = 0;

	//Función para crear el reporte PDF
	function reporte_inventario_herramientas_inventarios_fisicos(){
		
		//Validar que se encuentre una fecha seleccionada	
		if($('#txtFechaCorte_rep_inventario_herramientas_inventarios_fisicos').val() != ''){

			dteFechaCorteInventarioHerramientasInventariosFisicos =  $.formatFechaMysql($('#txtFechaCorte_rep_inventario_herramientas_inventarios_fisicos').val());

			//Si no existe id del evento en busqueda
			if( $('#txtMecanicoID_rep_inventario_herramientas_inventarios_fisicos').val() == '' || $('#txtMecanico_rep_inventario_herramientas_inventarios_fisicos').val() == ''
			  )
			{
				intMecanicoIDInventarioHerramientasInventariosFisicos = 0;
			}
			else{
				intMecanicoIDInventarioHerramientasInventariosFisicos = $('#txtMecanicoID_rep_inventario_herramientas_inventarios_fisicos').val();
			}
			
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("inventarios_fisicos/rep_inventario_herramientas/get_reporte/"+
						dteFechaCorteInventarioHerramientasInventariosFisicos+"/"+
						intMecanicoIDInventarioHerramientasInventariosFisicos );
		}
		else{
			$('#txtFechaCorte_rep_inventario_herramientas_inventarios_fisicos').focus();	
		}
	
	}

	//Función para descargar el reporte en XLS
	function descargar_xls_inventario_herramientas_inventarios_fisicos() {
		
		//Validar que se encuentre una fecha seleccionada	
		if($('#txtFechaCorte_rep_inventario_herramientas_inventarios_fisicos').val() != ''){

			dteFechaCorteInventarioHerramientasInventariosFisicos =  $.formatFechaMysql($('#txtFechaCorte_rep_inventario_herramientas_inventarios_fisicos').val());

			//Si no existe id del evento en busqueda
			if( $('#txtMecanicoID_rep_inventario_herramientas_inventarios_fisicos').val() == '' || $('#txtMecanico_rep_inventario_herramientas_inventarios_fisicos').val() == ''
			  )
			{
				intMecanicoIDInventarioHerramientasInventariosFisicos = 0;
			}
			else{
				intMecanicoIDInventarioHerramientasInventariosFisicos = $('#txtMecanicoID_rep_inventario_herramientas_inventarios_fisicos').val();
			}
			
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("inventarios_fisicos/rep_inventario_herramientas/get_xls/"+
						dteFechaCorteInventarioHerramientasInventariosFisicos+"/"+
						intMecanicoIDInventarioHerramientasInventariosFisicos );
		}
		else{
			$('#txtFechaCorte_rep_inventario_herramientas_inventarios_fisicos').focus();	
		}
		
	}	

	

	$(document).ready(function() 
	{	
		/*******************************************************************************************************************
		Controles correspondientes al formulario
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaCorte_rep_inventario_herramientas_inventarios_fisicos').datetimepicker({format: 'DD/MM/YYYY'});
		//Asignar la fecha actual
		$('#txtFechaCorte_rep_inventario_herramientas_inventarios_fisicos').val(fechaActual()); 

		//Autocomplete para recuperar los datos de un mecánico 
        $('#txtMecanico_rep_inventario_herramientas_inventarios_fisicos').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtMecanicoID_rep_inventario_herramientas_inventarios_fisicos').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "servicio/mecanicos/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
                   strDescripcion: request.term,
                   strEstatus: 'ACTIVO'
                 },
                 success: function( data ) {
                   response( data );
                 }
               });
           },
           select: function( event, ui ) {
             //Asignar id del registro seleccionado
             $('#txtMecanicoID_rep_inventario_herramientas_inventarios_fisicos').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('servicio/mecanicos/get_datos',
                  { 
                  	strBusqueda:$("#txtMecanicoID_rep_inventario_herramientas_inventarios_fisicos").val(),
                  	strTipo:'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtMecanicoID_rep_inventario_herramientas_inventarios_fisicos").val(data.row.mecanico_id);
                       $("#txtMecanico_rep_inventario_herramientas_inventarios_fisicos").val(data.row.empleado);
                    }
                  }
                 ,
                'json');
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