<div id="RepResultadosEncuestasMercadotecniaContent">  
	<!--Diseño del formulario-->
	<form id="frmRepResultadosEncuestasMercadotecnia" method="post" action="#" class="form-horizontal" role="form" 
		  name="frmRepResultadosEncuestasMercadotecnia" onsubmit="return(false)" autocomplete="off">

		<input id="txtEmpresa_rep_resultados_encuestas_mercadotecnia" type="hidden"> 
		<input id="txtSucursal_rep_resultados_encuestas_mercadotecnia" type="hidden"> 
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<div class="row">
				<!--Botones-->
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div id="ToolBtns" class="btn-group">
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  
								id="btnImprimir_rep_resultados_encuestas_mercadotecnia"
								onclick="graficas_rep_resultados_encuestas_mercadotecnia();" 
								title="Generar reporte" 
								tabindex="1">
							<span class="glyphicon glyphicon-stats"></span>
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
							<label for="txtFechaInicial_rep_resultados_encuestas_mercadotecnia">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicial_rep_resultados_encuestas_mercadotecnia'>
			                    <input class="form-control" id="txtFechaInicial_rep_resultados_encuestas_mercadotecnia"
			                    		name= "strFechaInicial_rep_resultados_encuestas_mercadotecnia" 
			                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
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
							<label for="txtFechaFinal_rep_resultados_encuestas_mercadotecnia">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinal_rep_resultados_encuestas_mercadotecnia'>
			                    <input class="form-control" id="txtFechaFinal_rep_resultados_encuestas_mercadotecnia"
			                    		name= "strFechaFinal_rep_resultados_encuestas_mercadotecnia" 
			                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
						</div>
					</div>
				</div>
		    </div><!--./row -->
		    <div class="row">
				<!--Autocomplete que contiene las encuestas activas-->
				<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id de la encuesta seleccionada-->
							<input id="txtEncuestaID_rep_resultados_encuestas_mercadotecnia" name="intEncuestaID_rep_resultados_encuestas_mercadotecnia"  
								   type="hidden" value="">
							</input>
							<label for="txtEncuesta_rep_resultados_encuestas_mercadotecnia">Encuesta</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtEncuesta_rep_resultados_encuestas_mercadotecnia" 
									name="strEncuesta_rep_resultados_encuestas_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese encuesta" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Módulo-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id de la encuesta-->
							<input id="txtModuloID_rep_resultados_encuestas_mercadotecnia" name="intModuloID_rep_resultados_encuestas_mercadotecnia"  
								   type="hidden" value="">
							</input>
							<label for="txtModulo_rep_resultados_encuestas_mercadotecnia">Módulo</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtModulo_rep_resultados_encuestas_mercadotecnia" 
									name="strModulo_rep_resultados_encuestas_mercadotecnia" type="text" value="" disabled>
							</input>
						</div>
					</div>
				</div>
		    </div><!--./row -->
		    <div class="row">
				<!--Autocomplete que contiene las zonas activas-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id de la zona seleccionada-->
							<input id="txtZonaID_rep_resultados_encuestas_mercadotecnia" name="intZonaID_rep_resultados_encuestas_mercadotecnia"  
								   type="hidden" value="">
							</input>
							<label for="txtZona_rep_resultados_encuestas_mercadotecnia">Zona</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtZona_rep_resultados_encuestas_mercadotecnia" 
									name="strZona_rep_resultados_encuestas_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese zona" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Autocomplete que contiene las localidades activas-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id de la localidad seleccionada-->
							<input id="txtLocalidadID_rep_resultados_encuestas_mercadotecnia" name="intLocalidadID_rep_resultados_encuestas_mercadotecnia"  
								   type="hidden" value="">
							</input>
							<label for="txtLocalidad_rep_resultados_encuestas_mercadotecnia">Localidad</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtLocalidad_rep_resultados_encuestas_mercadotecnia" 
									name="strLocalidad_rep_resultados_encuestas_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese localidad" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Autocomplete que contiene los municipios activos-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id del municipio seleccionado-->
							<input id="txtMunicipioID_rep_resultados_encuestas_mercadotecnia" name="intMunicipioID_rep_resultados_encuestas_mercadotecnia"  
								   type="hidden" value="">
							</input>
							<label for="txtMunicipio_rep_resultados_encuestas_mercadotecnia">Municipio</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtMunicipio_rep_resultados_encuestas_mercadotecnia" 
									name="strMunicipio_rep_resultados_encuestas_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese municipio" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Autocomplete que contiene los estados activos-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id del estado seleccionado-->
							<input id="txtEstadoID_rep_resultados_encuestas_mercadotecnia" name="intEstadoID_rep_resultados_encuestas_mercadotecnia"  
								   type="hidden" value="">
							</input>
							<label for="txtEstado_rep_resultados_encuestas_mercadotecnia">Estado</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtEstado_rep_resultados_encuestas_mercadotecnia" 
									name="strEstado_rep_resultados_encuestas_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese estado" maxlength="250">
							</input>
						</div>
					</div>
				</div>
		    </div><!--./row -->
		    <div class="row">
				<!--Autocomplete que contiene las actividades activas-->
				<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id la actividad seleccionada-->
							<input id="txtActividadID_rep_resultados_encuestas_mercadotecnia" name="intActividadID_rep_resultados_encuestas_mercadotecnia"  
								   type="hidden" value="">
							</input>
							<label for="txtActividad_rep_resultados_encuestas_mercadotecnia">Actividad</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtActividad_rep_resultados_encuestas_mercadotecnia" 
									name="strActividad_rep_resultados_encuestas_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese actividad" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Autocomplete que contiene los cultivos activos-->
				<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id del cultivo seleccionado-->
							<input id="txtCultivoID_rep_resultados_encuestas_mercadotecnia" name="intCultivoID_rep_resultados_encuestas_mercadotecnia"  
								   type="hidden" value="">
							</input>
							<label for="txtCultivo_rep_resultados_encuestas_mercadotecnia">Cultivo</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtCultivo_rep_resultados_encuestas_mercadotecnia" 
									name="strCultivo_rep_resultados_encuestas_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese cultivo" maxlength="250">
							</input>
						</div>
					</div>
				</div>
		    </div><!--./row -->
		    

		</div><!--Cierre del contenedor del formulario--> 
	</form><!--Cierre del formulario-->


	<!-- Diseño del modal-->
	<div id="RepResultadosEncuestasMercadotecniaBox" class="ModalBody" tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_rep_resultados_encuestas_mercadotecnia" class="ModalBodyTitle">
			<h1>Encuestas aplicadas</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
				<form id="frmPreguntasMercadotecnia" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmPreguntasMercadotecnia" onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<div id="chartColumns" class="col-sm-12 col-md-12 col-lg-12 col-xs-12 centered">
							
						</div>
						<img id="logo" class="logo" src="assets/images/misc/logo.png" style="display: none;" />
						<div id="googleChart" style="display: none;"></div>
					</div>		
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_encuestas_mercadotecnia"  
									onclick="imprimir_graficas_rep_resultados_encuestas_mercadotecnia();"  
									title="Descargar reporte a PDF">
								<span class="glyphicon glyphicon-print"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  
									id="btnCerrar_encuestas_mercadotecnia"
									type="reset" 
									aria-hidden="true" 
									onclick="cerrar_graficas_rep_resultados_encuestas_mercadotecnia();" 
									title="Cerrar">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
					<!--Cierre Botones de acción (barra de tareas)-->	
				</form>
				<!--Cierre del formulario-->	
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal-->


