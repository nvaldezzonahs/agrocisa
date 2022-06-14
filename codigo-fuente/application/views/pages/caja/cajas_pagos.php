	<div id="CajasPagosCajaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_cajas_pagos_caja" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_cajas_pagos_caja" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_cajas_pagos_caja">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_cajas_pagos_caja'>
				                    <input class="form-control" id="txtFechaInicialBusq_cajas_pagos_caja"
				                    		name= "strFechaInicialBusq_cajas_pagos_caja" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Fecha final-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaFinalBusq_cajas_pagos_caja">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_cajas_pagos_caja'>
				                    <input class="form-control" id="txtFechaFinalBusq_cajas_pagos_caja"
				                    		name= "strFechaFinalBusq_cajas_pagos_caja" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los empleados activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
								<input id="txtEmpleadoIDBusq_cajas_pagos_caja" 
									   name="intEmpleadoIDBusq_cajas_pagos_caja"  type="hidden" 
									   value="">
								</input>
								<label for="txtEmpleadoBusq_cajas_pagos_caja">Empleado</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtEmpleadoBusq_cajas_pagos_caja" 
										name="strEmpleadoBusq_cajas_pagos_caja" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_cajas_pagos_caja"
									onclick="paginacion_cajas_pagos_caja();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_cajas_pagos_caja" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_cajas_pagos_caja"
									onclick="reporte_cajas_pagos_caja();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_cajas_pagos_caja"
									onclick="descargar_xls_cajas_pagos_caja();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Empleado"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Vale"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Importe"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_cajas_pagos_caja">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Empleado</th>
							<th class="movil">Vale</th>
							<th class="movil">Importe</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_cajas_pagos_caja" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">
							<td class="movil">{{folio}}</td> 
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{empleado}}</td>
							<td class="movil">{{vale}}</td>
							<td class="movil">{{importe}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_cajas_pagos_caja({{caja_pago_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_cajas_pagos_caja({{caja_pago_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_cajas_pagos_caja({{caja_pago_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_cajas_pagos_caja({{caja_pago_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_cajas_pagos_caja({{caja_pago_id}},'{{estatus}}')"  title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="7"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_cajas_pagos_caja"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_cajas_pagos_caja">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="CajasPagosCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_cajas_pagos_caja"  class="ModalBodyTitle">
			<h1>Pagos a Caja Chica</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCajasPagosCaja" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmCajasPagosCaja"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCajaPagoID_cajas_pagos_caja" 
										   name="intCajaPagoID_cajas_pagos_caja" type="hidden" value="">
									</input>
									<label for="txtFolio_cajas_pagos_caja">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_cajas_pagos_caja" 
											name="strFolio_cajas_pagos_caja" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_cajas_pagos_caja">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_cajas_pagos_caja'>
					                    <input class="form-control" id="txtFecha_cajas_pagos_caja"
					                    		name= "strFecha_cajas_pagos_caja" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los empleados activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
									<input id="txtEmpleadoID_cajas_pagos_caja" 
										   name="intEmpleadoID_cajas_pagos_caja"  type="hidden" value="">
									</input>
									<label for="txtEmpleado_cajas_pagos_caja">Empleado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEmpleado_cajas_pagos_caja" 
											name="strEmpleado_cajas_pagos_caja" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene los vales de caja activos del empleado seleccionado-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del vale de caja seleccionado-->
									<input id="txtCajaValeID_cajas_pagos_caja" 
										   name="intCajaValeID_cajas_pagos_caja"  type="hidden" value="">
									</input>
									<label for="txtCajaVale_cajas_pagos_caja">Vale de caja</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCajaVale_cajas_pagos_caja" 
											name="strCajaVale_cajas_pagos_caja" type="text" value="" tabindex="1" placeholder="Ingrese vale de caja" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    	<!--Importe-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporte_cajas_pagos_caja">Importe</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_cajas_pagos_caja" id="txtImporte_cajas_pagos_caja" 
												name="intImporte_cajas_pagos_caja" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="12">
										</input>
										
									</div>
								</div>
							</div>
						</div>
						<!--Saldo pendiente-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el saldo  pendiente del vale de caja seleccionado-->
									<input id="txtSaldoPendiente_cajas_pagos_caja" 
										   name="intSaldoPendiente_cajas_pagos_caja"  type="hidden" value="">
									</input>
									<label for="txtSaldoRestante_cajas_pagos_caja">Saldo</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control" id="txtSaldoRestante_cajas_pagos_caja" 
												name="intSaldoRestante_cajas_pagos_caja" type="text" value="">
										</input>
										
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Observaciones-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_cajas_pagos_caja">Observaciones</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtObservaciones_cajas_pagos_caja" 
											   name="strObservaciones_cajas_pagos_caja" rows="3" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_cajas_pagos_caja"  
									onclick="validar_cajas_pagos_caja();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_cajas_pagos_caja"  
									onclick="reporte_registro_cajas_pagos_caja('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_cajas_pagos_caja"  
									onclick="cambiar_estatus_cajas_pagos_caja('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_cajas_pagos_caja"  
									onclick="cambiar_estatus_cajas_pagos_caja('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cajas_pagos_caja"
									type="reset" aria-hidden="true" onclick="cerrar_cajas_pagos_caja();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#CajasPagosCajaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaCajasPagosCaja = 0;
		var strUltimaBusquedaCajasPagosCaja = "";
		//Variables que se utilizan para la búsqueda de registros
		var intEmpleadoIDCajasPagosCaja = "";
		var dteFechaInicialCajasPagosCaja = "";
		var dteFechaFinalCajasPagosCaja = "";
		//Variable que se utiliza para asignar objeto del modal
		var objCajasPagosCaja = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_cajas_pagos_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/cajas_pagos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_cajas_pagos_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCajasPagosCaja = data.row;
					//Separar la cadena 
					var arrPermisosCajasPagosCaja = strPermisosCajasPagosCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCajasPagosCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCajasPagosCaja[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_cajas_pagos_caja').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosCajasPagosCaja[i]=='GUARDAR') || (arrPermisosCajasPagosCaja[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_cajas_pagos_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasPagosCaja[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_cajas_pagos_caja').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_cajas_pagos_caja();
						}
						else if(arrPermisosCajasPagosCaja[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_cajas_pagos_caja').removeAttr('disabled');
							$('#btnRestaurar_cajas_pagos_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasPagosCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_cajas_pagos_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasPagosCaja[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_cajas_pagos_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasPagosCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_cajas_pagos_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_cajas_pagos_caja() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaCajasPagosCaja =($('#txtFechaInicialBusq_cajas_pagos_caja').val()+$('#txtFechaFinalBusq_cajas_pagos_caja').val()+$('#txtEmpleadoIDBusq_cajas_pagos_caja').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaCajasPagosCaja != strUltimaBusquedaCajasPagosCaja)
			{
				intPaginaCajasPagosCaja = 0;
				strUltimaBusquedaCajasPagosCaja = strNuevaBusquedaCajasPagosCaja;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/cajas_pagos/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_cajas_pagos_caja').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_cajas_pagos_caja').val()),
					 intEmpleadoID: $('#txtEmpleadoIDBusq_cajas_pagos_caja').val(),
					 intPagina: intPaginaCajasPagosCaja,
					 strPermisosAcceso: $('#txtAcciones_cajas_pagos_caja').val()
					},
					function(data){
						$('#dg_cajas_pagos_caja tbody').empty();
						var tmpCajasPagosCaja = Mustache.render($('#plantilla_cajas_pagos_caja').html(),data);
						$('#dg_cajas_pagos_caja tbody').html(tmpCajasPagosCaja);
						$('#pagLinks_cajas_pagos_caja').html(data.paginacion);
						$('#numElementos_cajas_pagos_caja').html(data.total_rows);
						intPaginaCajasPagosCaja = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_cajas_pagos_caja() 
		{
			//Asignar valores para la búsqueda de registros
			intEmpleadoIDCajasPagosCaja =  $('#txtEmpleadoIDBusq_cajas_pagos_caja').val();
			dteFechaInicialCajasPagosCaja =  $.formatFechaMysql($('#txtFechaInicialBusq_cajas_pagos_caja').val());
			dteFechaFinalCajasPagosCaja =  $.formatFechaMysql($('#txtFechaFinalBusq_cajas_pagos_caja').val());

			//Si no existe fecha inicial
			if(dteFechaInicialCajasPagosCaja == '')
			{
				dteFechaInicialCajasPagosCaja = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalCajasPagosCaja == '')
			{
				dteFechaFinalCajasPagosCaja =  '0000-00-00';
			}
			
			//Si no existe id del empleado
			if(intEmpleadoIDCajasPagosCaja == '')
			{
				intEmpleadoIDCajasPagosCaja = 0;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("caja/cajas_pagos/get_reporte/"+dteFechaInicialCajasPagosCaja+"/"+dteFechaFinalCajasPagosCaja+"/"+intEmpleadoIDCajasPagosCaja);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_cajas_pagos_caja(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtCajaPagoID_cajas_pagos_caja').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("caja/cajas_pagos/get_reporte_registro/"+intID);
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_cajas_pagos_caja() 
		{
			//Asignar valores para la búsqueda de registros
			intEmpleadoIDCajasPagosCaja =  $('#txtEmpleadoIDBusq_cajas_pagos_caja').val();
			dteFechaInicialCajasPagosCaja =  $.formatFechaMysql($('#txtFechaInicialBusq_cajas_pagos_caja').val());
			dteFechaFinalCajasPagosCaja =  $.formatFechaMysql($('#txtFechaFinalBusq_cajas_pagos_caja').val());

			//Si no existe fecha inicial
			if(dteFechaInicialCajasPagosCaja == '')
			{
				dteFechaInicialCajasPagosCaja = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalCajasPagosCaja == '')
			{
				dteFechaFinalCajasPagosCaja =  '0000-00-00';
			}
			
			//Si no existe id del empleado
			if(intEmpleadoIDCajasPagosCaja == '')
			{
				intEmpleadoIDCajasPagosCaja = 0;
			}

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("caja/cajas_pagos/get_xls/"+dteFechaInicialCajasPagosCaja+"/"+dteFechaFinalCajasPagosCaja+"/"+intEmpleadoIDCajasPagosCaja);
		}
		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_cajas_pagos_caja()
		{
			//Incializar formulario
			$('#frmCajasPagosCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cajas_pagos_caja();
			//Limpiar cajas de texto ocultas
			$('#frmCajasPagosCaja').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_cajas_pagos_caja').val(fechaActual()); 
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_cajas_pagos_caja').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_cajas_pagos_caja').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_cajas_pagos_caja').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmCajasPagosCaja').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_cajas_pagos_caja').attr("disabled", "disabled");
			$('#txtSaldoRestante_cajas_pagos_caja').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_cajas_pagos_caja").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_cajas_pagos_caja").hide();
			$("#btnDesactivar_cajas_pagos_caja").hide();
			$("#btnRestaurar_cajas_pagos_caja").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_cajas_pagos_caja()
		{
			try {
				//Cerrar modal
				objCajasPagosCaja.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_cajas_pagos_caja').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cajas_pagos_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cajas_pagos_caja();
			//Validación del formulario de campos obligatorios
			$('#frmCajasPagosCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_cajas_pagos_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
									  	strEmpleado_cajas_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtEmpleadoID_cajas_pagos_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un empleado existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCajaVale_cajas_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vale de caja
					                                    if($('#txtCajaValeID_cajas_pagos_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un vale de caja existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intImporte_cajas_pagos_caja: {
											validators: {
												notEmpty: {message: 'Escriba un importe'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cajas_pagos_caja = $('#frmCajasPagosCaja').data('bootstrapValidator');
			bootstrapValidator_cajas_pagos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cajas_pagos_caja.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_cajas_pagos_caja();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cajas_pagos_caja()
		{
			try
			{
				$('#frmCajasPagosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para verificar que la caja de la sucursal se encuentre abierta
		function get_apertura_caja_cajas_pagos_caja()
		{
			//Hacer un llamado al método del controlador para verificar existencia de caja abierta
			$.post('caja/cajas_apertura/get_existencia',
			       {strFormulario: ''
			       },
			       function(data) {
			        	//Si no hay caja abierta
			            if(data.mensaje)
			            {
			            	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_cajas_pagos_caja('error', data.mensaje);
			       	    }
			       	    else
			       	    {	
		       	    		//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cajas_pagos_caja();
							//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
							$('#divEncabezadoModal_cajas_pagos_caja').addClass("estatus-NUEVO");
							//Abrir modal
							objCajasPagosCaja = $('#CajasPagosCajaBox').bPopup({
												    appendTo: '#CajasPagosCajaContent', 
					                                contentContainer: 'CajasPagosCajaM', 
					                                zIndex: 2, 
					                                modalClose: false, 
					                                modal: true, 
					                                follow: [true,false], 
					                                followEasing : "linear", 
					                                easing: "linear", 
					                                modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtEmpleado_cajas_pagos_caja').focus();
			       	    }
			       },
			       'json');
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_cajas_pagos_caja()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('caja/cajas_pagos/guardar',
					{ 
						intCajaPagoID: $('#txtCajaPagoID_cajas_pagos_caja').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_cajas_pagos_caja').val()),
						intEmpleadoID: $('#txtEmpleadoID_cajas_pagos_caja').val(),
						intCajaValeID: $('#txtCajaValeID_cajas_pagos_caja').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intImporte: $.reemplazar($("#txtImporte_cajas_pagos_caja").val(), ",", ""),
						strObservaciones: $('#txtObservaciones_cajas_pagos_caja').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_cajas_pagos_caja').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_cajas_pagos_caja();
							//Hacer un llamado a la función para cerrar modal
							cerrar_cajas_pagos_caja();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cajas_pagos_caja(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cajas_pagos_caja(tipoMensaje, mensaje)
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
			else if(tipoMensaje == 'informacion')
			{ 
				//Indicar al usuario el mensaje de información
				new $.Zebra_Dialog(mensaje, {
								'type': 'information',
								'title': 'Información',
								'buttons': [{caption: 'Aceptar',
											 callback: function () {
												//Enfocar caja de texto
												$('#txtImporte_cajas_pagos_caja').focus();
											 }
											}]
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
		function cambiar_estatus_cajas_pagos_caja(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCajaPagoID_cajas_pagos_caja').val();

			}
			else
			{
				intID = id;
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
				             {'type':     'question',
				              'title':    'Pagos a Caja Chica',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('caja/cajas_pagos/set_estatus',
				                                     {intCajaPagoID: intID,
				                                      strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                        	//Hacer llamado a la función  para cargar  los registros en el grid
				                                            paginacion_cajas_pagos_caja();

				                                            //Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_cajas_pagos_caja();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_cajas_pagos_caja(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('caja/cajas_pagos/set_estatus',
				     {intCajaPagoID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_cajas_pagos_caja();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_cajas_pagos_caja();     
							}
				        }
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_cajas_pagos_caja(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_cajas_pagos_caja(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/cajas_pagos/get_datos',
			       {intCajaPagoID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cajas_pagos_caja();
							//Variable que se utiliza para asignar el saldo pendiente del vale de caja
						    var intSaldoPendiente = 0;
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar el importe del pago
						    var intImporte = parseFloat(data.row.importe);
						    //Variable que se utiliza para asignar el saldo restante del vale de caja
						    var intSaldoRestante = parseFloat(data.row.saldo);
						  
						    //Calcular saldo pendiente del vale de caja
						    intSaldoPendiente = intImporte + intSaldoRestante;

				          	//Recuperar valores
				          	$('#txtCajaPagoID_cajas_pagos_caja').val(data.row.caja_pago_id);
				          	$('#txtFolio_cajas_pagos_caja').val(data.row.folio);
				          	$('#txtFecha_cajas_pagos_caja').val(data.row.fecha);
				          	$('#txtEmpleadoID_cajas_pagos_caja').val(data.row.empleado_id);
				          	$('#txtEmpleado_cajas_pagos_caja').val(data.row.empleado);
				          	$('#txtCajaValeID_cajas_pagos_caja').val(data.row.caja_vale_id);
				          	$('#txtCajaVale_cajas_pagos_caja').val(data.row.caja_vale);
						    $('#txtImporte_cajas_pagos_caja').val(intImporte);
						    $('#txtSaldoPendiente_cajas_pagos_caja').val(intSaldoPendiente);
						    $('#txtSaldoRestante_cajas_pagos_caja').val(intSaldoRestante);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporte_cajas_pagos_caja').formatCurrency({ roundToDecimalPlace: 2 });
					        $('#txtSaldoRestante_cajas_pagos_caja').formatCurrency({ roundToDecimalPlace: 2 });
					        $('#txtObservaciones_cajas_pagos_caja').val(data.row.observaciones);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_cajas_pagos_caja').addClass("estatus-"+strEstatus);
				            //Mostrar los siguientes botones
				            $("#btnImprimirRegistro_cajas_pagos_caja").show();
				           
				            //Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmCajasPagosCaja').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					           	$("#btnGuardar_cajas_pagos_caja").hide();
				            	
					            //Si no existe id del corte de caja
					            if(data.row.caja_corte_id == 0)
					            {
					            	//Si el estatus del registro es INACTIVO
				            		if(strEstatus== 'INACTIVO')
				            		{
				            			//Mostrar botón Restaurar
										$("#btnRestaurar_cajas_pagos_caja").show();
										
				            		}
				            	}

				            }
				            else
				            {
				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	//Mostrar los siguientes botones  
					            	$("#btnDesactivar_cajas_pagos_caja").show();
					            }
				            }

			            	//Abrir modal
							objCajasPagosCaja = $('#CajasPagosCajaBox').bPopup({
												    appendTo: '#CajasPagosCajaContent', 
					                                contentContainer: 'CajasPagosCajaM', 
					                                zIndex: 2, 
					                                modalClose: false, 
					                                modal: true, 
					                                follow: [true,false], 
					                                followEasing : "linear", 
					                                easing: "linear", 
					                                modalColor: ('#F0F0F0')});
				            //Enfocar caja de texto
							$('#txtEmpleado_cajas_pagos_caja').focus();
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
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_cajas_pagos_caja').datetimepicker({format: 'DD/MM/YYYY'});
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporte_cajas_pagos_caja').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_cajas_pagos_caja').blur(function(){
				$('.moneda_cajas_pagos_caja').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleado_cajas_pagos_caja').autocomplete({
	            source: function( request, response ) {
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtEmpleadoID_cajas_pagos_caja').val('');
	               $('#txtCajaValeID_cajas_pagos_caja').val('');
	               $('#txtCajaVale_cajas_pagos_caja').val('');
	               $('#txtSaldoPendiente_cajas_pagos_caja').val('');
	               $('#txtSaldoRestante_cajas_pagos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/empleados/autocomplete",
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
	              $('#txtEmpleadoID_cajas_pagos_caja').val(ui.item.data);
	             
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id del empleado cuando pierda el enfoque la caja de texto
	        $('#txtEmpleado_cajas_pagos_caja').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoID_cajas_pagos_caja').val() == '' ||
	               $('#txtEmpleado_cajas_pagos_caja').val() == '')
	            { 
	            	//Limpiar contenido de las siguientes cajas de texto
	                $('#txtEmpleadoID_cajas_pagos_caja').val('');
	                $('#txtEmpleado_cajas_pagos_caja').val('');
	                $('#txtCajaValeID_cajas_pagos_caja').val('');
	                $('#txtCajaVale_cajas_pagos_caja').val('');
	                $('#txtSaldoPendiente_cajas_pagos_caja').val('');
	                $('#txtSaldoRestante_cajas_pagos_caja').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un vale de caja
        	$('#txtCajaVale_cajas_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtCajaValeID_cajas_pagos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "caja/cajas_vales/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intEmpleadoID: $('#txtEmpleadoID_cajas_pagos_caja').val()
	                 },
	                 success: function( data ) {
	                   
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar valores del registro seleccionado
	             $('#txtCajaValeID_cajas_pagos_caja').val(ui.item.data);
	             $('#txtSaldoPendiente_cajas_pagos_caja').val(ui.item.saldo);
	             $('#txtSaldoRestante_cajas_pagos_caja').val(ui.item.saldo);
	             //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
			     $('#txtSaldoRestante_cajas_pagos_caja').formatCurrency({ roundToDecimalPlace: 2 });
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id del vale de caja cuando pierda el enfoque la caja de texto
	        $('#txtCajaVale_cajas_pagos_caja').focusout(function(e){
	            //Si no existe id del vale de caja
	            if($('#txtCajaValeID_cajas_pagos_caja').val() == '' ||
	               $('#txtCajaVale_cajas_pagos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCajaValeID_cajas_pagos_caja').val('');
	               $('#txtCajaVale_cajas_pagos_caja').val('');
	               $('#txtSaldoPendiente_cajas_pagos_caja').val('');
	               $('#txtSaldoRestante_cajas_pagos_caja').val('');
	            }
	        });


	        //Calcular el saldo restante cuando pierda el enfoque la caja de texto
	        $('#txtImporte_cajas_pagos_caja').focusout(function(e){
	            //Obtenemos los datos de las cajas de texto
	            var intSaldoPendiente = $('#txtSaldoPendiente_cajas_pagos_caja').val();
	            var intAbono = $('#txtImporte_cajas_pagos_caja').val(); 
	            //Variable que se utiliza para asignar el mensaje informativo
				var strMensaje = '';

				//Si no existe abono
				if(intAbono != '')
				{
					//Convertir cadena de texto a número decimal
					intAbono = parseFloat($.reemplazar(intAbono, ",", "")); 

		            //Verificar que el pago aplicado sea menor o igual que el saldo pendiente del vale de caja
		            if(intSaldoPendiente >= intAbono)
		            {
		            	//Calcular el saldo restante del vale de caja
						intSaldoRestante = intSaldoPendiente - intAbono;
						
						//Cambiar cantidad a formato moneda
				   		intSaldoRestante = formatMoney(intSaldoRestante, 2, '');
		            	
				    	//Asignar saldo restante
				    	$('#txtSaldoRestante_cajas_pagos_caja').val(intSaldoRestante);
		            }
		            else
		            {
		            	//Limpiar contenido de la caja de texto
				    	$('#txtImporte_cajas_pagos_caja').val('');

				    	//Cambiar cantidad a formato moneda
				   		intSaldoPendiente = formatMoney(intSaldoPendiente, 2, '');

				   		//Asignar saldo pendiente
				    	$('#txtSaldoRestante_cajas_pagos_caja').val(intSaldoPendiente);

		            	/*Mensaje que se utiliza para informar al usuario que el pago aplicado sobrepasa el saldo 
						  del vale de caja*/
						strMensaje = 'El pago aplicado sobrepasa el saldo del vale de caja.';
						strMensaje += '<br>Saldo restante: <b>'+intSaldoPendiente+'</b>';

						//Hacer un llamado a la función para mostrar mensaje de información
						mensaje_cajas_pagos_caja('informacion', strMensaje);
		            }
				}
	            
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_cajas_pagos_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_cajas_pagos_caja').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_cajas_pagos_caja').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_cajas_pagos_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_cajas_pagos_caja').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_cajas_pagos_caja').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleadoBusq_cajas_pagos_caja').autocomplete({
	            source: function( request, response ) {
            	   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtEmpleadoIDBusq_cajas_pagos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/empleados/autocomplete",
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
	             $('#txtEmpleadoIDBusq_cajas_pagos_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id del empleado cuando pierda el enfoque la caja de texto
	        $('#txtEmpleadoBusq_cajas_pagos_caja').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoIDBusq_cajas_pagos_caja').val() == '' ||
	               $('#txtEmpleadoBusq_cajas_pagos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoIDBusq_cajas_pagos_caja').val('');
	               $('#txtEmpleadoBusq_cajas_pagos_caja').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_cajas_pagos_caja').on('click','a',function(event){
				event.preventDefault();
				intPaginaCajasPagosCaja = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_cajas_pagos_caja();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_cajas_pagos_caja').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para verificar que la caja se encuentre abierta
				get_apertura_caja_cajas_pagos_caja();
				
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_cajas_pagos_caja').focus(); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_cajas_pagos_caja();
		});
	</script>