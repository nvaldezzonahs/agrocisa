<div id="RepCatalogoCuentasXmlContabilidadContent">  
		<!--Diseño del formulario-->
		<form id="frmRepCatalogoCuentasXmlContablidad" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepCatalogoCuentasXmlContablidad" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_catalogo_cuentas_xml_contabilidad"
									onclick="validar_rep_catalogo_cuentas_xml_contabilidad();" title="Generar XML" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
					<div class="row">
						<!--Título-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12 text-center">
									<label for="txtTitulo_rep_catalogo_cuentas_xml_contabilidad"><strong>GENERACIÓN DEL XML DEL CATÁLOGO DE CUENTAS</strong></label>
								</div>
							</div>
						</div>
				    </div>
			    	<div class="row">
				    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    		<!--Tipo de reporte -->							
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipoReporte_rep_catalogo_cuentas_xml_contabilidad">Tipo de reporte</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipoReporte_rep_catalogo_cuentas_xml_contabilidad" 
									 		name="strTipoReporte_rep_catalogo_cuentas_xml_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>                  
										<option value="TODAS">Catálogo completo</option>
										<option value="PERIODO">Cuentas utilizadas durante un periodo</option>
                     				</select>
								</div>
							</div>
				    	</div>
				    </div>
				    <!--Div que contiene los campos del periodo-->
				    <div id="divCamposPeriodo_rep_catalogo_cuentas_xml_contabilidad" class="row">
				    	<!-- Mes -->		
				    	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbMes_rep_catalogo_cuentas_xml_contabilidad">Mes</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMes_rep_catalogo_cuentas_xml_contabilidad" 
									 		name="strMes_rep_catalogo_cuentas_xml_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>                  
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
				    	<!--Año-->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtAnio_rep_catalogo_cuentas_xml_contabilidad">Año</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtAnio_rep_catalogo_cuentas_xml_contabilidad" 
											name="strAnio_rep_catalogo_cuentas_xml_contabilidad" type="number" value=""
											tabindex="1" placeholder="Ingrese año" maxlength="4" />
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
		function permisos_rep_catalogo_cuentas_xml_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/rep_catalogo_cuentas_xml/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_catalogo_cuentas_xml_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepCatalogoCuentasXmlContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosRepCatalogoCuentasXmlContabilidad = strPermisosRepCatalogoCuentasXmlContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepCatalogoCuentasXmlContabilidad.length; i++)
					{	//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepCatalogoCuentasXmlContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_catalogo_cuentas_xml_contabilidad').removeAttr('disabled');
						}				
						else if(arrPermisosRepCatalogoCuentasXmlContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_catalogo_cuentas_xml_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_catalogo_cuentas_xml_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_catalogo_cuentas_xml_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmRepCatalogoCuentasXmlContablidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strTipoReporte_rep_catalogo_cuentas_xml_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo de reporte'}
											}
										},
										strMes_rep_catalogo_cuentas_xml_contabilidad: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el mes cuando el tipo de reporte sea por periodo
						                                    if($('#cmbTipoReporte_rep_catalogo_cuentas_xml_contabilidad').val() == "PERIODO")
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Seleccione un mes'
						                                        	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strAnio_rep_catalogo_cuentas_xml_contabilidad: {
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
			var bootstrapValidator_rep_catalogo_cuentas_xml_contabilidad = $('#frmRepCatalogoCuentasXmlContablidad').data('bootstrapValidator');
			bootstrapValidator_rep_catalogo_cuentas_xml_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_catalogo_cuentas_xml_contabilidad.isValid())
			{
				
			 	//Hacer un llamado a la función para generar XML
			 	generar_xml_rep_catalogo_cuentas_xml_contabilidad();
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_catalogo_cuentas_xml_contabilidad()
		{
			try
			{
				$('#frmRepCatalogoCuentasXmlContablidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para generar XML
		function generar_xml_rep_catalogo_cuentas_xml_contabilidad() 
		{
			
			//Definir encapsulamiento de datos que son necesarios para generar el XML
			objReporte = {'url': 'contabilidad/rep_catalogo_cuentas_xml/get_xml',
							'data' : {
										
										'strTipoReporte': $('#cmbTipoReporte_rep_catalogo_cuentas_xml_contabilidad').val(), 
										'strMes': $('#cmbMes_rep_catalogo_cuentas_xml_contabilidad').val(),
										'strAnio': $('#txtAnio_rep_catalogo_cuentas_xml_contabilidad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el XML
			$.imprimirReporte(objReporte);
		}
		

		
		

		//Controles o Eventos del Modal
		$(document).ready(function() {
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Asignar el año actual
       		$('#txtAnio_rep_catalogo_cuentas_xml_contabilidad').val(anioActual()); 
       		//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtAnio_rep_catalogo_cuentas_xml_contabilidad').numeric({decimal: false, negative: false});
        	//Ocultar div que contiene los campos del periodo
			$('#divCamposPeriodo_rep_catalogo_cuentas_xml_contabilidad').hide();

		    //Ocultar/Mostrar controles del formulario cuando cambie la opción del combobox
	        $('#cmbTipoReporte_rep_catalogo_cuentas_xml_contabilidad').change(function(e){   

	        	//Variable que se utiliza para asignar el tipo de reporte
				var strTipoReporte = $('#cmbTipoReporte_rep_catalogo_cuentas_xml_contabilidad').val();

				//Dependiendo del tipo de reporte habilitar/deshabilitar controles del formulario
				if(strTipoReporte == "TODAS" || strTipoReporte == "")
				{
					//Limpiar las siguientes cajas de texto
					$('#cmbMes_rep_catalogo_cuentas_xml_contabilidad').val('');
					//Asignar el año actual
					$('#txtAnio_rep_catalogo_cuentas_xml_contabilidad').val(anioActual()); 
					//Ocultar div que contiene los campos del periodo
					$('#divCamposPeriodo_rep_catalogo_cuentas_xml_contabilidad').hide()
				}
				else
				{
					//Mostrar div que contiene los campos del periodo
					$('#divCamposPeriodo_rep_catalogo_cuentas_xml_contabilidad').show();
					//Enfocar combobox
					$('#cmbMes_rep_catalogo_cuentas_xml_contabilidad').focus();
						
				}
             	
	        });


        	//Enfocar combobox
			$('#cmbTipoReporte_rep_catalogo_cuentas_xml_contabilidad').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_catalogo_cuentas_xml_contabilidad();

		});
	</script>
	