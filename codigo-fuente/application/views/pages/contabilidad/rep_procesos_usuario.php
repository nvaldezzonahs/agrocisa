<div id="RepProcesosUsuarioContabilidadContent">  
		<!--Diseño del formulario-->
		<form id="frmRepProcesosUsuarioContablidad" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepProcesosUsuarioContablidad" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_doits_contabilidad"
									onclick="validar_rep_procesos_usuario_contablidad('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_proceoss_usuario_contabilidad"
									onclick="validar_rep_procesos_usuario_contablidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaInicial_rep_procesos_usuario_contabilidad">Fecha inicial</label>
							</div>
							<div id="divFechaInicialRepProcesosUsuariosMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_procesos_usuario_contabilidad'>
				                    <input class="form-control" 
				                    		id="txtFechaInicial_rep_procesos_usuario_contabilidad"
				                    		name= "strFechaInicial_rep_procesos_usario_contabilidad" 
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
								<label for="txtFechaFinal_rep_procesos_usuario_contabilidad">Fecha final</label>
							</div>
							<div id="divFechaFinalRepProcesosUsuariosMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_procesos_usuario_contabilidad'>
				                    <input class="form-control" 
				                    		id="txtFechaFinal_rep_procesos_usuario_contabilidad"
				                    		name= "strFechaFinal_rep_procesos_usario_contabilidad" 
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
			    	<!--Autocomplete que contiene los usuarios activos-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del usuario seleccionado-->
								<input id="txtUsuarioIDBusq_rep_procesos_usuario_contabilidad" 
									   name="intUsuarioIDBusq_cajas_apertura_caja"  type="hidden" 
									   value="">
								</input>
								<label for="txtUsuarioBusq_rep_procesos_usuario_contabilidad">Usuario</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtUsuarioBusq_rep_procesos_usuario_contabilidad" 
										name="strUsuarioBusq_cajas_apertura_caja" type="text" value="" tabindex="1" placeholder="Ingrese usuario" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			  			    
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepCarteraVencimientoCuentasPagarContent -->
	<!-- /.Plantilla para cargar las sucursales-->  
	
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
	/*******************************************************************************************************************
	Funciones del formulario
	*********************************************************************************************************************/
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_procesos_usuario_contabilidad()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('contabilidad/Rep_procesos_usuario/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_procesos_usuario_contabilidad').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepProcesosUsuarioContabilidad = data.row;
				//Separar la cadena 
				var arrPermisosRepProcesosUsuarioContabilidad = strPermisosRepProcesosUsuarioContabilidad.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepProcesosUsuarioContabilidad.length; i++)
				{	//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepProcesosUsuarioContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_procesos_usuario_contabilidad').removeAttr('disabled');
					}			
					else if(arrPermisosRepProcesosUsuarioContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_proceoss_usuario_contabilidad').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

		//Controles o Eventos del Modal
		$(document).ready(function() {
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicial_rep_procesos_usuario_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaFinal_rep_procesos_usuario_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_procesos_usuario_contabilidad').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_procesos_usuario_contabilidad').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_procesos_usuario_contabilidad').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_procesos_usuario_contabilidad').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un usuario 
	        $('#txtUsuarioBusq_rep_procesos_usuario_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsuarioIDBusq_rep_procesos_usuario_contabilidad').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "seguridad/usuarios/autocomplete",
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
	             $('#txtUsuarioIDBusq_rep_procesos_usuario_contabilidad').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_procesos_usuario_contabilidad();
			

		});
	</script>