	<div id="TraspasosCajaBancosCajaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_traspasos_caja_bancos_caja" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_traspasos_caja_bancos_caja" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_traspasos_caja_bancos_caja">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_traspasos_caja_bancos_caja'>
				                    <input class="form-control" id="txtFechaInicialBusq_traspasos_caja_bancos_caja"
				                    		name= "strFechaInicialBusq_traspasos_caja_bancos_caja" 
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
								<label for="txtFechaFinalBusq_traspasos_caja_bancos_caja">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_traspasos_caja_bancos_caja'>
				                    <input class="form-control" id="txtFechaFinalBusq_traspasos_caja_bancos_caja"
				                    		name= "strFechaFinalBusq_traspasos_caja_bancos_caja" 
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
								<input id="txtEmpleadoIDBusq_traspasos_caja_bancos_caja" 
									   name="intEmpleadoIDBusq_traspasos_caja_bancos_caja"  type="hidden" 
									   value="">
								</input>
								<label for="txtEmpleadoBusq_traspasos_caja_bancos_caja">Empleado</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtEmpleadoBusq_traspasos_caja_bancos_caja" 
										name="strEmpleadoBusq_traspasos_caja_bancos_caja" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_traspasos_caja_bancos_caja">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_traspasos_caja_bancos_caja" 
								 		name="strEstatusBusq_traspasos_caja_bancos_caja" tabindex="1">
								    <option value="TODOS">TODOS</option>
	                  				<option value="ACTIVO">ACTIVO</option>
	                  				<option value="INACTIVO">INACTIVO</option>
	                  				<option value="GENERAR POLIZA">GENERAR PÓLIZA</option>
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
								<label for="txtBusqueda_traspasos_caja_bancos_caja">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_traspasos_caja_bancos_caja" 
										name="strBusqueda_traspasos_caja_bancos_caja" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_traspasos_caja_bancos_caja" 
									   name="strImprimirDetalles_traspasos_caja_bancos_caja" type="checkbox"
									   value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_traspasos_caja_bancos_caja"
									onclick="paginacion_traspasos_caja_bancos_caja();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_traspasos_caja_bancos_caja" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_traspasos_caja_bancos_caja"
									onclick="reporte_traspasos_caja_bancos_caja('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_traspasos_caja_bancos_caja"
									onclick="reporte_traspasos_caja_bancos_caja('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla traspasos_caja_bancos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Empleado"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Cuenta"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla ingresos a relacionar
				*/
				td.movil.b1:nth-of-type(1):before {content: "Referencia"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Renglon Referencia"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "T.C."; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Folio"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Referencia"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "Razón social"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "Fecha"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "Forma Pago"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Módulo"; font-weight: bold;}
				td.movil.b10:nth-of-type(10):before {content: "Importe"; font-weight: bold;}
				td.movil.b11:nth-of-type(11):before {content: "Seleccionar"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla ingresos a relacionar
				*/
				td.movil.bt1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.bt2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.bt3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.bt4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.bt5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.bt6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.bt7:nth-of-type(7):before {content: "Importe"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles
				*/
				td.movil.c1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Referencia"; font-weight: bold;}
				td.movil.c3:nth-of-type(3):before {content: "Razón social"; font-weight: bold;}
				td.movil.c4:nth-of-type(4):before {content: "Fecha"; font-weight: bold;}
				td.movil.c5:nth-of-type(5):before {content: "Forma Pago"; font-weight: bold;}
				td.movil.c6:nth-of-type(6):before {content: "Módulo"; font-weight: bold;}
				td.movil.c7:nth-of-type(7):before {content: "Importe"; font-weight: bold;}
				td.movil.c8:nth-of-type(8):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles
				*/
				td.movil.ct1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.ct2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.ct3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.ct4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.ct5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.ct6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.ct7:nth-of-type(7):before {content: "Importe"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_traspasos_caja_bancos_caja">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Empleado</th>
							<th class="movil">Cuenta</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:12em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_traspasos_caja_bancos_caja" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{empleado}}</td>
							<td class="movil a4">{{cuenta_bancaria}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_traspasos_caja_bancos_caja({{traspaso_caja_banco_id}},'Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_traspasos_caja_bancos_caja({{traspaso_caja_banco_id}},'Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
                            	<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_traspasos_caja_bancos_caja({{traspaso_caja_banco_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_traspasos_caja_bancos_caja({{traspaso_caja_banco_id}}, 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_traspasos_caja_bancos_caja({{traspaso_caja_banco_id}}, '{{poliza_id}}', '{{folio_poliza}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_traspasos_caja_bancos_caja"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_traspasos_caja_bancos_caja">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_traspasos_caja_bancos_caja" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	

		<!-- Diseño del modal Ingresos a Depositar-->
		<div id="RelacionarIngresosTraspasosCajaBancosCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_ingresos_traspasos_caja_bancos_caja" class="ModalBodyTitle">
			<h1>Ingresos a Depositar</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarIngresosTraspasosCajaBancosCaja" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarIngresosTraspasosCajaBancosCaja"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicialBusq_relacionar_ingresos_traspasos_caja_bancos_caja">Fecha inicial</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaInicialBusq_relacionar_ingresos_traspasos_caja_bancos_caja'>
					                    <input class="form-control" id="txtFechaInicialBusq_relacionar_ingresos_traspasos_caja_bancos_caja"
					                    		name= "strFechaInicialBusq_relacionar_ingresos_traspasos_caja_bancos_caja" 
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
									<label for="txtFechaFinalBusq_relacionar_ingresos_traspasos_caja_bancos_caja">Fecha final</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaFinalBusq_relacionar_ingresos_traspasos_caja_bancos_caja'>
					                    <input class="form-control" id="txtFechaFinalBusq_relacionar_ingresos_traspasos_caja_bancos_caja"
					                    		name= "strFechaFinalBusq_relacionar_ingresos_traspasos_caja_bancos_caja" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los clientes activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
									<input id="txtProspectoIDBusq_relacionar_ingresos_traspasos_caja_bancos_caja" 
										   name="intProspectoIDBusq_relacionar_ingresos_traspasos_caja_bancos_caja"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_ingresos_traspasos_caja_bancos_caja">Razón social</label>
								</div>
								<div class="col-md-12">
									<div class="input-group">
										<input class="form-control" id="txtRazonSocialBusq_relacionar_ingresos_traspasos_caja_bancos_caja" 
											   name="strRazonSocialBusq_relacionar_ingresos_traspasos_caja_bancos_caja"  type="text" value="" 
											   tabindex="1" placeholder="Ingrese razón social" maxlength="250" >
										</input>
										<span class="input-group-btn">
											<button class="btn btn-primary" id="btnBuscar_relacionar_ingresos_traspasos_caja_bancos_caja"
													onclick="lista_ingresos_traspasos_caja_bancos_caja();" title="Buscar coincidencias" tabindex="1">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group row">
						<!--Div que contiene la tabla con los ingresos encontrados-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<!-- Caja de texto oculta para asignar el número de registros de la tabla ingresos a depositar--> 
							<input id="txtNumIngresos_relacionar_ingresos_traspasos_caja_bancos_caja" 
								   name="intNumIngreso_relacionar_ingresos_traspasos_caja_bancos_caja" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_ingresos_traspasos_caja_bancos_caja">
								<thead class="movil">
									<tr class="movil">
										<th class="movil">Folio</th>
										<th class="movil">Referencia</th>
										<th class="movil">Razón social</th>
										<th class="movil">Fecha</th>
										<th class="movil">Forma Pago</th>
										<th class="movil">Módulo</th>
										<th class="movil">Importe</th>
										<th class="movil" id="th-acciones" style="width:8em;">Seleccionar</th>
									</tr>
								</thead>
								<tbody class="movil"></tbody>
								<script id="plantilla_relacionar_ingresos_traspasos_caja_bancos_caja" type="text/template"> 
								{{#rows}}
									<tr class="movil">  
										<td class="movil-no-mostrar no-mostrar b1">{{referencia_id}}</td>
										<td class="movil-no-mostrar no-mostrar b2">{{renglon_referencia}}</td>
										<td class="movil-no-mostrar no-mostrar b3">{{tipo_cambio}}</td>
										<td class="movil b4">{{folio}}</td>
										<td class="movil b5">{{folio_detalle}}</td>
										<td class="movil b6">{{razon_social}}</td>
										<td class="movil b7">{{fecha}}</td>
										<td class="movil b8">{{forma_pago}}</td>
										<td class="movil b9">{{tipo_referencia}}</td>
										<td class="movil b10">{{importe}}</td>
										<td class="td-center movil b11"> 
											 <input 	type="checkbox" 
							    		class="form-check-input btn-xs" 
							    		id="chbAgregar_relacionar_ingresos_traspasos_caja_bancos_caja" />
										</td>
									</tr>
									{{/rows}}
									{{^rows}}
									<tr class="movil"> 
										<td class="movil" colspan="8"> No se encontraron resultados.</td>
									</tr> 
									{{/rows}}
								</script>
								<tfoot class="movil">
									<tr class="movil">
										<td class="movil bt1">
											<strong>Total</strong>
										</td>
										<td  class="movil bt2"></td>
										<td class="movil bt3"></td>
										<td class="movil bt4"></td>
										<td class="movil bt5"></td>
										<td class="movil bt6"></td>
										<td class="movil bt7">
											<strong id="acumImporte_relacionar_ingresos_traspasos_caja_bancos_caja"></strong>
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
										<strong id="numElementos_relacionar_ingresos_traspasos_caja_bancos_caja">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar ingresos-->
							<button class="btn btn-success" id="btnAgregar_relacionar_ingresos_traspasos_caja_bancos_caja"  
									onclick="validar_relacionar_ingresos_traspasos_caja_bancos_caja();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_ingresos_traspasos_caja_bancos_caja"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_ingresos_traspasos_caja_bancos_caja();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Ingresos a Depositar-->

		<!-- Diseño del modal Traspaso de Caja a Bancos-->
		<div id="TraspasosCajaBancosCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_traspasos_caja_bancos_caja"  class="ModalBodyTitle">
			<h1>Traspaso de Caja a Bancos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmTraspasosCajaBancosCaja" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmTraspasosCajaBancosCaja"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtTraspasoCajaBancoID_traspasos_caja_bancos_caja" 
										   name="intTraspasoCajaBancoID_traspasos_caja_bancos_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
									<input id="txtEstatus_traspasos_caja_bancos_caja" 
										   name="strEstatus_traspasos_caja_bancos_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar los id´s de las pólizas de anticipos del registro seleccionado-->
									<input id="txtPolizaID_traspasos_caja_bancos_caja" 
										   name="intPolizaID_traspasos_caja_bancos_caja" type="hidden" value="" />
									 <!-- Caja de texto oculta que se utiliza para recuperar los folios de las pólizas de anticipos -->
									<input id="txtFolioPoliza_traspasos_caja_bancos_caja" 
										   name="strFolioPoliza_traspasos_caja_bancos_caja" type="hidden" value="" />
									<label for="txtFolio_traspasos_caja_bancos_caja">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_traspasos_caja_bancos_caja" 
											name="strFolio_traspasos_caja_bancos_caja" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_traspasos_caja_bancos_caja">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_traspasos_caja_bancos_caja'>
					                    <input class="form-control" id="txtFecha_traspasos_caja_bancos_caja"
					                    		name= "strFecha_traspasos_caja_bancos_caja" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Moneda-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la moneda de la cuenta bancaria seleccionada-->
									<input id="txtMonedaID_traspasos_caja_bancos_caja" 
										   name="intMonedaID_traspasos_caja_bancos_caja" type="hidden" value="">
									</input>
									<label for="txtMoneda_traspasos_caja_bancos_caja">Moneda</label>
								</div>
								<div class="col-md-12">
                     				<input  class="form-control" 
											id="txtMoneda_traspasos_caja_bancos_caja" 
											name="strMoneda_traspasos_caja_bancos_caja" 
											type="text" value="" disabled/>
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
									<input id="txtCuentaBancariaID_traspasos_caja_bancos_caja" 
										   name="intCuentaBancariaID_traspasos_caja_bancos_caja"  type="hidden" 
										   value="">
									</input>
									<label for="txtCuentaBancaria_traspasos_caja_bancos_caja">Cuenta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuentaBancaria_traspasos_caja_bancos_caja" 
											name="strCuentaBancaria_traspasos_caja_bancos_caja" type="text" value="" tabindex="1" placeholder="Ingrese cuenta bancaria" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				     	<!--Importe-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporte_traspasos_caja_bancos_caja">Monto</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_traspasos_caja_bancos_caja" id="txtImporte_traspasos_caja_bancos_caja" 
												name="intImporte_traspasos_caja_bancos_caja" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23">
										</input>
										
									</div>
								</div>
							</div>
						</div>
						<!--Diferencia-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDiferencia_traspasos_caja_bancos_caja">Diferencia</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control" id="txtDiferencia_traspasos_caja_bancos_caja" 
												name="intDiferencia_traspasos_caja_bancos_caja" type="text" value="" disabled>
										</input>
										
									</div>
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
									<input id="txtEmpleadoID_traspasos_caja_bancos_caja" 
										   name="intEmpleadoID_traspasos_caja_bancos_caja"  type="hidden" value="">
									</input>
									<label for="txtEmpleado_traspasos_caja_bancos_caja">Empleado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEmpleado_traspasos_caja_bancos_caja" 
											name="strEmpleado_traspasos_caja_bancos_caja" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
				    <div class="row">
				    	<!--Observaciones-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_traspasos_caja_bancos_caja">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_traspasos_caja_bancos_caja" 
											name="strObservaciones_traspasos_caja_bancos_caja" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					 <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!--Div input-group no-mostrar que se utiliza para evitar que el mensaje de validación se muestre en el input-group -->
									<div class='input-group no-mostrar' >
										<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
										<input id="txtNumDetalles_traspasos_caja_bancos_caja" 
											   name="intNumDetalles_traspasos_caja_bancos_caja" type="hidden" value="">
										</input>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles del traspaso</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Buscar ingresos a depositar para agregarlos en la tabla-->
				                                	<button class="btn btn-primary pull-right" 
				                                			id="btnBuscarIngresos_traspasos_caja_bancos_caja"
				                                			onclick="abrir_relacionar_ingresos_traspasos_caja_bancos_caja();" 
				                                	     	title="Buscar ingresos no depositados" tabindex="1"> 
				                                		<span class="glyphicon glyphicon-search"></span> 
				                                		Relacionar ingresos
				                                	</button>
												</div>
												<br>
											</div>
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row ">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_traspasos_caja_bancos_caja">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Folio</th>
																<th class="movil">Referencia</th>
																<th class="movil">Razón social</th>
																<th class="movil">Fecha</th>
																<th class="movil">Forma Pago</th>
																<th class="movil">Módulo</th>
																<th class="movil">Importe</th>
																<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
														<tfoot class="movil">
															<tr class="movil">
																<td class="movil ct1">
																	<strong>Total</strong>
																</td>
																<td class="movil ct2"></td>
																<td class="movil ct3"></td>
																<td class="movil ct4"></td>
																<td class="movil ct5"></td>
																<td class="movil ct6"></td>
																<td  class="movil ct7">
																	<strong id="acumPago_detalles_traspasos_caja_bancos_caja"></strong>
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
																<strong id="numElementos_detalles_traspasos_caja_bancos_caja">0</strong> encontrados
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
					<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_traspasos_caja_bancos_caja" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 	
                  	<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_traspasos_caja_bancos_caja"  
									onclick="validar_traspasos_caja_bancos_caja();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_traspasos_caja_bancos_caja"  
									onclick="reporte_registro_traspasos_caja_bancos_caja('');"  title="Imprimir registro en PDF" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_traspasos_caja_bancos_caja"  
									onclick="cambiar_estatus_traspasos_caja_bancos_caja('', '', '');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_traspasos_caja_bancos_caja"
									type="reset" aria-hidden="true" onclick="cerrar_traspasos_caja_bancos_caja();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Traspaso de Caja a Bancos-->
	</div><!--#TraspasosCajaBancosCajaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaTraspasosCajaBancosCaja = 0;
		var strUltimaBusquedaTraspasosCajaBancosCaja = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
		var strTipoReferenciaTraspasosCajaBancosCaja = "TRASPASO BANCOS";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDTraspasosCajaBancosCaja = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar objeto del modal Ingresos a Depositar
		var objRelacionarIngresosTraspasosCajaBancosCaja = null;
		//Variable que se utiliza para asignar objeto del modal Traspaso de Caja a Bancos
		var objTraspasosCajaBancosCaja = null;

		/*******************************************************************************************************************
		Funciones del objeto Ingresos  relacionados (facturas, anticipos y/o pagos seleccionados)
		*********************************************************************************************************************/
		// Constructor del objeto Ingresos relacionados
		var objIngresosRelacionadosTraspasosCajaBancosCaja;
		function IngresosRelacionadosTraspasosCajaBancosCaja(ingresos)
		{
			this.arrIngresos = ingresos;
		}

		//Función para obtener todos los ingresos seleccionados
		IngresosRelacionadosTraspasosCajaBancosCaja.prototype.getIngresos = function() {
		    return this.arrIngresos;
		}

		//Función para agregar un ingreso al objeto 
		IngresosRelacionadosTraspasosCajaBancosCaja.prototype.setIngreso = function (ingreso){
			this.arrIngresos.push(ingreso);
		}

		//Función para obtener un ingreso del objeto 
		IngresosRelacionadosTraspasosCajaBancosCaja.prototype.getIngreso = function(index) {
		    return this.arrIngresos[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto Ingresos a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto Ingresos a relacionar
		var objIngresoRelacionarTraspasosCajaBancosCaja;
		
		function IngresoRelacionarTraspasosCajaBancosCaja(referenciaID, renglonReferencia, razonSocial, folio, 
														  folioDetalle, tipoCambio, fecha, tipoReferencia, 
														  formaPago, impPagado)
		{
		    this.intReferenciaID = referenciaID;
		    this.intRenglonReferencia = renglonReferencia;
		    this.strRazonSocial = razonSocial;
		    this.strFolio = folio;
		    this.strFolioDetalle = folioDetalle;
		    this.intTipoCambio = tipoCambio;
		    this.dteFecha = fecha;
		    this.strTipoReferencia = tipoReferencia;
		    this.strFormaPago = formaPago;
		    this.intImporte = impPagado;
		}

		/*******************************************************************************************************************
		Funciones del objeto Detalles del traspaso
		*********************************************************************************************************************/
		// Constructor del objeto detalles
		var objDetallesTraspasosCajaBancosCaja;
		function DetallesTraspasosCajaBancosCaja(detalles)
		{
			this.arrDetalles = detalles;
		}

		//Función para agregar una detalle al objeto 
		DetallesTraspasosCajaBancosCaja.prototype.setDetalle = function (detalle){
			this.arrDetalles.push(detalle);
		}

		/*******************************************************************************************************************
		Funciones del objeto Detalle del traspaso
		*********************************************************************************************************************/
		//Constructor del objeto detalle
		var objDetalleTraspasosCajaBancosCaja;
		function DetalleTraspasosCajaBancosCaja(tipoReferencia, referenciaID, renglonReferencia, importe)
		{
			this.strTipoReferencia = tipoReferencia;
			this.intReferenciaID = referenciaID;
			this.intRenglonReferencia = renglonReferencia;
			this.intImporte = importe;
		}

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_traspasos_caja_bancos_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/traspasos_caja_bancos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_traspasos_caja_bancos_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosTraspasosCajaBancosCaja = data.row;
					//Separar la cadena 
					var arrPermisosTraspasosCajaBancosCaja = strPermisosTraspasosCajaBancosCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosTraspasosCajaBancosCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosTraspasosCajaBancosCaja[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_traspasos_caja_bancos_caja').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosTraspasosCajaBancosCaja[i]=='GUARDAR') || (arrPermisosTraspasosCajaBancosCaja[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_traspasos_caja_bancos_caja').removeAttr('disabled');
						}
						else if(arrPermisosTraspasosCajaBancosCaja[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_traspasos_caja_bancos_caja').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_traspasos_caja_bancos_caja();
						}
						else if(arrPermisosTraspasosCajaBancosCaja[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_traspasos_caja_bancos_caja').removeAttr('disabled');
						}
						else if(arrPermisosTraspasosCajaBancosCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_traspasos_caja_bancos_caja').removeAttr('disabled');
						}
						else if(arrPermisosTraspasosCajaBancosCaja[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_traspasos_caja_bancos_caja').removeAttr('disabled');
						}
						else if(arrPermisosTraspasosCajaBancosCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_traspasos_caja_bancos_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_traspasos_caja_bancos_caja() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaTraspasosCajaBancosCaja = ($('#txtFechaInicialBusq_traspasos_caja_bancos_caja').val()+$('#txtFechaFinalBusq_traspasos_caja_bancos_caja').val()+$('#txtEmpleadoIDBusq_traspasos_caja_bancos_caja').val()+$('#cmbEstatusBusq_traspasos_caja_bancos_caja').val()+$('#txtBusqueda_traspasos_caja_bancos_caja').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaTraspasosCajaBancosCaja != strUltimaBusquedaTraspasosCajaBancosCaja)
			{
				intPaginaTraspasosCajaBancosCaja = 0;
				strUltimaBusquedaTraspasosCajaBancosCaja = strNuevaBusquedaTraspasosCajaBancosCaja;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/traspasos_caja_bancos/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_traspasos_caja_bancos_caja').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_traspasos_caja_bancos_caja').val()),
						intEmpleadoID: $('#txtEmpleadoIDBusq_traspasos_caja_bancos_caja').val(),
						strEstatus: $('#cmbEstatusBusq_traspasos_caja_bancos_caja').val(),
						strBusqueda: $('#txtBusqueda_traspasos_caja_bancos_caja').val(),
						intPagina:intPaginaTraspasosCajaBancosCaja,
						strPermisosAcceso: $('#txtAcciones_traspasos_caja_bancos_caja').val()
					},
					function(data){
						$('#dg_traspasos_caja_bancos_caja tbody').empty();
						var tmpTraspasosCajaBancosCaja = Mustache.render($('#plantilla_traspasos_caja_bancos_caja').html(),data);
						$('#dg_traspasos_caja_bancos_caja tbody').html(tmpTraspasosCajaBancosCaja);
						$('#pagLinks_traspasos_caja_bancos_caja').html(data.paginacion);
						$('#numElementos_traspasos_caja_bancos_caja').html(data.total_rows);
						intPaginaTraspasosCajaBancosCaja = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_traspasos_caja_bancos_caja(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'caja/traspasos_caja_bancos/';

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


			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_traspasos_caja_bancos_caja').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_traspasos_caja_bancos_caja').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_traspasos_caja_bancos_caja').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_traspasos_caja_bancos_caja').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_traspasos_caja_bancos_caja').val()),
										'intEmpleadoID': $('#txtEmpleadoIDBusq_traspasos_caja_bancos_caja').val(),
										'strEstatus': $('#cmbEstatusBusq_traspasos_caja_bancos_caja').val(), 
										'strBusqueda': $('#txtBusqueda_traspasos_caja_bancos_caja').val(),
										'strDetalles': $('#chbImprimirDetalles_traspasos_caja_bancos_caja').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_traspasos_caja_bancos_caja(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtTraspasoCajaBancoID_traspasos_caja_bancos_caja').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'caja/traspasos_caja_bancos/get_reporte_registro',
							'data' : {
										'intTraspasoCajaBancoID': intID			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

	
		/*******************************************************************************************************************
		Funciones del modal Ingresos a Depositar
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_ingresos_traspasos_caja_bancos_caja()
		{
			//Incializar formulario
			$('#frmRelacionarIngresosTraspasosCajaBancosCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_ingresos_traspasos_caja_bancos_caja();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarIngresosTraspasosCajaBancosCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_ingresos_traspasos_caja_bancos_caja');
			//Asignar la fecha actual
			$('#txtFechaInicialBusq_relacionar_ingresos_traspasos_caja_bancos_caja').val(fechaActual());
			$('#txtFechaFinalBusq_relacionar_ingresos_traspasos_caja_bancos_caja').val(fechaActual());
			//Eliminar los datos de la tabla ingresos a depositar
		    $('#dg_relacionar_ingresos_traspasos_caja_bancos_caja tbody').empty();
		    $('#numElementos_relacionar_ingresos_traspasos_caja_bancos_caja').html(0);
		    $('#acumImporte_relacionar_ingresos_traspasos_caja_bancos_caja').html('');
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_ingresos_traspasos_caja_bancos_caja()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_ingresos_traspasos_caja_bancos_caja();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_traspasos_caja_bancos_caja').val();
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_ingresos_traspasos_caja_bancos_caja').addClass("estatus-"+strEstatus);
			//Abrir modal
			objRelacionarIngresosTraspasosCajaBancosCaja = $('#RelacionarIngresosTraspasosCajaBancosCajaBox').bPopup({
											  appendTo: '#TraspasosCajaBancosCajaContent', 
			                              	  contentContainer: 'TraspasosCajaBancosCajaM', 
			                              	  zIndex: 2, 
			                              	  modalClose: false, 
			                              	  modal: true, 
			                              	  follow: [true,false], 
			                              	  followEasing : "linear", 
			                              	  easing: "linear", 
			                             	  modalColor: ('#F0F0F0')});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_relacionar_ingresos_traspasos_caja_bancos_caja').focus();
			//Hacer un llamado a la función  para cargar los ingresos en el grid
			lista_ingresos_traspasos_caja_bancos_caja();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_ingresos_traspasos_caja_bancos_caja()
		{
			try {
				//Cerrar modal
				objRelacionarIngresosTraspasosCajaBancosCaja.close();

			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_ingresos_traspasos_caja_bancos_caja()
		{

			//Hacer un llamado a la función para agregar las facturas (ingreso) seleccionadas al  objeto ingreso's  relacionados
			agregar_ingresos_relacionar_ingresos_traspasos_caja_bancos_caja();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_ingresos_traspasos_caja_bancos_caja();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarIngresosTraspasosCajaBancosCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumIngreso_relacionar_ingresos_traspasos_caja_bancos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccionar al menos un ingreso para este traspaso.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFechaInicialBusq_relacionar_ingresos_traspasos_caja_bancos_caja: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinalBusq_relacionar_ingresos_traspasos_caja_bancos_caja: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strRazonSocialBusq_relacionar_ingresos_traspasos_caja_bancos_caja: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_relacionar_ingresos_traspasos_caja_bancos_caja = $('#frmRelacionarIngresosTraspasosCajaBancosCaja').data('bootstrapValidator');
			bootstrapValidator_relacionar_ingresos_traspasos_caja_bancos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_ingresos_traspasos_caja_bancos_caja.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_ingresos_traspasos_caja_bancos_caja();
				//Hacer un llamado a la función para agregar los ingresos en la tabla detalles
		  		agregar_ingresos_relacionados_traspasos_caja_bancos_caja('Nuevo', '');
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_ingresos_traspasos_caja_bancos_caja()
		{
			try
			{
				$('#frmRelacionarIngresosTraspasosCajaBancosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar ingresos
		*********************************************************************************************************************/
		//Función para la búsqueda de ingresos 
		function lista_ingresos_traspasos_caja_bancos_caja() 
		{
			//Variables que se utilizan para asignar los criterios de búsqueda
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaInicialBusq =  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_ingresos_traspasos_caja_bancos_caja').val());
			var dteFechaFinalBusq =  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_ingresos_traspasos_caja_bancos_caja').val());
			var intProspectoIDBusq =  $('#txtProspectoIDBusq_relacionar_ingresos_traspasos_caja_bancos_caja').val();
			

			//Si no existen datos para realizar la búsqueda de coincidencias
			if(intProspectoIDBusq == '' && dteFechaInicialBusq == '' && dteFechaFinalBusq == '')
			{
				intProspectoIDBusq = 0;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/traspasos_caja_bancos/get_ingresos',
					{	dteFechaInicial:  dteFechaInicialBusq,
						dteFechaFinal:  dteFechaFinalBusq,
						intProspectoID: intProspectoIDBusq, 
						intMonedaIDTraspaso: $('#txtMonedaID_traspasos_caja_bancos_caja').val()
					},
					function(data){
						$('#dg_relacionar_ingresos_traspasos_caja_bancos_caja tbody').empty();
						var tmpRelacionarIngresosTraspasosCajaBancosCaja = Mustache.render($('#plantilla_relacionar_ingresos_traspasos_caja_bancos_caja').html(),data);
						$('#numElementos_relacionar_ingresos_traspasos_caja_bancos_caja').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_ingresos_traspasos_caja_bancos_caja').html(data.rows.length);	
						}
						$('#acumImporte_relacionar_ingresos_traspasos_caja_bancos_caja').html(data.acumulado_importe);
						$('#dg_relacionar_ingresos_traspasos_caja_bancos_caja tbody').html(tmpRelacionarIngresosTraspasosCajaBancosCaja);
						
					},
			'json');

			
		}

		//Función para agregar los ingresos seleccionados al objeto Ingresos relacionados
		function agregar_ingresos_relacionar_ingresos_traspasos_caja_bancos_caja()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
             
            //Crear instancia del objeto Ingresos relacionados (facturas, anticipos y/o pagos seleccionados)
			objIngresosRelacionadosTraspasosCajaBancosCaja = new IngresosRelacionadosTraspasosCajaBancosCaja([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_ingresos_traspasos_caja_bancos_caja tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
                	//Crear instancia del objeto Ingresos a relacionar
					objIngresoRelacionarTraspasosCajaBancosCaja = new IngresoRelacionarTraspasosCajaBancosCaja(null, '', '', '', '', 
																											   '', '', '', '', '');
														 
                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objIngresoRelacionarTraspasosCajaBancosCaja.intReferenciaID = strValor;
							        break;
							    case 1:
							        objIngresoRelacionarTraspasosCajaBancosCaja.intRenglonReferencia = strValor;
							        break;
							    case 2:
							        objIngresoRelacionarTraspasosCajaBancosCaja.intTipoCambio = strValor;
							        break;
							    case 3:
							        objIngresoRelacionarTraspasosCajaBancosCaja.strFolio = strValor;
							        break;
							   case 4:
							        objIngresoRelacionarTraspasosCajaBancosCaja.strFolioDetalle = strValor;
							        break;
							    case 5:
							        objIngresoRelacionarTraspasosCajaBancosCaja.strRazonSocial = strValor;
							        break;
							    case 6:
							        objIngresoRelacionarTraspasosCajaBancosCaja.dteFecha = strValor;
							        break;
							    case 7:
							        objIngresoRelacionarTraspasosCajaBancosCaja.strFormaPago = strValor;
							        break;
							    case 8:
							        objIngresoRelacionarTraspasosCajaBancosCaja.strTipoReferencia = strValor;
							        break;
							    case 9:
							       		objIngresoRelacionarTraspasosCajaBancosCaja.intImporte = strValor;
							       	break;
							}

					      	intCol++;
					    });

                	//Agregar datos del ingreso a relacionar
                	objIngresosRelacionadosTraspasosCajaBancosCaja.setIngreso(objIngresoRelacionarTraspasosCajaBancosCaja);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumIngresos_relacionar_ingresos_traspasos_caja_bancos_caja').val(intContador);

		}

		/*******************************************************************************************************************
		Funciones del modal Traspaso de Caja a Bancos
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_traspasos_caja_bancos_caja()
		{
			//Incializar formulario
			$('#frmTraspasosCajaBancosCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_traspasos_caja_bancos_caja();
			//Limpiar cajas de texto ocultas
			$('#frmTraspasosCajaBancosCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_traspasos_caja_bancos_caja');
			//Asignar la fecha actual
			$('#txtFecha_traspasos_caja_bancos_caja').val(fechaActual());
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		 	inicializar_detalles_traspasos_caja_bancos_caja();
			//Habilitar todos los elementos del formulario
			$('#frmTraspasosCajaBancosCaja').find('input, textarea, select').removeAttr('disabled','disabled');
			
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_traspasos_caja_bancos_caja').attr("disabled", "disabled");
			$('#txtMoneda_traspasos_caja_bancos_caja').attr("disabled", "disabled");
			$('#txtDiferencia_traspasos_caja_bancos_caja').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_traspasos_caja_bancos_caja").show();
			$("#btnBuscarIngresos_traspasos_caja_bancos_caja").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_traspasos_caja_bancos_caja").hide();
			$("#btnDesactivar_traspasos_caja_bancos_caja").hide();
			//Deshabilitar botón Buscar ingresos
			$('#btnBuscarIngresos_traspasos_caja_bancos_caja').attr('disabled','-1'); 
			//Crear instancia del objeto Detalles del traspaso
			objDetallesTraspasosCajaBancosCaja = new DetallesTraspasosCajaBancosCaja([]);
		}

		//Función para inicializar elementos de la cuenta bancaria
		function inicializar_cuenta_bancaria_traspasos_caja_bancos_caja()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtMonedaID_traspasos_caja_bancos_caja').val('');
	        $('#txtMoneda_traspasos_caja_bancos_caja').val('');
	        //Deshabilitar botón Buscar ingresos
            $('#btnBuscarIngresos_traspasos_caja_bancos_caja').attr('disabled','-1');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_traspasos_caja_bancos_caja();
		    //Hacer un llamado a la función para calcular la diferencia entre el monto a depositar y el monto de los comprobantes (ingresos)
			calcular_diferencia_traspasos_caja_bancos_caja();

		}

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_traspasos_caja_bancos_caja()
		{
			//Eliminar los datos de la tabla detalles
			$('#dg_detalles_traspasos_caja_bancos_caja tbody').empty();
			$('#numElementos_detalles_traspasos_caja_bancos_caja').html(0);
			$('#acumPago_detalles_traspasos_caja_bancos_caja').html('');
			$('#txtNumDetalles_traspasos_caja_bancos_caja').val('');
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_traspasos_caja_bancos_caja()
		{
			try {
				//Hacer un llamado a la función para cerrar modal Ingresos a Depositar
				cerrar_relacionar_ingresos_traspasos_caja_bancos_caja();
				//Cerrar modal
				objTraspasosCajaBancosCaja.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_traspasos_caja_bancos_caja();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_traspasos_caja_bancos_caja').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_traspasos_caja_bancos_caja()
		{			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_traspasos_caja_bancos_caja();
			//Validación del formulario de campos obligatorios
			$('#frmTraspasosCajaBancosCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_traspasos_caja_bancos_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCuentaBancaria_traspasos_caja_bancos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cuenta bancaria
					                                    if($('#txtCuentaBancariaID_traspasos_caja_bancos_caja').val() === '')
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
										strEmpleado_traspasos_caja_bancos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtEmpleadoID_traspasos_caja_bancos_caja').val() === '')
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
										intImporte_traspasos_caja_bancos_caja: {
											validators: {
												notEmpty: {message: 'Escriba el importe total'}
											}
										},
										intNumDetalles_traspasos_caja_bancos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para este traspaso.'
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
			var bootstrapValidator_traspasos_caja_bancos_caja = $('#frmTraspasosCajaBancosCaja').data('bootstrapValidator');
			bootstrapValidator_traspasos_caja_bancos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_traspasos_caja_bancos_caja.isValid())
			{
			   //Variable que se utiliza para asignar el mensaje informativo
				var strMensaje = '';

				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumPagoDetallesTraspasosCajaBancosCaja = $.reemplazar($('#acumPago_detalles_traspasos_caja_bancos_caja').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumPagoDetallesTraspasosCajaBancosCaja = $.reemplazar(intAcumPagoDetallesTraspasosCajaBancosCaja, ",", "");

				var intMontoTraspasosCajaBancosCaja = $.reemplazar($('#txtImporte_traspasos_caja_bancos_caja').val(), ",", "");

				//Verificar que el importe pagado sea igual al monto
				if(intAcumPagoDetallesTraspasosCajaBancosCaja != intMontoTraspasosCajaBancosCaja)
				{
					/*Mensaje que se utiliza para informar al usuario que existe diferencia entre importes*/
					strMensaje = 'La diferencia entre el monto a depositar y el monto de los comprobantes seleccionados ';
					strMensaje += 'es de  <b>$'+$('#txtDiferencia_traspasos_caja_bancos_caja').val()+'</b><br/>';
					strMensaje += '¿Desea guardar?';

					//Preguntar al usuario si desea guardar el registro
					new $.Zebra_Dialog(strMensaje,
				             {'type':     'question',
				              'title':    'Traspaso de Caja a Bancos',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                             	//Hacer un llamado a la función para guardar los datos del registro
											 	 guardar_traspasos_caja_bancos_caja();
				                            }
				                          }
				              });

				}
				else
				{					
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_traspasos_caja_bancos_caja();
				}
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_traspasos_caja_bancos_caja()
		{
			try
			{
				$('#frmTraspasosCajaBancosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_traspasos_caja_bancos_caja()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_traspasos_caja_bancos_caja').getElementsByTagName('tbody')[0];
			
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++)
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intImporte = $.reemplazar(objRen.cells[6].innerHTML, ",", "");
				//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio =  parseFloat(objRen.cells[10].innerHTML); 

				//Convertir importe a peso mexicano
				intImporte = intImporte * intTipoCambio;

				//Crear instancia del objeto Detalle
				objDetalleTraspasosCajaBancosCaja = new DetalleTraspasosCajaBancosCaja('', '', '', '');
				//Asignar valores al objeto
				objDetalleTraspasosCajaBancosCaja.strTipoReferencia = objRen.cells[5].innerHTML;
				objDetalleTraspasosCajaBancosCaja.intReferenciaID = objRen.cells[8].innerHTML;
				objDetalleTraspasosCajaBancosCaja.intRenglonReferencia = objRen.cells[9].innerHTML;
				objDetalleTraspasosCajaBancosCaja.intImporte = intImporte;
				//Agregar datos del detalle del pago
           		objDetallesTraspasosCajaBancosCaja.setDetalle(objDetalleTraspasosCajaBancosCaja);
			}

			//Hacer un llamado a la función JSON para guardar los detalles del traspaso
			var jsonDetalles = JSON.stringify(objDetallesTraspasosCajaBancosCaja); 
		
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('caja/traspasos_caja_bancos/guardar',
					{ 
						//Datos del traspaso
						intTraspasoCajaBancoID: $('#txtTraspasoCajaBancoID_traspasos_caja_bancos_caja').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_traspasos_caja_bancos_caja').val()),
						intCuentaBancariaID: $('#txtCuentaBancariaID_traspasos_caja_bancos_caja').val(),	
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intImporte: $.reemplazar($('#txtImporte_traspasos_caja_bancos_caja').val(), ",", ""),
						intEmpleadoID: $('#txtEmpleadoID_traspasos_caja_bancos_caja').val(),
						strObservaciones: $('#txtObservaciones_traspasos_caja_bancos_caja').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_traspasos_caja_bancos_caja').val(),
						//Datos de los detalles
						arrDetalles: jsonDetalles
					},
					function(data) {
						if (data.resultado)
						{

							//Si no existe id de la factura de refacciones, significa que es un nuevo registro   
							if($('#txtTraspasoCajaBancoID_traspasos_caja_bancos_caja').val() == '')
							{
							  	//Asignar el id del anticipo registrado en la base de datos
                     			$('#txtTraspasoCajaBancoID_traspasos_caja_bancos_caja').val(data.traspaso_caja_banco_id);
                 			}

							
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_traspasos_caja_bancos_caja(); 

							//Hacer un llamado a la función para generar póliza con los datos del registro
							generar_poliza_traspasos_caja_bancos_caja('', '');
						}

						
						//Si existe mensaje de error
						if(data.tipo_mensaje == 'error')
						{
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_traspasos_caja_bancos_caja(data.tipo_mensaje, data.mensaje);
						}
						
						
					},
			'json');
		}



		//Función para mostrar mensaje de éxito o error
		function mensaje_traspasos_caja_bancos_caja(tipoMensaje, mensaje)
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


		//Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_traspasos_caja_bancos_caja(id,  polizaID, folioPoliza)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para asignar el id de la póliza
			var intPolizaID = 0;
			//Variable que se utiliza para asignar el folio de la póliza
            var strFolioPoliza = '';

			 //Variable que se utiliza para asignar mensaje informativo
		    var strMensaje = '¿Está seguro que desea desactivar el registro ';

			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtTraspasoCajaBancoID_traspasos_caja_bancos_caja').val();
				intPolizaID = $('#txtPolizaID_traspasos_caja_bancos_caja').val();
				strFolioPoliza = $('#txtFolioPoliza_traspasos_caja_bancos_caja').val();

			}
			else
			{
				intID = id;
				intPolizaID = polizaID;
				strFolioPoliza = folioPoliza;
			}

			//Si existe el id de la póliza
			if(intPolizaID > 0)
			{
				strMensaje += '; también se desactivaran las pólizas con folio: '+strFolioPoliza;
			}

			strMensaje += '?';

		   
			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>'+strMensaje+'</strong>',
			             {'type':     'question',
			              'title':    'Traspaso de Caja a Bancos',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
			                              $.post('caja/traspasos_caja_bancos/set_estatus',
			                                     {
			                                     	intTraspasoCajaBancoID: intID, 
			                                     	intPolizaID: intPolizaID
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                          	//Hacer llamado a la función  para cargar  los registros en el grid
			                                          	paginacion_traspasos_caja_bancos_caja();

			                                          	//Si el id del registro se obtuvo del modal
														if(id == '')
														{
															//Hacer un llamado a la función para cerrar modal
															cerrar_traspasos_caja_bancos_caja();     
														}
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_traspasos_caja_bancos_caja(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_traspasos_caja_bancos_caja(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/traspasos_caja_bancos/get_datos',
			       {intTraspasoCajaBancoID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_traspasos_caja_bancos_caja();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';

				          	//Recuperar valores
				          	$('#txtTraspasoCajaBancoID_traspasos_caja_bancos_caja').val(data.row.traspaso_caja_banco_id);
				          	$('#txtFolio_traspasos_caja_bancos_caja').val(data.row.folio);
				          	$('#txtFecha_traspasos_caja_bancos_caja').val(data.row.fecha);
				          	$('#txtCuentaBancariaID_traspasos_caja_bancos_caja').val(data.row.cuenta_bancaria_id);
				          	$('#txtCuentaBancaria_traspasos_caja_bancos_caja').val(data.row.cuenta_bancaria);
				          	$('#txtMonedaID_traspasos_caja_bancos_caja').val(data.row.moneda_id);
				          	$('#txtMoneda_traspasos_caja_bancos_caja').val(data.row.moneda);
				          	$('#txtImporte_traspasos_caja_bancos_caja').val(data.row.importe);
				          	//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporte_traspasos_caja_bancos_caja').formatCurrency({ roundToDecimalPlace: 2 });
						    $('#txtEmpleadoID_traspasos_caja_bancos_caja').val(data.row.empleado_id);
						    $('#txtEmpleado_traspasos_caja_bancos_caja').val(data.row.empleado);
					        $('#txtObservaciones_traspasos_caja_bancos_caja').val(data.row.observaciones);
					        $('#txtPolizaID_traspasos_caja_bancos_caja').val(data.row.poliza_id);
						    $('#txtFolioPoliza_traspasos_caja_bancos_caja').val(data.row.folio_poliza);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_traspasos_caja_bancos_caja').addClass("estatus-"+strEstatus);
				            $('#txtEstatus_traspasos_caja_bancos_caja').val(strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_traspasos_caja_bancos_caja").show();
							

							 //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
                            if(tipoAccion == 'Ver')
                            {

                            	//Deshabilitar todos los elementos del formulario
				            	//Ocultar los siguientes botones
								$("#btnGuardar_traspasos_caja_bancos_caja").hide();
								$("#btnBuscarIngresos_traspasos_caja_bancos_caja").hide();
								//Deshabilitar todos los elementos del formulario
				            	$('#frmTraspasosCajaBancosCaja').find('input, textarea, select').attr('disabled','disabled');


                                //Si el estatus es ACTIVO
                                if(strEstatus == 'ACTIVO')
                                {
                                    //Mostrar el botón Desactivar
                                    $("#btnDesactivar_traspasos_caja_bancos_caja").show();
                                }

                            }
                            else
                            {
                            	//Habilitar botón Buscar ingresos
								$('#btnBuscarIngresos_traspasos_caja_bancos_caja').removeAttr('disabled');

								strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Eliminar'" +
													" onclick='eliminar_renglon_detalles_traspasos_caja_bancos_caja(this)'>" + 
													"<span class='glyphicon glyphicon-trash'></span></button>" + 
													"<button class='btn btn-default btn-xs up' title='Subir'>" + 
													"<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													"<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													"<span class='glyphicon glyphicon-arrow-down'></span></button>";
                            }



				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_traspasos_caja_bancos_caja').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaFolio = objRenglon.insertCell(0);
								var objCeldaFolioDetalle = objRenglon.insertCell(1);
								var objCeldaRazonSocial = objRenglon.insertCell(2);
								var objCeldaFecha = objRenglon.insertCell(3);
								var objCeldaFormaPago = objRenglon.insertCell(4);
								var objCeldaTipoReferencia = objRenglon.insertCell(5);
								var objCeldaImporte = objRenglon.insertCell(6);
								var objCeldaAcciones = objRenglon.insertCell(7);
								//Columnas ocultas
								var objCeldaReferenciaID = objRenglon.insertCell(8);
								var objCeldaRenglonReferencia = objRenglon.insertCell(9);
								var objCeldaTipoCambio = objRenglon.insertCell(10);

								//Variables que se utilizan para asignar valores del detalle
								var strTipoReferencia = data.detalles[intCon].tipo_referencia;
								var intReferenciaID =  data.detalles[intCon].referencia_id;
								var intRenglonReferencia = data.detalles[intCon].renglon_referencia;
							
								//Variable que se utiliza para asignar el id del detalle
								var strDetalleID = strTipoReferencia+'_'+intReferenciaID+'_'+intRenglonReferencia;


								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', strDetalleID);
								objCeldaFolio.setAttribute('class', 'movil c1');
								objCeldaFolio.innerHTML = data.detalles[intCon].folio;
								objCeldaFolioDetalle.setAttribute('class', 'movil c2');
								objCeldaFolioDetalle.innerHTML = data.detalles[intCon].folio_detalle;
								objCeldaRazonSocial.setAttribute('class', 'movil c3');
								objCeldaRazonSocial.innerHTML = data.detalles[intCon].razon_social;
								objCeldaFecha.setAttribute('class', 'movil c4');
								objCeldaFecha.innerHTML = data.detalles[intCon].fecha;
								objCeldaFormaPago.setAttribute('class', 'movil c5');
								objCeldaFormaPago.innerHTML = data.detalles[intCon].forma_pago;
								objCeldaTipoReferencia.setAttribute('class', 'movil c6');
								objCeldaTipoReferencia.innerHTML = strTipoReferencia;
								objCeldaImporte.setAttribute('class', 'movil c7');
								objCeldaImporte.innerHTML = formatMoney(data.detalles[intCon].importe, 2, '');;
								objCeldaAcciones.setAttribute('class', 'td-center movil c8');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
								objCeldaReferenciaID.innerHTML = intReferenciaID;
								objCeldaRenglonReferencia.setAttribute('class', 'no-mostrar');
								objCeldaRenglonReferencia.innerHTML = intRenglonReferencia;
								objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
								objCeldaTipoCambio.innerHTML = data.detalles[intCon].tipo_cambio;

				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_traspasos_caja_bancos_caja();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_traspasos_caja_bancos_caja tr").length - 2;
							$('#numElementos_detalles_traspasos_caja_bancos_caja').html(intFilas);
							$('#txtNumDetalles_traspasos_caja_bancos_caja').val(intFilas);


							//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objTraspasosCajaBancosCaja = $('#TraspasosCajaBancosCajaBox').bPopup({
													  appendTo: '#TraspasosCajaBancosCajaContent', 
						                              contentContainer: 'TraspasosCajaBancosCajaM', 
						                              zIndex: 2, 
						                              modalClose: false, 
						                              modal: true, 
						                              follow: [true,false], 
						                              followEasing : "linear", 
						                              easing: "linear", 
						                              modalColor: ('#F0F0F0')});
					        }
				             //Enfocar caja de texto
							$('#txtCuentaBancaria_traspasos_caja_bancos_caja').focus();
			       	    }
			       },
			       'json');
		}


		
		
		//Función para generar póliza con los datos de un registro
		function generar_poliza_traspasos_caja_bancos_caja(id, formulario)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
            var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtTraspasoCajaBancoID_traspasos_caja_bancos_caja').val();
			}
			else
			{
				intID = id;
				strTipo = 'gridview';
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_traspasos_caja_bancos_caja(formulario);
			//Hacer un llamado al método del controlador para generar póliza del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaTraspasosCajaBancosCaja, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_traspasos_caja_bancos_caja').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	            ocultar_circulo_carga_traspasos_caja_bancos_caja(formulario);

		     	//Si existe resultado
				if (data.resultado)
				{
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_traspasos_caja_bancos_caja();
					
					//Si el id del registro se obtuvo del modal
					if(strTipo == 'modal')
					{
						//Hacer un llamado a la función para cerrar modal
						cerrar_traspasos_caja_bancos_caja();     
					}
				}

				
		      	//Si se cumple la sentencia
				if(strTipo == 'modal' && data.tipo_mensaje == 'error')
				{
					//Indicar al usuario el mensaje de error
	                new $.Zebra_Dialog(data.mensaje, {
	                                    'type': 'error',
	                                    'title': 'Error',
	                                    'buttons': [{caption: 'Aceptar',
	                                                 callback: function () {
	                                                   //Hacer un llamado a la función para cerrar modal
			            								cerrar_traspasos_caja_bancos_caja();
	                                                 }
	                                                }]
	                                  });
				}
				else
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    	mensaje_traspasos_caja_bancos_caja(data.tipo_mensaje, data.mensaje);
				}

		     },
		     'json');
		}


		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de generar pólizas
		function mostrar_circulo_carga_traspasos_caja_bancos_caja(formulario)
		{

			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_traspasos_caja_bancos_caja';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_traspasos_caja_bancos_caja';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de generar pólizas
		function ocultar_circulo_carga_traspasos_caja_bancos_caja(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_traspasos_caja_bancos_caja';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_traspasos_caja_bancos_caja';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}

		//Función para regresar obtener los datos de una cuenta bancaria
		function get_datos_cuenta_bancaria_traspasos_caja_bancos_caja()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
            $.post('cuentas_pagar/cuentas_bancarias/get_datos',
                  { 
                  	strBusqueda:$('#txtCuentaBancariaID_traspasos_caja_bancos_caja').val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){	
                    	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
						inicializar_detalles_traspasos_caja_bancos_caja();                    	
                        //Asignar datos del registro seleccionado
                        $("#txtMonedaID_traspasos_caja_bancos_caja").val(data.row.moneda_id);
                        $("#txtMoneda_traspasos_caja_bancos_caja").val(data.row.moneda);
                        //Habilitar botón Buscar ingresos
						$('#btnBuscarIngresos_traspasos_caja_bancos_caja').removeAttr('disabled');
                    }
                  }
                 ,
                'json');
		}



		//Función que se utiliza para calcular la diferencia entre el monto a depositar y el monto de los comprobantes (total de ingresos)
		function calcular_diferencia_traspasos_caja_bancos_caja()
		{
			//Variable que se utiliza para asignar diferencia
			var intDiferencia = 0;
			//Variable que se utiliza para asignar el monto a depositar
			var intImporte =  $.reemplazar($('#txtImporte_traspasos_caja_bancos_caja').val(), ",", "");
			//Variable que se utiliza para asignar el acumulado de los ingresos (monto de los comprobantes)
			//Hacer un llamado a la función para reemplazar '$' por cadena vacia
			var intAcumPagoDetalles = $.reemplazar($('#acumPago_detalles_traspasos_caja_bancos_caja').html(), "$", "");
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intAcumPagoDetalles = $.reemplazar(intAcumPagoDetalles, ",", "");
			
		    //Si no existe monto a depositar
			if(intImporte == '')
			{	
				//Inicializar variable
				intImporte = 0;
			}

			//Si no existe monto de los comprobantes
			if(intAcumPagoDetalles == '')
			{
				//Inicializar variable
				intAcumPagoDetalles = 0;
			}

			//Convertir cadena de texto a número decimal
			intImporte = parseFloat(intImporte);
			intAcumPagoDetalles = parseFloat(intAcumPagoDetalles);

			//Calcular diferencia
			intDiferencia = intImporte - intAcumPagoDetalles;

			//Convertir cantidad a formato moneda
			intDiferencia =  formatMoney(intDiferencia, 2, '');

			//Asignar diferencia
			$('#txtDiferencia_traspasos_caja_bancos_caja').val(intDiferencia);
		}
		
		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_ingresos_relacionados_traspasos_caja_bancos_caja(tipoAccion)
		{	
			//Mostramos los ingresos relacionados (facturas, anticipos y/o pagos seleccionados)
			for (var intCon in objIngresosRelacionadosTraspasosCajaBancosCaja.getIngresos()) 
            {
            	//Crear instancia del objeto Ingresos a depositar 
            	objIngresoRelacionarTraspasosCajaBancosCaja = new IngresoRelacionarTraspasosCajaBancosCaja();
            	//Asignar datos del ingreso corespondiente al indice
            	objIngresoRelacionarTraspasosCajaBancosCaja = objIngresosRelacionadosTraspasosCajaBancosCaja.getIngreso(intCon);
            	
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_detalles_traspasos_caja_bancos_caja').getElementsByTagName('tbody')[0];					
				//Variable que se utiliza para asignar el id del detalle
				var strDetalleID =  objIngresoRelacionarTraspasosCajaBancosCaja.strTipoReferencia+'_'+objIngresoRelacionarTraspasosCajaBancosCaja.intReferenciaID+'_'+objIngresoRelacionarTraspasosCajaBancosCaja.intRenglonReferencia;

				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
				if (!objTabla.rows.namedItem(strDetalleID))
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaFolio = objRenglon.insertCell(0);
					var objCeldaFolioDetalle = objRenglon.insertCell(1);
					var objCeldaRazonSocial = objRenglon.insertCell(2);
					var objCeldaFecha = objRenglon.insertCell(3);
					var objCeldaFormaPago = objRenglon.insertCell(4);
					var objCeldaTipoReferencia = objRenglon.insertCell(5);
					var objCeldaImporte = objRenglon.insertCell(6);
					var objCeldaAcciones = objRenglon.insertCell(7);
					//Columnas ocultas
					var objCeldaReferenciaID = objRenglon.insertCell(8);
					var objCeldaRenglonReferencia = objRenglon.insertCell(9);
					var objCeldaTipoCambio = objRenglon.insertCell(10);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strDetalleID);
					objCeldaFolio.setAttribute('class', 'movil c1');
					objCeldaFolio.innerHTML = objIngresoRelacionarTraspasosCajaBancosCaja.strFolio;
					objCeldaFolioDetalle.setAttribute('class', 'movil c2');
					objCeldaFolioDetalle.innerHTML = objIngresoRelacionarTraspasosCajaBancosCaja.strFolioDetalle;
					objCeldaRazonSocial.setAttribute('class', 'movil c3');
					objCeldaRazonSocial.innerHTML = objIngresoRelacionarTraspasosCajaBancosCaja.strRazonSocial;
					objCeldaFecha.setAttribute('class', 'movil c4');
					objCeldaFecha.innerHTML = objIngresoRelacionarTraspasosCajaBancosCaja.dteFecha;
					objCeldaFormaPago.setAttribute('class', 'movil c5');
					objCeldaFormaPago.innerHTML = objIngresoRelacionarTraspasosCajaBancosCaja.strFormaPago;
					objCeldaTipoReferencia.setAttribute('class', 'movil c6');
					objCeldaTipoReferencia.innerHTML =  objIngresoRelacionarTraspasosCajaBancosCaja.strTipoReferencia;
					objCeldaImporte.setAttribute('class', 'movil c7');
					objCeldaImporte.innerHTML = objIngresoRelacionarTraspasosCajaBancosCaja.intImporte;
					objCeldaAcciones.setAttribute('class', 'td-center movil c8');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Eliminar'" +
								   " onclick='eliminar_renglon_detalles_traspasos_caja_bancos_caja(this)'>" + 
								   "<span class='glyphicon glyphicon-trash'></span></button>" + 
								   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
								   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
								   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
								   "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
					objCeldaReferenciaID.innerHTML = objIngresoRelacionarTraspasosCajaBancosCaja.intReferenciaID;
					objCeldaRenglonReferencia.setAttribute('class', 'no-mostrar');
					objCeldaRenglonReferencia.innerHTML = objIngresoRelacionarTraspasosCajaBancosCaja.intRenglonReferencia;
					objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
					objCeldaTipoCambio.innerHTML = objIngresoRelacionarTraspasosCajaBancosCaja.intTipoCambio;

				}
		
            }

            //Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_traspasos_caja_bancos_caja();

            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_traspasos_caja_bancos_caja tr").length - 2;
			$('#numElementos_detalles_traspasos_caja_bancos_caja').html(intFilas);
			$('#txtNumDetalles_traspasos_caja_bancos_caja').val(intFilas);
		}

		
		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_traspasos_caja_bancos_caja(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_traspasos_caja_bancos_caja").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_traspasos_caja_bancos_caja();

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_traspasos_caja_bancos_caja tr").length - 2;
			$('#numElementos_detalles_traspasos_caja_bancos_caja').html(intFilas);
			$('#txtNumDetalles_traspasos_caja_bancos_caja').val(intFilas);
		}


		//Función para calcular totales de la tabla
		function calcular_totales_detalles_traspasos_caja_bancos_caja()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_traspasos_caja_bancos_caja').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumPago = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intImporte = parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				

				//Incrementar acumulado
    			intAcumPago += intImporte;
			}

			//Convertir cantidad a formato moneda
			intAcumPago =  '$'+formatMoney(intAcumPago, 2, '');

			//Asignar los valores
			$('#acumPago_detalles_traspasos_caja_bancos_caja').html(intAcumPago);

			//Hacer un llamado a la función para calcular la diferencia entre el monto a depositar y el monto de los comprobantes (ingresos)
			calcular_diferencia_traspasos_caja_bancos_caja();
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Traspaso de Caja a Bancos
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_traspasos_caja_bancos_caja').datetimepicker({format: 'DD/MM/YYYY'});
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporte_traspasos_caja_bancos_caja').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_traspasos_caja_bancos_caja').blur(function(){
				$('.moneda_traspasos_caja_bancos_caja').formatCurrency({ roundToDecimalPlace: 2 });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_traspasos_caja_bancos_caja').blur(function(){
                $('.tipo-cambio_traspasos_caja_bancos_caja').formatCurrency({ roundToDecimalPlace: 4 });
            });

		    //Autocomplete para recuperar los datos de una cuenta bancaria 
	        $('#txtCuentaBancaria_traspasos_caja_bancos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaBancariaID_traspasos_caja_bancos_caja').val('');
	               //Hacer un llamado a la función para inicializar elementos de la cuenta bancaria
	               inicializar_cuenta_bancaria_traspasos_caja_bancos_caja();
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
	             $('#txtCuentaBancariaID_traspasos_caja_bancos_caja').val(ui.item.data);
	             //Hacer un llamado a la función para regresar los datos de la cuenta bancaria
	             get_datos_cuenta_bancaria_traspasos_caja_bancos_caja();
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
	        $('#txtCuentaBancaria_traspasos_caja_bancos_caja').focusout(function(e){
	            //Si no existe id de la cuenta bancaria
	            if($('#txtCuentaBancariaID_traspasos_caja_bancos_caja').val() == '' ||
	               $('#txtCuentaBancaria_traspasos_caja_bancos_caja').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtCuentaBancariaID_traspasos_caja_bancos_caja').val('');
	                $('#txtCuentaBancaria_traspasos_caja_bancos_caja').val('');
	                //Hacer un llamado a la función para inicializar elementos de la cuenta bancaria
	                inicializar_cuenta_bancaria_traspasos_caja_bancos_caja();
	            }
	            
	        });

        	//Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleado_traspasos_caja_bancos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEmpleadoID_traspasos_caja_bancos_caja').val('');
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
	             $('#txtEmpleadoID_traspasos_caja_bancos_caja').val(ui.item.data);
	           
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
	        $('#txtEmpleado_traspasos_caja_bancos_caja').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoID_traspasos_caja_bancos_caja').val() == '' ||
	               $('#txtEmpleado_traspasos_caja_bancos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoID_traspasos_caja_bancos_caja').val('');
	               $('#txtEmpleado_traspasos_caja_bancos_caja').val('');
	            }
	        });

	        //Calcular la diferencia de importes cuando pierda el enfoque la caja de texto
			$('#txtImporte_traspasos_caja_bancos_caja').focusout(function(e){
				//Hacer un llamado a la función para calcular la diferencia entre el monto a depositar y el monto de los comprobantes (ingresos)
				calcular_diferencia_traspasos_caja_bancos_caja();
			});

       		
			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_traspasos_caja_bancos_caja').on('click','button.btn',function(){
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

			
			//Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });
		    


			/*******************************************************************************************************************
			Controles correspondientes al modal Ingresos a Depositar
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_relacionar_ingresos_traspasos_caja_bancos_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_relacionar_ingresos_traspasos_caja_bancos_caja').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_relacionar_ingresos_traspasos_caja_bancos_caja').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_relacionar_ingresos_traspasos_caja_bancos_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_relacionar_ingresos_traspasos_caja_bancos_caja').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_relacionar_ingresos_traspasos_caja_bancos_caja').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_relacionar_ingresos_traspasos_caja_bancos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_relacionar_ingresos_traspasos_caja_bancos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete",
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
	             $('#txtProspectoIDBusq_relacionar_ingresos_traspasos_caja_bancos_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del cliente cuando pierda el enfoque la caja de texto
	        $('#txtRazonSocialBusq_relacionar_ingresos_traspasos_caja_bancos_caja').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_relacionar_ingresos_traspasos_caja_bancos_caja').val() == '' ||
	            	$('#txtRazonSocialBusq_relacionar_ingresos_traspasos_caja_bancos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_relacionar_ingresos_traspasos_caja_bancos_caja').val('');
	               $('#txtRazonSocialBusq_relacionar_ingresos_traspasos_caja_bancos_caja').val('');
	            }
	            
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_traspasos_caja_bancos_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_traspasos_caja_bancos_caja').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_traspasos_caja_bancos_caja').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_traspasos_caja_bancos_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_traspasos_caja_bancos_caja').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_traspasos_caja_bancos_caja').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleadoBusq_traspasos_caja_bancos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEmpleadoIDBusq_traspasos_caja_bancos_caja').val('');
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
	             $('#txtEmpleadoIDBusq_traspasos_caja_bancos_caja').val(ui.item.data);
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
	        $('#txtEmpleadoBusq_traspasos_caja_bancos_caja').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoIDBusq_traspasos_caja_bancos_caja').val() == '' ||
	            	$('#txtEmpleadoBusq_traspasos_caja_bancos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoIDBusq_traspasos_caja_bancos_caja').val('');
	               $('#txtEmpleadoBusq_traspasos_caja_bancos_caja').val('');
	            }
	            
	        });

			//Paginación de registros
			$('#pagLinks_traspasos_caja_bancos_caja').on('click','a',function(event){
				event.preventDefault();
				intPaginaTraspasosCajaBancosCaja = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_traspasos_caja_bancos_caja();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_traspasos_caja_bancos_caja').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_traspasos_caja_bancos_caja();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_traspasos_caja_bancos_caja').addClass("estatus-NUEVO");
				//Abrir modal
				objTraspasosCajaBancosCaja = $('#TraspasosCajaBancosCajaBox').bPopup({
									   appendTo: '#TraspasosCajaBancosCajaContent', 
		                               contentContainer: 'TraspasosCajaBancosCajaM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCuentaBancaria_traspasos_caja_bancos_caja').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_traspasos_caja_bancos_caja').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_traspasos_caja_bancos_caja();
		});
	</script>