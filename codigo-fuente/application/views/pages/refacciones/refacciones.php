	<div id="RefaccionesRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_refacciones_refacciones" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_refacciones_refacciones" 
								   name="strBusqueda_refacciones_refacciones"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_refacciones_refacciones"
										onclick="paginacion_refacciones_refacciones();" 
										title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_refacciones_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_refacciones_refacciones"
									onclick="reporte_refacciones_refacciones('PDF');" title="Imprimir reporte general en PDF"
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_refacciones_refacciones"
									onclick="reporte_refacciones_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla refacciones
				*/
				td.movil.a1:nth-of-type(1):before {content: "Línea"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Código 01"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Código 02"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Código 03"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Código 04"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Descripción"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Servicio"; font-weight: bold;}
				td.movil.a8:nth-of-type(8):before {content: "Estatus"; font-weight: bold;}
				td.movil.a9:nth-of-type(9):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla precios
				*/
				td.movil.b1:nth-of-type(1):before {content: "Lista de precios"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Precio"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_refacciones_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Línea</th>
							<th class="movil">Código 01</th>
							<th class="movil">Código 02</th>
							<th class="movil">Código 03</th>
							<th class="movil">Código 04</th>
							<th class="movil">Descripción</th>
							<th class="movil">Servicio</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_refacciones_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil a1">{{refacciones_linea}}</td>
							<td class="movil a2">{{codigo_01}}</td>
							<td class="movil a3">{{codigo_02}}</td>
						    <td class="movil a4">{{codigo_03}}</td>
						    <td class="movil a5">{{codigo_04}}</td>
							<td class="movil a6">{{descripcion}}</td>
							<td class="movil a7">{{servicio}}</td>
							<td class="movil a8">{{estatus}}</td>
							<td class="td-center movil a9"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_refacciones_refacciones({{refaccion_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_refacciones_refacciones({{refaccion_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_refacciones_refacciones({{refaccion_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_refacciones_refacciones({{refaccion_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_refacciones_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_refacciones_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="RefaccionesRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_refacciones_refacciones"  class="ModalBodyTitle">
			<h1>Refacciones</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_refacciones_refacciones" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_refacciones_refacciones" class="active">
									<a data-toggle="tab" href="#informacion_general_refacciones_refacciones">Información General</a>
								</li>
								<!--Tab que contiene la información de los precios-->
								<li id="tabPrecios_refacciones_refacciones">
									<a data-toggle="tab" href="#precios_refacciones_refacciones">Precios</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmRefaccionesRefacciones" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmRefaccionesRefacciones"  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_refacciones_refacciones" class="tab-pane fade in active">
							<div class="row">
							    <!--Código 01-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtRefaccionID_refacciones_refacciones" 
												   name="intRefaccionID_refacciones_refacciones"  
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el código 01 anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código 01-->
											<input id="txtCodigo01Anterior_refacciones_refacciones" 
												   name="strCodigo01Anterior_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtCodigo01_refacciones_refacciones">Código 01</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigo01_refacciones_refacciones" 
													name="strCodigo01_refacciones_refacciones" type="text" value="" 
													tabindex="1" placeholder="Ingrese código" maxlength="20">
											</input>
										</div>
									</div>
								</div>
								<!--Código 02-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el código 02 anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código 02-->
											<input id="txtCodigo02Anterior_refacciones_refacciones" 
												   name="strCodigo02Anterior_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtCodigo02_refacciones_refacciones">Código 02</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigo02_refacciones_refacciones" 
													name="strCodigo02_refacciones_refacciones" type="text" value="" 
													tabindex="1" placeholder="Ingrese código" maxlength="20">
											</input>
										</div>
									</div>
								</div>
								<!--Código 03-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el código 03 anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código 03-->
											<input id="txtCodigo03Anterior_refacciones_refacciones" 
												   name="strCodigo03Anterior_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtCodigo03_refacciones_refacciones">Código 03</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigo03_refacciones_refacciones" 
													name="strCodigo03_refacciones_refacciones" type="text" value="" 
													tabindex="1" placeholder="Ingrese código" maxlength="20">
											</input>
										</div>
									</div>
								</div>
								<!--Código 04-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el código 04 anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código 04-->
											<input id="txtCodigo04Anterior_refacciones_refacciones" 
												   name="strCodigo04Anterior_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtCodigo04_refacciones_refacciones">Código 04</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigo04_refacciones_refacciones" 
													name="strCodigo04_refacciones_refacciones" type="text" value="" 
													tabindex="1" placeholder="Ingrese código" maxlength="20">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Descripción-->
								<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtDescripcion_refacciones_refacciones">Descripción</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtDescripcion_refacciones_refacciones" 
													name="strDescripcion_refacciones_refacciones" type="text" value="" 
													tabindex="1" placeholder="Ingrese descripción" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Servicio--> 
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12 btn-toolBtns">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" id="chbServicio_refacciones_refacciones" 
												   name="strServicio_refacciones_refacciones" type="checkbox"
												   value="" tabindex="1">
											</input>
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Servicio
				                    	</label>
				                  	</div>
								</div>
						    </div>
						    <div class="row">
								<!--Autocomplete que contiene los productos y servicios activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtProductoServicio_refacciones_refacciones">Código SAT</label>
										</div>
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del producto/servicio seleccionado-->
											<input id="txtProductoServicioID_refacciones_refacciones" 
												   name="intProductoServicioID_refacciones_refacciones"  
												   type="hidden" value="">
										    </input>
											<input  class="form-control" id="txtProductoServicio_refacciones_refacciones" 
													name="strProductoServicio_refacciones_refacciones" type="text" 
													value="" tabindex="1" placeholder="Ingrese código SAT" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las unidades activas-->
								<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtUnidad_refacciones_refacciones">Unidad SAT</label>
										</div>
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la unidad seleccionada-->
											<input id="txtUnidadID_refacciones_refacciones" 
												   name="intUnidadID_refacciones_refacciones"  
												   type="hidden" value="">
										    </input>
											<input  class="form-control" id="txtUnidad_refacciones_refacciones" 
													name="strUnidad_refacciones_refacciones" type="text" 
													value="" tabindex="1" placeholder="Ingrese unidad SAT" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Autocomplete que contiene los MPC (Códigos de Productos de Marketing) activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del MPC seleccionado-->
											<input id="txtMpcID_refacciones_refacciones" 
												   name="intMpcID_refacciones_refacciones"  
												   type="hidden" value="">
										    </input>
											<label for="txtMpc_refacciones_refacciones">MPC</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMpc_refacciones_refacciones" 
													name="strMpc_refacciones_refacciones" type="text" 
													value="" tabindex="1" placeholder="Ingrese MPC" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!-- MPL (Línea de Productos de Marketing)-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMpl_refacciones_refacciones">MPL</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMpl_refacciones_refacciones" 
													name="strMpl_refacciones_refacciones" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--MCD (Descripción de Código de Marketing)-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMcd_refacciones_refacciones">MCD</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMcd_refacciones_refacciones" 
													name="strMcd_refacciones_refacciones" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Autocomplete que contiene las líneas de refacciones activas-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la línea de refacciones seleccionada-->
											<input id="txtRefaccionesLineaID_refacciones_refacciones" 
												   name="intRefaccionesLineaID_refacciones_refacciones"  
												   type="hidden" value="">
										    </input>
											<label for="txtRefaccionesLinea_refacciones_refacciones">Línea</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRefaccionesLinea_refacciones_refacciones" 
													name="strRefaccionesLinea_refacciones_refacciones" type="text" 
													value="" tabindex="1" placeholder="Ingrese línea" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las marcas de refacciones activas-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la marca de refacciones seleccionada-->
											<input id="txtRefaccionesMarcaID_refacciones_refacciones" 
												   name="intRefaccionesMarcaID_refacciones_refacciones"  
												   type="hidden" value="">
										    </input>
											<label for="txtRefaccionesMarca_refacciones_refacciones">Marca</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRefaccionesMarca_refacciones_refacciones" 
													name="strRefaccionesMarca_refacciones_refacciones" type="text" 
													value="" tabindex="1" placeholder="Ingrese marca" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Combobox que contiene las monedas activas-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbMonedaID_refacciones_refacciones">Moneda</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbMonedaID_refacciones_refacciones" 
											 		name="intMonedaID_refacciones_refacciones" tabindex="1">
		                     				</select>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIva_refacciones_refacciones" 
												   name="intTasaCuotaIva_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIva_refacciones_refacciones">IVA %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIva_refacciones_refacciones" 
													name="intPorcentajeIva_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese IVA" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los objetos de impuesto-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObjetoImpuesto_refacciones_refacciones">Objeto de impuesto SAT</label>
										</div>
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del objeto de impuesto seleccionado-->
											<input id="txtObjetoImpuestoID_refacciones_refacciones" 
												   name="intObjetoImpuestoID_refacciones_refacciones"  
												   type="hidden" value="">
										    </input>
											<input  class="form-control" id="txtObjetoImpuesto_refacciones_refacciones" 
													name="strObjetoImpuesto_refacciones_refacciones" type="text" 
													value="" tabindex="1" placeholder="Ingrese objeto de impuesto SAT" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">							
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIeps_refacciones_refacciones" 
												   name="intTasaCuotaIeps_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIeps_refacciones_refacciones">IEPS %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIeps_refacciones_refacciones" 
													name="intPorcentajeIeps_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							 <div class="row">
								<!--Costo planta-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCostoPlanta_refacciones_refacciones">Costo planta</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control moneda_refacciones_refacciones" id="txtCostoPlanta_refacciones_refacciones" 
													name="intCostoPlanta_refacciones_refacciones" type="text" 
													value="" tabindex="1" placeholder="Ingrese costo" maxlength="15">
											</input>
										</div>
									</div>
								</div>
								<!--Costo actual-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtActualCosto_refacciones_refacciones">Costo</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtActualCosto_refacciones_refacciones" 
													name="intActualCosto_refacciones_refacciones" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Existencia actual-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtActualExistencia_refacciones_refacciones">Existencia</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtActualExistencia_refacciones_refacciones" 
													name="intActualExistencia_refacciones_refacciones" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Existencia disponible-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtDisponibleExistencia_refacciones_refacciones">Disponible</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtDisponibleExistencia_refacciones_refacciones" 
													name="intDisponibleExistencia_refacciones_refacciones" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
								<!--Localización-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtLocalizacion_refacciones_refacciones">Localización</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtLocalizacion_refacciones_refacciones" 
													name="strLocalizacion_refacciones_refacciones" type="text" 
													value="" tabindex="1" placeholder="Ingrese localización" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Clasificación planta-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtClasificacionPlanta_refacciones_refacciones">Clasificación planta</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtClasificacionPlanta_refacciones_refacciones" 
													name="strClasificacionPlanta_refacciones_refacciones" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Clasificación-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtClasificacion_refacciones_refacciones">Clasificación</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtClasificacion_refacciones_refacciones" 
													name="strClasificacion_refacciones_refacciones" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Reorden-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtReorden_refacciones_refacciones">Reorden</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtReorden_refacciones_refacciones" 
													name="intReorden_refacciones_refacciones" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Mínimo-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMinimo_refacciones_refacciones">Mínimo</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMinimo_refacciones_refacciones" 
													name="intMinimo_refacciones_refacciones" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Máximo-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMaximo_refacciones_refacciones">Máximo</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMaximo_refacciones_refacciones" 
													name="intMaximo_refacciones_refacciones" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Autocomplete que contiene las refacciones activas-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la refacción seleccionada-->
											<input id="txtRemplazaID_refacciones_refacciones" 
												   name="intRemplazaID_refacciones_refacciones"  
												   type="hidden" value="">
										    </input>
											<label for="txtRemplaza_refacciones_refacciones">Reemplaza</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRemplaza_refacciones_refacciones" 
													name="strRemplaza_refacciones_refacciones" type="text" 
													value="" tabindex="1" placeholder="Ingrese refacción" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Reemplazó-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRemplazo_refacciones_refacciones">Reemplazó</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRemplazo_refacciones_refacciones" 
													name="strRemplazo_refacciones_refacciones" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
						    </div>
					    </div><!--Cierre del contenido del tab - Información General-->
					    <!--Tab - Precios-->
						<div id="precios_refacciones_refacciones" class="tab-pane fade">
							<div class="row">
							    <!--Autocomplete que contiene las listas de precios de refacciones activas-->
								<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la lista de precios de refacciones seleccionada-->
											<input id="txtRefaccionesListaPrecioID_precios_refacciones_refacciones" 
												   name="intRefaccionesListaPrecioID_precios_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtRefaccionesListaPrecio_precios_refacciones_refacciones">
												Lista de precios
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtRefaccionesListaPrecio_precios_refacciones_refacciones" 
													name="strRefaccionesListaPrecio_precios_refacciones_refacciones" 
													type="text" value="" tabindex="1"
													placeholder="Ingrese lista de precios" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Precio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPrecio_precios_refacciones_refacciones">Precio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control moneda_refacciones_refacciones" 
													id="txtPrecio_precios_refacciones_refacciones" 
													name="intPrecio_precios_refacciones_refacciones" 
													type="text" value="" tabindex="1"
													placeholder="Ingrese precio" maxlength="15">
											</input>
										</div>
									</div>
								</div>
								<!--Botón agregar-->
								<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
									<button class="btn btn-primary btn-toolBtns" 
											id="btnAgregar_precios_refacciones_refacciones" 
											onclick="agregar_renglon_precios_refacciones_refacciones();" 
											title="Agregar" tabindex="1">
										<span class="glyphicon glyphicon-plus"></span>
									</button>
								</div>
							</div>
							<div class="form-group row">
								<!--Div que contiene la tabla con los precios encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_precios_refacciones_refacciones">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Lista de precios</th>
												<th class="movil">Precio</th>
												<th class="movil" id="th-acciones" style="width:6em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
									</table>
									<br>
									<div class="row">
										<!--Número de registros encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_precios_refacciones_refacciones">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Precios-->
					</div><!--Cierre del contenedor de tabs-->
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_refacciones_refacciones"  
									onclick="validar_refacciones_refacciones();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_refacciones_refacciones"  
									onclick="cambiar_estatus_refacciones_refacciones('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_refacciones_refacciones"  
									onclick="cambiar_estatus_refacciones_refacciones('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_refacciones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_refacciones_refacciones();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#RefaccionesRefaccionesContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_refacciones_refacciones" type="text/template">
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
		var intPaginaRefaccionesRefacciones = 0;
		var strUltimaBusquedaRefaccionesRefacciones = "";
		//Variable que se utiliza para asignar el id del objeto de impuesto base
		var intObjetoImpuestoBaseIDRefaccionesRefacciones = <?php echo OBJETOIMP_BASE ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objRefaccionesRefacciones = null;	

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/refacciones/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_refacciones_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRefaccionesRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosRefaccionesRefacciones = strPermisosRefaccionesRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRefaccionesRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRefaccionesRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_refacciones_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosRefaccionesRefacciones[i]=='GUARDAR') || (arrPermisosRefaccionesRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_refacciones_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_refacciones_refacciones();
						}
						else if(arrPermisosRefaccionesRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_refacciones_refacciones').removeAttr('disabled');
							$('#btnRestaurar_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_refacciones_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_refacciones_refacciones() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_refacciones_refacciones').val() != strUltimaBusquedaRefaccionesRefacciones)
			{
				intPaginaRefaccionesRefacciones = 0;
				strUltimaBusquedaRefaccionesRefacciones = $('#txtBusqueda_refacciones_refacciones').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/refacciones/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_refacciones_refacciones').val(),
						intPagina:intPaginaRefaccionesRefacciones,
						strPermisosAcceso: $('#txtAcciones_refacciones_refacciones').val()
					},
					function(data){
						$('#dg_refacciones_refacciones tbody').empty();
						var tmpRefaccionesRefacciones = Mustache.render($('#plantilla_refacciones_refacciones').html(),data);
						$('#dg_refacciones_refacciones tbody').html(tmpRefaccionesRefacciones);
						$('#pagLinks_refacciones_refacciones').html(data.paginacion);
						$('#numElementos_refacciones_refacciones').html(data.total_rows);
						intPaginaRefaccionesRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_refacciones_refacciones(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/refacciones/';

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
										'strBusqueda': $('#txtBusqueda_refacciones_refacciones').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_refacciones_refacciones').empty();
					var temp = Mustache.render($('#monedas_refacciones_refacciones').html(), data);
					$('#cmbMonedaID_refacciones_refacciones').html(temp);
				},
				'json');
		}

		//Regresar el impuesto de objeto base
		function cargar_objeto_impuesto_base_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.ajax({
			        url: 'contabilidad/sat_objeto_impuesto/get_datos',
			        method:'post',
			        dataType: 'json',
			        async: false,
			        data: {
			        	strBusqueda:intObjetoImpuestoBaseIDRefaccionesRefacciones,
			       		strTipo: 'id'
			        },
			        success: function (data) {
			          	//Si no se encuentra código 
			        	if(data.row)
			        	{
			        		//Recuperar valores
				            $('#txtObjetoImpuestoID_refacciones_refacciones').val(data.row.objeto_impuesto_id);
				            $('#txtObjetoImpuesto_refacciones_refacciones').val(data.row.codigo+' - '+data.row.descripcion);

			        	}
			        }
			    });
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_refacciones_refacciones()
		{
			//Incializar formulario
			$('#frmRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmRefaccionesRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_refacciones_refacciones();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_refacciones_refacciones');
			
			//Habilitar todos los elementos del formulario
			$('#frmRefaccionesRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Seleccionar tab que contiene la información general
		    $('a[href="#informacion_general_refacciones_refacciones"]').click();
			//Deshabilitar las siguientes cajas de texto
			$("#txtMpl_refacciones_refacciones").attr('disabled','disabled');
			$("#txtMcd_refacciones_refacciones").attr('disabled','disabled');
			$("#txtActualCosto_refacciones_refacciones").attr('disabled','disabled');
			$("#txtReorden_refacciones_refacciones").attr('disabled','disabled');
			$("#txtActualExistencia_refacciones_refacciones").attr('disabled','disabled');
			$("#txtDisponibleExistencia_refacciones_refacciones").attr('disabled','disabled');
			$("#txtMinimo_refacciones_refacciones").attr('disabled','disabled');
			$("#txtMaximo_refacciones_refacciones").attr('disabled','disabled');
			$("#txtClasificacionPlanta_refacciones_refacciones").attr('disabled','disabled');
			$("#txtClasificacion_refacciones_refacciones").attr('disabled','disabled');
			$("#txtRemplazo_refacciones_refacciones").attr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_refacciones_refacciones").show();
			//Habilitar botón Agregar
			$('#btnAgregar_precios_refacciones_refacciones').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnDesactivar_refacciones_refacciones").hide();
			$("#btnRestaurar_refacciones_refacciones").hide();
			
		}


		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		function inicializar_detalles_refacciones_refacciones(){
			//Eliminar los datos de la tabla precios
			$('#dg_precios_refacciones_refacciones tbody').empty();
			$('#numElementos_precios_refacciones_refacciones').html(0);
		}

		//Función para inicializar elementos del MPC (Código de Producto de Marketing)
		function inicializar_mpc_refacciones_refacciones()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#txtMpl_refacciones_refacciones").val('');
            $("#txtMcd_refacciones_refacciones").val('');
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_refacciones_refacciones()
		{
			try {
				//Cerrar modal
				objRefaccionesRefacciones.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_refacciones_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_refacciones_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo01_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba un código'},
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que el código sea único
					                                    if((value ===  $('#txtCodigo02_refacciones_refacciones').val()) || (value ===  $('#txtCodigo03_refacciones_refacciones').val()) || (value ===  $('#txtCodigo04_refacciones_refacciones').val()))
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'El código debe ser único'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCodigo02_refacciones_refacciones: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que el código sea único
					                                    if(value !== '' &&  ((value ===  $('#txtCodigo01_refacciones_refacciones').val()) || (value ===  $('#txtCodigo03_refacciones_refacciones').val()) || (value ===  $('#txtCodigo04_refacciones_refacciones').val())))
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'El código debe ser único'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCodigo03_refacciones_refacciones: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que el código sea único
					                                    if(value !== '' && ((value ===  $('#txtCodigo01_refacciones_refacciones').val()) || (value ===  $('#txtCodigo02_refacciones_refacciones').val()) || (value ===  $('#txtCodigo04_refacciones_refacciones').val())))
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'El código debe ser único'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCodigo04_refacciones_refacciones: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que el código sea único
					                                    if(value !== '' && ((value ===  $('#txtCodigo01_refacciones_refacciones').val()) || (value ===  $('#txtCodigo02_refacciones_refacciones').val()) || (value ===  $('#txtCodigo03_refacciones_refacciones').val())))
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'El código debe ser único'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strDescripcion_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										strProductoServicio_refacciones_refacciones: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del producto/servicio
					                                    if($('#txtProductoServicioID_refacciones_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un código SAT existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strUnidad_refacciones_refacciones: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la unidad
					                                    if($('#txtUnidadID_refacciones_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una unidad SAT existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strObjetoImpuesto_refacciones_refacciones: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del objeto de impuesto
					                                    if($('#txtObjetoImpuestoID_refacciones_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un objeto de impuesto SAT existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMpc_refacciones_refacciones: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del MPC
					                                    if(value !== '' && $('#txtMpcID_refacciones_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un MPC existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strRefaccionesLinea_refacciones_refacciones: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la línea de refacción
					                                    if($('#txtRefaccionesLineaID_refacciones_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una línea existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strRefaccionesMarca_refacciones_refacciones: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la marca de refacción
					                                    if($('#txtRefaccionesMarcaID_refacciones_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una marca existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intMonedaID_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intPorcentajeIva_refacciones_refacciones: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IVA
					                                    if($('#txtTasaCuotaIva_refacciones_refacciones').val() === '')
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
										},
										intPorcentajeIeps_refacciones_refacciones: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IEPS
					                                    if(value != '' && $('#txtTasaCuotaIeps_refacciones_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una tasa o cuota de IEPS existente'
					                                        };
					                                    }

					                                      return true;
					                                  }
					                            }
											}
										},
									    strRemplaza_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la refacción
					                                    if(value !== '' && $('#txtRemplazaID_refacciones_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una refacción existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strRefaccionesListaPrecio_precios_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecio_precios_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_refacciones_refacciones = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_refacciones_refacciones = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_refacciones_refacciones.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_refacciones_refacciones.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_refacciones_refacciones = $('#frmRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_refacciones_refacciones.validate();
			
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_refacciones_refacciones.isValid())
			{
					validar_detalles_refacciones_refacciones();
			}
			else 
				return;
		}

		//Función que se utiliza para validar que los detalles cuenten con precio (mayor a cero)
		function validar_detalles_refacciones_refacciones()
		{	
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_precios_refacciones_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRefaccionesListaPrecioID = [];
			var arrPrecios = [];

			//Array que se utiliza para agregar las listas de precios incorrectas
			var arrDetallesIncorrectos = [];
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var strRefaccionesListaPrecio = objRen.cells[0].innerHTML;
				var intPrecio = parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
			    //Si existe precio
				if(intPrecio > 0)
				{
					//Asignar valores a los arrays
					arrRefaccionesListaPrecioID.push(objRen.getAttribute('id'));
					arrPrecios.push(intPrecio);
				}
				else
				{
					//Agregar refacción en el array, de esta manera, el usuario identificara las listas de precios incorrectas
					arrDetallesIncorrectos.push(strRefaccionesListaPrecio);
				}
			}
			
			//Si existen listas de precios incorrectas
			if(arrDetallesIncorrectos.length > 0)
			{
				//Mensaje que se utiliza para informar al usuario la lista de precios incorrectas
				var strMensaje = 'La refacción  no puede guardarse. Las siguientes <b>listas de precios</b> no tienen precio (0.00):<br>';

				//Hacer recorrido para obtener listas de precios incorrectas
				for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
				{
					//Agregar refacción en el mensaje
            		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
				}

				//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_refacciones_refacciones('error', strMensaje);
			}
			else
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_refacciones_refacciones(arrRefaccionesListaPrecioID, arrPrecios);
			}

		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_refacciones_refacciones()
		{
			try
			{
				$('#frmRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_refacciones_refacciones(arrRefaccionesListaPrecioID, arrPrecios)
		{
			//Si el checkbox servicio se encuentra seleccionado (marcado)
			if ($('#chbServicio_refacciones_refacciones').is(':checked')) {
			    //Asignar SI
			    $('#chbServicio_refacciones_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO 
			   $('#chbServicio_refacciones_refacciones').val('NO');
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/refacciones/guardar',
					{ 
						//Datos de la refacción
						intRefaccionID: $('#txtRefaccionID_refacciones_refacciones').val(),
						strCodigo01: $('#txtCodigo01_refacciones_refacciones').val(),
						strCodigo01Anterior: $('#txtCodigo01Anterior_refacciones_refacciones').val(),
						strCodigo02: $('#txtCodigo02_refacciones_refacciones').val(),
						strCodigo02Anterior: $('#txtCodigo02Anterior_refacciones_refacciones').val(),
						strCodigo03: $('#txtCodigo03_refacciones_refacciones').val(),
						strCodigo03Anterior: $('#txtCodigo03Anterior_refacciones_refacciones').val(),
						strCodigo04: $('#txtCodigo04_refacciones_refacciones').val(),
						strCodigo04Anterior: $('#txtCodigo04Anterior_refacciones_refacciones').val(),
						strDescripcion: $('#txtDescripcion_refacciones_refacciones').val(),
						strServicio: $('#chbServicio_refacciones_refacciones').val(),
						intProductoServicioID: $('#txtProductoServicioID_refacciones_refacciones').val(),
						intUnidadID: $('#txtUnidadID_refacciones_refacciones').val(),
						intObjetoImpuestoID: $('#txtObjetoImpuestoID_refacciones_refacciones').val(),
						intRefaccionesLineaID: $('#txtRefaccionesLineaID_refacciones_refacciones').val(),
						intRefaccionesMarcaID: $('#txtRefaccionesMarcaID_refacciones_refacciones').val(),
						intMpcID: $('#txtMpcID_refacciones_refacciones').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intCostoPlanta: $.reemplazar($('#txtCostoPlanta_refacciones_refacciones').val(), ",", ""),
						intMonedaID: $('#cmbMonedaID_refacciones_refacciones').val(),
						intTasaCuotaIva: $('#txtTasaCuotaIva_refacciones_refacciones').val(),
						intTasaCuotaIeps: $('#txtTasaCuotaIeps_refacciones_refacciones').val(),
						intRemplazaID: $('#txtRemplazaID_refacciones_refacciones').val(),
						//Datos del inventario
						strLocalizacion: $('#txtLocalizacion_refacciones_refacciones').val(),
						//Datos de los precios
						strRefaccionesListaPrecioID: arrRefaccionesListaPrecioID.join('|'),
						strPrecios: arrPrecios.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_refacciones_refacciones();
							//Hacer un llamado a la función para cerrar modal
							cerrar_refacciones_refacciones();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_refacciones_refacciones(tipoMensaje, mensaje, campoID)
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
												 	//Limpiar caja de texto
													$('#'+campoID+'_refacciones_refacciones').val('');
													//Enfocar caja de texto
													$('#'+campoID+'_refacciones_refacciones').focus();
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
		function cambiar_estatus_refacciones_refacciones(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtRefaccionID_refacciones_refacciones').val();

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
						              'title':    'Refacciones',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado a la función para modificar el estatus del registro
													  set_estatus_refacciones_refacciones(intID, strTipo, 'INACTIVO');

						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_refacciones_refacciones(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_refacciones_refacciones(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('refacciones/refacciones/set_estatus',
			      {intRefaccionID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_refacciones_refacciones();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_refacciones_refacciones();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_refacciones_refacciones(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_refacciones_refacciones();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;				            
				          	//Recuperar valores
				            $('#txtRefaccionID_refacciones_refacciones').val(data.row.refaccion_id);
				          	$('#txtCodigo01_refacciones_refacciones').val(data.row.codigo_01);
				            $('#txtCodigo01Anterior_refacciones_refacciones').val(data.row.codigo_01);
				            $('#txtCodigo02_refacciones_refacciones').val(data.row.codigo_02);
				            $('#txtCodigo02Anterior_refacciones_refacciones').val(data.row.codigo_02);
				            $('#txtCodigo03_refacciones_refacciones').val(data.row.codigo_03);
				            $('#txtCodigo03Anterior_refacciones_refacciones').val(data.row.codigo_03);
				            $('#txtCodigo04_refacciones_refacciones').val(data.row.codigo_04);
				            $('#txtCodigo04Anterior_refacciones_refacciones').val(data.row.codigo_04);
				            $('#txtDescripcion_refacciones_refacciones').val(data.row.descripcion);
				            
				            //Si la refacción es un servicio
			                if(data.row.servicio == 'SI')
			                {
			                	//Marcar (Seleccionar) checkbox para indicar que la refacción es un servicio
   					   			$('#chbServicio_refacciones_refacciones').prop("checked", true);
			                }

				            $('#txtProductoServicioID_refacciones_refacciones').val(data.row.producto_servicio_id);
				            $('#txtProductoServicio_refacciones_refacciones').val(data.row.producto_servicio);
				            $('#txtUnidadID_refacciones_refacciones').val(data.row.unidad_id);
				            $('#txtUnidad_refacciones_refacciones').val(data.row.unidad);
				            $('#txtObjetoImpuestoID_refacciones_refacciones').val(data.row.objeto_impuesto_id);
				            $('#txtObjetoImpuesto_refacciones_refacciones').val(data.row.objeto_impuesto);
				            $('#txtRefaccionesLineaID_refacciones_refacciones').val(data.row.refacciones_linea_id);
				            $('#txtRefaccionesLinea_refacciones_refacciones').val(data.row.refacciones_linea);
				            $('#txtRefaccionesMarcaID_refacciones_refacciones').val(data.row.refacciones_marca_id);
				            $('#txtRefaccionesMarca_refacciones_refacciones').val(data.row.refacciones_marca);
				            $('#txtMpcID_refacciones_refacciones').val(data.row.mpc_id);
				            $('#txtMpc_refacciones_refacciones').val(data.row.marketing_product_code);
				            $('#txtMpl_refacciones_refacciones').val(data.row.marketing_product_line);
				            $('#txtMcd_refacciones_refacciones').val(data.row.marketing_code_description);
				            $('#txtCostoPlanta_refacciones_refacciones').val(data.row.costo_planta);
				            //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtCostoPlanta_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
				            $('#cmbMonedaID_refacciones_refacciones').val(data.row.moneda_id);
				            $('#txtPorcentajeIva_refacciones_refacciones').val(data.row.porcentaje_iva);
				            $('#txtTasaCuotaIva_refacciones_refacciones').val(data.row.tasa_cuota_iva);
				            $('#txtPorcentajeIeps_refacciones_refacciones').val(data.row.porcentaje_ieps);
				            $('#txtTasaCuotaIeps_refacciones_refacciones').val(data.row.tasa_cuota_ieps);
				            $('#txtRemplazaID_refacciones_refacciones').val(data.row.remplaza_id);
				            $('#txtRemplaza_refacciones_refacciones').val(data.row.remplaza);
				            $('#txtRemplazo_refacciones_refacciones').val(data.row.remplazo);
				            $('#txtLocalizacion_refacciones_refacciones').val(data.row.localizacion);
				            $('#txtClasificacion_refacciones_refacciones').val(data.row.clasificacion);
				            $('#txtClasificacionPlanta_refacciones_refacciones').val(data.row.clasificacion_planta);
				            $('#txtMinimo_refacciones_refacciones').val(data.row.minimo);
				            $('#txtMaximo_refacciones_refacciones').val(data.row.maximo);
				            $('#txtReorden_refacciones_refacciones').val(data.row.reorden);
				            $('#txtActualExistencia_refacciones_refacciones').val(data.row.actual_existencia);
				            $('#txtDisponibleExistencia_refacciones_refacciones').val(data.row.disponible_existencia);
				            $('#txtActualCosto_refacciones_refacciones').val(data.row.actual_costo);
				            //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtActualCosto_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_refacciones_refacciones').addClass("estatus-"+strEstatus);				       
				            //Hacer llamado a la función  para cargar las listas de precios activas en el grid
				            listas_precios_refacciones_refacciones(strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_refacciones_refacciones").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmRefaccionesRefacciones').find('input, textarea, select').attr('disabled','disabled');

			            		//Deshabilitar botón Agregar
							    $('#btnAgregar_precios_refacciones_refacciones').prop('disabled', true);
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_refacciones_refacciones").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_refacciones_refacciones").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objRefaccionesRefacciones = $('#RefaccionesRefaccionesBox').bPopup({
															  appendTo: '#RefaccionesRefaccionesContent', 
								                              contentContainer: 'RefaccionesRefaccionesM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCodigo01_refacciones_refacciones').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Función para regresar y obtener los datos de un MPC (Código de Producto de Marketing)
		function get_datos_mpc_refacciones_refacciones()
		{
			 //Hacer un llamado al método del controlador para regresar los datos del MPC
             $.post('refacciones/marketing_product_codes/get_datos',
                  { 
                  	strBusqueda:$("#txtMpcID_refacciones_refacciones").val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtMpc_refacciones_refacciones").val(data.row.codigo+' - '+data.row.descripcion);
                       $("#txtMpl_refacciones_refacciones").val(data.row.marketing_product_line);
                       $("#txtMcd_refacciones_refacciones").val(data.row.marketing_code_description);
                    }
                  }
                 ,
                'json');
		}


		//Función para verificar la existencia de un registro
		function verificar_existencia_refacciones_refacciones(strCodigo, campoID)
		{
				//Verificar la existencia del código en la tabla de refacciones_kits
				if(strCodigo != '')
				{
					
					//Hacer un llamado al método del controlador para regresar los datos del registro que coincide con el código
					$.ajax({url: 'refacciones/refacciones_kits/get_datos',
							type: 'POST',
							data: {
								strBusqueda:strCodigo,
								strTipo: 'codigo'
							},
						     async: true, //blocks window close
							success: function(data) {
								if(data.row) 
			                  	{
			                    	
			                        //Hacer un llamado a la función para mostrar mensaje de error
						            mensaje_refacciones_refacciones('informacion', 'El código se encuentra agregado en el catálogo de kits de refacciones, favor de verificar.', campoID);
			                    }
			                    else
			                    {
			                       
			                    	//Si no existe id, verificar la existencia del código en la tabla refacciones
									if ($('#txtRefaccionID_refacciones_refacciones').val() == '')
									{
										//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código
									   editar_refacciones_refacciones(strCodigo, 'codigo', 'Nuevo');
									}
			                    }
							}
					});
				}
		}

		/*******************************************************************************************************************
		Funciones del Tab - Precios
		*********************************************************************************************************************/
		//Función para la búsqueda de listas de precios activas
		function listas_precios_refacciones_refacciones(estatus) 
		{
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_refacciones_refacciones();
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'ACTIVO')
			{
				strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
									"	onclick='editar_renglon_precios_refacciones_refacciones(this)'>" + 
									"<span class='glyphicon glyphicon-edit'></span></button>";
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones/get_datos_precios',
			       {intRefaccionID: $('#txtRefaccionID_refacciones_refacciones').val()
			       },
			       function(data) {
			            //Mostramos los precios del registro
			            for (var intCon in data.precios) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_precios_refacciones_refacciones').getElementsByTagName('tbody')[0];
							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaDescripcion = objRenglon.insertCell(0);
							var objCeldaPrecio = objRenglon.insertCell(1);
							var objCeldaAcciones = objRenglon.insertCell(2);

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.precios[intCon].refacciones_lista_precio_id);
							objCeldaDescripcion.setAttribute('class', 'movil b1');
							objCeldaDescripcion.innerHTML = data.precios[intCon].descripcion;
							objCeldaPrecio.setAttribute('class', 'movil b2');
							objCeldaPrecio.innerHTML = formatMoney(data.precios[intCon].precio, 2, '');
							objCeldaAcciones.setAttribute('class', 'td-center movil b3');
							objCeldaAcciones.innerHTML = strAccionesTabla;
			            }

			            //Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
						var intFilas = $("#dg_precios_refacciones_refacciones tr").length - 1;
						$('#numElementos_precios_refacciones_refacciones').html(intFilas);
			       },
			       'json');

		}


		/*******************************************************************************************************************
		Funciones de la tabla precios
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_precios_refacciones_refacciones()
		{
			//Obtenemos los datos de las cajas de texto
			var intRefaccionesListaPrecioID = $('#txtRefaccionesListaPrecioID_precios_refacciones_refacciones').val();
			var strRefaccionesListaPrecio = $('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').val();
			var intPrecio = $('#txtPrecio_precios_refacciones_refacciones').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_precios_refacciones_refacciones').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intRefaccionesListaPrecioID == '' || strRefaccionesListaPrecio == '')
			{
				//Enfocar caja de texto
				$('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').focus();
			}
			else if (intPrecio == '' || parseFloat($.reemplazar(intPrecio, ",", "")) == 0)
			{
				
				//Limpiar caja de texto
				$('#txtPrecio_precios_refacciones_refacciones').val('');
				//Enfocar caja de texto
				$('#txtPrecio_precios_refacciones_refacciones').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtRefaccionesListaPrecioID_precios_refacciones_refacciones').val('');
				$('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').val('');
				$('#txtPrecio_precios_refacciones_refacciones').val('');

				
				//Convertir cadena de texto a número decimal
				intPrecio = parseFloat($.reemplazar(intPrecio, ",", ""));

				//Editar el precio del detalle
				objTabla.rows.namedItem(intRefaccionesListaPrecioID).cells[1].innerHTML = formatMoney(intPrecio, 2, '');;
				
				//Enfocar caja de texto
				$('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_precios_refacciones_refacciones tr").length - 1;
			$('#numElementos_precios_refacciones_refacciones').html(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_precios_refacciones_refacciones(objRenglon)
		{
			//Variable que se utiliza para asignar el precio
			var intPrecio = parseFloat($.reemplazar(objRenglon.parentNode.parentNode.cells[1].innerHTML, ",", ""));

			//Si existe precio
			if(intPrecio > 0)
			{
				//Convertir cantidad a formato moneda
				intPrecio = formatMoney(intPrecio, 2, '');
			}
			else
			{
				//Asignar cadena vacia para obligar al usuario a capturar un precio mayor 
                intPrecio = '';
			}

			//Asignar los valores a las cajas de texto
			$('#txtRefaccionesListaPrecioID_precios_refacciones_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtPrecio_precios_refacciones_refacciones').val(intPrecio);
			//Enfocar caja de texto
			$('#txtPrecio_precios_refacciones_refacciones').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_precios_refacciones_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_precios_refacciones_refacciones").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_precios_refacciones_refacciones tr").length - 1;
			$('#numElementos_precios_refacciones_refacciones').html(intFilas);

			//Enfocar caja de texto
			$('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').focus();
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Información General
        	*********************************************************************************************************************/
		    //Validar campos decimales
			$('#txtPorcentajeIva_refacciones_refacciones').numeric();
			$('#txtPorcentajeIeps_refacciones_refacciones').numeric();
			$('#txtCostoPlanta_refacciones_refacciones').numeric();

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
			* por ejemplo: 1800 será 1,800.00*/
			$('.moneda_refacciones_refacciones').blur(function(){
				$('.moneda_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo01_refacciones_refacciones').focusout(function(e){
				
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_refacciones_refacciones($('#txtCodigo01_refacciones_refacciones').val(), 'txtCodigo01');
				
			});

			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo02_refacciones_refacciones').focusout(function(e){
				
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_refacciones_refacciones($('#txtCodigo02_refacciones_refacciones').val(), 'txtCodigo02');

			});

			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo03_refacciones_refacciones').focusout(function(e){
							
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_refacciones_refacciones($('#txtCodigo03_refacciones_refacciones').val(), 'txtCodigo03');

			});
			

			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo04_refacciones_refacciones').focusout(function(e){
				
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_refacciones_refacciones($('#txtCodigo04_refacciones_refacciones').val(), 'txtCodigo04');

			});

			//Autocomplete para recuperar los datos de un producto o servicio
	        $('#txtProductoServicio_refacciones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtProductoServicioID_refacciones_refacciones').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_productos_servicios/autocomplete",
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
	               $('#txtProductoServicioID_refacciones_refacciones').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del producto cuando pierda el enfoque la caja de texto
	        $('#txtProductoServicio_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del producto
	            if($('#txtProductoServicioID_refacciones_refacciones').val() == '' ||
	               $('#txtProductoServicio_refacciones_refacciones').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtProductoServicioID_refacciones_refacciones').val('');
	                $('#txtProductoServicio_refacciones_refacciones').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una unidad
	        $('#txtUnidad_refacciones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtUnidadID_refacciones_refacciones').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_unidades/autocomplete",
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
	               $('#txtUnidadID_refacciones_refacciones').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la unidad cuando pierda el enfoque la caja de texto
	        $('#txtUnidad_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la unidad
	            if($('#txtUnidadID_refacciones_refacciones').val() == '' ||
	               $('#txtUnidad_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUnidadID_refacciones_refacciones').val('');
	               $('#txtUnidad_refacciones_refacciones').val('');
	            }
	            
	        });


	        //Autocomplete para recuperar los datos de un objeto de impuesto
	        $('#txtObjetoImpuesto_refacciones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtObjetoImpuestoID_refacciones_refacciones').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_objeto_impuesto/autocomplete",
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
	               $('#txtObjetoImpuestoID_refacciones_refacciones').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del objeto de impuesto cuando pierda el enfoque la caja de texto
	        $('#txtObjetoImpuesto_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del objeto de impuesto
	            if($('#txtObjetoImpuestoID_refacciones_refacciones').val() == '' ||
	               $('#txtObjetoImpuesto_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtObjetoImpuestoID_refacciones_refacciones').val('');
	               $('#txtObjetoImpuesto_refacciones_refacciones').val('');
	            }
	            
	        });


			//Autocomplete para recuperar los datos de una MPC (Códigos de Productos de Marketing)
	        $('#txtMpc_refacciones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtMpcID_refacciones_refacciones').val('');
	                 //Hacer un llamado a la función para inicializar elementos del MPC
	                 inicializar_mpc_refacciones_refacciones();
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/marketing_product_codes/autocomplete",
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
	               $('#txtMpcID_refacciones_refacciones').val(ui.item.data);
	                //Hacer un llamado a la función para regresar los datos del MPC
	                get_datos_mpc_refacciones_refacciones();
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del MPC cuando pierda el enfoque la caja de texto
	        $('#txtMpc_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del MPC
	            if($('#txtMpcID_refacciones_refacciones').val() == '' ||
	               $('#txtMpc_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMpcID_refacciones_refacciones').val('');
	               $('#txtMpc_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos del MPC
	               inicializar_mpc_refacciones_refacciones();
	            }

	        });

			//Autocomplete para recuperar los datos de una línea de refacciones 
	        $('#txtRefaccionesLinea_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtRefaccionesLineaID_refacciones_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/refacciones_lineas/autocomplete",
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
	             $('#txtRefaccionesLineaID_refacciones_refacciones').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la línea de refacciones cuando pierda el enfoque la caja de texto
	        $('#txtRefaccionesLinea_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la línea de refacciones
	            if($('#txtRefaccionesLineaID_refacciones_refacciones').val() == '' ||
	               $('#txtRefaccionesLinea_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtRefaccionesLineaID_refacciones_refacciones').val('');
	               $('#txtRefaccionesLinea_refacciones_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una marca de refacciones
	        $('#txtRefaccionesMarca_refacciones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRefaccionesMarcaID_refacciones_refacciones').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones_marcas/autocomplete",
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
	               $('#txtRefaccionesMarcaID_refacciones_refacciones').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la marca de refacciones cuando pierda el enfoque la caja de texto
	        $('#txtRefaccionesMarca_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la marca de refacciones
	            if($('#txtRefaccionesMarcaID_refacciones_refacciones').val() == '' ||
	               $('#txtRefaccionesMarca_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtRefaccionesMarcaID_refacciones_refacciones').val('');
	               $('#txtRefaccionesMarca_refacciones_refacciones').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una refacción
	        $('#txtRemplaza_refacciones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRemplazaID_refacciones_refacciones').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones/autocomplete",
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
	               $('#txtRemplazaID_refacciones_refacciones').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
	        $('#txtRemplaza_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la refacción
	            if($('#txtRemplazaID_refacciones_refacciones').val() == '' ||
	               $('#txtRemplaza_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtRemplazaID_refacciones_refacciones').val('');
	               $('#txtRemplaza_refacciones_refacciones').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_refacciones_refacciones').val('');
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
	             $('#txtTasaCuotaIva_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtPorcentajeIva_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_refacciones_refacciones').val() == '' ||
	               $('#txtPorcentajeIva_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_refacciones_refacciones').val('');
	               $('#txtPorcentajeIva_refacciones_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_refacciones_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_tasa_cuota/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strImpuesto: 'IEPS'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtTasaCuotaIeps_refacciones_refacciones').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la tasa o cuota del impuesto de IEPS cuando pierda el enfoque la caja de texto
	        $('#txtPorcentajeIeps_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_refacciones_refacciones').val() == '' ||
	               $('#txtPorcentajeIeps_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_refacciones_refacciones').val('');
	               $('#txtPorcentajeIeps_refacciones_refacciones').val('');
	            }
	            
	        });

			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Precios
        	*********************************************************************************************************************/
        	//Validar campos decimales
			$('#txtPrecio_precios_refacciones_refacciones').numeric();

			//Autocomplete para recuperar los datos de una lista de precios 
			$('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtRefaccionesListaPrecioID_precios_refacciones_refacciones').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "refacciones/refacciones_listas_precios/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtRefaccionesListaPrecioID_precios_refacciones_refacciones').val(ui.item.data);
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id de la lista de precios cuando pierda el enfoque la caja de texto
			$('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').focusout(function(e){
				//Si no existe id de la lista de precios de refacciones
				if($('#txtRefaccionesListaPrecioID_precios_refacciones_refacciones').val() == '' ||
					$('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').val() == '')
				{ 
					//Limpiar contenido de las siguientes cajas de texto
					$('#txtRefaccionesListaPrecioID_precios_refacciones_refacciones').val('');
					$('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').val('');
				}
				
			});
			
	        //Validar que exista lista de precios cuando se pulse la tecla enter 
			$('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe lista de precios
		            if($('#txtRefaccionesListaPrecioID_precios_refacciones_refacciones').val() == '' || $('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtRefaccionesListaPrecio_precios_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtPrecio_precios_refacciones_refacciones').focus();
			   	    }
		        }
		    });

		    //Validar que exista precio cuando se pulse la tecla enter 
			$('#txtPrecio_precios_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio
		            if($('#txtPrecio_precios_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecio_precios_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
		    			agregar_renglon_precios_refacciones_refacciones();
			   	    }
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_refacciones_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaRefaccionesRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_refacciones_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_refacciones_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_refacciones_refacciones();
				//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
				cargar_objeto_impuesto_base_refacciones_refacciones();
				//Hacer llamado a la función  para cargar las listas de precios activas en el grid
				listas_precios_refacciones_refacciones('');
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_refacciones_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				 objRefaccionesRefacciones = $('#RefaccionesRefaccionesBox').bPopup({
											   appendTo: '#RefaccionesRefaccionesContent', 
				                               contentContainer: 'RefaccionesRefaccionesM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo01_refacciones_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_refacciones_refacciones').focus();  
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_refacciones_refacciones();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_refacciones_refacciones();
		});
	</script>