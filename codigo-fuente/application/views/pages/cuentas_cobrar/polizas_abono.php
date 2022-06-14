	<div id="PolizasAbonoCuentasCobrarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_polizas_abono_cuentas_cobrar" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_polizas_abono_cuentas_cobrar" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_polizas_abono_cuentas_cobrar">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_polizas_abono_cuentas_cobrar'>
				                    <input class="form-control" id="txtFechaInicialBusq_polizas_abono_cuentas_cobrar"
				                    		name= "strFechaInicialBusq_polizas_abono_cuentas_cobrar" 
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
								<label for="txtFechaFinalBusq_polizas_abono_cuentas_cobrar">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_polizas_abono_cuentas_cobrar'>
				                    <input class="form-control" id="txtFechaFinalBusq_polizas_abono_cuentas_cobrar"
				                    		name= "strFechaFinalBusq_polizas_abono_cuentas_cobrar" 
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
								<input id="txtProspectoIDBusq_polizas_abono_cuentas_cobrar" 
									   name="intProspectoIDBusq_polizas_abono_cuentas_cobrar"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocialBusq_polizas_abono_cuentas_cobrar">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_polizas_abono_cuentas_cobrar" 
										name="strRazonSocialBusq_polizas_abono_cuentas_cobrar" 
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
								<label for="cmbEstatusBusq_polizas_abono_cuentas_cobrar">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_polizas_abono_cuentas_cobrar" 
								 		name="strEstatusBusq_polizas_abono_cuentas_cobrar" tabindex="1">
								    <option value="TODOS">TODOS</option>
	                  				<option value="ACTIVO">ACTIVO</option>
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
								<label for="txtBusqueda_polizas_abono_cuentas_cobrar">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_polizas_abono_cuentas_cobrar" 
										name="strBusqueda_polizas_abono_cuentas_cobrar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_polizas_abono_cuentas_cobrar" 
									   name="strImprimirDetalles_polizas_abono_cuentas_cobrar" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_polizas_abono_cuentas_cobrar"
									onclick="paginacion_polizas_abono_cuentas_cobrar();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_polizas_abono_cuentas_cobrar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_polizas_abono_cuentas_cobrar"
									onclick="reporte_polizas_abono_cuentas_cobrar('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_polizas_abono_cuentas_cobrar"
									onclick="reporte_polizas_abono_cuentas_cobrar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla pólizas de abono
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Razón social"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "RFC"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

			    /*
				Definir columnas de la tabla facturas a relacionar
				*/
				td.movil.b1:nth-of-type(1):before {content: "Referencia"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "T.C."; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Moneda ID"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Tasa Cuota IVA"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "Tasa Cuota IEPS"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Tipo IEPS"; font-weight: bold;}
				td.movil.b10:nth-of-type(10):before {content: "Factor IEPS"; font-weight: bold;}
				td.movil.b11:nth-of-type(11):before {content: "Folio"; font-weight: bold;}
				td.movil.b12:nth-of-type(12):before {content: "Moneda"; font-weight: bold;}
				td.movil.b13:nth-of-type(13):before {content: "Fecha"; font-weight: bold;}
				td.movil.b14:nth-of-type(14):before {content: "Fecha Venc."; font-weight: bold;}
				td.movil.b15:nth-of-type(15):before {content: "Módulo"; font-weight: bold;}
				td.movil.b16:nth-of-type(16):before {content: "IVA %"; font-weight: bold;}
				td.movil.b17:nth-of-type(17):before {content: "IEPS %"; font-weight: bold;}
				td.movil.b18:nth-of-type(18):before {content: "Importe"; font-weight: bold;}
				td.movil.b19:nth-of-type(19):before {content: "Saldo"; font-weight: bold;}
				td.movil.b20:nth-of-type(20):before {content: "Vencido"; font-weight: bold;}
				td.movil.b21:nth-of-type(21):before {content: "Seleccionar"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla facturas a relacionar
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
				Definir columnas de la tabla detalles de la póliza de abono
				*/
				td.movil.c1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Módulo"; font-weight: bold;}
				td.movil.c3:nth-of-type(3):before {content: "Moneda"; font-weight: bold;}
				td.movil.c4:nth-of-type(4):before {content: "T.C."; font-weight: bold;}
				td.movil.c5:nth-of-type(5):before {content: "Concepto"; font-weight: bold;}
				td.movil.c6:nth-of-type(6):before {content: "IVA %"; font-weight: bold;}
				td.movil.c7:nth-of-type(7):before {content: "IEPS %"; font-weight: bold;}
				td.movil.c8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.c9:nth-of-type(9):before {content: "Importe"; font-weight: bold;}
				td.movil.c10:nth-of-type(10):before {content: "Saldo"; font-weight: bold;}
				td.movil.c11:nth-of-type(11):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la póliza de abono
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
				<table class="table-hover movil" id="dg_polizas_abono_cuentas_cobrar">
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
					<script id="plantilla_polizas_abono_cuentas_cobrar" type="text/template"> 
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
										onclick="editar_polizas_abono_cuentas_cobrar({{poliza_abono_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_polizas_abono_cuentas_cobrar({{poliza_abono_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_cliente_polizas_abono_cuentas_cobrar({{poliza_abono_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_polizas_abono_cuentas_cobrar({{poliza_abono_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_polizas_abono_cuentas_cobrar({{poliza_abono_id}}, {{anticipo_id}}, 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_polizas_abono_cuentas_cobrar({{poliza_abono_id}}, {{poliza_id}},  '{{folio_poliza}}')" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_polizas_abono_cuentas_cobrar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_polizas_abono_cuentas_cobrar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_polizas_abono_cuentas_cobrar" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarPolizasAbonoCuentasCobrarBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cliente_polizas_abono_cuentas_cobrar" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarPolizasAbonoCuentasCobrar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarPolizasAbonoCuentasCobrar"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Razón social-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtPolizaAbonoID_cliente_polizas_abono_cuentas_cobrar" 
										   name="intPolizaAbonoID_cliente_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el folio del registro seleccionado-->
									<input id="txtFolio_cliente_polizas_abono_cuentas_cobrar" 
										   name="strFolio_cliente_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />
									<label for="txtRazonSocial_cliente_polizas_abono_cuentas_cobrar">Razón social</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_cliente_polizas_abono_cuentas_cobrar" 
											name="strRazonSocial_cliente_polizas_abono_cuentas_cobrar" type="text" value="" 
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
									<label for="txtCorreoElectronico_cliente_polizas_abono_cuentas_cobrar">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_cliente_polizas_abono_cuentas_cobrar" 
											name="strCorreoElectronico_cliente_polizas_abono_cuentas_cobrar" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_cliente_polizas_abono_cuentas_cobrar">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_polizas_abono_cuentas_cobrar" 
											name="strCopiaCorreoElectronico_cliente_polizas_abono_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50" />
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cliente_polizas_abono_cuentas_cobrar" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_cliente_polizas_abono_cuentas_cobrar"  
									onclick="validar_cliente_polizas_abono_cuentas_cobrar();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cliente_polizas_abono_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_cliente_polizas_abono_cuentas_cobrar();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->
		
		<!-- Diseño del modal Pólizas de Abono-->
		<div id="PolizasAbonoCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_polizas_abono_cuentas_cobrar"  class="ModalBodyTitle">
			<h1>Pólizas de Abono</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmPolizasAbonoCuentasCobrar" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmPolizasAbonoCuentasCobrar"  onsubmit="return(false)" 
					  autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtPolizaAbonoID_polizas_abono_cuentas_cobrar" 
										   name="intPolizaAbonoID_polizas_abono_cuentas_cobrar" 
										   type="hidden" 
										   value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
									<input id="txtEstatus_polizas_abono_cuentas_cobrar" 
										   name="strEstatus_polizas_abono_cuentas_cobrar" 
										   type="hidden" 
										   value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_polizas_abono_cuentas_cobrar" 
										   name="intPolizaID_polizas_abono_cuentas_cobrar" type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
                                    <input id="txtFolioPoliza_polizas_abono_cuentas_cobrar" 
                                           name="strFolioPoliza_polizas_abono_cuentas_cobrar" type="hidden" value="" />
									<label for="txtFolio_polizas_abono_cuentas_cobrar">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtFolio_polizas_abono_cuentas_cobrar" 
											name="strFolio_polizas_abono_cuentas_cobrar" 
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
									<label for="txtFecha_polizas_abono_cuentas_cobrar">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_polizas_abono_cuentas_cobrar'>
					                    <input 	class="form-control" 
					                    		id="txtFecha_polizas_abono_cuentas_cobrar"
					                    		name= "strFecha_polizas_abono_cuentas_cobrar" 
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
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la moneda-->
									<input id="txtMonedaID_polizas_abono_cuentas_cobrar" 
										   name="intMonedaID_polizas_abono_cuentas_cobrar"  
										   type="hidden"  value="">
									</input>
									<label for="txtMoneda_polizas_abono_cuentas_cobrar">Moneda</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMoneda_polizas_abono_cuentas_cobrar" 
											name="strMoneda_polizas_abono_cuentas_cobrar" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_polizas_abono_cuentas_cobrar">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_polizas_abono_cuentas_cobrar" 
											id="txtTipoCambio_polizas_abono_cuentas_cobrar" 
											name="intTipoCambio_polizas_abono_cuentas_cobrar" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="" 
											maxlength="11" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">

						<!--Autocomplete que contiene los anticipos activos-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del anticipo seleccionado-->
									<input id="txtAnticipoID_polizas_abono_cuentas_cobrar" 
										   name="intAnticipoID_polizas_abono_cuentas_cobrar"  
										   type="hidden" value="">
									</input>
									<label for="txtAnticipo_polizas_abono_cuentas_cobrar">Anticipo</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtAnticipo_polizas_abono_cuentas_cobrar" 
											name="strAnticipo_polizas_abono_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese anticipo" maxlength="250" />
								</div>
							</div>
						</div>	
						<!--Autocomplete que contiene los clientes activos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id del cliente seleccionado-->
									<input id="txtProspectoID_polizas_abono_cuentas_cobrar" 
										   name="intProspectoID_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />   
									<!-- Caja de texto oculta para recuperar la calle del cliente seleccionado-->
									<input id="txtCalle_polizas_abono_cuentas_cobrar" 
										   name="strCalle_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta para recuperar el número exterior del cliente seleccionado-->
									<input id="txtNumeroExterior_polizas_abono_cuentas_cobrar" 
										   name="strNumeroExterior_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta para recuperar el número interior del cliente seleccionado-->
									<input id="txtNumeroInterior_polizas_abono_cuentas_cobrar" 
										   name="strNumeroInterior_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta para recuperar el código postal del cliente seleccionado-->
									<input id="txtCodigoPostal_polizas_abono_cuentas_cobrar" 
										   name="strCodigoPostal_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta para recuperar la colonia del cliente seleccionado-->
									<input id="txtColonia_polizas_abono_cuentas_cobrar" 
										   name="strColonia_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta para recuperar la localidad del cliente seleccionado-->
									<input id="txtLocalidad_polizas_abono_cuentas_cobrar" 
										   name="strLocalidad_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta para recuperar el municipio del cliente seleccionado-->
									<input id="txtMunicipio_polizas_abono_cuentas_cobrar" 
										   name="strMunicipio_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta para recuperar el estado del cliente seleccionado-->
									<input id="txtEstado_polizas_abono_cuentas_cobrar" 
										   name="strEstado_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta para recuperar el país del cliente seleccionado-->
									<input id="txtPais_polizas_abono_cuentas_cobrar" 
										   name="strPais_polizas_abono_cuentas_cobrar" 
										   type="hidden" value="" />
									<label for="txtRazonSocial_polizas_abono_cuentas_cobrar">
										Razón social
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_polizas_abono_cuentas_cobrar" 
											name="strRazonSocial_polizas_abono_cuentas_cobrar" type="text" value=""   
											tabindex="1" placeholder="Ingrese razón social" maxlength="250" />
								</div>
							</div>
						</div>
						<!--RFC-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRfc_polizas_abono_cuentas_cobrar">RFC</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRfc_polizas_abono_cuentas_cobrar"
										   name="strRfc_polizas_abono_cuentas_cobrar" 
										   type="text" value="" disabled />
								</div>
							</div>
						</div>
						<!--Saldo (total del anticipo que hace falta aplicar)-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSaldoAnticipo_polizas_abono_cuentas_cobrar">Saldo por aplicar</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control" id="txtSaldoAnticipo_polizas_abono_cuentas_cobrar" 
												name="intSaldoAnticipo_polizas_abono_cuentas_cobrar" type="text" value="" disabled>
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
									<label for="txtObservaciones_polizas_abono_cuentas_cobrar">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_polizas_abono_cuentas_cobrar" 
											name="strObservaciones_polizas_abono_cuentas_cobrar" 
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
										<input id="txtNumDetalles_polizas_abono_cuentas_cobrar" 
											   name="intNumDetalles_polizas_abono_cuentas_cobrar" 
											   type="hidden" 
											   value="" />
								    </div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la póliza de abono</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Botones-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="btn-group pull-right">
															<!--Buscar documentos a relacionar para agregarlos en la tabla-->
															<button class="btn btn-primary" 
							                                			id="btnBuscarDoc_polizas_abono_cuentas_cobrar" 
							                                			onclick="abrir_relacionar_fras_polizas_abono_cuentas_cobrar();" 
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
																<input id="txtReferenciaID_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																	   name="intReferenciaID_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar el saldo de la factura-->
                                                                <input id="txtSaldoFactura_fras_relacionadas_polizas_abono_cuentas_cobrar" 
                                                                       name="intSaldoFactura_fras_relacionadas_polizas_abono_cuentas_cobrar" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                  <!-- Caja de texto oculta que se utiliza para recuperar el id de la moneda de la referencia seleccionada-->
																<input id="txtMonedaID_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																	   name="intMonedaID_fras_relacionadas_polizas_abono_cuentas_cobrar"  
																	   type="hidden" value="">
															    </input>
															     <!-- Caja de texto oculta que se utiliza para recuperar el id de la tasa del impuesto de IVA de la referencia seleccionada-->
																<input id="txtTasaCuotaIvaFactura_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																	   name="intTasaCuotaIvaFactura_fras_relacionadas_polizas_abono_cuentas_cobrar"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta que se utiliza para recuperar el id de la tasa del impuesto de IEPS de la referencia seleccionada-->
															    <input id="txtTasaCuotaIepsFactura_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																	   name="intTasaCuotaIepsFactura_fras_relacionadas_polizas_abono_cuentas_cobrar"  
																	   type="hidden" value="">
															    </input>
																<label for="txtReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar">
																	Folio
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																		name="strReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Fecha-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtFecha_fras_relacionadas_polizas_abono_cuentas_cobrar">Fecha</label>
															</div>
															<div  class="col-md-12">
																<div class='input-group date'>
												                    <input class="form-control" id="txtFecha_fras_relacionadas_polizas_abono_cuentas_cobrar"
												                    		name= "strFecha_fras_relacionadas_polizas_abono_cuentas_cobrar" 
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
																<label for="txtTipoReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar">Módulo</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtTipoReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																		name="strTipoReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Moneda-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtMonedaTipo_fras_relacionadas_polizas_abono_cuentas_cobrar">
																	Moneda
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtMonedaTipo_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																		name="strMonedaTipo_fras_relacionadas_polizas_abono_cuentas_cobrar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Tipo de cambio-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtTipoCambio_fras_relacionadas_polizas_abono_cuentas_cobrar">Tipo de cambio</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtTipoCambio_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																		name="strTipoCambio_fras_relacionadas_polizas_abono_cuentas_cobrar" type="text" value="" disabled>
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
																<label for="txtSubtotalFactura_fras_relacionadas_polizas_abono_cuentas_cobrar">Subtotal</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtSubtotalFactura_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																		name="intSubtotalFactura_fras_relacionadas_polizas_abono_cuentas_cobrar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--IVA-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIvaFactura_fras_relacionadas_polizas_abono_cuentas_cobrar">IVA</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtIvaFactura_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																		name="intIvaFactura_fras_relacionadas_polizas_abono_cuentas_cobrar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--IEPS-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIepsFactura_fras_relacionadas_polizas_abono_cuentas_cobrar">
																	IEPS
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtIepsFactura_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																		name="intIepsFactura_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																		type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Total-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtImporteTotal_fras_relacionadas_polizas_abono_cuentas_cobrar">Total</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtImporteTotal_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																		name="intImporteTotal_fras_relacionadas_polizas_abono_cuentas_cobrar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Importe (pago)-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el importe auxiliar de la referencia seleccionada-->
																<input id="txtAbonoAux_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																	   name="intAbonoAux_fras_relacionadas_polizas_abono_cuentas_cobrar"  
																	    type="hidden" value="">
															    </input>
																<label for="txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar">Pago</label>
															</div>
															<div class="col-md-12">
																<div class='input-group'>
																	<input  class="form-control moneda_polizas_abono_cuentas_cobrar" id="txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar" 
																			name="intAbono_fras_relacionadas_polizas_abono_cuentas_cobrar" type="text" value="" 
																			tabindex="1" placeholder="Ingrese pago" maxlength="22">
																	</input>
																	<span id="spnMonedaPolizaAbono_fras_relacionadas_polizas_abono_cuentas_cobrar" class="input-group-addon"></span>
																</div>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_polizas_abono_cuentas_cobrar"
					                                			onclick="agregar_renglon_fras_relacionadas_polizas_abono_cuentas_cobrar();" 
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
													<table class="table-hover movil" id="dg_detalles_polizas_abono_cuentas_cobrar">
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
																<th class="movil">Importe</th>
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
																	<strong id="acumTotalFactura_fras_relacionadas_polizas_abono_cuentas_cobrar">$0.00</strong>
																</td>
																<td class="movil ct9">
																	<strong id="acumAbono_fras_relacionadas_polizas_abono_cuentas_cobrar">$0.00</strong>
																</td>
																<td class="movil ct10">
																	<strong id="acumSaldoFactura_fras_relacionadas_polizas_abono_cuentas_cobrar">$0.00</strong>
																	<strong id="monedaPolizaAbono_fras_relacionadas_polizas_abono_cuentas_cobrar"></strong>
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
																<strong id="numElementos_detalles_polizas_abono_cuentas_cobrar">0</strong> encontrados
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
					<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_polizas_abono_cuentas_cobrar" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" 
									id="btnGuardar_polizas_abono_cuentas_cobrar"  
									onclick="validar_polizas_abono_cuentas_cobrar();"  
									title="Guardar" 
									tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_polizas_abono_cuentas_cobrar"  
									onclick="abrir_cliente_polizas_abono_cuentas_cobrar('');"  
									title="Enviar correo electrónico" tabindex="4" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_polizas_abono_cuentas_cobrar"  
									onclick="reporte_registro_polizas_abono_cuentas_cobrar('');"  
									title="Imprimir registro en PDF" 
									tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" 
									id="btnDesactivar_polizas_abono_cuentas_cobrar"  
									onclick="cambiar_estatus_polizas_abono_cuentas_cobrar('', '', '');"  
									title="Desactivar" 
									tabindex="6" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  
									id="btnCerrar_polizas_abono_cuentas_cobrar"
									type="reset" 
									aria-hidden="true" 
									onclick="cerrar_polizas_abono_cuentas_cobrar();" 
									title="Cerrar"  
									tabindex="7">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Pólizas de Abono-->

		<!-- Diseño del modal Relacionar Documentos (facturas) de la Póliza de Abono-->
		<div id="RelacionarFrasPolizasAbonoCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_fras_polizas_abono_cuentas_cobrar" class="ModalBodyTitle">
			<h1>Facturas que Adeuda el Cliente</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarFrasPolizasAbonoCuentasCobrar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarFrasPolizasAbonoCuentasCobrar"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Razón social-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del prospecto seleccionado-->
									<input id="txtProspectoIDBusq_relacionar_fras_polizas_abono_cuentas_cobrar" 
										   name="intProspectoIDBusq_relacionar_fras_polizas_abono_cuentas_cobrar"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_fras_polizas_abono_cuentas_cobrar">Razón social</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRazonSocialBusq_relacionar_fras_polizas_abono_cuentas_cobrar" 
										   name="strRazonSocialBusq_relacionar_fras_polizas_abono_cuentas_cobrar"  type="text" value="">
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
							<input id="txtNumFras_relacionar_fras_polizas_abono_cuentas_cobrar" 
								   name="intNumFras_relacionar_fras_polizas_abono_cuentas_cobrar" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_fras_polizas_abono_cuentas_cobrar">
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
								<script id="plantilla_relacionar_fras_polizas_abono_cuentas_cobrar" type="text/template"> 
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
										<td class="movil-no-mostrar no-mostrar b9">{{tipo_ieps}}</td>
										<td class="movil-no-mostrar no-mostrar b10">{{factor_ieps}}</td>
										<td class="movil b11">{{folio}}</td>
										<td class="movil b12">{{moneda_tipo}}</td>
										<td class="movil b13">{{fecha}}</td>
										<td class="movil b14">{{vencimiento}}</td>
										<td class="movil b15">{{tipo_referencia}}</td>
										<td class="movil b16">{{porcentaje_iva}}</td>
										<td class="movil b17">{{porcentaje_ieps}}</td>
										<td class="movil b18">{{importe}}</td>
										<td class="movil b19">{{saldo}}</td>
										<td class="movil b20">{{saldo_vencido}}</td>
										<td class="td-center movil b21"> 
											 <input 	type="checkbox" 
							    		class="form-check-input btn-xs" 
							    		id="chbAgregar_relacionar_fras_polizas_abono_cuentas_cobrar" />
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
										<td  class="movil bt6"></td>
										<td  class="movil bt7"></td>
										<td  class="movil bt8"></td>
										<td  class="movil bt9">
											<strong id="acumSaldo_relacionar_fras_polizas_abono_cuentas_cobrar">$0.00</strong>
										</td>
										<td class="movil bt10">
											<strong  id="acumSaldoVencido_relacionar_fras_polizas_abono_cuentas_cobrar">$0.00</strong>
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
											<strong id="acumAntSaldo_relacionar_fras_polizas_abono_cuentas_cobrar">$0.00</strong>
										</td>
										<td class="movil bt10">
											<strong  id="acumAntSaldoVencido_relacionar_fras_polizas_abono_cuentas_cobrar">$0.00</strong>
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
										<strong id="numElementos_relacionar_fras_polizas_abono_cuentas_cobrar">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar facturas-->
							<button class="btn btn-success" id="btnAgregar_relacionar_fras_polizas_abono_cuentas_cobrar"  
									onclick="validar_relacionar_fras_polizas_abono_cuentas_cobrar();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_fras_polizas_abono_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_fras_polizas_abono_cuentas_cobrar();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar Documentos (facturas) de la Póliza de Abono-->
	</div><!--#PolizasAbonoCuentasCobrarContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_polizas_abono_cuentas_cobrar" type="text/template">
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
		var intPaginaPolizasAbonoCuentasCobrar = 0;
		var strUltimaBusquedaPolizasAbonoCuentasCobrar = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar en la búsqueda de facturas con adeudo)*/
		var strTipoReferenciaPolizasAbonoCuentasCobrar = "POLIZA ABONO";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDPolizasAbonoCuentasCobrar = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBasePolizasAbonoCuentasCobrar = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoPolizasAbonoCuentasCobrar = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar el código de la moneda seleccionada (de la póliza de abono)
		var strMonedaPolizasAbonoCuentasCobrar = "";
		
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarPolizasAbonoCuentasCobrar = null;
		//Variable que se utiliza para asignar objeto del modal Pólizas de Abono
		var objPolizasAbonoCuentasCobrar = null;
		//Variable que se utiliza para asignar objeto del modal Relacionar Documentos (facturas) de la Póliza de Abono
		var objRelacionarFrasPolizasAbonoCuentasCobrar = null;

		/*******************************************************************************************************************
		Funciones del objeto facturas relacionadas (seleccionadas)
		*********************************************************************************************************************/
		// Constructor del objeto facturas relacionadas (seleccionadas)
		var objFrasRelacionadasPolizasAbonoCuentasCobrar;
		function FrasRelacionadasPolizasAbonoCuentasCobrar(fras)
		{
			this.arrFras = fras;
		}

		//Función para obtener todas las facturas seleccionadas del pago
		FrasRelacionadasPolizasAbonoCuentasCobrar.prototype.getFacturas = function() {
		    return this.arrFras;
		}

		//Función para agregar una factura al objeto 
		FrasRelacionadasPolizasAbonoCuentasCobrar.prototype.setFactura = function (fra){
			this.arrFras.push(fra);
		}

		//Función para obtener una factura del objeto 
		FrasRelacionadasPolizasAbonoCuentasCobrar.prototype.getFactura = function(index) {
		    return this.arrFras[index];
		}

		/*******************************************************************************************************************
		Funciones del objeto facturas a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto facturas a relacionar
		var objFraRelacionarPolizasAbonoCuentasCobrar;
		
		function FraRelacionarPolizasAbonoCuentasCobrar(referenciaID, tipoReferencia,
														  folio, fecha, monedaID, monedaTipo, tipoCambio,
														  subtotalFactura, tasaCuotaIvaFactura, porcentajeIva, ivaFactura, 
														  tasaCuotaIepsFactura, porcentajeIeps, iepsFactura, 
														  impFactura,impPagado, saldoInsoluto, saldoFactura,
														  tipoTasaCuotaIeps, factorTasaCuotaIeps)
		{
		    this.intReferenciaID = referenciaID;
		    this.strTipoReferencia = tipoReferencia;
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

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_polizas_abono_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_cobrar/polizas_abono/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_polizas_abono_cuentas_cobrar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosPolizasAbonoCuentasCobrar = data.row;
					//Separar la cadena 
					var arrPermisosPolizasAbonoCuentasCobrar = strPermisosPolizasAbonoCuentasCobrar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosPolizasAbonoCuentasCobrar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosPolizasAbonoCuentasCobrar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_polizas_abono_cuentas_cobrar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosPolizasAbonoCuentasCobrar[i]=='GUARDAR') || (arrPermisosPolizasAbonoCuentasCobrar[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_polizas_abono_cuentas_cobrar').removeAttr('disabled');
						}
						//Si el indice es ENVIAR CORREO
						else if(arrPermisosPolizasAbonoCuentasCobrar[i]=='ENVIAR CORREO')
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_polizas_abono_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosPolizasAbonoCuentasCobrar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_polizas_abono_cuentas_cobrar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_polizas_abono_cuentas_cobrar();
						}
						else if(arrPermisosPolizasAbonoCuentasCobrar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_polizas_abono_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosPolizasAbonoCuentasCobrar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_polizas_abono_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosPolizasAbonoCuentasCobrar[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_polizas_abono_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosPolizasAbonoCuentasCobrar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_polizas_abono_cuentas_cobrar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_polizas_abono_cuentas_cobrar() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaPolizasAbonoCuentasCobrar =($('#txtFechaInicialBusq_polizas_abono_cuentas_cobrar').val()+$('#txtFechaFinalBusq_polizas_abono_cuentas_cobrar').val()+$('#txtProspectoIDBusq_polizas_abono_cuentas_cobrar').val()+$('#cmbEstatusBusq_polizas_abono_cuentas_cobrar').val()+$('#txtBusqueda_polizas_abono_cuentas_cobrar').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaPolizasAbonoCuentasCobrar != strUltimaBusquedaPolizasAbonoCuentasCobrar)
			{
				intPaginaPolizasAbonoCuentasCobrar = 0;
				strUltimaBusquedaPolizasAbonoCuentasCobrar = strNuevaBusquedaPolizasAbonoCuentasCobrar;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/polizas_abono/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_polizas_abono_cuentas_cobrar').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_polizas_abono_cuentas_cobrar').val()),
					 intProspectoID: $('#txtProspectoIDBusq_polizas_abono_cuentas_cobrar').val(),
					 strEstatus: $('#cmbEstatusBusq_polizas_abono_cuentas_cobrar').val(),
					 strBusqueda: $('#txtBusqueda_polizas_abono_cuentas_cobrar').val(),
					 intPagina: intPaginaPolizasAbonoCuentasCobrar,
					 strPermisosAcceso: $('#txtAcciones_polizas_abono_cuentas_cobrar').val()
					},
					function(data){
						$('#dg_polizas_abono_cuentas_cobrar tbody').empty();
						var tmpPolizasAbonoCuentasCobrar = Mustache.render($('#plantilla_polizas_abono_cuentas_cobrar').html(),data);
						$('#dg_polizas_abono_cuentas_cobrar tbody').html(tmpPolizasAbonoCuentasCobrar);
						$('#pagLinks_polizas_abono_cuentas_cobrar').html(data.paginacion);
						$('#numElementos_polizas_abono_cuentas_cobrar').html(data.total_rows);
						intPaginaPolizasAbonoCuentasCobrar = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_polizas_abono_cuentas_cobrar(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_cobrar/polizas_abono/';

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
			if ($('#chbImprimirDetalles_polizas_abono_cuentas_cobrar').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_polizas_abono_cuentas_cobrar').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_polizas_abono_cuentas_cobrar').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial':  $.formatFechaMysql($('#txtFechaInicialBusq_polizas_abono_cuentas_cobrar').val()),
										'dteFechaFinal':  $.formatFechaMysql($('#txtFechaFinalBusq_polizas_abono_cuentas_cobrar').val()),
										'intProspectoID': $('#txtProspectoIDBusq_polizas_abono_cuentas_cobrar').val(),
										'strEstatus': $('#cmbEstatusBusq_polizas_abono_cuentas_cobrar').val(), 
										'strBusqueda': $('#txtBusqueda_polizas_abono_cuentas_cobrar').val(),
										'strDetalles': $('#chbImprimirDetalles_polizas_abono_cuentas_cobrar').val()				
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_polizas_abono_cuentas_cobrar(id) 
		{	
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtPolizaAbonoID_polizas_abono_cuentas_cobrar').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'cuentas_cobrar/polizas_abono/get_reporte_registro',
							'data' : {
										'intPolizaAbonoID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		
		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cliente_polizas_abono_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmEnviarPolizasAbonoCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_polizas_abono_cuentas_cobrar();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cliente_polizas_abono_cuentas_cobrar');
		}


		//Función que se utiliza para abrir el modal
		function abrir_cliente_polizas_abono_cuentas_cobrar(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cliente_polizas_abono_cuentas_cobrar();
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtPolizaAbonoID_polizas_abono_cuentas_cobrar').val();
				
			}
			else
			{
				intID = id;
			}

		   //Hacer un llamado al método del controlador para regresar los datos del registro
		   $.post('cuentas_cobrar/polizas_abono/get_datos',
	       {
	       		intPolizaAbonoID:intID
	       },
	       function(data) {
	        	//Si hay datos del registro
	            if(data.row)
	            {
	            	//Asignar datos del registro seleccionado
					$('#txtPolizaAbonoID_cliente_polizas_abono_cuentas_cobrar').val(data.row.poliza_abono_id);
					$('#txtFolio_cliente_polizas_abono_cuentas_cobrar').val(data.row.folio);
					$('#txtRazonSocial_cliente_polizas_abono_cuentas_cobrar').val(data.row.razon_social);
					$('#txtCorreoElectronico_cliente_polizas_abono_cuentas_cobrar').val(data.row.correo_electronico);
					$('#txtCopiaCorreoElectronico_cliente_polizas_abono_cuentas_cobrar').val(data.row.contacto_correo_electronico);
					//Dependiendo del estatus cambiar el color del encabezado 
				    $('#divEncabezadoModal_cliente_polizas_abono_cuentas_cobrar').addClass("estatus-"+data.row.estatus);

				    //Abrir modal
					objEnviarPolizasAbonoCuentasCobrar = $('#EnviarPolizasAbonoCuentasCobrarBox').bPopup({
																   appendTo: '#PolizasAbonoCuentasCobrarContent', 
										                           contentContainer: 'PolizasAbonoCuentasCobrarM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
					//Enfocar caja de texto
					$('#txtCorreoElectronico_cliente_polizas_abono_cuentas_cobrar').focus();
	            }
	         },
	       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cliente_polizas_abono_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objEnviarPolizasAbonoCuentasCobrar.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cliente_polizas_abono_cuentas_cobrar();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cliente_polizas_abono_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_polizas_abono_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarPolizasAbonoCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_cliente_polizas_abono_cuentas_cobrar: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_cliente_polizas_abono_cuentas_cobrar: {
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
			var bootstrapValidator_cliente_polizas_abono_cuentas_cobrar = $('#frmEnviarPolizasAbonoCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_cliente_polizas_abono_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cliente_polizas_abono_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_cliente_polizas_abono_cuentas_cobrar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cliente_polizas_abono_cuentas_cobrar()
		{
			try
			{
				$('#frmEnviarPolizasAbonoCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al cliente
		function enviar_correo_cliente_polizas_abono_cuentas_cobrar()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cliente_polizas_abono_cuentas_cobrar();
			//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
			$.post('cuentas_cobrar/polizas_abono/enviar_correo_electronico_cliente',
					{ 
						intPolizaAbonoID: $('#txtPolizaAbonoID_cliente_polizas_abono_cuentas_cobrar').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_cliente_polizas_abono_cuentas_cobrar').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_polizas_abono_cuentas_cobrar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cliente_polizas_abono_cuentas_cobrar();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_cliente_polizas_abono_cuentas_cobrar();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_polizas_abono_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_cliente_polizas_abono_cuentas_cobrar()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_polizas_abono_cuentas_cobrar").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_cliente_polizas_abono_cuentas_cobrar()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_polizas_abono_cuentas_cobrar").addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones del modal Pólizas de Abono
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_polizas_abono_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmPolizasAbonoCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_polizas_abono_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmPolizasAbonoCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_polizas_abono_cuentas_cobrar');
			//Hacer un llamado a la función para inicializar elementos de las tablas detalles
			inicializar_detalles_polizas_abono_cuentas_cobrar();
			//Habilitar todos los elementos del formulario
			$('#frmPolizasAbonoCuentasCobrar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_polizas_abono_cuentas_cobrar').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtMoneda_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtTipoCambio_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtRfc_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtSaldoAnticipo_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtFecha_fras_relacionadas_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtTipoReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtMonedaTipo_fras_relacionadas_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtTipoCambio_fras_relacionadas_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtSubtotalFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtIvaFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtIepsFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtImporteTotal_fras_relacionadas_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");

			 //Asignar el código de la moneda de la póliza de abono
			 $('#spnMonedaPolizaAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').text('');
			 $('#monedaPolizaAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').html('');

			//Mostrar los siguientes botones
			$("#btnGuardar_polizas_abono_cuentas_cobrar").show();
			$('#btnBuscarDoc_polizas_abono_cuentas_cobrar').show();
			//Ocultar los siguientes botones
			$("#btnEnviarCorreo_polizas_abono_cuentas_cobrar").hide();
			$("#btnImprimirRegistro_polizas_abono_cuentas_cobrar").hide();
			$("#btnDesactivar_polizas_abono_cuentas_cobrar").hide();
			//Deshabilitar botón Buscar facturas
			$('#btnBuscarDoc_polizas_abono_cuentas_cobrar').attr('disabled','-1'); 
		}

		//Función para inicializar elementos del cliente
		function inicializar_cliente_polizas_abono_cuentas_cobrar()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#txtRfc_polizas_abono_cuentas_cobrar").val('');
            $("#txtCalle_polizas_abono_cuentas_cobrar").val('');
            $("#txtNumeroExterior_polizas_abono_cuentas_cobrar").val('');
            $("#txtNumeroInterior_polizas_abono_cuentas_cobrar").val('');
            $("#txtCodigoPostal_polizas_abono_cuentas_cobrar").val('');
            $("#txtColonia_polizas_abono_cuentas_cobrar").val('');
            $("#txtLocalidad_polizas_abono_cuentas_cobrar").val('');
            $("#txtMunicipio_polizas_abono_cuentas_cobrar").val('');
            $("#txtEstado_polizas_abono_cuentas_cobrar").val('');
            $("#txtPais_polizas_abono_cuentas_cobrar").val('');
            //Deshabilitar botón Buscar facturas
            $('#btnBuscarDoc_polizas_abono_cuentas_cobrar').attr('disabled','-1');
            //Hacer un llamado a la función para inicializar elementos de las tablas detalles
		    inicializar_detalles_polizas_abono_cuentas_cobrar();
		}


		//Función para inicializar elementos del anticipo
		function inicializar_anticipo_polizas_abono_cuentas_cobrar()
		{
		    //Limpiar contenido de las siguientes cajas de texto
		    $("#txtSaldoAnticipo_polizas_abono_cuentas_cobrar").val('');
		    $("#txtMonedaID_polizas_abono_cuentas_cobrar").val('');
		    $("#txtMoneda_polizas_abono_cuentas_cobrar").val('');
		    $("#txtTipoCambio_polizas_abono_cuentas_cobrar").val('');
			$('#spnMonedaPolizaAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').text('');
			$('#monedaPolizaAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').html('');

		    //Deshabilitar botón Buscar facturas
            $('#btnBuscarDoc_polizas_abono_cuentas_cobrar').attr('disabled','-1');
		}

		
		//Función para inicializar elementos de las tablas detalles
		function inicializar_detalles_polizas_abono_cuentas_cobrar()
		{
			//Hacer un llamado a la función para inicializar elementos de la factura (detalle)
		    inicializar_detalle_fras_relacionadas_polizas_abono_cuentas_cobrar();

			//Eliminar los datos de la tabla detalles de la póliza de abono
			$('#dg_detalles_polizas_abono_cuentas_cobrar tbody').empty();
			$('#numElementos_detalles_polizas_abono_cuentas_cobrar').html(0);
			$('#txtNumDetalles_polizas_abono_cuentas_cobrar').val('');
		    $('#acumTotalFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').html('$0.00');
		    $('#acumAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').html('$0.00');
		    $('#acumSaldoFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').html('$0.00');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_polizas_abono_cuentas_cobrar()
		{
			try {
				//Hacer un llamado a la función para cerrar modal Relacionar Documentos (facturas) de la Póliza de Abono
				cerrar_relacionar_fras_polizas_abono_cuentas_cobrar();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			  	cerrar_cliente_polizas_abono_cuentas_cobrar();
			    //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_polizas_abono_cuentas_cobrar('');
				//Cerrar modal
				objPolizasAbonoCuentasCobrar.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_polizas_abono_cuentas_cobrar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_polizas_abono_cuentas_cobrar()
		{

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_polizas_abono_cuentas_cobrar();

			//Validación del formulario de campos obligatorios
			$('#frmPolizasAbonoCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_polizas_abono_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strAnticipo_polizas_abono_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del anticipo
					                                    if($('#txtAnticipoID_polizas_abono_cuentas_cobrar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un anticipo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strRazonSocial_polizas_abono_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if($('#txtProspectoID_polizas_abono_cuentas_cobrar').val() === '')
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
										intNumDetalles_polizas_abono_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta póliza de abono'
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
			var bootstrapValidator_polizas_abono_cuentas_cobrar = $('#frmPolizasAbonoCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_polizas_abono_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_polizas_abono_cuentas_cobrar.isValid())
			{


				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intTotal =  $.reemplazar($('#acumAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').html(), "$", "");
				intTotal =  parseFloat($.reemplazar(intTotal, ",", ""));
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intSaldoAnticipo = parseFloat($.reemplazar($('#txtSaldoAnticipo_polizas_abono_cuentas_cobrar').val(), ",", ""));
				
				//Verificar que el total sea menor al saldo del anticipo
				if(intTotal > intSaldoAnticipo)
				{
					//Cambiar cantidad a formato moneda
					intSaldoAnticipo = formatMoney(intSaldoAnticipo, 2, '');

					/*Mensaje que se utiliza para informar al usuario que el total de la aplicación no debe ser mayor que el saldo del anticipo que hace falta aplicar*/
					var strMensaje = 'La póliza de abono sobrepasa el saldo del anticipo.';
						strMensaje += '<br>Saldo restante: <b>'+intSaldoAnticipo+'</b>';

					//Hacer un llamado a la función para mostrar mensaje de información
				    mensaje_polizas_abono_cuentas_cobrar('error', strMensaje);
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_polizas_abono_cuentas_cobrar();
				}

			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_polizas_abono_cuentas_cobrar()
		{
			try
			{
				$('#frmPolizasAbonoCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_polizas_abono_cuentas_cobrar()
		{
			
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_polizas_abono_cuentas_cobrar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrReferencias = [];
			var arrReferenciaID = [];
			var arrPrecios = [];
			var arrTasaCuotaIva = [];
			var arrIvas = [];
			var arrTasaCuotaIeps = [];
			var arrIeps = [];

			//Variable que se utiliza para asignar la moneda de la póliza de abono
			var intMonedaIDPolizaAbono = parseInt($("#txtMonedaID_polizas_abono_cuentas_cobrar").val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variable que se utiliza para asignar el tipo de cambio de la póliza de abono
				var intTipoCambioPolizaAbono = parseFloat($("#txtTipoCambio_polizas_abono_cuentas_cobrar").val());
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

				//Variables que se utilizan para asignar valores del detalle
				var intMonedaID = parseInt(objRen.cells[12].innerHTML);
				var intTipoCambio = parseFloat(objRen.cells[4].innerHTML);
				var intAbono = parseFloat(objRen.cells[19].innerHTML);
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

			    //Si la moneda de la póliza de abono es diferente a la moneda de la factura
				if(intMonedaID  !== intMonedaIDPolizaAbono)
				{
					//Asignar el tipo de cambio de la factura
					intTipoCambioPolizaAbono = intTipoCambio;
				}

			    //Convertir cantidad a pesos mexicanos
			    intAbonoPesos =  intAbono * intTipoCambioPolizaAbono;

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
				arrReferencias.push(objRen.cells[2].innerHTML);
				arrReferenciaID.push(objRen.cells[11].innerHTML);
				arrPrecios.push(intPrecio);
				arrTasaCuotaIva.push(objRen.cells[14].innerHTML);
				arrIvas.push(intImporteIva);
				arrTasaCuotaIeps.push(objRen.cells[16].innerHTML);
				arrIeps.push(intImporteIeps);
			}


			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_cobrar/polizas_abono/guardar',
			{ 
				//Datos de la póliza de abono
				intPolizaAbonoID: $('#txtPolizaAbonoID_polizas_abono_cuentas_cobrar').val(),
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				dteFecha: $.formatFechaMysql($('#txtFecha_polizas_abono_cuentas_cobrar').val()),
				intAnticipoID: $('#txtAnticipoID_polizas_abono_cuentas_cobrar').val(),
				intMonedaID: $('#txtMonedaID_polizas_abono_cuentas_cobrar').val(),
				intTipoCambio: $('#txtTipoCambio_polizas_abono_cuentas_cobrar').val(),
				intProspectoID: $('#txtProspectoID_polizas_abono_cuentas_cobrar').val(),
				strRazonSocial: $('#txtRazonSocial_polizas_abono_cuentas_cobrar').val(),
				strRfc: $('#txtRfc_polizas_abono_cuentas_cobrar').val(),
				strCalle: $('#txtCalle_polizas_abono_cuentas_cobrar').val(),
				strNumeroExterior: $('#txtNumeroExterior_polizas_abono_cuentas_cobrar').val(),
				strNumeroInterior: $('#txtNumeroInterior_polizas_abono_cuentas_cobrar').val(),
				strCodigoPostal: $('#txtCodigoPostal_polizas_abono_cuentas_cobrar').val(),
				strColonia: $('#txtColonia_polizas_abono_cuentas_cobrar').val(),
				strLocalidad: $('#txtLocalidad_polizas_abono_cuentas_cobrar').val(),
				strMunicipio: $('#txtMunicipio_polizas_abono_cuentas_cobrar').val(),
				strEstado: $('#txtEstado_polizas_abono_cuentas_cobrar').val(),
				strPais: $('#txtPais_polizas_abono_cuentas_cobrar').val(),
				strObservaciones: $('#txtObservaciones_polizas_abono_cuentas_cobrar').val(),
				intProcesoMenuID: $('#txtProcesoMenuID_polizas_abono_cuentas_cobrar').val(),
				//Datos de los detalles
				strReferencias: arrReferencias.join('|'),
				strReferenciaID: arrReferenciaID.join('|'),
				strPrecios: arrPrecios.join('|'),
				strTasaCuotaIva: arrTasaCuotaIva.join('|'),
				strIvas: arrIvas.join('|'),
				strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
				strIeps: arrIeps.join('|')
			},
				function(data) {
					if (data.resultado)
					{
						//Si no existe id de la póliza, significa que es un nuevo registro   
                        if($('#txtPolizaAbonoID_polizas_abono_cuentas_cobrar').val() == '')
                        {
                            //Asignar el id de la póliza registrado en la base de datos
                            $('#txtPolizaAbonoID_polizas_abono_cuentas_cobrar').val(data.poliza_abono_id);
                        }

						//Hacer llamado a la función para cargar  los registros en el grid
						paginacion_polizas_abono_cuentas_cobrar();

						//Hacer un llamado a la función para cerrar modal
						cerrar_polizas_abono_cuentas_cobrar();      

						//Hacer un llamado a la función para generar póliza con los datos del registro
                       // generar_poliza_polizas_abono_cuentas_cobrar('', '', '');
					}

					//Si existe mensaje de error
					/*if(data.tipo_mensaje == 'error')
					{
					    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_polizas_abono_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					}*/

					 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_polizas_abono_cuentas_cobrar(data.tipo_mensaje, data.mensaje);

				},
			'json');

		}


		//Función para mostrar mensaje de éxito o error
		function mensaje_polizas_abono_cuentas_cobrar(tipoMensaje, mensaje, campoID)
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
		function cambiar_estatus_polizas_abono_cuentas_cobrar(id, polizaID, folioPoliza)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para asignar el id de la póliza
			var intPolizaID = 0;
			//Variable que se utiliza para asignar el folio de la póliza
            var strFolioPoliza = '';

			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtPolizaAbonoID_polizas_abono_cuentas_cobrar').val();
				intPolizaID = $('#txtPolizaID_polizas_abono_cuentas_cobrar').val();
				strFolioPoliza = $('#txtFolioPoliza_polizas_abono_cuentas_cobrar').val();

			}
			else
			{
				intID = id;
				intPolizaID = polizaID;
				strFolioPoliza = folioPoliza;
			}

		   
			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro; también se desactivara la póliza con folio: '+strFolioPoliza+'?</strong>',
					             {'type':     'question',
					              'title':    'Pólizas de Abono',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('cuentas_cobrar/polizas_abono/set_estatus',
					                                     {intPolizaAbonoID: intID, 
					                                      intPolizaID: intPolizaID
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                          	//Hacer llamado a la función  para cargar  los registros en el grid
					                                          	paginacion_polizas_abono_cuentas_cobrar();

					                                          	//Si el id del registro se obtuvo del modal
																if(id == '')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_polizas_abono_cuentas_cobrar();     
																}
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_polizas_abono_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_polizas_abono_cuentas_cobrar(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/polizas_abono/get_datos',
			       {
			       	 intPolizaAbonoID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_polizas_abono_cuentas_cobrar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el código de la moneda
	                        strMonedaPolizasAbonoCuentasCobrar = data.row.codigo_moneda;
	                        //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				             //Asignar el id de la póliza
                            var intPolizaID = parseInt(data.row.poliza_id);

                            //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);
				            var intSaldoAnticipo = parseFloat(data.total_aplicar);

				            //Convertir peso mexicano a tipo de cambio
				            intSaldoAnticipo = intSaldoAnticipo / intTipoCambio;

				          	//Recuperar valores
				            $('#txtPolizaAbonoID_polizas_abono_cuentas_cobrar').val(data.row.poliza_abono_id);
				            $('#txtFolio_polizas_abono_cuentas_cobrar').val(data.row.folio);
				            $('#txtFecha_polizas_abono_cuentas_cobrar').val(data.row.fecha);
				            $('#txtAnticipoID_polizas_abono_cuentas_cobrar').val(data.row.anticipo_id);
				          	$('#txtAnticipo_polizas_abono_cuentas_cobrar').val(data.row.folio_anticipo);
				          	$('#txtSaldoAnticipo_polizas_abono_cuentas_cobrar').val(intSaldoAnticipo);
				          	$('#txtFolio_polizas_abono_cuentas_cobrar').val(data.row.folio);
				            $('#txtMonedaID_polizas_abono_cuentas_cobrar').val(data.row.moneda_id);
				          	$('#txtMoneda_polizas_abono_cuentas_cobrar').val(data.row.moneda);
				            $('#txtTipoCambio_polizas_abono_cuentas_cobrar').val(data.row.tipo_cambio);
				            $('#txtProspectoID_polizas_abono_cuentas_cobrar').val(data.row.prospecto_id);
						    $('#txtRazonSocial_polizas_abono_cuentas_cobrar').val(data.row.razon_social);
						    $('#txtRfc_polizas_abono_cuentas_cobrar').val(data.row.rfc);
						    $('#txtCalle_polizas_abono_cuentas_cobrar').val(data.row.calle);
						    $('#txtNumeroExterior_polizas_abono_cuentas_cobrar').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_polizas_abono_cuentas_cobrar').val(data.row.numero_interior);
						    $('#txtCodigoPostal_polizas_abono_cuentas_cobrar').val(data.row.codigo_postal);
						    $('#txtColonia_polizas_abono_cuentas_cobrar').val(data.row.colonia);
						    $('#txtLocalidad_polizas_abono_cuentas_cobrar').val(data.row.localidad);
						    $('#txtMunicipio_polizas_abono_cuentas_cobrar').val(data.row.municipio);
						    $('#txtEstado_polizas_abono_cuentas_cobrar').val(data.row.estado);
						    $('#txtPais_polizas_abono_cuentas_cobrar').val(data.row.pais);
				            $('#txtObservaciones_polizas_abono_cuentas_cobrar').val(data.row.observaciones);
				            $('#txtPolizaID_polizas_abono_cuentas_cobrar').val(intPolizaID);
						    $('#txtFolioPoliza_polizas_abono_cuentas_cobrar').val(data.row.folio_poliza);
				            $('#txtEstatus_polizas_abono_cuentas_cobrar').val(strEstatus);
				            //Asignar el código de la moneda de la póliza de abono
							$('#spnMonedaPolizaAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').text(strMonedaPolizasAbonoCuentasCobrar);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_polizas_abono_cuentas_cobrar').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_polizas_abono_cuentas_cobrar").show();

				            //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtSaldoAnticipo_polizas_abono_cuentas_cobrar').formatCurrency({ roundToDecimalPlace: 2 });


				            //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
                            if(tipoAccion == 'Ver')
                            {
                            		//Deshabilitar todos los elementos del formulario
				            	$('#frmPolizasAbonoCuentasCobrar').find('input, textarea, select').attr('disabled','disabled');
					            //Ocultar los siguientes botones
								$("#btnGuardar_polizas_abono_cuentas_cobrar").hide();
								$("#btnBuscarDoc_polizas_abono_cuentas_cobrar").hide();

								//Si el estatus del registro es ACTIVO
								if(strEstatus == 'ACTIVO')
								{
									//Mostrar bóton Enviar correo 
				            		$("#btnEnviarCorreo_polizas_abono_cuentas_cobrar").show();

				            		//Si existe el id de la póliza
				            		if(intPolizaID > 0)
				            		{
				            			//Mostrar bóton Desactivar
				            			$("#btnDesactivar_polizas_abono_cuentas_cobrar").show();
				            		}
				            		
								}

                            }
                            else
                            {

                            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
													" onclick='editar_renglon_fras_relacionadas_polizas_abono_cuentas_cobrar(this)'>" + 
													"<span class='glyphicon glyphicon-edit'></span></button>" + 
													"<button class='btn btn-default btn-xs' title='Eliminar'" +
													" onclick='eliminar_renglon_fras_relacionadas_polizas_abono_cuentas_cobrar(this)'>" + 
													"<span class='glyphicon glyphicon-trash'></span></button>" + 
													"<button class='btn btn-default btn-xs up' title='Subir'>" + 
													"<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													"<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													"<span class='glyphicon glyphicon-arrow-down'></span></button>";


							    //Habilitar botón Buscar facturas
								$('#btnBuscarDoc_polizas_abono_cuentas_cobrar').removeAttr('disabled');

                            }

				          
				          	//Variable que se utiliza para asignar la moneda de la póliza de abono
						    var intMonedaIDPolizaAbono = parseInt(data.row.moneda_id);

				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Variable que se utiliza para asignar el tipo de cambio de la póliza de abono
				            	var intTipoCambioPolizaAbono = parseFloat(data.row.tipo_cambio);

				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_polizas_abono_cuentas_cobrar').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaFolio = objRenglon.insertCell(0);
								var objCeldaFecha = objRenglon.insertCell(1);
								var objCeldaModulo = objRenglon.insertCell(2);
								var objCeldaMonedaTipo = objRenglon.insertCell(3);
								var objCeldaTipoCambio = objRenglon.insertCell(4);
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

								//Si la moneda de la póliza de abono es diferente a la moneda de la factura
								if(intMonedaIDPolizaAbono !== intMonedaID)
								{
								    //Asignar el tipo de cambio de la factura
									intTipoCambioPolizaAbono = intTipoCambio;
								}


								//Convertir peso mexicano a tipo de cambio del recibo de ingreso
								intAbono = intAbono / intTipoCambioPolizaAbono;


								//Incrementar el saldo de la factura
								intSaldoFactura =  intSaldoFactura + intAbono;

								//Redondear cantidad a dos decimales
								intSaldoFactura = intSaldoFactura.toFixed(2);
								intSaldoFactura = parseFloat(intSaldoFactura);
								

						        //Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', strDetalleID);
								objCeldaFolio.setAttribute('class', 'movil c1');
								objCeldaFolio.innerHTML = data.detalles[intCon].folio;
								objCeldaFecha.setAttribute('class', 'movil c2');
								objCeldaFecha.innerHTML = data.detalles[intCon].fecha;
								objCeldaModulo.setAttribute('class', 'movil c3');
								objCeldaModulo.innerHTML = strTipoReferencia;
								objCeldaMonedaTipo.setAttribute('class', 'movil c4');
								objCeldaMonedaTipo.innerHTML = data.detalles[intCon].moneda_tipo;
								objCeldaTipoCambio.setAttribute('class', 'movil c5');
								objCeldaTipoCambio.innerHTML = data.detalles[intCon].tipo_cambio;
								objCeldaPorcentajeIvaFactura.setAttribute('class', 'movil c6');
								objCeldaPorcentajeIvaFactura.innerHTML = data.detalles[intCon].porcentaje_iva;
								objCeldaPorcentajeIepsFactura.setAttribute('class', 'movil c7');
								objCeldaPorcentajeIepsFactura.innerHTML = data.detalles[intCon].porcentaje_ieps;
								objCeldaImpFactura.setAttribute('class', 'movil c8');
								objCeldaImpFactura.innerHTML =  formatMoney(data.detalles[intCon].total_factura, 2, '');
								objCeldaAbono.setAttribute('class', 'movil c9');
								objCeldaAbono.innerHTML = formatMoney(intAbono, 2, '');
								objCeldaSaldoInsoluto.setAttribute('class', 'movil c10');
								objCeldaSaldoInsoluto.innerHTML = formatMoney(data.detalles[intCon].saldo_factura, 2, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil c11');
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
								
				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_fras_relacionadas_polizas_abono_cuentas_cobrar();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_polizas_abono_cuentas_cobrar tr").length - 2;
							$('#numElementos_detalles_polizas_abono_cuentas_cobrar').html(intFilas);
							$('#txtNumDetalles_polizas_abono_cuentas_cobrar').val(intFilas);

			            	//Abrir modal
				            objPolizasAbonoCuentasCobrar = $('#PolizasAbonoCuentasCobrarBox').bPopup({
														  appendTo: '#PolizasAbonoCuentasCobrarContent', 
							                              contentContainer: 'PolizasAbonoCuentasCobrarM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtAnticipo_polizas_abono_cuentas_cobrar').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar obtener los datos de un cliente
		function get_datos_cliente_polizas_abono_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar los datos del cliente
            $.post('cuentas_cobrar/clientes/get_datos',
                  { 
                  	intProspectoID:$("#txtProspectoID_polizas_abono_cuentas_cobrar").val()
                  },
                  function(data) {
                    if(data.row){
                       
                       //Asignar datos del registro seleccionado
                       $("#txtRazonSocial_polizas_abono_cuentas_cobrar").val(data.row.razon_social);
                       $("#txtRfc_polizas_abono_cuentas_cobrar").val(data.row.rfc);
                       $("#txtCalle_polizas_abono_cuentas_cobrar").val(data.row.calle);
                       $("#txtNumeroExterior_polizas_abono_cuentas_cobrar").val(data.row.numero_exterior);
                       $("#txtNumeroInterior_polizas_abono_cuentas_cobrar").val(data.row.numero_interior);
                       $("#txtCodigoPostal_polizas_abono_cuentas_cobrar").val(data.row.codigo_postal);
                       $("#txtColonia_polizas_abono_cuentas_cobrar").val(data.row.colonia);
                       $("#txtLocalidad_polizas_abono_cuentas_cobrar").val(data.row.localidad);
                       $("#txtMunicipio_polizas_abono_cuentas_cobrar").val(data.row.municipio);
                       $("#txtEstado_polizas_abono_cuentas_cobrar").val(data.row.estado_rep);
                       $("#txtPais_polizas_abono_cuentas_cobrar").val(data.row.pais_rep);
                        //Si existe id de la moneda
			            if($('#txtMonedaID_polizas_abono_cuentas_cobrar').val() !== '' && $('#txtTipoCambio_polizas_abono_cuentas_cobrar').val() != '')
			            {
			            	//Habilitar botón Buscar facturas
			            	$('#btnBuscarDoc_polizas_abono_cuentas_cobrar').removeAttr('disabled');
			            }

                    }
                  }
                 ,
                'json');
		}

		//Función para regresar y obtener los datos de un anticipo
		function get_datos_anticipo_polizas_abono_cuentas_cobrar()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos del anticipo
            $.post('caja/anticipos/get_datos',
                  { 
                  	intAnticipoID:$("#txtAnticipoID_polizas_abono_cuentas_cobrar").val(), 
                  	strFormulario: 'polizas_aplicacion'
                  },
                  function(data) {	                  	
                    if(data.row){

                    	//Variable que se utiliza para asignar el tipo de cambio
		            	var intTipoCambio = parseFloat(data.row.tipo_cambio);
		            	//Variable que se utiliza para asignar el total del anticipo que hace falta aplicar
		            	var intTotalAnticipoAplicar = parseFloat(data.total_aplicar);

		            	//Convertir peso mexicano a tipo de cambio
					 	intTotalAnticipoAplicar = intTotalAnticipoAplicar / intTipoCambio;

					 	//Si existe saldo del anticipo por aplicar
					 	if(intTotalAnticipoAplicar > 0)
					 	{

						   	//Asignar datos del registro seleccionado
						   	 $("#txtMonedaID_polizas_abono_cuentas_cobrar").val(data.row.moneda_id);
						   	 $("#txtMoneda_polizas_abono_cuentas_cobrar").val(data.row.moneda);
	                      	 $("#txtTipoCambio_polizas_abono_cuentas_cobrar").val(data.row.tipo_cambio);
	                      	 //Asignar el código de la moneda
	                         strMonedaPolizasAbonoCuentasCobrar = data.row.MonedaTipo;
	                         //Asignar el código de la moneda de la póliza de abono
							 $('#spnMonedaPolizaAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').text(strMonedaPolizasAbonoCuentasCobrar);
							 $('#monedaPolizaAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').html(strMonedaPolizasAbonoCuentasCobrar);


	                       //Si no existe id del prospecto
	                       if($("#txtProspectoID_polizas_abono_cuentas_cobrar").val() == '')
	                       {
	                       	   $("#txtProspectoID_polizas_abono_cuentas_cobrar").val(data.row.prospecto_id);
		                       $("#txtRazonSocial_polizas_abono_cuentas_cobrar").val(data.row.razon_social);
		                       $("#txtRfc_polizas_abono_cuentas_cobrar").val(data.row.rfc);
		                       $("#txtCalle_polizas_abono_cuentas_cobrar").val(data.row.calle);
		                       $("#txtNumeroExterior_polizas_abono_cuentas_cobrar").val(data.row.numero_exterior);
		                       $("#txtNumeroInterior_polizas_abono_cuentas_cobrar").val(data.row.numero_interior);
		                       $("#txtCodigoPostal_polizas_abono_cuentas_cobrar").val(data.row.codigo_postal);
		                       $("#txtColonia_polizas_abono_cuentas_cobrar").val(data.row.colonia);
		                       $("#txtLocalidad_polizas_abono_cuentas_cobrar").val(data.row.localidad);
		                       $("#txtMunicipio_polizas_abono_cuentas_cobrar").val(data.row.municipio);
		                       $("#txtEstado_polizas_abono_cuentas_cobrar").val(data.row.estado);
		                       $("#txtPais_polizas_abono_cuentas_cobrar").val(data.row.pais);
		                      
	                       }

						   $("#txtSaldoAnticipo_polizas_abono_cuentas_cobrar").val(intTotalAnticipoAplicar);
						   //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					       $('#txtSaldoAnticipo_polizas_abono_cuentas_cobrar').formatCurrency({ roundToDecimalPlace: 2 });

					        //Habilitar botón Buscar facturas
							$('#btnBuscarDoc_polizas_abono_cuentas_cobrar').removeAttr('disabled');
					
					 	}
					 	else
					 	{
					 		//Asignar folio del anticipo que se desea aplicar
					 		var strFolioAnticipo = $('#txtAnticipo_polizas_abono_cuentas_cobrar').val();
					 		/*Mensaje que se utiliza para informar al usuario que el subtotal no se puede aplicar el anticipo*/
							var strMensaje = 'El anticipo: '+strFolioAnticipo+' ya ha sido aplicado.';

							//Limpiar contenido de las siguientes cajas de texto
							$('#txtAnticipoID_polizas_abono_cuentas_cobrar').val('');
							$('#txtAnticipo_polizas_abono_cuentas_cobrar').val('');

							//Hacer un llamado a la función para mostrar mensaje de información
							mensaje_polizas_abono_cuentas_cobrar('informacion', strMensaje, 'txtAnticipo_polizas_abono_cuentas_cobrar');
					 	}
                      
                    }
                  }
                 ,
                'json');

		}



		//Función para generar póliza con los datos de un registro
		function generar_poliza_polizas_abono_cuentas_cobrar(id, anticipoID, formulario)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para asignar el id del anticipo
			var intAnticipoID = 0;


			//Variable que se utiliza para saber si el id se obtuvo desde el modal
            var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtPolizaAbonoID_polizas_abono_cuentas_cobrar').val();
				intAnticipoID = $('#txtAnticipoID_polizas_abono_cuentas_cobrar').val();
			}
			else
			{
				intID = id;
				intAnticipoID = anticipoID;
				strTipo = 'gridview';
			}

			//Si existe el id del anticipo
			if(intAnticipoID > 0)
			{
				//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
				mostrar_circulo_carga_polizas_abono_cuentas_cobrar(formulario);
				//Hacer un llamado al método del controlador para generar póliza del registro
				$.post('contabilidad/generar_polizas/generar_poliza',
			     {
			     	intReferenciaID: intID,
			      	strTipoReferencia: strTipoReferenciaPolizasAbonoCuentasCobrar, 
			      	intProcesoMenuID: $('#txtProcesoMenuID_polizas_abono_cuentas_cobrar').val()
			     },
			     function(data) {

			     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		            ocultar_circulo_carga_polizas_abono_cuentas_cobrar(formulario);

			     	//Si existe resultado
					if (data.resultado)
					{
						//Hacer llamado a la función para cargar  los registros en el grid
						paginacion_polizas_abono_cuentas_cobrar();
						
						//Si el id del registro se obtuvo del modal
						if(strTipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_polizas_abono_cuentas_cobrar();     
						}
					}

					
			      	//Si se cumple la sentencia
					if(strTipo == 'modal' && data.tipo_mensaje == 'error')
					{
						//Indicar al usuario el mensaje de error
		                new $.Zebra_Dialog(data.mensaje, {
		                                    'type': 'error',
		                                    'title': 'Error',
		                                    'buttons': [{caption: 'Aceptar',
		                                                 callback: function () {
		                                                   //Hacer un llamado a la función para cerrar modal
				            								cerrar_polizas_abono_cuentas_cobrar();
		                                                 }
		                                                }]
		                                  });
					}
					else
					{
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				    	mensaje_polizas_abono_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					}

			     },
			     'json');
			}
			else
			{
				//Variable que se utiliza para asignar el mensaje de error
				var strMensaje = "No es posible generar póliza, favor de ingresar un anticipo.";

				//Hacer un llamado a la función para mostrar mensaje de información
				mensaje_polizas_abono_cuentas_cobrar('error', strMensaje);

			}
			
		}


		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de generar póliza
		function mostrar_circulo_carga_polizas_abono_cuentas_cobrar(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_polizas_abono_cuentas_cobrar';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_polizas_abono_cuentas_cobrar';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de generar póliza
		function ocultar_circulo_carga_polizas_abono_cuentas_cobrar(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_polizas_abono_cuentas_cobrar';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_polizas_abono_cuentas_cobrar';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones de la tabla facturas relacionadas
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_fras_relacionadas_polizas_abono_cuentas_cobrar()
		{
		
			//Mostramos las facturas relacionadas (seleccionadas)
			for (var intCon in objFrasRelacionadasPolizasAbonoCuentasCobrar.getFacturas()) 
            {
            	//Crear instancia del objeto Factura a relacionar 
            	objFraRelacionarPolizasAbonoCuentasCobrar = new FraRelacionarPolizasAbonoCuentasCobrar();
            	//Asignar datos de la factura corespondiente al indice
            	objFraRelacionarPolizasAbonoCuentasCobrar = objFrasRelacionadasPolizasAbonoCuentasCobrar.getFactura(intCon);
            	
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_detalles_polizas_abono_cuentas_cobrar').getElementsByTagName('tbody')[0];


			   //Variable que se utiliza para asignar el id del detalle
				var strDetalleID =  objFraRelacionarPolizasAbonoCuentasCobrar.intReferenciaID+'_'+objFraRelacionarPolizasAbonoCuentasCobrar.strTipoReferencia+'_'+objFraRelacionarPolizasAbonoCuentasCobrar.intTasaCuotaIvaFactura+'_'+objFraRelacionarPolizasAbonoCuentasCobrar.intTasaCuotaIepsFactura;

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

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strDetalleID);
					objCeldaFolio.setAttribute('class', 'movil c1');
					objCeldaFolio.innerHTML = objFraRelacionarPolizasAbonoCuentasCobrar.strFolio;
					objCeldaFecha.setAttribute('class', 'movil c2');
					objCeldaFecha.innerHTML = objFraRelacionarPolizasAbonoCuentasCobrar.dteFecha;
					objCeldaModulo.setAttribute('class', 'movil c3');
					objCeldaModulo.innerHTML = objFraRelacionarPolizasAbonoCuentasCobrar.strTipoReferencia;
					objCeldaMonedaTipo.setAttribute('class', 'movil c4');
					objCeldaMonedaTipo.innerHTML = objFraRelacionarPolizasAbonoCuentasCobrar.strMonedaTipo;
					objCeldaTipoCambio.setAttribute('class', 'movil c5');
					objCeldaTipoCambio.innerHTML = objFraRelacionarPolizasAbonoCuentasCobrar.intTipoCambio;
					objCeldaPorcentajeIvaFactura.setAttribute('class', 'movil c6');
					objCeldaPorcentajeIvaFactura.innerHTML =  objFraRelacionarPolizasAbonoCuentasCobrar.intPorcentajeIvaFactura;
					objCeldaPorcentajeIepsFactura.setAttribute('class', 'movil c7');
					objCeldaPorcentajeIepsFactura.innerHTML =  objFraRelacionarPolizasAbonoCuentasCobrar.intPorcentajeIepsFactura;
					objCeldaImpFactura.setAttribute('class', 'movil c8');
					objCeldaImpFactura.innerHTML = objFraRelacionarPolizasAbonoCuentasCobrar.intTotalFactura;
					objCeldaAbono.setAttribute('class', 'movil c9');
					objCeldaAbono.innerHTML = objFraRelacionarPolizasAbonoCuentasCobrar.intAbono;
					objCeldaSaldoInsoluto.setAttribute('class', 'movil c10');
					objCeldaSaldoInsoluto.innerHTML = formatMoney(objFraRelacionarPolizasAbonoCuentasCobrar.intSaldoInsoluto, 2, '');
					objCeldaAcciones.setAttribute('class', 'movil c11');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_fras_relacionadas_polizas_abono_cuentas_cobrar(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_fras_relacionadas_polizas_abono_cuentas_cobrar(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
					objCeldaReferenciaID.innerHTML = objFraRelacionarPolizasAbonoCuentasCobrar.intReferenciaID; 
					objCeldaMonedaID.setAttribute('class', 'no-mostrar');
					objCeldaMonedaID.innerHTML = objFraRelacionarPolizasAbonoCuentasCobrar.intMonedaID; 
					objCeldaSubtotalFactura.setAttribute('class', 'no-mostrar');
					objCeldaSubtotalFactura.innerHTML =  objFraRelacionarPolizasAbonoCuentasCobrar.intSubtotalFactura;
					objCeldaTasaCuotaIvaFactura.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIvaFactura.innerHTML =  objFraRelacionarPolizasAbonoCuentasCobrar.intTasaCuotaIvaFactura;
					objCeldaIvaFactura.setAttribute('class', 'no-mostrar');
					objCeldaIvaFactura.innerHTML =  objFraRelacionarPolizasAbonoCuentasCobrar.intIvaFactura;
					objCeldaTasaCuotaIepsFactura.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIepsFactura.innerHTML =  objFraRelacionarPolizasAbonoCuentasCobrar.intTasaCuotaIepsFactura;
					objCeldaIepsFactura.setAttribute('class', 'no-mostrar');
					objCeldaIepsFactura.innerHTML =  objFraRelacionarPolizasAbonoCuentasCobrar.intIepsFactura;
					objCeldaSaldoFactura.setAttribute('class', 'no-mostrar');
					objCeldaSaldoFactura.innerHTML =  objFraRelacionarPolizasAbonoCuentasCobrar.intSaldoFactura;
					objCeldaAbonoAux.setAttribute('class', 'no-mostrar');
					objCeldaAbonoAux.innerHTML = $.reemplazar(objFraRelacionarPolizasAbonoCuentasCobrar.intAbono, ",", "");
					objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTipoTasaCuotaIeps.innerHTML = objFraRelacionarPolizasAbonoCuentasCobrar.strTipoTasaCuotaIeps;
					objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaFactorTasaCuotaIeps.innerHTML = objFraRelacionarPolizasAbonoCuentasCobrar.strFactorTasaCuotaIeps;
					
				}
            }
           
            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_polizas_abono_cuentas_cobrar tr").length - 2;
			$('#numElementos_detalles_polizas_abono_cuentas_cobrar').html(intFilas);
			$('#txtNumDetalles_polizas_abono_cuentas_cobrar').val(intFilas);
		
			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_fras_relacionadas_polizas_abono_cuentas_cobrar();
		}

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_fras_relacionadas_polizas_abono_cuentas_cobrar()
		{
			//Variable que se utiliza para asignar el saldo insoluto
			var intSaldoInsoluto = 0;
			//Variable que se utiliza para asignar el mensaje informativo
			var strMensaje = '';

			//Variable que se utiliza para asignar la moneda de la póliza de abono
			var intMonedaIDPolizaAbono =  parseInt($("#txtMonedaID_polizas_abono_cuentas_cobrar").val());
			//Variable que se utiliza para asignar el tipo de cambio de la póliza de abono
			var intTipoCambioPolizaAbono =  parseFloat($("#txtTipoCambio_polizas_abono_cuentas_cobrar").val());
			//Obtenemos los datos de las cajas de texto
			var intReferenciaID = $('#txtReferenciaID_fras_relacionadas_polizas_abono_cuentas_cobrar').val();
			var strTipoReferencia = $('#txtTipoReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar').val();
			var intMonedaID = parseInt($('#txtMonedaID_fras_relacionadas_polizas_abono_cuentas_cobrar').val());
			var intTipoCambio = parseFloat($('#txtTipoCambio_fras_relacionadas_polizas_abono_cuentas_cobrar').val());
			var intSubtotalFactura = $('#txtSubtotalFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val();
			var intTasaCuotaIvaFactura = $('#txtTasaCuotaIvaFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val();
			var intTasaCuotaIepsFactura = $('#txtTasaCuotaIepsFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val();
		    var intSaldoFactura = $('#txtSaldoFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val();
			var intAbono = $('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').val();
			//Variable que se utiliza para asignar el importe que se va a guardar en la base de datos
			var intAbonoAux = $('#txtAbonoAux_fras_relacionadas_polizas_abono_cuentas_cobrar').val();
			//Variable que se utiliza para asignar el importe del abono convertido al tipo de cambio del pago
			var intAbonoConv = 0;

			//Variable que se utiliza para asignar el id del detalle
			var strDetalleID = intReferenciaID+'_'+strTipoReferencia+'_'+intTasaCuotaIvaFactura+'_'+intTasaCuotaIepsFactura;

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_polizas_abono_cuentas_cobrar').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intAbono == '')
			{
				//Enfocar caja de texto
				$('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').focus();
			}
			else
			{
				//Convertir cadena de texto a número decimal
				intSubtotalFactura =  parseFloat($.reemplazar(intSubtotalFactura, ",", ""));
				intSaldoFactura =  parseFloat(intSaldoFactura);
				intAbono =  parseFloat($.reemplazar(intAbono, ",", ""));
				//Asignar el saldo de la factura convertido al tipo de cambio
				var intSaldoFacturaConv = intSaldoFactura;

				//Si el tipo de moneda de la póliza de abono corresponde a peso mexicano
				if(intMonedaIDPolizaAbono === intMonedaBaseIDPolizasAbonoCuentasCobrar)
				{
					//Asignar el importe pagado
					intAbonoConv = intAbono;

					//Si el tipo de moneda de la factura es diferente a la moneda de la póliza de abono
					if(intMonedaID !== intMonedaIDPolizaAbono)
					{
						//Convertir importe pagado a peso mexicano
						intAbono = intAbono / intTipoCambio;
						intSaldoFacturaConv = intSaldoFacturaConv * intTipoCambio;
					}
				}
				else
				{
					//Si el tipo de moneda de la factura corresponde a peso mexicano
					if(intMonedaID === intMonedaBaseIDPolizasAbonoCuentasCobrar)
					{
						//Convertir importe pagado auxiliar a tipo de cambio
						var intConvImpAux = parseFloat(intAbonoAux) / intTipoCambioPolizaAbono;
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
						intAbono = intAbono * intTipoCambioPolizaAbono;
						intSaldoFacturaConv = intSaldoFacturaConv / intTipoCambioPolizaAbono;

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
					inicializar_detalle_fras_relacionadas_polizas_abono_cuentas_cobrar();
					
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
						objTabla.rows.namedItem(strDetalleID).cells[8].innerHTML =  formatMoney(intAbono, 2, '');
						objTabla.rows.namedItem(strDetalleID).cells[9].innerHTML =  formatMoney(intSaldoInsoluto, 2, '');
						objTabla.rows.namedItem(strDetalleID).cells[19].innerHTML = intAbono;
					}

					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_fras_relacionadas_polizas_abono_cuentas_cobrar();

					//Enfocar caja de texto
					$('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').focus();
				}
				else
				{
					//Cambiar cantidad a formato moneda
			    	intSaldoFacturaConv = formatMoney(intSaldoFacturaConv, 2, '');

					//Asignar saldo de la factura
					$('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').val(intSaldoFacturaConv);

					/*Mensaje que se utiliza para informar al usuario que el pago no debe ser mayor que el saldo de la factura*/
					strMensaje = 'El pago aplicado sobrepasa el saldo de la factura.';
					strMensaje += '<br>Saldo restante: <b>'+intSaldoFacturaConv+'</b>';
					//Hacer un llamado a la función para mostrar mensaje de información
				    mensaje_polizas_abono_cuentas_cobrar('informacion', strMensaje, 'txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar');

				}
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_polizas_abono_cuentas_cobrar tr").length - 2;
			$('#numElementos_detalles_polizas_abono_cuentas_cobrar').html(intFilas);
			$('#txtNumDetalles_polizas_abono_cuentas_cobrar').val(intFilas);
		}

		//Función para inicializar elementos del detalle
		function inicializar_detalle_fras_relacionadas_polizas_abono_cuentas_cobrar() 
		{
			//Limpiar las siguientes cajas de texto
			$('#txtReferenciaID_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
			$('#txtReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
			$('#txtFecha_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtTipoReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtMonedaID_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtMonedaTipo_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtTipoCambio_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtSubtotalFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtTasaCuotaIvaFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtIvaFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtTasaCuotaIepsFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtIepsFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtImporteTotal_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtAbonoAux_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		    $('#txtSaldoFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
		}

		
		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_fras_relacionadas_polizas_abono_cuentas_cobrar(objRenglon)
		{
			//Variable que se utiliza para asignar la moneda de la póliza de abono
			var intMonedaIDPolizaAbono =  parseInt($("#txtMonedaID_polizas_abono_cuentas_cobrar").val());
			//Variable que se utiliza para asignar el tipo de cambio de la póliza de abono
			var intTipoCambioPolizaAbono =  parseFloat($("#txtTipoCambio_polizas_abono_cuentas_cobrar").val());

			//Asignar valores del detalle
			var intTipoCambio = parseFloat(objRenglon.parentNode.parentNode.cells[4].innerHTML);
		    var intMonedaID = parseInt(objRenglon.parentNode.parentNode.cells[12].innerHTML);
		    var intAbonoAux = parseFloat(objRenglon.parentNode.parentNode.cells[19].innerHTML);
		    var intAbono = intAbonoAux;

		     //Si el tipo de moneda de la factura es diferente a la moneda de la póliza de abono
			if(intMonedaID !== intMonedaIDPolizaAbono )
			{
				//Si el tipo de moneda de la factura corresponde a peso mexicano
			    if(intMonedaID == intMonedaBaseIDPolizasAbonoCuentasCobrar)
				{
					//Convertir peso mexicano a tipo de cambio
					intAbono = intAbono / intTipoCambioPolizaAbono;
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
			$('#txtReferenciaID_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtFecha_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtTipoReferencia_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtMonedaID_fras_relacionadas_polizas_abono_cuentas_cobrar').val(intMonedaID);
			$('#txtMonedaTipo_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtTipoCambio_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			$('#txtImporteTotal_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[7].innerHTML);
			$('#txtSubtotalFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtTasaCuotaIvaFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtIvaFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[15].innerHTML);
			$('#txtTasaCuotaIepsFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtIepsFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);
			$('#txtSaldoFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').val(objRenglon.parentNode.parentNode.cells[18].innerHTML);
			$('#txtAbonoAux_fras_relacionadas_polizas_abono_cuentas_cobrar').val(intAbonoAux);
			$('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').val(intAbono);
			//Enfocar caja de texto
			$('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').focus();

		}
		//Función para quitar renglón de la tabla
		function eliminar_renglon_fras_relacionadas_polizas_abono_cuentas_cobrar(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_polizas_abono_cuentas_cobrar").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_fras_relacionadas_polizas_abono_cuentas_cobrar();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_polizas_abono_cuentas_cobrar tr").length - 2;
			$('#numElementos_detalles_polizas_abono_cuentas_cobrar').html(intFilas);
			$('#txtNumDetalles_polizas_abono_cuentas_cobrar').val(intFilas);

		}

		//Función para calcular totales de la tabla
		function calcular_totales_fras_relacionadas_polizas_abono_cuentas_cobrar()
		{
			//Hacer un llamado a la función para inicializar elementos del detalle
			inicializar_detalle_fras_relacionadas_polizas_abono_cuentas_cobrar();
			//Variable que se utiliza para asignar la moneda de la póliza de abono
			var intMonedaIDPolizaAbono =  parseInt($("#txtMonedaID_polizas_abono_cuentas_cobrar").val());
			//Variable que se utiliza para asignar el tipo de cambio del pago
			var intTipoCambioPolizaAbono =  parseFloat($("#txtTipoCambio_polizas_abono_cuentas_cobrar").val());

			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_polizas_abono_cuentas_cobrar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumTotalFactura = 0;
			var intAcumAbono = 0;
			var intAcumSaldoFactura = 0;


			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar los datos de la factura
				var intTipoCambio = parseFloat(objRen.cells[4].innerHTML);
				var intMonedaID = parseInt(objRen.cells[12].innerHTML);

				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intTotalFactura = $.reemplazar(objRen.cells[7].innerHTML, ",", "");
				var intAbono = $.reemplazar(objRen.cells[8].innerHTML, ",", "");
				var intSaldoFactura = $.reemplazar(objRen.cells[9].innerHTML, ",", "");
				
				//Si el tipo de moneda de la factura es diferente a la moneda de la póliza de abono
				if(intMonedaID !== intMonedaIDPolizaAbono )
				{
					//Convertir importe a peso mexicano
					intTotalFactura = intTotalFactura * intTipoCambio;
					intAbono = intAbono * intTipoCambio;
					intSaldoFactura = intSaldoFactura * intTipoCambio;

					//Si el tipo de moneda de la factura corresponde a peso mexicano
				    if(intMonedaID == intMonedaBaseIDPolizasAbonoCuentasCobrar)
					{
						//Convertir peso mexicano a tipo de cambio
						intTotalFactura = intTotalFactura / intTipoCambioPolizaAbono;
						intAbono = intAbono / intTipoCambioPolizaAbono;
						intSaldoFactura = intSaldoFactura / intTipoCambioPolizaAbono;
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
			$('#acumTotalFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').html(intAcumTotalFactura);
			$('#acumAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').html(intAcumAbono);
			$('#acumSaldoFactura_fras_relacionadas_polizas_abono_cuentas_cobrar').html(intAcumSaldoFactura);
			$('#monedaPolizaAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').html(strMonedaPolizasAbonoCuentasCobrar);
		}


		/*******************************************************************************************************************
		Funciones del modal Relacionar Documentos (facturas) de la Póliza de Abono
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_fras_polizas_abono_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmRelacionarFrasPolizasAbonoCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_fras_polizas_abono_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarFrasPolizasAbonoCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_fras_polizas_abono_cuentas_cobrar');
			//Eliminar los datos de la tabla documentos (facturas) a relacionar
		    $('#dg_relacionar_fras_polizas_abono_cuentas_cobrar tbody').empty();
		    $('#numElementos_relacionar_fras_polizas_abono_cuentas_cobrar').html(0);
		    $('#acumSaldo_relacionar_fras_polizas_abono_cuentas_cobrar').html('$0.00');
		    $('#acumSaldoVencido_relacionar_fras_polizas_abono_cuentas_cobrar').html('$0.00');
		    $('#acumAntSaldo_relacionar_fras_polizas_abono_cuentas_cobrar').html('$0.00');
		    $('#acumAntSaldoVencido_relacionar_fras_polizas_abono_cuentas_cobrar').html('$0.00');
		    //Deshabilitar la siguiente caja de texto
			$('#txtRazonSocialBusq_relacionar_fras_polizas_abono_cuentas_cobrar').attr("disabled", "disabled");
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_fras_polizas_abono_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_fras_polizas_abono_cuentas_cobrar();
			//Variables que se utilizan para asignar los datos del registro
			var strEstatus =  $('#txtEstatus_polizas_abono_cuentas_cobrar').val();
			var strRazonSocial =  $('#txtRazonSocial_polizas_abono_cuentas_cobrar').val();
			var intProspectoID =  $('#txtProspectoID_polizas_abono_cuentas_cobrar').val();

			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_fras_polizas_abono_cuentas_cobrar').addClass("estatus-"+strEstatus);
		    //Asignar los datos del cliente
		    $('#txtProspectoIDBusq_relacionar_fras_polizas_abono_cuentas_cobrar').val(intProspectoID);
		    $('#txtRazonSocialBusq_relacionar_fras_polizas_abono_cuentas_cobrar').val(strRazonSocial);

			//Abrir modal
			objRelacionarFrasPolizasAbonoCuentasCobrar = $('#RelacionarFrasPolizasAbonoCuentasCobrarBox').bPopup({
														  appendTo: '#PolizasAbonoCuentasCobrarContent', 
						                              	  contentContainer: 'PolizasAbonoCuentasCobrarM', 
						                              	  zIndex: 2, 
						                              	  modalClose: false, 
						                              	  modal: true, 
						                              	  follow: [true,false], 
						                              	  followEasing : "linear", 
						                              	  easing: "linear", 
						                             	  modalColor: ('#F0F0F0')});

			//Hacer un llamado a la función  para cargar las facturas con adeudos en el grid
			lista_facturas_relacionar_fras_polizas_abono_cuentas_cobrar();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_fras_polizas_abono_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objRelacionarFrasPolizasAbonoCuentasCobrar.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_fras_polizas_abono_cuentas_cobrar()
		{

			//Hacer un llamado a la función para agregar las facturas seleccionadas al  objeto Facturas relacionadas
			agregar_facturas_relacionar_fras_polizas_abono_cuentas_cobrar();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_fras_polizas_abono_cuentas_cobrar();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarFrasPolizasAbonoCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumFras_relacionar_fras_polizas_abono_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccionar al menos una factura para esta póliza de abono.'
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
			var bootstrapValidator_relacionar_fras_polizas_abono_cuentas_cobrar = $('#frmRelacionarFrasPolizasAbonoCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_relacionar_fras_polizas_abono_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_fras_polizas_abono_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_fras_polizas_abono_cuentas_cobrar();
				//Hacer un llamado a la función para agregar las facturas en la tabla facturas relacionadas
		  		agregar_fras_relacionadas_polizas_abono_cuentas_cobrar();
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_fras_polizas_abono_cuentas_cobrar()
		{
			try
			{
				$('#frmRelacionarFrasPolizasAbonoCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar facturas
		*********************************************************************************************************************/
		//Función para la búsqueda de facturas
		function lista_facturas_relacionar_fras_polizas_abono_cuentas_cobrar() 
		{
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/pagos/get_facturas_adeudos',
					{	
						intProspectoID: $('#txtProspectoIDBusq_relacionar_fras_polizas_abono_cuentas_cobrar').val(), 
						intMonedaIDPago: $('#txtMonedaID_polizas_abono_cuentas_cobrar').val(),
						intTipoCambioPago: $('#txtTipoCambio_polizas_abono_cuentas_cobrar').val(), 
						strTipo: strTipoReferenciaPolizasAbonoCuentasCobrar
					},
					function(data){
						$('#dg_relacionar_fras_polizas_abono_cuentas_cobrar tbody').empty();
						var tmpRelacionarFrasPolizasAbonoCuentasCobrar = Mustache.render($('#plantilla_relacionar_fras_polizas_abono_cuentas_cobrar').html(),data);
						$('#numElementos_relacionar_fras_polizas_abono_cuentas_cobrar').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_fras_polizas_abono_cuentas_cobrar').html(data.rows.length);	
						}
						$('#acumSaldo_relacionar_fras_polizas_abono_cuentas_cobrar').html(data.acumulado_saldo);
						$('#acumSaldoVencido_relacionar_fras_polizas_abono_cuentas_cobrar').html(data.acumulado_saldo_vencido+' '+strMonedaPolizasAbonoCuentasCobrar);
						$('#acumAntSaldo_relacionar_fras_polizas_abono_cuentas_cobrar').html(data.acumulado_anticipos);
						$('#acumAntSaldoVencido_relacionar_fras_polizas_abono_cuentas_cobrar').html(data.acumulado_anticipos+' '+strMonedaPolizasAbonoCuentasCobrar);
						$('#dg_relacionar_fras_polizas_abono_cuentas_cobrar tbody').html(tmpRelacionarFrasPolizasAbonoCuentasCobrar);
					
						
					},
			'json');

			
		}

		//Función para agregar las facturas seleccionadas al objeto Facturas relacionadas
		function agregar_facturas_relacionar_fras_polizas_abono_cuentas_cobrar()
		{
			//Variable que se utiliza para asignar la razón social del cliente
			var strRazonSocial =  $('#txtRazonSocialBusq_relacionar_fras_polizas_abono_cuentas_cobrar').val();
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
		    //Crear instancia del objeto Facturas relacionadas (seleccionadas)
			objFrasRelacionadasPolizasAbonoCuentasCobrar = new FrasRelacionadasPolizasAbonoCuentasCobrar([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_fras_polizas_abono_cuentas_cobrar tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
					//Crear instancia del objeto Factura a relacionar
					objFraRelacionarPolizasAbonoCuentasCobrar = new FraRelacionarPolizasAbonoCuentasCobrar(null, '', '', '', '', '', '',
																											   '', '', '', '',  '', '', '', 
																											   '','', '', '', '', '');

					

				
                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objFraRelacionarPolizasAbonoCuentasCobrar.intReferenciaID = strValor;
							        break;
							    case 1:
							        objFraRelacionarPolizasAbonoCuentasCobrar.intTipoCambio = strValor;
							        break;
							    case 2:
							        objFraRelacionarPolizasAbonoCuentasCobrar.intMonedaID = strValor;
							        break;
							    case 3:
							        objFraRelacionarPolizasAbonoCuentasCobrar.intSubtotalFactura = strValor;
							        break;
							    case 4:
							        objFraRelacionarPolizasAbonoCuentasCobrar.intTasaCuotaIvaFactura = strValor;
							        break;
							    case 5:
							        objFraRelacionarPolizasAbonoCuentasCobrar.intIvaFactura = strValor;
							        break;
							    case 6:
							        objFraRelacionarPolizasAbonoCuentasCobrar.intTasaCuotaIepsFactura = strValor;
							        break;
							    case 7:
							        objFraRelacionarPolizasAbonoCuentasCobrar.intIepsFactura = strValor;
							        break;
							    case 8:
							        objFraRelacionarPolizasAbonoCuentasCobrar.strTipoTasaCuotaIeps = strValor;
							        break;
							    case 9:
							        objFraRelacionarPolizasAbonoCuentasCobrar.strFactorTasaCuotaIeps = strValor;
							        break;
							    case 10:
							        objFraRelacionarPolizasAbonoCuentasCobrar.strFolio = strValor;
							        break;
							    case 11:
							        objFraRelacionarPolizasAbonoCuentasCobrar.strMonedaTipo = strValor;
							        break;
							    case 12:
							        objFraRelacionarPolizasAbonoCuentasCobrar.dteFecha = strValor;
							        break;
							    case 14:
							        objFraRelacionarPolizasAbonoCuentasCobrar.strTipoReferencia = strValor;
							        break;
							    case 15:
							        objFraRelacionarPolizasAbonoCuentasCobrar.intPorcentajeIvaFactura = strValor;
							        break;
							    case 16:
							        objFraRelacionarPolizasAbonoCuentasCobrar.intPorcentajeIepsFactura = strValor;
							        break;
							    case 17:
							        objFraRelacionarPolizasAbonoCuentasCobrar.intTotalFactura = strValor;
							        break;
							    case 18:
							     		 objFraRelacionarPolizasAbonoCuentasCobrar.intAbono = strValor;
							       		 objFraRelacionarPolizasAbonoCuentasCobrar.intSaldoInsoluto = 0;
							       		 //Hacer un llamado a la función para reemplazar ',' por cadena vacia
							       		 strValor = $.reemplazar(strValor, ",", "");
										 objFraRelacionarPolizasAbonoCuentasCobrar.intSaldoFactura = strValor;
							    	break;
							}
							
					      	intCol++;
					    });

                	//Agregar datos de la factura a relacionar
                	objFrasRelacionadasPolizasAbonoCuentasCobrar.setFactura(objFraRelacionarPolizasAbonoCuentasCobrar);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumFras_relacionar_fras_polizas_abono_cuentas_cobrar').val(intContador);

		}

		
		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Pólizas de Abono
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_polizas_abono_cuentas_cobrar').numeric();
			$('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_polizas_abono_cuentas_cobrar').blur(function(){
				$('.moneda_polizas_abono_cuentas_cobrar').formatCurrency({ roundToDecimalPlace: 2 });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_polizas_abono_cuentas_cobrar').blur(function(){
                $('.tipo-cambio_polizas_abono_cuentas_cobrar').formatCurrency({ roundToDecimalPlace: 4 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_polizas_abono_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});

		

		    //Autocomplete para recuperar los datos de un anticipo
	        $('#txtAnticipo_polizas_abono_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtAnticipoID_polizas_abono_cuentas_cobrar').val('');
	               //Hacer un llamado a la función para inicializar elementos del anticipo
	               inicializar_anticipo_polizas_abono_cuentas_cobrar();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "caja/anticipos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strFormulario: 'polizas_aplicacion'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	              //Asignar id del registro seleccionado
	              $('#txtAnticipoID_polizas_abono_cuentas_cobrar').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos del anticipo
	              get_datos_anticipo_polizas_abono_cuentas_cobrar();

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
			//Verificar que exista id del anticipo cuando pierda el enfoque la caja de texto
	        $('#txtAnticipo_polizas_abono_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del anticipo
	            if($('#txtAnticipoID_polizas_abono_cuentas_cobrar').val() == '' ||
	               $('#txtAnticipo_polizas_abono_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtAnticipoID_polizas_abono_cuentas_cobrar').val('');
	               $('#txtAnticipo_polizas_abono_cuentas_cobrar').val('');
	               //Hacer un llamado a la función para inicializar elementos del anticipo
	               inicializar_anticipo_polizas_abono_cuentas_cobrar();
	            }

	        });

			
			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_polizas_abono_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_polizas_abono_cuentas_cobrar').val('');
	               //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_polizas_abono_cuentas_cobrar();
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
	             $('#txtProspectoID_polizas_abono_cuentas_cobrar').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos del cliente
	              get_datos_cliente_polizas_abono_cuentas_cobrar();
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
	        $('#txtRazonSocial_polizas_abono_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_polizas_abono_cuentas_cobrar').val() == '' || $('#txtRazonSocial_polizas_abono_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_polizas_abono_cuentas_cobrar').val('');
	               $('#txtRazonSocial_polizas_abono_cuentas_cobrar').val('');
	               //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_polizas_abono_cuentas_cobrar();
                 
	            }
	        });

	       
	 
	        //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });


	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_polizas_abono_cuentas_cobrar').on('click','button.btn',function(){
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
	        $('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').focusout(function(e){
	            //Si el importe es un valor negativo
	            if(parseInt($('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').val()) <= 0)
	            { 
	            	//Limpiar caja de texto
	             	$('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
	             	//Enfocar caja de texto
				    $('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').focus();
	            }

	        });

	        
			//Validar que exista importe del pago cuando se pulse la tecla enter 
			$('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe importe del pago
		            if($('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').val() == '' ||
	                   parseInt($('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').val()) <= 0)
			   	    {
			   	    	//Limpiar caja de texto
	             		$('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').val('');
			   	   		//Enfocar caja de texto
					    $('#txtAbono_fras_relacionadas_polizas_abono_cuentas_cobrar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_fras_relacionadas_polizas_abono_cuentas_cobrar();
			   	    }
		        }
		    });


	        /*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_polizas_abono_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_polizas_abono_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_polizas_abono_cuentas_cobrar').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_polizas_abono_cuentas_cobrar').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_polizas_abono_cuentas_cobrar').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_polizas_abono_cuentas_cobrar').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un prospecto 
	        $('#txtRazonSocialBusq_polizas_abono_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_polizas_abono_cuentas_cobrar').val('');
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
	             $('#txtProspectoIDBusq_polizas_abono_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_polizas_abono_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_polizas_abono_cuentas_cobrar').val() == '' ||
	               $('#txtRazonSocialBusq_polizas_abono_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_polizas_abono_cuentas_cobrar').val('');
	               $('#txtRazonSocialBusq_polizas_abono_cuentas_cobrar').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_polizas_abono_cuentas_cobrar').on('click','a',function(event){
				event.preventDefault();
				intPaginaPolizasAbonoCuentasCobrar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_polizas_abono_cuentas_cobrar();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_polizas_abono_cuentas_cobrar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_polizas_abono_cuentas_cobrar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_polizas_abono_cuentas_cobrar').addClass("estatus-NUEVO");
				//Abrir modal
				 objPolizasAbonoCuentasCobrar = $('#PolizasAbonoCuentasCobrarBox').bPopup({
												   appendTo: '#PolizasAbonoCuentasCobrarContent', 
					                               contentContainer: 'PolizasAbonoCuentasCobrarM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtAnticipo_polizas_abono_cuentas_cobrar').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_polizas_abono_cuentas_cobrar').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_polizas_abono_cuentas_cobrar();

		});
	</script>