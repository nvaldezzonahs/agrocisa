	<div id="CotizacionesServicioServicioContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_cotizaciones_servicio_servicio" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_cotizaciones_servicio_servicio" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_cotizaciones_servicio_servicio">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_cotizaciones_servicio_servicio'>
				                    <input class="form-control" id="txtFechaInicialBusq_cotizaciones_servicio_servicio"
				                    		name= "strFechaInicialBusq_cotizaciones_servicio_servicio" 
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
								<label for="txtFechaFinalBusq_cotizaciones_servicio_servicio">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_cotizaciones_servicio_servicio'>
				                    <input class="form-control" id="txtFechaFinalBusq_cotizaciones_servicio_servicio"
				                    		name= "strFechaFinalBusq_cotizaciones_servicio_servicio" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los Prospectos activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del Prospecto seleccionado-->
								<input id="txtProspectoIDBusq_cotizaciones_servicio_servicio" 
									   name="intProspectoIDBusq_cotizaciones_servicio_servicio"  type="hidden" 
									   value="">
								</input>
								<label for="txtProspectoBusq_cotizaciones_servicio_servicio">Prospecto / Cliente</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProspectoBusq_cotizaciones_servicio_servicio" 
										name="strProspectoBusq_cotizaciones_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese prospecto o cliente" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_cotizaciones_servicio_servicio">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_cotizaciones_servicio_servicio" 
								 		name="strEstatusBusq_cotizaciones_servicio_servicio" tabindex="1">
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
								<label for="txtBusqueda_cotizaciones_servicio_servicio">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_cotizaciones_servicio_servicio" 
										name="strBusqueda_cotizaciones_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_cotizaciones_servicio_servicio" 
									   name="strImprimirDetalles_cotizaciones_servicio_servicio" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_cotizaciones_servicio_servicio"
									onclick="paginacion_cotizaciones_servicio_servicio();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_cotizaciones_servicio_servicio" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_cotizaciones_servicio_servicio"
									onclick="reporte_cotizaciones_servicio_servicio('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_cotizaciones_servicio_servicio"
									onclick="reporte_cotizaciones_servicio_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla cotizaciones
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Prospecto / Cliente"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla servicios de mano de obra
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Horas"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Total"; font-weight: bold;}
				td.movil.b10:nth-of-type(10):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla servicios de mano de obra
				*/
				td.movil.tb1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.tb2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.tb3:nth-of-type(3):before {content: "Horas"; font-weight: bold;}
				td.movil.tb4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.tb5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.tb6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.tb7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.tb8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.tb9:nth-of-type(9):before {content: "Total"; font-weight: bold;}

				/*
				Definir columnas de la tabla refacciones
				*/
				td.movil.c1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.c3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.c4:nth-of-type(4):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.c5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.c6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.c7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.c8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.c9:nth-of-type(9):before {content: "Total"; font-weight: bold;}
				td.movil.c10:nth-of-type(10):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla refacciones
				*/
				td.movil.tc1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.tc2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.tc3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.tc4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.tc5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.tc6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.tc7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.tc8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.tc9:nth-of-type(9):before {content: "Total"; font-weight: bold;}

				/*
				Definir columnas de la tabla trabajos foráneos
				*/
				td.movil.d1:nth-of-type(1):before {content: "Concepto"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.d5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.d6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.d7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.d8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.d9:nth-of-type(9):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla trabajos foráneos
				*/
				td.movil.td1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.td2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.td3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.td4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.td5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.td6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.td7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.td8:nth-of-type(8):before {content: "Total"; font-weight: bold;}


				/*
				Definir columnas de la tabla otros servicios
				*/
				td.movil.e1:nth-of-type(1):before {content: "Concepto"; font-weight: bold;}
				td.movil.e2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.e3:nth-of-type(3):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.e4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.e5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.e6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.e7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.e8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.e9:nth-of-type(9):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla otros servicios
				*/
				td.movil.te1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.te2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.te3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.te4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.te5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.te6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.te7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.te8:nth-of-type(8):before {content: "Total"; font-weight: bold;}

			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_cotizaciones_servicio_servicio">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Prospecto / Cliente</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_cotizaciones_servicio_servicio" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{prospecto}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_cotizaciones_servicio_servicio({{cotizacion_servicio_id}});"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_cotizaciones_servicio_servicio({{cotizacion_servicio_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_prospecto_cotizaciones_servicio_servicio({{cotizacion_servicio_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_cotizaciones_servicio_servicio({{cotizacion_servicio_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_cotizaciones_servicio_servicio({{cotizacion_servicio_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_cotizaciones_servicio_servicio({{cotizacion_servicio_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_cotizaciones_servicio_servicio"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_cotizaciones_servicio_servicio">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Cotizaciones-->
		<div id="CotizacionesServicioServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_cotizaciones_servicio_servicio"  class="ModalBodyTitle">
			<h1>Cotizaciones</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_cotizaciones_servicio_servicio" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_cotizaciones_servicio_servicio" class="active">
									<a data-toggle="tab" href="#informacion_general_cotizaciones_servicio_servicio">Información General</a>
								</li>
								<!--Tab que contiene la información de la mano de obra-->
								<li id="tabManoObra_cotizaciones_servicio_servicio">
									<a data-toggle="tab" href="#mano_obra_cotizaciones_servicio_servicio">Mano de Obra</a>
								</li>
								<!--Tab que contiene la información de las salidas de refacciones internas-->
								<li id="tabRefacciones_cotizaciones_servicio_servicio">
									<a data-toggle="tab" href="#refacciones_cotizaciones_servicio_servicio">Refacciones</a>
								</li>
								<!--Tab que contiene la información de los trabajos foráneos-->
								<li id="tabTrabajosForaneos_cotizaciones_servicio_servicio">
									<a data-toggle="tab" href="#trabajos_foraneos_cotizaciones_servicio_servicio">Trabajos Foráneos</a>
								</li>
								<!--Tab que contiene la información de otros-->
								<li id="tabOtros_cotizaciones_servicio_servicio">
									<a data-toggle="tab" href="#otros_cotizaciones_servicio_servicio">Otros</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmCotizacionesServicioServicio" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmCotizacionesServicioServicio"  onsubmit="return(false)" 
					  autocomplete="off" >

					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_cotizaciones_servicio_servicio" class="tab-pane fade in active">
							<div class="row">
								<!--Folio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtCotizacionServicioID_cotizaciones_servicio_servicio" 
												   name="intCotizacionServicioID_cotizaciones_servicio_servicio" 
												   type="hidden" 
												   value="" />
											<label for="txtFolio_cotizaciones_servicio_servicio">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_cotizaciones_servicio_servicio" 
													name="strFolio_cotizaciones_servicio_servicio" type="text" value="" 
													placeholder="Autogenerado" disabled />
										</div>
									</div>
								</div>
								<!-- Fecha -->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_cotizaciones_servicio_servicio">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_cotizaciones_servicio_servicio'>
							                    <input class="form-control" 
							                    		id="txtFecha_cotizaciones_servicio_servicio"
							                    		name= "strFecha_cotizaciones_servicio_servicio" 
							                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10" />
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
											<label for="cmbMonedaID_cotizaciones_servicio_servicio">Moneda</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbMonedaID_cotizaciones_servicio_servicio" 
											 		name="intMonedaID_cotizaciones_servicio_servicio" tabindex="1">
		                     				</select>
										</div>
									</div>
								</div>
								<!--Tipo de cambio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTipoCambio_cotizaciones_servicio_servicio">Tipo de cambio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control tipo-cambio_cotizaciones_servicio_servicio" id="txtTipoCambio_cotizaciones_servicio_servicio" 
													name="intTipoCambio_cotizaciones_servicio_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete para seleccionar un Prospecto/Cliente activo-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del  Cliente seleccionado-->
											<input id="txtProspectoID_cotizaciones_servicio_servicio" 
												   name="intProspectoID_cotizaciones_servicio_servicio"  type="hidden" value="">
										    </input>
										    <!-- Caja de texto oculta que se utiliza para recuperar el id de la lista de precios correspondiente al cliente seleccionado-->
											<input id="txtServicioListaPrecioID_cotizaciones_servicio_servicio" 
												   name="intServicioListaPrecioID_cotizaciones_servicio_servicio"  type="hidden" 
												   value="">
											</input>
											<label for="txtProspecto_cotizaciones_servicio_servicio">Prospecto / Cliente</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtProspecto_cotizaciones_servicio_servicio" 
													name="strProspecto_cotizaciones_servicio_servicio" 
													type="text" 
													value="" 
													tabindex="1" 
													placeholder="Ingrese prospecto o cliente" 
													maxlength="250" />
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
                       			<!--Autocomplete que contiene los tipos de servicios activos-->
                       			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                       				<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del tipo de servicio seleccionado-->
											<input id="txtServicioTipoID_cotizaciones_servicio_servicio" 
												   name="intServicioTipoID_cotizaciones_servicio_servicio"  
												   type="hidden" 
												   value="" />
											<label for="txtServicioTipo_cotizaciones_servicio_servicio">Tipo de servicio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtServicioTipo_cotizaciones_servicio_servicio" 
													name="strServicioTipo_cotizaciones_servicio_servicio" 
													type="text" 
													value="" 
													tabindex="1" 
													placeholder="Ingrese tipo de servicio" 
													maxlength="250" />
										</div>
									</div>
                       			</div>
                       			<!--Autocomplete que contiene los tipos de equipos activos-->
                       			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                       				<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del tipo de equipo seleccionado-->
											<input id="txtEquipoTipoID_cotizaciones_servicio_servicio" 
												   name="intEquipoTipoID_cotizaciones_servicio_servicio"  
												   type="hidden" 
												   value="" />
											<label for="txtEquipoTipo_cotizaciones_servicio_servicio">Tipo de equipo</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtEquipoTipo_cotizaciones_servicio_servicio" 
													name="strEquipoTipo_cotizaciones_servicio_servicio" 
													type="text" 
													value="" 
													tabindex="1" 
													placeholder="Ingrese tipo de equipo" 
													maxlength="250" />
										</div>
									</div>
                       			</div>	
                       		</div>
                       		<div class="row">
                       			<!--Madurez-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbMadurez_cotizaciones_servicio_servicio">Madurez</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbMadurez_cotizaciones_servicio_servicio" 
											 		name="strMadurez_cotizaciones_servicio_servicio" tabindex="1">
											    <option value="">Seleccione una opción</option>
											    <option value="1">1</option>
			                      				<option value="2">2</option>
			                      				<option value="3">3</option>
			                      				<option value="4">4</option>
			                 				</select>
										</div>
									</div>
								</div>
                       			<!--Autocomplete para seleccionar una estrategia-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la Estrategia seleccionada-->
											<input id="txtEstrategiaID_cotizaciones_servicio_servicio" 
												   name="intEstrategiaID_cotizaciones_servicio_servicio"  
												   type="hidden" 
												   value="" />
											<label for="txtEstrategia_cotizaciones_servicio_servicio">Estrategia</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtEstrategia_cotizaciones_servicio_servicio" 
													name="strEstrategia_cotizaciones_servicio_servicio" 
													type="text" 
													value="" 
													tabindex="1" 
													placeholder="Ingrese estrategia" 
													maxlength="250" />
										</div>
									</div>
								</div>
								<!--Gastos del servicio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el subtotal desglosado con base al importe capturado-->
											<input id="txtGastosServicioSubtotal_cotizaciones_servicio_servicio" 
												   name="intGastosServicioSubtotal_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el IVA desglosado con base al importe capturado-->
											<input id="txtGastosServicioIva_cotizaciones_servicio_servicio" 
												   name="intGastosServicioIva_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtGastosServicio_cotizaciones_servicio_servicio">Gastos de servicio</label>
										</div>
										<div class="col-md-12">
											<div class='input-group'>
												<span class="input-group-addon">$</span>
												<input  class="form-control moneda_cotizaciones_servicio_servicio" id="txtGastosServicio_cotizaciones_servicio_servicio" 
														name="intGastosServicio_cotizaciones_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="12">
												</input>
												
											</div>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
                       			<!--Observaciones-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObservaciones_cotizaciones_servicio_servicio">Observaciones</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtObservaciones_cotizaciones_servicio_servicio" 
													name="strObservaciones_cotizaciones_servicio_servicio" 
													type="text" 
													value="" 
													tabindex="1" 
													placeholder="Ingrese observaciones" 
													maxlength="250" />
										</div>
									</div>
								</div>
								<!--Notas-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNotas_cotizaciones_servicio_servicio">Notas</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtNotas_cotizaciones_servicio_servicio" 
													name="strNotas_cotizaciones_servicio_servicio" 
													type="text" 
													value="" 
													tabindex="1" 
													placeholder="Ingrese notas" 
													maxlength="250" />
										</div>
									</div>
								</div>
							</div>
                       	</div><!--Cierre Tab - Información General-->
                       	<!--Tab - Mano de Obra -->
                       	<div id="mano_obra_cotizaciones_servicio_servicio" class="tab-pane fade">
                       		<div class="row">
                       			<!--Autocomplete que contiene los servicios activos-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
											<input id="txtRenglon_mano_obra_cotizaciones_servicio_servicio" name="intRenglon_mano_obra_cotizaciones_servicio_servicio"  
												   type="hidden" value="">
										    </input>
											<!-- Caja de texto oculta para recuperar el id del servicio seleccionado-->
											<input id="txtServicioID_mano_obra_cotizaciones_servicio_servicio" 
												   name="intServicioID_mano_obra_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtCodigo_mano_obra_cotizaciones_servicio_servicio">Código</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" 
												   id="txtCodigo_mano_obra_cotizaciones_servicio_servicio"
												   name="strCodigo_mano_obra_cotizaciones_servicio_servicio" 
												   type="text" 
												   value="" 
												   tabindex="1" 
												   placeholder="Ingrese código" 
												   maxlength="250" />
										</div>
									</div>
								</div>
								<!--Descripción-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtDescripcion_mano_obra_cotizaciones_servicio_servicio">Descripción</label>
										</div>
										<div class="col-md-12">
											<input 	class="form-control" 
													id="txtDescripcion_mano_obra_cotizaciones_servicio_servicio"
												   	name="strDescripcion_mano_obra_cotizaciones_servicio_servicio" 
												   	type="text" 
												   	value="" 
												   	tabindex="1" 
												   	placeholder="Ingrese descripción" 
												   	maxlength="250" />
										</div>
									</div>
								</div>	
                       		</div>
                       		<div class="row">
                       			<!--Horas-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHoras_mano_obra_cotizaciones_servicio_servicio">Horas</label>
										</div>
										<div class="col-md-12">
											<input 	class="form-control cantidad_cotizaciones_servicio_servicio" 
													id="txtHoras_mano_obra_cotizaciones_servicio_servicio"
												   	name="intHoras_mano_obra_cotizaciones_servicio_servicio" 
												   	type="text" 
												   	value="" />
										</div>
									</div>
								</div>
                       			<!--Precio unitario-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPrecioUnitario_mano_obra_cotizaciones_servicio_servicio">Precio unitario</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control moneda_cotizaciones_servicio_servicio" id="txtPrecioUnitario_mano_obra_cotizaciones_servicio_servicio" 
													name="intPrecioUnitario_mano_obra_cotizaciones_servicio_servicio" type="text" value="">
											</input>
										</div>
									</div>
								</div>
								<!--Porcentaje del descuento-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio">Descuento %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control cantidad_cotizaciones_servicio_servicio" id="txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio" 
													name="intPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio" type="text" value="0.00" 
													tabindex="1" placeholder="Ingrese descuento" maxlength="15">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIva_mano_obra_cotizaciones_servicio_servicio" 
												   name="intTasaCuotaIva_mano_obra_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio">IVA %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio" 
													name="intPorcentajeIva_mano_obra_cotizaciones_servicio_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese IVA" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIeps_mano_obra_cotizaciones_servicio_servicio" 
												   name="intTasaCuotaIeps_mano_obra_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio">IEPS %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio" 
													name="intPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Botón agregar-->
                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
                                	<button class="btn btn-primary btn-toolBtns pull-right" 
                                			id="btnAgregar_mano_obra_cotizaciones_servicio_servicio"
                                			onclick="agregar_renglon_mano_obra_cotizaciones_servicio_servicio();" 
                                	     	title="Agregar" tabindex="1"> 
                                		<span class="glyphicon glyphicon-plus"></span>
                                	</button>
                             	</div>
                       		</div>
                       		<div class="form-group row">
								<!--Div que contiene la tabla con los servicios de mano de obra encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
										<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
										<input id="txtNumDetalles_mano_obra_cotizaciones_servicio_servicio" 
											   name="intNumDetalles_mano_obra_cotizaciones_servicio_servicio" type="hidden" value="">
										</input>
										<!-- Diseño de la tabla-->
										<table class="table-hover movil" id="dg_mano_obra_cotizaciones_servicio_servicio">
											<thead class="movil">
												<tr class="movil">
													<th class="movil">Código</th>
													<th class="movil">Descripción</th>
													<th class="movil">Horas</th>
													<th class="movil">Precio Unit.</th>
													<th class="movil">Desc.</th>
													<th class="movil">Subtotal</th>
													<th class="movil">IVA</th>
													<th class="movil">IEPS</th>
													<th class="movil">Total</th>
													<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
												</tr>
											</thead>
											<tbody class="movil"></tbody>
											<tfoot class="movil">
												<tr class="movil">
													<td class="movil tb1">
														<strong>Total</strong>
													</td>
													<td class="movil tb2"></td>
													<td  class="movil tb3">
														<strong id="acumHoras_mano_obra_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil tb4"></td>
													<td class="movil tb5">
														<strong id="acumDescuento_mano_obra_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil tb6">
														<strong id="acumSubtotal_mano_obra_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil tb7">
														<strong id="acumIva_mano_obra_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil tb8">
														<strong  id="acumIeps_mano_obra_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil tb9">
														<strong id="acumTotal_mano_obra_cotizaciones_servicio_servicio"></strong>
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
													<strong id="numElementos_mano_obra_cotizaciones_servicio_servicio">0</strong> encontrados
												</button>
											</div>
										</div>
								</div>
							</div>
                       	</div><!--Cierre Tab - Mano de Obra -->
                       	<!--Tab - Refacciones -->
                       	<div id="refacciones_cotizaciones_servicio_servicio" class="tab-pane fade">
                       		<div class="row">
								<!--Autocomplete que contiene las refacciones y kits de refacciones activas-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la referencia seleccionada-->
											<input id="txtReferenciaID_refacciones_cotizaciones_servicio_servicio" 
												   name="intReferenciaID_refacciones_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el id del tipo de referencia seleccionada-->
											<input id="txtTipoReferencia_refacciones_cotizaciones_servicio_servicio" 
												   name="strTipoReferencia_refacciones_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el código de la refacción-->
											<input id="txtCodigo_refacciones_cotizaciones_servicio_servicio" 
												   name="strCodigo_refacciones_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar la descripción de la refacción-->
											<input id="txtDescripcion_refacciones_cotizaciones_servicio_servicio" 
												   name="strDescripcion_refacciones_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el precio de la refacción-->
											<input id="txtPrecioRefaccion_refacciones_cotizaciones_servicio_servicio" 
												   name="intPrecioRefaccion_refacciones_cotizaciones_servicio_servicio"  
												   type="hidden" value="">
										    </input>
										    <!-- Caja de texto oculta que se utiliza para recuperar el tipo de cambio de la refacción-->
											<input id="txtTipoCambio_refacciones_cotizaciones_servicio_servicio" 
												   name="intTipoCambio_refacciones_cotizaciones_servicio_servicio"  
												   type="hidden" value="">   
										    </input>
											<label for="txtReferencia_refacciones_cotizaciones_servicio_servicio">
												Refacción
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtReferencia_refacciones_cotizaciones_servicio_servicio" 
													name="strReferencia_refacciones_cotizaciones_servicio_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese refacción" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
                       		<div class="row">
                       			<!--Cantidad-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCantidad_refacciones_cotizaciones_servicio_servicio">Cantidad</label>
										</div>
										<div class="col-md-12">
											<input 	class="form-control cantidad_cotizaciones_servicio_servicio" 
													id="txtCantidad_refacciones_cotizaciones_servicio_servicio"
												   	name="intCantidad_refacciones_cotizaciones_servicio_servicio" 
												   	type="text" 
												   	value="" 
												   	tabindex="1" 
												   	placeholder="Ingrese cantidad" 
												   	maxlength="15" />
										</div>
									</div>
								</div>
                       			<!--Precio unitario-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio">Precio unitario</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control cantidad_cotizaciones_servicio_servicio" 
													id="txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio" 
													name="intPrecioUnitario_refacciones_cotizaciones_servicio_servicio" 
													type="text" 
													value="" 
													tabindex="1" 
													placeholder="" 
													maxlength="15" />
										</div>
									</div>
								</div>
								<!--Porcentaje del descuento-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio">Descuento %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control cantidad_cotizaciones_servicio_servicio" 
													id="txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio" 
													name="intPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio" 
													type="text" 
													value="0.00" 
													tabindex="1" 
													placeholder="Ingrese descuento" 
													maxlength="15" />
										</div>
									</div>
								</div>
								<!--Porcentaje del IVA-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIva_refacciones_cotizaciones_servicio_servicio" 
												   name="intTasaCuotaIva_refacciones_cotizaciones_servicio_servicio" 
												   type="hidden" value="" />
											<label for="txtPorcentajeIva_refacciones_cotizaciones_servicio_servicio">IVA %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtPorcentajeIva_refacciones_cotizaciones_servicio_servicio" 
													name="intPorcentajeIva_refacciones_cotizaciones_servicio_servicio" 
													type="text" disabled/>
										</div>
									</div>
								</div>
								<!--Porcentaje del IEPS-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIeps_refacciones_cotizaciones_servicio_servicio" 
												   name="intTasaCuotaIeps_refacciones_cotizaciones_servicio_servicio" 
												   type="hidden" value="" />
											<label for="txtPorcentajeIeps_refacciones_cotizaciones_servicio_servicio">IEPS %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtPorcentajeIeps_refacciones_cotizaciones_servicio_servicio" 
													name="intPorcentajeIeps_refacciones_cotizaciones_servicio_servicio" 
													type="text" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Botón agregar-->
                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
                                	<button class="btn btn-primary btn-toolBtns pull-right" 
                                			id="btnAgregar_refacciones_cotizaciones_servicio_servicio"
                                			onclick="agregar_renglon_refacciones_cotizaciones_servicio_servicio();" 
                                	     	title="Agregar" tabindex="1"> 
                                		<span class="glyphicon glyphicon-plus"></span>
                                	</button>
                             	</div>
                       		</div>
                       		<div class="form-group row">
								<!--Div que contiene la tabla con las refacciones encontradas-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
										<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
										<input id="txtNumDetalles_refacciones_cotizaciones_servicio_servicio" 
											   name="intNumDetalles_refacciones_cotizaciones_servicio_servicio" type="hidden" value="">
										</input>
										<!-- Diseño de la tabla-->
										<table class="table-hover movil" id="dg_refacciones_cotizaciones_servicio_servicio">
											<thead class="movil">
												<tr class="movil">
													<th class="movil">Código</th>
													<th class="movil">Descripción</th>
													<th class="movil">Cantidad</th>
													<th class="movil">Precio Unit.</th>
													<th class="movil">Desc.</th>
													<th class="movil">Subtotal</th>
													<th class="movil">IVA</th>
													<th class="movil">IEPS</th>
													<th class="movil">Total</th>
													<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
												</tr>
											</thead>
											<tbody class="movil"></tbody>
											<tfoot class="movil">
												<tr class="movil">
													<td class="movil tc1">
														<strong>Total</strong>
													</td>
													<td class="movil tc2"></td>
													<td  class="movil tc3">
														<strong id="acumCantidad_refacciones_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil tc4"></td>
													<td class="movil tc5">
														<strong id="acumDescuento_refacciones_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil tc6">
														<strong id="acumSubtotal_refacciones_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil tc7">
														<strong id="acumIva_refacciones_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil tc8">
														<strong  id="acumIeps_refacciones_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil tc9">
														<strong id="acumTotal_refacciones_cotizaciones_servicio_servicio"></strong>
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
													<strong id="numElementos_refacciones_cotizaciones_servicio_servicio">0</strong> encontrados
												</button>
											</div>
										</div>
								</div>
							</div>
                       	</div><!--Cierre Tab - Refacciones -->
                       	<!--Tab - Trabajos Foráneos -->
                       	<div id="trabajos_foraneos_cotizaciones_servicio_servicio" class="tab-pane fade">
                       		<div class="row">
								<!--Concepto-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
											<input id="txtRenglon_trabajos_foraneos_cotizaciones_servicio_servicio" name="intRenglon_trabajos_foraneos_cotizaciones_servicio_servicio"  
												   type="hidden" value="">
										    </input>
											<label for="txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio">Concepto</label>
										</div>
										<div class="col-md-12">
											<input 	class="form-control" 
													id="txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio"
												   	name="strConcepto_trabajos_foraneos_cotizaciones_servicio_servicio" 
												   	type="text" 
												   	value="" 
												   	tabindex="1" 
												   	placeholder="Ingrese concepto" 
												   	maxlength="250" />
										</div>
									</div>
								</div>	
                       		</div>
                       		<div class="row">
                       			<!--Cantidad-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio">Cantidad</label>
										</div>
										<div class="col-md-12">
											<input 	class="form-control cantidad_cotizaciones_servicio_servicio" 
													id="txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio"
												   	name="intCantidad_trabajos_foraneos_cotizaciones_servicio_servicio" 
												   	type="text" 
												   	value="" 
												   	tabindex="1" 
												   	placeholder="Ingrese cantidad" 
												   	maxlength="15" />
										</div>
									</div>
								</div>
                       			<!--Precio unitario-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio">Precio unitario</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control moneda_cotizaciones_servicio_servicio" id="txtPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio" 
													name="intPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese precio unitario" maxlength="15">
											</input>
										</div>
									</div>
								</div>
								<!--Porcentaje del descuento-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio">Descuento %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control cantidad_cotizaciones_servicio_servicio" id="txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio" 
													name="intPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio" type="text" value="0.00" 
													tabindex="1" placeholder="Ingrese descuento" maxlength="15">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIva_trabajos_foraneos_cotizaciones_servicio_servicio" 
												   name="intTasaCuotaIva_trabajos_foraneos_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio">IVA %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio" 
													name="intPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese IVA" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIeps_trabajos_foraneos_cotizaciones_servicio_servicio" 
												   name="intTasaCuotaIeps_trabajos_foraneos_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio">IEPS %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio" 
													name="intPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Botón agregar-->
                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
                                	<button class="btn btn-primary btn-toolBtns pull-right" 
                                			id="btnAgregar_trabajos_foraneos_cotizaciones_servicio_servicio"
                                			onclick="agregar_renglon_trabajos_foraneos_cotizaciones_servicio_servicio();" 
                                	     	title="Agregar" tabindex="1"> 
                                		<span class="glyphicon glyphicon-plus"></span>
                                	</button>
                             	</div>
                       		</div>
                       		<div class="form-group row">
								<!--Div que contiene la tabla con los trabajos foráneos encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
										<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
										<input id="txtNumDetalles_trabajos_foraneos_cotizaciones_servicio_servicio" 
											   name="intNumDetalles_trabajos_foraneos_cotizaciones_servicio_servicio" type="hidden" value="">
										</input>
										<!-- Diseño de la tabla-->
										<table class="table-hover movil" id="dg_trabajos_foraneos_cotizaciones_servicio_servicio">
											<thead class="movil">
												<tr class="movil">
													<th class="movil">Concepto</th>
													<th class="movil">Cantidad</th>
													<th class="movil">Precio Unit.</th>
													<th class="movil">Desc.</th>
													<th class="movil">Subtotal</th>
													<th class="movil">IVA</th>
													<th class="movil">IEPS</th>
													<th class="movil">Total</th>
													<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
												</tr>
											</thead>
											<tbody class="movil"></tbody>
											<tfoot class="movil">
												<tr class="movil">
													<td class="movil td1">
														<strong>Total</strong>
													</td>
													<td  class="movil td2">
														<strong id="acumCantidad_trabajos_foraneos_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil td3"></td>
													<td class="movil td4">
														<strong id="acumDescuento_trabajos_foraneos_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil td5">
														<strong id="acumSubtotal_trabajos_foraneos_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil td6">
														<strong id="acumIva_trabajos_foraneos_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil td7">
														<strong  id="acumIeps_trabajos_foraneos_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil td8">
														<strong id="acumTotal_trabajos_foraneos_cotizaciones_servicio_servicio"></strong>
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
													<strong id="numElementos_trabajos_foraneos_cotizaciones_servicio_servicio">0</strong> encontrados
												</button>
											</div>
										</div>
								</div>
							</div>
                       	</div><!--Cierre Tab - Trabajos Foráneos -->
                       	<!--Tab - Otros -->
                       	<div id="otros_cotizaciones_servicio_servicio" class="tab-pane fade">
                       		<div class="row">
								<!--Concepto-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
											<input id="txtRenglon_otros_cotizaciones_servicio_servicio" name="intRenglon_otros_cotizaciones_servicio_servicio"  
												   type="hidden" value="">
										    </input>
											<label for="txtConcepto_otros_cotizaciones_servicio_servicio">Concepto</label>
										</div>
										<div class="col-md-12">
											<input 	class="form-control" 
													id="txtConcepto_otros_cotizaciones_servicio_servicio"
												   	name="strConcepto_otros_cotizaciones_servicio_servicio" 
												   	type="text" 
												   	value="" 
												   	tabindex="1" 
												   	placeholder="Ingrese concepto" 
												   	maxlength="250" />
										</div>
									</div>
								</div>	
                       		</div>
                       		<div class="row">
                       			<!--Cantidad-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCantidad_otros_cotizaciones_servicio_servicio">Cantidad</label>
										</div>
										<div class="col-md-12">
											<input 	class="form-control cantidad_cotizaciones_servicio_servicio" 
													id="txtCantidad_otros_cotizaciones_servicio_servicio"
												   	name="intCantidad_otros_cotizaciones_servicio_servicio" 
												   	type="text" 
												   	value="" 
												   	tabindex="1" 
												   	placeholder="Ingrese cantidad" 
												   	maxlength="15" />
										</div>
									</div>
								</div>
                       			<!--Precio unitario-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPrecioUnitario_otros_cotizaciones_servicio_servicio">Precio unitario</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control moneda_cotizaciones_servicio_servicio" id="txtPrecioUnitario_otros_cotizaciones_servicio_servicio" 
													name="intPrecioUnitario_otros_cotizaciones_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese precio unitario" maxlength="15">
											</input>
										</div>
									</div>
								</div>
								<!--Porcentaje del descuento-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio">Descuento %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control cantidad_cotizaciones_servicio_servicio" id="txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio" 
													name="intPorcentajeDescuento_otros_cotizaciones_servicio_servicio" type="text" value="0.00" 
													tabindex="1" placeholder="Ingrese descuento" maxlength="15">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIva_otros_cotizaciones_servicio_servicio" 
												   name="intTasaCuotaIva_otros_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIva_otros_cotizaciones_servicio_servicio">IVA %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIva_otros_cotizaciones_servicio_servicio" 
													name="intPorcentajeIva_otros_cotizaciones_servicio_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese IVA" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIeps_otros_cotizaciones_servicio_servicio" 
												   name="intTasaCuotaIeps_otros_cotizaciones_servicio_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIeps_otros_cotizaciones_servicio_servicio">IEPS %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIeps_otros_cotizaciones_servicio_servicio" 
													name="intPorcentajeIeps_otros_cotizaciones_servicio_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Botón agregar-->
                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
                                	<button class="btn btn-primary btn-toolBtns pull-right" 
                                			id="btnAgregar_otros_cotizaciones_servicio_servicio"
                                			onclick="agregar_renglon_otros_cotizaciones_servicio_servicio();" 
                                	     	title="Agregar" tabindex="1"> 
                                		<span class="glyphicon glyphicon-plus"></span>
                                	</button>
                             	</div>
                       		</div>
                       		<div class="form-group row">
								<!--Div que contiene la tabla con los otros servicios encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
										<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
										<input id="txtNumDetalles_otros_cotizaciones_servicio_servicio" 
											   name="intNumDetalles_otros_cotizaciones_servicio_servicio" type="hidden" value="">
										</input>
										<!-- Diseño de la tabla-->
										<table class="table-hover movil" id="dg_otros_cotizaciones_servicio_servicio">
											<thead class="movil">
												<tr class="movil">
													<th class="movil">Concepto</th>
													<th class="movil">Cantidad</th>
													<th class="movil">Precio Unit.</th>
													<th class="movil">Desc.</th>
													<th class="movil">Subtotal</th>
													<th class="movil">IVA</th>
													<th class="movil">IEPS</th>
													<th class="movil">Total</th>
													<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
												</tr>
											</thead>
											<tbody class="movil"></tbody>
											<tfoot class="movil">
												<tr class="movil">
													<td class="movil te1">
														<strong>Total</strong>
													</td>
													<td  class="movil te2">
														<strong id="acumCantidad_otros_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil te3"></td>
													<td class="movil te4">
														<strong id="acumDescuento_otros_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil te5">
														<strong id="acumSubtotal_otros_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil te6">
														<strong id="acumIva_otros_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil te7">
														<strong  id="acumIeps_otros_cotizaciones_servicio_servicio"></strong>
													</td>
													<td class="movil te8">
														<strong id="acumTotal_otros_cotizaciones_servicio_servicio"></strong>
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
													<strong id="numElementos_otros_cotizaciones_servicio_servicio">0</strong> encontrados
												</button>
											</div>
										</div>
								</div>
							</div>
                       	</div><!--Cierre Tab - Otros -->
					</div><!--Cierre del contenedor de tabs-->
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" 
									id="btnGuardar_cotizaciones_servicio_servicio"  
									onclick="validar_cotizaciones_servicio_servicio();"  
									title="Guardar" 
									tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_cotizaciones_servicio_servicio"  
									onclick="abrir_prospecto_cotizaciones_servicio_servicio('');"  
									title="Enviar correo electrónico" tabindex="3" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_cotizaciones_servicio_servicio"  
									onclick="reporte_registro_cotizaciones_servicio_servicio('');"  
									title="Imprimir registro en PDF" 
									tabindex="4" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" 
									id="btnDesactivar_cotizaciones_servicio_servicio"  
									onclick="cambiar_estatus_cotizaciones_servicio_servicio('','ACTIVO');"  
									title="Desactivar" 
									tabindex="5" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" 
									id="btnRestaurar_cotizaciones_servicio_servicio"  
									onclick="cambiar_estatus_cotizaciones_servicio_servicio('','INACTIVO');"  
									title="Restaurar" 
									tabindex="6" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  
									id="btnCerrar_cotizaciones_servicio_servicio"
									type="reset" 
									aria-hidden="true" 
									onclick="cerrar_cotizaciones_servicio_servicio();" 
									title="Cerrar"  
									tabindex="7">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cotizaciones-->

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarCotizacionesServicioServicioBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_prospecto_cotizaciones_servicio_servicio" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarCotizacionesServicioServicio" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarCotizacionesServicioServicio"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Prospecto-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCotizacionServicioID_prospecto_cotizaciones_servicio_servicio" 
										   name="intCotizacionServicioID_prospecto_cotizaciones_servicio_servicio" 
										   type="hidden" value="">
									</input>
									<label for="txtProspecto_prospecto_cotizaciones_servicio_servicio">Prospecto</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProspecto_prospecto_cotizaciones_servicio_servicio" 
											name="strProspecto_prospecto_cotizaciones_servicio_servicio" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="row">
			 			<!--Correo electrónico-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCorreoElectronico_prospecto_cotizaciones_servicio_servicio">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_prospecto_cotizaciones_servicio_servicio" 
											name="strCorreoElectronico_prospecto_cotizaciones_servicio_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="row">
			 			<!--Copia-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCopiaCorreoElectronico_prospecto_cotizaciones_servicio_servicio">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_prospecto_cotizaciones_servicio_servicio" 
											name="strCopiaCorreoElectronico_prospecto_cotizaciones_servicio_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_prospecto_cotizaciones_servicio_servicio" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_prospecto_cotizaciones_servicio_servicio"  
									onclick="validar_prospecto_cotizaciones_servicio_servicio();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_prospecto_cotizaciones_servicio_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_prospecto_cotizaciones_servicio_servicio();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->
	</div><!--#CotizacionesServicioServicioContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_cotizaciones_servicio_servicio" type="text/template">
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
		//Variables que se utilizan para la paginación de registros de ordenes de reparación
		var intPaginaCotizacionesServicioServicio = 0;
		var strUltimaBusquedaCotizacionesServicioServicio = "";
		//Variable que se utiliza para asignar el id del módulo de servicio
		var intModuloIDCotizacionesServicioServicio = <?php echo MODULO_SERVICIO ?>;
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDCotizacionesServicioServicio = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseCotizacionesServicioServicio = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoCotizacionesServicioServicio = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar el valor del impuesto IVA
		var intIvaCotizacionesServicioServicio = <?php echo IVA ?>;
		//Variable que se utiliza para asignar el valor del porcentaje de IVA
		var intPorcentajeIvaCotizacionesServicioServicio = <?php echo PORCENTAJE_IVA ?>;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarCotizacionesServicioServicio = null;
		//Variable que se utiliza para asignar objeto del modal Cotizaciones
		var objCotizacionesServicioServicio = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para desglosar el IVA del gasto de servicio
		var arrDesglosarIvaGastoCotizacionesServicioServicio  = {gasto: '#txtGastosServicio_cotizaciones_servicio_servicio',
															 porcentajeIva: intPorcentajeIvaCotizacionesServicioServicio,
															 iva: intIvaCotizacionesServicioServicio,
															 gastoSubtotal: '#txtGastosServicioSubtotal_cotizaciones_servicio_servicio',
															 gastoIva: '#txtGastosServicioIva_cotizaciones_servicio_servicio'
															};


		/*******************************************************************************************************************
		Funciones del objeto servicios de Mano de Obra de la cotización
		*********************************************************************************************************************/
		// Constructor del objeto servicios de mano de obra
		var objMOCotizacionCotizacionesServicioServicio;
		function MOCotizacionCotizacionesServicioServicio(detalles)
		{
			this.arrDetalles = detalles;
		}

		//Función para obtener servicios de mano de obra de la cotización
		MOCotizacionCotizacionesServicioServicio.prototype.getDetalles = function() {
		    return this.arrDetalles;
		}

		//Función para agregar un detalle al objeto 
		MOCotizacionCotizacionesServicioServicio.prototype.setDetalle = function (detalle){
			this.arrDetalles.push(detalle);
		}

		//Función para obtener un detalle del objeto
		MOCotizacionCotizacionesServicioServicio.prototype.getDetalle = function(index) {
		    return this.arrDetalles[index];
		}

		//Función para modificar un detalle del objeto
		MOCotizacionCotizacionesServicioServicio.prototype.modificarDetalle = function (index, detalle){
			this.arrDetalles[index] = detalle;
		}

		//Función para eliminar un detalle del objeto
		MOCotizacionCotizacionesServicioServicio.prototype.eliminarDetalle = function (index){
			if(index != -1) 
			{
				this.arrDetalles.splice(index, 1);
			}
		}

		//Función para cambiar las posiciones de los detalles en el objeto
		MOCotizacionCotizacionesServicioServicio.prototype.swap = function(index_A, index_B) {
		    var input = this.arrDetalles;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		/*******************************************************************************************************************
		Funciones del objeto servicio de Mano de Obra de la cotización
		*********************************************************************************************************************/
		//Constructor del objeto servicio de mano de obra
		var objDetalleMOCotizacionCotizacionesServicioServicio;
		function DetalleMOCotizacionCotizacionesServicioServicio(servicioID, codigo, descripcion, horas, 
										           				 precioUnitario, porcentajeDescuento, 
										           				 descuentoUnitario, tasaCuotaIva, porcentajeIva, 
										            			 tasaCuotaIeps, porcentajeIeps)
		{
		   
		    this.intServicioID = servicioID;
		    this.strCodigo = codigo;
		    this.strDescripcion = descripcion;
		    this.intHoras = horas;
		    this.intPrecioUnitario = precioUnitario;
		    this.intPorcentajeDescuento = porcentajeDescuento;
		    this.intDescuentoUnitario = descuentoUnitario;
		    this.intTasaCuotaIva = tasaCuotaIva;
		    this.intPorcentajeIva = porcentajeIva;
		    this.intTasaCuotaIeps = tasaCuotaIeps;
		    this.intPorcentajeIeps = porcentajeIeps;
		}



		/*******************************************************************************************************************
		Funciones del objeto Trabajos Foráneos de la cotización
		*********************************************************************************************************************/
		// Constructor del objeto trabajos foráneos
		var objTFCotizacionCotizacionesServicioServicio;
		function TFCotizacionCotizacionesServicioServicio(detalles)
		{
			this.arrDetalles = detalles;
		}

		//Función para obtener servicios de mano de obra de la cotización
		TFCotizacionCotizacionesServicioServicio.prototype.getDetalles = function() {
		    return this.arrDetalles;
		}

		//Función para agregar un detalle al objeto 
		TFCotizacionCotizacionesServicioServicio.prototype.setDetalle = function (detalle){
			this.arrDetalles.push(detalle);
		}

		//Función para obtener un detalle del objeto
		TFCotizacionCotizacionesServicioServicio.prototype.getDetalle = function(index) {
		    return this.arrDetalles[index];
		}

		//Función para modificar un detalle del objeto
		TFCotizacionCotizacionesServicioServicio.prototype.modificarDetalle = function (index, detalle){
			this.arrDetalles[index] = detalle;
		}

		//Función para eliminar un detalle del objeto
		TFCotizacionCotizacionesServicioServicio.prototype.eliminarDetalle = function (index){
			if(index != -1) 
			{
				this.arrDetalles.splice(index, 1);
			}
		}

		//Función para cambiar las posiciones de los detalles en el objeto
		TFCotizacionCotizacionesServicioServicio.prototype.swap = function(index_A, index_B) {
		    var input = this.arrDetalles;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		/*******************************************************************************************************************
		Funciones del objeto Trabajos Foráneos de la cotización
		*********************************************************************************************************************/
		//Constructor del objeto trabajo foráneo
		var objDetalleTFCotizacionCotizacionesServicioServicio;
		function DetalleTFCotizacionCotizacionesServicioServicio(concepto, cantidad, precioUnitario,
															     porcentajeDescuento, descuentoUnitario, 
															     tasaCuotaIva, porcentajeIva, 
										            			 tasaCuotaIeps, porcentajeIeps)
		{
		   
		    this.strConcepto = concepto;
		    this.intCantidad = cantidad;
		    this.intPrecioUnitario = precioUnitario;
		    this.intPorcentajeDescuento = porcentajeDescuento;
		    this.intDescuentoUnitario = descuentoUnitario;
		    this.intTasaCuotaIva = tasaCuotaIva;
		    this.intPorcentajeIva = porcentajeIva;
		    this.intTasaCuotaIeps = tasaCuotaIeps;
		    this.intPorcentajeIeps = porcentajeIeps;
		}


		/*******************************************************************************************************************
		Funciones del objeto Otros servicios de la cotización
		*********************************************************************************************************************/
		// Constructor del objeto otros servicios
		var objOtrosCotizacionCotizacionesServicioServicio;
		function OtrosCotizacionCotizacionesServicioServicio(detalles)
		{
			this.arrDetalles = detalles;
		}

		//Función para obtener otros servicios de la cotización
		OtrosCotizacionCotizacionesServicioServicio.prototype.getDetalles = function() {
		    return this.arrDetalles;
		}

		//Función para agregar un detalle al objeto 
		OtrosCotizacionCotizacionesServicioServicio.prototype.setDetalle = function (detalle){
			this.arrDetalles.push(detalle);
		}

		//Función para obtener un detalle del objeto
		OtrosCotizacionCotizacionesServicioServicio.prototype.getDetalle = function(index) {
		    return this.arrDetalles[index];
		}

		//Función para modificar un detalle del objeto
		OtrosCotizacionCotizacionesServicioServicio.prototype.modificarDetalle = function (index, detalle){
			this.arrDetalles[index] = detalle;
		}

		//Función para eliminar un detalle del objeto
		OtrosCotizacionCotizacionesServicioServicio.prototype.eliminarDetalle = function (index){
			if(index != -1) 
			{
				this.arrDetalles.splice(index, 1);
			}
		}

		//Función para cambiar las posiciones de los detalles en el objeto
		OtrosCotizacionCotizacionesServicioServicio.prototype.swap = function(index_A, index_B) {
		    var input = this.arrDetalles;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		/*******************************************************************************************************************
		Funciones del objeto Otro servicio de la cotización
		*********************************************************************************************************************/
		//Constructor del objeto otro servicio
		var objOtroCotizacionCotizacionesServicioServicio;
		function OtroCotizacionCotizacionesServicioServicio(concepto, cantidad,  precioUnitario, porcentajeDescuento, 
										            		descuentoUnitario, tasaCuotaIva, porcentajeIva, 
										            		tasaCuotaIeps, porcentajeIeps)
		{
		   
		    this.strConcepto = concepto;
		    this.intCantidad = cantidad;
		    this.intPrecioUnitario = precioUnitario;
		    this.intPorcentajeDescuento = porcentajeDescuento;
		    this.intDescuentoUnitario = descuentoUnitario;
		    this.intTasaCuotaIva = tasaCuotaIva;
		    this.intPorcentajeIva = porcentajeIva;
		    this.intTasaCuotaIeps = tasaCuotaIeps;
		    this.intPorcentajeIeps = porcentajeIeps;
		}


		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_cotizaciones_servicio_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/cotizaciones_servicio/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_cotizaciones_servicio_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCotizacionesServicioServicio = data.row;
					//Separar la cadena 
					var arrPermisosCotizacionesServicioServicio = strPermisosCotizacionesServicioServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCotizacionesServicioServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCotizacionesServicioServicio[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_cotizaciones_servicio_servicio').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosCotizacionesServicioServicio[i]=='GUARDAR') || (arrPermisosCotizacionesServicioServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_cotizaciones_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosCotizacionesServicioServicio[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_cotizaciones_servicio_servicio').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_cotizaciones_servicio_servicio();
						}
						else if(arrPermisosCotizacionesServicioServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_cotizaciones_servicio_servicio').removeAttr('disabled');
							$('#btnRestaurar_cotizaciones_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosCotizacionesServicioServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_cotizaciones_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosCotizacionesServicioServicio[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_cotizaciones_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosCotizacionesServicioServicio[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_cotizaciones_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosCotizacionesServicioServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_cotizaciones_servicio_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_cotizaciones_servicio_servicio() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaCotizacionesServicioServicio =($('#txtFechaInicialBusq_cotizaciones_servicio_servicio').val()+$('#txtFechaFinalBusq_cotizaciones_servicio_servicio').val()+$('#txtProspectoIDBusq_cotizaciones_servicio_servicio').val()+$('#cmbEstatusBusq_cotizaciones_servicio_servicio').val()+$('#txtBusqueda_cotizaciones_servicio_servicio').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaCotizacionesServicioServicio != strUltimaBusquedaCotizacionesServicioServicio)
			{
				intPaginaCotizacionesServicioServicio = 0;
				strUltimaBusquedaCotizacionesServicioServicio = strNuevaBusquedaCotizacionesServicioServicio;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/cotizaciones_servicio/get_paginacion',
				    {//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				     dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_cotizaciones_servicio_servicio').val()),
				     dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_cotizaciones_servicio_servicio').val()),
				     intProspectoID: $('#txtProspectoIDBusq_cotizaciones_servicio_servicio').val(),
				     strEstatus:     $('#cmbEstatusBusq_cotizaciones_servicio_servicio').val(),
						strBusqueda:    $('#txtBusqueda_cotizaciones_servicio_servicio').val(),
					 intPagina:intPaginaCotizacionesServicioServicio,
					 strPermisosAcceso: $('#txtAcciones_cotizaciones_servicio_servicio').val()
					},
					function(data){
						$('#dg_cotizaciones_servicio_servicio tbody').empty();
						var tmpCotizacionesServicioServicio = Mustache.render($('#plantilla_cotizaciones_servicio_servicio').html(),data);
						$('#dg_cotizaciones_servicio_servicio tbody').html(tmpCotizacionesServicioServicio);
						$('#pagLinks_cotizaciones_servicio_servicio').html(data.paginacion);
						$('#numElementos_cotizaciones_servicio_servicio').html(data.total_rows);
						intPaginaCotizacionesServicioServicio = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_cotizaciones_servicio_servicio(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/cotizaciones_servicio/';

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
			if ($('#chbImprimirDetalles_cotizaciones_servicio_servicio').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_cotizaciones_servicio_servicio').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_cotizaciones_servicio_servicio').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_cotizaciones_servicio_servicio').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_cotizaciones_servicio_servicio').val()),
										'intProspectoID': $('#txtProspectoIDBusq_cotizaciones_servicio_servicio').val(),
										'strEstatus': $('#cmbEstatusBusq_cotizaciones_servicio_servicio').val(), 
										'strBusqueda': $('#txtBusqueda_cotizaciones_servicio_servicio').val(),
										'strDetalles': $('#chbImprimirDetalles_cotizaciones_servicio_servicio').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_cotizaciones_servicio_servicio(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtCotizacionServicioID_cotizaciones_servicio_servicio').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'servicio/cotizaciones_servicio/get_reporte_registro',
							'data' : {
										'intCotizacionServicioID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_cotizaciones_servicio_servicio()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_cotizaciones_servicio_servicio').empty();
					var temp = Mustache.render($('#monedas_cotizaciones_servicio_servicio').html(), data);
					$('#cmbMonedaID_cotizaciones_servicio_servicio').html(temp);
				},
				'json');
		}

		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_prospecto_cotizaciones_servicio_servicio()
		{
			//Incializar formulario
			$('#frmEnviarCotizacionesServicioServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospecto_cotizaciones_servicio_servicio();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_prospecto_cotizaciones_servicio_servicio');
		}

		//Función que se utiliza para abrir el modal
		function abrir_prospecto_cotizaciones_servicio_servicio(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_prospecto_cotizaciones_servicio_servicio();
			//Variables que se utilizan para asignar los datos del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtCotizacionServicioID_cotizaciones_servicio_servicio').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/cotizaciones_servicio/get_datos',
			       {intCotizacionServicioID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtCotizacionServicioID_prospecto_cotizaciones_servicio_servicio').val(data.row.cotizacion_servicio_id);
							$('#txtProspecto_prospecto_cotizaciones_servicio_servicio').val(data.row.prospecto);
							$('#txtCorreoElectronico_prospecto_cotizaciones_servicio_servicio').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_prospecto_cotizaciones_servicio_servicio').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_prospecto_cotizaciones_servicio_servicio').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarCotizacionesServicioServicio = $('#EnviarCotizacionesServicioServicioBox').bPopup({
																   appendTo: '#CotizacionesServicioServicioContent', 
										                           contentContainer: 'CotizacionesServicioServicioM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_prospecto_cotizaciones_servicio_servicio').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_prospecto_cotizaciones_servicio_servicio()
		{
			try {
				//Cerrar modal
				objEnviarCotizacionesServicioServicio.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_prospecto_cotizaciones_servicio_servicio();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_prospecto_cotizaciones_servicio_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospecto_cotizaciones_servicio_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarCotizacionesServicioServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_prospecto_cotizaciones_servicio_servicio: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_prospecto_cotizaciones_servicio_servicio: {
				                        	validators: {
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    }
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_prospecto_cotizaciones_servicio_servicio = $('#frmEnviarCotizacionesServicioServicio').data('bootstrapValidator');
			bootstrapValidator_prospecto_cotizaciones_servicio_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_prospecto_cotizaciones_servicio_servicio.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_prospecto_cotizaciones_servicio_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_prospecto_cotizaciones_servicio_servicio()
		{
			try
			{
				$('#frmEnviarCotizacionesServicioServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al prospecto
		function enviar_correo_prospecto_cotizaciones_servicio_servicio()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_prospecto_cotizaciones_servicio_servicio();
			//Hacer un llamado al método del controlador para enviar correo electrónico al prospecto
			$.post('servicio/cotizaciones_servicio/enviar_correo_electronico_prospecto',
					{ 
						intCotizacionServicioID: $('#txtCotizacionServicioID_prospecto_cotizaciones_servicio_servicio').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_prospecto_cotizaciones_servicio_servicio').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_prospecto_cotizaciones_servicio_servicio').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_prospecto_cotizaciones_servicio_servicio();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_prospecto_cotizaciones_servicio_servicio();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cotizaciones_servicio_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_prospecto_cotizaciones_servicio_servicio()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_prospecto_cotizaciones_servicio_servicio").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_prospecto_cotizaciones_servicio_servicio()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_prospecto_cotizaciones_servicio_servicio").addClass('no-mostrar');
		}

		/*******************************************************************************************************************
		Funciones del modal Cotizaciones
		*********************************************************************************************************************/
		function nuevo_cotizaciones_servicio_servicio()
		{
			//Incializar formulario
			$('#frmCotizacionesServicioServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cotizaciones_servicio_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmCotizacionesServicioServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cotizaciones_servicio_servicio');
	    	//Eliminar los datos de la tabla servicios de mano de obra
	    	$('#dg_mano_obra_cotizaciones_servicio_servicio tbody').empty();
		    $('#acumHoras_mano_obra_cotizaciones_servicio_servicio').html('');
		    $('#acumDescuento_mano_obra_cotizaciones_servicio_servicio').html('');
		    $('#acumSubtotal_mano_obra_cotizaciones_servicio_servicio').html('');
		    $('#acumIva_mano_obra_cotizaciones_servicio_servicio').html('');
		    $('#acumIeps_mano_obra_cotizaciones_servicio_servicio').html('');
		    $('#acumTotal_mano_obra_cotizaciones_servicio_servicio').html('');
			$('#numElementos_mano_obra_cotizaciones_servicio_servicio').html(0);
			$('#txtNumDetalles_mano_obra_cotizaciones_servicio_servicio').val(0);
	    	//Hacer un llamado a la función para inicializar elementos de la tabla refacciones
		    inicializar_refacciones_cotizaciones_servicio_servicio();
	    	//Eliminar los datos de la tabla trabajos foráneos
	    	$('#dg_trabajos_foraneos_cotizaciones_servicio_servicio tbody').empty();
		    $('#acumCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').html('');
		    $('#acumDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').html('');
		    $('#acumSubtotal_trabajos_foraneos_cotizaciones_servicio_servicio').html('');
		    $('#acumIva_trabajos_foraneos_cotizaciones_servicio_servicio').html('');
		    $('#acumIeps_trabajos_foraneos_cotizaciones_servicio_servicio').html('');
		    $('#acumTotal_trabajos_foraneos_cotizaciones_servicio_servicio').html('');
			$('#numElementos_trabajos_foraneos_cotizaciones_servicio_servicio').html(0);
			$('#txtNumDetalles_trabajos_foraneos_cotizaciones_servicio_servicio').val(0);
	    	//Eliminar los datos de la tabla otros servicios
	    	$('#dg_otros_cotizaciones_servicio_servicio tbody').empty();
		    $('#acumCantidad_otros_cotizaciones_servicio_servicio').html('');
		    $('#acumDescuento_otros_cotizaciones_servicio_servicio').html('');
		    $('#acumSubtotal_otros_cotizaciones_servicio_servicio').html('');
		    $('#acumIva_otros_cotizaciones_servicio_servicio').html('');
		    $('#acumIeps_otros_cotizaciones_servicio_servicio').html('');
		    $('#acumTotal_otros_cotizaciones_servicio_servicio').html('');
			$('#numElementos_otros_cotizaciones_servicio_servicio').html(0);
			$('#txtNumDetalles_otros_cotizaciones_servicio_servicio').val(0);
			//Crear instancia del objeto servicios de Mano de Obra de la cotización
			objMOCotizacionCotizacionesServicioServicio = new MOCotizacionCotizacionesServicioServicio([]);
			//Crear instancia del objeto Trabajos Foráneos de la cotización
			objTFCotizacionCotizacionesServicioServicio = new TFCotizacionCotizacionesServicioServicio([]);
			//Crear instancia del objeto Otros servicios de la cotización
			objOtrosCotizacionCotizacionesServicioServicio = new OtrosCotizacionCotizacionesServicioServicio([]);
			//Habilitar todos los elementos del formulario
			$('#frmCotizacionesServicioServicio').find('input, textarea, select').removeAttr('disabled','disabled');
			//Seleccionar tab que contiene la información general
	    	$('a[href="#informacion_general_cotizaciones_servicio_servicio"]').click();
			//Asignar la fecha actual
			$('#txtFecha_cotizaciones_servicio_servicio').val(fechaActual()); 

			//Deshabilitar las siguientes cajas de texto			
			var arrCajasTexto  = {
									//Son los id de las cajas de texto que se van a deshabilitar
									rows: [	'#txtFolio_cotizaciones_servicio_servicio',
											'#txtPrecioUnitario_mano_obra_cotizaciones_servicio_servicio',
											'#txtHoras_mano_obra_cotizaciones_servicio_servicio',
											'#txtReferencia_refacciones_cotizaciones_servicio_servicio',	
											'#txtCantidad_refacciones_cotizaciones_servicio_servicio',
											'#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio',
											'#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio',
											'#txtPorcentajeIva_refacciones_cotizaciones_servicio_servicio',
											'#txtPorcentajeIeps_refacciones_cotizaciones_servicio_servicio'
										],
									//Es asignar un attributo disbaled|checked
									attribute: 'disabled',
									//Bool es para deshabilitar
									bool: true
								};
			//Hacer un llamado a la función para deshabilitar cajas de texto		
			$.habilitar_deshabilitar_campos(arrCajasTexto);

			//Mostrar los siguiente botones
			$("#btnGuardar_cotizaciones_servicio_servicio").show();
			//Habilitar los siguientes botones 
			$('#btnAgregar_mano_obra_cotizaciones_servicio_servicio').prop('disabled', false);
			$('#btnAgregar_refacciones_cotizaciones_servicio_servicio').prop('disabled', false);
			$('#btnAgregar_trabajos_foraneos_cotizaciones_servicio_servicio').prop('disabled', false);
			$('#btnAgregar_otros_cotizaciones_servicio_servicio').prop('disabled', false);
			//Ocultar los siguientes botones
			$('#btnEnviarCorreo_cotizaciones_servicio_servicio').hide();
			$('#btnImprimirRegistro_cotizaciones_servicio_servicio').hide();
			$('#btnDesactivar_cotizaciones_servicio_servicio').hide();
			$('#btnRestaurar_cotizaciones_servicio_servicio').hide();
		}


		//Función para inicializar elementos del prospecto
		function inicializar_prospecto_cotizaciones_servicio_servicio()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$("#txtServicioListaPrecioID_cotizaciones_servicio_servicio").val('');			//Hacer un llamado a la función para inicializar elementos de la tabla refacciones
		    inicializar_refacciones_cotizaciones_servicio_servicio();
		}

		//Función para inicializar elementos de la tabla detalles
		function inicializar_refacciones_cotizaciones_servicio_servicio()
		{
			//Hacer un llamado a la función para inicializar elementos de la refacción (detalle)
		    inicializar_detalle_refacciones_cotizaciones_servicio_servicio();

			//Eliminar los datos de la tabla refacciones
	    	$('#dg_refacciones_cotizaciones_servicio_servicio tbody').empty();
		    $('#acumCantidad_refacciones_cotizaciones_servicio_servicio').html('');
		    $('#acumDescuento_refacciones_cotizaciones_servicio_servicio').html('');
		    $('#acumSubtotal_refacciones_cotizaciones_servicio_servicio').html('');
		    $('#acumIva_refacciones_cotizaciones_servicio_servicio').html('');
		    $('#acumIeps_refacciones_cotizaciones_servicio_servicio').html('');
		    $('#acumTotal_refacciones_cotizaciones_servicio_servicio').html('');
			$('#numElementos_refacciones_cotizaciones_servicio_servicio').html(0);
			$('#txtNumDetalles_refacciones_cotizaciones_servicio_servicio').val(0);
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cotizaciones_servicio_servicio()
		{
			try {

				//Cerrar modal
				objCotizacionesServicioServicio.close();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			    cerrar_prospecto_cotizaciones_servicio_servicio();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_cotizaciones_servicio_servicio').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cotizaciones_servicio_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cotizaciones_servicio_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmCotizacionesServicioServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_cotizaciones_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_cotizaciones_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_cotizaciones_servicio_servicio: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_cotizaciones_servicio_servicio').val()) !== intMonedaBaseIDCotizacionesServicioServicio)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoCotizacionesServicioServicio)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoCotizacionesServicioServicio
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strProspecto_cotizaciones_servicio_servicio: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del prospecto
					                                    if($('#txtProspectoID_cotizaciones_servicio_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un prospecto existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMadurez_cotizaciones_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una madurez'}
											}
										},
										strEstrategia_cotizaciones_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la estrategia
					                                    if($('#txtEstrategiaID_cotizaciones_servicio_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una estrategia existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strServicioTipo_cotizaciones_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la estrategia
					                                    if($('#txtServicioTipoID_cotizaciones_servicio_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un tipo de servicio existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strEquipoTipo_cotizaciones_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la estrategia
					                                    if($('#txtEquipoTipoID_cotizaciones_servicio_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un tipo de equipo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCodigo_mano_obra_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
					                    strDescripcion_mano_obra_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intHoras_mano_obra_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_mano_obra_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_mano_obra_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strReferencia_refacciones_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_refacciones_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_refacciones_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_refacciones_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIeps_refacciones_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strConcepto_trabajos_foraneos_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_trabajos_foraneos_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strConcepto_otros_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_otros_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_otros_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_otros_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_otros_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIeps_otros_cotizaciones_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_cotizaciones_servicio_servicio = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_cotizaciones_servicio_servicio = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_cotizaciones_servicio_servicio.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_cotizaciones_servicio_servicio.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cotizaciones_servicio_servicio = $('#frmCotizacionesServicioServicio').data('bootstrapValidator');
			bootstrapValidator_cotizaciones_servicio_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cotizaciones_servicio_servicio.isValid())
			{
				//Hacer un llamado a la función para validar que los detalles cuenten con cantidad y precio unitario
				validar_detalles_cotizaciones_servicio_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cotizaciones_servicio_servicio()
		{
			try
			{
				$('#frmCotizacionesServicioServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}



		//Función que se utiliza para validar que los detalles cuenten con cantidad y precio unitario
		function validar_detalles_cotizaciones_servicio_servicio()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_refacciones_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

			//Array que se utiliza para agregar las refacciones incorrectas
			var arrDetallesIncorrectos = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var strCodigo = objRen.cells[0].innerHTML;
				var strDescripcion = objRen.cells[1].innerHTML;
				var intCantidad = parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				var intPrecioUnitario = parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				//Concatenar los datos de la referencia
				var strReferencia = strCodigo+' - '+strDescripcion;

				//Si la cantidad es igual a cero o el precio unitario es igual a cero
				if(intCantidad == 0 || intPrecioUnitario == 0)
				{
					//Agregar refacción en el array, de esta manera, el usuario identificara las refacciones incorrectas
					arrDetallesIncorrectos.push(strReferencia);
				}
			}

			//Si existen refacciones incorrectas
			if(arrDetallesIncorrectos.length > 0)
			{
				//Mensaje que se utiliza para informar al usuario la lista de refacciones incorrectas
				var strMensaje = 'La cotización no puede guardarse. Las siguientes <b>refacciones</b> no tienen precio unitario (0.00) o no tienen cantidad (0.00):<br>';

				//Hacer recorrido para obtener refacciones incorrectas
				for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
				{
					//Agregar refacción en el mensaje
            		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
				}

				//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_cotizaciones_servicio_servicio('error', strMensaje);
			}
			else
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_cotizaciones_servicio_servicio();
			}

		}


		//Función para guardar o modificar los datos de un registro
		function guardar_cotizaciones_servicio_servicio()
		{
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioCotizacion = parseFloat($('#txtTipoCambio_cotizaciones_servicio_servicio').val());


			//Obtenemos el objeto de la tabla servicios de mano de obra
			var objTabla = document.getElementById('dg_mano_obra_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrServicioIDMO = [];
			var arrCodigosMO = [];
			var arrDescripcionesMO = [];
			var arrHorasMO = [];
			var arrPreciosUnitariosMO = [];
			var arrDescuentosUnitariosMO = [];
			var arrTasaCuotaIvaMO = [];
			var arrIvasUnitariosMO = [];
			var arrTasaCuotaIepsMO = [];
			var arrIepsUnitariosMO = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intHoras = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intPrecioUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[4].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[6].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[7].innerHTML, ",", "");

				//Calcular iva unitario
				intIvaUnitario =  intIvaUnitario / intHoras;
				//Calcular ieps unitario
				intIepsUnitario = intIepsUnitario / intHoras;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioCotizacion;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioCotizacion;
				intIvaUnitario = intIvaUnitario * intTipoCambioCotizacion;
				intIepsUnitario = intIepsUnitario * intTipoCambioCotizacion;
			
				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{	
					//Restar descuento al precio unitario
					intPrecioUnitario = intPrecioUnitario - intDescuentoUnitario;
					
				}

				//Redondear cantidad a dos decimales
			    intPrecioUnitario = intPrecioUnitario.toFixed(2);
			    intPrecioUnitario = parseFloat(intPrecioUnitario);

				//Redondear cantidad a cuatro decimales
				intIvaUnitario = intIvaUnitario.toFixed(4);
				intIvaUnitario = parseFloat(intIvaUnitario);

				intIepsUnitario = intIepsUnitario.toFixed(4);
				intIepsUnitario = parseFloat(intIepsUnitario);

				//Asignar valores a los arrays
				arrServicioIDMO.push(objRen.cells[10].innerHTML);
				arrCodigosMO.push(objRen.cells[0].innerHTML);
				arrDescripcionesMO.push(objRen.cells[1].innerHTML);
				arrHorasMO.push(intHoras);
				arrPreciosUnitariosMO.push(intPrecioUnitario);
				arrDescuentosUnitariosMO.push(intDescuentoUnitario);
				arrTasaCuotaIvaMO.push(objRen.cells[11].innerHTML);
				arrIvasUnitariosMO.push(intIvaUnitario);
				arrTasaCuotaIepsMO.push(objRen.cells[12].innerHTML);
				arrIepsUnitariosMO.push(intIepsUnitario );
			}



			//Obtenemos el objeto de la tabla refacciones
			var objTabla = document.getElementById('dg_refacciones_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRefaccionIDRefacciones = [];
			var arrCodigosRefacciones = [];
			var arrDescripcionesRefacciones = [];
			var arrCantidadesRefacciones = [];
			var arrPreciosUnitariosRefacciones = [];
			var arrDescuentosUnitariosRefacciones = [];
			var arrTasaCuotaIvaRefacciones = [];
			var arrIvasUnitariosRefacciones = [];
			var arrTasaCuotaIepsRefacciones = [];
			var arrIepsUnitariosRefacciones = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intPrecioUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[4].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[6].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[7].innerHTML, ",", "");

				//Calcular iva unitario
				intIvaUnitario =  intIvaUnitario / intCantidad;
				//Calcular ieps unitario
				intIepsUnitario = intIepsUnitario / intCantidad;

			    //Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioCotizacion;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioCotizacion;
				intIvaUnitario = intIvaUnitario * intTipoCambioCotizacion;
				intIepsUnitario = intIepsUnitario * intTipoCambioCotizacion;

				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{	
					//Restar descuento al precio unitario
					intPrecioUnitario = intPrecioUnitario - intDescuentoUnitario;
				}

				//Redondear cantidad a dos decimales
			    intPrecioUnitario = intPrecioUnitario.toFixed(2);
			    intPrecioUnitario = parseFloat(intPrecioUnitario);

				//Redondear cantidad a cuatro decimales
				intIvaUnitario = intIvaUnitario.toFixed(4);
				intIvaUnitario = parseFloat(intIvaUnitario);
				
				intIepsUnitario = intIepsUnitario.toFixed(4);
				intIepsUnitario = parseFloat(intIepsUnitario);

				//Asignar valores a los arrays
				arrRefaccionIDRefacciones.push(objRen.getAttribute('id'));
				arrCodigosRefacciones.push(objRen.cells[0].innerHTML);
			    arrDescripcionesRefacciones.push(objRen.cells[1].innerHTML);
				arrCantidadesRefacciones.push(intCantidad);
				arrPreciosUnitariosRefacciones.push(intPrecioUnitario);
				arrDescuentosUnitariosRefacciones.push(intDescuentoUnitario);
				arrTasaCuotaIvaRefacciones.push(objRen.cells[16].innerHTML);
				arrIvasUnitariosRefacciones.push(intIvaUnitario );
				arrTasaCuotaIepsRefacciones.push(objRen.cells[17].innerHTML);
				arrIepsUnitariosRefacciones.push(intIepsUnitario);
			}


			//Obtenemos el objeto de la tabla trabajos foráneos
			var objTabla = document.getElementById('dg_trabajos_foraneos_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrConceptosTF = [];
			var arrCantidadesTF = [];
			var arrPreciosUnitariosTF = [];
			var arrDescuentosUnitariosTF = [];
			var arrTasaCuotaIvaTF = [];
			var arrIvasUnitariosTF = [];
			var arrTasaCuotaIepsTF = [];
			var arrIepsUnitariosTF = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				var intPrecioUnitario = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[5].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[6].innerHTML, ",", "");

				//Calcular iva unitario
				intIvaUnitario =  intIvaUnitario / intCantidad;
				//Calcular ieps unitario
				intIepsUnitario = intIepsUnitario / intCantidad;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioCotizacion;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioCotizacion;
				intIvaUnitario = intIvaUnitario * intTipoCambioCotizacion;
				intIepsUnitario = intIepsUnitario * intTipoCambioCotizacion;
			
				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{	
					//Restar descuento al precio unitario
					intPrecioUnitario = intPrecioUnitario - intDescuentoUnitario;
					
				}

				//Redondear cantidad a dos decimales
			    intPrecioUnitario = intPrecioUnitario.toFixed(2);
			    intPrecioUnitario = parseFloat(intPrecioUnitario);

				//Redondear cantidad a cuatro decimales
				intIvaUnitario = intIvaUnitario.toFixed(4);
				intIvaUnitario = parseFloat(intIvaUnitario);

				intIepsUnitario = intIepsUnitario.toFixed(4);
				intIepsUnitario = parseFloat(intIepsUnitario);

				//Asignar valores a los arrays
				arrConceptosTF.push(objRen.cells[0].innerHTML);
				arrCantidadesTF.push(intCantidad);
				arrPreciosUnitariosTF.push(intPrecioUnitario);
				arrDescuentosUnitariosTF.push(intDescuentoUnitario);
				arrTasaCuotaIvaTF.push(objRen.cells[9].innerHTML);
				arrIvasUnitariosTF.push(intIvaUnitario);
				arrTasaCuotaIepsTF.push(objRen.cells[10].innerHTML);
				arrIepsUnitariosTF.push(intIepsUnitario );
			}


			//Obtenemos el objeto de la tabla otros servicios
			var objTabla = document.getElementById('dg_otros_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrConceptosOtros = [];
			var arrCantidadesOtros = [];
			var arrPreciosUnitariosOtros = [];
			var arrDescuentosUnitariosOtros = [];
			var arrTasaCuotaIvaOtros = [];
			var arrIvasUnitariosOtros = [];
			var arrTasaCuotaIepsOtros = [];
			var arrIepsUnitariosOtros = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				var intPrecioUnitario = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[5].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[6].innerHTML, ",", "");

				//Calcular iva unitario
				intIvaUnitario =  intIvaUnitario / intCantidad;
				//Calcular ieps unitario
				intIepsUnitario = intIepsUnitario / intCantidad;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioCotizacion;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioCotizacion;
				intIvaUnitario = intIvaUnitario * intTipoCambioCotizacion;
				intIepsUnitario = intIepsUnitario * intTipoCambioCotizacion;
			
				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{	
					//Restar descuento al precio unitario
					intPrecioUnitario = intPrecioUnitario - intDescuentoUnitario;
					
				}

				//Redondear cantidad a dos decimales
			    intPrecioUnitario = intPrecioUnitario.toFixed(2);
			    intPrecioUnitario = parseFloat(intPrecioUnitario);

				//Redondear cantidad a cuatro decimales
				intIvaUnitario = intIvaUnitario.toFixed(4);
				intIvaUnitario = parseFloat(intIvaUnitario);

				intIepsUnitario = intIepsUnitario.toFixed(4);
				intIepsUnitario = parseFloat(intIepsUnitario);

				//Asignar valores a los arrays
				arrConceptosOtros.push(objRen.cells[0].innerHTML);
				arrCantidadesOtros.push(intCantidad);
				arrPreciosUnitariosOtros.push(intPrecioUnitario);
				arrDescuentosUnitariosOtros.push(intDescuentoUnitario);
				arrTasaCuotaIvaOtros.push(objRen.cells[9].innerHTML);
				arrIvasUnitariosOtros.push(intIvaUnitario);
				arrTasaCuotaIepsOtros.push(objRen.cells[10].innerHTML);
				arrIepsUnitariosOtros.push(intIepsUnitario );
			}


			//Asignar valores del gasto de servicio
			var intGastosServicioSubtotalCot = parseFloat($('#txtGastosServicioSubtotal_cotizaciones_servicio_servicio').val());
			var intGastosServicioIvaCot = parseFloat($('#txtGastosServicioIva_cotizaciones_servicio_servicio').val());

			//Convertir importes a peso mexicano
			intGastosServicioSubtotalCot = intGastosServicioSubtotalCot * intTipoCambioCotizacion;
			intGastosServicioIvaCot = intGastosServicioIvaCot * intTipoCambioCotizacion;


			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('servicio/cotizaciones_servicio/guardar',
					{ 
						intCotizacionServicioID: $('#txtCotizacionServicioID_cotizaciones_servicio_servicio').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_cotizaciones_servicio_servicio').val()),
						intMonedaID: $('#cmbMonedaID_cotizaciones_servicio_servicio').val(),
						intTipoCambio: intTipoCambioCotizacion,
						intProspectoID: $('#txtProspectoID_cotizaciones_servicio_servicio').val(),
						intEquipoTipoID: $('#txtEquipoTipoID_cotizaciones_servicio_servicio').val(),
						intServicioTipoID: $('#txtServicioTipoID_cotizaciones_servicio_servicio').val(),
						strMadurez: $('#cmbMadurez_cotizaciones_servicio_servicio').val(),
						intEstrategiaID: $('#txtEstrategiaID_cotizaciones_servicio_servicio').val(),
						intGastosServicio: intGastosServicioSubtotalCot,
						intGastosServicioIva: intGastosServicioIvaCot,
						strObservaciones: $('#txtObservaciones_cotizaciones_servicio_servicio').val(),
						strNotas: $('#txtNotas_cotizaciones_servicio_servicio').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_cotizaciones_servicio_servicio').val(),
						//Datos de los servicios de mano de obra 
						strServicioIDMO: arrServicioIDMO.join('|'),
						strCodigosMO: arrCodigosMO.join('|'),
						strDescripcionesMO: arrDescripcionesMO.join('|'),
						strHorasMO: arrHorasMO.join('|'),
						strPreciosUnitariosMO: arrPreciosUnitariosMO.join('|'),
						strDescuentosUnitariosMO: arrDescuentosUnitariosMO.join('|'),
						strTasaCuotaIvaMO: arrTasaCuotaIvaMO.join('|'),
						strIvasUnitariosMO: arrIvasUnitariosMO.join('|'),
						strTasaCuotaIepsMO: arrTasaCuotaIepsMO.join('|'),
						strIepsUnitariosMO: arrIepsUnitariosMO.join('|'),
						//Datos de las refacciones
						strRefaccionIDRefacciones: arrRefaccionIDRefacciones.join('|'),
						strCodigosRefacciones: arrCodigosRefacciones.join('|'),
						strDescripcionesRefacciones: arrDescripcionesRefacciones.join('|'),
						strCantidadesRefacciones: arrCantidadesRefacciones.join('|'),
						strPreciosUnitariosRefacciones: arrPreciosUnitariosRefacciones.join('|'),
						strDescuentosUnitariosRefacciones: arrDescuentosUnitariosRefacciones.join('|'),
						strTasaCuotaIvaRefacciones: arrTasaCuotaIvaRefacciones.join('|'),
						strIvasUnitariosRefacciones: arrIvasUnitariosRefacciones.join('|'),
						strTasaCuotaIepsRefacciones: arrTasaCuotaIepsRefacciones.join('|'),
						strIepsUnitariosRefacciones: arrIepsUnitariosRefacciones.join('|'),
						//Datos de las trabajos foráneos
						strConceptosTF: arrConceptosTF.join('|'),
						strCantidadesTF: arrCantidadesTF.join('|'),
						strPreciosUnitariosTF: arrPreciosUnitariosTF.join('|'),
						strDescuentosUnitariosTF: arrDescuentosUnitariosTF.join('|'),
						strTasaCuotaIvaTF: arrTasaCuotaIvaTF.join('|'),
						strIvasUnitariosTF: arrIvasUnitariosTF.join('|'),
						strTasaCuotaIepsTF: arrTasaCuotaIepsTF.join('|'),
						strIepsUnitariosTF: arrIepsUnitariosTF.join('|'),
						//Datos de los otros servicios
						strConceptosOtros: arrConceptosOtros.join('|'),
						strCantidadesOtros: arrCantidadesOtros.join('|'),
						strPreciosUnitariosOtros: arrPreciosUnitariosOtros.join('|'),
						strDescuentosUnitariosOtros: arrDescuentosUnitariosOtros.join('|'),
						strTasaCuotaIvaOtros: arrTasaCuotaIvaOtros.join('|'),
						strIvasUnitariosOtros: arrIvasUnitariosOtros.join('|'),
						strTasaCuotaIepsOtros: arrTasaCuotaIepsOtros.join('|'),
						strIepsUnitariosOtros: arrIepsUnitariosOtros.join('|')
						
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_cotizaciones_servicio_servicio();  
							//Hacer un llamado a la función para cerrar modal
							cerrar_cotizaciones_servicio_servicio();          
							
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cotizaciones_servicio_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cotizaciones_servicio_servicio(tipoMensaje, mensaje)
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
			else if(tipoMensaje == 'informacion_mano_obra' || tipoMensaje == 'informacion_refacciones')
            { 
                //Indicar al usuario el mensaje de información
                new $.Zebra_Dialog(mensaje, {
	                                'type': 'information',
	                                'title': 'Información',
	                                'buttons': [{caption: 'Aceptar',
	                                             callback: function () {
	                                             	//Si el tipo de mensaje corresponde al servicio de mano de obra
	                                             	if(tipoMensaje == 'informacion_mano_obra')
	                                             	{
	                                             		//Hacer un llamado a la función para inicializar elementos del servicio de mano de obra
														inicializar_detalle_mano_obra_cotizaciones_servicio_servicio();
														//Enfocar caja de texto
														$('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').focus();
	                                             	}
	                                             	else
	                                             	{
	                                             		//Enfocar caja de texto
														$('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').focus();
	                                             	}
													
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
		function cambiar_estatus_cotizaciones_servicio_servicio(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCotizacionServicioID_cotizaciones_servicio_servicio').val();

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
				              'title':    'Cotizaciones',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_cotizaciones_servicio_servicio(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_cotizaciones_servicio_servicio(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_cotizaciones_servicio_servicio(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('servicio/cotizaciones_servicio/set_estatus',
			      {intCotizacionServicioID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_cotizaciones_servicio_servicio();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cotizaciones_servicio_servicio();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_cotizaciones_servicio_servicio(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_cotizaciones_servicio_servicio(id)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/cotizaciones_servicio/get_datos',
			       {intCotizacionServicioID: id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cotizaciones_servicio_servicio();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				             //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);

				            //Variables que se utilizan para asignar valores del gasto de servicio
							var intGastosServicioSubtotal = parseFloat(data.row.gastos_servicio/intTipoCambio);
							var intGastosServicioIva = parseFloat(data.row.gastos_servicio_iva/intTipoCambio);
							//Calcular el importe total del gasto de servicio
						    var intGastosServicioTotal = intGastosServicioSubtotal + intGastosServicioIva;

				            //Variable que se utiliza para asignar las acciones del grid view (mano de obra, refacciones, trabajos foráneos y otros servicios)
				            var strAccionesTablaMO = '';
				            var strAccionesTablaRefacciones = '';
				            var strAccionesTablaTF = '';
				            var strAccionesTablaOtros = '';
				            
				          	//Recuperar valores
				            $('#txtCotizacionServicioID_cotizaciones_servicio_servicio').val(data.row.cotizacion_servicio_id);
				            $('#txtFolio_cotizaciones_servicio_servicio').val(data.row.folio);
				            $('#txtFecha_cotizaciones_servicio_servicio').val(data.row.fecha);
				            $('#cmbMonedaID_cotizaciones_servicio_servicio').val(data.row.moneda_id);
				            $('#txtTipoCambio_cotizaciones_servicio_servicio').val(data.row.tipo_cambio);
				            $('#txtProspectoID_cotizaciones_servicio_servicio').val(data.row.prospecto_id);
				            $('#txtProspecto_cotizaciones_servicio_servicio').val(data.row.prospecto);
				            $('#txtServicioListaPrecioID_cotizaciones_servicio_servicio').val(data.row.servicio_lista_precio_id);
				            $('#txtEquipoTipoID_cotizaciones_servicio_servicio').val(data.row.equipo_tipo_id);
				            $('#txtEquipoTipo_cotizaciones_servicio_servicio').val(data.row.equipo_tipo);
				            $('#txtServicioTipoID_cotizaciones_servicio_servicio').val(data.row.servicio_tipo_id);
				            $('#txtServicioTipo_cotizaciones_servicio_servicio').val(data.row.servicio_tipo);
				            $('#cmbMadurez_cotizaciones_servicio_servicio').val(data.row.madurez);
				            $('#txtEstrategiaID_cotizaciones_servicio_servicio').val(data.row.estrategia_id);
				            $('#txtEstrategia_cotizaciones_servicio_servicio').val(data.row.estrategia);

						    $('#txtGastosServicioIva_cotizaciones_servicio_servicio').val(intGastosServicioIva);
						    $('#txtGastosServicioSubtotal_cotizaciones_servicio_servicio').val(intGastosServicioSubtotal);
						    $('#txtGastosServicio_cotizaciones_servicio_servicio').val(intGastosServicioTotal);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtGastosServicio_cotizaciones_servicio_servicio').formatCurrency({ roundToDecimalPlace: 2 });
					        $('#txtObservaciones_cotizaciones_servicio_servicio').val(data.row.observaciones);
					        $('#txtNotas_cotizaciones_servicio_servicio').val(data.row.notas);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_cotizaciones_servicio_servicio').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_cotizaciones_servicio_servicio").show();

				            //Deshabilitar caja de texto
						    $("#txtServicioTipo_cotizaciones_servicio_servicio").attr('disabled','disabled');

				           
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_cotizaciones_servicio_servicio").show();
				            	//Mostrar botón Enviar correo  
				                 $("#btnEnviarCorreo_cotizaciones_servicio_servicio").show();

				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDCotizacionesServicioServicio)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_cotizaciones_servicio_servicio").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_cotizaciones_servicio_servicio").attr('disabled','disabled');
							    }


							    strAccionesTablaMO = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_mano_obra_cotizaciones_servicio_servicio(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_mano_obra_cotizaciones_servicio_servicio(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	
				            	strAccionesTablaRefacciones = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_refacciones_cotizaciones_servicio_servicio(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_refacciones_cotizaciones_servicio_servicio(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	
								strAccionesTablaTF = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_trabajos_foraneos_cotizaciones_servicio_servicio(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_trabajos_foraneos_cotizaciones_servicio_servicio(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";


				            	strAccionesTablaOtros = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_otros_cotizaciones_servicio_servicio(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_otros_cotizaciones_servicio_servicio(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				            	
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmCotizacionesServicioServicio').find('input, textarea, select').attr('disabled','disabled');
			            		//Deshabilitar los siguientes botones
			            		$('#btnAgregar_mano_obra_cotizaciones_servicio_servicio').prop('disabled', true);
			            		$('#btnAgregar_refacciones_cotizaciones_servicio_servicio').prop('disabled', true);
			            		$('#btnAgregar_trabajos_foraneos_cotizaciones_servicio_servicio').prop('disabled', true);
			            		$('#btnAgregar_otros_cotizaciones_servicio_servicio').prop('disabled', true);
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_cotizaciones_servicio_servicio").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_cotizaciones_servicio_servicio").show();
							}
							
				            //Hacer un llamado a la función para cargar las refacciones del registro en la tabla
				            cargar_refacciones_cotizaciones_servicio_servicio(intTipoCambio, data.refacciones, strAccionesTablaRefacciones);

				            //Mostramos los detalles (servicios de mano de obra) del registro
				           	for (var intCon in data.mano_obra) 
				            {
				            	//Variable que se utiliza para asignar el renglón del detalle
								var intRenglon = data.mano_obra[intCon].renglon;

								//Crear instancia del objeto Detalle del servicio de Mano de Obra de la cotización
								objDetalleMOCotizacionCotizacionesServicioServicio = new DetalleMOCotizacionCotizacionesServicioServicio('', '', '',
																				    '', '', '', 
														           				    '', '', '', 
														            			   '');

				

								//Variables que se utilizan para asignar valores del detalle
								var intSubtotal = parseFloat(data.mano_obra[intCon].precio_unitario);
								var intHoras =  parseFloat(data.mano_obra[intCon].horas);
								var intPrecioUnitario = parseFloat(data.mano_obra[intCon].precio_unitario);
								var intDescuentoUnitario = parseFloat(data.mano_obra[intCon].descuento_unitario);
								var intIvaUnitario = parseFloat(data.mano_obra[intCon].iva_unitario);
								var intIepsUnitario = parseFloat(data.mano_obra[intCon].ieps_unitario);
								var intImporteIva = 0;
								var intImporteIeps = 0;
								var intPorcentajeDescuento = 0;
								var intPorcentajeIeps = '';
								var intTotal = 0;

								//Convertir peso mexicano a tipo de cambio
								intSubtotal = intSubtotal / intTipoCambio;
								intPrecioUnitario = intPrecioUnitario / intTipoCambio;
								intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
								intIvaUnitario = intIvaUnitario / intTipoCambio;
								intIepsUnitario = intIepsUnitario / intTipoCambio;


								//Si existe importe del descuento
								if(intDescuentoUnitario > 0)
								{
									//Calcular precio unitario
									intPrecioUnitario = intPrecioUnitario + intDescuentoUnitario;
									//Calcular porcentaje del descuento
									intPorcentajeDescuento = (intDescuentoUnitario / intPrecioUnitario) * 100;
								}

								//Calcular subtotal
								intSubtotal = intHoras * intSubtotal;

								//Calcular importe de IVA
								intImporteIva =  intIvaUnitario * intHoras;


								//Si existe importe de IEPS unitario
								if(intIepsUnitario > 0)
								{
									//Calcular importe de IEPS
									intImporteIeps =  intIepsUnitario * intCantidad;
									//Asignar porcentaje de IEPS
									intPorcentajeIeps = data.otros[intCon].porcentaje_ieps;
								}

								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								//Cambiar cantidad a  formato moneda (a visualizar)
								intHoras =  formatMoney(intHoras, 2, '');
							    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
							    intDescuentoUnitario =  formatMoney(intDescuentoUnitario, 2, '');
							    intPorcentajeDescuento =  formatMoney(intPorcentajeDescuento, 2, '');
							    intImporteIva  =  formatMoney(intImporteIva, 4, '');
							    intImporteIeps  =  formatMoney(intImporteIeps, 4, '');
							    intSubtotal  =  formatMoney(intSubtotal, 2, '');
							    intTotal  =  formatMoney(intTotal, 2, '');


								//Asignar valores al objeto
								objDetalleMOCotizacionCotizacionesServicioServicio.intServicioID = data.mano_obra[intCon].servicio_id;
								objDetalleMOCotizacionCotizacionesServicioServicio.strCodigo = data.mano_obra[intCon].codigo;
								objDetalleMOCotizacionCotizacionesServicioServicio.strDescripcion = data.mano_obra[intCon].descripcion;
								objDetalleMOCotizacionCotizacionesServicioServicio.intHoras = intHoras;
								objDetalleMOCotizacionCotizacionesServicioServicio.intPrecioUnitario = intPrecioUnitario;
								objDetalleMOCotizacionCotizacionesServicioServicio.intPorcentajeDescuento = intPorcentajeDescuento;
								objDetalleMOCotizacionCotizacionesServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
								objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIva = data.mano_obra[intCon].tasa_cuota_iva;;
								objDetalleMOCotizacionCotizacionesServicioServicio.intPorcentajeIva = data.mano_obra[intCon].porcentaje_iva;
								objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIeps = data.mano_obra[intCon].tasa_cuota_ieps;
								objDetalleMOCotizacionCotizacionesServicioServicio.intPorcentajeIeps = intPorcentajeIeps;

								//Agregar datos del detalle (mano de obra) de la cotización
           						objMOCotizacionCotizacionesServicioServicio.setDetalle(objDetalleMOCotizacionCotizacionesServicioServicio);

							    //Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_mano_obra_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];
							    //Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaCodigo = objRenglon.insertCell(0);
								var objCeldaDescripcion = objRenglon.insertCell(1);
								var objCeldaHoras = objRenglon.insertCell(2);
								var objCeldaPrecioUnitario = objRenglon.insertCell(3);
								var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
								var objCeldaSubtotal = objRenglon.insertCell(5);
								var objCeldaIva = objRenglon.insertCell(6);
								var objCeldaIeps = objRenglon.insertCell(7);
								var objCeldaTotal = objRenglon.insertCell(8);
								var objCeldaAcciones = objRenglon.insertCell(9);
								//Columnas ocultas
								var objCeldaServicioID = objRenglon.insertCell(10);
								var objCeldaTasaCuotaIva = objRenglon.insertCell(11);
								var objCeldaTasaCuotaIeps = objRenglon.insertCell(12)
								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', intRenglon);
								objCeldaCodigo.setAttribute('class', 'movil b1');
								objCeldaCodigo.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.strCodigo;
								objCeldaDescripcion.setAttribute('class', 'movil b2');
								objCeldaDescripcion.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.strDescripcion;
								objCeldaHoras.setAttribute('class', 'movil b3');
								objCeldaHoras.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intHoras;
								objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
								objCeldaPrecioUnitario.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intPrecioUnitario;
								objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
								objCeldaDescuentoUnitario.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intDescuentoUnitario;
								objCeldaSubtotal.setAttribute('class', 'movil b6');
								objCeldaSubtotal.innerHTML = intSubtotal;
								objCeldaIva.setAttribute('class', 'movil b7');
								objCeldaIva.innerHTML = intImporteIva;
								objCeldaIeps.setAttribute('class', 'movil b8');
								objCeldaIeps.innerHTML = intImporteIeps;
								objCeldaTotal.setAttribute('class', 'movil b9');
								objCeldaTotal.innerHTML = intTotal;
								objCeldaAcciones.setAttribute('class', 'td-center movil b10');
								objCeldaAcciones.innerHTML = strAccionesTablaMO;
								objCeldaServicioID.setAttribute('class', 'no-mostrar');
								objCeldaServicioID.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intServicioID;
							    objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIva.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIva;
								objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIeps.innerHTML =  objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIeps;



				            }//Cierre de verificación de servicios de mano de obra

				            //Hacer un llamado a la función para calcular totales de la tabla servicios de mano de obra
							calcular_totales_mano_obra_cotizaciones_servicio_servicio();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_mano_obra_cotizaciones_servicio_servicio tr").length - 2;
							$('#numElementos_mano_obra_cotizaciones_servicio_servicio').html(intFilas);
							$('#txtNumDetalles_mano_obra_cotizaciones_servicio_servicio').val(intFilas);


				        	//Mostramos los detalles (trabajos foráneos) del registro
				           	for (var intCon in data.trabajos_foraneos) 
				            {
				            	//Variable que se utiliza para asignar el renglón del detalle
								var intRenglon = data.trabajos_foraneos[intCon].renglon;
								//Crear instancia del objeto Detalle del Trabajo Foráneo de la cotización
								objDetalleTFCotizacionCotizacionesServicioServicio = new DetalleTFCotizacionCotizacionesServicioServicio('', '', '',
																				     '', '', 
																				     '', '', 
															            			 '', '');

								//Variables que se utilizan para asignar valores del detalle
								var intSubtotal = parseFloat(data.trabajos_foraneos[intCon].precio_unitario);
								var intCantidad =  parseFloat(data.trabajos_foraneos[intCon].cantidad);
								var intPrecioUnitario = parseFloat(data.trabajos_foraneos[intCon].precio_unitario);
								var intDescuentoUnitario = parseFloat(data.trabajos_foraneos[intCon].descuento_unitario);
								var intIvaUnitario = parseFloat(data.trabajos_foraneos[intCon].iva_unitario);
								var intIepsUnitario = parseFloat(data.trabajos_foraneos[intCon].ieps_unitario);
								var intImporteIva = 0;
								var intImporteIeps = 0;
								var intPorcentajeDescuento = 0;
								var intPorcentajeIeps = '';
								var intTotal = 0;

								//Convertir peso mexicano a tipo de cambio
								intSubtotal = intSubtotal / intTipoCambio;
								intPrecioUnitario = intPrecioUnitario / intTipoCambio;
								intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
								intIvaUnitario = intIvaUnitario / intTipoCambio;
								intIepsUnitario = intIepsUnitario / intTipoCambio;


								//Si existe importe del descuento
								if(intDescuentoUnitario > 0)
								{
									//Calcular precio unitario
									intPrecioUnitario = intPrecioUnitario + intDescuentoUnitario;
									//Calcular porcentaje del descuento
									intPorcentajeDescuento = (intDescuentoUnitario / intPrecioUnitario) * 100;
								}

								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;

								//Calcular importe de IVA
								intImporteIva =  intIvaUnitario * intCantidad;


								//Si existe importe de IEPS unitario
								if(intIepsUnitario > 0)
								{
									//Calcular importe de IEPS
									intImporteIeps =  intIepsUnitario * intCantidad;
									//Asignar porcentaje de IEPS
									intPorcentajeIeps = data.otros[intCon].porcentaje_ieps;
								}

								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								//Cambiar cantidad a  formato moneda (a visualizar)
								intCantidad =  formatMoney(intCantidad, 2, '');
							    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
							    intDescuentoUnitario =  formatMoney(intDescuentoUnitario, 2, '');
							    intPorcentajeDescuento =  formatMoney(intPorcentajeDescuento, 2, '');
							    intImporteIva  =  formatMoney(intImporteIva, 4, '');
							    intImporteIeps  =  formatMoney(intImporteIeps, 4, '');
							    intSubtotal  =  formatMoney(intSubtotal, 2, '');
							    intTotal  =  formatMoney(intTotal, 2, '');


								//Asignar valores al objeto
								objDetalleTFCotizacionCotizacionesServicioServicio.strConcepto = data.trabajos_foraneos[intCon].concepto;
								objDetalleTFCotizacionCotizacionesServicioServicio.intCantidad = intCantidad;
								objDetalleTFCotizacionCotizacionesServicioServicio.intPrecioUnitario = intPrecioUnitario;
								objDetalleTFCotizacionCotizacionesServicioServicio.intPorcentajeDescuento = intPorcentajeDescuento;
								objDetalleTFCotizacionCotizacionesServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
								objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIva = data.trabajos_foraneos[intCon].tasa_cuota_iva;;
								objDetalleTFCotizacionCotizacionesServicioServicio.intPorcentajeIva = data.trabajos_foraneos[intCon].porcentaje_iva;
								objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIeps = data.trabajos_foraneos[intCon].tasa_cuota_ieps;
								objDetalleTFCotizacionCotizacionesServicioServicio.intPorcentajeIeps = intPorcentajeIeps;

								//Agregar datos del detalle (trabajo foráneo) de la cotización
           						objTFCotizacionCotizacionesServicioServicio.setDetalle(objDetalleTFCotizacionCotizacionesServicioServicio);

							    //Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_trabajos_foraneos_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];
							    //Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaConcepto = objRenglon.insertCell(0);
								var objCeldaCantidad = objRenglon.insertCell(1);
								var objCeldaPrecioUnitario = objRenglon.insertCell(2);
								var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
								var objCeldaSubtotal = objRenglon.insertCell(4);
								var objCeldaIva = objRenglon.insertCell(5);
								var objCeldaIeps = objRenglon.insertCell(6);
								var objCeldaTotal = objRenglon.insertCell(7);
								var objCeldaAcciones = objRenglon.insertCell(8);
								//Columnas ocultas
								var objCeldaTasaCuotaIva = objRenglon.insertCell(9);
								var objCeldaTasaCuotaIeps = objRenglon.insertCell(10);
								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', intRenglon);
								objCeldaConcepto.setAttribute('class', 'movil d1');
								objCeldaConcepto.innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.strConcepto;
								objCeldaCantidad.setAttribute('class', 'movil d2');
								objCeldaCantidad.innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intCantidad;
								objCeldaPrecioUnitario.setAttribute('class', 'movil d3');
								objCeldaPrecioUnitario.innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intPrecioUnitario;
								objCeldaDescuentoUnitario.setAttribute('class', 'movil d4');
								objCeldaDescuentoUnitario.innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intDescuentoUnitario;
								objCeldaSubtotal.setAttribute('class', 'movil d5');
								objCeldaSubtotal.innerHTML = intSubtotal;
								objCeldaIva.setAttribute('class', 'movil d6');
								objCeldaIva.innerHTML = intImporteIva;
								objCeldaIeps.setAttribute('class', 'movil d7');
								objCeldaIeps.innerHTML = intImporteIeps;
								objCeldaTotal.setAttribute('class', 'movil d8');
								objCeldaTotal.innerHTML = intTotal;
								objCeldaAcciones.setAttribute('class', 'td-center movil d9');
								objCeldaAcciones.innerHTML = strAccionesTablaTF;
								objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIva.innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIva;
								objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIeps.innerHTML =  objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIeps;

				            }//Cierre de verificación de trabajos foráneos

				            //Hacer un llamado a la función para calcular totales de la tabla trabajos foráneos
							calcular_totales_trabajos_foraneos_cotizaciones_servicio_servicio();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_trabajos_foraneos_cotizaciones_servicio_servicio tr").length - 2;
							$('#numElementos_trabajos_foraneos_cotizaciones_servicio_servicio').html(intFilas);
							$('#txtNumDetalles_trabajos_foraneos_cotizaciones_servicio_servicio').val(intFilas);

				            //Mostramos los detalles (otros servicios) del registro
				           	for (var intCon in data.otros) 
				            {
				            	//Variable que se utiliza para asignar el renglón del detalle
								var intRenglon = data.otros[intCon].renglon;
								//Crear instancia del objeto Otro servicio de la cotización
								objOtroCotizacionCotizacionesServicioServicio = 
								new OtroCotizacionCotizacionesServicioServicio('', '',  '', '', 
														            		   '', '', '', 
														            		   '', '');

								//Variables que se utilizan para asignar valores del detalle
								var intSubtotal = parseFloat(data.otros[intCon].precio_unitario);
								var intCantidad =  parseFloat(data.otros[intCon].cantidad);
								var intPrecioUnitario = parseFloat(data.otros[intCon].precio_unitario);
								var intDescuentoUnitario = parseFloat(data.otros[intCon].descuento_unitario);
								var intIvaUnitario = parseFloat(data.otros[intCon].iva_unitario);
								var intIepsUnitario = parseFloat(data.otros[intCon].ieps_unitario);
								var intImporteIva = 0;
								var intImporteIeps = 0;
								var intPorcentajeDescuento = 0;
								var intPorcentajeIeps = '';
								var intTotal = 0;

								//Convertir peso mexicano a tipo de cambio
								intSubtotal = intSubtotal / intTipoCambio;
								intPrecioUnitario = intPrecioUnitario / intTipoCambio;
								intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
								intIvaUnitario = intIvaUnitario / intTipoCambio;
								intIepsUnitario = intIepsUnitario / intTipoCambio;


								//Si existe importe del descuento
								if(intDescuentoUnitario > 0)
								{
									//Calcular precio unitario
									intPrecioUnitario = intPrecioUnitario + intDescuentoUnitario;
									//Calcular porcentaje del descuento
									intPorcentajeDescuento = (intDescuentoUnitario / intPrecioUnitario) * 100;
								}

								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;

								//Calcular importe de IVA
								intImporteIva =  intIvaUnitario * intCantidad;


								//Si existe importe de IEPS unitario
								if(intIepsUnitario > 0)
								{
									//Calcular importe de IEPS
									intImporteIeps =  intIepsUnitario * intCantidad;
									//Asignar porcentaje de IEPS
									intPorcentajeIeps = data.otros[intCon].porcentaje_ieps;
								}

								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								//Cambiar cantidad a  formato moneda (a visualizar)
								intCantidad =  formatMoney(intCantidad, 2, '');
							    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
							    intDescuentoUnitario =  formatMoney(intDescuentoUnitario, 2, '');
							    intPorcentajeDescuento =  formatMoney(intPorcentajeDescuento, 2, '');
							    intImporteIva  =  formatMoney(intImporteIva, 4, '');
							    intImporteIeps  =  formatMoney(intImporteIeps, 4, '');
							    intSubtotal  =  formatMoney(intSubtotal, 2, '');
							    intTotal  =  formatMoney(intTotal, 2, '');


								//Asignar valores al objeto
								objOtroCotizacionCotizacionesServicioServicio.strConcepto = data.otros[intCon].concepto;
								objOtroCotizacionCotizacionesServicioServicio.intCantidad = intCantidad;
								objOtroCotizacionCotizacionesServicioServicio.intPrecioUnitario = intPrecioUnitario;
								objOtroCotizacionCotizacionesServicioServicio.intPorcentajeDescuento = intPorcentajeDescuento;
								objOtroCotizacionCotizacionesServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
								objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIva = data.otros[intCon].tasa_cuota_iva;;
								objOtroCotizacionCotizacionesServicioServicio.intPorcentajeIva = data.otros[intCon].porcentaje_iva;
								objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIeps = data.otros[intCon].tasa_cuota_ieps;
								objOtroCotizacionCotizacionesServicioServicio.intPorcentajeIeps = intPorcentajeIeps;

								//Agregar datos del detalle (otro servicio) de la cotización
           						objOtrosCotizacionCotizacionesServicioServicio.setDetalle(objOtroCotizacionCotizacionesServicioServicio);

							    //Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_otros_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];
							    //Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaConcepto = objRenglon.insertCell(0);
								var objCeldaCantidad = objRenglon.insertCell(1);
								var objCeldaPrecioUnitario = objRenglon.insertCell(2);
								var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
								var objCeldaSubtotal = objRenglon.insertCell(4);
								var objCeldaIva = objRenglon.insertCell(5);
								var objCeldaIeps = objRenglon.insertCell(6);
								var objCeldaTotal = objRenglon.insertCell(7);
								var objCeldaAcciones = objRenglon.insertCell(8);
								//Columnas ocultas
								var objCeldaTasaCuotaIva = objRenglon.insertCell(9);
								var objCeldaTasaCuotaIeps = objRenglon.insertCell(10);
								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', intRenglon);
								objCeldaConcepto.setAttribute('class', 'movil e1');
								objCeldaConcepto.innerHTML = objOtroCotizacionCotizacionesServicioServicio.strConcepto;
								objCeldaCantidad.setAttribute('class', 'movil e2');
								objCeldaCantidad.innerHTML = objOtroCotizacionCotizacionesServicioServicio.intCantidad;
								objCeldaPrecioUnitario.setAttribute('class', 'movil e3');
								objCeldaPrecioUnitario.innerHTML = objOtroCotizacionCotizacionesServicioServicio.intPrecioUnitario;
								objCeldaDescuentoUnitario.setAttribute('class', 'movil e4');
								objCeldaDescuentoUnitario.innerHTML = objOtroCotizacionCotizacionesServicioServicio.intDescuentoUnitario;
								objCeldaSubtotal.setAttribute('class', 'movil e5');
								objCeldaSubtotal.innerHTML = intSubtotal;
								objCeldaIva.setAttribute('class', 'movil e6');
								objCeldaIva.innerHTML = intImporteIva;
								objCeldaIeps.setAttribute('class', 'movil e7');
								objCeldaIeps.innerHTML = intImporteIeps;
								objCeldaTotal.setAttribute('class', 'movil e8');
								objCeldaTotal.innerHTML = intTotal;
								objCeldaAcciones.setAttribute('class', 'td-center movil e9');
								objCeldaAcciones.innerHTML = strAccionesTablaOtros;
								objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIva.innerHTML = objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIva;
								objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIeps.innerHTML =  objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIeps;

				            }//Cierre de verificación de otros servicios

				            //Hacer un llamado a la función para calcular totales de la tabla otros servicios
							calcular_totales_otros_cotizaciones_servicio_servicio();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_otros_cotizaciones_servicio_servicio tr").length - 2;
							$('#numElementos_otros_cotizaciones_servicio_servicio').html(intFilas);
							$('#txtNumDetalles_otros_cotizaciones_servicio_servicio').val(intFilas);

				           
			            	//Abrir modal
				            objCotizacionesServicioServicio = $('#CotizacionesServicioServicioBox').bPopup({
														  appendTo: '#CotizacionesServicioServicioContent', 
							                              contentContainer: 'CotizacionesServicioServicioM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#cmbMonedaID_cotizaciones_servicio_servicio').focus();
			       	    }
			       },
			       'json');
		}

		

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_cotizaciones_servicio_servicio()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_cotizaciones_servicio_servicio').val()) !== intMonedaBaseIDCotizacionesServicioServicio)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_cotizaciones_servicio_servicio").val('');
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_cotizaciones_servicio_servicio').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_cotizaciones_servicio_servicio').val();
				
	            //Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	             $.ajax('caja/tipos_cambio/get_datos',
	             		{
				        "type" : "post",
				        "data": {strBusqueda:  strCriteriosBusq,
			       				 strTipo: 'fecha'
				                 },
				        success: function(data){
				            //Si los datos se recuperaron correctamente
				             if(data.row){
			                       $("#txtTipoCambio_cotizaciones_servicio_servicio").val(data.row.tipo_cambio_venta);
			                     
			                    }
				          },
				        "async": false,
				      });

	             //Hacer un llamado a la función para recalcular los importes y habilitar/deshabilitar campos
	              recalcular_precio_unitario_refacciones_cotizaciones_servicio_servicio('#txtTipoCambio_cotizaciones_servicio_servicio');
			}
		}

		//Función para recalcular el precio unitario del detalle
		function recalcular_precio_unitario_refacciones_cotizaciones_servicio_servicio(strCampoID)
		{
			//Si existe id del prospecto
            if($("#txtProspectoID_cotizaciones_servicio_servicio").val() !== '')
            {
	        	//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
				habilitar_elementos_tipo_cambio_refacciones_cotizaciones_servicio_servicio(strCampoID);
			}

        	//Hacer un llamado a la función para calcular el precio unitario
		  	calcular_precio_unitario_refacciones_cotizaciones_servicio_servicio();
        	//Hacer un llamado a la función para recalcular los importes
		  	recalcular_importes_refacciones_cotizaciones_servicio_servicio();
		}



		//Función para habilitar y deshabilitar los campos del detalle cuando cambia el tipo de cambio
		function habilitar_elementos_tipo_cambio_refacciones_cotizaciones_servicio_servicio(campo){
			//Deshabilitar o habilitar las siguientes cajas de texto			
			var arrCajasTexto  = {
						//Son los id de los input que se van a habilitar o deshabilitar
						rows:['#txtReferencia_refacciones_cotizaciones_servicio_servicio',
							  '#txtCantidad_refacciones_cotizaciones_servicio_servicio',
							  //'#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio',
							  '#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio'
							  ],
						//Es asignar un attributo disbaled|checked
						attribute: 'disabled',									
					};						
			($(campo).val() && $('#txtTipoCambio_cotizaciones_servicio_servicio').val())? arrCajasTexto.bool = false: arrCajasTexto.bool= true;								
			//Hacer un llamado a la función para habilitar o deshabilitar cajas de texto				
			$.habilitar_deshabilitar_campos(arrCajasTexto);
		}



		/*******************************************************************************************************************
		Funciones del Tab - Mano de Obra
		*********************************************************************************************************************/
		//Función para inicializar elementos del servicio
		function inicializar_detalle_mano_obra_cotizaciones_servicio_servicio()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtRenglon_mano_obra_cotizaciones_servicio_servicio').val('');
			$('#txtServicioID_mano_obra_cotizaciones_servicio_servicio').val('');
			$('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').val('');
		    $('#txtDescripcion_mano_obra_cotizaciones_servicio_servicio').val('');
		    $('#txtHoras_mano_obra_cotizaciones_servicio_servicio').val('');
		    $('#txtPrecioUnitario_mano_obra_cotizaciones_servicio_servicio').val('');
		    $('#txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio').val('0.00');
		    $('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').val('');
		    $('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').val('');
		    $('#txtTasaCuotaIva_mano_obra_cotizaciones_servicio_servicio').val('');
		    $('#txtTasaCuotaIeps_mano_obra_cotizaciones_servicio_servicio').val('');
		}

		//Función para regresar obtener los datos de un servicio
		function get_datos_servicio_mano_obra_cotizaciones_servicio_servicio()
		{
			
			//Hacer un llamado al método del controlador para regresar los datos del servicio
         	$.post('servicio/servicios/get_datos',
              { 
              	strBusqueda:$("#txtServicioID_mano_obra_cotizaciones_servicio_servicio").val(),
	       		strTipo: 'id'
              },
              function(data) {
                if(data.row){
                   $("#txtCodigo_mano_obra_cotizaciones_servicio_servicio").val(data.row.codigo);
                   $("#txtDescripcion_mano_obra_cotizaciones_servicio_servicio").val(data.row.descripcion);
                   $("#txtHoras_mano_obra_cotizaciones_servicio_servicio").val(data.row.horas);
                   //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
			       $('#txtHoras_mano_obra_cotizaciones_servicio_servicio').formatCurrency({ roundToDecimalPlace: 2 });
			       //Enfocar caja de texto
			       $('#txtHoras_mano_obra_cotizaciones_servicio_servicio').focus();
			       //Hacer un llamado a la función para regresar los datos del precio de un tipo de equipo
	               get_precio_equipo_tipo_cotizaciones_servicio_servicio();

                }
              }
             ,
            'json');

		}

		//Función para regresar obtener el precio de un tipo de equipo
		function get_precio_equipo_tipo_cotizaciones_servicio_servicio()
		{
			//Si existe id del servicio de mano de obra
			if($("#txtServicioID_mano_obra_cotizaciones_servicio_servicio").val() != '')
			{
				//Hacer un llamado al método del controlador para regresar los datos del tipo de equipo
				$.post('servicio/equipos_tipos/get_datos',
				  { 
				  	strBusqueda: $("#txtEquipoTipoID_cotizaciones_servicio_servicio").val(),
				  	strTipo: 'id',
				  	intServicioTipoID: $("#txtServicioTipoID_cotizaciones_servicio_servicio").val()
				  },
				  function(data) {
				    if(data.row)
				    {    
				    	//Recuperar valores
				    	$('#txtPrecioUnitario_mano_obra_cotizaciones_servicio_servicio').val(data.row.precio);
				         //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
						$('#txtPrecioUnitario_mano_obra_cotizaciones_servicio_servicio').formatCurrency({ roundToDecimalPlace: 2 });
				    }
				}
				 ,
				'json');
			}
		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_mano_obra_cotizaciones_servicio_servicio()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla cotizaciones_servicio_mano_obra)
			var intSubtotal = 0;
			//Variable que se utiliza para asignar el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_mano_obra_cotizaciones_servicio_servicio').val();
			var intServicioID = $('#txtServicioID_mano_obra_cotizaciones_servicio_servicio').val();
			var strCodigo = $('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').val();
			var strDescripcion = $('#txtDescripcion_mano_obra_cotizaciones_servicio_servicio').val();
			var intHoras = $('#txtHoras_mano_obra_cotizaciones_servicio_servicio').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_mano_obra_cotizaciones_servicio_servicio').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_mano_obra_cotizaciones_servicio_servicio').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_mano_obra_cotizaciones_servicio_servicio').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_mano_obra_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];


			//Validamos que se capturaron datos
			if (intServicioID == '' || strCodigo == '')
			{
				//Enfocar caja de texto
				$('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').focus();
			}
			else if (intServicioID == '' || strDescripcion == '')
			{
				//Enfocar caja de texto
				$('#txtDescripcion_mano_obra_cotizaciones_servicio_servicio').focus();
			}
			else if (intHoras == '')
			{
				//Enfocar caja de texto
				$('#txtHoras_mano_obra_cotizaciones_servicio_servicio').focus();
			}
			else if (intPrecioUnitario == '' ||  parseFloat(intPrecioUnitario) <= 0)
			{
				
				//Hacer un llamado a la función para mostrar mensaje de información
	          	mensaje_cotizaciones_servicio_servicio('informacion_mano_obra', 'No es posible agregar el servicio porque no tiene un precio establecido.');
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio').focus();
			}
			else if (intPorcentajeIva == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').focus();
			}
			else if(intTasaCuotaIeps == '' && intPorcentajeIeps != '')
			{
				//Limpiar caja de texto
				$('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').focus();
			}
			else
			{

				//Crear instancia del objeto Detalle del servicio de Mano de Obra de la cotización
				objDetalleMOCotizacionCotizacionesServicioServicio 
				= new DetalleMOCotizacionCotizacionesServicioServicio('', '', '',
																	 '', '', '', 
											           				 '', '', '', 
											            			 '');

				

				//Hacer un llamado a la función para inicializar elementos del detalle
				inicializar_detalle_mano_obra_cotizaciones_servicio_servicio();

				//Convertir cadena de texto a número decimal
				intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
				intHoras = parseFloat($.reemplazar(intHoras, ",", ""));
				intSubtotal = intPrecioUnitario;

				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					//Calcular descuento unitario
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;

					//Redondear cantidad a decimales
					intDescuentoUnitario = intDescuentoUnitario.toFixed(2);

					//Decrementar descuento unitario
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}

				//Calcular subtotal
				intSubtotal = intHoras * intSubtotal;
				//Redondear cantidad a decimales
				intSubtotal = intSubtotal.toFixed(2);
				intSubtotal = parseFloat(intSubtotal);

				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

				//Redondear cantidad a dos decimales
			    intImporteIva = intImporteIva.toFixed(4);
			    intImporteIva = parseFloat(intImporteIva);


				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
					//Redondear cantidad a dos decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(4);
			   	 	intImporteIeps = parseFloat(intImporteIeps);

				}


				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;


				//Cambiar cantidad a  formato moneda (a visualizar)
				intHoras =  formatMoney(intHoras, 2, '');
			    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
			    intDescuentoUnitario =  formatMoney(intDescuentoUnitario, 2, '');
			    intImporteIva  =  formatMoney(intImporteIva, 4, '');
			    intImporteIeps  =  formatMoney(intImporteIeps, 4, '');
			    intSubtotal  =  formatMoney(intSubtotal, 2, '');
			    intTotal  =  formatMoney(intTotal, 2, '');


				//Asignar valores al objeto
				objDetalleMOCotizacionCotizacionesServicioServicio.intServicioID = intServicioID;
				objDetalleMOCotizacionCotizacionesServicioServicio.strCodigo = strCodigo;
				objDetalleMOCotizacionCotizacionesServicioServicio.strDescripcion = strDescripcion;
				objDetalleMOCotizacionCotizacionesServicioServicio.intHoras = intHoras;
				objDetalleMOCotizacionCotizacionesServicioServicio.intPrecioUnitario = intPrecioUnitario;
				objDetalleMOCotizacionCotizacionesServicioServicio.intPorcentajeDescuento = intPorcentajeDescuento;
				objDetalleMOCotizacionCotizacionesServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
				objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIva = intTasaCuotaIva;
				objDetalleMOCotizacionCotizacionesServicioServicio.intPorcentajeIva = intPorcentajeIva;
				objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIeps = intTasaCuotaIeps;
				objDetalleMOCotizacionCotizacionesServicioServicio.intPorcentajeIeps = intPorcentajeIeps;

				//Revisamos si existe el renglón, si es así, editamos los datos del detalle
				if (intRenglon)
				{
					//Modificar los datos del detalle (mano de obra) corespondiente al indice
	        		objMOCotizacionCotizacionesServicioServicio.modificarDetalle(intRenglon, objDetalleMOCotizacionCotizacionesServicioServicio);

	        		//Incrementar renglón para obtener la posición del detalle en la tabla
					intRenglon++;

					//Seleccionar el renglón de la tabla para actualizar los datos del detalle
					var selectedRow = document.getElementById("dg_mano_obra_cotizaciones_servicio_servicio").rows[intRenglon].cells;

					selectedRow[0].innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.strCodigo;
					selectedRow[1].innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.strDescripcion;
					selectedRow[2].innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intHoras;
					selectedRow[3].innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intPrecioUnitario;
					selectedRow[4].innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intDescuentoUnitario;
					selectedRow[5].innerHTML = intSubtotal;
					selectedRow[6].innerHTML = intImporteIva;
					selectedRow[7].innerHTML = intImporteIeps;
					selectedRow[8].innerHTML = intTotal;
					selectedRow[10].innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intServicioID;
					selectedRow[11].innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIva;
					selectedRow[12].innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIeps;
				}
				else
				{
					//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
					intRenglon = $("#dg_mano_obra_cotizaciones_servicio_servicio tr").length - 2;
					//Incrementar 1 para el siguiente renglón
					intRenglon++;

					//Agregar datos del detalle (mano de obra) de la cotización
           			objMOCotizacionCotizacionesServicioServicio.setDetalle(objDetalleMOCotizacionCotizacionesServicioServicio);

           			//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCodigo = objRenglon.insertCell(0);
					var objCeldaDescripcion = objRenglon.insertCell(1);
					var objCeldaHoras = objRenglon.insertCell(2);
					var objCeldaPrecioUnitario = objRenglon.insertCell(3);
					var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
					var objCeldaSubtotal = objRenglon.insertCell(5);
					var objCeldaIva = objRenglon.insertCell(6);
					var objCeldaIeps = objRenglon.insertCell(7);
					var objCeldaTotal = objRenglon.insertCell(8);
					var objCeldaAcciones = objRenglon.insertCell(9);
					//Columnas ocultas
					var objCeldaServicioID = objRenglon.insertCell(10);
					var objCeldaTasaCuotaIva = objRenglon.insertCell(11);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(12);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRenglon);
					objCeldaCodigo.setAttribute('class', 'movil b1');
					objCeldaCodigo.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.strCodigo;
					objCeldaDescripcion.setAttribute('class', 'movil b2');
					objCeldaDescripcion.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.strDescripcion;
					objCeldaHoras.setAttribute('class', 'movil b3');
					objCeldaHoras.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intHoras;
					objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
					objCeldaPrecioUnitario.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intPrecioUnitario;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
					objCeldaDescuentoUnitario.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intDescuentoUnitario;
					objCeldaSubtotal.setAttribute('class', 'movil b6');
					objCeldaSubtotal.innerHTML = intSubtotal;
					objCeldaIva.setAttribute('class', 'movil b7');
					objCeldaIva.innerHTML = intImporteIva;
					objCeldaIeps.setAttribute('class', 'movil b8');
					objCeldaIeps.innerHTML = intImporteIeps;
					objCeldaTotal.setAttribute('class', 'movil b9');
					objCeldaTotal.innerHTML = intTotal;
					objCeldaAcciones.setAttribute('class', 'td-center movil b10');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_mano_obra_cotizaciones_servicio_servicio(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_mano_obra_cotizaciones_servicio_servicio(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				    objCeldaServicioID.setAttribute('class', 'no-mostrar');
					objCeldaServicioID.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intServicioID;
				    objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIva.innerHTML = objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIva;
					objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIeps.innerHTML =  objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIeps;

				}


				//Hacer un llamado a la función para calcular totales de la tabla otros servicios
				calcular_totales_mano_obra_cotizaciones_servicio_servicio();

				//Enfocar caja de texto
				$('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').focus();

			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_mano_obra_cotizaciones_servicio_servicio tr").length - 2;
			$('#numElementos_mano_obra_cotizaciones_servicio_servicio').html(intFilas);
			$('#txtNumDetalles_mano_obra_cotizaciones_servicio_servicio').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_mano_obra_cotizaciones_servicio_servicio(objRenglon)
		{

			//Decrementar indice para obtener la posición del detalle en el arreglo
		    var intRenglon =  parseInt(objRenglon.parentNode.parentNode.rowIndex) - 1;

		    //Crear instancia del objeto mano de obra de la cotización
        	objDetalleMOCotizacionCotizacionesServicioServicio = new DetalleMOCotizacionCotizacionesServicioServicio ();

        	//Asignar datos del detalle (mano de obra) corespondiente al indice
        	objDetalleMOCotizacionCotizacionesServicioServicio = objMOCotizacionCotizacionesServicioServicio.getDetalle(intRenglon);

			//Asignar los valores a las cajas de texto
			$('#txtRenglon_mano_obra_cotizaciones_servicio_servicio').val(intRenglon);
			$('#txtServicioID_mano_obra_cotizaciones_servicio_servicio').val(objDetalleMOCotizacionCotizacionesServicioServicio.intServicioID);
			$('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').val(objDetalleMOCotizacionCotizacionesServicioServicio.strCodigo);
			$('#txtDescripcion_mano_obra_cotizaciones_servicio_servicio').val(objDetalleMOCotizacionCotizacionesServicioServicio.strDescripcion);
			$('#txtHoras_mano_obra_cotizaciones_servicio_servicio').val(objDetalleMOCotizacionCotizacionesServicioServicio.intHoras);
			$('#txtPrecioUnitario_mano_obra_cotizaciones_servicio_servicio').val(objDetalleMOCotizacionCotizacionesServicioServicio.intPrecioUnitario);
			$('#txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio').val(objDetalleMOCotizacionCotizacionesServicioServicio.intPorcentajeDescuento);
			$('#txtTasaCuotaIva_mano_obra_cotizaciones_servicio_servicio').val(objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIva);
			$('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').val(objDetalleMOCotizacionCotizacionesServicioServicio.intPorcentajeIva);
			$('#txtTasaCuotaIeps_mano_obra_cotizaciones_servicio_servicio').val(objDetalleMOCotizacionCotizacionesServicioServicio.intTasaCuotaIeps);
			$('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').val(objDetalleMOCotizacionCotizacionesServicioServicio.intPorcentajeIeps);

			//Enfocar caja de texto
			$('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_mano_obra_cotizaciones_servicio_servicio(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			//Eliminar del objeto el detalle (mano de obra) seleccionado
			objMOCotizacionCotizacionesServicioServicio.eliminarDetalle(intRenglon - 1);

			//Eliminar el renglón indicado
			document.getElementById("dg_mano_obra_cotizaciones_servicio_servicio").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla otros servicios
			calcular_totales_mano_obra_cotizaciones_servicio_servicio();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_mano_obra_cotizaciones_servicio_servicio tr").length - 2;
			$('#numElementos_mano_obra_cotizaciones_servicio_servicio').html(intFilas);
			$('#txtNumDetalles_mano_obra_cotizaciones_servicio_servicio').val(intFilas);

			//Enfocar caja de texto
			$('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').focus();

		}

		//Función para calcular totales de la tabla
		function calcular_totales_mano_obra_cotizaciones_servicio_servicio()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_mano_obra_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumHoras = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumHoras += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[8].innerHTML, ",", ""));

			}

			//Convertir total de unidades a 2 decimales
			intAcumHoras = formatMoney(intAcumHoras, 2, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, 2, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 2, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, 4, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, 4, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 2, '');

			//Asignar los valores
			$('#acumHoras_mano_obra_cotizaciones_servicio_servicio').html(intAcumHoras);
			$('#acumDescuento_mano_obra_cotizaciones_servicio_servicio').html(intAcumDescuento);
			$('#acumSubtotal_mano_obra_cotizaciones_servicio_servicio').html(intAcumSubtotal);
			$('#acumIva_mano_obra_cotizaciones_servicio_servicio').html(intAcumIva);
			$('#acumIeps_mano_obra_cotizaciones_servicio_servicio').html(intAcumIeps);
			$('#acumTotal_mano_obra_cotizaciones_servicio_servicio').html(intAcumTotal);
		}


		/*******************************************************************************************************************
		Funciones del Tab - Refacciones
		*********************************************************************************************************************/
		//Función para inicializar elementos del detalle
		function inicializar_detalle_refacciones_cotizaciones_servicio_servicio() 
		{
			//Limpiar las siguientes cajas de texto
			$('#txtReferenciaID_refacciones_cotizaciones_servicio_servicio').val('');
			$('#txtReferencia_refacciones_cotizaciones_servicio_servicio').val('');
			$('#txtTipoReferencia_refacciones_cotizaciones_servicio_servicio').val('');
			$('#txtCodigo_refacciones_cotizaciones_servicio_servicio').val('');
			$('#txtDescripcion_refacciones_cotizaciones_servicio_servicio').val('');
			$('#txtCantidad_refacciones_cotizaciones_servicio_servicio').val('');
		    $('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').val('');
		    $('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').val('0.00');
		    $('#txtPorcentajeIva_refacciones_cotizaciones_servicio_servicio').val('');
		    $('#txtPorcentajeIeps_refacciones_cotizaciones_servicio_servicio').val('');
		    $('#txtTasaCuotaIva_refacciones_cotizaciones_servicio_servicio').val('');
		    $('#txtTasaCuotaIeps_refacciones_cotizaciones_servicio_servicio').val('');
		    $('#txtTipoCambio_refacciones_cotizaciones_servicio_servicio').val('');
		    $('#txtPrecioRefaccion_refacciones_cotizaciones_servicio_servicio').val('');
		    //Habilitar las siguientes cajas de texto
	    	$("#txtCantidad_refacciones_cotizaciones_servicio_servicio").removeAttr('disabled');
	   	 	//$("#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio").removeAttr('disabled');
		    
		}

		//Función para regresar y obtener los datos de una refacción
		function get_datos_refaccion_refacciones_cotizaciones_servicio_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los datos de la refacción
           	$.post('refacciones/refacciones/get_datos',
                  { 
                  	strBusqueda: $('#txtReferenciaID_refacciones_cotizaciones_servicio_servicio').val(),
		       		strTipo: 'id', 
		       		intRefaccionesListaPrecioID: $('#txtServicioListaPrecioID_cotizaciones_servicio_servicio').val(), 
		       		//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día 
	       			dteFechaTipoCambio: $.formatFechaMysql($('#txtFecha_cotizaciones_servicio_servicio').val()),
	       			//Regresar el precio que le corresponde al cliente
			       	strListaPrecioCte: 'SI'
                  },
                  function(data) {
                    if(data.row){

                       	$('#txtCodigo_refacciones_cotizaciones_servicio_servicio').val(data.row.codigo_01);
                       	$('#txtDescripcion_refacciones_cotizaciones_servicio_servicio').val(data.row.descripcion);
                       	$('#txtPrecioRefaccion_refacciones_cotizaciones_servicio_servicio').val(data.row.precio);

                       	$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').val(0);
        				//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
		    			$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').formatCurrency({ roundToDecimalPlace: 2 });

                       	$('#txtTasaCuotaIva_refacciones_cotizaciones_servicio_servicio').val(data.row.tasa_cuota_iva);
                       	$('#txtPorcentajeIva_refacciones_cotizaciones_servicio_servicio').val(data.row.porcentaje_iva);
                       	$('#txtTasaCuotaIeps_refacciones_cotizaciones_servicio_servicio').val(data.row.tasa_cuota_ieps);
                       	$('#txtPorcentajeIeps_refacciones_cotizaciones_servicio_servicio').val(data.row.porcentaje_ieps);
                       $('#txtTipoCambio_refacciones_cotizaciones_servicio_servicio').val(data.row.tipo_cambio_venta);
                      
                       //Hacer un llamado a la función para calcular el precio unitario
				  	   calcular_precio_unitario_refacciones_cotizaciones_servicio_servicio();
                       //Enfocar caja de texto
                  	   $('#txtCantidad_refacciones_cotizaciones_servicio_servicio').focus();
                    }
                  }
                 ,
                'json');
		}

		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_refacciones_cotizaciones_servicio_servicio(tipoReferencia)
		{
			//Si el tipo de referencia corresponde a una REFACCION
			if(tipoReferencia == 'REFACCION')
			{
				//Habilitar las siguientes cajas de texto
		    	//$('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').removeAttr('disabled');
		    	$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').removeAttr('disabled');
			}

			//Habilitar las siguientes cajas de texto
			$('#txtReferencia_refacciones_cotizaciones_servicio_servicio').removeAttr('disabled');
		    $('#txtCantidad_refacciones_cotizaciones_servicio_servicio').removeAttr('disabled');
		    //Limpiar las siguientes cajas de texto
		    $('#txtTipoReferencia_refacciones_cotizaciones_servicio_servicio').val('');
            $('#txtCodigo_refacciones_cotizaciones_servicio_servicio').val('');
            $('#txtDescripcion_refacciones_cotizaciones_servicio_servicio').val('');
            $('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').val('');
            $('#txtPrecioRefaccion_refacciones_cotizaciones_servicio_servicio').val('');
            $('#txtTipoCambioRefaccion_refacciones_cotizaciones_servicio_servicio').val('');
            $('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').val('0.00');
            $('#txtPorcentajeIva_refacciones_cotizaciones_servicio_servicio').val('');
            $('#txtPorcentajeIeps_refacciones_cotizaciones_servicio_servicio').val('');
            $('#txtTasaCuotaIva_refacciones_cotizaciones_servicio_servicio').val('');
			$('#txtTasaCuotaIeps_refacciones_cotizaciones_servicio_servicio').val('');
            $('#txtCantidad_refacciones_cotizaciones_servicio_servicio').val('');
            
		}

		//Función para cargar las refacciones de la cotización en la tabla 
		function cargar_refacciones_cotizaciones_servicio_servicio(intTipoCambio, arrDetalles, strAccionesTabla)
		{

			//Dependiendo del tipo de registro mostrar acciones de la tabla
			if(strAccionesTabla != '')
			{
	            //Habilitar las siguientes cajas de texto
				$("#txtReferencia_refacciones_cotizaciones_servicio_servicio").removeAttr('disabled');
				$("#txtCantidad_refacciones_cotizaciones_servicio_servicio").removeAttr('disabled');
				//$("#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio").removeAttr('disabled');
				$("#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio").removeAttr('disabled');
			}

           	//Mostramos los detalles del registro
           	for (var intCon in arrDetalles) 
            {
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_refacciones_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

				//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaCodigo = objRenglon.insertCell(0);
				var objCeldaDescripcion = objRenglon.insertCell(1);
				var objCeldaCantidad = objRenglon.insertCell(2);
				var objCeldaPrecioUnitario = objRenglon.insertCell(3);
				var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
				var objCeldaSubtotal = objRenglon.insertCell(5);
				var objCeldaIvaUnitario = objRenglon.insertCell(6);
				var objCeldaIepsUnitario = objRenglon.insertCell(7);
				var objCeldaTotal = objRenglon.insertCell(8);
				var objCeldaAcciones = objRenglon.insertCell(9);
				//Columnas ocultas
				var objCeldaPorcentajeDescuento = objRenglon.insertCell(10);
				var objCeldaPorcentajeIva = objRenglon.insertCell(11);
				var objCeldaPorcentajeIeps = objRenglon.insertCell(12);
				var objCeldaTipoReferencia = objRenglon.insertCell(13);
				var objCeldaTipoCambio = objRenglon.insertCell(14);
				var objCeldaPrecioRefaccion = objRenglon.insertCell(15);
				var objCeldaTasaCuotaIva = objRenglon.insertCell(16);
				var objCeldaTasaCuotaIeps = objRenglon.insertCell(17);

				//Variables que se utilizan para asignar valores del detalle
				var intSubtotal = parseFloat(arrDetalles[intCon].precio_unitario);
				var intCantidad =  parseFloat(arrDetalles[intCon].cantidad);
				var intPrecioUnitario = parseFloat(arrDetalles[intCon].precio_unitario);
				var intDescuentoUnitario = parseFloat(arrDetalles[intCon].descuento_unitario);
				var intIvaUnitario = parseFloat(arrDetalles[intCon].iva_unitario);
				var intIepsUnitario = parseFloat(arrDetalles[intCon].ieps_unitario);
				var intPrecioRefaccion = 0;
				var intImporteIva = 0;
				var intImporteIeps = 0;
				var intPorcentajeDescuento = 0;
				var intPorcentajeIeps = '';
				var intTotal = 0;

				//Convertir peso mexicano a tipo de cambio
				intSubtotal = intSubtotal / intTipoCambio;
				intPrecioUnitario = intPrecioUnitario / intTipoCambio;
				intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
				intIvaUnitario = intIvaUnitario / intTipoCambio;
				intIepsUnitario = intIepsUnitario / intTipoCambio;

				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{
					intPrecioUnitario = intPrecioUnitario + intDescuentoUnitario;
					//Calcular porcentaje del descuento
					intPorcentajeDescuento = (intDescuentoUnitario / intPrecioUnitario) * 100;
				}
				

			    //Asignar el precio de la refacción 
				intPrecioRefaccion = intPrecioUnitario;
				//Redondear cantidad a decimales
		   	 	intPrecioRefaccion = intPrecioRefaccion.toFixed(2);
		   	 	intPrecioRefaccion = parseFloat(intPrecioRefaccion);


				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;

				
				//Calcular importe de IVA
				intImporteIva =  intIvaUnitario * intCantidad;

				//Si existe importe de IEPS unitario
				if(intIepsUnitario > 0)
				{
					//Calcular importe de IEPS
					intImporteIeps =  intIepsUnitario * intCantidad;
					//Asignar porcentaje de IEPS
					intPorcentajeIeps = arrDetalles[intCon].porcentaje_ieps;
				}


				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Cambiar cantidad a  formato moneda (a visualizar)
				intCantidad =  formatMoney(intCantidad, 2, '');
			    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
			    intDescuentoUnitario =  formatMoney(intDescuentoUnitario, 2, '');
			    intPorcentajeDescuento =  formatMoney(intPorcentajeDescuento, 2, '');
			    intImporteIva  =  formatMoney(intImporteIva, 4, '');
			    intImporteIeps  =  formatMoney(intImporteIeps, 4, '');
			    intSubtotal  =  formatMoney(intSubtotal, 2, '');
			    intTotal  =  formatMoney(intTotal, 2, '');

				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', arrDetalles[intCon].refaccion_id);
				objCeldaCodigo.setAttribute('class', 'movil c1');
				objCeldaCodigo.innerHTML = arrDetalles[intCon].codigo;
				objCeldaDescripcion.setAttribute('class', 'movil c2');
				objCeldaDescripcion.innerHTML = arrDetalles[intCon].descripcion;
				objCeldaCantidad.setAttribute('class', 'movil c3');
				objCeldaCantidad.innerHTML = intCantidad;
				objCeldaPrecioUnitario.setAttribute('class', 'movil c4');
				objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
				objCeldaDescuentoUnitario.setAttribute('class', 'movil c5');
				objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
				objCeldaSubtotal.setAttribute('class', 'movil c6');
				objCeldaSubtotal.innerHTML = intSubtotal;
				objCeldaIvaUnitario.setAttribute('class', 'movil c7');
				objCeldaIvaUnitario.innerHTML = intImporteIva;
				objCeldaIepsUnitario.setAttribute('class', 'movil c8');
				objCeldaIepsUnitario.innerHTML = intImporteIeps;
				objCeldaTotal.setAttribute('class', 'movil c9');
				objCeldaTotal.innerHTML = intTotal;
				objCeldaAcciones.setAttribute('class', 'td-center movil c10');
				objCeldaAcciones.innerHTML = strAccionesTabla;
				objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
				objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento;
				objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
				objCeldaPorcentajeIva.innerHTML = arrDetalles[intCon].porcentaje_iva;
				objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
				objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
				objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
				objCeldaTipoReferencia.innerHTML = 'REFACCION';
				objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
				objCeldaTipoCambio.innerHTML = intTipoCambio;
				objCeldaPrecioRefaccion.setAttribute('class', 'no-mostrar');
				objCeldaPrecioRefaccion.innerHTML = intPrecioRefaccion;
				objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
				objCeldaTasaCuotaIva.innerHTML = arrDetalles[intCon].tasa_cuota_iva;
				objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
				objCeldaTasaCuotaIeps.innerHTML = arrDetalles[intCon].tasa_cuota_ieps;
            }

            //Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_refacciones_cotizaciones_servicio_servicio();
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $('#dg_refacciones_cotizaciones_servicio_servicio tr').length - 2;
			$('#numElementos_refacciones_cotizaciones_servicio_servicio').html(intFilas);
			$('#txtNumDetalles_refacciones_cotizaciones_servicio_servicio').val(intFilas);


		}

		//Función para la búsqueda de refacciones de la referencia
		function lista_refacciones_referencia_refacciones_cotizaciones_servicio_servicio(porcentajeDescuentoProm, referenciaID, tipoReferencia, cantidad) 
		{
			//Variable que se utiliza para asignar el tipo de cambio de la cotización
			var intTipoCambioCotizacion = parseFloat($('#txtTipoCambio_cotizaciones_servicio_servicio').val());
			//Variable que se utiliza para asignar el tipo de cambio de la cotización
			var intMonedaIDCotizacion =  parseFloat($('#cmbMonedaID_cotizaciones_servicio_servicio').val());
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_refacciones_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];
			
			//Array que se utiliza para agregar las refacciones incorrectas
			var arrDetallesIncorrectos = [];

			//Variable que se utiliza para asignar las acciones del grid view
            var strAccionesTablaDetalles = '';

			//Si el tipo de referencia no corresponde a un Kit de refacciones
            if(tipoReferencia != 'KIT')
            {
            	//Agregar acción de Editar
				strAccionesTablaDetalles = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_refacciones_cotizaciones_servicio_servicio(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>";					 
            }

            //Variable que se utiliza para asignar las acciones del grid view
            strAccionesTablaDetalles +=  "<button class='btn btn-default btn-xs' title='Eliminar'" +
									     " onclick='eliminar_renglon_refacciones_cotizaciones_servicio_servicio(this)'>" + 
										 "<span class='glyphicon glyphicon-trash'></span></button>" + 
										 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
										 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
										 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
										 "<span class='glyphicon glyphicon-arrow-down'></span></button>";								 

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones/get_datos',
			       {
			       		intReferenciaID: referenciaID,
			       		strTipoReferencia: tipoReferencia, 
			       		strTipo: 'referencias',
			       		intRefaccionesListaPrecioID: $('#txtServicioListaPrecioID_cotizaciones_servicio_servicio').val(), 
			       		//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			       		dteFechaTipoCambio:  $.formatFechaMysql($('#txtFecha_cotizaciones_servicio_servicio').val()),
			       		//Regresar el precio que le corresponde al cliente
			       		strListaPrecioCte: 'SI'

			       },
			       function(data) {

			       	 	//Mostramos las refacciones del registro
			            for (var intCon in data.row) 
			            {
				       		//Variables que se utilizan para asignar valores del detalle
							var intSubtotal = 0;
							var intPrecioUnitario = 0;
							var intRefaccionID =  data.row[intCon].refaccion_id;
							var intCantidad = 0;
							//Variable que se utiliza para asignar el tipo de referencia del detalle y poder modificar cantidad
							var strTipoReferenciaDet = tipoReferencia;
							//Si el tipo de referencia corresponde a un KIT
							if(tipoReferencia == 'KIT')
							{
								//Asignar la cantidad de la refacción del KIT
								intCantidad = data.row[intCon].cantidad;
							}
							else
							{
								//Asignar la cantidad del detalle
								intCantidad = cantidad;
								//Cambiar el tipo de referencia del detalle para poder modificar la cantidad en caso de ser LINEA/MARCA
								strTipoReferenciaDet = 'REFACCION';
							}
							
							var strCodigo = data.row[intCon].codigo;
							var strDescripcion = data.row[intCon].descripcion;
							var intPrecioRefaccion = parseFloat(data.row[intCon].precio);
							var intPorcentajeIva = parseFloat(data.row[intCon].porcentaje_iva);
							var intPorcentajeIeps = data.row[intCon].porcentaje_ieps;
							var intTipoCambioRefaccion = parseFloat(data.row[intCon].tipo_cambio_venta);
							var intTasaCuotaIva = data.row[intCon].tasa_cuota_iva;
							var intTasaCuotaIeps = data.row[intCon].tasa_cuota_ieps;
							var intPorcentajeDescuento = 0;
							//Concatenar los datos de la referencia
						    var strReferencia = strCodigo+' - '+strDescripcion;
							//Variable que se utiliza para asignar el descuento unitario
							var intDescuentoUnitario = 0;
							//Variable que se utiliza para asignar el importe de iva
							var intImporteIva = 0;
							//Variable que se utiliza para asignar el importe de ieps
							var intImporteIeps = 0;
							//Variable que se utiliza para asignar el importe total
							var intTotal = 0;

							//Si existe descuento de la promoción
							if(porcentajeDescuentoProm > 0)
							{
								intPorcentajeDescuento = porcentajeDescuentoProm;
							}
							else
							{
								intPorcentajeDescuento = parseFloat(data.row[intCon].porcentaje_descuento);
							}

							//Si existe precio de la refacción
						    if(intPrecioRefaccion > 0 && intTipoCambioRefaccion > 0)
						    {
					   	  	    //Convertir importe a peso mexicano
						      	intPrecioUnitario = intPrecioRefaccion * intTipoCambioRefaccion;

						       	//Si la moneda de la refacción no corresponde a peso mexicano
						        if(intMonedaIDCotizacion !== intMonedaBaseIDCotizacionesServicioServicio)
						        {
						       		//Convertir peso mexicano a tipo de cambio
						       		intPrecioUnitario = intPrecioUnitario / intTipoCambioCotizacion;

									//Redondear cantidad a decimales
									intPrecioUnitario = intPrecioUnitario.toFixed(2);
						    		intPrecioUnitario = parseFloat(intPrecioUnitario);
						        }
						    }

						    //Asignar el precio unitario
						    intSubtotal = intPrecioUnitario;

							//Si existe porcentaje de descuento
							if(intPorcentajeDescuento > 0)
							{
								//Calcular descuento unitario
								intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;

								//Redondear cantidad a decimales
								intDescuentoUnitario = intDescuentoUnitario.toFixed(2);

								//Decrementar descuento unitario
								intSubtotal = intSubtotal - intDescuentoUnitario;

								//Redondear cantidad a decimales
								intSubtotal = intSubtotal.toFixed(2);
								intSubtotal = parseFloat(intSubtotal);

							}

							//Si el precio es mayor que cero
							if(intSubtotal > 0)
							{
								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;
								//Redondear cantidad a decimales
								intSubtotal = intSubtotal.toFixed(2);
								intSubtotal = parseFloat(intSubtotal);

							
								//Calcular importe de IVA
								intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
								//Redondear cantidad a  decimales
							    intImporteIva = intImporteIva.toFixed(4);
							    intImporteIva = parseFloat(intImporteIva);
										
								
								//Si existe porcentaje de IEPS
								if(intPorcentajeIeps != '')
								{
									//Calcular importe de IEPS
									intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
									//Redondear cantidad a decimales
							   	 	intImporteIeps = intImporteIeps.toFixed(4);
							   	 	intImporteIeps = parseFloat(intImporteIeps);
								}
								
								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								//Cambiar cantidad a  formato moneda (a visualizar)
								intCantidad =  formatMoney(intCantidad, 2, '');
								intPrecioUnitario = formatMoney(intPrecioUnitario, 2, '');
								intDescuentoUnitario = formatMoney(intDescuentoUnitario, 2, '');
								intSubtotal = formatMoney(intSubtotal, 2, '');
								intImporteIva = formatMoney(intImporteIva, 4, '');
								intImporteIeps = formatMoney(intImporteIeps, 4, '');
								intTotal = formatMoney(intTotal, 2, '');
								intPorcentajeDescuento = formatMoney(intPorcentajeDescuento, 2, ''); 


								//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
								if (!objTabla.rows.namedItem(intRefaccionID))
								{
									//Insertamos el renglón con sus celdas en el objeto de la tabla
									var objRenglon = objTabla.insertRow();
									var objCeldaCodigo = objRenglon.insertCell(0);
									var objCeldaDescripcion = objRenglon.insertCell(1);
									var objCeldaCantidad = objRenglon.insertCell(2);
									var objCeldaPrecioUnitario = objRenglon.insertCell(3);
									var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
									var objCeldaSubtotal = objRenglon.insertCell(5);
									var objCeldaIvaUnitario = objRenglon.insertCell(6);
									var objCeldaIepsUnitario = objRenglon.insertCell(7);
									var objCeldaTotal = objRenglon.insertCell(8);
									var objCeldaAcciones = objRenglon.insertCell(9);
									//Columnas ocultas
									var objCeldaPorcentajeDescuento = objRenglon.insertCell(10);
									var objCeldaPorcentajeIva = objRenglon.insertCell(11);
									var objCeldaPorcentajeIeps = objRenglon.insertCell(12);
									var objCeldaTipoReferencia = objRenglon.insertCell(13);
									var objCeldaTipoCambio = objRenglon.insertCell(14);
									var objCeldaPrecioRefaccion = objRenglon.insertCell(15);
									var objCeldaTasaCuotaIva = objRenglon.insertCell(16);
									var objCeldaTasaCuotaIeps = objRenglon.insertCell(17);

									//Asignar valores
									objRenglon.setAttribute('class', 'movil');
									objRenglon.setAttribute('id', intRefaccionID);
									objCeldaCodigo.setAttribute('class', 'movil c1');
									objCeldaCodigo.innerHTML = strCodigo;
									objCeldaDescripcion.setAttribute('class', 'movil c2');
									objCeldaDescripcion.innerHTML = strDescripcion;
									objCeldaCantidad.setAttribute('class', 'movil c3');
									objCeldaCantidad.innerHTML = intCantidad;
									objCeldaPrecioUnitario.setAttribute('class', 'movil c4');
									objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
									objCeldaDescuentoUnitario.setAttribute('class', 'movil c5');
									objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
									objCeldaSubtotal.setAttribute('class', 'movil c6');
									objCeldaSubtotal.innerHTML = intSubtotal;
									objCeldaIvaUnitario.setAttribute('class', 'movil c7');
									objCeldaIvaUnitario.innerHTML = intImporteIva;
									objCeldaIepsUnitario.setAttribute('class', 'movil c8');
									objCeldaIepsUnitario.innerHTML = intImporteIeps
									objCeldaTotal.setAttribute('class', 'movil c9');
									objCeldaTotal.innerHTML = intTotal;
									objCeldaAcciones.setAttribute('class', 'td-center movil c10');
									objCeldaAcciones.innerHTML = strAccionesTablaDetalles;
									objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
									objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento; 
									objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
									objCeldaPorcentajeIva.innerHTML = data.row[intCon].porcentaje_iva; 
									objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
									objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
									objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
									objCeldaTipoReferencia.innerHTML = strTipoReferenciaDet;
									objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
									objCeldaTipoCambio.innerHTML = intTipoCambioRefaccion;
									objCeldaPrecioRefaccion.setAttribute('class', 'no-mostrar');
									objCeldaPrecioRefaccion.innerHTML = intPrecioRefaccion;
									objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
									objCeldaTasaCuotaIva.innerHTML =  intTasaCuotaIva;
									objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
									objCeldaTasaCuotaIeps.innerHTML = intTasaCuotaIeps;
								}
								else
								{

									objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = intCantidad;
									objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML = intPrecioUnitario;
									objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML =  intDescuentoUnitario;
									objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML =  intSubtotal;
									objTabla.rows.namedItem(intRefaccionID).cells[6].innerHTML = intImporteIva;
									objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML = intImporteIeps;
									objTabla.rows.namedItem(intRefaccionID).cells[8].innerHTML = intTotal;
									objTabla.rows.namedItem(intRefaccionID).cells[9].innerHTML = strAccionesTablaDetalles;
									objTabla.rows.namedItem(intRefaccionID).cells[10].innerHTML = intPorcentajeDescuento;
									objTabla.rows.namedItem(intRefaccionID).cells[11].innerHTML = data.row[intCon].porcentaje_iva; 
									objTabla.rows.namedItem(intRefaccionID).cells[12].innerHTML = intPorcentajeIeps;
									objTabla.rows.namedItem(intRefaccionID).cells[13].innerHTML = strTipoReferenciaDet;
									objTabla.rows.namedItem(intRefaccionID).cells[16].innerHTML = intTasaCuotaIva;
									objTabla.rows.namedItem(intRefaccionID).cells[17].innerHTML = intTasaCuotaIeps;
									
								}
							}
							else
							{
								
								//Agregar refacción en el array, de esta manera, el usuario identificara las refacciones incorrectas
							     arrDetallesIncorrectos.push(strReferencia);
							}

						}	
			       		

			       		//Si existen refacciones incorrectas
						if(arrDetallesIncorrectos.length > 0)
						{
							//Mensaje que se utiliza para informar al usuario la lista de refacciones incorrectas
							var strMensaje = 'No es posible agregar las siguientes <b>refacciones</b> porque no tienen precio unitario (0.00):<br>';

							//Hacer recorrido para obtener refacciones incorrectas
							for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
							{
								//Agregar refacción en el mensaje
			            		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
							}

							//Hacer un llamado a la función para mostrar mensaje de error
							mensaje_cotizaciones_servicio_servicio('error', strMensaje);

						}
						

			       		//Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_refacciones_cotizaciones_servicio_servicio();
						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $('#dg_refacciones_cotizaciones_servicio_servicio tr').length - 2;
						$('#numElementos_refacciones_cotizaciones_servicio_servicio').html(intFilas);
						$('#txtNumDetalles_refacciones_cotizaciones_servicio_servicio').val(intFilas);

			       	 },
			       'json');
		}


		//Función para agregar renglón a la tabla
		function agregar_renglon_refacciones_cotizaciones_servicio_servicio()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla cotizaciones_refacciones_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asignar el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;
			//Variable que se utiliza para agregar detalle en la tabla
			var strAgregar = 'NO';

			 //Variable que se utiliza para asignar el tipo de cambio de la cotización
		    var intTipoCambioCotizacion = parseFloat($('#txtTipoCambio_cotizaciones_servicio_servicio').val());
		    //Variable que se utiliza para asignar el tipo de cambio de la cotización
		    var intMonedaIDCotizacion =  parseFloat($('#cmbMonedaID_cotizaciones_servicio_servicio').val());
			//Obtenemos los datos de las cajas de texto
			var intReferenciaID = $('#txtReferenciaID_refacciones_cotizaciones_servicio_servicio').val();
			var strReferencia = $('#txtReferencia_refacciones_cotizaciones_servicio_servicio').val();
			var strTipoReferencia = $('#txtTipoReferencia_refacciones_cotizaciones_servicio_servicio').val();
			var strCodigo = $('#txtCodigo_refacciones_cotizaciones_servicio_servicio').val();
			var strDescripcion = $('#txtDescripcion_refacciones_cotizaciones_servicio_servicio').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').val();
			var intCantidad = $('#txtCantidad_refacciones_cotizaciones_servicio_servicio').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_refacciones_cotizaciones_servicio_servicio').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_refacciones_cotizaciones_servicio_servicio').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_refacciones_cotizaciones_servicio_servicio').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_refacciones_cotizaciones_servicio_servicio').val();
			var intTipoCambio = $('#txtTipoCambio_refacciones_cotizaciones_servicio_servicio').val();
			var intPrecioRefaccion = $('#txtPrecioRefaccion_refacciones_cotizaciones_servicio_servicio').val();
	

			//Variable que se utiliza para asignar el mensaje informativo
		    var strMensaje = 'No es posible agregar la refacción porque'; 

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_refacciones_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

			//Dependiendo del tipo de referencia validar los campos obligatorios
			if($('#txtTipoReferencia_refacciones_cotizaciones_servicio_servicio').val() == 'REFACCION')
			{
				//Validamos que se capturaron datos
				if (intReferenciaID == '' || strReferencia == '')
				{
					//Enfocar caja de texto
					$('#txtReferencia_refacciones_cotizaciones_servicio_servicio').focus();
				}
				else if (intCantidad == '' ||  intCantidad <= 0)
				{
					//Enfocar caja de texto
					$('#txtCantidad_refacciones_cotizaciones_servicio_servicio').val('');
					$('#txtCantidad_refacciones_cotizaciones_servicio_servicio').focus();
				}
				else if (intPrecioUnitario == '' || intPrecioUnitario <= 0)
				{
					//Concatenar mensaje de validación
					strMensaje += ' no tiene un precio establecido.';

					//Hacer un llamado a la función para mostrar mensaje de información
                	mensaje_cotizaciones_servicio_servicio('informacion_refacciones', strMensaje);
				}
				else if (intPorcentajeDescuento == '')
				{
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').focus();
				}
				else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
				{
					//Limpiar caja de texto
					$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').focus();
				}
				else if (intPorcentajeIva == '')
				{
					//Enfocar caja de texto
					$('#txtPorcentajeIva_refacciones_cotizaciones_servicio_servicio').focus();
				}
				else if((intTasaCuotaIeps == '' && intPorcentajeIeps != '') || 
					    (parseFloat($.reemplazar(intPorcentajeIeps, ",", "")) > 100))
				{
					//Limpiar caja de texto
					$('#txtPorcentajeIeps_refacciones_cotizaciones_servicio_servicio').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeIeps_refacciones_cotizaciones_servicio_servicio').focus();
				}
				else
				{	
					//Asignar SI para agregar el detalle
					strAgregar = 'SI';
				}
			}
			else
			{
				//Validamos que se capturaron datos
				if (intReferenciaID == '' || strReferencia == '')
				{
					//Enfocar caja de texto
					$('#txtReferencia_refacciones_cotizaciones_servicio_servicio').focus();
				}
				else if (intPorcentajeDescuento == '')
				{
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').focus();
				}
				else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
				{
					//Limpiar caja de texto
					$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').focus();
				}
				else
				{
					//Asignar SI para agregar el detalle
					strAgregar = 'SI';
				}


			}

			//Si se cumplen las reglas de validación
			if(strAgregar == 'SI')
			{
				
			    //Convertir cadena de texto a número decimal
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
				intSubtotal =  intPrecioUnitario;

			    //Si el tipo de referencia no corresponde a una refacción
				if(strTipoReferencia != 'REFACCION')
				{
					//Hacer un llamado a la función para inicializar elementos del detalle
					inicializar_detalle_refacciones_cotizaciones_servicio_servicio();
					//Hacer un llamado a la función para obtener las refacciones de la referencia
					lista_refacciones_referencia_refacciones_cotizaciones_servicio_servicio(intPorcentajeDescuento, intReferenciaID, strTipoReferencia, intCantidad);
				}
				else
				{
					

					//Si existe porcentaje de descuento
					if(intPorcentajeDescuento > 0)
					{
						//Calcular descuento unitario
						intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;
						//Redondear cantidad a decimales
						intDescuentoUnitario = intDescuentoUnitario.toFixed(2);
						//Decrementar descuento unitario
						intSubtotal = intSubtotal - intDescuentoUnitario;
						//Redondear cantidad a decimales
						intSubtotal = intSubtotal.toFixed(2);
						intSubtotal = parseFloat(intSubtotal);
					}


					//Si el precio es mayor que cero
					if(intSubtotal > 0)
					{
						//Hacer un llamado a la función para inicializar elementos del detalle
						inicializar_detalle_refacciones_cotizaciones_servicio_servicio();

						//Calcular subtotal
						intSubtotal = intCantidad * intSubtotal;
						//Redondear cantidad a decimales
						intSubtotal = intSubtotal.toFixed(2);
						intSubtotal = parseFloat(intSubtotal);

					
						//Calcular importe de IVA
						intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
					    //Redondear cantidad a  decimales
					    intImporteIva = intImporteIva.toFixed(4);
					    intImporteIva = parseFloat(intImporteIva);

						//Si existe porcentaje de IEPS
						if(intPorcentajeIeps != '')
						{
							//Calcular importe de IEPS
							intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
							//Redondear cantidad a decimales
					   	 	intImporteIeps = intImporteIeps.toFixed(4);
					   	 	intImporteIeps = parseFloat(intImporteIeps);
						}
						

						//Calcular importe total
						intTotal = intSubtotal + intImporteIva + intImporteIeps;

						//Cambiar cantidad a  formato moneda (a visualizar)
						intCantidad =  formatMoney(intCantidad, 2, '');
						intPrecioUnitario = formatMoney(intPrecioUnitario, 2, '');
						intDescuentoUnitario = formatMoney(intDescuentoUnitario, 2, '');
						intSubtotal = formatMoney(intSubtotal, 2, '');
						intImporteIva = formatMoney(intImporteIva, 4, '');
						intImporteIeps = formatMoney(intImporteIeps, 4, '');
						intTotal = formatMoney(intTotal, 2, '');
						intPorcentajeDescuento = formatMoney(intPorcentajeDescuento, 2, ''); 

						//Revisamos si existe el ID proporcionado, si es así, editamos los datos
						if (objTabla.rows.namedItem(intReferenciaID))
						{	
							
							objTabla.rows.namedItem(intReferenciaID).cells[2].innerHTML = intCantidad;
							objTabla.rows.namedItem(intReferenciaID).cells[3].innerHTML = intPrecioUnitario;
							objTabla.rows.namedItem(intReferenciaID).cells[4].innerHTML =  intDescuentoUnitario;
							objTabla.rows.namedItem(intReferenciaID).cells[5].innerHTML =  intSubtotal;
							objTabla.rows.namedItem(intReferenciaID).cells[6].innerHTML =  intImporteIva;
							objTabla.rows.namedItem(intReferenciaID).cells[7].innerHTML = intImporteIeps;
							objTabla.rows.namedItem(intReferenciaID).cells[8].innerHTML = intTotal;
							objTabla.rows.namedItem(intReferenciaID).cells[10].innerHTML = intPorcentajeDescuento;
							objTabla.rows.namedItem(intReferenciaID).cells[11].innerHTML = intPorcentajeIva;
							objTabla.rows.namedItem(intReferenciaID).cells[12].innerHTML = intPorcentajeIeps;
							objTabla.rows.namedItem(intReferenciaID).cells[15].innerHTML = intPrecioRefaccion;
							objTabla.rows.namedItem(intReferenciaID).cells[16].innerHTML = intTasaCuotaIva;
							objTabla.rows.namedItem(intReferenciaID).cells[17].innerHTML = intTasaCuotaIeps;
							
							
						}
						else
						{
							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcion = objRenglon.insertCell(1);
							var objCeldaCantidad = objRenglon.insertCell(2);
							var objCeldaPrecioUnitario = objRenglon.insertCell(3);
							var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
							var objCeldaSubtotal = objRenglon.insertCell(5);
							var objCeldaIvaUnitario = objRenglon.insertCell(6);
							var objCeldaIepsUnitario = objRenglon.insertCell(7);
							var objCeldaTotal = objRenglon.insertCell(8);
							var objCeldaAcciones = objRenglon.insertCell(9);
							//Columnas ocultas
							var objCeldaPorcentajeDescuento = objRenglon.insertCell(10);
							var objCeldaPorcentajeIva = objRenglon.insertCell(11);
							var objCeldaPorcentajeIeps = objRenglon.insertCell(12);
							var objCeldaTipoReferencia = objRenglon.insertCell(13);
							var objCeldaTipoCambio = objRenglon.insertCell(14);
							var objCeldaPrecioRefaccion = objRenglon.insertCell(15);
							var objCeldaTasaCuotaIva = objRenglon.insertCell(16);
							var objCeldaTasaCuotaIeps = objRenglon.insertCell(17);

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', intReferenciaID);
							objCeldaCodigo.setAttribute('class', 'movil c1');
							objCeldaCodigo.innerHTML = strCodigo;
							objCeldaDescripcion.setAttribute('class', 'movil c2');
							objCeldaDescripcion.innerHTML = strDescripcion;
							objCeldaCantidad.setAttribute('class', 'movil c3');
							objCeldaCantidad.innerHTML = intCantidad;
							objCeldaPrecioUnitario.setAttribute('class', 'movil c4');
							objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
							objCeldaDescuentoUnitario.setAttribute('class', 'movil c5');
							objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
							objCeldaSubtotal.setAttribute('class', 'movil c6');
							objCeldaSubtotal.innerHTML = intSubtotal;
							objCeldaIvaUnitario.setAttribute('class', 'movil c7');
							objCeldaIvaUnitario.innerHTML = intImporteIva;
							objCeldaIepsUnitario.setAttribute('class', 'movil c8');
							objCeldaIepsUnitario.innerHTML = intImporteIeps;
							objCeldaTotal.setAttribute('class', 'movil c9');
							objCeldaTotal.innerHTML = intTotal;
							objCeldaAcciones.setAttribute('class', 'td-center movil c10');
							objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
														 " onclick='editar_renglon_refacciones_cotizaciones_servicio_servicio(this)'>" + 
														 "<span class='glyphicon glyphicon-edit'></span></button>" + 
														 "<button class='btn btn-default btn-xs' title='Eliminar'" +
														 " onclick='eliminar_renglon_refacciones_cotizaciones_servicio_servicio(this)'>" + 
														 "<span class='glyphicon glyphicon-trash'></span></button>" + 
														 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
														 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
														 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
														 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
							objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento; 
							objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeIva.innerHTML = intPorcentajeIva; 
							objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
							objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
							objCeldaTipoReferencia.innerHTML = strTipoReferencia;
							objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
							objCeldaTipoCambio.innerHTML = intTipoCambio;
							objCeldaPrecioRefaccion.setAttribute('class', 'no-mostrar');
							objCeldaPrecioRefaccion.innerHTML = intPrecioRefaccion;
							objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
							objCeldaTasaCuotaIva.innerHTML = intTasaCuotaIva;
							objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
							objCeldaTasaCuotaIeps.innerHTML =  intTasaCuotaIeps;

						}

						//Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_refacciones_cotizaciones_servicio_servicio();
						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $('#dg_refacciones_cotizaciones_servicio_servicio tr').length - 2;
						$('#numElementos_refacciones_cotizaciones_servicio_servicio').html(intFilas);
						$('#txtNumDetalles_refacciones_cotizaciones_servicio_servicio').val(intFilas);

						//Enfocar caja de texto
						$('#txtReferencia_refacciones_cotizaciones_servicio_servicio').focus();
					}
					else
					{	
						
						//Concatenar mensaje de validación
					    strMensaje +=' el precio unitario (menos el descuento) no puede ser 0.00';

						
		                //Hacer un llamado a la función para mostrar mensaje de información
		                mensaje_cotizaciones_servicio_servicio('informacion_refacciones', strMensaje);
		                
						
					}
					
				}

				
			}
		
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_refacciones_cotizaciones_servicio_servicio(objRenglon)
		{
			//Variables que se utilizan para concatenar los datos de la referencia
			var strCodigo = objRenglon.parentNode.parentNode.cells[0].innerHTML;
			var strDescripcion = objRenglon.parentNode.parentNode.cells[1].innerHTML;
			var strReferencia = strCodigo+' - '+strDescripcion;
			var strTipoReferencia = objRenglon.parentNode.parentNode.cells[13].innerHTML;

			//Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	        inicializar_refaccion_refacciones_cotizaciones_servicio_servicio(strTipoReferencia);
			//Asignar los valores a las cajas de texto
			$('#txtReferenciaID_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.getAttribute("id"));

			$('#txtReferencia_refacciones_cotizaciones_servicio_servicio').val(strReferencia);
			$('#txtCodigo_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidad_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIva_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtPorcentajeIeps_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtTipoReferencia_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtTipoCambio_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtPrecioRefaccion_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[15].innerHTML);
			$('#txtTasaCuotaIva_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtTasaCuotaIeps_refacciones_cotizaciones_servicio_servicio').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);
			
			//Enfocar caja de texto
			$('#txtReferencia_refacciones_cotizaciones_servicio_servicio').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_refacciones_cotizaciones_servicio_servicio(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_refacciones_cotizaciones_servicio_servicio").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_refacciones_cotizaciones_servicio_servicio();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $('#dg_refacciones_cotizaciones_servicio_servicio tr').length - 2;
			$('#numElementos_refacciones_cotizaciones_servicio_servicio').html(intFilas);
			$('#txtNumDetalles_refacciones_cotizaciones_servicio_servicio').val(intFilas);

			//Enfocar caja de texto
			$('#txtReferencia_refacciones_cotizaciones_servicio_servicio').focus();
		}

		//Función para recalcular los importes de los detalles de la tabla 
		function recalcular_importes_refacciones_cotizaciones_servicio_servicio()
		{
			//Variable que se utiliza para asignar el tipo de cambio de la cotización
			var intTipoCambioCotizacion = parseFloat($('#txtTipoCambio_cotizaciones_servicio_servicio').val());
			//Variable que se utiliza para asignar el tipo de cambio de la refacción
			var intMonedaIDCotizacion =  parseFloat($('#cmbMonedaID_cotizaciones_servicio_servicio').val());

			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_refacciones_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

			//Verificamos que al menos exista un detalle agregado en el GRID de detalles
			if(objTabla.rows.length > 0){

				//Recorrer los renglones de la tabla para obtener los valores
				for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
				{
					//Variables que se utilizan para asignar valores del detalle
					var intSubtotal = 0;
					var intPrecioUnitario = 0;
					var intRefaccionID =  objRen.getAttribute('id');
					var intCantidad =  parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
					var intPorcentajeDescuento = parseFloat(objRen.cells[10].innerHTML);
					var intPorcentajeIva = parseFloat(objRen.cells[11].innerHTML);
					var intPorcentajeIeps = parseFloat(objRen.cells[12].innerHTML);
					var intTipoCambioRefaccion = parseFloat(objRen.cells[14].innerHTML);
					var intPrecioRefaccion = parseFloat(objRen.cells[15].innerHTML);
					//Variable que se utiliza para asignar el descuento unitario
					var intDescuentoUnitario = 0;
					//Variable que se utiliza para asignar el importe de iva
					var intImporteIva = 0;
					//Variable que se utiliza para asignar el importe de ieps
					var intImporteIeps = 0;
					//Variable que se utiliza para asignar el importe total
					var intTotal = 0;
							

					//Si existe precio de la refacción
				    if(intPrecioRefaccion > 0 && intTipoCambioRefaccion > 0)
				    {
			   	  	    //Convertir importe a peso mexicano
				      	intPrecioUnitario = intPrecioRefaccion * intTipoCambioRefaccion;

				       	//Si la moneda de la refacción no corresponde a peso mexicano
				        if(intMonedaIDCotizacion !== intMonedaBaseIDCotizacionesServicioServicio)
				        {
				       		//Convertir peso mexicano a tipo de cambio
				       		intPrecioUnitario = intPrecioUnitario / intTipoCambioCotizacion;
				       		//Redondear cantidad a x decimales
				    		intPrecioUnitario = intPrecioUnitario.toFixed(2);
				    		intPrecioUnitario = parseFloat(intPrecioUnitario);
				        }
				    }

				    //Asignar el precio unitario
				    intSubtotal = intPrecioUnitario;

					//Si existe porcentaje de descuento
					if(intPorcentajeDescuento > 0)
					{
						//Calcular descuento unitario
						intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;
						//Redondear cantidad a decimales
					    intDescuentoUnitario = intDescuentoUnitario.toFixed(2);

					    //Decrementar descuento unitario
						intSubtotal = intSubtotal - intDescuentoUnitario;
					}
					

					//Calcular subtotal
					intSubtotal = intCantidad * intSubtotal;
					//Redondear cantidad a decimales
					intSubtotal = intSubtotal.toFixed(2);
					intSubtotal = parseFloat(intSubtotal);

					//Si existe porcentaje de IVA
					if(intPorcentajeIva > 0)
					{
						//Calcular importe de IVA
						intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
						//Redondear cantidad a  decimales
					    intImporteIva = intImporteIva.toFixed(4);
					    intImporteIva = parseFloat(intImporteIva);
					}
					
					//Si existe porcentaje de IEPS
					if(intPorcentajeIeps > 0)
					{
						//Calcular importe de IEPS
						intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
						//Redondear cantidad a decimales
				   	 	intImporteIeps = intImporteIeps.toFixed(4);
				   	 	intImporteIeps = parseFloat(intImporteIeps);
					}
					
					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

					//Cambiar cantidad a  formato moneda (a visualizar)
					intCantidad =  formatMoney(intCantidad, 2, '');
					intPrecioUnitario = formatMoney(intPrecioUnitario, 2, '');
					intDescuentoUnitario = formatMoney(intDescuentoUnitario, 2, '');
					intSubtotal = formatMoney(intSubtotal, 2, '');
					intImporteIva = formatMoney(intImporteIva, 4, '');
					intImporteIeps = formatMoney(intImporteIeps, 4, '');
					intTotal = formatMoney(intTotal, 2, '');

					//Revisamos si existe el ID proporcionado, si es así, editamos los datos
					objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = intCantidad;
					objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML =  intPrecioUnitario;
					objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML =  intDescuentoUnitario;
					objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML =  intSubtotal;
					objTabla.rows.namedItem(intRefaccionID).cells[6].innerHTML = intImporteIva;
					objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML = intImporteIeps;
					objTabla.rows.namedItem(intRefaccionID).cells[8].innerHTML = intTotal;
				}

				//Hacer un llamado a la función para calcular totales de la tabla
			    calcular_totales_refacciones_cotizaciones_servicio_servicio();

			}

			
		}

		//Función para calcular totales de la tabla
		function calcular_totales_refacciones_cotizaciones_servicio_servicio()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_refacciones_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[8].innerHTML, ",", ""));

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, 2, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 2, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, 4, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, 4, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 2, '');

			//Asignar los valores
			$('#acumCantidad_refacciones_cotizaciones_servicio_servicio').html(intAcumUnidades);
			$('#acumDescuento_refacciones_cotizaciones_servicio_servicio').html(intAcumDescuento);
			$('#acumSubtotal_refacciones_cotizaciones_servicio_servicio').html(intAcumSubtotal);
			$('#acumIva_refacciones_cotizaciones_servicio_servicio').html(intAcumIva);
			$('#acumIeps_refacciones_cotizaciones_servicio_servicio').html(intAcumIeps);
			$('#acumTotal_refacciones_cotizaciones_servicio_servicio').html(intAcumTotal);
		}

		//Función para calcular el precio unitario del detalle
		function calcular_precio_unitario_refacciones_cotizaciones_servicio_servicio()
		{
		   //Variable que se utiliza para asignar el tipo de cambio de la cotización
		   var intTipoCambioCotizacion = parseFloat($('#txtTipoCambio_cotizaciones_servicio_servicio').val());
		   //Variable que se utiliza para asignar el tipo de cambio de la cotización
		   var intMonedaIDCotizacion =  parseFloat($('#cmbMonedaID_cotizaciones_servicio_servicio').val());
		   //Variable que se utiliza para asignar el tipo de cambio de la refacción
		   var intTipoCambioRefaccion = parseFloat($.reemplazar($('#txtTipoCambio_refacciones_cotizaciones_servicio_servicio').val(), ",", ""));
		   //Variable que se utiliza para asignar el precio de la refacción
		   var intPrecioRefaccion = parseFloat($.reemplazar($('#txtPrecioRefaccion_refacciones_cotizaciones_servicio_servicio').val(), ",", ""));
		   //Variable que se utiliza para asignar el precio unitario
		   var intPrecioUnitario = 0;

		   //Si existe precio de la refacción
		   if(intPrecioRefaccion > 0 && intTipoCambioRefaccion > 0)
		   {
	   	  	    //Convertir importe a peso mexicano
		      	intPrecioUnitario = intPrecioRefaccion * intTipoCambioRefaccion;

		       	//Si la moneda de la refacción no corresponde a peso mexicano
		        if(intMonedaIDCotizacion !== intMonedaBaseIDCotizacionesServicioServicio)
		        {
		       		//Si existe tipo de cambio de la cotización
		        	if(intTipoCambioCotizacion > 0)
		        	{

		        		//Convertir peso mexicano a tipo de cambio
		       			intPrecioUnitario = intPrecioUnitario / intTipoCambioCotizacion;
		        	}
		        	else
		        	{
		        		intPrecioUnitario = 0;
		        	}
		       		
		        }

		        //Cambiar el precio unitario del detalle
		   		$('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').val(intPrecioUnitario);
       	    	//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
           		$('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').formatCurrency({ roundToDecimalPlace: 2 });
		   }
		 	   
		}


		/*******************************************************************************************************************
		Funciones del Tab - Trabajos Foráneos
		*********************************************************************************************************************/
		//Función para inicializar elementos del detalle
		function inicializar_detalle_trabajos_foraneos_cotizaciones_servicio_servicio()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
			$('#txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
			$('#txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
		    $('#txtPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
		    $('#txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').val('0.00');
		    $('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
		    $('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
		    $('#txtTasaCuotaIva_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
		    $('#txtTasaCuotaIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_trabajos_foraneos_cotizaciones_servicio_servicio()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla cotizaciones_servicio_trabajos_foraneos)
			var intSubtotal = 0;
			//Variable que se utiliza para asignar el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_trabajos_foraneos_cotizaciones_servicio_servicio').val();
			var strConcepto = $('#txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio').val();
			var intCantidad = $('#txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_trabajos_foraneos_cotizaciones_servicio_servicio').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_trabajos_foraneos_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];


			//Validamos que se capturaron datos
			if (strConcepto == '')
			{
				//Enfocar caja de texto
				$('#txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			}
			else if (intCantidad == '' || intCantidad <= 0)
			{
				//Enfocar caja de texto
				$('#txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
				$('#txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			}
			else if (intPrecioUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			}
			else if (intPorcentajeIva == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			}
			else if(intTasaCuotaIeps == '' && intPorcentajeIeps != '')
			{
				//Limpiar caja de texto
				$('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			}
			else
			{

				//Crear instancia del objeto Detalle del Trabajo Foráneo de la cotización
				objDetalleTFCotizacionCotizacionesServicioServicio = new DetalleTFCotizacionCotizacionesServicioServicio('', '', '',
																													     '', '', 
																													     '', '', 
																								            			 '', '');

				

				//Hacer un llamado a la función para inicializar elementos del detalle
				inicializar_detalle_trabajos_foraneos_cotizaciones_servicio_servicio();

				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strConcepto = strConcepto.toUpperCase();

				//Convertir cadena de texto a número decimal
				intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intSubtotal = intPrecioUnitario;

				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					//Calcular descuento unitario
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;

					//Redondear cantidad a decimales
					intDescuentoUnitario = intDescuentoUnitario.toFixed(2);

					//Decrementar descuento unitario
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}

				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;
				//Redondear cantidad a decimales
				intSubtotal = intSubtotal.toFixed(2);
				intSubtotal = parseFloat(intSubtotal);

				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

				//Redondear cantidad a dos decimales
			    intImporteIva = intImporteIva.toFixed(4);
			    intImporteIva = parseFloat(intImporteIva);


				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
					//Redondear cantidad a dos decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(4);
			   	 	intImporteIeps = parseFloat(intImporteIeps);

				}


				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Cambiar cantidad a  formato moneda (a visualizar)
				intCantidad =  formatMoney(intCantidad, 2, '');
			    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
			    intDescuentoUnitario =  formatMoney(intDescuentoUnitario, 2, '');
			    intImporteIva  =  formatMoney(intImporteIva, 4, '');
			    intImporteIeps  =  formatMoney(intImporteIeps, 4, '');
			    intSubtotal  =  formatMoney(intSubtotal, 2, '');
			    intTotal  =  formatMoney(intTotal, 2, '');

				//Asignar valores al objeto
				objDetalleTFCotizacionCotizacionesServicioServicio.strConcepto = strConcepto;
				objDetalleTFCotizacionCotizacionesServicioServicio.intCantidad = intCantidad;
				objDetalleTFCotizacionCotizacionesServicioServicio.intPrecioUnitario = intPrecioUnitario;
				objDetalleTFCotizacionCotizacionesServicioServicio.intPorcentajeDescuento = intPorcentajeDescuento;
				objDetalleTFCotizacionCotizacionesServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
				objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIva = intTasaCuotaIva;
				objDetalleTFCotizacionCotizacionesServicioServicio.intPorcentajeIva = intPorcentajeIva;
				objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIeps = intTasaCuotaIeps;
				objDetalleTFCotizacionCotizacionesServicioServicio.intPorcentajeIeps = intPorcentajeIeps;

				//Revisamos si existe el renglón, si es así, editamos los datos del detalle
				if (intRenglon)
				{
					//Modificar los datos del detalle (trabajo foráneo) corespondiente al indice
	        		objTFCotizacionCotizacionesServicioServicio.modificarDetalle(intRenglon, objDetalleTFCotizacionCotizacionesServicioServicio);

	        		//Incrementar renglón para obtener la posición del detalle en la tabla
					intRenglon++;

					//Seleccionar el renglón de la tabla para actualizar los datos del detalle
					var selectedRow = document.getElementById("dg_trabajos_foraneos_cotizaciones_servicio_servicio").rows[intRenglon].cells;

					selectedRow[0].innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.strConcepto;
					selectedRow[1].innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intCantidad;
					selectedRow[2].innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intPrecioUnitario;
					selectedRow[3].innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intDescuentoUnitario;
					selectedRow[4].innerHTML = intSubtotal;
					selectedRow[5].innerHTML = intImporteIva;
					selectedRow[6].innerHTML = intImporteIeps;
					selectedRow[7].innerHTML = intTotal;
					selectedRow[9].innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIva;
					selectedRow[10].innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIeps;
				}
				else
				{
					//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
					intRenglon = $("#dg_trabajos_foraneos_cotizaciones_servicio_servicio tr").length - 2;
					//Incrementar 1 para el siguiente renglón
					intRenglon++;

					//Agregar datos del detalle (trabajo foráneo) de la cotización
           			objTFCotizacionCotizacionesServicioServicio.setDetalle(objDetalleTFCotizacionCotizacionesServicioServicio);

           			//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaConcepto = objRenglon.insertCell(0);
					var objCeldaCantidad = objRenglon.insertCell(1);
					var objCeldaPrecioUnitario = objRenglon.insertCell(2);
					var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
					var objCeldaSubtotal = objRenglon.insertCell(4);
					var objCeldaIva = objRenglon.insertCell(5);
					var objCeldaIeps = objRenglon.insertCell(6);
					var objCeldaTotal = objRenglon.insertCell(7);
					var objCeldaAcciones = objRenglon.insertCell(8);
					//Columnas ocultas
					var objCeldaTasaCuotaIva = objRenglon.insertCell(9);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(10);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRenglon);
					objCeldaConcepto.setAttribute('class', 'movil d1');
					objCeldaConcepto.innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.strConcepto;
					objCeldaCantidad.setAttribute('class', 'movil d2');
					objCeldaCantidad.innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intCantidad;
					objCeldaPrecioUnitario.setAttribute('class', 'movil d3');
					objCeldaPrecioUnitario.innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intPrecioUnitario;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil d4');
					objCeldaDescuentoUnitario.innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intDescuentoUnitario;
					objCeldaSubtotal.setAttribute('class', 'movil d5');
					objCeldaSubtotal.innerHTML = intSubtotal;
					objCeldaIva.setAttribute('class', 'movil d6');
					objCeldaIva.innerHTML = intImporteIva;
					objCeldaIeps.setAttribute('class', 'movil d7');
					objCeldaIeps.innerHTML = intImporteIeps;
					objCeldaTotal.setAttribute('class', 'movil d8');
					objCeldaTotal.innerHTML = intTotal;
					objCeldaAcciones.setAttribute('class', 'td-center movil d9');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_trabajos_foraneos_cotizaciones_servicio_servicio(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_trabajos_foraneos_cotizaciones_servicio_servicio(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIva.innerHTML = objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIva;
					objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIeps.innerHTML =  objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIeps;

				}


				//Hacer un llamado a la función para calcular totales de la tabla otros servicios
				calcular_totales_trabajos_foraneos_cotizaciones_servicio_servicio();

				//Enfocar caja de texto
				$('#txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_trabajos_foraneos_cotizaciones_servicio_servicio tr").length - 2;
			$('#numElementos_trabajos_foraneos_cotizaciones_servicio_servicio').html(intFilas);
			$('#txtNumDetalles_trabajos_foraneos_cotizaciones_servicio_servicio').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_trabajos_foraneos_cotizaciones_servicio_servicio(objRenglon)
		{

			//Decrementar indice para obtener la posición del detalle en el arreglo
		    var intRenglon =  parseInt(objRenglon.parentNode.parentNode.rowIndex) - 1;


		    //Crear instancia del objeto trabajo foráneo de la cotización
        	objDetalleTFCotizacionCotizacionesServicioServicio = new DetalleTFCotizacionCotizacionesServicioServicio ();

        	//Asignar datos del detalle (trabajo foráneo) corespondiente al indice
        	objDetalleTFCotizacionCotizacionesServicioServicio = objTFCotizacionCotizacionesServicioServicio.getDetalle(intRenglon);
			
			//Asignar los valores a las cajas de texto
			$('#txtRenglon_trabajos_foraneos_cotizaciones_servicio_servicio').val(intRenglon);
			$('#txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio').val(objDetalleTFCotizacionCotizacionesServicioServicio.strConcepto);
			$('#txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').val(objDetalleTFCotizacionCotizacionesServicioServicio.intCantidad);
			$('#txtPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio').val(objDetalleTFCotizacionCotizacionesServicioServicio.intPrecioUnitario);
			$('#txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').val(objDetalleTFCotizacionCotizacionesServicioServicio.intPorcentajeDescuento);
			$('#txtTasaCuotaIva_trabajos_foraneos_cotizaciones_servicio_servicio').val(objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIva);
			$('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').val(objDetalleTFCotizacionCotizacionesServicioServicio.intPorcentajeIva);
			$('#txtTasaCuotaIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val(objDetalleTFCotizacionCotizacionesServicioServicio.intTasaCuotaIeps);
			$('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val(objDetalleTFCotizacionCotizacionesServicioServicio.intPorcentajeIeps);

			//Enfocar caja de texto
			$('#txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_trabajos_foraneos_cotizaciones_servicio_servicio(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			//Eliminar del objeto el detalle (trabajo foráneo) seleccionado
			objTFCotizacionCotizacionesServicioServicio.eliminarDetalle(intRenglon - 1);

			//Eliminar el renglón indicado
			document.getElementById("dg_trabajos_foraneos_cotizaciones_servicio_servicio").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla otros servicios
			calcular_totales_trabajos_foraneos_cotizaciones_servicio_servicio();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_trabajos_foraneos_cotizaciones_servicio_servicio tr").length - 2;
			$('#numElementos_trabajos_foraneos_cotizaciones_servicio_servicio').html(intFilas);
			$('#txtNumDetalles_trabajos_foraneos_cotizaciones_servicio_servicio').val(intFilas);

			//Enfocar caja de texto
			$('#txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio').focus();

		}

		//Función para calcular totales de la tabla
		function calcular_totales_trabajos_foraneos_cotizaciones_servicio_servicio()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_trabajos_foraneos_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, 2, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 2, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, 4, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, 4, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 2, '');

			//Asignar los valores
			$('#acumCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').html(intAcumUnidades);
			$('#acumDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').html(intAcumDescuento);
			$('#acumSubtotal_trabajos_foraneos_cotizaciones_servicio_servicio').html(intAcumSubtotal);
			$('#acumIva_trabajos_foraneos_cotizaciones_servicio_servicio').html(intAcumIva);
			$('#acumIeps_trabajos_foraneos_cotizaciones_servicio_servicio').html(intAcumIeps);
			$('#acumTotal_trabajos_foraneos_cotizaciones_servicio_servicio').html(intAcumTotal);
		}


		/*******************************************************************************************************************
		Funciones del Tab - Otros
		*********************************************************************************************************************/
		//Función para inicializar elementos del detalle
		function inicializar_detalle_otros_cotizaciones_servicio_servicio()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_otros_cotizaciones_servicio_servicio').val('');
			$('#txtConcepto_otros_cotizaciones_servicio_servicio').val('');
			$('#txtCantidad_otros_cotizaciones_servicio_servicio').val('');
		    $('#txtPrecioUnitario_otros_cotizaciones_servicio_servicio').val('');
		    $('#txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio').val('0.00');
		    $('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').val('');
		    $('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').val('');
		    $('#txtTasaCuotaIva_otros_cotizaciones_servicio_servicio').val('');
		    $('#txtTasaCuotaIeps_otros_cotizaciones_servicio_servicio').val('');
		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_otros_cotizaciones_servicio_servicio()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla cotizaciones_servicio_otros)
			var intSubtotal = 0;
			//Variable que se utiliza para asignar el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_otros_cotizaciones_servicio_servicio').val();
			var strConcepto = $('#txtConcepto_otros_cotizaciones_servicio_servicio').val();
			var intCantidad = $('#txtCantidad_otros_cotizaciones_servicio_servicio').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_otros_cotizaciones_servicio_servicio').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_otros_cotizaciones_servicio_servicio').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_otros_cotizaciones_servicio_servicio').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_otros_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];


			//Validamos que se capturaron datos
			if (strConcepto == '')
			{
				//Enfocar caja de texto
				$('#txtConcepto_otros_cotizaciones_servicio_servicio').focus();
			}
			else if (intCantidad == '' || intCantidad <= 0)
			{
				//Enfocar caja de texto
				$('#txtCantidad_otros_cotizaciones_servicio_servicio').val('');
				$('#txtCantidad_otros_cotizaciones_servicio_servicio').focus();
			}
			else if (intPrecioUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_otros_cotizaciones_servicio_servicio').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio').focus();
			}
			else if (intPorcentajeIva == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').focus();
			}
			else if(intTasaCuotaIeps == '' && intPorcentajeIeps != '')
			{
				//Limpiar caja de texto
				$('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').focus();
			}
			else
			{

				//Crear instancia del objeto Otro servicio de la cotización
				objOtroCotizacionCotizacionesServicioServicio = new OtroCotizacionCotizacionesServicioServicio('', '', '',
																										       '', '', 
																										       '', '', 
																					            			   '', '');

				

				//Hacer un llamado a la función para inicializar elementos del detalle
				inicializar_detalle_otros_cotizaciones_servicio_servicio();

				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strConcepto = strConcepto.toUpperCase();

				//Convertir cadena de texto a número decimal
				intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intSubtotal = intPrecioUnitario;

				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					//Calcular descuento unitario
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;

					//Redondear cantidad a decimales
					intDescuentoUnitario = intDescuentoUnitario.toFixed(2);

					//Decrementar descuento unitario
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}

				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;
				//Redondear cantidad a decimales
				intSubtotal = intSubtotal.toFixed(2);
				intSubtotal = parseFloat(intSubtotal);

				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

				//Redondear cantidad a dos decimales
			    intImporteIva = intImporteIva.toFixed(4);
			    intImporteIva = parseFloat(intImporteIva);


				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
					//Redondear cantidad a dos decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(4);
			   	 	intImporteIeps = parseFloat(intImporteIeps);

				}


				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

					//Cambiar cantidad a  formato moneda (a visualizar)
				intCantidad =  formatMoney(intCantidad, 2, '');
			    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
			    intDescuentoUnitario =  formatMoney(intDescuentoUnitario, 2, '');
			    intImporteIva  =  formatMoney(intImporteIva, 4, '');
			    intImporteIeps  =  formatMoney(intImporteIeps, 4, '');
			    intSubtotal  =  formatMoney(intSubtotal, 2, '');
			    intTotal  =  formatMoney(intTotal, 2, '');


				//Asignar valores al objeto
				objOtroCotizacionCotizacionesServicioServicio.strConcepto = strConcepto;
				objOtroCotizacionCotizacionesServicioServicio.intCantidad = intCantidad;
				objOtroCotizacionCotizacionesServicioServicio.intPrecioUnitario = intPrecioUnitario;
				objOtroCotizacionCotizacionesServicioServicio.intPorcentajeDescuento = intPorcentajeDescuento;
				objOtroCotizacionCotizacionesServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
				objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIva = intTasaCuotaIva;
				objOtroCotizacionCotizacionesServicioServicio.intPorcentajeIva = intPorcentajeIva;
				objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIeps = intTasaCuotaIeps;
				objOtroCotizacionCotizacionesServicioServicio.intPorcentajeIeps = intPorcentajeIeps;

				//Revisamos si existe el renglón, si es así, editamos los datos del detalle
				if (intRenglon)
				{
					//Modificar los datos del detalle (otro servicio) corespondiente al indice
	        		objOtrosCotizacionCotizacionesServicioServicio.modificarDetalle(intRenglon, objOtroCotizacionCotizacionesServicioServicio);

	        		//Incrementar renglón para obtener la posición del detalle en la tabla
					intRenglon++;

					//Seleccionar el renglón de la tabla para actualizar los datos del detalle
					var selectedRow = document.getElementById("dg_otros_cotizaciones_servicio_servicio").rows[intRenglon].cells;

					selectedRow[0].innerHTML = objOtroCotizacionCotizacionesServicioServicio.strConcepto;
					selectedRow[1].innerHTML = objOtroCotizacionCotizacionesServicioServicio.intCantidad;
					selectedRow[2].innerHTML = objOtroCotizacionCotizacionesServicioServicio.intPrecioUnitario;
					selectedRow[3].innerHTML = objOtroCotizacionCotizacionesServicioServicio.intDescuentoUnitario;
					selectedRow[4].innerHTML = intSubtotal;
					selectedRow[5].innerHTML = intImporteIva;
					selectedRow[6].innerHTML = intImporteIeps;
					selectedRow[7].innerHTML = intTotal;
					selectedRow[9].innerHTML = objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIva;
					selectedRow[10].innerHTML = objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIeps;
				}
				else
				{
					//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
					intRenglon = $("#dg_otros_cotizaciones_servicio_servicio tr").length - 2;
					//Incrementar 1 para el siguiente renglón
					intRenglon++;

					//Agregar datos del detalle (otro servicio) de la cotización
           			objOtrosCotizacionCotizacionesServicioServicio.setDetalle(objOtroCotizacionCotizacionesServicioServicio);

           			//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaConcepto = objRenglon.insertCell(0);
					var objCeldaCantidad = objRenglon.insertCell(1);
					var objCeldaPrecioUnitario = objRenglon.insertCell(2);
					var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
					var objCeldaSubtotal = objRenglon.insertCell(4);
					var objCeldaIva = objRenglon.insertCell(5);
					var objCeldaIeps = objRenglon.insertCell(6);
					var objCeldaTotal = objRenglon.insertCell(7);
					var objCeldaAcciones = objRenglon.insertCell(8);
					//Columnas ocultas
					var objCeldaTasaCuotaIva = objRenglon.insertCell(9);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(10);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRenglon);
					objCeldaConcepto.setAttribute('class', 'movil e1');
					objCeldaConcepto.innerHTML = objOtroCotizacionCotizacionesServicioServicio.strConcepto;
					objCeldaCantidad.setAttribute('class', 'movil e2');
					objCeldaCantidad.innerHTML = objOtroCotizacionCotizacionesServicioServicio.intCantidad;
					objCeldaPrecioUnitario.setAttribute('class', 'movil e3');
					objCeldaPrecioUnitario.innerHTML = objOtroCotizacionCotizacionesServicioServicio.intPrecioUnitario;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil e4');
					objCeldaDescuentoUnitario.innerHTML = objOtroCotizacionCotizacionesServicioServicio.intDescuentoUnitario;
					objCeldaSubtotal.setAttribute('class', 'movil e5');
					objCeldaSubtotal.innerHTML = intSubtotal;
					objCeldaIva.setAttribute('class', 'movil e6');
					objCeldaIva.innerHTML = intImporteIva;
					objCeldaIeps.setAttribute('class', 'movil e7');
					objCeldaIeps.innerHTML = intImporteIeps;
					objCeldaTotal.setAttribute('class', 'movil e8');
					objCeldaTotal.innerHTML = intTotal;
					objCeldaAcciones.setAttribute('class', 'td-center movil e9');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_otros_cotizaciones_servicio_servicio(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_otros_cotizaciones_servicio_servicio(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIva.innerHTML = objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIva;
					objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIeps.innerHTML =  objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIeps;
				}


				//Hacer un llamado a la función para calcular totales de la tabla otros servicios
				calcular_totales_otros_cotizaciones_servicio_servicio();

				//Enfocar caja de texto
				$('#txtConcepto_otros_cotizaciones_servicio_servicio').focus();

			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_otros_cotizaciones_servicio_servicio tr").length - 2;
			$('#numElementos_otros_cotizaciones_servicio_servicio').html(intFilas);
			$('#txtNumDetalles_otros_cotizaciones_servicio_servicio').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_otros_cotizaciones_servicio_servicio(objRenglon)
		{

			//Decrementar indice para obtener la posición del detalle en el arreglo
		    var intRenglon =  parseInt(objRenglon.parentNode.parentNode.rowIndex) - 1;


		    //Crear instancia del objeto Otro servicio de la cotización
        	objOtroCotizacionCotizacionesServicioServicio = new OtroCotizacionCotizacionesServicioServicio();

        	//Asignar datos del detalle (otro servicio) corespondiente al indice
        	objOtroCotizacionCotizacionesServicioServicio = objOtrosCotizacionCotizacionesServicioServicio.getDetalle(intRenglon);

			//Asignar los valores a las cajas de texto
			$('#txtRenglon_otros_cotizaciones_servicio_servicio').val(intRenglon);
			$('#txtConcepto_otros_cotizaciones_servicio_servicio').val(objOtroCotizacionCotizacionesServicioServicio.strConcepto);
			$('#txtCantidad_otros_cotizaciones_servicio_servicio').val(objOtroCotizacionCotizacionesServicioServicio.intCantidad);
			$('#txtPrecioUnitario_otros_cotizaciones_servicio_servicio').val(objOtroCotizacionCotizacionesServicioServicio.intPrecioUnitario);
			$('#txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio').val(objOtroCotizacionCotizacionesServicioServicio.intPorcentajeDescuento);
			$('#txtTasaCuotaIva_otros_cotizaciones_servicio_servicio').val(objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIva);
			$('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').val(objOtroCotizacionCotizacionesServicioServicio.intPorcentajeIva);
			$('#txtTasaCuotaIeps_otros_cotizaciones_servicio_servicio').val(objOtroCotizacionCotizacionesServicioServicio.intTasaCuotaIeps);
			$('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').val(objOtroCotizacionCotizacionesServicioServicio.intPorcentajeIeps);

			//Enfocar caja de texto
			$('#txtConcepto_otros_cotizaciones_servicio_servicio').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_otros_cotizaciones_servicio_servicio(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			//Eliminar del objeto el detalle (otro servicio) seleccionado
			objOtrosCotizacionCotizacionesServicioServicio.eliminarDetalle(intRenglon - 1);

			//Eliminar el renglón indicado
			document.getElementById("dg_otros_cotizaciones_servicio_servicio").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla otros servicios
			calcular_totales_otros_cotizaciones_servicio_servicio();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_otros_cotizaciones_servicio_servicio tr").length - 2;
			$('#numElementos_otros_cotizaciones_servicio_servicio').html(intFilas);
			$('#txtNumDetalles_otros_cotizaciones_servicio_servicio').val(intFilas);

			//Enfocar caja de texto
			$('#txtConcepto_otros_cotizaciones_servicio_servicio').focus();

		}

		//Función para calcular totales de la tabla
		function calcular_totales_otros_cotizaciones_servicio_servicio()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_otros_cotizaciones_servicio_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, 2, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 2, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, 4, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, 4, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 2, '');

			//Asignar los valores
			$('#acumCantidad_otros_cotizaciones_servicio_servicio').html(intAcumUnidades);
			$('#acumDescuento_otros_cotizaciones_servicio_servicio').html(intAcumDescuento);
			$('#acumSubtotal_otros_cotizaciones_servicio_servicio').html(intAcumSubtotal);
			$('#acumIva_otros_cotizaciones_servicio_servicio').html(intAcumIva);
			$('#acumIeps_otros_cotizaciones_servicio_servicio').html(intAcumIeps);
			$('#acumTotal_otros_cotizaciones_servicio_servicio').html(intAcumTotal);
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{

			/*******************************************************************************************************************
			Controles correspondientes al modal Cotizaciones
			*********************************************************************************************************************/
			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Información General
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtGastosServicio_cotizaciones_servicio_servicio').numeric();
			$('#txtTipoCambio_cotizaciones_servicio_servicio').numeric();
        	//Agregar datepicker para seleccionar fecha
			$('#dteFecha_cotizaciones_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});

			//Calcular fecha de vencimiento cuando cambie la fecha
			$('#dteFecha_cotizaciones_servicio_servicio').on('dp.change', function (e) {	
             	//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_cotizaciones_servicio_servicio();
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.moneda_cotizaciones_servicio_servicio').blur(function(){
                $('.moneda_cotizaciones_servicio_servicio').formatCurrency({ roundToDecimalPlace: 2 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_cotizaciones_servicio_servicio').blur(function(){
                $('.tipo-cambio_cotizaciones_servicio_servicio').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_cotizaciones_servicio_servicio').blur(function(){
                $('.cantidad_cotizaciones_servicio_servicio').formatCurrency({ roundToDecimalPlace: 2 });
            });


            //Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_cotizaciones_servicio_servicio').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_cotizaciones_servicio_servicio').val()) === intMonedaBaseIDCotizacionesServicioServicio)
             	{
             		//Deshabilitar caja de texto
					$('#txtTipoCambio_cotizaciones_servicio_servicio').attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_cotizaciones_servicio_servicio').val(intTipoCambioMonedaBaseCotizacionesServicioServicio);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_cotizaciones_servicio_servicio').formatCurrency({ roundToDecimalPlace: 4 });
					//Hacer un llamado a la función para recalcular los importes y habilitar/deshabilitar campos
	                recalcular_precio_unitario_refacciones_cotizaciones_servicio_servicio('#cmbMonedaID_cotizaciones_servicio_servicio');
             	}
             	else
             	{
             		//Habilitar caja de texto
					$('#txtTipoCambio_cotizaciones_servicio_servicio').removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_cotizaciones_servicio_servicio').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_cotizaciones_servicio_servicio();
             	}
             	
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_cotizaciones_servicio_servicio').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_cotizaciones_servicio_servicio').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoCotizacionesServicioServicio)
	        	{
	        		$('#txtTipoCambio_cotizaciones_servicio_servicio').val(intTipoCambioMaximoCotizacionesServicioServicio);
	        	}

	        	//Hacer un llamado a la función para recalcular los importes y habilitar/deshabilitar campos
	            recalcular_precio_unitario_refacciones_cotizaciones_servicio_servicio('#txtTipoCambio_cotizaciones_servicio_servicio');

		    });


           //Autocomplete para recuperar los datos de un prospecto o cliente
	        $('#txtProspecto_cotizaciones_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_cotizaciones_servicio_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos del prospecto
	               inicializar_prospecto_cotizaciones_servicio_servicio();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/prospectos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'referencias'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar valores del registro seleccionado
	             $('#txtProspectoID_cotizaciones_servicio_servicio').val(ui.item.data);
	             $('#txtServicioListaPrecioID_cotizaciones_servicio_servicio').val(ui.item.servicio_lista_precio_id);

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del prospecto  cuando pierda el enfoque la caja de texto
	        $('#txtProspecto_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoID_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtProspecto_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_cotizaciones_servicio_servicio').val('');
	               $('#txtProspecto_cotizaciones_servicio_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos del prospecto
	               inicializar_prospecto_cotizaciones_servicio_servicio();
	              
	            }

	            //Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
				habilitar_elementos_tipo_cambio_refacciones_cotizaciones_servicio_servicio('#txtProspectoID_cotizaciones_servicio_servicio');

	        });


	         //Autocomplete para recuperar los datos de una estrategia
	        $('#txtEstrategia_cotizaciones_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEstrategiaID_cotizaciones_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/estrategias/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDCotizacionesServicioServicio
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEstrategiaID_cotizaciones_servicio_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la estrategia cuando pierda el enfoque la caja de texto
	        $('#txtEstrategia_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id de la estrategia
	            if($('#txtEstrategiaID_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtEstrategia_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstrategiaID_cotizaciones_servicio_servicio').val('');
	               $('#txtEstrategia_cotizaciones_servicio_servicio').val('');
	            }
	            
	        });

            //Autocomplete para recuperar los datos de un tipo de servicio 
	        $('#txtServicioTipo_cotizaciones_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtServicioTipoID_cotizaciones_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/servicios_tipos/autocomplete",
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
	             $('#txtServicioTipoID_cotizaciones_servicio_servicio').val(ui.item.data);
	             //Hacer un llamado a la función para regresar los datos del precio de un tipo de equipo
	              get_precio_equipo_tipo_cotizaciones_servicio_servicio();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del tipo de servicio cuando pierda el enfoque la caja de texto
	        $('#txtServicioTipo_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtServicioTipoID_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtServicioTipo_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtServicioTipoID_cotizaciones_servicio_servicio').val('');
	               $('#txtServicioTipo_cotizaciones_servicio_servicio').val('');
	               $('#txtPrecioUnitario_mano_obra_cotizaciones_servicio_servicio').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un tipo de equipo 
	        $('#txtEquipoTipo_cotizaciones_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEquipoTipoID_cotizaciones_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/equipos_tipos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intServicioTipoID: $('#txtServicioTipoID_cotizaciones_servicio_servicio').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEquipoTipoID_cotizaciones_servicio_servicio').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos del precio de un tipo de equipo
	              get_precio_equipo_tipo_cotizaciones_servicio_servicio();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del tipo de equipo cuando pierda el enfoque la caja de texto
	        $('#txtEquipoTipo_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtEquipoTipoID_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtEquipoTipo_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEquipoTipoID_cotizaciones_servicio_servicio').val('');
	               $('#txtEquipoTipo_cotizaciones_servicio_servicio').val('');
	               $('#txtPrecioUnitario_mano_obra_cotizaciones_servicio_servicio').val('');
	            }

	        });


            //Calcular el IVA desglosado despues de capturar gastos de servicio
	        $('#txtGastosServicio_cotizaciones_servicio_servicio').focusout(function(e){

	           	//Hacer un llamado a la función para desglosar el IVA del gasto de servicio
	       	   	$.desglosarIvaGasto(arrDesglosarIvaGastoCotizacionesServicioServicio);

	        });


	        //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });


        	/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Mano de Obra
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtHoras_mano_obra_cotizaciones_servicio_servicio').numeric();
			$('#txtPrecioUnitario_mano_obra_cotizaciones_servicio_servicio').numeric();
			$('#txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio').numeric();
        	$('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').numeric();
        	$('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').numeric();

			//Autocomplete para recuperar los datos de un servicio
			$('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtServicioID_mano_obra_cotizaciones_servicio_servicio').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "servicio/servicios/autocomplete",
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
					$('#txtServicioID_mano_obra_cotizaciones_servicio_servicio').val(ui.item.data);
					//Hacer un llamado a la función para regresar los datos del servicio
					get_datos_servicio_mano_obra_cotizaciones_servicio_servicio();
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id del servicio cuando pierda el enfoque la caja de texto
	        $('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id del servicio
	            if($('#txtServicioID_mano_obra_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').val() == '')
	            {
	               	//Hacer un llamado a la función para inicializar elementos del servicio
	              	inicializar_detalle_mano_obra_cotizaciones_servicio_servicio();
	            }
	        });

	        //Autocomplete para recuperar los datos de un servicio
			$('#txtDescripcion_mano_obra_cotizaciones_servicio_servicio').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtServicioID_mano_obra_cotizaciones_servicio_servicio').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "servicio/servicios/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term,
							strTipo: 'descripcion'
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtServicioID_mano_obra_cotizaciones_servicio_servicio').val(ui.item.data);
					//Hacer un llamado a la función para regresar los datos del servicio
					get_datos_servicio_mano_obra_cotizaciones_servicio_servicio();
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id del servicio cuando pierda el enfoque la caja de texto
	        $('#txtDescripcion_mano_obra_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id del servicio
	            if($('#txtServicioID_mano_obra_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtDescripcion_mano_obra_cotizaciones_servicio_servicio').val() == '')
	            { 
	               	//Hacer un llamado a la función para inicializar elementos del servicio
	              	inicializar_detalle_mano_obra_cotizaciones_servicio_servicio();
	            }

	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_mano_obra_cotizaciones_servicio_servicio').val('');
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
	             $('#txtTasaCuotaIva_mano_obra_cotizaciones_servicio_servicio').val(ui.item.data);
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
	        $('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_mano_obra_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_mano_obra_cotizaciones_servicio_servicio').val('');
	               $('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_mano_obra_cotizaciones_servicio_servicio').val('');
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
	             $('#txtTasaCuotaIeps_mano_obra_cotizaciones_servicio_servicio').val(ui.item.data);
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
	        $('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_mano_obra_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_mano_obra_cotizaciones_servicio_servicio').val('');
	               $('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').val('');
	            }
	            
	        });

	        //Función para mover renglones arriba y abajo en la tabla
	        $('#dg_mano_obra_cotizaciones_servicio_servicio').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Verifica que no sea el último elemento del grid
	            	if( row.next().index() != -1 )
	            	{ 
	            		objMOCotizacionCotizacionesServicioServicio.swap(row.index(), row.next().index() );
	            	}	

	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Verifica que no sea el primer elemento del grid
	            	if( row.prev().index() != -1 )
	            	{ 
	            		objMOCotizacionCotizacionesServicioServicio.swap(row.prev().index(), row.index() );
	            	}
	            	//Pasar al renglón de arriba
	            	row.prev().before(row);
	            }
				
	        });

	        //Validar que exista código del servicio cuando se pulse la tecla enter 
			$('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
			   	    //Si no existe código del servicio
		            if($('#txtServicioID_mano_obra_cotizaciones_servicio_servicio').val() == '' || $('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCodigo_mano_obra_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista descripción del servicio cuando se pulse la tecla enter 
			$('#txtDescripcion_mano_obra_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe descripción del servicio
		            if($('#txtServicioID_mano_obra_cotizaciones_servicio_servicio').val() == '' || $('#txtDescripcion_mano_obra_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtDescripcion_mano_obra_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_mano_obra_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_mano_obra_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {

			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtTasaCuotaIeps_mano_obra_cotizaciones_servicio_servicio').val() == '' && 
		         	   $('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').val() != '')
		         	{
		         	
		         		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_mano_obra_cotizaciones_servicio_servicio').focus();
		         	}
		         	else
		         	{
		         		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_mano_obra_cotizaciones_servicio_servicio();
		         	}
		        }
		    });


        	/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Refacciones
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtCantidad_refacciones_cotizaciones_servicio_servicio').numeric();
			$('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').numeric();
			$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').numeric();


			//Autocomplete para recuperar los datos de una refacción, kit, línea o marca
	        $('#txtReferencia_refacciones_cotizaciones_servicio_servicio').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtReferenciaID_refacciones_cotizaciones_servicio_servicio').val('');
	                 //Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	               	 inicializar_refaccion_refacciones_cotizaciones_servicio_servicio('REFACCION');

	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones_promociones/autocomplete",
	                   type: "post",
	                   dataType: "json",
	                   data: {
	                     strDescripcion: request.term,
	                     strTipo: 'referencias',
	                     //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						 dteFecha: $.formatFechaMysql($('#txtFecha_cotizaciones_servicio_servicio').val()), 
						 intRefaccionesListaPrecioID: $('#txtServicioListaPrecioID_cotizaciones_servicio_servicio').val(),
						 strListaPrecioCte: 'SI'

	                   },
	                   success: function( data ) {
	                     response( data );
	                   }
	                 });
	             },
	             select: function( event, ui ) {
	                //Asignar id del registro seleccionado
	                $('#txtReferenciaID_refacciones_cotizaciones_servicio_servicio').val(ui.item.data);
	                var intPorcentajeDescuento = parseFloat(ui.item.descuento_promocion);
	                var strTipoReferencia = ui.item.tipo_referencia;
	                 $('#txtTipoReferencia_refacciones_cotizaciones_servicio_servicio').val(strTipoReferencia);

	                //Si existe la referencia tiene descuento de promoción
	                if(intPorcentajeDescuento > 0)
	                {
	                	$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').val(intPorcentajeDescuento);
	                	//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					    $('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').formatCurrency({ roundToDecimalPlace: 2 });
	                }

	                //Si el tipo de referencia corresponde a una refacción
	                if(strTipoReferencia == 'REFACCION')
	                {
	                	 //Hacer un llamado a la función para regresar los datos de la refacción
	                	get_datos_refaccion_refacciones_cotizaciones_servicio_servicio();
	                }
	                else
	                {
	                	//Deshabilitar las siguientes cajas de texto
				   		$('#txtCantidad_refacciones_cotizaciones_servicio_servicio').attr('disabled','disabled');
				   		$('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').attr('disabled','disabled');
				   		$('#txtPorcentajeIva_refacciones_cotizaciones_servicio_servicio').attr('disabled','disabled');
				   		$('#txtPorcentajeIeps_refacciones_cotizaciones_servicio_servicio').attr('disabled','disabled');
				   		//Enfocar caja de texto
		                $('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').focus();
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

	        //Verificar que exista id de la referencia cuando pierda el enfoque la caja de texto
	        $('#txtReferencia_refacciones_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id de la referencia
	            if($('#txtReferenciaID_refacciones_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtReferencia_refacciones_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtReferenciaID_refacciones_cotizaciones_servicio_servicio').val('');
	               $('#txtReferencia_refacciones_cotizaciones_servicio_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	               	inicializar_refaccion_refacciones_cotizaciones_servicio_servicio('REFACCION');

	            }

	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_refacciones_cotizaciones_servicio_servicio').on('click','button.btn',function(){
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

	         //Validar que exista referencia cuando se pulse la tecla enter 
			$('#txtReferencia_refacciones_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe referencia
		            if($('#txtReferenciaID_refacciones_cotizaciones_servicio_servicio').val() == '' || $('#txtReferencia_refacciones_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtReferencia_refacciones_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtCantidad_refacciones_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_refacciones_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_refacciones_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_refacciones_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Si el tipo de referencia corresponde a una refacción 
			   	    	if($('#txtTipoReferencia_refacciones_cotizaciones_servicio_servicio').val() == 'REFACCION')
			   	    	{

			   	    		//Enfocar caja de texto
					    	$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').focus();
			   	    	}
			   	   		else
			   	   		{
			   	   			///Hacer un llamado a la función para agregar renglón a la tabla
		   	    			agregar_renglon_refacciones_cotizaciones_servicio_servicio();
			   	   		}
			   	    }
		        }
		    });

		    //Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe precio unitario
		            if($('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_refacciones_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Si el tipo de referencia corresponde a una refacción 
			   	    	if($('#txtTipoReferencia_refacciones_cotizaciones_servicio_servicio').val() == 'REFACCION')
			   	    	{
			   	    		//Enfocar caja de texto
					    	$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').focus();
			   	    	}
			   	   		else
			   	   		{
			   	   			//Hacer un llamado a la función para agregar renglón a la tabla
		   	    			agregar_renglon_refacciones_cotizaciones_servicio_servicio();
			   	   		}
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_refacciones_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {

		   	    		//Hacer un llamado a la función para agregar renglón a la tabla
		   	    		agregar_renglon_refacciones_cotizaciones_servicio_servicio();
			   	    	
			   	    }
		        }
		    });


        	/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Trabajos Foráneos
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').numeric();
			$('#txtPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio').numeric();
        	$('#txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').numeric();
        	$('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').numeric();
        	$('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').numeric();

        	//Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
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
	             $('#txtTasaCuotaIva_trabajos_foraneos_cotizaciones_servicio_servicio').val(ui.item.data);
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
	        $('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_trabajos_foraneos_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
	               $('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
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
	             $('#txtTasaCuotaIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val(ui.item.data);
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
	        $('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
	               $('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val('');
	            }
	            
	        });


	        //Función para mover renglones arriba y abajo en la tabla
	        $('#dg_trabajos_foraneos_cotizaciones_servicio_servicio').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Verifica que no sea el último elemento del grid
	            	if( row.next().index() != -1 )
	            	{ 
	            		objTFCotizacionCotizacionesServicioServicio.swap(row.index(), row.next().index() );
	            	}	

	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Verifica que no sea el primer elemento del grid
	            	if( row.prev().index() != -1 )
	            	{ 
	            		objTFCotizacionCotizacionesServicioServicio.swap(row.prev().index(), row.index() );
	            	}
	            	//Pasar al renglón de arriba
	            	row.prev().before(row);
	            }
				
	        });

	         //Validar que exista descripción cuando se pulse la tecla enter 
			$('#txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe descripción
		            if($('#txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtConcepto_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPrecioUnitario_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {

			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtTasaCuotaIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val() == '' && 
		         	   $('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').val() != '')
		         	{
		         	
		         		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_trabajos_foraneos_cotizaciones_servicio_servicio').focus();
		         	}
		         	else
		         	{
		         		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_trabajos_foraneos_cotizaciones_servicio_servicio();
		         	}
		        }
		    });


        	/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Otros
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtCantidad_otros_cotizaciones_servicio_servicio').numeric();
			$('#txtPrecioUnitario_otros_cotizaciones_servicio_servicio').numeric();
        	$('#txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio').numeric();
        	$('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').numeric();
        	$('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').numeric();

        	//Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_otros_cotizaciones_servicio_servicio').val('');
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
	             $('#txtTasaCuotaIva_otros_cotizaciones_servicio_servicio').val(ui.item.data);
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
	        $('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_otros_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_otros_cotizaciones_servicio_servicio').val('');
	               $('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_otros_cotizaciones_servicio_servicio').val('');
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
	             $('#txtTasaCuotaIeps_otros_cotizaciones_servicio_servicio').val(ui.item.data);
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
	        $('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_otros_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_otros_cotizaciones_servicio_servicio').val('');
	               $('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').val('');
	            }
	            
	        });


	        //Función para mover renglones arriba y abajo en la tabla
	        $('#dg_otros_cotizaciones_servicio_servicio').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Verifica que no sea el último elemento del grid
	            	if( row.next().index() != -1 )
	            	{ 
	            		objOtrosCotizacionCotizacionesServicioServicio.swap(row.index(), row.next().index() );
	            	}	

	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Verifica que no sea el primer elemento del grid
	            	if( row.prev().index() != -1 )
	            	{ 
	            		objOtrosCotizacionCotizacionesServicioServicio.swap(row.prev().index(), row.index() );
	            	}
	            	//Pasar al renglón de arriba
	            	row.prev().before(row);
	            }
				
	        });

	        //Validar que exista descripción cuando se pulse la tecla enter 
			$('#txtConcepto_otros_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe descripción
		            if($('#txtConcepto_otros_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtConcepto_otros_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_otros_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_otros_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_otros_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_otros_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_otros_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_otros_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPrecioUnitario_otros_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPrecioUnitario_otros_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_otros_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_otros_cotizaciones_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {

			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtTasaCuotaIeps_otros_cotizaciones_servicio_servicio').val() == '' && 
		         	   $('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').val() != '')
		         	{
		         	
		         		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_otros_cotizaciones_servicio_servicio').focus();
		         	}
		         	else
		         	{
		         		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_otros_cotizaciones_servicio_servicio();
		         	}
		        }
		    });



			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_cotizaciones_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_cotizaciones_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY',
			 																		              useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_cotizaciones_servicio_servicio').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_cotizaciones_servicio_servicio').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_cotizaciones_servicio_servicio').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_cotizaciones_servicio_servicio').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un prospecto o cliente
	        $('#txtProspectoBusq_cotizaciones_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_cotizaciones_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/prospectos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'referencias'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtProspectoIDBusq_cotizaciones_servicio_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del prospecto cuando pierda el enfoque la caja de texto
	        $('#txtProspectoBusq_cotizaciones_servicio_servicio').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_cotizaciones_servicio_servicio').val() == '' ||
	               $('#txtProspectoBusq_cotizaciones_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_cotizaciones_servicio_servicio').val('');
	               $('#txtProspectoBusq_cotizaciones_servicio_servicio').val('');
	            }

	        });

	        //Paginación de registros
			$('#pagLinks_cotizaciones_servicio_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaCotizacionesServicioServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_cotizaciones_servicio_servicio();
			});

			//Abrir modal Ordenes de Trabajo cuando se de clic en el botón
			$('#btnNuevo_cotizaciones_servicio_servicio').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_cotizaciones_servicio_servicio();
			
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_cotizaciones_servicio_servicio').addClass("estatus-NUEVO");
				//Abrir modal
				 objCotizacionesServicioServicio = $('#CotizacionesServicioServicioBox').bPopup({
											   appendTo: '#CotizacionesServicioServicioContent', 
				                               contentContainer: 'CotizacionesServicioServicioM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_cotizaciones_servicio_servicio').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_cotizaciones_servicio_servicio').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_cotizaciones_servicio_servicio();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
  			cargar_monedas_cotizaciones_servicio_servicio();
		});

	</script>
	