</div><!--#RepResultadosEncuestasMercadotecniaContent -->

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones para la graficación
	*********************************************************************************************************************/
	// Load the Visualization API and the piechart package. 
    google.charts.load('current', {'packages':['corechart']});    
     

	/*******************************************************************************************************************
	Funciones del formulario
	*********************************************************************************************************************/
	//Variables que se utilizan para la búsqueda de registros
	var dteFechaInicialRepAgendaCRM = "";
	var dteFechaFinalRepAgendaCRM = "";
	var intEncuestaIDRepResultadosEncuestasMercadotecnia = "";
	var intZonaIDRepResultadosEncuestasMercadotecnia = "";
	var intLocalidadIDRepResultadosEncuestasMercadotecnia = "";
	var intMunicipioIDRepResultadosEncuestasMercadotecnia = "";
	var intEstadoIDRepResultadosEncuestasMercadotecnia = "";
	var intActividadIDRepResultadosEncuestasMercadotecnia = "";
	var intCultivoIDRepResultadosEncuestasMercadotecnia = "";

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_resultados_encuestas_mercadotecnia()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('mercadotecnia/rep_resultados_encuestas/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_resultados_encuestas_mercadotecnia').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepResultadosEncuestasMercadotecnia = data.row;
				//Separar la cadena 
				var arrPermisosRepResultadosEncuestasMercadotecnia = strPermisosRepResultadosEncuestasMercadotecnia.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepResultadosEncuestasMercadotecnia.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepResultadosEncuestasMercadotecnia[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_resultados_encuestas_mercadotecnia').removeAttr('disabled');
					}
					
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para obtener nombre de la empresa y sucursal
	function empresa_rep_resultados_encuestas_mercadotecnia(){

		$.post('mercadotecnia/rep_resultados_encuestas/get_header',
		{ },
		function(data){
			$('#txtEmpresa_rep_resultados_encuestas_mercadotecnia').val(data.empresa.razon_social);
			$('#txtSucursal_rep_resultados_encuestas_mercadotecnia').val(data.sucursal.nombre);
		},
		'json');

	}

	//Función para crear el reporte con graficación
	function graficas_rep_resultados_encuestas_mercadotecnia(){
		
		$('#divEncabezadoModal_rep_resultados_encuestas_mercadotecnia').addClass("estatus-NUEVO");

		//Abrir modal
		objRepResultadosEncuestasMercadotecnia = $('#RepResultadosEncuestasMercadotecniaBox').bPopup({
													appendTo: '#RepResultadosEncuestasMercadotecniaM', 
													contentContainer: 'RepResultadosEncuestasMercadotecniaM', 
													zIndex: 1, 
													modalClose: false, 
													modal: true, 
													follow: [true,false], 
													followEasing : "linear", 
													easing: "linear", 
													modalColor: ('#F0F0F0')});
     	
     	// Set a callback to run when the Google Visualization API is loaded. 
    	google.charts.setOnLoadCallback(drawChart);	

	}

	function drawChart() {

		//
		var intEncuestaIDRepResultadosEncuestasMercadotecnia = $('#txtEncuestaID_rep_resultados_encuestas_mercadotecnia').val();
		var intZonaIDRepResultadosEncuestasMercadotecnia = $('#txtZonaID_rep_resultados_encuestas_mercadotecnia').val();
		var intLocalidadIDRepResultadosEncuestasMercadotecnia = $('#txtLocalidadID_rep_resultados_encuestas_mercadotecnia').val();
		var intMunicipioIDRepResultadosEncuestasMercadotecnia = $('#txtMunicipioID_rep_resultados_encuestas_mercadotecnia').val();
		var intEstadoIDRepResultadosEncuestasMercadotecnia = $('#txtEstadoID_rep_resultados_encuestas_mercadotecnia').val();
		var intActividadIDRepResultadosEncuestasMercadotecnia = $('#txtActividadID_rep_resultados_encuestas_mercadotecnia').val();
		var intCultivoIDRepResultadosEncuestasMercadotecnia = $('#txtCultivoID_rep_resultados_encuestas_mercadotecnia').val();

		//Asignar valores para la búsqueda de registros
		dteFechaInicialRepResultadosEncuestasMercadotecnia =  $.formatFechaMysql($('#txtFechaInicial_rep_resultados_encuestas_mercadotecnia').val());
		dteFechaFinalRepResultadosEncuestasMercadotecnia =  $.formatFechaMysql($('#txtFechaFinal_rep_resultados_encuestas_mercadotecnia').val());

		//Si no existe fecha inicial
		if(dteFechaInicialRepResultadosEncuestasMercadotecnia == '')
		{
			dteFechaInicialRepResultadosEncuestasMercadotecnia = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalRepResultadosEncuestasMercadotecnia == '')
		{
			dteFechaFinalRepResultadosEncuestasMercadotecnia =  '0000-00-00';
		}
		//Si no existe id de la encuesta
		if(intEncuestaIDRepResultadosEncuestasMercadotecnia == '')
		{
			intEncuestaIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id de la zona
		if(intZonaIDRepResultadosEncuestasMercadotecnia == '')
		{
			intZonaIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id de la localidad
		if(intLocalidadIDRepResultadosEncuestasMercadotecnia == '')
		{
			intLocalidadIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id del municipio
		if(intMunicipioIDRepResultadosEncuestasMercadotecnia == '')
		{
			intMunicipioIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id del estado
		if(intEstadoIDRepResultadosEncuestasMercadotecnia == '')
		{
			intEstadoIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id de la actividad
		if(intActividadIDRepResultadosEncuestasMercadotecnia == '')
		{
			intActividadIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id del cultivo
		if(intCultivoIDRepResultadosEncuestasMercadotecnia == '')
		{
			intCultivoIDRepResultadosEncuestasMercadotecnia = 0;
		}
		

		$.ajax({
		    url: "mercadotecnia/rep_resultados_encuestas/get_respuestas",
		    type: "POST",
		    data: { dteFechaInicial: dteFechaInicialRepResultadosEncuestasMercadotecnia,
		    		dteFechaFinal: dteFechaFinalRepResultadosEncuestasMercadotecnia,
		    		intEncuestaID: intEncuestaIDRepResultadosEncuestasMercadotecnia,
		    		intZonaID: intZonaIDRepResultadosEncuestasMercadotecnia,
		    		intLocalidadID: intLocalidadIDRepResultadosEncuestasMercadotecnia,
		    		intMunicipioID: intMunicipioIDRepResultadosEncuestasMercadotecnia,
		    		intEstadoID: intEstadoIDRepResultadosEncuestasMercadotecnia,
		    		intActividadID: intActividadIDRepResultadosEncuestasMercadotecnia,
		    		intCultivoID: intCultivoIDRepResultadosEncuestasMercadotecnia 
		    	  },
		    dataType: "json"
		}).done(function(jsonData) {
		  	
		  	//Generación de gráficas en la Vista
		    var strEncuestaAnterior = ''; 
		    for(var i=0; i<jsonData.length; i++){
		    	
		    	if(jsonData[i].encuesta != strEncuestaAnterior )
		    		$('#chartColumns').append( "<h3>"+ jsonData[i].encuesta +"</h3>" );

		    	$('#chartColumns').append( '<div align="center" id="chart_div'+i+'"></div>' );
		    	strEncuestaAnterior = jsonData[i].encuesta;
		    }
		        
		    for(var i=0; i<jsonData.length; i++){
		    	
		    	var data = new google.visualization.DataTable(jsonData[i]);
		    	var pregunta = jsonData[i].pregunta;
		    	var chart = new google.visualization.PieChart(document.getElementById('chart_div'+i));
		    	chart.draw(data, {title:pregunta, width: 600, height: 340, legend:'right', sliceVisibilityThreshold :0});
		    }
		    
		    
		});

	}

	//Función que se utiliza para cerrar el modal
	function cerrar_graficas_rep_resultados_encuestas_mercadotecnia()
	{
		try {
			//Cerrar modal
			objRepResultadosEncuestasMercadotecnia.close();
			$('#chartColumns').empty();
		}
		catch(err) {}
	}

	function getImgData(chartContainer) {
        var chartArea = chartContainer.getElementsByTagName('svg')[0].parentNode;
        var svg = chartArea.innerHTML;
        var doc = chartContainer.ownerDocument;
        var canvas = doc.createElement('canvas');
        canvas.setAttribute('width', chartArea.offsetWidth);
        canvas.setAttribute('height', chartArea.offsetHeight);
        
        
        canvas.setAttribute(
            'style',
            'position: absolute; ' +
            'top: ' + (-chartArea.offsetHeight * 2) + 'px;' +
            'left: ' + (-chartArea.offsetWidth * 2) + 'px;');
        doc.body.appendChild(canvas);
        canvg(canvas, svg);
        var imgData = canvas.toDataURL("image/png");
        canvas.parentNode.removeChild(canvas);
        return imgData;
    }

    function getDataUri(url) {
    var image = new Image();

    image.onload = function () {
        var canvas = document.createElement('canvas');
        canvas.width = this.naturalWidth; // or 'width' if you want a special/scaled size
        canvas.height = this.naturalHeight; // or 'height' if you want a special/scaled size

	    canvas.getContext('2d').drawImage(this, 0, 0);

        // Get raw image data
        canvas.toDataURL('image/png').replace(/^data:image\/(png|jpg);base64,/, '');

        // ... or get as Data URI
        canvas.toDataURL('image/png');

	    };

	    image.src = url;

	    return image;
	}
      

      
	//Función para imprimir en PDF las gráficas de encuestas 
	function imprimir_graficas_rep_resultados_encuestas_mercadotecnia(){

		//Agregar nombres de encuesta y gráficas
		var intEncuestaIDRepResultadosEncuestasMercadotecnia = $('#txtEncuestaID_rep_resultados_encuestas_mercadotecnia').val();
		var intZonaIDRepResultadosEncuestasMercadotecnia = $('#txtZonaID_rep_resultados_encuestas_mercadotecnia').val();
		var intLocalidadIDRepResultadosEncuestasMercadotecnia = $('#txtLocalidadID_rep_resultados_encuestas_mercadotecnia').val();
		var intMunicipioIDRepResultadosEncuestasMercadotecnia = $('#txtMunicipioID_rep_resultados_encuestas_mercadotecnia').val();
		var intEstadoIDRepResultadosEncuestasMercadotecnia = $('#txtEstadoID_rep_resultados_encuestas_mercadotecnia').val();
		var intActividadIDRepResultadosEncuestasMercadotecnia = $('#txtActividadID_rep_resultados_encuestas_mercadotecnia').val();
		var intCultivoIDRepResultadosEncuestasMercadotecnia = $('#txtCultivoID_rep_resultados_encuestas_mercadotecnia').val();

		//Asignar valores para la búsqueda de registros
		dteFechaInicialRepResultadosEncuestasMercadotecnia =  $.formatFechaMysql($('#txtFechaInicial_rep_resultados_encuestas_mercadotecnia').val());
		dteFechaFinalRepResultadosEncuestasMercadotecnia =  $.formatFechaMysql($('#txtFechaFinal_rep_resultados_encuestas_mercadotecnia').val());

		//Si no existe fecha inicial
		if(dteFechaInicialRepResultadosEncuestasMercadotecnia == '')
		{
			dteFechaInicialRepResultadosEncuestasMercadotecnia = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalRepResultadosEncuestasMercadotecnia == '')
		{
			dteFechaFinalRepResultadosEncuestasMercadotecnia =  '0000-00-00';
		}
		//Si no existe id de la encuesta
		if(intEncuestaIDRepResultadosEncuestasMercadotecnia == '')
		{
			intEncuestaIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id de la zona
		if(intZonaIDRepResultadosEncuestasMercadotecnia == '')
		{
			intZonaIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id de la localidad
		if(intLocalidadIDRepResultadosEncuestasMercadotecnia == '')
		{
			intLocalidadIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id del municipio
		if(intMunicipioIDRepResultadosEncuestasMercadotecnia == '')
		{
			intMunicipioIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id del estado
		if(intEstadoIDRepResultadosEncuestasMercadotecnia == '')
		{
			intEstadoIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id de la actividad
		if(intActividadIDRepResultadosEncuestasMercadotecnia == '')
		{
			intActividadIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id del cultivo
		if(intCultivoIDRepResultadosEncuestasMercadotecnia == '')
		{
			intCultivoIDRepResultadosEncuestasMercadotecnia = 0;
		}
		

		$.ajax({
		    url: "mercadotecnia/rep_resultados_encuestas/get_respuestas",
		    type: "POST",
		    data: { dteFechaInicial: dteFechaInicialRepResultadosEncuestasMercadotecnia,
		    		dteFechaFinal: dteFechaFinalRepResultadosEncuestasMercadotecnia,
		    		intEncuestaID: intEncuestaIDRepResultadosEncuestasMercadotecnia,
		    		intZonaID: intZonaIDRepResultadosEncuestasMercadotecnia,
		    		intLocalidadID: intLocalidadIDRepResultadosEncuestasMercadotecnia,
		    		intMunicipioID: intMunicipioIDRepResultadosEncuestasMercadotecnia,
		    		intEstadoID: intEstadoIDRepResultadosEncuestasMercadotecnia,
		    		intActividadID: intActividadIDRepResultadosEncuestasMercadotecnia,
		    		intCultivoID: intCultivoIDRepResultadosEncuestasMercadotecnia 
		    	  },
		    dataType: "json"
		}).done(function(jsonData) {
		  	
		  	var doc = new jsPDF();
			var pageHeight = doc.internal.pageSize.height;
			var logoImg = getDataUri('assets/images/misc/logo.png');
			var y = 35;
			var alturaTitulo = 5;
			var alturaGrafica = 80;

			console.log(pageHeight);
			/*
			*********************************************************************************
			* ENCABEZADO PARA CADA PÁGINA NUEVA
			*********************************************************************************
			*/
			doc.addImage(logoImg, 'png', 7, 10, 45, 15);
			//Razón social de la empresa
			doc.setFontType("bold");
			doc.setFontSize(12);
			doc.text(56, 14, $('#txtEmpresa_rep_resultados_encuestas_mercadotecnia').val() );
			//Nombre de la sucursal
			doc.setFontType("normal");
			doc.setFontSize(10);
			doc.text(56, 20, 'SUC. ' + $('#txtSucursal_rep_resultados_encuestas_mercadotecnia').val() );

			doc.setFontSize(10);

		  	//Generación de gráficas en la Vista
		    var strEncuestaAnterior = ''; 
    
		    for(var i=0; i<jsonData.length; i++){
		    	
		    	if(jsonData[i].encuesta != strEncuestaAnterior ){
		    		doc.text(7, y, jsonData[i].encuesta);
					y = y + alturaTitulo;
					console.log(y);
		    	}

		    	var data = new google.visualization.DataTable(jsonData[i]);
		    	var pregunta = jsonData[i].pregunta;
		    	var chart = new google.visualization.PieChart(document.getElementById('googleChart'));
		    	chart.draw(data, {title:pregunta, width: 600, height: 340, legend:'right', sliceVisibilityThreshold :0});

		    	var chart1 = getImgData( document.getElementById('googleChart')  );
				
				//Agregar una gráfica
				if(y + alturaGrafica > pageHeight){
					doc.addPage();
					y = 10;
					doc.addImage(chart1, 'PNG', 60, y, 100, 80);	
				}
				else{
					doc.addImage(chart1, 'PNG', 60, y, 100, 80);
				}
				
				y = y + alturaGrafica;
				
				console.log(y);
				strEncuestaAnterior = jsonData[i].encuesta;
		    }
		     
		    doc.save('rep_resultados_encuestas.pdf');
		    
		});  

	}

	//Función para cargar el reporte general en PDF
	function reporte_rep_resultados_encuestas_mercadotecnia() 
	{
		//
		var intEncuestaIDRepResultadosEncuestasMercadotecnia = $('#txtEncuestaID_rep_resultados_encuestas_mercadotecnia').val();
		var intZonaIDRepResultadosEncuestasMercadotecnia = $('#txtZonaID_rep_resultados_encuestas_mercadotecnia').val();
		var intLocalidadIDRepResultadosEncuestasMercadotecnia = $('#txtLocalidadID_rep_resultados_encuestas_mercadotecnia').val();
		var intMunicipioIDRepResultadosEncuestasMercadotecnia = $('#txtMunicipioID_rep_resultados_encuestas_mercadotecnia').val();
		var intEstadoIDRepResultadosEncuestasMercadotecnia = $('#txtEstadoID_rep_resultados_encuestas_mercadotecnia').val();
		var intActividadIDRepResultadosEncuestasMercadotecnia = $('#txtActividadID_rep_resultados_encuestas_mercadotecnia').val();
		var intCultivoIDRepResultadosEncuestasMercadotecnia = $('#txtCultivoID_rep_resultados_encuestas_mercadotecnia').val();

		//Asignar valores para la búsqueda de registros
		dteFechaInicialRepResultadosEncuestasMercadotecnia =  $.formatFechaMysql($('#txtFechaInicial_rep_resultados_encuestas_mercadotecnia').val());
		dteFechaFinalRepResultadosEncuestasMercadotecnia =  $.formatFechaMysql($('#txtFechaFinal_rep_resultados_encuestas_mercadotecnia').val());

		//Si no existe fecha inicial
		if(dteFechaInicialRepResultadosEncuestasMercadotecnia == '')
		{
			dteFechaInicialRepResultadosEncuestasMercadotecnia = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalRepResultadosEncuestasMercadotecnia == '')
		{
			dteFechaFinalRepResultadosEncuestasMercadotecnia =  '0000-00-00';
		}
		//Si no existe id de la encuesta
		if(intEncuestaIDRepResultadosEncuestasMercadotecnia == '')
		{
			intEncuestaIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id de la zona
		if(intZonaIDRepResultadosEncuestasMercadotecnia == '')
		{
			intZonaIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id de la localidad
		if(intLocalidadIDRepResultadosEncuestasMercadotecnia == '')
		{
			intLocalidadIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id del municipio
		if(intMunicipioIDRepResultadosEncuestasMercadotecnia == '')
		{
			intMunicipioIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id del estado
		if(intEstadoIDRepResultadosEncuestasMercadotecnia == '')
		{
			intEstadoIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id de la actividad
		if(intActividadIDRepResultadosEncuestasMercadotecnia == '')
		{
			intActividadIDRepResultadosEncuestasMercadotecnia = 0;
		}

		//Si no existe id del cultivo
		if(intCultivoIDRepResultadosEncuestasMercadotecnia == '')
		{
			intCultivoIDRepResultadosEncuestasMercadotecnia = 0;
		}

		

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("mercadotecnia/rep_resultados_encuestas/get_reporte/" + dteFechaInicialRepResultadosEncuestasMercadotecnia + "/"
																		  + dteFechaFinalRepResultadosEncuestasMercadotecnia + "/"
																		  + intEncuestaIDRepResultadosEncuestasMercadotecnia + "/"
																		  + intZonaIDRepResultadosEncuestasMercadotecnia + "/"
																		  + intLocalidadIDRepResultadosEncuestasMercadotecnia + "/"
																		  + intMunicipioIDRepResultadosEncuestasMercadotecnia + "/"
																		  + intEstadoIDRepResultadosEncuestasMercadotecnia + "/"
																		  + intActividadIDRepResultadosEncuestasMercadotecnia + "/"
																		  + intCultivoIDRepResultadosEncuestasMercadotecnia);
	}


	//Controles o Eventos del Modal
	$(document).ready(function() 
	{	
		/*******************************************************************************************************************
		Controles correspondientes al formulario
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicial_rep_resultados_encuestas_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinal_rep_resultados_encuestas_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicial_rep_resultados_encuestas_mercadotecnia').on('dp.change', function (e) {
			$('#dteFechaFinal_rep_resultados_encuestas_mercadotecnia').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinal_rep_resultados_encuestas_mercadotecnia').on('dp.change', function (e) {
			$('#dteFechaInicial_rep_resultados_encuestas_mercadotecnia').data('DateTimePicker').maxDate(e.date);
		});

		//Limpia los inputs relacionados a seleccionar un filtro por ubicación: Zona, Localidad, Municipio y Estado
		function limpiar_inputs_ubicaciones(){
			$('#txtZonaID_rep_resultados_encuestas_mercadotecnia').val('');
			$('#txtZona_rep_resultados_encuestas_mercadotecnia').val('');
			$('#txtLocalidadID_rep_resultados_encuestas_mercadotecnia').val('');
			$('#txtLocalidad_rep_resultados_encuestas_mercadotecnia').val('');
			$('#txtMunicipioID_rep_resultados_encuestas_mercadotecnia').val('');
			$('#txtMunicipio_rep_resultados_encuestas_mercadotecnia').val('');
			$('#txtEstadoID_rep_resultados_encuestas_mercadotecnia').val('');
			$('#txtEstado_rep_resultados_encuestas_mercadotecnia').val('');
		}

		//Autocomplete para recuperar los datos de una encuesta 
        $('#txtEncuesta_rep_resultados_encuestas_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtEncuestaID_rep_resultados_encuestas_mercadotecnia').val('');
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtZonaID_rep_resultados_encuestas_mercadotecnia').val('');
			   $('#txtZona_rep_resultados_encuestas_mercadotecnia').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "mercadotecnia/encuestas/autocomplete",
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
             $('#txtEncuestaID_rep_resultados_encuestas_mercadotecnia').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('mercadotecnia/encuestas/get_datos',
                  { 
                  	intEncuestaID:$("#txtEncuestaID_rep_resultados_encuestas_mercadotecnia").val()
                  },
                  function(data) {
                    if(data.row){
                       $("#txtEncuesta_rep_resultados_encuestas_mercadotecnia").val(data.row.descripcion);
                       $("#txtModuloID_rep_resultados_encuestas_mercadotecnia").val(data.row.modulo_id);
                       $("#txtModulo_rep_resultados_encuestas_mercadotecnia").val(data.row.modulo);
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

        //Verificar que exista id de la encuesta cuando pierda el enfoque la caja de texto
		$('#txtEncuesta_rep_resultados_encuestas_mercadotecnia').focusout(function(e){
			//Si no existe id de la encuesta
			if($('#txtEncuestaID_rep_resultados_encuestas_mercadotecnia').val() == '' ||
			   $('#txtEncuesta_rep_resultados_encuestas_mercadotecnia').val() == '')
			{ 
				//Limpiar contenido de las siguientes cajas de texto
				$('#txtEncuestaID_rep_resultados_encuestas_mercadotecnia').val('');
				$('#txtEncuesta_rep_resultados_encuestas_mercadotecnia').val('');
				$('#txtModuloID_rep_resultados_encuestas_mercadotecnia').val('');
				$('#txtModulo_rep_resultados_encuestas_mercadotecnia').val('');
				
			}
			
		});

        //Autocomplete para recuperar los datos de una zona  
        $('#txtZona_rep_resultados_encuestas_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtZonaID_rep_resultados_encuestas_mercadotecnia').val('');
               //console.log(request);
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "crm/zonas/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
                   strDescripcion: request.term,
                   intModuloID: $("#txtModuloID_rep_resultados_encuestas_mercadotecnia").val()
                 },
                 success: function( data ) {
                   response( data );
                 }
               });
           },
           select: function( event, ui ) {
             //Hacer un llamado a la función para limpiar ubicación
             limpiar_inputs_ubicaciones();
             //Asignar id del registro seleccionado
             $('#txtZonaID_rep_resultados_encuestas_mercadotecnia').val(ui.item.data);             
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });


        //Verificar que exista id de la zona cuando pierda el enfoque la caja de texto
		$('#txtZona_rep_resultados_encuestas_mercadotecnia').focusout(function(e){
			//Si no existe id de la zona
			if($('#txtZonaID_rep_resultados_encuestas_mercadotecnia').val() == '' ||
			   $('#txtZona_rep_resultados_encuestas_mercadotecnia').val() == '')
			{ 
				//Limpiar contenido de las siguientes cajas de texto
				$('#txtZonaID_rep_resultados_encuestas_mercadotecnia').val('');
				$('#txtZona_rep_resultados_encuestas_mercadotecnia').val('');
			}
			
		});

        //Autocomplete para recuperar los datos de una localidad  
        $('#txtLocalidad_rep_resultados_encuestas_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtLocalidadID_rep_resultados_encuestas_mercadotecnia').val('');
               //console.log(request);
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "crm/localidades/autocomplete",
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
             //Hacer un llamado a la función para limpiar ubicación
             limpiar_inputs_ubicaciones();
             //Asignar id del registro seleccionado
             $('#txtLocalidadID_rep_resultados_encuestas_mercadotecnia').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('crm/localidades/get_datos',
                  { 
                  	strBusqueda:$("#txtLocalidadID_rep_resultados_encuestas_mercadotecnia").val(),
                  	strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtLocalidad_rep_resultados_encuestas_mercadotecnia").val(data.row.localidad);
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

        //Verificar que exista id de la localidad cuando pierda el enfoque la caja de texto
		$('#txtLocalidad_rep_resultados_encuestas_mercadotecnia').focusout(function(e){
			//Si no existe id de la localidad
			if($('#txtLocalidadID_rep_resultados_encuestas_mercadotecnia').val() == '' ||
			   $('#txtLocalidad_rep_resultados_encuestas_mercadotecnia').val() == '')
			{ 
				//Limpiar contenido de las siguientes cajas de texto
				$('#txtLocalidadID_rep_resultados_encuestas_mercadotecnia').val('');
				$('#txtLocalidad_rep_resultados_encuestas_mercadotecnia').val('');
			}
			
		});


        //Autocomplete para recuperar los datos de un municipio  
        $('#txtMunicipio_rep_resultados_encuestas_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtMunicipioID_rep_resultados_encuestas_mercadotecnia').val('');
               //console.log(request);
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "crm/municipios/autocomplete",
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
           	 //Hacer un llamado a la función para limpiar ubicación
             limpiar_inputs_ubicaciones();
             //Asignar id del registro seleccionado
             $('#txtMunicipioID_rep_resultados_encuestas_mercadotecnia').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('crm/municipios/get_datos',
                  { 
                  	strBusqueda:$("#txtMunicipioID_rep_resultados_encuestas_mercadotecnia").val(),
                  	strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                       	
                       $("#txtMunicipio_rep_resultados_encuestas_mercadotecnia").val(data.row.municipio);
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


        //Verificar que exista id del municipio cuando pierda el enfoque la caja de texto
		$('#txtMunicipio_rep_resultados_encuestas_mercadotecnia').focusout(function(e){
			//Si no existe id del municipio
			if($('#txtMunicipioID_rep_resultados_encuestas_mercadotecnia').val() == '' ||
			   $('#txtMunicipio_rep_resultados_encuestas_mercadotecnia').val() == '')
			{ 
				//Limpiar contenido de las siguientes cajas de texto
				$('#txtMunicipioID_rep_resultados_encuestas_mercadotecnia').val('');
				$('#txtMunicipio_rep_resultados_encuestas_mercadotecnia').val('');
			}
			
		});

        //Autocomplete para recuperar los datos de un estado  
        $('#txtEstado_rep_resultados_encuestas_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtEstadoID_rep_resultados_encuestas_mercadotecnia').val('');
               //console.log(request);
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "contabilidad/sat_estados/autocomplete",
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
              //Hacer un llamado a la función para limpiar ubicación
             limpiar_inputs_ubicaciones();
             //Asignar id del registro seleccionado
             $('#txtEstadoID_rep_resultados_encuestas_mercadotecnia').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('contabilidad/sat_estados/get_datos',
                  { 
                  	strBusqueda:$("#txtEstadoID_rep_resultados_encuestas_mercadotecnia").val(),
                  	strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){ 	
                       $("#txtEstado_rep_resultados_encuestas_mercadotecnia").val(data.row.descripcion);
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

        //Verificar que exista id del estado cuando pierda el enfoque la caja de texto
		$('#txtEstado_rep_resultados_encuestas_mercadotecnia').focusout(function(e){
			//Si no existe id del estado
			if($('#txtEstadoID_rep_resultados_encuestas_mercadotecnia').val() == '' ||
			   $('#txtEstado_rep_resultados_encuestas_mercadotecnia').val() == '')
			{ 
				//Limpiar contenido de las siguientes cajas de texto
				$('#txtEstadoID_rep_resultados_encuestas_mercadotecnia').val('');
				$('#txtEstado_rep_resultados_encuestas_mercadotecnia').val('');
			}
			
		});

        //Autocomplete para recuperar los datos de una actividad de prospecto 
        $('#txtActividad_rep_resultados_encuestas_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtActividadID_rep_resultados_encuestas_mercadotecnia').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "crm/actividades/autocomplete",
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
             //Asignar id del registro seleccionado
             $('#txtActividadID_rep_resultados_encuestas_mercadotecnia').val(ui.item.data);
             
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

        //Verificar que exista id de la actividad cuando pierda el enfoque la caja de texto
		$('#txtActividad_rep_resultados_encuestas_mercadotecnia').focusout(function(e){
			//Si no existe id de la actividad
			if($('#txtActividadID_rep_resultados_encuestas_mercadotecnia').val() == '' ||
			   $('#txtActividad_rep_resultados_encuestas_mercadotecnia').val() == '')
			{ 
				//Limpiar contenido de las siguientes cajas de texto
				$('#txtActividadID_rep_resultados_encuestas_mercadotecnia').val('');
				$('#txtActividad_rep_resultados_encuestas_mercadotecnia').val('');
			}

		});

        //Autocomplete para recuperar los datos de un cultivo de prospecto 
        $('#txtCultivo_rep_resultados_encuestas_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtCultivoID_rep_resultados_encuestas_mercadotecnia').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "crm/cultivos/autocomplete",
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
             //Asignar id del registro seleccionado
             $('#txtCultivoID_rep_resultados_encuestas_mercadotecnia').val(ui.item.data);
             
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

        //Verificar que exista id del cultivo cuando pierda el enfoque la caja de texto
		$('#txtCultivo_rep_resultados_encuestas_mercadotecnia').focusout(function(e){
			//Si no existe id del cultivo
			if($('#txtCultivoID_rep_resultados_encuestas_mercadotecnia').val() == '' ||
			   $('#txtCultivo_rep_resultados_encuestas_mercadotecnia').val() == '')
			{ 
				//Limpiar contenido de las siguientes cajas de texto
				$('#txtCultivoID_rep_resultados_encuestas_mercadotecnia').val('');
				$('#txtCultivo_rep_resultados_encuestas_mercadotecnia').val('');
			}
			
		});
		
		//Enfocar caja de texto
		$('#txtFechaInicial_rep_resultados_encuestas_mercadotecnia').focus();

		//Deshabilitar los siguientes botones (funciones de permisos de acceso)
		$('#btnImprimir_rep_resultados_encuestas_mercadotecnia').attr('disabled','-1');
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_rep_resultados_encuestas_mercadotecnia();

		//Hacer un llamado para obtener datos de la empresa y sucursal
		empresa_rep_resultados_encuestas_mercadotecnia();

	});
</script>