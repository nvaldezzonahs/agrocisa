	<div id="MaquinariaDescripcionesMaquinariaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_maquinaria_descripciones_maquinaria" action="#" method="post" 
				  tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_maquinaria_descripciones_maquinaria" 
								   name="strBusqueda_maquinaria_descripciones_maquinaria"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_maquinaria_descripciones_maquinaria"
										onclick="paginacion_maquinaria_descripciones_maquinaria();" 
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
							<button class="btn btn-info" id="btnNuevo_maquinaria_descripciones_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_maquinaria_descripciones_maquinaria"
									onclick="reporte_maquinaria_descripciones_maquinaria('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_maquinaria_descripciones_maquinaria"
									onclick="reporte_maquinaria_descripciones_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla descripciones de maquinaria
				*/
				td.movil.a1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Servicio"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla componentes
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_maquinaria_descripciones_maquinaria">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Descripción</th>
							<th class="movil">Servicio</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_maquinaria_descripciones_maquinaria" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{codigo}}</td>
							<td class="movil a2">{{descripcion_corta}}</td>
							<td class="movil a3">{{servicio}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_maquinaria_descripciones_maquinaria({{maquinaria_descripcion_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_maquinaria_descripciones_maquinaria({{maquinaria_descripcion_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_maquinaria_descripciones_maquinaria({{maquinaria_descripcion_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_maquinaria_descripciones_maquinaria({{maquinaria_descripcion_id}},'{{estatus}}')"  
										title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="4"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_maquinaria_descripciones_maquinaria"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_maquinaria_descripciones_maquinaria">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MaquinariaDescripcionesMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_maquinaria_descripciones_maquinaria"  class="ModalBodyTitle">
				<h1>Descripciones de Maquinaria</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_maquinaria_descripciones_maquinaria" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_maquinaria_descripciones_maquinaria" class="active">
									<a data-toggle="tab" href="#informacion_general_maquinaria_descripciones_maquinaria">Información General</a>
								</li>
								<!--Tab que contiene la información de los Componentes-->
								<li id="tabComponentes_maquinaria_descripciones_maquinaria">
									<a data-toggle="tab" href="#componentes_maquinaria_descripciones_maquinaria">Componentes</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmMaquinariaDescripcionesMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmMaquinariaDescripcionesMaquinaria"  onsubmit="return(false)" 
					  autocomplete="off">
				  	<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
				  	<div class="tab-content">
						<!--Tab - Información General-->
					 	<div id="informacion_general_maquinaria_descripciones_maquinaria" class="tab-pane fade in active">
					 		<div class="row">
							    <!--Código-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtMaquinariaDescripcionID_maquinaria_descripciones_maquinaria" 
												   name="intMaquinariaDescripcionID_maquinaria_descripciones_maquinaria"  
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
											<input id="txtCodigoAnterior_maquinaria_descripciones_maquinaria" 
													name="strCodigoAnterior_maquinaria_descripciones_maquinaria" 
													type="hidden" value="">
											</input>
											<label for="txtCodigo_maquinaria_descripciones_maquinaria">Código</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigo_maquinaria_descripciones_maquinaria" 
													name="strCodigo_maquinaria_descripciones_maquinaria" type="text" value="" 
													tabindex="1" placeholder="Ingrese código" maxlength="30">
											</input>
										</div>
									</div>
								</div>
								<!--Descripción corta-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtDescripcionCorta_maquinaria_descripciones_maquinaria">Descripción corta</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtDescripcionCorta_maquinaria_descripciones_maquinaria" 
													name="strDescripcionCorta_maquinaria_descripciones_maquinaria" type="text" value=""
													tabindex="1" placeholder="Ingrese descripción" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Servicio--> 
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12 btn-toolBtns">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" id="chbServicio_maquinaria_descripciones_maquinaria" 
												   name="strServicio_maquinaria_descripciones_maquinaria" type="checkbox"
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
											<!-- Caja de texto oculta que se utiliza para recuperar el id del producto/servicio seleccionado-->
											<input id="txtProductoServicioID_maquinaria_descripciones_maquinaria" 
												   name="intProductoServicioID_maquinaria_descripciones_maquinaria"  
												   type="hidden" 
												   value="" />
											<label for="txtProductoServicio_maquinaria_descripciones_maquinaria">Código SAT</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtProductoServicio_maquinaria_descripciones_maquinaria" 
													name="strProductoServicio_maquinaria_descripciones_maquinaria" type="text"
													value="" tabindex="1"  placeholder="Ingrese código SAT" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las unidades activas-->
								<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del sat_unidades seleccionado-->
											<input id="txtUnidadID_maquinaria_descripciones_maquinaria" 
												   name="intUnidadID_maquinaria_descripciones_maquinaria"  
												   type="hidden" 
												   value="" />
											<label for="txtUnidad_maquinaria_descripciones_maquinaria">Unidad SAT</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtUnidad_maquinaria_descripciones_maquinaria" 
													name="strUnidad_maquinaria_descripciones_maquinaria" type="text" 
													value=""  tabindex="1"  placeholder="Ingrese unidad SAT" maxlength="250">
											</input>
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
											<input id="txtTasaCuotaIva_maquinaria_descripciones_maquinaria" 
												   name="intTasaCuotaIva_maquinaria_descripciones_maquinaria" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIva_maquinaria_descripciones_maquinaria">IVA %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIva_maquinaria_descripciones_maquinaria" 
													name="intPorcentajeIva_maquinaria_descripciones_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese IVA" maxlength="250">
											</input>
										</div>
									</div>
						    	</div>
						    	<!--Autocomplete que contiene los objetos de impuesto-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObjetoImpuesto_maquinaria_descripciones_maquinaria">Objeto de impuesto SAT</label>
										</div>
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del objeto de impuesto seleccionado-->
											<input id="txtObjetoImpuestoID_maquinaria_descripciones_maquinaria" 
												   name="intObjetoImpuestoID_maquinaria_descripciones_maquinaria"  
												   type="hidden" value="">
										    </input>
											<input  class="form-control" id="txtObjetoImpuesto_maquinaria_descripciones_maquinaria" 
													name="strObjetoImpuesto_maquinaria_descripciones_maquinaria" type="text" 
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
											<input id="txtTasaCuotaIeps_maquinaria_descripciones_maquinaria" 
												   name="intTasaCuotaIeps_maquinaria_descripciones_maquinaria" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIeps_maquinaria_descripciones_maquinaria">IEPS %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIeps_maquinaria_descripciones_maquinaria" 
													name="intPorcentajeIeps_maquinaria_descripciones_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
											</input>
										</div>
									</div>
						    	</div>
						    </div>
						    <div class="row">
						    	<!--Descripción larga-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtDescripcion_maquinaria_descripciones_maquinaria">Descripción</label>
										</div>
										<div class="col-md-12">
											<textarea  class="form-control" id="txtDescripcion_maquinaria_descripciones_maquinaria" 
													   name="strDescripcion_maquinaria_descripciones_maquinaria" rows="5" value="" tabindex="1" placeholder="Ingrese descripción"></textarea>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Autocomplete que contiene las líneas de maquinaria activas-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la línea de maquinaria seleccionada-->
											<input id="txtMaquinariaLineaID_maquinaria_descripciones_maquinaria" 
												   name="intMaquinariaLineaID_maquinaria_descripciones_maquinaria"  
												   type="hidden" value="">
										    </input>
											<label for="txtMaquinariaLinea_maquinaria_descripciones_maquinaria">Línea</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMaquinariaLinea_maquinaria_descripciones_maquinaria" 
													name="strMaquinariaLinea_maquinaria_descripciones_maquinaria" type="text" 
													value="" tabindex="1" placeholder="Ingrese línea" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las marcas de maquinaria activas-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la marca de maquinaria seleccionada-->
											<input id="txtMaquinariaMarcaID_maquinaria_descripciones_maquinaria" 
												   name="intMaquinariaMarcaID_maquinaria_descripciones_maquinaria"  
												   type="hidden" value="">
										    </input>
											<label for="txtMaquinariaMarca_maquinaria_descripciones_maquinaria">Marca</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMaquinariaMarca_maquinaria_descripciones_maquinaria" 
													name="strMaquinariaMarca_maquinaria_descripciones_maquinaria" type="text" 
													value="" tabindex="1" placeholder="Ingrese marca" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los modelos de maquinaria activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del modelo de maquinaria seleccionado-->
											<input id="txtMaquinariaModeloID_maquinaria_descripciones_maquinaria" 
												   name="intMaquinariaModeloID_maquinaria_descripciones_maquinaria"  
												   type="hidden" value="">
										    </input>
											<label for="txtMaquinariaModelo_maquinaria_descripciones_maquinaria">Modelo</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMaquinariaModelo_maquinaria_descripciones_maquinaria" 
													name="strMaquinariaModelo_maquinaria_descripciones_maquinaria" type="text" 
													value="" tabindex="1" placeholder="Ingrese modelo" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Meses de garantía-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMesesGarantia_maquinaria_descripciones_maquinaria">Meses de garantía</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMesesGarantia_maquinaria_descripciones_maquinaria" 
													name="intMesesGarantia_maquinaria_descripciones_maquinaria" type="text" 
													value="" tabindex="1" placeholder="Ingrese meses" maxlength="3">
											</input>
										</div>
									</div>
								</div>
								<!--Horas de garantía-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHorasGarantia_maquinaria_descripciones_maquinaria">Horas de garantía</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control moneda_maquinaria_descripciones_maquinaria" id="txtHorasGarantia_maquinaria_descripciones_maquinaria" 
													name="intHorasGarantia_maquinaria_descripciones_maquinaria" type="text" 
													value="" tabindex="1" placeholder="Ingrese horas" maxlength="12">
											</input>
										</div>
									</div>
								</div>
								<!--Combobox que contiene las monedas activas-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbMonedaID_maquinaria_descripciones_maquinaria">Moneda</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbMonedaID_maquinaria_descripciones_maquinaria" 
											 		name="intMonedaID_maquinaria_descripciones_maquinaria" tabindex="1">
		                     				</select>
										</div>
									</div>
								</div>
						    </div>
					 	</div>
					 	<!--Tab - Componentes -->
						<div id="componentes_maquinaria_descripciones_maquinaria" class="tab-pane fade">
							<div class="row">
							    <!--Código componente-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtMaquinariaDescripcionCompID_maquinaria_descripciones_maquinaria" 
												   name="intMaquinariaDescripcionCompID_maquinaria_descripciones_maquinaria"  
												   type="hidden" value="" />
											<label for="txtCodigo_maquinaria_descripciones_maquinaria">Código</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigoComp_maquinaria_descripciones_maquinaria" 
													name="strCodigoComp_maquinaria_descripciones_maquinaria" type="text" value="" 
													tabindex="1" placeholder="Ingrese código" maxlength="30" />
										</div>
									</div>
								</div>
								<!--Descripción corta componente-->
								<div class="col-sm-8 col-md-8 col-lg-8 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtDescripcionCortaComp_maquinaria_descripciones_maquinaria">Descripción corta</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtDescripcionCortaComp_maquinaria_descripciones_maquinaria" 
													name="strDescripcionCortaComp_maquinaria_descripciones_maquinaria" type="text" value=""
													tabindex="1" maxlength="50" disabled />
										</div>
									</div>
								</div>
								<!--Botón agregar componentes-->
                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                                	<button class="btn btn-primary btn-toolBtns pull-right" 
                                			id="btnAgregarComp_componentes_maquinaria_descripciones_maquinaria" 
                                			onclick="agregar_renglon_componentes_maquinaria_descripciones_maquinaria();" 
                                	     	title="Agregar"> 
                                		<span class="glyphicon glyphicon-plus"></span>
                                	</button>
                             	</div>
						    </div>
						    <div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">Componentes</h4>
												</div>
												<div class="panel-body">
													<!--Div que contiene la tabla con los componentes agregados-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!-- Diseño de la tabla-->
															<table class="table-hover movil" id="dg_componentes_maquinaria_descripciones_maquinaria">
																<thead class="movil">
																	<tr class="movil">
																		<th class="movil">Código</th>
																		<th class="movil">Descripción</th>
																		<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
																	</tr>
																</thead>
																<tbody class="movil"></tbody>
															</table>
															<br>
															<div class="row">
																<!--Número de registros encontrados-->
																<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																	<button class="btn btn-default btn-sm disabled pull-right">
																		<strong id="numElementos_componentes_maquinaria_descripciones_maquinaria">0</strong> encontrados
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
						</div>
					</div>		 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_maquinaria_descripciones_maquinaria"  
									onclick="validar_maquinaria_descripciones_maquinaria();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_maquinaria_descripciones_maquinaria"  
									onclick="cambiar_estatus_maquinaria_descripciones_maquinaria('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_maquinaria_descripciones_maquinaria"  
									onclick="cambiar_estatus_maquinaria_descripciones_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_maquinaria_descripciones_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_maquinaria_descripciones_maquinaria();" title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal primario-->

		<!--Diseño del modal secundario-->
		<div id="AditamentosMaquinariaDescripcionesMaquinariaBox" class="ModalBody" tabindex="-1">
			<!--Título-->
			<div id="divEncabezadoModalSecundario_maquinaria_descripciones_maquinaria" class="ModalBodyTitle">
				<h1>Ver aditamentos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAditamentosMaquinariaDescripcionesMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmAditamentosMaquinariaDescripcionesMaquinaria" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					  	<!--Código-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el renglón seleccionado -->	
									<label for="txtCodigoAditamentos_maquinaria_descripciones_maquinaria">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtCodigoAditamentos_maquinaria_descripciones_maquinaria" 
											name="strCodigoAditamentos_maquinaria_descripciones_maquinaria" 
											type="text" 
											disabled />
								</div>
							</div>
						</div>
						<!--Descripción-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">	
									<label for="txtDescripcionAditamentos_maquinaria_descripciones_maquinaria">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtDescripcionAditamentos_maquinaria_descripciones_maquinaria" 
											name="strDescripcionAditamentos_maquinaria_descripciones_maquinaria" 
											type="text" 
											disabled />
								</div>
							</div>
						</div>
						<!--Serie-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">	
									<label for="txtSerieAditamentos_maquinaria_descripciones_maquinaria">Serie</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtSerieAditamentos_maquinaria_descripciones_maquinaria" 
											name="strSerieAditamentos_maquinaria_descripciones_maquinaria" 
											type="text" 
											disabled />
								</div>
							</div>
						</div>
						<!--Motor-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">	
									<label for="txtMotorAditamentos_maquinaria_descripciones_maquinaria">Motor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtMotorAditamentos_maquinaria_descripciones_maquinaria" 
											name="strMotorAditamentos_maquinaria_descripciones_maquinaria" 
											type="text" 
											disabled />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="row">
										<!-- Diseño de la tabla-->
										<table class="table-hover" id="dg_aditamentos_detalles_maquinaria_descripciones_maquinaria">
											<thead>
												<tr>
													<th>Cantidad</th>
													<th>Descripción</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
										<br>
										<div class="row">
											<!--Número de registros encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<button class="btn btn-default btn-sm disabled pull-right">
													<strong id="numElementos_detalles_aditamentos_maquinaria_descripciones_maquinaria">0</strong> encontrados
												</button>
											</div>
										</div>
									</div>		
								</div>
							</div>		
						</div>
					</div>
					<!--Cierre row-->		
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_respuestas_maquinaria_descripciones_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_aditamentos_maquinaria_descripciones_maquinaria();" title="Cerrar">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
					<!--Cierre Botones de acción (barra de tareas)-->	
				</form>
				<!--Cierre del formulario-->	  
			</div>
			<!--Cierre del Contenido-->
		</div>
		<!--Cierre del modal secundario-->

	</div><!--#MaquinariaDescripcionesMaquinariaContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_maquinaria_descripciones_maquinaria" type="text/template">
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
		var intPaginaMaquinariaDescripcionesMaquinaria = 0;
		var strUltimaBusquedaMaquinariaDescripcionesMaquinaria = "";
		//Variable que se utiliza para asignar el id del objeto de impuesto base
		var intObjetoImpuestoBaseIDMaquinariaDescripcionesMaquinaria = <?php echo OBJETOIMP_BASE ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objMaquinariaDescripcionesMaquinaria = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_maquinaria_descripciones_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/maquinaria_descripciones/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_maquinaria_descripciones_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMaquinariaDescripcionesMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosMaquinariaDescripcionesMaquinaria = strPermisosMaquinariaDescripcionesMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMaquinariaDescripcionesMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMaquinariaDescripcionesMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_maquinaria_descripciones_maquinaria').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMaquinariaDescripcionesMaquinaria[i]=='GUARDAR') || (arrPermisosMaquinariaDescripcionesMaquinaria[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_maquinaria_descripciones_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosMaquinariaDescripcionesMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_maquinaria_descripciones_maquinaria').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_maquinaria_descripciones_maquinaria();
						}
						else if(arrPermisosMaquinariaDescripcionesMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_maquinaria_descripciones_maquinaria').removeAttr('disabled');
							$('#btnRestaurar_maquinaria_descripciones_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosMaquinariaDescripcionesMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_maquinaria_descripciones_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosMaquinariaDescripcionesMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_maquinaria_descripciones_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_maquinaria_descripciones_maquinaria() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_maquinaria_descripciones_maquinaria').val() != strUltimaBusquedaMaquinariaDescripcionesMaquinaria)
			{
				intPaginaMaquinariaDescripcionesMaquinaria = 0;
				strUltimaBusquedaMaquinariaDescripcionesMaquinaria = $('#txtBusqueda_maquinaria_descripciones_maquinaria').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('maquinaria/maquinaria_descripciones/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_maquinaria_descripciones_maquinaria').val(),
						intPagina:intPaginaMaquinariaDescripcionesMaquinaria,
						strPermisosAcceso: $('#txtAcciones_maquinaria_descripciones_maquinaria').val()
					},
					function(data){
						$('#dg_maquinaria_descripciones_maquinaria tbody').empty();
						var tmpMaquinariaDescripcionesMaquinaria = Mustache.render($('#plantilla_maquinaria_descripciones_maquinaria').html(),data);
						$('#dg_maquinaria_descripciones_maquinaria tbody').html(tmpMaquinariaDescripcionesMaquinaria);
						$('#pagLinks_maquinaria_descripciones_maquinaria').html(data.paginacion);
						$('#numElementos_maquinaria_descripciones_maquinaria').html(data.total_rows);
						intPaginaMaquinariaDescripcionesMaquinaria = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_maquinaria_descripciones_maquinaria(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/maquinaria_descripciones/';

			//Si el tipo de reporte es PDF
			if(strTipo == 'PDF')
			{
				//Concatenar nombre de la función que genera el reporte PDF
				strUrl += 'get_reporte';
			}
			else
			{
				//Concatenar nombre de la función que genera el archivo XLS
				strUrl += "get_xls";
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'strBusqueda': $('#txtBusqueda_maquinaria_descripciones_maquinaria').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_maquinaria_descripciones_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_maquinaria_descripciones_maquinaria').empty();
					var temp = Mustache.render($('#monedas_maquinaria_descripciones_maquinaria').html(), data);
					$('#cmbMonedaID_maquinaria_descripciones_maquinaria').html(temp);
				},
				'json');
		}

		//Regresar el impuesto de objeto base
		function cargar_objeto_impuesto_base_maquinaria_descripciones_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.ajax({
			        url: 'contabilidad/sat_objeto_impuesto/get_datos',
			        method:'post',
			        dataType: 'json',
			        async: false,
			        data: {
			        	strBusqueda:intObjetoImpuestoBaseIDMaquinariaDescripcionesMaquinaria,
			       		strTipo: 'id'
			        },
			        success: function (data) {
			          	//Si no se encuentra código 
			        	if(data.row)
			        	{
			        		//Recuperar valores
				            $('#txtObjetoImpuestoID_maquinaria_descripciones_maquinaria').val(data.row.objeto_impuesto_id);
				            $('#txtObjetoImpuesto_maquinaria_descripciones_maquinaria').val(data.row.codigo+' - '+data.row.descripcion);

			        	}
			        }
			    });
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_maquinaria_descripciones_maquinaria()
		{
			//Incializar formulario
			$('#frmMaquinariaDescripcionesMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_maquinaria_descripciones_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmMaquinariaDescripcionesMaquinaria').find('input[type=hidden]').val('');
			//Eliminar los datos de la tabla
			$('#dg_componentes_maquinaria_descripciones_maquinaria tbody').empty();
			$('#numElementos_componentes_maquinaria_descripciones_maquinaria').html(0);
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_maquinaria_descripciones_maquinaria');
			//Habilitar todos los elementos del formulario
			$('#frmMaquinariaDescripcionesMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');
			//Seleccionar tab que contiene la información general
		    $('a[href="#informacion_general_maquinaria_descripciones_maquinaria"]').click();
		    //Deshabilitar caja de texto
			$('#txtDescripcionCortaComp_maquinaria_descripciones_maquinaria').prop('disabled', true);
			//Mostrar botón Guardar
			$("#btnGuardar_maquinaria_descripciones_maquinaria").show();
			//Habilitar botón Agregar
			$('#btnAgregarComp_componentes_maquinaria_descripciones_maquinaria').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnDesactivar_maquinaria_descripciones_maquinaria").hide();
			$("#btnRestaurar_maquinaria_descripciones_maquinaria").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_maquinaria_descripciones_maquinaria()
		{
			try {

				//Hacer un llamado a la función para cerrar modal Ver aditamentos
				cerrar_aditamentos_maquinaria_descripciones_maquinaria();
				//Cerrar modal
				objMaquinariaDescripcionesMaquinaria.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_maquinaria_descripciones_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_maquinaria_descripciones_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_maquinaria_descripciones_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmMaquinariaDescripcionesMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_maquinaria_descripciones_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba el código para esta descripción de maquinaria'}
											}
										},
										strDescripcionCorta_maquinaria_descripciones_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										strProductoServicio_maquinaria_descripciones_maquinaria: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del producto/servicio
					                                    if($('#txtProductoServicioID_maquinaria_descripciones_maquinaria').val() === '')
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
										strUnidad_maquinaria_descripciones_maquinaria: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                   //Verificar que exista id de la unidad
					                                    if($('#txtUnidadID_maquinaria_descripciones_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un unidad SAT existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strObjetoImpuesto_maquinaria_descripciones_maquinaria: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del objeto de impuesto
					                                    if($('#txtObjetoImpuestoID_maquinaria_descripciones_maquinaria').val() === '')
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
										intPorcentajeIva_maquinaria_descripciones_maquinaria: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IVA
					                                    if($('#txtTasaCuotaIva_maquinaria_descripciones_maquinaria').val() === '')
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
										intPorcentajeIeps_maquinaria_descripciones_maquinaria: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IEPS
					                                    if(value != '' && $('#txtTasaCuotaIeps_maquinaria_descripciones_maquinaria').val() === '')
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
										strDescripcion_maquinaria_descripciones_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										intHorasGarantia_maquinaria_descripciones_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba número de horas'}
											}
										},
										intMesesGarantia_maquinaria_descripciones_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba número de meses'}
											}
										},
										intMonedaID_maquinaria_descripciones_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										strMaquinariaLinea_maquinaria_descripciones_maquinaria: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                	//Verificar que exista id de la línea de maquinaria
					                                    if($('#txtMaquinariaLineaID_maquinaria_descripciones_maquinaria').val() === '')
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
										strMaquinariaMarca_maquinaria_descripciones_maquinaria: {
											validators: {
												callback: {
					                             	callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la marca de maquinaria
					                                    if($('#txtMaquinariaMarcaID_maquinaria_descripciones_maquinaria').val() === '')
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
										strMaquinariaModelo_maquinaria_descripciones_maquinaria: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                	//Verificar que exista id del modelo de maquinaria
					                                    if($('#txtMaquinariaModeloID_maquinaria_descripciones_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un modelo existente'
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
			var bootstrapValidator_maquinaria_descripciones_maquinaria = $('#frmMaquinariaDescripcionesMaquinaria').data('bootstrapValidator');
			bootstrapValidator_maquinaria_descripciones_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_maquinaria_descripciones_maquinaria.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_maquinaria_descripciones_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_maquinaria_descripciones_maquinaria()
		{
			try
			{
				$('#frmMaquinariaDescripcionesMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_maquinaria_descripciones_maquinaria()
		{
			//Verificar si la maquinaria a agregar contiene componentes 
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_componentes_maquinaria_descripciones_maquinaria').getElementsByTagName('tbody')[0];
			var arrComponentes = [];

			//Variable para verificar si el código de la maquinaria a agregar es diferente a los componentes de la misma
			var codigoNovalido = false; 

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{	
				//Validación de códigos
				var intCodigoComp = objRen.cells[0].innerHTML;
				//Variables que se utilizan para asignar valores del detalle	
				var intReferenciaID = objRen.cells[3].innerHTML;
				if( $('#txtCodigo_maquinaria_descripciones_maquinaria').val() == intCodigoComp ){
					codigoNovalido = true;
				}
				//Asignar valores a los arrays
				arrComponentes.push(intReferenciaID);
			}

			//Si el checkbox servicio se encuentra seleccionado (marcado)
			if ($('#chbServicio_maquinaria_descripciones_maquinaria').is(':checked')) {
			    //Asignar SI
			    $('#chbServicio_maquinaria_descripciones_maquinaria').val('SI');
			}
			else
			{ 
			   //Asignar NO 
			   $('#chbServicio_maquinaria_descripciones_maquinaria').val('NO');
			}

			//Si los códigos a asignar son correctos
			if(codigoNovalido == false){ 

				//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('maquinaria/maquinaria_descripciones/guardar',
				{ 
					//Datos de la descripción de maquinaria
					intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_maquinaria_descripciones_maquinaria').val(),
					strCodigo: $('#txtCodigo_maquinaria_descripciones_maquinaria').val(),
					strCodigoAnterior: $('#txtCodigoAnterior_maquinaria_descripciones_maquinaria').val(),
		            intProductoServicioID: $('#txtProductoServicioID_maquinaria_descripciones_maquinaria').val(),
		            intUnidadID: $('#txtUnidadID_maquinaria_descripciones_maquinaria').val(),
		            intObjetoImpuestoID: $('#txtObjetoImpuestoID_maquinaria_descripciones_maquinaria').val(),
		            strDescripcionCorta: $('#txtDescripcionCorta_maquinaria_descripciones_maquinaria').val(),
		            strDescripcion: $('#txtDescripcion_maquinaria_descripciones_maquinaria').val(),
		            strServicio: $('#chbServicio_maquinaria_descripciones_maquinaria').val(),
		            intMaquinariaLineaID: $('#txtMaquinariaLineaID_maquinaria_descripciones_maquinaria').val(),
		            intMaquinariaMarcaID:  $('#txtMaquinariaMarcaID_maquinaria_descripciones_maquinaria').val(),
		            intMaquinariaModeloID:  $('#txtMaquinariaModeloID_maquinaria_descripciones_maquinaria').val(),
		            intMesesGarantia: $('#txtMesesGarantia_maquinaria_descripciones_maquinaria').val(),
		            //Hacer un llamado a la función para reemplazar ',' por cadena vacia
		            intHorasGarantia:  $.reemplazar($('#txtHorasGarantia_maquinaria_descripciones_maquinaria').val(), ",", ""),
		            intMonedaID: $('#cmbMonedaID_maquinaria_descripciones_maquinaria').val(),
		            intTasaCuotaIva: $('#txtTasaCuotaIva_maquinaria_descripciones_maquinaria').val(),
		            intTasaCuotaIeps: $('#txtTasaCuotaIeps_maquinaria_descripciones_maquinaria').val(),
		            //Datos de los componentes
		            strComponentes: arrComponentes.join('|')
				},
				function(data) {
					if (data.resultado)
					{
						//Hacer llamado a la función  para cargar los registros en el grid
						paginacion_maquinaria_descripciones_maquinaria();
						//Hacer un llamado a la función para cerrar modal
						cerrar_maquinaria_descripciones_maquinaria();                  
					}
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_maquinaria_descripciones_maquinaria(data.tipo_mensaje, data.mensaje);
				},
				'json');

			}
			else
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_maquinaria_descripciones_maquinaria('error', 'El código de la maquinaria a agregar es igual a un código de componente');
			}	

		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_maquinaria_descripciones_maquinaria(tipoMensaje, mensaje)
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
		function cambiar_estatus_maquinaria_descripciones_maquinaria(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMaquinariaDescripcionID_maquinaria_descripciones_maquinaria').val();

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
						              'title':    'Descripciones de Maquinaria',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                            	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_maquinaria_descripciones_maquinaria(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_maquinaria_descripciones_maquinaria(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_maquinaria_descripciones_maquinaria(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('maquinaria/maquinaria_descripciones/set_estatus',
			      {intMaquinariaDescripcionID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_maquinaria_descripciones_maquinaria();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_maquinaria_descripciones_maquinaria();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_maquinaria_descripciones_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_maquinaria_descripciones_maquinaria(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/maquinaria_descripciones/get_datos',
			       {
			       		strBusqueda:busqueda,
			       		strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_maquinaria_descripciones_maquinaria();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				            
				          	//Recuperar valores
				            $('#txtMaquinariaDescripcionID_maquinaria_descripciones_maquinaria').val(data.row.maquinaria_descripcion_id);
				            $('#txtCodigo_maquinaria_descripciones_maquinaria').val(data.row.codigo);
				            $('#txtCodigoAnterior_maquinaria_descripciones_maquinaria').val(data.row.codigo);
				            $('#txtProductoServicioID_maquinaria_descripciones_maquinaria').val(data.row.producto_servicio_id);
			                $('#txtProductoServicio_maquinaria_descripciones_maquinaria').val(data.row.producto_servicio);
			                $('#txtUnidad_maquinaria_descripciones_maquinaria').val(data.row.unidad);
			                $('#txtUnidadID_maquinaria_descripciones_maquinaria').val(data.row.unidad_id);
			                $('#txtObjetoImpuestoID_maquinaria_descripciones_maquinaria').val(data.row.objeto_impuesto_id);
				            $('#txtObjetoImpuesto_maquinaria_descripciones_maquinaria').val(data.row.objeto_impuesto);
			                $('#txtDescripcionCorta_maquinaria_descripciones_maquinaria').val(data.row.descripcion_corta);
			                $('#txtDescripcion_maquinaria_descripciones_maquinaria').val(data.row.descripcion);
			                
			                //Si la descripción es un servicio
			                if(data.row.servicio == 'SI')
			                {
			                	//Marcar (Seleccionar) checkbox para indicar que la descripción es un servicio
   					   			$('#chbServicio_maquinaria_descripciones_maquinaria').prop("checked", true);
			                }

			                $('#txtMaquinariaLineaID_maquinaria_descripciones_maquinaria').val(data.row.maquinaria_linea_id);
			                $('#txtMaquinariaLinea_maquinaria_descripciones_maquinaria').val(data.row.maquinaria_linea);
			                $('#txtMaquinariaMarcaID_maquinaria_descripciones_maquinaria').val(data.row.maquinaria_marca_id);
			                $('#txtMaquinariaMarca_maquinaria_descripciones_maquinaria').val(data.row.maquinaria_marca);
			                $('#txtMaquinariaModeloID_maquinaria_descripciones_maquinaria').val(data.row.maquinaria_modelo_id);
			                $('#txtMaquinariaModelo_maquinaria_descripciones_maquinaria').val(data.row.maquinaria_modelo);
			                $('#txtMesesGarantia_maquinaria_descripciones_maquinaria').val(data.row.meses_garantia);
			                $('#txtHorasGarantia_maquinaria_descripciones_maquinaria').val(data.row.horas_garantia);
			                //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtHorasGarantia_maquinaria_descripciones_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });

					        $('#cmbMonedaID_maquinaria_descripciones_maquinaria').val(data.row.moneda_id);
			                $('#txtTasaCuotaIva_maquinaria_descripciones_maquinaria').val(data.row.tasa_cuota_iva);
			                $('#txtPorcentajeIva_maquinaria_descripciones_maquinaria').val(data.row.porcentaje_iva);
			                $('#txtTasaCuotaIeps_maquinaria_descripciones_maquinaria').val(data.row.tasa_cuota_ieps);
			                $('#txtPorcentajeIeps_maquinaria_descripciones_maquinaria').val(data.row.porcentaje_ieps);
			                //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_maquinaria_descripciones_maquinaria').addClass("estatus-"+strEstatus);

				             //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_maquinaria_descripciones_maquinaria").show();
				            	

				            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Ver Aditamentos'" +
												 " onclick='ver_aditamentos_renglon_detalles_maquinaria_descripciones_maquinaria(this)'>" +
												 "<span class='glyphicon glyphicon-cog'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_componentes_maquinaria_descripciones_maquinaria(this)'>" +
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmMaquinariaDescripcionesMaquinaria').find('input, textarea, select').attr('disabled','disabled');
			            		 //Deshabilitar botón Agregar
	    						$('#btnAgregarComp_componentes_maquinaria_descripciones_maquinaria').prop('disabled', true); 
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_maquinaria_descripciones_maquinaria").hide(); 

								//Mostrar botón Restaurar
								$("#btnRestaurar_maquinaria_descripciones_maquinaria").show();
							}

			                //Agregar componentes al GRID de Componentes en caso de que aplique
			                if(data.detalles){
			                	//Mostramos los detalles del registro
					           	for (var intCon in data.detalles) 
					            {	
					            	//Obtenemos el objeto de la tabla
									var objTabla = document.getElementById('dg_componentes_maquinaria_descripciones_maquinaria').getElementsByTagName('tbody')[0];
									
									//Insertamos el renglón con sus celdas en el objeto de la tabla
									var objRenglon = objTabla.insertRow();
									var objCeldaCodigo = objRenglon.insertCell(0);
									var objCeldaDescripcionCorta = objRenglon.insertCell(1);
									var objCeldaAcciones = objRenglon.insertCell(2);
									var objCeldaMaquinariaDescripcionID = objRenglon.insertCell(3);

									//Asignar valores
									objRenglon.setAttribute('class', 'movil');
									objRenglon.setAttribute('id', data.detalles[intCon].codigo); 
									objCeldaCodigo.setAttribute('class', 'movil b1');
									objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
									objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
									objCeldaDescripcionCorta.innerHTML = data.detalles[intCon].descripcion_corta;
									objCeldaAcciones.setAttribute('class', 'td-center movil b3');
									objCeldaAcciones.innerHTML = strAccionesTabla; 
									objCeldaMaquinariaDescripcionID.setAttribute('class', 'no-mostrar');
									objCeldaMaquinariaDescripcionID.innerHTML = data.detalles[intCon].referencia_id;	
					            }

								//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
								var intFilas = $("#dg_componentes_maquinaria_descripciones_maquinaria tr").length - 1;
								$('#numElementos_componentes_maquinaria_descripciones_maquinaria').html(intFilas);
			                }

				           

				          

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objMaquinariaDescripcionesMaquinaria = $('#MaquinariaDescripcionesMaquinariaBox').bPopup({
															  appendTo: '#MaquinariaDescripcionesMaquinariaContent', 
								                              contentContainer: 'MaquinariaDescripcionesMaquinariaM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCodigo_maquinaria_descripciones_maquinaria').focus();
					        }
					        
			       	    }
			       },
			       'json');
		
		}



		/*******************************************************************************************************************
		Funciones de la tabla componentes
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_componentes_maquinaria_descripciones_maquinaria()
		{
			var intMaquinariaDescripcionID = $('#txtMaquinariaDescripcionCompID_maquinaria_descripciones_maquinaria').val();
			var strCodigo = $('#txtCodigoComp_maquinaria_descripciones_maquinaria').val();
			var strDescripcionCorta = $('#txtDescripcionCortaComp_maquinaria_descripciones_maquinaria').val();
			
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_componentes_maquinaria_descripciones_maquinaria').getElementsByTagName('tbody')[0];	

			if(intMaquinariaDescripcionID != ''){

				//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
				if (objTabla.rows.namedItem(strCodigo))
				{
					$('#txtCodigoComp_maquinaria_descripciones_maquinaria').focus();
				}
				else
				{
					//Asignamos el número de renglon correspondiente (iniciamos en 0 por cuestión de Indice)
					var renglon = $("#dg_componentes_maquinaria_descripciones_maquinaria tr").length - 1;

					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCodigo = objRenglon.insertCell(0);
					var objCeldaDescripcionCorta = objRenglon.insertCell(1);
					var objCeldaAcciones = objRenglon.insertCell(2);
					var objCeldaMaquinariaDescripcionID = objRenglon.insertCell(3);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strCodigo); 
					objCeldaCodigo.setAttribute('class', 'movil b1');
					objCeldaCodigo.innerHTML = strCodigo;
					objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
					objCeldaDescripcionCorta.innerHTML = strDescripcionCorta;
					objCeldaAcciones.setAttribute('class', 'td-center movil b3');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Ver Aditamentos'" +
												 " onclick='ver_aditamentos_renglon_detalles_maquinaria_descripciones_maquinaria(this)'>" +
												 "<span class='glyphicon glyphicon-cog'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_componentes_maquinaria_descripciones_maquinaria(this)'>" +
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>"; 
					objCeldaMaquinariaDescripcionID.setAttribute('class', 'no-mostrar');
					objCeldaMaquinariaDescripcionID.innerHTML = intMaquinariaDescripcionID;						 

					//Limpiar componentes
					$('#txtMaquinariaDescripcionCompID_maquinaria_descripciones_maquinaria').val('');
					$('#txtCodigoComp_maquinaria_descripciones_maquinaria').val('');
					$('#txtDescripcionCortaComp_maquinaria_descripciones_maquinaria').val('');
				}

			}
			else{
				$('#txtMaquinariaDescripcionCompID_maquinaria_descripciones_maquinaria').focus();
			}

			var intFilas = $("#dg_componentes_maquinaria_descripciones_maquinaria tr").length - 1;
			$('#numElementos_componentes_maquinaria_descripciones_maquinaria').html(intFilas);
			
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_componentes_maquinaria_descripciones_maquinaria(objRenglon)
		{	
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			//Eliminar el renglón indicado
			document.getElementById("dg_componentes_maquinaria_descripciones_maquinaria").deleteRow(intRenglon);
		
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_componentes_maquinaria_descripciones_maquinaria tr").length - 1;
			$('#numElementos_componentes_maquinaria_descripciones_maquinaria').html(intFilas);
			
			//Enfocar caja de texto
			$('#txtCodigoComp_maquinaria_descripciones_maquinaria').focus();

		}

		//Función para Aditamentos del renglón seleccionado
		function ver_aditamentos_renglon_detalles_maquinaria_descripciones_maquinaria(objRenglon){

			//Asignar los valores a las cajas de texto
			$('#txtSerie_detalles_maquinaria_descripciones_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtMotor_detalles_maquinaria_descripciones_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCodigo_detalles_maquinaria_descripciones_maquinaria').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtDescripcionCorta_detalles_maquinaria_descripciones_maquinaria').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);

			nuevo_aditamentos_maquinaria_descripciones_maquinaria('grid');

		}

		/*******************************************************************************************************************
		Funciones del modal secundario
		*********************************************************************************************************************/
		//Agregar aditamentos a una maquinaria
		function nuevo_aditamentos_maquinaria_descripciones_maquinaria(tipo){

			inicializar_aditamentos_detalles_maquinaria_descripciones_maquinaria();
			if($('#txtSerie_detalles_maquinaria_descripciones_maquinaria').val() != '' || tipo == 'grid'){

				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModalSecundario_maquinaria_descripciones_maquinaria').addClass("estatus-NUEVO");
				//Abrir modal secundario
				 objAditamentosMaquinariaDescripcionesMaquinaria = $('#AditamentosMaquinariaDescripcionesMaquinariaBox').bPopup({
											   appendTo: '#MaquinariaDescripcionesMaquinariaContent', 
				                               contentContainer: 'AditamentosMaquinariaDescripcionesMaquinariaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				
				//Asignar los valores que vienen del modal primario
				$('#txtCodigoAditamentos_maquinaria_descripciones_maquinaria').val($('#txtCodigo_detalles_maquinaria_descripciones_maquinaria').val()); 
				$('#txtDescripcionAditamentos_maquinaria_descripciones_maquinaria').val($('#txtDescripcionCorta_detalles_maquinaria_descripciones_maquinaria').val());
				$('#txtSerieAditamentos_maquinaria_descripciones_maquinaria').val($('#txtSerie_detalles_maquinaria_descripciones_maquinaria').val());
				$('#txtMotorAditamentos_maquinaria_descripciones_maquinaria').val($('#txtMotor_detalles_maquinaria_descripciones_maquinaria').val());

				//Consultar si la serie contiene aditamentos 
				//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	              $.post('maquinaria/salidas_maquinaria_traspaso/get_aditamentos',
	                  { 
	                  	strSerie: $("#txtSerieAditamentos_maquinaria_descripciones_maquinaria").val()
	                  },
	                  function(data) {

	                  	//Si se econtró información
	                    if(data){

	                    	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_aditamentos_detalles_maquinaria_descripciones_maquinaria').getElementsByTagName('tbody')[0];

	                    	for (var intCon in data) 
					        {
					        	//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaCantidad = objRenglon.insertCell(0);
								var objCeldaDescripcion = objRenglon.insertCell(1);
								
								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data[intCon].renglon);
								objCeldaCantidad.setAttribute('class', 'movil b1');
								objCeldaCantidad.innerHTML = data[intCon].cantidad;
								objCeldaDescripcion.setAttribute('class', 'movil b2');
								objCeldaDescripcion.innerHTML = data[intCon].descripcion;
					        }

					        var intFilas = $("#dg_aditamentos_detalles_maquinaria_descripciones_maquinaria tr").length - 1;
							$('#numElementos_detalles_aditamentos_maquinaria_descripciones_maquinaria').html(intFilas);

	                    }
	                }
	                 ,
	                'json');

			}

		}

		//Función que se utiliza para cerrar el modal secundario
		function cerrar_aditamentos_maquinaria_descripciones_maquinaria()
		{
			try {
				//Cerrar modal
				objAditamentosMaquinariaDescripcionesMaquinaria.close();
				//Enfocar caja de texto 
				$('#txtCodigo_detalles_maquinaria_descripciones_maquinaria').focus();	
			}
			catch(err) {}
		}

		//Función para inicializar elementos de la tabla detalles
		function inicializar_aditamentos_detalles_maquinaria_descripciones_maquinaria()
		{
			//Eliminar los datos de la tabla
			$('#dg_aditamentos_detalles_maquinaria_descripciones_maquinaria tbody').empty();
			$('#numElementos_detalles_aditamentos_maquinaria_descripciones_maquinaria').html(0);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
	        $('#txtMesesGarantia_maquinaria_descripciones_maquinaria').numeric({decimal: false, negative: false});
	        //Validar campos decimales (no hay necesidad de poner '.')
	        $('#txtHorasGarantia_maquinaria_descripciones_maquinaria').numeric();
	        $('#txtPorcentajeIva_maquinaria_descripciones_maquinaria').numeric();
			$('#txtPorcentajeIeps_maquinaria_descripciones_maquinaria').numeric();

	        /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_maquinaria_descripciones_maquinaria').blur(function(){
				$('.moneda_maquinaria_descripciones_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
			});
        	
			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo_maquinaria_descripciones_maquinaria').focusout(function(e){
				//Si no existe id, verificar la existencia del código
				if ($('#txtMaquinariaDescripcionID_maquinaria_descripciones_maquinaria').val() == '' && $('#txtCodigo_maquinaria_descripciones_maquinaria').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código 
					editar_maquinaria_descripciones_maquinaria($('#txtCodigo_maquinaria_descripciones_maquinaria').val(), 'codigo', 'Nuevo');
				}
			});

	        //Autocomplete para recuperar los datos de una línea de maquinaria
	        $('#txtMaquinariaLinea_maquinaria_descripciones_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtMaquinariaLineaID_maquinaria_descripciones_maquinaria').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "maquinaria/maquinaria_lineas/autocomplete",
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
	               $('#txtMaquinariaLineaID_maquinaria_descripciones_maquinaria').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la línea de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMaquinariaLinea_maquinaria_descripciones_maquinaria').focusout(function(e){
	            //Si no existe id de la línea de maquinaria
	            if($('#txtMaquinariaLineaID_maquinaria_descripciones_maquinaria').val() == '' ||
	               $('#txtMaquinariaLinea_maquinaria_descripciones_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaLineaID_maquinaria_descripciones_maquinaria').val('');
	               $('#txtMaquinariaLinea_maquinaria_descripciones_maquinaria').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una marca de maquinaria
	        $('#txtMaquinariaMarca_maquinaria_descripciones_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtMaquinariaMarcaID_maquinaria_descripciones_maquinaria').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "maquinaria/maquinaria_marcas/autocomplete",
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
	               $('#txtMaquinariaMarcaID_maquinaria_descripciones_maquinaria').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la marca de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMaquinariaMarca_maquinaria_descripciones_maquinaria').focusout(function(e){
	            //Si no existe id de la marca de maquinaria
	            if($('#txtMaquinariaMarcaID_maquinaria_descripciones_maquinaria').val() == '' ||
	               $('#txtMaquinariaMarca_maquinaria_descripciones_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaMarcaID_maquinaria_descripciones_maquinaria').val('');
	               $('#txtMaquinariaMarca_maquinaria_descripciones_maquinaria').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un modelo de maquinaria
	        $('#txtMaquinariaModelo_maquinaria_descripciones_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro  
	                 $('#txtMaquinariaModeloID_maquinaria_descripciones_maquinaria').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "maquinaria/maquinaria_modelos/autocomplete",
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
	               $('#txtMaquinariaModeloID_maquinaria_descripciones_maquinaria').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del modelo de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMaquinariaModelo_maquinaria_descripciones_maquinaria').focusout(function(e){
	            //Si no existe id  del modelo de maquinaria
	            if($('#txtMaquinariaModeloID_maquinaria_descripciones_maquinaria').val() == '' ||
	            	$('#txtMaquinariaModelo_maquinaria_descripciones_maquinaria').val() == '' )
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaModeloID_maquinaria_descripciones_maquinaria').val('');
	               $('#txtMaquinariaModelo_maquinaria_descripciones_maquinaria').val('');
	            }
	            
	        });

	        
	        //Autocomplete para recuperar los datos de un producto o servicio
	        $('#txtProductoServicio_maquinaria_descripciones_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtProductoServicioID_maquinaria_descripciones_maquinaria').val('');
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
	               $('#txtProductoServicioID_maquinaria_descripciones_maquinaria').val(ui.item.data);
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
	        $('#txtProductoServicio_maquinaria_descripciones_maquinaria').focusout(function(e){
	            //Si no existe id del producto
	            if($('#txtProductoServicioID_maquinaria_descripciones_maquinaria').val() == '' ||
	               $('#txtProductoServicio_maquinaria_descripciones_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProductoServicioID_maquinaria_descripciones_maquinaria').val('');
	               $('#txtProductoServicio_maquinaria_descripciones_maquinaria').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una unidad
	        $('#txtUnidad_maquinaria_descripciones_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtUnidadID_maquinaria_descripciones_maquinaria').val('');
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
	               $('#txtUnidadID_maquinaria_descripciones_maquinaria').val(ui.item.data);
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
	        $('#txtUnidad_maquinaria_descripciones_maquinaria').focusout(function(e){
	            //Si no existe id de la unidad
	            if($('#txtUnidadID_maquinaria_descripciones_maquinaria').val() == '' ||
	               $('#txtUnidad_maquinaria_descripciones_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUnidadID_maquinaria_descripciones_maquinaria').val('');
	               $('#txtUnidad_maquinaria_descripciones_maquinaria').val('');
	            }
	            
	        });


	         //Autocomplete para recuperar los datos de un objeto de impuesto
	        $('#txtObjetoImpuesto_maquinaria_descripciones_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtObjetoImpuestoID_maquinaria_descripciones_maquinaria').val('');
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
	               $('#txtObjetoImpuestoID_maquinaria_descripciones_maquinaria').val(ui.item.data);
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
	        $('#txtObjetoImpuesto_maquinaria_descripciones_maquinaria').focusout(function(e){
	            //Si no existe id del objeto de impuesto
	            if($('#txtObjetoImpuestoID_maquinaria_descripciones_maquinaria').val() == '' ||
	               $('#txtObjetoImpuesto_maquinaria_descripciones_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtObjetoImpuestoID_maquinaria_descripciones_maquinaria').val('');
	               $('#txtObjetoImpuesto_maquinaria_descripciones_maquinaria').val('');
	            }
	            
	        });

	         //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_maquinaria_descripciones_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_maquinaria_descripciones_maquinaria').val('');
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
	             $('#txtTasaCuotaIva_maquinaria_descripciones_maquinaria').val(ui.item.data);
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
	        $('#txtPorcentajeIva_maquinaria_descripciones_maquinaria').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_maquinaria_descripciones_maquinaria').val() == '' ||
	               $('#txtPorcentajeIva_maquinaria_descripciones_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_maquinaria_descripciones_maquinaria').val('');
	               $('#txtPorcentajeIva_maquinaria_descripciones_maquinaria').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_maquinaria_descripciones_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_maquinaria_descripciones_maquinaria').val('');
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
	             $('#txtTasaCuotaIeps_maquinaria_descripciones_maquinaria').val(ui.item.data);
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
	        $('#txtPorcentajeIeps_maquinaria_descripciones_maquinaria').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_maquinaria_descripciones_maquinaria').val() == '' ||
	               $('#txtPorcentajeIeps_maquinaria_descripciones_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_maquinaria_descripciones_maquinaria').val('');
	               $('#txtPorcentajeIeps_maquinaria_descripciones_maquinaria').val('');
	            }
	            
	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_componentes_maquinaria_descripciones_maquinaria').on('click','button.btn',function(){
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


		    //Autocomplete para recuperar los datos de un componente
	        $('#txtCodigoComp_maquinaria_descripciones_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtMaquinariaDescripcionCompID_maquinaria_descripciones_maquinaria').val('');
	               $('#txtDescripcionCortaComp_maquinaria_descripciones_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "maquinaria/maquinaria_descripciones/autocomplete",
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
	           	  $('#txtMaquinariaDescripcionCompID_maquinaria_descripciones_maquinaria').val(ui.item.data); 

	           	  //Separar datos del valor devuelto en el autocomplete (devuelve un arreglo)
	              var arrDatos = ui.item.value.split(" - ");

	               //Elegir código desde el valor devuelto en el autocomplete
					ui.item.value = arrDatos[0];
				   $("#txtDescripcionCortaComp_maquinaria_descripciones_maquinaria").val(arrDatos[1]);

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	         //Verificar que exista id de la descripción de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtCodigoComp_maquinaria_descripciones_maquinaria').focusout(function(e){
	            //Si no existe id de la refacción
	            if($('#txtMaquinariaDescripcionCompID_maquinaria_descripciones_maquinaria').val() == '' ||
	               $('#txtCodigoComp_maquinaria_descripciones_maquinaria').val() == '')
	            { 
	            	//Limpiar caja de texto que hace referencia al id del registro
	                $('#txtMaquinariaDescripcionCompID_maquinaria_descripciones_maquinaria').val('');
	                $('#txtCodigoComp_maquinaria_descripciones_maquinaria').val('');
	                $('#txtDescripcionCortaComp_maquinaria_descripciones_maquinaria').val('');
	            }

	        });

	        //Validar que exista código de maquinaria cuando se pulse la tecla enter 
			$('#txtCodigoComp_maquinaria_descripciones_maquinaria').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	 //Si no existe descripción de la refacción
		            if($('#txtMaquinariaDescripcionCompID_maquinaria_descripciones_maquinaria').val() == '' || $('#txtCodigoComp_maquinaria_descripciones_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtCodigoComp_maquinaria_descripciones_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_componentes_maquinaria_descripciones_maquinaria();
			   	    }
		        }
		    });



			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_maquinaria_descripciones_maquinaria').on('click','a',function(event){
				event.preventDefault();
				intPaginaMaquinariaDescripcionesMaquinaria = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_maquinaria_descripciones_maquinaria();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_maquinaria_descripciones_maquinaria').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_maquinaria_descripciones_maquinaria();
				//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
				cargar_objeto_impuesto_base_maquinaria_descripciones_maquinaria();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_maquinaria_descripciones_maquinaria').addClass("estatus-NUEVO");
				//Abrir modal
				 objMaquinariaDescripcionesMaquinaria = $('#MaquinariaDescripcionesMaquinariaBox').bPopup({
											   appendTo: '#MaquinariaDescripcionesMaquinariaContent', 
				                               contentContainer: 'MaquinariaDescripcionesMaquinariaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_maquinaria_descripciones_maquinaria').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_maquinaria_descripciones_maquinaria').focus();      
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_maquinaria_descripciones_maquinaria();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_maquinaria_descripciones_maquinaria();
		});
	</script>