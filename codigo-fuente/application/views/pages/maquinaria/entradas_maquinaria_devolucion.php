<div id="EntradasMaquinariaDevolucionMaquinariaContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_entradas_maquinaria_devolucion_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria"
			                    		name= "strFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria" 
			                    		type="text" 
			                    		value="" 
			                    		tabindex="1" 
			                    		placeholder="Ingrese fecha" 
			                    		maxlength="10"/>
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
							<label for="txtFechaFinalBusq_entradas_maquinaria_devolucion_maquinaria">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_entradas_maquinaria_devolucion_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_entradas_maquinaria_devolucion_maquinaria"
			                    		name= "strFechaFinalBusq_entradas_maquinaria_devolucion_maquinaria" 
			                    		type="text" 
			                    		value="" 
			                    		tabindex="1" 
			                    		placeholder="Ingrese fecha" 
			                    		maxlength="10"/>
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
						</div>
					</div>
				</div>
				<!--Cliente-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtClienteBusq_entradas_maquinaria_devolucion_maquinaria">Razón social</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtClienteIDBusq_entradas_maquinaria_devolucion_maquinaria" 
									name="strClienteIDBusq_entradas_maquinaria_devolucion_maquinaria" 
									type="hidden" />
							<input  class="form-control" 
									id="txtClienteBusq_entradas_maquinaria_devolucion_maquinaria" 
									name="strClienteBusq_entradas_maquinaria_devolucion_maquinaria" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese razón social"/>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbEstatusBusq_entradas_maquinaria_devolucion_maquinaria">Estatus</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbEstatusBusq_entradas_maquinaria_devolucion_maquinaria" 
							 		name="strEstatusBusq_entradas_maquinaria_devolucion_maquinaria" tabindex="1">
							    <option value="TODOS">TODOS</option>
                  				<option value="ACTIVO">ACTIVO</option> 
                  				<option value="TIMBRAR">TIMBRAR</option>            				
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
							<label for="txtBusqueda_entradas_maquinaria_devolucion_maquinaria">Descripción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtBusqueda_entradas_maquinaria_devolucion_maquinaria" 
									name="strBusqueda_entradas_maquinaria_devolucion_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Mostrar detalles de los registros en el reporte PDF--> 
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" 
                        			id="chbImprimirDetalles_entradas_maquinaria_devolucion_maquinaria" 
								   	name="strImprimirDetalles_entradas_maquinaria_devolucion_maquinaria" 
								   	type="checkbox"
								   	value="" 
								   	tabindex="1" />
							<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							Imprimir detalles
                    	</label>
                  	</div>
				</div>
				<!--Botones-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div id="ToolBtns" class="btn-group btn-toolBtns">
						<!-- Buscar registros -->
						<button class="btn btn-primary" id="btnBuscar_entradas_maquinaria_devolucion_maquinaria"
								onclick="paginacion_entradas_maquinaria_devolucion_maquinaria();" 
								title="Buscar coincidencias" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_entradas_maquinaria_devolucion_maquinaria" 
								title="Nuevo registro" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_entradas_maquinaria_devolucion_maquinaria"
								onclick="reporte_entradas_maquinaria_devolucion_maquinaria('PDF');" title="Generar reporte PDF" tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_entradas_maquinaria_devolucion_maquinaria"
								onclick="reporte_entradas_maquinaria_devolucion_maquinaria('XLS');" title="Descargar archivo XLS" tabindex="1" disabled>
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
			Definir columnas de la tabla movimientos
			*/
			td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
			td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
			td.movil.a3:nth-of-type(3):before {content: "Factura"; font-weight: bold;}
			td.movil.a4:nth-of-type(4):before {content: "Razón social"; font-weight: bold;}
			td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
			td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

			/*
			Definir columnas de la tabla CFDI a relacionar
			*/
			td.movil.b1:nth-of-type(1):before {content: "Referencia"; font-weight: bold;}
			td.movil.b2:nth-of-type(2):before {content: "Razón social"; font-weight: bold;}
			td.movil.b3:nth-of-type(3):before {content: "Folio"; font-weight: bold;}
			td.movil.b4:nth-of-type(4):before {content: "Fecha"; font-weight: bold;}
			td.movil.b5:nth-of-type(5):before {content: "Módulo"; font-weight: bold;}
			td.movil.b6:nth-of-type(6):before {content: "UUID"; font-weight: bold;}
			td.movil.b7:nth-of-type(7):before {content: "Importe"; font-weight: bold;}
			td.movil.b8:nth-of-type(8):before {content: "Seleccionar"; font-weight: bold;}

			/*
			Definir columnas de la tabla CFDI relacionados
			*/
			td.movil.c1:nth-of-type(1):before {content: "Razón social"; font-weight: bold;}
			td.movil.c2:nth-of-type(2):before {content: "Folio"; font-weight: bold;}
			td.movil.c3:nth-of-type(3):before {content: "Fecha"; font-weight: bold;}
			td.movil.c4:nth-of-type(4):before {content: "Módulo"; font-weight: bold;}
			td.movil.c5:nth-of-type(5):before {content: "UUID"; font-weight: bold;}
			td.movil.c6:nth-of-type(6):before {content: "Importe"; font-weight: bold;}
			td.movil.c7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

			/*
			Definir columnas de la tabla detalles del movimiento
			*/
			td.movil.d1:nth-of-type(1):before {content: "Serie"; font-weight: bold;}
			td.movil.d2:nth-of-type(2):before {content: "Motor"; font-weight: bold;}
			td.movil.d3:nth-of-type(3):before {content: "Código"; font-weight: bold;}
			td.movil.d4:nth-of-type(4):before {content: "Descripción"; font-weight: bold;}

		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_entradas_maquinaria_devolucion_maquinaria">
				<thead class="movil">
					<tr class="movil">
						<th class="movil">Folio</th>
						<th class="movil">Fecha</th>
						<th class="movil">Factura</th>
						<th class="movil">Razón social</th>
						<th class="movil">Estatus</th>
						<th class="movil" id="th-acciones" style="width:15em;">Acciones</th>
					</tr>
				</thead>
				<tbody class="movil"></tbody>
				<script id="plantilla_entradas_maquinaria_devolucion_maquinaria" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil a1">{{folio}}</td>
						<td class="movil a2">{{fecha}}</td>
						<td class="movil a3">{{folio_factura}}</td>
						<td class="movil a4">{{cliente}}</td>
						<td class="movil a5">{{estatus}}</td>
						<td class="td-center movil a6"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_entradas_maquinaria_devolucion_maquinaria({{movimiento_maquinaria_id}}, 'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_entradas_maquinaria_devolucion_maquinaria({{movimiento_maquinaria_id}}, 'Ver', {{cancelacion_id}})"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Ver motivo de cancelación-->
							<button class="btn btn-default btn-xs {{mostrarAccionMotivoCancelacion}}"  
									onclick="ver_cancelacion_entradas_maquinaria_devolucion_maquinaria({{cancelacion_id}})"  title="Ver motivo de cancelación">
									<i class="fa fa-info-circle" aria-hidden="true"></i>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
									onclick="abrir_cliente_entradas_maquinaria_devolucion_maquinaria({{movimiento_maquinaria_id}})"  title="Enviar correo electrónico">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_entradas_maquinaria_devolucion_maquinaria({{movimiento_maquinaria_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Generar póliza-->
							<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
									onclick="generar_poliza_entradas_maquinaria_devolucion_maquinaria({{movimiento_maquinaria_id}}, '{{estatus}}', 'principal')"  title="Generar póliza">
								<span class="glyphicon glyphicon-tags"></span>
							</button>
							<!--Timbrar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionTimbrar}}"  
									onclick="timbrar_entradas_maquinaria_devolucion_maquinaria({{movimiento_maquinaria_id}},'', 'principal', {{regimen_fiscal_id}})"  title="Timbrar">
								<span class="fa fa-certificate"></span>
							</button>
							<!--Descargar archivos-->
                        	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                        			 onmousedown="descargar_archivos_entradas_maquinaria_devolucion_maquinaria({{movimiento_maquinaria_id}}, '{{folio}}');" title="Descargar archivos">
                        		<span class="glyphicon glyphicon-download-alt"></span>
                        	</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_entradas_maquinaria_devolucion_maquinaria({{movimiento_maquinaria_id}}, '{{folio}}', {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_entradas_maquinaria_devolucion_maquinaria"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_entradas_maquinaria_devolucion_maquinaria">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!--Circulo de progreso-->
	<div id="divCirculoBarProgresoPrincipal_entradas_maquinaria_devolucion_maquinaria" class="load-container load5 circulo_bar no-mostrar">
		<div class="loader">Loading...</div>
		<br><br>
		<div align=center><b>Espere un momento por favor.</b></div>
	</div>

	<!-- Diseño del modal Enviar Correo Electrónico-->
	<div id="EnviarEntradasMaquinariaDevolucionMaquinariaBox" class="ModalBody  impresion-formato-modal-empleados">
		<!--Título-->
		<div id="divEncabezadoModal_cliente_entradas_maquinaria_devolucion_maquinaria" class="ModalBodyTitle confirmacion-modal-title">
		<h1>Enviar Correo Electrónico</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmEnviarEntradasMaquinariaDevolucionMaquinaria" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmEnviarEntradasMaquinariaDevolucionMaquinaria"  onsubmit="return(false)" autocomplete="off">
		 		<div class="row">
		 			<!--Cliente-->
		 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtMovimientoMaquinariaID_cliente_entradas_maquinaria_devolucion_maquinaria" 
									   name="intMovimientoMaquinariaID_cliente_entradas_maquinaria_devolucion_maquinaria" 
									   type="hidden" value="">
								</input>
								<!-- Caja de texto oculta que se utiliza para recuperar el folio del registro seleccionado-->
								<input id="txtFolio_cliente_entradas_maquinaria_devolucion_maquinaria" 
									   name="strFolio_cliente_entradas_maquinaria_devolucion_maquinaria" 
									   type="hidden" value="">
								</input>
								<label for="txtCliente_cliente_entradas_maquinaria_devolucion_maquinaria">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtCliente_cliente_entradas_maquinaria_devolucion_maquinaria" 
										name="strCliente_cliente_entradas_maquinaria_devolucion_maquinaria" type="text" value="" 
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
								<label for="txtCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria">Correo electrónico</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria" 
										name="strCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria" type="text" value="" 
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
								<label for="txtCopiaCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria">Copia</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria" 
										name="strCopiaCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria" type="text" value="" 
										tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
								</input>
							</div>
						</div>
					</div>
		 		</div>
		 		<!--Circulo de progreso-->
				<div id="divCirculoBarProgreso_cliente_entradas_maquinaria_devolucion_maquinaria" class="load-container load5 circulo_bar no-mostrar">
					<div class="loader">Loading...</div>
					<br><br>
					<div align=center><b>Espere un momento por favor.</b></div>
				</div> 
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Enviar correo electrónico-->
						<button class="btn btn-success" id="btnEnviarCorreo_cliente_entradas_maquinaria_devolucion_maquinaria"  
								onclick="validar_cliente_entradas_maquinaria_devolucion_maquinaria();"  title="Enviar correo electrónico" tabindex="1">
							<span class="glyphicon glyphicon-envelope"></span>
						</button>  
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_cliente_entradas_maquinaria_devolucion_maquinaria"
								type="reset" aria-hidden="true" onclick="cerrar_cliente_entradas_maquinaria_devolucion_maquinaria();" 
								title="Cerrar"  tabindex="1">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal Enviar Correo Electrónico-->

	<!-- Diseño del modal Relacionar CFDI-->
	<div id="RelacionarCfdiEntradasMaquinariaDevolucionMaquinariaBox" class="ModalBody">
		<!--Título-->
		<div id="divEncabezadoModal_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria" class="ModalBodyTitle">
			<h1>Relacionar CFDI</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria'>
				                    <input class="form-control" id="txtFechaInicialBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria"
				                    		name= "strFechaInicialBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria" 
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
								<label for="txtFechaFinalBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria'>
				                    <input class="form-control" id="txtFechaFinalBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria"
				                    		name= "strFechaFinalBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria" 
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
								<input id="txtProspectoIDBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria" 
									   name="intProspectoIDBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria"  type="hidden" 
									   value="">
								</input>
								<label for="txtClienteBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria">Razón social</label>
							</div>
							<div class="col-md-12">
								<div class="input-group">
									<input class="form-control" id="txtClienteBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria" 
										   name="strClienteBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria"  type="text" value="" 
										   tabindex="1" placeholder="Ingrese razón social" maxlength="250" >
									</input>
									<span class="input-group-btn">
										<button class="btn btn-primary" id="btnBuscar_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria"
												onclick="lista_facturas_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria();" title="Buscar coincidencias" tabindex="1">
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
					<!--Div que contiene la tabla con los CFDI encontrados-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<!-- Caja de texto oculta para asignar el número de registros de la tabla CFDI a relacionar--> 
						<input id="txtNumCfdi_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria" 
							   name="intNumCfdi_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria" type="hidden" value="">
						</input>
						<!-- Diseño de la tabla-->
						<table class="table-hover movil" id="dg_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria">
							<thead class="movil">
								<tr class="movil">
									<th class="movil">Razón social</th>
									<th class="movil">Folio</th>
									<th class="movil">Fecha</th>
									<th class="movil">Módulo</th>
									<th class="movil">UUID</th>
									<th class="movil">Importe</th>
									<th class="movil" id="th-acciones" style="width:8em;">Seleccionar</th>
								</tr>
							</thead>
							<tbody class="movil"></tbody>
							<script id="plantilla_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria" type="text/template"> 
							{{#rows}}
								<tr class="movil">  
									<td class="movil-no-mostrar no-mostrar b1">{{referencia_id}}</td>
									<td class="movil b2">{{cliente}}</td>
									<td class="movil b3">{{folio}}</td>
									<td class="movil b4">{{fecha}}</td>
									<td class="movil b5">{{tipo_referencia}}</td>
									<td class="movil b6">{{uuid}}</td>
									<td class="movil b7">{{importe}}</td>
									<td class="td-center movil b8"> 
										 <input 	type="checkbox" 
						    		class="form-check-input btn-xs" 
						    		id="chbAgregar_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria" />
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
									<strong id="numElementos_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria">0</strong> encontrados
								</button>
							</div>
						</div>
					</div>
				</div>			  
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Agregar CFDI´s-->
						<button class="btn btn-success" id="btnAgregar_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria"  
								onclick="validar_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria();"  title="Agregar" tabindex="1">
							<span class="glyphicon glyphicon-plus"></span>
						</button>  
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria"
								type="reset" aria-hidden="true" onclick="cerrar_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria();" 
								title="Cerrar" tabindex="1">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal Relacionar CFDI-->


	<!-- Diseño del modal Cancelación del timbrado-->
	<div id="CancelacionEntradasMaquinariaDevolucionMaquinariaBox" class="ModalBody  impresion-formato-modal-empleados">
		<!--Título-->
		<div id="divEncabezadoModal_cancelacion_entradas_maquinaria_devolucion_maquinaria" class="ModalBodyTitle confirmacion-modal-title">
		<h1>Cancelación</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmCancelacionEntradasMaquinariaDevolucionMaquinaria" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmCancelacionEntradasMaquinariaDevolucionMaquinaria"  onsubmit="return(false)" autocomplete="off">
		 		<div class="row">
		 			<!--Combobox que contiene los motivos de cancelación activos-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbCancelacionMotivoID_cancelacion_entradas_maquinaria_devolucion_maquinaria">Motivo</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select class="form-control" 
										id="cmbCancelacionMotivoID_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
								 		name="intCancelacionMotivoID_entradas_maquinaria_devolucion_maquinaria" 
								 		tabindex="1">
                 				</select>
							</div>
						</div>
					</div>
		 		</div>
		 		<div class="row">
		 			<!--Folio-->
		 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la factura-->
								<input id="txtReferenciaCfdiID_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
									   name="intReferenciaCfdiID_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
									   type="hidden" value="" />	

								<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
								<input id="txtPolizaID_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
									   name="intPolizaID_cancelacion_entradas_maquinaria_devolucion_maquinaria" type="hidden" value="" />

								<label for="txtFolio_cancelacion_entradas_maquinaria_devolucion_maquinaria">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtFolio_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
										name="strFolio_cancelacion_entradas_maquinaria_devolucion_maquinaria" type="text" value="" 
										disabled>
								</input>
							</div>
						</div>
					</div>
		 			<!--Autocomplete que contiene las facturas de refacciones activas (para su sustitución)-->
		 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtSustitucionID_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
									   name="intSustitucionID_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
									   type="hidden" value="" />	
								<!-- Caja de texto oculta que se utiliza para recuperar el UUID de la factura que sustituye-->
								<input id="txtUuidSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
									   name="strUuidSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
									   type="hidden" value="" />	   
								<label for="txtFolioSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria">Sustitución</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtFolioSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
										name="strFolioSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria" type="text" value="" 
										tabindex="1" placeholder="Ingrese anticipos" maxlength="250" >
								</input>
							</div>
						</div>
					</div>
		 		</div>
		 		<!--Div que contiene los campos del usuario y fecha del registro -->
		 		<div  id="divDatosCreacion_cancelacion_entradas_maquinaria_devolucion_maquinaria" class="row no-mostrar">
		 			<!--Usuario que realizó la cancelación-->
		 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtUsuarioCreacion_cancelacion_entradas_maquinaria_devolucion_maquinaria">Usuario de cancelación</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtUsuarioCreacion_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
										name="strUsuarioCreacion_cancelacion_entradas_maquinaria_devolucion_maquinaria" type="text" value="" 
										 disabled >
								</input>
							</div>
						</div>
					</div>
					<!--Fecha de cancelación-->
		 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaCreacion_cancelacion_entradas_maquinaria_devolucion_maquinaria">Fecha de cancelación</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtFechaCreacion_cancelacion_entradas_maquinaria_devolucion_maquinaria" 
										name="strFechaCreacion_cancelacion_entradas_maquinaria_devolucion_maquinaria" type="text" value="" 
										disabled>
								</input>
							</div>
						</div>
					</div>
		 		</div>
		 		<!--Circulo de progreso-->
				<div id="divCirculoBarProgreso_cancelacion_entradas_maquinaria_devolucion_maquinaria" class="load-container load5 circulo_bar no-mostrar">
					<div class="loader">Loading...</div>
					<br><br>
					<div align=center><b>Espere un momento por favor.</b></div>
				</div> 		 						
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Guardar cancelación del CFDI-->
						<button class="btn btn-success" id="btnGuardar_cancelacion_entradas_maquinaria_devolucion_maquinaria"  
								onclick="validar_cancelacion_entradas_maquinaria_devolucion_maquinaria();"  title="Cancelar CFDI" tabindex="1">
							<span class="fa fa-chain-broken"></span>
						</button>  
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_cancelacion_entradas_maquinaria_devolucion_maquinaria"
								type="reset" aria-hidden="true" onclick="cerrar_cancelacion_entradas_maquinaria_devolucion_maquinaria();" 
								title="Cerrar"  tabindex="1">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal Cancelación del timbrado-->


	<!-- Diseño del modal-->
	<div id="EntradasMaquinariaDevolucionMaquinariaBox" class="ModalBody"  tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_entradas_maquinaria_devolucion_maquinaria"  class="ModalBodyTitle">
			<h1>Entrada de maquinaria por devolución</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Tabs-->
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<ul class="nav nav-tabs  nav-justified" id="tabs_entradas_maquinaria_devolucion_maquinaria" role="tablist">
							<!--Tab que contiene la información general-->
							<li id="tabInformacionGeneral_entradas_maquinaria_devolucion_maquinaria" class="active">
								<a data-toggle="tab" href="#informacion_general_entradas_maquinaria_devolucion_maquinaria">Información General</a>
							</li>
							<!--Tab que contiene la información de los CFDI relacionados-->
							<li id="tabCfdiRelacionados_entradas_maquinaria_devolucion_maquinaria">
								<a data-toggle="tab" href="#cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria">CFDI Relacionados</a>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<!--Diseño del formulario-->
			<form id="frmEntradasMaquinariaDevolucionMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmEntradasMaquinariaDevolucionMaquinaria"  onsubmit="return(false)" autocomplete="off">
			   <!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
				<div class="tab-content">
					<!--Tab - Información General-->
					<div id="informacion_general_entradas_maquinaria_devolucion_maquinaria" class="tab-pane fade in active">
						<div class="row">
							<!-- Folio -->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
										<input id="txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria" 
											   name="intMovimientoCajaHerramientas_entradas_maquinaria_devolucion_maquinaria" 
											   type="hidden" 
											   value="" />
									    <!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
										<input id="txtEstatus_entradas_maquinaria_devolucion_maquinaria" 
											   name="strEstatus_entradas_maquinaria_devolucion_maquinaria" type="hidden" value="">
										</input>
										<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
										<input id="txtPolizaID_entradas_maquinaria_devolucion_maquinaria" 
											   name="intPolizaID_entradas_maquinaria_devolucion_maquinaria" type="hidden" value="" />
										 <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
										<input id="txtFolioPoliza_entradas_maquinaria_devolucion_maquinaria" 
											   name="strFolioPoliza_entradas_maquinaria_devolucion_maquinaria" type="hidden" value="" />
										<!-- Caja de texto oculta que se utiliza para recuperar el id de la cancelación del registro seleccionado-->
										<input id="txtCancelacionID_entradas_maquinaria_devolucion_maquinaria" 
												   name="intCancelacionID_entradas_maquinaria_devolucion_maquinaria" type="hidden" value="" />
										<label for="txtFolio_entradas_maquinaria_devolucion_maquinaria">Folio</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" 
										        id="txtFolio_entradas_maquinaria_devolucion_maquinaria" 
												name="strFolio_entradas_maquinaria_devolucion_maquinaria" 
												type="text" 
												value="" 
												tabindex="1" 
												placeholder="Autogenerado" 
												disabled />
									</div>
								</div>
							</div>
							<!-- Fecha -->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtFecha_entradas_maquinaria_devolucion_maquinaria">Fecha</label>
									</div>
									<div id="divFechaMsjValidacion" class="col-md-12">
										<div class='input-group date' id='dteFecha_entradas_maquinaria_devolucion_maquinaria'>
						                    <input class="form-control" 
						                    		id="txtFecha_entradas_maquinaria_devolucion_maquinaria"
						                    		name= "strFecha_entradas_maquinaria_devolucion_maquinaria" 
						                    		type="text" 
						                    		value="" 
						                    		tabindex="1" 
						                    		placeholder="Ingrese fecha" 
						                    		maxlength="10"/>
						                    <span class="input-group-addon">
						                        <span class="glyphicon glyphicon-calendar"></span>
						                    </span>
						                </div>
									</div>
								</div>
							</div>
							<!--Moneda-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id de la moneda-->
										<input id="txtMonedaID_entradas_maquinaria_devolucion_maquinaria" 
											   name="intMonedaID_entradas_maquinaria_devolucion_maquinaria"  
											   type="hidden"  value="" />
										<label for="txtMoneda_entradas_maquinaria_devolucion_maquinaria">Moneda</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtMoneda_entradas_maquinaria_devolucion_maquinaria" 
												name="strMoneda_entradas_maquinaria_devolucion_maquinaria" 
												type="text" value="" disabled />
									</div>
								</div>
							</div>
							<!--Tipo de cambio-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtTipoCambio_entradas_maquinaria_devolucion_maquinaria">Tipo de cambio</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtTipoCambio_entradas_maquinaria_devolucion_maquinaria" 
												name="intTipoCambio_entradas_maquinaria_devolucion_maquinaria" 
												type="text" value="" disabled/>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<!--Autocomplete que contiene las facturas de refacciones y servicios activas (timbradas)-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id de la factura seleccionada-->
										<input id="txtFacturaID_entradas_maquinaria_devolucion_maquinaria" 
											   name="intFacturaID_entradas_maquinaria_devolucion_maquinaria"  
											   type="hidden"  value="" />
									   <!-- Caja de texto oculta para recuperar el id del régimen fiscal del cliente seleccionado-->
										<input id="txtRegimenFiscalID_entradas_maquinaria_devolucion_maquinaria" 
											   name="intRegimenFiscalID_entradas_maquinaria_devolucion_maquinaria" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta para recuperar el id del régimen fiscal anterior (validar si es necesario modificar el régimen fiscal del registro  usado como referencia)-->
										<input id="txtRegimenFiscalIDAnterior_entradas_maquinaria_devolucion_maquinaria" 
											   name="intRegimenFiscalIDAnterior_entradas_maquinaria_devolucion_maquinaria" 
											   type="hidden" value="">
										</input>		
										<!-- Caja de texto oculta que se utiliza para recuperar el importe de la factura (para mostrarlo en la tabla CFDI relacionados)-->
										<input id="txtImporteFactura_entradas_maquinaria_devolucion_maquinaria" 
											   name="intImporteFactura_entradas_maquinaria_devolucion_maquinaria"  
											   type="hidden"  value="" />	   
										<label for="txtFactura_entradas_maquinaria_devolucion_maquinaria">Factura</label>
									</div>	
									<div class="col-md-12">
										<input  class="form-control" 
												id="txtFactura_entradas_maquinaria_devolucion_maquinaria" 
												name="strFactura_entradas_maquinaria_devolucion_maquinaria" 
												type="text" value="" tabindex="1" placeholder="Ingrese factura" maxlength="250" />
									</div>
								</div>	
							</div>
							<!--Razón social-->
							<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtRazonSocial_entradas_maquinaria_devolucion_maquinaria">Razón social</label>
									</div>
									<div class="col-md-12">
										<input class="form-control" id="txtRazonSocial_entradas_maquinaria_devolucion_maquinaria"
											   name="strRazonSocial_entradas_maquinaria_devolucion_maquinaria" 
											   type="text" value="" disabled />
									</div>
								</div>
							</div>
							<!--RFC-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtRfc_entradas_maquinaria_devolucion_maquinaria">RFC</label>
									</div>	
									<div class="col-md-12">
										<input  class="form-control" 
												id="txtRfc_entradas_maquinaria_devolucion_maquinaria" 
												name="strRfc_entradas_maquinaria_devolucion_maquinaria" 
												type="text" value="" disabled />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<!--Autocomplete que contiene las formas de pago activas-->
							<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta para recuperar el id de la forma de pago seleccionada-->
										<input id="txtFormaPagoID_entradas_maquinaria_devolucion_maquinaria" 
											   name="intFormaPagoID_entradas_maquinaria_devolucion_maquinaria" 
											   type="hidden" value="" />
										<label for="txtFormaPago_entradas_maquinaria_devolucion_maquinaria">
											Forma de pago
										</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtFormaPago_entradas_maquinaria_devolucion_maquinaria" 
												name="strFormaPago_entradas_maquinaria_devolucion_maquinaria" type="text" value=""  
												tabindex="1" placeholder="Ingrese forma de pago" maxlength="250" />
									</div>
								</div>
							</div>
							<!--Autocomplete que contiene los métodos de pago activos-->
							<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta para recuperar el id del método de pago seleccionado-->
										<input id="txtMetodoPagoID_entradas_maquinaria_devolucion_maquinaria" 
											   name="intMetodoPagoID_entradas_maquinaria_devolucion_maquinaria" 
											   type="hidden" value="" />
										<label for="txtMetodoPago_entradas_maquinaria_devolucion_maquinaria">
											Método de pago
										</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtMetodoPago_entradas_maquinaria_devolucion_maquinaria" 
												name="strMetodoPago_entradas_maquinaria_devolucion_maquinaria" type="text" value=""  
												tabindex="1" placeholder="Ingrese método de pago" maxlength="250" />
									</div>
								</div>
							</div>
							<!--Combobox que contiene la exportación activa-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="cmbExportacionID_entradas_maquinaria_devolucion_maquinaria">Exportación</label>
									</div>
									<div id="divCmbMsjValidacion" class="col-md-12">
										<select class="form-control" id="cmbExportacionID_entradas_maquinaria_devolucion_maquinaria"
										        name="intExportacionID_entradas_maquinaria_devolucion_maquinaria" tabindex="1">
	                     				</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<!--Autocomplete que contiene los usos de cfdi activos-->
							<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta para recuperar el id del uso de cfdi seleccionado-->
										<input id="txtUsoCfdiID_entradas_maquinaria_devolucion_maquinaria" 
											   name="intUsoCfdiID_entradas_maquinaria_devolucion_maquinaria" 
											   type="hidden" value="" />
										<label for="txtUsoCfdi_entradas_maquinaria_devolucion_maquinaria">
											Uso del CFDI
										</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtUsoCfdi_entradas_maquinaria_devolucion_maquinaria" 
												name="strUsoCfdi_entradas_maquinaria_devolucion_maquinaria" type="text" value=""  
												tabindex="1" placeholder="Ingrese uso del CFDI" maxlength="250" />
									</div>
								</div>
							</div>
							<!--Autocomplete que contiene los tipos de relación activos-->
							<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta para recuperar el id del tipo de relación seleccionado-->
										<input id="txtTipoRelacionID_entradas_maquinaria_devolucion_maquinaria" 
											   name="intTipoRelacionID_entradas_maquinaria_devolucion_maquinaria" 
											   type="hidden" value="" />
										<label for="txtTipoRelacion_entradas_maquinaria_devolucion_maquinaria">
											Tipo de relación
										</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtTipoRelacion_entradas_maquinaria_devolucion_maquinaria" 
												name="strTipoRelacion_entradas_maquinaria_devolucion_maquinaria" type="text" value=""  
												tabindex="1" placeholder="Ingrese tipo de relación" maxlength="250" />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Observaciones -->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtObservaciones_entradas_maquinaria_devolucion_maquinaria">Observaciones</label>
									</div>	
									<div class="col-md-12">
										<input  class="form-control" 
												id="txtObservaciones_entradas_maquinaria_devolucion_maquinaria" 
												name="strObservaciones_entradas_maquinaria_devolucion_maquinaria" 
												type="text" 
												value="" 
												tabindex="1" 
												placeholder="Ingrese observaciones" 
												maxlength="250" />			
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
										<input 	id="txtNumDetalles_entradas_maquinaria_devolucion_maquinaria" 
									   			name="intNumDetalles_entradas_maquinaria_devolucion_maquinaria" 
									   			type="hidden" value="" /> 
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">Detalles de la entrada por devolución</h4>
											</div>
											<div class="panel-body">
												<div class="row">
													<!--Div que contiene la tabla con los detalles encontrados-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!-- Diseño de la tabla-->
															<table class="table-hover movil" id="dg_detalles_entradas_maquinaria_devolucion_maquinaria">
																<thead class="movil">
																	<tr class="movil">
																		<th class="movil">Serie</th>
																		<th class="movil">Motor</th>
																		<th class="movil">Código</th>
																		<th class="movil">Descripción</th>
																	</tr>
																</thead>
																<tbody class="movil"></tbody>
																<tfoot class="movil">
																</tfoot>
															</table>
															<br>
															<div class="row">
																<!--Número de registros encontrados-->
																<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																	<button class="btn btn-default btn-sm disabled pull-right">
																		<strong id="numElementos_detalles_entradas_maquinaria_devolucion_maquinaria">0</strong> encontrados
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
					<!--Cierre Tab - Información General-->
					<!--Tab - CFDI relacionados-->
					<div id="cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria" class="tab-pane fade">
						<div class="row">
							<!--Botones-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<div class="btn-group pull-right">
									<!--Buscar CFDI a relacionar para agregarlos en la tabla-->
									<button class="btn btn-primary" 
	                                			id="btnBuscarCFDI_entradas_maquinaria_devolucion_maquinaria" 
	                                			onclick="abrir_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria();" 
	                                	     	title="Buscar CFDI" tabindex="1"> 
	                                		<span class="glyphicon glyphicon-search"></span>
	                                		 Relacionar CFDI
	                                </button>
								</div>
							</div>
						</div>
						<br>
						<div class="form-group row">
							<!--Div que contiene la tabla con los detalles encontrados-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<!-- Caja de texto oculta para asignar el número de registros de la tabla CFDI a relacionar--> 
								<input id="txtNumCfdiRelacionados_entradas_maquinaria_devolucion_maquinaria" 
									   name="intNumCfdiRelacionados_entradas_maquinaria_devolucion_maquinaria" type="hidden" value="" />
								<!-- Diseño de la tabla-->
								<table class="table-hover movil" id="dg_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria">
									<thead class="movil">
										<tr class="movil">
											<th class="movil">Razón social</th>
											<th class="movil">Folio</th>
											<th class="movil">Fecha</th>
											<th class="movil">Módulo</th>
											<th class="movil">UUID</th>
											<th class="movil">Importe</th>
											<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
										</tr>
									</thead>
									<tbody class="movil"></tbody>
								</table>
								<br>
								<div class="row">
									<!--Número de registros encontrados-->
									<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
										<button class="btn btn-default btn-sm disabled pull-right">
											<strong id="numElementos_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria">0</strong> encontrados
										</button>
									</div>
								</div>
							</div>
						</div>
					</div><!--Cierre del contenido del tab - CFDI relacionados-->	
				</div>
				<!--Cierre tab-content -->	
				<!--Circulo de progreso-->
				<div id="divCirculoBarProgreso_entradas_maquinaria_devolucion_maquinaria" class="load-container load5 circulo_bar no-mostrar">
					<div class="loader">Loading...</div>
					<br><br>
					<div align=center><b>Espere un momento por favor.</b></div>
				</div> 
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Nuevo registro-->
						<button class="btn btn-info" 
								id="btnReiniciar_entradas_maquinaria_devolucion_maquinaria"  
								onclick="nuevo_entradas_maquinaria_devolucion_maquinaria('Nuevo');"  
								title="Nuevo registro" 
								tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" 
								id="btnGuardar_entradas_maquinaria_devolucion_maquinaria"  
								onclick="validar_entradas_maquinaria_devolucion_maquinaria();"  
								title="Guardar" 
								tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Enviar correo electrónico-->
						<button class="btn btn-default" id="btnEnviarCorreo_entradas_maquinaria_devolucion_maquinaria"  
								onclick="abrir_cliente_entradas_maquinaria_devolucion_maquinaria('');"  
								title="Enviar correo electrónico" tabindex="3" disabled>
							<span class="glyphicon glyphicon-envelope"></span>
						</button> 
						<!--Ver motivo de cancelación del registro-->
						<button class="btn btn-default" id="btnVerMotivoCancelacion_entradas_maquinaria_devolucion_maquinaria"  
								onclick="ver_cancelacion_entradas_maquinaria_devolucion_maquinaria('');"  title="Ver motivo de cancelación" tabindex="4">
							<i class="fa fa-info-circle" aria-hidden="true"></i>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_entradas_maquinaria_devolucion_maquinaria"  
								onclick="reporte_registro_entradas_maquinaria_devolucion_maquinaria('');"  
								title="Imprimir" 
								tabindex="5" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Descargar archivos-->
	                    <button class="btn btn-default" id="btnDescargarArchivo_entradas_maquinaria_devolucion_maquinaria"  
								onclick="descargar_archivos_entradas_maquinaria_devolucion_maquinaria('','');"  title="Descargar archivos" tabindex="6" disabled>
							<span class="glyphicon glyphicon-download-alt"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" 
								id="btnDesactivar_entradas_maquinaria_devolucion_maquinaria"  
								onclick="cambiar_estatus_entradas_maquinaria_devolucion_maquinaria('', '', '', '');"  
								title="Desactivar" 
								tabindex="7" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  
								id="btnCerrar_entradas_maquinaria_devolucion_maquinaria"
								type="reset" 
								aria-hidden="true" 
								onclick="cerrar_entradas_maquinaria_devolucion_maquinaria();" 
								title="Cerrar"  
								tabindex="8">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal-->

</div><!--#EntradasMaquinariaDevolucionMaquinariaContent -->



<!-- /.Plantilla para cargar los motivo de cancelación en el combobox-->  
<script id="cancelacion_motivos_entradas_maquinaria_devolucion_maquinaria" type="text/template">
	<option value="">Seleccione una opción</option>
	{{#motivos}}
	<option value="{{value}}">{{nombre}}</option>
	{{/motivos}} 
</script>

<!-- /.Plantilla para cargar la exportación en el combobox-->  
<script id="exportacion_entradas_maquinaria_devolucion_maquinaria" type="text/template">
	<option value="">Seleccione una opción</option>
	{{#exportacion}}
	<option value="{{value}}">{{nombre}}</option>
	{{/exportacion}} 
</script>


<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variables que se utilizan para la paginación de registros
	var intPaginaEntradasMaquinariaDevolucionMaquinaria = 0;
	var strUltimaBusquedaEntradasMaquinariaDevolucionMaquinaria = "";
	/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
	var strTipoReferenciaPolizaEntradasMaquinariaDevolucionMaquinaria = "MOVIMIENTO DE MAQUINARIA";
	

	/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar en el timbrado y cfdi's relacionados)*/
	var strTipoReferenciaEntradasMaquinariaDevolucionMaquinaria = "DEVOLUCION MAQUINARIA";
	//Constante que se utiliza para definir el tipo de movimiento en la tabla movimientos maquinaria
	var intTipoMovimientoBDEntradasMaquinariaDevolucionMaquinaria = <?php echo ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA ?>;
	//Variable que se utiliza para asignar el id del motivo de cancelación: Comprobante emitido con errores con relación.
	var intCancelacionIDRelacionCfdiEntradasMaquinariaDevolucionMaquinaria = <?php echo MOTIVO_CANCELACION_RELACIONCFDI ?>;
	//Variable que se utiliza para asignar el id de la exportación base
	var intExportacionBaseIDEntradasMaquinariaDevolucionMaquinaria = <?php echo EXPORTACION_BASE ?>;
	//Variable que se utiliza para asignar el mensaje de régimen fiscal faltante.
	var strMsjRegimenFiscalCteEntradasMaquinariaDevolucionMaquinaria = "<?php echo MSJ_ERROR_REGIMEN_FISCAL ?>";

	//Variable que se utiliza para asignar objeto del modal Cancelación del timbrado
	var objCancelacionEntradasMaquinariaDevolucionMaquinaria = null;
	//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
	var objEnviarEntradasMaquinariaDevolucionMaquinaria = null;
	//Variable que se utiliza para asignar objeto del modal Relacionar CFDI
	var objRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria = null;
	//Variable que se utiliza para asignar objeto del modal
	var objEntradasMaquinariaDevolucionMaquinaria = null;
	
	/*******************************************************************************************************************
	Funciones del objeto Entrada por devolución
	*********************************************************************************************************************/
	// Constructor de Entrada
	var objEntrada;
	function Entrada(id, referenciaID, tipoMovimiento, folio, fecha, moneda, tipoCambio, formaPago, metodoPago, usoCfdi, tipoRelacion, observaciones, prospectoID, maquinarias)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intReferenciaID = referenciaID;
	    this.strTipoMovimiento = tipoMovimiento;
	    this.strFolio = folio;
	    this.strFecha = fecha;

	    this.intMonedaID = moneda;
	    this.intTipoCambio = tipoCambio;
	    this.intFormaPagoID = formaPago;
	    this.intMetodoPagoID = metodoPago;
	    this.intUsoCfdiID = usoCfdi;
	    this.intTipoRelacionID = tipoRelacion;

	    this.intProspectoID = prospectoID;
	    this.strObservaciones = observaciones;
	    this.arrMaquinarias = maquinarias;
	}
	// --------------------- MÉTODOS PARA EL OBJETO ENTRADA ------------------------------------------------------------
	Entrada.prototype.setID = function(id) { this.intMovimientoMaquinariaID = id; }
	Entrada.prototype.getID = function() { return this.intMovimientoMaquinariaID; }
	Entrada.prototype.setReferenciaID = function(referenciaID) { this.intReferenciaID = referenciaID; }
	Entrada.prototype.getReferenciaID = function() { return this.intReferenciaID; }
	Entrada.prototype.setTipoMovimiento = function(tipoMovimiento) { this.strTipoMovimiento = tipoMovimiento; }
	Entrada.prototype.getTipoMovimiento = function() { return this.strTipoMovimiento; }
	Entrada.prototype.setFolio = function(folio) { this.strFolio = folio; }
	Entrada.prototype.getFolio = function() { return this.strFolio; }
	Entrada.prototype.setFecha = function(fecha) { this.strFecha = fecha; }
	Entrada.prototype.getFecha = function() { return this.strFecha; }

	Entrada.prototype.setMonedaID = function(moneda) { this.intMonedaID = moneda; }
	Entrada.prototype.getMonedaID = function() { return this.intMonedaID; }
	Entrada.prototype.setTipoCambio = function(tipoCambio) { this.intTipoCambio = tipoCambio; }
	Entrada.prototype.getTipoCambio = function() { return this.intTipoCambio; }
	Entrada.prototype.setFormaPagoID = function(formaPago) { this.intFormaPagoID = formaPago; }
	Entrada.prototype.getFormaPagoID = function() { return this.intFormaPagoID; }
	Entrada.prototype.setMetodoPagoID = function(metodoPago) { this.intMetodoPagoID = metodoPago; }
	Entrada.prototype.getMetodoPagoID = function() { return this.intMetodoPagoID; }
	Entrada.prototype.setUsoCfdiID = function(usoCfdi) { this.intUsoCfdiID = usoCfdi; }
	Entrada.prototype.getUsoCfdiID = function() { return this.intUsoCfdiID; }
	Entrada.prototype.setTipoRelacionID = function(tipoRelacion) { this.intTipoRelacionID = tipoRelacion; }
	Entrada.prototype.getTipoRelacionID = function() { return this.intTipoRelacionID; }



	Entrada.prototype.setProspectoID = function(prospectoID) { this.intProspectoID = prospectoID; }
	Entrada.prototype.getProspectoID = function() { return this.intProspectoID; }
	Entrada.prototype.setObservaciones = function(observaciones) { this.strObservaciones = observaciones; }
	Entrada.prototype.getObservaciones = function() { return this.strObservaciones; }
	// -------------------- FUNCIONES ASOCIADAS AL ATRIBUTO MAQUINARIAS ---------------------------------------------------
	//Función para agregar todas las maquinarias al objeto Entrada
	Entrada.prototype.setMaquinarias = function(maquinarias) { this.arrMaquinarias = maquinarias; }
	//Función para obtener todas las maquinarias del objeto Entrada
	Entrada.prototype.getMaquinarias = function() { return this.arrMaquinarias; }
	//Función para agregar una maquinaria al objeto Entrada
	Entrada.prototype.setMaquinaria = function (maquinaria){ this.arrMaquinarias.push(maquinaria); }
	//Función para obtener una maquinaria del objeto Entrada
	Entrada.prototype.getMaquinaria = function(index) { return this.arrMaquinarias[index]; }
	//Función para modificar un objeto maquinaria del objeto Entrada
	Entrada.prototype.updateMaquinaria = function (index, maquinaria){ this.arrMaquinarias[index] = maquinaria; }
	//Función para eliminar una maquinaria del objeto Entrada
	Entrada.prototype.deleteMaquinaria = function (index){
		if(index != -1) {
			this.arrMaquinarias.splice(index, 1);
		}
	}
	//Función para cambiar las posiciones de las preguntas en el Objeto Encuesta
	Entrada.prototype.swap = function(index_A, index_B) {
	    var input = this.arrMaquinarias;
	 
	    var temp = input[index_A];
	    input[index_A] = input[index_B];
	    input[index_B] = temp;
	}


	/*******************************************************************************************************************
	Funciones del objeto Maquinaria
	*********************************************************************************************************************/
	// Constructor de Maquinaria
	var objMaquinaria;
	function Maquinaria(id, renglon, maquinariaDescripcionID, codigo, descripcionCorta, descripcion, serie, motor, numeroPedimento, consignacion)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intRenglon = renglon;
	    this.strMaquinariaDescripcionID = maquinariaDescripcionID;
	    this.strCodigo = codigo;
	    this.strDescripcionCorta = descripcionCorta;
	    this.strDescripcion = descripcion;
	    this.strSerie = serie;
	    this.strMotor = motor;
	    this.numPedimento = numeroPedimento;
	    this.strConsignacion = consignacion;
	}
	// --------------------- MÉTODOS PARA EL OBJETO MAQUINARIA ------------------------------------------------------------
	Maquinaria.prototype.setID = function(id) { this.intMovimientoMaquinariaID = id; }
	Maquinaria.prototype.getID = function() { return this.intMovimientoMaquinariaID; }
	Maquinaria.prototype.setRenglon = function(renglon) { this.intRenglon = renglon; }
	Maquinaria.prototype.getRenglon = function() { return this.intRenglon; }
	Maquinaria.prototype.setMaquinariaDescripcionID = function(maquinariaDescripcionID) { this.strMaquinariaDescripcionID = maquinariaDescripcionID; }
	Maquinaria.prototype.getMaquinariaDescripcionID = function() { return this.strMaquinariaDescripcionID; }
	Maquinaria.prototype.setMaquinariaDescripcion = function(maquinariaDescripcion) { this.strMaquinariaDescripcion = maquinariaDescripcion; }
	Maquinaria.prototype.getMaquinariaDescripcion = function() { return this.strMaquinariaDescripcion; }
	Maquinaria.prototype.setCodigo = function(codigo) { this.strCodigo = codigo; }
	Maquinaria.prototype.getCodigo = function() { return this.strCodigo; }
	Maquinaria.prototype.setDescripcionCorta = function(descripcionCorta) { this.strDescripcionCorta = descripcionCorta; }
	Maquinaria.prototype.getDescripcionCorta = function() { return this.strDescripcionCorta; }
	Maquinaria.prototype.setDescripcion = function(descripcion) { this.strDescripcion = descripcion; }
	Maquinaria.prototype.getDescripcion = function() { return this.strDescripcion; }
	Maquinaria.prototype.setSerie = function(serie) { this.strSerie = serie; }
	Maquinaria.prototype.getSerie = function() { return this.strSerie; }
	Maquinaria.prototype.setMotor = function(motor) { this.strMotor = motor; }
	Maquinaria.prototype.getMotor = function() { return this.strMotor; }
	Maquinaria.prototype.setNumeroPedimento = function(motor) { this.numPedimento = numeroPedimento; }
	Maquinaria.prototype.getNumeroPedimento = function() { return this.numPedimento; }
	Maquinaria.prototype.setConsignacion = function(motor) { this.strConsignacion = consignacion; }
	Maquinaria.prototype.getConsignacion = function() { return this.strConsignacion; }


	/*******************************************************************************************************************
	Funciones del objeto CFDI's  relacionados (facturas seleccionadas)
	*********************************************************************************************************************/
	// Constructor del objeto CFDI's relacionados (facturas seleccionadas)
	var objCfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria;
	function CfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria(cfdis)
	{
		this.arrCfdis = cfdis;
	}

	//Función para obtener todos los cfdi´s seleccionados
	CfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria.prototype.getCfdis = function() {
	    return this.arrCfdis;
	}

	//Función para agregar un cfdi al objeto 
	CfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria.prototype.setCfdi = function (cfdi){
		this.arrCfdis.push(cfdi);
	}

	//Función para obtener un cfdi del objeto 
	CfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria.prototype.getCfdi = function(index) {
	    return this.arrCfdis[index];
	}


	/*******************************************************************************************************************
	Funciones del objeto CFDI a relacionar
	*********************************************************************************************************************/
	// Constructor del objeto CFDI a relacionar
	var objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria;
	
	function CfdiRelacionarEntradasMaquinariaDevolucionMaquinaria(referenciaID, cliente, folio, fecha, tipoReferencia, uuid, importe)
	{
	    this.intReferenciaID = referenciaID;
	    this.strCliente = cliente;
	    this.strFolio = folio;
	    this.dteFecha = fecha;
	    this.strTipoReferencia = tipoReferencia;
	    this.strUuid = uuid;
	    this.intImporte = importe;
	}

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_entradas_maquinaria_devolucion_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('maquinaria/entradas_maquinaria_devolucion/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_entradas_maquinaria_devolucion_maquinaria').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosEntradasMaquinariaDevolucionMaquinaria = data.row;
				//Separar la cadena 
				var arrPermisosEntradasMaquinariaDevolucionMaquinaria = strPermisosEntradasMaquinariaDevolucionMaquinaria.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosEntradasMaquinariaDevolucionMaquinaria.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosEntradasMaquinariaDevolucionMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosEntradasMaquinariaDevolucionMaquinaria[i]=='GUARDAR') || (arrPermisosEntradasMaquinariaDevolucionMaquinaria[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
					}
					//Si el indice es VER REGISTRO
					else if(arrPermisosEntradasMaquinariaDevolucionMaquinaria[i]=='VER REGISTRO')
					{
						//Habilitar el control (botón descargar archivo)
					    $('#btnDescargarArchivo_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosEntradasMaquinariaDevolucionMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_entradas_maquinaria_devolucion_maquinaria();
					}
					else if(arrPermisosEntradasMaquinariaDevolucionMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
						
					}
					else if(arrPermisosEntradasMaquinariaDevolucionMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosEntradasMaquinariaDevolucionMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosEntradasMaquinariaDevolucionMaquinaria[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
					{
						//Habilitar el control (botón enviar correo)
						$('#btnEnviarCorreo_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosEntradasMaquinariaDevolucionMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_entradas_maquinaria_devolucion_maquinaria() 
	{

		 //Concatenar datos para la nueva búsqueda
		var strNuevaBusquedaEntradasMaquinariaDevolucionMaquinaria =($('#txtFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria').val()+$('#txtFechaFinalBusq_entradas_maquinaria_devolucion_maquinaria').val()+$('#txtClienteIDBusq_entradas_maquinaria_devolucion_maquinaria').val()+$('#cmbEstatusBusq_entradas_maquinaria_devolucion_maquinaria').val()+$('#txtBusqueda_entradas_maquinaria_devolucion_maquinaria').val());

		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaEntradasMaquinariaDevolucionMaquinaria != strUltimaBusquedaEntradasMaquinariaDevolucionMaquinaria)
		{
			intPaginaEntradasMaquinariaDevolucionMaquinaria = 0;
			strUltimaBusquedaEntradasMaquinariaDevolucionMaquinaria = strNuevaBusquedaEntradasMaquinariaDevolucionMaquinaria;
		}


		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('maquinaria/entradas_maquinaria_devolucion/get_paginacion',
				{	
					dteFechaInicial:$.formatFechaMysql($('#txtFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria').val()),
				    dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_entradas_maquinaria_devolucion_maquinaria').val()),
				    intProspectoID: $('#txtClienteIDBusq_entradas_maquinaria_devolucion_maquinaria').val(),
	    			strEstatus:     $('#cmbEstatusBusq_entradas_maquinaria_devolucion_maquinaria').val(),
	    			strBusqueda:    $('#txtBusqueda_entradas_maquinaria_devolucion_maquinaria').val(),
					intPagina:intPaginaEntradasMaquinariaDevolucionMaquinaria,
					strPermisosAcceso: $('#txtAcciones_entradas_maquinaria_devolucion_maquinaria').val()
				},
				function(data){
					$('#dg_entradas_maquinaria_devolucion_maquinaria tbody').empty();
					var tmpEntradasMaquinariaDevolucionMaquinaria = Mustache.render($('#plantilla_entradas_maquinaria_devolucion_maquinaria').html(),data);
					$('#dg_entradas_maquinaria_devolucion_maquinaria tbody').html(tmpEntradasMaquinariaDevolucionMaquinaria);
					$('#pagLinks_entradas_maquinaria_devolucion_maquinaria').html(data.paginacion);
					$('#numElementos_entradas_maquinaria_devolucion_maquinaria').html(data.total_rows);
					intPaginaEntradasMaquinariaDevolucionMaquinaria = data.pagina;
				},
		'json');
	}

	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_entradas_maquinaria_devolucion_maquinaria(tipoAccion)
	{
		
		//Incializar formulario
		$('#frmEntradasMaquinariaDevolucionMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_entradas_maquinaria_devolucion_maquinaria();
		//Limpiar cajas de texto ocultas
		$('#frmEntradasMaquinariaDevolucionMaquinaria').find('input[type=hidden]').val('');
		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
		$.removerClasesEncabezado('divEncabezadoModal_entradas_maquinaria_devolucion_maquinaria');

		//Seleccionar tab que contiene la información general del movimiento
		$('a[href="#informacion_general_entradas_maquinaria_devolucion_maquinaria"]').click();
		//Habilitar todos los elementos del formulario
	    $('#frmEntradasMaquinariaDevolucionMaquinaria').find('input, textarea, select').attr('disabled', false);
		//Hacer un llamado a la función para inicializar elementos de las tablas detalles y CFDI´s relacionados
		inicializar_detalles_entradas_maquinaria_devolucion_maquinaria();	

			
		/******************************************************************
		* INICIALIZACIÓN DE ELEMENTOS - ESTADO DEFAULT
		*******************************************************************/	
		//ID Movimiento
		$('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val('');
		//Folio
		$('#txtFolio_entradas_maquinaria_devolucion_maquinaria').val('');
		//Fecha
		$('#txtFecha_entradas_maquinaria_devolucion_maquinaria').val(fechaActual()); 
		//Cliente
		$('#txtCliente_entradas_maquinaria_devolucion_maquinaria').attr('disabled', true);

		$('#txtFolio_entradas_maquinaria_devolucion_maquinaria').attr('disabled', true);
		$('#txtMoneda_entradas_maquinaria_devolucion_maquinaria').attr('disabled', true);
		$('#txtTipoCambio_entradas_maquinaria_devolucion_maquinaria').attr('disabled', true);
		$('#txtRazonSocial_entradas_maquinaria_devolucion_maquinaria').attr('disabled', true);
		$('#txtRfc_entradas_maquinaria_devolucion_maquinaria').attr('disabled', true);

		$('#txtClienteID_entradas_maquinaria_devolucion_maquinaria').val('');
		$('#txtCliente_entradas_maquinaria_devolucion_maquinaria').val('');
		//Observaciones
		$('#txtObservaciones_entradas_maquinaria_devolucion_maquinaria').val('');
		
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_entradas_maquinaria_devolucion_maquinaria').addClass("estatus-NUEVO");
		}
	    
	    nuevo_objeto_entrada();

	    //Mostrar por Default 01- No aplica
		$('#cmbExportacionID_entradas_maquinaria_devolucion_maquinaria').val(intExportacionBaseIDEntradasMaquinariaDevolucionMaquinaria);


		//Mostrar los siguientes botones
		$("#btnGuardar_entradas_maquinaria_devolucion_maquinaria").show();
		$("#btnBuscarCFDI_entradas_maquinaria_devolucion_maquinaria").show(); 
		$("#btnReiniciar_entradas_maquinaria_devolucion_maquinaria").show(); 
		//Ocultar los siguientes botones
		$("#btnEnviarCorreo_entradas_maquinaria_devolucion_maquinaria").hide();
		$("#btnImprimirRegistro_entradas_maquinaria_devolucion_maquinaria").hide();
		$("#btnDescargarArchivo_entradas_maquinaria_devolucion_maquinaria").hide();
		$("#btnDesactivar_entradas_maquinaria_devolucion_maquinaria").hide();
		$('#btnVerMotivoCancelacion_entradas_maquinaria_devolucion_maquinaria').hide();
		
		
	}

	//Función para crear un nuevo objeto de tipo Entrada por traspaso
	function nuevo_objeto_entrada(){
		// Crear un Objeto de tipo Entrada por traspaso
		//objEntrada = new Entrada(null, null, '', '', '', '', null, null, []);
		objEntrada = new Entrada(null, null, '', '', '', null, null, null, null, null, null, '', null, []);
	}
	

	//Función para inicializar elementos de la factura de maquinaria
	function inicializar_factura_entradas_maquinaria_devolucion_maquinaria()
	{
		//Limpiar contenido de las siguientes cajas de texto
		$('#txtMonedaID_entradas_maquinaria_devolucion_maquinaria').val('');
		$('#txtMoneda_entradas_maquinaria_devolucion_maquinaria').val('');
        $('#txtTipoCambio_entradas_maquinaria_devolucion_maquinaria').val('');
        $('#txtRfc_entradas_maquinaria_devolucion_maquinaria').val('');
        $('#txtRegimenFiscalID_entradas_maquinaria_devolucion_maquinaria').val('');
        $('#txtRazonSocial_entradas_maquinaria_devolucion_maquinaria').val('');
        $('#txtFormaPagoID_entradas_maquinaria_devolucion_maquinaria').val('');
        $('#txtFormaPago_entradas_maquinaria_devolucion_maquinaria').val('');
        $('#txtMetodoPagoID_entradas_maquinaria_devolucion_maquinaria').val('');
        $('#txtMetodoPago_entradas_maquinaria_devolucion_maquinaria').val('');
        $('#txtUsoCfdiID_entradas_maquinaria_devolucion_maquinaria').val('');
        $('#txtUsoCfdi_entradas_maquinaria_devolucion_maquinaria').val('');
        $('#txtImporteFactura_entradas_maquinaria_devolucion_maquinaria').val('');
        //Hacer un llamado a la función para inicializar elementos de las tablas detalles y CFDI´s relacionados
	    inicializar_detalles_entradas_maquinaria_devolucion_maquinaria();
	}
				

	//Función para inicializar elementos de la tabla detalles
	function inicializar_detalles_entradas_maquinaria_devolucion_maquinaria()
	{
		//Eliminar los datos de la tabla detalles del movimiento
		$('#dg_detalles_entradas_maquinaria_devolucion_maquinaria tbody').empty();
		$('#acumCantidad_detalles_entradas_maquinaria_devolucion_maquinaria').html(0);
		$('#numElementos_detalles_entradas_maquinaria_devolucion_maquinaria').html(0);
		$('#txtNumDetalles_entradas_maquinaria_devolucion_maquinaria').html('');
		//Eliminar los datos de la tabla CFDI´s relacionados
	    $('#dg_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria tbody').empty();
		$('#numElementos_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria').html(0);
		$('#txtNumCfdiRelacionados_entradas_maquinaria_devolucion_maquinaria').val('');
	}
	
	
	//Función que se utiliza para cerrar el modal
	function cerrar_entradas_maquinaria_devolucion_maquinaria()
	{
		try {

			//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
			cerrar_cancelacion_entradas_maquinaria_devolucion_maquinaria();
			//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			cerrar_cliente_entradas_maquinaria_devolucion_maquinaria();
			//Hacer un llamado a la función para cerrar modal Relacionar CFDI
			cerrar_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria();
			//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
       		ocultar_circulo_carga_entradas_maquinaria_devolucion_maquinaria('');
			//Cerrar modal
			objEntradasMaquinariaDevolucionMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria').focus();	
		}
		catch(err) {}
	}

	
	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_entradas_maquinaria_devolucion_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_entradas_maquinaria_devolucion_maquinaria();
		//Validación del formulario de campos obligatorios
		$('#frmEntradasMaquinariaDevolucionMaquinaria')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_entradas_maquinaria_devolucion_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
									    strFactura_entradas_maquinaria_devolucion_maquinaria: {
											validators: {
											    callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de una factura seleccionada
					                                    if( $('#txtFacturaID_entradas_maquinaria_devolucion_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Ingrese una factura de maquinaria'
					                                        };
					                                    }
					                                    return true;
					                                }
						                        }
											}
										},
										strFormaPago_entradas_maquinaria_devolucion_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la forma de pago
					                                    if($('#txtFormaPagoID_entradas_maquinaria_devolucion_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una forma de pago existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMetodoPago_entradas_maquinaria_devolucion_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del método de pago
					                                    if($('#txtMetodoPagoID_entradas_maquinaria_devolucion_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un método de pago existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intExportacionID_entradas_maquinaria_devolucion_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una exportación'}
											}
										},
										strUsoCfdi_entradas_maquinaria_devolucion_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del uso de CFDI
					                                    if($('#txtUsoCfdiID_entradas_maquinaria_devolucion_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un uso de CFDI existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strTipoRelacion_entradas_maquinaria_devolucion_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if(($('#txtTipoRelacionID_entradas_maquinaria_devolucion_maquinaria').val() === '') 
					                                    	|| ($('#txtTipoRelacionID_entradas_maquinaria_devolucion_maquinaria').val() === '' && parseInt($('#txtNumCfdiRelacionados_entradas_maquinaria_devolucion_maquinaria').val()) > 0))
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un tipo de relación existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intNumCfdiRelacionados_entradas_maquinaria_devolucion_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan CFDI relacionados
					                                    if(parseInt($('#txtTipoRelacionID_entradas_maquinaria_devolucion_maquinaria').val()) > 0 &&
					                                    	(parseInt(value) === 0 || value === ''))
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un CFDI para esta entrada.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intNumDetalles_entradas_maquinaria_devolucion_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta entrada.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strChofer_entradas_maquinaria_devolucion_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strVehiculo_entradas_maquinaria_devolucion_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strSerie_detalles_entradas_maquinaria_devolucion_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strMotor_detalles_entradas_maquinaria_devolucion_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strCodigo_detalles_entradas_maquinaria_devolucion_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strDescripcion_detalles_entradas_maquinaria_devolucion_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										}

									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_entradas_maquinaria_devolucion_maquinaria = $('#frmEntradasMaquinariaDevolucionMaquinaria').data('bootstrapValidator');
		bootstrapValidator_entradas_maquinaria_devolucion_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_entradas_maquinaria_devolucion_maquinaria.isValid())
		{	
			//Hacer un llamado a la función para guardar los datos del registro
			guardar_entradas_maquinaria_devolucion_maquinaria();			
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_entradas_maquinaria_devolucion_maquinaria()
	{
		try
		{
			$('#frmEntradasMaquinariaDevolucionMaquinaria').data('bootstrapValidator').resetForm();

		}
		catch(err) {}
	}

	
	//Función para guardar o modificar los datos de un registro
	function guardar_entradas_maquinaria_devolucion_maquinaria()
	{		
		//Convenrtir al formato JSON todo lo generado en el objeto de la vista
		objEntrada.setID( $('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val() );
		objEntrada.setFolio(  $('#txtFolio_entradas_maquinaria_devolucion_maquinaria').val() );
		objEntrada.setFecha( $.formatFechaMysql($('#txtFecha_entradas_maquinaria_devolucion_maquinaria').val()) );

		objEntrada.setMonedaID( $('#txtMonedaID_entradas_maquinaria_devolucion_maquinaria').val() ); 
		objEntrada.setTipoCambio( $('#txtTipoCambio_entradas_maquinaria_devolucion_maquinaria').val() ); 
		objEntrada.setFormaPagoID( $('#txtFormaPagoID_entradas_maquinaria_devolucion_maquinaria').val() ); 
		objEntrada.setMetodoPagoID( $('#txtMetodoPagoID_entradas_maquinaria_devolucion_maquinaria').val() ); 
		objEntrada.setUsoCfdiID( $('#txtUsoCfdiID_entradas_maquinaria_devolucion_maquinaria').val() ); 
		objEntrada.setTipoRelacionID( $('#txtTipoRelacionID_entradas_maquinaria_devolucion_maquinaria').val() ); 

		objEntrada.setObservaciones( $('#txtObservaciones_entradas_maquinaria_devolucion_maquinaria').val() );
		var jsonEntrada = JSON.stringify(objEntrada); 

		//Obtenemos el objeto de la tabla CFDI relacionados
		var objTabla = document.getElementById('dg_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria').getElementsByTagName('tbody')[0];

		//Inicializamos las variables que obtendrán los datos de la tabla
		var arrCfdiRelacionado = [];
		var arrTiposRelacion = [];

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Asignar valores a los arrays
			arrCfdiRelacionado.push(objRen.cells[7].innerHTML);
			arrTiposRelacion.push(objRen.cells[3].innerHTML);
		}

		//Hacer un llamado al método del controlador para guardar los datos del registro	
		$.post('maquinaria/entradas_maquinaria_devolucion/guardar',
		{ 
			//Datos de la entrada por compra
			strFolioConsecutivo: $('#txtFolio_entradas_maquinaria_devolucion_maquinaria').val(),
			entradaDevolucion: jsonEntrada,
			intRegimenFiscalID: $('#txtRegimenFiscalID_entradas_maquinaria_devolucion_maquinaria').val(),
			intRegimenFiscalIDAnterior: $('#txtRegimenFiscalIDAnterior_entradas_maquinaria_devolucion_maquinaria').val(),
			intExportacionID: $('#cmbExportacionID_entradas_maquinaria_devolucion_maquinaria').val(),
			intProcesoMenuID: $('#txtProcesoMenuID_entradas_maquinaria_devolucion_maquinaria').val(),
			//Datos de los CFDI relacionados
			strCfdiRelacionado: arrCfdiRelacionado.join('|'),
			strTiposRelacion: arrTiposRelacion.join('|')
		},
				function(data) {

					if (data.resultado)
					{	
						//Si no existe id del movimiento, significa que es un nuevo registro   
						if($('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val() == '')
						{
						  	//Asignar el id del anticipo registrado en la base de datos
                 			$('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val(data.movimiento_maquinaria_id);
             			}
             			
             			//Hacer llamado a la función para cargar  los registros en el grid
						paginacion_entradas_maquinaria_devolucion_maquinaria();

						//Hacer un llamado a la función para timbrar los datos del registro
						timbrar_entradas_maquinaria_devolucion_maquinaria($('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val(), 'modal', '', 
							$('#txtRegimenFiscalID_entradas_maquinaria_devolucion_maquinaria').val());

						//Si no existe id de la póliza (o se trata de un nuevo registro)
						if(parseInt($('#txtPolizaID_entradas_maquinaria_devolucion_maquinaria').val()) == 0 || 
							$('#txtEstatus_entradas_maquinaria_devolucion_maquinaria').val() == '')
						{
							//Hacer un llamado a la función para generar póliza con los datos del registro
							generar_poliza_entradas_maquinaria_devolucion_maquinaria('', '', '');
						} 
					}

					//Si existe mensaje de error
					if(data.tipo_mensaje == 'error')
					{
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_entradas_maquinaria_devolucion_maquinaria(data.tipo_mensaje, data.mensaje);
					}


				},
		'json');
		
	}


	  //Función para habilitar controles del formulario correspondientes al timbrado
		function habilitar_controles_timbrado_entradas_maquinaria_devolucion_maquinaria()
		{
			//Deshabilitar todos los elementos del formulario
        	$('#frmEntradasMaquinariaDevolucionMaquinaria').find('input, textarea, select').attr('disabled','disabled');
        	//Habilitar las siguientes cajas de texto
        	$('#txtFormaPago_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
        	$('#txtMetodoPago_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
        	$('#txtUsoCfdi_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
        	$('#cmbExportacionID_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
        	$('#txtTipoRelacion_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
        	$('#txtObservaciones_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');
		}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_entradas_maquinaria_devolucion_maquinaria(id, estatus, formulario)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_entradas_maquinaria_devolucion_maquinaria(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaPolizaEntradasMaquinariaDevolucionMaquinaria, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_entradas_maquinaria_devolucion_maquinaria').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_entradas_maquinaria_devolucion_maquinaria(formulario);
			    //Si existe resultado
				if (data.resultado)
				{
					
					//Asignar el id de la póliza (generada) y evitar duplicidad de datos en caso de que no sea posible timbrar el registro
                    $('#txtPolizaID_entradas_maquinaria_devolucion_maquinaria').val(data.poliza_id);
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_entradas_maquinaria_devolucion_maquinaria();
				      
				}

			    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_entradas_maquinaria_devolucion_maquinaria(data.tipo_mensaje, data.mensaje);

				
		     },
		     'json');

		}

	//Función para timbrar los datos de un registro
	function timbrar_entradas_maquinaria_devolucion_maquinaria(id, tipo, formulario, regimenFiscalID)
	{
		
		//Si existe id del régimen fiscal
		if(regimenFiscalID > 0)
		{
		   //Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_entradas_maquinaria_devolucion_maquinaria(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/timbradoV4/set_timbrar',
			     {
			     	intReferenciaID: id,
			      	strTipoReferencia: strTipoReferenciaEntradasMaquinariaDevolucionMaquinaria
			     },
			     function(data) {

				    //Si el id del registro se obtuvo del modal
					if(tipo == 'modal')
					{
						//Si existe resultado (los datos se timbraron correctamente)
						if (data.resultado)
						{
							
							//Hacer un llamado a la función para cerrar modal
							cerrar_entradas_maquinaria_devolucion_maquinaria(); 
						}
						else
						{

							//Hacer un llamado a la función para limpiar los mensajes de error 
							limpiar_mensajes_entradas_maquinaria_devolucion_maquinaria();

							//Hacer un llamado a la función para cargar datos del registro (habilitar campos de timbrado)
							editar_entradas_maquinaria_devolucion_maquinaria(id,'Nuevo');

						}
					}


					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_entradas_maquinaria_devolucion_maquinaria();
					//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		            ocultar_circulo_carga_entradas_maquinaria_devolucion_maquinaria(formulario);
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_entradas_maquinaria_devolucion_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
		}
		else
		{
			//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			 mensaje_entradas_maquinaria_devolucion_maquinaria('error_regimen_fiscal');
		}
	}

	//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
	//al momento de timbrar un registro
	function mostrar_circulo_carga_entradas_maquinaria_devolucion_maquinaria(formulario)
	{
		//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
		var strCampoID = 'divCirculoBarProgreso_entradas_maquinaria_devolucion_maquinaria';

		//Si el Div a mostrar se encuentra en el formulario principal
		if(formulario == 'principal')
		{
			strCampoID = 'divCirculoBarProgresoPrincipal_entradas_maquinaria_devolucion_maquinaria';
		}

		//Remover clase para mostrar div que contiene la barra de carga
		$("#"+strCampoID).removeClass('no-mostrar');
	}

	//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
	//al momento de timbrar un registro
	function ocultar_circulo_carga_entradas_maquinaria_devolucion_maquinaria(formulario)
	{
		//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
		var strCampoID = 'divCirculoBarProgreso_entradas_maquinaria_devolucion_maquinaria';

		//Si el Div a ocultar se encuentra en el formulario principal
		if(formulario == 'principal')
		{
			strCampoID = 'divCirculoBarProgresoPrincipal_entradas_maquinaria_devolucion_maquinaria';
		}

		//Agregar clase para ocultar div que contiene la barra de carga
		$("#"+strCampoID).addClass('no-mostrar');
	}


	//Función para regresar obtener los datos de una factura de maquinaria
	function get_datos_factura_entradas_maquinaria_devolucion_maquinaria()
	{
		 //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
          $.post('maquinaria/facturas_maquinaria/get_datos',
          { 
              	intFacturaMaquinariaID: $("#txtFacturaID_entradas_maquinaria_devolucion_maquinaria").val()
          },
              function(data) {

                if(data.row){

                	//Objeto encapsulado
                	objEntrada.setReferenciaID(data.row.factura_maquinaria_id);
                	objEntrada.setTipoMovimiento(intTipoMovimientoBDEntradasMaquinariaDevolucionMaquinaria);
                	objEntrada.setProspectoID(data.row.prospecto_id);
                	
					//Agregar maquinarias del GRID
					//Limpiamos todo el array de maquinarias para insertar de nuevo los elementos
					objEntrada.arrMaquinarias = [];

					//Obtenemos el objeto de la tabla detalles
					var objTabla = document.getElementById('dg_detalles_entradas_maquinaria_devolucion_maquinaria').getElementsByTagName('tbody')[0];

                	//Hacer llamado a la función  para mostrar los datos de la factura
                	mostrar_datos_referencia_entradas_maquinaria_devolucion_maquinaria(data.row);

                	//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaSerie = objRenglon.insertCell(0);
					var objCeldaMotor = objRenglon.insertCell(1);
					var objCeldaCodigo = objRenglon.insertCell(2);
					var objCeldaDescripcionCorta = objRenglon.insertCell(3);

					//Asignar valores al GRID
					if(data.row.serie != null){
						//Editar objeto maquinaria en la vista
						var objMaquinaria = new Maquinaria();
						objMaquinaria.setRenglon(1);
						objMaquinaria.setMaquinariaDescripcionID(data.row.maquinaria_descripcion_id);
						objMaquinaria.setSerie(data.row.serie);
						objMaquinaria.setMotor(data.row.motor);
						objMaquinaria.setCodigo(data.row.codigo);
						objMaquinaria.setDescripcionCorta(data.row.descripcion_corta);

						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', data.row.serie); 
						objCeldaSerie.setAttribute('class', 'movil b1');
						objCeldaSerie.innerHTML = data.row.serie;
						objCeldaMotor.setAttribute('class', 'movil b2');
						objCeldaMotor.innerHTML = data.row.motor;
						objCeldaCodigo.setAttribute('class', 'movil b3');
						objCeldaCodigo.innerHTML = data.row.codigo;
						objCeldaDescripcionCorta.setAttribute('class', 'movil b4');
						objCeldaDescripcionCorta.innerHTML = data.row.descripcion_corta;

						objEntrada.setMaquinaria(objMaquinaria);

						var intFilas = $("#dg_detalles_entradas_maquinaria_devolucion_maquinaria tr").length - 1;
						$('#numElementos_detalles_entradas_maquinaria_devolucion_maquinaria').html(intFilas);
						$('#txtNumDetalles_entradas_maquinaria_devolucion_maquinaria').val(intFilas);
					}

                }

            }
             ,
            'json');
	}

	//Función para cambiar el estatus del registro seleccionado
	function cambiar_estatus_entradas_maquinaria_devolucion_maquinaria(id, folio, polizaID, folioPoliza)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Variable que se utiliza para asignar el folio del registro
	    var strFolio = '';
		//Variable que se utiliza para asignar el id de la póliza
		var intPolizaID = 0;
	    //Variable que se utiliza para asignar el folio de la póliza
		var strFolioPoliza = '';

		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val();
			strFolio = $('#txtFolio_entradas_maquinaria_devolucion_maquinaria').val();
			intPolizaID = $('#txtPolizaID_entradas_maquinaria_devolucion_maquinaria').val();
			strFolioPoliza = $('#txtFolioPoliza_entradas_maquinaria_devolucion_maquinaria').val();
		}
		else
		{
			intID = id;
			strFolio = folio;
			intPolizaID = polizaID;
			strFolioPoliza = folioPoliza;
		}

		//Preguntar al usuario si desea desactivar el registro
		new $.Zebra_Dialog('<strong>¿Está seguro que desea cancelar el registro; también se cancelara la póliza con folio: '+strFolioPoliza+'?</strong>',
					        {
					        	'type':     'question',
					            'title':    'Entrada de maquinaria por devolución',
					            'buttons':  ['Aceptar', 'Cancelar'],
					            'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                               		
					                             	 //Hacer un llamado a la función para abrir el modal Cancelación del timbrado (cambiar estatus y cancelar timbrado del registro)
					                              	abrir_cancelacion_entradas_maquinaria_devolucion_maquinaria(intID, strFolio, intPolizaID);
						                            

					                            }
					                          
					                        }

					        });

	}


	//Función para cancelar el timbrado de un registro. Cambia el estatus a INACTIVO
	function cancelar_timbrado_entradas_maquinaria_devolucion_maquinaria()
	{

		//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
		mostrar_circulo_carga_cancelacion_entradas_maquinaria_devolucion_maquinaria();
		 //Hacer un llamado al método del controlador para cancelar un CFDI y posteriormente cambiar el estatus a INACTIVO
         //----- CÓDIGO PARA PRODUCCIÓN
          $.post('contabilidad/timbrado_cancelar/set_cancelar',
          {
          		//Datos para cancelar el timbrado (CFDI)
         		intMovimientoID: $('#txtReferenciaCfdiID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(),
				strTipoReferencia: strTipoReferenciaEntradasMaquinariaDevolucionMaquinaria, 
				strUuidSustitucion: $('#txtUuidSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(),
				strMotivo: $('select[name="intCancelacionMotivoID_entradas_maquinaria_devolucion_maquinaria"] option:selected').text(),
				//Datos para cambiar (administrativamente) el estatus del registro
				intCancelacionMotivoID: $('#cmbCancelacionMotivoID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(), 
				intSustitucionID:  $('#txtSustitucionID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(),
				intPolizaID: $('#txtPolizaID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val()
          },
                 function(data) {

                    if(data.resultado)
                    {
						//Hacer llamado a la función  para cargar los registros en el grid
						paginacion_entradas_maquinaria_devolucion_maquinaria();	

						//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
						cerrar_cancelacion_entradas_maquinaria_devolucion_maquinaria();  

						//Si el id del registro se obtuvo del modal
						if($('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val() != '')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_entradas_maquinaria_devolucion_maquinaria();     
						}		
                    }

                    //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			        ocultar_circulo_carga_cancelacion_entradas_maquinaria_devolucion_maquinaria();
				    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_entradas_maquinaria_devolucion_maquinaria(data.tipo_mensaje, data.mensaje);


                 },
                'json');

	}
	

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_entradas_maquinaria_devolucion_maquinaria(id, tipoAccion, cancelacionID)
	{	
		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('maquinaria/entradas_maquinaria_devolucion/get_datos',
		       {
		       		intMovimientoMaquinariaID:id
		       },
		       function(data) {
	
		        	//Si hay datos del registro 
		            if(data.row)
		            {  

		            	//Hacer un llamado a la función para limpiar los campos del formulario
						nuevo_entradas_maquinaria_devolucion_maquinaria();
						//Asignar estatus del registro
				        var strEstatus = data.row.estatus;
				        //Asignar el id de la póliza
				        var intPolizaID = parseInt(data.row.poliza_id);
			          	
			          	//Recuperar valores para la Vista
			            $('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val(data.row.movimiento_maquinaria_id);
			            $('#txtFolio_entradas_maquinaria_devolucion_maquinaria').val(data.row.folio);
			            $('#txtFecha_entradas_maquinaria_devolucion_maquinaria').val(data.row.fecha);
			            $('#txtMoneda_entradas_maquinaria_devolucion_maquinaria').val(data.row.moneda);
			            $('#txtTipoCambio_entradas_maquinaria_devolucion_maquinaria').val(data.row.tipo_cambio);
			            $('#txtFacturaID_entradas_maquinaria_devolucion_maquinaria').val(data.row.referencia_id);
			            $('#txtFactura_entradas_maquinaria_devolucion_maquinaria').val(data.row.referencia);
			            $('#txtRazonSocial_entradas_maquinaria_devolucion_maquinaria').val(data.row.razon_social);
			            $('#txtRfc_entradas_maquinaria_devolucion_maquinaria').val(data.row.rfc);
			            $('#txtRegimenFiscalID_entradas_maquinaria_devolucion_maquinaria').val(data.row.regimen_fiscal_id);
						$('#txtRegimenFiscalIDAnterior_entradas_maquinaria_devolucion_maquinaria').val(data.row.regimenFiscalAnterior);
			            $('#txtFormaPagoID_entradas_maquinaria_devolucion_maquinaria').val(data.row.forma_pago_id);
			            $('#txtFormaPago_entradas_maquinaria_devolucion_maquinaria').val(data.row.forma_pago);
			            $('#txtMetodoPagoID_entradas_maquinaria_devolucion_maquinaria').val(data.row.metodo_pago_id);
			            $('#txtMetodoPago_entradas_maquinaria_devolucion_maquinaria').val(data.row.metodo_pago);
			            $('#txtUsoCfdiID_entradas_maquinaria_devolucion_maquinaria').val(data.row.uso_cfdi_id);
			            $('#txtUsoCfdi_entradas_maquinaria_devolucion_maquinaria').val(data.row.uso_cfdi);

			            $('#txtTipoRelacionID_entradas_maquinaria_devolucion_maquinaria').val(data.row.tipo_relacion_id);
			            $('#txtTipoRelacion_entradas_maquinaria_devolucion_maquinaria').val(data.row.tipo_relacion);
			            $('#cmbExportacionID_entradas_maquinaria_devolucion_maquinaria').val(data.row.exportacion_id);
						$('#txtObservaciones_entradas_maquinaria_devolucion_maquinaria').val(data.row.observaciones);
						$('#txtPolizaID_entradas_maquinaria_devolucion_maquinaria').val(intPolizaID);
						$('#txtFolioPoliza_entradas_maquinaria_devolucion_maquinaria').val(data.row.folio_poliza);

						//Objeto encapsulado
						objEntrada.setID(data.row.movimiento_maquinaria_id);
                    	objEntrada.setReferenciaID(data.row.referencia_id);
                    	objEntrada.setTipoMovimiento(intTipoMovimientoBDEntradasMaquinariaDevolucionMaquinaria);
                    	objEntrada.setFolio(data.row.folio);
                    	objEntrada.setObservaciones(data.row.observaciones);
                    	objEntrada.setProspectoID(data.row.prospecto_id);
                    	objEntrada.setFecha(data.row.fecha);
                    	
						//Agregar maquinarias del GRID
						//Limpiamos todo el array de maquinarias para insertar de nuevo los elementos
						objEntrada.arrMaquinarias = [];

			           	//Mostramos los detalles del registro
			           	for (var intCon in data.detalles) 
			            {	
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_entradas_maquinaria_devolucion_maquinaria').getElementsByTagName('tbody')[0];
							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaSerie = objRenglon.insertCell(0);
							var objCeldaMotor = objRenglon.insertCell(1);
							var objCeldaCodigo = objRenglon.insertCell(2);
							var objCeldaDescripcionCorta = objRenglon.insertCell(3);
							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].serie); 
							objCeldaSerie.setAttribute('class', 'movil d1');
							objCeldaSerie.innerHTML = data.detalles[intCon].serie;
							objCeldaMotor.setAttribute('class', 'movil d2');
							objCeldaMotor.innerHTML = data.detalles[intCon].motor;
							objCeldaCodigo.setAttribute('class', 'movil d3');
							objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
							objCeldaDescripcionCorta.setAttribute('class', 'movil d4');
							objCeldaDescripcionCorta.innerHTML = data.detalles[intCon].descripcion_corta;

							//Creamos objetos de tipo Maquinaria para cada elemento en la vista
							objMaquinaria = new Maquinaria(data.detalles[intCon].movimiento_maquinaria_id, 
														  data.detalles[intCon].renglon, 
														  data.detalles[intCon].maquinaria_descripcion_id, 
														  data.detalles[intCon].codigo, 
														  data.detalles[intCon].descripcion_corta, 
														  data.detalles[intCon].descripcion, 
														  data.detalles[intCon].serie, 
														  data.detalles[intCon].motor, 
														  data.detalles[intCon].consignacion, 
														  data.detalles[intCon].numero_pedimento, 
														  []
														  );
							
							objMaquinaria.setRenglon(data.detalles[intCon].renglon);
							objMaquinaria.setMaquinariaDescripcionID(data.detalles[intCon].maquinaria_descripcion_id);
							objMaquinaria.setSerie(data.detalles[intCon].serie);
							objMaquinaria.setMotor(data.detalles[intCon].motor);
							objMaquinaria.setCodigo(data.detalles[intCon].codigo);
							objMaquinaria.setDescripcionCorta(data.detalles[intCon].descripcion_corta);

							objEntrada.setMaquinaria(objMaquinaria);
	
			            }

						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_entradas_maquinaria_devolucion_maquinaria tr").length - 1;
						$('#numElementos_detalles_entradas_maquinaria_devolucion_maquinaria').html(intFilas);
						$('#txtNumDetalles_entradas_maquinaria_devolucion_maquinaria').val(intFilas);

						//Dependiendo del estatus cambiar el color del encabezado 
			            $('#divEncabezadoModal_entradas_maquinaria_devolucion_maquinaria').addClass("estatus-"+ strEstatus);
			            $('#txtEstatus_entradas_maquinaria_devolucion_maquinaria').val(strEstatus);
			            //Mostrar botón Imprimir  
			            $("#btnImprimirRegistro_entradas_maquinaria_devolucion_maquinaria").show();
			            
			            //Si existe archivo del registro
			            if(data.archivo != '')
			           	{
			           		//Mostrar botón Descargar Archivo
			            	$("#btnDescargarArchivo_entradas_maquinaria_devolucion_maquinaria").show();
			           	}
   			
						//Si se cumple la sentencia
			           	if(strEstatus == 'TIMBRAR' && intPolizaID == 0)
			            {

			            	//Hacer un llamado a la función para habilitar campos de timbrado
			            	habilitar_controles_timbrado_entradas_maquinaria_devolucion_maquinaria();
			            	//Deshabilitar las siguientes cajas de texto
			            	$('#txtFecha_entradas_maquinaria_devolucion_maquinaria').removeAttr('disabled');

			            }
			           	else if (strEstatus == 'TIMBRAR' && intPolizaID > 0)
			            {
			            	//Hacer un llamado a la función para habilitar campos de timbrado
			            	habilitar_controles_timbrado_entradas_maquinaria_devolucion_maquinaria();

			            }
			            else
			            {
			            	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
				            {
				            	//Mostrar los siguientes botones
				            	$('#btnEnviarCorreo_entradas_maquinaria_devolucion_maquinaria').show();

				            	//Si existe el id de la póliza
				            	if(intPolizaID > 0)
				            	{
				            		$('#btnDesactivar_entradas_maquinaria_devolucion_maquinaria').show();
				            	}
				            }

				            //Deshabilitar todos los elementos del formulario
			            	$('#frmEntradasMaquinariaDevolucionMaquinaria').find('input, textarea, select').attr('disabled','disabled');
			            	//Ocultar los siguientes botones
				            $("#btnGuardar_entradas_maquinaria_devolucion_maquinaria").hide();
				            $("#btnBuscarCFDI_entradas_maquinaria_devolucion_maquinaria").hide(); 


				            //Si existe id de la cancelación del CFDI
							if(cancelacionID > 0)
							{	
								//Asignar el id de la cancelación
								$("#txtCancelacionID_entradas_maquinaria_devolucion_maquinaria").val(cancelacionID); 
								//Mostrar botón Motivo de cancelación
								$("#btnVerMotivoCancelacion_entradas_maquinaria_devolucion_maquinaria").show(); 
							}
			            }

						
						//Agregar CFDIs previamente relacionados a este movimiento de entrada por DEVOLUCIÓN
				        //Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
			            agregar_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria('Editar', strEstatus);

			            //Si el tipo de acción es diferente de Nuevo
			            if(tipoAccion != 'Nuevo')
			            {
			            	//Abrir modal
				            objEntradasMaquinariaDevolucionMaquinaria = $('#EntradasMaquinariaDevolucionMaquinariaBox').bPopup({
											   appendTo: '#EntradasMaquinariaDevolucionMaquinariaContent', 
				                               contentContainer: 'EntradasMaquinariaDevolucionMaquinariaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

			            }

			            //Enfocar caja de texto
						$('#txtFactura_entradas_maquinaria_devolucion_maquinaria').focus();

		       	    }
		       	    
		       },
		       'json');
	}

	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_entradas_maquinaria_devolucion_maquinaria(id)
	{	
		//Variable que se utiliza para asignar el valores del registro
		var intID = 0;

		//Si no existe id, significa que se realizará la impresión desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val();	
		}
		else
		{
			intID = id;
		}

		
		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url':  'contabilidad/timbradoV4/get_pdf',
						'data' : {
									'intReferenciaID':intID,
									'strTipoReferencia':strTipoReferenciaEntradasMaquinariaDevolucionMaquinaria,
									'strTimbrar': 'NO'		
								 }
					   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);	
	}

	//Regresar exportación activa para cargarlas en el combobox
	function cargar_exportacion_entradas_maquinaria_devolucion_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar la exportación que se encuentra activa
		$.post('contabilidad/sat_exportacion/get_combo_box', {},
			function(data)
			{
				$('#cmbExportacionID_entradas_maquinaria_devolucion_maquinaria').empty();
				var temp = Mustache.render($('#exportacion_entradas_maquinaria_devolucion_maquinaria').html(), data);
				$('#cmbExportacionID_entradas_maquinaria_devolucion_maquinaria').html(temp);
			},
			'json');
	}


	//Función para mostrar mensaje de éxito o error
	function mensaje_entradas_maquinaria_devolucion_maquinaria(tipoMensaje, mensaje, campoID)
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
			else if(tipoMensaje == 'error_timbrado')
			{ 
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog(mensaje, 
								  {'type': 'error',
								   'title': 'Error',
								   'width': 650
					    		  });
			}
			else if(tipoMensaje == 'error_regimen_fiscal')
			{ 
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog(strMsjRegimenFiscalCteEntradasMaquinariaDevolucionMaquinaria, 
								  {'type': 'error',
								   'title': 'Error',
								   'buttons': [{caption: 'Aceptar',
	                                         callback: function () {
	                                            //Enfocar caja de texto
												$('#'+campoID).focus();
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

	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_entradas_maquinaria_devolucion_maquinaria(strTipo) 
	{	

		//Variable que se utiliza para asignar URL (ruta del controlador)
		var strUrl = 'maquinaria/entradas_maquinaria_devolucion/';

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
		if ($('#chbImprimirDetalles_entradas_maquinaria_devolucion_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_entradas_maquinaria_devolucion_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_entradas_maquinaria_devolucion_maquinaria').val('NO');
		}


		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url': strUrl,
						'data' : {
									'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria').val()),
									'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_entradas_maquinaria_devolucion_maquinaria').val()),
									'intProspectoID': $('#txtClienteIDBusq_entradas_maquinaria_devolucion_maquinaria').val(),
									'strEstatus': $('#cmbEstatusBusq_entradas_maquinaria_devolucion_maquinaria').val(), 
									'strBusqueda': $('#txtBusqueda_entradas_maquinaria_devolucion_maquinaria').val(),
									'strDetalles': $('#chbImprimirDetalles_entradas_maquinaria_devolucion_maquinaria').val()		
								 }
					   };


		//Hacer un llamado a la función para imprimir/descargar el reporte
		$.imprimirReporte(objReporte);

	}

	

	//Función que se utiliza para descargar los archivos del registro seleccionado
	function descargar_archivos_entradas_maquinaria_devolucion_maquinaria(movimientoMaquinariaID, folio)
	{
		//Variables que se utilizan para asignar los valores del registro
		var intID = 0;
		var strFolio = '';
		//Si no existe id, significa que se descargara el archivo desde el modal
		if(movimientoMaquinariaID == '')
		{
			intID = $('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val();
			strFolio = $('#txtFolio_entradas_maquinaria_devolucion_maquinaria').val();
		}
		else
		{
			intID = movimientoMaquinariaID;
			strFolio = folio;
		}


		//Definir encapsulamiento de datos que son necesarios para descargar el archivo
		objArchivo = {'url': 'contabilidad/timbradoV4/descargar_archivos',
						'data' : {
									'intReferenciaID': intID,
									'strTipoReferencia': strTipoReferenciaEntradasMaquinariaDevolucionMaquinaria,
									'strFolio': strFolio		
								 }
					   };


		//Hacer un llamado a la función para descarga del archivo
		$.imprimirReporte(objArchivo);
	}

	
	/*******************************************************************************************************************
	
	Funciones del modal Cancelación del timbrado
	*********************************************************************************************************************/
	//Función para limpiar los campos del formulario
	function nuevo_cancelacion_entradas_maquinaria_devolucion_maquinaria()
	{
		//Incializar formulario
		$('#frmCancelacionEntradasMaquinariaDevolucionMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_cancelacion_entradas_maquinaria_devolucion_maquinaria();
		//Limpiar cajas de texto ocultas
		$('#frmCancelacionEntradasMaquinariaDevolucionMaquinaria').find('input[type=hidden]').val('');
		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
		$.removerClasesEncabezado('divEncabezadoModal_cancelacion_entradas_maquinaria_devolucion_maquinaria');
		//Habilitar todos los elementos del formulario
		$('#frmCancelacionEntradasMaquinariaDevolucionMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');
		//Deshabilitar las siguientes cajas de texto
		$('#txtFolio_cancelacion_entradas_maquinaria_devolucion_maquinaria').attr('disabled','disabled');
		//Mostrar botón de Guardar
	    $("#btnGuardar_cancelacion_entradas_maquinaria_devolucion_maquinaria").show();
	    //Agregar clase para ocultar div que contiene los datos de creación del registro
		$("#divDatosCreacion_cancelacion_entradas_maquinaria_devolucion_maquinaria").addClass('no-mostrar');
	}

	//Función que se utiliza para abrir el modal
	function abrir_cancelacion_entradas_maquinaria_devolucion_maquinaria(id, folio, polizaID)
	{
		//Hacer un llamado a la función para limpiar los campos del formulario
		nuevo_cancelacion_entradas_maquinaria_devolucion_maquinaria();

		//Asignar datos del registro seleccionado
		$('#txtReferenciaCfdiID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(id);
		$('#txtFolio_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(folio);
		$('#txtPolizaID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(polizaID);
		//Dependiendo del estatus cambiar el color del encabezado 
	    $('#divEncabezadoModal_cancelacion_entradas_maquinaria_devolucion_maquinaria').addClass("estatus-ACTIVO");

	    //Abrir modal
		objCancelacionEntradasMaquinariaDevolucionMaquinaria = $('#CancelacionEntradasMaquinariaDevolucionMaquinariaBox').bPopup({
											   appendTo: '#EntradasMaquinariaDevolucionMaquinariaContent', 
					                           contentContainer: 'EntradasMaquinariaDevolucionMaquinariaM', 
					                           zIndex: 2, 
					                           modalClose: false, 
					                           modal: true, 
					                           follow: [true,false], 
					                           followEasing : "linear", 
					                           easing: "linear", 
					                           modalColor: ('#F0F0F0')});
		//Enfocar caja de texto
		$('#cmbCancelacionMotivoID_cancelacion_entradas_maquinaria_devolucion_maquinaria').focus();
	}

	//Función para regresar los datos (al formulario) del registro seleccionados
	function ver_cancelacion_entradas_maquinaria_devolucion_maquinaria(id)
	{

		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtCancelacionID_entradas_maquinaria_devolucion_maquinaria').val();

		}
		else
		{
			intID = id;
		}

		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('contabilidad/cancelaciones/get_datos',
        {
       		intCancelacionID:intID,
       		strTipoReferencia:strTipoReferenciaEntradasMaquinariaDevolucionMaquinaria
        },
		       function(data) {
		        	//Si hay datos del registro
		            if(data.row)
		            {
		               //Hacer un llamado a la función para limpiar los campos del formulario
						nuevo_cancelacion_entradas_maquinaria_devolucion_maquinaria();
						//Recuperar valores
						$('#cmbCancelacionMotivoID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(data.row.cancelacion_motivo_id);
						$('#txtFolio_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(data.row.folio_referencia);
						$('#txtFolioSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(data.row.folio_sustitucion);
						$('#txtUsuarioCreacion_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(data.row.usuario_creacion);
						$('#txtFechaCreacion_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(data.row.fecha_creacion);

						//Dependiendo del estatus cambiar el color del encabezado 
	   					$('#divEncabezadoModal_cancelacion_entradas_maquinaria_devolucion_maquinaria').addClass("estatus-INACTIVO");

	   				    //Deshabilitar todos los elementos del formulario
			            $('#frmCancelacionEntradasMaquinariaDevolucionMaquinaria').find('input, textarea, select').attr('disabled','disabled');
	   					//Ocultar botón de Guardar
			            $("#btnGuardar_cancelacion_entradas_maquinaria_devolucion_maquinaria").hide();
			            //Remover clase para mostrar div que contiene los datos de creación del registro
						$("#divDatosCreacion_cancelacion_entradas_maquinaria_devolucion_maquinaria").removeClass('no-mostrar');

						//Abrir modal
						objCancelacionEntradasMaquinariaDevolucionMaquinaria = $('#CancelacionEntradasMaquinariaDevolucionMaquinariaBox').bPopup({
											   appendTo: '#EntradasMaquinariaDevolucionMaquinariaContent', 
					                           contentContainer: 'EntradasMaquinariaDevolucionMaquinariaM', 
					                           zIndex: 2, 
					                           modalClose: false, 
					                           modal: true, 
					                           follow: [true,false], 
					                           followEasing : "linear", 
					                           easing: "linear", 
					                           modalColor: ('#F0F0F0')});
		       	    }
		       },
		       'json');

		
	}

	//Función que se utiliza para cerrar el modal
	function cerrar_cancelacion_entradas_maquinaria_devolucion_maquinaria()
	{
		try {
			//Cerrar modal
			objCancelacionEntradasMaquinariaDevolucionMaquinaria.close();
			//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	        ocultar_circulo_carga_cancelacion_entradas_maquinaria_devolucion_maquinaria();
			
		}
		catch(err) {}
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_cancelacion_entradas_maquinaria_devolucion_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_cancelacion_entradas_maquinaria_devolucion_maquinaria();
		//Validación del formulario de campos obligatorios
		$('#frmCancelacionEntradasMaquinariaDevolucionMaquinaria')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
								  	intCancelacionMotivoID_entradas_maquinaria_devolucion_maquinaria: {
										validators: {
											notEmpty: {message: 'Seleccione un motivo'}
										}
									},
									strFolioSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria: {
										validators: {
									    	callback: {
				                                callback: function(value, validator, $field) {
				                                    //Verificar que exista id del tipo de relación
				                                    if(value == '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val()) === intCancelacionIDRelacionCfdiEntradasMaquinariaDevolucionMaquinaria) 
				                                    	
				                                    {
			                                      		return {
				                                            valid: false,
				                                            message: 'Escriba un anticipo existente'
				                                        };
				                                    }
				                                    else if(value !== '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val()) !== intCancelacionIDRelacionCfdiEntradasMaquinariaDevolucionMaquinaria)
				                                    {

				                                    	//Hacer un llamado a la función para inicializar elementos de la sustitución
				                                    	inicializar_sustitucion_entradas_maquinaria_devolucion_maquinaria();
				                                    }
				                                    return true;
				                                }
				                            }
										}
									}
								}
			});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_cancelacion_entradas_maquinaria_devolucion_maquinaria = $('#frmCancelacionEntradasMaquinariaDevolucionMaquinaria').data('bootstrapValidator');
		bootstrapValidator_cancelacion_entradas_maquinaria_devolucion_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_cancelacion_entradas_maquinaria_devolucion_maquinaria.isValid())
		{
			//Hacer un llamado a la función para cancelar el timbrado de un registro
			cancelar_timbrado_entradas_maquinaria_devolucion_maquinaria();
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_cancelacion_entradas_maquinaria_devolucion_maquinaria()
	{
		try
		{
			$('#frmCancelacionEntradasMaquinariaDevolucionMaquinaria').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	
	//Función para inicializar elementos de la sustitución de CFDI
	function inicializar_sustitucion_entradas_maquinaria_devolucion_maquinaria()
	{
		
		//Limpiar contenido de las siguientes cajas de texto
       $('#txtSustitucionID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val('');
       $('#txtUuidSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria').val('');
       $('#txtFolioSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria').val('');
	}


	//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
	//al momento de cancelar el timbrado
	function mostrar_circulo_carga_cancelacion_entradas_maquinaria_devolucion_maquinaria()
	{
		//Remover clase para mostrar div que contiene la barra de carga
		$("#divCirculoBarProgreso_cancelacion_entradas_maquinaria_devolucion_maquinaria").removeClass('no-mostrar');
	}

	//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
	//al momento de cancelar el timbrado
	function ocultar_circulo_carga_cancelacion_entradas_maquinaria_devolucion_maquinaria()
	{
		//Agregar clase para ocultar div que contiene la barra de carga
		$("#divCirculoBarProgreso_cancelacion_entradas_maquinaria_devolucion_maquinaria").addClass('no-mostrar');
	}

	//Regresar motivos de cancelación activos para cargarlos en el combobox
	function cargar_motivos_cancelacion_entradas_maquinaria_devolucion_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
		$.post('contabilidad/sat_cancelacion_motivos/get_combo_box', {},
			function(data)
			{
				$('#cmbCancelacionMotivoID_cancelacion_entradas_maquinaria_devolucion_maquinaria').empty();
				var temp = Mustache.render($('#cancelacion_motivos_entradas_maquinaria_devolucion_maquinaria').html(), data);
				$('#cmbCancelacionMotivoID_cancelacion_entradas_maquinaria_devolucion_maquinaria').html(temp);
			},
			'json');
	}

	/*******************************************************************************************************************
	Funciones del modal Enviar Correo Electrónico
	*********************************************************************************************************************/
	//Función para limpiar los campos del formulario
	function nuevo_cliente_entradas_maquinaria_devolucion_maquinaria()
	{
		//Incializar formulario
		$('#frmEnviarEntradasMaquinariaDevolucionMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_cliente_entradas_maquinaria_devolucion_maquinaria();
	    //Quitar clases del div para poder tomar el color correspondiente al estatus del registro
	    $('#divEncabezadoModal_cliente_entradas_maquinaria_devolucion_maquinaria').removeClass("estatus-ACTIVO");
	}


	//Función que se utiliza para abrir el modal
	function abrir_cliente_entradas_maquinaria_devolucion_maquinaria(id)
	{
		//Hacer un llamado a la función para limpiar los campos del formulario
		nuevo_cliente_entradas_maquinaria_devolucion_maquinaria();
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;

		//Si no existe id, significa que se enviará correo electrónico desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val();
			
		}
		else
		{
			intID = id;
		}

		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('maquinaria/entradas_maquinaria_devolucion/get_datos',
       {
       		intMovimientoMaquinariaID:intID
       },
       function(data) {
        	//Si hay datos del registro
            if(data.row)
            {
            	//Asignar datos del registro seleccionado
				$('#txtMovimientoMaquinariaID_cliente_entradas_maquinaria_devolucion_maquinaria').val(data.row.movimiento_maquinaria_id);
				$('#txtFolio_cliente_entradas_maquinaria_devolucion_maquinaria').val(data.row.folio);
				$('#txtCliente_cliente_entradas_maquinaria_devolucion_maquinaria').val(data.row.cliente);
				$('#txtCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria').val(data.row.correo_electronico);
				$('#txtCopiaCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria').val(data.row.contacto_correo_electronico);
				//Dependiendo del estatus cambiar el color del encabezado 
			    $('#divEncabezadoModal_cliente_entradas_maquinaria_devolucion_maquinaria').addClass("estatus-"+data.row.estatus);

			    //Abrir modal
				objEnviarEntradasMaquinariaDevolucionMaquinaria = $('#EnviarEntradasMaquinariaDevolucionMaquinariaBox').bPopup({
															   appendTo: '#EntradasMaquinariaDevolucionMaquinariaContent', 
									                           contentContainer: 'EntradasMaquinariaDevolucionMaquinariaM', 
									                           zIndex: 2, 
									                           modalClose: false, 
									                           modal: true, 
									                           follow: [true,false], 
									                           followEasing : "linear", 
									                           easing: "linear", 
									                           modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria').focus();
            }
         },
       'json');
	}

	//Función que se utiliza para cerrar el modal
	function cerrar_cliente_entradas_maquinaria_devolucion_maquinaria()
	{
		try {
			//Cerrar modal
			objEnviarEntradasMaquinariaDevolucionMaquinaria.close();
			
		}
		catch(err) {}
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_cliente_entradas_maquinaria_devolucion_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_cliente_entradas_maquinaria_devolucion_maquinaria();
		//Validación del formulario de campos obligatorios
		$('#frmEnviarEntradasMaquinariaDevolucionMaquinaria')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria: {
			                        	validators: {
			                        		notEmpty: {message: 'Escriba un correo electrónico'},
			                                regexp: {
			                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
			                                    message: 'Escriba una dirección de correo electrónico que sea válida'
			                                }
			                          	}
				                    },
				                    strCopiaCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria: {
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
		var bootstrapValidator_cliente_entradas_maquinaria_devolucion_maquinaria = $('#frmEnviarEntradasMaquinariaDevolucionMaquinaria').data('bootstrapValidator');
		bootstrapValidator_cliente_entradas_maquinaria_devolucion_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_cliente_entradas_maquinaria_devolucion_maquinaria.isValid())
		{
			//Hacer un llamado a la función para enviar correo electrónico
			enviar_correo_cliente_entradas_maquinaria_devolucion_maquinaria();
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_cliente_entradas_maquinaria_devolucion_maquinaria()
	{
		try
		{
			$('#frmEnviarEntradasMaquinariaDevolucionMaquinaria').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para enviar correo electrónico al cliente
	function enviar_correo_cliente_entradas_maquinaria_devolucion_maquinaria()
	{
		//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
		mostrar_circulo_carga_cliente_entradas_maquinaria_devolucion_maquinaria();
		//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
		$.post('contabilidad/timbradoV4/enviar_correo_electronico_cliente',
				{ 
					intReferenciaID: $('#txtMovimientoMaquinariaID_cliente_entradas_maquinaria_devolucion_maquinaria').val(),
					strTipoReferencia: strTipoReferenciaEntradasMaquinariaDevolucionMaquinaria,
					strFolio: $('#txtFolio_cliente_entradas_maquinaria_devolucion_maquinaria').val(),
					strCorreoElectronico: $('#txtCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria').val(),
					strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_entradas_maquinaria_devolucion_maquinaria').val()
				},
				function(data) {
					if (data.resultado)
					{
						//Hacer un llamado a la función para cerrar modal
						cerrar_cliente_entradas_maquinaria_devolucion_maquinaria();
					}

					//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	           	 	ocultar_circulo_carga_cliente_entradas_maquinaria_devolucion_maquinaria();
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_entradas_maquinaria_devolucion_maquinaria(data.tipo_mensaje, data.mensaje);
				},
		'json');
	}

	//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
	//al momento de enviar correo electrónico
	function mostrar_circulo_carga_cliente_entradas_maquinaria_devolucion_maquinaria()
	{
		//Remover clase para mostrar div que contiene la barra de carga
		$("#divCirculoBarProgreso_cliente_entradas_maquinaria_devolucion_maquinaria").removeClass('no-mostrar');
	}

	//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
	//al momento de enviar correo electrónico
	function ocultar_circulo_carga_cliente_entradas_maquinaria_devolucion_maquinaria()
	{
		//Agregar clase para ocultar div que contiene la barra de carga
		$("#divCirculoBarProgreso_cliente_entradas_maquinaria_devolucion_maquinaria").addClass('no-mostrar');
	}

	/*******************************************************************************************************************
	Funciones del modal Relacionar CFDI
	*********************************************************************************************************************/
	//Función para limpiar los campos del formulario
	function nuevo_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria()
	{
		//Incializar formulario
		$('#frmRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria();
		//Limpiar cajas de texto ocultas
		$('#frmRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria').find('input[type=hidden]').val('');
		//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		$('#divEncabezadoModal_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').removeClass("estatus-NUEVO");
		$('#divEncabezadoModal_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').removeClass("estatus-TIMBRAR");
		//Eliminar los datos de la tabla CFDI a relacionar
	    $('#dg_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria tbody').empty();
	    $('#numElementos_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').html(0);
	}

	//Función que se utiliza para abrir el modal
	function abrir_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los campos del formulario
		nuevo_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria();
		//Variable que se utiliza para asignar el estatus del registro
		var strEstatus =  $('#txtEstatus_entradas_maquinaria_devolucion_maquinaria').val();
		//Si no existe estatus, significa que es un nuevo registro
		if(strEstatus == '')
		{
			strEstatus = 'NUEVO';
		}

		//Dependiendo del estatus cambiar el color del encabezado 
	    $('#divEncabezadoModal_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').addClass("estatus-"+strEstatus);
		//Abrir modal
		objRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria = $('#RelacionarCfdiEntradasMaquinariaDevolucionMaquinariaBox').bPopup({
										  appendTo: '#EntradasMaquinariaDevolucionMaquinariaContent', 
		                              	  contentContainer: 'EntradasMaquinariaDevolucionMaquinariaM', 
		                              	  zIndex: 2, 
		                              	  modalClose: false, 
		                              	  modal: true, 
		                              	  follow: [true,false], 
		                              	  followEasing : "linear", 
		                              	  easing: "linear", 
		                             	  modalColor: ('#F0F0F0')});

		//Enfocar caja de texto
		$('#txtFechaInicialBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').focus();
		//Hacer un llamado a la función  para cargar los CFDI´s en el grid
		lista_facturas_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria();

	}

	//Función que se utiliza para cerrar el modal
	function cerrar_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria()
	{
		try {
			//Cerrar modal
			objRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria.close();
		}
		catch(err) {}
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria()
	{

		//Hacer un llamado a la función para agregar las facturas (CFDI) seleccionadas al  objeto CFDI's  relacionados
		agregar_facturas_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria();

		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria();

		//Validación del formulario de campos obligatorios
		$('#frmRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									intNumCfdi_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria: {
										validators: {
									    	callback: {
				                                callback: function(value, validator, $field) {
				                                    //Verificar que existan detalles
				                                    if(parseInt(value) === 0 || value === '')
				                                    {
				                                    	return {
				                                            valid: false,
				                                            message: 'Seleccionar al menos un CFDI para esta entrada.'
				                                        };
				                                    }
				                                    return true;
				                                }
				                            }
										}
									},
									strFechaInicialBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria: {
										excluded: true  // Ignorar (no valida el campo)
									},
									strFechaFinalBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria: {
										excluded: true  // Ignorar (no valida el campo)
									},
									strClienteBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria: {
										excluded: true  // Ignorar (no valida el campo)
									}
								}
			});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria = $('#frmRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria').data('bootstrapValidator');
		bootstrapValidator_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria.isValid())
		{
			//Hacer un llamado a la función para cerrar el modal
			cerrar_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria();
			//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
	  		agregar_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria('Nuevo', '');
		}
		else 
			return;
		
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria()
	{
		try
		{
			$('#frmRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	/*******************************************************************************************************************
	Funciones de la tabla relacionar CFDI's
	*********************************************************************************************************************/
	//Función para la búsqueda de CFDI's 
	function lista_facturas_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria() 
	{
		//Variables que se utilizan para asignar los criterios de búsqueda
		//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
		var dteFechaInicialBusq =  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').val());
		var dteFechaFinalBusq =  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').val());
		var intProspectoIDBusq =  $('#txtProspectoIDBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').val();

		//Si no existen datos para realizar la búsqueda de coincidencias
		if(intProspectoIDBusq == '' && dteFechaInicialBusq == '' && dteFechaFinalBusq == '')
		{
			intProspectoIDBusq = 0;
		}

		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('caja/cfdi_relacionados/get_datos',
				{	dteFechaInicial:  dteFechaInicialBusq,
					dteFechaFinal:  dteFechaFinalBusq,
					intProspectoID: intProspectoIDBusq
				},
				function(data){
					$('#dg_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria tbody').empty();
					var tmpRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria = Mustache.render($('#plantilla_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').html(),data);
					$('#numElementos_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').html(0);
					if(data.rows)
					{
						$('#numElementos_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').html(data.rows.length);	
					}
					$('#dg_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria tbody').html(tmpRelacionarCfdiEntradasMaquinariaDevolucionMaquinaria);
					
				},
		'json');

		
	}

	//Función para agregar las facturas (CFDI) seleccionadas al objeto CFDI's  relacionados
	function agregar_facturas_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria()
	{
	    //Variable que se utiliza para asignar el texto del td
	    var strValor = "";
	    //Variable que se utiliza para asignar el indice de la columna
	    var intCol = 0;
	    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
	    var intContador = 0;
         
        //Crear instancia del objeto CFDI´s relacionados (facturas seleccionadas)
		objCfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria = new CfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria([]);

	    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
	   	$('#dg_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria tr:has(td)').find('input[type="checkbox"]').each(function() {
           	//Si el checkbox se encuentra marcado (seleccionado)
            if ($(this).prop("checked") == true)
            {
            	//Inicializar variables
            	intCol = 0;
            	
            	//Crear instancia del objeto CFDI a relacionar
				objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria = new CfdiRelacionarEntradasMaquinariaDevolucionMaquinaria(null, '', '', '', '', '', '');

            	//Buscamos el td más cercano en el DOM hacia "arriba"
				//luego encontramos los td adyacentes a este
            	$(this).closest('td').siblings().each(function(){

				      	//Obtenemos el texto del td 
				        strValor = $(this).text();

				        switch (intCol) {
						    case 0:
						        objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.intReferenciaID = strValor;
						        break;
						    case 1:
						        objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strCliente = strValor;
						        break;
						    case 2:
						        objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strFolio = strValor;
						        break;
						    case 3:
						        objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.dteFecha = strValor;
						        break;
						    case 4:
						        objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strTipoReferencia = strValor;
						        break;
						    case 5:
						       	objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strUuid = strValor;
						        break;
						    case 6:
						       	objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.intImporte = strValor;
						       	break;
						}

				      	intCol++;
				    });

            	//Agregar datos del cfdi a relacionar
            	objCfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria.setCfdi(objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria);
            	
            	//Incrementar el contador por cada registro
            	intContador++;
            }
        });

        //Asignar el número de registros seleccionados
        $('#txtNumCfdi_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').val(intContador);

	}



      

	
	/*******************************************************************************************************************
	Funciones de la tabla CFDI relacionados
	*********************************************************************************************************************/
	//Función para agregar renglones a la tabla 
	function agregar_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria(tipoAccion, estatus)
	{

		//Variable que se utiliza para asignar las acciones del grid view
	    var strAccionesTabla = '';

	    //Si se cumple la sentencia
		if(estatus == '' || estatus == 'TIMBRAR')
		{
			strAccionesTabla = "<button class='btn btn-default btn-xs' title='Eliminar'" +
								   " onclick='eliminar_renglon_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria(this)'>" + 
								   "<span class='glyphicon glyphicon-trash'></span></button>" + 
								   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
								   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
								   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
								   "<span class='glyphicon glyphicon-arrow-down'></span></button>";
		}

		//Si el tipo de acción corresponde a Editar						   
		if(tipoAccion == 'Editar')
		{

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/cfdi_relacionados/get_datos',
					{	
						intReferenciaID: $('#txtMovimientoMaquinariaID_entradas_maquinaria_devolucion_maquinaria').val(),
						strTipoReferencia: strTipoReferenciaEntradasMaquinariaDevolucionMaquinaria
					},
					function(data){

						//Mostramos los CFDI´s relacionados (facturas seleccionadas)
			           	for (var intCon in data.rows) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria').getElementsByTagName('tbody')[0];

							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCliente = objRenglon.insertCell(0);
							var objCeldaFolio = objRenglon.insertCell(1);
							var objCeldaFecha = objRenglon.insertCell(2);
							var objCeldaModulo = objRenglon.insertCell(3);
							var objCeldaUuid = objRenglon.insertCell(4);
							var objCeldaImporte = objRenglon.insertCell(5);
							var objCeldaAcciones = objRenglon.insertCell(6);
							//Columnas ocultas
							var objCeldaReferenciaID = objRenglon.insertCell(7);

							//Variable que se utiliza para asignar el id del detalle
							var strDetalleID =  data.rows[intCon].referencia_id+'_'+data.rows[intCon].tipo_referencia;

							//Variable que se utiliza para asignar las acciones del grid view (en caso de que el folio del CFDI relacionado sea diferente al folio de la factura)
	    					var strAccionesRenglon = strAccionesTabla;

	    					//Si el folio del CFDI relacionado es igual al folio de la factura
							if(data.rows[intCon].folio ==  $('#txtFactura_entradas_maquinaria_devolucion_maquinaria').val())
							{
								//No mostrar acciones
								strAccionesRenglon = '';
							}

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', strDetalleID);
							objCeldaCliente.setAttribute('class', 'movil c1');
							objCeldaCliente.innerHTML = data.rows[intCon].cliente;
							objCeldaFolio.setAttribute('class', 'movil c2');
							objCeldaFolio.innerHTML =  data.rows[intCon].folio;
							objCeldaFecha.setAttribute('class', 'movil c3');
							objCeldaFecha.innerHTML = data.rows[intCon].fecha;
							objCeldaModulo.setAttribute('class', 'movil c4');
							objCeldaModulo.innerHTML =  data.rows[intCon].tipo_referencia;
							objCeldaUuid.setAttribute('class', 'movil c5');
							objCeldaUuid.innerHTML =  data.rows[intCon].uuid;
							objCeldaImporte.setAttribute('class', 'movil c6');
							objCeldaImporte.innerHTML = data.rows[intCon].importe;
							objCeldaAcciones.setAttribute('class', 'td-center movil c7');
							objCeldaAcciones.innerHTML = strAccionesRenglon;
							objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
							objCeldaReferenciaID.innerHTML =  data.rows[intCon].referencia_id;

			            }

			            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
						var intFilas = $("#dg_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria tr").length - 1;
						$('#numElementos_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria').html(intFilas);
						$('#txtNumCfdiRelacionados_entradas_maquinaria_devolucion_maquinaria').val(intFilas);
					},
			'json');
		}
		else
		{
			//Mostramos los CFDI´s relacionados (facturas seleccionadas)
			for (var intCon in objCfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria.getCfdis()) 
            {
            	//Crear instancia del objeto CFDI a relacionar 
            	objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria = new CfdiRelacionarEntradasMaquinariaDevolucionMaquinaria();
            	//Asignar datos del CFDI corespondiente al indice
            	objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria = objCfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria.getCfdi(intCon);
            	
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria').getElementsByTagName('tbody')[0];

				//Variable que se utiliza para asignar el id del detalle
				var strDetalleID =  objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.intReferenciaID+'_'+objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strTipoReferencia;

				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
				if (!objTabla.rows.namedItem(strDetalleID))
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCliente = objRenglon.insertCell(0);
					var objCeldaFolio = objRenglon.insertCell(1);
					var objCeldaFecha = objRenglon.insertCell(2);
					var objCeldaModulo = objRenglon.insertCell(3);
					var objCeldaUuid = objRenglon.insertCell(4);
					var objCeldaImporte = objRenglon.insertCell(5);
					var objCeldaAcciones = objRenglon.insertCell(6);
					//Columnas ocultas
					var objCeldaReferenciaID = objRenglon.insertCell(7);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strDetalleID);
					objCeldaCliente.setAttribute('class', 'movil c1');
					objCeldaCliente.innerHTML = objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strCliente;
					objCeldaFolio.setAttribute('class', 'movil c2');
					objCeldaFolio.innerHTML = objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strFolio;
					objCeldaFecha.setAttribute('class', 'movil c3');
					objCeldaFecha.innerHTML = objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.dteFecha;
					objCeldaModulo.setAttribute('class', 'movil c4');
					objCeldaModulo.innerHTML = objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strTipoReferencia;
					objCeldaUuid.setAttribute('class', 'movil c5');
					objCeldaUuid.innerHTML =  objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strUuid;
					objCeldaImporte.setAttribute('class', 'movil c6');
					objCeldaImporte.innerHTML = objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.intImporte;
					objCeldaAcciones.setAttribute('class', 'td-center movil c7');
					objCeldaAcciones.innerHTML = strAccionesTabla;
					objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
					objCeldaReferenciaID.innerHTML = objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.intReferenciaID;
				}
            }

            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
			var intFilas = $("#dg_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria tr").length - 1;
			$('#numElementos_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria').html(intFilas);
			$('#txtNumCfdiRelacionados_entradas_maquinaria_devolucion_maquinaria').val(intFilas);
		}
	}


  	//Función para regresar mostrar los datos de la factura (refacciones/servicio)
	function mostrar_datos_referencia_entradas_maquinaria_devolucion_maquinaria(objRow)
	{

		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_entradas_maquinaria_devolucion_maquinaria();
    	//Recuperar valores
			$('#txtFactura_entradas_maquinaria_devolucion_maquinaria').val(objRow.folio);
			$('#txtMonedaID_entradas_maquinaria_devolucion_maquinaria').val(objRow.moneda_id);
			$('#txtMoneda_entradas_maquinaria_devolucion_maquinaria').val(objRow.moneda);
			$('#txtTipoCambio_entradas_maquinaria_devolucion_maquinaria').val(objRow.tipo_cambio);
		    $('#txtRazonSocial_entradas_maquinaria_devolucion_maquinaria').val(objRow.razon_social);
		    $('#txtRfc_entradas_maquinaria_devolucion_maquinaria').val(objRow.rfc);
		    $('#txtRegimenFiscalID_entradas_maquinaria_devolucion_maquinaria').val(objRow.regimen_fiscal_id);
		    $("#txtRegimenFiscalIDAnterior_entradas_maquinaria_devolucion_maquinaria").val(objRow.regimenFiscalAnterior);
		    $('#txtFormaPagoID_entradas_maquinaria_devolucion_maquinaria').val(objRow.forma_pago_id);
			$('#txtFormaPago_entradas_maquinaria_devolucion_maquinaria').val(objRow.forma_pago);
			$('#txtMetodoPagoID_entradas_maquinaria_devolucion_maquinaria').val(objRow.metodo_pago_id);
			$('#txtMetodoPago_entradas_maquinaria_devolucion_maquinaria').val(objRow.metodo_pago);
			$('#txtUsoCfdiID_entradas_maquinaria_devolucion_maquinaria').val(objRow.uso_cfdi_id);
			$('#txtUsoCfdi_entradas_maquinaria_devolucion_maquinaria').val(objRow.uso_cfdi);

		var precio = parseFloat(objRow.precio);
		var iva = parseFloat(objRow.iva);
		var ieps = parseFloat(objRow.ieps);
		var tipo_cambio = parseFloat(objRow.tipo_cambio);
		var importe = (precio + iva + ieps)/tipo_cambio;

		$('#txtImporteFactura_entradas_maquinaria_devolucion_maquinaria').val( '$'+formatMoney(importe, 2, '') );


		//Crear instancia del objeto CFDI´s relacionados (facturas seleccionadas)
		objCfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria = new CfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria([]);

		//Crear instancia del objeto CFDI a relacionar
		objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria = new CfdiRelacionarEntradasMaquinariaDevolucionMaquinaria(null, '', '', '', '', '', '');

		//Asignar datos al objeto
		objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.intReferenciaID = $('#txtFacturaID_entradas_maquinaria_devolucion_maquinaria').val();
		objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strCliente = objRow.cliente;
		objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strFolio = objRow.folio;
		objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.dteFecha = objRow.fecha_format;
		objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strTipoReferencia =  'FACTURA MAQUINARIA';
		objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.strUuid =  objRow.uuid;
		objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria.intImporte =  $('#txtImporteFactura_entradas_maquinaria_devolucion_maquinaria').val();
		
		//Agregar datos del cfdi a relacionar
        objCfdisRelacionadosEntradasMaquinariaDevolucionMaquinaria.setCfdi(objCfdiRelacionarEntradasMaquinariaDevolucionMaquinaria);
            					    
		//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
	  	agregar_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria('Nuevo', 'ACTIVO');	
		  
	}


	//Función para quitar renglón de la tabla
	function eliminar_renglon_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria(objRenglon)
	{
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
		
		//Eliminar el renglón indicado
		document.getElementById("dg_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria").deleteRow(intRenglon);

		//Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
		var intFilas = $("#dg_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria tr").length - 1;
		$('#numElementos_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria').html(intFilas);
		$('#txtNumCfdiRelacionados_entradas_maquinaria_devolucion_maquinaria').val(intFilas);
	}

	//Al inicializar el componente
	$(document).ready(function() 
	{
        /*******************************************************************************************************************
		Controles correspondientes al MODAL
		*********************************************************************************************************************/
        
        /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad por ejemplo: 10 será 10.00*/
        $('.cantidad_entradas_maquinaria_devolucion_maquinaria').blur(function(){
            $('.cantidad_entradas_maquinaria_devolucion_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
        });

        //Agregar datepicker para seleccionar fecha
		$('#dteFecha_entradas_maquinaria_devolucion_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_entradas_maquinaria_devolucion_maquinaria').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

        //Autocomplete para recuperar los datos de una forma de pago
        $('#txtFormaPago_entradas_maquinaria_devolucion_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtFormaPagoID_entradas_maquinaria_devolucion_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "contabilidad/sat_forma_pago/autocomplete",
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
             $('#txtFormaPagoID_entradas_maquinaria_devolucion_maquinaria').val(ui.item.data);
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });
        
        //Verificar que exista id de la forma de pago cuando pierda el enfoque la caja de texto
        $('#txtFormaPago_entradas_maquinaria_devolucion_maquinaria').focusout(function(e){
            //Si no existe id de la forma de pago
            if($('#txtFormaPagoID_entradas_maquinaria_devolucion_maquinaria').val() == '' ||
               $('#txtFormaPago_entradas_maquinaria_devolucion_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtFormaPagoID_entradas_maquinaria_devolucion_maquinaria').val('');
               $('#txtFormaPago_entradas_maquinaria_devolucion_maquinaria').val('');
            }
            
        });
        
        //Autocomplete para recuperar los datos de un método de pago
        $('#txtMetodoPago_entradas_maquinaria_devolucion_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtMetodoPagoID_entradas_maquinaria_devolucion_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "contabilidad/sat_metodos_pago/autocomplete",
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
             $('#txtMetodoPagoID_entradas_maquinaria_devolucion_maquinaria').val(ui.item.data);
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });
        
        //Verificar que exista id del método de pago cuando pierda el enfoque la caja de texto
        $('#txtMetodoPago_entradas_maquinaria_devolucion_maquinaria').focusout(function(e){
            //Si no existe id del método de pago
            if($('#txtMetodoPagoID_entradas_maquinaria_devolucion_maquinaria').val() == '' ||
               $('#txtMetodoPago_entradas_maquinaria_devolucion_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtMetodoPagoID_entradas_maquinaria_devolucion_maquinaria').val('');
               $('#txtMetodoPago_entradas_maquinaria_devolucion_maquinaria').val('');
            }
            
        });

        //Autocomplete para recuperar los datos de un uso del CFDI
        $('#txtUsoCfdi_entradas_maquinaria_devolucion_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtUsoCfdiID_entradas_maquinaria_devolucion_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "contabilidad/sat_uso_cfdi/autocomplete",
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
             $('#txtUsoCfdiID_entradas_maquinaria_devolucion_maquinaria').val(ui.item.data);
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });
        
        //Verificar que exista id del uso de CFDI cuando pierda el enfoque la caja de texto
        $('#txtUsoCfdi_entradas_maquinaria_devolucion_maquinaria').focusout(function(e){
            //Si no existe id del uso de CFDI
            if($('#txtUsoCfdiID_entradas_maquinaria_devolucion_maquinaria').val() == '' ||
               $('#txtUsoCfdi_entradas_maquinaria_devolucion_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtUsoCfdiID_entradas_maquinaria_devolucion_maquinaria').val('');
               $('#txtUsoCfdi_entradas_maquinaria_devolucion_maquinaria').val('');
            }
            
        });

        //Autocomplete para recuperar los datos de un tipo de relación
        $('#txtTipoRelacion_entradas_maquinaria_devolucion_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtTipoRelacionID_entradas_maquinaria_devolucion_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "contabilidad/sat_tipos_relacion/autocomplete",
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
             $('#txtTipoRelacionID_entradas_maquinaria_devolucion_maquinaria').val(ui.item.data);
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });
        
        //Verificar que exista id del tipo de relación cuando pierda el enfoque la caja de texto
        $('#txtTipoRelacion_entradas_maquinaria_devolucion_maquinaria').focusout(function(e){
            //Si no existe id del tipo de relación
            if($('#txtTipoRelacionID_entradas_maquinaria_devolucion_maquinaria').val() == '' ||
               $('#txtTipoRelacion_entradas_maquinaria_devolucion_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtTipoRelacionID_entradas_maquinaria_devolucion_maquinaria').val('');
               $('#txtTipoRelacion_entradas_maquinaria_devolucion_maquinaria').val('');
            }
            
        });

        //Autocomplete para recuperar los datos de un folio de salida por traspaso generado 
        $('#txtFactura_entradas_maquinaria_devolucion_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtFacturaID_entradas_maquinaria_devolucion_maquinaria').val('');
                //Hacer un llamado a la función para inicializar elementos de la factura de maquinaria
	            inicializar_factura_entradas_maquinaria_devolucion_maquinaria();
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "maquinaria/facturas_maquinaria/autocomplete",
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
           	  

           	   //Si existe id del regimen fiscal
	            if(ui.item.regimen_fiscal_id > 0)
	            {
		           	//Asignar id del registro seleccionado
		           	$('#txtFacturaID_entradas_maquinaria_devolucion_maquinaria').val(ui.item.data); 
				    //Hacer un llamado a la función para regresar los datos de la factura de maquinaria
		            get_datos_factura_entradas_maquinaria_devolucion_maquinaria();
		        }
		        else
	            {
	             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				     mensaje_entradas_maquinaria_devolucion_maquinaria('error_regimen_fiscal','','txtFactura_entradas_maquinaria_devolucion_maquinaria');
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

		//Verificar que exista id de la factura cuando pierda el enfoque la caja de texto
        $('#txtFactura_entradas_maquinaria_devolucion_maquinaria').focusout(function(e){
            //Si no existe id de la factura
            if($('#txtFacturaID_entradas_maquinaria_devolucion_maquinaria').val() == '' ||
               $('#txtFactura_entradas_maquinaria_devolucion_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtFacturaID_entradas_maquinaria_devolucion_maquinaria').val('');
               $('#txtFactura_entradas_maquinaria_devolucion_maquinaria').val('');
            }

        });

         //Función para mover renglones arriba y abajo en la tabla
		$('#dg_cfdi_relacionados_entradas_maquinaria_devolucion_maquinaria').on('click','button.btn',function(){
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
		Controles correspondientes al modal Relacionar CFDI
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		

		//Autocomplete para recuperar los datos de un cliente 
        $('#txtClienteBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtProspectoIDBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').val('');
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
             $('#txtProspectoIDBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').val(ui.item.data);
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
        $('#txtClienteBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').focusout(function(e){
            //Si no existe id del cliente
            if($('#txtProspectoIDBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').val() == '' ||
            	$('#txtClienteBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtProspectoIDBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').val('');
               $('#txtClienteBusq_relacionar_cfdi_entradas_maquinaria_devolucion_maquinaria').val('');
            }
            
        });


       /*******************************************************************************************************************
		Controles correspondientes al modal Cancelación del timbrado
		**************************************	*******************************************************************************/
		 //Autocomplete para recuperar los datos de una sustitución (factura, pago, etc.)
        $('#txtFolioSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtSustitucionID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "maquinaria/entradas_maquinaria_devolucion/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
                   strDescripcion: request.term, 
                   intReferenciaID: $('#txtReferenciaCfdiID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(),
                   strFormulario: 'cancelacion'
                 },
                 success: function( data ) {
                   response( data );
                 }
               });
           },
           select: function( event, ui ) {
             //Asignar id del registro seleccionado
             $('#txtSustitucionID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(ui.item.data);
             $('#txtUuidSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria').val(ui.item.uuid);
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });
        
        //Verificar que exista id del folio de sustitución cuando pierda el enfoque la caja de texto
        $('#txtFolioSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria').focusout(function(e){
            //Si no existe id del tipo de relación
            if($('#txtSustitucionID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val() == '' ||
               $('#txtFolioSustitucion_cancelacion_entradas_maquinaria_devolucion_maquinaria').val() == '')
            { 
               //Hacer un llamado a la función para inicializar elementos de la sustitución
				inicializar_sustitucion_entradas_maquinaria_devolucion_maquinaria();
            }
            
        });

        //Verificar motivo de cancelación cuando cambie la opción del combobox
        $('#cmbCancelacionMotivoID_cancelacion_entradas_maquinaria_devolucion_maquinaria').change(function(e){   
            //Si el motivo de cancelación no corresponde a 01 - Comprobante emitido con errores con relación.
          	if(parseInt($('#cmbCancelacionMotivoID_cancelacion_entradas_maquinaria_devolucion_maquinaria').val()) !== intCancelacionIDRelacionCfdiEntradasMaquinariaDevolucionMaquinaria)
         	{
         		//Hacer un llamado a la función para inicializar elementos de la sustitución
				inicializar_sustitucion_entradas_maquinaria_devolucion_maquinaria();
				
         	}
        });

		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_entradas_maquinaria_devolucion_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_entradas_maquinaria_devolucion_maquinaria').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_entradas_maquinaria_devolucion_maquinaria').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_entradas_maquinaria_devolucion_maquinaria').on('click','a',function(event){
			event.preventDefault();
			intPaginaEntradasMaquinariaDevolucionMaquinaria = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_entradas_maquinaria_devolucion_maquinaria();
		});

		//Autocomplete para recuperar los datos de un clientes 
        $('#txtClienteBusq_entradas_maquinaria_devolucion_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtClienteIDBusq_entradas_maquinaria_devolucion_maquinaria').val('');
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
             $('#txtClienteIDBusq_entradas_maquinaria_devolucion_maquinaria').val(ui.item.data);
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
        $('#txtClienteBusq_entradas_maquinaria_devolucion_maquinaria').focusout(function(e){
            //Si no existe id del cliente
            if($('#txtClienteIDBusq_entradas_maquinaria_devolucion_maquinaria').val() == '' ||
               $('#txtClienteBusq_entradas_maquinaria_devolucion_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtClienteIDBusq_entradas_maquinaria_devolucion_maquinaria').val('');
               $('#txtClienteBusq_entradas_maquinaria_devolucion_maquinaria').val('');
            }

        });

        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_entradas_maquinaria_devolucion_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_entradas_maquinaria_devolucion_maquinaria('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_entradas_maquinaria_devolucion_maquinaria').addClass("estatus-NUEVO");
			//Abrir modal
			 objEntradasMaquinariaDevolucionMaquinaria = $('#EntradasMaquinariaDevolucionMaquinariaBox').bPopup({
										   appendTo: '#EntradasMaquinariaDevolucionMaquinariaContent', 
			                               contentContainer: 'EntradasMaquinariaDevolucionMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});		
		});

        //
        $('#txtFechaInicialBusq_entradas_maquinaria_devolucion_maquinaria').focus();

  
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_entradas_maquinaria_devolucion_maquinaria();
		//Hacer un llamado a la función para cargar los motivos de cancelación en el combobox del modal
        cargar_motivos_cancelacion_entradas_maquinaria_devolucion_maquinaria();
        //Hacer un llamado a la función para cargar exportación en el combobox del modal
         cargar_exportacion_entradas_maquinaria_devolucion_maquinaria();

	});

</script>