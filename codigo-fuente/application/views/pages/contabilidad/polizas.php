	<div id="PolizasContabilidadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_polizas_contabilidad" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_polizas_contabilidad" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_polizas_contabilidad">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_polizas_contabilidad'>
				                    <input class="form-control" id="txtFechaInicialBusq_polizas_contabilidad"
				                    		name= "strFechaInicialBusq_polizas_contabilidad" 
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
								<label for="txtFechaFinalBusq_polizas_contabilidad">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_polizas_contabilidad'>
				                    <input class="form-control" id="txtFechaFinalBusq_polizas_contabilidad"
				                    		name= "strFechaFinalBusq_polizas_contabilidad" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
				    <!--Descripción-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_polizas_contabilidad">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_polizas_contabilidad" 
										name="strBusqueda_polizas_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_polizas_contabilidad">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_polizas_contabilidad" 
								 		name="strEstatusBusq_polizas_contabilidad" tabindex="1">
								    <option value="TODOS">TODOS</option>
								    <option value="ACTIVO">ACTIVO</option>
                      				<option value="NO APLICADA">NO APLICADA</option>
                      				<option value="INACTIVO">INACTIVO</option>
                 				</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Módulo-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbModuloBusq_polizas_contabilidad">Módulo</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbModuloBusq_polizas_contabilidad" 
								 		name="strModuloBusq_polizas_contabilidad" tabindex="1">
								    <option value="TODOS">TODOS</option>
								    <option value="MAQUINARIA">MAQUINARIA</option>
                      				<option value="REFACCIONES">REFACCIONES</option>
                      				<option value="SERVICIO">SERVICIO</option>
                      				<option value="CONTABILIDAD">CONTABILIDAD</option>
                      				<option value="CAJA">CAJA</option>
                      				<option value="CUENTAS POR COBRAR">CUENTAS POR COBRAR</option>
                      				<option value="CUENTAS POR PAGAR">CUENTAS POR PAGAR</option>
                      				<option value="CONTROL DE VEHICULOS">CONTROL DE VEHICULOS</option>
                      				<option value="AUDITORIA">AUDITORIA</option>
                      				<option value="MERCADOTECNIA">MERCADOTECNIA</option>
                 				</select>
							</div>
						</div>
					</div>
					<!--Proceso-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbProcesoBusq_polizas_contabilidad">Proceso</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbProcesoBusq_polizas_contabilidad" 
								 		name="strProcesoBusq_polizas_contabilidad" tabindex="1">
								    <option value="TODOS">TODOS</option>
								    <option value="POLIZA">POLIZA</option>
								    <option value="FACTURACION">FACTURACIÓN</option>
                      				<option value="ENTRADA POR COMPRA">ENTRADA POR COMPRA</option>
                      				<option value="ENTRADA POR DEVOLUCION DE CLIENTE">ENTRADA POR DEVOLUCIÓN DE CLIENTE</option>
                      				<option value="ENTRADA POR DEVOLUCION DE TALLER">ENTRADA POR DEVOLUCIÓN DE TALLER</option>
                      				<option value="ENTRADA POR TRASPASO">ENTRADA POR TRASPASO</option>
                      				<option value="ENTRADA POR TRASPASO ALMACEN GENERAL">ENTRADA POR TRASPASO ALMACÉN GENERAL</option>
                      				<option value="ENTRADA POR AJUSTE">ENTRADA POR AJUSTE</option>
                      				<option value="SALIDA POR TALLER">SALIDA POR TALLER</option>
                      				<option value="SALIDA POR CONSUMO INTERNO">SALIDA POR CONSUMO INTERNO</option>
                      				<option value="SALIDA POR TRASPASO">SALIDA POR TRASPASO</option>
                      				<option value="SALIDA POR DEVOLUCION AL PROVEEDOR">SALIDA POR DEVOLUCIÓN AL PROVEEDOR</option>
                      				<option value="SALIDA POR AJUSTE">SALIDA POR AJUSTE</option>
                      				<option value="TRABAJO FORANEO">TRABAJO FORÁNEO</option>
                      				<option value="ORDEN DE TRABAJO">ORDEN DE TRABAJO</option>
                      				<option value="ANTICIPO">ANTICIPO</option>
                      				<option value="RECIBO INTERNO ANTICIPO">RECIBO INTERNO ANTICIPO</option>
                      				<option value="RECIBO INGRESO">RECIBO INGRESO</option>
                      				<option value="RECEPCION PAGO">RECEPCIÓN PAGO</option>
                      				<option value="TRASPASO BANCOS">TRASPASO BANCOS</option>
                      				<option value="NOTA CREDITO">NOTA CRÉDITO</option>
                      				<option value="NOTA CREDITO SERVICIO">NOTA CRÉDITO SERVICIO</option>
                      				<option value="NOTA CARGO">NOTA CARGO</option>
                      				<option value="NOTA CARGO DIGITAL">NOTA CARGO DIGITAL</option>
                      				<option value="POLIZA ABONO">PÓLIZA DE ABONO</option>
                      				
                 				</select>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-6 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_polizas_contabilidad" 
									   name="strImprimirDetalles_polizas_contabilidad" type="checkbox"
									   value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-6">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_polizas_contabilidad"
									onclick="paginacion_polizas_contabilidad();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_polizas_contabilidad" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_polizas_contabilidad"
									onclick="reporte_polizas_contabilidad('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_polizas_contabilidad"
									onclick="reporte_polizas_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla pólizas
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Tipo"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Concepto"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Importe"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles de la póliza
				*/
				td.movil.b1:nth-of-type(1):before {content: "Cuenta"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Cargo"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Abono"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la póliza
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: "Cargo"; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Abono"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_polizas_contabilidad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Tipo</th>
							<th class="movil">Concepto</th>
							<th class="movil">Importe</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:17em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_polizas_contabilidad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{tipo}}</td>
							<td class="movil a4">{{concepto}}</td>
							<td class="movil a5">{{total_cargos}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_polizas_contabilidad({{poliza_id}});"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_polizas_contabilidad({{poliza_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_polizas_contabilidad({{poliza_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
                            	<!--Descargar archivos-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_polizas_contabilidad({{poliza_id}}, '{{folio}}');" title="Descargar archivos">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_polizas_contabilidad({{poliza_id}},'{{estatus}}', '{{total_cargos}}', '{{total_abonos}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_polizas_contabilidad({{poliza_id}},'{{estatus}}', '{{total_cargos}}', '{{total_abonos}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_polizas_contabilidad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_polizas_contabilidad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Pólizas-->
		<div id="PolizasContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_polizas_contabilidad"  class="ModalBodyTitle">
			<h1>Pólizas</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmPolizasContabilidad" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmPolizasContabilidad"  onsubmit="return(false)" 
					  autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtPolizaID_polizas_contabilidad" 
										   name="intPolizaID_polizas_contabilidad" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
									<input id="txtEstatus_polizas_contabilidad" 
										  name="strEstatus_polizas_contabilidad" type="hidden" value="">
									</input>
									<label for="txtFolio_polizas_contabilidad">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_polizas_contabilidad" 
											name="strFolio_polizas_contabilidad" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_polizas_contabilidad">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_polizas_contabilidad'>
					                    <input class="form-control" id="txtFecha_polizas_contabilidad"
					                    		name= "strFecha_polizas_contabilidad" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Tipo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipo_polizas_contabilidad">Tipo de póliza</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipo_polizas_contabilidad" 
									 		name="strTipo_polizas_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="DIARIO">DIARIO</option>
                          				<option value="INGRESO">INGRESO</option>
                          				<option value="EGRESO">EGRESO</option>
                     				</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Módulo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtModulo_polizas_contabilidad">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModulo_polizas_contabilidad" 
											name="strModulo_polizas_contabilidad" type="text" 
											value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Proceso-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtProceso_polizas_contabilidad">Proceso</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProceso_polizas_contabilidad" 
											name="strProceso_polizas_contabilidad" type="text" 
											value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Folio de la referencia-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la referencia (factura)-->
									<input id="txtReferenciaID_polizas_contabilidad" 
										   name="intReferenciaID_polizas_contabilidad" type="hidden" value="">
									</input>
									<label for="txtReferencia_polizas_contabilidad">Referencia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtReferencia_polizas_contabilidad" 
											name="strReferencia_polizas_contabilidad" type="text" 
											value="" disabled>
									</input>
								</div>
							</div>
						</div>
					</div>
				    <div class="row">
				    	<!--Concepto-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtConcepto_polizas_contabilidad">Concepto</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtConcepto_polizas_contabilidad" 
											name="strConcepto_polizas_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese concepto" maxlength="250">
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
									<label for="txtObservaciones_polizas_contabilidad">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_polizas_contabilidad" 
											name="strObservaciones_polizas_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
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
										<input id="txtNumDetalles_polizas_contabilidad" 
											   name="intNumDetalles_polizas_contabilidad" type="hidden" value="">
										</input>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la póliza</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene las cuentas activas-->
													<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
																<input id="txtRenglon_detalles_polizas_contabilidad" 
																	   name="intRenglon_detalles_polizas_contabilidad" type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para asignar el id del objeto (input) tipo file-->
																<input id="txtIDCampoArchivo_detalles_polizas_contabilidad" 
																	   name="strIDCampoArchivo_detalles_polizas_contabilidad" type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para para asignar el id del área (spam) del objeto (input) tipo file-->
																<input id="txtIDCampoArea_detalles_polizas_contabilidad" 
																	   name="strIDCampoArea_detalles_polizas_contabilidad" type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para la descripción de los archivos de un registro existente-->
																<input id="txtArchivoExistente_detalles_polizas_contabilidad" 
																	   name="strArchivoExistente_detalles_polizas_contabilidad" type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón anterior-->
																<input id="txtRenglonAnterior_detalles_polizas_contabilidad" 
																	   name="intRenglonAnterior_detalles_polizas_contabilidad" type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para asignar el tipo de registro 
																	 (Nuevo/Existente en la base de datos) de esta manera se identificara el renglón-->
																<input id="txtTipoRenglon_detalles_polizas_contabilidad" 
																	   name="strTipoRenglon_detalles_polizas_contabilidad" type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta seleccionada-->
																<input id="txtCuentaID_detalles_polizas_contabilidad" 
																	   name="intCuentaID_detalles_polizas_contabilidad"  
																	   type="hidden" value="">
																</input>
																<label for="txtCuenta_detalles_polizas_contabilidad">
																	Cuenta
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtCuenta_detalles_polizas_contabilidad" 
																		name="strCuenta_detalles_polizas_contabilidad" type="text" value="" 
																		tabindex="1" placeholder="Ingrese cuenta" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Importe-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtImporte_detalles_polizas_contabilidad">Importe</label>
															</div>
															<div class="col-md-12">
																<div class='input-group'>
																	<span class="input-group-addon">$</span>
																	<input  class="form-control moneda_polizas_contabilidad" id="txtImporte_detalles_polizas_contabilidad" 
																			name="intImporte_detalles_polizas_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23">
																	</input>
																</div>
															</div>
														</div>
													</div>
													<!--Naturaleza-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbNaturaleza_detalles_polizas_contabilidad">Naturaleza</label>
															</div>
															<div class="col-md-12">
																<select class="form-control" id="cmbNaturaleza_detalles_polizas_contabilidad" 
																 		name="strNaturaleza_detalles_polizas_contabilidad" tabindex="1">
																 	<option value="">Seleccione una opción</option>
								                      				<option value="CARGO">CARGO</option>
								                      				<option value="ABONO">ABONO</option>
								                 				</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Referencia-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtReferencia_detalles_polizas_contabilidad">
																	Referencia
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtReferencia_detalles_polizas_contabilidad" 
																		name="strReferencia_detalles_polizas_contabilidad" type="text" value="" 
																		tabindex="1" placeholder="Ingrese referencia" maxlength="250">
																</input>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Concepto-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtConcepto_detalles_polizas_contabilidad">
																	Concepto
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtConcepto_detalles_polizas_contabilidad" 
																		name="strConcepto_detalles_polizas_contabilidad" type="text" value="" 
																		tabindex="1" placeholder="Ingrese concepto" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Botones-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="btn-group pull-right">
															<!--Agregar detalle en la tabla-->
															<button class="btn btn-primary" 
							                                			id="btnAgregar_detalles_polizas_contabilidad" 
							                                			onclick="agregar_renglon_detalles_polizas_contabilidad();" 
							                                	     	title="Agregar" tabindex="1"> 
							                                		<span class="glyphicon glyphicon-plus"></span>
							                                </button>
										                    <!--Subir archivos-->
									                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_polizas_contabilidad">
									                        	<span class="fa fa-upload"></span>
									                        	<span id='archivos_area_detalles_polizas_contabilidad'>
										                        	<input id="archivo_varios_detalles_polizas_contabilidad" 
										                        		   name="archivo_varios_detalles_polizas_contabilidad[]" type="file" multiple
										                        		   accept="text/xml,application/pdf" onchange="verificar_extension_archivos_detalles_polizas_contabilidad(this);">
										                        	</input>
										                        </span>
									                        </span>
										                     <!--Descargar archivo-->
										                    <button class="btn btn-default" id="btnDescargarArchivo_detalles_polizas_contabilidad"  
																	onclick="descargar_archivos_detalles_polizas_contabilidad('');"  title="Descargar archivo" tabindex="1">
																<span class="glyphicon glyphicon-download-alt"></span>
															</button>
															<!--Eliminar archivo-->
															<button class="btn btn-default" id="btnEliminarArchivo_detalles_polizas_contabilidad"  
																	onclick="eliminar_archivo_detalles_polizas_contabilidad('', '')"  title="Eliminar archivo" tabindex="1"> 
																<span class="glyphicon glyphicon-export"></span>
															</button>
														</div>
													</div>
												</div>
												<br>
											</div>
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row ">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_polizas_contabilidad">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Cuenta</th>
																<th class="movil">Cargo</th>
																<th class="movil">Abono</th>
																<th class="movil" id="th-acciones" style="width:16em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
														<tfoot class="movil">
															<tr class="movil">
																<td class="movil t1">
																	<strong>Total</strong>
																</td>
																<td class="movil t2">
																	<strong id="acumCargo_detalles_polizas_contabilidad">$0.00000</strong>
																</td>
																<td class="movil t3">
																	<strong id="acumAbono_detalles_polizas_contabilidad">$0.00000</strong>
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
																<strong id="numElementos_detalles_polizas_contabilidad">0</strong> encontrados
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
						<!--Total-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 pull-right">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_polizas_contabilidad">Importe total</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_polizas_contabilidad" id="txtImporteTotal_polizas_contabilidad" 
												name="intImporteTotal_polizas_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23">
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
							<button class="btn btn-success" id="btnGuardar_polizas_contabilidad"  
									onclick="validar_polizas_contabilidad();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_polizas_contabilidad"  
									onclick="reporte_registro_polizas_contabilidad('');"  title="Imprimir registro en PDF" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
		                     <!--Descargar archivos-->
		                    <button class="btn btn-default" id="btnDescargarArchivos_polizas_contabilidad"  
									onclick="descargar_archivos_polizas_contabilidad('', '');"  title="Descargar archivos" tabindex="4" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_polizas_contabilidad"  
									onclick="cambiar_estatus_polizas_contabilidad('','ACTIVO', '', '');"  title="Desactivar" tabindex="5" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_polizas_contabilidad"  
									onclick="cambiar_estatus_polizas_contabilidad('','INACTIVO', '', '');"  title="Restaurar" tabindex="6" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_polizas_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_polizas_contabilidad();" 
									title="Cerrar"  tabindex="7">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Pólizas-->

		<!-- Diseño del modal Diot del Detalle de Póliza-->
		<div id="DiotDetallePolizasContabilidadBox" class="ModalBody impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_diot_detalle_polizas_contabilidad"  class="ModalBodyTitle">
			<h1>Asociar Movimiento a Proveedor</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmDiotDetallePolizasContabilidad" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmDiotDetallePolizasContabilidad" onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Cuenta-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el renglón del detalle seleccionado-->
									<input class="form-control" id="txtRenglonDetalle_diot_detalle_polizas_contabilidad"
											   name="intRenglonDetalle_diot_detalle_polizas_contabilidad" type="hidden">
									</input>
									<label for="txtCuenta_diot_detalle_polizas_contabilidad">Cuenta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuenta_diot_detalle_polizas_contabilidad" 
											name="strCuenta_diot_detalle_polizas_contabilidad" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
					    <!--Serie-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSerie_diot_detalle_polizas_contabilidad">Serie</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSerie_diot_detalle_polizas_contabilidad" 
											name="strSerie_diot_detalle_polizas_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese serie" maxlength="25">
									</input>
								</div>
							</div>
						</div>
						<!--Folio-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFolio_diot_detalle_polizas_contabilidad">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_diot_detalle_polizas_contabilidad" 
										    name="strFolio_diot_detalle_polizas_contabilidad" type="text" value="" 
										    tabindex="1" placeholder="Ingrese folio" maxlength="25">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Referencia-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtReferencia_diot_detalle_polizas_contabilidad">Referencia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtReferencia_diot_detalle_polizas_contabilidad" 
										    name="strReferencia_diot_detalle_polizas_contabilidad" type="text" value="" 
										    tabindex="1" placeholder="Ingrese referencia" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene los proveedores activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
									<input id="txtProveedorID_diot_detalle_polizas_contabilidad" 
										   name="intProveedorID_diot_detalle_polizas_contabilidad"  type="hidden" 
										   value="">
									</input>
									<label for="txtProveedor_diot_detalle_polizas_contabilidad">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_diot_detalle_polizas_contabilidad" 
											name="strProveedor_diot_detalle_polizas_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Importe-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporte_diot_detalle_polizas_contabilidad">Importe</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
									<span class="input-group-addon">$</span>
										<input  class="form-control" id="txtImporte_diot_detalle_polizas_contabilidad" 
										    name="intImporte_diot_detalle_polizas_contabilidad" type="text" value="" 
										    disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
									<input  class="form-control" id="txtTasaCuotaIva_diot_detalle_polizas_contabilidad" 
										    name="intTasaCuotaIva_diot_detalle_polizas_contabilidad" type="hidden" value="" >
									</input>
									<label for="txtPorcentajeIva_diot_detalle_polizas_contabilidad">IVA %</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPorcentajeIva_diot_detalle_polizas_contabilidad" 
										    name="intPorcentajeIva_diot_detalle_polizas_contabilidad" type="text" value="" 
										    tabindex="1" placeholder="Ingrese IVA" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Importe base-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteBase_diot_detalle_polizas_contabilidad">Importe base</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
									<span class="input-group-addon">$</span>
										<input  class="form-control" id="txtImporteBase_diot_detalle_polizas_contabilidad" 
										    name="intImporteBase_diot_detalle_polizas_contabilidad" type="text" value="" 
										    disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Importe IVA-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteIva_diot_detalle_polizas_contabilidad">Importe IVA</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
									<span class="input-group-addon">$</span>
										<input  class="form-control" id="txtImporteIva_diot_detalle_polizas_contabilidad" 
										    name="intImporteIva_diot_detalle_polizas_contabilidad" type="text" value="" 
										    disabled>
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
							<button class="btn btn-success" id="btnGuardar_diot_detalle_polizas_contabilidad"
									onclick="validar_diot_detalle_polizas_contabilidad();"  title="Guardar" tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_diot_detalle_polizas_contabilidad"
							        type="reset" aria-hidden="true" onclick="cerrar_diot_detalle_polizas_contabilidad();" 
							        title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Diot del Detalle de Póliza-->
	</div><!--#PolizasContabilidadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaPolizasContabilidad = 0;
		var strUltimaBusquedaPolizasContabilidad = "";
		//Variable que se utiliza para asignar el id de la cuenta base
		var intCuentaBaseIDPolizasContabilidad = <?php echo CUENTA_BASE ?>;
		//Variable que se utiliza para asignar objeto del modal Pólizas
		var objPolizasContabilidad = null;
		//Variable que se utiliza para asignar objeto del modal Diot del Detalle de Póliza
		var objDiotDetallePolizasContabilidad = null;

		/*******************************************************************************************************************
		Funciones del objeto Detalles de la póliza
		*********************************************************************************************************************/
		// Constructor del objeto detalles
		var objDetallesPolizaPolizasContabilidad;
		function DetallesPolizaPolizasContabilidad(detalles)
		{
			this.arrDetalles = detalles;
		}

		//Función para obtener todos los detalles de la póliza
		DetallesPolizaPolizasContabilidad.prototype.getDetalles = function() {
		    return this.arrDetalles;
		}

		//Función para agregar una detalle al objeto 
		DetallesPolizaPolizasContabilidad.prototype.setDetalle = function (detalle){
			this.arrDetalles.push(detalle);
		}

		//Función para obtener un detalle del objeto
		DetallesPolizaPolizasContabilidad.prototype.getDetalle = function(index) {
		    return this.arrDetalles[index];
		}

		//Función para modificar un detalle del objeto
		DetallesPolizaPolizasContabilidad.prototype.modificarDetalle = function (index, detalle){
			this.arrDetalles[index] = detalle;
		}

		//Función para eliminar un detalle del objeto
		DetallesPolizaPolizasContabilidad.prototype.eliminarDetalle = function (index){
			if(index != -1) 
			{
				this.arrDetalles.splice(index, 1);
			}
		}

		//Función para cambiar las posiciones de los detalles en el objeto
		DetallesPolizaPolizasContabilidad.prototype.swap = function(index_A, index_B) {
		    var input = this.arrDetalles;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		/*******************************************************************************************************************
		Funciones del objeto Detalle de la póliza
		*********************************************************************************************************************/
		//Constructor del objeto detalle
		var objDetallePolizaPolizasContabilidad;
		function DetallePolizaPolizasContabilidad(cuentaID, cuenta, importe, naturaleza, referencia, concepto, 
												  abono, cargo, archivoExistente, IDCampoArchivo, renglonAnterior,
												  tipoRenglon, IDCampoArea, detallesDiot)
		{
		    this.intCuentaID = cuentaID;
		    this.strCuenta = cuenta;
		    this.intImporte = importe;
		    this.strNaturaleza = naturaleza;
		    this.strReferencia = referencia;
		    this.strConcepto = concepto;
		    this.intAbono = abono;
		    this.intCargo = cargo;
		    this.strArchivoExistente = archivoExistente;
		    this.strIDCampoArchivo = IDCampoArchivo;
		    this.intRenglonAnterior = renglonAnterior;
		    this.strTipoRenglon = tipoRenglon;
		    this.strIDCampoArea = IDCampoArea;
		    this.arrDetallesDiot = detallesDiot;
		}

		//Función para agregar todos los detalles Diot del detalle
		DetallePolizaPolizasContabilidad.prototype.setDetallesDiot = function(diots) {
	    	
	    	this.arrDetallesDiot = diots;
		}

		//Función para eliminar todos los detalles Diot del detalle
		DetallePolizaPolizasContabilidad.prototype.eliminarDetallesDiot = function() {
			
			this.arrDetallesDiot = 0;
		}

		//Función para obtener un detalle Diot del objeto 
		DetallePolizaPolizasContabilidad.prototype.getDetalleDiot = function(index) {
		    return this.arrDetallesDiot[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto Diot  del detalle
		*********************************************************************************************************************/
		// Constructor del objeto detalle Diot
		var objDetalleDiotPolizasContabilidad;
		function DetalleDiotPolizasContabilidad(proveedorID, proveedor, serie, folio, referencia,  tasaCuotaIva, porcentajeIva,
											   importeBase, importeIva)
		{
		    this.intProveedorID= proveedorID;
		    this.strProveedor = proveedor;
		    this.strSerie = serie;
		    this.strFolio = folio;
		    this.strReferencia = referencia;
		    this.intTasaCuotaIva = tasaCuotaIva;
		    this.intPorcentajeIva = porcentajeIva;
		    this.intImporteBase = importeBase;
		    this.intImporteIva = importeIva;
		}


		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_polizas_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/polizas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_polizas_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosPolizasContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosPolizasContabilidad = strPermisosPolizasContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosPolizasContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosPolizasContabilidad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_polizas_contabilidad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosPolizasContabilidad[i]=='GUARDAR') || (arrPermisosPolizasContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_polizas_contabilidad').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosPolizasContabilidad[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivos_polizas_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosPolizasContabilidad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_polizas_contabilidad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_polizas_contabilidad();
						}
						else if(arrPermisosPolizasContabilidad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_polizas_contabilidad').removeAttr('disabled');
							$('#btnRestaurar_polizas_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosPolizasContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_polizas_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosPolizasContabilidad[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_polizas_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosPolizasContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_polizas_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_polizas_contabilidad() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaPolizasContabilidad =($('#txtFechaInicialBusq_polizas_contabilidad').val()+$('#txtFechaFinalBusq_polizas_contabilidad').val()+$('#cmbEstatusBusq_polizas_contabilidad').val()+$('#cmbModuloBusq_polizas_contabilidad').val()+$('#cmbProcesoBusq_polizas_contabilidad').val()+$('#txtBusqueda_polizas_contabilidad').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaPolizasContabilidad != strUltimaBusquedaPolizasContabilidad)
			{
				intPaginaPolizasContabilidad = 0;
				strUltimaBusquedaPolizasContabilidad = strNuevaBusquedaPolizasContabilidad;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('contabilidad/polizas/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_polizas_contabilidad').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_polizas_contabilidad').val()),
					 strEstatus: $('#cmbEstatusBusq_polizas_contabilidad').val(),
					 strModulo: $('#cmbModuloBusq_polizas_contabilidad').val(),
					 strProceso: $('#cmbProcesoBusq_polizas_contabilidad').val(),
					 strBusqueda: $('#txtBusqueda_polizas_contabilidad').val(),
					 intPagina: intPaginaPolizasContabilidad,
					 strPermisosAcceso: $('#txtAcciones_polizas_contabilidad').val()
					},
					function(data){
						$('#dg_polizas_contabilidad tbody').empty();
						var tmpPolizasContabilidad = Mustache.render($('#plantilla_polizas_contabilidad').html(),data);
						$('#dg_polizas_contabilidad tbody').html(tmpPolizasContabilidad);
						$('#pagLinks_polizas_contabilidad').html(data.paginacion);
						$('#numElementos_polizas_contabilidad').html(data.total_rows);
						intPaginaPolizasContabilidad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_polizas_contabilidad(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/polizas/';

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
			if ($('#chbImprimirDetalles_polizas_contabilidad').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_polizas_contabilidad').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_polizas_contabilidad').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_polizas_contabilidad').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_polizas_contabilidad').val()),
										'strEstatus': $('#cmbEstatusBusq_polizas_contabilidad').val(), 
										'strModulo': $('#cmbModuloBusq_polizas_contabilidad').val(),
										'strProceso': $('#cmbProcesoBusq_polizas_contabilidad').val(),
										'strBusqueda': $('#txtBusqueda_polizas_contabilidad').val(),
										'strDetalles': $('#chbImprimirDetalles_polizas_contabilidad').val()					
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_polizas_contabilidad(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtPolizaID_polizas_contabilidad').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'contabilidad/polizas/get_reporte_registro',
							'data' : {
										'intPolizaID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);

		}

		

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_polizas_contabilidad(polizaID, folio)
		{
			
			//Variables que se utilizan para asignar los valores del registro
			var intPolizaID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(polizaID == '')
			{
				intPolizaID = $('#txtPolizaID_polizas_contabilidad').val();
				strFolio = $('#txtFolio_polizas_contabilidad').val();
			}
			else
			{
				intPolizaID = polizaID;
				strFolio = folio;
			}


			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'contabilidad/polizas/descargar_archivos',
							'data' : {
										'intPolizaID': intPolizaID,
										'strFolio': strFolio				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}
	
	
		/*******************************************************************************************************************
		Funciones del modal Pólizas
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_polizas_contabilidad()
		{
			//Incializar formulario
			$('#frmPolizasContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_polizas_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmPolizasContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_polizas_contabilidad');
		    //Eliminar los datos de la tabla detalles de la póliza
		    $('#dg_detalles_polizas_contabilidad tbody').empty();
		    $('#acumCargo_detalles_polizas_contabilidad').html('0.00000');
		    $('#acumAbono_detalles_polizas_contabilidad').html('$0.00000');
			$('#numElementos_detalles_polizas_contabilidad').html(0);
			//Crear instancia del objeto Detalles de la póliza
			objDetallesPolizaPolizasContabilidad = new DetallesPolizaPolizasContabilidad([]);
			//Habilitar todos los elementos del formulario
			$('#frmPolizasContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_polizas_contabilidad').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_polizas_contabilidad').attr("disabled", "disabled");
			$('#txtModulo_polizas_contabilidad').attr("disabled", "disabled");
			$('#txtProceso_polizas_contabilidad').attr("disabled", "disabled");
			$('#txtReferencia_polizas_contabilidad').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_polizas_contabilidad").show();
			//Ocultar los siguientes botones
			$("#btnDescargarArchivo_detalles_polizas_contabilidad").hide();
			$("#btnEliminarArchivo_detalles_polizas_contabilidad").hide();
			$("#btnImprimirRegistro_polizas_contabilidad").hide();
			$("#btnDescargarArchivos_polizas_contabilidad").hide();
			$("#btnDesactivar_polizas_contabilidad").hide();
			$("#btnRestaurar_polizas_contabilidad").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_polizas_contabilidad()
		{
			try {
				//Cerrar modal
				objPolizasContabilidad.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_polizas_contabilidad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_polizas_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_polizas_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmPolizasContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFolio_polizas_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba el folio para esta póliza'}
											}
										},
									  	strFecha_polizas_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strTipo_polizas_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo de póliza'}
											}
										},
										strConcepto_polizas_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba un concepto'}
											}
										},
										intImporteTotal_polizas_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba el importe total'}
											}
										},
										intNumDetalles_polizas_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta póliza.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCuenta_detalles_polizas_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intImporte_detalles_polizas_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strNaturaleza_detalles_polizas_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strReferencia_detalles_polizas_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strConcepto_detalles_polizas_contabilidad: {
											excluded: true  //Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_polizas_contabilidad = $('#frmPolizasContabilidad').data('bootstrapValidator');
			bootstrapValidator_polizas_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_polizas_contabilidad.isValid())
			{
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumCargoDetallesPolizasContabilidad = $.reemplazar($('#acumCargo_detalles_polizas_contabilidad').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumCargoDetallesPolizasContabilidad = $.reemplazar(intAcumCargoDetallesPolizasContabilidad, ",", "");

				var intImporteTotalPolizasContabilidad = $.reemplazar($('#txtImporteTotal_polizas_contabilidad').val(), ",", "");
 
				//Verificar que el importe total sea igual al total de detalles
				if(intAcumCargoDetallesPolizasContabilidad != intImporteTotalPolizasContabilidad )
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_polizas_contabilidad('error', 'El importe total no coincide con los cargos, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_polizas_contabilidad();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_polizas_contabilidad()
		{
			try
			{
				$('#frmPolizasContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_polizas_contabilidad()
		{
			//Variable que se utiliza para asignar el estatus de la póliza
			var strEstatusPoliza = 'NO APLICADA';
			//Variable que se utiliza para asignar el acumulado de los cargos
			var intAcumCargoDetallesPoliza = $.reemplazar($('#acumCargo_detalles_polizas_contabilidad').html(), "$", "");
			//Variable que se utiliza para asignar el acumulado de los abonos
			var intAcumAbonoDetallesPoliza = $.reemplazar($('#acumAbono_detalles_polizas_contabilidad').html(), "$", "");

			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intAcumCargoDetallesPoliza = $.reemplazar(intAcumCargoDetallesPoliza, ",", "");
			intAcumAbonoDetallesPoliza = $.reemplazar(intAcumAbonoDetallesPoliza, ",", "");

			//Si el acumulado de los cargos es igual al acumulado de los abonos
			if(intAcumCargoDetallesPoliza == intAcumAbonoDetallesPoliza)
			{
				//Cambiar el estatus de la póliza
				strEstatusPoliza = 'ACTIVO';
			}

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_polizas_contabilidad').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRenglonesActuales = [];
			var arrRenglonesAnteriores = [];
			//Variable que se utiliza para concatenar la lista con los archivos de los detalles
			var strListaArchivos = '';
			//Variable que se utiliza par asignar el id del renglón del detalle
			var intRenglonID = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				
				//Incrementar renglón por cada detalle recorrido
				intRenglonID++;
				//Asignar id del objeto tipo file
				var strBotonArchivoID = objRen.cells[9].innerHTML;
				//Asignar valor del objeto tipo file
				var fileUpload = $("#"+strBotonArchivoID);
				//Obtenemos un array con los datos de los archivos
				var files = $("#"+strBotonArchivoID)[0].files;

				//Si el el número de archivos seleccionados es mayor que cero
		        if(parseInt(fileUpload.get(0).files.length) > 0)
		        {	
		        	//Concatenar datos y agregarlos a la lista de archivos
		        	strListaArchivos += intRenglonID+'&'+strBotonArchivoID+'|';
	          	}

				//Asignar valores a los arrays
				arrRenglonesActuales.push(intRenglonID);
				arrRenglonesAnteriores.push(objRen.cells[10].innerHTML);
			}

			//Quitar último elemento de la cadena
			strListaArchivos = strListaArchivos.slice(0, -1);

		    //Hacer un llamado a la función JSON para guardar los detalles de la póliza
			var jsonDetalles = JSON.stringify(objDetallesPolizaPolizasContabilidad); 

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('contabilidad/polizas/guardar',
					{ 
						//Datos de la póliza
						intPolizaID: $('#txtPolizaID_polizas_contabilidad').val(),
						strTipo: $('#cmbTipo_polizas_contabilidad').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_polizas_contabilidad').val()),
						strConcepto: $('#txtConcepto_polizas_contabilidad').val(),
						strObservaciones: $('#txtObservaciones_polizas_contabilidad').val(),
						strEstatus: strEstatusPoliza,
						intProcesoMenuID: $('#txtProcesoMenuID_polizas_contabilidad').val(),
						//Datos de los renglones
						strRenglonesActuales: arrRenglonesActuales.join('|'),
						strRenglonesAnteriores: arrRenglonesAnteriores.join('|'),
						//Datos de los detalles
						arrDetalles: jsonDetalles
					},
					function(data) {
						if (data.resultado)
						{
							//Si no existe id de la póliza, significa que es un nuevo registro   
							if($('#txtPolizaID_polizas_contabilidad').val() == '')
							{
							  	//Asignar el id de la póliza de compra registrada en la base de datos
                     			$('#txtPolizaID_polizas_contabilidad').val(data.poliza_id);
                 			}

							//Si existen archivos seleccionados
             				if(strListaArchivos != '')
             				{
             					//Hacer un llamado a la función para subir los archivos
	                    		subir_archivos_detalles_polizas_contabilidad(strListaArchivos);
             				}
             				else
             				{
             					//Hacer un llamado a la función para cerrar modal
		                    	cerrar_polizas_contabilidad();
		                    	
								//Hacer llamado a la función  para cargar  los registros en el grid
		               			paginacion_polizas_contabilidad();  
             				}
         					
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_polizas_contabilidad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_polizas_contabilidad(tipoMensaje, mensaje)
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
		function cambiar_estatus_polizas_contabilidad(id,estatus, totalCargos, totalAbonos)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			var intTotalCargos = 0;
			var intTotalAbonos = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';

			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtPolizaID_polizas_contabilidad').val();
				intTotalCargos = $('#acumCargo_detalles_polizas_contabilidad').val();
				intTotalAbonos = $('#acumAbono_detalles_polizas_contabilidad').val();

			}
			else
			{
				intID = id;
				intTotalCargos = totalCargos;
				intTotalAbonos = totalAbonos;
				strTipo = 'gridview';
			}

			//Variable que se utiliza para asignar el estatus de la póliza
			var strEstatusPoliza = 'NO APLICADA';
			//Variable que se utiliza para asignar el acumulado de los cargos
			var intAcumCargoDetallesPoliza = $.reemplazar(intTotalCargos, "$", "");
			//Variable que se utiliza para asignar el acumulado de los abonos
			var intAcumAbonoDetallesPoliza = $.reemplazar(intTotalAbonos, "$", "");

			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intAcumCargoDetallesPoliza = $.reemplazar(intAcumCargoDetallesPoliza, ",", "");
			intAcumAbonoDetallesPoliza = $.reemplazar(intAcumAbonoDetallesPoliza, ",", "");


			//Si el acumulado de los cargos es igual al acumulado de los abonos
			if(intAcumCargoDetallesPoliza == intAcumAbonoDetallesPoliza)
			{
				//Cambiar el estatus de la póliza
				strEstatusPoliza = 'ACTIVO';
			}

		    //Si el estatus del registro es diferente de INACTIVO
		    if(estatus != 'INACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
				             {'type':     'question',
				              'title':    'Pólizas',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_polizas_contabilidad(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es ACTIVO O NO APLICADA
		    {	

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_polizas_contabilidad(intID, strTipo, strEstatusPoliza);
				
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_polizas_contabilidad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('contabilidad/polizas/set_estatus',
			      {intPolizaID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_polizas_contabilidad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_polizas_contabilidad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_polizas_contabilidad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_polizas_contabilidad(id)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/polizas/get_datos',
			       {
			       		intPolizaID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_polizas_contabilidad();
							//Asignar estatus y reemplazar cadena vacia por '_'
				            var strEstatus = data.row.estatus;
							strEstatus = strEstatus.replace(" ", "_");

				          	//Recuperar valores
				            $('#txtPolizaID_polizas_contabilidad').val(data.row.poliza_id);
				            $('#cmbTipo_polizas_contabilidad').val(data.row.tipo);
				            $('#txtFolio_polizas_contabilidad').val(data.row.folio);
				            $('#txtModulo_polizas_contabilidad').val(data.row.modulo);
				            $('#txtProceso_polizas_contabilidad').val(data.row.proceso);
				            $('#txtReferenciaID_polizas_contabilidad').val(data.row.referencia_id);
				            $('#txtReferencia_polizas_contabilidad').val(data.row.referencia);
				            $('#txtFecha_polizas_contabilidad').val(data.row.fecha);
				            $('#txtConcepto_polizas_contabilidad').val(data.row.concepto);
				            $('#txtObservaciones_polizas_contabilidad').val(data.row.beneficiario);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_polizas_contabilidad').addClass("estatus-"+strEstatus);
				            $('#txtEstatus_polizas_contabilidad').val(strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_polizas_contabilidad").show();

				            //Si existen archivos del registro
				           	if(data.total_archivos > 0)
				           	{
				           		//Mostrar botón Descargar Archivos
				            	$("#btnDescargarArchivos_polizas_contabilidad").show();
				           	}

							//Si el estatus del registro es INACTIVO
				            if(strEstatus == 'INACTIVO')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmPolizasContabilidad').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					            $("#btnGuardar_polizas_contabilidad").hide();
				            	//Mostrar botón Restaurar
				            	$("#btnRestaurar_polizas_contabilidad").show();
				            }
				            else //ACTIVO O NO APLICADA
				            {
					            	
					            //Mostrar los siguientes botones  
					            $("#btnDesactivar_polizas_contabilidad").show();
				            }

				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Variable que se utiliza para asignar el renglón del detalle
								var intRenglon = data.detalles[intCon].renglon;
								//Variable que se utiliza para asignar el tipo de renglón
								var strTipoRenglon = '"Existente"';
								 //Variables que se utiliza para asignar el id del objeto (input) tipo file
								var strIDCampoArchivo = 'archivo_varios_detalles_polizas_contabilidad_'+intRenglon;
								//Variables que se utiliza para asignar el id del área (spam) del objeto (input) tipo file
								var strIDCampoArea = 'archivos_area_detalles_polizas_contabilidad_'+intRenglon;
								//Variable que se utiliza para asignar las acciones del archivo
								var strAccionesArchivo = '';
								var strNombreArchivo = data.detalles[intCon].archivos;
								//Variable que se utiliza para asignar el importe del cargo
								var intCargo = 0;
								//Variable que se utiliza para asignar el importe del abono
								var intAbono = 0;
								//Variable que se utiliza para asignar la naturaleza
								var strNaturaleza = data.detalles[intCon].naturaleza;
								//Variable que se utiliza para asignar el importe
								var intImporte = data.detalles[intCon].importe;
								//Variable que se utiliza para asignar el id de la cuenta
								var intCuentaID = data.detalles[intCon].cuenta_id;
								//Variable que se utiliza para concatenar los datos de la cuenta
								var strCuenta = data.detalles[intCon].cuenta+' - '+data.detalles[intCon].cuenta_descripcion;

								//Si existe archivo del detalle
								if(strNombreArchivo != '')
								{
									//Descargar archivo
									strAccionesArchivo += "<button class='btn btn-default btn-xs' title='Descargar archivo'" +
															 " onclick='descargar_archivos_detalles_polizas_contabilidad("+intRenglon+")'>" + 
															 "<span class='glyphicon glyphicon-download-alt'></span></button>";

									//Eliminar archivo
									strAccionesArchivo += "<button class='btn btn-default btn-xs' title='Eliminar archivo'" +
															 " onclick='eliminar_archivo_detalles_polizas_contabilidad("+intRenglon+","+strTipoRenglon+")'>" + 
															 "<span class='glyphicon glyphicon-export'></span></button>";
								}

								//Dependiendo de la naturaleza, asignar importe
								if(strNaturaleza == 'CARGO')
								{
									intCargo =  intImporte;
								}
								else
								{
									intAbono =  intImporte;
								}

				            	//Crear instancia del objeto Detalle de la póliza
								objDetallePolizaPolizasContabilidad = new DetallePolizaPolizasContabilidad(null, '', '', '', '', '', '', 
																						  '', '' , '', '', '','', []);
								

								//Asignar valores al objeto
								objDetallePolizaPolizasContabilidad.intCuentaID = intCuentaID;
								objDetallePolizaPolizasContabilidad.strCuenta = strCuenta;
								objDetallePolizaPolizasContabilidad.intImporte = intImporte;
								objDetallePolizaPolizasContabilidad.strNaturaleza = strNaturaleza;
								objDetallePolizaPolizasContabilidad.strReferencia = data.detalles[intCon].referencia;
								objDetallePolizaPolizasContabilidad.strConcepto =data.detalles[intCon].concepto;
								objDetallePolizaPolizasContabilidad.intAbono = formatMoney(intAbono, 5, '');
								objDetallePolizaPolizasContabilidad.intCargo = formatMoney(intCargo, 5, '');
								//Asignar valores (del archivo) al objeto
								objDetallePolizaPolizasContabilidad.strArchivoExistente = strNombreArchivo;
								objDetallePolizaPolizasContabilidad.strIDCampoArchivo = strIDCampoArchivo;
								objDetallePolizaPolizasContabilidad.intRenglonAnterior = intRenglon;
								objDetallePolizaPolizasContabilidad.strTipoRenglon =  'Existente'; 
								objDetallePolizaPolizasContabilidad.strIDCampoArea =  strIDCampoArea; 

								//Array que se utiliza para agregar los detalles Diot del registro
								var arrDiotsDetallePoliza = [];
								
								//Mostramos los detalles Diot del registro
					            for (var intConDR in  data.detalles[intCon].arrDetallesDiot) 
					            {
					            	//Crear instancia del objeto Detalle Diot
									objDetalleDiotPolizasContabilidad = new DetalleDiotPolizasContabilidad(null, '', '', '', '', '','', '','');
									//Asignar valores 
									objDetalleDiotPolizasContabilidad.intProveedorID = data.detalles[intCon].arrDetallesDiot[intConDR].proveedor_id;
									objDetalleDiotPolizasContabilidad.strProveedor = data.detalles[intCon].arrDetallesDiot[intConDR].proveedor;
									objDetalleDiotPolizasContabilidad.strSerie = data.detalles[intCon].arrDetallesDiot[intConDR].serie;
									objDetalleDiotPolizasContabilidad.strFolio = data.detalles[intCon].arrDetallesDiot[intConDR].folio;;
									objDetalleDiotPolizasContabilidad.strReferencia = data.detalles[intCon].arrDetallesDiot[intConDR].referencia;
									objDetalleDiotPolizasContabilidad.intTasaCuotaIva = data.detalles[intCon].arrDetallesDiot[intConDR].tasa_cuota_iva;
									objDetalleDiotPolizasContabilidad.intPorcentajeIva =data.detalles[intCon].arrDetallesDiot[intConDR].porcentaje_iva;
									objDetalleDiotPolizasContabilidad.intImporteBase =  data.detalles[intCon].arrDetallesDiot[intConDR].importe_base;
									objDetalleDiotPolizasContabilidad.intImporteIva =data.detalles[intCon].arrDetallesDiot[intConDR].importe_iva;

									//Agregar objeto en el array
									arrDiotsDetallePoliza.push(objDetalleDiotPolizasContabilidad);

					            }

					            //Agregar array con los detalles Diot
           					    objDetallePolizaPolizasContabilidad.setDetallesDiot(arrDiotsDetallePoliza);

           					    //Agregar datos del detalle de la póliza
           						objDetallesPolizaPolizasContabilidad.setDetalle(objDetallePolizaPolizasContabilidad);

           						//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_polizas_contabilidad').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaCuenta = objRenglon.insertCell(0);
								var objCeldaConcepto = objRenglon.insertCell(1);
								var objCeldaReferencia = objRenglon.insertCell(2);
								var objCeldaCargo = objRenglon.insertCell(3);
								var objCeldaAbono = objRenglon.insertCell(4);
								var objCeldaAcciones = objRenglon.insertCell(5);
								//Columnas ocultas
								var objCeldaImporte =  objRenglon.insertCell(6);
								var objCeldaNaturaleza = objRenglon.insertCell(7);
								var objCeldaArchivoExistente = objRenglon.insertCell(8);
								var objCeldaIDCampoArchivo = objRenglon.insertCell(9);
								//Columna que se utiliza para asignar el renglon de un detalle existente de esta manera 
								//se renombrara la carpeta que contiene los archivos
								var objCeldaRenglonAnterior = objRenglon.insertCell(10);
								var objCeldaTipoRenglon = objRenglon.insertCell(11);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', intRenglon);
								objCeldaCuenta.setAttribute('class', 'movil b1');
								objCeldaCuenta.innerHTML = objDetallePolizaPolizasContabilidad.strCuenta;
								objCeldaConcepto.setAttribute('class', 'no-mostrar');
								objCeldaConcepto.innerHTML = objDetallePolizaPolizasContabilidad.strConcepto;
								objCeldaReferencia.setAttribute('class', 'no-mostrar');
								objCeldaReferencia.innerHTML =  objDetallePolizaPolizasContabilidad.strReferencia;;
								objCeldaCargo.setAttribute('class', 'movil b2');
								objCeldaCargo.innerHTML =  objDetallePolizaPolizasContabilidad.intCargo;
								objCeldaAbono.setAttribute('class', 'movil b3');
								objCeldaAbono.innerHTML = objDetallePolizaPolizasContabilidad.intAbono;
								objCeldaAcciones.setAttribute('class', 'td-center movil b4');


								//Si el estatus del registro es diferente de INACTIVO
								if(strEstatus != 'INACTIVO')
								{
									objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_detalles_polizas_contabilidad(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<span   class='fileupload-buttonbar'>"+
															 "<span class='btn  btn-default btn-xs fileinput-button '>"+
															 "<span class='fa fa-upload'></span>"+
															"<span id='"+strIDCampoArea+"'>"+
															"<input name='"+strIDCampoArchivo+"[]' id='"+strIDCampoArchivo+"'"+
															 "type='file' multiple accept='text/xml,application/pdf'"+
															 "onchange='verificar_extension_archivos_detalles_polizas_contabilidad(this);'>"+
															"</input></span></span></span>"+
															strAccionesArchivo+
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='verificar_renglon_eliminar_detalles_polizas_contabilidad(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
								}
								else
								{
									objCeldaAcciones.innerHTML = "";
								}
								

								objCeldaImporte.setAttribute('class', 'no-mostrar');
								objCeldaImporte.innerHTML = formatMoney(intImporte, 5, '');
								objCeldaNaturaleza.setAttribute('class', 'no-mostrar');
								objCeldaNaturaleza.innerHTML = objDetallePolizaPolizasContabilidad.strNaturaleza;;
								objCeldaArchivoExistente.setAttribute('class', 'no-mostrar');
								objCeldaArchivoExistente.innerHTML = objDetallePolizaPolizasContabilidad.strArchivoExistente;
								objCeldaIDCampoArchivo.setAttribute('class', 'no-mostrar');
								objCeldaIDCampoArchivo.innerHTML = objDetallePolizaPolizasContabilidad.strIDCampoArchivo; 
								objCeldaRenglonAnterior.setAttribute('class', 'no-mostrar');
								objCeldaRenglonAnterior.innerHTML = objDetallePolizaPolizasContabilidad.intRenglonAnterior; 
								objCeldaTipoRenglon.setAttribute('class', 'no-mostrar');
								objCeldaTipoRenglon.innerHTML = objDetallePolizaPolizasContabilidad.strTipoRenglon;


				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_polizas_contabilidad();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_polizas_contabilidad tr").length - 2;
							$('#numElementos_detalles_polizas_contabilidad').html(intFilas);
							$('#txtNumDetalles_polizas_contabilidad').val(intFilas);
							
							//Variable que se utiliza para asignar el acumulado de los cargos
							var intAcumCargoDetallesPoliza = $.reemplazar($('#acumCargo_detalles_polizas_contabilidad').html(), "$", "");

							//Asignar acumulado de los cargos
							$('#txtImporteTotal_polizas_contabilidad').val(intAcumCargoDetallesPoliza);
							 //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporteTotal_polizas_contabilidad').formatCurrency({ roundToDecimalPlace: 5 });


			            	//Abrir modal
				            objPolizasContabilidad = $('#PolizasContabilidadBox').bPopup({
														  appendTo: '#PolizasContabilidadContent', 
							                              contentContainer: 'PolizasContabilidadM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar combobox
							$('#cmbTipo_polizas_contabilidad').focus();
			       	    }
			       },
			       'json');
		}


		//Función para verificar la extensión de los archivos seleccionados de un objeto tipo file
		function verificar_extension_archivos_detalles_polizas_contabilidad(campoID)
		{			
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDPolizasContabilidad = $(campoID).attr("id");
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDPolizasContabilidad);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDPolizasContabilidad)[0].files;
			//Variable que se utiliza para asignar la extensión del primer archivo seleccionado
			var strExtensionAnterior = '';
			//Variable que se utiliza para asignar el mensaje de error
			var strMensajeError = '';
			//Variable que se utiliza para asignar el tipo de renglón
			var strTipoRenglon = '';
			//Variable que se utiliza para asignar el renglón del detalle
			var intRenglonID = 0;

			//Si no existe concepto del detalle
			if($('#txtConcepto_detalles_polizas_contabilidad').val() == '')
			{
				//Limpiar las siguientes cajas de texto para evitar subir archivos en el renglón que fue mostrado anteriormente
				$('#txtTipoRenglon_detalles_polizas_contabilidad').val('');
				$('#txtRenglonAnterior_detalles_polizas_contabilidad').val('');

			}

			//Si no existe tipo de renglón, significa que se subira el archivo desde el modal en caso de que exista el renglón en la BD
			if(strBotonArchivoIDPolizasContabilidad == 'archivo_varios_detalles_polizas_contabilidad')
			{

				strTipoRenglon = $('#txtTipoRenglon_detalles_polizas_contabilidad').val();
				intRenglonID = $('#txtRenglonAnterior_detalles_polizas_contabilidad').val();
			}
			else
			{
				
				 //Asignar id del botón tipo file
				 var strBotonCampoID = strBotonArchivoIDPolizasContabilidad;
				 //Reemplazar id del botón por cadena vacia para obtener el renglón de la tabla
				 intRenglonID = strBotonCampoID.replace("archivo_varios_detalles_polizas_contabilidad_", "");
				 //Seleccionar el renglón de la tabla para recuperar el nombre del archivo
				 var selectedRow = document.getElementById("dg_detalles_polizas_contabilidad").rows[intRenglonID].cells;
				 //Asignar el tipo de renglón
				 strTipoRenglon = selectedRow[11].innerHTML;
			}
			
			//Crear instancia al objeto del formulario
	        var formData = new FormData($("#frmPolizasContabilidad")[0]);
	     	//Agregar campos al objeto del formulario
			formData.append("intPolizaID_detalles_polizas_contabilidad", $("#txtPolizaID_polizas_contabilidad").val());
			formData.append("intRenglon_detalles_polizas_contabilidad", intRenglonID);

            //Si el el número de archivos seleccionados es mayor que dos
	        if(parseInt(fileUpload.get(0).files.length) > 2)
	        {
	           //Mensaje que se utiliza para informar al usuario que solo es posible subir dos archivos
	           strMensajeError = 'Solamente puede subir dos archivos: un XML y un PDF.';
	        }
	        else
	        {
	        	//Hacer recorrido para verificar que la extensión de los  archivos seleccionados sea diferente
	        	for (var intCont = 0; intCont < parseInt(fileUpload.get(0).files.length); intCont++)
				{
				    //Obtenemos el nombre del archivo
					var fileName = files[intCont].name;
					//Obtenemos la extensión del archivo
					var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);

					//Si existe un archivo anterior
					if(strExtensionAnterior !== '')
					{
						//Verificar si la extensión del archivo es la misma
						if(strExtensionAnterior == fileExtension)
						{
							//Mensaje que se utiliza para informar al usuario que los archivos son de la misma extensión
							strMensajeError = 'No es posible subir los archivos con la misma extensión,  favor de seleccionar un XML y un PDF.';
						}
						
					}

					//Asignar extensión del primer archivo
					strExtensionAnterior = fileExtension;

					//Agregar campo tipo file al objeto del formulario
					formData.append("archivo_varios_detalles_polizas_contabilidad[]", document.getElementById(strBotonArchivoIDPolizasContabilidad).files[intCont]);
				 	
				}
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Limpia ruta del archivo cargado
		        $('#'+strBotonArchivoIDPolizasContabilidad).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_polizas_contabilidad('error', strMensajeError);
	        }
	        else
	        {
	        	//Si el renglón existe en la BD
	        	if(strTipoRenglon == 'Existente')
		        {
		        	//Hacer un llamado al método del controlador para subir archivos del registro
		            $.ajax({
		                url: 'contabilidad/polizas/subir_archivos',
		                type: "POST",
		                data: formData,
		                contentType: false,
		                processData: false,
		                success: function(data)
		                {
		                	//Limpia ruta del archivo cargado
		         			$('#'+strBotonArchivoIDPolizasContabilidad).val('');
		         			//Subida finalizada
							if (data.resultado)
							{	
								//Si el renglón del registro se obtuvo del modal
								if(strBotonArchivoIDPolizasContabilidad == 'archivo_varios_detalles_polizas_contabilidad')
								{
									//Mostrar los siguientes botones
									$('#btnDescargarArchivo_detalles_polizas_contabilidad').show();
									$('#btnEliminarArchivo_detalles_polizas_contabilidad').show();
								}

								//Si existen archivos del vale de caja
								if(data.total_archivos > 0)
								{
									//Mostrar botón Descargar Archivos
					            	$("#btnDescargarArchivos_polizas_contabilidad").show();
								}

								//Hacer un llamado a la función para agregar las acciones (subir y eliminar) del archivo
								//en la columna de acciones (grid view)
								agregar_acciones_archivo_varios_detalles_polizas_contabilidad(intRenglonID, 'subir_archivo');
							}

							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		    				mensaje_polizas_contabilidad(data.tipo_mensaje, data.mensaje);
		                   
		                }
	            	});
			    	
		        }
	        }
	       
		}

	    //Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_detalles_polizas_contabilidad(renglon)
		{
			//Variable que se utiliza para asignar el renglón del registro
			var intRenglonID = 0;

			//Si no existe renglón, significa que se realizará la descarga desde el modal
			if(renglon == '')
			{

				intRenglonID = $('#txtRenglonAnterior_detalles_polizas_contabilidad').val();

			}
			else
			{
				intRenglonID = renglon;
			}

			
			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'contabilidad/polizas/descargar_archivos_detalle',
							'data' : {
										'intPolizaID': $('#txtPolizaID_polizas_contabilidad').val(),
										'intRenglonID': intRenglonID				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}


		//Función que se utiliza para eliminar el archivo del registro seleccionado
		function eliminar_archivo_detalles_polizas_contabilidad(renglon, tipoRenglon)
		{
			//Variable que se utiliza para asignar el tipo de renglón
			var strTipoRenglon = '';
			//Variable que se utiliza para asignar el renglón del detalle
			var intRenglonID = 0;

			//Si no existe renglón, significa que se eliminara el archivo desde el modal
			if(renglon == '')
			{
				intRenglonID = $('#txtRenglonAnterior_detalles_polizas_contabilidad').val();
				strTipoRenglon = $('#txtTipoRenglon_detalles_polizas_contabilidad').val();

			}
			else
			{
				intRenglonID = renglon;
				strTipoRenglon = tipoRenglon;
			}

			//Hacer un llamado al método del controlador para eliminar carpeta que contiene los archivos del registro
			$.post('contabilidad/polizas/eliminar_carpeta_detalle',
			     {intPolizaID: $('#txtPolizaID_polizas_contabilidad').val(),
			      intRenglon: intRenglonID
			     },
			     function(data) {
			       
			        //Si el renglón existe en la BD
			        if(strTipoRenglon == 'Existente')
			        {
			        	//Archivo eliminado
						if (data.resultado)
						{	
							//Si el renglón del registro se obtuvo del modal
							if(renglon == '')
							{
								//Ocultar los siguientes botones
								$('#btnDescargarArchivo_detalles_polizas_contabilidad').hide();
								$('#btnEliminarArchivo_detalles_polizas_contabilidad').hide();
							}

							//Hacer un llamado a la función para quitar las acciones (subir y eliminar) del archivo
							//en la columna de acciones  (grid view)
							agregar_acciones_archivo_varios_detalles_polizas_contabilidad(intRenglonID, 'eliminar_archivo');
						}

			       	 	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        	mensaje_polizas_contabilidad(data.tipo_mensaje, data.mensaje);
			        }
			        else if(data.tipo_mensaje == 'error')
			        {
			        	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			       		 mensaje_polizas_contabilidad(data.tipo_mensaje, data.mensaje);
			        }

			       	//Si no existen archivos del vale de caja
					if(data.total_archivos == 0)
					{
						//Ocultar botón Descargar Archivos
		            	$("#btnDescargarArchivos_polizas_contabilidad").hide();
					}
			       
			     },
			    'json');
		}


		//Función para subir archivos de los detalles
		function subir_archivos_detalles_polizas_contabilidad(strListaArchivos)
		{
			
			//Separar la cadena para obtener el ID del objeto tipo file
		    var arrListaArchivos = strListaArchivos.split('|');

		    //Variable que se utiliza para asignar el mensaje de error
		    var strMensajeError = '';

		    //Hacer recorrido para subir archivos de los detalles
	        for (var intCont = 0; intCont < arrListaArchivos.length; intCont++) 
	        {
	        	//Asignar datos del archivo del detalle (renglón&ID del objeto tipo file)
	            var strDatos = arrListaArchivos[intCont];
	            var arrDatos = strDatos.split('&');

	            //Crear instancia al objeto del formulario
	       		var formData = new FormData($("#frmCajasValesCaja")[0]);
	            //Agregar campos al objeto del formulario
			    formData.append("intRenglon_detalles_polizas_contabilidad", arrDatos[0]);
			    formData.append("intPolizaID_detalles_polizas_contabilidad", $("#txtPolizaID_polizas_contabilidad").val());

	            //Variable que se utiliza para asignar archivos
				var strBotonArchivoIDGrid  = arrDatos[1];
				//Asignar valor del objeto tipo file
				var fileUpload = $("#"+strBotonArchivoIDGrid);
				//Obtenemos un array con los datos de los archivos
				var files = $("#"+strBotonArchivoIDGrid)[0].files;
				//Hacer recorrido para verificar que la extensión de los  archivos seleccionados sea diferente
	        	for (var intContArc = 0; intContArc < parseInt(fileUpload.get(0).files.length); intContArc++)
				{
					//Agregar campo tipo file al objeto del formulario
			    	formData.append("archivo_varios_detalles_polizas_contabilidad[]", document.getElementById(strBotonArchivoIDGrid).files[intContArc]);
				}

			    //Hacer un llamado al método del controlador para subir archivos del registro
	            $.ajax({
	                url: 'contabilidad/polizas/subir_archivos',
	                type: "POST",
	                data: formData,
	                contentType: false,
	                processData: false,
	                success: function(data)
	                {
	                	if (data.resultado)
						{
							//Si existe mensaje de error
							if(data.tipo_mensaje == 'error')
							{
								//Concatenar mensaje
								strMensajeError += ' '+data.mensaje;
							}

		                }
	                   
	                }
            	});
	            
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_polizas_contabilidad('error', strMensajeError);
	        }
	        else
	        {	
	        	//Hacer un llamado a la función para cerrar modal
				cerrar_polizas_contabilidad();
				//Hacer llamado a la función  para cargar  los registros en el grid
       			paginacion_polizas_contabilidad();  
	        }
	       
		}

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_polizas_contabilidad()
		{
			//Variable que se utiliza para asignar el importe del cargo
			var intCargo = 0;
			//Variable que se utiliza para asignar el importe del abono
			var intAbono = 0;

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_polizas_contabilidad').val();
			var intCuentaID = $('#txtCuentaID_detalles_polizas_contabilidad').val();
			var strCuenta = $('#txtCuenta_detalles_polizas_contabilidad').val();
			var intImporte = $('#txtImporte_detalles_polizas_contabilidad').val();
			var strNaturaleza = $('#cmbNaturaleza_detalles_polizas_contabilidad').val();
			var strReferencia = $('#txtReferencia_detalles_polizas_contabilidad').val();
			var strConcepto = $('#txtConcepto_detalles_polizas_contabilidad').val();
			var strArchivoExistente = $('#txtArchivoExistente_detalles_polizas_contabilidad').val();
			var strIDCampoArchivo = $('#txtIDCampoArchivo_detalles_polizas_contabilidad').val();
			var intRenglonAnterior = $('#txtRenglonAnterior_detalles_polizas_contabilidad').val();
			var strTipoRenglon = $('#txtTipoRenglon_detalles_polizas_contabilidad').val();
			var strIDCampoArea = $('#txtIDCampoArea_detalles_polizas_contabilidad').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_polizas_contabilidad').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intCuentaID == '' || strCuenta == '')
			{
				//Enfocar caja de texto
				$('#txtCuenta_detalles_polizas_contabilidad').focus();
			}
			else if (intImporte == '')
			{
				//Enfocar caja de texto
				$('#txtImporte_detalles_polizas_contabilidad').focus();
			}
			else if (strNaturaleza == '')
			{
				//Enfocar caja de texto
				$('#cmbNaturaleza_detalles_polizas_contabilidad').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtCuentaID_detalles_polizas_contabilidad').val('');
				$('#txtCuenta_detalles_polizas_contabilidad').val('');
				$('#txtImporte_detalles_polizas_contabilidad').val('');
				$('#cmbNaturaleza_detalles_polizas_contabilidad').val('');
				$('#txtReferencia_detalles_polizas_contabilidad').val('');
				$('#txtConcepto_detalles_polizas_contabilidad').val('');
				$('#txtRenglon_detalles_polizas_contabilidad').val('');
			    $('#txtRenglonAnterior_detalles_polizas_contabilidad').val('');
			    $('#txtTipoRenglon_detalles_polizas_contabilidad').val('');
			    $('#txtArchivoExistente_detalles_polizas_contabilidad').val('');
			    $('#txtIDCampoArchivo_detalles_polizas_contabilidad').val('');
			    $('#txtIDCampoArea_detalles_polizas_contabilidad').val('');
			    //Ocultar los siguientes botones
		    	$('#btnDescargarArchivo_detalles_polizas_contabilidad').hide();
		    	$('#btnEliminarArchivo_detalles_polizas_contabilidad').hide();

		    	//Crear instancia del objeto Detalle de la póliza
				objDetallePolizaPolizasContabilidad = new DetallePolizaPolizasContabilidad(null, '', '', '', '', '', '', 
																						  '', '' , '', '', '','', []);

         		//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strConcepto = strConcepto.toUpperCase();
				strReferencia = strReferencia.toUpperCase();
				//Convertir cadena de texto a número decimal
				intImporte = parseFloat($.reemplazar(intImporte, ",", ""));

				//Dependiendo de la naturaleza, asignar importe
				if(strNaturaleza == 'CARGO')
				{
					intCargo =  intImporte;
				}
				else
				{
					intAbono =  intImporte;
				}

				//Asignar valores al objeto
				objDetallePolizaPolizasContabilidad.intCuentaID = intCuentaID;
				objDetallePolizaPolizasContabilidad.strCuenta = strCuenta;
				objDetallePolizaPolizasContabilidad.intImporte = intImporte;
				objDetallePolizaPolizasContabilidad.strNaturaleza = strNaturaleza;
				objDetallePolizaPolizasContabilidad.strReferencia = strReferencia;
				objDetallePolizaPolizasContabilidad.strConcepto = strConcepto;
				objDetallePolizaPolizasContabilidad.intAbono = formatMoney(intAbono, 5, '');
				objDetallePolizaPolizasContabilidad.intCargo = formatMoney(intCargo, 5, '');

				//Convertir cantidad a formato moneda
				intImporte = formatMoney(intImporte, 5, '');
				
				//Revisamos si existe el renglón, si es así, editamos los datos del detalle
				if (intRenglon)
				{
					//Asignar valores (del archivo) al objeto
					objDetallePolizaPolizasContabilidad.strArchivoExistente = strArchivoExistente;
					objDetallePolizaPolizasContabilidad.strIDCampoArchivo = strIDCampoArchivo;
					objDetallePolizaPolizasContabilidad.intRenglonAnterior = intRenglonAnterior;
					objDetallePolizaPolizasContabilidad.strTipoRenglon = strTipoRenglon; 
					objDetallePolizaPolizasContabilidad.strIDCampoArea =  strIDCampoArea; 

					//Modificar los datos del detalle corespondiente al indice
	        		objDetallesPolizaPolizasContabilidad.modificarDetalle(intRenglon, objDetallePolizaPolizasContabilidad);

	        		//Incrementar renglón para obtener la posición del detalle en la tabla
					intRenglon++;
					//Seleccionar el renglón de la tabla para actualizar los datos del detalle
					var selectedRow = document.getElementById("dg_detalles_polizas_contabilidad").rows[intRenglon].cells;
					selectedRow[0].innerHTML = objDetallePolizaPolizasContabilidad.strCuenta;
					selectedRow[1].innerHTML = objDetallePolizaPolizasContabilidad.strConcepto;
					selectedRow[2].innerHTML = objDetallePolizaPolizasContabilidad.strReferencia;
					selectedRow[3].innerHTML = objDetallePolizaPolizasContabilidad.intCargo;
					selectedRow[4].innerHTML = objDetallePolizaPolizasContabilidad.intAbono;
					selectedRow[6].innerHTML = intImporte;
					selectedRow[7].innerHTML = objDetallePolizaPolizasContabilidad.strNaturaleza;
					selectedRow[9].innerHTML = objDetallePolizaPolizasContabilidad.strIDCampoArchivo; 
					selectedRow[10].innerHTML = objDetallePolizaPolizasContabilidad.intRenglonAnterior; 
				}
				else
				{

					//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
					intRenglon = $("#dg_detalles_polizas_contabilidad tr").length - 2;
					//Incrementar 1 para el siguiente renglón
					intRenglon++;
					//Variable que se utiliza para asignar el id del objeto (input) tipo file
				    strIDCampoArchivo = 'archivo_varios_detalles_polizas_contabilidad_'
					//Variable que se utiliza para asignar el id del área (spam) del objeto (input) tipo file
					strIDCampoArea = 'archivos_area_detalles_polizas_contabilidad_';

					//Agregar renglón de la fila
					strIDCampoArchivo += intRenglon;
					strIDCampoArea += intRenglon;

					//Asignar valores (del archivo) al objeto
					objDetallePolizaPolizasContabilidad.strArchivoExistente = '';
					objDetallePolizaPolizasContabilidad.strIDCampoArchivo = strIDCampoArchivo;
					objDetallePolizaPolizasContabilidad.intRenglonAnterior = 0;
					objDetallePolizaPolizasContabilidad.strTipoRenglon =  'Nuevo'; 
					objDetallePolizaPolizasContabilidad.strIDCampoArea =  strIDCampoArea; 
					//Agregar datos del detalle de la póliza
           			objDetallesPolizaPolizasContabilidad.setDetalle(objDetallePolizaPolizasContabilidad);

					//Variable que se utiliza para asignar el tipo de renglón
					var strTipoRenglon = '"Nuevo"';

					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCuenta = objRenglon.insertCell(0);
					var objCeldaConcepto = objRenglon.insertCell(1);
					var objCeldaReferencia = objRenglon.insertCell(2);
					var objCeldaCargo = objRenglon.insertCell(3);
					var objCeldaAbono = objRenglon.insertCell(4);
					var objCeldaAcciones = objRenglon.insertCell(5);
					//Columnas ocultas
					var objCeldaImporte =  objRenglon.insertCell(6);
					var objCeldaNaturaleza = objRenglon.insertCell(7);
					var objCeldaArchivoExistente = objRenglon.insertCell(8);
					var objCeldaIDCampoArchivo = objRenglon.insertCell(9);
					//Columna que se utiliza para asignar el renglon de un detalle existente de esta manera 
					//se renombrara la carpeta que contiene los archivos
					var objCeldaRenglonAnterior = objRenglon.insertCell(10);
					var objCeldaTipoRenglon = objRenglon.insertCell(11);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRenglon);
					objCeldaCuenta.setAttribute('class', 'movil b1');
					objCeldaCuenta.innerHTML = objDetallePolizaPolizasContabilidad.strCuenta;
					objCeldaConcepto.setAttribute('class', 'no-mostrar');
					objCeldaConcepto.innerHTML =  objDetallePolizaPolizasContabilidad.strConcepto;
					objCeldaReferencia.setAttribute('class', 'no-mostrar');
					objCeldaReferencia.innerHTML = objDetallePolizaPolizasContabilidad.strReferencia;
					objCeldaCargo.setAttribute('class', 'movil b2');
					objCeldaCargo.innerHTML =  objDetallePolizaPolizasContabilidad.intCargo;
					objCeldaAbono.setAttribute('class', 'movil b3');
					objCeldaAbono.innerHTML = objDetallePolizaPolizasContabilidad.intAbono;
					objCeldaAcciones.setAttribute('class', 'td-center movil b4');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_polizas_contabilidad(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<span   class='fileupload-buttonbar'>"+
												 "<span class='btn  btn-default btn-xs fileinput-button '>"+
												 "<span class='fa fa-upload'></span>"+
												"<span id='"+strIDCampoArea+"'>"+
												"<input name='"+strIDCampoArchivo+"[]' id='"+strIDCampoArchivo+"'"+
												 "type='file' multiple accept='text/xml,application/pdf'"+
												 "onchange='verificar_extension_archivos_detalles_polizas_contabilidad(this);'>"+
												"</input></span></span></span>"+
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='verificar_renglon_eliminar_detalles_polizas_contabilidad(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaImporte.setAttribute('class', 'no-mostrar');
					objCeldaImporte.innerHTML = intImporte;
					objCeldaNaturaleza.setAttribute('class', 'no-mostrar');
					objCeldaNaturaleza.innerHTML = objDetallePolizaPolizasContabilidad.strNaturaleza;
					objCeldaArchivoExistente.setAttribute('class', 'no-mostrar');
					objCeldaArchivoExistente.innerHTML = objDetallePolizaPolizasContabilidad.strArchivoExistente;
					objCeldaIDCampoArchivo.setAttribute('class', 'no-mostrar');
					objCeldaIDCampoArchivo.innerHTML = objDetallePolizaPolizasContabilidad.strIDCampoArchivo; 
					objCeldaRenglonAnterior.setAttribute('class', 'no-mostrar');
					objCeldaRenglonAnterior.innerHTML = objDetallePolizaPolizasContabilidad.intRenglonAnterior; 
					objCeldaTipoRenglon.setAttribute('class', 'no-mostrar');
					objCeldaTipoRenglon.innerHTML = objDetallePolizaPolizasContabilidad.strTipoRenglon; 

				}

				//Clonar contenido del campo file (archivos seleccionados del comprobante)
			    var clone = $('#archivo_varios_detalles_polizas_contabilidad').clone();
		   		clone.attr('id', strIDCampoArchivo);
			    $('#'+strIDCampoArea).html(clone);
			    //Limpia ruta del archivo cargado
		        $('#archivo_varios_detalles_polizas_contabilidad').val('');

		        //Hacer un llamado a la función que nos posicionará en el renglón siguiente de la tabla detalles
				siguiente_renglon_detalles_polizas_contabilidad(intRenglon);

				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_polizas_contabilidad();
				//Enfocar caja de texto
				$('#txtCuenta_detalles_polizas_contabilidad').focus();
			}
				                                   		

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_polizas_contabilidad tr").length - 2;
			$('#numElementos_detalles_polizas_contabilidad').html(intFilas);
			$('#txtNumDetalles_polizas_contabilidad').val(intFilas);

			//Verificar que exista el tipo de cambio cuando la moneda
			if(parseInt(intCuentaID) === intCuentaBaseIDPolizasContabilidad)
			{
				//Hacer un llamado a la función para abrir el modal de Diot
				abrir_diot_detalle_polizas_contabilidad(intRenglon); 
			}
				                                    
		}

		//Función que nos posicionará en el renglón siguiente de la tabla detalles
		function siguiente_renglon_detalles_polizas_contabilidad(renglon)
		{
			//Calculalos el indice del siguiente renglón
			var intRenglonSiguiente = parseInt(renglon) + 1;
			var intNumeroRenglones = $("#dg_detalles_polizas_contabilidad tr").length - 2;
			var objRenglon = $('#dg_detalles_polizas_contabilidad tr').eq(intRenglonSiguiente);

			//Verificar que sea el último renglón 
			if(intRenglonSiguiente <= intNumeroRenglones)
			{
				//Hacer un llamado a la función para mostrar los datos del renglón
				get_datos_renglon_detalles_polizas_contabilidad(intRenglonSiguiente);
				
			}

		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_polizas_contabilidad(objRenglon)
		{
			//Decrementar indice para obtener la posición del detalle en el arreglo
		    var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
		    //Hacer un llamado a la función para mostrar los datos del renglón
		    get_datos_renglon_detalles_polizas_contabilidad(intRenglon);
		}


		//Función para regresar los datos correspondientes a la fila de la tabla
		function get_datos_renglon_detalles_polizas_contabilidad(renglon) 
		{

			//Variable que se utiliza para asignar el indice del renglón
			var intRenglon = parseInt(renglon);
			//Seleccionar el renglón de la tabla para recuperar el nombre del archivo y el tipo de renglón
			var selectedRow = document.getElementById("dg_detalles_polizas_contabilidad").rows[intRenglon].cells;

			//Decrementar indice para obtener la posición del detalle en el arreglo
		     intRenglon -=  1;
		    //Crear instancia del objeto Detalle de la póliza
        	objDetallePolizaPolizasContabilidad = new DetallePolizaPolizasContabilidad();
        	//Asignar datos del detalle corespondiente al indice
        	objDetallePolizaPolizasContabilidad = objDetallesPolizaPolizasContabilidad.getDetalle(intRenglon);
        	//Variables que se utiliza para asignar el id del objeto (input) tipo file
        	var strIDCampoArchivo = objDetallePolizaPolizasContabilidad.strIDCampoArchivo;
        	var strNombreArchivo =  selectedRow[8].innerHTML;
        	var strTipoRenglon = selectedRow[11].innerHTML;

        	//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_polizas_contabilidad').val(intRenglon);
			$('#txtCuentaID_detalles_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.intCuentaID);
			$('#txtCuenta_detalles_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.strCuenta);
			$('#txtConcepto_detalles_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.strConcepto);
			$('#txtReferencia_detalles_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.strReferencia);
			$('#txtImporte_detalles_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.intImporte);
			//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
		    $('#txtImporte_detalles_polizas_contabilidad').formatCurrency({ roundToDecimalPlace: 5 });
			$('#cmbNaturaleza_detalles_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.strNaturaleza);
			$('#txtArchivoExistente_detalles_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.strArchivoExistente);
			$('#txtIDCampoArchivo_detalles_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.strIDCampoArchivo);
			$('#txtRenglonAnterior_detalles_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.intRenglonAnterior);
			$('#txtTipoRenglon_detalles_polizas_contabilidad').val(strTipoRenglon);
			$('#txtIDCampoArea_detalles_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.strIDCampoArea);
			
			 //Clonar contenido del campo file (archivos seleccionados del comprobante)
		    var clone = $('#'+strIDCampoArchivo).clone();
	   		clone.attr('id', 'archivo_varios_detalles_polizas_contabilidad');
		    $('#archivos_area_detalles_polizas_contabilidad').html(clone);

		    //Si existe archivo del detalle
		    if(strNombreArchivo != '' && strTipoRenglon == 'Existente')
		    {
		    	//Mostrar los siguientes botones
		    	$('#btnDescargarArchivo_detalles_polizas_contabilidad').show();
		    	$('#btnEliminarArchivo_detalles_polizas_contabilidad').show();
		    }
		    else
		    {
		    	//Ocultar los siguientes botones
		    	$('#btnDescargarArchivo_detalles_polizas_contabilidad').hide();
		    	$('#btnEliminarArchivo_detalles_polizas_contabilidad').hide();
		    }


			//Enfocar caja de texto
			$('#txtCuenta_detalles_polizas_contabilidad').focus();

			
		}

		//Función para verificar si el renglón contiene archivos antes de eliminarlo de la tabla
		function verificar_renglon_eliminar_detalles_polizas_contabilidad(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			//Variables que se utilizan para asignar valores del detalle
			var strNombreArchivo = objRenglon.parentNode.parentNode.cells[8].innerHTML;
			var intRenglonAnterior = objRenglon.parentNode.parentNode.cells[10].innerHTML;
			var strTipoRenglon = objRenglon.parentNode.parentNode.cells[11].innerHTML;

			//Si existe archivo del detalle
			if(strNombreArchivo != '')
			{
				//Preguntar al usuario si desea eliminar el archivo del registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea eliminar el archivo del registro?</strong>',
				             {'type':     'question',
				              'title':    'Pólizas',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                            	//Hacer un llamado a la función para quitar el renglón de la tabla
												eliminar_renglon_detalles_polizas_contabilidad(intRenglon);
				                              	//Hacer un llamado a la función para eliminar carpeta que contiene el archivo del registro
												eliminar_archivo_detalles_polizas_contabilidad(intRenglonAnterior, strTipoRenglon);
				                            }
				                          }
				              });
				
			}
			else
			{
				//Hacer un llamado a la función para quitar el renglón de la tabla
				eliminar_renglon_detalles_polizas_contabilidad(intRenglon);

			}
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_polizas_contabilidad(renglon)
		{
			//Eliminar del objeto el detalle seleccionado
			objDetallesPolizaPolizasContabilidad.eliminarDetalle(renglon - 1);

			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_polizas_contabilidad").deleteRow(renglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_polizas_contabilidad();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_polizas_contabilidad tr").length - 2;
			$('#numElementos_detalles_polizas_contabilidad').html(intFilas);
			$('#txtNumDetalles_polizas_contabilidad').val(intFilas);
			//Enfocar caja de texto
			$('#txtConcepto_detalles_polizas_contabilidad').focus();
		}


		//Función para calcular totales de la tabla
		function calcular_totales_detalles_polizas_contabilidad()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_polizas_contabilidad').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumCargo = 0;
			var intAcumAbono = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumCargo += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumAbono += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
			}

			//Convertir cantidad a formato moneda
			intAcumCargo =  '$'+formatMoney(intAcumCargo, 5, '');
			intAcumAbono =  '$'+formatMoney(intAcumAbono, 5, '');

			//Asignar los valores
			$('#acumCargo_detalles_polizas_contabilidad').html(intAcumCargo);
			$('#acumAbono_detalles_polizas_contabilidad').html(intAcumAbono);
		}

		//Función para agregar o quitar las acciones (subir y eliminar) del archivo en la columna de acciones  (grid view)
		function agregar_acciones_archivo_varios_detalles_polizas_contabilidad(renglon, tipoAccion)
		{
			//Variable que se utiliza para asignar el tipo de renglón
			var strTipoRenglon = '"Existente"';
			//Variables que se utiliza para asignar el id del objeto (input) tipo file
			var strIDCampoArchivo = 'archivo_varios_detalles_polizas_contabilidad_'+renglon;
			//Variables que se utiliza para asignar el id del área (spam) del objeto (input) tipo file
			var strIDCampoArea = 'archivos_area_detalles_detalles_polizas_contabilidad_'+renglon;
			//Variable que se utiliza para asignar las acciones del renglon
			var strAccionesArchivo = '';

			//Si el tipo de acción corresponde a subir_archivo (agregar acciones)
			if(tipoAccion == 'subir_archivo')
			{
				//Descargar archivo(s)
				strAccionesArchivo += "<button class='btn btn-default btn-xs' title='Descargar archivo'" +
										 " onclick='descargar_archivos_detalles_polizas_contabilidad("+renglon+")'>" + 
										 "<span class='glyphicon glyphicon-download-alt'></span></button>";

				//Eliminar archivo(s)
				strAccionesArchivo += "<button class='btn btn-default btn-xs' title='Eliminar archivo'" +
										 " onclick='eliminar_archivo_detalles_polizas_contabilidad("+renglon+","+strTipoRenglon+")'>" + 
										 "<span class='glyphicon glyphicon-export'></span></button>";

				
			}


			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTablaDetalles =  "<button class='btn btn-default btn-xs' title='Editar'" +
											" onclick='editar_renglon_detalles_polizas_contabilidad(this)'>" + 
											"<span class='glyphicon glyphicon-edit'></span></button>" + 
											"<span   class='fileupload-buttonbar'>"+
											"<span class='btn  btn-default btn-xs fileinput-button '>"+
											"<span class='fa fa-upload'></span>"+
											"<span id='"+strIDCampoArea+"'>"+
											"<input name='"+strIDCampoArchivo+"[]' id='"+strIDCampoArchivo+"'"+
											"type='file' multiple accept='text/xml,application/pdf'"+
											"onchange='verificar_extension_archivos_detalles_polizas_contabilidad(this);'>"+
											"</input></span></span></span>"+
											strAccionesArchivo+
											"<button class='btn btn-default btn-xs' title='Eliminar'" +
											" onclick='verificar_renglon_eliminar_detalles_polizas_contabilidad(this)'>" + 
											"<span class='glyphicon glyphicon-trash'></span></button>" + 
											"<button class='btn btn-default btn-xs up' title='Subir'>" + 
											"<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											"<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											"<span class='glyphicon glyphicon-arrow-down'></span></button>";


			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_polizas_contabilidad').getElementsByTagName('tbody')[0];
			
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
			    //Variables que se utilizan para asignar valores del detalle
				var intRenglonAnterior = objRen.cells[10].innerHTML;

				//Si se cumple la sentencia
				if(intRenglonAnterior == renglon)
				{
					//Si el tipo de acción corresponde a subir_archivo 
					if(tipoAccion == 'subir_archivo')
					{
						//Modificar nombre de archivo para indicar al usuario que el renglón contiene archivos
						objTabla.rows.namedItem(renglon).cells[8].innerHTML = 'nuevo_archivo';
					}
					else
					{
						//Modificar nombre de archivo para indicar al usuario que el renglón no contiene archivos
						objTabla.rows.namedItem(renglon).cells[8].innerHTML = '';
					}

					//Modificar acciones del registro
					objTabla.rows.namedItem(renglon).cells[5].innerHTML = strAccionesTablaDetalles;
				}

			}

		}

		/*******************************************************************************************************************
		Funciones del modal Diot del Detalle de Póliza
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_diot_detalle_polizas_contabilidad()
		{
			//Incializar formulario
			$('#frmDiotDetallePolizasContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_diot_detalle_polizas_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmDiotDetallePolizasContabilidad').find('input[type=hidden]').val('');
		}	

		//Función que se utiliza para abrir el modal
		function abrir_diot_detalle_polizas_contabilidad(renglon)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_diot_detalle_polizas_contabilidad();
			//Variables que se utilizan para asignar los datos del registro
			var strEstatus =  $('#txtEstatus_polizas_contabilidad').val();
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}
			
			//Decrementar indice para obtener la posición del detalle en el arreglo
		    var intRenglon =  parseInt(renglon) - 1;
		    //Crear instancia del objeto Detalle de la póliza
        	objDetallePolizaPolizasContabilidad = new DetallePolizaPolizasContabilidad();
        	//Asignar datos del detalle corespondiente al indice
        	objDetallePolizaPolizasContabilidad = objDetallesPolizaPolizasContabilidad.getDetalle(intRenglon);

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_diot_detalle_polizas_contabilidad').addClass("estatus-"+strEstatus);
		    //Asignar los datos del detalle de la póliza
		    $('#txtRenglonDetalle_diot_detalle_polizas_contabilidad').val(intRenglon);
		    $('#txtCuenta_diot_detalle_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.strCuenta);
		    $('#txtImporte_diot_detalle_polizas_contabilidad').val(objDetallePolizaPolizasContabilidad.intImporte);
		    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
		    $('#txtImporte_diot_detalle_polizas_contabilidad').formatCurrency({ roundToDecimalPlace: 6 });

			//Abrir modal
			objDiotDetallePagosContabilidad = $('#DiotDetallePolizasContabilidadBox').bPopup({
												  appendTo: '#PolizasContabilidadContent', 
				                              	  contentContainer: 'PolizasContabilidadM', 
				                              	  zIndex: 2, 
				                              	  modalClose: false, 
				                              	  modal: true, 
				                              	  follow: [true,false], 
				                              	  followEasing : "linear", 
				                              	  easing: "linear", 
				                             	  modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#txtSerie_diot_detalle_polizas_contabilidad').focus();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_diot_detalle_polizas_contabilidad()
		{
			try {
				//Cerrar modal
				objDiotDetallePagosContabilidad.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_diot_detalle_polizas_contabilidad()
		{

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_diot_detalle_polizas_contabilidad();

			//Validación del formulario de campos obligatorios
			$('#frmDiotDetallePolizasContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strSerie_diot_detalle_polizas_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba una serie'}
											}
										},
										strFolio_diot_detalle_polizas_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba un folio'}
											}
										},
										strProveedor_diot_detalle_polizas_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtProveedorID_diot_detalle_polizas_contabilidad').val() === '')
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
										intPorcentajeIva_diot_detalle_polizas_contabilidad: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IVA
					                                    if($('#txtTasaCuotaIva_diot_detalle_polizas_contabilidad').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una tasa o cuota de IVA existente'
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
			var bootstrapValidator_diot_detalle_polizas_contabilidad = $('#frmDiotDetallePolizasContabilidad').data('bootstrapValidator');
			bootstrapValidator_diot_detalle_polizas_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_diot_detalle_polizas_contabilidad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_diot_detalle_polizas_contabilidad();
				
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_diot_detalle_polizas_contabilidad()
		{
			try
			{
				$('#frmRelacionarFrasDetallePagosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}


		//Función que se utiliza para calcular los importes
		function calcular_importes_diot_detalle_polizas_contabilidad()
		{
			//Variable que se utiliza para asignar el importe del detalle
			var intImporteDetalle = 0;
			//Variable que se utiliza para asignar el importe base
			var intImporteBase = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;

			//Obtenemos los datos de las cajas de texto
			var intPorcentajeIva = $('#txtPorcentajeIva_diot_detalle_polizas_contabilidad').val();
			
            //Verificar que exista porcentaje de IVA
			if(intPorcentajeIva != '')
			{ 
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intImporteDetalle = parseFloat($.reemplazar($("#txtImporte_diot_detalle_polizas_contabilidad").val(), ",", ""));

				//Calcular importe base
				intImporteBase = parseFloat(intImporteDetalle / 1.16);
				//Calcular importe de IVA
				intImporteIva = parseFloat(intImporteDetalle - intImporteBase);
			}

			//Cambiar cantidad a formato moneda
			intImporteBase = formatMoney(intImporteBase, 6, '');
			intImporteIva = formatMoney(intImporteIva, 6, '');

			//Asignar importe total 
			$('#txtImporteBase_diot_detalle_polizas_contabilidad').val(intImporteBase);
			$('#txtImporteIva_diot_detalle_polizas_contabilidad').val(intImporteIva);
		}

		//Función para guardar el detalle del Diot
		function guardar_diot_detalle_polizas_contabilidad()
		{

			//Asignar el renglón del detalle seleccionado
			var intRenglon = $('#txtRenglonDetalle_diot_detalle_polizas_contabilidad').val();

			//Eliminar los detalles Diot de la póliza
			objDetallePolizaPolizasContabilidad.eliminarDetallesDiot(intRenglon);

		    //Array que se utiliza para agregar los detalles Diot del registro
			var arrDiotsDetallePoliza = [];

			//Crear instancia del objeto Detalle Diot
			objDetalleDiotPolizasContabilidad = new DetalleDiotPolizasContabilidad(null, '', '', '', '', '','', '','');
			//Asignar valores 
			objDetalleDiotPolizasContabilidad.intProveedorID = $('#txtProveedorID_diot_detalle_polizas_contabilidad').val();
			objDetalleDiotPolizasContabilidad.strProveedor = $('#txtProveedor_diot_detalle_polizas_contabilidad').val();
			objDetalleDiotPolizasContabilidad.strSerie = $('#txtSerie_diot_detalle_polizas_contabilidad').val();
			objDetalleDiotPolizasContabilidad.strFolio = $('#txtFolio_diot_detalle_polizas_contabilidad').val();
			objDetalleDiotPolizasContabilidad.strReferencia = $('#txtReferencia_diot_detalle_polizas_contabilidad').val();
			objDetalleDiotPolizasContabilidad.intTasaCuotaIva = $('#txtTasaCuotaIva_diot_detalle_polizas_contabilidad').val();
			objDetalleDiotPolizasContabilidad.intPorcentajeIva = $('#txtPorcentajeIva_diot_detalle_polizas_contabilidad').val();
			objDetalleDiotPolizasContabilidad.intImporteBase =  $.reemplazar($('#txtImporteBase_diot_detalle_polizas_contabilidad').val(), ",", "");
			objDetalleDiotPolizasContabilidad.intImporteIva = $.reemplazar($('#txtImporteIva_diot_detalle_polizas_contabilidad').val(), ",", "");

			//Agregar objeto en el array
			arrDiotsDetallePoliza.push(objDetalleDiotPolizasContabilidad);

			//Agregar array con los detalles Diot
            objDetallePolizaPolizasContabilidad.setDetallesDiot(arrDiotsDetallePoliza);

			//Hacer un llamado a la función para cerrar el modal
		    cerrar_diot_detalle_polizas_contabilidad();

		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			
			/*******************************************************************************************************************
			Controles correspondientes al modal Pólizas
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtImporteTotal_polizas_contabilidad').numeric();
		    $('#txtImporte_detalles_polizas_contabilidad').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_polizas_contabilidad').blur(function(){
				$('.moneda_polizas_contabilidad').formatCurrency({ roundToDecimalPlace: 5 });
			});

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_polizas_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
			
			//Deshabilitar tecla enter en formularios (para evitar abrir un modal o evento onclick cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });


	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_polizas_contabilidad').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Verifica que no sea el último elemento del grid
	            	if( row.next().index() != -1 )
	            	{ 
	            		objDetallesPolizaPolizasContabilidad.swap(row.index(), row.next().index() );
	            	}	

	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Verifica que no sea el primer elemento del grid
	            	if( row.prev().index() != -1 )
	            	{ 
	            		objDetallesPolizaPolizasContabilidad.swap(row.prev().index(), row.index() );
	            	}
	            	//Pasar al renglón de arriba
	            	row.prev().before(row);
	            }
				
	        });


	        //Autocomplete para recuperar los datos de una cuenta
	        $('#txtCuenta_detalles_polizas_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaID_detalles_polizas_contabilidad').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/catalogo_cuentas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strTipo: 'polizas'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtCuentaID_detalles_polizas_contabilidad').val(ui.item.data);
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
	        $('#txtCuenta_detalles_polizas_contabilidad').focusout(function(e){
	        	//Si no existe id de la cuenta
	            if($('#txtCuentaID_detalles_polizas_contabilidad').val() == '' ||
	               $('#txtCuenta_detalles_polizas_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCuentaID_detalles_polizas_contabilidad').val('');
	               $('#txtCuenta_detalles_polizas_contabilidad').val('');
	            }
	            
	        });


	        //Validar que exista cuenta cuando se pulse la tecla enter 
			$('#txtCuenta_detalles_polizas_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe cuenta
		            if($('#txtCuentaID_detalles_polizas_contabilidad').val() == '' || $('#txtCuenta_detalles_polizas_contabilidad').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCuenta_detalles_polizas_contabilidad').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtImporte_detalles_polizas_contabilidad').focus();
			   	    }
		        }
		    });


			//Validar que exista importe cuando se pulse la tecla enter 
			$('#txtImporte_detalles_polizas_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe importe
		           if($('#txtImporte_detalles_polizas_contabilidad').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtImporte_detalles_polizas_contabilidad').focus();
			   	    }
			   	    else
			   	    {

			   	   		//Enfocar combobox
					    $('#cmbNaturaleza_detalles_polizas_contabilidad').focus();
			   	    }
		        }
		    });

		   
		    //Validar que exista naturaleza cuando se pulse la tecla enter 
			$("#cmbNaturaleza_detalles_polizas_contabilidad").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe naturaleza
		            if($('#cmbNaturaleza_detalles_polizas_contabilidad').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbNaturaleza_detalles_polizas_contabilidad').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
				   		$('#txtReferencia_detalles_polizas_contabilidad').focus();
			   	    }
		        
		        }  
		    });
		     
		    //Validar que exista referencia cuando se pulse la tecla enter 
			$('#txtReferencia_detalles_polizas_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		   	   		//Enfocar caja de texto
				    $('#txtConcepto_detalles_polizas_contabilidad').focus();
			   	    
		        }
		    });

		    //Validar que exista concepto cuando se pulse la tecla enter 
			$('#txtConcepto_detalles_polizas_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		   	   		//Hacer un llamado a la función para agregar renglón a la tabla
	    			agregar_renglon_detalles_polizas_contabilidad();
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al modal Diot del Detalle de Póliza
			*********************************************************************************************************************/
			$('#txtPorcentajeIva_diot_detalle_polizas_contabilidad').numeric();

			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_diot_detalle_polizas_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorID_diot_detalle_polizas_contabilidad').val('');
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
	              //Asignar valores del registro seleccionado
	              $('#txtProveedorID_diot_detalle_polizas_contabilidad').val(ui.item.data);
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
	        $('#txtProveedor_diot_detalle_polizas_contabilidad').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_diot_detalle_polizas_contabilidad').val() == '' ||
	               $('#txtProveedor_diot_detalle_polizas_contabilidad').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	               	$('#txtProveedorID_diot_detalle_polizas_contabilidad').val('');
	              	$('#txtProveedor_diot_detalle_polizas_contabilidad').val('');
	            }

	        });
	       	
			//Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_diot_detalle_polizas_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_diot_detalle_polizas_contabilidad').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_tasa_cuota/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strImpuesto: 'IVA'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtTasaCuotaIva_diot_detalle_polizas_contabilidad').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la tasa o cuota del impuesto de IVA cuando pierda el enfoque la caja de texto
	        $('#txtPorcentajeIva_diot_detalle_polizas_contabilidad').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_diot_detalle_polizas_contabilidad').val() == '' ||
	               $('#txtPorcentajeIva_diot_detalle_polizas_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_diot_detalle_polizas_contabilidad').val('');
	               $('#txtPorcentajeIva_diot_detalle_polizas_contabilidad').val('');

	               
	            }

	            //Hacer un llamado a la función para calcular los importes
				calcular_importes_diot_detalle_polizas_contabilidad();
	            
	        });



			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_polizas_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_polizas_contabilidad').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_polizas_contabilidad').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_polizas_contabilidad').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_polizas_contabilidad').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_polizas_contabilidad').data('DateTimePicker').maxDate(e.date);
			});

			//Paginación de registros
			$('#pagLinks_polizas_contabilidad').on('click','a',function(event){
				event.preventDefault();
				intPaginaPolizasContabilidad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_polizas_contabilidad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_polizas_contabilidad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_polizas_contabilidad();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_polizas_contabilidad').addClass("estatus-NUEVO");
				//Abrir modal
				 objPolizasContabilidad = $('#PolizasContabilidadBox').bPopup({
												   appendTo: '#PolizasContabilidadContent', 
					                               contentContainer: 'PolizasContabilidadM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar combobox
				$('#cmbTipo_polizas_contabilidad').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_polizas_contabilidad').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_polizas_contabilidad();
		});
	</script>