
	<div id="MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_movimientos_entradas_refacciones_devolucion_factura_refacciones" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones"
				                    		name= "strFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
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
								<label for="txtFechaFinalBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones"
				                    		name= "strFechaFinalBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
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
								<input id="txtProspectoIDBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
									   name="intProspectoIDBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
									   type="hidden" value="">
								</input>
								<label for="txtRazonSocialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										name="strProspectoBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
								 		name="strEstatusBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones" tabindex="1">
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
								<label for="txtBusqueda_movimientos_entradas_refacciones_devolucion_factura_refacciones">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										name="strBusqueda_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
									   	name="strImprimirDetalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
									   	type="checkbox" value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!-- Buscar registros -->
							<button class="btn btn-primary" id="btnBuscar_movimientos_entradas_refacciones_devolucion_factura_refacciones"
									onclick="paginacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_entradas_refacciones_devolucion_factura_refacciones"
									onclick="reporte_movimientos_entradas_refacciones_devolucion_factura_refacciones('PDF');" title="Generar reporte PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_entradas_refacciones_devolucion_factura_refacciones"
									onclick="reporte_movimientos_entradas_refacciones_devolucion_factura_refacciones('XLS');" title="Descargar archivo XLS" tabindex="1" disabled>
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
				td.movil.a3:nth-of-type(3):before {content: "Referencia"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Factura"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Razón social"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

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
				td.movil.d1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.d5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.d6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles del movimiento
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}

				
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_movimientos_entradas_refacciones_devolucion_factura_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Referencia</th>
							<th class="movil">Factura</th>
							<th class="movil">Razón social</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{tipo_referencia}}</td>
							<td class="movil a4">{{folio_factura}}</td>
							<td class="movil a5">{{razon_social}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_movimientos_entradas_refacciones_devolucion_factura_refacciones({{movimiento_refacciones_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_movimientos_entradas_refacciones_devolucion_factura_refacciones({{movimiento_refacciones_id}},'Ver', {{cancelacion_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Ver motivo de cancelación-->
								<button class="btn btn-default btn-xs {{mostrarAccionMotivoCancelacion}}"  
										onclick="ver_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones({{cancelacion_id}})"  title="Ver motivo de cancelación">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones({{movimiento_refacciones_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_movimientos_entradas_refacciones_devolucion_factura_refacciones({{movimiento_refacciones_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_movimientos_entradas_refacciones_devolucion_factura_refacciones({{movimiento_refacciones_id}}, '{{estatus}}', 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Timbrar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionTimbrar}}"  
										onclick="timbrar_movimientos_entradas_refacciones_devolucion_factura_refacciones({{movimiento_refacciones_id}},'','principal',{{regimen_fiscal_id}})"  title="Timbrar">
									<span class="fa fa-certificate"></span>
								</button>
								<!--Descargar archivos-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_movimientos_entradas_refacciones_devolucion_factura_refacciones({{movimiento_refacciones_id}}, '{{folio}}');" title="Descargar archivos">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_movimientos_entradas_refacciones_devolucion_factura_refacciones({{movimiento_refacciones_id}}, '{{folio}}', {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="5"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_entradas_refacciones_devolucion_factura_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_movimientos_entradas_refacciones_devolucion_factura_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_devolucion_factura_refacciones" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarMovimientosEntradasRefaccionesDevolucionFacturaRefaccionesBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Cliente-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMovimientoRefaccionesID_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   name="intMovimientoRefaccionesID_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el folio del registro seleccionado-->
									<input id="txtFolio_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   name="strFolio_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   type="hidden" value="">
									</input>
									<label for="txtRazonSocial_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones">Razón social</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
											name="strRazonSocial_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value="" 
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
									<label for="txtCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
											name="strCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
											name="strCopiaCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
									onclick="validar_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Relacionar CFDI-->
		<div id="RelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones" class="ModalBodyTitle">
				<h1>Relacionar CFDI</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones">Fecha inicial</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaInicialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones'>
					                    <input class="form-control" id="txtFechaInicialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones"
					                    		name= "strFechaInicialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
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
									<label for="txtFechaFinalBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones">Fecha final</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaFinalBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones'>
					                    <input class="form-control" id="txtFechaFinalBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones"
					                    		name= "strFechaFinalBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
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
									<input id="txtProspectoIDBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   name="intProspectoIDBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones">Razón social</label>
								</div>
								<div class="col-md-12">
									<div class="input-group">
										<input class="form-control" id="txtRazonSocialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
											   name="strRazonSocialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones"  type="text" value="" 
											   tabindex="1" placeholder="Ingrese razón social" maxlength="250" >
										</input>
										<span class="input-group-btn">
											<button class="btn btn-primary" id="btnBuscar_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones"
													onclick="lista_facturas_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones();" title="Buscar coincidencias" tabindex="1">
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
							<input id="txtNumCfdi_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
								   name="intNumCfdi_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones">
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
								<script id="plantilla_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text/template"> 
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
							    		id="chbAgregar_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones" />
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
										<strong id="numElementos_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar CFDI´s-->
							<button class="btn btn-success" id="btnAgregar_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
									onclick="validar_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar CFDI-->


		<!-- Diseño del modal Cancelación del timbrado-->
		<div id="CancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefaccionesBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" class="ModalBodyTitle confirmacion-modal-title">
			<h1>Cancelación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Combobox que contiene los motivos de cancelación activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCancelacionMotivoID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones">Motivo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbCancelacionMotivoID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
									 		name="intCancelacionMotivoID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
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
									<input id="txtReferenciaCfdiID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   name="intReferenciaCfdiID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   type="hidden" value="" />	

									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   name="intPolizaID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="hidden" value="" />

									<label for="txtFolio_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
											name="strFolio_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value="" 
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
									<input id="txtSustitucionID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   name="intSustitucionID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   type="hidden" value="" />	
									<!-- Caja de texto oculta que se utiliza para recuperar el UUID de la factura que sustituye-->
									<input id="txtUuidSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   name="strUuidSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   type="hidden" value="" />	   
									<label for="txtFolioSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones">Sustitución</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolioSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
											name="strFolioSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese anticipos" maxlength="250" >
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Div que contiene los campos del usuario y fecha del registro -->
			 		<div  id="divDatosCreacion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" class="row no-mostrar">
			 			<!--Usuario que realizó la cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuarioCreacion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones">Usuario de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuarioCreacion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
											name="strUsuarioCreacion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value="" 
											 disabled >
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaCreacion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones">Fecha de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFechaCreacion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
											name="strFechaCreacion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 						
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar cancelación del CFDI-->
							<button class="btn btn-success" id="btnGuardar_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
									onclick="validar_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();"  title="Cancelar CFDI" tabindex="1">
								<span class="fa fa-chain-broken"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cancelación del timbrado-->

		<!-- Diseño del modal Entradas por devolución del cliente-->
		<div id="MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_movimientos_entradas_refacciones_devolucion_factura_refacciones"  class="ModalBodyTitle">
			<h1>Entradas por Devolución del Cliente</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_movimientos_entradas_refacciones_devolucion_factura_refacciones" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_movimientos_entradas_refacciones_devolucion_factura_refacciones" class="active">
									<a data-toggle="tab" href="#informacion_general_movimientos_entradas_refacciones_devolucion_factura_refacciones">Información General</a>
								</li>
								<!--Tab que contiene la información de los CFDI relacionados-->
								<li id="tabCfdiRelacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones">
									<a data-toggle="tab" href="#cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones">CFDI Relacionados</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmMovimientosEntradasRefaccionesDevolucionFacturaRefacciones" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMovimientosEntradasRefaccionesDevolucionFacturaRefacciones"  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_movimientos_entradas_refacciones_devolucion_factura_refacciones" class="tab-pane fade in active">
							<div class="row">
								<!-- Folio -->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="strEstatus_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
											<input id="txtPolizaID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intPolizaID_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="hidden" value="" />
											 <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
											<input id="txtFolioPoliza_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="strFolioPoliza_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="hidden" value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la cancelación del registro seleccionado-->
											<input id="txtCancelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intCancelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="hidden" value="" />
											<label for="txtFolio_movimientos_entradas_refacciones_devolucion_factura_refacciones">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													name="strFolio_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													type="text" value="" placeholder="Autogenerado" disabled />
										</div>
									</div>
								</div>
								<!-- Fecha -->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_movimientos_entradas_refacciones_devolucion_factura_refacciones">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_movimientos_entradas_refacciones_devolucion_factura_refacciones'>
							                    <input class="form-control" 
							                    		id="txtFecha_movimientos_entradas_refacciones_devolucion_factura_refacciones"
							                    		name= "strFecha_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
							                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
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
											<input id="txtMonedaID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intMonedaID_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
												   type="hidden"  value="">
											<label for="txtMoneda_movimientos_entradas_refacciones_devolucion_factura_refacciones">Moneda</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMoneda_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													name="strMoneda_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Tipo de cambio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTipoCambio_movimientos_entradas_refacciones_devolucion_factura_refacciones">Tipo de cambio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTipoCambio_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													name="intTipoCambio_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
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
											<input id="txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
												   type="hidden"  value="">
											</input>
											<!-- Caja de texto oculta para recuperar el tipo de referencia (refacciones/servicio) seleccionada-->
											<input id="txtTipoReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="strTipoReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones"  type="hidden" 
												   value="">
											</input>
											<!-- Caja de texto oculta para recuperar el id del régimen fiscal del cliente seleccionado-->
												<input id="txtRegimenFiscalID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													   name="intRegimenFiscalID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													   type="hidden" value="">
												</input>
											<!-- Caja de texto oculta para recuperar el id del régimen fiscal anterior (validar si es necesario modificar el régimen fiscal del registro  usado como referencia)-->
											<input id="txtRegimenFiscalIDAnterior_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intRegimenFiscalIDAnterior_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   type="hidden" value="">
											</input>		
											<!-- Caja de texto oculta que se utiliza para recuperar el importe de la factura (para mostrarlo en la tabla CFDI relacionados)-->
											<input id="txtImporteFactura_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intImporteFactura_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
												   type="hidden"  value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el módulo de referencia (para mostrarlo en la tabla CFDI relacionados)-->
											<input id="txtModuloReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="strModuloReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
												   type="hidden"  value="">
											</input>
											<label for="txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones">Factura</label>
										</div>	
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													name="strReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													type="text" value="" tabindex="1" placeholder="Ingrese factura" maxlength="250" />
										</div>
									</div>	
								</div>
								<!--Razón social-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRazonSocial_movimientos_entradas_refacciones_devolucion_factura_refacciones">Razón social</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRazonSocial_movimientos_entradas_refacciones_devolucion_factura_refacciones"
												   name="strRazonSocial_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Rfc-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRfc_movimientos_entradas_refacciones_devolucion_factura_refacciones">RFC</label>
										</div>	
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtRfc_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													name="strRfc_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
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
											<input id="txtFormaPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intFormaPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones">
												Forma de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													name="strFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value=""  
													tabindex="1" placeholder="Ingrese forma de pago" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los métodos de pago activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del método de pago seleccionado-->
											<input id="txtMetodoPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intMetodoPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones">
												Método de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													name="strMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value=""  
													tabindex="1" placeholder="Ingrese método de pago" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Combobox que contiene la exportación activa-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbExportacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones">Exportación</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbExportacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones"
											        name="intExportacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones" tabindex="1">
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
											<input id="txtUsoCfdiID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intUsoCfdiID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones">
												Uso del CFDI
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													name="strUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value=""  
													tabindex="1" placeholder="Ingrese uso del CFDI" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los tipos de relación activos-->
								<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del tipo de relación seleccionado-->
											<input id="txtTipoRelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intTipoRelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtTipoRelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones">
												Tipo de relación
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTipoRelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													name="strTipoRelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text" value=""  
													tabindex="1" placeholder="Ingrese tipo de relación" maxlength="250">
											</input>
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
		                                    <input id="txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
		                                           name="intEmpleadoAutorizacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones"  type="hidden" 
		                                           value="">
		                                    </input>
		                                    <label for="txtEmpleadoAutorizacion_movimientos_entradas_refacciones_devolucion_factura_refacciones">Autoriza</label>
		                                </div>  
		                                <div class="col-md-12">
		                                    <input  class="form-control" 
		                                            id="txtEmpleadoAutorizacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
		                                            name="strEmpleadoAutorizacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
		                                            type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250" />
		                                </div>
		                            </div>
		                        </div>
		                    </div>
							<div class="row">
								<!-- Observaciones -->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObservaciones_movimientos_entradas_refacciones_devolucion_factura_refacciones">Observaciones</label>
										</div>	
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtObservaciones_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													name="strObservaciones_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
													type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250" />			
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
											<input id="txtNumDetalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
												   name="intNumDetalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="hidden" value="">
											</input>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">Detalles de la entrada por devolución</h4>
												</div>
												<div class="panel-body">
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!--Código-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<!-- Caja de texto oculta que se utiliza para recuperar el renglón de la refacción-->
																		<input id="txtRenglon_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																			   name="intRenglon_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																			   type="hidden" value="">
																		</input>
																		<!-- Caja de texto oculta que se utiliza para recuperar la cantidad de salida de la refacción-->
																		<input id="txtCantidadSalida_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																			   name="intCantidadSalida_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																			   type="hidden" value="">
																		</input>
																		<!-- Caja de texto oculta que se utiliza para recuperar la cantidad devuelta al taller-->
																		<input id="txtCantidadDevolucion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																			   name="intCantidadDevolucion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																			   type="hidden" value="">
																		</input>
																		<label for="txtCodigo_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones">
																			Código
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" 
																				id="txtCodigo_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																				name="strCodigo_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																				type="text" value="" disabled />
																	</div>
																</div>
															</div>
															<!--Descripción-->
															<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtDescripcion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones">
																			Descripción
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" 
																				id="txtDescripcion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																				name="strDescripcion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																				type="text" value="" disabled/>
																	</div>
																</div>
															</div>
															<!--Cantidad-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones">
																			Cantidad
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control cantidad_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																				id="txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																				name="intCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																				type="text" value="" tabindex="1"
																				placeholder="Ingrese cantidad" maxlength="14" />
																	</div>
																</div>
															</div>
															<!--Precio unitario-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtPrecioUnitario_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones">Precio unitario</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" 
																				id="txtPrecioUnitario_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																				name="intPrecioUnitario_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
																				type="text" value="" disabled />
																	</div>
																</div>
															</div>
															<!--Botón agregar-->
							                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
							                                	<button class="btn btn-primary btn-toolBtns" 
							                                			id="btnAgregar_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
							                                			 onclick="agregar_renglon_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones();" 
							                                	     	title="Agregar" tabindex="1"> 
							                                		<span class="glyphicon glyphicon-plus"></span>
							                                	</button>
							                             	</div>
														</div>
													</div>
													<!--Div que contiene la tabla con los detalles encontrados-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!-- Diseño de la tabla-->
															<table class="table-hover movil" id="dg_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones">
																<thead class="movil">
																	<tr class="movil">
																		<th class="movil">Código</th>
																		<th class="movil">Descripción</th>
																		<th class="movil">Cantidad</th>
																		<th class="movil">Precio Unit.</th>
																		<th class="movil">Subtotal</th>
																		<th class="movil" id="th-acciones" style="width:6em;">Acciones</th>
																	</tr>
																</thead>
																<tbody class="movil"></tbody>
																<tfoot class="movil">
																	<tr class="movil">
																		<td class="movil t1">
																			<strong>Total</strong>
																		</td>
																		<td class="movil t2"></td>
																		<td  class="movil t3">
																			<strong id="acumCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones"></strong>
																		</td>
																		<td class="movil t4"></td>
																		<td class="movil t5">
																			<strong id="acumSubtotal_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones"></strong>
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
																		<strong id="numElementos_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones">0</strong> encontrados
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
						</div><!--Cierre del contenido del tab - Información General-->
						<!--Tab - CFDI relacionados-->
						<div id="cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones" class="tab-pane fade">
							<div class="row">
								<!--Botones-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="btn-group pull-right">
										<!--Buscar CFDI a relacionar para agregarlos en la tabla-->
										<button class="btn btn-primary" 
		                                			id="btnBuscarCFDI_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
		                                			onclick="abrir_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones();" 
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
									<input id="txtNumCfdiRelacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones" 
										   name="intNumCfdiRelacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="hidden" value="">
									</input>
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones">
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
												<strong id="numElementos_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - CFDI relacionados-->
					</div><!--Cierre del contenedor de tabs-->
					<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_movimientos_entradas_refacciones_devolucion_factura_refacciones" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
									onclick="validar_movimientos_entradas_refacciones_devolucion_factura_refacciones();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
									onclick="abrir_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones('');"  
									title="Enviar correo electrónico" tabindex="3" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Ver motivo de cancelación del registro-->
							<button class="btn btn-default" id="btnVerMotivoCancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
									onclick="ver_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones('');"  title="Ver motivo de cancelación" tabindex="4">
								<i class="fa fa-info-circle" aria-hidden="true"></i>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
									onclick="reporte_registro_movimientos_entradas_refacciones_devolucion_factura_refacciones('');"  
									title="Imprimir" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivos-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
									onclick="descargar_archivos_movimientos_entradas_refacciones_devolucion_factura_refacciones('','');"  title="Descargar archivos" tabindex="6" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_movimientos_entradas_refacciones_devolucion_factura_refacciones"  
									onclick="cambiar_estatus_movimientos_entradas_refacciones_devolucion_factura_refacciones('', '', '', '');"  title="Desactivar" tabindex="7" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_movimientos_entradas_refacciones_devolucion_factura_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_movimientos_entradas_refacciones_devolucion_factura_refacciones();" 
									title="Cerrar"  tabindex="8">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Entradas por devolución del cliente-->
	</div><!--#MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesContent -->


	<!-- /.Plantilla para cargar los motivo de cancelación en el combobox-->  
	<script id="cancelacion_motivos_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#motivos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/motivos}} 
	</script>

	<!-- /.Plantilla para cargar la exportación en el combobox-->  
	<script id="exportacion_movimientos_entradas_refacciones_devolucion_factura_refacciones" type="text/template">
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
		var intPaginaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = 0;
		var strUltimaBusquedaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar en el timbrado y cfdi's relacionados)*/
		var strTipoReferenciaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = "DEVOLUCION REFACCIONES";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
		var strTipoReferenciaPolizaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = "MOVIMIENTO DE REFACCIONES";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = <?php echo NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES ?>;
		var intNumDecimalesPrecioUnitBDMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = <?php echo NUM_DECIMALES_PRECIO_UNIT_MOV_REFACCIONES ?>;

		//Variable que se utiliza para asignar el id del motivo de cancelación: Comprobante emitido con errores con relación.
		var intCancelacionIDRelacionCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = <?php echo MOTIVO_CANCELACION_RELACIONCFDI ?>;

		//Variable que se utiliza para asignar el id de la exportación base
		var intExportacionBaseIDMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = <?php echo EXPORTACION_BASE ?>;

		//Variable que se utiliza para asignar el mensaje de régimen fiscal faltante.
		var strMsjRegimenFiscalCteMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = "<?php echo MSJ_ERROR_REGIMEN_FISCAL ?>";

		//Variable que se utiliza para asignar objeto del modal Cancelación del timbrado
		var objCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = null;

		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = null;
		//Variable que se utiliza para asignar objeto del modal Relacionar CFDI
		var objRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = null;
		//Variable que se utiliza para asignar objeto del modal Entradas por devolución del cliente
		var objMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = null;


		/*******************************************************************************************************************
		Funciones del objeto CFDI's  relacionados (facturas seleccionadas)
		*********************************************************************************************************************/
		// Constructor del objeto CFDI's relacionados (facturas seleccionadas)
		var objCfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones;
		function CfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones(cfdis)
		{
			this.arrCfdis = cfdis;
		}

		//Función para obtener todos los cfdi´s seleccionados
		CfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.prototype.getCfdis = function() {
		    return this.arrCfdis;
		}

		//Función para agregar un cfdi al objeto 
		CfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.prototype.setCfdi = function (cfdi){
			this.arrCfdis.push(cfdi);
		}

		//Función para obtener un cfdi del objeto 
		CfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.prototype.getCfdi = function(index) {
		    return this.arrCfdis[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto CFDI a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto CFDI a relacionar
		var objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones;
		
		function CfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones(referenciaID, cliente, folio, fecha, tipoReferencia, uuid, importe)
		{
		    this.intReferenciaID = referenciaID;
		    this.strRazonSocial = cliente;
		    this.strFolio = folio;
		    this.dteFecha = fecha;
		    this.strTipoReferencia = tipoReferencia;
		    this.strUuid = uuid;
		    this.intImporte = importe;
		}


		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/movimientos_entradas_refacciones_devolucion_factura/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = strPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones[i]=='GUARDAR') || (arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
						}
						else if(arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_movimientos_entradas_refacciones_devolucion_factura_refacciones() 
		{

		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones =($('#txtFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()+$('#txtFechaFinalBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()+$('#txtProspectoIDBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()+$('#cmbEstatusBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()+$('#txtBusqueda_movimientos_entradas_refacciones_devolucion_factura_refacciones').val());

			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones != strUltimaBusquedaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones)
			{
				intPaginaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = 0;
				strUltimaBusquedaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = strNuevaBusquedaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/movimientos_entradas_refacciones_devolucion_factura/get_paginacion',
					{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial:$.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()),
					  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()),
					  intProspectoID: $('#txtProspectoIDBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
					  strEstatus:     $('#cmbEstatusBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
					  strBusqueda:    $('#txtBusqueda_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
					  intPagina: intPaginaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones,
					  strPermisosAcceso: $('#txtAcciones_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()
					},
					function(data){
						$('#dg_movimientos_entradas_refacciones_devolucion_factura_refacciones tbody').empty();
						var tmpMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = Mustache.render($('#plantilla_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(),data);
						$('#dg_movimientos_entradas_refacciones_devolucion_factura_refacciones tbody').html(tmpMovimientosEntradasRefaccionesDevolucionFacturaRefacciones);
						$('#pagLinks_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(data.paginacion);
						$('#numElementos_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(data.total_rows);
						intPaginaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = data.pagina;
					},
			'json');
		}



		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_movimientos_entradas_refacciones_devolucion_factura_refacciones(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/movimientos_entradas_refacciones_devolucion_factura/';

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
			if ($('#chbImprimirDetalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()),
										'intProspectoID': $('#txtProspectoIDBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
										'strEstatus': $('#cmbEstatusBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(), 
										'strBusqueda': $('#txtBusqueda_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
										'strDetalles': $('#chbImprimirDetalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_movimientos_entradas_refacciones_devolucion_factura_refacciones(id) 
		{
			//Variable que se utiliza para asignar el valores del registro
			var intID = 0;

			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
				
			}
			else
			{
				intID = id;
			}



			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url':  'contabilidad/timbradoV4/get_pdf',
							'data' : {
										'intReferenciaID':intID,
										'strTipoReferencia':strTipoReferenciaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones,
										'strTimbrar': 'NO'		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);	
		}

		

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_movimientos_entradas_refacciones_devolucion_factura_refacciones(movimientoRefaccionesID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(movimientoRefaccionesID == '')
			{
				intID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
				strFolio = $('#txtFolio_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
			}
			else
			{
				intID = movimientoRefaccionesID;
				strFolio = folio;
			}

			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'contabilidad/timbradoV4/descargar_archivos',
							'data' : {
										'intReferenciaID': intID,
										'strTipoReferencia': strTipoReferenciaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones,
										'strFolio':strFolio		
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

			
		}

		



		 /*******************************************************************************************************************
		Funciones del modal Cancelación del timbrado
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Incializar formulario
			$('#frmCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones');
			//Habilitar todos los elementos del formulario
			$('#frmCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').attr('disabled','disabled');
			//Mostrar botón de Guardar
		    $("#btnGuardar_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones").show();
		    //Agregar clase para ocultar div que contiene los datos de creación del registro
			$("#divDatosCreacion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones").addClass('no-mostrar');
		}

		//Función que se utiliza para abrir el modal
		function abrir_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones(id, folio, polizaID)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();

			//Asignar datos del registro seleccionado
			$('#txtReferenciaCfdiID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(id);
			$('#txtFolio_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(folio);
			$('#txtPolizaID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(polizaID);
			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').addClass("estatus-ACTIVO");

		    //Abrir modal
			objCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = $('#CancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefaccionesBox').bPopup({
												   appendTo: '#MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesContent', 
						                           contentContainer: 'MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesM', 
						                           zIndex: 2, 
						                           modalClose: false, 
						                           modal: true, 
						                           follow: [true,false], 
						                           followEasing : "linear", 
						                           easing: "linear", 
						                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#cmbCancelacionMotivoID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
		}

		//Función para regresar los datos (al formulario) del registro seleccionados
		function ver_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones(id)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCancelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/cancelaciones/get_datos',
	        {
	       		intCancelacionID:intID,
	       		strTipoReferencia:strTipoReferenciaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones
	        },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			               //Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
							//Recuperar valores
							$('#cmbCancelacionMotivoID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.cancelacion_motivo_id);
							$('#txtFolio_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.folio_referencia);
							$('#txtFolioSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.folio_sustitucion);
							$('#txtUsuarioCreacion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.usuario_creacion);
							$('#txtFechaCreacion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.fecha_creacion);

							//Dependiendo del estatus cambiar el color del encabezado 
		   					$('#divEncabezadoModal_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').addClass("estatus-INACTIVO");

		   				    //Deshabilitar todos los elementos del formulario
				            $('#frmCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').find('input, textarea, select').attr('disabled','disabled');
		   					//Ocultar botón de Guardar
				            $("#btnGuardar_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones").hide();
				            //Remover clase para mostrar div que contiene los datos de creación del registro
							$("#divDatosCreacion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones").removeClass('no-mostrar');

							//Abrir modal
							objCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = $('#CancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefaccionesBox').bPopup({
												   appendTo: '#MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesContent', 
						                           contentContainer: 'MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesM', 
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
		function cerrar_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			try {
				//Cerrar modal
				objCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	intCancelacionMotivoID_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione un motivo'}
											}
										},
										strFolioSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if(value == '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()) === intCancelacionIDRelacionCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones) 
					                                    	
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un anticipo existente'
					                                        };
					                                    }
					                                    else if(value !== '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()) !== intCancelacionIDRelacionCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones)
					                                    {

					                                    	//Hacer un llamado a la función para inicializar elementos de la sustitución
					                                    	inicializar_sustitucion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones = $('#frmCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').data('bootstrapValidator');
			bootstrapValidator_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones.isValid())
			{
				//Hacer un llamado a la función para cancelar el timbrado de un registro
				cancelar_timbrado_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			try
			{
				$('#frmCancelacionMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		
		//Función para inicializar elementos de la sustitución de CFDI
		function inicializar_sustitucion_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			
			//Limpiar contenido de las siguientes cajas de texto
           $('#txtSustitucionID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
           $('#txtUuidSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
           $('#txtFolioSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
		}


		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function mostrar_circulo_carga_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function ocultar_circulo_carga_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones").addClass('no-mostrar');
		}

		//Regresar motivos de cancelación activos para cargarlos en el combobox
		function cargar_motivos_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_cancelacion_motivos/get_combo_box', {},
				function(data)
				{
					$('#cmbCancelacionMotivoID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').empty();
					var temp = Mustache.render($('#cancelacion_motivos_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(), data);
					$('#cmbCancelacionMotivoID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(temp);
				},
				'json');
		}



		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Incializar formulario
			$('#frmEnviarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones');
		    
		}


		//Función que se utiliza para abrir el modal
		function abrir_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/movimientos_entradas_refacciones_devolucion_factura/get_datos',
			       {intMovimientoRefaccionesID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtMovimientoRefaccionesID_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.movimiento_refacciones_id);
							$('#txtFolio_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.folio);
							$('#txtRazonSocial_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.razon_social);
							$('#txtCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = $('#EnviarMovimientosEntradasRefaccionesDevolucionFacturaRefaccionesBox').bPopup({
																		   appendTo: '#MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesContent', 
												                           contentContainer: 'MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesM', 
												                           zIndex: 2, 
												                           modalClose: false, 
												                           modal: true, 
												                           follow: [true,false], 
												                           followEasing : "linear", 
												                           easing: "linear", 
												                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			try {
				//Cerrar modal
				objEnviarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
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
			var bootstrapValidator_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones = $('#frmEnviarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').data('bootstrapValidator');
			bootstrapValidator_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			try
			{
				$('#frmEnviarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al cliente
		function enviar_correo_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
			$.post('contabilidad/timbradoV4/enviar_correo_electronico_cliente',
					{ 
						intReferenciaID: $('#txtMovimientoRefaccionesID_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						strTipoReferencia: strTipoReferenciaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones,
						strFolio: $('#txtFolio_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_movimientos_entradas_refacciones_devolucion_factura_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones").addClass('no-mostrar');
		}

		/*******************************************************************************************************************
		Funciones del modal Relacionar CFDI
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Incializar formulario
			$('#frmRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones');
			//Eliminar los datos de la tabla CFDI a relacionar
		    $('#dg_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones tbody').empty();
		    $('#numElementos_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(0);
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').addClass("estatus-"+strEstatus);
			//Abrir modal
			objRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = $('#RelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefaccionesBox').bPopup({
											  appendTo: '#MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesContent', 
			                              	  contentContainer: 'MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesM', 
			                              	  zIndex: 2, 
			                              	  modalClose: false, 
			                              	  modal: true, 
			                              	  follow: [true,false], 
			                              	  followEasing : "linear", 
			                              	  easing: "linear", 
			                             	  modalColor: ('#F0F0F0')});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
			//Hacer un llamado a la función  para cargar los CFDI´s en el grid
			lista_facturas_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			try {
				//Cerrar modal
				objRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{

			//Hacer un llamado a la función para agregar las facturas (CFDI) seleccionadas al  objeto CFDI's  relacionados
			agregar_facturas_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumCfdi_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
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
										strFechaInicialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinalBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strRazonSocialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones = $('#frmRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').data('bootstrapValidator');
			bootstrapValidator_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones();
				//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
		  		agregar_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones('Nuevo', '');
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			try
			{
				$('#frmRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar CFDI's
		*********************************************************************************************************************/
		//Función para la búsqueda de CFDI's 
		function lista_facturas_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones() 
		{
			//Variables que se utilizan para asignar los criterios de búsqueda
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaInicialBusq =  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val());
			var dteFechaFinalBusq =  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val());
			var intProspectoIDBusq =  $('#txtProspectoIDBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();

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
						$('#dg_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones tbody').empty();
						var tmpRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = Mustache.render($('#plantilla_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(),data);
						$('#numElementos_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(data.rows.length);	
						}
						$('#dg_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones tbody').html(tmpRelacionarCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones);
						
					},
			'json');

			
		}

		//Función para agregar las facturas (CFDI) seleccionadas al objeto CFDI's  relacionados
		function agregar_facturas_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
             
            //Crear instancia del objeto CFDI´s relacionados (facturas seleccionadas)
			objCfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = new CfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
                	//Crear instancia del objeto CFDI a relacionar
					objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = new CfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones(null, '', '', '', '', '', '');

                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.intReferenciaID = strValor;
							        break;
							    case 1:
							        objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strRazonSocial = strValor;
							        break;
							    case 2:
							        objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strFolio = strValor;
							        break;
							    case 3:
							        objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.dteFecha = strValor;
							        break;
							    case 4:
							        objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strTipoReferencia = strValor;
							        break;
							    case 5:
							       	objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strUuid = strValor;
							        break;
							    case 6:
							       	objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.intImporte = strValor;
							       	break;
							}

					      	intCol++;
					    });

                	//Agregar datos del cfdi a relacionar
                	objCfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.setCfdi(objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumCfdi_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(intContador);

		}


		/*******************************************************************************************************************
		Funciones del modal Entradas por devolución del cliente
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Incializar formulario
			$('#frmMovimientosEntradasRefaccionesDevolucionFacturaRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').find('input[type=hidden]').val('');

			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_movimientos_entradas_refacciones_devolucion_factura_refacciones');
			//Hacer un llamado a la función para inicializar elementos de las tablas detalles y CFDI´s relacionados
			inicializar_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			
			//Habilitar todos los elementos del formulario
			$('#frmMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Seleccionar tab que contiene la información general del movimiento
			$('a[href="#informacion_general_movimientos_entradas_refacciones_devolucion_factura_refacciones"]').click();
			//Asignar la fecha actual
			$('#txtFecha_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$("#txtMoneda_movimientos_entradas_refacciones_devolucion_factura_refacciones").attr('disabled','disabled');
			$("#txtTipoCambio_movimientos_entradas_refacciones_devolucion_factura_refacciones").attr('disabled','disabled');
			$('#txtFolio_movimientos_entradas_refacciones_devolucion_factura_refacciones').attr("disabled", "disabled");
			$('#txtOrdenReparacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').attr("disabled", "disabled");
			$('#txtRfc_movimientos_entradas_refacciones_devolucion_factura_refacciones').attr("disabled", "disabled");
			$('#txtRazonSocial_movimientos_entradas_refacciones_devolucion_factura_refacciones').attr("disabled", "disabled");
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').attr("disabled", "disabled");
			$('#txtDescripcion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').attr("disabled", "disabled");
			$('#txtPrecioUnitario_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').attr("disabled", "disabled");

			 //Mostrar por Default 01- No aplica
			$('#cmbExportacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(intExportacionBaseIDMovimientosEntradasRefaccionesDevolucionFacturaRefacciones);

 			//Mostrar los siguientes botones
			$("#btnGuardar_movimientos_entradas_refacciones_devolucion_factura_refacciones").show();
			$("#btnBuscarCFDI_movimientos_entradas_refacciones_devolucion_factura_refacciones").show(); 
			//Ocultar los siguientes botones
			$("#btnEnviarCorreo_movimientos_entradas_refacciones_devolucion_factura_refacciones").hide();
			$("#btnImprimirRegistro_movimientos_entradas_refacciones_devolucion_factura_refacciones").hide();
			$("#btnDescargarArchivo_movimientos_entradas_refacciones_devolucion_factura_refacciones").hide();
			$("#btnDesactivar_movimientos_entradas_refacciones_devolucion_factura_refacciones").hide();
			$('#btnVerMotivoCancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').hide();
			
		}

		//Función para inicializar elementos de la factura (refacciones/servicio)
		function inicializar_factura_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtMonedaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
			$('#txtMoneda_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            $('#txtTipoCambio_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            $('#txtRfc_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            $('#txtRegimenFiscalID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            $('#txtRazonSocial_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            $('#txtFormaPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            $('#txtFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            $('#txtMetodoPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            $('#txtMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            $('#txtUsoCfdiID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            $('#txtUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	        $('#txtImporteFactura_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	        $('#txtModuloReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            //Hacer un llamado a la función para inicializar elementos de las tablas detalles y CFDI´s relacionados
		    inicializar_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones();
		}
																	
		//Función para inicializar elementos de las tablas detalles y CFDI's relacionados
		function inicializar_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Hacer un llamado a la función para inicializar elementos de la refacción
			inicializar_refaccion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones();

			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones tbody').empty();
			$('#acumCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').html('');
		    $('#acumSubtotal_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').html('');
			$('#numElementos_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(0);
			$('#txtNumDetalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');

		    //Eliminar los datos de la tabla CFDI´s relacionados
		    $('#dg_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones tbody').empty();
			$('#numElementos_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(0);
			$('#txtNumCfdiRelacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			try {

				//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
				cerrar_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
				cerrar_cliente_movimientos_entradas_refacciones_devolucion_factura_refacciones();
				//Hacer un llamado a la función para cerrar modal Relacionar CFDI
				cerrar_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_movimientos_entradas_refacciones_devolucion_factura_refacciones('');
				//Cerrar modal
				objMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_entradas_refacciones_devolucion_factura_refacciones();

			//Validación del formulario de campos obligatorios
			$('#frmMovimientosEntradasRefaccionesDevolucionFacturaRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
										},
										strReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la factura
					                                    if($('#txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una factura existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strEmpleadoAutorizacion_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
                                            validators: {
                                                callback: {
                                                    callback: function(value, validator, $field) {
                                                        //Verificar que exista id del empleado
                                                        if($('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() === '')
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
                                        strFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la forma de pago
					                                    if($('#txtFormaPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() === '')
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
										strMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del método de pago
					                                    if($('#txtMetodoPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() === '')
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
										intExportacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una exportación'}
											}
										},
										strUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del uso de CFDI
					                                    if($('#txtUsoCfdiID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() === '')
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
										strTipoRelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if(($('#txtTipoRelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() === '') 
					                                    	|| ($('#txtTipoRelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() === '' && parseInt($('#txtNumCfdiRelacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()) > 0))
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
										intNumDetalles_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseFloat(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos una devolución para esta entrada.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
									    intCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones: {
									        excluded: true  // Ignorar (no valida el campo)    
									    }
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_movimientos_entradas_refacciones_devolucion_factura_refacciones = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_movimientos_entradas_refacciones_devolucion_factura_refacciones = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_movimientos_entradas_refacciones_devolucion_factura_refacciones.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_movimientos_entradas_refacciones_devolucion_factura_refacciones.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_movimientos_entradas_refacciones_devolucion_factura_refacciones = $('#frmMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').data('bootstrapValidator');
			bootstrapValidator_movimientos_entradas_refacciones_devolucion_factura_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_movimientos_entradas_refacciones_devolucion_factura_refacciones.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			}
			else 
				return;
		}


		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			try
			{
				$('#frmMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Obtenemos el objeto de la tabla CFDI relacionados
			var objTabla = document.getElementById('dg_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').getElementsByTagName('tbody')[0];

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

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla detalles
			var arrRenglon = [];
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCodigosLineas = [];
			var arrCantidades = [];
			var arrCostosUnitarios = [];
			var arrPreciosUnitarios = [];
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioMovimiento = parseFloat($('#txtTipoCambio_movimientos_entradas_refacciones_devolucion_factura_refacciones').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad =  $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intPrecioUnitario = $.reemplazar(objRen.cells[11].innerHTML, ",", "");

				//Si existe cantidad a devolver
				if(intCantidad > 0)
				{
					//Convertir importes a peso mexicano
					intPrecioUnitario = intPrecioUnitario * intTipoCambioMovimiento;
					
					//Asignar valores a los arrays
					arrRenglon.push(objRen.getAttribute('id'));
					arrRefaccionID.push(objRen.cells[8].innerHTML);
					arrCodigos.push(objRen.cells[0].innerHTML);
					arrDescripciones.push(objRen.cells[1].innerHTML);
					arrCodigosLineas.push(objRen.cells[9].innerHTML);
					arrCantidades.push(intCantidad);
					arrCostosUnitarios.push(objRen.cells[10].innerHTML);
					arrPreciosUnitarios.push(intPrecioUnitario);
				}
				
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/movimientos_entradas_refacciones_devolucion_factura/guardar',
					{ 
						//Datos del movimiento
						intMovimientoRefaccionesID: $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()),
						intMonedaID: $('#txtMonedaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						intTipoCambio:  intTipoCambioMovimiento,
						strTipoReferencia: $('#txtTipoReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						intReferenciaID: $('#txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						intRegimenFiscalIDAnterior: $('#txtRegimenFiscalIDAnterior_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						intEmpleadoAutorizacion: $('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						intFormaPagoID: $('#txtFormaPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						intMetodoPagoID: $('#txtMetodoPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						intUsoCfdiID: $('#txtUsoCfdiID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						intTipoRelacionID: $('#txtTipoRelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						intExportacionID: $('#cmbExportacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						strObservaciones: $('#txtObservaciones_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
						//Datos de los detalles
						strRenglon: arrRenglon.join('|'),
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCodigosLineas: arrCodigosLineas.join('|'),
						strCantidades: arrCantidades.join('|'),
						strCostosUnitarios: arrCostosUnitarios.join('|'),
						strPreciosUnitarios: arrPreciosUnitarios.join('|'),
						//Datos de los CFDI relacionados
						strCfdiRelacionado: arrCfdiRelacionado.join('|'),
						strTiposRelacion: arrTiposRelacion.join('|')
					},
					function(data) {
						if (data.resultado)
						{	
							//Si no existe id del movimiento, significa que es un nuevo registro   
							if($('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
							{
							  	//Asignar el id del anticipo registrado en la base de datos
                     			$('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.movimiento_refacciones_id);
                 			}
                 			

                 			 //Hacer llamado a la función  para cargar  los registros en el grid
		               		paginacion_movimientos_entradas_refacciones_devolucion_factura_refacciones(); 


		               		//Hacer un llamado a la función para timbrar los datos del registro
							timbrar_movimientos_entradas_refacciones_devolucion_factura_refacciones($('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(), 'modal', '', $('#txtRegimenFiscalID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val());

							
		               		//Si no existe id de la póliza (o se trata de un nuevo registro)
							if(parseInt($('#txtPolizaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()) == 0 || 
								$('#txtEstatus_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
							{
								//Hacer un llamado a la función para generar póliza con los datos del registro
								generar_poliza_movimientos_entradas_refacciones_devolucion_factura_refacciones('', '', '');
							} 
						}

						//Si existe mensaje de error
						if(data.tipo_mensaje == 'error')
						{
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_movimientos_entradas_refacciones_devolucion_factura_refacciones(data.tipo_mensaje, data.mensaje);
						}
					},
			'json');
		}


		//Regresar exportación activa para cargarlas en el combobox
		function cargar_exportacion_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar la exportación que se encuentra activa
			$.post('contabilidad/sat_exportacion/get_combo_box', {},
				function(data)
				{
					$('#cmbExportacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').empty();
					var temp = Mustache.render($('#exportacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(), data);
					$('#cmbExportacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(temp);
				},
				'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_movimientos_entradas_refacciones_devolucion_factura_refacciones(tipoMensaje, mensaje, campoID)
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
													$('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
												 }
												}]
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
				new $.Zebra_Dialog(strMsjRegimenFiscalCteMovimientosEntradasRefaccionesDevolucionFacturaRefacciones, 
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

		//Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_movimientos_entradas_refacciones_devolucion_factura_refacciones(id, folio, polizaID, folioPoliza)
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
				intID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
				strFolio = $('#txtFolio_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
				intPolizaID = $('#txtPolizaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
				strFolioPoliza = $('#txtFolioPoliza_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();

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
					             {'type':     'question',
					              'title':    'Entradas por Devolución del Cliente',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado a la función para abrir el modal Cancelación del timbrado (cambiar estatus y cancelar timbrado del registro)
					                              abrir_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones(intID, strFolio, intPolizaID);
					                            }
					                          }
					              });
		}


		//Función para cancelar el timbrado de un registro. Cambia el estatus a INACTIVO
		function cancelar_timbrado_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			 //Hacer un llamado al método del controlador para cancelar un CFDI y posteriormente cambiar el estatus a INACTIVO
	         //----- CÓDIGO PARA PRODUCCIÓN
	          $.post('contabilidad/timbrado_cancelar/set_cancelar',
	          {
	          		//Datos para cancelar el timbrado (CFDI)
	         		intMovimientoID: $('#txtReferenciaCfdiID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
					strTipoReferencia: strTipoReferenciaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones, 
					strUuidSustitucion: $('#txtUuidSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
					strMotivo: $('select[name="intCancelacionMotivoID_movimientos_entradas_refacciones_devolucion_factura_refacciones"] option:selected').text(),
					//Datos para cambiar (administrativamente) el estatus del registro
					intCancelacionMotivoID: $('#cmbCancelacionMotivoID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(), 
					intSustitucionID:  $('#txtSustitucionID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
					intPolizaID: $('#txtPolizaID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()
	          },
	                 function(data) {

	                    if(data.resultado)
	                    {
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();	

							//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
							cerrar_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();  

							//Si el id del registro se obtuvo del modal
							if($('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() != '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_movimientos_entradas_refacciones_devolucion_factura_refacciones();     
							}		
	                    }

	                    //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
				        ocultar_circulo_carga_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
					    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_movimientos_entradas_refacciones_devolucion_factura_refacciones(data.tipo_mensaje, data.mensaje);


	                 },
	                'json');

		}



		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_movimientos_entradas_refacciones_devolucion_factura_refacciones(id, tipoAccion, cancelacionID)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/movimientos_entradas_refacciones_devolucion_factura/get_datos',
			       {intMovimientoRefaccionesID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_movimientos_entradas_refacciones_devolucion_factura_refacciones();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el id de la póliza
				            var intPolizaID = parseInt(data.row.poliza_id); 
				            
				          	//Recuperar valores
				            $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.movimiento_refacciones_id);
				            $('#txtFolio_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.folio);
				            $('#txtFecha_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.fecha_format);
				            $('#txtMonedaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.moneda_id);
				            $('#txtMoneda_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.moneda);
				            $('#txtTipoCambio_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.tipo_cambio)
				           	$('#txtTipoReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.tipo_referencia);
				            $('#txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.referencia_id);
				             $('#txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.folio_factura);
						    $('#txtRfc_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.rfc);
						    $('#txtRegimenFiscalID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.regimen_fiscal_id);
						    $('#txtRegimenFiscalIDAnterior_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.regimenFiscalAnterior);
						    $('#txtRazonSocial_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.razon_social);
						    $('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.empleado_autorizacion);
                            $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.empleado);
                            $('#txtFormaPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.forma_pago_id);
                            $('#txtFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.forma_pago);
                            $('#txtMetodoPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.metodo_pago_id);
                            $('#txtMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.metodo_pago);
                            $('#txtUsoCfdiID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.uso_cfdi_id);
                            $('#txtUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.uso_cfdi);
                            $('#txtTipoRelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.tipo_relacion_id);
                            $('#txtTipoRelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.tipo_relacion);
                            $('#cmbExportacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.exportacion_id);
						    $('#txtObservaciones_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.observaciones);
							$('#txtPolizaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(intPolizaID);
						    $('#txtFolioPoliza_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.row.folio_poliza);
						    $('#txtEstatus_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(strEstatus);


							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_movimientos_entradas_refacciones_devolucion_factura_refacciones').addClass("estatus-"+strEstatus);
				          
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_movimientos_entradas_refacciones_devolucion_factura_refacciones").show();

				            //Si existe archivo del registro
				            if(data.archivo != '')
				           	{
				           		//Mostrar botón Descargar Archivo
				            	$("#btnDescargarArchivo_movimientos_entradas_refacciones_devolucion_factura_refacciones").show();
				           	}


				           	//Si se cumple la sentencia
				           	if(strEstatus == 'TIMBRAR' && intPolizaID == 0)
				            {

				            	//Hacer un llamado a la función para habilitar campos de timbrado
				            	habilitar_controles_timbrado_movimientos_entradas_refacciones_devolucion_factura_refacciones();
				            	//Deshabilitar las siguientes cajas de texto
				            	$('#txtFecha_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
				            	
				            	$('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');

				            }
				           	else if (strEstatus == 'TIMBRAR' && intPolizaID > 0)
				            {
				            	//Hacer un llamado a la función para habilitar campos de timbrado
				            	habilitar_controles_timbrado_movimientos_entradas_refacciones_devolucion_factura_refacciones();

				            }
				            else
				            {
				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	//Mostrar los siguientes botones
					            	$('#btnEnviarCorreo_movimientos_entradas_refacciones_devolucion_factura_refacciones').show();

					            	//Si existe el id de la póliza
					            	if(intPolizaID > 0)
					            	{
					            		$('#btnDesactivar_movimientos_entradas_refacciones_devolucion_factura_refacciones').show();
					            	}
					            }

					            //Deshabilitar todos los elementos del formulario
				            	$('#frmMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_movimientos_entradas_refacciones_devolucion_factura_refacciones").hide();
					            $("#btnBuscarCFDI_movimientos_entradas_refacciones_devolucion_factura_refacciones").hide();


					            //Si existe id de la cancelación del CFDI
								if(cancelacionID > 0)
								{	
									//Asignar el id de la cancelación
									$("#txtCancelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones").val(cancelacionID); 
									//Mostrar botón Motivo de cancelación
									$("#btnVerMotivoCancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones").show(); 
								}

				            }

							
				            //Hacer llamado a la función  para cargar los detalles del registro en el grid
				            lista_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones('Editar', strEstatus, intPolizaID);

				            //Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
							agregar_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones('Editar', strEstatus);	


							//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
								objMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = $('#MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesBox').bPopup({
															   appendTo: '#MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesContent', 
								                               contentContainer: 'MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesM', 
								                               zIndex: 2, 
								                               modalClose: false, 
								                               modal: true, 
								                               follow: [true,false], 
								                               followEasing : "linear", 
								                               easing: "linear", 
								                               modalColor: ('#F0F0F0')});
							}
							
							//Enfocar caja de texto
							$('#txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
							
			       	    }
			       },
			       'json');
		}


		//Función para habilitar controles del formulario correspondientes al timbrado
		function habilitar_controles_timbrado_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Deshabilitar todos los elementos del formulario
        	$('#frmMovimientosEntradasRefaccionesDevolucionFacturaRefacciones').find('input, textarea, select').attr('disabled','disabled');
        	//Habilitar las siguientes cajas de texto
        	$('#txtFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
        	$('#txtMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
        	$('#txtUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
        	$('#txtTipoRelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
        	$('#cmbExportacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
        	$('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
        	$('#txtObservaciones_movimientos_entradas_refacciones_devolucion_factura_refacciones').removeAttr('disabled');
		}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_movimientos_entradas_refacciones_devolucion_factura_refacciones(id, estatus, formulario)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_movimientos_entradas_refacciones_devolucion_factura_refacciones(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaPolizaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_movimientos_entradas_refacciones_devolucion_factura_refacciones(formulario);
			    //Si existe resultado
				if (data.resultado)
				{

					//Asignar el id de la póliza (generada) y evitar duplicidad de datos en caso de que no sea posible timbrar el registro
                    $('#txtPolizaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(data.poliza_id);
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
				      
				}

			    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_movimientos_entradas_refacciones_devolucion_factura_refacciones(data.tipo_mensaje, data.mensaje);

				
		     },
		     'json');

		}

		//Función para timbrar los datos de un registro
		function timbrar_movimientos_entradas_refacciones_devolucion_factura_refacciones(id, tipo, formulario, regimenFiscalID)
		{

			//Si existe id del régimen fiscal
			if(regimenFiscalID > 0)
			{
				//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
				mostrar_circulo_carga_movimientos_entradas_refacciones_devolucion_factura_refacciones(formulario);
				//Hacer un llamado al método del controlador para timbrar los datos del registro
				$.post('contabilidad/timbradoV4/set_timbrar',
				     {
				     	intReferenciaID: id,
				      	strTipoReferencia: strTipoReferenciaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones
				     },
				     function(data) {

					    //Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Si existe resultado (los datos se timbraron correctamente)
							if (data.resultado)
							{
								
								//Hacer un llamado a la función para cerrar modal
								cerrar_movimientos_entradas_refacciones_devolucion_factura_refacciones(); 
							}
							else
							{

								//Hacer un llamado a la función para limpiar los mensajes de error 
								limpiar_mensajes_movimientos_entradas_refacciones_devolucion_factura_refacciones();

								//Hacer un llamado a la función para cargar datos del registro (habilitar campos de timbrado)
								editar_movimientos_entradas_refacciones_devolucion_factura_refacciones(id,'Nuevo');

							}
						}


						//Hacer llamado a la función para cargar  los registros en el grid
						paginacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			            ocultar_circulo_carga_movimientos_entradas_refacciones_devolucion_factura_refacciones(formulario);
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_movimientos_entradas_refacciones_devolucion_factura_refacciones(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
			}
			else
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				 mensaje_movimientos_entradas_refacciones_devolucion_factura_refacciones('error_regimen_fiscal');
			}
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function mostrar_circulo_carga_movimientos_entradas_refacciones_devolucion_factura_refacciones(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_refacciones_devolucion_factura_refacciones';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_devolucion_factura_refacciones';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function ocultar_circulo_carga_movimientos_entradas_refacciones_devolucion_factura_refacciones(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_refacciones_devolucion_factura_refacciones';

			//Si el Div a ocultar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_devolucion_factura_refacciones';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}

		//Función para regresar obtener los datos de una factura de refacciones
		function get_datos_factura_refacciones_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los datos de la factura
              $.post('refacciones/facturas_refacciones/get_datos',
                  { 
                  	intFacturaRefaccionesID: $("#txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones").val(),
                  },
                  function(data) {
                    if(data.row){

                    	//Hacer llamado a la función  para mostrar los datos de la factura
                    	mostrar_datos_referencia_movimientos_entradas_refacciones_devolucion_factura_refacciones(data.row);
                    }
                }
                 ,
                'json');
		}

		//Función para regresar obtener los datos de una factura de servicio
		function get_datos_factura_servicio_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los datos de la factura
              $.post('servicio/facturas_servicio/get_datos',
                  { 
                  	intFacturaServicioID: $("#txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones").val(),
                  },
                  function(data) {
                    if(data.row){

             		    //Hacer llamado a la función  para mostrar los datos de la factura
             		    mostrar_datos_referencia_movimientos_entradas_refacciones_devolucion_factura_refacciones(data.row);
                    }
                }
                 ,
                'json');
		}

		//Función para regresar mostrar los datos de la factura (refacciones/servicio)
		function mostrar_datos_referencia_movimientos_entradas_refacciones_devolucion_factura_refacciones(objRow)
		{

			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones();
        	//Recuperar valores
 			$('#txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.folio);
 			$('#txtMonedaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.moneda_id);
 			$('#txtMoneda_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.moneda);
 			$('#txtTipoCambio_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.tipo_cambio);
 		    $('#txtRfc_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.rfc);
 		    $('#txtRegimenFiscalID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.regimen_fiscal_id);
 		    $("#txtRegimenFiscalIDAnterior_movimientos_entradas_refacciones_devolucion_factura_refacciones").val(objRow.regimenFiscalAnterior);
 		    $('#txtRazonSocial_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.razon_social);
 		    $('#txtFormaPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.forma_pago_id);
			$('#txtFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.forma_pago);
			$('#txtMetodoPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.metodo_pago_id);
			$('#txtMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.metodo_pago);
			$('#txtUsoCfdiID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.uso_cfdi_id);
			$('#txtUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRow.uso_cfdi);

			//Crear instancia del objeto CFDI´s relacionados (facturas seleccionadas)
			objCfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = new CfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones([]);

			//Crear instancia del objeto CFDI a relacionar
			objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = new CfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones(null, '', '', '', '', '', '');

			//Asignar datos al objeto
			objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.intReferenciaID = $('#txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
			objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strRazonSocial = objRow.razon_social;
			objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strFolio = objRow.folio;
			objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.dteFecha = objRow.fecha_format;
			objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strTipoReferencia =  $('#txtModuloReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
			objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strUuid =  objRow.uuid;
			objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.intImporte =  $('#txtImporteFactura_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
			
			//Agregar datos del cfdi a relacionar
            objCfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.setCfdi(objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones);
                					    
			//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
		  	agregar_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones('Nuevo', 'ACTIVO');	
 		  
 		    //Hacer llamado a la función  para cargar los detalles del registro en el grid
 		    lista_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones('Nuevo', '', '');
		}


		/*******************************************************************************************************************
		Funciones de la tabla CFDI relacionados
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones(tipoAccion, estatus)
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'TIMBRAR')
			{
				strAccionesTabla = "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones(this)'>" + 
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
							intReferenciaID: $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
							strTipoReferencia: strTipoReferenciaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones
						},
						function(data){

							//Mostramos los CFDI´s relacionados (facturas seleccionadas)
				           	for (var intCon in data.rows) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').getElementsByTagName('tbody')[0];

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
								if(data.rows[intCon].folio ==  $('#txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val())
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
							var intFilas = $("#dg_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones tr").length - 1;
							$('#numElementos_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(intFilas);
							$('#txtNumCfdiRelacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(intFilas);
						},
				'json');
			}
			else
			{
				//Mostramos los CFDI´s relacionados (facturas seleccionadas)
				for (var intCon in objCfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.getCfdis()) 
	            {
	            	//Crear instancia del objeto CFDI a relacionar 
	            	objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = new CfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones();
	            	//Asignar datos del CFDI corespondiente al indice
	            	objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = objCfdisRelacionadosMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.getCfdi(intCon);
	            	
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').getElementsByTagName('tbody')[0];

					//Variable que se utiliza para asignar el id del detalle
					var strDetalleID =  objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.intReferenciaID+'_'+objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strTipoReferencia;

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
						objCeldaCliente.innerHTML = objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strRazonSocial;
						objCeldaFolio.setAttribute('class', 'movil c2');
						objCeldaFolio.innerHTML = objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strFolio;
						objCeldaFecha.setAttribute('class', 'movil c3');
						objCeldaFecha.innerHTML = objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.dteFecha;
						objCeldaModulo.setAttribute('class', 'movil c4');
						objCeldaModulo.innerHTML = objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strTipoReferencia;
						objCeldaUuid.setAttribute('class', 'movil c5');
						objCeldaUuid.innerHTML =  objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.strUuid;
						objCeldaImporte.setAttribute('class', 'movil c6');
						objCeldaImporte.innerHTML = objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.intImporte;
						objCeldaAcciones.setAttribute('class', 'td-center movil c7');
						objCeldaAcciones.innerHTML = strAccionesTabla;
						objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
						objCeldaReferenciaID.innerHTML = objCfdiRelacionarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones.intReferenciaID;
					}
	            }

	            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
				var intFilas = $("#dg_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones tr").length - 1;
				$('#numElementos_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(intFilas);
				$('#txtNumCfdiRelacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(intFilas);
			}
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
			var intFilas = $("#dg_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones tr").length - 1;
			$('#numElementos_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(intFilas);
			$('#txtNumCfdiRelacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(intFilas);
		}
		

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
			$('#txtDescripcion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
			$('#txtPrecioUnitario_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
			$('#txtCantidadSalida_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
			$('#txtCantidadDevolucion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
		}

		//Función para la búsqueda de detalles del registro
		function lista_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones(tipoAccion, estatus, polizaID) 
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';
		    //Asignar el id de la póliza
			var intPolizaID = parseInt(polizaID); 

		    //Si se cumple la sentencia
			if(estatus == '' || (estatus == 'TIMBRAR' && intPolizaID == 0))
			{
				strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
								 	"	onclick='editar_renglon_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones(this)'>" + 
								 	"<span class='glyphicon glyphicon-edit'></span></button>";
			}


			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/movimientos_entradas_refacciones_devolucion_factura/get_datos_detalles',
			       {
			       		intMovimientoRefaccionesID: $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
			       		intReferenciaID: $('#txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(),
			       		strTipoReferencia: $('#txtTipoReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()
			       },
			       function(data) {

			       		//Variable que se utiliza para asignar el tipo de cambio
			            var intTipoCambio = parseFloat($('#txtTipoCambio_movimientos_entradas_refacciones_devolucion_factura_refacciones').val());

			            //Mostramos los detalles del registro
			            for (var intCon in data.detalles) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').getElementsByTagName('tbody')[0];

							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcion = objRenglon.insertCell(1);
							var objCeldaCantidad = objRenglon.insertCell(2);
							var objCeldaPrecioUnitario = objRenglon.insertCell(3);
							var objCeldaSubtotal = objRenglon.insertCell(4);
							var objCeldaAcciones = objRenglon.insertCell(5);
							//Columnas ocultas
							var objCeldaCantidadFactura = objRenglon.insertCell(6);
							var objCeldaCantidadDevolucion = objRenglon.insertCell(7);
							var objRefaccionID = objRenglon.insertCell(8);
							var objCeldaCodigoLinea = objRenglon.insertCell(9);
							var objCeldaCostoUnitarioBD = objRenglon.insertCell(10);
							var objCeldaPrecioUnitarioBD = objRenglon.insertCell(11);


							//Variables que se utilizan para asignar valores del detalle
							var intSubtotal = parseFloat(data.detalles[intCon].precio_unitario);
							var intCantidadEntrada =  parseFloat(data.detalles[intCon].cantidad_entrada);
							var intCantidadSalida =  parseFloat(data.detalles[intCon].cantidad_salida);
							var intPrecioUnitario = parseFloat(data.detalles[intCon].precio_unitario);
							var intCantidad = 0;
							
							//Variable que se utiliza para asignar la cantidad que ha sido devuelta
							var intCantidadDevolucion = parseFloat(data.detalles[intCon].cantidad_devolucion);

							//Si el tipo de acción corresponde a Editar
							if(tipoAccion == 'Editar')
							{
								//Asignar valores del detalle correspondiente a la entrada
								intCantidad = intCantidadEntrada;

								//Calcular cantidad devuelta
								intCantidadDevolucion -=  intCantidad;
							}
							else
							{
								//Cambiar la cantidad de salida
								intCantidad = intCantidadSalida;
							}
							

							//Convertir peso mexicano a tipo de cambio
							intSubtotal = intSubtotal / intTipoCambio;
							intPrecioUnitario = intPrecioUnitario / intTipoCambio;

							//Si el tipo de acción corresponde a Nuevo
							if(tipoAccion == 'Nuevo')
							{
								//Inicializar valores para evitar mostrar los datos de la salida
								intSubtotal = 0;
							}
							else
							{
								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;
							}

							//Cambiar cantidad a  formato moneda (a visualizar)
						    intCantidadEntrada =  formatMoney(intCantidadEntrada, 2, '');

						    var intPrecioUnitarioMostrar =  formatMoney(intPrecioUnitario, intNumDecimalesMostrarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones, '');

						    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones, '');

						    //Cambiar cantidad a  formato moneda (a guardar en la  BD)
							var intPrecioUnitarioBD =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDMovimientosEntradasRefaccionesDevolucionFacturaRefacciones, '');

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].renglon);
							objCeldaCodigo.setAttribute('class', 'movil d1');
							objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
							objCeldaDescripcion.setAttribute('class', 'movil d2');
							objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
							objCeldaCantidad.setAttribute('class', 'movil d3');
							objCeldaCantidad.innerHTML = intCantidadEntrada;
							objCeldaPrecioUnitario.setAttribute('class', 'movil d4');
							objCeldaPrecioUnitario.innerHTML = intPrecioUnitarioMostrar;
							objCeldaSubtotal.setAttribute('class', 'movil d5');
							objCeldaSubtotal.innerHTML = intSubtotalMostrar;
							objCeldaAcciones.setAttribute('class', 'td-center movil d6');
							objCeldaAcciones.innerHTML = strAccionesTabla;
							objCeldaCantidadFactura.setAttribute('class', 'no-mostrar');
							objCeldaCantidadFactura.innerHTML = intCantidadSalida; 
							objCeldaCantidadDevolucion.setAttribute('class', 'no-mostrar');
							objCeldaCantidadDevolucion.innerHTML = intCantidadDevolucion; 
							objRefaccionID.setAttribute('class', 'no-mostrar');
							objRefaccionID.innerHTML = data.detalles[intCon].refaccion_id; 
							objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
							objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea; 
							objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
							objCeldaCostoUnitarioBD.innerHTML =  data.detalles[intCon].costo_unitario;
							objCeldaPrecioUnitarioBD.setAttribute('class', 'no-mostrar');
							objCeldaPrecioUnitarioBD.innerHTML =  intPrecioUnitarioBD;

							
			            }

			            //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones tr").length - 2;
						$('#numElementos_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(intFilas);
			       },
			       'json');

		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Variable que se utiliza para asignar el subtotal (costo unitario en la tabla movimientos_refacciones_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asignar la cantidad a devolver
			var intCantidadDevolver = 0;
			//Variable que se utiliza para asignar el mensaje informativo
			var strMensaje = '';

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
			var intCantidad = $('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
			var intCantidadSalida = $('#txtCantidadSalida_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();
			var intCantidadDevolucion = $('#txtCantidadDevolucion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val();		
			
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').getElementsByTagName('tbody')[0];

			//Si existe ID del renglón
			if (intRenglon != '' )
			{
				//Validamos que se capturaron datos
				if (intCantidad == '')
				{
					//Enfocar caja de texto
					$('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
				}
				else
				{
					//Convertir cadena de texto a número decimal
					intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
					intSubtotal =  parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
					intCantidadSalida = parseFloat(intCantidadSalida);
					intCantidadDevolucion = parseFloat(intCantidadDevolucion);

					//Calcular la cantidad a devolver
					intCantidadDevolver = intCantidad + intCantidadDevolucion;


					//Verificar que la cantidad sea menor o igual que la salida
					if(intCantidadDevolver <= intCantidadSalida)
					{
						//Hacer un llamado a la función para inicializar elementos de la refacción
						inicializar_refaccion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones();
					
						//Calcular subtotal
						intSubtotal = intCantidad * intSubtotal;

						//Cambiar cantidad a  formato moneda (a visualizar)
						intCantidad =  formatMoney(intCantidad, 2, '');
						var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones, '');

						//Editar los datos del detalle
					    objTabla.rows.namedItem(intRenglon).cells[2].innerHTML = intCantidad;
					    objTabla.rows.namedItem(intRenglon).cells[4].innerHTML =  intSubtotalMostrar;
					    //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones();

						//Enfocar caja de texto
						$('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
					}
					else
					{
						
						//Calcular la cantidad a devolver
				    	intCantidad = intCantidadSalida - intCantidadDevolucion;

				    	//Si la cantidad de salida es igual a la cantidad devuelta
						if(intCantidadSalida == intCantidadDevolucion)
						{
							//Mensaje que se utiliza para informar al usuario que la refacción ha sido devuelta
							strMensaje = 'La refacción ha sido devuelta.';
						}
						else
						{
							/*Mensaje que se utiliza para informar al usuario que la cantidad a 
							  devolver no debe ser mayor que la cantidad que no ha sido devuelta*/
							strMensaje = 'La cantidad a devolver es mayor que la cantidad que no ha sido devuelta.';
						}

				    	//Cambiar cantidad a formato moneda
			    		intCantidad = formatMoney(intCantidad, 2, '');

				    	//Asignar cantidad a devolver
						$('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(intCantidad);

						//Hacer un llamado a la función para mostrar mensaje de información
					    mensaje_movimientos_entradas_refacciones_devolucion_factura_refacciones('informacion', strMensaje);
					}
					
				}


				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones tr").length - 2;
				$('#numElementos_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(intFilas);
		    }
		    else
		    {
		    	//Limpiar caja de texto
		    	$('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
		    }
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPrecioUnitario_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtCantidadSalida_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRenglon.parentNode.parentNode.cells[6].innerHTML);
			$('#txtCantidadDevolucion_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(objRenglon.parentNode.parentNode.cells[7].innerHTML);

			//Enfocar caja de texto
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
		}


		//Función para calcular totales de la tabla
		function calcular_totales_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumSubtotal = 0;
			//Variable que se utiliza para contar el número de refacciones con devolución
		    var intContadorDetalles = 0;
		    //Variable que se utiliza para asignar la cantidad de la refacción
		    var intCantidad = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				//Convertir cadena de texto a número decimal
				intCantidad = parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				//Incrementar acumulados
				intAcumUnidades += intCantidad;
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				
				//Si existe cantidad de la refacción
				if(intCantidad > 0)
				{
					//Incrementar contador por cada detalle
					intContadorDetalles++;
				}

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesDevolucionFacturaRefacciones, '');

			//Asignar los valores
			$('#acumCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(intAcumUnidades);
			$('#acumSubtotal_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').html(intAcumSubtotal);
			$('#txtNumDetalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(intContadorDetalles);
		}

		


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Entradas por devolución del cliente
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').numeric();

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_entradas_refacciones_devolucion_factura_refacciones').blur(function(){
                $('.cantidad_movimientos_entradas_refacciones_devolucion_factura_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
            });

            //Agregar datepicker para seleccionar fecha
			$('#dteFecha_movimientos_entradas_refacciones_devolucion_factura_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

			
	        //Autocomplete para recuperar los datos de una factura de refacciones o  de servicios
	        $('#txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la factura de refacciones
	               inicializar_factura_movimientos_entradas_refacciones_devolucion_factura_refacciones();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/movimientos_entradas_refacciones_devolucion_factura/autocomplete",
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

		           	 //Si existe id del regimen fiscal
		             if(ui.item.regimen_fiscal_id > 0)
		             {
		                //Asignar datos del registro seleccionado
		                $('#txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.data);
		                $('#txtTipoReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.tipo_referencia);
		                $('#txtImporteFactura_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.importe);
		                $('#txtModuloReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.modulo);

		                //Dependiendo del tipo de refencia mostrar datos de la factura
		                if(ui.item.tipo_referencia == 'REFACCIONES')
		                {
		              	 	//Hacer un llamado a la función para regresar los datos de la factura de refacciones
		              		get_datos_factura_refacciones_movimientos_entradas_refacciones_devolucion_factura_refacciones();
		                } 
		                else
		                {
		              		//Hacer un llamado a la función para regresar los datos de la factura de servicio
		              		get_datos_factura_servicio_movimientos_entradas_refacciones_devolucion_factura_refacciones();
		                }
		             }
		             else
		             {
		             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					     mensaje_movimientos_entradas_refacciones_devolucion_factura_refacciones('error_regimen_fiscal','','txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones');
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
	        $('#txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').focusout(function(e){
	            //Si no existe id de la factura
	            if($('#txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '' ||
	               $('#txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtReferenciaID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	               $('#txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
            	   $('#txtTipoReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una forma de pago
	        $('#txtFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtFormaPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
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
	             $('#txtFormaPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.data);
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
	        $('#txtFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').focusout(function(e){
	            //Si no existe id de la forma de pago
	            if($('#txtFormaPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '' ||
	               $('#txtFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtFormaPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	               $('#txtFormaPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	            }
	            
	        });
	        
	        //Autocomplete para recuperar los datos de un método de pago
	        $('#txtMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMetodoPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
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
	             $('#txtMetodoPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.data);
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
	        $('#txtMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').focusout(function(e){
	            //Si no existe id del método de pago
	            if($('#txtMetodoPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '' ||
	               $('#txtMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMetodoPagoID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	               $('#txtMetodoPago_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un uso del CFDI
	        $('#txtUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsoCfdiID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
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
	             $('#txtUsoCfdiID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.data);
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
	        $('#txtUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').focusout(function(e){
	            //Si no existe id del uso de CFDI
	            if($('#txtUsoCfdiID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '' ||
	               $('#txtUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUsoCfdiID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	               $('#txtUsoCfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un tipo de relación
	        $('#txtTipoRelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTipoRelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
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
	             $('#txtTipoRelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.data);
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
	        $('#txtTipoRelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtTipoRelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '' ||
	               $('#txtTipoRelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTipoRelacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	               $('#txtTipoRelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un empleado
            $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').autocomplete({
                source: function( request, response ) {
                   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
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
                 //Asignar valores del registro seleccionado
                 $('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.data);

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
            $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').focusout(function(e){
                //Si no existe id del empleado
                if($('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '' ||
                   $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
                   $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
                }

            });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar botón Agregar
			   	    	$('#btnAgregar_detalles_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
			   	    }
		        }
		    });

		    //Función para mover renglones arriba y abajo en la tabla
			$('#dg_cfdi_relacionados_movimientos_entradas_refacciones_devolucion_factura_refacciones').on('click','button.btn',function(){
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
			$('#dteFechaInicialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
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
	             $('#txtProspectoIDBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '' ||
	            	$('#txtRazonSocialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	               $('#txtRazonSocialBusq_relacionar_cfdi_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	            }
	            
	        });


	          /*******************************************************************************************************************
			Controles correspondientes al modal Cancelación del timbrado
			**************************************	*******************************************************************************/
			 //Autocomplete para recuperar los datos de una sustitución (factura, pago, etc.)
	        $('#txtFolioSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSustitucionID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/movimientos_entradas_refacciones_devolucion_factura/autocomplete_cancelacion",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intReferenciaID: $('#txtReferenciaCfdiID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtSustitucionID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.data);
	             $('#txtUuidSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.uuid);
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
	        $('#txtFolioSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtSustitucionID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '' ||
	               $('#txtFolioSustitucion_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
	            { 
	               //Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
	            }
	            
	        });

	        //Verificar motivo de cancelación cuando cambie la opción del combobox
	        $('#cmbCancelacionMotivoID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').change(function(e){   
	            //Si el motivo de cancelación no corresponde a 01 - Comprobante emitido con errores con relación.
              	if(parseInt($('#cmbCancelacionMotivoID_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones').val()) !== intCancelacionIDRelacionCfdiMovimientosEntradasRefaccionesDevolucionFacturaRefacciones)
             	{
             		//Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
					
             	}
	        });

			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').data('DateTimePicker').maxDate(e.date);
			});
			
			//Autocomplete para recuperar los datos de un cliente
	        $('#txtRazonSocialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
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
	             $('#txtProspectoIDBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '' ||
	               $('#txtRazonSocialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	               $('#txtRazonSocialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').val('');
	            }

	        });

	        //Paginación de registros
			$('#pagLinks_movimientos_entradas_refacciones_devolucion_factura_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_movimientos_entradas_refacciones_devolucion_factura_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_entradas_refacciones_devolucion_factura_refacciones();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_movimientos_entradas_refacciones_devolucion_factura_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				objMovimientosEntradasRefaccionesDevolucionFacturaRefacciones = $('#MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesBox').bPopup({
											   appendTo: '#MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesContent', 
				                               contentContainer: 'MovimientosEntradasRefaccionesDevolucionFacturaRefaccionesM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#txtReferencia_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_movimientos_entradas_refacciones_devolucion_factura_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_movimientos_entradas_refacciones_devolucion_factura_refacciones();
			//Hacer un llamado a la función para cargar los motivos de cancelación en el combobox del modal
            cargar_motivos_cancelacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
            //Hacer un llamado a la función para cargar exportación en el combobox del modal
        	cargar_exportacion_movimientos_entradas_refacciones_devolucion_factura_refacciones();
		});
	</script>