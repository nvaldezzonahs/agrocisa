	<div id="ValesGasolinaControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_vales_gasolina_control_vehiculos" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_vales_gasolina_control_vehiculos" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_vales_gasolina_control_vehiculos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_vales_gasolina_control_vehiculos'>
				                    <input class="form-control" id="txtFechaInicialBusq_vales_gasolina_control_vehiculos"
				                    		name= "strFechaInicialBusq_vales_gasolina_control_vehiculos" 
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
								<label for="txtFechaFinalBusq_vales_gasolina_control_vehiculos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_vales_gasolina_control_vehiculos'>
				                    <input class="form-control" id="txtFechaFinalBusq_vales_gasolina_control_vehiculos"
				                    		name= "strFechaFinalBusq_vales_gasolina_control_vehiculos" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los vehículos activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del vehículo seleccionado-->
								<input id="txtVehiculoIDBusq_vales_gasolina_control_vehiculos" 
									   name="intVehiculoIDBusq_vales_gasolina_control_vehiculos"  type="hidden" 
									   value="" />
								<label for="txtVehiculoBusq_vales_gasolina_control_vehiculos">Vehículo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVehiculoBusq_vales_gasolina_control_vehiculos" 
										name="strVehiculoBusq_vales_gasolina_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250" />
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_vales_gasolina_control_vehiculos">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_vales_gasolina_control_vehiculos" 
								 		name="strEstatusBusq_vales_gasolina_control_vehiculos" tabindex="1">
								    <option value="TODOS">TODOS</option>
									<option value="ACTIVO">ACTIVO</option>	
									<option value="INACTIVO">INACTIVO</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_vales_gasolina_control_vehiculos">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_vales_gasolina_control_vehiculos" 
										name="strBusqueda_vales_gasolina_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_vales_gasolina_control_vehiculos" 
									   name="strImprimirDetalles_vales_gasolina_control_vehiculos" type="checkbox"
									   value="" tabindex="1" />
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_vales_gasolina_control_vehiculos"
									onclick="paginacion_vales_gasolina_control_vehiculos();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_vales_gasolina_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_vales_gasolina_control_vehiculos"
									onclick="reporte_vales_gasolina_control_vehiculos();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_vales_gasolina_control_vehiculos"
									onclick="descargar_xls_vales_gasolina_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla vales de gasolina
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Proveedor"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Vehículo"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles del vale de gasolina
				*/
				td.movil.b1:nth-of-type(1):before {content: "Artículo"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Litros"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "IVA"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Total"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles del vale de gasolina
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: "Litros"; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Subtotal"; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: "IVA"; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Total"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_vales_gasolina_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Proveedor</th>
							<th class="movil">Vehículo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_vales_gasolina_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{proveedor}}</td>
							<td class="movil a4">{{vehiculo}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_vales_gasolina_control_vehiculos({{vale_gasolina_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_vales_gasolina_control_vehiculos({{vale_gasolina_id}},'Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
                            	<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_vales_gasolina_control_vehiculos({{vale_gasolina_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_vales_gasolina_control_vehiculos({{vale_gasolina_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_vales_gasolina_control_vehiculos({{vale_gasolina_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_vales_gasolina_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_vales_gasolina_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ValesGasolinaControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_vales_gasolina_control_vehiculos"  class="ModalBodyTitle">
			<h1>Vales de Gasolina</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmValesGasolinaControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmValesGasolinaControlVehiculos"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtValeGasolinaID_vales_gasolina_control_vehiculos" 
										   name="intValeGasolinaID_vales_gasolina_control_vehiculos" type="hidden" value="" />
									<label for="txtFolio_vales_gasolina_control_vehiculos">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_vales_gasolina_control_vehiculos" 
											name="strFolio_vales_gasolina_control_vehiculos" type="text" 
											value="" placeholder="Autogenerado" disabled />
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_vales_gasolina_control_vehiculos">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_vales_gasolina_control_vehiculos'>
					                    <input class="form-control" id="txtFecha_vales_gasolina_control_vehiculos"
					                    		name= "strFecha_vales_gasolina_control_vehiculos" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
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
									<label for="txtHora_vales_gasolina_control_vehiculos">Hora</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class="input-group bootstrap-timepicker timepicker" id="dteHora_vales_gasolina_control_vehiculos">
							            <input 	id="txtHora_vales_gasolina_control_vehiculos"
							            		name= "strHora_vales_gasolina_control_vehiculos" 
							            		type="text" value="" placeholder="Seleccione" class="form-control input-small" />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>
						<!--Bomba-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtBomba_vales_gasolina_control_vehiculos">Bomba</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtBomba_vales_gasolina_control_vehiculos" 
											name="strBomba_vales_gasolina_control_vehiculos" 
											type="text" 
											value="" 
											tabindex="1" placeholder="Ingrese bomba" maxlength="10" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene los proveedores activos-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del  proveedor seleccionado-->
									<input id="txtProveedorID_vales_gasolina_control_vehiculos" 
										   name="intProveedorID_vales_gasolina_control_vehiculos"  type="hidden" value="" />
									<label for="txtProveedor_vales_gasolina_control_vehiculos">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_vales_gasolina_control_vehiculos" 
											name="strProveedor_vales_gasolina_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Factura-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFactura_vales_gasolina_control_vehiculos">Factura</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFactura_vales_gasolina_control_vehiculos" 
											name="strFactura_vales_gasolina_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese factura" maxlength="10" />
								</div>
							</div>
						</div>
					</div>
					  <div class="row">
				    	<!--Autocomplete que contiene los vehículos activos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del  vehículo seleccionado-->
									<input id="txtVehiculoID_vales_gasolina_control_vehiculos" 
										   name="intVehiculoID_vales_gasolina_control_vehiculos"  
										   type="hidden" value="" />
									<label for="txtVehiculo_vales_gasolina_control_vehiculos">Vehículo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtVehiculo_vales_gasolina_control_vehiculos" 
											name="strVehiculo_vales_gasolina_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Placas-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPlacas_vales_gasolina_control_vehiculos">Placas</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPlacas_vales_gasolina_control_vehiculos" 
											name="strPlacas_vales_gasolina_control_vehiculos" type="text" maxlength="10" disabled />
								</div>
							</div>
						</div>
						<!--Kilometraje-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtKilometraje_vales_gasolina_control_vehiculos">Kilometraje</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control moneda_vales_gasolina_control_vehiculos" id="txtKilometraje_vales_gasolina_control_vehiculos" 
											name="intKilometraje_vales_gasolina_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese kilometraje" maxlength="11" />
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Corporativo (tipo de empleado que no pertenece a una sucursal)--> 
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 btn-toolBtns">
							<div class="checkbox">
		                    	<label id="label-checkbox">
		                        	<input class="form-control" id="chbCorporativo_vales_gasolina_control_vehiculos" 
										   name="strCorporativo_vales_gasolina_control_vehiculos" type="checkbox"
										   value="" tabindex="1">
									</input>
									<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
									Corporativo
		                    	</label>
		                  	</div>
						</div>
						<!--Combobox que contiene los módulos activos-->
						<div  class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbModuloID_vales_gasolina_control_vehiculos">Módulo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbModuloID_vales_gasolina_control_vehiculos" 
									 		name="intModuloID_vales_gasolina_control_vehiculos" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las sucursales activas-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
									<input id="txtSucursalID_vales_gasolina_control_vehiculos" 
										   name="intSucursalID_vales_gasolina_control_vehiculos"  
										   type="hidden" 
										   value="" />
									<label for="txtSucursal_vales_gasolina_control_vehiculos">Sucursal</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSucursal_vales_gasolina_control_vehiculos" 
											name="strSucursal_vales_gasolina_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese sucursal" maxlength="250" />
								</div>
							</div>
						</div>
				    </div>
					<div class="row">
						<!--Autocomplete que contiene los empleados activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
									<input id="txtEmpleadoID_vales_gasolina_control_vehiculos" 
										   name="intEmpleadoID_vales_gasolina_control_vehiculos" type="hidden" value="" />
									<label for="txtEmpleado_vales_gasolina_control_vehiculos">Empleado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEmpleado_vales_gasolina_control_vehiculos" 
											name="strEmpleado_vales_gasolina_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250" />
								</div>
							</div>
						</div>
					</div>
				    <div class="row">
				    	<!--Destino-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDestino_vales_gasolina_control_vehiculos">Destino</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtDestino_vales_gasolina_control_vehiculos" 
											name="strDestino_vales_gasolina_control_vehiculos" 
											value="" tabindex="1" placeholder="Ingrese destino" 
											maxlength="250" />
								</div>
							</div>
						</div>
				    </div>
				    <!-- Sección del detallado -->
				    <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!--Div input-group no-mostrar que se utiliza para evitar que el mensaje de validación se muestre en el input-group -->
									<div class='input-group no-mostrar' >
										<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
										<input id="txtNumDetalles_detalles_vales_gasolina_control_vehiculos" 
									   		name="intNumDetalles_vales_gasolina_control_vehiculos" type="hidden" value="" >
									   	</input>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles del vale de gasolina</h4>
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
													<div class="row">
														<!--Artículo-->
														<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
															<div class="form-group">
																<div class="col-md-12">
																	<label for="cmbArticulo_detalles_vales_gasolina_control_vehiculos">Artículo</label>
																</div>
																<div class="col-md-12">
																	<select class="form-control" id="cmbArticulo_detalles_vales_gasolina_control_vehiculos" 
																	 		name="strArticulo_detalles_vales_gasolina_control_vehiculos" tabindex="1">
																	    <option value="">Seleccione una opción</option>
																	    <option value="MAGNA">MAGNA</option>
																	    <option value="PREMIUM">PREMIUM</option>
									                      				<option value="DIESEL">DIESEL</option>
									                      				<option value="LUBRICANTE">LUBRICANTE</option>
									                 				</select>
																</div>
															</div>
														</div>
														<!--Litros-->
														<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
															<div class="form-group">
																<div class="col-md-12">
																	<label for="txtLitros_detalles_vales_gasolina_control_vehiculos">Litros</label>
																</div>
																<div class="col-md-12">
																	<input  class="form-control moneda_vales_gasolina_control_vehiculos" 
																			id="txtLitros_detalles_vales_gasolina_control_vehiculos" 
																			name="intLitros_detalles_vales_gasolina_control_vehiculos" 
																			type="text"
																			placeholder="Ingrese litros" 
																			value="" 
																			tabindex="1" 
																			maxlength="6" 
																			disabled />
																</div>
															</div>
														</div>
														<!--Subtotal-->
														<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
															<div class="form-group">
																<div class="col-md-12">
																	<label for="txtSubtotal_detalles_vales_gasolina_control_vehiculos">Subtotal</label>
																</div>
																<div class="col-md-12">
																	<input  class="form-control moneda_vales_gasolina_control_vehiculos" 
																			id="txtSubtotal_detalles_vales_gasolina_control_vehiculos" 
																			name="intSubtotal_vales_gasolina_control_vehiculos" 
																			type="text" value="" tabindex="1" 
																			placeholder="Ingrese importe" maxlength="12" />
																</div>
															</div>
														</div>
														<!--Iva-->
														<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
															<div class="form-group">
																<div class="col-md-12">
																	<label for="txtIva_detalles_vales_gasolina_control_vehiculos">IVA</label>
																</div>
																<div class="col-md-12">
																	<input  class="form-control moneda_vales_gasolina_control_vehiculos" 
																				id="txtIva_detalles_vales_gasolina_control_vehiculos" 
																				name="intIva_detalles_vales_gasolina_control_vehiculos" 
																				type="text" value="" tabindex="1" 
																				placeholder="Ingrese importe" maxlength="12" />
																</div>
															</div>
														</div>
														<!--Total-->
														<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
															<div class="form-group">
																<div class="col-md-12">
																	<label for="txtTotal_detalles_vales_gasolina_control_vehiculos">Total</label>
																</div>
																<div class="col-md-12">
																		<input  class="form-control" id="txtTotal_detalles_vales_gasolina_control_vehiculos" 
																				name="intTotal_detalles_vales_gasolina_control_vehiculos" type="text" value="" disabled>
																		</input>
																</div>
															</div>
														</div>
														<!--Botón agregar-->
						                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
						                                	<button class="btn btn-primary btn-toolBtns pull-right" 
						                                			id="btnAgregar_vales_gasolina_control_vehiculos" 
						                                			onclick="agregar_renglon_detalles_vales_gasolina_control_vehiculos();" 
						                                	     	title="Agregar" tabindex="1"> 
						                                		<span class="glyphicon glyphicon-plus"></span>
						                                	</button>
						                             	</div>
													</div>
												</div>
											</div>
											<div class="row">
												<!--Div que contiene la tabla con los detalles encontrados-->
												<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
													<div class="row">
														<!-- Diseño de la tabla-->
														<table class="table-hover movil" id="dg_detalles_vales_gasolina_control_vehiculos">
															<thead class="movil">
																<tr class="movil">
																	<th class="movil">Artículo</th>
																	<th class="movil">Litros</th>
																	<th class="movil">Subtotal</th>
																	<th class="movil">IVA</th>
																	<th class="movil">Total</th>
																	<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
																</tr>
															</thead>
															<tbody class="movil"></tbody>
															<tfoot class="movil">
															<tr class="movil">
																<td class="movil t1">
																	<strong>Total</strong>
																</td>
																<td  class="movil t2">
																	<strong id="acumLitros_detalles_vales_gasolina_control_vehiculos"></strong>
																</td>
																<td class="movil t3">
																	<strong id="acumSubtotal_detalles_vales_gasolina_control_vehiculos"></strong>
																</td>
																<td class="movil t4">
																	<strong id="acumIva_detalles_vales_gasolina_control_vehiculos"></strong>
																</td>
																<td class="movil t5">
																	<strong id="acumTotal_detalles_vales_gasolina_control_vehiculos"></strong>
																</td>
																<td class="movil"></td>
															</tr>
														</tfoot>
														</table>
														<br>
														<div class="row">
															<!--Número de registros encontrados-->
															<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																<button class="btn btn-default btn-sm disabled pull-right">
																	<strong id="numElementos_detalles_vales_gasolina_control_vehiculos">0</strong> encontrados
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- Termina sección del Detallado -->

					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_vales_gasolina_control_vehiculos"  
									onclick="validar_vales_gasolina_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_vales_gasolina_control_vehiculos"  
									onclick="cambiar_estatus_vales_gasolina_control_vehiculos('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_vales_gasolina_control_vehiculos"  
									onclick="reporte_registro_vales_gasolina_control_vehiculos('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_vales_gasolina_control_vehiculos"  
									onclick="cambiar_estatus_vales_gasolina_control_vehiculos('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_vales_gasolina_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_vales_gasolina_control_vehiculos();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ValesGasolinaControlVehiculosContent -->

	<!-- /.Plantilla para cargar los módulos en el combobox-->  
	<script id="modulos_vales_gasolina_control_vehiculos" type="text/template">
		<option value="">Seleccione una opción</option>
		<option value="ADMINISTRACION">ADMINISTRACIÓN</option>
		{{#modulos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/modulos}} 
	</script>
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaValesGasolinaControlVehiculos = 0;
		var strUltimaBusquedaValesGasolinaControlVehiculos = "";
		//Variables que se utilizan para la búsqueda de registros
		var intVehiculoIDValesGasolinaControlVehiculos = "";
		var dteFechaInicialValesGasolinaControlVehiculos = "";
		var dteFechaFinalValesGasolinaControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objValesGasolinaControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_vales_gasolina_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/vales_gasolina/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_vales_gasolina_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosValesGasolinaControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosValesGasolinaControlVehiculos = strPermisosValesGasolinaControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosValesGasolinaControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosValesGasolinaControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_vales_gasolina_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosValesGasolinaControlVehiculos[i]=='GUARDAR') || (arrPermisosValesGasolinaControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_vales_gasolina_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosValesGasolinaControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_vales_gasolina_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_vales_gasolina_control_vehiculos();
						}
						else if(arrPermisosValesGasolinaControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_vales_gasolina_control_vehiculos').removeAttr('disabled');
							$('#btnRestaurar_vales_gasolina_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosValesGasolinaControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_vales_gasolina_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosValesGasolinaControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_vales_gasolina_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosValesGasolinaControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_vales_gasolina_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_vales_gasolina_control_vehiculos() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaValesGasolinaControlVehiculos =($('#txtFechaInicialBusq_vales_gasolina_control_vehiculos').val()+$('#txtFechaFinalBusq_vales_gasolina_control_vehiculos').val()+$('#txtVehiculoIDBusq_vales_gasolina_control_vehiculos').val()+$('#cmbEstatusBusq_vales_gasolina_control_vehiculos').val()+$('#txtBusqueda_vales_gasolina_control_vehiculos').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaValesGasolinaControlVehiculos != strUltimaBusquedaValesGasolinaControlVehiculos)
			{
				intPaginaValesGasolinaControlVehiculos = 0;
				strUltimaBusquedaValesGasolinaControlVehiculos = strNuevaBusquedaValesGasolinaControlVehiculos;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/vales_gasolina/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_vales_gasolina_control_vehiculos').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_vales_gasolina_control_vehiculos').val()),
						intVehiculoID: $('#txtVehiculoIDBusq_vales_gasolina_control_vehiculos').val(),
						strEstatus: $('#cmbEstatusBusq_vales_gasolina_control_vehiculos').val(),
					 	strBusqueda: $('#txtBusqueda_vales_gasolina_control_vehiculos').val(),
						intPagina:intPaginaValesGasolinaControlVehiculos,
						strPermisosAcceso: $('#txtAcciones_vales_gasolina_control_vehiculos').val()
					},
					function(data){
						$('#dg_vales_gasolina_control_vehiculos tbody').empty();
						var tmpValesGasolinaControlVehiculos = Mustache.render($('#plantilla_vales_gasolina_control_vehiculos').html(),data);
						$('#dg_vales_gasolina_control_vehiculos tbody').html(tmpValesGasolinaControlVehiculos);
						$('#pagLinks_vales_gasolina_control_vehiculos').html(data.paginacion);
						$('#numElementos_vales_gasolina_control_vehiculos').html(data.total_rows);
						intPaginaValesGasolinaControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_vales_gasolina_control_vehiculos() 
		{
			//Asignar valores para la búsqueda de registros
			intVehiculoIDValesGasolinaControlVehiculos =  $('#txtVehiculoIDBusq_vales_gasolina_control_vehiculos').val();
			dteFechaInicialValesGasolinaControlVehiculos =  $.formatFechaMysql($('#txtFechaInicialBusq_vales_gasolina_control_vehiculos').val());
			dteFechaFinalValesGasolinaControlVehiculos =  $.formatFechaMysql($('#txtFechaFinalBusq_vales_gasolina_control_vehiculos').val());

			//Si no existe fecha inicial
			if(dteFechaInicialValesGasolinaControlVehiculos == '')
			{
				dteFechaInicialValesGasolinaControlVehiculos = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalValesGasolinaControlVehiculos == '')
			{
				dteFechaFinalValesGasolinaControlVehiculos =  '0000-00-00';
			}

			//Si no existe id del vehículo
			if(intVehiculoIDValesGasolinaControlVehiculos == '')
			{
				intVehiculoIDValesGasolinaControlVehiculos = 0;
			}

			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_vales_gasolina_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_vales_gasolina_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_vales_gasolina_control_vehiculos').val('NO');
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/vales_gasolina/get_reporte/"
					+dteFechaInicialValesGasolinaControlVehiculos+"/"
					+dteFechaFinalValesGasolinaControlVehiculos+"/"
					+intVehiculoIDValesGasolinaControlVehiculos+"/"
					+$('#cmbEstatusBusq_vales_gasolina_control_vehiculos').val()+"/"
					+$('#chbImprimirDetalles_vales_gasolina_control_vehiculos').val()+"/"
					+$('#txtBusqueda_vales_gasolina_control_vehiculos').val());
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_vales_gasolina_control_vehiculos(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtValeGasolinaID_vales_gasolina_control_vehiculos').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/vales_gasolina/get_reporte_registro/"+intID);

		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_vales_gasolina_control_vehiculos() 
		{
			//Asignar valores para la búsqueda de registros
			intVehiculoIDValesGasolinaControlVehiculos =  $('#txtVehiculoIDBusq_vales_gasolina_control_vehiculos').val();
			dteFechaInicialValesGasolinaControlVehiculos =  $.formatFechaMysql($('#txtFechaInicialBusq_vales_gasolina_control_vehiculos').val());
			dteFechaFinalValesGasolinaControlVehiculos =  $.formatFechaMysql($('#txtFechaFinalBusq_vales_gasolina_control_vehiculos').val());

			//Si no existe fecha inicial
			if(dteFechaInicialValesGasolinaControlVehiculos == '')
			{
				dteFechaInicialValesGasolinaControlVehiculos = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalValesGasolinaControlVehiculos == '')
			{
				dteFechaFinalValesGasolinaControlVehiculos =  '0000-00-00';
			}

			//Si no existe id del vehículo
			if(intVehiculoIDValesGasolinaControlVehiculos == '')
			{
				intVehiculoIDValesGasolinaControlVehiculos = 0;
			}
			
			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_vales_gasolina_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_vales_gasolina_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_vales_gasolina_control_vehiculos').val('NO');
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/vales_gasolina/get_xls/"
					+dteFechaInicialValesGasolinaControlVehiculos+"/"
					+dteFechaFinalValesGasolinaControlVehiculos+"/"
					+intVehiculoIDValesGasolinaControlVehiculos+"/"
					+$('#cmbEstatusBusq_vales_gasolina_control_vehiculos').val()+"/"
					+$('#chbImprimirDetalles_vales_gasolina_control_vehiculos').val()+"/"
					+$('#txtBusqueda_vales_gasolina_control_vehiculos').val());
			
		}


		//Regresar módulos activos para cargarlos en el combobox
		function cargar_modulos_vales_gasolina_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los módulos que se encuentran activos 
			$.post('crm/modulos/get_combo_box', {},
				function(data)
				{
					$('#cmbModuloID_vales_gasolina_control_vehiculos').empty();
					var temp = Mustache.render($('#modulos_vales_gasolina_control_vehiculos').html(), data);
					$('#cmbModuloID_vales_gasolina_control_vehiculos').html(temp);
				},
				'json');
		}

		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_vales_gasolina_control_vehiculos()
		{
			//Incializar formulario
			$('#frmValesGasolinaControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_vales_gasolina_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmValesGasolinaControlVehiculos').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_vales_gasolina_control_vehiculos').val(fechaActual());
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_vales_gasolina_control_vehiculos(); 
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_vales_gasolina_control_vehiculos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_vales_gasolina_control_vehiculos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_vales_gasolina_control_vehiculos').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmValesGasolinaControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar caja de texto
			$('#txtFolio_vales_gasolina_control_vehiculos').attr("disabled", "disabled");
			$('#txtPlacas_vales_gasolina_control_vehiculos').attr("disabled", "disabled");
			$('#txtTotal_detalles_vales_gasolina_control_vehiculos').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_vales_gasolina_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_vales_gasolina_control_vehiculos").hide();
			$("#btnRestaurar_vales_gasolina_control_vehiculos").hide();

		}


		//Función para inicializar elementos del vehículo
		function inicializar_vehiculo_vales_gasolina_control_vehiculos()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtPlacas_vales_gasolina_control_vehiculos').val('');
            $('#txtSucursalID_vales_gasolina_control_vehiculos').val('');
            $('#txtSucursal_vales_gasolina_control_vehiculos').val('');
            $('#cmbModuloID_vales_gasolina_control_vehiculos').val('');
            $('#txtEmpleadoID_vales_gasolina_control_vehiculos').val('');
            $('#txtEmpleado_vales_gasolina_control_vehiculos').val('');
            //Habilitar los siguientes elementos del formulario
			$("#txtSucursal_vales_gasolina_control_vehiculos").removeAttr('disabled');
			$("#cmbModuloID_vales_gasolina_control_vehiculos").removeAttr('disabled');
            //Desmarcar (Deseleccionar) checkbox para indicar que el empleado pertenece a una sucursal
        	$('#chbCorporativo_vales_gasolina_control_vehiculos').prop("checked", false);
		}


		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_vales_gasolina_control_vehiculos()
		{
			//Eliminar los datos de la tabla detalles del vale
			$('#dg_detalles_vales_gasolina_control_vehiculos tbody').empty();
			$('#acumLitros_detalles_vales_gasolina_control_vehiculos').html('');
		    $('#acumSubtotal_detalles_vales_gasolina_control_vehiculos').html('');
		    $('#acumIva_detalles_vales_gasolina_control_vehiculos').html('');
		    $('#acumTotal_detalles_vales_gasolina_control_vehiculos').html('');
			$('#numElementos_detalles_vales_gasolina_control_vehiculos').html(0);
			$('#txtNumDetalles_detalles_vales_gasolina_control_vehiculos').val('');
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_vales_gasolina_control_vehiculos()
		{
			try {
				//Cerrar modal
				objValesGasolinaControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_vales_gasolina_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_vales_gasolina_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_vales_gasolina_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmValesGasolinaControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_vales_gasolina_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHora_vales_gasolina_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										},
										strBomba_vales_gasolina_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba una bomba'}
											}
										},
										strProveedor_vales_gasolina_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtProveedorID_vales_gasolina_control_vehiculos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un proveedor existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFactura_vales_gasolina_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strEmpleado_vales_gasolina_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtEmpleadoID_vales_gasolina_control_vehiculos').val() === '')
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
										intModuloID_vales_gasolina_control_vehiculos: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                	//Verificar que exista id del módulo cuando el empleado no sea corporativo
					                                    if(!$('#chbCorporativo_vales_gasolina_control_vehiculos').is(':checked') && $('#cmbModuloID_vales_gasolina_control_vehiculos').val() === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccione un módulo'
					                                        };
					                                    }
														return true;
					                                }
					                            }
											}
										},
										strSucursal_vales_gasolina_control_vehiculos: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la sucursal cuando el empleado no sea corporativo
					                                    if(!$('#chbCorporativo_vales_gasolina_control_vehiculos').is(':checked') && $('#txtSucursalID_vales_gasolina_control_vehiculos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una sucursal existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strVehiculo_vales_gasolina_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vehículo
					                                    if($('#txtVehiculoID_vales_gasolina_control_vehiculos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un vehículo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intKilometraje_vales_gasolina_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba un kilometraje'}
											}
										},
										strDestino_vales_gasolina_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba un destino'}
											}
										},
										intNumDetalles_vales_gasolina_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para este vale'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strArticulo_detalles_vales_gasolina_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intLitros_detalles_vales_gasolina_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intSubtotal_detalles_vales_gasolina_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intIva_detalles_vales_gasolina_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										}

									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_vales_gasolina_control_vehiculos = $('#frmValesGasolinaControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_vales_gasolina_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_vales_gasolina_control_vehiculos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_vales_gasolina_control_vehiculos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_vales_gasolina_control_vehiculos()
		{
			try
			{
				$('#frmValesGasolinaControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_vales_gasolina_control_vehiculos()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_vales_gasolina_control_vehiculos').getElementsByTagName('tbody')[0];
			
			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrArticulos = [];
			var arrLitros = [];
			var arrSubtotales = [];
			var arrIvas = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variable que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intLitros = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				var intSubtotal = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intIva = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				
				//Asignar valores a los arrays
				arrArticulos.push(objRen.getAttribute('id'));
				arrLitros.push(intLitros);
				arrSubtotales.push(intSubtotal);
				arrIvas.push(intIva);
			}

			//Variable que se utiliza para asignar el id del módulo
			var intModuloIDVale = $('#cmbModuloID_vales_gasolina_control_vehiculos').val();

			//Si el módulo corresponde a Administración
			if(intModuloIDVale == 'ADMINISTRACION')
			{
				//Asignar cadena vacía  porque el módulo no se encuentra en la tabla modulos
				intModuloIDVale = '';
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/vales_gasolina/guardar',
			{ 
				//Datos del vale de gasolina
				intValeGasolinaID: $('#txtValeGasolinaID_vales_gasolina_control_vehiculos').val(),
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				dteFecha: $.formatFechaMysql($('#txtFecha_vales_gasolina_control_vehiculos').val()),
				intProveedorID: $('#txtProveedorID_vales_gasolina_control_vehiculos').val(),
				strHora: convertirHora12a24($('#txtHora_vales_gasolina_control_vehiculos').val()),
				strBomba: $('#txtBomba_vales_gasolina_control_vehiculos').val(),
				strFactura: $('#txtFactura_vales_gasolina_control_vehiculos').val(),
				intVehiculoID: $('#txtVehiculoID_vales_gasolina_control_vehiculos').val(),
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intKilometraje:  $.reemplazar($('#txtKilometraje_vales_gasolina_control_vehiculos').val(), ",", ""),
				intEmpleadoID: $('#txtEmpleadoID_vales_gasolina_control_vehiculos').val(),
				intModuloID: intModuloIDVale,
				intSucursalID: $('#txtSucursalID_vales_gasolina_control_vehiculos').val(),
				strDestino: $('#txtDestino_vales_gasolina_control_vehiculos').val(),
				//Datos de los detalles
				strArticulos: arrArticulos.join('|'), 
				strLitros: arrLitros.join('|'),
				strSubtotales: arrSubtotales.join('|'),
				strIvas: arrIvas.join('|'),
				intProcesoMenuID: $('#txtProcesoMenuID_vales_gasolina_control_vehiculos').val()
			},
			function(data) {
				if (data.resultado)
				{
					//Hacer un llamado a la función para cerrar modal
					cerrar_vales_gasolina_control_vehiculos();      
					//Hacer llamado a la función  para cargar los registros en el grid
					paginacion_vales_gasolina_control_vehiculos();            
				}

				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_vales_gasolina_control_vehiculos(data.tipo_mensaje, data.mensaje);
			},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_vales_gasolina_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_vales_gasolina_control_vehiculos(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtValeGasolinaID_vales_gasolina_control_vehiculos').val();

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
				              'title':    'Vales de Gasolina',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('control_vehiculos/vales_gasolina/set_estatus',
				                                     {
				                                     	intValeGasolinaID: intID,
				                                      	strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                            //Hacer llamado a la función  para cargar  los registros en el grid
				                                            paginacion_vales_gasolina_control_vehiculos();

				                                            //Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_vales_gasolina_control_vehiculos();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_vales_gasolina_control_vehiculos(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('control_vehiculos/vales_gasolina/set_estatus',
				     {
				     	intValeGasolinaID: intID,
				      	strEstatus: estatus
				     },
				     function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función para cargar  los registros en el grid
							paginacion_vales_gasolina_control_vehiculos();

							//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_vales_gasolina_control_vehiculos();     
							}
						}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_vales_gasolina_control_vehiculos(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_vales_gasolina_control_vehiculos(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/vales_gasolina/get_datos',
			       {
			       	  intValeGasolinaID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_vales_gasolina_control_vehiculos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				            
				          	//Recuperar valores
				          	$('#txtValeGasolinaID_vales_gasolina_control_vehiculos').val(data.row.vale_gasolina_id);
				          	$('#txtFolio_vales_gasolina_control_vehiculos').val(data.row.folio);
				          	$('#txtFecha_vales_gasolina_control_vehiculos').val(data.row.fecha);
				          	$('#txtHora_vales_gasolina_control_vehiculos').timepicker('setTime', data.row.hora);
				          	$('#txtProveedorID_vales_gasolina_control_vehiculos').val(data.row.proveedor_id);
						    $('#txtProveedor_vales_gasolina_control_vehiculos').val(data.row.proveedor);
				          	$('#txtBomba_vales_gasolina_control_vehiculos').val(data.row.bomba);
				          	$('#txtFactura_vales_gasolina_control_vehiculos').val(data.row.factura);
				          	$('#txtVehiculoID_vales_gasolina_control_vehiculos').val(data.row.vehiculo_id);
						    $('#txtVehiculo_vales_gasolina_control_vehiculos').val(data.row.vehiculo);
						    $('#txtPlacas_vales_gasolina_control_vehiculos').val(data.row.placas);
						    $('#txtKilometraje_vales_gasolina_control_vehiculos').val(data.row.kilometraje);
						    $('#txtEmpleadoID_vales_gasolina_control_vehiculos').val(data.row.empleado_id);
						    $('#txtEmpleado_vales_gasolina_control_vehiculos').val(data.row.empleado);

						    //Si existe id de la sucursal
						    if(data.row.sucursal_id > 0)
						    {
						    	$('#txtSucursalID_vales_gasolina_control_vehiculos').val(data.row.sucursal_id);
						    	$('#txtSucursal_vales_gasolina_control_vehiculos').val(data.row.sucursal);
						    	
						    	//Si existe id del módulo
						    	if(data.row.modulo_id > 0)
						    	{	
						    		$('#cmbModuloID_vales_gasolina_control_vehiculos').val(data.row.modulo_id);
						    	}
						    	else
						    	{
						    		$('#cmbModuloID_vales_gasolina_control_vehiculos').val('ADMINISTRACION');
						    	}
						    	
						    }
						    else
						    {
						    	//Marcar (Seleccionar) checkbox para indicar que el empleado no pertenece a una sucursal
		   					    $('#chbCorporativo_vales_gasolina_control_vehiculos').prop("checked", true);
						    	//Deshabilitar los siguientes elementos del formulario
								$("#txtSucursal_vales_gasolina_control_vehiculos").attr('disabled','disabled');
								$("#cmbModuloID_vales_gasolina_control_vehiculos").attr('disabled','disabled');
						    }

						    $('#txtDestino_vales_gasolina_control_vehiculos').val(data.row.destino);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtKilometraje_vales_gasolina_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
					       
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_vales_gasolina_control_vehiculos').addClass("estatus-"+strEstatus);

				            //Si el tipo de acción corresponde a Editar
				            if(tipoAccion == 'Editar')
							{
								strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
													" onclick='editar_renglon_detalles_vales_gasolina_control_vehiculos(this)'>" + 
													"<span class='glyphicon glyphicon-edit'></span></button>" + 
													"<button class='btn btn-default btn-xs' title='Eliminar'" +
													" onclick='eliminar_renglon_detalles_vales_gasolina_control_vehiculos(this)'>" + 
													"<span class='glyphicon glyphicon-trash'></span></button>" + 
													"<button class='btn btn-default btn-xs up' title='Subir'>" + 
													"<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													"<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													"<span class='glyphicon glyphicon-arrow-down'></span></button>";

								//Mostrar botón Desactivar
				            	$("#btnDesactivar_vales_gasolina_control_vehiculos").show();
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmValesGasolinaControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_vales_gasolina_control_vehiculos").hide(); 
								
				           		//Si el estatus es INACTIVO
								if(strEstatus == 'INACTIVO')
								{
									//Mostrar botón Restaurar
									$("#btnRestaurar_vales_gasolina_control_vehiculos").show();
								}
								
							}
				            
			            
				            //Si existen detalles
			       	    	if(data.detalles)
			       	    	{

			       	    		//Mostramos los detalles del registro
								for (var intCon in data.detalles) 
					            {	
					            	//Obtenemos el objeto de la tabla
									var objTabla = document.getElementById('dg_detalles_vales_gasolina_control_vehiculos').getElementsByTagName('tbody')[0];
									
									//Variables que se utilizan para asignar valores del detalle
									var intSubtotal = parseFloat(data.detalles[intCon].subtotal);
									var intIva =  parseFloat(data.detalles[intCon].iva);
									var intTotal = 0;

									//Calcular importe total
								    intTotal = intSubtotal + intIva;


									//Insertamos el renglón con sus celdas en el objeto de la tabla
									var objRenglon = objTabla.insertRow();
									var objCeldaArticulo = objRenglon.insertCell(0);
									var objCeldaLitros = objRenglon.insertCell(1);
									var objCeldaSubtotal = objRenglon.insertCell(2);
									var objCeldaIva = objRenglon.insertCell(3);
									var objCeldaTotal = objRenglon.insertCell(4);
									var objCeldaAcciones = objRenglon.insertCell(5);

									//Asignar valores
									objRenglon.setAttribute('class', 'movil');
									objRenglon.setAttribute('id', data.detalles[intCon].articulo);
									objCeldaArticulo.setAttribute('class', 'movil b1');
									objCeldaArticulo.innerHTML = data.detalles[intCon].articulo;
									objCeldaLitros.setAttribute('class', 'movil b2');
									objCeldaLitros.innerHTML = data.detalles[intCon].litros;
									objCeldaSubtotal.setAttribute('class', 'movil b3');
									objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 2, '');
									objCeldaIva.setAttribute('class', 'movil b4');
									objCeldaIva.innerHTML = formatMoney(intIva, 2, '');
									objCeldaTotal.setAttribute('class', 'movil b5');
									objCeldaTotal.innerHTML = formatMoney(intTotal, 2, '');
									objCeldaAcciones.setAttribute('class', 'td-center movil b6');
									objCeldaAcciones.innerHTML = strAccionesTabla;
					            }

			       	    	}

							//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_detalles_vales_gasolina_control_vehiculos tr").length - 2;
							$('#numElementos_detalles_vales_gasolina_control_vehiculos').html(intFilas);
							$('#txtNumDetalles_detalles_vales_gasolina_control_vehiculos').val(intFilas);

							//Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_vales_gasolina_control_vehiculos();

							//Abrir modal
				            objValesGasolinaControlVehiculos = $('#ValesGasolinaControlVehiculosBox').bPopup({
														  appendTo: '#ValesGasolinaControlVehiculosContent', 
							                              contentContainer: 'ValesGasolinaControlVehiculosM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});


				            //Enfocar caja de texto
							$('#txtProveedor_vales_gasolina_control_vehiculos').focus();
			       	    }
			       },
			       'json');
		}


		//Función para regresar obtener los datos de un vehículo 
		function get_datos_vehiculo_vales_gasolina_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los datos del vehículo
             $.post('control_vehiculos/vehiculos/get_datos',
              { 
              	strBusqueda:$("#txtVehiculoID_vales_gasolina_control_vehiculos").val(),
	       		strTipo: 'id'
              },
              function(data) {

                if(data.row){
                   //Recuperar valores
                   $("#txtVehiculo_vales_gasolina_control_vehiculos").val(data.row.codigo+ ' - '+data.row.modelo + ' ' + data.row.marca );
                    $("#txtPlacas_vales_gasolina_control_vehiculos").val(data.row.placas); 
                    $('#txtEmpleadoID_vales_gasolina_control_vehiculos').val(data.row.responsable_id);
		            $('#txtEmpleado_vales_gasolina_control_vehiculos').val(data.row.responsable);

				    //Si existe id de la sucursal
				    if(data.row.sucursal_id > 0)
				    {
				    	$('#txtSucursalID_vales_gasolina_control_vehiculos').val(data.row.sucursal_id);
				    	$('#txtSucursal_vales_gasolina_control_vehiculos').val(data.row.sucursal);
				    }
				    else
				    {
				    	//Marcar (Seleccionar) checkbox para indicar que el empleado no pertenece a una sucursal
   					    $('#chbCorporativo_vales_gasolina_control_vehiculos').prop("checked", true);
				    	//Deshabilitar los siguientes elementos del formulario
						$("#txtSucursal_vales_gasolina_control_vehiculos").attr('disabled','disabled');
						$("#cmbModuloID_vales_gasolina_control_vehiculos").attr('disabled','disabled');
				    }
                }

              }
             ,
            'json');
		}


		
		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_vales_gasolina_control_vehiculos()
		{
			//Obtenemos los datos de las cajas de texto
			var strArticulo = $('#cmbArticulo_detalles_vales_gasolina_control_vehiculos').val();
			var intLitros = $('#txtLitros_detalles_vales_gasolina_control_vehiculos').val();
			var intSubtotal = $('#txtSubtotal_detalles_vales_gasolina_control_vehiculos').val();
			var intIva = $('#txtIva_detalles_vales_gasolina_control_vehiculos').val();
			var intTotal = $('#txtTotal_detalles_vales_gasolina_control_vehiculos').val();
			
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_vales_gasolina_control_vehiculos').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if(strArticulo == '')
			{
				//Enfocar caja de texto
				$('#cmbArticulo_detalles_vales_gasolina_control_vehiculos').focus();
			}
			else if(intLitros == '')
			{
				//Enfocar caja de texto
				$('#txtLitros_detalles_vales_gasolina_control_vehiculos').focus();
			}
			else if(intSubtotal == '')
			{
				//Enfocar caja de texto
				$('#txtSubtotal_detalles_vales_gasolina_control_vehiculos').focus();
			}
			else if(intIva == '')
			{
				//Enfocar caja de texto
				$('#txtIva_detalles_vales_gasolina_control_vehiculos').focus();
			}
			else
			{

				//Limpiamos las cajas de texto
				$('#cmbArticulo_detalles_vales_gasolina_control_vehiculos').val('');
				$('#txtLitros_detalles_vales_gasolina_control_vehiculos').val('');
				$('#txtSubtotal_detalles_vales_gasolina_control_vehiculos').val('');
				$('#txtIva_detalles_vales_gasolina_control_vehiculos').val('');
				$('#txtTotal_detalles_vales_gasolina_control_vehiculos').val('');

				//Convertir cadena de texto a número decimal
				intLitros = parseFloat($.reemplazar(intLitros, ",", ""));
				intSubtotal = parseFloat($.reemplazar(intSubtotal, ",", ""));
				intIva = parseFloat($.reemplazar(intIva, ",", ""));
				intTotal = parseFloat($.reemplazar(intTotal, ",", ""));

				//Cambiar cantidad a  formato moneda (a visualizar)
			    intLitros =  formatMoney(intLitros, 2, '');
			    intSubtotal =  formatMoney(intSubtotal, 2, '');
				intIva =  formatMoney(intIva, 2, '');
				intTotal =  formatMoney(intTotal, 2, '');


				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
				if (!objTabla.rows.namedItem(strArticulo))
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaArticulo = objRenglon.insertCell(0);
					var objCeldaLitros = objRenglon.insertCell(1);
					var objCeldaSubtotal = objRenglon.insertCell(2);
					var objCeldaIva = objRenglon.insertCell(3);
					var objCeldaTotal = objRenglon.insertCell(4);
					var objCeldaAcciones = objRenglon.insertCell(5);

					objRenglon.setAttribute('id', strArticulo);
					objCeldaArticulo.setAttribute('class', 'movil b1');
					objCeldaArticulo.innerHTML = strArticulo;
					objCeldaLitros.setAttribute('class', 'movil b2');
					objCeldaLitros.innerHTML = intLitros;
					objCeldaSubtotal.setAttribute('class', 'movil b3');
					objCeldaSubtotal.innerHTML = intSubtotal;
					objCeldaIva.setAttribute('class', 'movil b4');
					objCeldaIva.innerHTML = intIva;
					objCeldaTotal.setAttribute('class', 'movil b5');
					objCeldaTotal.innerHTML = intTotal;
					objCeldaAcciones.setAttribute('class', 'td-center movil b6');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_vales_gasolina_control_vehiculos(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalles_vales_gasolina_control_vehiculos(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				
				}
				else
				{

					objTabla.rows.namedItem(strArticulo).cells[0].innerHTML = strArticulo;
					objTabla.rows.namedItem(strArticulo).cells[1].innerHTML = intLitros;
					objTabla.rows.namedItem(strArticulo).cells[2].innerHTML = intSubtotal;
					objTabla.rows.namedItem(strArticulo).cells[3].innerHTML = intIva;
					objTabla.rows.namedItem(strArticulo).cells[4].innerHTML = intTotal;
				}
				
				//Enfocar caja de texto
				$('#cmbArticulo_detalles_vales_gasolina_control_vehiculos').focus();

				//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
				var intFilas = $("#dg_detalles_vales_gasolina_control_vehiculos tr").length - 2;
				$('#numElementos_detalles_vales_gasolina_control_vehiculos').html(intFilas);
				$('#txtNumDetalles_detalles_vales_gasolina_control_vehiculos').val(intFilas);

				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_vales_gasolina_control_vehiculos();
				
			}

		}

		
		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_vales_gasolina_control_vehiculos(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
	
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_vales_gasolina_control_vehiculos").deleteRow(intRenglon);

			//Enfocar caja de texto
			$('#cmbArticulo_detalles_vales_gasolina_control_vehiculos').focus();

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_detalles_vales_gasolina_control_vehiculos tr").length - 2;
			$('#numElementos_detalles_vales_gasolina_control_vehiculos').html(intFilas);
			$('#txtNumDetalles_detalles_vales_gasolina_control_vehiculos').val(intFilas);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_vales_gasolina_control_vehiculos();
			
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_vales_gasolina_control_vehiculos(objRenglon)
		{	
			//Asignar los valores a los elementos del formulario
			$('#cmbArticulo_detalles_vales_gasolina_control_vehiculos').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtLitros_detalles_vales_gasolina_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtSubtotal_detalles_vales_gasolina_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtIva_detalles_vales_gasolina_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtTotal_detalles_vales_gasolina_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			//Enfocar caja de texto
			$('#cmbArticulo_detalles_vales_gasolina_control_vehiculos').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_vales_gasolina_control_vehiculos()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_vales_gasolina_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumLitros = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumTotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumLitros += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
			}

			//Convertir total de unidades a 2 decimales
			intAcumLitros = formatMoney(intAcumLitros, 2, '');
			//Convertir cantidad a formato moneda
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 2, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, 2, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 2, '');

			//Asignar los valores
			$('#acumLitros_detalles_vales_gasolina_control_vehiculos').html(intAcumLitros);
			$('#acumSubtotal_detalles_vales_gasolina_control_vehiculos').html(intAcumSubtotal);
			$('#acumIva_detalles_vales_gasolina_control_vehiculos').html(intAcumIva);
			$('#acumTotal_detalles_vales_gasolina_control_vehiculos').html(intAcumTotal);

		}

		//Función que se utiliza para calcular el importe total del vale
		function calcular_total_detalles_vales_gasolina_control_vehiculos()
		{
			//Variable que se utiliza para asignar el subtotal
			var intSubtotal = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;
			
         	//Verificar que exista importe de subtotal
			if($('#txtSubtotal_detalles_vales_gasolina_control_vehiculos').val() != '')
			{ 
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intSubtotal = parseFloat($.reemplazar($("#txtSubtotal_detalles_vales_gasolina_control_vehiculos").val(), ",", ""));
			
			}

			//Verificar que exista importe de IVA
			if($('#txtIva_detalles_vales_gasolina_control_vehiculos').val() != '')
			{ 
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intImporteIva = parseFloat($.reemplazar($("#txtIva_detalles_vales_gasolina_control_vehiculos").val(), ",", ""));
			}


			//Calcular importe total
			intTotal =  intSubtotal + intImporteIva ;

			//Cambiar cantidad a formato moneda
			intTotal = formatMoney(intTotal, 2, '');
			//Asignar importe total 
			$('#txtTotal_detalles_vales_gasolina_control_vehiculos').val(intTotal);
		}



		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_vales_gasolina_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			//Agregar timepicker para seleccionar una hora
			$('#txtHora_vales_gasolina_control_vehiculos').timepicker({minuteStep: 1});
			$('#txtHora_vales_gasolina_control_vehiculos').timepicker('setTime', '');
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtKilometraje_vales_gasolina_control_vehiculos').numeric();
			$('#txtLitros_detalles_vales_gasolina_control_vehiculos').numeric();
        	$('#txtSubtotal_detalles_vales_gasolina_control_vehiculos').numeric();
        	$('#txtIva_detalles_vales_gasolina_control_vehiculos').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_vales_gasolina_control_vehiculos').blur(function(){
				$('.moneda_vales_gasolina_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
			});

        	//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_vales_gasolina_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro seleccionado
	               $('#txtProveedorID_vales_gasolina_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/proveedores/autocomplete",
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
	             	$('#txtProveedorID_vales_gasolina_control_vehiculos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id del proveedor cuando pierda el enfoque la caja de texto
	        $('#txtProveedor_vales_gasolina_control_vehiculos').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_vales_gasolina_control_vehiculos').val() == '' ||
	               $('#txtProveedor_vales_gasolina_control_vehiculos').val() == '' )
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorID_vales_gasolina_control_vehiculos').val('');
	               $('#txtProveedor_vales_gasolina_control_vehiculos').val('');
	            }

	        });


	        //Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleado_vales_gasolina_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEmpleadoID_vales_gasolina_control_vehiculos').val('');
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
	             	$('#txtEmpleadoID_vales_gasolina_control_vehiculos').val(ui.item.data);
	             	//Separar datos del valor devuelto en el autocomplete (devuelve un arreglo)
	                var arrDatos = ui.item.value.split(" - ");
	                //Asignar nombre del empleado
	                ui.item.value = arrDatos[1];
	             
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
	        $('#txtEmpleado_vales_gasolina_control_vehiculos').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoID_vales_gasolina_control_vehiculos').val() == '' ||
	               $('#txtEmpleado_vales_gasolina_control_vehiculos').val() == '' )
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoID_vales_gasolina_control_vehiculos').val('');
	               $('#txtEmpleado_vales_gasolina_control_vehiculos').val('');

	            }

	        });


	        //Autocomplete para recuperar los datos de un vehículo 
	        $('#txtVehiculo_vales_gasolina_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoID_vales_gasolina_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos del vehículo
	               inicializar_vehiculo_vales_gasolina_control_vehiculos();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/vehiculos/autocomplete",
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
		             $('#txtVehiculoID_vales_gasolina_control_vehiculos').val(ui.item.data);
		             //Hacer un llamado a la función para regresar los datos del vehículo
	             	 get_datos_vehiculo_vales_gasolina_control_vehiculos();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vehículo cuando pierda el enfoque la caja de texto
	        $('#txtVehiculo_vales_gasolina_control_vehiculos').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoID_vales_gasolina_control_vehiculos').val() == '' ||
	               $('#txtVehiculo_vales_gasolina_control_vehiculos').val() == '')
	            { 
	               	//Limpiar contenido de las siguientes cajas de texto
	               	$('#txtVehiculoID_vales_gasolina_control_vehiculos').val('');
	               	$('#txtVehiculo_vales_gasolina_control_vehiculos').val('');
	               	//Hacer un llamado a la función para inicializar elementos del vehículo
	               	inicializar_vehiculo_vales_gasolina_control_vehiculos();
	            }

	        });

	        //Autocomplete para recuperar los datos de una sucursal
	        $('#txtSucursal_vales_gasolina_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSucursalID_vales_gasolina_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "administracion/sucursales/autocomplete",
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
	             $('#txtSucursalID_vales_gasolina_control_vehiculos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la sucursal cuando pierda el enfoque la caja de texto
	        $('#txtSucursal_vales_gasolina_control_vehiculos').focusout(function(e){
	            //Si no existe id de la sucursal
	            if($('#txtSucursalID_vales_gasolina_control_vehiculos').val() == '' ||
	               $('#txtSucursal_vales_gasolina_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSucursalID_vales_gasolina_control_vehiculos').val('');
	               $('#txtSucursal_vales_gasolina_control_vehiculos').val('');
	            }

	        });


	        //Habilitar o deshabilitar sucursal, cuando se de click en el checkbox
		    $("#chbCorporativo_vales_gasolina_control_vehiculos").click(function() { 
		     	//Si el checkbox corporativo se encuentra seleccionado (marcado)
				if ($('#chbCorporativo_vales_gasolina_control_vehiculos').is(':checked')) 
		        {
		            //Deshabilitar los siguientes elementos del formulario
					$("#txtSucursal_vales_gasolina_control_vehiculos").attr('disabled','disabled');
					$("#cmbModuloID_vales_gasolina_control_vehiculos").attr('disabled','disabled');
					//Limpiar contenido de las siguientes cajas de texto
		            $('#txtSucursalID_vales_gasolina_control_vehiculos').val('');
		            $('#txtSucursal_vales_gasolina_control_vehiculos').val('');
		            //Limpiar contenido del combobox
		            $('#cmbModuloID_vales_gasolina_control_vehiculos').val('');

		        }
		        else
		        {
		          	//Habilitar los siguientes elementos del formulario
					$("#txtSucursal_vales_gasolina_control_vehiculos").removeAttr('disabled');
					$("#cmbModuloID_vales_gasolina_control_vehiculos").removeAttr('disabled');
		        }
		    
		    }); 

		    //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_vales_gasolina_control_vehiculos').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Pasar al renglón de arriba
	            	row.prev().before(row);
	            }
				
	        });


	        //Calcular el importe total del vale cuando pierda el enfoque la caja de texto
			$('#txtSubtotal_detalles_vales_gasolina_control_vehiculos').focusout(function(e){
				//Hacer un llamado a la función para calcular el importe total del vale
				calcular_total_detalles_vales_gasolina_control_vehiculos();
			});


			//Calcular el importe total del vale cuando pierda el enfoque la caja de texto
			$('#txtIva_detalles_vales_gasolina_control_vehiculos').focusout(function(e){
				//Hacer un llamado a la función para calcular el importe total del vale
				calcular_total_detalles_vales_gasolina_control_vehiculos();
			});

			//Enfocar concepto cuando se modifique la selección del combo
			$('#cmbArticulo_detalles_vales_gasolina_control_vehiculos').change(function(e){
				//Si no existe artículo
				if($('#cmbArticulo_detalles_vales_gasolina_control_vehiculos').val() == '')
				{
					//Enfocar comobox
					$('#cmbArticulo_detalles_vales_gasolina_control_vehiculos').focus();
				}
				else
				{
					//Enfocar caja de texto
					$('#txtLitros_detalles_vales_gasolina_control_vehiculos').focus();
				}


			});


			//Validar que existan litros  cuando se pulse la tecla enter 
			$("#txtLitros_detalles_vales_gasolina_control_vehiculos").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existen litros
		            if($('#txtLitros_detalles_vales_gasolina_control_vehiculos').val() == '')
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtLitros_detalles_vales_gasolina_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {	
			   	    	//Enfocar caja de texto
			   	    	$('#txtSubtotal_detalles_vales_gasolina_control_vehiculos').focus();
			   	    }
		        
		        }  
		    });

		   
		    //Validar que exista subtotal cuando se pulse la tecla enter 
			$("#txtSubtotal_detalles_vales_gasolina_control_vehiculos").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe subtotal
		            if($('#txtSubtotal_detalles_vales_gasolina_control_vehiculos').val() == '')
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtSubtotal_detalles_vales_gasolina_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {	
			   	    	//Hacer un llamado a la función para calcular el importe total del vale
			   	    	calcular_total_detalles_vales_gasolina_control_vehiculos();

			   	    	//Enfocar caja de texto
			   	    	$('#txtIva_detalles_vales_gasolina_control_vehiculos').focus();
			   	    }
		        
		        }  
		    });


		    //Validar que exista IVA cuando se pulse la tecla enter 
			$("#txtIva_detalles_vales_gasolina_control_vehiculos").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe IVA
		            if($('#txtIva_detalles_vales_gasolina_control_vehiculos').val() == '')
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtIva_detalles_vales_gasolina_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {	
			   	    	//Hacer un llamado a la función para calcular el importe total del vale
			   	    	calcular_total_detalles_vales_gasolina_control_vehiculos();
			   	    	//Enfocar botón Agregar
			   	    	$('#btnAgregar_vales_gasolina_control_vehiculos').focus();
			   	    }
		        
		        }  
		    });



			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_vales_gasolina_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_vales_gasolina_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_vales_gasolina_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_vales_gasolina_control_vehiculos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_vales_gasolina_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_vales_gasolina_control_vehiculos').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un vehículo 
	        $('#txtVehiculoBusq_vales_gasolina_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoIDBusq_vales_gasolina_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/vehiculos/autocomplete",
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
	             $('#txtVehiculoIDBusq_vales_gasolina_control_vehiculos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vehículo cuando pierda el enfoque la caja de texto
	        $('#txtVehiculoBusq_vales_gasolina_control_vehiculos').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoIDBusq_vales_gasolina_control_vehiculos').val() == '' ||
	               $('#txtVehiculoBusq_vales_gasolina_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoIDBusq_vales_gasolina_control_vehiculos').val('');
	               $('#txtVehiculoBusq_vales_gasolina_control_vehiculos').val('');
	            }
	            
	        });

			//Paginación de registros
			$('#pagLinks_vales_gasolina_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaValesGasolinaControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_vales_gasolina_control_vehiculos();
			});

			
			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_vales_gasolina_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_vales_gasolina_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_vales_gasolina_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				 objValesGasolinaControlVehiculos = $('#ValesGasolinaControlVehiculosBox').bPopup({
											   appendTo: '#ValesGasolinaControlVehiculosContent', 
				                               contentContainer: 'ValesGasolinaControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtProveedor_vales_gasolina_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_vales_gasolina_control_vehiculos').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_vales_gasolina_control_vehiculos();
			//Hacer un llamado a la función para cargar módulos en el combobox del modal
            cargar_modulos_vales_gasolina_control_vehiculos();
		});
	</script>