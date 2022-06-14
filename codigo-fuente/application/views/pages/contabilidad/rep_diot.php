<div id="RepDiotContabilidadContent">  
		<!--Diseño del formulario-->
		<form id="frmRepDiotContablidad" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepDiotContablidad" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_doits_contabilidad"
									onclick="validar_rep_polizas_pagar('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_diots_contabilidad"
									onclick="validar_rep_polizas('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				<div class="row">
					<!--Tipo Pólizas -->
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
						<!--Año-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtAnio_rep_diot_contabilidad">Año</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtAnio_rep_diot_contabilidad" 
												name="strAnio_rep_diot_contabilidad" type="number" value=""
												tabindex="1" placeholder="Ingrese año" maxlength="4" />
									</div>
								</div>
							</div>
					</div>
					<!--Mes-->
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
						<div class="form-group">
						<div class="col-md-12">
							<label for="cmbMeses_rep_diot_contabilidad">Seleccione mes:</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" 
									id="cmbMeses_rep_diot_contabilidad" 
							 		name="strMeses_rep_diot_contabilidad_" 
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
	function permisos_rep_diot_contabilidad()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('contabilidad/Rep_diot/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_diot_contabilidad').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepDiotContabilidad = data.row;
				//Separar la cadena 
				var arrPermisosRepDiotContabilidad = strPermisosRepDiotContabilidad.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepDiotContabilidad.length; i++)
				{					
					if(arrPermisosRepDiotContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_diots_contabilidad').removeAttr('disabled');
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
			//Asignar el año actual			
			$('#txtAnio_rep_diot_contabilidad').val(anioActual()); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_diot_contabilidad();
			

		});
	</script>
	