	<div id="RepComisionesMaquinariaContent">  
		<!--Diseño del formulario-->
		<form id="frmRepComisionesMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepComisionesMaquinaria" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_comisiones_maquinaria"
									onclick="reporte_rep_comisiones_maquinaria();" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_comisiones_maquinaria"
									onclick="descargar_xls_rep_comisiones_maquinaria();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaInicial_rep_comisiones_maquinaria">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_comisiones_maquinaria'>
				                    <input class="form-control" id="txtFechaInicial_rep_comisiones_maquinaria"
				                    		name= "strFechaInicial_rep_comisiones_maquinaria" 
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
								<label for="txtFechaFinal_rep_comisiones_maquinaria">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_comisiones_maquinaria'>
				                    <input class="form-control" id="txtFechaFinal_rep_comisiones_maquinaria"
				                    		name= "strFechaFinal_rep_comisiones_maquinaria" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Tipo-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbTipo_rep_comisiones_maquinaria">Tipo</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbTipo_rep_comisiones_maquinaria" 
								 		name="strTipo_rep_comisiones_maquinaria" tabindex="1">
								 	<option value="VENDEDORES">VENDEDORES</option>
                      				<option value="CHOFERES">CHOFERES</option>
                 				</select>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepComisionesMaquinariaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Variables que se utilizan para la búsqueda de registros
		var dteFechaInicialRepComisionesMaquinaria = "";
		var dteFechaFinalRepComisionesMaquinaria = "";

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_comisiones_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/rep_comisiones/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_comisiones_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepComisionesMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosRepComisionesMaquinaria = strPermisosRepComisionesMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepComisionesMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepComisionesMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_comisiones_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosRepComisionesMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_comisiones_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_rep_comisiones_maquinaria() 
		{
			//Asignar valores para la búsqueda de registros
			dteFechaInicialRepComisionesMaquinaria =  $.formatFechaMysql($('#txtFechaInicial_rep_comisiones_maquinaria').val());
			dteFechaFinalRepComisionesMaquinaria =  $.formatFechaMysql($('#txtFechaFinal_rep_comisiones_maquinaria').val());

			//Si no existe fecha inicial
			if(dteFechaInicialRepComisionesMaquinaria == '')
			{
				dteFechaInicialRepComisionesMaquinaria = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalRepComisionesMaquinaria == '')
			{
				dteFechaFinalRepComisionesMaquinaria =  '0000-00-00';
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			/*window.open("maquinaria/rep_comisiones/get_reporte/"+$('#cmbTipo_rep_comisiones_maquinaria').val()+"/"+intVendedorIDRepComisionesMaquinaria+'/'+dteFechaInicialRepComisionesMaquinaria+"/"+dteFechaFinalRepComisionesMaquinaria);*/
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_rep_comisiones_maquinaria() 
		{
			//Asignar valores para la búsqueda de registros
			dteFechaInicialRepComisionesMaquinaria =  $.formatFechaMysql($('#txtFechaInicial_rep_comisiones_maquinaria').val());
			dteFechaFinalRepComisionesMaquinaria =  $.formatFechaMysql($('#txtFechaFinal_rep_comisiones_maquinaria').val());

			//Si no existe fecha inicial
			if(dteFechaInicialRepComisionesMaquinaria == '')
			{
				dteFechaInicialRepComisionesMaquinaria = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalRepComisionesMaquinaria == '')
			{
				dteFechaFinalRepComisionesMaquinaria =  '0000-00-00';
			}
			
			/*//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("maquinaria/rep_comisiones/get_xls/"+$('#cmbTipo_rep_comisiones_maquinaria').val()+"/"+intVendedorIDRepComisionesMaquinaria+'/'+dteFechaInicialRepComisionesMaquinaria+"/"+dteFechaFinalRepComisionesMaquinaria);*/
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicial_rep_comisiones_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_comisiones_maquinaria').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_comisiones_maquinaria').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_comisiones_maquinaria').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_comisiones_maquinaria').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_comisiones_maquinaria').data('DateTimePicker').maxDate(e.date);
			});

			//Enfocar caja de texto
			$('#txtFechaInicial_rep_comisiones_maquinaria').focus();		
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_comisiones_maquinaria();
		});
	</script>