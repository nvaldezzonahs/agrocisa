<div id="NotasCreditoServicioServicioContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_notas_credito_servicio_servicio" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_notas_credito_servicio_servicio">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_notas_credito_servicio_servicio'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_notas_credito_servicio_servicio"
			                    		name= "strFechaInicialBusq_notas_credito_servicio_servicio" 
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
							<label for="txtFechaFinalBusq_notas_credito_servicio_servicio">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_notas_credito_servicio_servicio'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_notas_credito_servicio_servicio"
			                    		name= "strFechaFinalBusq_notas_credito_servicio_servicio" 
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
				<!--Autocomplete que contiene los clientes activos-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
							<input id="txtProspectoIDBusq_notas_credito_servicio_servicio" 
								   name="intProspectoIDBusq_notas_credito_servicio_servicio"  type="hidden" 
								   value="">
							</input>
							<label for="txtRazonSocialBusq_notas_credito_servicio_servicio">Razón social</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtRazonSocialBusq_notas_credito_servicio_servicio" 
									name="strRazonSocialBusq_notas_credito_servicio_servicio" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese razón social" 
									maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Estatus-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbEstatusBusq_notas_credito_servicio_servicio">Estatus</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbEstatusBusq_notas_credito_servicio_servicio" 
							 		name="strEstatusBusq_notas_credito_servicio_servicio" tabindex="1">
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
							<label for="txtBusqueda_notas_credito_servicio_servicio">Descripción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtBusqueda_notas_credito_servicio_servicio" 
									name="strBusqueda_notas_credito_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Mostrar detalles de los registros en el reporte PDF--> 
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" 
                        			id="chbImprimirDetalles_notas_credito_servicio_servicio" 
								   	name="strImprimirDetalles_notas_credito_servicio_servicio" 
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
						<button class="btn btn-primary" id="btnBuscar_notas_credito_servicio_servicio"
								onclick="paginacion_notas_credito_servicio_servicio();" 
								title="Buscar coincidencias" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_notas_credito_servicio_servicio" 
								title="Nuevo registro" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_notas_credito_servicio_servicio"
								onclick="reporte_notas_credito_servicio_servicio('PDF');" title="Generar reporte PDF" tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_notas_credito_servicio_servicio"
								onclick="reporte_notas_credito_servicio_servicio('XLS');" title="Descargar archivo XLS" tabindex="1" disabled>
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
			Definir columnas de la tabla notas de crédito
			*/
			td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
			td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
			td.movil.a3:nth-of-type(3):before {content: "Razón social"; font-weight: bold;}
			td.movil.a4:nth-of-type(4):before {content: "RFC"; font-weight: bold;}
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
				Definir columnas de la tabla detalles de la nota de crédito
				*/
				td.movil.d1:nth-of-type(1):before {content: "Descripción"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Precio"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Desc."; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Subtotal"; font-weight: bold;}
				td.movil.d5:nth-of-type(5):before {content: "IVA"; font-weight: bold;}
				td.movil.d6:nth-of-type(6):before {content: "IEPS"; font-weight: bold;}
				td.movil.d7:nth-of-type(7):before {content: "Total"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la nota de crédito
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Desc."; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: "Subtotal"; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "IVA"; font-weight: bold;}
				td.movil.t6:nth-of-type(6):before {content: "IEPS"; font-weight: bold;}
				td.movil.t7:nth-of-type(7):before {content: "Total"; font-weight: bold;}

		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_notas_credito_servicio_servicio">
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
				<script id="plantilla_notas_credito_servicio_servicio" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{folio_factura}}</td>
						<td class="movil">{{razon_social}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_notas_credito_servicio_servicio({{nota_credito_servicio_id}}, 'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_notas_credito_servicio_servicio({{nota_credito_servicio_id}}, 'Ver', {{cancelacion_id}})"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Ver motivo de cancelación-->
							<button class="btn btn-default btn-xs {{mostrarAccionMotivoCancelacion}}"  
									onclick="ver_cancelacion_notas_credito_servicio_servicio({{cancelacion_id}})"  title="Ver motivo de cancelación">
									<i class="fa fa-info-circle" aria-hidden="true"></i>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
									onclick="abrir_cliente_notas_credito_servicio_servicio({{nota_credito_servicio_id}})"  title="Enviar correo electrónico">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_notas_credito_servicio_servicio({{nota_credito_servicio_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Generar póliza-->
							<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
									onclick="generar_poliza_notas_credito_servicio_servicio({{nota_credito_servicio_id}}, '{{estatus}}', 'principal')"  title="Generar póliza">
								<span class="glyphicon glyphicon-tags"></span>
							</button>
							<!--Timbrar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionTimbrar}}"  
									onclick="timbrar_notas_credito_servicio_servicio({{nota_credito_servicio_id}},'', 'principal',  {{regimen_fiscal_id}})"  title="Timbrar">
								<span class="fa fa-certificate"></span>
							</button>
							<!--Descargar archivos-->
                        	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                        			 onmousedown="descargar_archivos_notas_credito_servicio_servicio({{nota_credito_servicio_id}}, '{{folio}}');" title="Descargar archivos">
                        		<span class="glyphicon glyphicon-download-alt"></span>
                        	</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_notas_credito_servicio_servicio({{nota_credito_servicio_id}}, '{{folio}}', {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_notas_credito_servicio_servicio"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_notas_credito_servicio_servicio">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!--Circulo de progreso-->
	<div id="divCirculoBarProgresoPrincipal_notas_credito_servicio_servicio" class="load-container load5 circulo_bar no-mostrar">
		<div class="loader">Loading...</div>
		<br><br>
		<div align=center><b>Espere un momento por favor.</b></div>
	</div>

	<!-- Diseño del modal Enviar Correo Electrónico-->
	<div id="EnviarNotasCreditoServicioServicioBox" class="ModalBody  impresion-formato-modal-empleados">
		<!--Título-->
		<div id="divEncabezadoModal_cliente_notas_credito_servicio_servicio" class="ModalBodyTitle confirmacion-modal-title"">
		<h1>Enviar Correo Electrónico</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmEnviarNotasCreditoServicioServicio" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmEnviarNotasCreditoServicioServicio"  onsubmit="return(false)" autocomplete="off">
		 		<div class="row">
		 			<!--Razón social-->
		 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtNotaCreditoServicioID_cliente_notas_credito_servicio_servicio" 
									   name="intNotaCreditoServicioID_cliente_notas_credito_servicio_servicio" 
									   type="hidden" value="">
								</input>
								<!-- Caja de texto oculta que se utiliza para recuperar el folio del registro seleccionado-->
								<input id="txtFolio_cliente_notas_credito_servicio_servicio" 
									   name="strFolio_cliente_notas_credito_servicio_servicio" 
									   type="hidden" value="">
								</input>
								<label for="txtRazonSocial_cliente_notas_credito_servicio_servicio">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocial_cliente_notas_credito_servicio_servicio" 
										name="strRazonSocial_cliente_notas_credito_servicio_servicio" type="text" value="" 
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
								<label for="txtCorreoElectronico_cliente_notas_credito_servicio_servicio">Correo electrónico</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtCorreoElectronico_cliente_notas_credito_servicio_servicio" 
										name="strCorreoElectronico_cliente_notas_credito_servicio_servicio" type="text" value="" 
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
								<label for="txtCopiaCorreoElectronico_cliente_notas_credito_servicio_servicio">Copia</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_notas_credito_servicio_servicio" 
										name="strCopiaCorreoElectronico_cliente_notas_credito_servicio_servicio" type="text" value="" 
										tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
								</input>
							</div>
						</div>
					</div>
		 		</div>
		 		<!--Circulo de progreso-->
				<div id="divCirculoBarProgreso_cliente_notas_credito_servicio_servicio" class="load-container load5 circulo_bar no-mostrar">
					<div class="loader">Loading...</div>
					<br><br>
					<div align=center><b>Espere un momento por favor.</b></div>
				</div> 
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Enviar correo electrónico-->
						<button class="btn btn-success" id="btnEnviarCorreo_cliente_notas_credito_servicio_servicio"  
								onclick="validar_cliente_notas_credito_servicio_servicio();"  title="Enviar correo electrónico" tabindex="1">
							<span class="glyphicon glyphicon-envelope"></span>
						</button>  
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_cliente_notas_credito_servicio_servicio"
								type="reset" aria-hidden="true" onclick="cerrar_cliente_notas_credito_servicio_servicio();" 
								title="Cerrar"  tabindex="1">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal Enviar Correo Electrónico-->

	<!-- Diseño del modal Relacionar CFDI-->
	<div id="RelacionarCfdiNotasCreditoServicioServicioBox" class="ModalBody">
		<!--Título-->
		<div id="divEncabezadoModal_relacionar_cfdi_notas_credito_servicio_servicio" class="ModalBodyTitle">
			<h1>Relacionar CFDI</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmRelacionarCfdiNotasCreditoServicioServicio" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmRelacionarCfdiNotasCreditoServicioServicio"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_relacionar_cfdi_notas_credito_servicio_servicio">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_relacionar_cfdi_notas_credito_servicio_servicio'>
				                    <input class="form-control" id="txtFechaInicialBusq_relacionar_cfdi_notas_credito_servicio_servicio"
				                    		name= "strFechaInicialBusq_relacionar_cfdi_notas_credito_servicio_servicio" 
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
								<label for="txtFechaFinalBusq_relacionar_cfdi_notas_credito_servicio_servicio">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_relacionar_cfdi_notas_credito_servicio_servicio'>
				                    <input class="form-control" id="txtFechaFinalBusq_relacionar_cfdi_notas_credito_servicio_servicio"
				                    		name= "strFechaFinalBusq_relacionar_cfdi_notas_credito_servicio_servicio" 
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
								<input id="txtProspectoIDBusq_relacionar_cfdi_notas_credito_servicio_servicio" 
									   name="intProspectoIDBusq_relacionar_cfdi_notas_credito_servicio_servicio"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocialBusq_relacionar_cfdi_notas_credito_servicio_servicio">Razón social</label>
							</div>
							<div class="col-md-12">
								<div class="input-group">
									<input class="form-control" id="txtRazonSocialBusq_relacionar_cfdi_notas_credito_servicio_servicio" 
										   name="strRazonSocialBusq_relacionar_cfdi_notas_credito_servicio_servicio"  type="text" value="" 
										   tabindex="1" placeholder="Ingrese razón social" maxlength="250" >
									</input>
									<span class="input-group-btn">
										<button class="btn btn-primary" id="btnBuscar_relacionar_cfdi_notas_credito_servicio_servicio"
												onclick="lista_facturas_relacionar_cfdi_notas_credito_servicio_servicio();" title="Buscar coincidencias" tabindex="1">
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
						<input id="txtNumCfdi_relacionar_cfdi_notas_credito_servicio_servicio" 
							   name="intNumCfdi_relacionar_cfdi_notas_credito_servicio_servicio" type="hidden" value="">
						</input>
						<!-- Diseño de la tabla-->
						<table class="table-hover movil" id="dg_relacionar_cfdi_notas_credito_servicio_servicio">
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
							<script id="plantilla_relacionar_cfdi_notas_credito_servicio_servicio" type="text/template"> 
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
						    		id="chbAgregar_relacionar_cfdi_notas_credito_servicio_servicio" />
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
									<strong id="numElementos_relacionar_cfdi_notas_credito_servicio_servicio">0</strong> encontrados
								</button>
							</div>
						</div>
					</div>
				</div>			  
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Agregar CFDI´s-->
						<button class="btn btn-success" id="btnAgregar_relacionar_cfdi_notas_credito_servicio_servicio"  
								onclick="validar_relacionar_cfdi_notas_credito_servicio_servicio();"  title="Agregar" tabindex="1">
							<span class="glyphicon glyphicon-plus"></span>
						</button>  
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_cfdi_notas_credito_servicio_servicio"
								type="reset" aria-hidden="true" onclick="cerrar_relacionar_cfdi_notas_credito_servicio_servicio();" 
								title="Cerrar" tabindex="1">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal Relacionar CFDI-->

		<!-- Diseño del modal Cancelación del timbrado-->
		<div id="CancelacionNotasCreditoServicioServicioBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cancelacion_notas_credito_servicio_servicio" class="ModalBodyTitle confirmacion-modal-title">
			<h1>Cancelación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCancelacionNotasCreditoServicioServicio" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmCancelacionNotasCreditoServicioServicio"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Combobox que contiene los motivos de cancelación activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCancelacionMotivoID_cancelacion_notas_credito_servicio_servicio">Motivo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbCancelacionMotivoID_cancelacion_notas_credito_servicio_servicio" 
									 		name="intCancelacionMotivoID_notas_credito_servicio_servicio" 
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
									<input id="txtReferenciaCfdiID_cancelacion_notas_credito_servicio_servicio" 
										   name="intReferenciaCfdiID_cancelacion_notas_credito_servicio_servicio" 
										   type="hidden" value="" />	

									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_cancelacion_notas_credito_servicio_servicio" 
										   name="intPolizaID_cancelacion_notas_credito_servicio_servicio" type="hidden" value="" />

									<label for="txtFolio_cancelacion_notas_credito_servicio_servicio">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_cancelacion_notas_credito_servicio_servicio" 
											name="strFolio_cancelacion_notas_credito_servicio_servicio" type="text" value="" 
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
									<input id="txtSustitucionID_cancelacion_notas_credito_servicio_servicio" 
										   name="intSustitucionID_cancelacion_notas_credito_servicio_servicio" 
										   type="hidden" value="" />	
									<!-- Caja de texto oculta que se utiliza para recuperar el UUID de la factura que sustituye-->
									<input id="txtUuidSustitucion_cancelacion_notas_credito_servicio_servicio" 
										   name="strUuidSustitucion_cancelacion_notas_credito_servicio_servicio" 
										   type="hidden" value="" />	   
									<label for="txtFolioSustitucion_cancelacion_notas_credito_servicio_servicio">Sustitución</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolioSustitucion_cancelacion_notas_credito_servicio_servicio" 
											name="strFolioSustitucion_cancelacion_notas_credito_servicio_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese anticipos" maxlength="250" >
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Div que contiene los campos del usuario y fecha del registro -->
			 		<div  id="divDatosCreacion_cancelacion_notas_credito_servicio_servicio" class="row no-mostrar">
			 			<!--Usuario que realizó la cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuarioCreacion_cancelacion_notas_credito_servicio_servicio">Usuario de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuarioCreacion_cancelacion_notas_credito_servicio_servicio" 
											name="strUsuarioCreacion_cancelacion_notas_credito_servicio_servicio" type="text" value="" 
											 disabled >
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaCreacion_cancelacion_notas_credito_servicio_servicio">Fecha de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFechaCreacion_cancelacion_notas_credito_servicio_servicio" 
											name="strFechaCreacion_cancelacion_notas_credito_servicio_servicio" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cancelacion_notas_credito_servicio_servicio" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 						
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar cancelación del CFDI-->
							<button class="btn btn-success" id="btnGuardar_cancelacion_notas_credito_servicio_servicio"  
									onclick="validar_cancelacion_notas_credito_servicio_servicio();"  title="Cancelar CFDI" tabindex="1">
								<span class="fa fa-chain-broken"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cancelacion_notas_credito_servicio_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_cancelacion_notas_credito_servicio_servicio();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cancelación del timbrado-->


	<!-- Diseño del modal-->
	<div id="NotasCreditoServicioServicioBox" class="ModalBody"  tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_notas_credito_servicio_servicio"  class="ModalBodyTitle">
			<h1>Notas de Crédito</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Tabs-->
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<ul class="nav nav-tabs  nav-justified" id="tabs_notas_credito_servicio_servicio" role="tablist">
							<!--Tab que contiene la información general-->
							<li id="tabInformacionGeneral_notas_credito_servicio_servicio" class="active">
								<a data-toggle="tab" href="#informacion_general_notas_credito_servicio_servicio">Información General</a>
							</li>
							<!--Tab que contiene la información de los CFDI relacionados-->
							<li id="tabCfdiRelacionados_notas_credito_servicio_servicio">
								<a data-toggle="tab" href="#cfdi_relacionados_notas_credito_servicio_servicio">CFDI Relacionados</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!--Diseño del formulario-->
			<form id="frmNotasCreditoServicioServicio" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmNotasCreditoServicioServicio"  onsubmit="return(false)" autocomplete="off">
			   <!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
				<div class="tab-content">
					<!--Tab - Información General-->
					<div id="informacion_general_notas_credito_servicio_servicio" class="tab-pane fade in active">
						<div class="row">
							<!-- Folio -->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
										<input id="txtNotaCreditoServicioID_notas_credito_servicio_servicio" 
											   name="intNotaCreditoServicioID_notas_credito_servicio_servicio" 
											   type="hidden" 
											   value="" />
										 <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
										<input id="txtPolizaID_notas_credito_servicio_servicio" 
											   name="intPolizaID_notas_credito_servicio_servicio" type="hidden" value="" />
										 <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
										<input id="txtFolioPoliza_notas_credito_servicio_servicio" 
											   name="strFolioPoliza_notas_credito_servicio_servicio" type="hidden" value="" />
									    <!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
										<input id="txtEstatus_notas_credito_servicio_servicio" 
											   name="strEstatus_notas_credito_servicio_servicio" type="hidden" value="">
										</input>
										<!-- Caja de texto oculta que se utiliza para recuperar el id de la cancelación del registro seleccionado-->
										<input id="txtCancelacionID_notas_credito_servicio_servicio" 
												   name="intCancelacionID_notas_credito_servicio_servicio" type="hidden" value="" />
										<label for="txtFolio_notas_credito_servicio_servicio">Folio</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" 
										        id="txtFolio_notas_credito_servicio_servicio" 
												name="strFolio_notas_credito_servicio_servicio" 
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
										<label for="txtFecha_notas_credito_servicio_servicio">Fecha</label>
									</div>
									<div id="divFechaMsjValidacion" class="col-md-12">
										<div class='input-group date' id='dteFecha_notas_credito_servicio_servicio'>
						                    <input class="form-control" 
						                    		id="txtFecha_notas_credito_servicio_servicio"
						                    		name= "strFecha_notas_credito_servicio_servicio" 
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
										<input id="txtMonedaID_notas_credito_servicio_servicio" 
											   name="intMonedaID_notas_credito_servicio_servicio"  
											   type="hidden"  value="" />
										<label for="txtMoneda_notas_credito_servicio_servicio">Moneda</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtMoneda_notas_credito_servicio_servicio" 
												name="strMoneda_notas_credito_servicio_servicio" 
												type="text" value="" disabled />
									</div>
								</div>
							</div>
							<!--Tipo de cambio-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtTipoCambio_notas_credito_servicio_servicio">Tipo de cambio</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtTipoCambio_notas_credito_servicio_servicio" 
												name="intTipoCambio_notas_credito_servicio_servicio" 
												type="text" value="" disabled/>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<!--Autocomplete que contiene las facturas de refacciones y servicios activas (timbradas)-->
							<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id de la factura seleccionada-->
										<input id="txtFacturaServicioID_notas_credito_servicio_servicio" 
											   name="intFacturaServicioID_notas_credito_servicio_servicio"  
											   type="hidden"  value="">
									    </input>
									    <!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de reparación -->
										<input id="txtOrdenReparacionID_notas_credito_servicio_servicio" 
											   name="intOrdenReparacionID_notas_credito_servicio_servicio"  
											   type="hidden"  value="">
										</input>
										<!-- Caja de texto oculta para recuperar el id del cliente-->
										<input id="txtProspectoID_notas_credito_servicio_servicio" 
											   name="intProspectoID_notas_credito_servicio_servicio" 
											   type="hidden" value=""> 
										</input>
										 <!-- Caja de texto oculta para recuperar el id del régimen fiscal del cliente seleccionado-->
										<input id="txtRegimenFiscalID_notas_credito_servicio_servicio" 
											   name="intRegimenFiscalID_notas_credito_servicio_servicio" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta para recuperar el id del régimen fiscal anterior (validar si es necesario modificar el régimen fiscal del registro  usado como referencia)-->
										<input id="txtRegimenFiscalIDAnterior_notas_credito_servicio_servicio" 
											   name="intRegimenFiscalIDAnterior_notas_credito_servicio_servicio" 
											   type="hidden" value="">
										</input>		
										<!-- Caja de texto oculta para recuperar la calle del cliente-->
										<input id="txtCalle_notas_credito_servicio_servicio" 
											   name="strCalle_notas_credito_servicio_servicio" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta para recuperar el número exterior del cliente-->
										<input id="txtNumeroExterior_notas_credito_servicio_servicio" 
											   name="strNumeroExterior_notas_credito_servicio_servicio" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta para recuperar el número interior del cliente -->
										<input id="txtNumeroInterior_notas_credito_servicio_servicio" 
											   name="strNumeroInterior_notas_credito_servicio_servicio" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta para recuperar el código postal del cliente -->
										<input id="txtCodigoPostal_notas_credito_servicio_servicio" 
											   name="strCodigoPostal_notas_credito_servicio_servicio" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta para recuperar la colonia del cliente -->
										<input id="txtColonia_notas_credito_servicio_servicio" 
											   name="strColonia_notas_credito_servicio_servicio" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta para recuperar la localidad del cliente -->
										<input id="txtLocalidad_notas_credito_servicio_servicio" 
											   name="strLocalidad_notas_credito_servicio_servicio" 
											   type="hidden" value="">
									    </input>
										<!-- Caja de texto oculta para recuperar el municipio del cliente -->
										<input id="txtMunicipio_notas_credito_servicio_servicio" 
											   name="strMunicipio_notas_credito_servicio_servicio" 
											   type="hidden" value="">
									    </input>
										<!-- Caja de texto oculta para recuperar el estado del cliente -->
										<input id="txtEstado_notas_credito_servicio_servicio" 
											   name="strEstado_notas_credito_servicio_servicio" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta para recuperar el país del cliente-->
										<input id="txtPais_notas_credito_servicio_servicio" 
											   name="strPais_notas_credito_servicio_servicio" 
											   type="hidden" value="">
										</input>
									    <!-- Caja de texto oculta para recuperar el subtotal desglosado con base al importe capturado-->
										<input id="txtGastosServicio_notas_credito_servicio_servicio" 
											   name="intGastosServicio_notas_credito_servicio_servicio" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta para recuperar el IVA desglosado con base al importe capturado-->
										<input id="txtGastosServicioIva_notas_credito_servicio_servicio" 
											   name="intGastosServicioIva_notas_credito_servicio_servicio" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta que se utiliza para recuperar el importe de la factura (para mostrarlo en la tabla CFDI relacionados)-->
										<input id="txtImporteFacturaServicio_notas_credito_servicio_servicio" 
											   name="intImporteFacturaServicio_notas_credito_servicio_servicio"  
											   type="hidden"  value="" />	   
										<label for="txtFacturaServicio_notas_credito_servicio_servicio">Factura</label>
									</div>	
									<div class="col-md-12">
										<input  class="form-control" 
												id="txtFacturaServicio_notas_credito_servicio_servicio" 
												name="strFacturaServicio_notas_credito_servicio_servicio" 
												type="text" value="" tabindex="1" placeholder="Ingrese factura" maxlength="250" />
									</div>
								</div>	
							</div>
							<!--Razón social-->
							<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtRazonSocial_notas_credito_servicio_servicio">Razón social</label>
									</div>
									<div class="col-md-12">
										<input class="form-control" id="txtRazonSocial_notas_credito_servicio_servicio"
											   name="strRazonSocial_notas_credito_servicio_servicio" 
											   type="text" value="" disabled />
									</div>
								</div>
							</div>
							<!--RFC-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtRfc_notas_credito_servicio_servicio">RFC</label>
									</div>	
									<div class="col-md-12">
										<input  class="form-control" 
												id="txtRfc_notas_credito_servicio_servicio" 
												name="strRfc_notas_credito_servicio_servicio" 
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
										<input id="txtFormaPagoID_notas_credito_servicio_servicio" 
											   name="intFormaPagoID_notas_credito_servicio_servicio" 
											   type="hidden" value="" />
										<label for="txtFormaPago_notas_credito_servicio_servicio">
											Forma de pago
										</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtFormaPago_notas_credito_servicio_servicio" 
												name="strFormaPago_notas_credito_servicio_servicio" type="text" value=""  
												tabindex="1" placeholder="Ingrese forma de pago" maxlength="250" />
									</div>
								</div>
							</div>
							<!--Autocomplete que contiene los métodos de pago activos-->
							<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta para recuperar el id del método de pago seleccionado-->
										<input id="txtMetodoPagoID_notas_credito_servicio_servicio" 
											   name="intMetodoPagoID_notas_credito_servicio_servicio" 
											   type="hidden" value="" />
										<label for="txtMetodoPago_notas_credito_servicio_servicio">
											Método de pago
										</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtMetodoPago_notas_credito_servicio_servicio" 
												name="strMetodoPago_notas_credito_servicio_servicio" type="text" value=""  
												tabindex="1" placeholder="Ingrese método de pago" maxlength="250" />
									</div>
								</div>
							</div>
							<!--Combobox que contiene la exportación activa-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="cmbExportacionID_notas_credito_servicio_servicio">Exportación</label>
									</div>
									<div id="divCmbMsjValidacion" class="col-md-12">
										<select class="form-control" id="cmbExportacionID_notas_credito_servicio_servicio"
										        name="intExportacionID_notas_credito_servicio_servicio" tabindex="1">
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
										<input id="txtUsoCfdiID_notas_credito_servicio_servicio" 
											   name="intUsoCfdiID_notas_credito_servicio_servicio" 
											   type="hidden" value="" />
										<label for="txtUsoCfdi_notas_credito_servicio_servicio">
											Uso del CFDI
										</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtUsoCfdi_notas_credito_servicio_servicio" 
												name="strUsoCfdi_notas_credito_servicio_servicio" type="text" value=""  
												tabindex="1" placeholder="Ingrese uso del CFDI" maxlength="250" />
									</div>
								</div>
							</div>
							<!--Autocomplete que contiene los tipos de relación activos-->
							<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta para recuperar el id del tipo de relación seleccionado-->
										<input id="txtTipoRelacionID_notas_credito_servicio_servicio" 
											   name="intTipoRelacionID_notas_credito_servicio_servicio" 
											   type="hidden" value="" />
										<label for="txtTipoRelacion_notas_credito_servicio_servicio">
											Tipo de relación
										</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtTipoRelacion_notas_credito_servicio_servicio" 
												name="strTipoRelacion_notas_credito_servicio_servicio" type="text" value=""  
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
										<label for="txtObservaciones_notas_credito_servicio_servicio">Observaciones</label>
									</div>	
									<div class="col-md-12">
										<input  class="form-control" 
												id="txtObservaciones_notas_credito_servicio_servicio" 
												name="strObservaciones_notas_credito_servicio_servicio" 
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
										<input 	id="txtNumDetalles_notas_credito_servicio_servicio" 
									   			name="intNumDetalles_notas_credito_servicio_servicio" 
									   			type="hidden" value="" /> 
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">Detalles de la nota de crédito</h4>
											</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!--Concepto-->
															<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtConcepto_detalles_notas_credito_servicio_servicio">
																			Concepto
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtConcepto_detalles_notas_credito_servicio_servicio" 
																				name="strConcepto_detalles_notas_credito_servicio_servicio" type="text" value="" 
																				tabindex="1" placeholder="Ingrese concepto" maxlength="250">
																		</input>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--Autocomplete que contiene los objetos de impuesto-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtObjetoImpuesto_detalles_notas_credito_servicio_servicio">Objeto de impuesto SAT</label>
															</div>
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el código del objeto de impuesto seleccionado-->
																<input id="txtObjetoImpuestoSat_detalles_notas_credito_servicio_servicio" 
																	   name="strObjetoImpuestoSat_detalles_notas_credito_servicio_servicio"  
																	   type="hidden" value="">
															    </input>
																<input  class="form-control" id="txtObjetoImpuesto_detalles_notas_credito_servicio_servicio" 
																		name="strObjetoImpuesto_detalles_notas_credito_servicio_servicio" type="text" 
																		value="" tabindex="1" placeholder="Ingrese objeto de impuesto SAT" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Div que contiene la tabla con los detalles encontrados-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!-- Diseño de la tabla-->
															<table class="table-hover movil" id="dg_detalles_notas_credito_servicio_servicio">
																<thead class="movil">
																	<tr class="movil">
																		<th class="movil">Descripción</th>
																		<th class="movil">Precio</th>
																		<th class="movil">Descuento</th>
																		<th class="movil">Subtotal</th>
																		<th class="movil">IVA</th>
																		<th class="movil">IEPS</th>
																		<th class="movil">Total</th>
																	</tr>
																</thead>
																<tbody class="movil"></tbody>
																<tfoot class="movil">
																	<tr class="movil">
																		<td class="movil t1">
																			<strong>Total</strong>
																		</td>
																		<td class="movil t2"></td>
																		<td class="movil t3">
																			<strong id="acumDescuento_detalles_notas_credito_servicio_servicio"></strong>
																		</td>
																		<td class="movil t4">
																			<strong id="acumSubtotal_detalles_notas_credito_servicio_servicio"></strong>
																		</td>
																		<td class="movil t5">
																			<strong id="acumIva_detalles_notas_credito_servicio_servicio"></strong>
																		</td>
																		<td class="movil t6">
																			<strong  id="acumIeps_detalles_notas_credito_servicio_servicio"></strong>
																		</td>
																		<td class="movil t7">
																			<strong id="acumTotal_detalles_notas_credito_servicio_servicio"></strong>
																		</td>
																	</tr>
																</tfoot>
															</table>
															<br>
															<div class="row">
																<!--Número de registros encontrados-->
																<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																	<button class="btn btn-default btn-sm disabled pull-right">
																		<strong id="numElementos_detalles_notas_credito_servicio_servicio">0</strong> encontrados
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
					<div id="cfdi_relacionados_notas_credito_servicio_servicio" class="tab-pane fade">
						<div class="row">
							<!--Botones-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<div class="btn-group pull-right">
									<!--Buscar CFDI a relacionar para agregarlos en la tabla-->
									<button class="btn btn-primary" 
	                                			id="btnBuscarCFDI_notas_credito_servicio_servicio" 
	                                			onclick="abrir_relacionar_cfdi_notas_credito_servicio_servicio();" 
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
								<input id="txtNumCfdiRelacionados_notas_credito_servicio_servicio" 
									   name="intNumCfdiRelacionados_notas_credito_servicio_servicio" type="hidden" value="" />
								<!-- Diseño de la tabla-->
								<table class="table-hover movil" id="dg_cfdi_relacionados_notas_credito_servicio_servicio">
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
											<strong id="numElementos_cfdi_relacionados_notas_credito_servicio_servicio">0</strong> encontrados
										</button>
									</div>
								</div>
							</div>
						</div>
					</div><!--Cierre del contenido del tab - CFDI relacionados-->	
				</div>
				<!--Cierre tab-content -->	
				<!--Circulo de progreso-->
				<div id="divCirculoBarProgreso_notas_credito_servicio_servicio" class="load-container load5 circulo_bar no-mostrar">
					<div class="loader">Loading...</div>
					<br><br>
					<div align=center><b>Espere un momento por favor.</b></div>
				</div> 
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Nuevo registro-->
						<button class="btn btn-info" 
								id="btnReiniciar_notas_credito_servicio_servicio"  
								onclick="nuevo_notas_credito_servicio_servicio('Nuevo');"  
								title="Nuevo registro" 
								tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" 
								id="btnGuardar_notas_credito_servicio_servicio"  
								onclick="validar_notas_credito_servicio_servicio();"  
								title="Guardar" 
								tabindex="3" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Enviar correo electrónico-->
						<button class="btn btn-default" id="btnEnviarCorreo_notas_credito_servicio_servicio"  
								onclick="abrir_cliente_notas_credito_servicio_servicio('');"  
								title="Enviar correo electrónico" tabindex="4" disabled>
							<span class="glyphicon glyphicon-envelope"></span>
						</button> 
						<!--Ver motivo de cancelación del registro-->
						<button class="btn btn-default" id="btnVerMotivoCancelacion_notas_credito_servicio_servicio"  
								onclick="ver_cancelacion_notas_credito_servicio_servicio('');"  title="Ver motivo de cancelación" tabindex="5">
							<i class="fa fa-info-circle" aria-hidden="true"></i>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_notas_credito_servicio_servicio"  
								onclick="reporte_registro_notas_credito_servicio_servicio('');"  
								title="Imprimir" 
								tabindex="6" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Descargar archivos-->
	                    <button class="btn btn-default" id="btnDescargarArchivo_notas_credito_servicio_servicio"  
								onclick="descargar_archivos_notas_credito_servicio_servicio('', '');"  title="Descargar archivos" tabindex="7" disabled>
							<span class="glyphicon glyphicon-download-alt"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" 
								id="btnDesactivar_notas_credito_servicio_servicio"  
								onclick="cambiar_estatus_notas_credito_servicio_servicio('', '', '', '');"  
								title="Desactivar" 
								tabindex="8" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  
								id="btnCerrar_notas_credito_servicio_servicio"
								type="reset" 
								aria-hidden="true" 
								onclick="cerrar_notas_credito_servicio_servicio();" 
								title="Cerrar"  
								tabindex="9">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal-->

</div><!--#NotasCreditoServicioServicioContent -->


<!-- /.Plantilla para cargar los motivo de cancelación en el combobox-->  
<script id="cancelacion_motivos_notas_credito_servicio_servicio" type="text/template">
	<option value="">Seleccione una opción</option>
	{{#motivos}}
	<option value="{{value}}">{{nombre}}</option>
	{{/motivos}} 
</script>

<!-- /.Plantilla para cargar la exportación en el combobox-->  
<script id="exportacion_notas_credito_servicio_servicio" type="text/template">
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
	var intPaginaNotasCreditoServicioServicio = 0;
	var strUltimaBusquedaNotasCreditoServicioServicio = "";
	/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar en el timbrado y cfdi's relacionados)*/
	var strTipoReferenciaNotasCreditoServicioServicio = "DEVOLUCION SERVICIO";
	/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
	var strTipoReferenciaPolizaNotasCreditoServicioServicio = "NOTA CREDITO SERVICIO";
	//Variable que se utiliza para asignar el id de la moneda base
    var intMonedaBaseIDNotasCreditoServicioServicio = <?php echo MONEDA_BASE ?>;
    //Variable que se utiliza para asignar el id de la exportación base
	var intExportacionBaseIDNotasCreditoServicioServicio = <?php echo EXPORTACION_BASE ?>;
    //Variable que se utiliza para asignar el id del objeto de impuesto base
	var intObjetoImpuestoBaseIDNotasCreditoServicioServicio = <?php echo OBJETOIMP_BASE ?>;

    //Variable que se utiliza para asignar el id del motivo de cancelación: Comprobante emitido con errores con relación.
	var intCancelacionIDRelacionCfdiNotasCreditoServicioServicio = <?php echo MOTIVO_CANCELACION_RELACIONCFDI ?>;
	//Variable que se utiliza para asignar el mensaje de régimen fiscal faltante.
	var strMsjRegimenFiscalCteNotasCreditoServicioServicio = "<?php echo MSJ_ERROR_REGIMEN_FISCAL ?>";

	//Variable que se utiliza para asignar objeto del modal Cancelación del timbrado
	var objCancelacionNotasCreditoServicioServicio = null;

	//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
	var objEnviarNotasCreditoServicioServicio = null;
	//Variable que se utiliza para asignar objeto del modal Relacionar CFDI
	var objRelacionarCfdiNotasCreditoServicioServicio = null;
	//Variable que se utiliza para asignar objeto del modal
	var objNotasCreditoServicioServicio = null;
	

	/*******************************************************************************************************************
	Funciones del objeto Detalles de la factura
	*********************************************************************************************************************/
	/*Constructor del objeto Detalles (contiene detalles de la factura (mismos que se consultan una sola vez) como: servicios de mano de obra, refacciones, trabajos foráneos y otros servicios)*/
	var objDetallesFraNotasCreditoServicioServicio;
	function DetallesFraNotasCreditoServicioServicio(serviciosManoObra, refacciones, trabajosForaneos, otros)
	{
	    this.arrServiciosManoObra = serviciosManoObra;
	    this.arrRefacciones = refacciones;
	    this.arrTrabajosForaneos = trabajosForaneos;
	    this.arrOtros = otros;
	}

	//Función para agregar todos los servicios de mano de obra al objeto Detalles
	DetallesFraNotasCreditoServicioServicio.prototype.setServicios = function(serviciosManoObra) {
	    this.arrServiciosManoObra = serviciosManoObra;
	}
	//Función para obtener todos los servicios de mano de obra del objeto Detalles
	DetallesFraNotasCreditoServicioServicio.prototype.getServicios = function() {
	    return this.arrServiciosManoObra;
	}

	//Función para obtener un servicio del objeto 
	DetallesFraNotasCreditoServicioServicio.prototype.getServicio = function(index) {
	    return this.arrServiciosManoObra[index];
	}


	//Función para agregar todas las refacciones al objeto Detalles
	DetallesFraNotasCreditoServicioServicio.prototype.setRefacciones = function(refacciones) {
	    this.arrRefacciones = refacciones;
	}
	//Función para obtener todas las refacciones del objeto Detalles
	DetallesFraNotasCreditoServicioServicio.prototype.getRefacciones = function() {
	    return this.arrRefacciones;
	}

	//Función para obtener una refacción del objeto 
	DetallesFraNotasCreditoServicioServicio.prototype.getRefaccion = function(index) {
	    return this.arrRefacciones[index];
	}


	//Función para agregar todos los trabajos foráneos al objeto Detalles
	DetallesFraNotasCreditoServicioServicio.prototype.setTrabajosForaneos = function(trabajosForaneos) {
	    this.arrTrabajosForaneos = trabajosForaneos;
	}
	//Función para obtener todos los trabajos foráneos del objeto Detalles
	DetallesFraNotasCreditoServicioServicio.prototype.getTrabajosForaneos = function() {
	    return this.arrTrabajosForaneos;
	}

	//Función para obtener un trabajo foráneo del objeto 
	DetallesFraNotasCreditoServicioServicio.prototype.getTrabajoForaneo = function(index) {
	    return this.arrTrabajosForaneos[index];
	}

	//Función para agregar otros servicios al objeto Detalles
	DetallesFraNotasCreditoServicioServicio.prototype.setOtros = function(otros) {
	    this.arrOtros = otros;
	}
	//Función para obtener otros servicios del objeto Detalles
	DetallesFraNotasCreditoServicioServicio.prototype.getOtros = function() {
	    return this.arrOtros;
	}

	//Función para obtener un servicio del objeto 
	DetallesFraNotasCreditoServicioServicio.prototype.getOtro = function(index) {
	    return this.arrOtros[index];
	}
	
	/*******************************************************************************************************************
	Funciones del objeto Detalles de la nota de crédito
	*********************************************************************************************************************/
	// Constructor del objeto detalles de la nota de crédito
	var objDetallesNotaNotasCreditoServicioServicio;
	function DetallesNotaNotasCreditoServicioServicio(detalles)
	{
		this.arrDetalles = detalles;
	}

	//Función para agregar los detalles  al objeto Detalles de la nota de crédito
	DetallesNotaNotasCreditoServicioServicio.prototype.setDetalles = function(detalles) {
	    this.arrDetalles = detalles;
	}


	/*******************************************************************************************************************
	Funciones del objeto CFDI's  relacionados (facturas seleccionadas)
	*********************************************************************************************************************/
	// Constructor del objeto CFDI's relacionados (facturas seleccionadas)
	var objCfdisRelacionadosNotasCreditoServicioServicio;
	function CfdisRelacionadosNotasCreditoServicioServicio(cfdis)
	{
		this.arrCfdis = cfdis;
	}

	//Función para obtener todos los cfdi´s seleccionados
	CfdisRelacionadosNotasCreditoServicioServicio.prototype.getCfdis = function() {
	    return this.arrCfdis;
	}

	//Función para agregar un cfdi al objeto 
	CfdisRelacionadosNotasCreditoServicioServicio.prototype.setCfdi = function (cfdi){
		this.arrCfdis.push(cfdi);
	}

	//Función para obtener un cfdi del objeto 
	CfdisRelacionadosNotasCreditoServicioServicio.prototype.getCfdi = function(index) {
	    return this.arrCfdis[index];
	}


	/*******************************************************************************************************************
	Funciones del objeto CFDI a relacionar
	*********************************************************************************************************************/
	// Constructor del objeto CFDI a relacionar
	var objCfdiRelacionarNotasCreditoServicioServicio;
	
	function CfdiRelacionarNotasCreditoServicioServicio(referenciaID, cliente, folio, fecha, tipoReferencia, uuid, importe)
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
	function permisos_notas_credito_servicio_servicio()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('servicio/notas_credito_servicio/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_notas_credito_servicio_servicio').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosNotasCreditoServicioServicio = data.row;
				//Separar la cadena 
				var arrPermisosNotasCreditoServicioServicio = strPermisosNotasCreditoServicioServicio.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosNotasCreditoServicioServicio.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosNotasCreditoServicioServicio[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_notas_credito_servicio_servicio').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosNotasCreditoServicioServicio[i]=='GUARDAR') || (arrPermisosNotasCreditoServicioServicio[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_notas_credito_servicio_servicio').removeAttr('disabled');
					}
					//Si el indice es VER REGISTRO
					else if(arrPermisosNotasCreditoServicioServicio[i]=='VER REGISTRO')
					{
						//Habilitar el control (botón descargar archivo)
						$('#btnDescargarArchivo_notas_credito_servicio_servicio').removeAttr('disabled');
					}
					//Si el indice es ENVIAR CORREO
					else if(arrPermisosNotasCreditoServicioServicio[i]=='ENVIAR CORREO')
					{
						//Habilitar el control (botón enviar correo)
						$('#btnEnviarCorreo_notas_credito_servicio_servicio').removeAttr('disabled');
					}
					else if(arrPermisosNotasCreditoServicioServicio[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_notas_credito_servicio_servicio').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_notas_credito_servicio_servicio();
					}
					else if(arrPermisosNotasCreditoServicioServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_notas_credito_servicio_servicio').removeAttr('disabled');
						
					}
					else if(arrPermisosNotasCreditoServicioServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_notas_credito_servicio_servicio').removeAttr('disabled');
					}
					else if(arrPermisosNotasCreditoServicioServicio[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_notas_credito_servicio_servicio').removeAttr('disabled');
					}
					else if(arrPermisosNotasCreditoServicioServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_notas_credito_servicio_servicio').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_notas_credito_servicio_servicio() 
	{
		
		//Concatenar datos para la nueva búsqueda
		var strNuevaBusquedaNotasCreditoServicioServicio =($('#txtFechaInicialBusq_notas_credito_servicio_servicio').val()+$('#txtFechaFinalBusq_notas_credito_servicio_servicio').val()+$('#txtProspectoIDBusq_notas_credito_servicio_servicio').val()+$('#cmbEstatusBusq_notas_credito_servicio_servicio').val()+$('#txtBusqueda_notas_credito_servicio_servicio').val());

		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaNotasCreditoServicioServicio != strUltimaBusquedaNotasCreditoServicioServicio)
		{
			intPaginaNotasCreditoServicioServicio = 0;
			strUltimaBusquedaNotasCreditoServicioServicio = strNuevaBusquedaNotasCreditoServicioServicio;
		}

		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('servicio/notas_credito_servicio/get_paginacion',
				{	
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_notas_credito_servicio_servicio').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_notas_credito_servicio_servicio').val()),
					 intProspectoID: $('#txtProspectoIDBusq_notas_credito_servicio_servicio').val(),
	    			strEstatus:     $('#cmbEstatusBusq_notas_credito_servicio_servicio').val(),
	    			strBusqueda:    $('#txtBusqueda_notas_credito_servicio_servicio').val(),
					intPagina:intPaginaNotasCreditoServicioServicio,
					strPermisosAcceso: $('#txtAcciones_notas_credito_servicio_servicio').val()
				},
				function(data){
					$('#dg_notas_credito_servicio_servicio tbody').empty();
					var tmpNotasCreditoServicioServicio = Mustache.render($('#plantilla_notas_credito_servicio_servicio').html(),data);
					$('#dg_notas_credito_servicio_servicio tbody').html(tmpNotasCreditoServicioServicio);
					$('#pagLinks_notas_credito_servicio_servicio').html(data.paginacion);
					$('#numElementos_notas_credito_servicio_servicio').html(data.total_rows);
					intPaginaNotasCreditoServicioServicio = data.pagina;
				},
		'json');
	}

	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_notas_credito_servicio_servicio(strTipo) 
	{	
		//Variable que se utiliza para asignar URL (ruta del controlador)
		var strUrl = 'servicio/notas_credito_servicio/';

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
		if ($('#chbImprimirDetalles_notas_credito_servicio_servicio').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_notas_credito_servicio_servicio').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_notas_credito_servicio_servicio').val('NO');
		}


		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_notas_credito_servicio_servicio').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_notas_credito_servicio_servicio').val()),
										'intProspectoID': $('#txtProspectoIDBusq_notas_credito_servicio_servicio').val(),
										'strEstatus': $('#cmbEstatusBusq_notas_credito_servicio_servicio').val(), 
										'strBusqueda': $('#txtBusqueda_notas_credito_servicio_servicio').val(),
										'strDetalles': $('#chbImprimirDetalles_notas_credito_servicio_servicio').val()			
									 }
						   };


		//Hacer un llamado a la función para imprimir/descargar el reporte
		$.imprimirReporte(objReporte);
	}

	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_notas_credito_servicio_servicio(id)
	{	
		//Variable que se utiliza para asignar el valores del registro
		var intID = 0;

		//Si no existe id, significa que se realizará la impresión desde el modal
		if(id == '')
		{
			intID = $('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val();	
		}
		else
		{
			intID = id;
		}



		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url':  'contabilidad/timbradoV4/get_pdf',
						'data' : {
									'intReferenciaID':intID,
									'strTipoReferencia':strTipoReferenciaNotasCreditoServicioServicio,
									'strTimbrar': 'NO'		
								 }
					   };


		//Hacer un llamado a la función para imprimir/descargar el reporte
		$.imprimirReporte(objReporte);	
	}


	//Función que se utiliza para descargar los archivos del registro seleccionado
	function descargar_archivos_notas_credito_servicio_servicio(notaCreditoServicioID, folio)
	{
		//Variables que se utilizan para asignar los valores del registro
		var intID = 0;
		var strFolio = '';
		//Si no existe id, significa que se descargara el archivo desde el modal
		if(notaCreditoServicioID == '')
		{
			intID = $('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val();
			strFolio = $('#txtFolio_notas_credito_servicio_servicio').val();
		}
		else
		{
			intID = notaCreditoServicioID;
			strFolio = folio;
		}

		
		//Definir encapsulamiento de datos que son necesarios para descargar el archivo
		objArchivo = {'url': 'contabilidad/timbradoV4/descargar_archivos',
						'data' : {
									'intReferenciaID': intID,
									'strTipoReferencia': strTipoReferenciaNotasCreditoServicioServicio,
									'strFolio':strFolio		
								 }
					   };


		//Hacer un llamado a la función para descarga del archivo
		$.imprimirReporte(objArchivo);
	}


	//Regresar exportación activa para cargarlas en el combobox
	function cargar_exportacion_notas_credito_servicio_servicio()
	{
		//Hacer un llamado al método del controlador para regresar la exportación que se encuentra activa
		$.post('contabilidad/sat_exportacion/get_combo_box', {},
			function(data)
			{
				$('#cmbExportacionID_notas_credito_servicio_servicio').empty();
				var temp = Mustache.render($('#exportacion_notas_credito_servicio_servicio').html(), data);
				$('#cmbExportacionID_notas_credito_servicio_servicio').html(temp);
			},
			'json');
	}




	/*******************************************************************************************************************
	Funciones del modal Cancelación del timbrado
	*********************************************************************************************************************/
	//Función para limpiar los campos del formulario
	function nuevo_cancelacion_notas_credito_servicio_servicio()
	{
		//Incializar formulario
		$('#frmCancelacionNotasCreditoServicioServicio')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_cancelacion_notas_credito_servicio_servicio();
		//Limpiar cajas de texto ocultas
		$('#frmCancelacionNotasCreditoServicioServicio').find('input[type=hidden]').val('');
		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
		$.removerClasesEncabezado('divEncabezadoModal_cancelacion_notas_credito_servicio_servicio');
		//Habilitar todos los elementos del formulario
		$('#frmCancelacionNotasCreditoServicioServicio').find('input, textarea, select').removeAttr('disabled','disabled');
		//Deshabilitar las siguientes cajas de texto
		$('#txtFolio_cancelacion_notas_credito_servicio_servicio').attr('disabled','disabled');
		//Mostrar botón de Guardar
	    $("#btnGuardar_cancelacion_notas_credito_servicio_servicio").show();
	    //Agregar clase para ocultar div que contiene los datos de creación del registro
		$("#divDatosCreacion_cancelacion_notas_credito_servicio_servicio").addClass('no-mostrar');
	}

	//Función que se utiliza para abrir el modal
	function abrir_cancelacion_notas_credito_servicio_servicio(id, folio, polizaID)
	{
		//Hacer un llamado a la función para limpiar los campos del formulario
		nuevo_cancelacion_notas_credito_servicio_servicio();

		//Asignar datos del registro seleccionado
		$('#txtReferenciaCfdiID_cancelacion_notas_credito_servicio_servicio').val(id);
		$('#txtFolio_cancelacion_notas_credito_servicio_servicio').val(folio);
		$('#txtPolizaID_cancelacion_notas_credito_servicio_servicio').val(polizaID);
		//Dependiendo del estatus cambiar el color del encabezado 
	    $('#divEncabezadoModal_cancelacion_notas_credito_servicio_servicio').addClass("estatus-ACTIVO");

	    //Abrir modal
		objCancelacionNotasCreditoServicioServicio = $('#CancelacionNotasCreditoServicioServicioBox').bPopup({
											   appendTo: '#NotasCreditoServicioServicioContent', 
					                           contentContainer: 'NotasCreditoServicioServicioM', 
					                           zIndex: 2, 
					                           modalClose: false, 
					                           modal: true, 
					                           follow: [true,false], 
					                           followEasing : "linear", 
					                           easing: "linear", 
					                           modalColor: ('#F0F0F0')});
		//Enfocar caja de texto
		$('#cmbCancelacionMotivoID_cancelacion_notas_credito_servicio_servicio').focus();
	}

	//Función para regresar los datos (al formulario) del registro seleccionados
	function ver_cancelacion_notas_credito_servicio_servicio(id)
	{

		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtCancelacionID_notas_credito_servicio_servicio').val();

		}
		else
		{
			intID = id;
		}

		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('contabilidad/cancelaciones/get_datos',
        {
       		intCancelacionID:intID,
       		strTipoReferencia:strTipoReferenciaNotasCreditoServicioServicio
        },
		       function(data) {
		        	//Si hay datos del registro
		            if(data.row)
		            {
		               //Hacer un llamado a la función para limpiar los campos del formulario
						nuevo_cancelacion_notas_credito_servicio_servicio();
						//Recuperar valores
						$('#cmbCancelacionMotivoID_cancelacion_notas_credito_servicio_servicio').val(data.row.cancelacion_motivo_id);
						$('#txtFolio_cancelacion_notas_credito_servicio_servicio').val(data.row.folio_referencia);
						$('#txtFolioSustitucion_cancelacion_notas_credito_servicio_servicio').val(data.row.folio_sustitucion);
						$('#txtUsuarioCreacion_cancelacion_notas_credito_servicio_servicio').val(data.row.usuario_creacion);
						$('#txtFechaCreacion_cancelacion_notas_credito_servicio_servicio').val(data.row.fecha_creacion);

						//Dependiendo del estatus cambiar el color del encabezado 
	   					$('#divEncabezadoModal_cancelacion_notas_credito_servicio_servicio').addClass("estatus-INACTIVO");

	   				    //Deshabilitar todos los elementos del formulario
			            $('#frmCancelacionNotasCreditoServicioServicio').find('input, textarea, select').attr('disabled','disabled');
	   					//Ocultar botón de Guardar
			            $("#btnGuardar_cancelacion_notas_credito_servicio_servicio").hide();
			            //Remover clase para mostrar div que contiene los datos de creación del registro
						$("#divDatosCreacion_cancelacion_notas_credito_servicio_servicio").removeClass('no-mostrar');

						//Abrir modal
						objCancelacionNotasCreditoServicioServicio = $('#CancelacionNotasCreditoServicioServicioBox').bPopup({
											   appendTo: '#NotasCreditoServicioServicioContent', 
					                           contentContainer: 'NotasCreditoServicioServicioM', 
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
	function cerrar_cancelacion_notas_credito_servicio_servicio()
	{
		try {
			//Cerrar modal
			objCancelacionNotasCreditoServicioServicio.close();
			//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	        ocultar_circulo_carga_cancelacion_notas_credito_servicio_servicio();
			
		}
		catch(err) {}
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_cancelacion_notas_credito_servicio_servicio()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_cancelacion_notas_credito_servicio_servicio();
		//Validación del formulario de campos obligatorios
		$('#frmCancelacionNotasCreditoServicioServicio')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
								  	intCancelacionMotivoID_notas_credito_servicio_servicio: {
										validators: {
											notEmpty: {message: 'Seleccione un motivo'}
										}
									},
									strFolioSustitucion_cancelacion_notas_credito_servicio_servicio: {
										validators: {
									    	callback: {
				                                callback: function(value, validator, $field) {
				                                    //Verificar que exista id del tipo de relación
				                                    if(value == '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_notas_credito_servicio_servicio').val()) === intCancelacionIDRelacionCfdiNotasCreditoServicioServicio) 
				                                    	
				                                    {
			                                      		return {
				                                            valid: false,
				                                            message: 'Escriba un anticipo existente'
				                                        };
				                                    }
				                                    else if(value !== '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_notas_credito_servicio_servicio').val()) !== intCancelacionIDRelacionCfdiNotasCreditoServicioServicio)
				                                    {

				                                    	//Hacer un llamado a la función para inicializar elementos de la sustitución
				                                    	inicializar_sustitucion_notas_credito_servicio_servicio();
				                                    }
				                                    return true;
				                                }
				                            }
										}
									}
								}
			});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_cancelacion_notas_credito_servicio_servicio = $('#frmCancelacionNotasCreditoServicioServicio').data('bootstrapValidator');
		bootstrapValidator_cancelacion_notas_credito_servicio_servicio.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_cancelacion_notas_credito_servicio_servicio.isValid())
		{
			//Hacer un llamado a la función para cancelar el timbrado de un registro
			cancelar_timbrado_notas_credito_servicio_servicio();
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_cancelacion_notas_credito_servicio_servicio()
	{
		try
		{
			$('#frmCancelacionNotasCreditoServicioServicio').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	
	//Función para inicializar elementos de la sustitución de CFDI
	function inicializar_sustitucion_notas_credito_servicio_servicio()
	{
		
		//Limpiar contenido de las siguientes cajas de texto
       $('#txtSustitucionID_cancelacion_notas_credito_servicio_servicio').val('');
       $('#txtUuidSustitucion_cancelacion_notas_credito_servicio_servicio').val('');
       $('#txtFolioSustitucion_cancelacion_notas_credito_servicio_servicio').val('');
	}


	//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
	//al momento de cancelar el timbrado
	function mostrar_circulo_carga_cancelacion_notas_credito_servicio_servicio()
	{
		//Remover clase para mostrar div que contiene la barra de carga
		$("#divCirculoBarProgreso_cancelacion_notas_credito_servicio_servicio").removeClass('no-mostrar');
	}

	//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
	//al momento de cancelar el timbrado
	function ocultar_circulo_carga_cancelacion_notas_credito_servicio_servicio()
	{
		//Agregar clase para ocultar div que contiene la barra de carga
		$("#divCirculoBarProgreso_cancelacion_notas_credito_servicio_servicio").addClass('no-mostrar');
	}

	//Regresar motivos de cancelación activos para cargarlos en el combobox
	function cargar_motivos_cancelacion_notas_credito_servicio_servicio()
	{
		//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
		$.post('contabilidad/sat_cancelacion_motivos/get_combo_box', {},
			function(data)
			{
				$('#cmbCancelacionMotivoID_cancelacion_notas_credito_servicio_servicio').empty();
				var temp = Mustache.render($('#cancelacion_motivos_notas_credito_servicio_servicio').html(), data);
				$('#cmbCancelacionMotivoID_cancelacion_notas_credito_servicio_servicio').html(temp);
			},
			'json');
	}


	/*******************************************************************************************************************
	Funciones del modal Enviar Correo Electrónico
	*********************************************************************************************************************/
	//Función para limpiar los campos del formulario
	function nuevo_cliente_notas_credito_servicio_servicio()
	{
		//Incializar formulario
		$('#frmEnviarNotasCreditoServicioServicio')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_cliente_notas_credito_servicio_servicio();
	    //Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
		$.removerClasesEncabezado('divEncabezadoModal_cliente_notas_credito_servicio_servicio');
	}


	//Función que se utiliza para abrir el modal
	function abrir_cliente_notas_credito_servicio_servicio(id)
	{
		//Hacer un llamado a la función para limpiar los campos del formulario
		nuevo_cliente_notas_credito_servicio_servicio();
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;

		//Si no existe id, significa que se enviará correo electrónico desde el modal
		if(id == '')
		{
			intID = $('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val();
			
		}
		else
		{
			intID = id;
		}

		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('servicio/notas_credito_servicio/get_datos',
       {
       		intNotaCreditoServicioID:intID
       },
       function(data) {
        	//Si hay datos del registro
            if(data.row)
            {
            	//Asignar datos del registro seleccionado
				$('#txtNotaCreditoServicioID_cliente_notas_credito_servicio_servicio').val(data.row.nota_credito_servicio_id);
				$('#txtFolio_cliente_notas_credito_servicio_servicio').val(data.row.folio);
				$('#txtRazonSocial_cliente_notas_credito_servicio_servicio').val(data.row.razon_social);
				$('#txtCorreoElectronico_cliente_notas_credito_servicio_servicio').val(data.row.correo_electronico);
				$('#txtCopiaCorreoElectronico_cliente_notas_credito_servicio_servicio').val(data.row.contacto_correo_electronico);
				//Dependiendo del estatus cambiar el color del encabezado 
			    $('#divEncabezadoModal_cliente_notas_credito_servicio_servicio').addClass("estatus-"+data.row.estatus);

			    //Abrir modal
				objEnviarNotasCreditoServicioServicio = $('#EnviarNotasCreditoServicioServicioBox').bPopup({
															   appendTo: '#NotasCreditoServicioServicioContent', 
									                           contentContainer: 'NotasCreditoServicioServicioM', 
									                           zIndex: 2, 
									                           modalClose: false, 
									                           modal: true, 
									                           follow: [true,false], 
									                           followEasing : "linear", 
									                           easing: "linear", 
									                           modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCorreoElectronico_cliente_notas_credito_servicio_servicio').focus();
            }
         },
       'json');
	}

	//Función que se utiliza para cerrar el modal
	function cerrar_cliente_notas_credito_servicio_servicio()
	{
		try {
			//Cerrar modal
			objEnviarNotasCreditoServicioServicio.close();
			
		}
		catch(err) {}
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_cliente_notas_credito_servicio_servicio()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_cliente_notas_credito_servicio_servicio();
		//Validación del formulario de campos obligatorios
		$('#frmEnviarNotasCreditoServicioServicio')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strCorreoElectronico_cliente_notas_credito_servicio_servicio: {
			                        	validators: {
			                        		notEmpty: {message: 'Escriba un correo electrónico'},
			                                regexp: {
			                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
			                                    message: 'Escriba una dirección de correo electrónico que sea válida'
			                                }
			                          	}
				                    },
				                    strCopiaCorreoElectronico_cliente_notas_credito_servicio_servicio: {
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
		var bootstrapValidator_cliente_notas_credito_servicio_servicio = $('#frmEnviarNotasCreditoServicioServicio').data('bootstrapValidator');
		bootstrapValidator_cliente_notas_credito_servicio_servicio.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_cliente_notas_credito_servicio_servicio.isValid())
		{
			//Hacer un llamado a la función para enviar correo electrónico
			enviar_correo_cliente_notas_credito_servicio_servicio();
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_cliente_notas_credito_servicio_servicio()
	{
		try
		{
			$('#frmEnviarNotasCreditoServicioServicio').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para enviar correo electrónico al cliente
	function enviar_correo_cliente_notas_credito_servicio_servicio()
	{
		//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
		mostrar_circulo_carga_cliente_notas_credito_servicio_servicio();
		//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
		$.post('contabilidad/timbradoV4/enviar_correo_electronico_cliente',
				{ 
					intReferenciaID: $('#txtNotaCreditoServicioID_cliente_notas_credito_servicio_servicio').val(),
					strTipoReferencia: strTipoReferenciaNotasCreditoServicioServicio,
					strFolio: $('#txtFolio_cliente_notas_credito_servicio_servicio').val(),
					strCorreoElectronico: $('#txtCorreoElectronico_cliente_notas_credito_servicio_servicio').val(),
					strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_notas_credito_servicio_servicio').val()
				},
				function(data) {
					if (data.resultado)
					{
						//Hacer un llamado a la función para cerrar modal
						cerrar_cliente_notas_credito_servicio_servicio();
					}

					//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	           	 	ocultar_circulo_carga_cliente_notas_credito_servicio_servicio();
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_notas_credito_servicio_servicio(data.tipo_mensaje, data.mensaje);
				},
		'json');
	}

	//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
	//al momento de enviar correo electrónico
	function mostrar_circulo_carga_cliente_notas_credito_servicio_servicio()
	{
		//Remover clase para mostrar div que contiene la barra de carga
		$("#divCirculoBarProgreso_cliente_notas_credito_servicio_servicio").removeClass('no-mostrar');
	}

	//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
	//al momento de enviar correo electrónico
	function ocultar_circulo_carga_cliente_notas_credito_servicio_servicio()
	{
		//Agregar clase para ocultar div que contiene la barra de carga
		$("#divCirculoBarProgreso_cliente_notas_credito_servicio_servicio").addClass('no-mostrar');
	}


	/*******************************************************************************************************************
	Funciones del modal Relacionar CFDI
	*********************************************************************************************************************/
	//Función para limpiar los campos del formulario
	function nuevo_relacionar_cfdi_notas_credito_servicio_servicio()
	{
		//Incializar formulario
		$('#frmRelacionarCfdiNotasCreditoServicioServicio')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_relacionar_cfdi_notas_credito_servicio_servicio();
		//Limpiar cajas de texto ocultas
		$('#frmRelacionarCfdiNotasCreditoServicioServicio').find('input[type=hidden]').val('');
		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
		$.removerClasesEncabezado('divEncabezadoModal_relacionar_cfdi_notas_credito_servicio_servicio');
		//Eliminar los datos de la tabla CFDI a relacionar
	    $('#dg_relacionar_cfdi_notas_credito_servicio_servicio tbody').empty();
	    $('#numElementos_relacionar_cfdi_notas_credito_servicio_servicio').html(0);
	}

	//Función que se utiliza para abrir el modal
	function abrir_relacionar_cfdi_notas_credito_servicio_servicio()
	{
		//Hacer un llamado a la función para limpiar los campos del formulario
		nuevo_relacionar_cfdi_notas_credito_servicio_servicio();
		//Variable que se utiliza para asignar el estatus del registro
		var strEstatus =  $('#txtEstatus_notas_credito_servicio_servicio').val();
		//Si no existe estatus, significa que es un nuevo registro
		if(strEstatus == '')
		{
			strEstatus = 'NUEVO';
		}

		//Dependiendo del estatus cambiar el color del encabezado 
	    $('#divEncabezadoModal_relacionar_cfdi_notas_credito_servicio_servicio').addClass("estatus-"+strEstatus);
		//Abrir modal
		objRelacionarCfdiNotasCreditoServicioServicio = $('#RelacionarCfdiNotasCreditoServicioServicioBox').bPopup({
										  appendTo: '#NotasCreditoServicioServicioContent', 
		                              	  contentContainer: 'NotasCreditoServicioServicioM', 
		                              	  zIndex: 2, 
		                              	  modalClose: false, 
		                              	  modal: true, 
		                              	  follow: [true,false], 
		                              	  followEasing : "linear", 
		                              	  easing: "linear", 
		                             	  modalColor: ('#F0F0F0')});

		//Enfocar caja de texto
		$('#txtFechaInicialBusq_relacionar_cfdi_notas_credito_servicio_servicio').focus();
		//Hacer un llamado a la función  para cargar los CFDI´s en el grid
		lista_facturas_relacionar_cfdi_notas_credito_servicio_servicio();

	}

	//Función que se utiliza para cerrar el modal
	function cerrar_relacionar_cfdi_notas_credito_servicio_servicio()
	{
		try {
			//Cerrar modal
			objRelacionarCfdiNotasCreditoServicioServicio.close();
		}
		catch(err) {}
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_relacionar_cfdi_notas_credito_servicio_servicio()
	{

		//Hacer un llamado a la función para agregar las facturas (CFDI) seleccionadas al  objeto CFDI's  relacionados
		agregar_facturas_relacionar_cfdi_notas_credito_servicio_servicio();

		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_relacionar_cfdi_notas_credito_servicio_servicio();

		//Validación del formulario de campos obligatorios
		$('#frmRelacionarCfdiNotasCreditoServicioServicio')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									intNumCfdi_relacionar_cfdi_notas_credito_servicio_servicio: {
										validators: {
									    	callback: {
				                                callback: function(value, validator, $field) {
				                                    //Verificar que existan detalles
				                                    if(parseInt(value) === 0 || value === '')
				                                    {
				                                    	return {
				                                            valid: false,
				                                            message: 'Seleccionar al menos un CFDI para esta nota de crédito.'
				                                        };
				                                    }
				                                    return true;
				                                }
				                            }
										}
									},
									strFechaInicialBusq_relacionar_cfdi_notas_credito_servicio_servicio: {
										excluded: true  // Ignorar (no valida el campo)
									},
									strFechaFinalBusq_relacionar_cfdi_notas_credito_servicio_servicio: {
										excluded: true  // Ignorar (no valida el campo)
									},
									strRazonSocialBusq_relacionar_cfdi_notas_credito_servicio_servicio: {
										excluded: true  // Ignorar (no valida el campo)
									}
								}
			});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_relacionar_cfdi_notas_credito_servicio_servicio = $('#frmRelacionarCfdiNotasCreditoServicioServicio').data('bootstrapValidator');
		bootstrapValidator_relacionar_cfdi_notas_credito_servicio_servicio.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_relacionar_cfdi_notas_credito_servicio_servicio.isValid())
		{
			//Hacer un llamado a la función para cerrar el modal
			cerrar_relacionar_cfdi_notas_credito_servicio_servicio();
			//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
	  		agregar_cfdi_relacionados_notas_credito_servicio_servicio('Nuevo', '');
		}
		else 
			return;
		
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_relacionar_cfdi_notas_credito_servicio_servicio()
	{
		try
		{
			$('#frmRelacionarCfdiNotasCreditoServicioServicio').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	/*******************************************************************************************************************
	Funciones de la tabla relacionar CFDI's
	*********************************************************************************************************************/
	//Función para la búsqueda de CFDI's 
	function lista_facturas_relacionar_cfdi_notas_credito_servicio_servicio() 
	{
		//Variables que se utilizan para asignar los criterios de búsqueda
		//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
		var dteFechaInicialBusq =  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_cfdi_notas_credito_servicio_servicio').val());
		var dteFechaFinalBusq =  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_cfdi_notas_credito_servicio_servicio').val());
		var intProspectoIDBusq =  $('#txtProspectoIDBusq_relacionar_cfdi_notas_credito_servicio_servicio').val();

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
					$('#dg_relacionar_cfdi_notas_credito_servicio_servicio tbody').empty();
					var tmpRelacionarCfdiNotasCreditoServicioServicio = Mustache.render($('#plantilla_relacionar_cfdi_notas_credito_servicio_servicio').html(),data);
					$('#numElementos_relacionar_cfdi_notas_credito_servicio_servicio').html(0);
					if(data.rows)
					{
						$('#numElementos_relacionar_cfdi_notas_credito_servicio_servicio').html(data.rows.length);	
					}
					$('#dg_relacionar_cfdi_notas_credito_servicio_servicio tbody').html(tmpRelacionarCfdiNotasCreditoServicioServicio);
					
				},
		'json');

		
	}

	//Función para agregar las facturas (CFDI) seleccionadas al objeto CFDI's  relacionados
	function agregar_facturas_relacionar_cfdi_notas_credito_servicio_servicio()
	{
	    //Variable que se utiliza para asignar el texto del td
	    var strValor = "";
	    //Variable que se utiliza para asignar el indice de la columna
	    var intCol = 0;
	    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
	    var intContador = 0;
         
        //Crear instancia del objeto CFDI´s relacionados (facturas seleccionadas)
		objCfdisRelacionadosNotasCreditoServicioServicio = new CfdisRelacionadosNotasCreditoServicioServicio([]);

	    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
	   	$('#dg_relacionar_cfdi_notas_credito_servicio_servicio tr:has(td)').find('input[type="checkbox"]').each(function() {
           	//Si el checkbox se encuentra marcado (seleccionado)
            if ($(this).prop("checked") == true)
            {
            	//Inicializar variables
            	intCol = 0;
            	
            	//Crear instancia del objeto CFDI a relacionar
				objCfdiRelacionarNotasCreditoServicioServicio = new CfdiRelacionarNotasCreditoServicioServicio(null, '', '', '', '', '', '');

            	//Buscamos el td más cercano en el DOM hacia "arriba"
				//luego encontramos los td adyacentes a este
            	$(this).closest('td').siblings().each(function(){

				      	//Obtenemos el texto del td 
				        strValor = $(this).text();

				        switch (intCol) {
						    case 0:
						        objCfdiRelacionarNotasCreditoServicioServicio.intReferenciaID = strValor;
						        break;
						    case 1:
						        objCfdiRelacionarNotasCreditoServicioServicio.strCliente = strValor;
						        break;
						    case 2:
						        objCfdiRelacionarNotasCreditoServicioServicio.strFolio = strValor;
						        break;
						    case 3:
						        objCfdiRelacionarNotasCreditoServicioServicio.dteFecha = strValor;
						        break;
						    case 4:
						        objCfdiRelacionarNotasCreditoServicioServicio.strTipoReferencia = strValor;
						        break;
						    case 5:
						       	objCfdiRelacionarNotasCreditoServicioServicio.strUuid = strValor;
						        break;
						    case 6:
						       	objCfdiRelacionarNotasCreditoServicioServicio.intImporte = strValor;
						       	break;
						}

				      	intCol++;
				    });

            	//Agregar datos del cfdi a relacionar
            	objCfdisRelacionadosNotasCreditoServicioServicio.setCfdi(objCfdiRelacionarNotasCreditoServicioServicio);
            	
            	//Incrementar el contador por cada registro
            	intContador++;
            }
        });

        //Asignar el número de registros seleccionados
        $('#txtNumCfdi_relacionar_cfdi_notas_credito_servicio_servicio').val(intContador);

	}



	/*******************************************************************************************************************
	Funciones del modal Notas de Crédito
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_notas_credito_servicio_servicio(tipoAccion)
	{
		//Incializar formulario
		$('#frmNotasCreditoServicioServicio')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_notas_credito_servicio_servicio();
		//Limpiar cajas de texto ocultas
		$('#frmNotasCreditoServicioServicio').find('input[type=hidden]').val('');
		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
		$.removerClasesEncabezado('divEncabezadoModal_notas_credito_servicio_servicio');
		//Hacer un llamado a la función para inicializar elementos de las tablas detalles y CFDI´s relacionados
		inicializar_detalles_notas_credito_servicio_servicio();	
		//Crear instancia del objeto Detalles de la factura
		objDetallesFraNotasCreditoServicioServicio = new DetallesFraNotasCreditoServicioServicio([], [], [], []);

		//Crear instancia del objeto Detalles de la nota de crédito
		objDetallesNotaNotasCreditoServicioServicio = new DetallesNotaNotasCreditoServicioServicio([]);

		//Habilitar todos los elementos del formulario
	    $('#frmNotasCreditoServicioServicio').find('input, textarea, select').attr('disabled', false);
	    //Seleccionar tab que contiene la información general de la nota de crédito
		$('a[href="#informacion_general_notas_credito_servicio_servicio"]').click();
		//Asignar la fecha actual
		$('#txtFecha_notas_credito_servicio_servicio').val(fechaActual()); 
		
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_notas_credito_servicio_servicio').addClass("estatus-NUEVO");
			//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
			cargar_objeto_impuesto_base_notas_credito_servicio_servicio();
		}

		
		//Deshabilitar las siguientes cajas de texto
		$('#txtFolio_notas_credito_servicio_servicio').attr("disabled", "disabled");
		$('#txtRazonSocial_notas_credito_servicio_servicio').attr("disabled", "disabled");
		$('#txtRfc_notas_credito_servicio_servicio').attr("disabled", "disabled");
		$('#txtMoneda_notas_credito_servicio_servicio').attr("disabled", "disabled");
		$('#txtTipoCambio_notas_credito_servicio_servicio').attr("disabled", "disabled");

		 //Mostrar por Default 01- No aplica
		$('#cmbExportacionID_notas_credito_servicio_servicio').val(intExportacionBaseIDNotasCreditoServicioServicio);

		//Mostrar botón Guardar
		$("#btnGuardar_notas_credito_servicio_servicio").show();
		$("#btnBuscarCFDI_notas_credito_servicio_servicio").show();
		$("#btnReiniciar_notas_credito_servicio_servicio").show(); 
		//Ocultar los siguientes botones
		$("#btnEnviarCorreo_notas_credito_servicio_servicio").hide();
		$("#btnDescargarArchivo_notas_credito_servicio_servicio").hide();
		$("#btnImprimirRegistro_notas_credito_servicio_servicio").hide();
		$("#btnDesactivar_notas_credito_servicio_servicio").hide();
		$('#btnVerMotivoCancelacion_notas_credito_servicio_servicio').hide();
	}

	
	//Función para inicializar elementos de la factura de servicio
	function inicializar_factura_notas_credito_servicio_servicio()
	{
		//Limpiar contenido de las siguientes cajas de texto
		$('#txtMonedaID_notas_credito_servicio_servicio').val('');
        $('#txtMoneda_notas_credito_servicio_servicio').val('');
        $('#txtTipoCambio_notas_credito_servicio_servicio').val('');
        $('#txtOrdenReparacionID_notas_credito_servicio_servicio').val('');
        $('#txtProspectoID_notas_credito_servicio_servicio').val('');
	    $('#txtRazonSocial_notas_credito_servicio_servicio').val('');
	    $('#txtRegimenFiscalID_notas_credito_servicio_servicio').val('');
	    $('#txtRfc_notas_credito_servicio_servicio').val('');
	    $('#txtCalle_notas_credito_servicio_servicio').val('');
	    $('#txtNumeroExterior_notas_credito_servicio_servicio').val('');
	    $('#txtNumeroInterior_notas_credito_servicio_servicio').val('');
	    $('#txtCodigoPostal_notas_credito_servicio_servicio').val('');
	    $('#txtColonia_notas_credito_servicio_servicio').val('');
	    $('#txtLocalidad_notas_credito_servicio_servicio').val('');
	    $('#txtMunicipio_notas_credito_servicio_servicio').val('');
	    $('#txtEstado_notas_credito_servicio_servicio').val('');
	    $('#txtPais_notas_credito_servicio_servicio').val('');
	    $('#txtFormaPagoID_notas_credito_servicio_servicio').val('');
	    $('#txtFormaPago_notas_credito_servicio_servicio').val('');
	    $('#txtMetodoPagoID_notas_credito_servicio_servicio').val('');
	    $('#txtMetodoPago_notas_credito_servicio_servicio').val('');
	    $('#txtUsoCfdiID_notas_credito_servicio_servicio').val('');
	    $('#txtUsoCfdi_notas_credito_servicio_servicio').val('');
	    $("#txtGastosServicio_notas_credito_servicio_servicio").val('');
		$("#txtGastosServicioIva_notas_credito_servicio_servicio").val('');
		$("#txtImporteFacturaServicio_notas_credito_servicio_servicio").val('');
        //Hacer un llamado a la función para inicializar elementos de las tablas detalles y CFDI´s relacionados
		inicializar_detalles_notas_credito_servicio_servicio();
	}

	//Función para inicializar elementos de la tabla detalles
	function inicializar_detalles_notas_credito_servicio_servicio()
	{
		//Eliminar los datos de la tabla detalles de la nota de crédito
		$('#dg_detalles_notas_credito_servicio_servicio tbody').empty();
		$('#acumDescuento_detalles_notas_credito_servicio_servicio').html('');
	    $('#acumSubtotal_detalles_notas_credito_servicio_servicio').html('');
	    $('#acumIva_detalles_notas_credito_servicio_servicio').html('');
	    $('#acumIeps_detalles_notas_credito_servicio_servicio').html('');
	    $('#acumTotal_detalles_notas_credito_servicio_servicio').html('');
		$('#numElementos_detalles_notas_credito_servicio_servicio').html(0);
		$('#txtNumDetalles_notas_credito_servicio_servicio').html('');
		//Eliminar los datos de la tabla CFDI´s relacionados
	    $('#dg_cfdi_relacionados_notas_credito_servicio_servicio tbody').empty();
		$('#numElementos_cfdi_relacionados_notas_credito_servicio_servicio').html(0);
		$('#txtNumCfdiRelacionados_notas_credito_servicio_servicio').val('');

		//Crear instancia del objeto Detalles de la nota de crédito
		objDetallesNotaNotasCreditoServicioServicio = new DetallesNotaNotasCreditoServicioServicio([]);
		
	}



	//Función que se utiliza para cerrar el modal
	function cerrar_notas_credito_servicio_servicio()
	{
		try {

			//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
			cerrar_cancelacion_notas_credito_servicio_servicio();
			//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			cerrar_cliente_notas_credito_servicio_servicio();
			//Hacer un llamado a la función para cerrar modal Relacionar CFDI
			cerrar_relacionar_cfdi_notas_credito_servicio_servicio();
			//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
       		ocultar_circulo_carga_notas_credito_servicio_servicio('');
			//Cerrar modal
			objNotasCreditoServicioServicio.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_notas_credito_servicio_servicio').focus();	
		}
		catch(err) {}
	}

	
	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_notas_credito_servicio_servicio()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_notas_credito_servicio_servicio();
		//Validación del formulario de campos obligatorios
		$('#frmNotasCreditoServicioServicio')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_notas_credito_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
									    strFacturaServicio_notas_credito_servicio_servicio: {
											validators: {
											    callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la factura
					                                    if( $('#txtFacturaServicioID_notas_credito_servicio_servicio').val() === '')
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
										strFormaPago_notas_credito_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la forma de pago
					                                    if($('#txtFormaPagoID_notas_credito_servicio_servicio').val() === '')
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
										strMetodoPago_notas_credito_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del método de pago
					                                    if($('#txtMetodoPagoID_notas_credito_servicio_servicio').val() === '')
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
										intExportacionID_notas_credito_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una exportación'}
											}
										},
										strUsoCfdi_notas_credito_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del uso de CFDI
					                                    if($('#txtUsoCfdiID_notas_credito_servicio_servicio').val() === '')
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
										strTipoRelacion_notas_credito_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if(($('#txtTipoRelacionID_notas_credito_servicio_servicio').val() === '') 
					                                    	|| ($('#txtTipoRelacionID_notas_credito_servicio_servicio').val() === '' && parseInt($('#txtNumCfdiRelacionados_notas_credito_servicio_servicio').val()) > 0))
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
										intNumCfdiRelacionados_notas_credito_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan CFDI relacionados
					                                    if(parseInt($('#txtTipoRelacionID_notas_credito_servicio_servicio').val()) > 0 &&
					                                    	(parseInt(value) === 0 || value === ''))
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un CFDI para esta nota de crédito.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intNumDetalles_notas_credito_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta nota de crédito.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strConcepto_detalles_notas_credito_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Escriba un concepto'}
											}
										}, 
										strObjetoImpuesto_detalles_notas_credito_servicio_servicio: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista código del objeto de impuesto
					                                    if($('#txtObjetoImpuestoSat_detalles_notas_credito_servicio_servicio').val() === '')
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
										}
									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_notas_credito_servicio_servicio = $('#frmNotasCreditoServicioServicio').data('bootstrapValidator');
		bootstrapValidator_notas_credito_servicio_servicio.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_notas_credito_servicio_servicio.isValid())
		{	
			//Hacer un llamado a la función para guardar los datos del registro
			guardar_notas_credito_servicio_servicio();			
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_notas_credito_servicio_servicio()
	{
		try
		{
			$('#frmNotasCreditoServicioServicio').data('bootstrapValidator').resetForm();

		}
		catch(err) {}
	}

	
	//Función para guardar o modificar los datos de un registro
	function guardar_notas_credito_servicio_servicio()
	{		
		//Obtenemos el objeto de la tabla CFDI relacionados
		var objTabla = document.getElementById('dg_cfdi_relacionados_notas_credito_servicio_servicio').getElementsByTagName('tbody')[0];

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


		//Hacer un llamado a la función JSON para guardar los detalles de la nota de crédito
	    var jsonDetalles = JSON.stringify(objDetallesNotaNotasCreditoServicioServicio); 

		//Hacer un llamado al método del controlador para guardar los datos del registro	
		$.post('servicio/notas_credito_servicio/guardar',
		{ 
			//Datos de la nota de crédito
			intNotaCreditoServicioID: $('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val(),
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			dteFecha: $.formatFechaMysql($('#txtFecha_notas_credito_servicio_servicio').val()),
			intMonedaID: $('#txtMonedaID_notas_credito_servicio_servicio').val(),
			intTipoCambio: $('#txtTipoCambio_notas_credito_servicio_servicio').val(),
			intOrdenReparacionID: $('#txtOrdenReparacionID_notas_credito_servicio_servicio').val(),
			intFacturaServicioID: $('#txtFacturaServicioID_notas_credito_servicio_servicio').val(),
			intProspectoID: $('#txtProspectoID_notas_credito_servicio_servicio').val(),
			strRazonSocial: $('#txtRazonSocial_notas_credito_servicio_servicio').val(),
			strRfc: $('#txtRfc_notas_credito_servicio_servicio').val(),
			intRegimenFiscalID: $('#txtRegimenFiscalID_notas_credito_servicio_servicio').val(),
			intRegimenFiscalIDAnterior: $('#txtRegimenFiscalIDAnterior_notas_credito_servicio_servicio').val(),
			strCalle: $('#txtCalle_notas_credito_servicio_servicio').val(),
			strNumeroExterior: $('#txtNumeroExterior_notas_credito_servicio_servicio').val(),
			strNumeroInterior: $('#txtNumeroInterior_notas_credito_servicio_servicio').val(),
			strCodigoPostal: $('#txtCodigoPostal_notas_credito_servicio_servicio').val(),
			strColonia: $('#txtColonia_notas_credito_servicio_servicio').val(),
			strLocalidad: $('#txtLocalidad_notas_credito_servicio_servicio').val(),
			strMunicipio: $('#txtMunicipio_notas_credito_servicio_servicio').val(),
			strEstado: $('#txtEstado_notas_credito_servicio_servicio').val(),
			strPais: $('#txtPais_notas_credito_servicio_servicio').val(),
			intFormaPagoID: $('#txtFormaPagoID_notas_credito_servicio_servicio').val(),
			intMetodoPagoID: $('#txtMetodoPagoID_notas_credito_servicio_servicio').val(),
			intUsoCfdiID: $('#txtUsoCfdiID_notas_credito_servicio_servicio').val(),
			intTipoRelacionID: $('#txtTipoRelacionID_notas_credito_servicio_servicio').val(),
			intExportacionID: $('#cmbExportacionID_notas_credito_servicio_servicio').val(),
			strObservaciones: $('#txtObservaciones_notas_credito_servicio_servicio').val(),
			intProcesoMenuID: $('#txtProcesoMenuID_notas_credito_servicio_servicio').val(),
			//Datos de los detalles
			strConcepto: $('#txtConcepto_detalles_notas_credito_servicio_servicio').val(),
			strObjetoImpuestoSat: $('#txtObjetoImpuestoSat_detalles_notas_credito_servicio_servicio').val(),
			arrDetalles: jsonDetalles,
			//Datos de los CFDI relacionados	
			strCfdiRelacionado: arrCfdiRelacionado.join('|'),
			strTiposRelacion: arrTiposRelacion.join('|')

		},
		function(data) {

			if (data.resultado)
			{	
				//Si no existe id de la nota de crédito, significa que es un nuevo registro   
				if($('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val() == '')
				{
				  	//Asignar el id de la nota de crédito registrada en la base de datos
         			$('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val(data.nota_credito_servicio_id);
     			}
     			
     			//Hacer llamado a la función para cargar  los registros en el grid
				paginacion_notas_credito_servicio_servicio();

				//Hacer un llamado a la función para timbrar los datos del registro
				timbrar_notas_credito_servicio_servicio($('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val(), 'modal', '', $('#txtRegimenFiscalID_notas_credito_servicio_servicio').val());	

				//Si no existe id de la póliza (o se trata de un nuevo registro)
				if(parseInt($('#txtPolizaID_notas_credito_servicio_servicio').val()) == 0 || 
					$('#txtEstatus_notas_credito_servicio_servicio').val() == '')
				{
					//Hacer un llamado a la función para generar póliza con los datos del registro
					 generar_poliza_notas_credito_servicio_servicio('', '', '');

				}

			}

			//Si existe mensaje de error
			if(data.tipo_mensaje == 'error')
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_notas_credito_servicio_servicio(data.tipo_mensaje, data.mensaje);
			}


		},
		'json');
		
	}


	//Función para generar póliza con los datos de un registro
	function generar_poliza_notas_credito_servicio_servicio(id, estatus, formulario)
	{

		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val();
		}
		else
		{
			intID = id;
		}

		//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
		mostrar_circulo_carga_notas_credito_servicio_servicio(formulario);
		//Hacer un llamado al método del controlador para timbrar los datos del registro
		$.post('contabilidad/generar_polizas/generar_poliza',
	     {
	     	intReferenciaID: intID,
	      	strTipoReferencia: strTipoReferenciaPolizaNotasCreditoServicioServicio, 
	      	intProcesoMenuID: $('#txtProcesoMenuID_notas_credito_servicio_servicio').val()
	     },
	     function(data) {

	     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		    ocultar_circulo_carga_notas_credito_servicio_servicio(formulario);
		    //Si existe resultado
			if (data.resultado)
			{
			    //Asignar el id de la póliza (generada) y evitar duplicidad de datos en caso de que no sea posible timbrar el registro
                $('#txtPolizaID_notas_credito_servicio_servicio').val(data.poliza_id);
				//Hacer llamado a la función para cargar  los registros en el grid
				paginacion_notas_credito_servicio_servicio();
				
			}

			//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			mensaje_notas_credito_servicio_servicio(data.tipo_mensaje, data.mensaje);

	     },
	     'json');
	}


	//Función para timbrar los datos de un registro
		function timbrar_notas_credito_servicio_servicio(id, tipo, formulario, regimenFiscalID)
		{

			//Si existe id del régimen fiscal
			if(regimenFiscalID > 0)
			{

				//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
				mostrar_circulo_carga_notas_credito_servicio_servicio(formulario);
				//Hacer un llamado al método del controlador para timbrar los datos del registro
				$.post('contabilidad/timbradoV4/set_timbrar',
			     {
			     	intReferenciaID: id,
			      	strTipoReferencia: strTipoReferenciaNotasCreditoServicioServicio
			     },
			     function(data) {
					//Si el id del registro se obtuvo del modal
					if(tipo == 'modal')
					{
						//Si existe resultado (los datos se timbraron correctamente)
						if (data.resultado)
						{

							//Hacer un llamado a la función para cerrar modal
							cerrar_notas_credito_servicio_servicio();  
						}
						else
						{
							//Hacer un llamado a la función para limpiar los mensajes de error 
							limpiar_mensajes_notas_credito_servicio_servicio();
							//Hacer un llamado a la función para cargar datos del registro (habilitar campos de timbrado)
							editar_notas_credito_servicio_servicio(id,'Nuevo');

						}
					}

					//Hacer llamado a la función para cargar  los registros en el grid
				    paginacion_notas_credito_servicio_servicio();
					//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		            ocultar_circulo_carga_notas_credito_servicio_servicio(formulario);
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_notas_credito_servicio_servicio(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

			}
			else
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				 mensaje_notas_credito_servicio_servicio('error_regimen_fiscal');
			}

		}


	
	//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
	//al momento de timbrar un registro
	function mostrar_circulo_carga_notas_credito_servicio_servicio(formulario)
	{
		//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
		var strCampoID = 'divCirculoBarProgreso_notas_credito_servicio_servicio';

		//Si el Div a mostrar se encuentra en el formulario principal
		if(formulario == 'principal')
		{
			strCampoID = 'divCirculoBarProgresoPrincipal_notas_credito_servicio_servicio';
		}

		//Remover clase para mostrar div que contiene la barra de carga
		$("#"+strCampoID).removeClass('no-mostrar');
	}

	//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
	//al momento de timbrar un registro
	function ocultar_circulo_carga_notas_credito_servicio_servicio(formulario)
	{
		//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
		var strCampoID = 'divCirculoBarProgreso_notas_credito_servicio_servicio';

		//Si el Div a ocultar se encuentra en el formulario principal
		if(formulario == 'principal')
		{
			strCampoID = 'divCirculoBarProgresoPrincipal_notas_credito_servicio_servicio';
		}

		//Agregar clase para ocultar div que contiene la barra de carga
		$("#"+strCampoID).addClass('no-mostrar');
	}


	//Función para mostrar mensaje de éxito o error
	function mensaje_notas_credito_servicio_servicio(tipoMensaje, mensaje, campoID)
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
				new $.Zebra_Dialog(strMsjRegimenFiscalCteNotasCreditoServicioServicio, 
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
	function cambiar_estatus_notas_credito_servicio_servicio(id, folio, polizaID, folioPoliza)
	{
		//Variable que se utiliza para asignar el id de la nota de crédito
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
			intID = $('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val();
			strFolio = $('#txtFolio_notas_credito_servicio_servicio').val();
			intPolizaID = $('#txtPolizaID_notas_credito_servicio_servicio').val();
			strFolioPoliza = $('#txtFolioPoliza_notas_credito_servicio_servicio').val();
		}
		else
		{
			intID = id;
			strFolio = folio;
			intPolizaID = polizaID;
			strFolioPoliza = folioPoliza;
		}

	   
		//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea cancelar el registro; también se desactivara la póliza con folio: '+strFolioPoliza+'?</strong>',
				             {'type':     'question',
				              'title':    'Notas de Crédito',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                               //Hacer un llamado a la función para abrir el modal Cancelación del timbrado (cambiar estatus y cancelar timbrado del registro)
					                           abrir_cancelacion_notas_credito_servicio_servicio(intID, strFolio, intPolizaID);
				                            }
				                          }
				              });
	}


	//Función para cancelar el timbrado de un registro. Cambia el estatus a INACTIVO
	function cancelar_timbrado_notas_credito_servicio_servicio()
	{

		//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
		mostrar_circulo_carga_cancelacion_notas_credito_servicio_servicio();
		 //Hacer un llamado al método del controlador para cancelar un CFDI y posteriormente cambiar el estatus a INACTIVO
         //----- CÓDIGO PARA PRODUCCIÓN
          $.post('contabilidad/timbrado_cancelar/set_cancelar',
          {
          		//Datos para cancelar el timbrado (CFDI)
         		intMovimientoID: $('#txtReferenciaCfdiID_cancelacion_notas_credito_servicio_servicio').val(),
				strTipoReferencia: strTipoReferenciaNotasCreditoServicioServicio, 
				strUuidSustitucion: $('#txtUuidSustitucion_cancelacion_notas_credito_servicio_servicio').val(),
				strMotivo: $('select[name="intCancelacionMotivoID_notas_credito_servicio_servicio"] option:selected').text(),
				//Datos para cambiar (administrativamente) el estatus del registro
				intCancelacionMotivoID: $('#cmbCancelacionMotivoID_cancelacion_notas_credito_servicio_servicio').val(), 
				intSustitucionID:  $('#txtSustitucionID_cancelacion_notas_credito_servicio_servicio').val(),
				intPolizaID: $('#txtPolizaID_cancelacion_notas_credito_servicio_servicio').val()
          },
                 function(data) {

                    if(data.resultado)
                    {
						//Hacer llamado a la función  para cargar los registros en el grid
						paginacion_notas_credito_servicio_servicio();	

						//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
						cerrar_cancelacion_notas_credito_servicio_servicio();  

						//Si el id del registro se obtuvo del modal
						if($('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val() != '')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_notas_credito_servicio_servicio();     
						}		
                    }

                    //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			        ocultar_circulo_carga_cancelacion_notas_credito_servicio_servicio();
				    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_notas_credito_servicio_servicio(data.tipo_mensaje, data.mensaje);


                 },
                'json');

	}



	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_notas_credito_servicio_servicio(id, tipoAccion, cancelacionID)
	{	
		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('servicio/notas_credito_servicio/get_datos',
		       {
		       		intNotaCreditoServicioID:id
		       },
		       function(data) {
	
		        	//Si hay datos del registro 
		            if(data.row)
		            {  

		            	//Hacer un llamado a la función para limpiar los campos del formulario
						nuevo_notas_credito_servicio_servicio();
						//Asignar estatus del registro
				        var strEstatus = data.row.estatus;
			           //Asignar el id de la póliza
			            var intPolizaID = parseInt(data.row.poliza_id); 
			          	
			          	//Recuperar valores
			            $('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val(data.row.nota_credito_servicio_id);
			            $('#txtFolio_notas_credito_servicio_servicio').val(data.row.folio);
			            $('#txtFecha_notas_credito_servicio_servicio').val(data.row.fecha_format);
			            $('#txtMonedaID_notas_credito_servicio_servicio').val(data.row.moneda_id);
			            $('#txtMoneda_notas_credito_servicio_servicio').val(data.row.moneda);
			            $('#txtTipoCambio_notas_credito_servicio_servicio').val(data.row.tipo_cambio);
			            $('#txtFacturaServicioID_notas_credito_servicio_servicio').val(data.row.factura_servicio_id);
			            $('#txtFacturaServicio_notas_credito_servicio_servicio').val(data.row.folio_factura);
			            $('#txtOrdenReparacionID_notas_credito_servicio_servicio').val(data.row.orden_reparacion_id);
			            $('#txtProspectoID_notas_credito_servicio_servicio').val(data.row.prospecto_id);
					    $('#txtRazonSocial_notas_credito_servicio_servicio').val(data.row.razon_social);
					    $('#txtRfc_notas_credito_servicio_servicio').val(data.row.rfc);
					    $('#txtRegimenFiscalID_notas_credito_servicio_servicio').val(data.row.regimen_fiscal_id);
						$('#txtRegimenFiscalIDAnterior_notas_credito_servicio_servicio').val(data.row.regimenFiscalAnterior);
					    $('#txtCalle_notas_credito_servicio_servicio').val(data.row.calle);
					    $('#txtNumeroExterior_notas_credito_servicio_servicio').val(data.row.numero_exterior);
					    $('#txtNumeroInterior_notas_credito_servicio_servicio').val(data.row.numero_interior);
					    $('#txtCodigoPostal_notas_credito_servicio_servicio').val(data.row.codigo_postal);
					    $('#txtColonia_notas_credito_servicio_servicio').val(data.row.colonia);
					    $('#txtLocalidad_notas_credito_servicio_servicio').val(data.row.localidad);
					    $('#txtMunicipio_notas_credito_servicio_servicio').val(data.row.municipio);
					    $('#txtEstado_notas_credito_servicio_servicio').val(data.row.estado);
					    $('#txtPais_notas_credito_servicio_servicio').val(data.row.pais);
					    $('#txtGastosServicio_notas_credito_servicio_servicio').val(data.row.gastos_servicio);
						$('#txtGastosServicioIva_notas_credito_servicio_servicio').val(data.row.gastos_servicio_iva);
						$('#txtFormaPagoID_notas_credito_servicio_servicio').val(data.row.forma_pago_id);
				    	$('#txtFormaPago_notas_credito_servicio_servicio').val(data.row.forma_pago);
				    	$('#txtMetodoPagoID_notas_credito_servicio_servicio').val(data.row.metodo_pago_id);
				    	$('#txtMetodoPago_notas_credito_servicio_servicio').val(data.row.metodo_pago);
				    	$('#txtUsoCfdiID_notas_credito_servicio_servicio').val(data.row.uso_cfdi_id);
				    	$('#txtUsoCfdi_notas_credito_servicio_servicio').val(data.row.uso_cfdi);
				    	$('#txtTipoRelacionID_notas_credito_servicio_servicio').val(data.row.tipo_relacion_id);
				    	$('#txtTipoRelacion_notas_credito_servicio_servicio').val(data.row.tipo_relacion);
				    	$('#cmbExportacionID_notas_credito_servicio_servicio').val(data.row.exportacion_id);
				    	$('#txtObservaciones_notas_credito_servicio_servicio').val(data.row.observaciones);
				    	$('#txtConcepto_detalles_notas_credito_servicio_servicio').val(data.concepto);
				    	$('#txtObjetoImpuestoSat_detalles_notas_credito_servicio_servicio').val(data.objeto_impuesto_sat);
				        $('#txtObjetoImpuesto_detalles_notas_credito_servicio_servicio').val(data.objeto_impuesto);
				    	$('#txtPolizaID_notas_credito_servicio_servicio').val(intPolizaID);
						$('#txtFolioPoliza_notas_credito_servicio_servicio').val(data.row.folio_poliza);
						//Dependiendo del estatus cambiar el color del encabezado 
			            $('#divEncabezadoModal_notas_credito_servicio_servicio').addClass("estatus-"+ strEstatus);
			            $('#txtEstatus_notas_credito_servicio_servicio').val(strEstatus);
			            //Mostrar botón Imprimir  
			            $("#btnImprimirRegistro_notas_credito_servicio_servicio").show();
			            //Deshabilitar factura de servicio
					    $('#txtFacturaServicio_notas_credito_servicio_servicio').attr("disabled", "disabled");
   						
   						//Si existe archivo del registro
			           	if(data.archivo != '')
			           	{
			           		//Mostrar botón Descargar Archivo
			            	$("#btnDescargarArchivo_notas_credito_servicio_servicio").show();
			           	}


			            //Si el estatus del registro es TIMBRAR y no existe póliza
			           	if (strEstatus == 'TIMBRAR' && intPolizaID > 0)
			            {
			            	//Hacer un llamado a la función para habilitar campos de timbrado
			            	habilitar_controles_timbrado_notas_credito_servicio_servicio();
			            }
			            else if(strEstatus != 'TIMBRAR')//Si el estatus del registro es diferente de TIMBRAR
						{
							//Deshabilitar todos los elementos del formulario
			            	$('#frmNotasCreditoServicioServicio').find('input, textarea, select').attr('disabled','disabled');

			            	//Si el estatus del registro es ACTIVO
							if(strEstatus == 'ACTIVO')
							{
								//Mostrar los siguientes botones
			            		$("#btnEnviarCorreo_notas_credito_servicio_servicio").show();

			            		//Si existe el id de la póliza
				            	if(intPolizaID > 0)
				            	{
				            		$('#btnDesactivar_notas_credito_servicio_servicio').show();
				            	}
							}

			            	//Ocultar los siguientes botones
				            $("#btnReiniciar_notas_credito_servicio_servicio").hide();
							$("#btnGuardar_notas_credito_servicio_servicio").hide();
							$("#btnBuscarCFDI_notas_credito_servicio_servicio").hide(); 

							//Si existe id de la cancelación del CFDI
							if(cancelacionID > 0)
							{	
								//Asignar el id de la cancelación
								$("#txtCancelacionID_notas_credito_servicio_servicio").val(cancelacionID); 
								//Mostrar botón Motivo de cancelación
								$("#btnVerMotivoCancelacion_notas_credito_servicio_servicio").show(); 
							}
						}

						
						//Agregar datos a los array's del objeto Detalles de la factura
	              		objDetallesFraNotasCreditoServicioServicio.setServicios(data.mano_obra);
	              		objDetallesFraNotasCreditoServicioServicio.setRefacciones(data.refacciones);
	              		objDetallesFraNotasCreditoServicioServicio.setTrabajosForaneos(data.trabajos_foraneos);
	              		objDetallesFraNotasCreditoServicioServicio.setOtros(data.otros);
	              	    //Hacer llamado a la función  para cargar los acumulados del registro en el grid
			    		agregar_renglones_acumulados_factura_notas_credito_servicio_servicio();

			    		//Agregar datos al array del objeto Detalles de la nota de crédito
						objDetallesNotaNotasCreditoServicioServicio.setDetalles(data.detalles);	
			    		
						//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
			            agregar_cfdi_relacionados_notas_credito_servicio_servicio('Editar', strEstatus);

			            //Si el tipo de acción es diferente de Nuevo
			            if(tipoAccion != 'Nuevo')
			            {
			            	//Abrir modal
				            objNotasCreditoServicioServicio = $('#NotasCreditoServicioServicioBox').bPopup({
											   appendTo: '#NotasCreditoServicioServicioContent', 
				                               contentContainer: 'NotasCreditoServicioServicioM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
					    }

			            //Enfocar caja de texto
						$('#txtFecha_notas_credito_servicio_servicio').focus();

		       	    }
		       	    
		       },
		       'json');
	}


	//Función para habilitar controles del formulario correspondientes al timbrado
	function habilitar_controles_timbrado_notas_credito_servicio_servicio()
	{
		//Deshabilitar todos los elementos del formulario
    	$('#frmNotasCreditoServicioServicio').find('input, textarea, select').attr('disabled','disabled');
    	//Habilitar las siguientes cajas de texto
    	$('#txtFormaPago_notas_credito_servicio_servicio').removeAttr('disabled');
    	$('#txtMetodoPago_notas_credito_servicio_servicio').removeAttr('disabled');
    	$('#txtUsoCfdi_notas_credito_servicio_servicio').removeAttr('disabled');
    	$('#txtTipoRelacion_notas_credito_servicio_servicio').removeAttr('disabled');
    	$('#cmbExportacionID_notas_credito_servicio_servicio').removeAttr('disabled');
    	$('#txtObjetoImpuesto_detalles_notas_credito_servicio_servicio').removeAttr('disabled');
    	$('#txtObservaciones_notas_credito_servicio_servicio').removeAttr('disabled');
	}

	//Función para regresar y obtener los datos de una factura
	function get_datos_factura_notas_credito_servicio_servicio()
	{
		//Hacer un llamado al método del controlador para regresar los datos de la factura
		$.post('servicio/facturas_servicio/get_datos',
		       {
		       		intFacturaServicioID:$("#txtFacturaServicioID_notas_credito_servicio_servicio").val()
		       },
		       function(data) {
		        	//Si hay datos del registro
		            if(data.row)
		            {

			          	//Recuperar valores
			            $('#txtMonedaID_notas_credito_servicio_servicio').val(data.row.moneda_id);
			            $('#txtMoneda_notas_credito_servicio_servicio').val(data.row.moneda);
			            $('#txtTipoCambio_notas_credito_servicio_servicio').val(data.row.tipo_cambio);
			            $('#txtOrdenReparacionID_notas_credito_servicio_servicio').val(data.row.orden_reparacion_id);
			            $('#txtProspectoID_notas_credito_servicio_servicio').val(data.row.prospecto_id);
					    $('#txtRazonSocial_notas_credito_servicio_servicio').val(data.row.razon_social);
					    $('#txtRfc_notas_credito_servicio_servicio').val(data.row.rfc);
					    $('#txtRegimenFiscalID_notas_credito_servicio_servicio').val(data.row.regimen_fiscal_id);
		    			$("#txtRegimenFiscalIDAnterior_notas_credito_servicio_servicio").val(data.row.regimenFiscalAnterior);
					    $('#txtCalle_notas_credito_servicio_servicio').val(data.row.calle);
					    $('#txtNumeroExterior_notas_credito_servicio_servicio').val(data.row.numero_exterior);
					    $('#txtNumeroInterior_notas_credito_servicio_servicio').val(data.row.numero_interior);
					    $('#txtCodigoPostal_notas_credito_servicio_servicio').val(data.row.codigo_postal);
					    $('#txtColonia_notas_credito_servicio_servicio').val(data.row.colonia);
					    $('#txtLocalidad_notas_credito_servicio_servicio').val(data.row.localidad);
					    $('#txtMunicipio_notas_credito_servicio_servicio').val(data.row.municipio);
					    $('#txtEstado_notas_credito_servicio_servicio').val(data.row.estado);
					    $('#txtPais_notas_credito_servicio_servicio').val(data.row.pais);
					    $('#txtGastosServicio_notas_credito_servicio_servicio').val(data.row.gastos_servicio);
						$('#txtGastosServicioIva_notas_credito_servicio_servicio').val(data.row.gastos_servicio_iva);
						$('#txtFormaPagoID_notas_credito_servicio_servicio').val(data.row.forma_pago_id);
				    	$('#txtFormaPago_notas_credito_servicio_servicio').val(data.row.forma_pago);
				    	$('#txtMetodoPagoID_notas_credito_servicio_servicio').val(data.row.metodo_pago_id);
				    	$('#txtMetodoPago_notas_credito_servicio_servicio').val(data.row.metodo_pago);
				    	$('#txtUsoCfdiID_notas_credito_servicio_servicio').val(data.row.uso_cfdi_id);
				    	$('#txtUsoCfdi_notas_credito_servicio_servicio').val(data.row.uso_cfdi);

						//Agregar datos a los array's del objeto Detalles de la factura
	              		objDetallesFraNotasCreditoServicioServicio.setServicios(data.mano_obra);
	              		objDetallesFraNotasCreditoServicioServicio.setRefacciones(data.refacciones);
	              		objDetallesFraNotasCreditoServicioServicio.setTrabajosForaneos(data.trabajos_foraneos);
	              		objDetallesFraNotasCreditoServicioServicio.setOtros(data.otros);
	              	    //Hacer llamado a la función  para cargar los acumulados del registro en el grid
			    		agregar_renglones_acumulados_factura_notas_credito_servicio_servicio();
			    		//Hacer llamado a la función  para obtener los importes la factura por tasa
			    		get_tasas_factura_notas_credito_servicio_servicio();


			    		//Crear instancia del objeto CFDI´s relacionados (facturas seleccionadas)
						objCfdisRelacionadosNotasCreditoServicioServicio = new CfdisRelacionadosNotasCreditoServicioServicio([]);

						//Crear instancia del objeto CFDI a relacionar
						objCfdiRelacionarNotasCreditoServicioServicio = new CfdiRelacionarNotasCreditoServicioServicio(null, '', '', '', '', '', '');

						//Asignar datos al objeto
						objCfdiRelacionarNotasCreditoServicioServicio.intReferenciaID = $('#txtFacturaServicioID_notas_credito_servicio_servicio').val();
						objCfdiRelacionarNotasCreditoServicioServicio.strCliente = data.row.razon_social;
						objCfdiRelacionarNotasCreditoServicioServicio.strFolio = data.row.folio;
						objCfdiRelacionarNotasCreditoServicioServicio.dteFecha = data.row.fecha_format;
						objCfdiRelacionarNotasCreditoServicioServicio.strTipoReferencia =  'FACTURA SERVICIO';
						objCfdiRelacionarNotasCreditoServicioServicio.strUuid =  data.row.uuid;
						objCfdiRelacionarNotasCreditoServicioServicio.intImporte = $('#txtImporteFacturaServicio_notas_credito_servicio_servicio').val();
						
						//Agregar datos del cfdi a relacionar
			            objCfdisRelacionadosNotasCreditoServicioServicio.setCfdi(objCfdiRelacionarNotasCreditoServicioServicio);
			                					    
						//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
					  	agregar_cfdi_relacionados_notas_credito_servicio_servicio('Nuevo', 'ACTIVO');	

		       	    }
		       	   
					
		       },
		       'json');
	}

	//Función para regresar y obtener los importes de la factur por tasa
	function get_tasas_factura_notas_credito_servicio_servicio()
	{
		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('caja/pagos/get_tasas_factura',
					{	
						intReferenciaID: $('#txtFacturaServicioID_notas_credito_servicio_servicio').val(), 
						strTipoReferencia: 'SERVICIO',
						intTipoCambioFra: $('#txtTipoCambio_notas_credito_servicio_servicio').val()
					},
					function(data){
						//Si existen registros
						if(data.rows)
						{
							//Agregar datos al array del objeto Detalles de la nota de crédito
							objDetallesNotaNotasCreditoServicioServicio.setDetalles(data.rows);	
						}
						
					},
			'json');
	}

	
	/*******************************************************************************************************************
	Funciones de la tabla detalles
	*********************************************************************************************************************/	
	//Regresar el impuesto de objeto base
	function cargar_objeto_impuesto_base_notas_credito_servicio_servicio()
	{
		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.ajax({
		        url: 'contabilidad/sat_objeto_impuesto/get_datos',
		        method:'post',
		        dataType: 'json',
		        async: false,
		        data: {
		        	strBusqueda:intObjetoImpuestoBaseIDNotasCreditoServicioServicio,
		       		strTipo: 'id'
		        },
		        success: function (data) {
		          	//Si no se encuentra código 
		        	if(data.row)
		        	{
		        		//Recuperar valores
			            $('#txtObjetoImpuestoSat_detalles_notas_credito_servicio_servicio').val(data.row.codigo);
			            $('#txtObjetoImpuesto_detalles_notas_credito_servicio_servicio').val(data.row.codigo+' - '+data.row.descripcion);

		        	}
		        }
		    });
	}

	//Función para agregar renglones de los detalles acumulados a la tabla
	function agregar_renglones_acumulados_factura_notas_credito_servicio_servicio() 
	{
		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_notas_credito_servicio_servicio();
		//Variable que se utiliza para asignar la moneda de la factura
		var intMonedaIDFactura =  parseInt($("#txtMonedaID_notas_credito_servicio_servicio").val());
		//Variable que se utiliza para asignar el tipo de cambio de la factura
		var intTipoCambioFactura =  parseFloat($("#txtTipoCambio_notas_credito_servicio_servicio").val());

		//Si existe tipo de cambio
		if(intTipoCambioFactura > 0)
		{
			//Variables que se utilizan para asignar acumulados generales
			var strDescripcion = '';
			var intAcumPrecio = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Variables que se utilizan para asignar acumulados de los servicios de mano de obra
			var intAcumPrecioMO = 0;
			var intAcumDescuentoMO = 0;
			var intAcumSubtotalMO = 0;
			var intAcumIvaMO = 0;
			var intAcumIepsMO = 0;
			var intAcumTotalMO = 0;

		    //Variables que se utilizan para asignar acumulados de las refacciones
			var intAcumPrecioRef = 0;
			var intAcumDescuentoRef = 0;
			var intAcumSubtotalRef = 0;
			var intAcumIvaRef = 0;
			var intAcumIepsRef = 0;
			var intAcumTotalRef = 0;

			//Variables que se utilizan para asignar acumulados de los trabajos foráneos
			var intAcumPrecioTF = 0;
			var intAcumDescuentoTF = 0;
			var intAcumSubtotalTF = 0;
			var intAcumIvaTF = 0;
			var intAcumIepsTF = 0;
			var intAcumTotalTF = 0;

			//Variables que se utilizan para asignar acumulados de otros servicios
			var intAcumPrecioOtros = 0;
			var intAcumDescuentoOtros = 0;
			var intAcumSubtotalOtros = 0;
			var intAcumIvaOtros = 0;
			var intAcumIepsOtros = 0;
			var intAcumTotalOtros = 0;

			/*
			*****************************************************************************************************************
			* GASTOS DE SERVICIO
			*****************************************************************************************************************
			*/
			//Variables que se utilizan para asignar el gasto de servicio
			var intGastosServicioSubtotal = parseFloat($("#txtGastosServicio_notas_credito_servicio_servicio").val());
			var intGastosServicioIva = parseFloat($("#txtGastosServicioIva_notas_credito_servicio_servicio").val());
			var intGastosServicioTotal = 0;

			//Si el tipo de moneda de la factura no corresponde a peso mexicano
			if(intMonedaIDFactura !== intMonedaBaseIDNotasCreditoServicioServicio)
			{
				//Convertir peso mexicano a tipo de cambio
				intGastosServicioSubtotal = intGastosServicioSubtotal / intTipoCambioFactura;
				intGastosServicioIva = intGastosServicioIva / intTipoCambioFactura;
				intGastosServicioTotal = intGastosServicioTotal / intTipoCambioFactura;

			    //Redondear cantidad a decimales
				intGastosServicioSubtotal = intGastosServicioSubtotal.toFixed(2);
				intGastosServicioSubtotal = parseFloat(intGastosServicioSubtotal);

				//Redondear cantidad a dos decimales
			    intGastosServicioIva = intGastosServicioIva.toFixed(4);
			    intGastosServicioIva = parseFloat(intGastosServicioIva);
			}

			//Calcular el total del gasto de servicio
			intGastosServicioTotal = intGastosServicioSubtotal + intGastosServicioIva;

			
    		/*
			*****************************************************************************************************************
			* MANO DE OBRA
			*****************************************************************************************************************
			*/
			//Hacer recorrido para obtener los detalles de mano de obra
		    for (var intCon in objDetallesFraNotasCreditoServicioServicio.getServicios()) 
		    {
		    	//Crear instancia temporal del objeto Detalles de la orden de reparación (o factura) consultada
				objServicioDetalleNotasCreditoServicioServicio = new DetallesFraNotasCreditoServicioServicio();
				//Asignar datos del detalle de mano de obra corespondiente al indice
            	objServicioDetalleNotasCreditoServicioServicio = objDetallesFraNotasCreditoServicioServicio.getServicio(intCon);
		    	
		    	//Variables que se utilizan para asignar valores del detalle
		    	var intTasaCuotaIeps = objServicioDetalleNotasCreditoServicioServicio.tasa_cuota_ieps;
	        	var intPorcentajeIva = objServicioDetalleNotasCreditoServicioServicio.porcentaje_iva;
	        	var intPorcentajeIeps = objServicioDetalleNotasCreditoServicioServicio.porcentaje_ieps;

	        	//Variable que se utiliza para asignar el importe de iva
				var intImporteIva = 0;
	        	//Variable que se utiliza para asignar el iva unitario
				var intIvaUnitario = 0;
				//Variable que se utiliza para asignar el importe de ieps
				var intImporteIeps = 0;
				//Variable que se utiliza para asignar el ieps unitario
				var intIepsUnitario = 0;
				//Variable que se utiliza para asignar el descuento unitario
			    var intDescuentoUnitario = 0;
	       		//Variable que se utiliza para asignar el precio unitario
	        	var intPrecioUnitario = 0;
	        	//Variable que se utiliza para asignar el subtotal 
				var intSubtotal = 0;

				//Asignar precio unitario
			    intPrecioUnitario = parseFloat(objServicioDetalleNotasCreditoServicioServicio.precio_unitario);
			    //Convertir peso mexicano a tipo de cambio
				intPrecioUnitario = intPrecioUnitario / intTipoCambioFactura;
				

	        	//Redondear cantidad a decimales
				intPrecioUnitario = intPrecioUnitario.toFixed(2);
				intPrecioUnitario = parseFloat(intPrecioUnitario);
				//Asignar precio unitario
				intSubtotal = intPrecioUnitario;

				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

				//Redondear cantidad a dos decimales
			    intImporteIva = intImporteIva.toFixed(4);
			    intImporteIva = parseFloat(intImporteIva);

				//Si existe id de la tasa de cuota del IEPS
				if(intTasaCuotaIeps > 0)
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
					//Redondear cantidad a dos decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(4);
			   	 	intImporteIeps = parseFloat(intImporteIeps);
				}

				//Si el tipo de moneda de la factura no corresponde a peso mexicano
				if(intMonedaIDFactura !== intMonedaBaseIDNotasCreditoServicioServicio)
				{
					//Convertir peso mexicano a tipo de cambio
					intSubtotal = intSubtotal / intTipoCambioFactura;
					intImporteIva = intImporteIva / intTipoCambioFactura;
					intImporteIeps = intImporteIeps / intTipoCambioFactura;

				    //Redondear cantidad a decimales
					intSubtotal = intSubtotal.toFixed(2);
					intSubtotal = parseFloat(intSubtotal);

					//Redondear cantidad a dos decimales
				    intImporteIva = intImporteIva.toFixed(4);
				    intImporteIva = parseFloat(intImporteIva);

				    //Redondear cantidad a dos decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(4);
			   	 	intImporteIeps = parseFloat(intImporteIeps);
				}

				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioFactura;
				intIvaUnitario = intImporteIva * intTipoCambioFactura;
				intIepsUnitario = intImporteIeps * intTipoCambioFactura;

				//Redondear cantidad a decimales
				intIvaUnitario = intIvaUnitario.toFixed(4);
				intIvaUnitario = parseFloat(intIvaUnitario);

				//Redondear cantidad a decimales
				intIepsUnitario = intIepsUnitario.toFixed(4);
				intIepsUnitario = parseFloat(intIepsUnitario);

				//Incrementar acumulados
				intAcumPrecioMO += intSubtotal;
				intAcumSubtotalMO += intSubtotal;
				intAcumIvaMO += intImporteIva;
				intAcumIepsMO += intImporteIeps;
				intAcumTotalMO += intTotal;
		    }

		    /*
			*****************************************************************************************************************
			* REFACCIONES
			*****************************************************************************************************************
			*/
			//Hacer recorrido para obtener los detalles de las refacciones
			for (var intCon in objDetallesFraNotasCreditoServicioServicio.getRefacciones()) 
		    {
		    	//Crear instancia temporal del objeto Detalles de la orden de reparación (o factura) consultada
				objRefaccionDetalleNotasCreditoServicioServicio = new DetallesFraNotasCreditoServicioServicio();
				//Asignar datos del detalle de refacciones corespondiente al indice
            	objRefaccionDetalleNotasCreditoServicioServicio = objDetallesFraNotasCreditoServicioServicio.getRefaccion(intCon);

		    	//Variables que se utilizan para asignar valores del detalle
	        	var intMonedaID =  intMonedaIDFactura;
	        	var strMoneda =   '';
	        	var intTipoCambio = intTipoCambioFactura;
	        	//Variable que se utiliza para asignar el tipo de cambio del día
	        	var intTipoCambioDia  = intTipoCambioFactura;
	        	var intCantidad = parseFloat(objRefaccionDetalleNotasCreditoServicioServicio.cantidad);
	        	var intCantidadDevolucion = 0;
		
				//Si no existen errores con respecto al tipo de cambio del día
				if( intCantidad > 0)
				{

					//Variables que se utilizan para asignar valores del detalle
					var intTasaCuotaIeps = objRefaccionDetalleNotasCreditoServicioServicio.tasa_cuota_ieps;
		        	var intPorcentajeIva = objRefaccionDetalleNotasCreditoServicioServicio.porcentaje_iva;
		        	var intPorcentajeIeps = objRefaccionDetalleNotasCreditoServicioServicio.porcentaje_ieps;
		        	var intPrecioUnitario = parseFloat(objRefaccionDetalleNotasCreditoServicioServicio.precio_unitario);
					
		        	//Variable que se utiliza para asignar el importe de iva
					var intImporteIva = 0;
		        	//Variable que se utiliza para asignar el iva unitario
					var intIvaUnitario = 0;
					//Variable que se utiliza para asignar el importe de ieps
					var intImporteIeps = 0;
					//Variable que se utiliza para asignar el ieps unitario
					var intIepsUnitario = 0;
					//Variable que se utiliza para asignar el descuento unitario
				    var intDescuentoUnitario = 0;
		        	//Variable que se utiliza para asignar el subtotal 
					var intSubtotal = 0;

				    //Convertir peso mexicano a tipo de cambio
					intPrecioUnitario = intPrecioUnitario / intTipoCambio;
					
					//Redondear cantidad a decimales
					intPrecioUnitario = intPrecioUnitario.toFixed(2);
					intPrecioUnitario = parseFloat(intPrecioUnitario);

					//Calcular subtotal
					intSubtotal = intCantidad * intPrecioUnitario;


					//Calcular importe de IVA
					intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
					//Redondear cantidad a dos decimales
				    intImporteIva = intImporteIva.toFixed(4);
				    intImporteIva = parseFloat(intImporteIva);

					//Si existe id de la tasa de cuota del IEPS
					if(intTasaCuotaIeps > 0)
					{
						//Calcular importe de IEPS
						intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
						//Redondear cantidad a dos decimales
				   	 	intImporteIeps = intImporteIeps.toFixed(4);
				   	 	intImporteIeps = parseFloat(intImporteIeps);
					}

					//Si el tipo de moneda de la factura corresponde a pesos mexicano
					if(intMonedaIDFactura == intMonedaBaseIDNotasCreditoServicioServicio)
					{
						//Si el tipo de moneda del detalle es diferente a pesos mexicano
						if(intMonedaID !== intMonedaBaseIDNotasCreditoServicioServicio)
						{
							//Convertir importes a tipo de cambio
							intPrecioUnitario = intPrecioUnitario * intTipoCambioDia;
							intSubtotal = intSubtotal * intTipoCambioDia;
							intImporteIva = intImporteIva * intTipoCambioDia;
							intImporteIeps = intImporteIeps * intTipoCambioDia;

						}

					}
					else
					{
						//Si el tipo de moneda del detalle corresponde a pesos mexicano
						if(intMonedaID === intMonedaBaseIDNotasCreditoServicioServicio)
						{
							//Convertir importes a peso mexicano
							intPrecioUnitario = intPrecioUnitario / intTipoCambioDia;
							intSubtotal = intSubtotal / intTipoCambioDia;
							intImporteIva = intImporteIva / intTipoCambioDia;
							intImporteIeps = intImporteIeps / intTipoCambioDia;

						}
					}

					
					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

					//Calcular iva unitario
					intIvaUnitario =  intImporteIva / intCantidad;
					//Calcular ieps unitario
					intIepsUnitario = intImporteIeps / intCantidad;

					//Convertir importes a peso mexicano
					intPrecioUnitario = intPrecioUnitario * intTipoCambioFactura;
					intIvaUnitario = intIvaUnitario * intTipoCambioFactura;
					intIepsUnitario = intIepsUnitario * intTipoCambioFactura;

					//Redondear cantidad a decimales
					intIvaUnitario = intIvaUnitario.toFixed(4);
					intIvaUnitario = parseFloat(intIvaUnitario);

					
					//Redondear cantidad a decimales
					intIepsUnitario = intIepsUnitario.toFixed(4);
					intIepsUnitario = parseFloat(intIepsUnitario);


					//Incrementar acumulados
					intAcumPrecioRef += intSubtotal;
					intAcumSubtotalRef += intSubtotal;
					intAcumIvaRef += intImporteIva;
					intAcumIepsRef += intImporteIeps;
					intAcumTotalRef += intTotal;

				}//Cierre de verificación de errores por inexistencia del tipo cambio del día

		     }//Cierre de for
			    
			
			
			/*
			*****************************************************************************************************************
			* TRABAJOS FORANEOS
			*****************************************************************************************************************
			*/

			//Hacer recorrido para obtener los detalles de los trabajos foráneos
		    for (var intCon in objDetallesFraNotasCreditoServicioServicio.getTrabajosForaneos()) 
		    {
		    	//Crear instancia temporal del objeto Detalles de la orden de reparación (o factura) consultada
				objTrabajoForaneoDetalleNotasCreditoServicioServicio = new DetallesFraNotasCreditoServicioServicio();
				//Asignar datos del detalle del trabajo foráneo corespondiente al indice
            	objTrabajoForaneoDetalleNotasCreditoServicioServicio = objDetallesFraNotasCreditoServicioServicio.getTrabajoForaneo(intCon);
		   
		    	//Variables que se utilizan para asignar valores del detalle
	        	var intMonedaID = intMonedaIDFactura;
	        	var strMoneda =   '';
	        	var intTipoCambio  = intTipoCambioFactura;
	        	//Variable que se utiliza para asignar el tipo de cambio del día
	        	var intTipoCambioDia  = intTipoCambioFactura;
	        	

				//Variables que se utilizan para asignar valores del detalle
				var intCantidad = parseFloat(objTrabajoForaneoDetalleNotasCreditoServicioServicio.cantidad);
				var intPrecioUnitario = parseFloat(objTrabajoForaneoDetalleNotasCreditoServicioServicio.precio_unitario);
			    var intDescuentoUnitario = 0;
	        	var intPorcentajeIva = objTrabajoForaneoDetalleNotasCreditoServicioServicio.porcentaje_iva;
	        	var intPorcentajeIeps = objTrabajoForaneoDetalleNotasCreditoServicioServicio.porcentaje_ieps;
				var intTasaCuotaIeps = objTrabajoForaneoDetalleNotasCreditoServicioServicio.tasa_cuota_ieps;
				var strTipoTasaCuotaIeps = objTrabajoForaneoDetalleNotasCreditoServicioServicio.tipo_ieps;
				var strFactorTasaCuotaIeps = objTrabajoForaneoDetalleNotasCreditoServicioServicio.factor_ieps;
				
	        	//Variable que se utiliza para asignar el importe de iva
				var intImporteIva = 0;
	        	//Variable que se utiliza para asignar el iva unitario
				var intIvaUnitario = 0;
				//Variable que se utiliza para asignar el importe de ieps
				var intImporteIeps = 0;
				//Variable que se utiliza para asignar el ieps unitario
				var intIepsUnitario = 0;
				
	        	//Variable que se utiliza para asignar el subtotal 
				var intSubtotal = 0;

			    //Convertir peso mexicano a tipo de cambio
				intPrecioUnitario = intPrecioUnitario / intTipoCambio;
				
				//Redondear cantidad a decimales
				intPrecioUnitario = intPrecioUnitario.toFixed(2);
				intPrecioUnitario = parseFloat(intPrecioUnitario);

				//Calcular subtotal
				intSubtotal = intCantidad * intPrecioUnitario;

				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
				//Redondear cantidad a dos decimales
			    intImporteIva = intImporteIva.toFixed(4);
			    intImporteIva = parseFloat(intImporteIva);

				//Si existe id de la tasa de cuota del IEPS
				if(intTasaCuotaIeps > 0)
				{
					//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
					if(strTipoTasaCuotaIeps === 'RANGO' && strFactorTasaCuotaIeps ==='Cuota')
					{
						//Limpiar contenido de las siguientes variables
						intTasaCuotaIeps =  '';
					}
					else
					{
						//Calcular importe de IEPS
						intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
						//Redondear cantidad a dos decimales
				   	 	intImporteIeps = intImporteIeps.toFixed(4);
				   	 	intImporteIeps = parseFloat(intImporteIeps);
					}
					
				}
				
				//Si el tipo de moneda de la factura corresponde a pesos mexicano
				if(intMonedaIDFactura == intMonedaBaseIDNotasCreditoServicioServicio)
				{
					//Si el tipo de moneda del detalle es diferente a pesos mexicano
					if(intMonedaID !== intMonedaBaseIDNotasCreditoServicioServicio)
					{
						//Convertir importes a tipo de cambio
						intPrecioUnitario = intPrecioUnitario * intTipoCambioDia;
						intSubtotal = intSubtotal * intTipoCambioDia;
						intImporteIva = intImporteIva * intTipoCambioDia;
						intImporteIeps = intImporteIeps * intTipoCambioDia;

					}

				}
				else
				{
					//Si el tipo de moneda del detalle corresponde a pesos mexicano
					if(intMonedaID === intMonedaBaseIDNotasCreditoServicioServicio)
					{
						//Convertir importes a peso mexicano
						intPrecioUnitario = intPrecioUnitario / intTipoCambioDia;
						intSubtotal = intSubtotal / intTipoCambioDia;
						intImporteIva = intImporteIva / intTipoCambioDia;
						intImporteIeps = intImporteIeps / intTipoCambioDia;

					}
				}

				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Calcular iva unitario
				intIvaUnitario =  intImporteIva / intCantidad;
				//Calcular ieps unitario
				intIepsUnitario = intImporteIeps / intCantidad;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioFactura;
				intIvaUnitario = intIvaUnitario * intTipoCambioFactura;
				intIepsUnitario = intIepsUnitario * intTipoCambioFactura;

				//Redondear cantidad a decimales
				intIvaUnitario = intIvaUnitario.toFixed(4);
				intIvaUnitario = parseFloat(intIvaUnitario);

				//Redondear cantidad a decimales
				intIepsUnitario = intIepsUnitario.toFixed(4);
				intIepsUnitario = parseFloat(intIepsUnitario);

				//Incrementar acumulados
				intAcumPrecioTF += intSubtotal;
				intAcumSubtotalTF += intSubtotal;
				intAcumIvaTF += intImporteIva;
				intAcumIepsTF += intImporteIeps;
				intAcumTotalTF += intTotal;


		    }//Cierre de for


		    /*
			*****************************************************************************************************************
			* OTROS
			*****************************************************************************************************************
			*/
			//Hacer recorrido para obtener los detalles de otros servicios
			for (var intCon in objDetallesFraNotasCreditoServicioServicio.getOtros()) 
		    {
		    	//Crear instancia temporal del objeto Detalles de la orden de reparación (o factura) consultada
				objOtroDetalleNotasCreditoServicioServicio = new DetallesFraNotasCreditoServicioServicio();
				//Asignar datos del detalle de otro servicio corespondiente al indice
            	objOtroDetalleNotasCreditoServicioServicio = objDetallesFraNotasCreditoServicioServicio.getOtro(intCon);


				//Variables que se utilizan para asignar valores del detalle
	        	var intMonedaID = intMonedaIDFactura;
	        	var strMoneda =   '';
	        	var intTipoCambio  = intTipoCambioFactura;
	        	//Variable que se utiliza para asignar el tipo de cambio del día
	        	var intTipoCambioDia  = intTipoCambioFactura;


	        	//Variables que se utilizan para asignar valores del detalle
				var intCantidad = parseFloat(objOtroDetalleNotasCreditoServicioServicio.cantidad);
				var intPrecioUnitario = parseFloat(objOtroDetalleNotasCreditoServicioServicio.precio_unitario);
			    var intDescuentoUnitario = parseFloat(objOtroDetalleNotasCreditoServicioServicio.descuento_unitario);
	        	var intPorcentajeIva = objOtroDetalleNotasCreditoServicioServicio.porcentaje_iva;
	        	var intPorcentajeIeps = objOtroDetalleNotasCreditoServicioServicio.porcentaje_ieps;
	        	var intTasaCuotaIeps  = objOtroDetalleNotasCreditoServicioServicio.tasa_cuota_ieps;
			
	        	//Variable que se utiliza para asignar el importe de iva
				var intImporteIva = 0;
	        	//Variable que se utiliza para asignar el iva unitario
				var intIvaUnitario = 0;
				//Variable que se utiliza para asignar el importe de ieps
				var intImporteIeps = 0;
				//Variable que se utiliza para asignar el ieps unitario
				var intIepsUnitario = 0;
	        	//Variable que se utiliza para asignar el subtotal 
				var intSubtotal = 0;
				//Variable que se utiliza para asignar el precio 
				var intPrecio = 0;
				//Variable que se utiliza para asignar el descuento 
       			var intDescuento = 0;

			    //Convertir peso mexicano a tipo de cambio
				intPrecioUnitario = intPrecioUnitario / intTipoCambio;
				intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
				
				//Redondear cantidad a x decimales
				intPrecioUnitario = intPrecioUnitario.toFixed(2);
				intPrecioUnitario = parseFloat(intPrecioUnitario);

				intDescuentoUnitario = intDescuentoUnitario.toFixed(2);
				intDescuentoUnitario = parseFloat(intDescuentoUnitario);

				//Calcular subtotal
				intSubtotal = intCantidad * intPrecioUnitario;


				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
				//Redondear cantidad a dos decimales
			    intImporteIva = intImporteIva.toFixed(4);
			    intImporteIva = parseFloat(intImporteIva);

				//Si existe id de la tasa de cuota del IEPS
				if(intTasaCuotaIeps > 0)
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
					//Redondear cantidad a dos decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(4);
			   	 	intImporteIeps = parseFloat(intImporteIeps);
				}

				//Si el tipo de moneda de la factura corresponde a pesos mexicano
				if(intMonedaIDFactura == intMonedaBaseIDNotasCreditoServicioServicio)
				{
					//Si el tipo de moneda del detalle es diferente a pesos mexicano
					if(intMonedaID !== intMonedaBaseIDNotasCreditoServicioServicio)
					{
						//Convertir importes a tipo de cambio
						intPrecioUnitario = intPrecioUnitario * intTipoCambioDia;
						intDescuentoUnitario = intDescuentoUnitario * intTipoCambioDia;
						intSubtotal = intSubtotal * intTipoCambioDia;
						intImporteIva = intImporteIva * intTipoCambioDia;
						intImporteIeps = intImporteIeps * intTipoCambioDia;

					}

				}
				else
				{
					//Si el tipo de moneda del detalle corresponde a pesos mexicano
					if(intMonedaID === intMonedaBaseIDNotasCreditoServicioServicio)
					{
						//Convertir importes a peso mexicano
						intPrecioUnitario = intPrecioUnitario / intTipoCambioDia;
						intDescuentoUnitario = intDescuentoUnitario / intTipoCambioDia;
						intSubtotal = intSubtotal / intTipoCambioDia;
						intImporteIva = intImporteIva / intTipoCambioDia;
						intImporteIeps = intImporteIeps / intTipoCambioDia;

					}
				}

				
				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Asignar el importe del subtotal
       			intPrecio = intSubtotal;

				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{
					//Incrementar precio unitario
					intPrecio = intPrecioUnitario + intDescuentoUnitario;
					//Calcular precio
					intPrecio = intPrecio * intCantidad;
					//Calcular descuento
					intDescuento = intDescuentoUnitario * intCantidad;
				}


				//Calcular iva unitario
				intIvaUnitario =  intImporteIva / intCantidad;
				//Calcular ieps unitario
				intIepsUnitario = intImporteIeps / intCantidad;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioFactura;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioFactura;
				intIvaUnitario = intIvaUnitario * intTipoCambioFactura;
				intIepsUnitario = intIepsUnitario * intTipoCambioFactura;

				//Redondear cantidad a x decimales
			    intPrecioUnitario = intPrecioUnitario.toFixed(2);
				intPrecioUnitario = parseFloat(intPrecioUnitario);

				intDescuentoUnitario = intDescuentoUnitario.toFixed(2);
				intDescuentoUnitario = parseFloat(intDescuentoUnitario);

				intIvaUnitario = intIvaUnitario.toFixed(4);
				intIvaUnitario = parseFloat(intIvaUnitario);

				intIepsUnitario = intIepsUnitario.toFixed(4);
				intIepsUnitario = parseFloat(intIepsUnitario);
       			
				//Incrementar acumulados
				intAcumPrecioOtros += intPrecio;
				intAcumSubtotalOtros += intSubtotal;
				intAcumDescuentoOtros += intDescuento;
				intAcumIvaOtros += intImporteIva;
				intAcumIepsOtros += intImporteIeps;
				intAcumTotalOtros += intTotal;

		    }//Cierre de for


	        //Si existen detalles de la factura
	        (intAcumPrecioMO > 0 || intAcumPrecioRef > 0 || intAcumPrecioTF > 0 
	        	|| intAcumPrecioOtros > 0 || intGastosServicioTotal > 0)
	        {
	        	//Obtenemos el objeto de la tabla detalles
	        	var objTabla = document.getElementById('dg_detalles_notas_credito_servicio_servicio').getElementsByTagName('tbody')[0];

				/*
				*****************************************************************************************************************
				* MANO DE OBRA
				*****************************************************************************************************************
				*/
				//Asignar descripción de la referencia
			    strDescripcion = 'MANO DE OBRA';
			   
				//Si existen detalles de mano de obra
		        if(intAcumPrecioMO > 0)
		        {    
		        	//Recuperar acumulados de la mano de obra
		        	intAcumPrecio = intAcumPrecioMO;
					intAcumDescuento = intAcumDescuentoMO;
					intAcumSubtotal = intAcumSubtotalMO;
					intAcumIva = intAcumIvaMO;
					intAcumIeps = intAcumIepsMO;
					intAcumTotal = intAcumTotalMO;
		        }

		        //Cambiar cantidad a  formato moneda (a visualizar)
		        intAcumPrecio = formatMoney(intAcumPrecio, 2, '');
		        intAcumDescuento = formatMoney(intAcumDescuento, 2, '');
		        intAcumSubtotal = formatMoney(intAcumSubtotal, 2, '');
		        intAcumIva = formatMoney(intAcumIva, 4, '');
		        intAcumIeps = formatMoney(intAcumIeps, 4, '');
		        intAcumTotal = formatMoney(intAcumTotal, 4, '');

		        //Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaDescripcion = objRenglon.insertCell(0);
				var objCeldaAcumPrecio = objRenglon.insertCell(1);
				var objCeldaAcumDescuento = objRenglon.insertCell(2);
				var objCeldaAcumSubtotal = objRenglon.insertCell(3);
				var objCeldaAcumIva = objRenglon.insertCell(4);
				var objCeldaAcumIeps = objRenglon.insertCell(5);
				var objCeldaAcumTotal = objRenglon.insertCell(6);
		        //Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', 'mano_obra'); 
				objCeldaDescripcion.setAttribute('class', 'movil d1');
				objCeldaDescripcion.innerHTML = strDescripcion;
				objCeldaAcumPrecio.setAttribute('class', 'movil d2');
				objCeldaAcumPrecio.innerHTML =  intAcumPrecio;
				objCeldaAcumDescuento.setAttribute('class', 'movil d3');
				objCeldaAcumDescuento.innerHTML =  intAcumDescuento;
				objCeldaAcumSubtotal.setAttribute('class', 'movil d4');
				objCeldaAcumSubtotal.innerHTML =  intAcumSubtotal;
				objCeldaAcumIva.setAttribute('class', 'movil d5');
				objCeldaAcumIva.innerHTML = intAcumIva;
				objCeldaAcumIeps.setAttribute('class', 'movil d6');
				objCeldaAcumIeps.innerHTML =  intAcumIeps;
				objCeldaAcumTotal.setAttribute('class', 'movil d7');
				objCeldaAcumTotal.innerHTML =  intAcumTotal;

				/*
				*****************************************************************************************************************
				* REFACCIONES
				*****************************************************************************************************************
				*/
				//Inicializar variables
				intAcumPrecio = 0;
				intAcumDescuento = 0;
				intAcumSubtotal = 0;
				intAcumIva = 0;
				intAcumIeps = 0;
				intAcumTotal = 0;

				//Asignar descripción de la referencia
			    strDescripcion = 'REFACCIONES';

			    //Si existen detalles de refacciones
		        if(intAcumPrecioRef > 0)
		        {    
		        	//Recuperar acumulados de las refacciones
		        	intAcumPrecio = intAcumPrecioRef;
					intAcumDescuento = intAcumDescuentoRef;
					intAcumSubtotal = intAcumSubtotalRef;
					intAcumIva = intAcumIvaRef;
					intAcumIeps = intAcumIepsRef;
					intAcumTotal = intAcumTotalRef;
		        }

		        
		        //Cambiar cantidad a  formato moneda (a visualizar)
		        intAcumPrecio = formatMoney(intAcumPrecio, 2, '');
		        intAcumDescuento = formatMoney(intAcumDescuento, 2, '');
		        intAcumSubtotal = formatMoney(intAcumSubtotal, 2, '');
		        intAcumIva = formatMoney(intAcumIva, 4, '');
		        intAcumIeps = formatMoney(intAcumIeps, 4, '');
		        intAcumTotal = formatMoney(intAcumTotal, 4, '');


		        //Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaDescripcion = objRenglon.insertCell(0);
				var objCeldaAcumPrecio = objRenglon.insertCell(1);
				var objCeldaAcumDescuento = objRenglon.insertCell(2);
				var objCeldaAcumSubtotal = objRenglon.insertCell(3);
				var objCeldaAcumIva = objRenglon.insertCell(4);
				var objCeldaAcumIeps = objRenglon.insertCell(5);
				var objCeldaAcumTotal = objRenglon.insertCell(6);
		        //Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', 'refacciones'); 
				objCeldaDescripcion.setAttribute('class', 'movil d1');
				objCeldaDescripcion.innerHTML = strDescripcion;
				objCeldaAcumPrecio.setAttribute('class', 'movil d2');
				objCeldaAcumPrecio.innerHTML =  intAcumPrecio;
				objCeldaAcumDescuento.setAttribute('class', 'movil d3');
				objCeldaAcumDescuento.innerHTML =  intAcumDescuento;
				objCeldaAcumSubtotal.setAttribute('class', 'movil d4');
				objCeldaAcumSubtotal.innerHTML =  intAcumSubtotal;
				objCeldaAcumIva.setAttribute('class', 'movil d5');
				objCeldaAcumIva.innerHTML = intAcumIva;
				objCeldaAcumIeps.setAttribute('class', 'movil d6');
				objCeldaAcumIeps.innerHTML =  intAcumIeps;
				objCeldaAcumTotal.setAttribute('class', 'movil d7');
				objCeldaAcumTotal.innerHTML =  intAcumTotal;


				/*
				*****************************************************************************************************************
				* TRABAJOS FORANEOS
				*****************************************************************************************************************
				*/
				//Inicializar variables
				intAcumPrecio = 0;
				intAcumDescuento = 0;
				intAcumSubtotal = 0;
				intAcumIva = 0;
				intAcumIeps = 0;
				intAcumTotal = 0;

				//Asignar descripción de la referencia
			    strDescripcion = 'TRABAJOS FORÁNEOS';

			    //Si existen detalles de trabajos foráneos
		        if(intAcumPrecioTF != null)
		        {    
		        	//Recuperar acumulados de los trabajos foráneos
		        	intAcumPrecio = intAcumPrecioTF;
					intAcumDescuento = intAcumDescuentoTF;
					intAcumSubtotal = intAcumSubtotalTF;
					intAcumIva = intAcumIvaTF;
					intAcumIeps = intAcumIepsTF;
					intAcumTotal = intAcumTotalTF;
		        }

		        //Cambiar cantidad a  formato moneda (a visualizar)
		        intAcumPrecio = formatMoney(intAcumPrecio, 2, '');
		        intAcumDescuento = formatMoney(intAcumDescuento, 2, '');
		        intAcumSubtotal = formatMoney(intAcumSubtotal, 2, '');
		        intAcumIva = formatMoney(intAcumIva, 4, '');
		        intAcumIeps = formatMoney(intAcumIeps, 4, '');
		        intAcumTotal = formatMoney(intAcumTotal, 4, '');

		        //Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaDescripcion = objRenglon.insertCell(0);
				var objCeldaAcumPrecio = objRenglon.insertCell(1);
				var objCeldaAcumDescuento = objRenglon.insertCell(2);
				var objCeldaAcumSubtotal = objRenglon.insertCell(3);
				var objCeldaAcumIva = objRenglon.insertCell(4);
				var objCeldaAcumIeps = objRenglon.insertCell(5);
				var objCeldaAcumTotal = objRenglon.insertCell(6);
		        //Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', 'trabajos_foraneos'); 
				objCeldaDescripcion.setAttribute('class', 'movil d1');
				objCeldaDescripcion.innerHTML = strDescripcion;
				objCeldaAcumPrecio.setAttribute('class', 'movil d2');
				objCeldaAcumPrecio.innerHTML =  intAcumPrecio;
				objCeldaAcumDescuento.setAttribute('class', 'movil d3');
				objCeldaAcumDescuento.innerHTML =  intAcumDescuento;
				objCeldaAcumSubtotal.setAttribute('class', 'movil d4');
				objCeldaAcumSubtotal.innerHTML =  intAcumSubtotal;
				objCeldaAcumIva.setAttribute('class', 'movil d5');
				objCeldaAcumIva.innerHTML = intAcumIva;
				objCeldaAcumIeps.setAttribute('class', 'movil d6');
				objCeldaAcumIeps.innerHTML =  intAcumIeps;
				objCeldaAcumTotal.setAttribute('class', 'movil d7');
				objCeldaAcumTotal.innerHTML =  intAcumTotal;


				/*
				*****************************************************************************************************************
				* GASTOS DE SERVICIO
				*****************************************************************************************************************
				*/
				//Inicializar variables
				intAcumPrecio = 0;
				intAcumDescuento = 0;
				intAcumSubtotal = 0;
				intAcumIva = 0;
				intAcumIeps = 0;
				intAcumTotal = 0;

				//Asignar descripción de la referencia
			    strDescripcion = 'GASTOS DE SERVICIO';
			   
				//Si existen gastos de servicio
		        if(intGastosServicioTotal > 0)
		        {    
		        	//Recuperar acumulados del gasto de servicio
		        	intAcumPrecio = intGastosServicioSubtotal;
					intAcumDescuento = 0 ;
					intAcumSubtotal = intGastosServicioSubtotal;
					intAcumIva = intGastosServicioIva;
					intAcumIeps = 0;
					intAcumTotal = intGastosServicioTotal;
		        }

		        //Cambiar cantidad a  formato moneda (a visualizar)
		        intAcumPrecio = formatMoney(intAcumPrecio, 2, '');
		        intAcumDescuento = formatMoney(intAcumDescuento, 2, '');
		        intAcumSubtotal = formatMoney(intAcumSubtotal, 2, '');
		        intAcumIva = formatMoney(intAcumIva, 4, '');
		        intAcumIeps = formatMoney(intAcumIeps, 4, '');
		        intAcumTotal = formatMoney(intAcumTotal, 4, '');

		        //Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaDescripcion = objRenglon.insertCell(0);
				var objCeldaAcumPrecio = objRenglon.insertCell(1);
				var objCeldaAcumDescuento = objRenglon.insertCell(2);
				var objCeldaAcumSubtotal = objRenglon.insertCell(3);
				var objCeldaAcumIva = objRenglon.insertCell(4);
				var objCeldaAcumIeps = objRenglon.insertCell(5);
				var objCeldaAcumTotal = objRenglon.insertCell(6);
		        //Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', 'gastos_servicio'); 
				objCeldaDescripcion.setAttribute('class', 'movil d1');
				objCeldaDescripcion.innerHTML = strDescripcion;
				objCeldaAcumPrecio.setAttribute('class', 'movil d2');
				objCeldaAcumPrecio.innerHTML =  intAcumPrecio;
				objCeldaAcumDescuento.setAttribute('class', 'movil d3');
				objCeldaAcumDescuento.innerHTML =  intAcumDescuento;
				objCeldaAcumSubtotal.setAttribute('class', 'movil d4');
				objCeldaAcumSubtotal.innerHTML =  intAcumSubtotal;
				objCeldaAcumIva.setAttribute('class', 'movil d5');
				objCeldaAcumIva.innerHTML = intAcumIva;
				objCeldaAcumIeps.setAttribute('class', 'movil d6');
				objCeldaAcumIeps.innerHTML =  intAcumIeps;
				objCeldaAcumTotal.setAttribute('class', 'movil d7');
				objCeldaAcumTotal.innerHTML =  intAcumTotal;


				/*
				*****************************************************************************************************************
				* OTROS
				*****************************************************************************************************************
				*/
				//Inicializar variables
				intAcumPrecio = 0;
				intAcumDescuento = 0;
				intAcumSubtotal = 0;
				intAcumIva = 0;
				intAcumIeps = 0;
				intAcumTotal = 0;

				//Asignar descripción de la referencia
			    strDescripcion = 'OTROS';

			    //Si existen detalles de otros servicios
		        if(intAcumPrecioOtros > 0)
		        {    
		        	//Recuperar acumulados de otros servicios
		        	intAcumPrecio = intAcumPrecioOtros;
					intAcumDescuento = intAcumDescuentoOtros;
					intAcumSubtotal = intAcumSubtotalOtros;
					intAcumIva = intAcumIvaOtros;
					intAcumIeps = intAcumIepsOtros;
					intAcumTotal = intAcumTotalOtros;
		        }

		        
		        //Cambiar cantidad a  formato moneda (a visualizar)
		        intAcumPrecio = formatMoney(intAcumPrecio, 2, '');
		        intAcumDescuento = formatMoney(intAcumDescuento, 2, '');
		        intAcumSubtotal = formatMoney(intAcumSubtotal, 2, '');
		        intAcumIva = formatMoney(intAcumIva, 4, '');
		        intAcumIeps = formatMoney(intAcumIeps, 4, '');
		        intAcumTotal = formatMoney(intAcumTotal, 4, '');


		        //Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaDescripcion = objRenglon.insertCell(0);
				var objCeldaAcumPrecio = objRenglon.insertCell(1);
				var objCeldaAcumDescuento = objRenglon.insertCell(2);
				var objCeldaAcumSubtotal = objRenglon.insertCell(3);
				var objCeldaAcumIva = objRenglon.insertCell(4);
				var objCeldaAcumIeps = objRenglon.insertCell(5);
				var objCeldaAcumTotal = objRenglon.insertCell(6);
		        //Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', 'otros'); 
				objCeldaDescripcion.setAttribute('class', 'movil d1');
				objCeldaDescripcion.innerHTML = strDescripcion;
				objCeldaAcumPrecio.setAttribute('class', 'movil d2');
				objCeldaAcumPrecio.innerHTML =  intAcumPrecio;
				objCeldaAcumDescuento.setAttribute('class', 'movil d3');
				objCeldaAcumDescuento.innerHTML =  intAcumDescuento;
				objCeldaAcumSubtotal.setAttribute('class', 'movil d4');
				objCeldaAcumSubtotal.innerHTML =  intAcumSubtotal;
				objCeldaAcumIva.setAttribute('class', 'movil d5');
				objCeldaAcumIva.innerHTML = intAcumIva;
				objCeldaAcumIeps.setAttribute('class', 'movil d6');
				objCeldaAcumIeps.innerHTML =  intAcumIeps;
				objCeldaAcumTotal.setAttribute('class', 'movil d7');
				objCeldaAcumTotal.innerHTML =  intAcumTotal;


				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_notas_credito_servicio_servicio();
	            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_notas_credito_servicio_servicio tr").length - 2;
				$('#numElementos_detalles_notas_credito_servicio_servicio').html(intFilas);
				$('#txtNumDetalles_notas_credito_servicio_servicio').val(intFilas);
	        }

		}//Cierre de verificación del tipo de cambio
		
	}


    //Función para calcular totales de la tabla
	function calcular_totales_detalles_notas_credito_servicio_servicio()
	{
		//Obtenemos el objeto de la tabla 
		var objTabla = document.getElementById('dg_detalles_notas_credito_servicio_servicio').getElementsByTagName('tbody')[0];

		//Inicializamos las variables que se utilizan para los acumulados
		var intAcumDescuento = 0;
		var intAcumSubtotal = 0;
		var intAcumIva = 0;
		var intAcumIeps = 0;
		var intAcumTotal = 0;
		var intImporteFra = 0;

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intAcumDescuento += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
			intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
			intAcumIva += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
			intAcumIeps += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
			intAcumTotal += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
			intImporteFra += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));

		}

		//Convertir cantidad a formato moneda
		intAcumDescuento =  '$'+formatMoney(intAcumDescuento, 2, '');
		intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 2, '');
		intAcumIva =  '$'+formatMoney(intAcumIva, 4, '');
		intAcumIeps =  '$'+formatMoney(intAcumIeps, 4, '');
		intAcumTotal =  '$'+formatMoney(intAcumTotal, 4, '');
		intImporteFra =  '$'+formatMoney(intImporteFra, 2, '');

		//Asignar los valores
		$('#acumDescuento_detalles_notas_credito_servicio_servicio').html(intAcumDescuento);
		$('#acumSubtotal_detalles_notas_credito_servicio_servicio').html(intAcumSubtotal);
		$('#acumIva_detalles_notas_credito_servicio_servicio').html(intAcumIva);
		$('#acumIeps_detalles_notas_credito_servicio_servicio').html(intAcumIeps);
		$('#acumTotal_detalles_notas_credito_servicio_servicio').html(intAcumTotal);
		$('#txtImporteFacturaServicio_notas_credito_servicio_servicio').val(intImporteFra);
	}

	
	/*******************************************************************************************************************
	Funciones de la tabla CFDI relacionados
	*********************************************************************************************************************/
	//Función para agregar renglones a la tabla 
	function agregar_cfdi_relacionados_notas_credito_servicio_servicio(tipoAccion, estatus)
	{

		//Variable que se utiliza para asignar las acciones del grid view
	    var strAccionesTabla = '';

	    //Si se cumple la sentencia
		if(estatus == '' || estatus == 'TIMBRAR')
		{
			strAccionesTabla = "<button class='btn btn-default btn-xs' title='Eliminar'" +
								   " onclick='eliminar_renglon_cfdi_relacionados_notas_credito_servicio_servicio(this)'>" + 
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
						intReferenciaID: $('#txtNotaCreditoServicioID_notas_credito_servicio_servicio').val(),
						strTipoReferencia: strTipoReferenciaNotasCreditoServicioServicio
					},
					function(data){

						//Mostramos los CFDI´s relacionados (facturas seleccionadas)
			           	for (var intCon in data.rows) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_cfdi_relacionados_notas_credito_servicio_servicio').getElementsByTagName('tbody')[0];

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
							if(data.rows[intCon].folio ==  $('#txtFacturaServicio_notas_credito_servicio_servicio').val())
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
						var intFilas = $("#dg_cfdi_relacionados_notas_credito_servicio_servicio tr").length - 1;
						$('#numElementos_cfdi_relacionados_notas_credito_servicio_servicio').html(intFilas);
						$('#txtNumCfdiRelacionados_notas_credito_servicio_servicio').val(intFilas);
					},
			'json');
		}
		else
		{
			//Mostramos los CFDI´s relacionados (facturas seleccionadas)
			for (var intCon in objCfdisRelacionadosNotasCreditoServicioServicio.getCfdis()) 
            {
            	//Crear instancia del objeto CFDI a relacionar 
            	objCfdiRelacionarNotasCreditoServicioServicio = new CfdiRelacionarNotasCreditoServicioServicio();
            	//Asignar datos del CFDI corespondiente al indice
            	objCfdiRelacionarNotasCreditoServicioServicio = objCfdisRelacionadosNotasCreditoServicioServicio.getCfdi(intCon);
            	
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_cfdi_relacionados_notas_credito_servicio_servicio').getElementsByTagName('tbody')[0];

				//Variable que se utiliza para asignar el id del detalle
				var strDetalleID =  objCfdiRelacionarNotasCreditoServicioServicio.intReferenciaID+'_'+objCfdiRelacionarNotasCreditoServicioServicio.strTipoReferencia;

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
					objCeldaCliente.innerHTML = objCfdiRelacionarNotasCreditoServicioServicio.strCliente;
					objCeldaFolio.setAttribute('class', 'movil c2');
					objCeldaFolio.innerHTML = objCfdiRelacionarNotasCreditoServicioServicio.strFolio;
					objCeldaFecha.setAttribute('class', 'movil c3');
					objCeldaFecha.innerHTML = objCfdiRelacionarNotasCreditoServicioServicio.dteFecha;
					objCeldaModulo.setAttribute('class', 'movil c4');
					objCeldaModulo.innerHTML = objCfdiRelacionarNotasCreditoServicioServicio.strTipoReferencia;
					objCeldaUuid.setAttribute('class', 'movil c5');
					objCeldaUuid.innerHTML =  objCfdiRelacionarNotasCreditoServicioServicio.strUuid;
					objCeldaImporte.setAttribute('class', 'movil c6');
					objCeldaImporte.innerHTML = objCfdiRelacionarNotasCreditoServicioServicio.intImporte;
					objCeldaAcciones.setAttribute('class', 'td-center movil c7');
					objCeldaAcciones.innerHTML = strAccionesTabla;
					objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
					objCeldaReferenciaID.innerHTML = objCfdiRelacionarNotasCreditoServicioServicio.intReferenciaID;
				}
            }

            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
			var intFilas = $("#dg_cfdi_relacionados_notas_credito_servicio_servicio tr").length - 1;
			$('#numElementos_cfdi_relacionados_notas_credito_servicio_servicio').html(intFilas);
			$('#txtNumCfdiRelacionados_notas_credito_servicio_servicio').val(intFilas);
		}
	}

	//Función para quitar renglón de la tabla
	function eliminar_renglon_cfdi_relacionados_notas_credito_servicio_servicio(objRenglon)
	{
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
		
		//Eliminar el renglón indicado
		document.getElementById("dg_cfdi_relacionados_notas_credito_servicio_servicio").deleteRow(intRenglon);

		//Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
		var intFilas = $("#dg_cfdi_relacionados_notas_credito_servicio_servicio tr").length - 1;
		$('#numElementos_cfdi_relacionados_notas_credito_servicio_servicio').html(intFilas);
		$('#txtNumCfdiRelacionados_notas_credito_servicio_servicio').val(intFilas);
	}

	//Al inicializar el componente
	$(document).ready(function() 
	{
        /*******************************************************************************************************************
		Controles correspondientes al modal Notas de Crédito
		*********************************************************************************************************************/
        /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad por ejemplo: 10 será 10.00*/
        $('.cantidad_notas_credito_servicio_servicio').blur(function(){
            $('.cantidad_notas_credito_servicio_servicio').formatCurrency({ roundToDecimalPlace: 2 });
        });

        //Agregar datepicker para seleccionar fecha
		$('#dteFecha_notas_credito_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_notas_credito_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

        //Autocomplete para recuperar los datos de una forma de pago
        $('#txtFormaPago_notas_credito_servicio_servicio').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtFormaPagoID_notas_credito_servicio_servicio').val('');
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
             $('#txtFormaPagoID_notas_credito_servicio_servicio').val(ui.item.data);
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
        $('#txtFormaPago_notas_credito_servicio_servicio').focusout(function(e){
            //Si no existe id de la forma de pago
            if($('#txtFormaPagoID_notas_credito_servicio_servicio').val() == '' ||
               $('#txtFormaPago_notas_credito_servicio_servicio').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtFormaPagoID_notas_credito_servicio_servicio').val('');
               $('#txtFormaPago_notas_credito_servicio_servicio').val('');
            }
            
        });
        
        //Autocomplete para recuperar los datos de un método de pago
        $('#txtMetodoPago_notas_credito_servicio_servicio').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtMetodoPagoID_notas_credito_servicio_servicio').val('');
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
             $('#txtMetodoPagoID_notas_credito_servicio_servicio').val(ui.item.data);
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
        $('#txtMetodoPago_notas_credito_servicio_servicio').focusout(function(e){
            //Si no existe id del método de pago
            if($('#txtMetodoPagoID_notas_credito_servicio_servicio').val() == '' ||
               $('#txtMetodoPago_notas_credito_servicio_servicio').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtMetodoPagoID_notas_credito_servicio_servicio').val('');
               $('#txtMetodoPago_notas_credito_servicio_servicio').val('');
            }
            
        });

        //Autocomplete para recuperar los datos de un uso del CFDI
        $('#txtUsoCfdi_notas_credito_servicio_servicio').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtUsoCfdiID_notas_credito_servicio_servicio').val('');
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
             $('#txtUsoCfdiID_notas_credito_servicio_servicio').val(ui.item.data);
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
        $('#txtUsoCfdi_notas_credito_servicio_servicio').focusout(function(e){
            //Si no existe id del uso de CFDI
            if($('#txtUsoCfdiID_notas_credito_servicio_servicio').val() == '' ||
               $('#txtUsoCfdi_notas_credito_servicio_servicio').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtUsoCfdiID_notas_credito_servicio_servicio').val('');
               $('#txtUsoCfdi_notas_credito_servicio_servicio').val('');
            }
            
        });

        //Autocomplete para recuperar los datos de un tipo de relación
        $('#txtTipoRelacion_notas_credito_servicio_servicio').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtTipoRelacionID_notas_credito_servicio_servicio').val('');
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
             $('#txtTipoRelacionID_notas_credito_servicio_servicio').val(ui.item.data);
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
        $('#txtTipoRelacion_notas_credito_servicio_servicio').focusout(function(e){
            //Si no existe id del tipo de relación
            if($('#txtTipoRelacionID_notas_credito_servicio_servicio').val() == '' ||
               $('#txtTipoRelacion_notas_credito_servicio_servicio').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtTipoRelacionID_notas_credito_servicio_servicio').val('');
               $('#txtTipoRelacion_notas_credito_servicio_servicio').val('');
            }
            
        });

        //Autocomplete para recuperar los datos de una factura de servicio
        $('#txtFacturaServicio_notas_credito_servicio_servicio').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtFacturaServicioID_notas_credito_servicio_servicio').val('');
               //Hacer un llamado a la función para inicializar elementos de la factura de servicio
	           inicializar_factura_notas_credito_servicio_servicio();
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "servicio/facturas_servicio/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
                   strDescripcion: request.term, 
                   strFormulario: 'NOTA CREDITO'
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
	           	   $('#txtFacturaServicioID_notas_credito_servicio_servicio').val(ui.item.data); 
	           	   //Hacer un llamado a la función para regresar los datos de la factura de refacciones
		           get_datos_factura_notas_credito_servicio_servicio();
	           }
		        else
	            {
	             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				     mensaje_notas_credito_servicio_servicio('error_regimen_fiscal','','txtFacturaServicio_notas_credito_servicio_servicio');
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
        $('#txtFacturaServicio_notas_credito_servicio_servicio').focusout(function(e){
            //Si no existe id de la factura
            if($('#txtFacturaServicioID_notas_credito_servicio_servicio').val() == '' ||
               $('#txtFacturaServicio_notas_credito_servicio_servicio').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtFacturaServicioID_notas_credito_servicio_servicio').val('');
               $('#txtFacturaServicio_notas_credito_servicio_servicio').val('');
               //Hacer un llamado a la función para inicializar elementos de la factura de servicio
	           inicializar_factura_notas_credito_servicio_servicio();
            }

        });

        //Autocomplete para recuperar los datos de un objeto de impuesto
        $('#txtObjetoImpuesto_detalles_notas_credito_servicio_servicio').autocomplete({
              source: function( request, response ) {
              	 //Limpiar caja de texto que hace referencia al código del registro 
                 $('#txtObjetoImpuestoSat_detalles_notas_credito_servicio_servicio').val('');
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
               //Elegir código desde el valor devuelto en el autocomplete
				var strCodigo = ui.item.value.split(" - ")[0];
               //Asignar el código del registro seleccionado
               $('#txtObjetoImpuestoSat_detalles_notas_credito_servicio_servicio').val(strCodigo);

             },
             open: function() {
                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
               },
               close: function() {
                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
               },
             minLength: 1
        });

        //Verificar que exista código del objeto de impuesto cuando pierda el enfoque la caja de texto
        $('#txtObjetoImpuesto_detalles_notas_credito_servicio_servicio').focusout(function(e){
            //Si no existe código del objeto de impuesto
            if($('#txtObjetoImpuestoSat_detalles_notas_credito_servicio_servicio').val() == '' ||
               $('#txtObjetoImpuesto_detalles_notas_credito_servicio_servicio').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtObjetoImpuestoSat_detalles_notas_credito_servicio_servicio').val('');
               $('#txtObjetoImpuesto_detalles_notas_credito_servicio_servicio').val('');
            }
            
        });


         //Función para mover renglones arriba y abajo en la tabla
		$('#dg_cfdi_relacionados_notas_credito_servicio_servicio').on('click','button.btn',function(){
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
		$('#dteFechaInicialBusq_relacionar_cfdi_notas_credito_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_relacionar_cfdi_notas_credito_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});
		

		//Autocomplete para recuperar los datos de un cliente 
        $('#txtRazonSocialBusq_relacionar_cfdi_notas_credito_servicio_servicio').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtProspectoIDBusq_relacionar_cfdi_notas_credito_servicio_servicio').val('');
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
             $('#txtProspectoIDBusq_relacionar_cfdi_notas_credito_servicio_servicio').val(ui.item.data);
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
        $('#txtRazonSocialBusq_relacionar_cfdi_notas_credito_servicio_servicio').focusout(function(e){
            //Si no existe id del cliente
            if($('#txtProspectoIDBusq_relacionar_cfdi_notas_credito_servicio_servicio').val() == '' ||
            	$('#txtRazonSocialBusq_relacionar_cfdi_notas_credito_servicio_servicio').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtProspectoIDBusq_relacionar_cfdi_notas_credito_servicio_servicio').val('');
               $('#txtRazonSocialBusq_relacionar_cfdi_notas_credito_servicio_servicio').val('');
            }
            
        });

         /*******************************************************************************************************************
			Controles correspondientes al modal Cancelación del timbrado
			**************************************	*******************************************************************************/
		  //Autocomplete para recuperar los datos de una sustitución (factura, pago, etc.)
	        $('#txtFolioSustitucion_cancelacion_notas_credito_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSustitucionID_cancelacion_notas_credito_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/notas_credito_servicio/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intReferenciaID: $('#txtReferenciaCfdiID_cancelacion_notas_credito_servicio_servicio').val(),
	                   strFormulario: 'cancelacion'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtSustitucionID_cancelacion_notas_credito_servicio_servicio').val(ui.item.data);
	             $('#txtUuidSustitucion_cancelacion_notas_credito_servicio_servicio').val(ui.item.uuid);
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
	        $('#txtFolioSustitucion_cancelacion_notas_credito_servicio_servicio').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtSustitucionID_cancelacion_notas_credito_servicio_servicio').val() == '' ||
	               $('#txtFolioSustitucion_cancelacion_notas_credito_servicio_servicio').val() == '')
	            { 
	               //Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_notas_credito_servicio_servicio();
	            }
	            
	        });

	        //Verificar motivo de cancelación cuando cambie la opción del combobox
	        $('#cmbCancelacionMotivoID_cancelacion_notas_credito_servicio_servicio').change(function(e){   
	            //Si el motivo de cancelación no corresponde a 01 - Comprobante emitido con errores con relación.
              	if(parseInt($('#cmbCancelacionMotivoID_cancelacion_notas_credito_servicio_servicio').val()) !== intCancelacionIDRelacionCfdiNotasCreditoServicioServicio)
             	{
             		//Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_notas_credito_servicio_servicio();
					
             	}
	        });


		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_notas_credito_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_notas_credito_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_notas_credito_servicio_servicio').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_notas_credito_servicio_servicio').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_notas_credito_servicio_servicio').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_notas_credito_servicio_servicio').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_notas_credito_servicio_servicio').on('click','a',function(event){
			event.preventDefault();
			intPaginaNotasCreditoServicioServicio = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_notas_credito_servicio_servicio();
		});

	    //Autocomplete para recuperar los datos de un cliente 
        $('#txtRazonSocialBusq_notas_credito_servicio_servicio').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtProspectoIDBusq_notas_credito_servicio_servicio').val('');
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
             $('#txtProspectoIDBusq_notas_credito_servicio_servicio').val(ui.item.data);
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
        $('#txtRazonSocialBusq_notas_credito_servicio_servicio').focusout(function(e){
            //Si no existe id del cliente
            if($('#txtProspectoIDBusq_notas_credito_servicio_servicio').val() == '' ||
            	$('#txtRazonSocialBusq_notas_credito_servicio_servicio').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtProspectoIDBusq_notas_credito_servicio_servicio').val('');
               $('#txtRazonSocialBusq_notas_credito_servicio_servicio').val('');
            }
            
        });

        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_notas_credito_servicio_servicio').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_notas_credito_servicio_servicio('Nuevo');
			//Abrir modal
			 objNotasCreditoServicioServicio = $('#NotasCreditoServicioServicioBox').bPopup({
										   appendTo: '#NotasCreditoServicioServicioContent', 
			                               contentContainer: 'NotasCreditoServicioServicioM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});	
		    //Enfocar caja de texto
			$('#txtFacturaServicio_notas_credito_servicio_servicio').focus();	
		});

        //Enfocar caja de texto
        $('#txtFechaInicialBusq_notas_credito_servicio_servicio').focus();

		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_notas_credito_servicio_servicio();
		//Hacer un llamado a la función para cargar los motivos de cancelación en el combobox del modal
        cargar_motivos_cancelacion_notas_credito_servicio_servicio();
         //Hacer un llamado a la función para cargar exportación en el combobox del modal
         cargar_exportacion_notas_credito_servicio_servicio();

	});

</script>