<div id="RepCuentasPresupuestosContabilidadContent">  
		<!--Diseño del formulario-->
		<form id="frmRepCuentasPresupuestosContabilidad" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepCuentasPresupuestosContabilidad" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_cuentas_presupuestos_contabilidad"
									onclick="validar_rep_cuentas_presupuestos_contabilidad('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_cuentas_presupuestos_contabilidad"
									onclick="validar_rep_cuentas_presupuestos_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				<div class="row">					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
						<!--Año-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtAnio_rep_cuentas_presupuestos_contabilidad">Año</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtAnio_rep_cuentas_presupuestos_contabilidad" 
												name="strAnio_rep_cuentas_presupuestos_contabilidad" type="number" value=""
												tabindex="1" placeholder="Ingrese año" maxlength="4" />
									</div>
								</div>
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
		function permisos_rep_cuentas_presupuestos_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/rep_cuentas_presupuestos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_cuentas_presupuestos_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepCuentasPresupuestosContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosRepCuentasPresupuestosContabilidad = strPermisosRepCuentasPresupuestosContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepCuentasPresupuestosContabilidad.length; i++)
					{	//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepCuentasPresupuestosContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_cuentas_presupuestos_contabilidad').removeAttr('disabled');
						}				
						else if(arrPermisosRepCuentasPresupuestosContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_cuentas_presupuestos_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_cuentas_presupuestos_contabilidad(strTipo) 
		{	//Hacer un llamado a la función para limpiar los mensajes de error 
				limpiar_mensajes_rep_cuentas_presupuestos_contabilidad();
				//Validación del formulario de campos obligatorios
				$('#frmRepCuentasPresupuestosContabilidad')
					.bootstrapValidator({excluded: [':disabled'],
										 container: 'popover',
										 feedbackIcons: {
										 	valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
										  },
										  fields: {
											strAnio_rep_cuentas_presupuestos_contabilidad: {
												validators: {
													notEmpty: {message: 'Escriba un año'},
													stringLength: {
														min: 4,
														message: 'El año debe tener 4 caracteres de longitud'
													}
												}
											}
										}
					});
				//Variable que se utiliza para asignar el objeto bootstrapValidator
				var bootstrapValidator_rep_cuentas_presupuestos_contabilidad = $('#frmRepCuentasPresupuestosContabilidad').data('bootstrapValidator');
				bootstrapValidator_rep_cuentas_presupuestos_contabilidad.validate();
				//Si se cumplen las reglas de validación
				if(bootstrapValidator_rep_cuentas_presupuestos_contabilidad.isValid())
				{	
					//Hacer un llamado a la función para generar reporte en PDF/XLS
					reporte_rep_cuentas_presupuestos_contabilidad(strTipo);
					
				}
				else 
					return;
			

		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_cuentas_presupuestos_contabilidad()
		{
			try
			{
				$('#frmRepCuentasPresupuestosContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_cuentas_presupuestos_contabilidad(strTipo) 
		{			
	     	//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/rep_cuentas_presupuestos/';

			//Si el tipo de reporte es PDF
			if(strTipo == 'PDF')
			{
				//Concatenar nombre de la función que genera el reporte PDF
				strUrl += 'get_reporte';
			}
			else
			{
				//Concatenar nombre de la función que genera el archivo XLS
				strUrl += 'get_xls';
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'strAnio': $('#txtAnio_rep_cuentas_presupuestos_contabilidad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}


		//Controles o Eventos del Modal
		$(document).ready(function() {
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Asignar el año actual			
			$('#txtAnio_rep_cuentas_presupuestos_contabilidad').val(anioActual()); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_cuentas_presupuestos_contabilidad();
		});
	</script>
	