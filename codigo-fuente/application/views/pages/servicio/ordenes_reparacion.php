	<div id="OrdenesReparacionServicioContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_ordenes_reparacion_servicio" method="post" action="#" 
				  class="form-horizontal" role="form" name="frmBusqueda_ordenes_reparacion_servicio"
				  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_ordenes_reparacion_servicio">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_ordenes_reparacion_servicio'>
				                    <input class="form-control" id="txtFechaInicialBusq_ordenes_reparacion_servicio"
				                    		name= "strFechaInicialBusq_ordenes_reparacion_servicio" 
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
								<label for="txtFechaFinalBusq_ordenes_reparacion_servicio">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_ordenes_reparacion_servicio'>
				                    <input class="form-control" id="txtFechaFinalBusq_ordenes_reparacion_servicio"
				                    		name= "strFechaFinalBusq_ordenes_reparacion_servicio" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los prospectos y clientes activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del prospecto/cliente seleccionado-->
								<input id="txtProspectoIDBusq_ordenes_reparacion_servicio" 
									   name="intProspectoIDBusq_ordenes_reparacion_servicio"  type="hidden" 
									   value="">
								</input>
								<label for="txtProspectoBusq_ordenes_reparacion_servicio">Cliente</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProspectoBusq_ordenes_reparacion_servicio" 
										name="strProspectoBusq_ordenes_reparacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese cliente" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_ordenes_reparacion_servicio">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_ordenes_reparacion_servicio" 
								 		name="strEstatusBusq_ordenes_reparacion_servicio" tabindex="1">
								    <option value="TODOS">TODOS</option>
                      				<option value="ACTIVO">ACTIVO</option>
                      				<option value="FINALIZADO">FINALIZADO</option>
                      				<option value="FACTURADO">FACTURADO</option>
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
								<label for="txtBusqueda_ordenes_reparacion_servicio">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_ordenes_reparacion_servicio" 
										name="strBusqueda_ordenes_reparacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_ordenes_reparacion_servicio" 
									   name="strImprimirDetalles_ordenes_reparacion_servicio" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_ordenes_reparacion_servicio"
									onclick="paginacion_ordenes_reparacion_servicio();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_ordenes_reparacion_servicio" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_ordenes_reparacion_servicio"
									onclick="reporte_ordenes_reparacion_servicio('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_ordenes_reparacion_servicio"
									onclick="reporte_ordenes_reparacion_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla ordenes de reparación 
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Cliente"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla servicios
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Servicio"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Horas"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Precio"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Mecánico"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla salidas de refacciones por taller
				*/
				td.movil.c1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.c3:nth-of-type(3):before {content: "Requisición"; font-weight: bold;}
				td.movil.c4:nth-of-type(4):before {content: "Código"; font-weight: bold;}
				td.movil.c5:nth-of-type(5):before {content: "Descripción"; font-weight: bold;}
				td.movil.c6:nth-of-type(6):before {content: "Solicitado"; font-weight: bold;}
				td.movil.c7:nth-of-type(7):before {content: "Surtido"; font-weight: bold;}
				td.movil.c8:nth-of-type(8):before {content: "Devolución"; font-weight: bold;}
				td.movil.c9:nth-of-type(9):before {content: "Cantidad"; font-weight: bold;}
				td.movil.c10:nth-of-type(10):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.c11:nth-of-type(11):before {content: "Total"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla salidas de refacciones por taller
				*/
				td.movil.tc1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.tc2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.tc3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.tc4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.tc5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.tc6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.tc7:nth-of-type(7):before {content: "Surtido"; font-weight: bold;}
				td.movil.tc8:nth-of-type(8):before {content: "Devolución"; font-weight: bold;}
				td.movil.tc9:nth-of-type(9):before {content: "Cantidad"; font-weight: bold;}
				td.movil.tc10:nth-of-type(10):before {content: ""; font-weight: bold;}
				td.movil.tc11:nth-of-type(11):before {content: "Total"; font-weight: bold;}

				/*
				Definir columnas de la tabla trabajos foráneos
				*/
				td.movil.d1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Concepto"; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Cantidad"; font-weight: bold;}
				td.movil.d5:nth-of-type(5):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.d6:nth-of-type(6):before {content: "Desc."; font-weight: bold;}
				td.movil.d7:nth-of-type(7):before {content: "Subtotal"; font-weight: bold;}
				td.movil.d8:nth-of-type(8):before {content: "IVA"; font-weight: bold;}
				td.movil.d9:nth-of-type(9):before {content: "IEPS"; font-weight: bold;}
				td.movil.d10:nth-of-type(10):before {content: "Total"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla trabajos foráneos
				*/
				td.movil.td1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.td2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.td3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.td4:nth-of-type(4):before {content: "Cantidad"; font-weight: bold;}
				td.movil.td5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.td6:nth-of-type(6):before {content: "Desc."; font-weight: bold;}
				td.movil.td7:nth-of-type(7):before {content: "Subtotal"; font-weight: bold;}
				td.movil.td8:nth-of-type(8):before {content: "IVA"; font-weight: bold;}
				td.movil.td9:nth-of-type(9):before {content: "IEPS"; font-weight: bold;}
				td.movil.td10:nth-of-type(10):before {content: "Total"; font-weight: bold;}

				/*
				Definir columnas de la tabla tiempos de los servicios
				*/
				td.movil.e1:nth-of-type(1):before {content: "Fecha de inicio"; font-weight: bold;}
				td.movil.e2:nth-of-type(2):before {content: "Motivo de suspensión"; font-weight: bold;}
				td.movil.e3:nth-of-type(3):before {content: "Fecha de suspensión"; font-weight: bold;}
				td.movil.e4:nth-of-type(4):before {content: "Tiempo"; font-weight: bold;}
				td.movil.e5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.e6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla otros servicios
				*/
				td.movil.f1:nth-of-type(1):before {content: "Concepto"; font-weight: bold;}
				td.movil.f2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.f3:nth-of-type(3):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.f4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.f5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.f6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.f7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.f8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.f9:nth-of-type(9):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla otros servicios
				*/
				td.movil.tf1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.tf2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.tf3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.tf4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.tf5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.tf6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.tf7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.tf8:nth-of-type(8):before {content: "Total"; font-weight: bold;}

			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_ordenes_reparacion_servicio">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Cliente</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_ordenes_reparacion_servicio" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{prospecto}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_ordenes_reparacion_servicio({{orden_reparacion_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_ordenes_reparacion_servicio({{orden_reparacion_id}},'Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
                            	<!---Finalizar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionFinalizar}}" 
										onclick="cambiar_estatus_ordenes_reparacion_servicio({{orden_reparacion_id}}, 'FINALIZADO',{{total_serviciosNofinalizados}}, '{{serie}}', '{{facturar_servicio_tipo}}');" title="Finalizar">
									<span class="glyphicon glyphicon-time"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="impresion_formato_ordenes_reparacion_servicio({{orden_reparacion_id}},'{{estatus}}')"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_ordenes_reparacion_servicio({{orden_reparacion_id}}, 'gridview')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_ordenes_reparacion_servicio({{orden_reparacion_id}},'INACTIVO',{{total_serviciosNofinalizados}}, '{{serie}}', '{{facturar_servicio_tipo}}');" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ordenes_reparacion_servicio"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_ordenes_reparacion_servicio">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_ordenes_reparacion_servicio" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	


		<!-- Diseño del modal Impresión de Formato-->
		<div id="FormatoOrdenesReparacionServicioBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_formato_ordenes_reparacion_servicio" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Impresión</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmFormatoOrdenesReparacionServicio" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmFormatoOrdenesReparacionServicio"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
						<input id="txtOrdenReparacionID_formato_ordenes_reparacion_servicio" 
							   name="intOrdenReparacionID_formato_ordenes_reparacion_servicio" 
							   type="hidden" value="">
						</input>
						<!--Tipo de reporte-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<label>Seleccione el tipo de impresión:</label>
							<div class="custom-control custom-radio">
								<input 
										id="bgCostos_formato_ordenes_reparacion_servicio"
										type="radio" 
								  	   	class="custom-control-input" 
								  	   	name="strTipoReporte_formato_ordenes_reparacion_servicio" 
								  	   	value="ConCostos"  checked />
								<label class="custom-control-label" for="bgCostos_formato_ordenes_reparacion_servicio">Con costos</label>
							</div>
							<div class="custom-control custom-radio">
								<input 
										id="bgSinCostos_formato_ordenes_reparacion_servicio"	
										type="radio" 
									  	class="custom-control-input"  
								  	    name="strTipoReporte_formato_ordenes_reparacion_servicio"  
								  	    value="SinCostos"  />
								<label class="custom-control-label" for="bgSinCostos_formato_ordenes_reparacion_servicio">Sin costos</label>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Imprimir reporte-->
							<button class="btn btn-success" id="btnImprimir_formato_ordenes_reparacion_servicio"  
									onclick="reporte_registro_ordenes_reparacion_servicio();"  title="Imprimir registro en PDF" tabindex="2">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_formato_ordenes_reparacion_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_formato_ordenes_reparacion_servicio();" 
									title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Impresión de Formato-->

		<!-- Diseño del modal Ordenes de Trabajo-->
		<div id="OrdenesReparacionServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_ordenes_reparacion_servicio" class="ModalBodyTitle">
				<h1>Ordenes de Trabajo</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_ordenes_reparacion_servicio" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_ordenes_reparacion_servicio" class="active">
									<a data-toggle="tab" href="#informacion_general_ordenes_reparacion_servicio">Información General</a>
								</li>
								<!--Tab que contiene la información de la mano de obra-->
								<li id="tabManoObra_ordenes_reparacion_servicio" class="disabled disabledTab">
									<a data-toggle="tab" href="#mano_obra_ordenes_reparacion_servicio">Mano de Obra</a>
								</li>
								<!--Tab que contiene la información de las salidas de refacciones por taller-->
								<li id="tabSalidasRefacciones_ordenes_reparacion_servicio" class="disabled disabledTab">
									<a data-toggle="tab" href="#salidas_refacciones_ordenes_reparacion_servicio">Refacciones</a>
								</li>
								<!--Tab que contiene la información de los trabajos foráneos-->
								<li id="tabTrabajosForaneos_ordenes_reparacion_servicio" class="disabled disabledTab">
									<a data-toggle="tab" href="#trabajos_foraneos_ordenes_reparacion_servicio">Trabajos Foráneos</a>
								</li>
								<!--Tab que contiene la información de otros-->
								<li id="tabOtros_ordenes_reparacion_servicio" class="disabled disabledTab">
									<a data-toggle="tab" href="#otros_ordenes_reparacion_servicio">Otros</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmOrdenesReparacionServicio" method="post" action="#" class="form-horizontal" role="form" name="frmOrdenesReparacionServicio" 
					  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_ordenes_reparacion_servicio" class="tab-pane fade in active">
							<div class="row">
								<!--Folio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtOrdenReparacionID_ordenes_reparacion_servicio" 
												   name="intOrdenReparacionID_ordenes_reparacion_servicio" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_ordenes_reparacion_servicio" 
											       name="strEstatus_ordenes_reparacion_servicio" type="hidden" value="">
											</input>
											<label for="txtFolio_ordenes_reparacion_servicio">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_ordenes_reparacion_servicio" 
													name="strFolio_ordenes_reparacion_servicio" type="text" value="" 
													placeholder="Autogenerado" disabled>
											</input>
										</div>
									</div>
								</div>
								<!-- Fecha -->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_ordenes_reparacion_servicio">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_ordenes_reparacion_servicio'>
							                    <input class="form-control" 
							                    		id="txtFecha_ordenes_reparacion_servicio"
							                    		name= "strFecha_ordenes_reparacion_servicio" 
							                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!-- Fecha de finalización-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFechaFinalizacion_ordenes_reparacion_servicio">Fecha de finalización</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFechaFinalizacion_ordenes_reparacion_servicio'>
							                    <input class="form-control" 
							                    		id="txtFechaFinalizacion_ordenes_reparacion_servicio"
							                    		name= "strFechaFinalizacion_ordenes_reparacion_servicio" 
							                    		type="text"  value="" disabled />
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Usuario de finalización-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtUsuarioFinalizacion_ordenes_reparacion_servicio">Usuario de finalización</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtUsuarioFinalizacion_ordenes_reparacion_servicio" 
													name="strUsuarioFinalizacion_ordenes_reparacion_servicio" type="text" value="" disabled>
											</input>
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
											<input id="txtServicioTipoID_ordenes_reparacion_servicio" 
												   name="intServicioTipoID_ordenes_reparacion_servicio"  type="hidden" 
												   value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el tipo de factura (facturar) del servicio-->
											<input id="txtFacturarServicioTipo_ordenes_reparacion_servicio" 
												   name="strFacturarServicioTipo_ordenes_reparacion_servicio"  type="hidden" 
												   value="">
											</input>
											<label for="txtServicioTipo_ordenes_reparacion_servicio">
												Tipo de servicio
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtServicioTipo_ordenes_reparacion_servicio" 
													name="strServicioTipo_ordenes_reparacion_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese tipo de servicio" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los prospectos y clientes activos-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del prospecto/cliente seleccionado-->
											<input id="txtProspectoID_ordenes_reparacion_servicio" 
												   name="intProspectoID_ordenes_reparacion_servicio"  type="hidden" 
												   value="">
											</input>
											<label for="txtProspecto_ordenes_reparacion_servicio">Cliente</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtProspecto_ordenes_reparacion_servicio" 
													name="strProspecto_ordenes_reparacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese cliente" maxlength="250">
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
                       			<!--Tipo de reparación-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbTipoReparacion_ordenes_reparacion_servicio">Tipo de reparación</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbTipoReparacion_ordenes_reparacion_servicio" 
											 		name="strTipoReparacion_ordenes_reparacion_servicio" tabindex="1">
											    <option value="">Seleccione una opción</option>
			                      				<option value="PUBLICO">PUBLICO</option>
			                      				<option value="INTERNO">INTERNO</option>
			                      				<option value="GARANTIA">GARANTIA</option>
			                      				<option value="OTRAS MARCAS">OTRAS MARCAS</option>
			                 				</select>
										</div>
									</div>
								</div>
                       			<!--Ubicación-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbUbicacion_ordenes_reparacion_servicio">Ubicación</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbUbicacion_ordenes_reparacion_servicio" 
											 		name="strUbicacion_ordenes_reparacion_servicio" tabindex="1">
											    <option value="">Seleccione una opción</option>
			                      				<option value="PISO">PISO</option>
			                      				<option value="CAMPO">CAMPO</option>
			                      				<option value="CLIENTE">CLIENTE</option>
			                 				</select>
										</div>
									</div>
								</div>
                       	    </div>
                       		<div class="row">
                       			<!--Autocomplete que contiene las series de prospectos_inventario / maquinaria_inventario (dependiendo del tipo de servicio (Facturar = SI/NO))-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de referencia de la serie seleccionada-->
											<input id="txtSerieReferenciaID_ordenes_reparacion_servicio" 
												   name="intSerieReferenciaID_ordenes_reparacion_servicio"  type="hidden" 
												   value="">
											</input>
											<label for="txtSerie_ordenes_reparacion_servicio">Serie</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtSerie_ordenes_reparacion_servicio" 
													name="strSerie_ordenes_reparacion_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese serie" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Motor-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMotor_ordenes_reparacion_servicio">Motor</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMotor_ordenes_reparacion_servicio" 
													name="strMotor_ordenes_reparacion_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese motor" maxlength="50">
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
                       			<!--Autocomplete que contiene los tipos de equipos activos-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del tipo de equipo seleccionado-->
											<input id="txtEquipoTipoID_ordenes_reparacion_servicio" 
												   name="intEquipoTipoID_ordenes_reparacion_servicio"  type="hidden" 
												   value="">
											</input>
											<label for="txtEquipoTipo_ordenes_reparacion_servicio">Tipo de equipo</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtEquipoTipo_ordenes_reparacion_servicio" 
													name="strEquipoTipo_ordenes_reparacion_servicio" type="text"  value="" tabindex="1" 
													placeholder="Ingrese tipo de equipo" maxlength="250" />
											</input>
										</div>
									</div>
								</div>
                       			<!--Autocomplete que contiene las descripciones de maquinaria activas-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la descripción de maquinaria seleccionada-->
											<input id="txtMaquinariaDescripcionID_ordenes_reparacion_servicio" 
												   name="intMaquinariaDescripcionID_ordenes_reparacion_servicio"  type="hidden" 
												   value="">
											</input>
											<label for="txtMaquinariaDescripcion_ordenes_reparacion_servicio">Maquinaria</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMaquinariaDescripcion_ordenes_reparacion_servicio" 
													name="strMaquinariaDescripcion_ordenes_reparacion_servicio" type="text"  value="" tabindex="1" 
													placeholder="Ingrese maquinaria" maxlength="250" />
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
                       			<!--Horas-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHoras_ordenes_reparacion_servicio">Horas de uso</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control moneda_ordenes_reparacion_servicio" id="txtHoras_ordenes_reparacion_servicio" 
													name="intHoras_ordenes_reparacion_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese horas" maxlength="12">
											</input>
										</div>
									</div>
								</div>
								<!--Gastos del servicio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el subtotal desglosado con base al importe capturado-->
											<input id="txtGastosServicioSubtotal_ordenes_reparacion_servicio" 
												   name="intGastosServicioSubtotal_ordenes_reparacion_servicio" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el IVA desglosado con base al importe capturado-->
											<input id="txtGastosServicioIva_ordenes_reparacion_servicio" 
												   name="intGastosServicioIva_ordenes_reparacion_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtGastosServicio_ordenes_reparacion_servicio">Gastos de servicio</label>
										</div>
										<div class="col-md-12">
											<div class='input-group'>
												<span class="input-group-addon">$</span>
												<input  class="form-control moneda_ordenes_reparacion_servicio" id="txtGastosServicio_ordenes_reparacion_servicio" 
														name="intGastosServicio_ordenes_reparacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="12">
												</input>
												
											</div>
										</div>
									</div>
								</div>
								<!--Falla-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFalla_ordenes_reparacion_servicio">Falla</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFalla_ordenes_reparacion_servicio" 
													name="strFalla_ordenes_reparacion_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese falla" maxlength="250">
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
                       			<!--Causa-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCausa_ordenes_reparacion_servicio">Causa</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCausa_ordenes_reparacion_servicio" 
													name="strCausa_ordenes_reparacion_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese causa" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Solución-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtSolucion_ordenes_reparacion_servicio">Solución</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtSolucion_ordenes_reparacion_servicio" 
													name="strSolucion_ordenes_reparacion_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese solución" maxlength="250">
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
											<label for="txtObservaciones_ordenes_reparacion_servicio">Observaciones</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtObservaciones_ordenes_reparacion_servicio" 
													name="strObservaciones_ordenes_reparacion_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
											</input>
										</div>
									</div>
								</div>
                       		</div>
						</div><!--Cierre del contenido del tab - Información General-->
						<!--Tab - Mano de Obra-->
						<div id="mano_obra_ordenes_reparacion_servicio" class="tab-pane fade">
							<div class="row">
								<!--Autocomplete que contiene los servicios activos-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
											<input id="txtRenglon_mano_obra_ordenes_reparacion_servicio" name="intRenglon_mano_obra_ordenes_reparacion_servicio"  
												   type="hidden" value="">
										    </input>
											<!-- Caja de texto oculta para recuperar el id del servicio seleccionado-->
											<input id="txtServicioID_mano_obra_ordenes_reparacion_servicio" 
												   name="intServicioID_mano_obra_ordenes_reparacion_servicio" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro-->
											<input id="txtEstatus_mano_obra_ordenes_reparacion_servicio" 
												   name="strEstatus_mano_obra_ordenes_reparacion_servicio"  
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el total de servicios activos-->
											<input id="txtTotalServiciosActivos_mano_obra_ordenes_reparacion_servicio" 
												   name="intTotalServiciosActivos_mano_obra_ordenes_reparacion_servicio"  
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el id del mecánico seleccionado-->
											<input id="txtMecanicoID_mano_obra_ordenes_reparacion_servicio" 
												   name="intMecanicoID_mano_obra_ordenes_reparacion_servicio"  
												   type="hidden" value="">
											</input>
											<label for="txtCodigo_mano_obra_ordenes_reparacion_servicio">Código</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtCodigo_mano_obra_ordenes_reparacion_servicio"
												   name="strCodigo_mano_obra_ordenes_reparacion_servicio" 
												   type="text" value="" tabindex="1" placeholder="Ingrese código" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Descripción-->
								<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtDescripcion_mano_obra_ordenes_reparacion_servicio">Descripción</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtDescripcion_mano_obra_ordenes_reparacion_servicio"
												   name="strDescripcion_mano_obra_ordenes_reparacion_servicio" 
												   type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Horas-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHoras_mano_obra_ordenes_reparacion_servicio">Horas</label>
										</div>
										<div class="col-md-12">
											<input class="form-control cantidad_ordenes_reparacion_servicio" id="txtHoras_mano_obra_ordenes_reparacion_servicio"
												   name="intHoras_mano_obra_ordenes_reparacion_servicio" 
												   type="text" value="" tabindex="1" placeholder="Ingrese horas" maxlength="12">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Precio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPrecio_mano_obra_ordenes_reparacion_servicio">Precio</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtPrecio_mano_obra_ordenes_reparacion_servicio"
												   name="intPrecio_mano_obra_ordenes_reparacion_servicio" 
												   type="text" value="">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los mecánicos activos-->
								<div class="col-sm-8 col-md-8 col-lg-8 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del mecánico seleccionado-->
											<input id="txtMecanicoID_mano_obra_ordenes_reparacion_servicio" 
												   name="intMecanicoID_mano_obra_ordenes_reparacion_servicio"  
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el costo por hora del mécanico-->
											<input id="txtCosto_mano_obra_ordenes_reparacion_servicio" 
												   name="intCosto_mano_obra_ordenes_reparacion_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtMecanico_mano_obra_ordenes_reparacion_servicio">Mecánico</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMecanico_mano_obra_ordenes_reparacion_servicio" 
													name="strMecanico_mano_obra_ordenes_reparacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese mecánico" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Botón agregar-->
                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                                	<button class="btn btn-primary btn-toolBtns pull-right" 
                                			id="btnAgregar_mano_obra_ordenes_reparacion_servicio" 
                                			onclick="guardar_mano_obra_ordenes_reparacion_servicio();" 
                                	     	title="Agregar" tabindex="1"> 
                                		<span class="glyphicon glyphicon-plus"></span>
                                	</button>
                             	</div>
							</div>
							<div class="form-group row">
								<!--Div que contiene la tabla con los servicios encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_mano_obra_ordenes_reparacion_servicio">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Código</th>
												<th class="movil">Servicio</th>
												<th class="movil">Horas</th>
												<th class="movil">Precio</th>
												<th class="movil">Mecánico</th>
												<th class="movil">Estatus</th>
												<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_mano_obra_ordenes_reparacion_servicio" type="text/template"> 
										{{#rows}}
											<tr class="movil {{estiloRegistro}}">   
												<td class="movil b1">{{codigo}}</td>
												<td class="movil b2">{{descripcion}}</td>
												<td class="movil b3">{{horas}}</td>
												<td class="movil b4">{{precio}}</td>
												<td class="movil b5">{{mecanico}}</td>
												<td class="movil b6">{{estatus}}</td>
												<td class="td-center movil b7"> 
													<!--Editar registro-->
													<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
															onclick="editar_mano_obra_ordenes_reparacion_servicio({{renglon}})"  
															title="Editar">
														<span class="glyphicon glyphicon-edit"></span>
													</button>
													<!--Ver registro-->
					                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
					                            			 onclick="editar_mano_obra_ordenes_reparacion_servicio({{renglon}});" title="Ver">
					                            		<span class="glyphicon glyphicon-eye-open"></span>
					                            	</button>
					                            	<!---Reactivar registro-->
													<button class="btn btn-default btn-xs {{mostrarAccionReactivar}}"  
															onclick="cambiar_estatus_mano_obra_ordenes_reparacion_servicio({{renglon}});"  title="Reactivar">
														<span class="fa fa-undo"></span>
													</button>
													<!--Suspender o finalizar registro-->
													<button class="btn btn-default btn-xs {{mostrarAccionFinalizar}}" 
															onclick="abrir_tiempos_mano_obra_ordenes_reparacion_servicio({{renglon}})" 
															title="Suspender o Finalizar">
														<span class="glyphicon glyphicon-time"></span>
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
										<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_mano_obra_ordenes_reparacion_servicio"></div>
										<!--Número de registros encontrados-->
										<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_mano_obra_ordenes_reparacion_servicio">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Mano de Obra-->
						<!--Tab - Refacciones-->
						<div id="salidas_refacciones_ordenes_reparacion_servicio" class="tab-pane fade">
							<div class="form-group row">
								<!--Div que contiene la tabla con las salidas de refacciones encontradas-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_salidas_refacciones_ordenes_reparacion_servicio">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Folio</th>
												<th class="movil">Fecha</th>
												<th class="movil">Requisición</th>
												<th class="movil">Código</th>
												<th class="movil">Descripción</th>
												<th class="movil">Solicitado</th>
												<th class="movil">Surtido</th>
												<th class="movil">Dev.</th>
												<th class="movil">Cantidad</th>
												<th class="movil">Precio Unit.</th>
												<th class="movil">Total</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_salidas_refacciones_ordenes_reparacion_servicio" type="text/template"> 
										{{#rows}}
											<tr class="movil {{estiloRegistro}}">   
												<td class="movil c1">{{folio}}</td>
												<td class="movil c2">{{fecha}}</td>
												<td class="movil c3">{{folio_requisicion}}</td>
												<td class="movil c4">{{codigo}}</td>
												<td class="movil c5">{{descripcion}}</td>
												<td class="movil c6">{{cantidad_solicitada}}</td>
												<td class="movil c7">{{cantidad_surtida}}</td>
												<td class="movil c8">{{cantidad_devolucion}}</td>
												<td class="movil c9">{{cantidad_facturar}}</td>
												<td class="movil c10">{{precio_unitario}}</td>
												<td class="movil c11">{{total}}</td>
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
												<td class="movil tc1">
													<strong>Total</strong>
												</td>
												<td class="movil tc2"></td>
												<td class="movil tc3"></td>
												<td class="movil tc4"></td>
												<td class="movil tc5"></td>
												<td class="movil tc6"></td>
												<td  class="movil tc7">
													<strong id="acumCantidadSurtida_salidas_refacciones_ordenes_reparacion_servicio">0.00</strong>
												</td>
												<td  class="movil tc8">
													<strong id="acumCantidadDevolucion_salidas_refacciones_ordenes_reparacion_servicio">0.00</strong>
												</td>
												<td  class="movil tc9">
													<strong id="acumCantidadFacturar_salidas_refacciones_ordenes_reparacion_servicio">0.00</strong>
												</td>
												<td class="movil tc10"></td>
												<td class="movil tc11">
													<strong id="acumTotal_salidas_refacciones_ordenes_reparacion_servicio">$0.00</strong>
												</td>
											</tr>
										</tfoot>
									</table>
									<br>
									<!--Diseño de la paginación-->
									<div class="row">
										<!--Páginas-->
										<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_salidas_refacciones_ordenes_reparacion_servicio"></div>
										<!--Número de registros encontrados-->
										<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_salidas_refacciones_ordenes_reparacion_servicio">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Refacciones-->
						<!--Tab - Trabajos Foráneos-->
						<div id="trabajos_foraneos_ordenes_reparacion_servicio" class="tab-pane fade">
							<div class="form-group row">
								<!--Div que contiene la tabla con las salidas de refacciones encontradas-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_trabajos_foraneos_ordenes_reparacion_servicio">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Folio</th>
												<th class="movil">Fecha</th>
												<th class="movil">Concepto</th>
												<th class="movil">Cantidad</th>
												<th class="movil">Precio Unit.</th>
												<th class="movil">Desc.</th>
												<th class="movil">Subtotal</th>
												<th class="movil">IVA</th>
												<th class="movil">IEPS</th>
												<th class="movil">Total</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_trabajos_foraneos_ordenes_reparacion_servicio" type="text/template"> 
										{{#rows}}
											<tr class="movil {{estiloRegistro}}">   
												<td class="movil d1">{{folio}}</td>
												<td class="movil d2">{{fecha}}</td>
												<td class="movil d3">{{concepto}}</td>
												<td class="movil d4">{{cantidad}}</td>
												<td class="movil d5">{{precio_unitario}}</td>
												<td class="movil d6">{{descuento_unitario}}</td>
												<td class="movil d7">{{subtotal}}</td>
												<td class="movil d8">{{importe_iva}}</td>
												<td class="movil d9">{{importe_ieps}}</td>
												<td class="movil d10">{{total}}</td>
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
												<td class="movil td1">
													<strong>Total</strong>
												</td>
												<td class="movil td2"></td>
												<td class="movil td3"></td>
												<td  class="movil td4">
													<strong id="acumCantidad_trabajos_foraneos_ordenes_reparacion_servicio">0.00</strong>
												</td>
												<td class="movil td5"></td>
												<td class="movil td6">
													<strong id="acumDescuento_trabajos_foraneos_ordenes_reparacion_servicio">$0.00</strong>
												</td>
												<td class="movil td7">
													<strong id="acumSubtotal_trabajos_foraneos_ordenes_reparacion_servicio">$0.00</strong>
												</td>
												<td class="movil td8">
													<strong id="acumIva_trabajos_foraneos_ordenes_reparacion_servicio">$0.000000</strong>
												</td>
												<td class="movil td9">
													<strong  id="acumIeps_trabajos_foraneos_ordenes_reparacion_servicio">$0.000000</strong>
												</td>
												<td class="movil td10">
													<strong id="acumTotal_trabajos_foraneos_ordenes_reparacion_servicio">$0.000000</strong>
												</td>
											</tr>
										</tfoot>
									</table>
									<br>
									<!--Diseño de la paginación-->
									<div class="row">
										<!--Páginas-->
										<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_trabajos_foraneos_ordenes_reparacion_servicio"></div>
										<!--Número de registros encontrados-->
										<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_trabajos_foraneos_ordenes_reparacion_servicio">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Trabajos Foráneos -->
					    <!--Tab - Otros-->
						<div id="otros_ordenes_reparacion_servicio" class="tab-pane fade">
							<div class="row">
								<!--Concepto-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
											<input id="txtRenglon_otros_ordenes_reparacion_servicio" name="intRenglon_otros_ordenes_reparacion_servicio"  
												   type="hidden" value="">
										    </input>
											<label for="txtConcepto_otros_ordenes_reparacion_servicio">Concepto</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtConcepto_otros_ordenes_reparacion_servicio"
												   name="strConcepto_otros_ordenes_reparacion_servicio" 
												   type="text" value="" tabindex="1" placeholder="Ingrese concepto" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
						    	<!--Autocomplete que contiene los productos y servicios activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del producto/servicio seleccionado-->
											<input id="txtProductoServicioID_otros_ordenes_reparacion_servicio" 
												   name="intProductoServicioID_otros_ordenes_reparacion_servicio"  
												   type="hidden" value="">
										    </input>
											<label for="txtProductoServicio_otros_ordenes_reparacion_servicio">Código SAT</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtProductoServicio_otros_ordenes_reparacion_servicio" 
													name="strProductoServicio_otros_ordenes_reparacion_servicio" type="text" 
													value="" tabindex="1" placeholder="Ingrese código SAT" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las unidades activas-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la unidad seleccionada-->
											<input id="txtUnidadID_otros_ordenes_reparacion_servicio" 
												   name="intUnidadID_otros_ordenes_reparacion_servicio"  
												   type="hidden" value="">
										    </input>
											<label for="txtUnidad_otros_ordenes_reparacion_servicio">Unidad SAT</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtUnidad_otros_ordenes_reparacion_servicio" 
													name="strUnidad_otros_ordenes_reparacion_servicio" type="text" 
													value="" tabindex="1" placeholder="Ingrese unidad SAT" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los objetos de impuesto-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObjetoImpuesto_otros_ordenes_reparacion_servicio">Objeto de impuesto SAT</label>
										</div>
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del objeto de impuesto seleccionado-->
											<input id="txtObjetoImpuestoID_otros_ordenes_reparacion_servicio" 
												   name="intObjetoImpuestoID_otros_ordenes_reparacion_servicio"  
												   type="hidden" value="">
										    </input>
											<input  class="form-control" id="txtObjetoImpuesto_otros_ordenes_reparacion_servicio" 
													name="strObjetoImpuesto_otros_ordenes_reparacion_servicio" type="text" 
													value="" tabindex="1" placeholder="Ingrese objeto de impuesto SAT" maxlength="250">
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
											<label for="txtCantidad_otros_ordenes_reparacion_servicio">
												Cantidad
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control cantidad_ordenes_reparacion_servicio" 
													id="txtCantidad_otros_ordenes_reparacion_servicio" 
													name="intCantidad_otros_ordenes_reparacion_servicio" 
													type="text" value="" tabindex="1"
													placeholder="Ingrese cantidad" maxlength="15">
											</input>
										</div>
									</div>
								</div>
								<!--Precio unitario-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPrecioUnitario_otros_ordenes_reparacion_servicio">Precio unitario</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control moneda_ordenes_reparacion_servicio" id="txtPrecioUnitario_otros_ordenes_reparacion_servicio" 
													name="intPrecioUnitario_otros_ordenes_reparacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese precio unitario" maxlength="15">
											</input>
										</div>
									</div>
								</div>
								<!--Porcentaje del descuento-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPorcentajeDescuento_otros_ordenes_reparacion_servicio">Descuento %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control cantidad_ordenes_reparacion_servicio" id="txtPorcentajeDescuento_otros_ordenes_reparacion_servicio" 
													name="intPorcentajeDescuento_otros_ordenes_reparacion_servicio" type="text" value="0.00" 
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
											<input id="txtTasaCuotaIva_otros_ordenes_reparacion_servicio" 
												   name="intTasaCuotaIva_otros_ordenes_reparacion_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIva_otros_ordenes_reparacion_servicio">IVA %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIva_otros_ordenes_reparacion_servicio" 
													name="intPorcentajeIva_otros_ordenes_reparacion_servicio" type="text" value="" 
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
											<input id="txtTasaCuotaIeps_otros_ordenes_reparacion_servicio" 
												   name="intTasaCuotaIeps_otros_ordenes_reparacion_servicio" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIeps_otros_ordenes_reparacion_servicio">IEPS %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIeps_otros_ordenes_reparacion_servicio" 
													name="intPorcentajeIeps_otros_ordenes_reparacion_servicio" type="text" value="" 
													tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Botón agregar-->
                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
                                	<button class="btn btn-primary btn-toolBtns pull-right" 
                                			id="btnAgregar_otros_ordenes_reparacion_servicio" 
                                			onclick="agregar_renglon_otros_ordenes_reparacion_servicio();" 
                                	     	title="Agregar" tabindex="1"> 
                                		<span class="glyphicon glyphicon-plus"></span>
                                	</button>
                             	</div>
							</div>
							<div class="form-group row">
								<!--Div que contiene la tabla con los otros servicios encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
										<!-- Diseño de la tabla-->
										<table class="table-hover movil" id="dg_otros_ordenes_reparacion_servicio">
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
													<td class="movil tf1">
														<strong>Total</strong>
													</td>
													<td  class="movil tf2">
														<strong id="acumCantidad_otros_ordenes_reparacion_servicio"></strong>
													</td>
													<td class="movil tf3"></td>
													<td class="movil tf4">
														<strong id="acumDescuento_otros_ordenes_reparacion_servicio"></strong>
													</td>
													<td class="movil tf5">
														<strong id="acumSubtotal_otros_ordenes_reparacion_servicio"></strong>
													</td>
													<td class="movil tf6">
														<strong id="acumIva_otros_ordenes_reparacion_servicio"></strong>
													</td>
													<td class="movil tf7">
														<strong  id="acumIeps_otros_ordenes_reparacion_servicio"></strong>
													</td>
													<td class="movil tf8">
														<strong id="acumTotal_otros_ordenes_reparacion_servicio"></strong>
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
													<strong id="numElementos_otros_ordenes_reparacion_servicio">0</strong> encontrados
												</button>
											</div>
										</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Otros-->
					</div><!--Cierre del contenedor de tabs-->
					<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_ordenes_reparacion_servicio" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_ordenes_reparacion_servicio"  
									onclick="validar_ordenes_reparacion_servicio();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!---Finalizar registro-->
							<button class="btn btn-default" id="btnFinalizar_ordenes_reparacion_servicio"  
									onclick="cambiar_estatus_ordenes_reparacion_servicio('','FINALIZADO', '', '', '');"  title="Finalizar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-time"></span>
							</button>	
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_ordenes_reparacion_servicio"  
									onclick="impresion_formato_ordenes_reparacion_servicio('','');"  title="Imprimir registro en PDF" tabindex="4" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_ordenes_reparacion_servicio"  
									onclick="cambiar_estatus_ordenes_reparacion_servicio('','INACTIVO', '', '', '');"  title="Desactivar" tabindex="5" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_ordenes_reparacion_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_ordenes_reparacion_servicio();" title="Cerrar"  tabindex="6">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Ordenes de Trabajo-->

		<!-- Diseño del modal Tiempos del Servicio de Mano de Obra-->
		<div id="TiempoManoObraOrdenesReparacionServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_tiempos_mano_obra_ordenes_reparacion_servicio" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Suspender o Finalizar Servicio</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmTiempoManoObraOrdenesReparacionServicio" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmTiempoManoObraOrdenesReparacionServicio"  onsubmit="return(false)" autocomplete="off">
			    	<div class="row">
					    <!--Código-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdenReparacionTiempoID_tiempos_mano_obra_ordenes_reparacion_servicio" 
									       name="intOrdenReparacionTiempoID_tiempos_mano_obra_ordenes_reparacion_servicio" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
									<input id="txtRenglon_tiempos_mano_obra_ordenes_reparacion_servicio" 
									       name="intRenglon_tiempos_mano_obra_ordenes_reparacion_servicio" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del servicio seleccionado-->
									<input id="txtServicioID_tiempos_mano_obra_ordenes_reparacion_servicio" 
									       name="intServicioID_tiempos_mano_obra_ordenes_reparacion_servicio" type="hidden" value="">
									</input>
									<label for="txtCodigo_tiempos_mano_obra_ordenes_reparacion_servicio">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_tiempos_mano_obra_ordenes_reparacion_servicio" 
											name="strCodigo_tiempos_mano_obra_ordenes_reparacion_servicio" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Descripción-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_tiempos_mano_obra_ordenes_reparacion_servicio">Servicio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_tiempos_mano_obra_ordenes_reparacion_servicio" 
											name="strDescripcion_tiempos_mano_obra_ordenes_reparacion_servicio" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Horas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHoras_tiempos_mano_obra_ordenes_reparacion_servicio">Horas</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtHoras_tiempos_mano_obra_ordenes_reparacion_servicio" 
											name="intHoras_tiempos_mano_obra_ordenes_reparacion_servicio" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!-- Fecha de inicio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicio_tiempos_mano_obra_ordenes_reparacion_servicio">Fecha de inicio</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaInicio_tiempos_mano_obra_ordenes_reparacion_servicio'>
					                    <input class="form-control" 
					                    		id="txtFechaInicio_tiempos_mano_obra_ordenes_reparacion_servicio"
					                    		name= "strFechaInicio_tiempos_mano_obra_ordenes_reparacion_servicio" 
					                    		type="text"  value="" disabled />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Usuario de inicio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuarioInicio_tiempos_mano_obra_ordenes_reparacion_servicio">Usuario de inicio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuarioInicio_tiempos_mano_obra_ordenes_reparacion_servicio" 
											name="strUsuarioInicio_tiempos_mano_obra_ordenes_reparacion_servicio" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!-- Fecha de suspensión-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaSuspension_tiempos_mano_obra_ordenes_reparacion_servicio">Fecha de suspensión</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaSuspension_tiempos_mano_obra_ordenes_reparacion_servicio'>
					                    <input class="form-control" 
					                    		id="txtFechaSuspension_tiempos_mano_obra_ordenes_reparacion_servicio"
					                    		name= "dteFechaSuspension_tiempos_mano_obra_ordenes_reparacion_servicio" 
					                    		type="text"  value="" disabled />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Usuario de suspensión-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuarioSuspension_tiempos_mano_obra_ordenes_reparacion_servicio">Usuario de suspensión</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuarioSuspension_tiempos_mano_obra_ordenes_reparacion_servicio" 
											name="strUsuarioSuspension_tiempos_mano_obra_ordenes_reparacion_servicio" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
				    </div>
			    	<div class="row">
				    	<!--Autocomplete que contiene los motivos de suspensión activos-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del motivo de suspensión seleccionado-->
									<input id="txtMotivoSuspensionID_tiempos_mano_obra_ordenes_reparacion_servicio" 
									       name="intMotivoSuspensionID_tiempos_mano_obra_ordenes_reparacion_servicio" type="hidden" value="">
									</input>
									<label for="txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio">Motivo de suspensión</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio" 
												name="strMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio" type="text" value="" 
												tabindex="1" placeholder="Ingrese motivo de suspensión" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Tiempo-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTiempo_tiempos_mano_obra_ordenes_reparacion_servicio">Tiempo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTiempo_tiempos_mano_obra_ordenes_reparacion_servicio" 
											name="intTiempo_tiempos_mano_obra_ordenes_reparacion_servicio" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Botón agregar-->
                      	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                        	<button class="btn btn-primary btn-toolBtns pull-right" 
                        			id="btnAgregar_tiempos_mano_obra_ordenes_reparacion_servicio" 
                        			onclick="guardar_tiempos_mano_obra_ordenes_reparacion_servicio();" 
                        	     	title="Agregar" tabindex="1"> 
                        		<span class="glyphicon glyphicon-plus"></span>
                        	</button>
                     	</div>
				    </div>
				    <div class="form-group row">
						<!--Div que contiene la tabla con los tiempos encontrados-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_tiempos_mano_obra_ordenes_reparacion_servicio">
								<thead class="movil">
									<tr class="movil">
										<th class="movil">Fecha de inicio</th>
										<th class="movil">Motivo de suspensión</th>
										<th class="movil">Fecha de suspensión</th>
										<th class="movil">Tiempo</th>
										<th class="movil">Estatus</th>
										<th class="movil" id="th-acciones" style="width:4em;">Acciones</th>
									</tr>
								</thead>
								<tbody class="movil"></tbody>
								<script id="plantilla_tiempos_mano_obra_ordenes_reparacion_servicio" type="text/template"> 
								{{#rows}}
									<tr class="movil {{estiloRegistro}}">   
										<td class="movil e1">{{fecha_inicio}}</td>
										<td class="movil e2">{{motivo_suspension}}</td>
										<td class="movil e3">{{fecha_suspension}}</td>
										<td class="movil e4">{{tiempo}}</td>
										<td class="movil e5">{{estatus}}</td>
										<td class="td-center movil e6"> 
											<!--Editar registro-->
											<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
													onclick="editar_tiempos_mano_obra_ordenes_reparacion_servicio({{orden_reparacion_tiempo_id}})"  
													title="Editar">
												<span class="glyphicon glyphicon-edit"></span>
											</button>
											<!--Ver registro-->
			                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
			                            			 onclick="editar_tiempos_mano_obra_ordenes_reparacion_servicio({{orden_reparacion_tiempo_id}});" title="Ver">
			                            		<span class="glyphicon glyphicon-eye-open"></span>
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
							<div class="row">
								<!--Número de registros encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<button class="btn btn-default btn-sm disabled pull-right">
										<strong id="numElementos_tiempos_mano_obra_ordenes_reparacion_servicio">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_tiempos_mano_obra_ordenes_reparacion_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_tiempos_mano_obra_ordenes_reparacion_servicio();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Tiempos del Servicio de Mano de Obra-->
	</div><!--#OrdenesReparacionServicioContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros de ordenes de reparación
		var intPaginaOrdenesReparacionServicio = 0;
		var strUltimaBusquedaOrdenesReparacionServicio = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
		var strTipoReferenciaOrdenesReparacionServicio = "ORDEN DE TRABAJO";
		//Variable que se utiliza para asignar el valor del impuesto IVA
		var intIvaOrdenesReparacionServicio = <?php echo IVA ?>;
		//Variable que se utiliza para asignar el valor del porcentaje de IVA
		var intPorcentajeIvaOrdenesReparacionServicio = <?php echo PORCENTAJE_IVA ?>;
		//Variable que se utiliza para asignar el id del tipo de servicio: Garantía
		var intServicioTipoIDGarantiaOrdenesReparacionServicio = <?php echo TIPO_SERVICIO_GARANTIA ?>;
		//Variable que se utiliza para asignar el id del objeto de impuesto base
		var intObjetoImpuestoBaseIDOrdenesReparacionServicio = <?php echo OBJETOIMP_BASE ?>;
		//Variables que se utilizan para la paginación de registros de mano de obra
		var intPaginaManoObraOrdenesReparacionServicio = 0;
		var strUltimaBusquedaManoObraOrdenesReparacionServicio = "";
		//Variables que se utilizan para la paginación de registros de salidas de refacciones por taller
		var intPaginaSalidasRefaccionesOrdenesReparacionServicio = 0;
		var strUltimaBusquedaSalidasRefaccionesOrdenesReparacionServicio = "";
		//Variables que se utilizan para la paginación de registros de trabajos foráneos
		var intPaginaTrabajosForaneosOrdenesReparacionServicio = 0;
		var strUltimaBusquedaTrabajosForaneosOrdenesReparacionServicio = "";
		//Variables que se utilizan para la paginación de registros de tiempos de mano de obra
		var intPaginaTiemposManoObraOrdenesReparacionServicio = 0;
		var strUltimaBusquedaTiemposManoObraOrdenesReparacionServicio = "";
		//Variable que se utiliza para asignar objeto del modal Impresión de Formato
		var objFormatoOrdenesReparacionServicio = null;
		//Variable que se utiliza para asignar objeto del modal Ordenes de Trabajo
		var objOrdenesReparacionServicio = null;
		//Variable que se utiliza para asignar objeto del modal Tiempos del Servicio de Mano de Obra
		var objTiempoManoObraOrdenesReparacionServicio = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para desglosar el IVA del gasto de servicio
		var arrDesglosarIvaGastoOrdenesReparacionServicio  = {gasto: '#txtGastosServicio_ordenes_reparacion_servicio',
															 porcentajeIva: intPorcentajeIvaOrdenesReparacionServicio,
															 iva: intIvaOrdenesReparacionServicio,
															 gastoSubtotal: '#txtGastosServicioSubtotal_ordenes_reparacion_servicio',
															 gastoIva: '#txtGastosServicioIva_ordenes_reparacion_servicio'
															};

		
		/*******************************************************************************************************************
		Funciones del objeto Otros servicios de la orden de reparación
		*********************************************************************************************************************/
		// Constructor del objeto otros servicios
		var objOtrosOrdenOrdenesReparacionServicio;
		function OtrosOrdenOrdenesReparacionServicio(detalles)
		{
			this.arrDetalles = detalles;
		}

		//Función para obtener otros servicios de la orden de reparación
		OtrosOrdenOrdenesReparacionServicio.prototype.getDetalles = function() {
		    return this.arrDetalles;
		}

		//Función para agregar un detalle al objeto 
		OtrosOrdenOrdenesReparacionServicio.prototype.setDetalle = function (detalle){
			this.arrDetalles.push(detalle);
		}

		//Función para obtener un detalle del objeto
		OtrosOrdenOrdenesReparacionServicio.prototype.getDetalle = function(index) {
		    return this.arrDetalles[index];
		}

		//Función para modificar un detalle del objeto
		OtrosOrdenOrdenesReparacionServicio.prototype.modificarDetalle = function (index, detalle){
			this.arrDetalles[index] = detalle;
		}

		//Función para eliminar un detalle del objeto
		OtrosOrdenOrdenesReparacionServicio.prototype.eliminarDetalle = function (index){
			if(index != -1) 
			{
				this.arrDetalles.splice(index, 1);
			}
		}

		//Función para cambiar las posiciones de los detalles en el objeto
		OtrosOrdenOrdenesReparacionServicio.prototype.swap = function(index_A, index_B) {
		    var input = this.arrDetalles;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		/*******************************************************************************************************************
		Funciones del objeto Otro servicio de la orden de reparación
		*********************************************************************************************************************/
		//Constructor del objeto otro servicio
		var objOtroOrdenOrdenesReparacionServicio;
		function OtroOrdenOrdenesReparacionServicio(concepto, productoServicioID, productoServicio, unidadID, unidad,
													objetoImpuestoID, objetoImpuesto, cantidad,  precioUnitario, porcentajeDescuento, 
										            descuentoUnitario, tasaCuotaIva, porcentajeIva, ivaUnitario, 
										            tasaCuotaIeps, porcentajeIeps, iepsUnitario)
		{
		   
		    this.strConcepto = concepto;
		    this.intProductoServicioID = productoServicioID;
		    this.strProductoServicio = productoServicio;
		    this.intUnidadID = unidadID;
		    this.strUnidad = unidad;
		    this.intObjetoImpuestoID = objetoImpuestoID;
		    this.strObjetoImpuesto = objetoImpuesto;
		    this.intCantidad = cantidad;
		    this.intPrecioUnitario = precioUnitario;
		    this.intPorcentajeDescuento = porcentajeDescuento;
		    this.intDescuentoUnitario = descuentoUnitario;
		    this.intTasaCuotaIva = tasaCuotaIva;
		    this.intPorcentajeIva = porcentajeIva;
		    this.intIvaUnitario = ivaUnitario;
		    this.intTasaCuotaIeps = tasaCuotaIeps;
		    this.intPorcentajeIeps = porcentajeIeps;
		    this.intIepsUnitario = iepsUnitario;
		}

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_ordenes_reparacion_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/ordenes_reparacion/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_ordenes_reparacion_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosOrdenesReparacionServicio = data.row;
					//Separar la cadena 
					var arrPermisosOrdenesReparacionServicio = strPermisosOrdenesReparacionServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosOrdenesReparacionServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosOrdenesReparacionServicio[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_ordenes_reparacion_servicio').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosOrdenesReparacionServicio[i]=='GUARDAR') || (arrPermisosOrdenesReparacionServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_ordenes_reparacion_servicio').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesReparacionServicio[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_ordenes_reparacion_servicio').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_ordenes_reparacion_servicio();
						}
						else if(arrPermisosOrdenesReparacionServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_ordenes_reparacion_servicio').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesReparacionServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_ordenes_reparacion_servicio').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesReparacionServicio[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_ordenes_reparacion_servicio').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesReparacionServicio[i]=='FINALIZAR ORDEN DE REPARACION')//Si el indice es FINALIZAR ORDEN DE REPARACION
						{
							//Habilitar el control (botón finalizar)
							$('#btnFinalizar_ordenes_reparacion_servicio').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesReparacionServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_ordenes_reparacion_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_ordenes_reparacion_servicio() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaOrdenesReparacionServicio =($('#txtFechaInicialBusq_ordenes_reparacion_servicio').val()+$('#txtFechaFinalBusq_ordenes_reparacion_servicio').val()+$('#txtProspectoIDBusq_ordenes_reparacion_servicio').val()+$('#cmbEstatusBusq_ordenes_reparacion_servicio').val()+$('#txtBusqueda_ordenes_reparacion_servicio').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaOrdenesReparacionServicio != strUltimaBusquedaOrdenesReparacionServicio)
			{
				intPaginaOrdenesReparacionServicio = 0;
				strUltimaBusquedaOrdenesReparacionServicio = strNuevaBusquedaOrdenesReparacionServicio;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/ordenes_reparacion/get_paginacion',
				    {//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				     dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_reparacion_servicio').val()),
				     dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_reparacion_servicio').val()),
				     intProspectoID: $('#txtProspectoIDBusq_ordenes_reparacion_servicio').val(),
				     strEstatus:     $('#cmbEstatusBusq_ordenes_reparacion_servicio').val(),
						strBusqueda:    $('#txtBusqueda_ordenes_reparacion_servicio').val(),
					 intPagina:intPaginaOrdenesReparacionServicio,
					 strPermisosAcceso: $('#txtAcciones_ordenes_reparacion_servicio').val()
					},
					function(data){
						$('#dg_ordenes_reparacion_servicio tbody').empty();
						var tmpOrdenesReparacionServicio = Mustache.render($('#plantilla_ordenes_reparacion_servicio').html(),data);
						$('#dg_ordenes_reparacion_servicio tbody').html(tmpOrdenesReparacionServicio);
						$('#pagLinks_ordenes_reparacion_servicio').html(data.paginacion);
						$('#numElementos_ordenes_reparacion_servicio').html(data.total_rows);
						intPaginaOrdenesReparacionServicio = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_ordenes_reparacion_servicio(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/ordenes_reparacion/';

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
			if ($('#chbImprimirDetalles_ordenes_reparacion_servicio').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_ordenes_reparacion_servicio').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_ordenes_reparacion_servicio').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_reparacion_servicio').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_reparacion_servicio').val()),
										'intProspectoID': $('#txtProspectoIDBusq_ordenes_reparacion_servicio').val(),
										'strEstatus': $('#cmbEstatusBusq_ordenes_reparacion_servicio').val(), 
										'strBusqueda': $('#txtBusqueda_ordenes_reparacion_servicio').val(),
										'strDetalles': $('#chbImprimirDetalles_ordenes_reparacion_servicio').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal Impresión de Formato
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_formato_ordenes_reparacion_servicio()
		{
			//Incializar formulario
			$('#frmFormatoOrdenesReparacionServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_formato_ordenes_reparacion_servicio();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_formato_ordenes_reparacion_servicio');
		}

		//Función que se utiliza para abrir el modal
		function impresion_formato_ordenes_reparacion_servicio(id, estatus)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_formato_ordenes_reparacion_servicio();
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			var strEstatus = '';

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenReparacionID_ordenes_reparacion_servicio').val();
				strEstatus = $('#txtEstatus_ordenes_reparacion_servicio').val();	
			}
			else
			{
				intID = id;
				strEstatus = estatus;
			}


			//Asignar el id del registro seleccionado
			$('#txtOrdenReparacionID_formato_ordenes_reparacion_servicio').val(intID);
			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_formato_ordenes_reparacion_servicio').addClass("estatus-"+strEstatus);

		    //Abrir modal
			objFormatoOrdenesReparacionServicio = $('#FormatoOrdenesReparacionServicioBox').bPopup({
															  appendTo: '#OrdenesReparacionServicioContent', 
								                              contentContainer: 'OrdenesReparacionServicioM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});
			
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_formato_ordenes_reparacion_servicio()
		{
			try {
				//Cerrar modal
				objFormatoOrdenesReparacionServicio.close();	
			}
			catch(err) {}
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_formato_ordenes_reparacion_servicio()
		{
			try
			{
				$('#frmFormatoOrdenesReparacionServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_ordenes_reparacion_servicio() 
		{
			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'servicio/ordenes_reparacion/get_reporte_registro',
							'data' : {
										'strTipoReporte': $("input:radio[name='strTipoReporte_formato_ordenes_reparacion_servicio']:checked").val(),
										'intOrdenReparacionID': $('#txtOrdenReparacionID_formato_ordenes_reparacion_servicio').val()	
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal Ordenes de Trabajo
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_ordenes_reparacion_servicio()
		{
			//Incializar formulario
			$('#frmOrdenesReparacionServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_reparacion_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmOrdenesReparacionServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_ordenes_reparacion_servicio');
		    //Agregar clase disabled disabledTab para deshabilitar los siguientes tabs
		    $('#tabManoObra_ordenes_reparacion_servicio').addClass("disabled disabledTab");
		    $('#tabSalidasRefacciones_ordenes_reparacion_servicio').addClass("disabled disabledTab");
		    $('#tabTrabajosForaneos_ordenes_reparacion_servicio').addClass("disabled disabledTab");
		    $('#tabOtros_ordenes_reparacion_servicio').addClass("disabled disabledTab");
		    //Eliminar los datos de la tabla servicios de mano de obra
		    $('#dg_mano_obra_ordenes_reparacion_servicio tbody').empty();
		    $('#numElementos_mano_obra_ordenes_reparacion_servicio').html(0);
		    $('#pagLinks_mano_obra_ordenes_reparacion_servicio').html(0);
		    //Eliminar los datos de la tabla salidas de refacciones
		    $('#dg_salidas_refacciones_ordenes_reparacion_servicio tbody').empty();
		    $('#acumCantidadSurtida_salidas_refacciones_ordenes_reparacion_servicio').html('0.00');
		    $('#acumCantidadDevolucion_salidas_refacciones_ordenes_reparacion_servicio').html('0.00');
		    $('#acumCantidadFacturar_salidas_refacciones_ordenes_reparacion_servicio').html('0.00');
			$('#acumTotal_salidas_refacciones_ordenes_reparacion_servicio').html('$0.00');
		    $('#numElementos_salidas_refacciones_ordenes_reparacion_servicio').html(0);
		    $('#pagLinks_salidas_refacciones_ordenes_reparacion_servicio').html(0);
		    //Eliminar los datos de la tabla trabajos foráneos
		    $('#dg_trabajos_foraneos_ordenes_reparacion_servicio tbody').empty();
		    $('#acumCantidad_trabajos_foraneos_ordenes_reparacion_servicio').html('0.00');
		    $('#acumDescuento_trabajos_foraneos_ordenes_reparacion_servicio').html('$0.00');
		    $('#acumSubtotal_trabajos_foraneos_ordenes_reparacion_servicio').html('$0.00');
		    $('#acumIva_trabajos_foraneos_ordenes_reparacion_servicio').html('$0.000000');
		    $('#acumIeps_trabajos_foraneos_ordenes_reparacion_servicio').html('$0.000000');
		    $('#acumTotal_trabajos_foraneos_ordenes_reparacion_servicio').html('$0.000000');
		    $('#numElementos_trabajos_foraneos_ordenes_reparacion_servicio').html(0);
		    $('#pagLinks_trabajos_foraneos_ordenes_reparacion_servicio').html(0);
		    //Eliminar los datos de la tabla otros servicios
		    $('#dg_otros_ordenes_reparacion_servicio tbody').empty();
		    $('#acumCantidad_otros_ordenes_reparacion_servicio').html('');
		    $('#acumDescuento_otros_ordenes_reparacion_servicio').html('');
		    $('#acumSubtotal_otros_ordenes_reparacion_servicio').html('');
		    $('#acumIva_otros_ordenes_reparacion_servicio').html('');
		    $('#acumIeps_otros_ordenes_reparacion_servicio').html('');
		    $('#acumTotal_otros_ordenes_reparacion_servicio').html('');
			$('#numElementos_otros_ordenes_reparacion_servicio').html(0);
			//Crear instancia del objeto Otros servicios de la orden de reparación
			objOtrosOrdenOrdenesReparacionServicio = new OtrosOrdenOrdenesReparacionServicio([]);
			//Habilitar todos los elementos del formulario
			$('#frmOrdenesReparacionServicio').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_ordenes_reparacion_servicio').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_ordenes_reparacion_servicio').attr("disabled", "disabled");
			$('#txtFechaFinalizacion_ordenes_reparacion_servicio').attr("disabled", "disabled");
			$('#txtUsuarioFinalizacion_ordenes_reparacion_servicio').attr("disabled", "disabled");
			$('#txtPrecio_mano_obra_ordenes_reparacion_servicio').attr("disabled", "disabled");
			$('#txtHoras_mano_obra_ordenes_reparacion_servicio').attr("disabled", "disabled");
			//Habilitar caja de texto
			$("#txtServicioTipo_ordenes_reparacion_servicio").removeAttr('disabled');
			//Mostrar los siguiente botones
			$("#btnGuardar_ordenes_reparacion_servicio").show();
			//Habilitar los siguientes botones 
			$('#btnAgregar_mano_obra_ordenes_reparacion_servicio').prop('disabled', false);
			$('#btnAgregar_otros_ordenes_reparacion_servicio').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnFinalizar_ordenes_reparacion_servicio").hide();
			$("#btnImprimirRegistro_ordenes_reparacion_servicio").hide();
			$("#btnDesactivar_ordenes_reparacion_servicio").hide();

			//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
		    cargar_objeto_impuesto_base_otros_ordenes_reparacion_servicio();
		}
		

	    //Función para inicializar elementos del tipo de servicio
		function inicializar_servicio_tipo_ordenes_reparacion_servicio()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$("#txtFacturarServicioTipo_ordenes_reparacion_servicio").val('');
			$("#txtSerieReferenciaID_ordenes_reparacion_servicio").val('');
			$("#txtSerie_ordenes_reparacion_servicio").val('');

		}

		//Función para inicializar elementos del prospecto/cliente
		function inicializar_prospecto_ordenes_reparacion_servicio()
		{	
			//Si se cumple la sentencia
			if($("#txtFacturarServicioTipo_ordenes_reparacion_servicio").val() == 'SI'
			   && $("#txtProspectoID_ordenes_reparacion_servicio").val() == '')
			{
				//Limpiar contenido de la caja de texto
				$("#txtSerie_ordenes_reparacion_servicio").val('');
			}

		}
		

		//Función que se utiliza para cerrar el modal
		function cerrar_ordenes_reparacion_servicio()
		{
			try {

				//Hacer un llamado a la función para cerrar modal Tiempos del Servicio de Mano de Obra
				cerrar_tiempos_mano_obra_ordenes_reparacion_servicio();
				//Hacer un llamado a la función para cerrar modal Impresión de Formato
				cerrar_formato_ordenes_reparacion_servicio();
				//Cerrar modal
				objOrdenesReparacionServicio.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_reparacion_servicio').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_ordenes_reparacion_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_reparacion_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmOrdenesReparacionServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_ordenes_reparacion_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strServicioTipo_ordenes_reparacion_servicio: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de servicio
					                                    if($('#txtServicioTipoID_ordenes_reparacion_servicio').val() === '')
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
										strProspecto_ordenes_reparacion_servicio: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del prospecto
					                                    if($('#txtProspectoID_ordenes_reparacion_servicio').val() === '')
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
										strEquipoTipo_ordenes_reparacion_servicio: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de equipo
					                                    if($('#txtEquipoTipoID_ordenes_reparacion_servicio').val() === '')
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
										strMaquinariaDescripcion_ordenes_reparacion_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la descripción de maquinaria
					                                    if($('#txtMaquinariaDescripcionID_ordenes_reparacion_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una descripción existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intGastosServicio_ordenes_reparacion_servicio: {
											validators: {
												notEmpty: {message: 'Escriba un importe'}
											}
										},
										strUbicacion_ordenes_reparacion_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una ubicación'}
											}
										},
										strTipoReparacion_ordenes_reparacion_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo de reparación'}
											}
										},
										strFalla_ordenes_reparacion_servicio: {
											validators: {
												notEmpty: {message: 'Escriba una falla'}
											}
										},
										strCodigo_mano_obra_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
					                    strDescripcion_mano_obra_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intHoras_mano_obra_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecio_mano_obra_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strMecanico_mano_obra_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strConcepto_otros_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strProductoServicio_otros_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strUnidad_otros_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strObjetoImpuesto_otros_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_otros_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_otros_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_otros_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_otros_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIeps_otros_ordenes_reparacion_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_ordenes_reparacion_servicio = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_ordenes_reparacion_servicio = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_ordenes_reparacion_servicio.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_ordenes_reparacion_servicio.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_ordenes_reparacion_servicio = $('#frmOrdenesReparacionServicio').data('bootstrapValidator');
			bootstrapValidator_ordenes_reparacion_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_ordenes_reparacion_servicio.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_ordenes_reparacion_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_ordenes_reparacion_servicio()
		{
			try
			{
				$('#frmOrdenesReparacionServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_ordenes_reparacion_servicio()
		{	

			//Hacer un llamado a la función JSON para guardar los otros servicios de la orden de reparación
			var jsonOtros = JSON.stringify(objOtrosOrdenOrdenesReparacionServicio); 

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('servicio/ordenes_reparacion/guardar',
					{ 
						intOrdenReparacionID: $('#txtOrdenReparacionID_ordenes_reparacion_servicio').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_ordenes_reparacion_servicio').val()),
						intServicioTipoID: $('#txtServicioTipoID_ordenes_reparacion_servicio').val(),
						strTipoReparacion: $('#cmbTipoReparacion_ordenes_reparacion_servicio').val(),
						strUbicacion: $('#cmbUbicacion_ordenes_reparacion_servicio').val(),
						intProspectoID: $('#txtProspectoID_ordenes_reparacion_servicio').val(),
						strSerie: $('#txtSerie_ordenes_reparacion_servicio').val(),
						strMotor: $('#txtMotor_ordenes_reparacion_servicio').val(),
						intEquipoTipoID: $('#txtEquipoTipoID_ordenes_reparacion_servicio').val(),
						intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_ordenes_reparacion_servicio').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intHoras:  $.reemplazar($('#txtHoras_ordenes_reparacion_servicio').val(), ",", ""),
						strFalla: $('#txtFalla_ordenes_reparacion_servicio').val(),
						strCausa: $('#txtCausa_ordenes_reparacion_servicio').val(),
						strSolucion: $('#txtSolucion_ordenes_reparacion_servicio').val(),
						intGastosServicio: $('#txtGastosServicioSubtotal_ordenes_reparacion_servicio').val(),
						intGastosServicioIva: $('#txtGastosServicioIva_ordenes_reparacion_servicio').val(),
						strObservaciones: $('#txtObservaciones_ordenes_reparacion_servicio').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_ordenes_reparacion_servicio').val(),
						//Datos de los detalles (otros servicios)
						arrOtros: jsonOtros
					},
					function(data) {
						if (data.resultado)
						{
							//Si no existe id de la orden de reparación, significa que es un nuevo registro
							if($('#txtOrdenReparacionID_ordenes_reparacion_servicio').val() == '')
							{
								//Hacer un llamado a la función para recuperar los datos de la orden de reparación registrada en la base de datos
								editar_ordenes_reparacion_servicio(data.orden_reparacion_id, 'Nuevo');
								//Seleccionar tab que contiene la información de la mano de obra
								$('a[href="#mano_obra_ordenes_reparacion_servicio"]').click();
							}
							else
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_ordenes_reparacion_servicio();
							}       

							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_ordenes_reparacion_servicio();            
							
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_reparacion_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
			
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_ordenes_reparacion_servicio(tipoMensaje, mensaje)
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
			else if(tipoMensaje == 'informacion_mano_obra')
            { 
                //Indicar al usuario el mensaje de información
                new $.Zebra_Dialog(mensaje, {
	                                'type': 'information',
	                                'title': 'Información',
	                                'buttons': [{caption: 'Aceptar',
	                                             callback: function () {
													//Hacer un llamado a la función para limpiar los campos del formulario
													nuevo_mano_obra_ordenes_reparacion_servicio(); 
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
		function cambiar_estatus_ordenes_reparacion_servicio(id, estatus, totalServiciosNoFinalizados, serie, facturarServicioTipo)
		{ 

			//Variable que se utiliza para generar póliza en caso de que el tipo de servicio no se facture
			var strGenerarPoliza = 'NO';
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Variable que se utiliza para asignar serie
		    var strSerieOrden = '';
			//Variable que se utiliza para asignar el total de servicios de mano de obra
		    var intTotalServiciosManoObra = 0;
		    //Variable que se utiliza para saber si el tipo de servicio se facturara
		    var strFacturarServicioTipo = '';
			//Variable que se utiliza para cambiar el título del mensaje
			var strTituloMensaje = '';
			//Variable que se utiliza para cambiar el mensaje
			var strMensaje = '';
			//Variable que se utiliza para permitir modificar el estatus del registro
			var strPermitirCambiarEstatus = 'SI';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenReparacionID_ordenes_reparacion_servicio').val();
				intTotalServiciosManoObra = $('#numElementos_mano_obra_ordenes_reparacion_servicio').html();
				strSerieOrden = $('#txtSerie_ordenes_reparacion_servicio').val();
				strFacturarServicioTipo = $('#txtFacturarServicioTipo_ordenes_reparacion_servicio').val();

			}
			else
			{
				intID = id;
				intTotalServiciosManoObra = totalServiciosNoFinalizados; 
				strSerieOrden = serie;
				strFacturarServicioTipo = facturarServicioTipo;
				strTipo = 'gridview';
			}

	       	//Dependiendo del estatus cambiar el título y mensaje de la alerta
	    	if(estatus == 'INACTIVO')
	    	{
	    		strTituloMensaje = 'Ordenes de Trabajo';
	    		strMensaje =  '¿Está seguro que desea desactivar el registro?';
	    	}
	    	else if(estatus == 'FINALIZADO')
	    	{
	    		strTituloMensaje = 'Finalizar Ordenes de Trabajo';
	    		
	    		
	    		//Si existen servicio de mano de obra o no existe serie
	    		if(intTotalServiciosManoObra > 0 || strSerieOrden == '')
	    		{	
	    			//Si no existe serie
	    			if(strSerieOrden == '')
	    			{
	    				strMensaje += '<li> Escriba una serie existente. </li>';
	    			}

	    			//Si existen servicio de mano de obra
	    			if(intTotalServiciosManoObra > 0)
	    			{

	    				//Si no existe id, significa que se realizará la verificación de servicios desde el modal
		    			if(id == '')
		    			{

		    				//Asignar mensaje de verificación de servicios finalizados
		    				strMensaje += validar_servicios_finalizados_mano_obra_ordenes_reparacion_servicio();
		    			}
		    			else
		    			{
		    				//Asignar mensaje para informar al usuario la existencia de servicios no finalizados
		    				strMensaje += '<li> Existen servicios que no se encuentran finalizados, favor de verificar. </li>'
		    			}
	    			}

	    			//Si existen errores de validación
	    			if(strMensaje != '')
	    			{
	    			 	//Concatenar referencia del mensaje de validación
	    			 	strMensaje = '<ul><b>No es posible finalizar esta orden de trabajo:</b>'+strMensaje;
	    			  	strMensaje += '</ul>';
	    			}
	    			
	    			
	    		}

	    		

	    		//Si existen servicios de mano de obra no finalizados
	    		if(strMensaje != '')
	    		{
	    			//Asignar NO para evitar cambiar el estatus del registro
	    			strPermitirCambiarEstatus = 'NO';

	    			//Hacer un llamado a la función para mostrar mensaje de error
					mensaje_ordenes_reparacion_servicio('error', strMensaje);
	    		}
	    		else
	    		{
	    			strMensaje =  '¿Está seguro que desea finalizar esta orden de trabajo?';
	    		}
	    	}
	    	
	    	//Si se cumple la regla de validación
	    	if(strPermitirCambiarEstatus == 'SI')
	    	{
	    		//Preguntar al usuario si desea modificar el estatus del registro
				new $.Zebra_Dialog('<strong>'+strMensaje+'</strong>',
				             {'type':     'question',
				              'title':    strTituloMensaje,
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus
				                              $.post('servicio/ordenes_reparacion/set_estatus',
				                                     {intOrdenReparacionID: intID,
				                                      strEstatus: estatus,
				                                      strSerie: strSerieOrden
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                            //Hacer llamado a la función  para cargar  los registros en el grid
				                                            paginacion_ordenes_reparacion_servicio();

				                                            //Si se cumple la sentencia
															if(estatus == 'FINALIZADO' && strFacturarServicioTipo == 'NO')
															{
																//Asignar SI para generar póliza del registro
																strGenerarPoliza = 'SI';
																//Hacer un llamado a la función para generar póliza con los datos del registro
																generar_poliza_ordenes_reparacion_servicio(intID, strTipo);
															}	
															else
															{
																//Si el id del registro se obtuvo del modal
																if(strTipo == 'modal')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_ordenes_reparacion_servicio();     
																}
															}
				                                        }

				                                       //Si se cumple la sentencia
				                                        if(strGenerarPoliza == 'NO' || data.tipo_mensaje == 'error')
				                                        {
				                                        	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_ordenes_reparacion_servicio(data.tipo_mensaje, data.mensaje);
				                                        }
					                                        
					                                    
				                                     },
				                                    'json');
				                            }
				                        }
				              });

	    	}
		   
		}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_ordenes_reparacion_servicio(id, tipo)
		{

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_ordenes_reparacion_servicio(tipo);

			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: id,
		      	strTipoReferencia: strTipoReferenciaOrdenesReparacionServicio, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_ordenes_reparacion_servicio').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_ordenes_reparacion_servicio(tipo);
			    //Si existe resultado
				if (data.resultado)
				{
					
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_ordenes_reparacion_servicio();

					//Si el id del registro se obtuvo del modal
					if(tipo == 'modal')
					{
						//Hacer un llamado a la función para cerrar modal
						cerrar_ordenes_reparacion_servicio();     
					}

				}

		      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		        mensaje_ordenes_reparacion_servicio(data.tipo_mensaje, data.mensaje);
				
		     },
		     'json');

		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function mostrar_circulo_carga_ordenes_reparacion_servicio(tipo)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_ordenes_reparacion_servicio';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(tipo == 'gridview')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_ordenes_reparacion_servicio';
			}


			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}


		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function ocultar_circulo_carga_ordenes_reparacion_servicio(tipo)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_ordenes_reparacion_servicio';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(tipo == 'gridview')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_ordenes_reparacion_servicio';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}



		//Función que se utiliza para validar que todos los servicios de mano de obra esten finalizados
		function validar_servicios_finalizados_mano_obra_ordenes_reparacion_servicio()
		{
			//Obtenemos el objeto de la tabla servicios de mano de obra
			var objTabla = document.getElementById('dg_mano_obra_ordenes_reparacion_servicio').getElementsByTagName('tbody')[0];

			//Array que se utiliza para agregar los servicios que no se encuentran finalizados
			var arrServiciosNoFinalizados = [];

			//Mensaje que se utiliza para informar al usuario la lista de servicios que no estan finalizados
			var strMensaje = '';

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var strCodigo = objRen.cells[0].innerHTML;
				var strDescripcion = objRen.cells[1].innerHTML;
				var strEstatus = objRen.cells[5].innerHTML;
				//Concatenar datos del servicio
				var strServicio =  strCodigo+' - '+strDescripcion;
				//Concatenar el estatus del servicio
				strServicio+= ' estatus: '+strEstatus;

				//Si el estatus del servicio es diferente de FINALIZADO
				if(strEstatus !== 'FINALIZADO')
				{
					//Agregar servicio en el array, de esta manera, el usuario identificara los servicios que no se encuentran finalizados
					arrServiciosNoFinalizados.push(strServicio);
				}
			}

			//Si existen servicios no finalizados
			if(arrServiciosNoFinalizados.length > 0)
			{
				//Mensaje que se utiliza para informar al usuario la lista de servicios sin finalizar
		    	strMensaje = strMensaje + 'Los siguientes <b>servicios</b> no se encuentran finalizados:<br>';

		    	//Hacer recorrido para obtener servicios no finalizados
				for(var intCont = 0; intCont < arrServiciosNoFinalizados.length; intCont++)
				{
					//Agregar concepto en el mensaje
            		strMensaje = strMensaje + arrServiciosNoFinalizados[intCont] + '<br/>';
				}
				
			}

			//Regresar mensaje informativo
			return strMensaje;
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ordenes_reparacion_servicio(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/ordenes_reparacion/get_datos',
			       {
			       		intOrdenReparacionID: id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ordenes_reparacion_servicio();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				             //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';

				          	//Recuperar valores
				          	$('#txtOrdenReparacionID_ordenes_reparacion_servicio').val(data.row.orden_reparacion_id);
				            $('#txtFolio_ordenes_reparacion_servicio').val(data.row.folio);
						    $('#txtFecha_ordenes_reparacion_servicio').val(data.row.fecha);
						    $('#txtServicioTipoID_ordenes_reparacion_servicio').val(data.row.servicio_tipo_id);
						    $('#txtServicioTipo_ordenes_reparacion_servicio').val(data.row.servicio_tipo);
						    $('#txtFacturarServicioTipo_ordenes_reparacion_servicio').val(data.row.facturar_servicio_tipo);
						    $('#cmbTipoReparacion_ordenes_reparacion_servicio').val(data.row.tipo_reparacion);
						    $('#cmbUbicacion_ordenes_reparacion_servicio').val(data.row.ubicacion);
						    $('#txtProspectoID_ordenes_reparacion_servicio').val(data.row.prospecto_id);
						    $('#txtProspecto_ordenes_reparacion_servicio').val(data.row.prospecto);
						    $('#txtSerieReferenciaID_ordenes_reparacion_servicio').val(data.row.serie);
						    $('#txtSerie_ordenes_reparacion_servicio').val(data.row.serie);
						    $('#txtMotor_ordenes_reparacion_servicio').val(data.row.motor);
						    $('#txtEquipoTipoID_ordenes_reparacion_servicio').val(data.row.equipo_tipo_id);
						    $('#txtEquipoTipo_ordenes_reparacion_servicio').val(data.row.equipo_tipo);
						    $('#txtMaquinariaDescripcionID_ordenes_reparacion_servicio').val(data.row.maquinaria_descripcion_id);
						    $('#txtMaquinariaDescripcion_ordenes_reparacion_servicio').val(data.row.maquinaria_descripcion);
						    $('#txtHoras_ordenes_reparacion_servicio').val(data.row.horas);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtHoras_ordenes_reparacion_servicio').formatCurrency({ roundToDecimalPlace: 2 });
						    $('#txtFalla_ordenes_reparacion_servicio').val(data.row.falla);
						    $('#txtCausa_ordenes_reparacion_servicio').val(data.row.causa);
						    $('#txtSolucion_ordenes_reparacion_servicio').val(data.row.solucion);
						    $('#txtObservaciones_ordenes_reparacion_servicio').val(data.row.observaciones);

						    //Variables que se utilizan para asignar valores del gasto de servicio
							var intGastosServicioSubtotal = parseFloat(data.row.gastos_servicio);
							var intGastosServicioIva = parseFloat(data.row.gastos_servicio_iva);
							//Calcular el importe total del gasto de servicio
						    var intGastosServicioTotal = intGastosServicioSubtotal + intGastosServicioIva;

						    $('#txtGastosServicioIva_ordenes_reparacion_servicio').val(intGastosServicioIva);
						    $('#txtGastosServicioSubtotal_ordenes_reparacion_servicio').val(intGastosServicioSubtotal);
						    $('#txtGastosServicio_ordenes_reparacion_servicio').val(intGastosServicioTotal);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtGastosServicio_ordenes_reparacion_servicio').formatCurrency({ roundToDecimalPlace: 2 });
						    $('#txtFechaFinalizacion_ordenes_reparacion_servicio').val(data.row.fecha_finalizacion);
						    $('#txtUsuarioFinalizacion_ordenes_reparacion_servicio').val(data.row.usuario_finalizacion);
						    $('#txtEstatus_ordenes_reparacion_servicio').val(strEstatus);
						    //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_ordenes_reparacion_servicio').addClass("estatus-"+strEstatus);
							//Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_ordenes_reparacion_servicio").show();

						    //Deshabilitar caja de texto
						    $("#txtServicioTipo_ordenes_reparacion_servicio").attr('disabled','disabled');
						    
						    //Quitar clase disabled disabledTab para habilitar los siguientes tabs
						    $('#tabManoObra_ordenes_reparacion_servicio').removeClass("disabled disabledTab");
						    $('#tabSalidasRefacciones_ordenes_reparacion_servicio').removeClass("disabled disabledTab");
				            $('#tabTrabajosForaneos_ordenes_reparacion_servicio').removeClass("disabled disabledTab");
				            $('#tabOtros_ordenes_reparacion_servicio').removeClass("disabled disabledTab"); 
				            //Hacer llamado a la función  para cargar los servicios de mano de obra en el grid
				            paginacion_mano_obra_ordenes_reparacion_servicio();
				            //Hacer llamado a la función  para cargar las salidas de refacciones por taller en el grid
				            paginacion_salidas_refacciones_ordenes_reparacion_servicio();
				            //Hacer llamado a la función  para cargar los trabajos foráneos en el grid
				            paginacion_trabajos_foraneos_ordenes_reparacion_servicio();
				           
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
													" onclick='editar_renglon_otros_ordenes_reparacion_servicio(this)'>" + 
													"<span class='glyphicon glyphicon-edit'></span></button>" + 
													"<button class='btn btn-default btn-xs' title='Eliminar'" +
													" onclick='eliminar_renglon_otros_ordenes_reparacion_servicio(this)'>" + 
													"<span class='glyphicon glyphicon-trash'></span></button>" + 
													"<button class='btn btn-default btn-xs up' title='Subir'>" + 
													"<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													"<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													"<span class='glyphicon glyphicon-arrow-down'></span></button>";

								//Mostrar los siguientes botones
				            	$("#btnDesactivar_ordenes_reparacion_servicio").show();

				            	//Si no existen requisiciones de refacciones ACTIVAS O PARCIALMENTE SURTIDO 
				            	if(data.row.total_requisiciones == 0)
				            	{
				            	 	$("#btnFinalizar_ordenes_reparacion_servicio").show();
				            	}
							}
							else 
							{
								//Deshabilitar todos los elementos del formulario
			            		$('#frmOrdenesReparacionServicio').find('input, textarea, select').attr('disabled','disabled');
			            		//Deshabilitar los siguientes botones
			            		$('#btnAgregar_mano_obra_ordenes_reparacion_servicio').prop('disabled', true);
			            		$('#btnAgregar_otros_ordenes_reparacion_servicio').prop('disabled', true);
			            		//Ocultar los siguientes botones
				           		$("#btnGuardar_ordenes_reparacion_servicio").hide(); 
							}			            	


							//Mostramos los detalles (otros servicios) del registro
				           	for (var intCon in data.otros) 
				            {
				            	//Variable que se utiliza para asignar el renglón del detalle
								var intRenglon = data.otros[intCon].renglon;
								//Crear instancia del objeto Otro servicio de la orden de reparación
								objOtroOrdenOrdenesReparacionServicio = new OtroOrdenOrdenesReparacionServicio('', '', '', '', 
																									           '', '',  '',  '', 
																									           '', '', '', '', 
																									           '', '', '','', '');

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

								//Asignar valores al objeto
								objOtroOrdenOrdenesReparacionServicio.strConcepto = data.otros[intCon].concepto;
								objOtroOrdenOrdenesReparacionServicio.intProductoServicioID = data.otros[intCon].producto_servicio_id;
								objOtroOrdenOrdenesReparacionServicio.strProductoServicio = data.otros[intCon].producto_servicio;
								objOtroOrdenOrdenesReparacionServicio.intUnidadID = data.otros[intCon].unidad_id;
								objOtroOrdenOrdenesReparacionServicio.strUnidad = data.otros[intCon].unidad;
								objOtroOrdenOrdenesReparacionServicio.intObjetoImpuestoID = data.otros[intCon].objeto_impuesto_id;
								objOtroOrdenOrdenesReparacionServicio.strObjetoImpuesto = data.otros[intCon].objeto_impuesto;
								objOtroOrdenOrdenesReparacionServicio.intCantidad = intCantidad;
								objOtroOrdenOrdenesReparacionServicio.intPrecioUnitario = data.otros[intCon].precio_unitario;
								objOtroOrdenOrdenesReparacionServicio.intPorcentajeDescuento = intPorcentajeDescuento;
								objOtroOrdenOrdenesReparacionServicio.intDescuentoUnitario = data.otros[intCon].descuento_unitario;
								objOtroOrdenOrdenesReparacionServicio.intTasaCuotaIva = data.otros[intCon].tasa_cuota_iva;;
								objOtroOrdenOrdenesReparacionServicio.intPorcentajeIva = data.otros[intCon].porcentaje_iva;
								objOtroOrdenOrdenesReparacionServicio.intIvaUnitario = data.otros[intCon].iva_unitario;
								objOtroOrdenOrdenesReparacionServicio.intTasaCuotaIeps = data.otros[intCon].tasa_cuota_ieps;
								objOtroOrdenOrdenesReparacionServicio.intPorcentajeIeps = intPorcentajeIeps;
								objOtroOrdenOrdenesReparacionServicio.intIepsUnitario = data.otros[intCon].ieps_unitario;

								//Agregar datos del detalle (otro servicio) de la orden de reparación
           						objOtrosOrdenOrdenesReparacionServicio.setDetalle(objOtroOrdenOrdenesReparacionServicio);

           						//Cambiar cantidad a  formato moneda (a visualizar)
								intCantidad =  formatMoney(intCantidad, 2, '');
							    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
							    intDescuentoUnitario =  formatMoney(intDescuentoUnitario, 2, '');
							    intImporteIva  =  formatMoney(intImporteIva, 4, '');
							    intImporteIeps  =  formatMoney(intImporteIeps, 4, '');
							    intSubtotal  =  formatMoney(intSubtotal, 2, '');
							    intTotal  =  formatMoney(intTotal, 2, '');


							    //Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_otros_ordenes_reparacion_servicio').getElementsByTagName('tbody')[0];
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
								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', intRenglon);
								objCeldaConcepto.setAttribute('class', 'movil f1');
								objCeldaConcepto.innerHTML = objOtroOrdenOrdenesReparacionServicio.strConcepto;
								objCeldaCantidad.setAttribute('class', 'movil f2');
								objCeldaCantidad.innerHTML = intCantidad;
								objCeldaPrecioUnitario.setAttribute('class', 'movil f3');
								objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
								objCeldaDescuentoUnitario.setAttribute('class', 'movil f4');
								objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
								objCeldaSubtotal.setAttribute('class', 'movil f5');
								objCeldaSubtotal.innerHTML = intSubtotal;
								objCeldaIva.setAttribute('class', 'movil f6');
								objCeldaIva.innerHTML = intImporteIva;
								objCeldaIeps.setAttribute('class', 'movil f7');
								objCeldaIeps.innerHTML = intImporteIeps;
								objCeldaTotal.setAttribute('class', 'movil f8');
								objCeldaTotal.innerHTML = intTotal;
								objCeldaAcciones.setAttribute('class', 'td-center movil f9');
								objCeldaAcciones.innerHTML = strAccionesTabla;

				            }

				            //Hacer un llamado a la función para calcular totales de la tabla otros servicios
							calcular_totales_otros_ordenes_reparacion_servicio();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_otros_ordenes_reparacion_servicio tr").length - 2;
							$('#numElementos_otros_ordenes_reparacion_servicio').html(intFilas);

			            	//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Seleccionar tab que contiene la información general
		  						$('a[href="#informacion_general_ordenes_reparacion_servicio"]').click();
				            	//Abrir modal
					            objOrdenesReparacionServicio = $('#OrdenesReparacionServicioBox').bPopup({
															  appendTo: '#OrdenesReparacionServicioContent', 
								                              contentContainer: 'OrdenesReparacionServicioM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtProspecto_ordenes_reparacion_servicio').focus();
					        }
					        
			       	    }
			       },
			       'json');
		}

		


		/*******************************************************************************************************************
		Funciones del Tab - Mano de Obra
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_mano_obra_ordenes_reparacion_servicio() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtOrdenReparacionID_ordenes_reparacion_servicio').val() != strUltimaBusquedaManoObraOrdenesReparacionServicio)
			{
				intPaginaManoObraOrdenesReparacionServicio = 0;
				strUltimaBusquedaManoObraOrdenesReparacionServicio = $('#txtOrdenReparacionID_ordenes_reparacion_servicio').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/ordenes_reparacion/get_paginacion_servicios',
			{	intOrdenReparacionID:$('#txtOrdenReparacionID_ordenes_reparacion_servicio').val(),
				intPagina:intPaginaManoObraOrdenesReparacionServicio,
				strPermisosAcceso: $('#txtAcciones_ordenes_reparacion_servicio').val(),
				strEstatusOrdenReparacion: $('#txtEstatus_ordenes_reparacion_servicio').val()
			},
				function(data){
					$('#dg_mano_obra_ordenes_reparacion_servicio tbody').empty();
					var tmpManoObraOrdenesReparacionServicio = Mustache.render($('#plantilla_mano_obra_ordenes_reparacion_servicio').html(),data);
					$('#dg_mano_obra_ordenes_reparacion_servicio tbody').html(tmpManoObraOrdenesReparacionServicio);
					$('#pagLinks_mano_obra_ordenes_reparacion_servicio').html(data.paginacion);
					$('#numElementos_mano_obra_ordenes_reparacion_servicio').html(data.total_rows);
					//Variable que se utiliza para asignar el total de servicios activos
					var intTotalServiciosActivos = parseInt(data.total_servicios_activos);
					//Asignar el total de servicios activos
					$('#txtTotalServiciosActivos_mano_obra_ordenes_reparacion_servicio').val(data.total_servicios_activos);
					//Si existe un servicio activo
					if (intTotalServiciosActivos > 0)
					{
						//Hacer un llamado a la función para deshabilitar controles del formulario
						habilitar_controles_mano_obra_ordenes_reparacion_servicio('Deshabilitar');
					}
					else
					{
						//Hacer un llamado a la función para habilitar controles del formulario
						habilitar_controles_mano_obra_ordenes_reparacion_servicio('Habilitar');
					}
					intPaginaManoObraOrdenesReparacionServicio = data.pagina;
				},
			'json');
		}

		//Función para limpiar los campos del formulario
		function nuevo_mano_obra_ordenes_reparacion_servicio()
		{
			//Hacer un llamado a la función para inicializar elementos del servicio
			inicializar_servicio_mano_obra_ordenes_reparacion_servicio();
			
			//Limpiamos las cajas de texto
		    $('#txtMecanicoID_mano_obra_ordenes_reparacion_servicio').val('');
		    $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').val('');
		    $('#txtCosto_mano_obra_ordenes_reparacion_servicio').val('');
		    //Eliminar los datos de la tabla detalles de tiempos del servicio de mano de obra
			$('#dg_tiempos_mano_obra_ordenes_reparacion_servicio tbody').empty();
			$('#numElementos_tiempos_mano_obra_ordenes_reparacion_servicio').html(0);
			$('#pagLinks_tiempos_mano_obra_ordenes_reparacion_servicio').html(0);
		    //Enfocar caja de texto
			$('#txtCodigo_mano_obra_ordenes_reparacion_servicio').focus();
		}

		//Función para inicializar elementos del servicio
		function inicializar_servicio_mano_obra_ordenes_reparacion_servicio()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtRenglon_mano_obra_ordenes_reparacion_servicio').val('');
			$('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val('');
			$('#txtCodigo_mano_obra_ordenes_reparacion_servicio').val('');
		    $('#txtDescripcion_mano_obra_ordenes_reparacion_servicio').val('');
		    $('#txtHoras_mano_obra_ordenes_reparacion_servicio').val('');
		    $('#txtPrecio_mano_obra_ordenes_reparacion_servicio').val('');
		    $('#txtEstatus_mano_obra_ordenes_reparacion_servicio').val('');
		}


		//Función para habilitar y deshabilitar las horas del servicio dependiendo del tipo de servicio
		function habilitar_horas_mano_obra_ordenes_reparacion_servicio()
		{
			//Variable que se utiliza para asignar el total de servicios activos
		    var intTotalServiciosActivos = parseInt($('#txtTotalServiciosActivos_mano_obra_ordenes_reparacion_servicio').val());

			 //Dependiendo del tipo de servicio habilitar o deshabilitar horas
          	if((parseInt($('#txtServicioTipoID_ordenes_reparacion_servicio').val()) === intServicioTipoIDGarantiaOrdenesReparacionServicio) && 
          		(intTotalServiciosActivos === 0 || 
          		 $('#txtEstatus_mano_obra_ordenes_reparacion_servicio').val() == 'ACTIVO'))
         	{
         		//Habilitar caja de texto
				$("#txtHoras_mano_obra_ordenes_reparacion_servicio").removeAttr('disabled');
         	}
         	else
         	{
         		//Deshabilitar caja de texto
				$("#txtHoras_mano_obra_ordenes_reparacion_servicio").attr('disabled','disabled');
         	}

		}

		//Función para regresar obtener los datos de un servicio
		function get_datos_servicio_mano_obra_ordenes_reparacion_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los datos del servicio
         	$.post('servicio/servicios/get_datos',
              { 
              	strBusqueda:$("#txtServicioID_mano_obra_ordenes_reparacion_servicio").val(),
	       		strTipo: 'id'
              },
              function(data) {
                if(data.row){
                   $("#txtCodigo_mano_obra_ordenes_reparacion_servicio").val(data.row.codigo);
                   $("#txtDescripcion_mano_obra_ordenes_reparacion_servicio").val(data.row.descripcion);
                   $("#txtHoras_mano_obra_ordenes_reparacion_servicio").val(data.row.horas);
                   //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
			       $('#txtHoras_mano_obra_ordenes_reparacion_servicio').formatCurrency({ roundToDecimalPlace: 2 });
			       //Enfocar caja de texto
			       $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').focus();
			       //Hacer un llamado a la función para regresar los datos del precio de un tipo de equipo
	               get_precio_equipo_tipo_ordenes_reparacion_servicio();

                }
              }
             ,
            'json');

		}

		//Función para regresar obtener el precio de un tipo de equipo
		function get_precio_equipo_tipo_ordenes_reparacion_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los datos del tipo de equipo
			$.post('servicio/equipos_tipos/get_datos',
			  { 
			  	strBusqueda: $("#txtEquipoTipoID_ordenes_reparacion_servicio").val(),
			  	strTipo: 'id',
			  	intServicioTipoID: $("#txtServicioTipoID_ordenes_reparacion_servicio").val()
			  },
			  function(data) {
			    if(data.row)
			    {    
			    	//Recuperar valores
			    	$('#txtPrecio_mano_obra_ordenes_reparacion_servicio').val(data.row.precio);
			         //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtPrecio_mano_obra_ordenes_reparacion_servicio').formatCurrency({ roundToDecimalPlace: 2 });
			    }
			}
			 ,
			'json');
		}

		//Función para guardar o modificar los datos de un servicio
		function guardar_mano_obra_ordenes_reparacion_servicio()
		{
			//Obtenemos los datos de las cajas de texto
			var intServicioIDMO = $('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val();
			var strCodigoMO = $('#txtCodigo_mano_obra_ordenes_reparacion_servicio').val();
			var strDescripcionMO = $('#txtDescripcion_mano_obra_ordenes_reparacion_servicio').val();
			var intHorasMO = $('#txtHoras_mano_obra_ordenes_reparacion_servicio').val();
			var intPrecioMO = $('#txtPrecio_mano_obra_ordenes_reparacion_servicio').val();
			var intCostoMO = $('#txtCosto_mano_obra_ordenes_reparacion_servicio').val();
			var intMecanicoIDMO = $('#txtMecanicoID_mano_obra_ordenes_reparacion_servicio').val();
			var strMecanicoMO = $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').val();
			var strEstatusMO = $('#txtEstatus_mano_obra_ordenes_reparacion_servicio').val();

			//Si el estatus del servicio de mano de obra es diferente de SUSPENDIDO o FINALIZADO
			if(strEstatusMO !== 'SUSPENDIDO' && strEstatusMO !== 'FINALIZADO')
			{
				//Validamos que se capturaron datos
				if (intServicioIDMO == '' || strCodigoMO == '')
				{
					//Enfocar caja de texto
					$('#txtCodigo_mano_obra_ordenes_reparacion_servicio').focus();
				}
				else if (intServicioIDMO == '' || strDescripcionMO == '')
				{
					//Enfocar caja de texto
					$('#txtDescripcion_mano_obra_ordenes_reparacion_servicio').focus();
				}
				else if (intHorasMO == '')
				{
					//Enfocar caja de texto
					$('#txtHoras_mano_obra_ordenes_reparacion_servicio').focus();
				}
				else if (intMecanicoIDMO == '' || strMecanicoMO == '')
				{
					//Enfocar caja de texto
					$('#txtMecanico_mano_obra_ordenes_reparacion_servicio').focus();
				}
				else if (parseFloat(intPrecioMO) <= 0)
				{
					//Hacer un llamado a la función para mostrar mensaje de información
	                mensaje_ordenes_reparacion_servicio('informacion_mano_obra', 'No es posible agregar el servicio porque no tiene un precio establecido.');
				}
				else
				{
					//Hacer un llamado a la función para reemplazar ',' por cadena vacia
					intHorasMO = $.reemplazar(intHorasMO, ",", "");
					intPrecioMO  = $.reemplazar(intPrecioMO, ",", "");

					//Hacer un llamado al método del controlador para guardar los datos del registro
					$.post('servicio/ordenes_reparacion/guardar_servicios',
							{ 
								intOrdenReparacionID: $('#txtOrdenReparacionID_ordenes_reparacion_servicio').val(),
								intRenglon: $('#txtRenglon_mano_obra_ordenes_reparacion_servicio').val(),
								intServicioID: intServicioIDMO,
								intHoras:  intHorasMO,
								intPrecio: intPrecioMO,
								intCosto: intCostoMO,
								intMecanicoID: intMecanicoIDMO
							},
							function(data) {
								if (data.resultado)
								{
									//Hacer un llamado a la función para limpiar los campos del formulario
									nuevo_mano_obra_ordenes_reparacion_servicio(); 
									//Hacer llamado a la función  para cargar los servicios de mano de obra en el grid
									paginacion_mano_obra_ordenes_reparacion_servicio();               
								}

								//Si existe un error al momento de realizar el registro
								if(data.tipo_mensaje == 'error')
								{
									//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					           	 	mensaje_ordenes_reparacion_servicio(data.tipo_mensaje, data.mensaje);
								}
								
							},
					'json');

				}
			}
			else
			{
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_mano_obra_ordenes_reparacion_servicio();
				//Hacer llamado a la función  para cargar los servicios de mano de obra en el grid
				paginacion_mano_obra_ordenes_reparacion_servicio();
			}
			
		}

		// Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_mano_obra_ordenes_reparacion_servicio(renglon)
		{
			//Preguntar al usuario si desea modificar el estatus del registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea activar este servicio?</strong>',
			             {'type':     'question',
			              'title':    'Activar Servicio',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para cambiar el estatus
			                              $.post('servicio/ordenes_reparacion/set_estatus_servicios',
			                                     {intOrdenReparacionID: $('#txtOrdenReparacionID_ordenes_reparacion_servicio').val(),
			                                      intRenglon: renglon
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                            //Hacer llamado a la función  para cargar los servicios de mano de obra en el grid
			                                            paginacion_mano_obra_ordenes_reparacion_servicio();
		                                            	
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_ordenes_reparacion_servicio(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                        }
			              });
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_mano_obra_ordenes_reparacion_servicio(renglon)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/ordenes_reparacion/get_datos_servicios',
			       {intOrdenReparacionID: $('#txtOrdenReparacionID_ordenes_reparacion_servicio').val(),
			       	intRenglon: renglon
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_mano_obra_ordenes_reparacion_servicio();
						   //Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				          	//Recuperar valores
				            $('#txtRenglon_mano_obra_ordenes_reparacion_servicio').val(data.row.renglon);
				            $('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val(data.row.servicio_id);
				            $('#txtCodigo_mano_obra_ordenes_reparacion_servicio').val(data.row.codigo);
				            $('#txtDescripcion_mano_obra_ordenes_reparacion_servicio').val(data.row.descripcion);
				            $('#txtHoras_mano_obra_ordenes_reparacion_servicio').val(data.row.horas);
				            //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtHoras_mano_obra_ordenes_reparacion_servicio').formatCurrency({ roundToDecimalPlace: 2 });
				            $('#txtPrecio_mano_obra_ordenes_reparacion_servicio').val(data.row.precio);
				            //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtPrecio_mano_obra_ordenes_reparacion_servicio').formatCurrency({ roundToDecimalPlace: 2 });
					        $('#txtCosto_mano_obra_ordenes_reparacion_servicio').val(data.row.costo);
				            $('#txtMecanicoID_mano_obra_ordenes_reparacion_servicio').val(data.row.mecanico_id);
				            $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').val(data.row.mecanico);
				            $('#txtEstatus_mano_obra_ordenes_reparacion_servicio').val(strEstatus);
				          	
				            //Si el estatus del registro es  ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Hacer un llamado a la función para habilitar controles del formulario
								habilitar_controles_mano_obra_ordenes_reparacion_servicio('Habilitar');
							}
							else 
							{	
								//Hacer un llamado a la función para habilitar controles del formulario
								habilitar_controles_mano_obra_ordenes_reparacion_servicio('Deshabilitar');
							}
				           
			       	    }
			       },
			       'json');
		}

		//Función para habilitar o deshabilitar controles del formulario
		function habilitar_controles_mano_obra_ordenes_reparacion_servicio(tipoAccion)
		{
			//Dependiendo del tipo habilitar o deshabilitar controles
			if(tipoAccion == 'Habilitar')
			{
				//Si el estatus de la orden de reparación es ACTIVO
				if($("#txtEstatus_ordenes_reparacion_servicio").val() == 'ACTIVO' )
				{
					//Habilitar los siguientes controles
					$("#txtCodigo_mano_obra_ordenes_reparacion_servicio").removeAttr('disabled');
					$("#txtDescripcion_mano_obra_ordenes_reparacion_servicio").removeAttr('disabled');
					$("#txtMecanico_mano_obra_ordenes_reparacion_servicio").removeAttr('disabled');
					//Hacer un llamado a la función para habilitar/deshabilitar las horas del servicio de mano de obra
	           		habilitar_horas_mano_obra_ordenes_reparacion_servicio(); 
					
				}
			}
			else
			{
				//Deshabilitar los siguientes controles
				$("#txtCodigo_mano_obra_ordenes_reparacion_servicio").attr('disabled','disabled');
				$("#txtDescripcion_mano_obra_ordenes_reparacion_servicio").attr('disabled','disabled');
				$("#txtMecanico_mano_obra_ordenes_reparacion_servicio").attr('disabled','disabled');
				$("#txtHoras_mano_obra_ordenes_reparacion_servicio").attr('disabled','disabled');
			}


		}

		/*******************************************************************************************************************
		Funciones del Tab - Refacciones
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_salidas_refacciones_ordenes_reparacion_servicio() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtOrdenReparacionID_ordenes_reparacion_servicio').val() != strUltimaBusquedaSalidasRefaccionesOrdenesReparacionServicio)
			{
				intPaginaSalidasRefaccionesOrdenesReparacionServicio = 0;
				strUltimaBusquedaSalidasRefaccionesOrdenesReparacionServicio = $('#txtOrdenReparacionID_ordenes_reparacion_servicio').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/movimientos_salidas_refacciones_taller/get_paginacion_detalles',
			{	
				intOrdenReparacionID:$('#txtOrdenReparacionID_ordenes_reparacion_servicio').val(),
				intPagina:intPaginaSalidasRefaccionesOrdenesReparacionServicio
			},
			function(data){
				$('#dg_salidas_refacciones_ordenes_reparacion_servicio tbody').empty();
				var tmpSalidasRefaccionesOrdenesReparacionServicio = Mustache.render($('#plantilla_salidas_refacciones_ordenes_reparacion_servicio').html(),data);
				$('#dg_salidas_refacciones_ordenes_reparacion_servicio tbody').html(tmpSalidasRefaccionesOrdenesReparacionServicio);
				$('#pagLinks_salidas_refacciones_ordenes_reparacion_servicio').html(data.paginacion);
				$('#numElementos_salidas_refacciones_ordenes_reparacion_servicio').html(data.total_rows);
				$('#acumCantidadSurtida_salidas_refacciones_ordenes_reparacion_servicio').html(data.acumulado_cantidad_surtidas);
				$('#acumCantidadDevolucion_salidas_refacciones_ordenes_reparacion_servicio').html(data.acumulado_cantidad_devolucion);
				$('#acumCantidadFacturar_salidas_refacciones_ordenes_reparacion_servicio').html(data.acumulado_cantidad_facturar);
				$('#acumTotal_salidas_refacciones_ordenes_reparacion_servicio').html(data.acumulado_total);
				intPaginaSalidasRefaccionesOrdenesReparacionServicio = data.pagina;
			},
			'json');
		}

		/*******************************************************************************************************************
		Funciones del Tab - Trabajos Foráneos
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_trabajos_foraneos_ordenes_reparacion_servicio() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtOrdenReparacionID_ordenes_reparacion_servicio').val() != strUltimaBusquedaTrabajosForaneosOrdenesReparacionServicio)
			{
				intPaginaTrabajosForaneosOrdenesReparacionServicio = 0;
				strUltimaBusquedaTrabajosForaneosOrdenesReparacionServicio = $('#txtOrdenReparacionID_ordenes_reparacion_servicio').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/trabajos_foraneos/get_paginacion_detalles',
					{	
						intOrdenReparacionID:$('#txtOrdenReparacionID_ordenes_reparacion_servicio').val(),
						intPagina:intPaginaTrabajosForaneosOrdenesReparacionServicio,
						strPermisosAcceso: $('#txtAcciones_ordenes_reparacion_servicio').val()
					},
					function(data){
						$('#dg_trabajos_foraneos_ordenes_reparacion_servicio tbody').empty();
						var tmpTrabajosForaneosOrdenesReparacionServicio = Mustache.render($('#plantilla_trabajos_foraneos_ordenes_reparacion_servicio').html(),data);
						$('#dg_trabajos_foraneos_ordenes_reparacion_servicio tbody').html(tmpTrabajosForaneosOrdenesReparacionServicio);
						$('#pagLinks_trabajos_foraneos_ordenes_reparacion_servicio').html(data.paginacion);
						$('#numElementos_trabajos_foraneos_ordenes_reparacion_servicio').html(data.total_rows);
						$('#acumCantidad_trabajos_foraneos_ordenes_reparacion_servicio').html(data.acumulado_cantidad);
						$('#acumDescuento_trabajos_foraneos_ordenes_reparacion_servicio').html(data.acumulado_descuento);
						$('#acumSubtotal_trabajos_foraneos_ordenes_reparacion_servicio').html(data.acumulado_subtotal);
						$('#acumIva_trabajos_foraneos_ordenes_reparacion_servicio').html(data.acumulado_iva);
						$('#acumIeps_trabajos_foraneos_ordenes_reparacion_servicio').html(data.acumulado_ieps);
						$('#acumTotal_trabajos_foraneos_ordenes_reparacion_servicio').html(data.acumulado_total);
						intPaginaTrabajosForaneosOrdenesReparacionServicio = data.pagina;
					},
			'json');
		}


		/*******************************************************************************************************************
		Funciones del Tab - Otros
		*********************************************************************************************************************/

		//Regresar el impuesto de objeto base
		function cargar_objeto_impuesto_base_otros_ordenes_reparacion_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.ajax({
			        url: 'contabilidad/sat_objeto_impuesto/get_datos',
			        method:'post',
			        dataType: 'json',
			        async: false,
			        data: {
			        	strBusqueda:intObjetoImpuestoBaseIDOrdenesReparacionServicio,
			       		strTipo: 'id'
			        },
			        success: function (data) {
			          	//Si no se encuentra código 
			        	if(data.row)
			        	{
			        		//Recuperar valores
				            $('#txtObjetoImpuestoID_otros_ordenes_reparacion_servicio').val(data.row.objeto_impuesto_id);
				            $('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').val(data.row.codigo+' - '+data.row.descripcion);

			        	}
			        }
			    });
		}



		//Función para inicializar elementos del detalle
		function inicializar_detalle_otros_ordenes_reparacion_servicio()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_otros_ordenes_reparacion_servicio').val('');
			$('#txtConcepto_otros_ordenes_reparacion_servicio').val('');
			$('#txtProductoServicioID_otros_ordenes_reparacion_servicio').val('');
			$('#txtProductoServicio_otros_ordenes_reparacion_servicio').val('');
			$('#txtUnidadID_otros_ordenes_reparacion_servicio').val('');
			$('#txtUnidad_otros_ordenes_reparacion_servicio').val('');
			$('#txtObjetoImpuestoID_otros_ordenes_reparacion_servicio').val('');
			$('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').val('');
			$('#txtCantidad_otros_ordenes_reparacion_servicio').val('');
		    $('#txtPrecioUnitario_otros_ordenes_reparacion_servicio').val('');
		    $('#txtPorcentajeDescuento_otros_ordenes_reparacion_servicio').val('0.00');
		    $('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').val('');
		    $('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').val('');
		    $('#txtTasaCuotaIva_otros_ordenes_reparacion_servicio').val('');
		    $('#txtTasaCuotaIeps_otros_ordenes_reparacion_servicio').val('');
		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_otros_ordenes_reparacion_servicio()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla ordenes_reparacion_otros)
			var intSubtotal = 0;
			//Variable que se utiliza para asignar el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de iva unitario
			var intIvaUnitario = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe de ieps unitario
			var intIepsUnitario = 0;
			//Variable que se utiliza para asignar el precio unitario que se va a guardar en la BD
			var intPrecioUnitarioBD = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_otros_ordenes_reparacion_servicio').val();
			var strConcepto = $('#txtConcepto_otros_ordenes_reparacion_servicio').val();
			var intProductoServicioID = $('#txtProductoServicioID_otros_ordenes_reparacion_servicio').val();
			var strProductoServicio = $('#txtProductoServicio_otros_ordenes_reparacion_servicio').val();
			var intUnidadID = $('#txtUnidadID_otros_ordenes_reparacion_servicio').val();
			var strUnidad = $('#txtUnidad_otros_ordenes_reparacion_servicio').val();
			var intObjetoImpuestoID = $('#txtObjetoImpuestoID_otros_ordenes_reparacion_servicio').val();
			var strObjetoImpuesto = $('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').val();
			var intCantidad = $('#txtCantidad_otros_ordenes_reparacion_servicio').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_otros_ordenes_reparacion_servicio').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_otros_ordenes_reparacion_servicio').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_otros_ordenes_reparacion_servicio').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_otros_ordenes_reparacion_servicio').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_otros_ordenes_reparacion_servicio').getElementsByTagName('tbody')[0];


			//Validamos que se capturaron datos
			if (strConcepto == '')
			{
				//Enfocar caja de texto
				$('#txtConcepto_otros_ordenes_reparacion_servicio').focus();
			}
			else if (intProductoServicioID == '')
			{
				//Enfocar caja de texto
				$('#txtProductoServicio_otros_ordenes_reparacion_servicio').focus();
			}
			else if (intUnidadID == '')
			{
				//Enfocar caja de texto
				$('#txtUnidad_otros_ordenes_reparacion_servicio').focus();
			}
			else if (intObjetoImpuestoID == '')
			{
				//Enfocar caja de texto
				$('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').focus();
			}
			else if (intCantidad == '')
			{
				//Enfocar caja de texto
				$('#txtCantidad_otros_ordenes_reparacion_servicio').focus();
			}
			else if (intPrecioUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_otros_ordenes_reparacion_servicio').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_otros_ordenes_reparacion_servicio').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_otros_ordenes_reparacion_servicio').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_otros_ordenes_reparacion_servicio').focus();
			}
			else if (intPorcentajeIva == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').focus();
			}
			else if(intTasaCuotaIeps == '' && intPorcentajeIeps != '')
			{
				//Limpiar caja de texto
				$('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').focus();
			}
			else
			{

				//Crear instancia del objeto Otro servicio de la orden de reparación
				objOtroOrdenOrdenesReparacionServicio = new OtroOrdenOrdenesReparacionServicio('', '', '', '', 
																					           '', '',  '',  '', 
																					           '', '', '', '', 
																					           '', '', '','', '');

				

				//Hacer un llamado a la función para inicializar elementos del detalle
				inicializar_detalle_otros_ordenes_reparacion_servicio();

				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strConcepto = strConcepto.toUpperCase();

				//Convertir cadena de texto a número decimal
				intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intSubtotal = intPrecioUnitario;
				intPrecioUnitarioBD = intPrecioUnitario;

				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					//Calcular descuento unitario
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;

					//Redondear cantidad a decimales
					intDescuentoUnitario = intDescuentoUnitario.toFixed(2);

					//Restar descuento al precio unitario
					intPrecioUnitarioBD = intPrecioUnitario - intDescuentoUnitario;

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

			    //Calcular iva unitario
				intIvaUnitario =  intImporteIva / intCantidad;
				//Redondear cantidad a decimales
				intIvaUnitario = intIvaUnitario.toFixed(4);
				intIvaUnitario = parseFloat(intIvaUnitario);

				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
					//Redondear cantidad a dos decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(4);
			   	 	intImporteIeps = parseFloat(intImporteIeps);

			   	 	//Calcular ieps unitario
					intIepsUnitario = intImporteIeps / intCantidad;
					//Redondear cantidad a decimales
					intIepsUnitario = intIepsUnitario.toFixed(4);
					intIepsUnitario = parseFloat(intIepsUnitario);
				}


				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Asignar valores al objeto
				objOtroOrdenOrdenesReparacionServicio.strConcepto = strConcepto;
				objOtroOrdenOrdenesReparacionServicio.intProductoServicioID = intProductoServicioID;
				objOtroOrdenOrdenesReparacionServicio.strProductoServicio = strProductoServicio;
				objOtroOrdenOrdenesReparacionServicio.intUnidadID = intUnidadID;
				objOtroOrdenOrdenesReparacionServicio.strUnidad = strUnidad;
				objOtroOrdenOrdenesReparacionServicio.intObjetoImpuestoID = intObjetoImpuestoID;
				objOtroOrdenOrdenesReparacionServicio.strObjetoImpuesto = strObjetoImpuesto;
				objOtroOrdenOrdenesReparacionServicio.intCantidad = intCantidad;
				objOtroOrdenOrdenesReparacionServicio.intPrecioUnitario = intPrecioUnitarioBD;
				objOtroOrdenOrdenesReparacionServicio.intPorcentajeDescuento = intPorcentajeDescuento;
				objOtroOrdenOrdenesReparacionServicio.intDescuentoUnitario = intDescuentoUnitario;
				objOtroOrdenOrdenesReparacionServicio.intTasaCuotaIva = intTasaCuotaIva;
				objOtroOrdenOrdenesReparacionServicio.intPorcentajeIva = intPorcentajeIva;
				objOtroOrdenOrdenesReparacionServicio.intIvaUnitario = intIvaUnitario;
				objOtroOrdenOrdenesReparacionServicio.intTasaCuotaIeps = intTasaCuotaIeps;
				objOtroOrdenOrdenesReparacionServicio.intPorcentajeIeps = intPorcentajeIeps;
				objOtroOrdenOrdenesReparacionServicio.intIepsUnitario = intIepsUnitario;


				//Cambiar cantidad a  formato moneda (a visualizar)
				intCantidad =  formatMoney(intCantidad, 2, '');
			    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
			    intDescuentoUnitario =  formatMoney(intDescuentoUnitario, 2, '');
			    intImporteIva  =  formatMoney(intImporteIva, 4, '');
			    intImporteIeps  =  formatMoney(intImporteIeps, 4, '');
			    intSubtotal  =  formatMoney(intSubtotal, 2, '');
			    intTotal  =  formatMoney(intTotal, 2, '');

				//Revisamos si existe el renglón, si es así, editamos los datos del detalle
				if (intRenglon)
				{
					//Modificar los datos del detalle (otro servicio) corespondiente al indice
	        		objOtrosOrdenOrdenesReparacionServicio.modificarDetalle(intRenglon, objOtroOrdenOrdenesReparacionServicio);

	        		//Incrementar renglón para obtener la posición del detalle en la tabla
					intRenglon++;

					//Seleccionar el renglón de la tabla para actualizar los datos del detalle
					var selectedRow = document.getElementById("dg_otros_ordenes_reparacion_servicio").rows[intRenglon].cells;

					selectedRow[0].innerHTML = objOtroOrdenOrdenesReparacionServicio.strConcepto;
					selectedRow[1].innerHTML = intCantidad;
					selectedRow[2].innerHTML = intPrecioUnitario;
					selectedRow[3].innerHTML = intDescuentoUnitario;
					selectedRow[4].innerHTML = intSubtotal;
					selectedRow[5].innerHTML = intImporteIva;
					selectedRow[6].innerHTML = intImporteIeps;
					selectedRow[7].innerHTML = intTotal;
				}
				else
				{
					//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
					intRenglon = $("#dg_otros_ordenes_reparacion_servicio tr").length - 2;
					//Incrementar 1 para el siguiente renglón
					intRenglon++;

					//Agregar datos del detalle (otro servicio) de la orden de reparación
           			objOtrosOrdenOrdenesReparacionServicio.setDetalle(objOtroOrdenOrdenesReparacionServicio);

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
					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRenglon);
					objCeldaConcepto.setAttribute('class', 'movil f1');
					objCeldaConcepto.innerHTML = objOtroOrdenOrdenesReparacionServicio.strConcepto;
					objCeldaCantidad.setAttribute('class', 'movil f2');
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaPrecioUnitario.setAttribute('class', 'movil f3');
					objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil f4');
					objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
					objCeldaSubtotal.setAttribute('class', 'movil f5');
					objCeldaSubtotal.innerHTML = intSubtotal;
					objCeldaIva.setAttribute('class', 'movil f6');
					objCeldaIva.innerHTML = intImporteIva;
					objCeldaIeps.setAttribute('class', 'movil f7');
					objCeldaIeps.innerHTML = intImporteIeps;
					objCeldaTotal.setAttribute('class', 'movil f8');
					objCeldaTotal.innerHTML = intTotal;
					objCeldaAcciones.setAttribute('class', 'td-center movil f9');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_otros_ordenes_reparacion_servicio(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_otros_ordenes_reparacion_servicio(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				}


				//Hacer un llamado a la función para calcular totales de la tabla otros servicios
				calcular_totales_otros_ordenes_reparacion_servicio();
				//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
				cargar_objeto_impuesto_base_otros_ordenes_reparacion_servicio();
				

				//Enfocar caja de texto
				$('#txtConcepto_otros_ordenes_reparacion_servicio').focus();

			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_otros_ordenes_reparacion_servicio tr").length - 2;
			$('#numElementos_otros_ordenes_reparacion_servicio').html(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_otros_ordenes_reparacion_servicio(objRenglon)
		{

			//Decrementar indice para obtener la posición del detalle en el arreglo
		    var intRenglon =  parseInt(objRenglon.parentNode.parentNode.rowIndex) - 1;


		    //Crear instancia del objeto Otro servicio de la orden de reparación
        	objOtroOrdenOrdenesReparacionServicio = new OtroOrdenOrdenesReparacionServicio();

        	//Asignar datos del detalle (otro servicio) corespondiente al indice
        	objOtroOrdenOrdenesReparacionServicio = objOtrosOrdenOrdenesReparacionServicio.getDetalle(intRenglon);

        	//Variables que se utilizan para asignar valores del detalle (otro servicio)
			var intPrecioUnitario = parseFloat(objOtroOrdenOrdenesReparacionServicio.intPrecioUnitario);
			var intDescuentoUnitario = parseFloat(objOtroOrdenOrdenesReparacionServicio.intDescuentoUnitario);

			//Si existe importe del descuento
			if(intDescuentoUnitario > 0)
			{
				//Calcular precio unitario
				intPrecioUnitario = intPrecioUnitario + intDescuentoUnitario;
			}

			//Cambiar cantidad a  formato moneda (a visualizar)
			var intCantidad =  formatMoney(objOtroOrdenOrdenesReparacionServicio.intCantidad, 2, '');
		    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
		    var intPorcentajeDescuento =  formatMoney(objOtroOrdenOrdenesReparacionServicio.intPorcentajeDescuento, 2, '');
			
			//Asignar los valores a las cajas de texto
			$('#txtRenglon_otros_ordenes_reparacion_servicio').val(intRenglon);
			$('#txtConcepto_otros_ordenes_reparacion_servicio').val(objOtroOrdenOrdenesReparacionServicio.strConcepto);
			$('#txtProductoServicioID_otros_ordenes_reparacion_servicio').val(objOtroOrdenOrdenesReparacionServicio.intProductoServicioID);
			$('#txtProductoServicio_otros_ordenes_reparacion_servicio').val(objOtroOrdenOrdenesReparacionServicio.strProductoServicio);
			$('#txtUnidadID_otros_ordenes_reparacion_servicio').val(objOtroOrdenOrdenesReparacionServicio.intUnidadID);
			$('#txtUnidad_otros_ordenes_reparacion_servicio').val(objOtroOrdenOrdenesReparacionServicio.strUnidad);
			$('#txtObjetoImpuestoID_otros_ordenes_reparacion_servicio').val(objOtroOrdenOrdenesReparacionServicio.intObjetoImpuestoID);
			$('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').val(objOtroOrdenOrdenesReparacionServicio.strObjetoImpuesto);
			$('#txtCantidad_otros_ordenes_reparacion_servicio').val(intCantidad);
			$('#txtPrecioUnitario_otros_ordenes_reparacion_servicio').val(intPrecioUnitario);
			$('#txtPorcentajeDescuento_otros_ordenes_reparacion_servicio').val(intPorcentajeDescuento);
			$('#txtTasaCuotaIva_otros_ordenes_reparacion_servicio').val(objOtroOrdenOrdenesReparacionServicio.intTasaCuotaIva);
			$('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').val(objOtroOrdenOrdenesReparacionServicio.intPorcentajeIva);
			$('#txtTasaCuotaIeps_otros_ordenes_reparacion_servicio').val(objOtroOrdenOrdenesReparacionServicio.intTasaCuotaIeps);
			$('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').val(objOtroOrdenOrdenesReparacionServicio.intPorcentajeIeps);

			//Enfocar caja de texto
			$('#txtConcepto_otros_ordenes_reparacion_servicio').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_otros_ordenes_reparacion_servicio(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			//Eliminar del objeto el detalle (otro servicio) seleccionado
			objOtrosOrdenOrdenesReparacionServicio.eliminarDetalle(intRenglon - 1);

			//Eliminar el renglón indicado
			document.getElementById("dg_otros_ordenes_reparacion_servicio").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla otros servicios
			calcular_totales_otros_ordenes_reparacion_servicio();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_otros_ordenes_reparacion_servicio tr").length - 2;
			$('#numElementos_otros_ordenes_reparacion_servicio').html(intFilas);

			//Enfocar caja de texto
			$('#txtConcepto_otros_ordenes_reparacion_servicio').focus();

		}

		//Función para calcular totales de la tabla
		function calcular_totales_otros_ordenes_reparacion_servicio()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_otros_ordenes_reparacion_servicio').getElementsByTagName('tbody')[0];

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
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
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
			$('#acumCantidad_otros_ordenes_reparacion_servicio').html(intAcumUnidades);
			$('#acumDescuento_otros_ordenes_reparacion_servicio').html(intAcumDescuento);
			$('#acumSubtotal_otros_ordenes_reparacion_servicio').html(intAcumSubtotal);
			$('#acumIva_otros_ordenes_reparacion_servicio').html(intAcumIva);
			$('#acumIeps_otros_ordenes_reparacion_servicio').html(intAcumIeps);
			$('#acumTotal_otros_ordenes_reparacion_servicio').html(intAcumTotal);
		}
		
		/*******************************************************************************************************************
		Funciones del modal Tiempos del Servicio de Mano de Obra
		*********************************************************************************************************************/
	    //Función para la búsqueda de registros
		function paginacion_tiempos_mano_obra_ordenes_reparacion_servicio(servicioID) 
		{
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaTiemposManoObraOrdenesReparacionServicio =($('#txtOrdenReparacionID_ordenes_reparacion_servicio').val()+$('#txtServicioID_tiempos_mano_obra_ordenes_reparacion_servicio').val()+$('#txtRenglon_tiempos_mano_obra_ordenes_reparacion_servicio').val());

			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaTiemposManoObraOrdenesReparacionServicio != strUltimaBusquedaTiemposManoObraOrdenesReparacionServicio)
			{
				intPaginaTiemposManoObraOrdenesReparacionServicio= 0;
				strUltimaBusquedaTiemposManoObraOrdenesReparacionServicio = strNuevaBusquedaTiemposManoObraOrdenesReparacionServicio;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/ordenes_reparacion/get_paginacion_servicios_tiempos',
					{	intOrdenReparacionID:$('#txtOrdenReparacionID_ordenes_reparacion_servicio').val(),
						intServicioID: $('#txtServicioID_tiempos_mano_obra_ordenes_reparacion_servicio').val(),
						intRenglon: $('#txtRenglon_tiempos_mano_obra_ordenes_reparacion_servicio').val(),
						intPagina:intPaginaTiemposManoObraOrdenesReparacionServicio,
						strPermisosAcceso: $('#txtAcciones_ordenes_reparacion_servicio').val()
					},
					function(data){
						$('#dg_tiempos_mano_obra_ordenes_reparacion_servicio tbody').empty();
						var tmpTiemposManoObraOrdenesReparacionServicio = Mustache.render($('#plantilla_tiempos_mano_obra_ordenes_reparacion_servicio').html(),data);
						$('#dg_tiempos_mano_obra_ordenes_reparacion_servicio tbody').html(tmpTiemposManoObraOrdenesReparacionServicio);
						$('#pagLinks_tiempos_mano_obra_ordenes_reparacion_servicio').html(data.paginacion);
						$('#numElementos_tiempos_mano_obra_ordenes_reparacion_servicio').html(data.total_rows);
						intPaginaTiemposManoObraOrdenesReparacionServicio = data.pagina;
					},
			'json');
		}

	    //Función para limpiar los campos del formulario
		function nuevo_tiempos_mano_obra_ordenes_reparacion_servicio(tipoAccion)
		{
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_tiempos_mano_obra_ordenes_reparacion_servicio');
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtOrdenReparacionTiempoID_tiempos_mano_obra_ordenes_reparacion_servicio').val('');
			$('#txtFechaInicio_tiempos_mano_obra_ordenes_reparacion_servicio').val('');
			$('#txtUsuarioInicio_tiempos_mano_obra_ordenes_reparacion_servicio').val('');
			$('#txtFechaSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').val('');
			$('#txtUsuarioSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').val('');
			$('#txtMotivoSuspensionID_tiempos_mano_obra_ordenes_reparacion_servicio').val('');
			$('#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').val('');
			$('#txtTiempo_tiempos_mano_obra_ordenes_reparacion_servicio').val('');
			//Deshabilitar los siguientes controles
			$("#btnAgregar_tiempos_mano_obra_ordenes_reparacion_servicio").attr('disabled','disabled');
			$("#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio").attr('disabled','disabled');
			
			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_tiempos_mano_obra_ordenes_reparacion_servicio').addClass("estatus-NUEVO");
			}
		}

		//Función que se utiliza para abrir el modal
		function abrir_tiempos_mano_obra_ordenes_reparacion_servicio(renglon)
		{
			//Hacer un llamado a la función para limpiar los campos del servicio
			nuevo_mano_obra_ordenes_reparacion_servicio();
			//Hacer un llamado a la función para habilitar controles del servicio
			habilitar_controles_mano_obra_ordenes_reparacion_servicio('Deshabilitar');
			//Hacer un llamado a la función para limpiar los campos del tiempo
			nuevo_tiempos_mano_obra_ordenes_reparacion_servicio('Nuevo');
			
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/ordenes_reparacion/get_datos_servicios',
			       {intOrdenReparacionID: $('#txtOrdenReparacionID_ordenes_reparacion_servicio').val(),
			       	intRenglon: renglon
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
			            	$('#txtServicioID_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.servicio_id);
			            	$('#txtRenglon_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.renglon);
							$('#txtCodigo_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.codigo);
							$('#txtDescripcion_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.descripcion);
							$('#txtHoras_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.horas);
							//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtHoras_tiempos_mano_obra_ordenes_reparacion_servicio').formatCurrency({ roundToDecimalPlace: 2 });

					     
		    				//Hacer llamado a la función  para cargar los tiempos del servicio en el grid
				            paginacion_tiempos_mano_obra_ordenes_reparacion_servicio();

						    //Abrir modal
							objTiempoManoObraOrdenesReparacionServicio = $('#TiempoManoObraOrdenesReparacionServicioBox').bPopup({
																   appendTo: '#OrdenesReparacionServicioContent', 
										                           contentContainer: 'OrdenesReparacionServicioM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_tiempos_mano_obra_ordenes_reparacion_servicio()
		{
			try {
				//Cerrar modal
				objTiempoManoObraOrdenesReparacionServicio.close();
				//Hacer llamado a la función  para cargar los servicios de mano de obra en el grid
				paginacion_mano_obra_ordenes_reparacion_servicio();
				//Enfocar caja de texto
				$('#txtCodigo_mano_obra_ordenes_reparacion_servicio').focus();
				
			}
			catch(err) {}
		}

		//Función para modificar los datos de un tiempo del servicio
		function guardar_tiempos_mano_obra_ordenes_reparacion_servicio()
		{
			//Obtenemos los datos de las cajas de texto
			var intMotivoSuspensionIDTMO = $('#txtMotivoSuspensionID_tiempos_mano_obra_ordenes_reparacion_servicio').val();
			var strMotivoSuspensionTMO = $('#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').val();

			//Validamos que se capturaron datos
			if (intMotivoSuspensionIDTMO == '' || strMotivoSuspensionTMO == '')
			{
				//Enfocar caja de texto
				$('#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').focus();
			}
			else
			{
				//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('servicio/ordenes_reparacion/modificar_servicios_tiempos',
						{ 
							intOrdenReparacionTiempoID: $('#txtOrdenReparacionTiempoID_tiempos_mano_obra_ordenes_reparacion_servicio').val(),
							intOrdenReparacionID: $('#txtOrdenReparacionID_ordenes_reparacion_servicio').val(),
							intRenglon: $('#txtRenglon_tiempos_mano_obra_ordenes_reparacion_servicio').val(),
							intMotivoSuspensionID: intMotivoSuspensionIDTMO
						},
						function(data) {
							if (data.resultado)
							{
								//Hacer un llamado a la función para limpiar los campos del formulario
								nuevo_tiempos_mano_obra_ordenes_reparacion_servicio('Nuevo');
								//Hacer llamado a la función  para cargar los tiempos del servicio en el grid
				           		paginacion_tiempos_mano_obra_ordenes_reparacion_servicio();
				           	
							}

							//Si existe un error al momento de realizar el registro
							if(data.tipo_mensaje == 'error')
							{
								//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				           	 	mensaje_ordenes_reparacion_servicio(data.tipo_mensaje, data.mensaje);
							}
							
						},
				'json');

			}

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_tiempos_mano_obra_ordenes_reparacion_servicio(ordenReparacionTiempoID)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/ordenes_reparacion/get_datos_servicios_tiempos',
			       {intOrdenReparacionTiempoID: ordenReparacionTiempoID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_tiempos_mano_obra_ordenes_reparacion_servicio('');
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;				          	
				            //Recuperar valores
				          	$('#txtOrdenReparacionTiempoID_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.orden_reparacion_tiempo_id);
				            $('#txtRenglon_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.renglon);
				            $('#txtFechaInicio_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.fecha_inicio);
				            $('#txtUsuarioInicio_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.usuario_inicio);
				            $('#txtFechaSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.fecha_suspension);
				            $('#txtUsuarioSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.usuario_suspension);
				            $('#txtTiempo_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.tiempo);
				            $('#txtMotivoSuspensionID_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.motivo_suspension_id);
				            $('#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').val(data.row.motivo_suspension);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_tiempos_mano_obra_ordenes_reparacion_servicio').addClass("estatus-"+strEstatus);
				          	
				          	//Si el estatus de la orden de reparación es ACTIVO
							if($("#txtEstatus_ordenes_reparacion_servicio").val() == 'ACTIVO' && strEstatus == 'ACTIVO')
							{
								//Habilitar caja de texto
								$("#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio").removeAttr('disabled');
								//Habilitar botón Agregar
								$("#btnAgregar_tiempos_mano_obra_ordenes_reparacion_servicio").removeAttr('disabled');
							}
				           
				            //Enfocar caja de texto
							$('#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').focus();
			       	    }
			       },
			       'json');
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Ordenes de Trabajo
			*********************************************************************************************************************/
			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Información General
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtHoras_ordenes_reparacion_servicio').numeric();
			$('#txtGastosServicio_ordenes_reparacion_servicio').numeric();
        	//Agregar datepicker para seleccionar fecha
			$('#dteFecha_ordenes_reparacion_servicio').datetimepicker({format: 'DD/MM/YYYY'});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.moneda_ordenes_reparacion_servicio').blur(function(){
                $('.moneda_ordenes_reparacion_servicio').formatCurrency({ roundToDecimalPlace: 2 });
            });

             /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_ordenes_reparacion_servicio').blur(function(){
                $('.cantidad_ordenes_reparacion_servicio').formatCurrency({ roundToDecimalPlace: 2 });
            });
            
			//Autocomplete para recuperar los datos de un tipo de servicio 
	        $('#txtServicioTipo_ordenes_reparacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar cajas de texto que hacen referencia al id del registro 
				   $('#txtServicioTipoID_ordenes_reparacion_servicio').val('');
				   //Hacer un llamado a la función para inicializar elementos del tipo de servicio
				   inicializar_servicio_tipo_ordenes_reparacion_servicio();
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
	               //Asignar valores del registro seleccionado
	               $('#txtServicioTipoID_ordenes_reparacion_servicio').val(ui.item.data);
	               $('#txtFacturarServicioTipo_ordenes_reparacion_servicio').val(ui.item.facturar);
	              
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
	        $('#txtServicioTipo_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id del tipo de servicio 
	            if($('#txtServicioTipoID_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtServicioTipo_ordenes_reparacion_servicio').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtServicioTipoID_ordenes_reparacion_servicio').val('');
	                $('#txtServicioTipo_ordenes_reparacion_servicio').val('');
	                //Hacer un llamado a la función para inicializar elementos del tipo de servicio
	                inicializar_servicio_tipo_ordenes_reparacion_servicio();
	                
	            }

	        });

			//Autocomplete para recuperar los datos de un prospecto o cliente
	        $('#txtProspecto_ordenes_reparacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
				   $('#txtProspectoID_ordenes_reparacion_servicio').val('');
				   //Hacer un llamado a la función para inicializar elementos del prospecto/cliente
	               inicializar_prospecto_ordenes_reparacion_servicio();
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
	             $('#txtProspectoID_ordenes_reparacion_servicio').val(ui.item.data);
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
	        $('#txtProspecto_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoID_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtProspecto_ordenes_reparacion_servicio').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtProspectoID_ordenes_reparacion_servicio').val('');
	                $('#txtProspecto_ordenes_reparacion_servicio').val('');
	                //Hacer un llamado a la función para inicializar elementos del prospecto/cliente
	              	inicializar_prospecto_ordenes_reparacion_servicio();
	            }

	        });

	        //Autocomplete para recuperar los datos de un tipo de equipo 
	        $('#txtEquipoTipo_ordenes_reparacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
				   $('#txtEquipoTipoID_ordenes_reparacion_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/equipos_tipos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intServicioTipoID: $('#txtServicioTipoID_ordenes_reparacion_servicio').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	              //Asignar datos del registro seleccionado
	              $('#txtEquipoTipoID_ordenes_reparacion_servicio').val(ui.item.data);
	             
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
	        $('#txtEquipoTipo_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id del tipo de equipo 
	            if($('#txtEquipoTipoID_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtEquipoTipo_ordenes_reparacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEquipoTipoID_ordenes_reparacion_servicio').val('');
	               $('#txtEquipoTipo_ordenes_reparacion_servicio').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una serie (dependiendo del tipo de servicio (Facturar = SI/NO))
	        $('#txtSerie_ordenes_reparacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
				   $('#txtSerieReferenciaID_ordenes_reparacion_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/prospectos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'series', 
	                   strFacturar:  $('#txtFacturarServicioTipo_ordenes_reparacion_servicio').val(),
	                   intProspectoID: $('#txtProspectoID_ordenes_reparacion_servicio').val(),
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtSerieReferenciaID_ordenes_reparacion_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de referencia de la serie cuando pierda el enfoque la caja de texto
	        $('#txtSerie_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id de referencia (prospectos_inventario/maquinaria_inventario) de la serie
	            if($('#txtSerieReferenciaID_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtSerie_ordenes_reparacion_servicio').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtSerieReferenciaID_ordenes_reparacion_servicio').val('');
	                $('#txtSerie_ordenes_reparacion_servicio').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una descripción de maquinaria
			$('#txtMaquinariaDescripcion_ordenes_reparacion_servicio').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
				    $('#txtMaquinariaDescripcionID_ordenes_reparacion_servicio').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "maquinaria/maquinaria_descripciones/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term,
							strTipo: 'codigo',
							strMovimientoRefaccionesInternas: ''
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtMaquinariaDescripcionID_ordenes_reparacion_servicio').val(ui.item.data);
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
	        $('#txtMaquinariaDescripcion_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id de la descripción de maquinaria
	           	if($('#txtMaquinariaDescripcionID_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtMaquinariaDescripcion_ordenes_reparacion_servicio').val() == '')
	            { 
	              	//Limpiar contenido de las siguientes cajas de texto
	               	$('#txtMaquinariaDescripcionID_ordenes_reparacion_servicio').val('');
	                $('#txtMaquinariaDescripcion_ordenes_reparacion_servicio').val('');
	            }
	        });

	        //Calcular el IVA desglosado despues de capturar gastos de servicio
	        $('#txtGastosServicio_ordenes_reparacion_servicio').focusout(function(e){

	           	//Hacer un llamado a la función para desglosar el IVA del gasto de servicio
	       	   	$.desglosarIvaGasto(arrDesglosarIvaGastoOrdenesReparacionServicio);

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
        	$('#txtHoras_mano_obra_ordenes_reparacion_servicio').numeric();
			$('#txtPrecio_mano_obra_ordenes_reparacion_servicio').numeric();
        
        	//Autocomplete para recuperar los datos de un servicio
			$('#txtCodigo_mano_obra_ordenes_reparacion_servicio').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val('');
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
					$('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val(ui.item.data);
					//Hacer un llamado a la función para regresar los datos del servicio
					get_datos_servicio_mano_obra_ordenes_reparacion_servicio();
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
	        $('#txtCodigo_mano_obra_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id del servicio
	            if($('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtCodigo_mano_obra_ordenes_reparacion_servicio').val() == '')
	            {
	               	//Hacer un llamado a la función para inicializar elementos del servicio
	              	inicializar_servicio_mano_obra_ordenes_reparacion_servicio();
	            }
	        });

	        //Autocomplete para recuperar los datos de un servicio
			$('#txtDescripcion_mano_obra_ordenes_reparacion_servicio').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val('');
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
					$('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val(ui.item.data);
					//Hacer un llamado a la función para regresar los datos del servicio
					get_datos_servicio_mano_obra_ordenes_reparacion_servicio();
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
	        $('#txtDescripcion_mano_obra_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id del servicio
	            if($('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtDescripcion_mano_obra_ordenes_reparacion_servicio').val() == '')
	            { 
	               	//Hacer un llamado a la función para inicializar elementos del servicio
	              	inicializar_servicio_mano_obra_ordenes_reparacion_servicio();
	            }

	        });

			//Autocomplete para recuperar los datos de un mecánico 
	        $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMecanicoID_mano_obra_ordenes_reparacion_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/mecanicos/autocomplete",
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
	             $('#txtMecanicoID_mano_obra_ordenes_reparacion_servicio').val(ui.item.data);
	             $('#txtCosto_mano_obra_ordenes_reparacion_servicio').val(ui.item.costo);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del mecánico cuando pierda el enfoque la caja de texto
	        $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id del mecánico
	            if($('#txtMecanicoID_mano_obra_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMecanicoID_mano_obra_ordenes_reparacion_servicio').val('');
	               $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').val('');
	               $('#txtCosto_mano_obra_ordenes_reparacion_servicio').val('');
	            }
	            
	        });

	        //Validar que exista código del servicio cuando se pulse la tecla enter 
			$('#txtCodigo_mano_obra_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
			   	    //Si no existe código del servicio
		            if($('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val() == '' || $('#txtCodigo_mano_obra_ordenes_reparacion_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCodigo_mano_obra_ordenes_reparacion_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista descripción del servicio cuando se pulse la tecla enter 
			$('#txtDescripcion_mano_obra_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe descripción del servicio
		            if($('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val() == '' || $('#txtDescripcion_mano_obra_ordenes_reparacion_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtDescripcion_mano_obra_ordenes_reparacion_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').focus();
			   	    }
		        }
		    });

		    
		    //Validar que exista mecánico cuando se pulse la tecla enter 
			$('#txtMecanico_mano_obra_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe mecánico
		            if($('#txtMecanicoID_mano_obra_ordenes_reparacion_servicio').val() == '' || $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtMecanico_mano_obra_ordenes_reparacion_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para guardar los datos del servicio de mano de obra
			   	    	guardar_mano_obra_ordenes_reparacion_servicio();
			   	    }
		        }
		    });

			//Paginación de registros
			$('#pagLinks_mano_obra_ordenes_reparacion_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaManoObraOrdenesReparacionServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar los servicios de mano de obra en el grid
				paginacion_mano_obra_ordenes_reparacion_servicio();
			});

			/*Asignar el precio del servicio correspondiente al tipo de equipo*/
			$(document).on('shown.bs.tab', 'a[href="#mano_obra_ordenes_reparacion_servicio"]', function (){
				//Si existe existe id del servicio de mano de obra
				if($('#txtServicioID_mano_obra_ordenes_reparacion_servicio').val() != '')
				{
					//Hacer un llamado a la función para regresar los datos del precio de un tipo de equipo
					get_precio_equipo_tipo_ordenes_reparacion_servicio();
				}
				
			});


			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Refacciones
        	*********************************************************************************************************************/
        	//Paginación de registros
			$('#pagLinks_salidas_refacciones_ordenes_reparacion_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaSalidasRefaccionesOrdenesReparacionServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar las salidas de refacciones por taller en el grid
				paginacion_salidas_refacciones_ordenes_reparacion_servicio();
			});


			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Trabajos Foráneos
        	*********************************************************************************************************************/
        	//Paginación de registros
			$('#pagLinks_trabajos_foraneos_ordenes_reparacion_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaTrabajosForaneosOrdenesReparacionServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar los trabajos foráneos en el grid
				paginacion_trabajos_foraneos_ordenes_reparacion_servicio();
			});

			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Otros
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtCantidad_otros_ordenes_reparacion_servicio').numeric();
			$('#txtPrecioUnitario_otros_ordenes_reparacion_servicio').numeric();
        	$('#txtPorcentajeDescuento_otros_ordenes_reparacion_servicio').numeric();
        	$('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').numeric();
        	$('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').numeric();


        	//Autocomplete para recuperar los datos de un producto o servicio
	        $('#txtProductoServicio_otros_ordenes_reparacion_servicio').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtProductoServicioID_otros_ordenes_reparacion_servicio').val('');
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
	               $('#txtProductoServicioID_otros_ordenes_reparacion_servicio').val(ui.item.data);
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
	        $('#txtProductoServicio_otros_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id del producto
	            if($('#txtProductoServicioID_otros_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtProductoServicio_otros_ordenes_reparacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProductoServicioID_otros_ordenes_reparacion_servicio').val('');
	               $('#txtProductoServicio_otros_ordenes_reparacion_servicio').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una unidad
	        $('#txtUnidad_otros_ordenes_reparacion_servicio').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtUnidadID_otros_ordenes_reparacion_servicio').val('');
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
	               $('#txtUnidadID_otros_ordenes_reparacion_servicio').val(ui.item.data);
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
	        $('#txtUnidad_otros_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id de la unidad
	            if($('#txtUnidadID_otros_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtUnidad_otros_ordenes_reparacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUnidadID_otros_ordenes_reparacion_servicio').val('');
	               $('#txtUnidad_otros_ordenes_reparacion_servicio').val('');
	            }
	            
	        });


	        //Autocomplete para recuperar los datos de un objeto de impuesto
	        $('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtObjetoImpuestoID_otros_ordenes_reparacion_servicio').val('');
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
	               $('#txtObjetoImpuestoID_otros_ordenes_reparacion_servicio').val(ui.item.data);
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
	        $('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id del objeto de impuesto
	            if($('#txtObjetoImpuestoID_otros_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtObjetoImpuestoID_otros_ordenes_reparacion_servicio').val('');
	               $('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').val('');
	            }
	            
	        });


	         //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_otros_ordenes_reparacion_servicio').val('');
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
	             $('#txtTasaCuotaIva_otros_ordenes_reparacion_servicio').val(ui.item.data);
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
	        $('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_otros_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_otros_ordenes_reparacion_servicio').val('');
	               $('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_otros_ordenes_reparacion_servicio').val('');
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
	             $('#txtTasaCuotaIeps_otros_ordenes_reparacion_servicio').val(ui.item.data);
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
	        $('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_otros_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_otros_ordenes_reparacion_servicio').val('');
	               $('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').val('');
	            }
	            
	        });


	        //Función para mover renglones arriba y abajo en la tabla
	        $('#dg_otros_ordenes_reparacion_servicio').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Verifica que no sea el último elemento del grid
	            	if( row.next().index() != -1 )
	            	{ 
	            		objOtrosOrdenOrdenesReparacionServicio.swap(row.index(), row.next().index() );
	            	}	

	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Verifica que no sea el primer elemento del grid
	            	if( row.prev().index() != -1 )
	            	{ 
	            		objOtrosOrdenOrdenesReparacionServicio.swap(row.prev().index(), row.index() );
	            	}
	            	//Pasar al renglón de arriba
	            	row.prev().before(row);
	            }
				
	        });

	        //Validar que exista concepto cuando se pulse la tecla enter 
			$('#txtConcepto_otros_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe concepto
		            if($('#txtConcepto_otros_ordenes_reparacion_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtConcepto_otros_ordenes_reparacion_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtProductoServicio_otros_ordenes_reparacion_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista producto o servicio SAT cuando se pulse la tecla enter 
			$('#txtProductoServicio_otros_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe producto o servicio SAT
		            if($('#txtProductoServicioID_otros_ordenes_reparacion_servicio').val() == '' || $('#txtProductoServicio_otros_ordenes_reparacion_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtProductoServicio_otros_ordenes_reparacion_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtUnidad_otros_ordenes_reparacion_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista unidad SAT cuando se pulse la tecla enter 
			$('#txtUnidad_otros_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe unidad SAT
		            if($('#txtUnidadID_otros_ordenes_reparacion_servicio').val() == '' || $('#txtUnidad_otros_ordenes_reparacion_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtUnidad_otros_ordenes_reparacion_servicio').focus();
			   	    }
			   	    else
			   	    {
						//Enfocar caja de texto
					    $('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').focus();
					  
			   	    }
		        }
		    });

		    //Validar que exista objeto de impuesto SAT cuando se pulse la tecla enter 
			$('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe objeto de impuesto SAT 
		            if($('#txtObjetoImpuestoID_otros_ordenes_reparacion_servicio').val() == '' || $('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtObjetoImpuesto_otros_ordenes_reparacion_servicio').focus();
			   	    }
			   	    else
			   	    {
						//Enfocar caja de texto
					    $('#txtCantidad_otros_ordenes_reparacion_servicio').focus();
					  
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_otros_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_otros_ordenes_reparacion_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_otros_ordenes_reparacion_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_otros_ordenes_reparacion_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_otros_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPrecioUnitario_otros_ordenes_reparacion_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPrecioUnitario_otros_ordenes_reparacion_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_otros_ordenes_reparacion_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_otros_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_otros_ordenes_reparacion_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_otros_ordenes_reparacion_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_otros_ordenes_reparacion_servicio').focus();
			   	    }
			   	    else
			   	    {

			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtTasaCuotaIeps_otros_ordenes_reparacion_servicio').val() == '' && 
		         	   $('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').val() != '')
		         	{
		         	
		         		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_otros_ordenes_reparacion_servicio').focus();
		         	}
		         	else
		         	{
		         		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_otros_ordenes_reparacion_servicio();
		         	}
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al modal Tiempos del Servicio de Mano de Obra
			*********************************************************************************************************************/
			//Autocomplete para recuperar los datos de un motivo de suspensión
			$('#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
				    $('#txtMotivoSuspensionID_tiempos_mano_obra_ordenes_reparacion_servicio').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "servicio/motivos_suspension/autocomplete",
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
					$('#txtMotivoSuspensionID_tiempos_mano_obra_ordenes_reparacion_servicio').val(ui.item.data);
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id del motivo de suspensión cuando pierda el enfoque la caja de texto
	        $('#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id del motivo de suspensión 
	           	if($('#txtMotivoSuspensionID_tiempos_mano_obra_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').val() == '')
	            { 
	              	//Limpiar contenido de las siguientes cajas de texto
	               	$('#txtMotivoSuspensionID_tiempos_mano_obra_ordenes_reparacion_servicio').val('');
	                $('#txtMotivoSuspension_tiempos_mano_obra_ordenes_reparacion_servicio').val('');
	            }
	        });

			//Paginación de registros
			$('#pagLinks_tiempos_mano_obra_ordenes_reparacion_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaTiemposManoObraOrdenesReparacionServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar los tiempos del servicio en el grid
				paginacion_tiempos_mano_obra_ordenes_reparacion_servicio();
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_ordenes_reparacion_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_ordenes_reparacion_servicio').datetimepicker({format: 'DD/MM/YYYY',
			 																		              useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_ordenes_reparacion_servicio').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_ordenes_reparacion_servicio').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_ordenes_reparacion_servicio').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_ordenes_reparacion_servicio').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un prospecto o cliente
	        $('#txtProspectoBusq_ordenes_reparacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_ordenes_reparacion_servicio').val('');
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
	             $('#txtProspectoIDBusq_ordenes_reparacion_servicio').val(ui.item.data);
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
	        $('#txtProspectoBusq_ordenes_reparacion_servicio').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_ordenes_reparacion_servicio').val() == '' ||
	               $('#txtProspectoBusq_ordenes_reparacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_ordenes_reparacion_servicio').val('');
	               $('#txtProspectoBusq_ordenes_reparacion_servicio').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_ordenes_reparacion_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaOrdenesReparacionServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_ordenes_reparacion_servicio();
			});

			//Abrir modal Ordenes de Trabajo cuando se de clic en el botón
			$('#btnNuevo_ordenes_reparacion_servicio').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_ordenes_reparacion_servicio();
				//Seleccionar tab que contiene la información general
		    	$('a[href="#informacion_general_ordenes_reparacion_servicio"]').click();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_ordenes_reparacion_servicio').addClass("estatus-NUEVO");
				//Abrir modal
				 objOrdenesReparacionServicio = $('#OrdenesReparacionServicioBox').bPopup({
											   appendTo: '#OrdenesReparacionServicioContent', 
				                               contentContainer: 'OrdenesReparacionServicioM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtServicioTipo_ordenes_reparacion_servicio').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_ordenes_reparacion_servicio').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_ordenes_reparacion_servicio();
		});
	</script>