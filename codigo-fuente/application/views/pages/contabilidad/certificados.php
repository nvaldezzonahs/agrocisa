	<div id="CertificadosContabilidadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_certificados_contabilidad" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_certificados_contabilidad" 
								   name="strBusqueda_certificados_contabilidad"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_certificados_contabilidad"
										onclick="paginacion_certificados_contabilidad();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_certificados_contabilidad" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_certificados_contabilidad"
									onclick="reporte_certificados_contabilidad('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_certificados_contabilidad"
									onclick="reporte_certificados_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre de barra de herramientas-->
		<!--Estilo que se utiliza para mostrar los nombres de las columnas de la tabla en el dispositivo móvil -->
		<style>
			@media (max-width: 480px) 
			{
			    /*
				Definir columnas
				*/
				td.movil:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Vigencia desde"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Vigencia hasta"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_certificados_contabilidad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Vigencia desde</th>
							<th class="movil">Vigencia hasta</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_certificados_contabilidad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{folio}}</td>
							<td class="movil">{{vigencia_desde}}</td>
							<td class="movil">{{vigencia_hasta}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_certificados_contabilidad({{certificado_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_certificados_contabilidad({{certificado_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_certificados_contabilidad({{certificado_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_certificados_contabilidad({{certificado_id}},'{{estatus}}')"  
										title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="3"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_certificados_contabilidad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_certificados_contabilidad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="CertificadosContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_certificados_contabilidad"  class="ModalBodyTitle">
			<h1>Certificados</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCertificadosContabilidad" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmCertificadosContabilidad" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Folio-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCertificadoID_certificados_contabilidad" 
										   name="intCertificadoID_certificados_contabilidad" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el folio anterior y así evitar duplicidad en caso de que exista otro registro con el mismo folio-->
									<input id="txtFolioAnterior_certificados_contabilidad" 
										   name="strFolioAnterior_certificados_contabilidad" type="hidden" value="">
									</input>
									<label for="txtFolio_certificados_contabilidad">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_certificados_contabilidad" 
											name="strFolio_certificados_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese folio" maxlength="20">
									</input>
								</div>
							</div>
						</div>
						<!--Vigencia desde-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtVigenciaDesde_certificados_contabilidad">Vigencia desde</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteVigenciaDesde_certificados_contabilidad'>
					                    <input class="form-control" id="txtVigenciaDesde_certificados_contabilidad"
					                    		name= "strVigenciaDesde_certificados_contabilidad" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Vigencia hasta-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtVigenciaHasta_certificados_contabilidad">Vigencia hasta</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteVigenciaHasta_certificados_contabilidad'>
					                    <input class="form-control" id="txtVigenciaHasta_certificados_contabilidad"
					                    		name= "strVigenciaHasta_certificados_contabilidad" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_certificados_contabilidad"  
									onclick="validar_certificados_contabilidad();" title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_certificados_contabilidad"  
									onclick="cambiar_estatus_certificados_contabilidad('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_certificados_contabilidad"  
									onclick="cambiar_estatus_certificados_contabilidad('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_certificados_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_certificados_contabilidad();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#CertificadosContabilidadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaCertificadosContabilidad = 0;
		var strUltimaBusquedaCertificadosContabilidad = "";
		//Variable que se utiliza para asignar objeto del modal
		var objCertificadosContabilidad = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_certificados_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/certificados/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_certificados_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCertificadosContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosCertificadosContabilidad = strPermisosCertificadosContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCertificadosContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCertificadosContabilidad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_certificados_contabilidad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosCertificadosContabilidad[i]=='GUARDAR') || (arrPermisosCertificadosContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_certificados_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosCertificadosContabilidad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_certificados_contabilidad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_certificados_contabilidad();
						}
						else if(arrPermisosCertificadosContabilidad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_certificados_contabilidad').removeAttr('disabled');
							$('#btnRestaurar_certificados_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosCertificadosContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_certificados_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosCertificadosContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_certificados_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_certificados_contabilidad() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_certificados_contabilidad').val() != strUltimaBusquedaCertificadosContabilidad)
			{
				intPaginaCertificadosContabilidad = 0;
				strUltimaBusquedaCertificadosContabilidad = $('#txtBusqueda_certificados_contabilidad').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('contabilidad/certificados/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_certificados_contabilidad').val(),
						intPagina:intPaginaCertificadosContabilidad,
						strPermisosAcceso: $('#txtAcciones_certificados_contabilidad').val()
					},
					function(data){
						$('#dg_certificados_contabilidad tbody').empty();
						var tmpCertificadosContabilidad = Mustache.render($('#plantilla_certificados_contabilidad').html(),data);
						$('#dg_certificados_contabilidad tbody').html(tmpCertificadosContabilidad);
						$('#pagLinks_certificados_contabilidad').html(data.paginacion);
						$('#numElementos_certificados_contabilidad').html(data.total_rows);
						intPaginaCertificadosContabilidad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_certificados_contabilidad(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/certificados/';

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
										'strBusqueda': $('#txtBusqueda_certificados_contabilidad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_certificados_contabilidad()
		{
			//Incializar formulario
			$('#frmCertificadosContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_certificados_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmCertificadosContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_certificados_contabilidad');
			//Habilitar todos los elementos del formulario
			$('#frmCertificadosContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar la siguiente caja de texto
			$("#txtDiasVigencia_certificados_contabilidad").attr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_certificados_contabilidad").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_certificados_contabilidad").hide();
			$("#btnRestaurar_certificados_contabilidad").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_certificados_contabilidad()
		{
			try {
				//Cerrar modal
				objCertificadosContabilidad.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_certificados_contabilidad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_certificados_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_certificados_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmCertificadosContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFolio_certificados_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba el folio para este certificado'}
											}
										},
										strVigenciaDesde_certificados_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strVigenciaHasta_certificados_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_certificados_contabilidad = $('#frmCertificadosContabilidad').data('bootstrapValidator');
			bootstrapValidator_certificados_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_certificados_contabilidad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_certificados_contabilidad();
			}
			else 
				return;
		}

		//Función para verificar que un certificado no se encuentre activo
		function get_certificado_activo_certificados_contabilidad()
		{
			//Hacer un llamado al método del controlador para verificar existencia de un certificado activo
			$.post('contabilidad/certificados/get_existencia',
			       {
			       },
			       function(data) {
			        	//Si existe un certificado activo
			            if(data.mensaje)
			            {
			            	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_certificados_contabilidad('error', data.mensaje);
			       	    }
			       	    else
			       	    {	
		       	    		//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_certificados_contabilidad();
							//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
							$('#divEncabezadoModal_certificados_contabilidad').addClass("estatus-NUEVO");
							//Abrir modal
							 objCertificadosContabilidad = $('#CertificadosContabilidadBox').bPopup({
														   appendTo: '#CertificadosContabilidadContent', 
							                               contentContainer: 'CertificadosContabilidadM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtFolio_certificados_contabilidad').focus();
			       	    }
			       },
			       'json');
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_certificados_contabilidad()
		{
			try
			{
				$('#frmCertificadosContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_certificados_contabilidad()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('contabilidad/certificados/guardar',
					{ 
						intCertificadoID: $('#txtCertificadoID_certificados_contabilidad').val(),
						strFolio: $('#txtFolio_certificados_contabilidad').val(),
						strFolioAnterior: $('#txtFolioAnterior_certificados_contabilidad').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteVigenciaDesde: $.formatFechaMysql($('#txtVigenciaDesde_certificados_contabilidad').val()),
						dteVigenciaHasta: $.formatFechaMysql($('#txtVigenciaHasta_certificados_contabilidad').val())
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_certificados_contabilidad();
							//Hacer un llamado a la función para cerrar modal
							cerrar_certificados_contabilidad();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_certificados_contabilidad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_certificados_contabilidad(tipoMensaje, mensaje)
		{
			//Si el tipo de mensaje es error 
			if(tipoMensaje == 'error')
			{ 
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog(mensaje, 
							  {'type': 'error',
							   'title': 'Error'
				    		  });
			}
			else
			{
			    //Indicar al usuario el mensaje de éxito
				new $.Zebra_Dialog(mensaje, 
							  {'type': 'confirmation',
							   'title': 'Éxito',
							   'buttons': false,
						       'modal': false,
						       'auto_close': 2000
					    	  });
			}
		}

		// Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_certificados_contabilidad(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCertificadoID_certificados_contabilidad').val();

			}
			else
			{
				intID = id;
				strTipo = 'gridview';
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
				             {'type':     'question',
				              'title':    'Certificados',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_certificados_contabilidad(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_certificados_contabilidad(intID, strTipo, 'ACTIVO');
				
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_certificados_contabilidad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('contabilidad/certificados/set_estatus',
			      {intCertificadoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_certificados_contabilidad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_certificados_contabilidad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_certificados_contabilidad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_certificados_contabilidad(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/certificados/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_certificados_contabilidad();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

				          	//Recuperar valores
				            $('#txtCertificadoID_certificados_contabilidad').val(data.row.certificado_id);
				            $('#txtFolio_certificados_contabilidad').val(data.row.folio);
				            $('#txtFolioAnterior_certificados_contabilidad').val(data.row.folio);
				            $('#txtVigenciaDesde_certificados_contabilidad').val(data.row.vigencia_desde);
				            $('#txtVigenciaHasta_certificados_contabilidad').val(data.row.vigencia_hasta);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_certificados_contabilidad').addClass("estatus-"+strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_certificados_contabilidad").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmCertificadosContabilidad').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_certificados_contabilidad").hide(); 
								
								//Si no existe un certificado Activo
								if(data.certificado != 'existe')
								{
									//Mostrar botón Restaurar
									$("#btnRestaurar_certificados_contabilidad").show();
								}
								
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objCertificadosContabilidad = $('#CertificadosContabilidadBox').bPopup({
															  appendTo: '#CertificadosContabilidadContent', 
								                              contentContainer: 'CertificadosContabilidadM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtFolio_certificados_contabilidad').focus();
					        }
			       	    }
			       },
			       'json');
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteVigenciaDesde_certificados_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteVigenciaHasta_certificados_contabilidad').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteVigenciaDesde_certificados_contabilidad').on('dp.change', function (e) {
				$('#dteVigenciaHasta_certificados_contabilidad').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteVigenciaHasta_certificados_contabilidad').on('dp.change', function (e) {
				$('#dteVigenciaDesde_certificados_contabilidad').data('DateTimePicker').maxDate(e.date);
			});


			//Comprobar la existencia del folio en la BD cuando pierda el enfoque la caja de texto
			$('#txtFolio_certificados_contabilidad').focusout(function(e){
				//Si no existe id, verificar la existencia del folio
				if ($('#txtCertificadoID_certificados_contabilidad').val() == '' && $('#txtFolio_certificados_contabilidad').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el folio 
					editar_certificados_contabilidad($('#txtFolio_certificados_contabilidad').val(), 'folio', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_certificados_contabilidad').on('click','a',function(event){
				event.preventDefault();
				intPaginaCertificadosContabilidad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_certificados_contabilidad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_certificados_contabilidad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para verificar que un certificado no se encuentre activo
				get_certificado_activo_certificados_contabilidad();
				
			});

			//Enfocar caja de texto
			$('#txtBusqueda_certificados_contabilidad').focus();  
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_certificados_contabilidad();
		});
	</script>