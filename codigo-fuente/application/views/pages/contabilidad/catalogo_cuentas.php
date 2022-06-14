	<div id="CatalogoCuentasContabilidadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_catalogo_cuentas_contabilidad" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_catalogo_cuentas_contabilidad" 
								   name="strBusqueda_catalogo_cuentas_contabilidad"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_catalogo_cuentas_contabilidad"
										onclick="paginacion_catalogo_cuentas_contabilidad();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_catalogo_cuentas_contabilidad" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_catalogo_cuentas_contabilidad"
									onclick="reporte_catalogo_cuentas_contabilidad('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_catalogo_cuentas_contabilidad"
									onclick="reporte_catalogo_cuentas_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Cuenta"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Tipo"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Naturaleza"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Cuenta padre"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Cuenta SAT"; font-weight: bold;}
				td.movil:nth-of-type(7):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(8):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_catalogo_cuentas_contabilidad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Cuenta</th>
							<th class="movil">Descripción</th>
							<th class="movil">Tipo</th>
							<th class="movil">Naturaleza</th>
							<th class="movil">Cuenta padre</th>
							<th class="movil">Cuenta SAT</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_catalogo_cuentas_contabilidad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{cuenta}}</td>
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{tipo_cuenta}}</td>
							<td class="movil">{{naturaleza}}</td>
							<td class="movil">{{cuenta_padre}}</td>
							<td class="movil">{{sat_cuenta}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_catalogo_cuentas_contabilidad({{cuenta_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_catalogo_cuentas_contabilidad({{cuenta_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_catalogo_cuentas_contabilidad({{cuenta_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_catalogo_cuentas_contabilidad({{cuenta_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_catalogo_cuentas_contabilidad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_catalogo_cuentas_contabilidad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="CatalogoCuentasContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_catalogo_cuentas_contabilidad"  class="ModalBodyTitle">
			<h1>Catálogo de Cuentas</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCatalogoCuentasContabilidad" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmCatalogoCuentasContabilidad"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Cuenta contable-->
                  		<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                  			<!--Div que contiene los campos de la cuenta contable-->
                            <div class="form-group row">
                                <!--Etiqueta del encabezado-->
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                	<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCuentaID_catalogo_cuentas_contabilidad" 
										   name="intCuentaID_catalogo_cuentas_contabilidad" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el primer nivel anterior y así evitar duplicidad en caso de que exista otro registro con la misma cuenta-->
									<input id="txtPrimerNivelAnterior_catalogo_cuentas_contabilidad" 
										   name="strPrimerNivelAnterior_catalogo_cuentas_contabilidad" type="hidden" value="">
									</input>
                                    <label for="txtPrimerNivel_catalogo_cuentas_contabilidad">Cuenta contable</label>
                                </div>
                                <!--Primer nivel-->
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                    <input  class="form-control" id="txtPrimerNivel_catalogo_cuentas_contabilidad" 
                                     		name="strPrimerNivel_catalogo_cuentas_contabilidad" 
                                     		type="text" value="" tabindex="1" placeholder="Primer nivel" maxlength="3">
                                    </input>
                                </div>
                                <!--Segundo nivel-->
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                	<!-- Caja de texto oculta que se utiliza para recuperar el segundo nivel anterior y así evitar duplicidad en caso de que exista otro registro con la misma cuenta-->
									<input id="txtSegundoNivelAnterior_catalogo_cuentas_contabilidad" 
										   name="strSegundoNivelAnterior_catalogo_cuentas_contabilidad" type="hidden" value="">
									</input>
                                    <input  class="form-control" id="txtSegundoNivel_catalogo_cuentas_contabilidad" 
                                      		name="strSegundoNivel_catalogo_cuentas_contabilidad" 
                                      		type="text" value="" tabindex="1" placeholder="Segundo nivel" maxlength="2">
                                	</input>
                                </div>
                                <!--Tercer nivel-->
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                	<!-- Caja de texto oculta que se utiliza para recuperar el tercer nivel anterior y así evitar duplicidad en caso de que exista otro registro con la misma cuenta-->
									<input id="txtTercerNivelAnterior_catalogo_cuentas_contabilidad" 
										   name="strTercerNivelAnterior_catalogo_cuentas_contabilidad" type="hidden" value="">
									</input>
                                    <input  class="form-control" id="txtTercerNivel_catalogo_cuentas_contabilidad" 
                                      		name="strTercerNivel_catalogo_cuentas_contabilidad" 
                                      		type="text" value="" tabindex="1" placeholder="Tercer nivel" maxlength="2">
                                	</input>
                                </div>
                                <!--Cuarto nivel-->
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                	<!-- Caja de texto oculta que se utiliza para recuperar el cuarto nivel anterior y así evitar duplicidad en caso de que exista otro registro con la misma cuenta-->
									<input id="txtCuartoNivelAnterior_catalogo_cuentas_contabilidad" 
										   name="strCuartoNivelAnterior_catalogo_cuentas_contabilidad" type="hidden" value="">
									</input>
                                    <input  class="form-control" id="txtCuartoNivel_catalogo_cuentas_contabilidad" 
                                      		name="strCuartoNivel_catalogo_cuentas_contabilidad" 
                                      		type="text" value="" tabindex="1" placeholder="Cuarto nivel" maxlength="5">
                                	</input>
                                </div>
                            </div>
                  		</div>
                    </div>
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_catalogo_cuentas_contabilidad">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_catalogo_cuentas_contabilidad" 
											name="strDescripcion_catalogo_cuentas_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese descripción" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Naturaleza-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbNaturaleza_catalogo_cuentas_contabilidad">Naturaleza</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbNaturaleza_catalogo_cuentas_contabilidad" 
									 		name="strNaturaleza_catalogo_cuentas_contabilidad" tabindex="1">
									 	<option value="">Seleccione una opción</option>
                          				<option value="DEUDORA">DEUDORA</option>
                          				<option value="ACREEDORA">ACREEDORA</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cuenta-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipoCuenta_catalogo_cuentas_contabilidad">Tipo de cuenta</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipoCuenta_catalogo_cuentas_contabilidad" 
									 		name="strTipoCuenta_catalogo_cuentas_contabilidad" tabindex="1">
									 	<option value="">Seleccione una opción</option>
                          				<option value="ACTIVO">ACTIVO</option>
                          				<option value="CAPITAL">CAPITAL</option>
                          				<option value="ORDEN">ORDEN</option>
                          				<option value="PASIVO">PASIVO</option>
                          				<option value="RESULTADOS">RESULTADOS</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Acepta movimientos-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbAceptaMovimientos_catalogo_cuentas_contabilidad">Acepta movimientos</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbAceptaMovimientos_catalogo_cuentas_contabilidad" 
									 		name="strAceptaMovimientos_catalogo_cuentas_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="SI">SI</option>
                          				<option value="NO">NO</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Acepta movimientos bancarios-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbMovimientosBancarios_catalogo_cuentas_contabilidad">Movimientos bancarios</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMovimientosBancarios_catalogo_cuentas_contabilidad" 
									 		name="strMovimientosBancarios_catalogo_cuentas_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="SI">SI</option>
                          				<option value="NO">NO</option>
                     				</select>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene las cuentas activas-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta seleccionada-->
									<input id="txtCuentaPadreID_catalogo_cuentas_contabilidad" 
										   name="intCuentaPadreID_catalogo_cuentas_contabilidad"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el primer nivel de la cuenta padre seleccionada y de esta manera verificar que no sea diferente al código del primer nivel de la cuenta contable-->
									<input id="txtCuentaPadreCodigo_catalogo_cuentas_contabilidad" 
										   name="strCuentaPadreCodigo_catalogo_cuentas_contabilidad"  
										   type="hidden" value="">
									</input>
									<label for="txtCuentaPadre_catalogo_cuentas_contabilidad">Cuenta padre</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuentaPadre_catalogo_cuentas_contabilidad" 
											name="strCuentaPadre_catalogo_cuentas_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese cuenta padre" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				     <div class="row">
				    	<!--Autocomplete que contiene las cuentas SAT activas-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta SAT seleccionada-->
									<input id="txtSatCuentaID_catalogo_cuentas_contabilidad" 
										   name="intSatCuentaID_catalogo_cuentas_contabilidad"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el código (antes del punto)de la cuenta SAT seleccionada y de esta manera verificar que no sea diferente al código del primer nivel de la cuenta contable-->
									<input id="txtSatCuentaCodigo_catalogo_cuentas_contabilidad" 
										   name="strSatCuentaCodigo_catalogo_cuentas_contabilidad"  
										   type="hidden" value="">
									</input>
									<label for="txtSatCuenta_catalogo_cuentas_contabilidad">Cuenta SAT</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSatCuenta_catalogo_cuentas_contabilidad" 
											name="strSatCuenta_catalogo_cuentas_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese cuenta SAT" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_catalogo_cuentas_contabilidad"  
									onclick="validar_catalogo_cuentas_contabilidad();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_catalogo_cuentas_contabilidad"  
									onclick="cambiar_estatus_catalogo_cuentas_contabilidad('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_catalogo_cuentas_contabilidad"  
									onclick="cambiar_estatus_catalogo_cuentas_contabilidad('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_catalogo_cuentas_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_catalogo_cuentas_contabilidad();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#CatalogoCuentasContabilidadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaCatalogoCuentasContabilidad = 0;
		var strUltimaBusquedaCatalogoCuentasContabilidad = "";
		//Variable que se utiliza para asignar objeto del modal
		var objCatalogoCuentasContabilidad = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_catalogo_cuentas_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/catalogo_cuentas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_catalogo_cuentas_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCatalogoCuentasContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosCatalogoCuentasContabilidad = strPermisosCatalogoCuentasContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCatalogoCuentasContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCatalogoCuentasContabilidad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_catalogo_cuentas_contabilidad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosCatalogoCuentasContabilidad[i]=='GUARDAR') || (arrPermisosCatalogoCuentasContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_catalogo_cuentas_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosCatalogoCuentasContabilidad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_catalogo_cuentas_contabilidad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_catalogo_cuentas_contabilidad();
						}
						else if(arrPermisosCatalogoCuentasContabilidad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_catalogo_cuentas_contabilidad').removeAttr('disabled');
							$('#btnRestaurar_catalogo_cuentas_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosCatalogoCuentasContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_catalogo_cuentas_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosCatalogoCuentasContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_catalogo_cuentas_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_catalogo_cuentas_contabilidad() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_catalogo_cuentas_contabilidad').val() != strUltimaBusquedaCatalogoCuentasContabilidad)
			{
				intPaginaCatalogoCuentasContabilidad = 0;
				strUltimaBusquedaCatalogoCuentasContabilidad = $('#txtBusqueda_catalogo_cuentas_contabilidad').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('contabilidad/catalogo_cuentas/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_catalogo_cuentas_contabilidad').val(),
						intPagina:intPaginaCatalogoCuentasContabilidad,
						strPermisosAcceso: $('#txtAcciones_catalogo_cuentas_contabilidad').val()
					},
					function(data){
						$('#dg_catalogo_cuentas_contabilidad tbody').empty();
						var tmpCatalogoCuentasContabilidad = Mustache.render($('#plantilla_catalogo_cuentas_contabilidad').html(),data);
						$('#dg_catalogo_cuentas_contabilidad tbody').html(tmpCatalogoCuentasContabilidad);
						$('#pagLinks_catalogo_cuentas_contabilidad').html(data.paginacion);
						$('#numElementos_catalogo_cuentas_contabilidad').html(data.total_rows);
						intPaginaCatalogoCuentasContabilidad = data.pagina;
					},
			'json');
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_catalogo_cuentas_contabilidad(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/catalogo_cuentas/';

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
										'strBusqueda': $('#txtBusqueda_catalogo_cuentas_contabilidad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_catalogo_cuentas_contabilidad()
		{
			//Incializar formulario
			$('#frmCatalogoCuentasContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_catalogo_cuentas_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmCatalogoCuentasContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_catalogo_cuentas_contabilidad');
			//Habilitar todos los elementos del formulario
			$('#frmCatalogoCuentasContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_catalogo_cuentas_contabilidad").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_catalogo_cuentas_contabilidad").hide();
			$("#btnRestaurar_catalogo_cuentas_contabilidad").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_catalogo_cuentas_contabilidad()
		{
			try {
				//Cerrar modal
				objCatalogoCuentasContabilidad.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_catalogo_cuentas_contabilidad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_catalogo_cuentas_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_catalogo_cuentas_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmCatalogoCuentasContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strPrimerNivel_catalogo_cuentas_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba el primer nivel de la cuenta'},
												stringLength: {
													min: 3,
													message: 'El primer nivel debe tener como mínimo  3 caracteres de longitud'
												}
											}
										},
										strSegundoNivel_catalogo_cuentas_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba el segundo nivel de la cuenta'},
												stringLength: {
													min: 2,
													message: 'El segundo nivel debe tener como mínimo 2 caracteres de longitud'
												}
											}
										},
										strTercerNivel_catalogo_cuentas_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba el tercer nivel de la cuenta'},
												stringLength: {
													min: 2,
													message: 'El tercer nivel debe tener como mínimo 2 caracteres de longitud'
												}
											}
										},
										strCuartoNivel_catalogo_cuentas_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba el cuarto nivel de la cuenta'},
												stringLength: {
													min: 5,
													message: 'El cuarto nivel debe tener como mínimo 5 caracteres de longitud'
												}
											}
										},
										strDescripcion_catalogo_cuentas_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										strNaturaleza_catalogo_cuentas_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una naturaleza'}
											}
										},
										strTipoCuenta_catalogo_cuentas_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo de cuenta'}
											}
										},
										strAceptaMovimientos_catalogo_cuentas_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione si acepta o no movimientos'}
											}
										},
										strMovimientosBancarios_catalogo_cuentas_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione si acepta o no movimientos bancarios'}
											}
										},
										strCuentaPadre_catalogo_cuentas_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cuenta padre
					                                    if(value !== '')
					                                    {
					                                    	//Si no existe id de la cuenta padre
					                                    	if($('#txtCuentaPadreID_catalogo_cuentas_contabilidad').val() === '')
					                                    	{
					                                    		return {
							                                        valid: false,
							                                        message: 'Escriba una cuenta existente'
							                                    };
					                                    	}

					                                    	//Si el id de la cuenta padre es igual al id de la cuenta
					                                    	if($('#txtCuentaID_catalogo_cuentas_contabilidad').val() === 
					                                    		$('#txtCuentaPadreID_catalogo_cuentas_contabilidad').val())
						                                    {

						                                    	return {
						                                            valid: false,
						                                            message: 'No es posible seleccionar la misma cuenta como cuenta padre'
						                                        };
						                                    }
					                                    }

					                                    return true;
					                                }
					                            }
											}
										},
										strSatCuenta_catalogo_cuentas_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cuenta SAT
					                                    if($('#txtSatCuentaID_catalogo_cuentas_contabilidad').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una cuenta SAT existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_catalogo_cuentas_contabilidad = $('#frmCatalogoCuentasContabilidad').data('bootstrapValidator');
			bootstrapValidator_catalogo_cuentas_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_catalogo_cuentas_contabilidad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_catalogo_cuentas_contabilidad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_catalogo_cuentas_contabilidad()
		{
			try
			{
				$('#frmCatalogoCuentasContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_catalogo_cuentas_contabilidad()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('contabilidad/catalogo_cuentas/guardar',
					{ 
						intCuentaID: $('#txtCuentaID_catalogo_cuentas_contabilidad').val(),
						intCuentaPadreID: $('#txtCuentaPadreID_catalogo_cuentas_contabilidad').val(),
						intSatCuentaID: $('#txtSatCuentaID_catalogo_cuentas_contabilidad').val(),
						strPrimerNivel: $('#txtPrimerNivel_catalogo_cuentas_contabilidad').val(),
						strPrimerNivelAnterior: $('#txtPrimerNivelAnterior_catalogo_cuentas_contabilidad').val(),
						strSegundoNivel: $('#txtSegundoNivel_catalogo_cuentas_contabilidad').val(),
						strSegundoNivelAnterior: $('#txtSegundoNivelAnterior_catalogo_cuentas_contabilidad').val(),
						strTercerNivel: $('#txtTercerNivel_catalogo_cuentas_contabilidad').val(),
						strTercerNivelAnterior: $('#txtTercerNivelAnterior_catalogo_cuentas_contabilidad').val(),
						strCuartoNivel: $('#txtCuartoNivel_catalogo_cuentas_contabilidad').val(),
						strCuartoNivelAnterior: $('#txtCuartoNivelAnterior_catalogo_cuentas_contabilidad').val(),
						strDescripcion: $('#txtDescripcion_catalogo_cuentas_contabilidad').val(),
						strNaturaleza: $('#cmbNaturaleza_catalogo_cuentas_contabilidad').val(),
						strTipoCuenta: $('#cmbTipoCuenta_catalogo_cuentas_contabilidad').val(),
						strAceptaMovimientos: $('#cmbAceptaMovimientos_catalogo_cuentas_contabilidad').val(),
						strMovimientosBancarios: $('#cmbMovimientosBancarios_catalogo_cuentas_contabilidad').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_catalogo_cuentas_contabilidad();
							//Hacer un llamado a la función para cerrar modal
							cerrar_catalogo_cuentas_contabilidad();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_catalogo_cuentas_contabilidad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_catalogo_cuentas_contabilidad(tipoMensaje, mensaje)
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
												$('#txtSatCuenta_catalogo_cuentas_contabilidad').focus();
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
		function cambiar_estatus_catalogo_cuentas_contabilidad(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCuentaID_catalogo_cuentas_contabilidad').val();

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
				              'title':    'Catálogo de Cuentas',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_catalogo_cuentas_contabilidad(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_catalogo_cuentas_contabilidad(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_catalogo_cuentas_contabilidad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('contabilidad/catalogo_cuentas/set_estatus',
			      {intCuentaID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_catalogo_cuentas_contabilidad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_catalogo_cuentas_contabilidad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_catalogo_cuentas_contabilidad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_catalogo_cuentas_contabilidad(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/catalogo_cuentas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_catalogo_cuentas_contabilidad();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

				            //Variable que se utiliza para asignar el primer nivel de la cuenta contable
				            var strPrimerNivel = data.row.primer_nivel;

				          	//Recuperar valores
				            $('#txtCuentaID_catalogo_cuentas_contabilidad').val(data.row.cuenta_id);
				            $('#txtCuentaPadreID_catalogo_cuentas_contabilidad').val(data.row.cuenta_padre_id);
				            $('#txtCuentaPadre_catalogo_cuentas_contabilidad').val(data.row.cuenta_padre);
				            $('#txtCuentaPadreCodigo_catalogo_cuentas_contabilidad').val(strPrimerNivel);
				            $('#txtSatCuentaID_catalogo_cuentas_contabilidad').val(data.row.sat_cuenta_id);
				            $('#txtSatCuenta_catalogo_cuentas_contabilidad').val(data.row.sat_cuenta);
				            $('#txtSatCuentaCodigo_catalogo_cuentas_contabilidad').val(strPrimerNivel);
				            $('#txtPrimerNivel_catalogo_cuentas_contabilidad').val(strPrimerNivel);
				            $('#txtPrimerNivelAnterior_catalogo_cuentas_contabilidad').val(strPrimerNivel);
				            $('#txtSegundoNivel_catalogo_cuentas_contabilidad').val(data.row.segundo_nivel);
				            $('#txtSegundoNivelAnterior_catalogo_cuentas_contabilidad').val(data.row.segundo_nivel);
				            $('#txtTercerNivel_catalogo_cuentas_contabilidad').val(data.row.tercer_nivel);
				            $('#txtTercerNivelAnterior_catalogo_cuentas_contabilidad').val(data.row.tercer_nivel);
				            $('#txtCuartoNivel_catalogo_cuentas_contabilidad').val(data.row.cuarto_nivel);
				            $('#txtCuartoNivelAnterior_catalogo_cuentas_contabilidad').val(data.row.cuarto_nivel);
				            $('#txtDescripcion_catalogo_cuentas_contabilidad').val(data.row.descripcion);
				            $('#cmbNaturaleza_catalogo_cuentas_contabilidad').val(data.row.naturaleza);
				            $('#cmbTipoCuenta_catalogo_cuentas_contabilidad').val(data.row.tipo_cuenta);
				            $('#cmbAceptaMovimientos_catalogo_cuentas_contabilidad').val(data.row.acepta_movimientos);
				            $('#cmbMovimientosBancarios_catalogo_cuentas_contabilidad').val(data.row.movimientos_bancarios);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_catalogo_cuentas_contabilidad').addClass("estatus-"+strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_catalogo_cuentas_contabilidad").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmCatalogoCuentasContabilidad').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_catalogo_cuentas_contabilidad").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_catalogo_cuentas_contabilidad").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objCatalogoCuentasContabilidad = $('#CatalogoCuentasContabilidadBox').bPopup({
															  appendTo: '#CatalogoCuentasContabilidadContent', 
								                              contentContainer: 'CatalogoCuentasContabilidadM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCuenta_catalogo_cuentas_contabilidad').focus();
					        }
			       	    }
			       },
			       'json');
		}


		//Función para verificar la existencia de un registro
		function verificar_existencia_catalogo_cuentas_contabilidad()
		{
			//Si no existe id, verificar la existencia de la cuenta
			if ($('#txtCuentaID_catalogo_cuentas_contabilidad').val() == '' && 
				$('#txtPrimerNivel_catalogo_cuentas_contabilidad').val() != '' && 
				$('#txtSegundoNivel_catalogo_cuentas_contabilidad').val() != '' &&
				$('#txtTercerNivel_catalogo_cuentas_contabilidad').val() != '' && 
				$('#txtCuartoNivel_catalogo_cuentas_contabilidad').val() != '')
			{
				//Concatenar criterios de búsqueda para poder verificar la existencia de la cuenta
				var strCriteriosBusqCatalogoCuentasContabilidad = $('#txtPrimerNivel_catalogo_cuentas_contabilidad').val()+'|'+$('#txtSegundoNivel_catalogo_cuentas_contabilidad').val()+'|'+$('#txtTercerNivel_catalogo_cuentas_contabilidad').val()+'|'+$('#txtCuartoNivel_catalogo_cuentas_contabilidad').val();
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con la cuenta 
				editar_catalogo_cuentas_contabilidad(strCriteriosBusqCatalogoCuentasContabilidad, 'cuenta', 'Nuevo');
			}
		}

		//Función para verificar la existencia del primer nivel de un registro 
		function verificar_existencia_primer_nivel_catalogo_cuentas_contabilidad()
		{
			//Variable que se utiliza para asignar el primer nivel de la cuenta contable
	           	var strPrimerNivel =  $('#txtPrimerNivel_catalogo_cuentas_contabilidad').val();
	           	var strSatCuentaCodigo =  $('#txtSatCuentaCodigo_catalogo_cuentas_contabilidad').val();
	           	var strCuentaPadreCodigo =  $('#txtCuentaPadreCodigo_catalogo_cuentas_contabilidad').val();

				//Si existe primer nivel de la cuenta contable
				if(strPrimerNivel != '')
				{
					//Si el primer nivel no coincide con el código (antes del punto) de la cuenta SAT
					if(strPrimerNivel != strSatCuentaCodigo)
					{
						//Limpiar contenido de las siguientes cajas de texto
						$('#txtSatCuentaID_catalogo_cuentas_contabilidad').val('');
						$('#txtSatCuenta_catalogo_cuentas_contabilidad').val('');
					}

					//Si el primer nivel no coincide con el código de la cuenta padre
					if(strPrimerNivel != strCuentaPadreCodigo)
					{
						//Limpiar contenido de las siguientes cajas de texto
						$('#txtCuentaPadreID_catalogo_cuentas_contabilidad').val('');
						$('#txtCuentaPadre_catalogo_cuentas_contabilidad').val('');
					}
				}
				
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_catalogo_cuentas_contabilidad();

		}




		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
            $('#txtPrimerNivel_catalogo_cuentas_contabilidad').numeric({decimal: false, negative: false});
            $('#txtSegundoNivel_catalogo_cuentas_contabilidad').numeric({decimal: false, negative: false});
            $('#txtTercerNivel_catalogo_cuentas_contabilidad').numeric({decimal: false, negative: false});
            $('#txtCuartoNivel_catalogo_cuentas_contabilidad').numeric({decimal: false, negative: false});

			//Comprobar la existencia de la cuenta en la BD cuando pierda el enfoque la caja de texto
			$('#txtPrimerNivel_catalogo_cuentas_contabilidad').focusout(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro (primer nivel)
				verificar_existencia_primer_nivel_catalogo_cuentas_contabilidad();

			});

			//Comprobar la existencia de la cuenta en la BD cuando pierda el enfoque la caja de texto
			$('#txtSegundoNivel_catalogo_cuentas_contabilidad').focusout(function(e){
				
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_catalogo_cuentas_contabilidad();
			});

			//Comprobar la existencia de la cuenta en la BD cuando pierda el enfoque la caja de texto
			$('#txtTercerNivel_catalogo_cuentas_contabilidad').focusout(function(e){
				
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_catalogo_cuentas_contabilidad();
			});

			//Comprobar la existencia de la cuenta en la BD cuando pierda el enfoque la caja de texto
			$('#txtCuartoNivel_catalogo_cuentas_contabilidad').focusout(function(e){
				
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_catalogo_cuentas_contabilidad();
			});

			//Autocomplete para recuperar los datos de una cuenta
	        $('#txtCuentaPadre_catalogo_cuentas_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaPadreID_catalogo_cuentas_contabilidad').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/catalogo_cuentas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'cuenta_padre',
	                   strPrimerNivel: $('#txtPrimerNivel_catalogo_cuentas_contabilidad').val(), 
	                   intCuentaID: $('#txtCuentaID_catalogo_cuentas_contabilidad').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	           	 //Variable que se utiliza para asignar el primer nivel de la cuenta contable
	           	 var strPrimerNivel =  $('#txtPrimerNivel_catalogo_cuentas_contabilidad').val();
	             //Asignar id del registro seleccionado
	             $('#txtCuentaPadreID_catalogo_cuentas_contabilidad').val(ui.item.data);
	             $('#txtCuentaPadreCodigo_catalogo_cuentas_contabilidad').val(strPrimerNivel);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la cuenta cuando pierda el enfoque la caja de texto
	        $('#txtCuentaPadre_catalogo_cuentas_contabilidad').focusout(function(e){
	            //Si no existe id de la cuenta
	            if($('#txtCuentaPadreID_catalogo_cuentas_contabilidad').val() == '' ||
	               $('#txtCuentaPadre_catalogo_cuentas_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCuentaPadreID_catalogo_cuentas_contabilidad').val('');
	               $('#txtCuentaPadre_catalogo_cuentas_contabilidad').val('');
	               $('#txtCuentaPadreCodigo_catalogo_cuentas_contabilidad').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una cuenta SAT
	        $('#txtSatCuenta_catalogo_cuentas_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSatCuentaID_catalogo_cuentas_contabilidad').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_catalogo_cuentas/autocomplete",
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
	           	 //Elegir código de la cuenta SAT antes del punto
			  	 var strCodigo = ui.item.value.split(" - ")[0].split(".")[0];
			  	 //Variable que se utiliza para asignar el primer nivel de la cuenta contable
			  	 var strPrimerNivel = $('#txtPrimerNivel_catalogo_cuentas_contabilidad').val();

			  	 //Si el código de la cuenta SAT coincide con el primer nivel de la cuenta contable
			  	 if(strCodigo == strPrimerNivel)
			  	 {
			  	 	 //Asignar valores del registro seleccionado
	             	 $('#txtSatCuentaID_catalogo_cuentas_contabilidad').val(ui.item.data);
	             	 $('#txtSatCuentaCodigo_catalogo_cuentas_contabilidad').val(strPrimerNivel);
			  	 }
			  	 else
			  	 {
			  	 	//Limpiar contenido de la caja de texto
			  	 	ui.item.value = '';

			  	 	/*Mensaje que se utiliza para informar al usuario que la cuenta SAT no coincide con el primer nivel
			  	 	 de la cuenta contable*/
					var strMensaje = 'La cuenta SAT debe corresponder al ';
					    strMensaje += '<br>primer nivel: <b>'+strPrimerNivel+'</b>';
					    strMensaje += ' de la cuenta contable.';

					//Hacer un llamado a la función para mostrar mensaje de información
				    mensaje_catalogo_cuentas_contabilidad('informacion', strMensaje);
			  	 }
	            
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la cuenta SAT cuando pierda el enfoque la caja de texto
	        $('#txtSatCuenta_catalogo_cuentas_contabilidad').focusout(function(e){
	            //Si no existe id de la cuenta SAT
	            if($('#txtSatCuentaID_catalogo_cuentas_contabilidad').val() == '' ||
	               $('#txtSatCuenta_catalogo_cuentas_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSatCuentaID_catalogo_cuentas_contabilidad').val('');
	               $('#txtSatCuenta_catalogo_cuentas_contabilidad').val('');
	               $('#txtSatCuentaCodigo_catalogo_cuentas_contabilidad').val('');
	            }
	            
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_catalogo_cuentas_contabilidad').on('click','a',function(event){
				event.preventDefault();
				intPaginaCatalogoCuentasContabilidad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_catalogo_cuentas_contabilidad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_catalogo_cuentas_contabilidad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_catalogo_cuentas_contabilidad();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_catalogo_cuentas_contabilidad').addClass("estatus-NUEVO");
				//Abrir modal
				 objCatalogoCuentasContabilidad = $('#CatalogoCuentasContabilidadBox').bPopup({
											   appendTo: '#CatalogoCuentasContabilidadContent', 
				                               contentContainer: 'CatalogoCuentasContabilidadM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCuenta_catalogo_cuentas_contabilidad').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_catalogo_cuentas_contabilidad').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_catalogo_cuentas_contabilidad();
		});
	</script>