	<div id="DescuentosProveedoresCuentasPagarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_descuentos_proveedores_cuentas_pagar" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_descuentos_proveedores_cuentas_pagar" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_descuentos_proveedores_cuentas_pagar">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_descuentos_proveedores_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaInicialBusq_descuentos_proveedores_cuentas_pagar"
				                    		name= "strFechaInicialBusq_descuentos_proveedores_cuentas_pagar" 
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
								<label for="txtFechaFinalBusq_descuentos_proveedores_cuentas_pagar">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_descuentos_proveedores_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaFinalBusq_descuentos_proveedores_cuentas_pagar"
				                    		name= "strFechaFinalBusq_descuentos_proveedores_cuentas_pagar" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los proveedores activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
								<input id="txtProveedorIDBusq_descuentos_proveedores_cuentas_pagar" 
									   name="intProveedorIDBusq_descuentos_proveedores_cuentas_pagar"  type="hidden" 
									   value="">
								</input>
								<label for="txtProveedorBusq_descuentos_proveedores_cuentas_pagar">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedorBusq_descuentos_proveedores_cuentas_pagar" 
										name="strProveedorBusq_descuentos_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_descuentos_proveedores_cuentas_pagar">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_descuentos_proveedores_cuentas_pagar" 
								 		name="strEstatusBusq_descuentos_proveedores_cuentas_pagar" tabindex="1">
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
								<label for="txtBusqueda_descuentos_proveedores_cuentas_pagar">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_descuentos_proveedores_cuentas_pagar" 
										name="strBusqueda_descuentos_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_descuentos_proveedores_cuentas_pagar" 
									   name="strImprimirDetalles_descuentos_proveedores_cuentas_pagar" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_descuentos_proveedores_cuentas_pagar"
									onclick="paginacion_descuentos_proveedores_cuentas_pagar();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_descuentos_proveedores_cuentas_pagar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_descuentos_proveedores_cuentas_pagar"
									onclick="reporte_descuentos_proveedores_cuentas_pagar('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_descuentos_proveedores_cuentas_pagar"
									onclick="reporte_descuentos_proveedores_cuentas_pagar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla descuentos a proveedores
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Proveedor"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				 /*
				Definir columnas de la tabla ordenes de compra a relacionar
				*/
				td.movil.b1:nth-of-type(1):before {content: "Referencia"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "T.C."; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Moneda ID"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Tasa Cuota IVA"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "Tasa Cuota IEPS"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Saldo Auxiliar"; font-weight: bold;}
				td.movil.b10:nth-of-type(10):before {content: "Importe Auxiliar"; font-weight: bold;}
				td.movil.b11:nth-of-type(11):before {content: "Tipo IEPS"; font-weight: bold;}
				td.movil.b12:nth-of-type(12):before {content: "Factor IEPS"; font-weight: bold;}
				td.movil.b13:nth-of-type(13):before {content: "Folio"; font-weight: bold;}
				td.movil.b14:nth-of-type(14):before {content: "Moneda"; font-weight: bold;}
				td.movil.b15:nth-of-type(15):before {content: "Fecha"; font-weight: bold;}
				td.movil.b16:nth-of-type(16):before {content: "Fecha Venc."; font-weight: bold;}
				td.movil.b17:nth-of-type(17):before {content: "Módulo"; font-weight: bold;}
				td.movil.b18:nth-of-type(18):before {content: "IVA %"; font-weight: bold;}
				td.movil.b19:nth-of-type(19):before {content: "IEPS %"; font-weight: bold;}
				td.movil.b20:nth-of-type(20):before {content: "Importe"; font-weight: bold;}
				td.movil.b21:nth-of-type(21):before {content: "Saldo"; font-weight: bold;}
				td.movil.b22:nth-of-type(22):before {content: "Vencido"; font-weight: bold;}
				td.movil.b23:nth-of-type(23):before {content: "Seleccionar"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla ordenes de compra a relacionar
				*/
				td.movil.bt1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.bt2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.bt3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.bt4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.bt5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.bt6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.bt7:nth-of-type(7):before {content: ""; font-weight: bold;}
				td.movil.bt8:nth-of-type(8):before {content: ""; font-weight: bold;}
				td.movil.bt9:nth-of-type(9):before {content: "Saldo"; font-weight: bold;}
				td.movil.bt10:nth-of-type(10):before {content: "Vencido"; font-weight: bold;}


				/*
				Definir columnas de la tabla detalles del descuento a proveedor
				*/
				td.movil.c1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.c3:nth-of-type(3):before {content: "Módulo"; font-weight: bold;}
				td.movil.c4:nth-of-type(4):before {content: "Moneda"; font-weight: bold;}
				td.movil.c5:nth-of-type(5):before {content: "T.C."; font-weight: bold;}
				td.movil.c6:nth-of-type(6):before {content: "IVA %"; font-weight: bold;}
				td.movil.c7:nth-of-type(7):before {content: "IEPS %"; font-weight: bold;}
				td.movil.c8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.c9:nth-of-type(9):before {content: "Importe"; font-weight: bold;}
				td.movil.c10:nth-of-type(10):before {content: "Saldo"; font-weight: bold;}
				td.movil.c11:nth-of-type(11):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles del descuento a proveedor
				*/
				td.movil.ct1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.ct2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.ct3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.ct4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.ct5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.ct6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.ct7:nth-of-type(7):before {content: ""; font-weight: bold;}
				td.movil.ct8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.ct9:nth-of-type(9):before {content: "Importe"; font-weight: bold;}
				td.movil.ct10:nth-of-type(10):before {content: "Saldo"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_descuentos_proveedores_cuentas_pagar">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Proveedor</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:15em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_descuentos_proveedores_cuentas_pagar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{proveedor}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_descuentos_proveedores_cuentas_pagar({{descuento_proveedor_id}});"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_descuentos_proveedores_cuentas_pagar({{descuento_proveedor_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_descuentos_proveedores_cuentas_pagar({{descuento_proveedor_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								 <!--Subir varios archivos-->
								<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
									<span class="btn  btn-default btn-xs fileinput-button ">
								    	<span class="fa fa-upload"></span>
										<input name="archivo_varios_descuentos_proveedores_cuentas_pagar{{descuento_proveedor_id}}[]" id="archivo_varios_descuentos_proveedores_cuentas_pagar{{descuento_proveedor_id}}"  type="file" multiple accept="text/xml,application/pdf" 
											   onchange="subir_archivos_grid_descuentos_proveedores_cuentas_pagar({{descuento_proveedor_id}});">
								  		</input>
								    </span>
								</span>
                            	<!--Descargar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_descuentos_proveedores_cuentas_pagar({{descuento_proveedor_id}}, '{{folio}}');" title="Descargar archivo">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
                            	<!--Eliminar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}" 
                            			 onmousedown="eliminar_archivos_descuentos_proveedores_cuentas_pagar({{descuento_proveedor_id}});" title="Eliminar archivo">
                            		<span class="glyphicon glyphicon-export"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_descuentos_proveedores_cuentas_pagar({{descuento_proveedor_id}});" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_descuentos_proveedores_cuentas_pagar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_descuentos_proveedores_cuentas_pagar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		
		<!-- Diseño del modal Descuentos-->
		<div id="DescuentosProveedoresCuentasPagarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_descuentos_proveedores_cuentas_pagar"  class="ModalBodyTitle">
			<h1>Descuentos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmDescuentosProveedoresCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmDescuentosProveedoresCuentasPagar"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtDescuentoProveedorID_descuentos_proveedores_cuentas_pagar" 
										   name="intDescuentoProveedorID_descuentos_proveedores_cuentas_pagar" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
									<input id="txtEstatus_descuentos_proveedores_cuentas_pagar" 
										   name="strEstatus_descuentos_proveedores_cuentas_pagar" type="hidden" value="">
									</input>
									<label for="txtFolio_descuentos_proveedores_cuentas_pagar">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_descuentos_proveedores_cuentas_pagar" 
											name="strFolio_descuentos_proveedores_cuentas_pagar" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_descuentos_proveedores_cuentas_pagar">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_descuentos_proveedores_cuentas_pagar'>
					                    <input class="form-control" id="txtFecha_descuentos_proveedores_cuentas_pagar"
					                    		name= "strFecha_descuentos_proveedores_cuentas_pagar" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Combobox que contiene las monedas activas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbMonedaID_descuentos_proveedores_cuentas_pagar">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_descuentos_proveedores_cuentas_pagar" 
									 		name="intMonedaID_descuentos_proveedores_cuentas_pagar" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_descuentos_proveedores_cuentas_pagar">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_descuentos_proveedores_cuentas_pagar" id="txtTipoCambio_descuentos_proveedores_cuentas_pagar" 
											name="intTipoCambio_descuentos_proveedores_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11">
									</input>
								</div>
							</div>
						</div>
					</div>
				    <div class="row">
						<!--Referencia-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtReferencia_descuentos_proveedores_cuentas_pagar">Folio proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtReferencia_descuentos_proveedores_cuentas_pagar" 
											name="strReferencia_descuentos_proveedores_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese folio" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los proveedores activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
									<input id="txtProveedorID_descuentos_proveedores_cuentas_pagar" 
										   name="intProveedorID_descuentos_proveedores_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta para recuperar la razón social del proveedor seleccionado-->
									<input id="txtRazonSocial_descuentos_proveedores_cuentas_pagar" 
										   name="strRazonSocial_descuentos_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el rfc del proveedor seleccionado-->
									<input id="txtRfc_descuentos_proveedores_cuentas_pagar" 
										   name="strRfc_descuentos_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar la calle del proveedor seleccionado-->
									<input id="txtCalle_descuentos_proveedores_cuentas_pagar" 
										   name="strCalle_descuentos_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el número exterior del proveedor seleccionado-->
									<input id="txtNumeroExterior_descuentos_proveedores_cuentas_pagar" 
										   name="strNumeroExterior_descuentos_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el número interior del proveedor seleccionado-->
									<input id="txtNumeroInterior_descuentos_proveedores_cuentas_pagar" 
										   name="strNumeroInterior_descuentos_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el código postal del proveedor seleccionado-->
									<input id="txtCodigoPostal_descuentos_proveedores_cuentas_pagar" 
										   name="strCodigoPostal_descuentos_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar la colonia del proveedor seleccionado-->
									<input id="txtColonia_descuentos_proveedores_cuentas_pagar" 
										   name="strColonia_descuentos_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar la localidad del proveedor seleccionado-->
									<input id="txtLocalidad_descuentos_proveedores_cuentas_pagar" 
										   name="strLocalidad_descuentos_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el municipio del proveedor seleccionado-->
									<input id="txtMunicipio_descuentos_proveedores_cuentas_pagar" 
										   name="strMunicipio_descuentos_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el estado del proveedor seleccionado-->
									<input id="txtEstado_descuentos_proveedores_cuentas_pagar" 
										   name="strEstado_descuentos_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el país del proveedor seleccionado-->
									<input id="txtPais_descuentos_proveedores_cuentas_pagar" 
										   name="strPais_descuentos_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<label for="txtProveedor_descuentos_proveedores_cuentas_pagar">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_descuentos_proveedores_cuentas_pagar" 
											name="strProveedor_descuentos_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Monto-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMonto_descuentos_proveedores_cuentas_pagar">Monto</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_descuentos_proveedores_cuentas_pagar" id="txtMonto_descuentos_proveedores_cuentas_pagar" 
												name="intMonto_descuentos_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="14">
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
									<label for="txtObservaciones_descuentos_proveedores_cuentas_pagar">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_descuentos_proveedores_cuentas_pagar" 
											name="strObservaciones_descuentos_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
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
										<input id="txtNumDetalles_descuentos_proveedores_cuentas_pagar" 
												   name="intNumDetalles_descuentos_proveedores_cuentas_pagar" type="hidden" value="">
										</input>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles del descuento</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Botones-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="btn-group pull-right">
															<!--Buscar documentos a relacionar para agregarlos en la tabla-->
															<button class="btn btn-primary" 
							                                			id="btnBuscarDoc_descuentos_proveedores_cuentas_pagar" 
							                                			onclick="abrir_relacionar_oc_descuentos_proveedores_cuentas_pagar();" 
							                                	     	title="Buscar documento" tabindex="1"> 
							                                		<span class="glyphicon glyphicon-search"></span>
							                                		 Relacionar documento
							                                </button>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<!--Folio-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la referencia seleccionada-->
																<input id="txtReferenciaID_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																	   name="intReferenciaID_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar el saldo de la orden de compra-->
                                                                <input id="txtSaldoOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
                                                                       name="intSaldoOrden_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                  <!-- Caja de texto oculta que se utiliza para recuperar el id de la moneda de la referencia seleccionada-->
																<input id="txtMonedaID_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																	   name="intMonedaID_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta que se utiliza para recuperar el id de la tasa del impuesto de IVA de la referencia seleccionada-->
																<input id="txtTasaCuotaIvaOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																	   name="intTasaCuotaIvaOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta que se utiliza para recuperar el id de la tasa del impuesto de IEPS de la referencia seleccionada-->
															    <input id="txtTasaCuotaIepsOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																	   name="intTasaCuotaIepsOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar"  
																	   type="hidden" value="">
															    </input>
																<label for="txtReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">
																	Folio
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																		name="strReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Fecha-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtFecha_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">Fecha</label>
															</div>
															<div  class="col-md-12">
																<div class='input-group date'>
												                    <input class="form-control" id="txtFecha_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar"
												                    		name= "strFecha_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
												                    		type="text" value="" disabled />
												                    <span class="input-group-addon">
												                        <span class="glyphicon glyphicon-calendar"></span>
												                    </span>
												                </div>
															</div>
														</div>
													</div>
													<!--Tipo de referencia-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtTipoReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">Módulo</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtTipoReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																		name="strTipoReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Moneda-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtMonedaTipo_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">
																	Moneda
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtMonedaTipo_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																		name="strMonedaTipo_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Tipo de cambio-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtTipoCambio_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">Tipo de cambio</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtTipoCambio_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																		name="strTipoCambio_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Subtotal-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtSubtotalOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">Subtotal</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtSubtotalOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																		name="intSubtotalOrdenCompraCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--IVA-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIvaOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">IVA</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtIvaOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																		name="intIvaOrdenCompraCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--IEPS-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIepsOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">
																	IEPS
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtIepsOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																		name="intIepsOrdenCompraCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																		type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Total-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtImporteTotal_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">Total</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtImporteTotal_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																		name="intImporteTotal_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control porcentaje_descuentos_proveedores_cuentas_pagar" id="txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" 
																		name="intPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar" type="text" value="" 
																		tabindex="1" placeholder="Ingrese descuento" maxlength="9">
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_descuentos_proveedores_cuentas_pagar"
					                                			onclick="agregar_renglon_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();" 
					                                	     	title="Agregar" tabindex="1"> 
					                                		<span class="glyphicon glyphicon-plus"></span>
					                                	</button>
					                             	</div>
												</div>
											</div>
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row ">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_descuentos_proveedores_cuentas_pagar">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Folio</th>
																<th class="movil">Fecha</th>
																<th class="movil">Módulo</th>
																<th class="movil">Moneda</th>
																<th class="movil">T.C.</th>
																<th class="movil">IVA %</th>
																<th class="movil">IEPS %</th>
																<th class="movil">Total</th>
																<th class="movil">Desc.</th>
																<th class="movil">Saldo</th>
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
																<td class="movil ct7"></td>
																<td class="movil ct8">
																	<strong id="acumTotalOrden_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">$0.00</strong>
																</td>
																<td class="movil ct9">
																	<strong id="acumDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">$0.00</strong>
																</td>
																<td class="movil ct10">
																	<strong id="acumSaldoOrden_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar">$0.00</strong>
																	<strong id="monedaDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar"></strong>
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
																<strong id="numElementos_detalles_descuentos_proveedores_cuentas_pagar">0</strong> encontrados
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
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_descuentos_proveedores_cuentas_pagar"  
									onclick="validar_descuentos_proveedores_cuentas_pagar();"  title="Guardar" 
									tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_descuentos_proveedores_cuentas_pagar"  
									onclick="reporte_registro_descuentos_proveedores_cuentas_pagar('');"  title="Imprimir registro en PDF" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Subir varios archivos-->
		                    <span  class="fileupload-buttonbar" tabindex="4">
		                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_descuentos_proveedores_cuentas_pagar" disabled>
		                        	<span class="fa fa-upload"></span>
		                        	<input id="archivo_varios_descuentos_proveedores_cuentas_pagar" 
		                        		   name="archivo_varios_descuentos_proveedores_cuentas_pagar[]" type="file" multiple 
		                        		   accept="text/xml,application/pdf" onchange="subir_archivos_modal_descuentos_proveedores_cuentas_pagar('Editar');">
		                        	</input>
		                        </span>
		                    </span>
		                    <!--Descargar archivo-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_descuentos_proveedores_cuentas_pagar"  
									onclick="descargar_archivos_descuentos_proveedores_cuentas_pagar('','');"  title="Descargar archivo" tabindex="5" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Eliminar archivo-->
							<button class="btn btn-default" id="btnEliminarArchivo_descuentos_proveedores_cuentas_pagar"  
									onclick="eliminar_archivos_descuentos_proveedores_cuentas_pagar('')"  title="Eliminar archivo" tabindex="6" disabled>
								<span class="glyphicon glyphicon-export"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_descuentos_proveedores_cuentas_pagar"  
									onclick="cambiar_estatus_descuentos_proveedores_cuentas_pagar('');"  title="Desactivar" tabindex="7" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_descuentos_proveedores_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_descuentos_proveedores_cuentas_pagar();" 
									title="Cerrar"  tabindex="8">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Descuentos-->

		<!-- Diseño del modal Relacionar Documentos (ordenes de compra) del Descuento-->
		<div id="RelacionarOCDescuentosProveedoresCuentasPagarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_oc_descuentos_proveedores_cuentas_pagar" class="ModalBodyTitle">
			<h1>Ordenes de Compra con Adeudo</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarOCDescuentosProveedoresCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarOCDescuentosProveedoresCuentasPagar"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Proveedor-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
									<input id="txtProveedorIDBusq_relacionar_oc_descuentos_proveedores_cuentas_pagar" 
										   name="intProveedorIDBusq_relacionar_oc_descuentos_proveedores_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<label for="txtProveedorBusq_relacionar_oc_descuentos_proveedores_cuentas_pagar">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtProveedorBusq_relacionar_oc_descuentos_proveedores_cuentas_pagar" 
										   name="strProveedorBusq_relacionar_oc_descuentos_proveedores_cuentas_pagar"  type="text" value="">
									</input>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group row">
						<!--Div que contiene la tabla con las ordenes de compra encontradas-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<!-- Caja de texto oculta para asignar el número de registros de la tabla ordenes de compra a relacionar--> 
							<input id="txtNumOC_relacionar_oc_descuentos_proveedores_cuentas_pagar" 
								   name="intNumOC_relacionar_oc_descuentos_proveedores_cuentas_pagar" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_oc_descuentos_proveedores_cuentas_pagar">
								<thead class="movil">
									<tr class="movil">
										<th class="movil">Folio</th>
										<th class="movil">Moneda</th>
										<th class="movil">Fecha</th>
										<th class="movil">Fecha Venc.</th>
										<th class="movil">Módulo</th>
										<th class="movil">IVA %</th>
										<th class="movil">IEPS %</th>
										<th class="movil">Importe</th>
										<th class="movil">Saldo</th>
										<th class="movil">Vencido</th>
										<th class="movil" id="th-acciones" style="width:8em;">Seleccionar</th>
									</tr>
								</thead>
								<tbody class="movil"></tbody>
								<script id="plantilla_relacionar_oc_descuentos_proveedores_cuentas_pagar" type="text/template"> 
								{{#rows}}
									<tr class="movil">  
										<td class="movil-no-mostrar no-mostrar b1">{{referencia_id}}</td>
										<td class="movil-no-mostrar no-mostrar b2">{{tipo_cambio}}</td>
										<td class="movil-no-mostrar no-mostrar b3">{{moneda_id}}</td>
										<td class="movil-no-mostrar no-mostrar b4">{{subtotal}}</td>
										<td class="movil-no-mostrar no-mostrar b5">{{tasa_cuota_iva}}</td>
										<td class="movil-no-mostrar no-mostrar b6">{{iva}}</td>
										<td class="movil-no-mostrar no-mostrar b7">{{tasa_cuota_ieps}}</td>
										<td class="movil-no-mostrar no-mostrar b8">{{ieps}}</td>
										<td class="movil-no-mostrar no-mostrar b9">{{saldo_auxiliar}}</td>
										<td class="movil-no-mostrar no-mostrar b10">{{importe_auxiliar}}</td>
										<td class="movil-no-mostrar no-mostrar b11">{{tipo_ieps}}</td>
										<td class="movil-no-mostrar no-mostrar b12">{{factor_ieps}}</td>
										<td class="movil b13">{{folio}}</td>
										<td class="movil b14">{{moneda_tipo}}</td>
										<td class="movil b15">{{fecha}}</td>
										<td class="movil b16">{{vencimiento}}</td>
										<td class="movil b17">{{tipo_referencia}}</td>
										<td class="movil b18">{{porcentaje_iva}}</td>
										<td class="movil b19">{{porcentaje_ieps}}</td>
										<td class="movil b20">{{importe}}</td>
										<td class="movil b21">{{saldo}}</td>
										<td class="movil b22">{{saldo_vencido}}</td>
										<td class="td-center movil b23"> 
											 <input 	type="checkbox" 
							    		class="form-check-input btn-xs" 
							    		id="chbAgregar_relacionar_oc_descuentos_proveedores_cuentas_pagar" />
										</td>
									</tr>
									{{/rows}}
									{{^rows}}
									<tr class="movil"> 
										<td class="movil" colspan="3"> No se encontraron resultados.</td>
									</tr> 
									{{/rows}}
								</script>
								<tfoot class="movil">
									<tr class="movil">
										<td class="movil bt1">
											<strong>Total</strong>
										</td>
										<td  class="movil bt2"></td>
										<td  class="movil bt3"></td>
										<td  class="movil bt4"></td>
										<td  class="movil bt5"></td>
										<td class="movil bt6"></td>
										<td class="movil bt7"></td>
										<td class="movil bt8"></td>
										<td class="movil bt9">
											<strong id="acumSaldo_relacionar_oc_descuentos_proveedores_cuentas_pagar">$0.00</strong>
										</td>
										<td class="movil bt10">
											<strong  id="acumSaldoVencido_relacionar_oc_descuentos_proveedores_cuentas_pagar">$0.00</strong>
										</td>
										<td class="movil"></td>
									</tr>
									<tr class="movil">
										<td class="movil bt1">
											<strong>Anticipo</strong>
										</td>
										<td  class="movil bt2"></td>
										<td  class="movil bt3"></td>
										<td  class="movil bt4"></td>
										<td class="movil bt5"></td>
										<td class="movil bt6"></td>
										<td class="movil bt7"></td>
										<td class="movil bt8"></td>
										<td class="movil bt9">
											<strong id="acumAntSaldo_relacionar_oc_descuentos_proveedores_cuentas_pagar">$0.00</strong>
										</td>
										<td class="movil bt10">
											<strong  id="acumAntSaldoVencido_relacionar_oc_descuentos_proveedores_cuentas_pagar">$0.00</strong>
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
										<strong id="numElementos_relacionar_oc_descuentos_proveedores_cuentas_pagar">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar ordenes de compra-->
							<button class="btn btn-success" id="btnAgregar_relacionar_oc_descuentos_proveedores_cuentas_pagar"  
									onclick="validar_relacionar_oc_descuentos_proveedores_cuentas_pagar();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_oc_descuentos_proveedores_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_oc_descuentos_proveedores_cuentas_pagar();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar Documentos (ordenes de compra) del Descuento-->
	</div><!--#DescuentosProveedoresCuentasPagarContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_descuentos_proveedores_cuentas_pagar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaDescuentosProveedoresCuentasPagar = 0;
		var strUltimaBusquedaDescuentosProveedoresCuentasPagar = "";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarDescuentosProveedoresCuentasPagar = <?php echo NUM_DECIMALES_MOSTRAR_CUENTAS_PAGAR ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesPrecioUnitBDDescuentosProveedoresCuentasPagar = <?php echo NUM_DECIMALES_PRECIO_UNIT_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesIvaUnitBDDescuentosProveedoresCuentasPagar = <?php echo NUM_DECIMALES_IVA_UNIT_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesIepsUnitBDDescuentosProveedoresCuentasPagar = <?php echo NUM_DECIMALES_IEPS_UNIT_OC_CUENTAS_PAGAR ?>;
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDDescuentosProveedoresCuentasPagar = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseDescuentosProveedoresCuentasPagar = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoDescuentosProveedoresCuentasPagar = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar el código de la moneda seleccionada (del pago)
		var strMonedaDescuentosProveedoresCuentasPagar = "";
		//Variable que se utiliza para asignar objeto del modal Descuentos
		var objDescuentosProveedoresCuentasPagar = null;
		//Variable que se utiliza para asignar objeto del modal Relacionar Documentos (ordenes de compra) del Descuento
		var objRelacionarOCDescuentosProveedoresCuentasPagar = null;


		/*******************************************************************************************************************
		Funciones del objeto ordenes de compra relacionadas (seleccionadas)
		*********************************************************************************************************************/
		// Constructor del objeto ordenes de compra relacionadas (seleccionadas)
		var objOrdenesRelacionadasDescuentosProveedoresCuentasPagar;
		function OrdenesRelacionadasDescuentosProveedoresCuentasPagar(ordenes)
		{
			this.arrOrdenes = ordenes;
		}

		//Función para obtener todas las ordenes de compra seleccionadas del descuento
		OrdenesRelacionadasDescuentosProveedoresCuentasPagar.prototype.getOrdenes = function() {
		    return this.arrOrdenes;
		}

		//Función para agregar una orden de compra al objeto 
		OrdenesRelacionadasDescuentosProveedoresCuentasPagar.prototype.setOrden = function (orden){
			this.arrOrdenes.push(orden);
		}

		//Función para obtener una orden de compra del objeto 
		OrdenesRelacionadasDescuentosProveedoresCuentasPagar.prototype.getOrden = function(index) {
		    return this.arrOrdenes[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto ordenes de compra a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto ordenes de compra a relacionar
		var objOrdenRelacionarDescuentosProveedoresCuentasPagar;

		function OrdenRelacionarDescuentosProveedoresCuentasPagar(referenciaID, tipoReferencia, folio, fecha,
															 monedaID, monedaTipo, tipoCambio, subtotalOrden, 
															 tasaCuotaIvaOrden, porcentajeIva, ivaOrden, 
															 tasaCuotaIepsOrden, porcentajeIeps, iepsOrden, 
															 impOrden,impPagado, saldoInsoluto, saldoOrden, 
															 saldoOrdenAux,impOrdenAux, tipoTasaCuotaIeps, 
															 factorTasaCuotaIeps)
		{
		    this.intReferenciaID = referenciaID;
		    this.strTipoReferencia = tipoReferencia;
		    this.strFolio = folio;
		    this.dteFecha = fecha;
		    this.intMonedaID = monedaID;
		    this.strMonedaTipo = monedaTipo;
		    this.intTipoCambio = tipoCambio;
		    this.intSubtotalOrdenCompra = subtotalOrden;
		    this.intTasaCuotaIvaOrdenCompra = tasaCuotaIvaOrden;
		    this.intPorcentajeIvaOrdenCompra = porcentajeIva;
		    this.intIvaOrdenCompra = ivaOrden;
		    this.intTasaCuotaIepsOrdenCompra = tasaCuotaIepsOrden;
		    this.intPorcentajeIepsOrdenCompra = porcentajeIeps;
		    this.intIepsOrdenCompra = iepsOrden;
		    this.intTotalOrdenCompra = impOrden;
		    this.intDescuento = impPagado;
		    this.intSaldoInsoluto = saldoInsoluto;
		    this.intSaldoOrden = saldoOrden;
		    this.intSaldoOrdenAux = saldoOrdenAux;
		    this.intTotalOrdenCompraAux = impOrdenAux;
		    this.strTipoTasaCuotaIeps = tipoTasaCuotaIeps;
		    this.strFactorTasaCuotaIeps = factorTasaCuotaIeps;
		   
		}

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_descuentos_proveedores_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_pagar/descuentos_proveedores/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_descuentos_proveedores_cuentas_pagar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosDescuentosProveedoresCuentasPagar = data.row;
					//Separar la cadena 
					var arrPermisosDescuentosProveedoresCuentasPagar = strPermisosDescuentosProveedoresCuentasPagar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosDescuentosProveedoresCuentasPagar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosDescuentosProveedoresCuentasPagar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosDescuentosProveedoresCuentasPagar[i]=='GUARDAR') || (arrPermisosDescuentosProveedoresCuentasPagar[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es ADJUNTAR
						else if(arrPermisosDescuentosProveedoresCuentasPagar[i]=='ADJUNTAR')
						{
							//Habilitar el control (botón Adjuntar)
							$('#btnAdjuntar_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
							//Habilitar el control (botón eliminar archivo)
							$('#btnEliminarArchivo_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosDescuentosProveedoresCuentasPagar[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosDescuentosProveedoresCuentasPagar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_descuentos_proveedores_cuentas_pagar();
						}
						else if(arrPermisosDescuentosProveedoresCuentasPagar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
							
						}
						else if(arrPermisosDescuentosProveedoresCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosDescuentosProveedoresCuentasPagar[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosDescuentosProveedoresCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_descuentos_proveedores_cuentas_pagar() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaDescuentosProveedoresCuentasPagar =($('#txtFechaInicialBusq_descuentos_proveedores_cuentas_pagar').val()+$('#txtFechaFinalBusq_descuentos_proveedores_cuentas_pagar').val()+$('#txtProveedorIDBusq_descuentos_proveedores_cuentas_pagar').val()+$('#cmbEstatusBusq_descuentos_proveedores_cuentas_pagar').val()+$('#txtBusqueda_descuentos_proveedores_cuentas_pagar').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaDescuentosProveedoresCuentasPagar != strUltimaBusquedaDescuentosProveedoresCuentasPagar)
			{
				intPaginaDescuentosProveedoresCuentasPagar = 0;
				strUltimaBusquedaDescuentosProveedoresCuentasPagar = strNuevaBusquedaDescuentosProveedoresCuentasPagar;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_pagar/descuentos_proveedores/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_descuentos_proveedores_cuentas_pagar').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_descuentos_proveedores_cuentas_pagar').val()),
					 intProveedorID: $('#txtProveedorIDBusq_descuentos_proveedores_cuentas_pagar').val(),
					 strEstatus: $('#cmbEstatusBusq_descuentos_proveedores_cuentas_pagar').val(),
					 strBusqueda: $('#txtBusqueda_descuentos_proveedores_cuentas_pagar').val(),
					 intPagina: intPaginaDescuentosProveedoresCuentasPagar,
					 strPermisosAcceso: $('#txtAcciones_descuentos_proveedores_cuentas_pagar').val()
					},
					function(data){
						$('#dg_descuentos_proveedores_cuentas_pagar tbody').empty();
						var tmpDescuentosProveedoresCuentasPagar = Mustache.render($('#plantilla_descuentos_proveedores_cuentas_pagar').html(),data);
						$('#dg_descuentos_proveedores_cuentas_pagar tbody').html(tmpDescuentosProveedoresCuentasPagar);
						$('#pagLinks_descuentos_proveedores_cuentas_pagar').html(data.paginacion);
						$('#numElementos_descuentos_proveedores_cuentas_pagar').html(data.total_rows);
						intPaginaDescuentosProveedoresCuentasPagar = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_descuentos_proveedores_cuentas_pagar(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_pagar/descuentos_proveedores/';

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
			if ($('#chbImprimirDetalles_descuentos_proveedores_cuentas_pagar').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_descuentos_proveedores_cuentas_pagar').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_descuentos_proveedores_cuentas_pagar').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial':  $.formatFechaMysql($('#txtFechaInicialBusq_descuentos_proveedores_cuentas_pagar').val()),
										'dteFechaFinal':  $.formatFechaMysql($('#txtFechaFinalBusq_descuentos_proveedores_cuentas_pagar').val()),
										'intProveedorID': $('#txtProveedorIDBusq_descuentos_proveedores_cuentas_pagar').val(),
										'strEstatus': $('#cmbEstatusBusq_descuentos_proveedores_cuentas_pagar').val(), 
										'strBusqueda': $('#txtBusqueda_descuentos_proveedores_cuentas_pagar').val(),
										'strDetalles': $('#chbImprimirDetalles_descuentos_proveedores_cuentas_pagar').val()				
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_descuentos_proveedores_cuentas_pagar(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtDescuentoProveedorID_descuentos_proveedores_cuentas_pagar').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'cuentas_pagar/descuentos_proveedores/get_reporte_registro',
							'data' : {
										'intDescuentoProveedorID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Función para subir archivos de un registro desde el grid view
		function subir_archivos_grid_descuentos_proveedores_cuentas_pagar(descuentoProveedorID)
		{
			//Crear instancia al objeto del formulario
	        var formData = new FormData($("#frmDescuentosProveedoresCuentasPagar")[0]);
			//Agregar campos al objeto del formulario
			formData.append("intDescuentoProveedorID_descuentos_proveedores_cuentas_pagar", descuentoProveedorID);
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDGridDescuentosProveedoresCuentasPagar  = "archivo_varios_descuentos_proveedores_cuentas_pagar"+descuentoProveedorID;
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDGridDescuentosProveedoresCuentasPagar);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDGridDescuentosProveedoresCuentasPagar)[0].files;
			//Variable que se utiliza para asignar la extensión del primer archivo seleccionado
			var strExtensionAnterior = '';
			//Variable que se utiliza para asignar el mensaje de error
			var strMensajeError = '';
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
					formData.append("archivo_varios_descuentos_proveedores_cuentas_pagar[]", document.getElementById(strBotonArchivoIDGridDescuentosProveedoresCuentasPagar).files[intCont]);
				 	
				}
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Limpia ruta del archivo cargado
		        $('#'+strBotonArchivoIDGridDescuentosProveedoresCuentasPagar).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_descuentos_proveedores_cuentas_pagar('error', strMensajeError);
	        }
	        else
	        {
	        	//Hacer un llamado al método del controlador para subir archivos del registro
	            $.ajax({
	                url: 'cuentas_pagar/descuentos_proveedores/subir_archivos',
	                type: "POST",
	                data: formData,
	                contentType: false,
	                processData: false,
	                success: function(data)
	                {
	                    //Limpia ruta del archivo cargado
		         		$('#'+strBotonArchivoIDGridDescuentosProveedoresCuentasPagar).val('');
						//Subida finalizada.
						if (data.resultado)
						{
		         		   //Hacer llamado a la función  para cargar  los registros en el grid
			           	   paginacion_descuentos_proveedores_cuentas_pagar();  
						}
                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    		mensaje_descuentos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
	                }
            	});

	        }

		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_descuentos_proveedores_cuentas_pagar(descuentoProveedorID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intDescuentoProveedorID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(descuentoProveedorID == '')
			{
				intDescuentoProveedorID = $('#txtDescuentoProveedorID_descuentos_proveedores_cuentas_pagar').val();
				strFolio = $('#txtFolio_descuentos_proveedores_cuentas_pagar').val();
			}
			else
			{
				intDescuentoProveedorID = descuentoProveedorID;
				strFolio = folio;
			}


			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'cuentas_pagar/descuentos_proveedores/descargar_archivos',
							'data' : {
										'intDescuentoProveedorID': intDescuentoProveedorID,
										'strFolio': strFolio				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}

		//Función que se utiliza para eliminar los archivos del registro seleccionado
		function eliminar_archivos_descuentos_proveedores_cuentas_pagar(id)
		{

			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;

			//Si no existe id, significa que se eliminara el archivo desde el modal
			if(id == '')
			{
				intID = $('#txtDescuentoProveedorID_descuentos_proveedores_cuentas_pagar').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para eliminar carpeta que contiene los archivos del registro
			$.post('cuentas_pagar/descuentos_proveedores/eliminar_carpeta_registro',
			     {intDescuentoProveedorID: intID
			     },
			     function(data) {
			       
			        if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros en el grid
		          	    paginacion_descuentos_proveedores_cuentas_pagar();
		          	    //Si el id del registro se obtuvo del modal
						if(id == '')
						{
							//Ocultar los siguientes botones
							$('#btnDescargarArchivo_descuentos_proveedores_cuentas_pagar').hide();
							$('#btnEliminarArchivo_descuentos_proveedores_cuentas_pagar').hide();    
						}
			        }
		        	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		       		mensaje_descuentos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
			       
			     },
			    'json');
		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_descuentos_proveedores_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').empty();
					var temp = Mustache.render($('#monedas_descuentos_proveedores_cuentas_pagar').html(), data);
					$('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').html(temp);
				},
				'json');
		}

		/*******************************************************************************************************************
		Funciones del modal Descuentos
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_descuentos_proveedores_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmDescuentosProveedoresCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_descuentos_proveedores_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmDescuentosProveedoresCuentasPagar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_descuentos_proveedores_cuentas_pagar');
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_descuentos_proveedores_cuentas_pagar();
			
			//Habilitar todos los elementos del formulario
			$('#frmDescuentosProveedoresCuentasPagar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_descuentos_proveedores_cuentas_pagar').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtFecha_detalles_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtTipoReferencia_detalles_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtSubtotalOrdenCompra_detalles_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtIvaOrdenCompra_detalles_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtIepsOrdenCompra_detalles_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtImporteTotal_detalles_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtFecha_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtTipoReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtMonedaTipo_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtTipoCambio_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtSubtotalOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtIvaOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtIepsOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtImporteTotal_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");

			//Mostrar los siguientes botones
			$("#btnGuardar_descuentos_proveedores_cuentas_pagar").show();
			$("#btnAdjuntar_descuentos_proveedores_cuentas_pagar").show();
			$('#btnBuscarDoc_descuentos_proveedores_cuentas_pagar').show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_descuentos_proveedores_cuentas_pagar").hide();
			$("#btnDescargarArchivo_descuentos_proveedores_cuentas_pagar").hide();
			$("#btnEliminarArchivo_descuentos_proveedores_cuentas_pagar").hide();
			$("#btnDesactivar_descuentos_proveedores_cuentas_pagar").hide();
			//Deshabilitar botón Buscar ordenes de compra
			$('#btnBuscarDoc_descuentos_proveedores_cuentas_pagar').attr('disabled','-1'); 
		}

		//Función para inicializar elementos del proveedor
		function inicializar_proveedor_descuentos_proveedores_cuentas_pagar()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtRazonSocial_descuentos_proveedores_cuentas_pagar').val('');
            $('#txtRfc_descuentos_proveedores_cuentas_pagar').val('');
            $('#txtCalle_descuentos_proveedores_cuentas_pagar').val('');
            $('#txtNumeroExterior_descuentos_proveedores_cuentas_pagar').val('');
            $('#txtNumeroInterior_descuentos_proveedores_cuentas_pagar').val('');
            $('#txtCodigoPostal_descuentos_proveedores_cuentas_pagar').val('');
            $('#txtColonia_descuentos_proveedores_cuentas_pagar').val('');
            $('#txtLocalidad_descuentos_proveedores_cuentas_pagar').val('');
            $('#txtMunicipio_descuentos_proveedores_cuentas_pagar').val('');
            $('#txtEstado_descuentos_proveedores_cuentas_pagar').val('');
            $('#txtPais_descuentos_proveedores_cuentas_pagar').val('');
            //Deshabilitar botón Buscar ordenes de compra
            $('#btnBuscarDoc_descuentos_proveedores_cuentas_pagar').attr('disabled','-1');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_descuentos_proveedores_cuentas_pagar();
		}

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_descuentos_proveedores_cuentas_pagar() 
		{
			//Hacer un llamado a la función para inicializar elementos de la orden de compra (detalle)
		    inicializar_detalle_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();
			//Eliminar los datos de la tabla detalles del descuento a proveedor
			$('#dg_detalles_descuentos_proveedores_cuentas_pagar tbody').empty();
			$('#numElementos_detalles_descuentos_proveedores_cuentas_pagar').html(0);
			$('#txtNumDetalles_descuentos_proveedores_cuentas_pagar').val('');
			$('#acumTotalOrden_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').html('$0.00');
		    $('#acumDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').html('$0.00');
		    $('#acumSaldoOrden_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').html('$0.00');
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_descuentos_proveedores_cuentas_pagar()
		{
			try {
				
				//Hacer un llamado a la función para cerrar modal Relacionar Documentos (ordenes de compra) del Descuento
				cerrar_relacionar_oc_descuentos_proveedores_cuentas_pagar();
				//Cerrar modal
				objDescuentosProveedoresCuentasPagar.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_descuentos_proveedores_cuentas_pagar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_descuentos_proveedores_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_descuentos_proveedores_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmDescuentosProveedoresCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_descuentos_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_descuentos_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_descuentos_proveedores_cuentas_pagar: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').val()) !== intMonedaBaseIDDescuentosProveedoresCuentasPagar)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoDescuentosProveedoresCuentasPagar)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoDescuentosProveedoresCuentasPagar
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strReferencia_descuentos_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un folio'}
											}
										},
										strProveedor_descuentos_proveedores_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtProveedorID_descuentos_proveedores_cuentas_pagar').val() === '')
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
										intMonto_descuentos_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un importe'}
											}
										},
										intNumDetalles_descuentos_proveedores_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para este descuento.'
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
			var bootstrapValidator_descuentos_proveedores_cuentas_pagar = $('#frmDescuentosProveedoresCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_descuentos_proveedores_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_descuentos_proveedores_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumAbonoOrdenesDescuentosProveedoresCuentasPagar = $.reemplazar($('#acumDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumAbonoOrdenesDescuentosProveedoresCuentasPagar = $.reemplazar(intAcumAbonoOrdenesDescuentosProveedoresCuentasPagar, ",", "");
				var intMontoDescuentosProveedoresCuentasPagar = $.reemplazar($('#txtMonto_descuentos_proveedores_cuentas_pagar').val(), ",", "");

				//Verificar que el importe pagado sea igual al monto
				if(intAcumAbonoOrdenesDescuentosProveedoresCuentasPagar != intMontoDescuentosProveedoresCuentasPagar)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_descuentos_proveedores_cuentas_pagar('error', 'El monto no coincide con los detalles, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_descuentos_proveedores_cuentas_pagar();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_descuentos_proveedores_cuentas_pagar()
		{
			try
			{
				$('#frmDescuentosProveedoresCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_descuentos_proveedores_cuentas_pagar()
		{
			//Obtenemos un array con los datos del archivo
    		var arrArchivoDescuentosProveedoresCuentasPagar = $("#archivo_varios_descuentos_proveedores_cuentas_pagar");

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_descuentos_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrReferencias = [];
			var arrReferenciaID = [];
			var arrImportes = [];
			var arrTasaCuotaIva = [];
			var arrIvas = [];
			var arrTasaCuotaIeps = [];
			var arrIeps = [];
			
			//Variable que se utiliza para asignar la moneda del pago
			var intMonedaIDPago = parseInt($("#cmbMonedaID_descuentos_proveedores_cuentas_pagar").val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variable que se utiliza para asignar el tipo de cambio del pago
				var intTipoCambioPago = parseFloat($("#txtTipoCambio_descuentos_proveedores_cuentas_pagar").val());
				//Variable que se utiliza para asignar el importe
				var intImporte = 0;
				//Variable que se utiliza para asignar el importe de iva
				var intImporteIva = 0;
				//Variable que se utiliza para asignar el importe de ieps
				var intImporteIeps = 0;
				//Variable que se utiliza para asignar porcentaje del impuesto que se va a desglosar
				var intPorcentajeDesglose = 0;
				//Asignar NO para evitar calcular el impuesto de IEPS
				var strCalcularIEPS = 'NO';
				//Variable que se utiliza para asignar el total de impuestos correspondientes al abono
				var intTotalImpuestos = 0;
				//Variable que se utiliza para asignar el total del abono que le corresponde a la tasa
				var intAbonoTasa = 0;
				//Variable que se utiliza para asignar el importe del abono convertido al tipo de cambio pesos mexicanos
				var intAbonoPesos = 0;

				//Variables que se utilizan para asignar los valores del detalle
				var intMonedaID = parseInt(objRen.cells[12].innerHTML);
				var intTipoCambio = parseFloat(objRen.cells[4].innerHTML);
				var intAbono = $.reemplazar(objRen.cells[8].innerHTML, ",", "");
				var intPorcentajeIva = objRen.cells[5].innerHTML;
				var intPorcentajeIeps = objRen.cells[6].innerHTML;
				var strTipoTasaCuotaIeps = objRen.cells[20].innerHTML;
				var strFactorTasaCuotaIeps = objRen.cells[21].innerHTML;
				//Asignar porcentaje de IVA para su desglose
		        intPorcentajeDesglose = parseFloat(intPorcentajeIva);

		        //Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{	
					//Si la tasa de cuota no es de tipo RANGO ni su factor es Cuota
					if(strTipoTasaCuotaIeps !== 'RANGO' && strFactorTasaCuotaIeps !=='Cuota')
					{
						//Convertir cadena de texto a número decimal
						intPorcentajeIeps = parseFloat(intPorcentajeIeps);
						//Incremetar porcentaje de impuestos para su desglose
						intPorcentajeDesglose += intPorcentajeIeps;
						//Asignar SI para calcular el impuesto de IEPS
						strCalcularIEPS = 'SI';
					}
					
				}

				//Calcular porcentaje de impuestos (para su desglose)
			    intPorcentajeDesglose += 1;

			    //Si la moneda del pago es diferente a la moneda de la orden de compra
				if(intMonedaID  !== intMonedaIDPago)
				{
					//Asignar el tipo de cambio de la orden de compra
					intTipoCambioPago = intTipoCambio;
				}

				//Convertir cantidad a pesos mexicanos
			    intAbonoPesos =  intAbono * intTipoCambioPago;

			    //Calcular precio de la referencia (desglosar IVA y/o IEPS)
                intImporte =  intAbonoPesos / intPorcentajeDesglose;

                //Redondear cantidad a decimales
				intImporte = intImporte.toFixed(intNumDecimalesPrecioUnitBDDescuentosProveedoresCuentasPagar);
				intImporte = parseFloat(intImporte);

				//Calcular importe de IVA
	        	intImporteIva = intImporte *  intPorcentajeIva;

	        	//Redondear cantidad a decimales
				intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDDescuentosProveedoresCuentasPagar);
				intImporteIva = parseFloat(intImporteIva);

				//Si se cumple la regla de validación
				if(strCalcularIEPS == 'SI')
				{
					//Calcular importe de IEPS
            		intImporteIeps = intImporte * intPorcentajeIeps;
            		//Redondear cantidad a decimales
					intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDDescuentosProveedoresCuentasPagar);
					intImporteIeps = parseFloat(intImporteIeps);
				}

				//Calcular el total de impuestos por pagar
				intTotalImpuestos = intImporteIva + intImporteIeps;

				//Calcular el total del abono por su tasa (que se va a guardar en la BD)
				intAbonoTasa = intImporte + intTotalImpuestos;
				//Redondear cantidad a decimales
				intAbonoTasa = intAbonoTasa.toFixed(intNumDecimalesPrecioUnitBDDescuentosProveedoresCuentasPagar);
				intAbonoTasa = parseFloat(intAbonoTasa);

				//Verificar que el abono que le corresponde a la tasa no sea distinto al que se ingresa
				if(intAbonoTasa != intAbonoPesos)
				{
					//Calcular precio nuevamente para evitar más decimales 
					intImporte = intAbonoPesos - intTotalImpuestos;
					intImporte = intImporte.toFixed(intNumDecimalesPrecioUnitBDDescuentosProveedoresCuentasPagar);
					intImporte = parseFloat(intImporte);
				}


				//Asignar valores a los arrays
				arrReferencias.push(objRen.cells[2].innerHTML);
				arrReferenciaID.push(objRen.cells[11].innerHTML);
				arrImportes.push(intImporte);
				arrTasaCuotaIva.push(objRen.cells[14].innerHTML);
				arrIvas.push(intImporteIva);
				arrTasaCuotaIeps.push(objRen.cells[16].innerHTML);
				arrIeps.push(intImporteIeps);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_pagar/descuentos_proveedores/guardar',
					{ 
						//Datos del descuento a proveedor
						intDescuentoProveedorID: $('#txtDescuentoProveedorID_descuentos_proveedores_cuentas_pagar').val(),
						strFolioConsecutivo: $('#txtFolio_descuentos_proveedores_cuentas_pagar').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_descuentos_proveedores_cuentas_pagar').val()),
						intMonedaID: $('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').val(),
						intTipoCambio: $('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').val(),
						strReferencia: $('#txtReferencia_descuentos_proveedores_cuentas_pagar').val(),
						intProveedorID: $('#txtProveedorID_descuentos_proveedores_cuentas_pagar').val(),
						strRazonSocial: $('#txtRazonSocial_descuentos_proveedores_cuentas_pagar').val(),
						strRfc: $('#txtRfc_descuentos_proveedores_cuentas_pagar').val(),
						strCalle: $('#txtCalle_descuentos_proveedores_cuentas_pagar').val(),
						strNumeroExterior: $('#txtNumeroExterior_descuentos_proveedores_cuentas_pagar').val(),
						strNumeroInterior: $('#txtNumeroInterior_descuentos_proveedores_cuentas_pagar').val(),
						strCodigoPostal: $('#txtCodigoPostal_descuentos_proveedores_cuentas_pagar').val(),
						strColonia: $('#txtColonia_descuentos_proveedores_cuentas_pagar').val(),
						strLocalidad: $('#txtLocalidad_descuentos_proveedores_cuentas_pagar').val(),
						strMunicipio: $('#txtMunicipio_descuentos_proveedores_cuentas_pagar').val(),
						strEstado: $('#txtEstado_descuentos_proveedores_cuentas_pagar').val(),
						strPais: $('#txtPais_descuentos_proveedores_cuentas_pagar').val(),
						strObservaciones: $('#txtObservaciones_descuentos_proveedores_cuentas_pagar').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_descuentos_proveedores_cuentas_pagar').val(),
						//Datos de los detalles
						strReferencias: arrReferencias.join('|'),
						strReferenciaID: arrReferenciaID.join('|'),
						strImportes: arrImportes.join('|'),
						strTasaCuotaIva: arrTasaCuotaIva.join('|'),
						strIvas: arrIvas.join('|'),
						strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
						strIeps: arrIeps.join('|')
					},
					function(data) {
						if (data.resultado)
						{

							//Si no existe id del descuento, significa que es un nuevo registro   
							if($('#txtDescuentoProveedorID_descuentos_proveedores_cuentas_pagar').val() == '')
							{
							  	//Asignar el id del descuento registrado en la base de datos
                     			$('#txtDescuentoProveedorID_descuentos_proveedores_cuentas_pagar').val(data.descuento_proveedor_id);
                     			//Asignar folio consecutivo
                 				$('#txtFolio_descuentos_proveedores_cuentas_pagar').val(data.folio);
                 			}

             				//Si existen archivos seleccionados
             				if(arrArchivoDescuentosProveedoresCuentasPagar != undefined )
             				{
             					//Hacer un llamado a la función para subir el archivo
	                    		subir_archivos_modal_descuentos_proveedores_cuentas_pagar('Nuevo');
             				}
             				else
             				{
             					//Hacer un llamado a la función para cerrar modal
		                    	cerrar_descuentos_proveedores_cuentas_pagar();
								//Hacer llamado a la función  para cargar  los registros en el grid
		               			paginacion_descuentos_proveedores_cuentas_pagar();  
             				}
         					
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_descuentos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_descuentos_proveedores_cuentas_pagar(tipoMensaje, mensaje)
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
				new $.Zebra_Dialog(mensaje, 
								  {'type': 'information',
								   'title': 'Información',
								   'buttons': [{caption: 'Aceptar',
											 callback: function () {
												//Enfocar caja de texto
												$('#txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').focus();
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
		function cambiar_estatus_descuentos_proveedores_cuentas_pagar(id)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtDescuentoProveedorID_descuentos_proveedores_cuentas_pagar').val();

			}
			else
			{
				intID = id;
			}

			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
					             {'type':     'question',
					              'title':    'Descuentos',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('cuentas_pagar/descuentos_proveedores/set_estatus',
					                                     {intDescuentoProveedorID: intID
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                          	//Hacer llamado a la función  para cargar  los registros en el grid
					                                          	paginacion_descuentos_proveedores_cuentas_pagar();

					                                          	//Si el id del registro se obtuvo del modal
																if(id == '')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_descuentos_proveedores_cuentas_pagar();     
																}
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_descuentos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });
		   
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_descuentos_proveedores_cuentas_pagar(id)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_pagar/descuentos_proveedores/get_datos',
			       {intDescuentoProveedorID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_descuentos_proveedores_cuentas_pagar();
							 //Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				             //Asignar el código de la moneda
	                        strMonedaDescuentosProveedoresCuentasPagar = data.row.codigo_moneda;

	                        //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';

				          	//Recuperar valores
				            $('#txtDescuentoProveedorID_descuentos_proveedores_cuentas_pagar').val(data.row.descuento_proveedor_id);
				            $('#txtFolio_descuentos_proveedores_cuentas_pagar').val(data.row.folio);
				            $('#txtFecha_descuentos_proveedores_cuentas_pagar').val(data.row.fecha);
				            $('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').val(data.row.moneda_id);
				            $('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').val(data.row.tipo_cambio);
				            $('#txtReferencia_descuentos_proveedores_cuentas_pagar').val(data.row.referencia);
				            $('#txtProveedorID_descuentos_proveedores_cuentas_pagar').val(data.row.proveedor_id);
						    $('#txtProveedor_descuentos_proveedores_cuentas_pagar').val(data.row.proveedor);
						    $('#txtRazonSocial_descuentos_proveedores_cuentas_pagar').val(data.row.razon_social);
						    $('#txtRfc_descuentos_proveedores_cuentas_pagar').val(data.row.rfc);
						    $('#txtCalle_descuentos_proveedores_cuentas_pagar').val(data.row.calle);
						    $('#txtNumeroExterior_descuentos_proveedores_cuentas_pagar').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_descuentos_proveedores_cuentas_pagar').val(data.row.numero_interior);
						    $('#txtCodigoPostal_descuentos_proveedores_cuentas_pagar').val(data.row.codigo_postal);
						    $('#txtColonia_descuentos_proveedores_cuentas_pagar').val(data.row.colonia);
						    $('#txtLocalidad_descuentos_proveedores_cuentas_pagar').val(data.row.localidad);
						    $('#txtMunicipio_descuentos_proveedores_cuentas_pagar').val(data.row.municipio);
						    $('#txtEstado_descuentos_proveedores_cuentas_pagar').val(data.row.estado);
						    $('#txtPais_descuentos_proveedores_cuentas_pagar').val(data.row.pais);
						    $('#txtObservaciones_descuentos_proveedores_cuentas_pagar').val(data.row.observaciones);
						    $('#txtEstatus_descuentos_proveedores_cuentas_pagar').val(strEstatus);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_descuentos_proveedores_cuentas_pagar').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_descuentos_proveedores_cuentas_pagar").show();

				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar los siguientes botones
				            	$("#btnDescargarArchivo_descuentos_proveedores_cuentas_pagar").show();
				            	//Si el estatus del registro es ACTIVO
				            	if(strEstatus == 'ACTIVO')
					            {
					            	$('#btnEliminarArchivo_descuentos_proveedores_cuentas_pagar').show();
					            }
				           	}

			            	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
				            {
				            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
													" onclick='editar_renglon_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar(this)'>" + 
													"<span class='glyphicon glyphicon-edit'></span></button>" + 
													"<button class='btn btn-default btn-xs' title='Eliminar'" +
													" onclick='eliminar_renglon_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar(this)'>" + 
													"<span class='glyphicon glyphicon-trash'></span></button>" + 
													"<button class='btn btn-default btn-xs up' title='Subir'>" + 
													"<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													"<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													"<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDDescuentosProveedoresCuentasPagar)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_descuentos_proveedores_cuentas_pagar").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_descuentos_proveedores_cuentas_pagar").attr('disabled','disabled');
							    }

				            	//Mostrar los siguientes botones  
				            	$("#btnDesactivar_descuentos_proveedores_cuentas_pagar").show();
				            	//Habilitar botón Buscar ordenes de compra
								$('#btnBuscarDoc_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
				            }
				            else
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmDescuentosProveedoresCuentasPagar').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_descuentos_proveedores_cuentas_pagar").hide();
				            	$("#btnAdjuntar_descuentos_proveedores_cuentas_pagar").hide();
				            	$("#btnBuscarDoc_descuentos_proveedores_cuentas_pagar").hide();
				            }


				            //Variable que se utiliza para asignar la moneda del pago
						    var intMonedaIDPago = parseInt(data.row.moneda_id);

				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Variable que se utiliza para asignar el tipo de cambio del pago
				            	var intTipoCambioPago = parseFloat(data.row.tipo_cambio);

				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_descuentos_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaFolio = objRenglon.insertCell(0);
								var objCeldaFecha = objRenglon.insertCell(1);
								var objCeldaModulo = objRenglon.insertCell(2);
								var objCeldaMonedaTipo = objRenglon.insertCell(3);
								var objCeldaTipoCambio = objRenglon.insertCell(4);
								var objCeldaPorcentajeIvaOrden = objRenglon.insertCell(5);
								var objCeldaPorcentajeIepsOrden = objRenglon.insertCell(6);
								var objCeldaImpOrden = objRenglon.insertCell(7);
								var objCeldaAbono = objRenglon.insertCell(8);
								var objCeldaSaldoInsoluto = objRenglon.insertCell(9);
								var objCeldaAcciones = objRenglon.insertCell(10);
								//Columnas ocultas
								var objCeldaReferenciaID = objRenglon.insertCell(11);
								var objCeldaMonedaID = objRenglon.insertCell(12);
								var objCeldaSubtotalOrden = objRenglon.insertCell(13);
								var objCeldaTasaCuotaIvaOrden = objRenglon.insertCell(14);
								var objCeldaIvaOrden = objRenglon.insertCell(15);
								var objCeldaTasaCuotaIepsOrden = objRenglon.insertCell(16);
								var objCeldaIepsOrden = objRenglon.insertCell(17);
								var objCeldaSaldoOrden = objRenglon.insertCell(18);
								var objCeldaPorcentajeDescuento = objRenglon.insertCell(19);
								var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(20);
								var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(21);


								//Variables que se utilizan para asignar valores del detalle
								var intReferenciaID = data.detalles[intCon].referencia_id;
								var strTipoReferencia = data.detalles[intCon].referencia;
								var intTasaCuotaIva = data.detalles[intCon].tasa_cuota_iva;
								var intTasaCuotaIeps = data.detalles[intCon].tasa_cuota_ieps;
								var intMonedaID = parseInt(data.detalles[intCon].moneda_id);
								var intTipoCambio = parseFloat(data.detalles[intCon].tipo_cambio);
								var intTotalOrdenCompra = parseFloat(data.detalles[intCon].total_orden);
								var intSaldoOrden = parseFloat(data.detalles[intCon].saldo_orden);
								//Variable que se utiliza para asignar el porcentaje del descuento 
								var intPorcentajeDescuento = 0;
								//Variable que se utiliza para asignar el descuento 
								var intAbono = parseFloat(data.detalles[intCon].abono);
								//Variable que se utiliza para asignar el id del detalle
								var strDetalleID =  intReferenciaID+'_'+strTipoReferencia+'_'+intTasaCuotaIva+'_'+intTasaCuotaIeps;

								//Si la moneda del pago es diferente a la moneda de la orden de compra
								if(intMonedaIDPago !== intMonedaID)
								{
								    //Asignar el tipo de cambio de la orden de compra
									intTipoCambioPago = intTipoCambio;
								}

								//Convertir peso mexicano a tipo de cambio del pago
								intAbono = intAbono / intTipoCambioPago;

								//Incrementar el saldo de la orden de compra
								intSaldoOrden =  intSaldoOrden + intAbono;
								//Redondear cantidad a dos decimales
								intSaldoOrden = intSaldoOrden.toFixed(2);
								intSaldoOrden = parseFloat(intSaldoOrden);

								//Calcular porcentaje del descuento
								intPorcentajeDescuento = (intAbono * 100) / intTotalOrdenCompra;

							
						        //Asignar valores
						        objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', strDetalleID);
								objCeldaFolio.setAttribute('class', 'movil c1');
								objCeldaFolio.innerHTML =  data.detalles[intCon].folio;
								objCeldaFecha.setAttribute('class', 'movil c2');
								objCeldaFecha.innerHTML = data.detalles[intCon].fecha;
								objCeldaModulo.setAttribute('class', 'movil c3');
								objCeldaModulo.innerHTML = strTipoReferencia;
								objCeldaMonedaTipo.setAttribute('class', 'movil c4');
								objCeldaMonedaTipo.innerHTML = data.detalles[intCon].moneda_tipo;
								objCeldaTipoCambio.setAttribute('class', 'movil c5');
								objCeldaTipoCambio.innerHTML =  data.detalles[intCon].tipo_cambio;
								objCeldaPorcentajeIvaOrden.setAttribute('class', 'movil c6');
								objCeldaPorcentajeIvaOrden.innerHTML = data.detalles[intCon].porcentaje_iva;
								objCeldaPorcentajeIepsOrden.setAttribute('class', 'movil c7');
								objCeldaPorcentajeIepsOrden.innerHTML = data.detalles[intCon].porcentaje_ieps;
								objCeldaImpOrden.setAttribute('class', 'movil c8');
								objCeldaImpOrden.innerHTML = formatMoney(data.detalles[intCon].total_orden, 2, '');
								objCeldaAbono.setAttribute('class', 'movil c9');
								objCeldaAbono.innerHTML = formatMoney(intAbono, 2, '');
								objCeldaSaldoInsoluto.setAttribute('class', 'movil c10');
								objCeldaSaldoInsoluto.innerHTML =  formatMoney(data.detalles[intCon].saldo_orden, 2, '');
								objCeldaAcciones.setAttribute('class', 'movil c11');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
								objCeldaReferenciaID.innerHTML = intReferenciaID; 
								objCeldaMonedaID.setAttribute('class', 'no-mostrar');
								objCeldaMonedaID.innerHTML = data.detalles[intCon].moneda_id; 
								objCeldaSubtotalOrden.setAttribute('class', 'no-mostrar');
								objCeldaSubtotalOrden.innerHTML =  formatMoney(data.detalles[intCon].subtotal_orden, intNumDecimalesMostrarDescuentosProveedoresCuentasPagar, '');
								objCeldaTasaCuotaIvaOrden.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIvaOrden.innerHTML = intTasaCuotaIva;
								objCeldaIvaOrden.setAttribute('class', 'no-mostrar');
								objCeldaIvaOrden.innerHTML = formatMoney(data.detalles[intCon].iva_orden, intNumDecimalesMostrarDescuentosProveedoresCuentasPagar, '');
								objCeldaTasaCuotaIepsOrden.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIepsOrden.innerHTML = intTasaCuotaIeps;
								objCeldaIepsOrden.setAttribute('class', 'no-mostrar');
								objCeldaIepsOrden.innerHTML = formatMoney(data.detalles[intCon].ieps_orden, intNumDecimalesMostrarDescuentosProveedoresCuentasPagar, '');
								objCeldaSaldoOrden.setAttribute('class', 'no-mostrar');
								objCeldaSaldoOrden.innerHTML =  intSaldoOrden;
								objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeDescuento.innerHTML =  formatMoney(intPorcentajeDescuento, 6, ''); 
							    objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTipoTasaCuotaIeps.innerHTML =  data.detalles[intCon].tipo_ieps;
								objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaFactorTasaCuotaIeps.innerHTML =  data.detalles[intCon].factor_ieps;
								
				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_descuentos_proveedores_cuentas_pagar tr").length - 2;
							$('#numElementos_detalles_descuentos_proveedores_cuentas_pagar').html(intFilas);
							$('#txtNumDetalles_descuentos_proveedores_cuentas_pagar').val(intFilas);
							
			            	//Abrir modal
				            objDescuentosProveedoresCuentasPagar = $('#DescuentosProveedoresCuentasPagarBox').bPopup({
														  appendTo: '#DescuentosProveedoresCuentasPagarContent', 
							                              contentContainer: 'DescuentosProveedoresCuentasPagarM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar obtener los datos de un proveedor
		function get_datos_proveedor_descuentos_proveedores_cuentas_pagar()
		{
			  //Hacer un llamado al método del controlador para regresar los datos del proveedor
			  $.post('cuentas_pagar/proveedores/get_datos',
			      { 
			      	intProveedorID: $('#txtProveedorID_descuentos_proveedores_cuentas_pagar').val()
			      },
			      function(data) {
			        if(data.row){
			        	//Recuperar valores
			            $('#txtRazonSocial_descuentos_proveedores_cuentas_pagar').val(data.row.razon_social);
			            $('#txtRfc_descuentos_proveedores_cuentas_pagar').val(data.row.rfc);
			            $('#txtCalle_descuentos_proveedores_cuentas_pagar').val(data.row.calle);
			            $('#txtNumeroExterior_descuentos_proveedores_cuentas_pagar').val(data.row.numero_exterior);
			            $('#txtNumeroInterior_descuentos_proveedores_cuentas_pagar').val(data.row.numero_interior);
			            $('#txtCodigoPostal_descuentos_proveedores_cuentas_pagar').val(data.row.codigo_postal);
			            $('#txtColonia_descuentos_proveedores_cuentas_pagar').val(data.row.colonia);
			            $('#txtLocalidad_descuentos_proveedores_cuentas_pagar').val(data.row.localidad);
			            $('#txtMunicipio_descuentos_proveedores_cuentas_pagar').val(data.row.municipio);
			            $('#txtEstado_descuentos_proveedores_cuentas_pagar').val(data.row.estado_rep);
			            $('#txtPais_descuentos_proveedores_cuentas_pagar').val(data.row.pais_rep);
			            //Si existe id de la moneda
			            if($('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').val() !== '' && $('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').val() != '')
			            {
			            	//Habilitar botón Buscar ordenes de compra
			            	$('#btnBuscarDoc_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
			            }
			           
			        }
			    }
			     ,
			    'json');
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_descuentos_proveedores_cuentas_pagar()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').val()) !== intMonedaBaseIDDescuentosProveedoresCuentasPagar)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_descuentos_proveedores_cuentas_pagar").val('');
         		//Deshabilitar botón Buscar ordenes de compra
				$('#btnBuscarDoc_descuentos_proveedores_cuentas_pagar').attr('disabled','-1'); 


				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_descuentos_proveedores_cuentas_pagar').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_descuentos_proveedores_cuentas_pagar").val(data.row.tipo_cambio_sat);
	                        //Habilitar botón Buscar ordenes de compra
	                       	$('#btnBuscarDoc_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
	                      
	                    }
	                  }
	                 ,
	                'json');

	             //Hacer un llamado a la función para calcular totales de la tabla
				 calcular_totales_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();
			}
			
		}

		//Función para subir los archivos de un registro desde el modal
		function subir_archivos_modal_descuentos_proveedores_cuentas_pagar(tipoAccion)
		{
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDDescuentosProveedoresCuentasPagar  = "archivo_varios_descuentos_proveedores_cuentas_pagar";
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDDescuentosProveedoresCuentasPagar);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDDescuentosProveedoresCuentasPagar)[0].files;
			//Variable que se utiliza para asignar la extensión del primer archivo seleccionado
			var strExtensionAnterior = '';
			//Variable que se utiliza para asignar el mensaje de error
			var strMensajeError = '';

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
				 	
				}
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Limpia ruta del archivo cargado
			    $('#'+strBotonArchivoIDDescuentosProveedoresCuentasPagar).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_descuentos_proveedores_cuentas_pagar('error', strMensajeError);
	        }
	        else
	        {
	        	//Si existe id del registro subir los archivos
	        	if($('#txtDescuentoProveedorID_descuentos_proveedores_cuentas_pagar').val() != '')
	        	{
		        	//Crear instancia al objeto del formulario
		        	var formData = new FormData($("#frmDescuentosProveedoresCuentasPagar")[0]);
		        	//Hacer un llamado al método del controlador para subir archivos del registro
		            $.ajax({
		                url: 'cuentas_pagar/descuentos_proveedores/subir_archivos',
		                type: "POST",
		                data: formData,
		                contentType: false,
		                processData: false,
		                success: function(data)
		                {
		                    //Limpia ruta del archivo cargado
			         		$('#'+strBotonArchivoIDDescuentosProveedoresCuentasPagar).val('');
							//Subida finalizada.
							if (data.resultado)
							{
							   //Mostrar los siguientes botones
		                       $('#btnDescargarArchivo_descuentos_proveedores_cuentas_pagar').show();
		                       $("#btnEliminarArchivo_descuentos_proveedores_cuentas_pagar").show();
			         		   //Hacer llamado a la función  para cargar  los registros en el grid
				           	   paginacion_descuentos_proveedores_cuentas_pagar();  
							}

							//Si la acción corresponde a un nuevo registro
		                    if(tipoAccion == 'Nuevo')
		                    {
		                    	//Si el tipo de mensaje es un éxito
				                if(data.tipo_mensaje == 'éxito')
				                {
					                //Hacer un llamado a la función para cerrar modal
					                cerrar_descuentos_proveedores_cuentas_pagar();
					               
				                }
				                else
				                {
				                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    			mensaje_descuentos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
				                }
		                    }
		                    else
		                    {

		                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    		mensaje_descuentos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
		                    }
		                }
	            	});
	            }
	        }
			
		}


		/*******************************************************************************************************************
		Funciones de la tabla ordenes de compra relacionadas
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar()
		{
			//Mostramos las ordenes de compra relacionadas (seleccionadas)
			for (var intCon in objOrdenesRelacionadasDescuentosProveedoresCuentasPagar.getOrdenes()) 
            {
            	//Crear instancia del objeto Orden de compra a relacionar 
            	objOrdenRelacionarDescuentosProveedoresCuentasPagar = new OrdenRelacionarDescuentosProveedoresCuentasPagar();
            	//Asignar datos de la orden de compra corespondiente al indice
            	objOrdenRelacionarDescuentosProveedoresCuentasPagar = objOrdenesRelacionadasDescuentosProveedoresCuentasPagar.getOrden(intCon);
            	
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_detalles_descuentos_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];

			    //Variable que se utiliza para asignar el id del detalle
				var strDetalleID =  objOrdenRelacionarDescuentosProveedoresCuentasPagar.intReferenciaID+'_'+objOrdenRelacionarDescuentosProveedoresCuentasPagar.strTipoReferencia+'_'+objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTasaCuotaIvaOrdenCompra+'_'+objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTasaCuotaIepsOrdenCompra;

				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
				if (!objTabla.rows.namedItem(strDetalleID))
				{
					
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaFolio = objRenglon.insertCell(0);
					var objCeldaFecha = objRenglon.insertCell(1);
					var objCeldaModulo = objRenglon.insertCell(2);
					var objCeldaMonedaTipo = objRenglon.insertCell(3);
					var objCeldaTipoCambio = objRenglon.insertCell(4);
					var objCeldaPorcentajeIvaOrden = objRenglon.insertCell(5);
					var objCeldaPorcentajeIepsOrden = objRenglon.insertCell(6);
					var objCeldaImpOrden = objRenglon.insertCell(7);
					var objCeldaAbono = objRenglon.insertCell(8);
					var objCeldaSaldoInsoluto = objRenglon.insertCell(9);
					var objCeldaAcciones = objRenglon.insertCell(10);
					//Columnas ocultas
					var objCeldaReferenciaID = objRenglon.insertCell(11);
					var objCeldaMonedaID = objRenglon.insertCell(12);
					var objCeldaSubtotalOrden = objRenglon.insertCell(13);
					var objCeldaTasaCuotaIvaOrden = objRenglon.insertCell(14);
					var objCeldaIvaOrden = objRenglon.insertCell(15);
					var objCeldaTasaCuotaIepsOrden = objRenglon.insertCell(16);
					var objCeldaIepsOrden = objRenglon.insertCell(17);
					var objCeldaSaldoOrden = objRenglon.insertCell(18);
					var objCeldaPorcentajeDescuento = objRenglon.insertCell(19);
					var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(20);
					var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(21);

				
					
					//Variable que se utiliza para asignar el porcentaje del descuento 
					var intPorcentajeDescuento = 0;
					//Hacer un llamado a la función para reemplazar ',' por cadena vacia
					var intDescuento = $.reemplazar(objOrdenRelacionarDescuentosProveedoresCuentasPagar.intDescuento, ",", "");
					var intTotalOrdenCompra = $.reemplazar(objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTotalOrdenCompra, ",", "");
					
					
					//Calcular porcentaje del descuento
					intPorcentajeDescuento = (intDescuento * 100) / intTotalOrdenCompra;

					

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strDetalleID);
					objCeldaFolio.setAttribute('class', 'movil c1');
					objCeldaFolio.innerHTML = objOrdenRelacionarDescuentosProveedoresCuentasPagar.strFolio;
					objCeldaFecha.setAttribute('class', 'movil c2');
					objCeldaFecha.innerHTML = objOrdenRelacionarDescuentosProveedoresCuentasPagar.dteFecha;
					objCeldaModulo.setAttribute('class', 'movil c3');
					objCeldaModulo.innerHTML = objOrdenRelacionarDescuentosProveedoresCuentasPagar.strTipoReferencia;
					objCeldaMonedaTipo.setAttribute('class', 'movil c4');
					objCeldaMonedaTipo.innerHTML = objOrdenRelacionarDescuentosProveedoresCuentasPagar.strMonedaTipo;
					objCeldaTipoCambio.setAttribute('class', 'movil c5');
					objCeldaTipoCambio.innerHTML = objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTipoCambio;
					objCeldaPorcentajeIvaOrden.setAttribute('class', 'movil c6');
					objCeldaPorcentajeIvaOrden.innerHTML =  objOrdenRelacionarDescuentosProveedoresCuentasPagar.intPorcentajeIvaOrdenCompra;
					objCeldaPorcentajeIepsOrden.setAttribute('class', 'movil c7');
					objCeldaPorcentajeIepsOrden.innerHTML =  objOrdenRelacionarDescuentosProveedoresCuentasPagar.intPorcentajeIepsOrdenCompra;
					objCeldaImpOrden.setAttribute('class', 'movil c8');
					objCeldaImpOrden.innerHTML = objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTotalOrdenCompra;
					objCeldaAbono.setAttribute('class', 'movil c9');
					objCeldaAbono.innerHTML = objOrdenRelacionarDescuentosProveedoresCuentasPagar.intDescuento;
					objCeldaSaldoInsoluto.setAttribute('class', 'movil c10');
					objCeldaSaldoInsoluto.innerHTML = formatMoney(objOrdenRelacionarDescuentosProveedoresCuentasPagar.intSaldoInsoluto, 2, '');
					objCeldaAcciones.setAttribute('class', 'movil c11');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
					objCeldaReferenciaID.innerHTML = objOrdenRelacionarDescuentosProveedoresCuentasPagar.intReferenciaID; 
					objCeldaMonedaID.setAttribute('class', 'no-mostrar');
					objCeldaMonedaID.innerHTML = objOrdenRelacionarDescuentosProveedoresCuentasPagar.intMonedaID;
					objCeldaSubtotalOrden.setAttribute('class', 'no-mostrar');
					objCeldaSubtotalOrden.innerHTML =  objOrdenRelacionarDescuentosProveedoresCuentasPagar.intSubtotalOrdenCompra;
					objCeldaTasaCuotaIvaOrden.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIvaOrden.innerHTML =  objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTasaCuotaIvaOrdenCompra;
					objCeldaIvaOrden.setAttribute('class', 'no-mostrar');
					objCeldaIvaOrden.innerHTML =  objOrdenRelacionarDescuentosProveedoresCuentasPagar.intIvaOrdenCompra;
					objCeldaTasaCuotaIepsOrden.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIepsOrden.innerHTML =  objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTasaCuotaIepsOrdenCompra;
					objCeldaIepsOrden.setAttribute('class', 'no-mostrar');
					objCeldaIepsOrden.innerHTML =  objOrdenRelacionarDescuentosProveedoresCuentasPagar.intIepsOrdenCompra;
					objCeldaSaldoOrden.setAttribute('class', 'no-mostrar');
					objCeldaSaldoOrden.innerHTML =  objOrdenRelacionarDescuentosProveedoresCuentasPagar.intSaldoOrden;
					objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeDescuento.innerHTML =  formatMoney(intPorcentajeDescuento, 6, ''); 
					objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTipoTasaCuotaIeps.innerHTML =  objOrdenRelacionarDescuentosProveedoresCuentasPagar.strTipoTasaCuotaIeps;
					objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaFactorTasaCuotaIeps.innerHTML =  objOrdenRelacionarDescuentosProveedoresCuentasPagar.strFactorTasaCuotaIeps;
					
				}
            }
           
            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_descuentos_proveedores_cuentas_pagar tr").length - 2;
			$('#numElementos_detalles_descuentos_proveedores_cuentas_pagar').html(intFilas);
			$('#txtNumDetalles_descuentos_proveedores_cuentas_pagar').val(intFilas);
		
			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();
		}

		

		//Función para agregar renglón a la tabla
		function agregar_renglon_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar()
		{
			//Variable que se utiliza para asignar el descuento 
			var intDescuento = 0;
			//Variable que se utiliza para asignar el saldo insoluto
			var intSaldoInsoluto = 0;
			//Variable que se utiliza para asignar el mensaje informativo
			var strMensaje = '';
			//Variable que se utiliza para asignar el porcentaje del saldo de la orden de compra
			var intPorcentajeSaldoOrdenCompra = 0;

			//Variable que se utiliza para asignar la moneda del pago
			var intMonedaIDPago =  parseInt($("#cmbMonedaID_descuentos_proveedores_cuentas_pagar").val());
			var intTipoCambioPago =  parseFloat($("#txtTipoCambio_descuentos_proveedores_cuentas_pagar").val());
			//Obtenemos los datos de las cajas de texto
			var intReferenciaID = $('#txtReferenciaID_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val();
			var strTipoReferencia = $('#txtTipoReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val();
			var intMonedaID = parseInt($('#txtMonedaID_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val());
			var intTipoCambio = parseFloat($('#txtTipoCambio_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val());
			var intSubtotalOrdenCompra = $('#txtSubtotalOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val();
			var intTasaCuotaIvaOrdenCompra = $('#txtTasaCuotaIvaOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val();
			var intTasaCuotaIepsOrdenCompra = $('#txtTasaCuotaIepsOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val();
			 
		    var intTotalOrdenCompra = $('#txtImporteTotal_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val();
			var intSaldoOrden = $('#txtSaldoOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val();
		
			//Variable que se utiliza para asignar el id del detalle
			var strDetalleID = intReferenciaID+'_'+strTipoReferencia+'_'+intTasaCuotaIvaOrdenCompra+'_'+intTasaCuotaIepsOrdenCompra;

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_descuentos_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').focus();
			}
			else
			{
				//Convertir cadena de texto a número decimal
				intSubtotalOrdenCompra =  parseFloat($.reemplazar(intSubtotalOrdenCompra, ",", ""));
		     	intTotalOrdenCompra =  parseFloat($.reemplazar(intTotalOrdenCompra, ",", ""));
				intSaldoOrden =  parseFloat(intSaldoOrden);
				intPorcentajeDescuento =  parseFloat($.reemplazar(intPorcentajeDescuento, ",", ""));
				//Asignar el saldo de la orden de compra convertido al tipo de cambio
				var intSaldoOrdenConv = intSaldoOrden;

				//Si el tipo de moneda del pago corresponde a peso mexicano
				if(intMonedaIDPago === intMonedaBaseIDDescuentosProveedoresCuentasPagar)
				{
					//Si el tipo de moneda de la orden de compra es diferente a la moneda del pago
					if(intMonedaID !== intMonedaIDPago)
					{
						//Convertir importe pagado a peso mexicano
						intSaldoOrdenConv = intSaldoOrdenConv * intTipoCambio;
					}
				}
				else
				{
					//Si el tipo de moneda de la orden de compra corresponde a peso mexicano
					if(intMonedaID === intMonedaBaseIDDescuentosProveedoresCuentasPagar)
					{
						//Convertir importe pagado a tipo de cambio
						intSaldoOrdenConv = intSaldoOrdenConv / intTipoCambioPago;

					}
				}

				
				//Calcular porcentaje del saldo de la orden de compra
				intPorcentajeSaldoOrdenCompra = (intSaldoOrden * 100) / intTotalOrdenCompra;

			    //Redondear cantidad a 6 decimales
			    var intPorcentajeDescuentoConv = intPorcentajeSaldoOrdenCompra.toFixed(6);

				//Verificar que el importe pagado sea menor o igual que el saldo de la orden de compra
				if(intPorcentajeDescuento <= intPorcentajeDescuentoConv)
				{	
					//Hacer un llamado a la función para inicializar elementos del detalle
					inicializar_detalle_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();

				   //Si el porcentaje del descuento es igual al porcentaje auxiliar del saldo de la orden de compra
					if(intPorcentajeDescuentoConv == intPorcentajeDescuento)
					{
						intPorcentajeDescuento = intPorcentajeSaldoOrdenCompra;
					}

					//Calcular descuento de la referencia
					intDescuento = parseFloat(intTotalOrdenCompra * intPorcentajeDescuento) / 100;
				

					//Calcular el saldo insoluto de la orden de compra
					intSaldoInsoluto =  intSaldoOrden  - intDescuento;
					
					//Revisamos si existe el ID proporcionado, si es así, editamos los datos
					if (objTabla.rows.namedItem(strDetalleID))
					{
						objTabla.rows.namedItem(strDetalleID).cells[8].innerHTML =  formatMoney(intDescuento, 2, '');
						objTabla.rows.namedItem(strDetalleID).cells[9].innerHTML =  formatMoney(intSaldoInsoluto, 2, '');
						objTabla.rows.namedItem(strDetalleID).cells[19].innerHTML = formatMoney(intPorcentajeDescuento, 6, '');
					}

					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();

					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').focus();
				}
				else
				{
					//Cambiar cantidad a formato moneda
			    	intPorcentajeDescuentoConv = formatMoney(intPorcentajeDescuentoConv, 6, '');
			    	intSaldoOrdenConv = formatMoney(intSaldoOrdenConv, 2, '');

					//Asignar saldo de la orden de compra
					$('#txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(intPorcentajeDescuentoConv);

					/*Mensaje que se utiliza para informar al usuario que el descuento no debe ser mayor que el saldo de la orden de compra*/
					strMensaje = 'El descuento aplicado sobrepasa el saldo de la orden de compra.';
					strMensaje += '<br>Saldo restante: <b>'+intSaldoOrdenConv+'</b>';
					strMensaje += '<br>Descuento restante: <b>'+intPorcentajeDescuentoConv+'</b>';
					//Hacer un llamado a la función para mostrar mensaje de información
				    mensaje_descuentos_proveedores_cuentas_pagar('informacion', strMensaje);

				}
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_descuentos_proveedores_cuentas_pagar tr").length - 2;
			$('#numElementos_detalles_descuentos_proveedores_cuentas_pagar').html(intFilas);
			$('#txtNumDetalles_descuentos_proveedores_cuentas_pagar').val(intFilas);
		}

		//Función para inicializar elementos del detalle
		function inicializar_detalle_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar() 
		{
			//Limpiar las siguientes cajas de texto
			$('#txtReferenciaID_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
			$('#txtReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
			$('#txtFecha_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtTipoReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtMonedaID_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtMonedaTipo_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtTipoCambio_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtSubtotalOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtTasaCuotaIvaOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtIvaOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtTasaCuotaIepsOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtIepsOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtImporteTotal_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		    $('#txtSaldoOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val('');
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar(objRenglon)
		{
			
			//Asignar los valores a las cajas de texto
			$('#txtReferenciaID_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtFecha_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtTipoReferencia_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtMonedaID_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtMonedaTipo_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtTipoCambio_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			
			$('#txtImporteTotal_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[7].innerHTML);
			$('#txtSubtotalOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtTasaCuotaIvaOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtIvaOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[15].innerHTML);
			$('#txtTasaCuotaIepsOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtIepsOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);
			$('#txtSaldoOrdenCompra_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[18].innerHTML);
			$('#txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[19].innerHTML);
			
			
			//Enfocar caja de texto
			$('#txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_descuentos_proveedores_cuentas_pagar").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_descuentos_proveedores_cuentas_pagar tr").length - 2;
			$('#numElementos_detalles_descuentos_proveedores_cuentas_pagar').html(intFilas);
			$('#txtNumDetalles_descuentos_proveedores_cuentas_pagar').val(intFilas);

		}


		//Función para calcular totales de la tabla
		function calcular_totales_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar()
		{
			//Hacer un llamado a la función para inicializar elementos del detalle
			inicializar_detalle_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();
			//Variable que se utiliza para asignar la moneda del pago
			var intMonedaIDPago =  parseInt($("#cmbMonedaID_descuentos_proveedores_cuentas_pagar").val());
			//Variable que se utiliza para asignar el tipo de cambio del pago
			var intTipoCambioPago =  parseFloat($("#txtTipoCambio_descuentos_proveedores_cuentas_pagar").val());

			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_descuentos_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumTotalOrdenCompra = 0;
			var intAcumAbono = 0;
			var intAcumSaldoOrdenCompra = 0;


			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar los datos de la orden de compra
				var intTipoCambio = parseFloat(objRen.cells[4].innerHTML);
				var intMonedaID = parseInt(objRen.cells[12].innerHTML);

				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intTotalOrdenCompra = $.reemplazar(objRen.cells[7].innerHTML, ",", "");
				var intDescuento = $.reemplazar(objRen.cells[8].innerHTML, ",", "");
				var intSaldoOrden = $.reemplazar(objRen.cells[9].innerHTML, ",", "");
				//Si el tipo de moneda de la orden de compra es diferente a la moneda del pago
				if(intMonedaID !== intMonedaIDPago )
				{
					//Convertir importe a peso mexicano
					intTotalOrdenCompra = intTotalOrdenCompra * intTipoCambio;
					intDescuento = intDescuento * intTipoCambio;
					intSaldoOrden = intSaldoOrden * intTipoCambio;

					//Si el tipo de moneda de la orden de compra corresponde a peso mexicano
				    if(intMonedaID == intMonedaBaseIDDescuentosProveedoresCuentasPagar)
					{
						//Convertir peso mexicano a tipo de cambio
						intTotalOrdenCompra = intTotalOrdenCompra / intTipoCambioPago;
						intDescuento = intDescuento / intTipoCambioPago;
						intSaldoOrden = intSaldoOrden / intTipoCambioPago;
					}
					
				}

				//Incrementar acumulado
				intAcumTotalOrdenCompra += parseFloat(intTotalOrdenCompra);
    			intAcumAbono += parseFloat(intDescuento);
    			intAcumSaldoOrdenCompra += parseFloat(intSaldoOrden);
			}

			//Convertir cantidad a formato moneda
			intAcumTotalOrdenCompra =  '$'+formatMoney(intAcumTotalOrdenCompra, 2, '');
			intAcumAbono =  '$'+formatMoney(intAcumAbono, 2, '');
			intAcumSaldoOrdenCompra =  '$'+formatMoney(intAcumSaldoOrdenCompra, 2, '');

			//Asignar los valores
			$('#acumTotalOrden_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').html(intAcumTotalOrdenCompra);
			$('#acumDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').html(intAcumAbono);
			$('#acumSaldoOrden_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').html(intAcumSaldoOrdenCompra);
			$('#monedaDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').html(strMonedaDescuentosProveedoresCuentasPagar);
		}


		/*******************************************************************************************************************
		Funciones del modal Relacionar Documentos (ordenes de compra) del Descuento
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_oc_descuentos_proveedores_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmRelacionarOCDescuentosProveedoresCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_oc_descuentos_proveedores_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarOCDescuentosProveedoresCuentasPagar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_oc_descuentos_proveedores_cuentas_pagar');
			//Eliminar los datos de la tabla documentos (ordenes de compra) a relacionar
		    $('#dg_relacionar_oc_descuentos_proveedores_cuentas_pagar tbody').empty();
		    $('#numElementos_relacionar_oc_descuentos_proveedores_cuentas_pagar').html(0);
		    $('#acumSaldo_relacionar_oc_descuentos_proveedores_cuentas_pagar').html('$0.00');
		    $('#acumSaldoVencido_relacionar_oc_descuentos_proveedores_cuentas_pagar').html('$0.00');
		    $('#acumAntSaldo_relacionar_oc_descuentos_proveedores_cuentas_pagar').html('$0.00');
		    $('#acumAntSaldoVencido_relacionar_oc_descuentos_proveedores_cuentas_pagar').html('$0.00');
		    //Deshabilitar la siguiente caja de texto
			$('#txtProveedorBusq_relacionar_oc_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled");
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_oc_descuentos_proveedores_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_oc_descuentos_proveedores_cuentas_pagar();
			//Variables que se utilizan para asignar los datos del registro
			var strEstatus =  $('#txtEstatus_descuentos_proveedores_cuentas_pagar').val();
			var strProveedor =  $('#txtProveedor_descuentos_proveedores_cuentas_pagar').val();
			var intProveedorID =  $('#txtProveedorID_descuentos_proveedores_cuentas_pagar').val();

			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_oc_descuentos_proveedores_cuentas_pagar').addClass("estatus-"+strEstatus);
		    //Asignar los datos del proveedor
		    $('#txtProveedorIDBusq_relacionar_oc_descuentos_proveedores_cuentas_pagar').val(intProveedorID);
		    $('#txtProveedorBusq_relacionar_oc_descuentos_proveedores_cuentas_pagar').val(strProveedor);

			//Abrir modal
			objRelacionarOCDescuentosProveedoresCuentasPagar = $('#RelacionarOCDescuentosProveedoresCuentasPagarBox').bPopup({
														  appendTo: '#DescuentosProveedoresCuentasPagarContent', 
						                              	  contentContainer: 'DescuentosProveedoresCuentasPagarM', 
						                              	  zIndex: 2, 
						                              	  modalClose: false, 
						                              	  modal: true, 
						                              	  follow: [true,false], 
						                              	  followEasing : "linear", 
						                              	  easing: "linear", 
						                             	  modalColor: ('#F0F0F0')});

			//Hacer un llamado a la función  para cargar las ordenes de compra con adeudos en el grid
			lista_ordenes_relacionar_oc_descuentos_proveedores_cuentas_pagar();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_oc_descuentos_proveedores_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objRelacionarOCDescuentosProveedoresCuentasPagar.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_oc_descuentos_proveedores_cuentas_pagar()
		{

			//Hacer un llamado a la función para agregar las ordenes de compra seleccionadas al  objeto Ordenes relacionadas
			agregar_ordenes_relacionar_oc_descuentos_proveedores_cuentas_pagar();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_oc_descuentos_proveedores_cuentas_pagar();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarOCDescuentosProveedoresCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumOC_relacionar_oc_descuentos_proveedores_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccionar al menos una orden de compra para este descuento.'
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
			var bootstrapValidator_relacionar_oc_descuentos_proveedores_cuentas_pagar = $('#frmRelacionarOCDescuentosProveedoresCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_relacionar_oc_descuentos_proveedores_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_oc_descuentos_proveedores_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_oc_descuentos_proveedores_cuentas_pagar();
				//Hacer un llamado a la función para agregar las ordenes de compra en la tabla ordenes de compra relacionadas
		  		agregar_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_oc_descuentos_proveedores_cuentas_pagar()
		{
			try
			{
				$('#frmRelacionarOCDescuentosProveedoresCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar ordenes de compra
		*********************************************************************************************************************/
		//Función para la búsqueda de ordenes de compra
		function lista_ordenes_relacionar_oc_descuentos_proveedores_cuentas_pagar() 
		{
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_pagar/pagos_proveedores/get_ordenes_adeudos',
					{	
						intProveedorID: $('#txtProveedorIDBusq_relacionar_oc_descuentos_proveedores_cuentas_pagar').val(), 
						intMonedaIDPago: $('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').val(),
						intTipoCambioPago: $('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').val()
					},
					function(data){
						$('#dg_relacionar_oc_descuentos_proveedores_cuentas_pagar tbody').empty();
						var tmpRelacionarOCDescuentosProveedoresCuentasPagar = Mustache.render($('#plantilla_relacionar_oc_descuentos_proveedores_cuentas_pagar').html(),data);
						$('#numElementos_relacionar_oc_descuentos_proveedores_cuentas_pagar').html(0);
						if(data.rows)
						{

							$('#numElementos_relacionar_oc_descuentos_proveedores_cuentas_pagar').html(data.rows.length);	
						}
						$('#acumSaldo_relacionar_oc_descuentos_proveedores_cuentas_pagar').html(data.acumulado_saldo);
						$('#acumSaldoVencido_relacionar_oc_descuentos_proveedores_cuentas_pagar').html(data.acumulado_saldo_vencido+' '+strMonedaDescuentosProveedoresCuentasPagar);
						$('#acumAntSaldo_relacionar_oc_descuentos_proveedores_cuentas_pagar').html(data.acumulado_anticipos);
						$('#acumAntSaldoVencido_relacionar_oc_descuentos_proveedores_cuentas_pagar').html(data.acumulado_anticipos+' '+strMonedaDescuentosProveedoresCuentasPagar);
						$('#dg_relacionar_oc_descuentos_proveedores_cuentas_pagar tbody').html(tmpRelacionarOCDescuentosProveedoresCuentasPagar);
						
					},
			'json');

			
		}

		//Función para agregar las ordenes de compra seleccionadas al objeto Ordenes de compra relacionadas
		function agregar_ordenes_relacionar_oc_descuentos_proveedores_cuentas_pagar()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
		    //Crear instancia del objeto Facturas relacionadas (seleccionadas)
			objOrdenesRelacionadasDescuentosProveedoresCuentasPagar = new OrdenesRelacionadasDescuentosProveedoresCuentasPagar([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_oc_descuentos_proveedores_cuentas_pagar tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
					//Crear instancia del objeto Orden de compra a relacionar
					objOrdenRelacionarDescuentosProveedoresCuentasPagar = new OrdenRelacionarDescuentosProveedoresCuentasPagar(null, '', '', '',
																													 '', '', '', '', 
																													 '', '', '', 
																													 '', '', '', 
																													 '','', '', '','','','','');
                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intReferenciaID = strValor;
							        break;
							    case 1:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTipoCambio = strValor;
							        break;
							    case 2:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intMonedaID = strValor;
							        break;
							    case 3:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intSubtotalOrdenCompra = strValor;
							        break;
							    case 4:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTasaCuotaIvaOrdenCompra = strValor;
							        break;
							    case 5:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intIvaOrdenCompra = strValor;
							        break;
							    case 6:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTasaCuotaIepsOrdenCompra = strValor;
							        break;
							    case 7:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intIepsOrdenCompra = strValor;
							        break;
							    case 8:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intSaldoOrdenAux = strValor;
							        break;
							    case 9:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTotalOrdenCompraAux = strValor;
							        break;
							    case 10:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.strTipoTasaCuotaIeps = strValor;
							        break;
							    case 11:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.strFactorTasaCuotaIeps = strValor;
							        break;
							    case 12:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.strFolio = strValor;
							        break;
							    case 13:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.strMonedaTipo = strValor;
							        break;
							    case 15:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.dteFecha = strValor;
							        break;
							    case 16:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.strTipoReferencia = strValor;
							        break;
							    case 17:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intPorcentajeIvaOrdenCompra = strValor;
							        break;
							    case 18:
							        objOrdenRelacionarDescuentosProveedoresCuentasPagar.intPorcentajeIepsOrdenCompra = strValor;
							        break;
							    case 19:
							       		objOrdenRelacionarDescuentosProveedoresCuentasPagar.intTotalOrdenCompra = strValor;
							       	break;
							    case 20:
							     		 objOrdenRelacionarDescuentosProveedoresCuentasPagar.intDescuento = strValor;
							       		 objOrdenRelacionarDescuentosProveedoresCuentasPagar.intSaldoInsoluto = 0;
							       		 //Hacer un llamado a la función para reemplazar ',' por cadena vacia
										 objOrdenRelacionarDescuentosProveedoresCuentasPagar.intSaldoOrden = $.reemplazar(strValor, ",", "");
							       	break;
							}
							
					      	intCol++;
					    });

                	//Agregar datos de la orden de compra a relacionar
                	objOrdenesRelacionadasDescuentosProveedoresCuentasPagar.setOrden(objOrdenRelacionarDescuentosProveedoresCuentasPagar);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumOC_relacionar_oc_descuentos_proveedores_cuentas_pagar').val(intContador);

		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Descuentos
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').numeric();
			$('#txtMonto_descuentos_proveedores_cuentas_pagar').numeric();
        	$('#txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_descuentos_proveedores_cuentas_pagar').blur(function(){
				$('.moneda_descuentos_proveedores_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 2 });
			});


			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.000000*/
        	$('.porcentaje_descuentos_proveedores_cuentas_pagar').blur(function(){
				$('.porcentaje_descuentos_proveedores_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 6 });
			});



        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_descuentos_proveedores_cuentas_pagar').blur(function(){
                $('.tipo-cambio_descuentos_proveedores_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_descuentos_proveedores_cuentas_pagar').blur(function(){
                $('.cantidad_descuentos_proveedores_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_descuentos_proveedores_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});

			//Regresar el tipo de cambio de la moneda cuando cambie la fecha
			$('#dteFecha_descuentos_proveedores_cuentas_pagar').on('dp.change', function (e) {
				//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_descuentos_proveedores_cuentas_pagar();
			});

			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').change(function(e){   
	            
	            //Variable que se utiliza para asignar el texto del combobox moneda
				var strMoneda = '';
				//Si existe id de la moneda
             	if($('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').val() !== '')
             	{

             		//Asignar el texto del combobox moneda
				    strMoneda = $('select[name="intMonedaID_descuentos_proveedores_cuentas_pagar"] option:selected').text();
					//Separar cadena para obtener el código de la moneda del descuento
					strMoneda = strMoneda.substr(0,3);

             	}
             	
				//Asignar el código de la moneda del descuento
				strMonedaDescuentosProveedoresCuentasPagar = strMoneda;

	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').val()) === intMonedaBaseIDDescuentosProveedoresCuentasPagar)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_descuentos_proveedores_cuentas_pagar").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').val(intTipoCambioMonedaBaseDescuentosProveedoresCuentasPagar);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 4 });
					//Si existe id del proveedor
	                if($("#txtProveedorID_descuentos_proveedores_cuentas_pagar").val() !== '')
	                {
	                	//Habilitar botón Buscar ordenes de compra
                  		$('#btnBuscarDoc_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
	                }

	                //Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_descuentos_proveedores_cuentas_pagar").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_descuentos_proveedores_cuentas_pagar();
             	}
             	
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoDescuentosProveedoresCuentasPagar)
	        	{
	        		$('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').val(intTipoCambioMaximoDescuentosProveedoresCuentasPagar);
	        	}

	        	//Si no existe tipo de cambio 
	        	if($('#txtTipoCambio_descuentos_proveedores_cuentas_pagar').val() == '' || $('#txtProveedorID_descuentos_proveedores_cuentas_pagar').val() == '' )
	        	{
	        		//Deshabilitar botón  Buscar ordenes de compra
					$('#btnBuscarDoc_descuentos_proveedores_cuentas_pagar').attr("disabled", "disabled"); 
					//Inicializar valores de los acumulados
	         		$('#acumTotalOrden_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').html('$0.00');
	         		$('#acumDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').html('$0.00');
	         		$('#acumSaldoOrden_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').html('$0.00');
	        	}
	        	else
	        	{
	        		//Habilitar botón Buscar ordenes de compra
					$('#btnBuscarDoc_descuentos_proveedores_cuentas_pagar').removeAttr('disabled');
					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();
	        	}

		    });

			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_descuentos_proveedores_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorID_descuentos_proveedores_cuentas_pagar').val('');
	               //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_descuentos_proveedores_cuentas_pagar();
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
	              $('#txtProveedorID_descuentos_proveedores_cuentas_pagar').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos del proveedor
	              get_datos_proveedor_descuentos_proveedores_cuentas_pagar();
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
	        $('#txtProveedor_descuentos_proveedores_cuentas_pagar').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_descuentos_proveedores_cuentas_pagar').val() == '' ||
	               $('#txtProveedor_descuentos_proveedores_cuentas_pagar').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	               	$('#txtProveedorID_descuentos_proveedores_cuentas_pagar').val('');
	              	$('#txtProveedor_descuentos_proveedores_cuentas_pagar').val('');
	                //Hacer un llamado a la función para inicializar elementos del proveedor
	                inicializar_proveedor_descuentos_proveedores_cuentas_pagar();
	            }

	        });
	       	

	        //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_descuentos_proveedores_cuentas_pagar').on('click','button.btn',function(){
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

	
			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		   	    	//Hacer un llamado a la función para agregar renglón a la tabla
   	    			agregar_renglon_ordenes_relacionadas_descuentos_proveedores_cuentas_pagar();
		        }
		    });

			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_descuentos_proveedores_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_descuentos_proveedores_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_descuentos_proveedores_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_descuentos_proveedores_cuentas_pagar').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_descuentos_proveedores_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_descuentos_proveedores_cuentas_pagar').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_descuentos_proveedores_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorIDBusq_descuentos_proveedores_cuentas_pagar').val('');
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
	             $('#txtProveedorIDBusq_descuentos_proveedores_cuentas_pagar').val(ui.item.data);
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
	        $('#txtProveedorBusq_descuentos_proveedores_cuentas_pagar').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorIDBusq_descuentos_proveedores_cuentas_pagar').val() == '' ||
	               $('#txtProveedorBusq_descuentos_proveedores_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorIDBusq_descuentos_proveedores_cuentas_pagar').val('');
	               $('#txtProveedorBusq_descuentos_proveedores_cuentas_pagar').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_descuentos_proveedores_cuentas_pagar').on('click','a',function(event){
				event.preventDefault();
				intPaginaDescuentosProveedoresCuentasPagar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_descuentos_proveedores_cuentas_pagar();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_descuentos_proveedores_cuentas_pagar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_descuentos_proveedores_cuentas_pagar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_descuentos_proveedores_cuentas_pagar').addClass("estatus-NUEVO");
				//Abrir modal
				 objDescuentosProveedoresCuentasPagar = $('#DescuentosProveedoresCuentasPagarBox').bPopup({
												   appendTo: '#DescuentosProveedoresCuentasPagarContent', 
					                               contentContainer: 'DescuentosProveedoresCuentasPagarM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_descuentos_proveedores_cuentas_pagar').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_descuentos_proveedores_cuentas_pagar').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_descuentos_proveedores_cuentas_pagar();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_descuentos_proveedores_cuentas_pagar();
		});
	</script>