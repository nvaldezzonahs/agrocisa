	<div id="CajasIngresosCajaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_cajas_ingresos_caja" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_cajas_ingresos_caja" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_cajas_ingresos_caja">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_cajas_ingresos_caja'>
				                    <input class="form-control" id="txtFechaInicialBusq_cajas_ingresos_caja"
				                    		name= "strFechaInicialBusq_cajas_ingresos_caja" 
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
								<label for="txtFechaFinalBusq_cajas_ingresos_caja">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_cajas_ingresos_caja'>
				                    <input class="form-control" id="txtFechaFinalBusq_cajas_ingresos_caja"
				                    		name= "strFechaFinalBusq_cajas_ingresos_caja" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_cajas_ingresos_caja">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_cajas_ingresos_caja" 
										name="strConceptoBusq_cajas_ingresos_caja" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_cajas_ingresos_caja">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_cajas_ingresos_caja" 
								 		name="strEstatusBusq_cajas_ingresos_caja" tabindex="1">
								    <option value="TODOS">TODOS</option>
	                  				<option value="ACTIVO">ACTIVO</option>
	                  				<option value="INACTIVO">INACTIVO</option>
                 				</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 pull-right">
						<div id="ToolBtns" class="btn-group">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_cajas_ingresos_caja"
									onclick="paginacion_cajas_ingresos_caja();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_cajas_ingresos_caja" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_cajas_ingresos_caja"
									onclick="reporte_cajas_ingresos_caja();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_cajas_ingresos_caja"
									onclick="descargar_xls_cajas_ingresos_caja();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Fecha"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Concepto"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Cuenta"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Importe"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Imte. interno"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_cajas_ingresos_caja">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Fecha</th>
							<th class="movil">Concepto</th>
							<th class="movil">Cuenta</th>
							<th class="movil">Importe</th>
							<th class="movil">Impt. interno</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_cajas_ingresos_caja" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{concepto}}</td>
							<td class="movil">{{cuenta_bancaria}}</td>
							<td class="movil">{{importe}}</td>
							<td class="movil">{{importe_interno}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_cajas_ingresos_caja({{caja_ingreso_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_cajas_ingresos_caja({{caja_ingreso_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_cajas_ingresos_caja({{caja_ingreso_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_cajas_ingresos_caja({{caja_ingreso_id}},'{{estatus}}')"  title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="6"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_cajas_ingresos_caja"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_cajas_ingresos_caja">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="CajasIngresosCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_cajas_ingresos_caja"  class="ModalBodyTitle">
			<h1>Ingreso de Efectivo a Caja Chica</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCajasIngresosCaja" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmCajasIngresosCaja"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCajaIngresoID_cajas_ingresos_caja" 
										   name="intCajaIngresoID_cajas_ingresos_caja" type="hidden" value="">
									</input>
									<label for="txtFecha_cajas_ingresos_caja">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_cajas_ingresos_caja'>
					                    <input class="form-control" id="txtFecha_cajas_ingresos_caja"
					                    		name= "strFecha_cajas_ingresos_caja" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Concepto-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtConcepto_cajas_ingresos_caja">Concepto</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtConcepto_cajas_ingresos_caja" 
											name="strConcepto_cajas_ingresos_caja" type="text" value="" tabindex="1" placeholder="Ingrese concepto" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene las cuentas bancarias activas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta bancaria seleccionada-->
									<input id="txtCuentaBancariaID_cajas_ingresos_caja" 
										   name="intCuentaBancariaID_cajas_ingresos_caja"  type="hidden" 
										   value="">
									</input>
									<label for="txtCuentaBancaria_cajas_ingresos_caja">Cuenta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuentaBancaria_cajas_ingresos_caja" 
											name="strCuentaBancaria_cajas_ingresos_caja" type="text" value="" tabindex="1" placeholder="Ingrese cuenta bancaria" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Importe-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporte_cajas_ingresos_caja">Importe</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_cajas_ingresos_caja" id="txtImporte_cajas_ingresos_caja" 
												name="intImporte_cajas_ingresos_caja" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="12">
										</input>
										
									</div>
								</div>
							</div>
						</div>
						<!--Importe interno-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteInterno_cajas_ingresos_caja">Importe interno</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_cajas_ingresos_caja" id="txtImporteInterno_cajas_ingresos_caja" 
												name="intImporteInterno_cajas_ingresos_caja" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="12">
										</input>
										
									</div>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_cajas_ingresos_caja"  
									onclick="validar_cajas_ingresos_caja();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_cajas_ingresos_caja"  
									onclick="cambiar_estatus_cajas_ingresos_caja('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_cajas_ingresos_caja"  
									onclick="cambiar_estatus_cajas_ingresos_caja('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cajas_ingresos_caja"
									type="reset" aria-hidden="true" onclick="cerrar_cajas_ingresos_caja();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#CajasIngresosCajaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaCajasIngresosCaja = 0;
		var strUltimaBusquedaCajasIngresosCaja = "";
		//Variables que se utilizan para la búsqueda de registros
		var dteFechaInicialCajasIngresosCaja = "";
		var dteFechaFinalCajasIngresosCaja = "";
		//Variable que se utiliza para asignar objeto del modal
		var objCajasIngresosCaja = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_cajas_ingresos_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/cajas_ingresos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_cajas_ingresos_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCajasIngresosCaja = data.row;
					//Separar la cadena 
					var arrPermisosCajasIngresosCaja = strPermisosCajasIngresosCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCajasIngresosCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCajasIngresosCaja[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_cajas_ingresos_caja').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosCajasIngresosCaja[i]=='GUARDAR') || (arrPermisosCajasIngresosCaja[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_cajas_ingresos_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasIngresosCaja[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_cajas_ingresos_caja').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_cajas_ingresos_caja();
						}
						else if(arrPermisosCajasIngresosCaja[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_cajas_ingresos_caja').removeAttr('disabled');
							$('#btnRestaurar_cajas_ingresos_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasIngresosCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_cajas_ingresos_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasIngresosCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_cajas_ingresos_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_cajas_ingresos_caja() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaCajasIngresosCaja =($('#txtFechaInicialBusq_cajas_ingresos_caja').val()+$('#txtFechaFinalBusq_cajas_ingresos_caja').val()+$('#cmbEstatusBusq_cajas_ingresos_caja').val()+$('#txtBusqueda_cajas_ingresos_caja').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaCajasIngresosCaja != strUltimaBusquedaCajasIngresosCaja)
			{
				intPaginaCajasIngresosCaja = 0;
				strUltimaBusquedaCajasIngresosCaja = strNuevaBusquedaCajasIngresosCaja;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/cajas_ingresos/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_cajas_ingresos_caja').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_cajas_ingresos_caja').val()),
						strEstatus: $('#cmbEstatusBusq_cajas_ingresos_caja').val(),
					 	strBusqueda: $('#txtBusqueda_cajas_ingresos_caja').val(),
						intPagina:intPaginaCajasIngresosCaja,
						strPermisosAcceso: $('#txtAcciones_cajas_ingresos_caja').val()
					},
					function(data){
						$('#dg_cajas_ingresos_caja tbody').empty();
						var tmpCajasIngresosCaja = Mustache.render($('#plantilla_cajas_ingresos_caja').html(),data);
						$('#dg_cajas_ingresos_caja tbody').html(tmpCajasIngresosCaja);
						$('#pagLinks_cajas_ingresos_caja').html(data.paginacion);
						$('#numElementos_cajas_ingresos_caja').html(data.total_rows);
						intPaginaCajasIngresosCaja = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_cajas_ingresos_caja() 
		{
			//Asignar valores para la búsqueda de registros
			dteFechaInicialCajasIngresosCaja =  $.formatFechaMysql($('#txtFechaInicialBusq_cajas_ingresos_caja').val());
			dteFechaFinalCajasIngresosCaja =  $.formatFechaMysql($('#txtFechaFinalBusq_cajas_ingresos_caja').val());

			//Si no existe fecha inicial
			if(dteFechaInicialCajasIngresosCaja == '')
			{
				dteFechaInicialCajasIngresosCaja = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalCajasIngresosCaja == '')
			{
				dteFechaFinalCajasIngresosCaja =  '0000-00-00';
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("caja/cajas_ingresos/get_reporte/"+dteFechaInicialCajasIngresosCaja+"/"+dteFechaFinalCajasIngresosCaja+"/"+$('#cmbEstatusBusq_cajas_ingresos_caja').val()+"/"+$('#txtBusqueda_cajas_ingresos_caja').val());
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_cajas_ingresos_caja() 
		{
			//Asignar valores para la búsqueda de registros
			dteFechaInicialCajasIngresosCaja =  $.formatFechaMysql($('#txtFechaInicialBusq_cajas_ingresos_caja').val());
			dteFechaFinalCajasIngresosCaja =  $.formatFechaMysql($('#txtFechaFinalBusq_cajas_ingresos_caja').val());

			//Si no existe fecha inicial
			if(dteFechaInicialCajasIngresosCaja == '')
			{
				dteFechaInicialCajasIngresosCaja = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalCajasIngresosCaja == '')
			{
				dteFechaFinalCajasIngresosCaja =  '0000-00-00';
			}
			
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("caja/cajas_ingresos/get_xls/"+dteFechaInicialCajasIngresosCaja+"/"+dteFechaFinalCajasIngresosCaja+"/"+$('#cmbEstatusBusq_cajas_ingresos_caja').val()+"/"+$('#txtBusqueda_cajas_ingresos_caja').val());
		}
		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_cajas_ingresos_caja()
		{
			//Incializar formulario
			$('#frmCajasIngresosCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cajas_ingresos_caja();
			//Limpiar cajas de texto ocultas
			$('#frmCajasIngresosCaja').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_cajas_ingresos_caja').val(fechaActual()); 
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_cajas_ingresos_caja').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_cajas_ingresos_caja').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_cajas_ingresos_caja').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmCajasIngresosCaja').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_cajas_ingresos_caja").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_cajas_ingresos_caja").hide();
			$("#btnRestaurar_cajas_ingresos_caja").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_cajas_ingresos_caja()
		{
			try {
				//Cerrar modal
				objCajasIngresosCaja.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_cajas_ingresos_caja').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cajas_ingresos_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cajas_ingresos_caja();
			//Validación del formulario de campos obligatorios
			$('#frmCajasIngresosCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCuentaBancaria_cajas_ingresos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cuenta bancaria
					                                    if($('#txtCuentaBancariaID_cajas_ingresos_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una cuenta bancaria existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFecha_cajas_ingresos_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strConcepto_cajas_ingresos_caja: {
											validators: {
												notEmpty: {message: 'Escriba un concepto'}
											}
										},
										intImporte_cajas_ingresos_caja: {
											validators: {
												notEmpty: {message: 'Escriba un importe'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cajas_ingresos_caja = $('#frmCajasIngresosCaja').data('bootstrapValidator');
			bootstrapValidator_cajas_ingresos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cajas_ingresos_caja.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_cajas_ingresos_caja();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cajas_ingresos_caja()
		{
			try
			{
				$('#frmCajasIngresosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para verificar que la caja de la sucursal se encuentre abierta
		function get_apertura_caja_cajas_ingresos_caja()
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
							mensaje_cajas_ingresos_caja('error', data.mensaje);
			       	    }
			       	    else
			       	    {	
		       	    		//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cajas_ingresos_caja();
							//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
							$('#divEncabezadoModal_cajas_ingresos_caja').addClass("estatus-NUEVO");
							//Abrir modal
							objCajasIngresosCaja = $('#CajasIngresosCajaBox').bPopup({
												    appendTo: '#CajasIngresosCajaContent', 
					                                contentContainer: 'CajasIngresosCajaM', 
					                                zIndex: 2, 
					                                modalClose: false, 
					                                modal: true, 
					                                follow: [true,false], 
					                                followEasing : "linear", 
					                                easing: "linear", 
					                                modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtConcepto_cajas_ingresos_caja').focus();
			       	    }
			       },
			       'json');
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_cajas_ingresos_caja()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('caja/cajas_ingresos/guardar',
					{ 
						intCajaIngresoID: $('#txtCajaIngresoID_cajas_ingresos_caja').val(),
						intCuentaBancariaID: $('#txtCuentaBancariaID_cajas_ingresos_caja').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_cajas_ingresos_caja').val()),
						strConcepto: $('#txtConcepto_cajas_ingresos_caja').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intImporte: $.reemplazar($("#txtImporte_cajas_ingresos_caja").val(), ",", ""),
						intImporteInterno: $.reemplazar($("#txtImporteInterno_cajas_ingresos_caja").val(), ",", "")
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_cajas_ingresos_caja();
							//Hacer un llamado a la función para cerrar modal
							cerrar_cajas_ingresos_caja();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cajas_ingresos_caja(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cajas_ingresos_caja(tipoMensaje, mensaje)
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
		function cambiar_estatus_cajas_ingresos_caja(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCajaIngresoID_cajas_ingresos_caja').val();

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
				              'title':    'Ingreso de Efectivo a Caja Chica',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('caja/cajas_ingresos/set_estatus',
				                                     {intCajaIngresoID: intID,
				                                      strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                        	//Hacer llamado a la función  para cargar  los registros en el grid
				                                            paginacion_cajas_ingresos_caja();

				                                            //Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_cajas_ingresos_caja();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_cajas_ingresos_caja(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('caja/cajas_ingresos/set_estatus',
				     {intCajaIngresoID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_cajas_ingresos_caja();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_cajas_ingresos_caja();     
							}
				        }
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_cajas_ingresos_caja(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_cajas_ingresos_caja(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/cajas_ingresos/get_datos',
			       {intCajaIngresoID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cajas_ingresos_caja();
				          	//Recuperar valores
				          	$('#txtCajaIngresoID_cajas_ingresos_caja').val(data.row.caja_ingreso_id);
				          	$('#txtCajaAperturaID_cajas_ingresos_caja').val(id);
				          	$('#txtCuentaBancariaID_cajas_ingresos_caja').val(data.row.cuenta_bancaria_id);
						    $('#txtCuentaBancaria_cajas_ingresos_caja').val(data.row.cuenta_bancaria);
				          	$('#txtFecha_cajas_ingresos_caja').val(data.row.fecha);
						    $('#txtConcepto_cajas_ingresos_caja').val(data.row.concepto);
						    $('#txtImporte_cajas_ingresos_caja').val(data.row.importe);
						    $('#txtImporteInterno_cajas_ingresos_caja').val(data.row.importe_interno);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporte_cajas_ingresos_caja').formatCurrency({ roundToDecimalPlace: 2 });
					        $('#txtImporteInterno_cajas_ingresos_caja').formatCurrency({ roundToDecimalPlace: 2 });
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_cajas_ingresos_caja').addClass("estatus-"+data.row.estatus);

				            //Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmCajasIngresosCaja').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					            $("#btnGuardar_cajas_ingresos_caja").hide();
					            
					            //Si no existe id del corte de caja
					            if(data.row.caja_corte_id == 0)
					            {
					            	//Mostrar botón Restaurar
									$("#btnRestaurar_cajas_ingresos_caja").show();
					            } 
				            }
				            else
				            {
				            	//Mostrar botón Desactivar
				            	$("#btnDesactivar_cajas_ingresos_caja").show();
				            }

			            	//Abrir modal
				            objCajasIngresosCaja = $('#CajasIngresosCajaBox').bPopup({
														  appendTo: '#CajasIngresosCajaContent', 
							                              contentContainer: 'CajasIngresosCajaM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtConcepto_cajas_ingresos_caja').focus();
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
			$('#dteFecha_cajas_ingresos_caja').datetimepicker({format: 'DD/MM/YYYY'});
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporte_cajas_ingresos_caja').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_cajas_ingresos_caja').blur(function(){
				$('.moneda_cajas_ingresos_caja').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Autocomplete para recuperar los datos de una cuenta bancaria 
	        $('#txtCuentaBancaria_cajas_ingresos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaBancariaID_cajas_ingresos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/cuentas_bancarias/autocomplete",
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
	              $('#txtCuentaBancariaID_cajas_ingresos_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la cuenta bancaria cuando pierda el enfoque la caja de texto
	        $('#txtCuentaBancaria_cajas_ingresos_caja').focusout(function(e){
	            //Si no existe id de la cuenta bancaria
	            if($('#txtCuentaBancariaID_cajas_ingresos_caja').val() == '' ||
	               $('#txtCuentaBancaria_cajas_ingresos_caja').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	               	$('#txtCuentaBancariaID_cajas_ingresos_caja').val('');
	              	$('#txtCuentaBancaria_cajas_ingresos_caja').val('');
	            }

	        });
	        

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_cajas_ingresos_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_cajas_ingresos_caja').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_cajas_ingresos_caja').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_cajas_ingresos_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_cajas_ingresos_caja').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_cajas_ingresos_caja').data('DateTimePicker').maxDate(e.date);
			});

			//Paginación de registros
			$('#pagLinks_cajas_ingresos_caja').on('click','a',function(event){
				event.preventDefault();
				intPaginaCajasIngresosCaja = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_cajas_ingresos_caja();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_cajas_ingresos_caja').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para verificar que la caja se encuentre abierta
				get_apertura_caja_cajas_ingresos_caja();
				
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_cajas_ingresos_caja').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_cajas_ingresos_caja();
		});
	</script>