	<div id="CajasAperturaCajaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_cajas_apertura_caja" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_cajas_apertura_caja" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_cajas_apertura_caja">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_cajas_apertura_caja'>
				                    <input class="form-control" id="txtFechaInicialBusq_cajas_apertura_caja"
				                    		name= "strFechaInicialBusq_cajas_apertura_caja" 
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
								<label for="txtFechaFinalBusq_cajas_apertura_caja">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_cajas_apertura_caja'>
				                    <input class="form-control" id="txtFechaFinalBusq_cajas_apertura_caja"
				                    		name= "strFechaFinalBusq_cajas_apertura_caja" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los usuarios activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del usuario seleccionado-->
								<input id="txtUsuarioIDBusq_cajas_apertura_caja" 
									   name="intUsuarioIDBusq_cajas_apertura_caja"  type="hidden" 
									   value="">
								</input>
								<label for="txtUsuarioBusq_cajas_apertura_caja">Usuario</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtUsuarioBusq_cajas_apertura_caja" 
										name="strUsuarioBusq_cajas_apertura_caja" type="text" value="" tabindex="1" placeholder="Ingrese usuario" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_cajas_apertura_caja">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_cajas_apertura_caja" 
								 		name="strEstatusBusq_cajas_apertura_caja" tabindex="1">
								    <option value="TODOS">TODOS</option>
	                  				<option value="ABIERTA">ABIERTA</option>
	                  				<option value="CERRADA">CERRADA</option>
	                  				<option value="CANCELADA">CANCELADA</option>
                 				</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Descripción-->
					<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_cajas_apertura_caja">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_cajas_apertura_caja" 
										name="strBusqueda_cajas_apertura_caja" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_cajas_apertura_caja"
									onclick="paginacion_cajas_apertura_caja();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_cajas_apertura_caja" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_cajas_apertura_caja"
									onclick="reporte_cajas_apertura_caja('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_cajas_apertura_caja"
									onclick="reporte_cajas_apertura_caja('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(2):before {content: "Usuario"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Cuenta"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Impt. de apertura"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Impt. interno"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Saldo"; font-weight: bold;}
				td.movil:nth-of-type(7):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(8):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_cajas_apertura_caja">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Fecha</th>
							<th class="movil">Usuario</th>
							<th class="movil">Cuenta</th>
							<th class="movil">Impt. de apertura</th>
							<th class="movil">Impt. interno</th>
							<th class="movil">Saldo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_cajas_apertura_caja" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{usuario}}</td>
							<td class="movil">{{cuenta_bancaria}}</td>
							<td class="movil">{{importe_apertura}}</td>
							<td class="movil">{{importe_interno}}</td>
							<td class="movil">{{saldo}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="ver_cajas_apertura_caja({{caja_apertura_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Cancelar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionCancelar}}" 
										onclick="cancelar_cajas_apertura_caja({{caja_apertura_id}},{{caja_corte_id}});" title="Cancelar">
									<span class="glyphicon glyphicon-ban-circle"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_cajas_apertura_caja"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_cajas_apertura_caja">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="CajasAperturaCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_cajas_apertura_caja"  class="ModalBodyTitle">
			<h1>Apertura de Caja</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCajasAperturaCaja" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmCajasAperturaCaja"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCajaAperturaID_cajas_apertura_caja" 
										   name="intCajaAperturaID_cajas_apertura_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del cierre de caja-->
									<input id="txtCajaCorteID_cajas_apertura_caja" 
										   name="intCajaCorteID_cajas_apertura_caja" type="hidden" value="">
									</input>
									<label for="txtFecha_cajas_apertura_caja">Fecha</label>
								</div>
								<div  id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_cajas_apertura_caja'>
					                    <input class="form-control" id="txtFecha_cajas_apertura_caja"
					                    		name= "strFecha_cajas_apertura_caja" 
					                    		type="text" value="" tabindex="1" 
					                    		placeholder="Ingrese fecha" maxlength="10" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Hora-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHora_cajas_apertura_caja">Hora</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class="input-group bootstrap-timepicker timepicker" id="dteHora_cajas_apertura_caja">
							            <input 	id="txtHora_cajas_apertura_caja"
							            		name= "strHora_cajas_apertura_caja" 
							            		type="text" value="" tabindex="1" placeholder="Ingrese hora" class="form-control input-small" />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>
						<!--Usuario-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuario_cajas_apertura_caja">Usuario</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuario_cajas_apertura_caja" 
											name="strUsuario_cajas_apertura_caja" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				     	<!--Autocomplete que contiene las cuentas bancarias activas-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta bancaria seleccionada-->
									<input id="txtCuentaBancariaID_cajas_apertura_caja" 
										   name="intCuentaBancariaID_cajas_apertura_caja"  type="hidden" 
										   value="">
									</input>
									<label for="txtCuentaBancaria_cajas_apertura_caja">Cuenta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuentaBancaria_cajas_apertura_caja" 
											name="strCuentaBancaria_cajas_apertura_caja" type="text" value="" tabindex="1" placeholder="Ingrese cuenta bancaria" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
				     	<!--Importe de apertura-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteApertura_cajas_apertura_caja">Importe de apertura</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_cajas_apertura_caja" id="txtImporteApertura_cajas_apertura_caja" 
												name="intImporteApertura_cajas_apertura_caja" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="12">
										</input>
										
									</div>
								</div>
							</div>
						</div>
						<!--Importe interno-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteInterno_cajas_apertura_caja">Importe interno</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_cajas_apertura_caja" id="txtImporteInterno_cajas_apertura_caja" 
												name="intImporteInterno_cajas_apertura_caja" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="12">
										</input>
										
									</div>
								</div>
							</div>
						</div>
						<!--Saldo del cierre de caja anterior-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSaldo_cajas_apertura_caja">Saldo</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_cajas_apertura_caja" id="txtSaldo_cajas_apertura_caja" 
												name="intSaldo_cajas_apertura_caja" type="text" value="" disabled>
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
							<button class="btn btn-success" id="btnGuardar_cajas_apertura_caja"  
									onclick="validar_cajas_apertura_caja();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Cancelar registro-->
							<button class="btn btn-default" id="btnCancelar_cajas_apertura_caja"  
									onclick="cancelar_cajas_apertura_caja('', '');"  title="Cancelar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cajas_apertura_caja"
									type="reset" aria-hidden="true" onclick="cerrar_cajas_apertura_caja();" 
									title="Cerrar"  tabindex="4">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#CajasAperturaCajaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variable que se utiliza para asignar hora actual
		var strHoraActualCajasAperturaCaja;
		//Variables que se utilizan para la paginación de registros
		var intPaginaCajasAperturaCaja = 0;
		var strUltimaBusquedaCajasAperturaCaja = "";
		//Variable que se utiliza para asignar objeto del modal
		var objCajasAperturaCaja = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_cajas_apertura_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/cajas_apertura/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_cajas_apertura_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCajasAperturaCaja = data.row;
					//Separar la cadena 
					var arrPermisosCajasAperturaCaja = strPermisosCajasAperturaCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCajasAperturaCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCajasAperturaCaja[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_cajas_apertura_caja').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosCajasAperturaCaja[i]=='GUARDAR') || (arrPermisosCajasAperturaCaja[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_cajas_apertura_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasAperturaCaja[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_cajas_apertura_caja').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_cajas_apertura_caja();
						}
						else if(arrPermisosCajasAperturaCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_cajas_apertura_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasAperturaCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_cajas_apertura_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasAperturaCaja[i]=='CANCELAR')//Si el indice es CANCELAR
						{
							//Habilitar el control (botón cancelar)
							$('#btnCancelar_cajas_apertura_caja').removeAttr('disabled');
						}
						
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_cajas_apertura_caja() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaCajasAperturaCaja =($('#txtFechaInicialBusq_cajas_apertura_caja').val()+$('#txtFechaFinalBusq_cajas_apertura_caja').val()+$('#txtUsuarioIDBusq_cajas_apertura_caja').val()+$('#cmbEstatusBusq_cajas_apertura_caja').val()+$('#txtBusqueda_cajas_apertura_caja').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaCajasAperturaCaja != strUltimaBusquedaCajasAperturaCaja)
			{
				intPaginaCajasAperturaCaja = 0;
				strUltimaBusquedaCajasAperturaCaja = strNuevaBusquedaCajasAperturaCaja;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/cajas_apertura/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_cajas_apertura_caja').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_cajas_apertura_caja').val()),
						intUsuarioID: $('#txtUsuarioIDBusq_cajas_apertura_caja').val(),
						strEstatus: $('#cmbEstatusBusq_cajas_apertura_caja').val(),
					 	strBusqueda: $('#txtBusqueda_cajas_apertura_caja').val(),
						intPagina:intPaginaCajasAperturaCaja,
						strPermisosAcceso: $('#txtAcciones_cajas_apertura_caja').val()
					},
					function(data){
						$('#dg_cajas_apertura_caja tbody').empty();
						var tmpCajasAperturaCaja = Mustache.render($('#plantilla_cajas_apertura_caja').html(),data);
						$('#dg_cajas_apertura_caja tbody').html(tmpCajasAperturaCaja);
						$('#pagLinks_cajas_apertura_caja').html(data.paginacion);
						$('#numElementos_cajas_apertura_caja').html(data.total_rows);
						intPaginaCajasAperturaCaja = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_cajas_apertura_caja(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'caja/cajas_apertura/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_cajas_apertura_caja').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_cajas_apertura_caja').val()),
										'intUsuarioID': $('#txtUsuarioIDBusq_cajas_apertura_caja').val(),
										'strEstatus': $('#cmbEstatusBusq_cajas_apertura_caja').val(), 
										'strBusqueda': $('#txtBusqueda_cajas_apertura_caja').val()		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}

		
		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_cajas_apertura_caja()
		{
			//Recuperar valores del usuario logeado en el sistema
			var strUsuarioCajasAperturaCaja = '<?php echo $this->session->userdata('usuario') ?>';
			var strEmpleadoCajasAperturaCaja = '<?php echo $this->session->userdata('empleado') ?>';
			//Si existe nombre del empleado
			if(strEmpleadoCajasAperturaCaja != '')
			{   
				strUsuarioCajasAperturaCaja = strUsuarioCajasAperturaCaja+' - '+strEmpleadoCajasAperturaCaja;
			}
			//Incializar formulario
			$('#frmCajasAperturaCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cajas_apertura_caja();
			//Limpiar cajas de texto ocultas
			$('#frmCajasAperturaCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cajas_apertura_caja');
			//Habilitar todos los elementos del formulario
			$('#frmCajasAperturaCaja').find('input, textarea, select').removeAttr('disabled','disabled');
		    //Asignar la fecha actual
			$('#txtFecha_cajas_apertura_caja').val(fechaActual()); 
			$('#txtUsuario_cajas_apertura_caja').val(strUsuarioCajasAperturaCaja);
			//Deshabilitar las siguientes cajas de texto
			//$('#txtFecha_cajas_apertura_caja').attr("disabled", "disabled");
		 	//$('#txtHora_cajas_apertura_caja').attr("disabled", "disabled");
			$('#txtUsuario_cajas_apertura_caja').attr("disabled", "disabled");
			$('#txtSaldo_cajas_apertura_caja').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_cajas_apertura_caja").show();
			//Ocultar botón Cancelar
			$("#btnCancelar_cajas_apertura_caja").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_cajas_apertura_caja()
		{
			try {
				//Hacer un llamado a la función para detener temporizador de hora actual
			    get_hora_actual_cajas_apertura_caja('Detener');
				//Cerrar modal
				objCajasAperturaCaja.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_cajas_apertura_caja').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cajas_apertura_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cajas_apertura_caja();
			//Validación del formulario de campos obligatorios
			$('#frmCajasAperturaCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_cajas_apertura_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHora_cajas_apertura_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										},
									  	strCuentaBancaria_cajas_apertura_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cuenta bancaria
					                                    if($('#txtCuentaBancariaID_cajas_apertura_caja').val() === '')
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
										intImporteApertura_cajas_apertura_caja: {
											validators: {
												notEmpty: {message: 'Escriba un importe'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cajas_apertura_caja = $('#frmCajasAperturaCaja').data('bootstrapValidator');
			bootstrapValidator_cajas_apertura_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cajas_apertura_caja.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_cajas_apertura_caja();
			}
			else 
				return;
		}

		//Función para verificar que la caja de la sucursal no se encuentre abierta
		function get_apertura_caja_cajas_apertura_caja()
		{
			//Hacer un llamado al método del controlador para verificar existencia de caja abierta
			$.post('caja/cajas_apertura/get_existencia',
			       {strFormulario: 'apertura_caja'
			       },
			       function(data) {
			        	//Si no hay caja abierta
			            if(data.mensaje)
			            {
			            	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_cajas_apertura_caja('error', data.mensaje);
			       	    }
			       	    else
			       	    {	
		       	    		//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cajas_apertura_caja();
							//Hacer un llamado a la función para iniciar temporizador de hora actual
							get_hora_actual_cajas_apertura_caja('Iniciar');
							//Hacer un llamado a la función para obtener el saldo (total de importe físico) del último cierre de caja
							get_saldo_ultimo_cierre_caja_cajas_vales_caja();

							//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
							$('#divEncabezadoModal_cajas_apertura_caja').addClass("estatus-NUEVO");
							
							//Abrir modal
							 objCajasAperturaCaja = $('#CajasAperturaCajaBox').bPopup({
													   appendTo: '#CajasAperturaCajaContent', 
						                               contentContainer: 'CajasAperturaCajaM', 
						                               zIndex: 2, 
						                               modalClose: false, 
						                               modal: true, 
						                               follow: [true,false], 
						                               followEasing : "linear", 
						                               easing: "linear", 
						                               modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCuentaBancaria_cajas_apertura_caja').focus();
			       	    }
			       },
			       'json');
		}


		//Función para obtener el saldo (total de importe físico) del último cierre de caja
		function get_saldo_ultimo_cierre_caja_cajas_vales_caja()
		{
			 //Hacer un llamado al método del controlador para regresar el saldo del último cierre de caja
             $.ajax('caja/cajas_corte/get_importe_fisico_ultimo_cierre',
             		{
			        "type" : "post",
			        "data": {},
			        success: function(data){
			            //Asignar el total de importe físico
		                $("#txtSaldo_cajas_apertura_caja").val(data.importe_fisico);
		                    
			          },
			        "async": false,
			      });
		}


		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cajas_apertura_caja()
		{
			try
			{
				$('#frmCajasAperturaCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para iniciar o detener temporizador de hora actual//Función para regresar hora actual
		function get_hora_actual_cajas_apertura_caja(tipoAccion)
		{
			//Si el tipo de acción corrresponde a Iniciar
			if(tipoAccion == 'Iniciar')
			{

				//Asignar hora actual
				$('#txtHora_cajas_apertura_caja').val(horaActual());
				$('#txtHora_cajas_apertura_caja').timepicker('setTime', horaActual());
				//Asignar temporizador para cambiar hora actual (hora:minutos:segundos)
				/*strHoraActualCajasAperturaCaja =  setTimeout(function(){ get_hora_actual_cajas_apertura_caja(tipoAccion)}, 1000);*/
			}
			else
			{
				//Borrar temporizador establecido con el método setTimeout()
				clearTimeout(strHoraActualCajasAperturaCaja);
			}
	        
	     }

		//Función para guardar los datos de un registro
		function guardar_cajas_apertura_caja()
		{
			//Asignar datos de la fecha y hora
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaApertura = $.formatFechaMysql($('#txtFecha_cajas_apertura_caja').val());
			//Hacer un llamado a la función para convertir hora a formato 24
			var strHora = convertirHora12a24($('#txtHora_cajas_apertura_caja').val());

			//Concatenar los datos de la fecha y hora
			dteFechaApertura += ' '+strHora;

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('caja/cajas_apertura/guardar',
					{ 
						intCuentaBancariaID: $('#txtCuentaBancariaID_cajas_apertura_caja').val(),
						dteFecha: dteFechaApertura,
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intImporteApertura: $.reemplazar($("#txtImporteApertura_cajas_apertura_caja").val(), ",", ""),
						intImporteInterno: $.reemplazar($("#txtImporteInterno_cajas_apertura_caja").val(), ",", ""),
						intSaldo: $.reemplazar($("#txtSaldo_cajas_apertura_caja").val(), ",", "")
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_cajas_apertura_caja();
							//Hacer un llamado a la función para cerrar modal
							cerrar_cajas_apertura_caja();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cajas_apertura_caja(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cajas_apertura_caja(tipoMensaje, mensaje)
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

		//Función para cancelar (cambiar estatus) el registro seleccionado
		function cancelar_cajas_apertura_caja(cajaAperturaID, cajaCorteID)
		{
			//Variable que se utiliza para asignar el id de la apertura de caja
			var intCajaAperturaIDReg = 0;
			//Variable que se utiliza para asignar el id del corte de caja
			var intCajaCorteIDReg = 0;

			//Si no existe id, significa que se realizará la cancelación desde el modal
			if(cajaAperturaID == '')
			{
				intCajaAperturaIDReg = $('#txtCajaAperturaID_cajas_apertura_caja').val();
				intCajaCorteIDReg = $('#txtCajaCorteID_cajas_apertura_caja').val();

			}
			else
			{
				intCajaAperturaIDReg = cajaAperturaID;
				intCajaCorteIDReg = cajaCorteID;
			}

			//Preguntar al usuario si desea cancelar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea cancelar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Apertura de Caja',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para cambiar el estatus a CANCELADA
			                              $.post('caja/cajas_apertura/set_cancelar',
			                                     {intCajaAperturaID: intCajaAperturaIDReg,
			                                      intCajaCorteID: intCajaCorteIDReg
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                            //Hacer llamado a la función  para cargar  los registros en el grid
			                                          	paginacion_cajas_apertura_caja();

			                                          	//Si el id del registro se obtuvo del modal
														if(cajaAperturaID == '')
														{
															//Hacer un llamado a la función para cerrar modal
															cerrar_cajas_apertura_caja();     
														}
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_cajas_apertura_caja(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function ver_cajas_apertura_caja(id)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/cajas_apertura/get_datos',
			       {intCajaAperturaID: id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cajas_apertura_caja();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				          	//Recuperar valores
				          	$('#txtCajaAperturaID_cajas_apertura_caja').val(id);
				          	$('#txtCuentaBancariaID_cajas_apertura_caja').val(data.row.cuenta_bancaria_id);
						    $('#txtCuentaBancaria_cajas_apertura_caja').val(data.row.cuenta_bancaria);
				            $('#txtFecha_cajas_apertura_caja').val(data.row.fecha);
				            $('#txtHora_cajas_apertura_caja').val(data.row.hora);
				            $('#txtUsuario_cajas_apertura_caja').val(data.row.usuario);
				            $('#txtImporteApertura_cajas_apertura_caja').val(data.row.importe_apertura);
				            $('#txtImporteInterno_cajas_apertura_caja').val(data.row.importe_interno);
				            $('#txtSaldo_cajas_apertura_caja').val(data.row.saldo);
				            //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporteApertura_cajas_apertura_caja').formatCurrency({ roundToDecimalPlace: 2 });
					        $('#txtImporteInterno_cajas_apertura_caja').formatCurrency({ roundToDecimalPlace: 2 });
					        $('#txtSaldo_cajas_apertura_caja').formatCurrency({ roundToDecimalPlace: 2 });
					        $('#txtCajaCorteID_cajas_apertura_caja').val(data.row.caja_corte_id);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_cajas_apertura_caja').addClass("estatus-"+strEstatus);
				         	//Deshabilitar todos los elementos del formulario
				            $('#frmCajasAperturaCaja').find('input, textarea, select').attr('disabled','disabled');
							//Ocultar botón Guardar
							$("#btnGuardar_cajas_apertura_caja").hide();

							//Si el estatus del registro es CERRADA
							if(strEstatus == 'CERRADA')
							{
								//Mostrar botón Cancelar
								$("#btnCancelar_cajas_apertura_caja").show();
							}

			            	//Abrir modal
				            objCajasAperturaCaja = $('#CajasAperturaCajaBox').bPopup({
														  appendTo: '#CajasAperturaCajaContent', 
							                              contentContainer: 'CajasAperturaCajaM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtCuentaBancaria_cajas_apertura_caja').focus();
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
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporteApertura_cajas_apertura_caja').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_cajas_apertura_caja').blur(function(){
				$('.moneda_cajas_apertura_caja').formatCurrency({ roundToDecimalPlace: 2 });
			});


			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_cajas_apertura_caja').datetimepicker({format: 'DD/MM/YYYY'});

        	//Agregar timepicker para seleccionar una hora
			$('#txtHora_cajas_apertura_caja').timepicker({format: 'HH:mm:ss',
														  minuteStep: 1,
														  showSeconds: true,
														  secondStep: 1});

			$('#txtHora_cajas_apertura_caja').timepicker('setTime', '');

			//Autocomplete para recuperar los datos de una cuenta bancaria 
	        $('#txtCuentaBancaria_cajas_apertura_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaBancariaID_cajas_apertura_caja').val('');
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
	              $('#txtCuentaBancariaID_cajas_apertura_caja').val(ui.item.data);
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
	        $('#txtCuentaBancaria_cajas_apertura_caja').focusout(function(e){
	            //Si no existe id de la cuenta bancaria
	            if($('#txtCuentaBancariaID_cajas_apertura_caja').val() == '' ||
	               $('#txtCuentaBancaria_cajas_apertura_caja').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	               	$('#txtCuentaBancariaID_cajas_apertura_caja').val('');
	              	$('#txtCuentaBancaria_cajas_apertura_caja').val('');
	            }

	        });

	       	

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_cajas_apertura_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_cajas_apertura_caja').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_cajas_apertura_caja').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_cajas_apertura_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_cajas_apertura_caja').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_cajas_apertura_caja').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un usuario 
	        $('#txtUsuarioBusq_cajas_apertura_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsuarioIDBusq_cajas_apertura_caja').val('');
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
	             $('#txtUsuarioIDBusq_cajas_apertura_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del usuario cuando pierda el enfoque la caja de texto
	        $('#txtUsuarioBusq_cajas_apertura_caja').focusout(function(e){
	            //Si no existe id del usuario
	            if($('#txtUsuarioIDBusq_cajas_apertura_caja').val() == '' ||
	               $('#txtUsuarioBusq_cajas_apertura_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUsuarioIDBusq_cajas_apertura_caja').val('');
	               $('#txtUsuarioBusq_cajas_apertura_caja').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_cajas_apertura_caja').on('click','a',function(event){
				event.preventDefault();
				intPaginaCajasAperturaCaja = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_cajas_apertura_caja();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_cajas_apertura_caja').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para verificar que la caja no se encuentre abierta
				get_apertura_caja_cajas_apertura_caja();
				
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_cajas_apertura_caja').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_cajas_apertura_caja();
		});
	</script>