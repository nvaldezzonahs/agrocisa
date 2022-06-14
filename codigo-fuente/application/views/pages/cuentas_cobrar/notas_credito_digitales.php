	<div id="NotasCreditoDigitalesCuentasCobrarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_notas_credito_digitales_cuentas_cobrar" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_notas_credito_digitales_cuentas_cobrar" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_notas_credito_digitales_cuentas_cobrar">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_notas_credito_digitales_cuentas_cobrar'>
				                    <input class="form-control" id="txtFechaInicialBusq_notas_credito_digitales_cuentas_cobrar"
				                    		name= "strFechaInicialBusq_notas_credito_digitales_cuentas_cobrar" 
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
								<label for="txtFechaFinalBusq_notas_credito_digitales_cuentas_cobrar">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_notas_credito_digitales_cuentas_cobrar'>
				                    <input class="form-control" id="txtFechaFinalBusq_notas_credito_digitales_cuentas_cobrar"
				                    		name= "strFechaFinalBusq_notas_credito_digitales_cuentas_cobrar" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
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
								<input id="txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar" 
									   name="intProspectoIDBusq_notas_credito_digitales_cuentas_cobrar"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocialBusq_notas_credito_digitales_cuentas_cobrar">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_notas_credito_digitales_cuentas_cobrar" 
										name="strRazonSocialBusq_notas_credito_digitales_cuentas_cobrar" 
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
								<label for="cmbEstatusBusq_notas_credito_digitales_cuentas_cobrar">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_notas_credito_digitales_cuentas_cobrar" 
								 		name="strEstatusBusq_notas_credito_digitales_cuentas_cobrar" tabindex="1">
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
								<label for="txtBusqueda_notas_credito_digitales_cuentas_cobrar">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_notas_credito_digitales_cuentas_cobrar" 
										name="strBusqueda_notas_credito_digitales_cuentas_cobrar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_notas_credito_digitales_cuentas_cobrar" 
									   name="strImprimirDetalles_notas_credito_digitales_cuentas_cobrar" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_notas_credito_digitales_cuentas_cobrar"
									onclick="paginacion_notas_credito_digitales_cuentas_cobrar();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_notas_credito_digitales_cuentas_cobrar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_notas_credito_digitales_cuentas_cobrar"
									onclick="reporte_notas_credito_digitales_cuentas_cobrar('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_notas_credito_digitales_cuentas_cobrar"
									onclick="reporte_notas_credito_digitales_cuentas_cobrar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla notas de crédito digitales
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
				Definir columnas de la tabla facturas a relacionar
				*/
				td.movil.d1:nth-of-type(1):before {content: "Referencia"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "UUID"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "T.C."; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Moneda ID"; font-weight: bold;}
				td.movil.d5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.d6:nth-of-type(6):before {content: "Tasa Cuota IVA"; font-weight: bold;}
				td.movil.d7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.d8:nth-of-type(8):before {content: "Tasa Cuota IEPS"; font-weight: bold;}
				td.movil.d9:nth-of-type(9):before {content: "IEPS"; font-weight: bold;}
				td.movil.d10:nth-of-type(10):before {content: "Importe Factura CFDI"; font-weight: bold;}
				td.movil.d11:nth-of-type(11):before {content: "Tipo IEPS"; font-weight: bold;}
				td.movil.d12:nth-of-type(12):before {content: "Factor IEPS"; font-weight: bold;}
				td.movil.d13:nth-of-type(13):before {content: "Tipo Referencia CFDI"; font-weight: bold;}
				td.movil.d14:nth-of-type(14):before {content: "Folio"; font-weight: bold;}
				td.movil.d15:nth-of-type(15):before {content: "Moneda"; font-weight: bold;}
				td.movil.d16:nth-of-type(16):before {content: "Fecha"; font-weight: bold;}
				td.movil.d17:nth-of-type(17):before {content: "Fecha Venc."; font-weight: bold;}
				td.movil.d18:nth-of-type(18):before {content: "Módulo"; font-weight: bold;}
				td.movil.d19:nth-of-type(19):before {content: "IVA %"; font-weight: bold;}
				td.movil.d20:nth-of-type(20):before {content: "IEPS %"; font-weight: bold;}
				td.movil.d21:nth-of-type(21):before {content: "Importe"; font-weight: bold;}
				td.movil.d22:nth-of-type(22):before {content: "Saldo"; font-weight: bold;}
				td.movil.d23:nth-of-type(23):before {content: "Vencido"; font-weight: bold;}
				td.movil.d24:nth-of-type(24):before {content: "Seleccionar"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla facturas a relacionar
				*/
				td.movil.dt1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.dt2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.dt3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.dt4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.dt5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.dt6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.dt7:nth-of-type(7):before {content: ""; font-weight: bold;}
				td.movil.dt8:nth-of-type(8):before {content: ""; font-weight: bold;}
				td.movil.dt9:nth-of-type(9):before {content: "Saldo"; font-weight: bold;}
				td.movil.dt10:nth-of-type(10):before {content: "Vencido"; font-weight: bold;}


				/*
				Definir columnas de la tabla detalles de la nota de crédito digital
				*/
				td.movil.e1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.e2:nth-of-type(2):before {content: "Módulo"; font-weight: bold;}
				td.movil.e3:nth-of-type(3):before {content: "Moneda"; font-weight: bold;}
				td.movil.e4:nth-of-type(4):before {content: "T.C."; font-weight: bold;}
				td.movil.e5:nth-of-type(5):before {content: "Concepto"; font-weight: bold;}
				td.movil.e6:nth-of-type(6):before {content: "IVA %"; font-weight: bold;}
				td.movil.e7:nth-of-type(7):before {content: "IEPS %"; font-weight: bold;}
				td.movil.e8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.e9:nth-of-type(9):before {content: "Importe"; font-weight: bold;}
				td.movil.e10:nth-of-type(10):before {content: "Saldo"; font-weight: bold;}
				td.movil.e11:nth-of-type(11):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la nota de crédito digital
				*/
				td.movil.et1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.et2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.et3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.et4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.et5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.et6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.et7:nth-of-type(7):before {content: ""; font-weight: bold;}
				td.movil.et8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.et9:nth-of-type(9):before {content: "Importe"; font-weight: bold;}
				td.movil.et10:nth-of-type(10):before {content: "Saldo"; font-weight: bold;}
		
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_notas_credito_digitales_cuentas_cobrar">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Razón social</th>
							<th class="movil">RFC</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:15em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_notas_credito_digitales_cuentas_cobrar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{razon_social}}</td>
							<td class="movil a4">{{rfc}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_notas_credito_digitales_cuentas_cobrar({{nota_credito_digital_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_notas_credito_digitales_cuentas_cobrar({{nota_credito_digital_id}},'Ver',{{cancelacion_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Ver motivo de cancelación-->
								<button class="btn btn-default btn-xs {{mostrarAccionMotivoCancelacion}}"  
										onclick="ver_cancelacion_notas_credito_digitales_cuentas_cobrar({{cancelacion_id}})"  title="Ver motivo de cancelación">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_cliente_notas_credito_digitales_cuentas_cobrar({{nota_credito_digital_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_notas_credito_digitales_cuentas_cobrar({{nota_credito_digital_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_notas_credito_digitales_cuentas_cobrar({{nota_credito_digital_id}}, '{{estatus}}', 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Timbrar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionTimbrar}}"  
										onclick="timbrar_notas_credito_digitales_cuentas_cobrar({{nota_credito_digital_id}},'', 'principal', {{regimen_fiscal_id}})"  title="Timbrar">
									<span class="fa fa-certificate"></span>
								</button>
								<!--Descargar archivos-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_notas_credito_digitales_cuentas_cobrar({{nota_credito_digital_id}}, '{{folio}}');" title="Descargar archivos">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_notas_credito_digitales_cuentas_cobrar({{nota_credito_digital_id}},'{{folio}}', {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_notas_credito_digitales_cuentas_cobrar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_notas_credito_digitales_cuentas_cobrar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_notas_credito_digitales_cuentas_cobrar" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div>

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarNotasCreditoDigitalesCuentasCobrarBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cliente_notas_credito_digitales_cuentas_cobrar" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarNotasCreditoDigitalesCuentasCobrar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarNotasCreditoDigitalesCuentasCobrar"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Razón social-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtNotaCreditoDigitalID_cliente_notas_credito_digitales_cuentas_cobrar" 
										   name="intNotaCreditoDigitalID_cliente_notas_credito_digitales_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el folio del registro seleccionado-->
									<input id="txtFolio_cliente_notas_credito_digitales_cuentas_cobrar" 
										   name="strFolio_cliente_notas_credito_digitales_cuentas_cobrar" 
										   type="hidden" value="" />
									<label for="txtRazonSocial_cliente_notas_credito_digitales_cuentas_cobrar">Razón social</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_cliente_notas_credito_digitales_cuentas_cobrar" 
											name="strRazonSocial_cliente_notas_credito_digitales_cuentas_cobrar" type="text" value="" 
											disabled />
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="row">
			 			<!--Correo electrónico-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar" 
											name="strCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50" />
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="row">
			 			<!--Copia-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCopiaCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar" 
											name="strCopiaCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50" />
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cliente_notas_credito_digitales_cuentas_cobrar" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_cliente_notas_credito_digitales_cuentas_cobrar"  
									onclick="validar_cliente_notas_credito_digitales_cuentas_cobrar();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cliente_notas_credito_digitales_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_cliente_notas_credito_digitales_cuentas_cobrar();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->
		
		<!-- Diseño del modal Relacionar CFDI-->
		<div id="RelacionarCfdiNotasCreditoDigitalesCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar" class="ModalBodyTitle">
			<h1>Relacionar CFDI</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarCfdiNotasCreditoDigitalesCuentasCobrar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarCfdiNotasCreditoDigitalesCuentasCobrar"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar">Fecha inicial</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaInicialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar'>
					                    <input class="form-control" id="txtFechaInicialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar"
					                    		name= "strFechaInicialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar" 
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
									<label for="txtFechaFinalBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar">Fecha final</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaFinalBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar'>
					                    <input class="form-control" id="txtFechaFinalBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar"
					                    		name= "strFechaFinalBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar" 
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
									<input id="txtProspectoIDBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar" 
										   name="intProspectoIDBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar"  type="hidden" 
										   value="" />
									<label for="txtRazonSocialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar">Razón social</label>
								</div>
								<div class="col-md-12">
									<div class="input-group">
										<input class="form-control" id="txtRazonSocialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar" 
											   name="strRazonSocialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar"  type="text" value="" 
											   tabindex="1" placeholder="Ingrese razón social" maxlength="250" />
										<span class="input-group-btn">
											<button class="btn btn-primary" id="btnBuscar_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar"
													onclick="lista_facturas_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar();" title="Buscar coincidencias" tabindex="1">
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
							<input id="txtNumCfdi_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar" 
								   name="intNumCfdi_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar" type="hidden" value="" />
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar">
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
								<script id="plantilla_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar" type="text/template"> 
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
							    		id="chbAgregar_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar" />
										</td>
									</tr>
									{{/rows}}
									{{^rows}}
									<tr class="movil"> 
										<td class="movil" colspan="7"> No se encontraron resultados.</td>
									</tr> 
									{{/rows}}
								</script>
								
							</table>
							<br>
							<div class="row">
								<!--Número de registros encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<button class="btn btn-default btn-sm disabled pull-right">
										<strong id="numElementos_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar CFDI-->
							<button class="btn btn-success" id="btnAgregar_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar"  
									onclick="validar_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar CFDI-->


		<!-- Diseño del modal Cancelación del timbrado-->
		<div id="CancelacionNotasCreditoDigitalesCuentasCobrarBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cancelacion_notas_credito_digitales_cuentas_cobrar" class="ModalBodyTitle confirmacion-modal-title">
			<h1>Cancelación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCancelacionNotasCreditoDigitalesCuentasCobrar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmCancelacionNotasCreditoDigitalesCuentasCobrar"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Combobox que contiene los motivos de cancelación activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCancelacionMotivoID_cancelacion_notas_credito_digitales_cuentas_cobrar">Motivo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbCancelacionMotivoID_cancelacion_notas_credito_digitales_cuentas_cobrar" 
									 		name="intCancelacionMotivoID_notas_credito_digitales_cuentas_cobrar" 
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
									<input id="txtReferenciaCfdiID_cancelacion_notas_credito_digitales_cuentas_cobrar" 
										   name="intReferenciaCfdiID_cancelacion_notas_credito_digitales_cuentas_cobrar" 
										   type="hidden" value="" />	

									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_cancelacion_notas_credito_digitales_cuentas_cobrar" 
										   name="intPolizaID_cancelacion_notas_credito_digitales_cuentas_cobrar" type="hidden" value="" />

									<label for="txtFolio_cancelacion_notas_credito_digitales_cuentas_cobrar">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_cancelacion_notas_credito_digitales_cuentas_cobrar" 
											name="strFolio_cancelacion_notas_credito_digitales_cuentas_cobrar" type="text" value="" 
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
									<input id="txtSustitucionID_cancelacion_notas_credito_digitales_cuentas_cobrar" 
										   name="intSustitucionID_cancelacion_notas_credito_digitales_cuentas_cobrar" 
										   type="hidden" value="" />	
									<!-- Caja de texto oculta que se utiliza para recuperar el UUID de la factura que sustituye-->
									<input id="txtUuidSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar" 
										   name="strUuidSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar" 
										   type="hidden" value="" />	   
									<label for="txtFolioSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar">Sustitución</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolioSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar" 
											name="strFolioSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese anticipos" maxlength="250" >
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Div que contiene los campos del usuario y fecha del registro -->
			 		<div  id="divDatosCreacion_cancelacion_notas_credito_digitales_cuentas_cobrar" class="row no-mostrar">
			 			<!--Usuario que realizó la cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuarioCreacion_cancelacion_notas_credito_digitales_cuentas_cobrar">Usuario de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuarioCreacion_cancelacion_notas_credito_digitales_cuentas_cobrar" 
											name="strUsuarioCreacion_cancelacion_notas_credito_digitales_cuentas_cobrar" type="text" value="" 
											 disabled >
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaCreacion_cancelacion_notas_credito_digitales_cuentas_cobrar">Fecha de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFechaCreacion_cancelacion_notas_credito_digitales_cuentas_cobrar" 
											name="strFechaCreacion_cancelacion_notas_credito_digitales_cuentas_cobrar" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cancelacion_notas_credito_digitales_cuentas_cobrar" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 						
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar cancelación del CFDI-->
							<button class="btn btn-success" id="btnGuardar_cancelacion_notas_credito_digitales_cuentas_cobrar"  
									onclick="validar_cancelacion_notas_credito_digitales_cuentas_cobrar();"  title="Cancelar CFDI" tabindex="1">
								<span class="fa fa-chain-broken"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cancelacion_notas_credito_digitales_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_cancelacion_notas_credito_digitales_cuentas_cobrar();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cancelación del timbrado-->


		<!-- Diseño del modal Notas de Crédito Digitales-->
		<div id="NotasCreditoDigitalesCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_notas_credito_digitales_cuentas_cobrar"  class="ModalBodyTitle">
			<h1>Notas de Crédito Digitales</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_notas_credito_digitales_cuentas_cobrar" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_notas_credito_digitales_cuentas_cobrar" class="active">
									<a data-toggle="tab" href="#informacion_general_notas_credito_digitales_cuentas_cobrar">Información General</a>
								</li>
								<!--Tab que contiene la información de los CFDI relacionados-->
								<li id="tabCfdiRelacionados_notas_credito_digitales_cuentas_cobrar">
									<a data-toggle="tab" href="#cfdi_relacionados_notas_credito_digitales_cuentas_cobrar">CFDI Relacionados</a>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<!--Diseño del formulario-->
				<form id="frmNotasCreditoDigitalesCuentasCobrar" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmNotasCreditoDigitalesCuentasCobrar"  onsubmit="return(false)" 
					  autocomplete="off" enctype="multipart/form-data">
					  <!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_notas_credito_digitales_cuentas_cobrar" class="tab-pane fade in active">
							<div class="row">
								<!--Folio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar" 
												   name="intNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" 
												   value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_notas_credito_digitales_cuentas_cobrar" 
												   name="strEstatus_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" 
												   value="" />
										   <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
											<input id="txtPolizaID_notas_credito_digitales_cuentas_cobrar" 
												   name="intPolizaID_notas_credito_digitales_cuentas_cobrar" type="hidden" value="" />
											 <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
											<input id="txtFolioPoliza_notas_credito_digitales_cuentas_cobrar" 
												   name="strFolioPoliza_notas_credito_digitales_cuentas_cobrar" type="hidden" value="" />
										   <!-- Caja de texto oculta que se utiliza para recuperar el id de la cancelación del registro seleccionado-->
											<input id="txtCancelacionID_notas_credito_digitales_cuentas_cobrar" 
												   name="intCancelacionID_notas_credito_digitales_cuentas_cobrar" type="hidden" value="" />
											<label for="txtFolio_notas_credito_digitales_cuentas_cobrar">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtFolio_notas_credito_digitales_cuentas_cobrar" 
													name="strFolio_notas_credito_digitales_cuentas_cobrar" 
													type="text" 
													value="" 
													placeholder="Autogenerado" 
													disabled />
										</div>
									</div>
								</div>
								<!--Fecha-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_notas_credito_digitales_cuentas_cobrar">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_notas_credito_digitales_cuentas_cobrar'>
							                    <input 	class="form-control" 
							                    		id="txtFecha_notas_credito_digitales_cuentas_cobrar"
							                    		name= "strFecha_notas_credito_digitales_cuentas_cobrar" 
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
								<!--Combobox que contiene las monedas activas-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbMonedaID_notas_credito_digitales_cuentas_cobrar">Moneda</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbMonedaID_notas_credito_digitales_cuentas_cobrar" 
											 		name="intMonedaID_notas_credito_digitales_cuentas_cobrar" tabindex="1">
		                     				</select>
										</div>
									</div>
								</div>
								<!--Tipo de cambio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTipoCambio_notas_credito_digitales_cuentas_cobrar">Tipo de cambio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control tipo-cambio_notas_credito_digitales_cuentas_cobrar" 
													id="txtTipoCambio_notas_credito_digitales_cuentas_cobrar" 
													name="intTipoCambio_notas_credito_digitales_cuentas_cobrar" 
													type="text" 
													value="" 
													tabindex="1" 
													placeholder="Ingrese tipo de cambio" 
													maxlength="11" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene los clientes activos-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del cliente seleccionado-->
											<input id="txtProspectoID_notas_credito_digitales_cuentas_cobrar" 
												   name="intProspectoID_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />   
										      <!-- Caja de texto oculta para recuperar el id del régimen fiscal del cliente seleccionado-->
											<input id="txtRegimenFiscalID_notas_credito_digitales_cuentas_cobrar" 
												   name="intRegimenFiscalID_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar la calle del cliente seleccionado-->
											<input id="txtCalle_notas_credito_digitales_cuentas_cobrar" 
												   name="strCalle_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el número exterior del cliente seleccionado-->
											<input id="txtNumeroExterior_notas_credito_digitales_cuentas_cobrar" 
												   name="strNumeroExterior_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el número interior del cliente seleccionado-->
											<input id="txtNumeroInterior_notas_credito_digitales_cuentas_cobrar" 
												   name="strNumeroInterior_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el código postal del cliente seleccionado-->
											<input id="txtCodigoPostal_notas_credito_digitales_cuentas_cobrar" 
												   name="strCodigoPostal_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar la colonia del cliente seleccionado-->
											<input id="txtColonia_notas_credito_digitales_cuentas_cobrar" 
												   name="strColonia_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar la localidad del cliente seleccionado-->
											<input id="txtLocalidad_notas_credito_digitales_cuentas_cobrar" 
												   name="strLocalidad_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el municipio del cliente seleccionado-->
											<input id="txtMunicipio_notas_credito_digitales_cuentas_cobrar" 
												   name="strMunicipio_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el estado del cliente seleccionado-->
											<input id="txtEstado_notas_credito_digitales_cuentas_cobrar" 
												   name="strEstado_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el país del cliente seleccionado-->
											<input id="txtPais_notas_credito_digitales_cuentas_cobrar" 
												   name="strPais_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />
											<label for="txtRazonSocial_notas_credito_digitales_cuentas_cobrar">
												Razón social
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRazonSocial_notas_credito_digitales_cuentas_cobrar" 
													name="strRazonSocial_notas_credito_digitales_cuentas_cobrar" type="text" value=""   
													tabindex="1" placeholder="Ingrese razón social" maxlength="250" />
										</div>
									</div>
								</div>
								<!--RFC-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRfc_notas_credito_digitales_cuentas_cobrar">RFC</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRfc_notas_credito_digitales_cuentas_cobrar"
												   name="strRfc_notas_credito_digitales_cuentas_cobrar" 
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
											<input id="txtFormaPagoID_notas_credito_digitales_cuentas_cobrar" 
												   name="intFormaPagoID_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />
											<label for="txtFormaPago_notas_credito_digitales_cuentas_cobrar">
												Forma de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFormaPago_notas_credito_digitales_cuentas_cobrar" 
													name="strFormaPago_notas_credito_digitales_cuentas_cobrar" type="text" value=""  
													tabindex="1" placeholder="Ingrese forma de pago" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los métodos de pago activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del método de pago seleccionado-->
											<input id="txtMetodoPagoID_notas_credito_digitales_cuentas_cobrar" 
												   name="intMetodoPagoID_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden"/>
											<label for="txtMetodoPago_notas_credito_digitales_cuentas_cobrar">
												Método de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtMetodoPago_notas_credito_digitales_cuentas_cobrar" 
													name="strMetodoPago_notas_credito_digitales_cuentas_cobrar" 
													type="text"  
													tabindex="1" 
													placeholder="Ingrese método de pago" 
													maxlength="250" />
										</div>
									</div>
								</div>
								<!--Combobox que contiene la exportación activa-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbExportacionID_notas_credito_digitales_cuentas_cobrar">Exportación</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbExportacionID_notas_credito_digitales_cuentas_cobrar"
											        name="intExportacionID_notas_credito_digitales_cuentas_cobrar" tabindex="1">
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
											<input id="txtUsoCfdiID_notas_credito_digitales_cuentas_cobrar" 
												   name="intUsoCfdiID_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" />
											<label for="txtUsoCfdi_notas_credito_digitales_cuentas_cobrar">
												Uso del CFDI
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtUsoCfdi_notas_credito_digitales_cuentas_cobrar" 
													name="strUsoCfdi_notas_credito_digitales_cuentas_cobrar" 
													type="text"  
													tabindex="1" 
													placeholder="Ingrese uso del CFDI" 
													maxlength="250" />
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los usos de cfdi activos-->
								<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del tipo de relación seleccionado-->
											<input id="txtTipoRelacionID_notas_credito_digitales_cuentas_cobrar" 
												   name="intTipoRelacionID_notas_credito_digitales_cuentas_cobrar" 
												   type="hidden" value="" />
											<label for="txtTipoRelacion_notas_credito_digitales_cuentas_cobrar">
												Tipo de relación
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTipoRelacion_notas_credito_digitales_cuentas_cobrar" 
													name="strTipoRelacion_notas_credito_digitales_cuentas_cobrar" type="text" value=""  
													tabindex="1" 
													placeholder="Ingrese tipo de relación" maxlength="250" />
										</div>
									</div>
								</div>
							</div>
						    <div class="row">
						    	<!--Observaciones-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObservaciones_notas_credito_digitales_cuentas_cobrar">Observaciones</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtObservaciones_notas_credito_digitales_cuentas_cobrar" 
													name="strObservaciones_notas_credito_digitales_cuentas_cobrar" 
													type="text" value="" tabindex="1" 
													placeholder="Ingrese observaciones" maxlength="250" />
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
												<input id="txtNumDetalles_notas_credito_digitales_cuentas_cobrar" 
													   name="intNumDetalles_notas_credito_digitales_cuentas_cobrar" 
													   type="hidden" 
													   value="" />
										    </div>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">Detalles de la nota de crédito digital</h4>
												</div>
												<div class="panel-body">
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!--Botones-->
															<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																<div class="btn-group pull-right">
																	<!--Buscar documentos a relacionar para agregarlos en la tabla-->
																	<button class="btn btn-primary" 
									                                			id="btnBuscarDoc_notas_credito_digitales_cuentas_cobrar" 
									                                			onclick="abrir_relacionar_fras_notas_credito_digitales_cuentas_cobrar();" 
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
																		<input id="txtReferenciaID_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																			   name="intReferenciaID_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																			   type="hidden" value="">
																		</input>
																		<!-- Caja de texto oculta que se utiliza para recuperar el saldo de la factura-->
		                                                                <input id="txtSaldoFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
		                                                                       name="intSaldoFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
		                                                                       type="hidden" value="">
		                                                                </input>
		                                                                <!-- Caja de texto oculta que se utiliza para recuperar el id de la moneda de la referencia seleccionada-->
																		<input id="txtMonedaID_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																			   name="intMonedaID_fras_relacionadas_notas_credito_digitales_cuentas_cobrar"  
																			   type="hidden" value="">
																	    </input>
																	     <!-- Caja de texto oculta que se utiliza para recuperar el id de la tasa del impuesto de IVA de la referencia seleccionada-->
																		<input id="txtTasaCuotaIvaFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																			   name="intTasaCuotaIvaFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar"  
																			   type="hidden" value="">
																	    </input>
																	    <!-- Caja de texto oculta que se utiliza para recuperar el id de la tasa del impuesto de IEPS de la referencia seleccionada-->
																	    <input id="txtTasaCuotaIepsFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																			   name="intTasaCuotaIepsFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar"  
																			   type="hidden" value="">
																	    </input>
																		<label for="txtReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">
																			Folio
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																				name="strReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" type="text" value="" disabled>
																		</input>
																	</div>
																</div>
															</div>
															<!--Fecha-->
															<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtFecha_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">Fecha</label>
																	</div>
																	<div  class="col-md-12">
																		<div class='input-group date'>
														                    <input class="form-control" id="txtFecha_fras_relacionadas_notas_credito_digitales_cuentas_cobrar"
														                    		name= "strFecha_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
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
																		<label for="txtTipoReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">Módulo</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtTipoReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																				name="strTipoReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" type="text" value="" disabled>
																		</input>
																	</div>
																</div>
															</div>
															<!--Moneda-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtMonedaTipo_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">
																			Moneda
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtMonedaTipo_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																				name="strMonedaTipo_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" type="text" value="" disabled>
																		</input>
																	</div>
																</div>
															</div>
															<!--Tipo de cambio-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtTipoCambio_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">Tipo de cambio</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtTipoCambio_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																				name="strTipoCambio_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" type="text" value="" disabled>
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
																		<label for="txtConcepto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">
																			Concepto
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" 
																				id="txtConcepto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																				name="strConcepto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
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
															<!--Autocomplete que contiene los objetos de impuesto-->
															<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">Objeto de impuesto SAT</label>
																	</div>
																	<div class="col-md-12">
																		<!-- Caja de texto oculta que se utiliza para recuperar el código del objeto de impuesto seleccionado-->
																		<input id="txtObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																			   name="strObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar"  
																			   type="hidden" value="">
																	    </input>
																		<input  class="form-control" id="txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																				name="strObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" type="text" 
																				value="" tabindex="1" placeholder="Ingrese objeto de impuesto SAT" maxlength="250">
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
																		<label for="txtSubtotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">Subtotal</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtSubtotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																				name="intSubtotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" type="text" value="" disabled>
																		</input>
																	</div>
																</div>
															</div>
															<!--IVA-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtIvaFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">IVA</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtIvaFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																				name="intIvaFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" type="text" value="" disabled>
																		</input>
																	</div>
																</div>
															</div>
															<!--IEPS-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtIepsFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">
																			IEPS
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" 
																				id="txtIepsFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																				name="intIepsFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																				type="text" value="" disabled>
																		</input>
																	</div>
																</div>
															</div>
															<!--Total-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtImporteTotal_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">Total</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtImporteTotal_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																				name="intImporteTotal_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" type="text" value="" disabled>
																		</input>
																	</div>
																</div>
															</div>
															<!--Importe (pago)-->
															<div class="col-sm-3 col-md-3 col-lg-3 col-xs-10">
																<div class="form-group">
																	<div class="col-md-12">
																		<!-- Caja de texto oculta que se utiliza para recuperar el importe auxiliar de la referencia seleccionada-->
																		<input id="txtAbonoAux_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																			   name="intAbonoAux_fras_relacionadas_notas_credito_digitales_cuentas_cobrar"  
																			    type="hidden" value="">
																	    </input>
																		<label for="txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">Pago</label>
																	</div>
																	<div class="col-md-12">
																		<div class='input-group'>
																			<input  class="form-control moneda_notas_credito_digitales_cuentas_cobrar" id="txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" 
																					name="intAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" type="text" value="" 
																					tabindex="1" placeholder="Ingrese pago" maxlength="22">
																			</input>
																			<span id="spnMonedaNotaCredito_fras_relacionadas_notas_credito_digitales_cuentas_cobrar" class="input-group-addon"></span>
																		</div>
																	</div>
																</div>
															</div>
															<!--Botón agregar-->
							                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
							                                	<button class="btn btn-primary btn-toolBtns pull-right" 
							                                			id="btnAgregar_notas_credito_digitales_cuentas_cobrar"
							                                			onclick="agregar_renglon_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();" 
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
															<table class="table-hover movil" id="dg_detalles_notas_credito_digitales_cuentas_cobrar">
																<thead class="movil">
																	<tr class="movil">
																		<th class="movil">Folio</th>
																		<th class="movil">Módulo</th>
																		<th class="movil">Moneda</th>
																		<th class="movil">T.C.</th>
																		<th class="movil">Concepto</th>
																		<th class="movil">IVA %</th>
																		<th class="movil">IEPS %</th>
																		<th class="movil">Total</th>
																		<th class="movil">Importe</th>
																		<th class="movil">Saldo</th>
																		<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
																	</tr>
																</thead>
																<tbody class="movil"></tbody>
																<tfoot class="movil">
																	<tr class="movil">
																		<td class="movil et1">
																			<strong>Total</strong>
																		</td>
																		<td class="movil et2"></td>
																		<td class="movil et3"></td>
																		<td class="movil et4"></td>
																		<td class="movil et5"></td>
																		<td class="movil et6"></td>
																		<td class="movil et7"></td>
																		<td class="movil et8">
																			<strong id="acumTotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">$0.00</strong>
																		</td>
																		<td class="movil et9">
																			<strong id="acumAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">$0.00</strong>
																		</td>
																		<td class="movil et10">
																			<strong id="acumSaldoFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar">$0.00</strong>
																			<strong id="monedaNotaCredito_fras_relacionadas_notas_credito_digitales_cuentas_cobrar"></strong>
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
																		<strong id="numElementos_detalles_notas_credito_digitales_cuentas_cobrar">0</strong> encontrados
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
						<!--Cierre del contenido del tab - Información General-->
						<!--Tab - CFDI relacionados-->
						<div id="cfdi_relacionados_notas_credito_digitales_cuentas_cobrar" class="tab-pane fade">
							<div class="row">
								<!--Botones-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="btn-group pull-right">
										<!--Buscar CFDI a relacionar para agregarlos en la tabla-->
										<button class="btn btn-primary" 
		                                			id="btnBuscarCFDI_notas_credito_digitales_cuentas_cobrar" 
		                                			onclick="abrir_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar();" 
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
									<!-- Caja de texto oculta para asignar el número de registros de la tabla CFDI  a relacionar--> 
									<input id="txtNumCfdiRelacionados_notas_credito_digitales_cuentas_cobrar" 
										   name="intNumCfdiRelacionados_notas_credito_digitales_cuentas_cobrar" type="hidden" value="">
									</input>
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar">
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
												<strong id="numElementos_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--Cierre del contenido del tab - CFDI relacionados-->
					</div>	
					<!-- Cierre del tab-content -->
					<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_notas_credito_digitales_cuentas_cobrar" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" 
									id="btnGuardar_notas_credito_digitales_cuentas_cobrar"  
									onclick="validar_notas_credito_digitales_cuentas_cobrar();"  
									title="Guardar" 
									tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_notas_credito_digitales_cuentas_cobrar"  
									onclick="abrir_cliente_notas_credito_digitales_cuentas_cobrar('');"  
									title="Enviar correo electrónico" tabindex="3" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Ver motivo de cancelación del registro-->
							<button class="btn btn-default" id="btnVerMotivoCancelacion_notas_credito_digitales_cuentas_cobrar"  
									onclick="ver_cancelacion_notas_credito_digitales_cuentas_cobrar('');"  title="Ver motivo de cancelación" tabindex="4">
								<i class="fa fa-info-circle" aria-hidden="true"></i>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_notas_credito_digitales_cuentas_cobrar"  
									onclick="reporte_registro_notas_credito_digitales_cuentas_cobrar('');"  
									title="Imprimir registro en PDF" 
									tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivos-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_notas_credito_digitales_cuentas_cobrar"  
									onclick="descargar_archivos_notas_credito_digitales_cuentas_cobrar('', '');"  title="Descargar archivos" tabindex="6" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" 
									id="btnDesactivar_notas_credito_digitales_cuentas_cobrar"  
									onclick="cambiar_estatus_notas_credito_digitales_cuentas_cobrar('', '', '', '');"  
									title="Desactivar" 
									tabindex="7" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  
									id="btnCerrar_notas_credito_digitales_cuentas_cobrar"
									type="reset" 
									aria-hidden="true" 
									onclick="cerrar_notas_credito_digitales_cuentas_cobrar();" 
									title="Cerrar"  
									tabindex="8">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Notas de Crédito Digitales-->

		<!-- Diseño del modal Relacionar Documentos (facturas) de la Nota de Crédito Digital-->
		<div id="RelacionarFrasNotasCreditoDigitalesCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_fras_notas_credito_digitales_cuentas_cobrar" class="ModalBodyTitle">
			<h1>Facturas que Adeuda el Cliente</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarFrasNotasCreditoDigitalesCuentasCobrar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarFrasNotasCreditoDigitalesCuentasCobrar"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Razón social-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del prospecto seleccionado-->
									<input id="txtProspectoIDBusq_relacionar_fras_notas_credito_digitales_cuentas_cobrar" 
										   name="intProspectoIDBusq_relacionar_fras_notas_credito_digitales_cuentas_cobrar"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_fras_notas_credito_digitales_cuentas_cobrar">Razón social</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRazonSocialBusq_relacionar_fras_notas_credito_digitales_cuentas_cobrar" 
										   name="strRazonSocialBusq_relacionar_fras_notas_credito_digitales_cuentas_cobrar"  type="text" value="">
									</input>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group row">
						<!--Div que contiene la tabla con las facturas encontradas-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<!-- Caja de texto oculta para asignar el número de registros de la tabla facturas a relacionar--> 
							<input id="txtNumFras_relacionar_fras_notas_credito_digitales_cuentas_cobrar" 
								   name="intNumFras_relacionar_fras_notas_credito_digitales_cuentas_cobrar" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_fras_notas_credito_digitales_cuentas_cobrar">
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
								<script id="plantilla_relacionar_fras_notas_credito_digitales_cuentas_cobrar" type="text/template"> 
								{{#rows}}
									<tr class="movil">  
										<td class="movil-no-mostrar no-mostrar d1">{{referencia_id}}</td>
										<td class="movil-no-mostrar no-mostrar d2">{{uuid}}</td>
										<td class="movil-no-mostrar no-mostrar d3">{{tipo_cambio}}</td>
										<td class="movil-no-mostrar no-mostrar d4">{{moneda_id}}</td>
										<td class="movil-no-mostrar no-mostrar d5">{{subtotal}}</td>
										<td class="movil-no-mostrar no-mostrar d6">{{tasa_cuota_iva}}</td>
										<td class="movil-no-mostrar no-mostrar d7">{{iva}}</td>
										<td class="movil-no-mostrar no-mostrar d8">{{tasa_cuota_ieps}}</td>
										<td class="movil-no-mostrar no-mostrar d9">{{ieps}}</td>
										<td class="movil-no-mostrar no-mostrar d10">{{importe_fra_cfdi}}</td>
										<td class="movil-no-mostrar no-mostrar d11">{{tipo_ieps}}</td>
										<td class="movil-no-mostrar no-mostrar d12">{{factor_ieps}}</td>
										<td class="movil-no-mostrar no-mostrar d13">{{tipo_referencia_cfdi}}</td>
										<td class="movil d14">{{folio}}</td>
										<td class="movil d15">{{moneda_tipo}}</td>
										<td class="movil d16">{{fecha}}</td>
										<td class="movil d17">{{vencimiento}}</td>
										<td class="movil d18">{{tipo_referencia}}</td>
										<td class="movil d19">{{porcentaje_iva}}</td>
										<td class="movil d20">{{porcentaje_ieps}}</td>
										<td class="movil d21">{{importe}}</td>
										<td class="movil d22">{{saldo}}</td>
										<td class="movil d23">{{saldo_vencido}}</td>
										<td class="td-center movil d24"> 
											 <input 	type="checkbox" 
							    		class="form-check-input btn-xs" 
							    		id="chbAgregar_relacionar_fras_notas_credito_digitales_cuentas_cobrar" />
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
										<td class="movil dt1">
											<strong>Total</strong>
										</td>
										<td  class="movil dt2"></td>
										<td  class="movil dt3"></td>
										<td  class="movil dt4"></td>
										<td  class="movil dt5"></td>
										<td class="movil dt6"></td>
										<td class="movil dt7"></td>
										<td class="movil dt8"></td>
										<td class="movil dt9">
											<strong id="acumSaldo_relacionar_fras_notas_credito_digitales_cuentas_cobrar">$0.00</strong>
										</td>
										<td class="movil dt10">
											<strong  id="acumSaldoVencido_relacionar_fras_notas_credito_digitales_cuentas_cobrar">$0.00</strong>
										</td>
										<td class="movil"></td>
									</tr>
									<tr class="movil">
										<td class="movil dt1">
											<strong>Anticipo</strong>
										</td>
										<td  class="movil dt2"></td>
										<td  class="movil dt3"></td>
										<td  class="movil dt4"></td>
										<td class="movil dt5"></td>
										<td class="movil dt6"></td>
										<td class="movil dt7"></td>
										<td class="movil dt8"></td>
										<td class="movil dt9">
											<strong id="acumAntSaldo_relacionar_fras_notas_credito_digitales_cuentas_cobrar">$0.00</strong>
										</td>
										<td class="movil dt10">
											<strong  id="acumAntSaldoVencido_relacionar_fras_notas_credito_digitales_cuentas_cobrar">$0.00</strong>
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
										<strong id="numElementos_relacionar_fras_notas_credito_digitales_cuentas_cobrar">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar facturas-->
							<button class="btn btn-success" id="btnAgregar_relacionar_fras_notas_credito_digitales_cuentas_cobrar"  
									onclick="validar_relacionar_fras_notas_credito_digitales_cuentas_cobrar();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_fras_notas_credito_digitales_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_fras_notas_credito_digitales_cuentas_cobrar();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar Documentos (facturas) de la Nota de Crédito Digital-->
	</div><!--#NotasCreditoDigitalesCuentasCobrarContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_notas_credito_digitales_cuentas_cobrar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>

	<!-- /.Plantilla para cargar los motivo de cancelación en el combobox-->  
	<script id="cancelacion_motivos_notas_credito_digitales_cuentas_cobrar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#motivos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/motivos}} 
	</script>

	<!-- /.Plantilla para cargar la exportación en el combobox-->  
	<script id="exportacion_notas_credito_digitales_cuentas_cobrar" type="text/template">
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
		var intPaginaNotasCreditoDigitalesCuentasCobrar = 0;
		var strUltimaBusquedaNotasCreditoDigitalesCuentasCobrar = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar en el timbrado y cfdi's relacionados)*/
		var strTipoReferenciaNotasCreditoDigitalesCuentasCobrar = "NOTA CREDITO";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDNotasCreditoDigitalesCuentasCobrar = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el id de la exportación base
		var intExportacionBaseIDNotasCreditoDigitalesCuentasCobrar = <?php echo EXPORTACION_BASE ?>;
		//Variable que se utiliza para asignar el id del objeto de impuesto base
		var intObjetoImpuestoBaseIDNotasCreditoDigitalesCuentasCobrar = <?php echo OBJETOIMP_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseNotasCreditoDigitalesCuentasCobrar = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoNotasCreditoDigitalesCuentasCobrar = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar el código de la moneda seleccionada (de la nota de crédito digital)
		var strMonedaNotasCreditoDigitalesCuentasCobrar = "";
		//Variable que se utiliza para asignar el id del motivo de cancelación: Comprobante emitido con errores con relación.
		var intCancelacionIDRelacionCfdiNotasCreditoDigitalesCuentasCobrar = <?php echo MOTIVO_CANCELACION_RELACIONCFDI ?>;
		//Variable que se utiliza para asignar el mensaje de régimen fiscal faltante.
		var strMsjRegimenFiscalCteNotasCreditoDigitalesCuentasCobrar = "<?php echo MSJ_ERROR_REGIMEN_FISCAL ?>";

		//Variable que se utiliza para asignar objeto del modal Cancelación del timbrado
		var objCancelacionNotasCreditoDigitalesCuentasCobrar = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarNotasCreditoDigitalesCuentasCobrar = null;
		//Variable que se utiliza para asignar objeto del modal Relacionar CFDI
		var objRelacionarCfdiNotasCreditoDigitalesCuentasCobrar = null;
		//Variable que se utiliza para asignar objeto del modal Notas de Crédito Digitales Digital
		var objNotasCreditoDigitalesCuentasCobrar = null;
		//Variable que se utiliza para asignar objeto del modal Relacionar Documentos (facturas) de la Nota de Crédito Digital
		var objRelacionarFrasNotasCreditoDigitalesCuentasCobrar = null;

		/*******************************************************************************************************************
		Funciones del objeto facturas relacionadas (seleccionadas)
		*********************************************************************************************************************/
		// Constructor del objeto facturas relacionadas (seleccionadas)
		var objFrasRelacionadasNotasCreditoDigitalesCuentasCobrar;
		function FrasRelacionadasNotasCreditoDigitalesCuentasCobrar(fras)
		{
			this.arrFras = fras;
		}

		//Función para obtener todas las facturas seleccionadas del pago
		FrasRelacionadasNotasCreditoDigitalesCuentasCobrar.prototype.getFacturas = function() {
		    return this.arrFras;
		}

		//Función para agregar una factura al objeto 
		FrasRelacionadasNotasCreditoDigitalesCuentasCobrar.prototype.setFactura = function (fra){
			this.arrFras.push(fra);
		}

		//Función para obtener una factura del objeto 
		FrasRelacionadasNotasCreditoDigitalesCuentasCobrar.prototype.getFactura = function(index) {
		    return this.arrFras[index];
		}

		/*******************************************************************************************************************
		Funciones del objeto facturas a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto facturas a relacionar
		var objFraRelacionarNotasCreditoDigitalesCuentasCobrar;
		
		function FraRelacionarNotasCreditoDigitalesCuentasCobrar(referenciaID, tipoReferencia, tipoReferenciaCfdi,
																 folio, fecha, monedaID, monedaTipo, tipoCambio,
																 subtotalFactura, tasaCuotaIvaFactura, porcentajeIva, ivaFactura, 
																 tasaCuotaIepsFactura, porcentajeIeps, iepsFactura, 
																 impFactura,impPagado, saldoInsoluto, saldoFactura, 
																 tipoTasaCuotaIeps, factorTasaCuotaIeps)
		{
		    this.intReferenciaID = referenciaID;
		    this.strTipoReferencia = tipoReferencia;
		    this.strTipoReferenciaCfdi = tipoReferenciaCfdi;
		    this.strFolio = folio;
		    this.dteFecha = fecha;
		    this.intMonedaID = monedaID;
		    this.strMonedaTipo = monedaTipo;
		    this.intTipoCambio = tipoCambio;
		    this.intSubtotalFactura = subtotalFactura;
		    this.intTasaCuotaIvaFactura = tasaCuotaIvaFactura;
		    this.intPorcentajeIvaFactura = porcentajeIva;
		    this.intIvaFactura = ivaFactura;
		    this.intTasaCuotaIepsFactura = tasaCuotaIepsFactura;
		    this.intPorcentajeIepsFactura = porcentajeIeps;
		    this.intIepsFactura = iepsFactura;
		    this.intTotalFactura = impFactura;
		    this.intAbono = impPagado;
		    this.intSaldoInsoluto = saldoInsoluto;
		    this.intSaldoFactura = saldoFactura;
		    this.strTipoTasaCuotaIeps = tipoTasaCuotaIeps;
		    this.strFactorTasaCuotaIeps = factorTasaCuotaIeps;
		}

		/*******************************************************************************************************************
		Funciones del objeto CFDI's  relacionados (facturas seleccionadas)
		*********************************************************************************************************************/
		// Constructor del objeto CFDI's relacionados (facturas seleccionadas)
		var objCfdisRelacionadosNotasCreditoDigitalesCuentasCobrar;
		function CfdisRelacionadosNotasCreditoDigitalesCuentasCobrar(cfdis)
		{
			this.arrCfdis = cfdis;
		}

		//Función para obtener todos los cfdi´s seleccionados
		CfdisRelacionadosNotasCreditoDigitalesCuentasCobrar.prototype.getCfdis = function() {
		    return this.arrCfdis;
		}

		//Función para agregar un cfdi al objeto 
		CfdisRelacionadosNotasCreditoDigitalesCuentasCobrar.prototype.setCfdi = function (cfdi){
			this.arrCfdis.push(cfdi);
		}

		//Función para obtener un cfdi del objeto 
		CfdisRelacionadosNotasCreditoDigitalesCuentasCobrar.prototype.getCfdi = function(index) {
		    return this.arrCfdis[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto CFDI a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto CFDI a relacionar
		var objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar;
		
		function CfdiRelacionarNotasCreditoDigitalesCuentasCobrar(referenciaID, cliente, folio, fecha, tipoReferencia, uuid, importe)
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
		function permisos_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_cobrar/notas_credito_digitales/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_notas_credito_digitales_cuentas_cobrar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosNotasCreditoDigitalesCuentasCobrar = data.row;
					//Separar la cadena 
					var arrPermisosNotasCreditoDigitalesCuentasCobrar = strPermisosNotasCreditoDigitalesCuentasCobrar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosNotasCreditoDigitalesCuentasCobrar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosNotasCreditoDigitalesCuentasCobrar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosNotasCreditoDigitalesCuentasCobrar[i]=='GUARDAR') || (arrPermisosNotasCreditoDigitalesCuentasCobrar[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosNotasCreditoDigitalesCuentasCobrar[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
						}
						//Si el indice es ENVIAR CORREO
						else if(arrPermisosNotasCreditoDigitalesCuentasCobrar[i]=='ENVIAR CORREO')
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosNotasCreditoDigitalesCuentasCobrar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_notas_credito_digitales_cuentas_cobrar();
						}
						else if(arrPermisosNotasCreditoDigitalesCuentasCobrar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosNotasCreditoDigitalesCuentasCobrar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosNotasCreditoDigitalesCuentasCobrar[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosNotasCreditoDigitalesCuentasCobrar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_notas_credito_digitales_cuentas_cobrar() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaNotasCreditoDigitalesCuentasCobrar =($('#txtFechaInicialBusq_notas_credito_digitales_cuentas_cobrar').val()+$('#txtFechaFinalBusq_notas_credito_digitales_cuentas_cobrar').val()+$('#txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar').val()+$('#cmbEstatusBusq_notas_credito_digitales_cuentas_cobrar').val()+$('#txtBusqueda_notas_credito_digitales_cuentas_cobrar').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaNotasCreditoDigitalesCuentasCobrar != strUltimaBusquedaNotasCreditoDigitalesCuentasCobrar)
			{
				intPaginaNotasCreditoDigitalesCuentasCobrar = 0;
				strUltimaBusquedaNotasCreditoDigitalesCuentasCobrar = strNuevaBusquedaNotasCreditoDigitalesCuentasCobrar;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/notas_credito_digitales/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_notas_credito_digitales_cuentas_cobrar').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_notas_credito_digitales_cuentas_cobrar').val()),
					 intProspectoID: $('#txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar').val(),
					 strEstatus: $('#cmbEstatusBusq_notas_credito_digitales_cuentas_cobrar').val(),
					 strBusqueda: $('#txtBusqueda_notas_credito_digitales_cuentas_cobrar').val(),
					 intPagina: intPaginaNotasCreditoDigitalesCuentasCobrar,
					 strPermisosAcceso: $('#txtAcciones_notas_credito_digitales_cuentas_cobrar').val()
					},
					function(data){
						$('#dg_notas_credito_digitales_cuentas_cobrar tbody').empty();
						var tmpNotasCreditoDigitalesCuentasCobrar = Mustache.render($('#plantilla_notas_credito_digitales_cuentas_cobrar').html(),data);
						$('#dg_notas_credito_digitales_cuentas_cobrar tbody').html(tmpNotasCreditoDigitalesCuentasCobrar);
						$('#pagLinks_notas_credito_digitales_cuentas_cobrar').html(data.paginacion);
						$('#numElementos_notas_credito_digitales_cuentas_cobrar').html(data.total_rows);
						intPaginaNotasCreditoDigitalesCuentasCobrar = data.pagina;
					},
			'json');
		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_notas_credito_digitales_cuentas_cobrar(notaCreditoDigitalID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(notaCreditoDigitalID == '')
			{
				intID = $('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val();
				strFolio = $('#txtFolio_notas_credito_digitales_cuentas_cobrar').val();
			}
			else
			{
				intID = notaCreditoDigitalID;
				strFolio = folio;
			}

			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'contabilidad/timbradoV4/descargar_archivos',
							'data' : {
										'intReferenciaID': intID,
										'strTipoReferencia': strTipoReferenciaNotasCreditoDigitalesCuentasCobrar,
										'strFolio': strFolio		
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_notas_credito_digitales_cuentas_cobrar(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_cobrar/notas_credito_digitales/';

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
			if ($('#chbImprimirDetalles_notas_credito_digitales_cuentas_cobrar').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_notas_credito_digitales_cuentas_cobrar').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_notas_credito_digitales_cuentas_cobrar').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial':  $.formatFechaMysql($('#txtFechaInicialBusq_notas_credito_digitales_cuentas_cobrar').val()),
										'dteFechaFinal':  $.formatFechaMysql($('#txtFechaFinalBusq_notas_credito_digitales_cuentas_cobrar').val()),
										'intProspectoID': $('#txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar').val(),
										'strEstatus': $('#cmbEstatusBusq_notas_credito_digitales_cuentas_cobrar').val(), 
										'strBusqueda': $('#txtBusqueda_notas_credito_digitales_cuentas_cobrar').val(),
										'strDetalles': $('#chbImprimirDetalles_notas_credito_digitales_cuentas_cobrar').val()						
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_notas_credito_digitales_cuentas_cobrar(id) 
		{	
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url':  'contabilidad/timbradoV4/get_pdf',
							'data' : {
										'intReferenciaID':intID,
										'strTipoReferencia':strTipoReferenciaNotasCreditoDigitalesCuentasCobrar,
										'strTimbrar': 'NO'		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);	
		}

		

		/*******************************************************************************************************************
		Funciones del modal Cancelación del timbrado
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cancelacion_notas_credito_digitales_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmCancelacionNotasCreditoDigitalesCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_notas_credito_digitales_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmCancelacionNotasCreditoDigitalesCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cancelacion_notas_credito_digitales_cuentas_cobrar');
			//Habilitar todos los elementos del formulario
			$('#frmCancelacionNotasCreditoDigitalesCuentasCobrar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_cancelacion_notas_credito_digitales_cuentas_cobrar').attr('disabled','disabled');
			//Mostrar botón de Guardar
		    $("#btnGuardar_cancelacion_notas_credito_digitales_cuentas_cobrar").show();
		    //Agregar clase para ocultar div que contiene los datos de creación del registro
			$("#divDatosCreacion_cancelacion_notas_credito_digitales_cuentas_cobrar").addClass('no-mostrar');
		}

		//Función que se utiliza para abrir el modal
		function abrir_cancelacion_notas_credito_digitales_cuentas_cobrar(id, folio, polizaID)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cancelacion_notas_credito_digitales_cuentas_cobrar();

			//Asignar datos del registro seleccionado
			$('#txtReferenciaCfdiID_cancelacion_notas_credito_digitales_cuentas_cobrar').val(id);
			$('#txtFolio_cancelacion_notas_credito_digitales_cuentas_cobrar').val(folio);
			$('#txtPolizaID_cancelacion_notas_credito_digitales_cuentas_cobrar').val(polizaID);
			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_cancelacion_notas_credito_digitales_cuentas_cobrar').addClass("estatus-ACTIVO");

		    //Abrir modal
			objCancelacionNotasCreditoDigitalesCuentasCobrar = $('#CancelacionNotasCreditoDigitalesCuentasCobrarBox').bPopup({
												   appendTo: '#NotasCreditoDigitalesCuentasCobrarContent', 
						                           contentContainer: 'NotasCreditoDigitalesCuentasCobrarM', 
						                           zIndex: 2, 
						                           modalClose: false, 
						                           modal: true, 
						                           follow: [true,false], 
						                           followEasing : "linear", 
						                           easing: "linear", 
						                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#cmbCancelacionMotivoID_cancelacion_notas_credito_digitales_cuentas_cobrar').focus();
		}

		//Función para regresar los datos (al formulario) del registro seleccionados
		function ver_cancelacion_notas_credito_digitales_cuentas_cobrar(id)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCancelacionID_notas_credito_digitales_cuentas_cobrar').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/cancelaciones/get_datos',
	        {
	       		intCancelacionID:intID,
	       		strTipoReferencia:strTipoReferenciaNotasCreditoDigitalesCuentasCobrar
	        },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			               //Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cancelacion_notas_credito_digitales_cuentas_cobrar();
							//Recuperar valores
							$('#cmbCancelacionMotivoID_cancelacion_notas_credito_digitales_cuentas_cobrar').val(data.row.cancelacion_motivo_id);
							$('#txtFolio_cancelacion_notas_credito_digitales_cuentas_cobrar').val(data.row.folio_referencia);
							$('#txtFolioSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar').val(data.row.folio_sustitucion);
							$('#txtUsuarioCreacion_cancelacion_notas_credito_digitales_cuentas_cobrar').val(data.row.usuario_creacion);
							$('#txtFechaCreacion_cancelacion_notas_credito_digitales_cuentas_cobrar').val(data.row.fecha_creacion);

							//Dependiendo del estatus cambiar el color del encabezado 
		   					$('#divEncabezadoModal_cancelacion_notas_credito_digitales_cuentas_cobrar').addClass("estatus-INACTIVO");

		   				    //Deshabilitar todos los elementos del formulario
				            $('#frmCancelacionNotasCreditoDigitalesCuentasCobrar').find('input, textarea, select').attr('disabled','disabled');
		   					//Ocultar botón de Guardar
				            $("#btnGuardar_cancelacion_notas_credito_digitales_cuentas_cobrar").hide();
				            //Remover clase para mostrar div que contiene los datos de creación del registro
							$("#divDatosCreacion_cancelacion_notas_credito_digitales_cuentas_cobrar").removeClass('no-mostrar');

							//Abrir modal
							objCancelacionNotasCreditoDigitalesCuentasCobrar = $('#CancelacionNotasCreditoDigitalesCuentasCobrarBox').bPopup({
												   appendTo: '#NotasCreditoDigitalesCuentasCobrarContent', 
						                           contentContainer: 'NotasCreditoDigitalesCuentasCobrarM', 
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
		function cerrar_cancelacion_notas_credito_digitales_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objCancelacionNotasCreditoDigitalesCuentasCobrar.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cancelacion_notas_credito_digitales_cuentas_cobrar();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cancelacion_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_notas_credito_digitales_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmCancelacionNotasCreditoDigitalesCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	intCancelacionMotivoID_notas_credito_digitales_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Seleccione un motivo'}
											}
										},
										strFolioSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if(value == '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_notas_credito_digitales_cuentas_cobrar').val()) === intCancelacionIDRelacionCfdiNotasCreditoDigitalesCuentasCobrar) 
					                                    	
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un anticipo existente'
					                                        };
					                                    }
					                                    else if(value !== '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_notas_credito_digitales_cuentas_cobrar').val()) !== intCancelacionIDRelacionCfdiNotasCreditoDigitalesCuentasCobrar)
					                                    {

					                                    	//Hacer un llamado a la función para inicializar elementos de la sustitución
					                                    	inicializar_sustitucion_notas_credito_digitales_cuentas_cobrar();
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cancelacion_notas_credito_digitales_cuentas_cobrar = $('#frmCancelacionNotasCreditoDigitalesCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_cancelacion_notas_credito_digitales_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cancelacion_notas_credito_digitales_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para cancelar el timbrado de un registro
				cancelar_timbrado_notas_credito_digitales_cuentas_cobrar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cancelacion_notas_credito_digitales_cuentas_cobrar()
		{
			try
			{
				$('#frmCancelacionNotasCreditoDigitalesCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		
		//Función para inicializar elementos de la sustitución de CFDI
		function inicializar_sustitucion_notas_credito_digitales_cuentas_cobrar()
		{
			
			//Limpiar contenido de las siguientes cajas de texto
           $('#txtSustitucionID_cancelacion_notas_credito_digitales_cuentas_cobrar').val('');
           $('#txtUuidSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar').val('');
           $('#txtFolioSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar').val('');
		}


		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function mostrar_circulo_carga_cancelacion_notas_credito_digitales_cuentas_cobrar()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_notas_credito_digitales_cuentas_cobrar").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function ocultar_circulo_carga_cancelacion_notas_credito_digitales_cuentas_cobrar()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_notas_credito_digitales_cuentas_cobrar").addClass('no-mostrar');
		}

		//Regresar motivos de cancelación activos para cargarlos en el combobox
		function cargar_motivos_cancelacion_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_cancelacion_motivos/get_combo_box', {},
				function(data)
				{
					$('#cmbCancelacionMotivoID_cancelacion_notas_credito_digitales_cuentas_cobrar').empty();
					var temp = Mustache.render($('#cancelacion_motivos_notas_credito_digitales_cuentas_cobrar').html(), data);
					$('#cmbCancelacionMotivoID_cancelacion_notas_credito_digitales_cuentas_cobrar').html(temp);
				},
				'json');
		}


		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cliente_notas_credito_digitales_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmEnviarNotasCreditoDigitalesCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_notas_credito_digitales_cuentas_cobrar();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cliente_notas_credito_digitales_cuentas_cobrar');
		    
		}


		//Función que se utiliza para abrir el modal
		function abrir_cliente_notas_credito_digitales_cuentas_cobrar(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cliente_notas_credito_digitales_cuentas_cobrar();
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val();
				
			}
			else
			{
				intID = id;
			}

		   //Hacer un llamado al método del controlador para regresar los datos del registro
		   $.post('cuentas_cobrar/notas_credito_digitales/get_datos',
	       {
	       		intNotaCreditoDigitalID:intID
	       },
	       function(data) {
	        	//Si hay datos del registro
	            if(data.row)
	            {
	            	//Asignar datos del registro seleccionado
					$('#txtNotaCreditoDigitalID_cliente_notas_credito_digitales_cuentas_cobrar').val(data.row.nota_credito_digital_id);
					$('#txtFolio_cliente_notas_credito_digitales_cuentas_cobrar').val(data.row.folio);
					$('#txtRazonSocial_cliente_notas_credito_digitales_cuentas_cobrar').val(data.row.razon_social);
					$('#txtCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar').val(data.row.correo_electronico);
					$('#txtCopiaCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar').val(data.row.contacto_correo_electronico);
					//Dependiendo del estatus cambiar el color del encabezado 
				    $('#divEncabezadoModal_cliente_notas_credito_digitales_cuentas_cobrar').addClass("estatus-"+data.row.estatus);

				    //Abrir modal
					objEnviarNotasCreditoDigitalesCuentasCobrar = $('#EnviarNotasCreditoDigitalesCuentasCobrarBox').bPopup({
																   appendTo: '#NotasCreditoDigitalesCuentasCobrarContent', 
										                           contentContainer: 'NotasCreditoDigitalesCuentasCobrarM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
					//Enfocar caja de texto
					$('#txtCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar').focus();
	            }
	         },
	       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cliente_notas_credito_digitales_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objEnviarNotasCreditoDigitalesCuentasCobrar.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cliente_notas_credito_digitales_cuentas_cobrar();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cliente_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_notas_credito_digitales_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarNotasCreditoDigitalesCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar: {
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
			var bootstrapValidator_cliente_notas_credito_digitales_cuentas_cobrar = $('#frmEnviarNotasCreditoDigitalesCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_cliente_notas_credito_digitales_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cliente_notas_credito_digitales_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_cliente_notas_credito_digitales_cuentas_cobrar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cliente_notas_credito_digitales_cuentas_cobrar()
		{
			try
			{
				$('#frmEnviarNotasCreditoDigitalesCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al cliente
		function enviar_correo_cliente_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cliente_notas_credito_digitales_cuentas_cobrar();
			//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
			$.post('contabilidad/timbradoV4/enviar_correo_electronico_cliente',
					{ 
						intReferenciaID: $('#txtNotaCreditoDigitalID_cliente_notas_credito_digitales_cuentas_cobrar').val(),
						strTipoReferencia: strTipoReferenciaNotasCreditoDigitalesCuentasCobrar,
						strFolio: $('#txtFolio_cliente_notas_credito_digitales_cuentas_cobrar').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_notas_credito_digitales_cuentas_cobrar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cliente_notas_credito_digitales_cuentas_cobrar();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_cliente_notas_credito_digitales_cuentas_cobrar();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_notas_credito_digitales_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_cliente_notas_credito_digitales_cuentas_cobrar()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_notas_credito_digitales_cuentas_cobrar").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_cliente_notas_credito_digitales_cuentas_cobrar()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_notas_credito_digitales_cuentas_cobrar").addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones del modal Relacionar CFDI
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmRelacionarCfdiNotasCreditoDigitalesCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarCfdiNotasCreditoDigitalesCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar');
			//Eliminar los datos de la tabla CFDI a relacionar
		    $('#dg_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar tbody').empty();
		    $('#numElementos_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').html(0);
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_notas_credito_digitales_cuentas_cobrar').val();
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').addClass("estatus-"+strEstatus);
			//Abrir modal
			objRelacionarCfdiNotasCreditoDigitalesCuentasCobrar = $('#RelacionarCfdiNotasCreditoDigitalesCuentasCobrarBox').bPopup({
											  appendTo: '#NotasCreditoDigitalesCuentasCobrarContent', 
			                              	  contentContainer: 'NotasCreditoDigitalesCuentasCobrarM', 
			                              	  zIndex: 2, 
			                              	  modalClose: false, 
			                              	  modal: true, 
			                              	  follow: [true,false], 
			                              	  followEasing : "linear", 
			                              	  easing: "linear", 
			                             	  modalColor: ('#F0F0F0')});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').focus();
			//Hacer un llamado a la función  para cargar los CFDI en el grid
			lista_facturas_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objRelacionarCfdiNotasCreditoDigitalesCuentasCobrar.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar()
		{

			//Hacer un llamado a la función para agregar las facturas (CFDI) seleccionadas al  objeto CFDI's  relacionados
			agregar_facturas_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarCfdiNotasCreditoDigitalesCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumCfdi_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccionar al menos un CFDI para esta nota de crédito digital.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFechaInicialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinalBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strRazonSocialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar = $('#frmRelacionarCfdiNotasCreditoDigitalesCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar();
				//Hacer un llamado a la función para agregar los CFDI en la tabla CFDI relacionados
		  		agregar_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar('Nuevo', '');
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar()
		{
			try
			{
				$('#frmRelacionarCfdiNotasCreditoDigitalesCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar CFDI's
		*********************************************************************************************************************/
		//Función para la búsqueda de CFDI's 
		function lista_facturas_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar() 
		{
			//Variables que se utilizan para asignar los criterios de búsqueda
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaInicialBusq =  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').val());
			var dteFechaFinalBusq =  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').val());
			var intProspectoIDBusq =  $('#txtProspectoIDBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').val();

			//Si no existen datos para realizar la búsqueda de coincidencias
			if(intProspectoIDBusq == '' && dteFechaInicialBusq == '' && dteFechaFinalBusq == '')
			{
				intProspectoIDBusq = 0;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/cfdi_relacionados/get_datos',
			{	
				dteFechaInicial:  dteFechaInicialBusq,
				dteFechaFinal:  dteFechaFinalBusq,
				intProspectoID: intProspectoIDBusq
			},
					function(data){

						$('#dg_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar tbody').empty();
						var tmpRelacionarCfdiNotasCreditoDigitalesCuentasCobrar = Mustache.render($('#plantilla_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').html(),data);
						$('#numElementos_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').html(data.rows.length);	
						}
						$('#dg_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar tbody').html(tmpRelacionarCfdiNotasCreditoDigitalesCuentasCobrar);
						
					},
			'json');
	
		}

		//Función para agregar las facturas (CFDI) seleccionadas al objeto CFDI's  relacionados
		function agregar_facturas_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
             
            //Crear instancia del objeto CFDI relacionados (facturas seleccionadas)
			objCfdisRelacionadosNotasCreditoDigitalesCuentasCobrar = new CfdisRelacionadosNotasCreditoDigitalesCuentasCobrar([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	//Crear instancia del objeto CFDI a relacionar
					objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar = new CfdiRelacionarNotasCreditoDigitalesCuentasCobrar(null, '', '', '', '', '', '');
                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.intReferenciaID = strValor;
							        break;
							    case 1:
							        objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strCliente = strValor;
							        break;
							    case 2:
							        objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strFolio = strValor;
							        break;
							    case 3:
							        objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.dteFecha = strValor;
							        break;
							    case 4:
							        objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strTipoReferencia = strValor;
							        break;
							    case 5:
							       	objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strUuid = strValor;
							        break;
							    case 6:
							       	objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.intImporte = strValor;
							       	break;
							}

					      	intCol++;
					    });

                	//Agregar datos del cfdi a relacionar
                	objCfdisRelacionadosNotasCreditoDigitalesCuentasCobrar.setCfdi(objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumCfdi_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').val(intContador);

		}


		/*******************************************************************************************************************
		Funciones del modal Notas de Crédito Digitales
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_notas_credito_digitales_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmNotasCreditoDigitalesCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_notas_credito_digitales_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmNotasCreditoDigitalesCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_notas_credito_digitales_cuentas_cobrar');
			//Hacer un llamado a la función para inicializar elementos de las tablas detalles y CFDI relacionados
			inicializar_detalles_notas_credito_digitales_cuentas_cobrar();

			//Habilitar todos los elementos del formulario
			$('#frmNotasCreditoDigitalesCuentasCobrar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Seleccionar tab que contiene la información general
		  	$('a[href="#informacion_general_notas_credito_digitales_cuentas_cobrar"]').click();
			//Asignar la fecha actual
			$('#txtFecha_notas_credito_digitales_cuentas_cobrar').val(fechaActual());
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtRfc_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtFecha_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtTipoReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtMonedaTipo_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtTipoCambio_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtSubtotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtIvaFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtIepsFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtImporteTotal_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");

			//Mostrar por Default 01- No aplica
			$('#cmbExportacionID_notas_credito_digitales_cuentas_cobrar').val(intExportacionBaseIDNotasCreditoDigitalesCuentasCobrar);

			//Mostrar los siguientes botones
			$("#btnGuardar_notas_credito_digitales_cuentas_cobrar").show();
			$("#btnBuscarCFDI_notas_credito_digitales_cuentas_cobrar").show(); 
			$('#btnBuscarDoc_notas_credito_digitales_cuentas_cobrar').show();
			//Ocultar los siguientes botones
			$("#btnEnviarCorreo_notas_credito_digitales_cuentas_cobrar").hide();
			$("#btnDescargarArchivo_notas_credito_digitales_cuentas_cobrar").hide();
			$("#btnImprimirRegistro_notas_credito_digitales_cuentas_cobrar").hide();
			$("#btnDesactivar_notas_credito_digitales_cuentas_cobrar").hide();
			$('#btnVerMotivoCancelacion_notas_credito_digitales_cuentas_cobrar').hide();
			//Deshabilitar botón Buscar facturas
			$('#btnBuscarDoc_notas_credito_digitales_cuentas_cobrar').attr('disabled','-1'); 
		}

		//Función para inicializar elementos del cliente
		function inicializar_cliente_notas_credito_digitales_cuentas_cobrar()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#txtRfc_notas_credito_digitales_cuentas_cobrar").val('');
            $("#txtRegimenFiscalID_notas_credito_digitales_cuentas_cobrar").val('');
            $("#txtCalle_notas_credito_digitales_cuentas_cobrar").val('');
            $("#txtNumeroExterior_notas_credito_digitales_cuentas_cobrar").val('');
            $("#txtNumeroInterior_notas_credito_digitales_cuentas_cobrar").val('');
            $("#txtCodigoPostal_notas_credito_digitales_cuentas_cobrar").val('');
            $("#txtColonia_notas_credito_digitales_cuentas_cobrar").val('');
            $("#txtLocalidad_notas_credito_digitales_cuentas_cobrar").val('');
            $("#txtMunicipio_notas_credito_digitales_cuentas_cobrar").val('');
            $("#txtEstado_notas_credito_digitales_cuentas_cobrar").val('');
            $("#txtPais_notas_credito_digitales_cuentas_cobrar").val('');
            //Deshabilitar botón Buscar facturas
            $('#btnBuscarDoc_notas_credito_digitales_cuentas_cobrar').attr('disabled','-1');
            //Hacer un llamado a la función para inicializar elementos de las tablas detalles y CFDI relacionados
		    inicializar_detalles_notas_credito_digitales_cuentas_cobrar();
		}

		
		//Función para inicializar elementos de las tablas detalles y CFDI relacionados
		function inicializar_detalles_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado a la función para inicializar elementos de la factura (detalle)
		    inicializar_detalle_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();

			//Eliminar los datos de la tabla detalles de la nota de crédito digital
			$('#dg_detalles_notas_credito_digitales_cuentas_cobrar tbody').empty();
			$('#numElementos_detalles_notas_credito_digitales_cuentas_cobrar').html(0);
			$('#txtNumDetalles_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#acumTotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html('$0.00');
		    $('#acumAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html('$0.00');
		    $('#acumSaldoFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html('$0.00');

		    //Eliminar los datos de la tabla CFDI relacionados
		    $('#dg_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar tbody').empty();
			$('#numElementos_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar').html(0);
			$('#txtNumCfdiRelacionados_notas_credito_digitales_cuentas_cobrar').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_notas_credito_digitales_cuentas_cobrar()
		{
			try {
				
				 //Hacer un llamado a la función para cerrar modal Cancelación del timbrado
				cerrar_cancelacion_notas_credito_digitales_cuentas_cobrar();
				//Hacer un llamado a la función para cerrar modal Relacionar CFDI
				cerrar_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar();
				//Hacer un llamado a la función para cerrar modal Relacionar Documentos (facturas) de la Nota de Crédito Digital
				cerrar_relacionar_fras_notas_credito_digitales_cuentas_cobrar();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			  	cerrar_cliente_notas_credito_digitales_cuentas_cobrar();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_notas_credito_digitales_cuentas_cobrar('');
				//Cerrar modal
				objNotasCreditoDigitalesCuentasCobrar.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_notas_credito_digitales_cuentas_cobrar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_notas_credito_digitales_cuentas_cobrar()
		{

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_notas_credito_digitales_cuentas_cobrar();

			//Validación del formulario de campos obligatorios
			$('#frmNotasCreditoDigitalesCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_notas_credito_digitales_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_notas_credito_digitales_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_notas_credito_digitales_cuentas_cobrar: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').val()) !== intMonedaBaseIDNotasCreditoDigitalesCuentasCobrar)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoNotasCreditoDigitalesCuentasCobrar)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoNotasCreditoDigitalesCuentasCobrar
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strRazonSocial_notas_credito_digitales_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if($('#txtProspectoID_notas_credito_digitales_cuentas_cobrar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una razón social existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFormaPago_notas_credito_digitales_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la forma de pago
					                                    if($('#txtFormaPagoID_notas_credito_digitales_cuentas_cobrar').val() === '')
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
										strMetodoPago_notas_credito_digitales_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del método de pago
					                                    if($('#txtMetodoPagoID_notas_credito_digitales_cuentas_cobrar').val() === '')
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
										intExportacionID_notas_credito_digitales_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Seleccione una exportación'}
											}
										},
										strUsoCfdi_notas_credito_digitales_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del uso de CFDI
					                                    if($('#txtUsoCfdiID_notas_credito_digitales_cuentas_cobrar').val() === '')
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
										strTipoRelacion_notas_credito_digitales_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if((value !== '' && $('#txtTipoRelacionID_notas_credito_digitales_cuentas_cobrar').val() === '') 
					                                    	|| ($('#txtTipoRelacionID_notas_credito_digitales_cuentas_cobrar').val() === '' && parseInt($('#txtNumCfdiRelacionados_notas_credito_digitales_cuentas_cobrar').val()) > 0))
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
										intNumCfdiRelacionados_notas_credito_digitales_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan CFDI relacionados
					                                    if(parseInt($('#txtTipoRelacionID_notas_credito_digitales_cuentas_cobrar').val()) > 0 &&
					                                    	(parseInt(value) === 0 || value === ''))
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un CFDI para esta nota de crédito digital.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intNumDetalles_notas_credito_digitales_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta nota de crédito digital'
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
			var bootstrapValidator_notas_credito_digitales_cuentas_cobrar = $('#frmNotasCreditoDigitalesCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_notas_credito_digitales_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_notas_credito_digitales_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para validar que los detalles cuenten con concepto
				validar_detalles_notas_credito_digitales_cuentas_cobrar();	
			}
			else 
				return;
		}


		//Función que se utiliza para validar que los detalles cuenten con concepto
		function validar_detalles_notas_credito_digitales_cuentas_cobrar()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_notas_credito_digitales_cuentas_cobrar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrReferencias = [];
			var arrReferenciaID = [];
			var arrConceptos = [];
			var arrObjetoImpuestoSat = [];
			var arrPrecios = [];
			var arrTasaCuotaIva = [];
			var arrIvas = [];
			var arrTasaCuotaIeps = [];
			var arrIeps = [];

			//Array que se utiliza para agregar los conceptos que no tienen: concepto
			var arrDatosFaltantes = [];

			//Variable que se utiliza para asignar la moneda de la nota de crédito
			var intMonedaIDNotaCredito = parseInt($("#cmbMonedaID_notas_credito_digitales_cuentas_cobrar").val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variable que se utiliza para asignar el tipo de cambio de la nota de crédito
				var intTipoCambioNotaCredito = parseFloat($("#txtTipoCambio_notas_credito_digitales_cuentas_cobrar").val());
				//Variable que se utiliza para asignar el precio
				var intPrecio = 0;
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

				//Variable que se utiliza para asignar el código del objeto de impuesto SAT
				var strObjetoImpuestoSat = objRen.cells[24].innerHTML;

				//Variables que se utilizan para asignar los valores del detalle
				var strFolio =   objRen.cells[0].innerHTML;
				var strTipoReferencia =   objRen.cells[1].innerHTML;
				var strConcepto = objRen.cells[4].innerHTML;
				var intMonedaID = parseInt(objRen.cells[12].innerHTML);
				var intTipoCambio = parseFloat(objRen.cells[3].innerHTML);
				var intAbono = parseFloat(objRen.cells[19].innerHTML);
				var intPorcentajeIva =   objRen.cells[5].innerHTML;
				var intPorcentajeIeps =   objRen.cells[6].innerHTML;
				var strTipoTasaCuotaIeps = objRen.cells[20].innerHTML;
				var strFactorTasaCuotaIeps = objRen.cells[21].innerHTML;

			    //Concatenar los datos de la referencia
				var strReferencia = strFolio+' - '+strTipoReferencia+', IVA%: '+intPorcentajeIva+' IEPS%: '+intPorcentajeIva;

				//Si no existe concepto o no existe importe
				if(strConcepto == '' || intAbono <= 0 || strObjetoImpuestoSat == '')
				{
					//Agregar concepto en el array, de esta manera, el usuario identificara las referencias sin concepto
					arrDatosFaltantes.push(strReferencia);
				}
				else
				{
					
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

					//Si la moneda de la nota de crédito es diferente a la moneda de la factura
					if(intMonedaID  !== intMonedaIDNotaCredito)
					{
						//Asignar el tipo de cambio de la factura
						intTipoCambioNotaCredito = intTipoCambio;
					}
						
				    //Convertir cantidad a pesos mexicanos
				    intAbonoPesos =  intAbono * intTipoCambioNotaCredito;

				    //Calcular precio de la referencia (desglosar IVA y/o IEPS)
	                intPrecio =  intAbonoPesos / intPorcentajeDesglose;

	                //Redondear cantidad a decimales
					intPrecio = intPrecio.toFixed(2);
					intPrecio = parseFloat(intPrecio);

					//Calcular importe de IVA
		        	intImporteIva = intPrecio *  intPorcentajeIva;
		        	//Redondear cantidad a decimales
					intImporteIva = intImporteIva.toFixed(2);
					intImporteIva = parseFloat(intImporteIva);

					//Si se cumple la regla de validación
					if(strCalcularIEPS == 'SI')
					{
						//Calcular importe de IEPS
	            		intImporteIeps = intPrecio * intPorcentajeIeps;
	            		//Redondear cantidad a decimales
						intImporteIeps = intImporteIeps.toFixed(2);
						intImporteIeps = parseFloat(intImporteIeps);
					}

					//Calcular el total de impuestos por pagar
					intTotalImpuestos = intImporteIva + intImporteIeps;

					//Calcular el total del abono por su tasa (que se va a guardar en la BD)
					intAbonoTasa = intPrecio + intTotalImpuestos;
					//Redondear cantidad a decimales
					intAbonoTasa = intAbonoTasa.toFixed(2);
					intAbonoTasa = parseFloat(intAbonoTasa);

					//Verificar que el abono que le corresponde a la tasa no sea distinto al que se ingresa
					if(intAbonoTasa != intAbonoPesos)
					{
						//Calcular precio nuevamente para evitar más decimales 
						intPrecio = intAbonoPesos - intTotalImpuestos;
						intPrecio = intPrecio.toFixed(2);
						intPrecio = parseFloat(intPrecio);
					}

					//Asignar valores a los arrays
					arrReferencias.push(strTipoReferencia);
					arrReferenciaID.push(objRen.cells[11].innerHTML);
					arrConceptos.push(strConcepto);
					arrObjetoImpuestoSat.push(strObjetoImpuestoSat);
					arrPrecios.push(intPrecio);
					arrTasaCuotaIva.push(objRen.cells[14].innerHTML);
					arrIvas.push(intImporteIva);
					arrTasaCuotaIeps.push(objRen.cells[16].innerHTML);
					arrIeps.push(intImporteIeps);

				}
			
			}

			//Si existen referencias sin concepto
			if(arrDatosFaltantes.length > 0)
			{
				//Mensaje que se utiliza para informar al usuario la lista de referencias sin concepto
				var strMensaje = 'La nota de crédito digital no puede guardarse. ';
				strMensaje += 'Los siguientes <b>folios</b> no tienen concepto, objeto de impuesto SAT o importe (0.00):<br>'

				//Hacer recorrido para obtener referencias sin concepto
				for(var intCont = 0; intCont < arrDatosFaltantes.length; intCont++)
				{
					//Agregar concepto en el mensaje
            		strMensaje = strMensaje + arrDatosFaltantes[intCont] + '<br/>';
				}

				//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_notas_credito_digitales_cuentas_cobrar('conceptos_faltantes', strMensaje);
			}
			else
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_notas_credito_digitales_cuentas_cobrar(arrReferencias, arrReferenciaID, arrConceptos, arrObjetoImpuestoSat, arrPrecios,
												   			   arrTasaCuotaIva, arrIvas, arrTasaCuotaIeps, arrIeps);
			}

		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_notas_credito_digitales_cuentas_cobrar()
		{
			try
			{
				$('#frmNotasCreditoDigitalesCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_notas_credito_digitales_cuentas_cobrar(arrReferencias, arrReferenciaID, arrConceptos, arrObjetoImpuestoSat, 
															    arrPrecios, arrTasaCuotaIva, arrIvas, arrTasaCuotaIeps, arrIeps)
		{
			//Obtenemos el objeto de la tabla CFDI relacionados
			var objTabla = document.getElementById('dg_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar').getElementsByTagName('tbody')[0];

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
			$.post('cuentas_cobrar/notas_credito_digitales/guardar',
			{ 
				//Datos de la nota de crédito
				intNotaCreditoDigitalID: $('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val(),
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				dteFecha: $.formatFechaMysql($('#txtFecha_notas_credito_digitales_cuentas_cobrar').val()),
				intMonedaID: $('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').val(),
				intTipoCambio: $('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').val(),
				intProspectoID: $('#txtProspectoID_notas_credito_digitales_cuentas_cobrar').val(),
				strRazonSocial: $('#txtRazonSocial_notas_credito_digitales_cuentas_cobrar').val(),
				strRfc: $('#txtRfc_notas_credito_digitales_cuentas_cobrar').val(),
				intRegimenFiscalID: $('#txtRegimenFiscalID_notas_credito_digitales_cuentas_cobrar').val(),
				strCalle: $('#txtCalle_notas_credito_digitales_cuentas_cobrar').val(),
				strNumeroExterior: $('#txtNumeroExterior_notas_credito_digitales_cuentas_cobrar').val(),
				strNumeroInterior: $('#txtNumeroInterior_notas_credito_digitales_cuentas_cobrar').val(),
				strCodigoPostal: $('#txtCodigoPostal_notas_credito_digitales_cuentas_cobrar').val(),
				strColonia: $('#txtColonia_notas_credito_digitales_cuentas_cobrar').val(),
				strLocalidad: $('#txtLocalidad_notas_credito_digitales_cuentas_cobrar').val(),
				strMunicipio: $('#txtMunicipio_notas_credito_digitales_cuentas_cobrar').val(),
				strEstado: $('#txtEstado_notas_credito_digitales_cuentas_cobrar').val(),
				strPais: $('#txtPais_notas_credito_digitales_cuentas_cobrar').val(),
				intFormaPagoID: $('#txtFormaPagoID_notas_credito_digitales_cuentas_cobrar').val(),
				intMetodoPagoID: $('#txtMetodoPagoID_notas_credito_digitales_cuentas_cobrar').val(),
				intUsoCfdiID: $('#txtUsoCfdiID_notas_credito_digitales_cuentas_cobrar').val(),
				intTipoRelacionID: $('#txtTipoRelacionID_notas_credito_digitales_cuentas_cobrar').val(),
				intExportacionID: $('#cmbExportacionID_notas_credito_digitales_cuentas_cobrar').val(),
				strObservaciones: $('#txtObservaciones_notas_credito_digitales_cuentas_cobrar').val(),
				intProcesoMenuID: $('#txtProcesoMenuID_notas_credito_digitales_cuentas_cobrar').val(),
				//Datos de los detalles
				strReferencias: arrReferencias.join('|'),
				strReferenciaID: arrReferenciaID.join('|'),
				strConceptos: arrConceptos.join('|'),
				strObjetoImpuestoSat: arrObjetoImpuestoSat.join('|'),
				strPrecios: arrPrecios.join('|'),
				strTasaCuotaIva: arrTasaCuotaIva.join('|'),
				strIvas: arrIvas.join('|'),
				strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
				strIeps: arrIeps.join('|'),
				//Datos de los CFDI relacionados
				strCfdiRelacionado: arrCfdiRelacionado.join('|'),
				strTiposRelacion: arrTiposRelacion.join('|')
			},
				function(data) {
					if (data.resultado)
					{
						//Si no existe id de la nota de crédito digital, significa que es un nuevo registro   
						if($('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val() == '')
						{
						  	//Asignar el id de la nota de crédito digital registrada en la base de datos
                 			$('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val(data.nota_credito_digital_id);
             			}
						
						
						//Hacer llamado a la función para cargar  los registros en el grid
						paginacion_notas_credito_digitales_cuentas_cobrar();

             			//Hacer un llamado a la función para timbrar los datos del registro
						timbrar_notas_credito_digitales_cuentas_cobrar($('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val(), 'modal', '', $('#txtRegimenFiscalID_notas_credito_digitales_cuentas_cobrar').val());	

						//Si no existe id de la póliza (o se trata de un nuevo registro)
						if(parseInt($('#txtPolizaID_notas_credito_digitales_cuentas_cobrar').val()) == 0 || 
							$('#txtEstatus_notas_credito_digitales_cuentas_cobrar').val() == '')
						{
							//Hacer un llamado a la función para generar póliza con los datos del registro
							 generar_poliza_notas_credito_digitales_cuentas_cobrar('', '', '');
						}

					}

					//Si existe mensaje de error
					if(data.tipo_mensaje == 'error')
					{
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_notas_credito_digitales_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					}

				},
			'json');

		}

		
		//Función para generar póliza con los datos de un registro
		function generar_poliza_notas_credito_digitales_cuentas_cobrar(id, estatus, formulario)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_notas_credito_digitales_cuentas_cobrar(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaNotasCreditoDigitalesCuentasCobrar, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_notas_credito_digitales_cuentas_cobrar').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_notas_credito_digitales_cuentas_cobrar(formulario);
			    //Si existe resultado
				if (data.resultado)
				{
					//Asignar el id de la póliza (generada) y evitar duplicidad de datos en caso de que no sea posible timbrar el registro
                    $('#txtPolizaID_notas_credito_digitales_cuentas_cobrar').val(data.poliza_id);
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_notas_credito_digitales_cuentas_cobrar();
					
				}

				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_notas_credito_digitales_cuentas_cobrar(data.tipo_mensaje, data.mensaje);

		     },
		     'json');
		}

		//Función para timbrar los datos de un registro
		function timbrar_notas_credito_digitales_cuentas_cobrar(id, tipo, formulario, regimenFiscalID)
		{

			//Si existe id del régimen fiscal
			if(regimenFiscalID > 0)
			{
					//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
					mostrar_circulo_carga_notas_credito_digitales_cuentas_cobrar(formulario);

					//Hacer un llamado al método del controlador para timbrar los datos del registro
					$.post('contabilidad/timbradoV4/set_timbrar',
				     {
				     	intReferenciaID: id,
				      	strTipoReferencia: strTipoReferenciaNotasCreditoDigitalesCuentasCobrar
				     },
				     function(data) {
						//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Si existe resultado (los datos se timbraron correctamente)
							if (data.resultado)
							{

								//Hacer un llamado a la función para cerrar modal
								cerrar_notas_credito_digitales_cuentas_cobrar();  
							}
							else
							{
								//Hacer un llamado a la función para limpiar los mensajes de error 
								limpiar_mensajes_notas_credito_digitales_cuentas_cobrar();
								//Hacer un llamado a la función para cargar datos del registro (habilitar campos de timbrado)
								editar_notas_credito_digitales_cuentas_cobrar(id,'Nuevo');

							}
						}

						//Hacer llamado a la función para cargar  los registros en el grid
					    paginacion_notas_credito_digitales_cuentas_cobrar();
						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			            ocultar_circulo_carga_notas_credito_digitales_cuentas_cobrar(formulario);
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_notas_credito_digitales_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
			}
			else
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				 mensaje_notas_credito_digitales_cuentas_cobrar('error_regimen_fiscal');
			}
			
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function mostrar_circulo_carga_notas_credito_digitales_cuentas_cobrar(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_notas_credito_digitales_cuentas_cobrar';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_notas_credito_digitales_cuentas_cobrar';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function ocultar_circulo_carga_notas_credito_digitales_cuentas_cobrar(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_notas_credito_digitales_cuentas_cobrar';

			//Si el Div a ocultar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_notas_credito_digitales_cuentas_cobrar';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_notas_credito_digitales_cuentas_cobrar(tipoMensaje, mensaje, campoID)
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
			else if(tipoMensaje == 'conceptos_faltantes')
			{ 
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog(mensaje, 
							  {'type': 'error',
							   'title': 'Error',
							   'width': 600
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
				new $.Zebra_Dialog(strMsjRegimenFiscalCteNotasCreditoDigitalesCuentasCobrar, 
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
			else if(tipoMensaje == 'informacion')
			{ 
				//Indicar al usuario el mensaje de información
				new $.Zebra_Dialog(mensaje, {
								'type': 'information',
								'title': 'Información',
								'buttons': [{caption: 'Aceptar',
											 callback: function () {
												//Enfocar caja de texto
												$('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();
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
		function cambiar_estatus_notas_credito_digitales_cuentas_cobrar(id, folio, polizaID, folioPoliza)
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
				intID = $('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val();
				strFolio = $('#txtFolio_notas_credito_digitales_cuentas_cobrar').val();
				intPolizaID = $('#txtPolizaID_notas_credito_digitales_cuentas_cobrar').val();
				strFolioPoliza = $('#txtFolioPoliza_notas_credito_digitales_cuentas_cobrar').val();

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
					             {
					             	'type':     'question',
					              	'title':    'Notas de Crédito Digitales',
					              	'buttons':  ['Aceptar', 'Cancelar'],
					              	'onClose':  function(caption) {

						                            if(caption == 'Aceptar')
						                            {
						                               //Hacer un llamado a la función para abrir el modal Cancelación del timbrado (cambiar estatus y cancelar timbrado del registro)
					                 			 		abrir_cancelacion_notas_credito_digitales_cuentas_cobrar(intID, strFolio, intPolizaID);

						                            }

					                          }
					              });
		    
		}


		//Función para cancelar el timbrado de un registro. Cambia el estatus a INACTIVO
		function cancelar_timbrado_notas_credito_digitales_cuentas_cobrar()
		{

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cancelacion_notas_credito_digitales_cuentas_cobrar();

			 //Hacer un llamado al método del controlador para cancelar un CFDI y posteriormente cambiar el estatus a INACTIVO
	         //----- CÓDIGO PARA PRODUCCIÓN
	          $.post('contabilidad/timbrado_cancelar/set_cancelar',
	          {
	          		//Datos para cancelar el timbrado (CFDI)
	         		intMovimientoID: $('#txtReferenciaCfdiID_cancelacion_notas_credito_digitales_cuentas_cobrar').val(),
					strTipoReferencia: strTipoReferenciaNotasCreditoDigitalesCuentasCobrar, 
					strUuidSustitucion: $('#txtUuidSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar').val(),
					strMotivo: $('select[name="intCancelacionMotivoID_notas_credito_digitales_cuentas_cobrar"] option:selected').text(),
					//Datos para cambiar (administrativamente) el estatus del registro
					intCancelacionMotivoID: $('#cmbCancelacionMotivoID_cancelacion_notas_credito_digitales_cuentas_cobrar').val(), 
					intSustitucionID:  $('#txtSustitucionID_cancelacion_notas_credito_digitales_cuentas_cobrar').val(),
					intPolizaID: $('#txtPolizaID_cancelacion_notas_credito_digitales_cuentas_cobrar').val()

	          },
	                 function(data) {

	                    if(data.resultado)
	                    {
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_notas_credito_digitales_cuentas_cobrar();	

							//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
							cerrar_cancelacion_notas_credito_digitales_cuentas_cobrar();  

							//Si el id del registro se obtuvo del modal
							if($('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val() != '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_notas_credito_digitales_cuentas_cobrar();     
							}		
	                    }

	                    //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
				        ocultar_circulo_carga_cancelacion_notas_credito_digitales_cuentas_cobrar();
					    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_notas_credito_digitales_cuentas_cobrar(data.tipo_mensaje, data.mensaje);


	                 },
	                'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_notas_credito_digitales_cuentas_cobrar(id, tipoAccion, cancelacionID)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/notas_credito_digitales/get_datos',
			       {
			       	 intNotaCreditoDigitalID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_notas_credito_digitales_cuentas_cobrar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				             //Asignar el id de la póliza
				            var intPolizaID = parseInt(data.row.poliza_id); 
				            //Asignar el código de la moneda
	                        strMonedaNotasCreditoDigitalesCuentasCobrar = data.row.MonedaTipo;
	                        //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';

				          	//Recuperar valores
				            $('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val(data.row.nota_credito_digital_id);
				            $('#txtFolio_notas_credito_digitales_cuentas_cobrar').val(data.row.folio);
				            $('#txtFecha_notas_credito_digitales_cuentas_cobrar').val(data.row.fecha_format);
				            $('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').val(data.row.moneda_id);
				            $('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').val(data.row.tipo_cambio);
				            $('#txtProspectoID_notas_credito_digitales_cuentas_cobrar').val(data.row.prospecto_id);
						    $('#txtRazonSocial_notas_credito_digitales_cuentas_cobrar').val(data.row.razon_social);
						    $('#txtRfc_notas_credito_digitales_cuentas_cobrar').val(data.row.rfc);
						    $('#txtRegimenFiscalID_notas_credito_digitales_cuentas_cobrar').val(data.row.regimen_fiscal_id);
						    $('#txtCalle_notas_credito_digitales_cuentas_cobrar').val(data.row.calle);
						    $('#txtNumeroExterior_notas_credito_digitales_cuentas_cobrar').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_notas_credito_digitales_cuentas_cobrar').val(data.row.numero_interior);
						    $('#txtCodigoPostal_notas_credito_digitales_cuentas_cobrar').val(data.row.codigo_postal);
						    $('#txtColonia_notas_credito_digitales_cuentas_cobrar').val(data.row.colonia);
						    $('#txtLocalidad_notas_credito_digitales_cuentas_cobrar').val(data.row.localidad);
						    $('#txtMunicipio_notas_credito_digitales_cuentas_cobrar').val(data.row.municipio);
						    $('#txtEstado_notas_credito_digitales_cuentas_cobrar').val(data.row.estado);
						    $('#txtPais_notas_credito_digitales_cuentas_cobrar').val(data.row.pais);
						    $('#txtFormaPagoID_notas_credito_digitales_cuentas_cobrar').val(data.row.forma_pago_id);
						    $('#txtFormaPago_notas_credito_digitales_cuentas_cobrar').val(data.row.forma_pago);
						    $('#txtMetodoPagoID_notas_credito_digitales_cuentas_cobrar').val(data.row.metodo_pago_id);
						    $('#txtMetodoPago_notas_credito_digitales_cuentas_cobrar').val(data.row.metodo_pago);
						    $('#txtUsoCfdiID_notas_credito_digitales_cuentas_cobrar').val(data.row.uso_cfdi_id);
						    $('#txtUsoCfdi_notas_credito_digitales_cuentas_cobrar').val(data.row.uso_cfdi);
						    $('#txtTipoRelacionID_notas_credito_digitales_cuentas_cobrar').val(data.row.tipo_relacion_id);
						    $('#txtTipoRelacion_notas_credito_digitales_cuentas_cobrar').val(data.row.tipo_relacion);
						    $('#cmbExportacionID_notas_credito_digitales_cuentas_cobrar').val(data.row.exportacion_id);
				            $('#txtObservaciones_notas_credito_digitales_cuentas_cobrar').val(data.row.observaciones);
				            $('#txtPolizaID_notas_credito_digitales_cuentas_cobrar').val(intPolizaID);
						    $('#txtFolioPoliza_notas_credito_digitales_cuentas_cobrar').val(data.row.folio_poliza);
				            $('#txtEstatus_notas_credito_digitales_cuentas_cobrar').val(strEstatus);
				            //Asignar el código de la moneda de la nota de crédito digital
							$('#spnMonedaNotaCredito_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').text(strMonedaNotasCreditoDigitalesCuentasCobrar);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_notas_credito_digitales_cuentas_cobrar').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_notas_credito_digitales_cuentas_cobrar").show();
				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar botón Descargar Archivo
				            	$("#btnDescargarArchivo_notas_credito_digitales_cuentas_cobrar").show();
				           	}	


				            //Si el estatus del registro es TIMBRAR
				            if(strEstatus == 'TIMBRAR' && intPolizaID == 0)
							{
								strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
													" onclick='editar_renglon_fras_relacionadas_notas_credito_digitales_cuentas_cobrar(this)'>" + 
													"<span class='glyphicon glyphicon-edit'></span></button>" + 
													"<button class='btn btn-default btn-xs' title='Eliminar'" +
													" onclick='eliminar_renglon_fras_relacionadas_notas_credito_digitales_cuentas_cobrar(this)'>" + 
													"<span class='glyphicon glyphicon-trash'></span></button>" + 
													"<button class='btn btn-default btn-xs up' title='Subir'>" + 
													"<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													"<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													"<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDNotasCreditoDigitalesCuentasCobrar)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_notas_credito_digitales_cuentas_cobrar").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar caja de texto
									$("#txtTipoCambio_notas_credito_digitales_cuentas_cobrar").attr('disabled','disabled');
							    }

							    //Habilitar botón Buscar facturas
								$('#btnBuscarDoc_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
							}
							else if (strEstatus == 'TIMBRAR' && intPolizaID > 0)
				            {
				            	//Hacer un llamado a la función para habilitar campos de timbrado
				            	habilitar_controles_timbrado_notas_credito_digitales_cuentas_cobrar();
				            }
							else 
							{
								//Si el estatus del registro es ACTIVO
								if(strEstatus == 'ACTIVO')
								{
									//Mostrar los siguientes botones
				            		$("#btnEnviarCorreo_notas_credito_digitales_cuentas_cobrar").show();

				            		//Si existe el id de la póliza
					            	if(intPolizaID > 0)
					            	{
					            		$("#btnDesactivar_notas_credito_digitales_cuentas_cobrar").show();
					            	}
								}

								//Deshabilitar todos los elementos del formulario
				            	$('#frmNotasCreditoDigitalesCuentasCobrar').find('input, textarea, select').attr('disabled','disabled');
					            //Ocultar los siguientes botones
								$("#btnGuardar_notas_credito_digitales_cuentas_cobrar").hide();
								$("#btnBuscarDoc_notas_credito_digitales_cuentas_cobrar").hide();
								$("#btnBuscarCFDI_notas_credito_digitales_cuentas_cobrar").hide(); 

								//Si existe id de la cancelación del CFDI
								if(cancelacionID > 0)
								{	
									//Asignar el id de la cancelación
									$("#txtCancelacionID_notas_credito_digitales_cuentas_cobrar").val(cancelacionID); 
									//Mostrar botón Motivo de cancelación
									$("#btnVerMotivoCancelacion_notas_credito_digitales_cuentas_cobrar").show(); 
								}
							}
				          
				          	 //Variable que se utiliza para asignar la moneda de la nota de crédito
						    var intMonedaIDNotaCredito = parseInt(data.row.moneda_id);

				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Variable que se utiliza para asignar el tipo de cambio de la nota de crédito
				            	var intTipoCambioNotaCredito = parseFloat(data.row.tipo_cambio);

				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_notas_credito_digitales_cuentas_cobrar').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaFolio = objRenglon.insertCell(0);
								var objCeldaModulo = objRenglon.insertCell(1);
								var objCeldaMonedaTipo = objRenglon.insertCell(2);
								var objCeldaTipoCambio = objRenglon.insertCell(3);
								var objCeldaConcepto = objRenglon.insertCell(4);
								var objCeldaPorcentajeIvaFactura = objRenglon.insertCell(5);
								var objCeldaPorcentajeIepsFactura = objRenglon.insertCell(6);
								var objCeldaImpFactura = objRenglon.insertCell(7);
								var objCeldaAbono = objRenglon.insertCell(8);
								var objCeldaSaldoInsoluto = objRenglon.insertCell(9);
								var objCeldaAcciones = objRenglon.insertCell(10);
								//Columnas ocultas
								var objCeldaReferenciaID = objRenglon.insertCell(11);
								var objCeldaMonedaID = objRenglon.insertCell(12);
								var objCeldaSubtotalFactura = objRenglon.insertCell(13);
								var objCeldaTasaCuotaIvaFactura = objRenglon.insertCell(14);
								var objCeldaIvaFactura = objRenglon.insertCell(15);
								var objCeldaTasaCuotaIepsFactura = objRenglon.insertCell(16);
								var objCeldaIepsFactura = objRenglon.insertCell(17);
								var objCeldaSaldoFactura = objRenglon.insertCell(18);
								var objCeldaAbonoAux = objRenglon.insertCell(19);
								var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(20);
								var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(21);
								var objCeldaFecha = objRenglon.insertCell(22);
								var objCeldaTipoReferenciaCfdi = objRenglon.insertCell(23);
								var objCeldaObjetoImpuestoSat = objRenglon.insertCell(24);
								var objCeldaObjetoImpuesto = objRenglon.insertCell(25);

								//Variables que se utilizan para asignar valores del detalle
								var intReferenciaID = data.detalles[intCon].referencia_id;
								var strTipoReferencia = data.detalles[intCon].referencia;
								var intTasaCuotaIva = data.detalles[intCon].tasa_cuota_iva;
								var intTasaCuotaIeps = data.detalles[intCon].tasa_cuota_ieps;
								var intMonedaID = parseInt(data.detalles[intCon].moneda_id);
								var intTipoCambio = parseFloat(data.detalles[intCon].tipo_cambio);
								var intSaldoFactura = parseFloat(data.detalles[intCon].saldo_factura);
								//Variable que se utiliza para asignar el abono 
								var intAbono = parseFloat(data.detalles[intCon].abono);
								//Variable que se utiliza para asignar el id del detalle
								var strDetalleID = intReferenciaID+'_'+strTipoReferencia+'_'+intTasaCuotaIva+'_'+intTasaCuotaIeps;

								//Si la moneda de la nota de crédito es diferente a la moneda de la factura
								if(intMonedaIDNotaCredito !== intMonedaID)
								{
								    //Asignar el tipo de cambio de la factura
									intTipoCambioNotaCredito = intTipoCambio;
								}

								//Convertir peso mexicano a tipo de cambio de la nota de crédito
								intAbono = intAbono / intTipoCambioNotaCredito;

								//Incrementar el saldo de la factura
								intSaldoFactura =  intSaldoFactura + intAbono;

								//Redondear cantidad a dos decimales
								intSaldoFactura = intSaldoFactura.toFixed(2);
								intSaldoFactura = parseFloat(intSaldoFactura);

						        //Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', strDetalleID);
								objCeldaFolio.setAttribute('class', 'movil e1');
								objCeldaFolio.innerHTML = data.detalles[intCon].folio;
								objCeldaModulo.setAttribute('class', 'movil e2');
								objCeldaModulo.innerHTML = strTipoReferencia;
								objCeldaMonedaTipo.setAttribute('class', 'movil e3');
								objCeldaMonedaTipo.innerHTML = data.detalles[intCon].moneda_tipo;
								objCeldaTipoCambio.setAttribute('class', 'movil e4');
								objCeldaTipoCambio.innerHTML = data.detalles[intCon].tipo_cambio;
								objCeldaConcepto.setAttribute('class', 'movil e5');
								objCeldaConcepto.innerHTML = data.detalles[intCon].concepto;
								objCeldaPorcentajeIvaFactura.setAttribute('class', 'movil e6');
								objCeldaPorcentajeIvaFactura.innerHTML = data.detalles[intCon].porcentaje_iva;
								objCeldaPorcentajeIepsFactura.setAttribute('class', 'movil e7');
								objCeldaPorcentajeIepsFactura.innerHTML = data.detalles[intCon].porcentaje_ieps;
								objCeldaImpFactura.setAttribute('class', 'movil e8');
								objCeldaImpFactura.innerHTML =  formatMoney(data.detalles[intCon].total_factura, 2, '');
								objCeldaAbono.setAttribute('class', 'movil e9');
								objCeldaAbono.innerHTML = formatMoney(intAbono, 2, '');
								objCeldaSaldoInsoluto.setAttribute('class', 'movil e10');
								objCeldaSaldoInsoluto.innerHTML = formatMoney(data.detalles[intCon].saldo_factura, 2, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil e11');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
								objCeldaReferenciaID.innerHTML = intReferenciaID; 
								objCeldaMonedaID.setAttribute('class', 'no-mostrar');
								objCeldaMonedaID.innerHTML = data.detalles[intCon].moneda_id; 
								objCeldaSubtotalFactura.setAttribute('class', 'no-mostrar');
								objCeldaSubtotalFactura.innerHTML = formatMoney(data.detalles[intCon].subtotal_factura, 2, '');
								objCeldaTasaCuotaIvaFactura.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIvaFactura.innerHTML = intTasaCuotaIva;
								objCeldaIvaFactura.setAttribute('class', 'no-mostrar');
								objCeldaIvaFactura.innerHTML = formatMoney(data.detalles[intCon].iva_factura, 2, '');
								objCeldaTasaCuotaIepsFactura.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIepsFactura.innerHTML = intTasaCuotaIeps;
								objCeldaIepsFactura.setAttribute('class', 'no-mostrar');
								objCeldaIepsFactura.innerHTML = formatMoney(data.detalles[intCon].ieps_factura, 2, '');
								objCeldaSaldoFactura.setAttribute('class', 'no-mostrar');
								objCeldaSaldoFactura.innerHTML = intSaldoFactura;
								objCeldaAbonoAux.setAttribute('class', 'no-mostrar');
								objCeldaAbonoAux.innerHTML =  intAbono;
								objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTipoTasaCuotaIeps.innerHTML =  data.detalles[intCon].tipo_ieps;
								objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaFactorTasaCuotaIeps.innerHTML =  data.detalles[intCon].factor_ieps;
								objCeldaFecha.setAttribute('class', 'no-mostrar');
								objCeldaFecha.innerHTML = data.detalles[intCon].fecha;
								objCeldaTipoReferenciaCfdi.setAttribute('class', 'no-mostrar');
								objCeldaTipoReferenciaCfdi.innerHTML = data.detalles[intCon].tipo_referencia_cfdi;
								objCeldaObjetoImpuestoSat.setAttribute('class', 'no-mostrar');
								objCeldaObjetoImpuestoSat.innerHTML = data.detalles[intCon].objeto_impuesto_sat;
								objCeldaObjetoImpuesto.setAttribute('class', 'no-mostrar');
								objCeldaObjetoImpuesto.innerHTML = data.detalles[intCon].objeto_impuesto;
				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_notas_credito_digitales_cuentas_cobrar tr").length - 2;
							$('#numElementos_detalles_notas_credito_digitales_cuentas_cobrar').html(intFilas);
							$('#txtNumDetalles_notas_credito_digitales_cuentas_cobrar').val(intFilas);

				            //Hacer un llamado a la función para agregar los CFDI en la tabla CFDI relacionados
							agregar_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar('Editar', strEstatus);

							//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objNotasCreditoDigitalesCuentasCobrar = $('#NotasCreditoDigitalesCuentasCobrarBox').bPopup({
															  appendTo: '#NotasCreditoDigitalesCuentasCobrarContent', 
								                              contentContainer: 'NotasCreditoDigitalesCuentasCobrarM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});
					        }

				            //Enfocar caja de texto
							$('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar obtener los datos de un cliente
		function get_datos_cliente_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar los datos del cliente
            $.post('cuentas_cobrar/clientes/get_datos',
                  { 
                  	intProspectoID:$("#txtProspectoID_notas_credito_digitales_cuentas_cobrar").val()
                  },
                  function(data) {
                    if(data.row){
                       
                       //Asignar datos del registro seleccionado
                       $("#txtRazonSocial_notas_credito_digitales_cuentas_cobrar").val(data.row.razon_social);
                       $("#txtRfc_notas_credito_digitales_cuentas_cobrar").val(data.row.rfc);
                       $('#txtRegimenFiscalID_notas_credito_digitales_cuentas_cobrar').val(data.row.regimen_fiscal_id);
                       $("#txtCalle_notas_credito_digitales_cuentas_cobrar").val(data.row.calle);
                       $("#txtNumeroExterior_notas_credito_digitales_cuentas_cobrar").val(data.row.numero_exterior);
                       $("#txtNumeroInterior_notas_credito_digitales_cuentas_cobrar").val(data.row.numero_interior);
                       $("#txtCodigoPostal_notas_credito_digitales_cuentas_cobrar").val(data.row.codigo_postal);
                       $("#txtColonia_notas_credito_digitales_cuentas_cobrar").val(data.row.colonia);
                       $("#txtLocalidad_notas_credito_digitales_cuentas_cobrar").val(data.row.localidad);
                       $("#txtMunicipio_notas_credito_digitales_cuentas_cobrar").val(data.row.municipio);
                       $("#txtEstado_notas_credito_digitales_cuentas_cobrar").val(data.row.estado_rep);
                       $("#txtPais_notas_credito_digitales_cuentas_cobrar").val(data.row.pais_rep);
                        //Si existe id de la moneda
			            if($('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').val() !== '' && $('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').val() != '')
			            {
			            	//Habilitar botón Buscar facturas
			            	$('#btnBuscarDoc_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
			            }

                    }
                  }
                 ,
                'json');
		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').empty();
					var temp = Mustache.render($('#monedas_notas_credito_digitales_cuentas_cobrar').html(), data);
					$('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').html(temp);
				},
				'json');
		}

		//Regresar el impuesto de objeto base
		function cargar_objeto_impuesto_base_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.ajax({
			        url: 'contabilidad/sat_objeto_impuesto/get_datos',
			        method:'post',
			        dataType: 'json',
			        async: false,
			        data: {
			        	strBusqueda:intObjetoImpuestoBaseIDNotasCreditoDigitalesCuentasCobrar,
			       		strTipo: 'id'
			        },
			        success: function (data) {
			          	//Si no se encuentra código 
			        	if(data.row)
			        	{
			        		//Recuperar valores
				            $('#txtObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(data.row.codigo);
				            $('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(data.row.codigo+' - '+data.row.descripcion);

			        	}
			        }
			    });
		}

		//Regresar exportación activa para cargarlas en el combobox
		function cargar_exportacion_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar la exportación que se encuentra activa
			$.post('contabilidad/sat_exportacion/get_combo_box', {},
				function(data)
				{
					$('#cmbExportacionID_notas_credito_digitales_cuentas_cobrar').empty();
					var temp = Mustache.render($('#exportacion_notas_credito_digitales_cuentas_cobrar').html(), data);
					$('#cmbExportacionID_notas_credito_digitales_cuentas_cobrar').html(temp);
				},
				'json');
		}
		


		//Función para habilitar controles del formulario correspondientes al timbrado
		function habilitar_controles_timbrado_notas_credito_digitales_cuentas_cobrar()
		{
			//Deshabilitar todos los elementos del formulario
        	$('#frmNotasCreditoDigitalesCuentasCobrar').find('input, textarea, select').attr('disabled','disabled');
        	//Habilitar las siguientes cajas de texto
        	$('#txtFormaPago_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
        	$('#txtMetodoPago_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
        	$('#txtUsoCfdi_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
        	$('#txtTipoRelacion_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
        	$('#cmbExportacionID_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
        	$('#txtObservaciones_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_notas_credito_digitales_cuentas_cobrar()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').val()) !== intMonedaBaseIDNotasCreditoDigitalesCuentasCobrar)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_notas_credito_digitales_cuentas_cobrar").val('');
         		//Inicializar valores de los acumulados
         		$('#acumTotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html('$0.00');
         		$('#acumAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html('$0.00');
         		$('#acumSaldoFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html('$0.00');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_notas_credito_digitales_cuentas_cobrar').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_notas_credito_digitales_cuentas_cobrar").val(data.row.tipo_cambio_sat);
	                    }
	                  }
	                 ,
	                'json');

	            //Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();
			}
			
		}


		/*******************************************************************************************************************
		Funciones de la tabla facturas relacionadas
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_fras_relacionadas_notas_credito_digitales_cuentas_cobrar()
		{
		
			//Mostramos las facturas relacionadas (seleccionadas)
			for (var intCon in objFrasRelacionadasNotasCreditoDigitalesCuentasCobrar.getFacturas()) 
            {
            	//Crear instancia del objeto Factura a relacionar 
            	objFraRelacionarNotasCreditoDigitalesCuentasCobrar = new FraRelacionarNotasCreditoDigitalesCuentasCobrar();
            	//Asignar datos de la factura corespondiente al indice
            	objFraRelacionarNotasCreditoDigitalesCuentasCobrar = objFrasRelacionadasNotasCreditoDigitalesCuentasCobrar.getFactura(intCon);
            	
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_detalles_notas_credito_digitales_cuentas_cobrar').getElementsByTagName('tbody')[0];


			    //Variable que se utiliza para asignar el id del detalle
				var strDetalleID =  objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intReferenciaID+'_'+objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strTipoReferencia+'_'+objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intTasaCuotaIvaFactura+'_'+objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intTasaCuotaIepsFactura;

				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
				if (!objTabla.rows.namedItem(strDetalleID))
				{
					
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaFolio = objRenglon.insertCell(0);
					var objCeldaModulo = objRenglon.insertCell(1);
					var objCeldaMonedaTipo = objRenglon.insertCell(2);
					var objCeldaTipoCambio = objRenglon.insertCell(3);
					var objCeldaConcepto = objRenglon.insertCell(4);
					var objCeldaPorcentajeIvaFactura = objRenglon.insertCell(5);
					var objCeldaPorcentajeIepsFactura = objRenglon.insertCell(6);
					var objCeldaImpFactura = objRenglon.insertCell(7);
					var objCeldaAbono = objRenglon.insertCell(8);
					var objCeldaSaldoInsoluto = objRenglon.insertCell(9);
					var objCeldaAcciones = objRenglon.insertCell(10);
					//Columnas ocultas
					var objCeldaReferenciaID = objRenglon.insertCell(11);
					var objCeldaMonedaID = objRenglon.insertCell(12);
					var objCeldaSubtotalFactura = objRenglon.insertCell(13);
					var objCeldaTasaCuotaIvaFactura = objRenglon.insertCell(14);
					var objCeldaIvaFactura = objRenglon.insertCell(15);
					var objCeldaTasaCuotaIepsFactura = objRenglon.insertCell(16);
					var objCeldaIepsFactura = objRenglon.insertCell(17);
					var objCeldaSaldoFactura = objRenglon.insertCell(18);
					var objCeldaAbonoAux = objRenglon.insertCell(19);
					var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(20);
					var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(21);
					var objCeldaFecha = objRenglon.insertCell(22);
					var objCeldaTipoReferenciaCfdi = objRenglon.insertCell(23);
					var objCeldaObjetoImpuestoSat = objRenglon.insertCell(24);
					var objCeldaObjetoImpuesto = objRenglon.insertCell(25);
					
					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strDetalleID);
					objCeldaFolio.setAttribute('class', 'movil e1');
					objCeldaFolio.innerHTML = objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strFolio;
					objCeldaModulo.setAttribute('class', 'movil e2');
					objCeldaModulo.innerHTML = objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strTipoReferencia;
					objCeldaMonedaTipo.setAttribute('class', 'movil e3');
					objCeldaMonedaTipo.innerHTML = objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strMonedaTipo;
					objCeldaTipoCambio.setAttribute('class', 'movil e4');
					objCeldaTipoCambio.innerHTML = objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intTipoCambio;
					objCeldaConcepto.setAttribute('class', 'movil e5');
					objCeldaConcepto.innerHTML = '';
					objCeldaPorcentajeIvaFactura.setAttribute('class', 'movil e6');
					objCeldaPorcentajeIvaFactura.innerHTML =  objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intPorcentajeIvaFactura;
					objCeldaPorcentajeIepsFactura.setAttribute('class', 'movil e7');
					objCeldaPorcentajeIepsFactura.innerHTML =  objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intPorcentajeIepsFactura;
					objCeldaImpFactura.setAttribute('class', 'movil e8');
					objCeldaImpFactura.innerHTML = objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intTotalFactura;
					objCeldaAbono.setAttribute('class', 'movil e9');
					objCeldaAbono.innerHTML = objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intAbono;
					objCeldaSaldoInsoluto.setAttribute('class', 'movil e10');
					objCeldaSaldoInsoluto.innerHTML = formatMoney(objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intSaldoInsoluto, 2, '');
					objCeldaAcciones.setAttribute('class', 'movil e11');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_fras_relacionadas_notas_credito_digitales_cuentas_cobrar(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_fras_relacionadas_notas_credito_digitales_cuentas_cobrar(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
					objCeldaReferenciaID.innerHTML = objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intReferenciaID; 
					objCeldaMonedaID.setAttribute('class', 'no-mostrar');
					objCeldaMonedaID.innerHTML = objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intMonedaID; 
					objCeldaSubtotalFactura.setAttribute('class', 'no-mostrar');
					objCeldaSubtotalFactura.innerHTML =  objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intSubtotalFactura;
					objCeldaTasaCuotaIvaFactura.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIvaFactura.innerHTML =  objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intTasaCuotaIvaFactura;
					objCeldaIvaFactura.setAttribute('class', 'no-mostrar');
					objCeldaIvaFactura.innerHTML =  objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intIvaFactura;
					objCeldaTasaCuotaIepsFactura.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIepsFactura.innerHTML =  objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intTasaCuotaIepsFactura;
					objCeldaIepsFactura.setAttribute('class', 'no-mostrar');
					objCeldaIepsFactura.innerHTML =  objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intIepsFactura;
					objCeldaSaldoFactura.setAttribute('class', 'no-mostrar');
					objCeldaSaldoFactura.innerHTML =  objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intSaldoFactura;
					objCeldaAbonoAux.setAttribute('class', 'no-mostrar');
					objCeldaAbonoAux.innerHTML =  $.reemplazar(objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intAbono, ",", "");
					objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTipoTasaCuotaIeps.innerHTML =  objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strTipoTasaCuotaIeps;
					objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaFactorTasaCuotaIeps.innerHTML = objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strFactorTasaCuotaIeps;
					objCeldaFecha.setAttribute('class', 'no-mostrar');
					objCeldaFecha.innerHTML = objFraRelacionarNotasCreditoDigitalesCuentasCobrar.dteFecha;
					objCeldaTipoReferenciaCfdi.setAttribute('class', 'no-mostrar');
					objCeldaTipoReferenciaCfdi.innerHTML = objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strTipoReferenciaCfdi;
					objCeldaObjetoImpuestoSat.setAttribute('class', 'no-mostrar');
					objCeldaObjetoImpuestoSat.innerHTML = '';
					objCeldaObjetoImpuesto.setAttribute('class', 'no-mostrar');
					objCeldaObjetoImpuesto.innerHTML = '';
					
				}
            }
           
            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_notas_credito_digitales_cuentas_cobrar tr").length - 2;
			$('#numElementos_detalles_notas_credito_digitales_cuentas_cobrar').html(intFilas);
			$('#txtNumDetalles_notas_credito_digitales_cuentas_cobrar').val(intFilas);
		
			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();

			//Hacer un llamado a la función para agregar los CFDI en la tabla CFDI relacionados
		  	agregar_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar('Nuevo', 'ACTIVO');
		}

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_fras_relacionadas_notas_credito_digitales_cuentas_cobrar()
		{
			//Variable que se utiliza para asignar el saldo insoluto
			var intSaldoInsoluto = 0;
			//Variable que se utiliza para asignar el mensaje informativo
			var strMensaje = '';

			//Variable que se utiliza para asignar la moneda de la nota de crédito
			var intMonedaIDNotaCredito =  parseInt($("#cmbMonedaID_notas_credito_digitales_cuentas_cobrar").val());
			//Variable que se utiliza para asignar el tipo de cambio de la nota de crédito
			var intTipoCambioNotaCredito =  parseFloat($("#txtTipoCambio_notas_credito_digitales_cuentas_cobrar").val());
			//Obtenemos los datos de las cajas de texto
			var intReferenciaID = $('#txtReferenciaID_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val();
			var strTipoReferencia = $('#txtTipoReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val();
			var strConcepto = $('#txtConcepto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val();
			var strObjetoImpuestoSat = $('#txtObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val();
			var strObjetoImpuesto = $('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val();
			var intMonedaID = parseInt($('#txtMonedaID_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val());
			var intTipoCambio = parseFloat($('#txtTipoCambio_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val());
			var intSubtotalFactura = $('#txtSubtotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val();
			var intTasaCuotaIvaFactura = $('#txtTasaCuotaIvaFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val();
			var intTasaCuotaIepsFactura = $('#txtTasaCuotaIepsFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val();
		    var intSaldoFactura = $('#txtSaldoFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val();
			var intAbono = $('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val();
			//Variable que se utiliza para asignar el importe que se va a guardar en la base de datos
			var intAbonoAux = $('#txtAbonoAux_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val();
			//Variable que se utiliza para asignar el importe del abono convertido al tipo de cambio del pago
			var intAbonoConv = 0;

			//Variable que se utiliza para asignar el id del detalle
			var strDetalleID = intReferenciaID+'_'+strTipoReferencia+'_'+intTasaCuotaIvaFactura+'_'+intTasaCuotaIepsFactura;

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_notas_credito_digitales_cuentas_cobrar').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (strConcepto == '')
			{
				//Enfocar caja de texto
				$('#txtConcepto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();
			}
			else if (strObjetoImpuestoSat == '')
			{
				//Enfocar caja de texto
				$('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();
			}
			else if (intAbono == '')
			{
				//Enfocar caja de texto
				$('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();
			}
			
			else
			{
				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strConcepto = strConcepto.toUpperCase();

				//Convertir cadena de texto a número decimal
				intSubtotalFactura =  parseFloat($.reemplazar(intSubtotalFactura, ",", ""));
				intSaldoFactura =  parseFloat(intSaldoFactura);
				intAbono =  parseFloat($.reemplazar(intAbono, ",", ""));
				//Asignar el saldo de la factura convertido al tipo de cambio
				var intSaldoFacturaConv = intSaldoFactura;

				//Si el tipo de moneda de la nota de crédito corresponde a peso mexicano
				if(intMonedaIDNotaCredito === intMonedaBaseIDNotasCreditoDigitalesCuentasCobrar)
				{
					//Asignar el importe pagado
					intAbonoConv = intAbono;

					//Si el tipo de moneda de la factura es diferente a la moneda del pago
					if(intMonedaID !== intMonedaIDNotaCredito)
					{
						//Convertir importe pagado a peso mexicano
						intAbono = intAbono / intTipoCambio;
						intSaldoFacturaConv = intSaldoFacturaConv * intTipoCambio;
					}
				}
				else
				{
					//Si el tipo de moneda de la factura corresponde a peso mexicano
					if(intMonedaID === intMonedaBaseIDNotasCreditoDigitalesCuentasCobrar)
					{
						//Convertir importe pagado auxiliar a tipo de cambio
						var intConvImpAux = parseFloat(intAbonoAux) / intTipoCambioNotaCredito;
						//Redondear cantidad a dos decimales
						var intRedConvImpAux = intConvImpAux.toFixed(2);
						//Si el importe pagado es igual a la conversión del importe auxiliar
						if(intAbono == intRedConvImpAux)
						{
							//Asignar el importe auxiliar convertido
							intAbono = intConvImpAux;
						}

						//Asignar el importe pagado
						intAbonoConv = intAbono;

						//Convertir importe pagado a tipo de cambio
						intAbono = intAbono * intTipoCambioNotaCredito;
						intSaldoFacturaConv = intSaldoFacturaConv / intTipoCambioNotaCredito;

					}
					else
					{
						//Asignar el importe pagado
						intAbonoConv = intAbono;
					}
				}

				//Redondear cantidad a dos decimales
				intSaldoFacturaConv = intSaldoFacturaConv.toFixed(2);
				intSaldoFacturaConv = parseFloat(intSaldoFacturaConv);
				intAbonoConv = intAbonoConv.toFixed(2);
				intAbonoConv = parseFloat(intAbonoConv);

				//Verificar que el importe pagado sea menor o igual que el saldo de la factura
				if(intAbonoConv <= intSaldoFacturaConv)
				{	
					//Hacer un llamado a la función para inicializar elementos del detalle
					inicializar_detalle_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();

					//Si el saldo de la factura es igual al importe pagado auxiliar
					if(intSaldoFacturaConv == intAbonoConv)
					{
						//Asignar saldo anterior de la factura (para evitar saldos pendientes)
						intAbono = intSaldoFactura;
					}

					//Calcular el saldo insoluto de la factura
					intSaldoInsoluto =  intSaldoFactura  - intAbono;

					//Revisamos si existe el ID proporcionado, si es así, editamos los datos
					if (objTabla.rows.namedItem(strDetalleID))
					{
						objTabla.rows.namedItem(strDetalleID).cells[4].innerHTML =  strConcepto;
						objTabla.rows.namedItem(strDetalleID).cells[8].innerHTML =  formatMoney(intAbono, 2, '');
						objTabla.rows.namedItem(strDetalleID).cells[9].innerHTML =  formatMoney(intSaldoInsoluto, 2, '');
						objTabla.rows.namedItem(strDetalleID).cells[19].innerHTML = intAbono;
						objTabla.rows.namedItem(strDetalleID).cells[24].innerHTML = strObjetoImpuestoSat;
						objTabla.rows.namedItem(strDetalleID).cells[25].innerHTML = strObjetoImpuesto;
					}

					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();

					//Enfocar caja de texto
					$('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();
				}
				else
				{
					//Cambiar cantidad a formato moneda
			    	intSaldoFacturaConv = formatMoney(intSaldoFacturaConv, 2, '');

					//Asignar saldo de la factura
					$('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(intSaldoFacturaConv);

					/*Mensaje que se utiliza para informar al usuario que el pago no debe ser mayor que el saldo de la factura*/
					strMensaje = 'El pago aplicado sobrepasa el saldo de la factura.';
					strMensaje += '<br>Saldo restante: <b>'+intSaldoFacturaConv+'</b>';
					//Hacer un llamado a la función para mostrar mensaje de información
				    mensaje_notas_credito_digitales_cuentas_cobrar('informacion', strMensaje);

				}
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_notas_credito_digitales_cuentas_cobrar tr").length - 2;
			$('#numElementos_detalles_notas_credito_digitales_cuentas_cobrar').html(intFilas);
			$('#txtNumDetalles_notas_credito_digitales_cuentas_cobrar').val(intFilas);
		}

		//Función para inicializar elementos del detalle
		function inicializar_detalle_fras_relacionadas_notas_credito_digitales_cuentas_cobrar() 
		{
			//Limpiar las siguientes cajas de texto
			$('#txtReferenciaID_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
			$('#txtReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
			$('#txtFecha_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtTipoReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtMonedaID_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtMonedaTipo_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtTipoCambio_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtConcepto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtSubtotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtTasaCuotaIvaFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtIvaFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtTasaCuotaIepsFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtIepsFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtImporteTotal_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtAbonoAux_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		    $('#txtSaldoFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
		}

		
		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_fras_relacionadas_notas_credito_digitales_cuentas_cobrar(objRenglon)
		{
			//Variable que se utiliza para asignar la moneda de la nota de crédito digital
			var intMonedaIDNotaCredito =  parseInt($("#cmbMonedaID_notas_credito_digitales_cuentas_cobrar").val());
			//Variable que se utiliza para asignar el tipo de cambio de la nota de crédito digital
			var intTipoCambioNotaCredito =  parseFloat($("#txtTipoCambio_notas_credito_digitales_cuentas_cobrar").val());

			//Asignar valores del detalle
			var intTipoCambio = parseFloat(objRenglon.parentNode.parentNode.cells[3].innerHTML);
		    var intMonedaID = parseInt(objRenglon.parentNode.parentNode.cells[12].innerHTML);
		    var intAbonoAux = parseFloat(objRenglon.parentNode.parentNode.cells[19].innerHTML);
		    var intAbono = intAbonoAux;

		     //Si el tipo de moneda de la factura es diferente a la moneda de la nota de crédito digital
			if(intMonedaID !== intMonedaIDNotaCredito )
			{
				//Si el tipo de moneda de la factura corresponde a peso mexicano
			    if(intMonedaID == intMonedaBaseIDNotasCreditoDigitalesCuentasCobrar)
				{
					//Convertir peso mexicano a tipo de cambio
					intAbono = intAbono / intTipoCambioNotaCredito;
				}
				else
				{
					//Convertir importe a peso mexicano
					intAbono = intAbono * intTipoCambio;
				}
			}

			//Convertir cantidad a formato moneda
			intAbono = formatMoney(intAbono, 2, '');

			//Asignar los valores a las cajas de texto
			$('#txtReferenciaID_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtTipoReferencia_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtMonedaID_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(intMonedaID);
			$('#txtMonedaTipo_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtTipoCambio_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtConcepto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			$('#txtImporteTotal_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[7].innerHTML);
			$('#txtSubtotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtTasaCuotaIvaFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtIvaFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[15].innerHTML);
			$('#txtTasaCuotaIepsFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtIepsFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);
			$('#txtSaldoFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[18].innerHTML);
			$('#txtFecha_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[22].innerHTML);
			$('#txtAbonoAux_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(intAbonoAux);
			$('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(intAbono);
			$('#txtObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[24].innerHTML);
			$('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[25].innerHTML);

			//Si no existe código del objeto de impuesto SAT
			if($('#txtObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val() == '')
			{
				//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
				cargar_objeto_impuesto_base_notas_credito_digitales_cuentas_cobrar();
			}

			//Enfocar caja de texto
			$('#txtConcepto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();

		}
		//Función para quitar renglón de la tabla
		function eliminar_renglon_fras_relacionadas_notas_credito_digitales_cuentas_cobrar(objRenglon)
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_notas_credito_digitales_cuentas_cobrar').getElementsByTagName('tbody')[0];
			//Variable que se utiliza para eliminar detalle en la tabla CFDI relacionados
			var strEliminarCfdi = 'SI';
			
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;

			//Seleccionar el renglón de la tabla para buscar los datos en las tablas CFDI´S relacionados y Facturas relacionadas (detalles de la nota de crédito digital) de esta manera se eliminara el CFDI relacionado que le corresponde a la factura (en caso de que no exista otro detalle con la misma referencia) 
			var selectedRow = document.getElementById("dg_detalles_notas_credito_digitales_cuentas_cobrar").rows[intRenglon].cells;
			//Variables que se utilizan para asignar los valores del detalle
			var strTipoReferenciaCfdi = selectedRow[23].innerHTML;
			var intReferenciaIDCfdi = selectedRow[11].innerHTML;
			//Variable que se utiliza para asignar el id del detalle CFDI relacionado
			var strDetalleIDCfdi = intReferenciaIDCfdi+'_'+strTipoReferenciaCfdi;
		
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_notas_credito_digitales_cuentas_cobrar").deleteRow(intRenglon);
			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_notas_credito_digitales_cuentas_cobrar tr").length - 2;
			$('#numElementos_detalles_notas_credito_digitales_cuentas_cobrar').html(intFilas);
			$('#txtNumDetalles_notas_credito_digitales_cuentas_cobrar').val(intFilas);

			//Recorrer los renglones de la tabla facturas relacionadas para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar los datos de la factura
				var strTipoReferenciaCfdiFra = objRen.cells[23].innerHTML;
				var intReferenciaIDFra = objRen.cells[11].innerHTML;

				//Si existe otro detalle con las mismas características (referencia del CFDI)
				if(strTipoReferenciaCfdiFra == strTipoReferenciaCfdi && intReferenciaIDFra == intReferenciaIDCfdi)
				{
					//Asignar NO para evitar eliminar el detalle de la tabla CFDI relacionados
					strEliminarCfdi = 'NO';
					return;
				}
			}

			//Si se cumple la regla de validación
			if(strEliminarCfdi == 'SI')
			{
				//Hacer un llamado a la función para eliminar el CFDI (factura) relacionado 
				verificar_renglon_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar(null, strDetalleIDCfdi);
			}

		}

		//Función para calcular totales de la tabla
		function calcular_totales_fras_relacionadas_notas_credito_digitales_cuentas_cobrar()
		{
			
			//Hacer un llamado a la función para inicializar elementos del detalle
			inicializar_detalle_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();
			//Variable que se utiliza para asignar la moneda de la nota de crédito digital
			var intMonedaIDNotaCredito =  parseInt($("#cmbMonedaID_notas_credito_digitales_cuentas_cobrar").val());
			//Variable que se utiliza para asignar el tipo de cambio del pago
			var intTipoCambioNotaCredito =  parseFloat($("#txtTipoCambio_notas_credito_digitales_cuentas_cobrar").val());

			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_notas_credito_digitales_cuentas_cobrar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumTotalFactura = 0;
			var intAcumAbono = 0;
			var intAcumSaldoFactura = 0;


			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar los datos de la factura
				var intTipoCambio = parseFloat(objRen.cells[3].innerHTML);
				var intMonedaID = parseInt(objRen.cells[12].innerHTML);

				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intTotalFactura = $.reemplazar(objRen.cells[7].innerHTML, ",", "");
				var intAbono = $.reemplazar(objRen.cells[8].innerHTML, ",", "");
				var intSaldoFactura = $.reemplazar(objRen.cells[9].innerHTML, ",", "");
				
				//Si el tipo de moneda de la factura es diferente a la moneda de la nota de crédito digital
				if(intMonedaID !== intMonedaIDNotaCredito )
				{
					//Convertir importe a peso mexicano
					intTotalFactura = intTotalFactura * intTipoCambio;
					intAbono = intAbono * intTipoCambio;
					intSaldoFactura = intSaldoFactura * intTipoCambio;

					//Si el tipo de moneda de la factura corresponde a peso mexicano
				    if(intMonedaID == intMonedaBaseIDNotasCreditoDigitalesCuentasCobrar)
					{
						//Convertir peso mexicano a tipo de cambio
						intTotalFactura = intTotalFactura / intTipoCambioNotaCredito;
						intAbono = intAbono / intTipoCambioNotaCredito;
						intSaldoFactura = intSaldoFactura / intTipoCambioNotaCredito;
					}
					
				}

				//Incrementar acumulado
				intAcumTotalFactura += parseFloat(intTotalFactura);
    			intAcumAbono += parseFloat(intAbono);
    			intAcumSaldoFactura += parseFloat(intSaldoFactura);
			}

			//Convertir cantidad a formato moneda
			intAcumTotalFactura =  '$'+formatMoney(intAcumTotalFactura, 2, '');
			intAcumAbono =  '$'+formatMoney(intAcumAbono, 2, '');
			intAcumSaldoFactura =  '$'+formatMoney(intAcumSaldoFactura, 2, '');

			//Asignar los valores
			$('#acumTotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html(intAcumTotalFactura);
			$('#acumAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html(intAcumAbono);
			$('#acumSaldoFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html(intAcumSaldoFactura);
			$('#monedaNotaCredito_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html(strMonedaNotasCreditoDigitalesCuentasCobrar);
		}


		/*******************************************************************************************************************
		Funciones del modal Relacionar Documentos (facturas) de la Nota de Crédito Digital
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_fras_notas_credito_digitales_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmRelacionarFrasNotasCreditoDigitalesCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_fras_notas_credito_digitales_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarFrasNotasCreditoDigitalesCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_fras_notas_credito_digitales_cuentas_cobrar');
			//Eliminar los datos de la tabla documentos (facturas) a relacionar
		    $('#dg_relacionar_fras_notas_credito_digitales_cuentas_cobrar tbody').empty();
		    $('#numElementos_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html(0);
		    $('#acumSaldo_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html('$0.00');
		    $('#acumSaldoVencido_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html('$0.00');
		    $('#acumAntSaldo_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html('$0.00');
		    $('#acumAntSaldoVencido_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html('$0.00');
		    //Deshabilitar la siguiente caja de texto
			$('#txtRazonSocialBusq_relacionar_fras_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled");
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_fras_notas_credito_digitales_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_fras_notas_credito_digitales_cuentas_cobrar();
			//Variables que se utilizan para asignar los datos del registro
			var strEstatus =  $('#txtEstatus_notas_credito_digitales_cuentas_cobrar').val();
			var strRazonSocial =  $('#txtRazonSocial_notas_credito_digitales_cuentas_cobrar').val();
			var intProspectoID =  $('#txtProspectoID_notas_credito_digitales_cuentas_cobrar').val();

			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_fras_notas_credito_digitales_cuentas_cobrar').addClass("estatus-"+strEstatus);
		    //Asignar los datos del cliente
		    $('#txtProspectoIDBusq_relacionar_fras_notas_credito_digitales_cuentas_cobrar').val(intProspectoID);
		    $('#txtRazonSocialBusq_relacionar_fras_notas_credito_digitales_cuentas_cobrar').val(strRazonSocial);

			//Abrir modal
			objRelacionarFrasNotasCreditoDigitalesCuentasCobrar = $('#RelacionarFrasNotasCreditoDigitalesCuentasCobrarBox').bPopup({
														  appendTo: '#NotasCreditoDigitalesCuentasCobrarContent', 
						                              	  contentContainer: 'NotasCreditoDigitalesCuentasCobrarM', 
						                              	  zIndex: 2, 
						                              	  modalClose: false, 
						                              	  modal: true, 
						                              	  follow: [true,false], 
						                              	  followEasing : "linear", 
						                              	  easing: "linear", 
						                             	  modalColor: ('#F0F0F0')});

			//Hacer un llamado a la función  para cargar las facturas con adeudos en el grid
			lista_facturas_relacionar_fras_notas_credito_digitales_cuentas_cobrar();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_fras_notas_credito_digitales_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objRelacionarFrasNotasCreditoDigitalesCuentasCobrar.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_fras_notas_credito_digitales_cuentas_cobrar()
		{

			//Hacer un llamado a la función para agregar las facturas seleccionadas al  objeto Facturas relacionadas
			agregar_facturas_relacionar_fras_notas_credito_digitales_cuentas_cobrar();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_fras_notas_credito_digitales_cuentas_cobrar();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarFrasNotasCreditoDigitalesCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumFras_relacionar_fras_notas_credito_digitales_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccionar al menos una factura para esta nota de crédito digital.'
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
			var bootstrapValidator_relacionar_fras_notas_credito_digitales_cuentas_cobrar = $('#frmRelacionarFrasNotasCreditoDigitalesCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_relacionar_fras_notas_credito_digitales_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_fras_notas_credito_digitales_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_fras_notas_credito_digitales_cuentas_cobrar();
				//Hacer un llamado a la función para agregar las facturas en la tabla facturas relacionadas
		  		agregar_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_fras_notas_credito_digitales_cuentas_cobrar()
		{
			try
			{
				$('#frmRelacionarFrasNotasCreditoDigitalesCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar facturas
		*********************************************************************************************************************/
		//Función para la búsqueda de facturas
		function lista_facturas_relacionar_fras_notas_credito_digitales_cuentas_cobrar() 
		{
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/pagos/get_facturas_adeudos',
					{	
						intProspectoID: $('#txtProspectoIDBusq_relacionar_fras_notas_credito_digitales_cuentas_cobrar').val(), 
						intMonedaIDPago: $('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').val(),
						intTipoCambioPago: $('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').val(), 
						strTipo: strTipoReferenciaNotasCreditoDigitalesCuentasCobrar
					},
					function(data){
						$('#dg_relacionar_fras_notas_credito_digitales_cuentas_cobrar tbody').empty();
						var tmpRelacionarFrasNotasCreditoDigitalesCuentasCobrar = Mustache.render($('#plantilla_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html(),data);
						$('#numElementos_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html(data.rows.length);	
						}
						$('#acumSaldo_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html(data.acumulado_saldo);
						$('#acumSaldoVencido_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html(data.acumulado_saldo_vencido+' '+strMonedaNotasCreditoDigitalesCuentasCobrar);
						$('#acumAntSaldo_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html(data.acumulado_anticipos);
						$('#acumAntSaldoVencido_relacionar_fras_notas_credito_digitales_cuentas_cobrar').html(data.acumulado_anticipos+' '+strMonedaNotasCreditoDigitalesCuentasCobrar);
						$('#dg_relacionar_fras_notas_credito_digitales_cuentas_cobrar tbody').html(tmpRelacionarFrasNotasCreditoDigitalesCuentasCobrar);
					
						
					},
			'json');

			
		}

		//Función para agregar las facturas seleccionadas al objeto Facturas relacionadas
		function agregar_facturas_relacionar_fras_notas_credito_digitales_cuentas_cobrar()
		{
			//Variable que se utiliza para asignar la razón social del cliente
			var strRazonSocial =  $('#txtRazonSocialBusq_relacionar_fras_notas_credito_digitales_cuentas_cobrar').val();
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
		    //Crear instancia del objeto Facturas relacionadas (seleccionadas)
			objFrasRelacionadasNotasCreditoDigitalesCuentasCobrar = new FrasRelacionadasNotasCreditoDigitalesCuentasCobrar([]);
			//Crear instancia del objeto CFDI relacionados (facturas seleccionadas)
			objCfdisRelacionadosNotasCreditoDigitalesCuentasCobrar = new CfdisRelacionadosNotasCreditoDigitalesCuentasCobrar([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_fras_notas_credito_digitales_cuentas_cobrar tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
					//Crear instancia del objeto Factura a relacionar
					objFraRelacionarNotasCreditoDigitalesCuentasCobrar = new FraRelacionarNotasCreditoDigitalesCuentasCobrar(null, '', '', '', '', 
																															 '', '', '', '',
																															 '', '', '', '', 
																															 '', '', '', 
																															 '','', '', '', '');

					//Crear instancia del objeto CFDI a relacionar
					objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar = new CfdiRelacionarNotasCreditoDigitalesCuentasCobrar(null, '', '', '', '', '', '');

                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intReferenciaID = strValor;
							        objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.intReferenciaID = strValor;
							        objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strCliente = strRazonSocial;
							        break;
							    case 1:
							        objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strUuid = strValor;
							        break;
							    case 2:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intTipoCambio = strValor;
							        break;
							    case 3:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intMonedaID = strValor;
							        break;
							    case 4:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intSubtotalFactura = strValor;
							        break;
							    case 5:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intTasaCuotaIvaFactura = strValor;
							        break;
							    case 6:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intIvaFactura = strValor;
							        break;
							    case 7:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intTasaCuotaIepsFactura = strValor;
							        break;
							    case 8:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intIepsFactura = strValor;
							        break;
							    case 9:
							        objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.intImporte = strValor;
							        break;
							    case 10:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strTipoTasaCuotaIeps = strValor;
							        break;
							    case 11:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strFactorTasaCuotaIeps = strValor;
							        break;
							    case 12:
							          objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strTipoReferencia = strValor;
							          objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strTipoReferenciaCfdi = strValor;
							        break;
							    case 13:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strFolio = strValor;
							        objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strFolio = strValor;
							        break;
							    case 14:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strMonedaTipo = strValor;
							        break;
							    case 15:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.dteFecha = strValor;
							        objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.dteFecha = strValor;
							        break;
							    case 17:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.strTipoReferencia = strValor;
							        break;
							    case 18:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intPorcentajeIvaFactura = strValor;
							        break;
							    case 19:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intPorcentajeIepsFactura = strValor;
							        break;
							    case 20:
							        objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intTotalFactura = strValor;
							        break;
							    case 21:
							     		 objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intAbono = strValor;
							       		 objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intSaldoInsoluto = 0;
							       		 //Hacer un llamado a la función para reemplazar ',' por cadena vacia
							       		 strValor = $.reemplazar(strValor, ",", "");
										 objFraRelacionarNotasCreditoDigitalesCuentasCobrar.intSaldoFactura = strValor;
							    	break;
							}
							
					      	intCol++;
					    });

                	//Agregar datos de la factura a relacionar
                	objFrasRelacionadasNotasCreditoDigitalesCuentasCobrar.setFactura(objFraRelacionarNotasCreditoDigitalesCuentasCobrar);
                	//Agregar datos del cfdi a relacionar
            		objCfdisRelacionadosNotasCreditoDigitalesCuentasCobrar.setCfdi(objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumFras_relacionar_fras_notas_credito_digitales_cuentas_cobrar').val(intContador);

		}

		

		/*******************************************************************************************************************
		Funciones de la tabla CFDI relacionados
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar(tipoAccion, estatus)
		{
			
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';
		    //Variable que se utiliza para asignar el indice del renglón
		    var intRenglon = 0;

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'TIMBRAR')
			{
				strAccionesTabla = "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='verificar_renglon_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar(this,null)'>" + 
									   "<span class='glyphicon glyphicon-trash'></span></button>" + 
									   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
									   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
									   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
									   "<span class='glyphicon glyphicon-arrow-down'></span></button>";
			}

			//Si el tipo de acción corresponde a Editar						   
			if(tipoAccion == 'Editar')
			{
				
				//Obtenemos el objeto de la tabla
				var objTablaFrasRelacionadas = document.getElementById('dg_detalles_notas_credito_digitales_cuentas_cobrar').getElementsByTagName('tbody')[0];

				//Hacer un llamado al método del controlador para regresar listado de registros
				$.post('caja/cfdi_relacionados/get_datos',
					{	
						intReferenciaID: $('#txtNotaCreditoDigitalID_notas_credito_digitales_cuentas_cobrar').val(),
						strTipoReferencia: strTipoReferenciaNotasCreditoDigitalesCuentasCobrar
					},
						function(data){

							//Mostramos los CFDI relacionados (facturas seleccionadas)
				           	for (var intCon in data.rows) 
				            {

				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar').getElementsByTagName('tbody')[0];

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
								//Variables que se utilizan para asignar los valores del detalle
								var intReferenciaID = data.rows[intCon].referencia_id;
								var strTipoReferencia = data.rows[intCon].tipo_referencia;

								//Variable que se utiliza para asignar el id del detalle
								var strDetalleID =  intReferenciaID+'_'+strTipoReferencia;

								//Variable que se utiliza para asignar las acciones del grid view (en caso de que el folio del CFDI relacionado se encuentre en la tabla facturas relacionadas)
		    					var strAccionesRenglon = strAccionesTabla;

								//Recorrer los renglones de la tabla facturas relacionadas para obtener los valores
								for (var intRenFra = 0, objRenFra ; objRenFra = objTablaFrasRelacionadas.rows[intRenFra]; intRenFra ++) 
								{
									//Variables que se utilizan para asignar los datos de la factura
									var strTipoReferenciaCfdiFra = objRenFra .cells[23].innerHTML;
									var intReferenciaIDFra = objRenFra.cells[11].innerHTML;

									//Si existe otro detalle con las mismas características (referencia del CFDI)
									if(strTipoReferenciaCfdiFra == strTipoReferencia && intReferenciaIDFra == intReferenciaID)
									{
										//Asignar NO para evitar eliminar el detalle de la tabla CFDI relacionados
										strAccionesRenglon = '';
									}
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
							var intFilas = $("#dg_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar tr").length - 1;
							$('#numElementos_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar').html(intFilas);
							$('#txtNumCfdiRelacionados_notas_credito_digitales_cuentas_cobrar').val(intFilas);
						},
				'json');
			}
			else
			{
				//Mostramos los CFDI relacionados (facturas seleccionadas)
				for (var intCon in objCfdisRelacionadosNotasCreditoDigitalesCuentasCobrar.getCfdis()) 
	            {
	            	//Crear instancia del objeto CFDI a relacionar 
	            	objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar = new CfdiRelacionarNotasCreditoDigitalesCuentasCobrar();
	            	//Asignar datos del CFDI corespondiente al indice
	            	objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar = objCfdisRelacionadosNotasCreditoDigitalesCuentasCobrar.getCfdi(intCon);
	            	
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar').getElementsByTagName('tbody')[0];
				
					//Variable que se utiliza para asignar el id del detalle
					var strDetalleID =  objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.intReferenciaID+'_'+objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strTipoReferencia;

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
						objCeldaCliente.innerHTML = objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strCliente;
						objCeldaFolio.setAttribute('class', 'movil c2');
						objCeldaFolio.innerHTML = objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strFolio;
						objCeldaFecha.setAttribute('class', 'movil c3');
						objCeldaFecha.innerHTML = objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.dteFecha;
						objCeldaModulo.setAttribute('class', 'movil c4');
						objCeldaModulo.innerHTML = objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strTipoReferencia;
						objCeldaUuid.setAttribute('class', 'movil c5');
						objCeldaUuid.innerHTML =  objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.strUuid;
						objCeldaImporte.setAttribute('class', 'movil c6');
						objCeldaImporte.innerHTML = objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.intImporte;
						objCeldaAcciones.setAttribute('class', 'td-center movil c7');
						objCeldaAcciones.innerHTML = strAccionesTabla;
						objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
						objCeldaReferenciaID.innerHTML = objCfdiRelacionarNotasCreditoDigitalesCuentasCobrar.intReferenciaID;
					}
	            }

	            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
				var intFilas = $("#dg_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar tr").length - 1;
				$('#numElementos_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar').html(intFilas);
				$('#txtNumCfdiRelacionados_notas_credito_digitales_cuentas_cobrar').val(intFilas);
			}
		}


		//Función para verificar el id (CFDI) del renglón de la tabla antes de eliminarlo
		function verificar_renglon_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar(objRenglon, id)
		{
			//Si existe id, significa que se eliminará la factura relacionada (quitar elemento de la tabla)
			if(id != null)
			{
				//Obtenemos el objeto de la tabla 
				var objTabla = document.getElementById('dg_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar').getElementsByTagName('tbody')[0];

				//Asignar pivote (mitad del arreglo) para hacer la búsqueda más rápida
				var intPivoteInicial = Math.round(objTabla.childNodes.length / 2);
				//Asignar pivote inicial para evitar que el pivote inicial no busque una posición que no contiene el arreglo
				var intPivote = intPivoteInicial;

				
				//Hacer recorrido para obtener el indice del renglón 
				for (var intRen = 0; intRen <= intPivote; intRen++, intPivoteInicial++) 
				{
					//Revisamos que exista el ID proporcionado, si es así, eliminar el renglón de la tabla
					if(objTabla.childNodes[intRen].id == id)
					{
						//Hacer un llamado a la función para quitar el renglón de la tabla
						eliminar_renglon_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar(objTabla.childNodes[intRen].rowIndex);
						return;
					}

					//Si el pivote es mayor que el arreglo de la tabla
					if (objTabla.childNodes.length >  1)
					{
						//Revisamos que exista el ID proporcionado, si es así, eliminar el renglón de la tabla
						if(objTabla.childNodes[intPivoteInicial].id == id)
						{
							//Hacer un llamado a la función para quitar el renglón de la tabla
							eliminar_renglon_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar(objTabla.childNodes[intPivoteInicial].rowIndex);
							return;
						}
						
					}
				}

			}
			else
			{
				//Hacer un llamado a la función para quitar el renglón de la tabla
				eliminar_renglon_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar(objRenglon.parentNode.parentNode.rowIndex);
			}

		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar(renglon)
		{
			//Eliminar el renglón indicado
			document.getElementById("dg_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar").deleteRow(renglon);
			//Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
			var intFilas = $("#dg_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar tr").length - 1;
			$('#numElementos_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar').html(intFilas);
			$('#txtNumCfdiRelacionados_notas_credito_digitales_cuentas_cobrar').val(intFilas);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Notas de Crédito Digitales
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').numeric();
			$('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_notas_credito_digitales_cuentas_cobrar').blur(function(){
				$('.moneda_notas_credito_digitales_cuentas_cobrar').formatCurrency({ roundToDecimalPlace: 2 });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_notas_credito_digitales_cuentas_cobrar').blur(function(){
                $('.tipo-cambio_notas_credito_digitales_cuentas_cobrar').formatCurrency({ roundToDecimalPlace: 4 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_notas_credito_digitales_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});

			//Regresar el tipo de cambio de la moneda cuando cambie la fecha
			$('#dteFecha_notas_credito_digitales_cuentas_cobrar').on('dp.change', function (e) {
				//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_notas_credito_digitales_cuentas_cobrar();
			});

			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').change(function(e){   
	           
	           	//Variable que se utiliza para asignar el texto del combobox moneda
				var strMoneda = '';
				//Si existe id de la moneda
             	if($('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').val() !== '')
             	{

             		//Asignar el texto del combobox moneda
				    strMoneda = $('select[name="intMonedaID_notas_credito_digitales_cuentas_cobrar"] option:selected').text();
					//Separar cadena para obtener el código de la moneda de la moneda de la nota de crédito digital
					strMoneda = strMoneda.substr(0,3);

             	}
             	
				//Asignar el código de la moneda
				$('#spnMonedaNotaCredito_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').text(strMoneda);
				strMonedaNotasCreditoDigitalesCuentasCobrar = strMoneda;


	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').val()) === intMonedaBaseIDNotasCreditoDigitalesCuentasCobrar)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_notas_credito_digitales_cuentas_cobrar").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').val(intTipoCambioMonedaBaseNotasCreditoDigitalesCuentasCobrar);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').formatCurrency({ roundToDecimalPlace: 4 });
					//Si existe id del prospecto
	                if($("#txtProspectoID_notas_credito_digitales_cuentas_cobrar").val() !== '')
	                {
	                	//Habilitar botón Buscar facturas
                  		$('#btnBuscarDoc_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
	                }

	                //Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_notas_credito_digitales_cuentas_cobrar").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_notas_credito_digitales_cuentas_cobrar();
             	}

	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoNotasCreditoDigitalesCuentasCobrar)
	        	{
	        		$('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').val(intTipoCambioMaximoNotasCreditoDigitalesCuentasCobrar);
	        	}

	        	//Si no existe tipo de cambio 
	        	if($('#txtTipoCambio_notas_credito_digitales_cuentas_cobrar').val() == '' || $('#txtProspectoID_notas_credito_digitales_cuentas_cobrar').val() == '' )
	        	{
	        		//Deshabilitar botón  Buscar facturas
					$('#btnBuscarDoc_notas_credito_digitales_cuentas_cobrar').attr("disabled", "disabled"); 
					//Inicializar valores de los acumulados
	         		$('#acumTotalFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html('$0.00');
	         		$('#acumAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html('$0.00');
	         		$('#acumSaldoFactura_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').html('$0.00');
	        	}
	        	else
	        	{
	        		//Habilitar botón Buscar facturas
					$('#btnBuscarDoc_notas_credito_digitales_cuentas_cobrar').removeAttr('disabled');
					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();
	        	}

		    });

			
			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_notas_credito_digitales_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_notas_credito_digitales_cuentas_cobrar').val('');
	               //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_notas_credito_digitales_cuentas_cobrar();
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

	           		//Si existe id del regimen fiscal
		            if(ui.item.regimen_fiscal_id > 0)
		            {
		             	//Asignar id del registro seleccionado
		            	$('#txtProspectoID_notas_credito_digitales_cuentas_cobrar').val(ui.item.data);
		              	//Hacer un llamado a la función para regresar los datos del cliente
		              	get_datos_cliente_notas_credito_digitales_cuentas_cobrar();
	                }
		            else
		            {
		             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					     mensaje_notas_credito_digitales_cuentas_cobrar('error_regimen_fiscal','','txtRazonSocial_notas_credito_digitales_cuentas_cobrar');
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
	        
	        //Verificar que exista id del cliente cuando pierda el enfoque la caja de texto
	        $('#txtRazonSocial_notas_credito_digitales_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_notas_credito_digitales_cuentas_cobrar').val() == '' || $('#txtRazonSocial_notas_credito_digitales_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_notas_credito_digitales_cuentas_cobrar').val('');
	               $('#txtRazonSocial_notas_credito_digitales_cuentas_cobrar').val('');
	               //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_notas_credito_digitales_cuentas_cobrar();
                 
	            }
	        });

	        //Autocomplete para recuperar los datos de una forma de pago
	        $('#txtFormaPago_notas_credito_digitales_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtFormaPagoID_notas_credito_digitales_cuentas_cobrar').val('');
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
	             $('#txtFormaPagoID_notas_credito_digitales_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtFormaPago_notas_credito_digitales_cuentas_cobrar').focusout(function(e){
	            //Si no existe id de la forma de pago
	            if($('#txtFormaPagoID_notas_credito_digitales_cuentas_cobrar').val() == '' ||
	               $('#txtFormaPago_notas_credito_digitales_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtFormaPagoID_notas_credito_digitales_cuentas_cobrar').val('');
	               $('#txtFormaPago_notas_credito_digitales_cuentas_cobrar').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un método de pago
	        $('#txtMetodoPago_notas_credito_digitales_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMetodoPagoID_notas_credito_digitales_cuentas_cobrar').val('');
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
	             $('#txtMetodoPagoID_notas_credito_digitales_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtMetodoPago_notas_credito_digitales_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del método de pago
	            if($('#txtMetodoPagoID_notas_credito_digitales_cuentas_cobrar').val() == '' ||
	               $('#txtMetodoPago_notas_credito_digitales_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMetodoPagoID_notas_credito_digitales_cuentas_cobrar').val('');
	               $('#txtMetodoPago_notas_credito_digitales_cuentas_cobrar').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un uso del CFDI
	        $('#txtUsoCfdi_notas_credito_digitales_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsoCfdiID_notas_credito_digitales_cuentas_cobrar').val('');
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
	             $('#txtUsoCfdiID_notas_credito_digitales_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtUsoCfdi_notas_credito_digitales_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del uso de CFDI
	            if($('#txtUsoCfdiID_notas_credito_digitales_cuentas_cobrar').val() == '' ||
	               $('#txtUsoCfdi_notas_credito_digitales_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUsoCfdiID_notas_credito_digitales_cuentas_cobrar').val('');
	               $('#txtUsoCfdi_notas_credito_digitales_cuentas_cobrar').val('');
	            }
	            
	        }); 

	        //Autocomplete para recuperar los datos de un tipo de relación
	        $('#txtTipoRelacion_notas_credito_digitales_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTipoRelacionID_notas_credito_digitales_cuentas_cobrar').val('');
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
	             $('#txtTipoRelacionID_notas_credito_digitales_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtTipoRelacion_notas_credito_digitales_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtTipoRelacionID_notas_credito_digitales_cuentas_cobrar').val() == '' ||
	               $('#txtTipoRelacion_notas_credito_digitales_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTipoRelacionID_notas_credito_digitales_cuentas_cobrar').val('');
	               $('#txtTipoRelacion_notas_credito_digitales_cuentas_cobrar').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un objeto de impuesto
	        $('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al código del registro 
	                 $('#txtObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
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
	               $('#txtObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val(strCodigo);

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
	        $('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focusout(function(e){
	            //Si no existe código del objeto de impuesto
	            if($('#txtObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val() == '' ||
	               $('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
	               $('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
	            }
	            
	        });


	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_cfdi_relacionados_notas_credito_digitales_cuentas_cobrar').on('click','button.btn',function(){
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


	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_notas_credito_digitales_cuentas_cobrar').on('click','button.btn',function(){
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

			//Verificar que el importe no sea un valor negativo cuando pierda el enfoque la caja de texto
	        $('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focusout(function(e){
	            //Si el importe es un valor negativo
	            if(parseInt($('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val()) <= 0)
	            { 
	            	//Limpiar caja de texto
	             	$('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val('');
	             	//Enfocar caja de texto
				    $('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();
	            }

	        });


	        //Validar que exista concepto cuando se pulse la tecla enter 
			$('#txtConcepto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe concepto
		           if($('#txtConcepto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtConcepto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();
			   	    }
		        }
		    });


		    //Validar que exista código del objeto de impuesto SAT cuando se pulse la tecla enter 
			$('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe código del objeto de impuesto SAT  
		           if($('#txtObjetoImpuestoSat_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtObjetoImpuesto_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();
			   	    }
		        }
		    });

			//Validar que exista importe del pago cuando se pulse la tecla enter 
			$('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe importe del pago
		            if($('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val() == '' ||
	                   parseInt($('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').val()) <= 0)
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtAbono_fras_relacionadas_notas_credito_digitales_cuentas_cobrar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_fras_relacionadas_notas_credito_digitales_cuentas_cobrar();
			   	    }
		        }
		    });

	       
            /*******************************************************************************************************************
			Controles correspondientes al modal Relacionar CFDI
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});
			

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').val('');
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
	             $('#txtProspectoIDBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').val() == '' ||
	            	$('#txtRazonSocialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').val('');
	               $('#txtRazonSocialBusq_relacionar_cfdi_notas_credito_digitales_cuentas_cobrar').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_notas_credito_digitales_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar').val('');
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
	             $('#txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_notas_credito_digitales_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar').val() == '' ||
	            	$('#txtRazonSocialBusq_notas_credito_digitales_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar').val('');
	               $('#txtRazonSocialBusq_notas_credito_digitales_cuentas_cobrar').val('');
	            }
	            
	        });

	        /*******************************************************************************************************************
			Controles correspondientes al modal Cancelación del timbrado
			**************************************	*******************************************************************************/
			 //Autocomplete para recuperar los datos de una sustitución (factura, pago, etc.)
	        $('#txtFolioSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSustitucionID_cancelacion_notas_credito_digitales_cuentas_cobrar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/notas_credito_digitales/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intReferenciaID: $('#txtReferenciaCfdiID_cancelacion_notas_credito_digitales_cuentas_cobrar').val(),
	                   strFormulario: 'cancelacion'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtSustitucionID_cancelacion_notas_credito_digitales_cuentas_cobrar').val(ui.item.data);
	             $('#txtUuidSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar').val(ui.item.uuid);
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
	        $('#txtFolioSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtSustitucionID_cancelacion_notas_credito_digitales_cuentas_cobrar').val() == '' ||
	               $('#txtFolioSustitucion_cancelacion_notas_credito_digitales_cuentas_cobrar').val() == '')
	            { 
	               //Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_notas_credito_digitales_cuentas_cobrar();
	            }
	            
	        });

	        //Verificar motivo de cancelación cuando cambie la opción del combobox
	        $('#cmbCancelacionMotivoID_cancelacion_notas_credito_digitales_cuentas_cobrar').change(function(e){   
	            //Si el motivo de cancelación no corresponde a 01 - Comprobante emitido con errores con relación.
              	if(parseInt($('#cmbCancelacionMotivoID_cancelacion_notas_credito_digitales_cuentas_cobrar').val()) !== intCancelacionIDRelacionCfdiNotasCreditoDigitalesCuentasCobrar)
             	{
             		//Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_notas_credito_digitales_cuentas_cobrar();
					
             	}
	        });

	        /*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_notas_credito_digitales_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_notas_credito_digitales_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_notas_credito_digitales_cuentas_cobrar').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_notas_credito_digitales_cuentas_cobrar').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_notas_credito_digitales_cuentas_cobrar').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_notas_credito_digitales_cuentas_cobrar').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un prospecto 
	        $('#txtRazonSocialBusq_notas_credito_digitales_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar').val('');
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
	             $('#txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_notas_credito_digitales_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar').val() == '' ||
	               $('#txtRazonSocialBusq_notas_credito_digitales_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_notas_credito_digitales_cuentas_cobrar').val('');
	               $('#txtRazonSocialBusq_notas_credito_digitales_cuentas_cobrar').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_notas_credito_digitales_cuentas_cobrar').on('click','a',function(event){
				event.preventDefault();
				intPaginaNotasCreditoDigitalesCuentasCobrar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_notas_credito_digitales_cuentas_cobrar();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_notas_credito_digitales_cuentas_cobrar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_notas_credito_digitales_cuentas_cobrar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_notas_credito_digitales_cuentas_cobrar').addClass("estatus-NUEVO");
				//Abrir modal
				 objNotasCreditoDigitalesCuentasCobrar = $('#NotasCreditoDigitalesCuentasCobrarBox').bPopup({
												   appendTo: '#NotasCreditoDigitalesCuentasCobrarContent', 
					                               contentContainer: 'NotasCreditoDigitalesCuentasCobrarM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_notas_credito_digitales_cuentas_cobrar').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_notas_credito_digitales_cuentas_cobrar').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_notas_credito_digitales_cuentas_cobrar();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_notas_credito_digitales_cuentas_cobrar();
            //Hacer un llamado a la función para cargar los motivos de cancelación en el combobox del modal
            cargar_motivos_cancelacion_notas_credito_digitales_cuentas_cobrar();
             //Hacer un llamado a la función para cargar exportación en el combobox del modal
            cargar_exportacion_notas_credito_digitales_cuentas_cobrar();

		});
	</script>