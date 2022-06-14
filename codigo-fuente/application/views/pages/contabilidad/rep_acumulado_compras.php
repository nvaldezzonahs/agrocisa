<div id="RepAcumuladoComprasContabilidadContent">  
		<!--Diseño del formulario-->
		<form id="frmRepAcumuladoComprasContabilidad" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepAcumuladoComprasContabilidad" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="frmImprimir_rep_acumulado_compras_contabilidad"
									onclick="validar_rep_polizas_pagar('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_acumulado_compras_contabilidad"
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
						<!--Año-->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtAnio_rep_acumulado_compras_contabilidad">Año</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtAnio_rep_acumulado_compras_contabilidad" 
											name="strAnio_rep_acumulado_compras_contabilidad" type="number" value=""
											tabindex="1" placeholder="Ingrese año" maxlength="4" />
								</div>
							</div>
						</div>
						<!--Tipo Módulo -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipoModulo_rep_acumulado_compras_contabilidad">Tipo pólizas</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbTipoModulo_rep_acumulado_compras_contabilidad" 
									 		name="strTipoModulo_rep_acumulado_compras_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="MAQUINARIA">MAQUINARIA</option>
                          				<option value="REFACCIONES">REFACCIONES</option>
                          				<option value="SERVICIO">SERVICIO</option>                    			
                     				</select>
								</div>
							</div>
						</div>
						<!--Combobox que contiene las Sucursales activas-->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">						
							<div class="form-group">
									<div class="col-md-12">
										<label for="cmbSucursalID_rep_acumulado_compras_contabilidad">Sucursal</label>
									</div>
									<div class="col-md-12">
										<select class="form-control" id="cmbSucursalID_rep_acumulado_compras_contabilidad" 
										 		name="intSucursalID_rep_acumulado_compras_contabilidad" tabindex="1">
	                          				
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
	function permisos_rep_acumulado_compras_contabilidad()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('contabilidad/Rep_acumulado_compras/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_acumulado_compras_contabilidad').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepAcumuladoComprasContabilidad = data.row;
				//Separar la cadena 
				var arrPermisosRepAcumuladoComprasContabilidad = strPermisosRepAcumuladoComprasContabilidad.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepAcumuladoComprasContabilidad.length; i++)
				{	//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepAcumuladoComprasContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_acumulado_compras_contabilidad').removeAttr('disabled');
					}				
					if(arrPermisosRepAcumuladoComprasContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_acumulado_compras_contabilidad').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Regresar sucursales activas para cargarlas en el combobox
	function cargar_sucursales_rep_acumulado_compras_contabilidad()
	{
		//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
		$.post('administracion/sucursales/get_combo_box', {},
			function(data)
			{
				$('#cmbSucursalID_rep_acumulado_compras_contabilidad').empty();
				var temp = Mustache.render($('#sucursales_rep_acumulado_compras_contabilidad').html(), data);
				var todas = '<option value="0">TODAS</option>';
				res = todas.concat(temp);
				$('#cmbSucursalID_rep_acumulado_compras_contabilidad').html(res);
			},
			'json');
	}




		

		//Controles o Eventos del Modal
		$(document).ready(function() {
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Hacer un llamado a la función para cargar sucursales en el combobox del modal
			cargar_sucursales_rep_acumulado_compras_contabilidad();
			//Asignar el año actual			
			$('#txtAnio_rep_acumulado_compras_contabilidad').val(anioActual()); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_acumulado_compras_contabilidad();
			

		});
	</script>