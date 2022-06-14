	<div id="AnticiposDevolucionCuentasPagarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_anticipos_devolucion_cuentas_pagar" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_anticipos_devolucion_cuentas_pagar" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_anticipos_devolucion_cuentas_pagar">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_anticipos_devolucion_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaInicialBusq_anticipos_devolucion_cuentas_pagar"
				                    		name= "strFechaInicialBusq_anticipos_devolucion_cuentas_pagar" 
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
								<label for="txtFechaFinalBusq_anticipos_devolucion_cuentas_pagar">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_anticipos_devolucion_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaFinalBusq_anticipos_devolucion_cuentas_pagar"
				                    		name= "strFechaFinalBusq_anticipos_devolucion_cuentas_pagar" 
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
								<input id="txtProspectoIDBusq_anticipos_devolucion_cuentas_pagar" 
									   name="intProspectoIDBusq_anticipos_devolucion_cuentas_pagar"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocialBusq_anticipos_devolucion_cuentas_pagar">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_anticipos_devolucion_cuentas_pagar" 
										name="strRazonSocialBusq_anticipos_devolucion_cuentas_pagar" 
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
								<label for="cmbEstatusBusq_anticipos_devolucion_cuentas_pagar">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_anticipos_devolucion_cuentas_pagar" 
								 		name="strEstatusBusq_anticipos_devolucion_cuentas_pagar" tabindex="1">
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
								<label for="txtBusqueda_anticipos_devolucion_cuentas_pagar">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_anticipos_devolucion_cuentas_pagar" 
										name="strBusqueda_anticipos_devolucion_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_anticipos_devolucion_cuentas_pagar" 
									   name="strImprimirDetalles_anticipos_devolucion_cuentas_pagar" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_anticipos_devolucion_cuentas_pagar"
									onclick="paginacion_anticipos_devolucion_cuentas_pagar();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_anticipos_devolucion_cuentas_pagar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_anticipos_devolucion_cuentas_pagar"
									onclick="reporte_anticipos_devolucion_cuentas_pagar('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_anticipos_devolucion_cuentas_pagar"
									onclick="reporte_anticipos_devolucion_cuentas_pagar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla devolución de anticipos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Razón social"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "RFC"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Cuenta bancaria"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

			    /*
				Definir columnas de la tabla anticipos a relacionar
				*/
				td.movil.b1:nth-of-type(1):before {content: "Referencia"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Tipo Referencia"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "T.C."; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Tasa Cuota IVA"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "IVA %"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "Tasa Cuota IEPS"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "IEPS %"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "IEPS"; font-weight: bold;}
				td.movil.b10:nth-of-type(10):before {content: "Folio"; font-weight: bold;}
				td.movil.b11:nth-of-type(11):before {content: "Fecha"; font-weight: bold;}
				td.movil.b12:nth-of-type(12):before {content: "Concepto"; font-weight: bold;}
				td.movil.b13:nth-of-type(13):before {content: "Importe"; font-weight: bold;}
				td.movil.b14:nth-of-type(14):before {content: "Saldo"; font-weight: bold;}
				td.movil.b15:nth-of-type(15):before {content: "Seleccionar"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla anticipos a relacionar
				*/
				td.movil.bt1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.bt2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.bt3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.bt4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.bt5:nth-of-type(5):before {content: "Saldo"; font-weight: bold;}


				/*
				Definir columnas de la tabla detalles de la devolución de anticipos
				*/
				td.movil.c1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.c3:nth-of-type(3):before {content: "Concepto"; font-weight: bold;}
				td.movil.c4:nth-of-type(4):before {content: "Total"; font-weight: bold;}
				td.movil.c5:nth-of-type(5):before {content: "Importe"; font-weight: bold;}
				td.movil.c6:nth-of-type(6):before {content: "Saldo"; font-weight: bold;}
				td.movil.c7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la devolución de anticipos
				*/
				td.movil.ct1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.ct2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.ct3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.ct4:nth-of-type(4):before {content: "Total"; font-weight: bold;}
				td.movil.ct5:nth-of-type(5):before {content: "Importe"; font-weight: bold;}
				td.movil.ct6:nth-of-type(6):before {content: "Saldo"; font-weight: bold;}
		
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_anticipos_devolucion_cuentas_pagar">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Razón social</th>
							<th class="movil">RFC</th>
							<th class="movil">Cuenta bancaria</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_anticipos_devolucion_cuentas_pagar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{razon_social}}</td>
							<td class="movil a4">{{rfc}}</td>
							<td class="movil a5">{{cuenta_bancaria}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_anticipos_devolucion_cuentas_pagar({{anticipo_devolucion_id}});"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_anticipos_devolucion_cuentas_pagar({{anticipo_devolucion_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_anticipos_devolucion_cuentas_pagar({{anticipo_devolucion_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_anticipos_devolucion_cuentas_pagar({{anticipo_devolucion_id}})" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_anticipos_devolucion_cuentas_pagar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_anticipos_devolucion_cuentas_pagar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		
		<!-- Diseño del modal Devolución de Anticipos-->
		<div id="AnticiposDevolucionCuentasPagarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_anticipos_devolucion_cuentas_pagar"  class="ModalBodyTitle">
			<h1>Devolución de Anticipos a Clientes</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAnticiposDevolucionCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmAnticiposDevolucionCuentasPagar"  onsubmit="return(false)" 
					  autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtAnticipoDevolucionID_anticipos_devolucion_cuentas_pagar" 
										   name="intAnticipoDevolucionID_anticipos_devolucion_cuentas_pagar" 
										   type="hidden" 
										   value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
									<input id="txtEstatus_anticipos_devolucion_cuentas_pagar" 
										   name="strEstatus_anticipos_devolucion_cuentas_pagar" 
										   type="hidden" 
										   value="" />
									<label for="txtFolio_anticipos_devolucion_cuentas_pagar">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtFolio_anticipos_devolucion_cuentas_pagar" 
											name="strFolio_anticipos_devolucion_cuentas_pagar" 
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
									<label for="txtFecha_anticipos_devolucion_cuentas_pagar">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_anticipos_devolucion_cuentas_pagar'>
					                    <input 	class="form-control" 
					                    		id="txtFecha_anticipos_devolucion_cuentas_pagar"
					                    		name= "strFecha_anticipos_devolucion_cuentas_pagar" 
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
					</div>
					<div class="row">
						<!--Autocomplete que contiene los clientes activos-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id del cliente seleccionado-->
									<input id="txtProspectoID_anticipos_devolucion_cuentas_pagar" 
										   name="intProspectoID_anticipos_devolucion_cuentas_pagar" 
										   type="hidden" value="" />   
									<label for="txtRazonSocial_anticipos_devolucion_cuentas_pagar">
										Razón social
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_anticipos_devolucion_cuentas_pagar" 
											name="strRazonSocial_anticipos_devolucion_cuentas_pagar" type="text" value=""   
											tabindex="1" placeholder="Ingrese razón social" maxlength="250" />
								</div>
							</div>
						</div>
						<!--RFC-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRfc_anticipos_devolucion_cuentas_pagar">RFC</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRfc_anticipos_devolucion_cuentas_pagar"
										   name="strRfc_anticipos_devolucion_cuentas_pagar" 
										   type="text" value="" disabled />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las cuentas bancarias activas-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta bancaria seleccionada-->
									<input id="txtCuentaBancariaID_anticipos_devolucion_cuentas_pagar" 
										   name="intCuentaBancariaID_anticipos_devolucion_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<label for="txtCuentaBancaria_anticipos_devolucion_cuentas_pagar">Cuenta bancaria</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuentaBancaria_anticipos_devolucion_cuentas_pagar" 
											name="strCuentaBancaria_anticipos_devolucion_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese cuenta bancaria" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Moneda-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la moneda de la cuenta bancaria seleccionada-->
									<input id="txtMonedaID_anticipos_devolucion_cuentas_pagar" 
											   name="intMonedaID_anticipos_devolucion_cuentas_pagar" type="hidden" value="">
									</input>
									<label for="txtMoneda_anticipos_devolucion_cuentas_pagar">Moneda</label>
								</div>
								<div class="col-md-12">
	                 				<input  class="form-control" id="txtMoneda_anticipos_devolucion_cuentas_pagar" 
											name="strMoneda_anticipos_devolucion_cuentas_pagar" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las cuentas bancarias activas (del cliente)-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtClienteCuentaBancaria_anticipos_devolucion_cuentas_pagar">Cuenta del cliente</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtClienteCuentaBancaria_anticipos_devolucion_cuentas_pagar" 
											name="strClienteCuentaBancaria_anticipos_devolucion_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese cuenta bancaria del cliente" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los bancos activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del banco seleccionado-->
									<input id="txtClienteBancoID_anticipos_devolucion_cuentas_pagar" 
										   name="intClienteBancoID_anticipos_devolucion_cuentas_pagar"  
										   type="hidden" value="">
									</input>
									<label for="txtClienteBanco_anticipos_devolucion_cuentas_pagar">Banco</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtClienteBanco_anticipos_devolucion_cuentas_pagar" 
											name="strClienteBanco_anticipos_devolucion_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese banco" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
				    	<!--Motivo-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMotivo_anticipos_devolucion_cuentas_pagar">Motivo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMotivo_anticipos_devolucion_cuentas_pagar" 
											name="strMotivo_anticipos_devolucion_cuentas_pagar" 
											type="text" value="" tabindex="1" 
											placeholder="Ingrese motivo" maxlength="250" />
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Observaciones-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_anticipos_devolucion_cuentas_pagar">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_anticipos_devolucion_cuentas_pagar" 
											name="strObservaciones_anticipos_devolucion_cuentas_pagar" 
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
										<input id="txtNumDetalles_anticipos_devolucion_cuentas_pagar" 
											   name="intNumDetalles_anticipos_devolucion_cuentas_pagar" 
											   type="hidden" 
											   value="" />
								    </div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la devolución de anticipos</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Botones-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="btn-group pull-right">
															<!--Buscar documentos a relacionar para agregarlos en la tabla-->
															<button class="btn btn-primary" 
							                                			id="btnBuscarDoc_anticipos_devolucion_cuentas_pagar" 
							                                			onclick="abrir_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar();" 
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
																<input id="txtReferenciaID_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
																	   name="intReferenciaID_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar el tipo de referencia-->
                                                                <input id="txtTipoReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
                                                                       name="strTipoReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
                                                                       type="hidden" value="">
                                                                </input>
																<!-- Caja de texto oculta que se utiliza para recuperar el saldo del anticipo-->
                                                                <input id="txtSaldoAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
                                                                       name="intSaldoAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
                                                                       type="hidden" value="">
                                                                </input>
																<label for="txtReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar">
																	Folio
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
																		name="strReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Fecha-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtFecha_ant_relacionados_anticipos_devolucion_cuentas_pagar">Fecha</label>
															</div>
															<div  class="col-md-12">
																<div class='input-group date'>
												                    <input class="form-control" id="txtFecha_ant_relacionados_anticipos_devolucion_cuentas_pagar"
												                    		name= "strFecha_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
												                    		type="text" value="" disabled />
												                    <span class="input-group-addon">
												                        <span class="glyphicon glyphicon-calendar"></span>
												                    </span>
												                </div>
															</div>
														</div>
													</div>
													<!--Concepto-->
													<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtConcepto_ant_relacionados_anticipos_devolucion_cuentas_pagar">Concepto</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtConcepto_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
																		name="strConcepto_ant_relacionados_anticipos_devolucion_cuentas_pagar" type="text" value="" disabled>
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
																<label for="txtSubtotalAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar">Subtotal</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtSubtotalAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
																		name="intSubtotalAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--IVA-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIvaAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar">IVA</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtIvaAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
																		name="intIvaAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--IEPS-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIepsAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar">
																	IEPS
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtIepsAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
																		name="intIepsAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
																		type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Total-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtImporteTotal_ant_relacionados_anticipos_devolucion_cuentas_pagar">Total</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtImporteTotal_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
																		name="intImporteTotal_ant_relacionados_anticipos_devolucion_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Importe (pago)-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar">Devolución</label>
															</div>
															<div class="col-md-12">
																<div class='input-group'>
																	<input  class="form-control moneda_anticipos_devolucion_cuentas_pagar" id="txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
																			name="intDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar" type="text" value="" 
																			tabindex="1" placeholder="Ingrese devolución" maxlength="22">
																	</input>
																	<span id="spnMonedaDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar" class="input-group-addon"></span>
																</div>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_anticipos_devolucion_cuentas_pagar"
					                                			onclick="agregar_renglon_ant_relacionados_anticipos_devolucion_cuentas_pagar();" 
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
													<table class="table-hover movil" id="dg_detalles_anticipos_devolucion_cuentas_pagar">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Folio</th>
																<th class="movil">Fecha</th>
																<th class="movil">Concepto</th>
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
																<td class="movil ct4">
																	<strong id="acumTotalAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar">$0.00</strong>
																</td>
																<td class="movil ct5">
																	<strong id="acumDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar">$0.00</strong>
																</td>
																<td class="movil ct6">
																	<strong id="acumSaldoAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar">$0.00</strong>
																	<strong id="monedaDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar"></strong>
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
																<strong id="numElementos_detalles_anticipos_devolucion_cuentas_pagar">0</strong> encontrados
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
							<button class="btn btn-success" 
									id="btnGuardar_anticipos_devolucion_cuentas_pagar"  
									onclick="validar_anticipos_devolucion_cuentas_pagar();"  
									title="Guardar" 
									tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_anticipos_devolucion_cuentas_pagar"  
									onclick="reporte_registro_anticipos_devolucion_cuentas_pagar('');"  
									title="Imprimir registro en PDF" 
									tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" 
									id="btnDesactivar_anticipos_devolucion_cuentas_pagar"  
									onclick="cambiar_estatus_anticipos_devolucion_cuentas_pagar('');"  
									title="Desactivar" 
									tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  
									id="btnCerrar_anticipos_devolucion_cuentas_pagar"
									type="reset" 
									aria-hidden="true" 
									onclick="cerrar_anticipos_devolucion_cuentas_pagar();" 
									title="Cerrar"  
									tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal -->

		<!-- Diseño del modal Relacionar Documentos (anticipos) de la Devolución-->
		<div id="RelacionarAntAnticiposDevolucionCuentasPagarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar" class="ModalBodyTitle">
			<h1>Anticipos del Cliente</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarAntAnticiposDevolucionCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarAntAnticiposDevolucionCuentasPagar"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Razón social-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del prospecto seleccionado-->
									<input id="txtProspectoIDBusq_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
										   name="intProspectoIDBusq_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar">Razón social</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRazonSocialBusq_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
										   name="strRazonSocialBusq_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar"  type="text" value="">
									</input>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group row">
						<!--Div que contiene la tabla con las anticipos encontradas-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<!-- Caja de texto oculta para asignar el número de registros de la tabla anticipos a relacionar--> 
							<input id="txtNumAnticipos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar" 
								   name="intNumAnticipos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar">
								<thead class="movil">
									<tr class="movil">
										<th class="movil">Folio</th>
										<th class="movil">Fecha</th>
										<th class="movil">Concepto</th>
										<th class="movil">Importe</th>
										<th class="movil">Saldo</th>
										<th class="movil" id="th-acciones" style="width:8em;">Seleccionar</th>
									</tr>
								</thead>
								<tbody class="movil"></tbody>
								<script id="plantilla_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar" type="text/template"> 
								{{#rows}}
									<tr class="movil">  
										<td class="movil-no-mostrar no-mostrar b1">{{referencia_id}}</td>
										<td class="movil-no-mostrar no-mostrar b2">{{tipo_referencia}}</td>
										<td class="movil-no-mostrar no-mostrar b3">{{tipo_cambio}}</td>
										<td class="movil-no-mostrar no-mostrar b4">{{subtotal}}</td>
										<td class="movil-no-mostrar no-mostrar b5">{{tasa_cuota_iva}}</td>
										<td class="movil-no-mostrar no-mostrar b6">{{porcentaje_iva}}</td>
										<td class="movil-no-mostrar no-mostrar b7">{{iva}}</td>
										<td class="movil-no-mostrar no-mostrar b8">{{tasa_cuota_ieps}}</td>
										<td class="movil-no-mostrar no-mostrar b9">{{porcentaje_ieps}}</td>
										<td class="movil-no-mostrar no-mostrar b10">{{ieps}}</td>
										<td class="movil b11">{{folio}}</td>
										<td class="movil b12">{{fecha}}</td>
										<td class="movil b13">{{concepto}}</td>
										<td class="movil b14">{{importe}}</td>
										<td class="movil b15">{{saldo}}</td>
										<td class="td-center movil b16"> 
											 <input 	type="checkbox" 
							    		class="form-check-input btn-xs" 
							    		id="chbAgregar_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar" />
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
										<td  class="movil bt5">
											<strong id="acumSaldo_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar">$0.00</strong>
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
										<strong id="numElementos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar anticipos-->
							<button class="btn btn-success" id="btnAgregar_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar"  
									onclick="validar_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar Documentos (anticipos) de la Devolución-->
	</div><!--#AnticiposDevolucionCuentasPagarContent -->


	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaAnticiposDevolucionCuentasPagar = 0;
		var strUltimaBusquedaAnticiposDevolucionCuentasPagar = "";
		//Variable que se utiliza para asignar el código de la moneda que le corresponde a la cuenta bancaria
		var strMonedaAnticiposDevolucionCuentasPagar = "";
		//Variables que se utilizan para la búsqueda de registros
		var intintProspectoIDAnticiposDevolucionCuentasPagar = "";
		var dteFechaInicialAnticiposDevolucionCuentasPagar = "";
		var dteFechaFinalAnticiposDevolucionCuentasPagar = "";
		//Variable que se utiliza para asignar objeto del modal Devolución de Anticipos
		var objAnticiposDevolucionCuentasPagar = null;
		//Variable que se utiliza para asignar objeto del modal Relacionar Documentos (anticipos) de la Devolución de Anticipos
		var objRelacionarFrasAnticiposDevolucionCuentasPagar = null;

		/*******************************************************************************************************************
		Funciones del objeto anticipos relacionados (seleccionados)
		*********************************************************************************************************************/
		// Constructor del objeto anticipos relacionados (seleccionados)
		var objAntRelacionadosAnticiposDevolucionCuentasPagar;
		function AntRelacionadosAnticiposDevolucionCuentasPagar(ant)
		{
			this.arrAnt = ant;
		}

		//Función para obtener todas las anticipos seleccionados de la devolución
		AntRelacionadosAnticiposDevolucionCuentasPagar.prototype.getAnticipos = function() {
		    return this.arrAnt;
		}

		//Función para agregar un anticipo al objeto 
		AntRelacionadosAnticiposDevolucionCuentasPagar.prototype.setAnticipo = function (fra){
			this.arrAnt.push(fra);
		}

		//Función para obtener un anticipo del objeto 
		AntRelacionadosAnticiposDevolucionCuentasPagar.prototype.getAnticipo = function(index) {
		    return this.arrAnt[index];
		}

		/*******************************************************************************************************************
		Funciones del objeto anticipos a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto anticipos a relacionar
		var objAntRelacionarAnticiposDevolucionCuentasPagar;
		
		function AntRelacionarAnticiposDevolucionCuentasPagar(referenciaID, tipoReferencia, 
															  folio, fecha, concepto, tipoCambio,
															  subtotalAnticipo, tasaCuotaIvaAnticipo, 
															  porcentajeIvaAnticipo, ivaAnticipo,
															  tasaCuotaIepsAnticipo, porcentajeIepsAnticipo,
															  iepsAnticipo, impAnticipo, impDevolucion, 
															  saldoInsoluto, saldoAnticipo)
		{
		    this.intReferenciaID = referenciaID;
		    this.strTipoReferencia = tipoReferencia;
		    this.strFolio = folio;
		    this.dteFecha = fecha;
		    this.strConcepto = concepto;
		    this.intTipoCambio = tipoCambio;
		    this.intSubtotalAnticipo = subtotalAnticipo;
		    this.intTasaCuotaIvaAnticipo = tasaCuotaIvaAnticipo;
		    this.intPorcentajeIvaAnticipo = porcentajeIvaAnticipo;
		    this.intIvaAnticipo = ivaAnticipo;
		    this.intTasaCuotaIepsAnticipo = tasaCuotaIepsAnticipo;
		    this.intPorcentajeIepsAnticipo = porcentajeIepsAnticipo;
		    this.intIepsAnticipo = iepsAnticipo;
		    this.intTotalAnticipo = impAnticipo;;
		    this.intDevolucion = impDevolucion;
		    this.intSaldoInsoluto = saldoInsoluto;
		    this.intSaldoAnticipo = saldoAnticipo;
		}

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_anticipos_devolucion_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_pagar/anticipos_devolucion/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_anticipos_devolucion_cuentas_pagar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosAnticiposDevolucionCuentasPagar = data.row;
					//Separar la cadena 
					var arrPermisosAnticiposDevolucionCuentasPagar = strPermisosAnticiposDevolucionCuentasPagar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosAnticiposDevolucionCuentasPagar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosAnticiposDevolucionCuentasPagar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_anticipos_devolucion_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosAnticiposDevolucionCuentasPagar[i]=='GUARDAR') || (arrPermisosAnticiposDevolucionCuentasPagar[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_anticipos_devolucion_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposDevolucionCuentasPagar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_anticipos_devolucion_cuentas_pagar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_anticipos_devolucion_cuentas_pagar();
						}
						else if(arrPermisosAnticiposDevolucionCuentasPagar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_anticipos_devolucion_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposDevolucionCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_anticipos_devolucion_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposDevolucionCuentasPagar[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_anticipos_devolucion_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposDevolucionCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_anticipos_devolucion_cuentas_pagar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_anticipos_devolucion_cuentas_pagar() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaAnticiposDevolucionCuentasPagar =($('#txtFechaInicialBusq_anticipos_devolucion_cuentas_pagar').val()+$('#txtFechaFinalBusq_anticipos_devolucion_cuentas_pagar').val()+$('#txtProspectoIDBusq_anticipos_devolucion_cuentas_pagar').val()+$('#cmbEstatusBusq_anticipos_devolucion_cuentas_pagar').val()+$('#txtBusqueda_anticipos_devolucion_cuentas_pagar').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaAnticiposDevolucionCuentasPagar != strUltimaBusquedaAnticiposDevolucionCuentasPagar)
			{
				intPaginaAnticiposDevolucionCuentasPagar = 0;
				strUltimaBusquedaAnticiposDevolucionCuentasPagar = strNuevaBusquedaAnticiposDevolucionCuentasPagar;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_pagar/anticipos_devolucion/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_anticipos_devolucion_cuentas_pagar').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_anticipos_devolucion_cuentas_pagar').val()),
					 intProspectoID: $('#txtProspectoIDBusq_anticipos_devolucion_cuentas_pagar').val(),
					 strEstatus: $('#cmbEstatusBusq_anticipos_devolucion_cuentas_pagar').val(),
					 strBusqueda: $('#txtBusqueda_anticipos_devolucion_cuentas_pagar').val(),
					 intPagina: intPaginaAnticiposDevolucionCuentasPagar,
					 strPermisosAcceso: $('#txtAcciones_anticipos_devolucion_cuentas_pagar').val()
					},
					function(data){
						$('#dg_anticipos_devolucion_cuentas_pagar tbody').empty();
						var tmpAnticiposDevolucionCuentasPagar = Mustache.render($('#plantilla_anticipos_devolucion_cuentas_pagar').html(),data);
						$('#dg_anticipos_devolucion_cuentas_pagar tbody').html(tmpAnticiposDevolucionCuentasPagar);
						$('#pagLinks_anticipos_devolucion_cuentas_pagar').html(data.paginacion);
						$('#numElementos_anticipos_devolucion_cuentas_pagar').html(data.total_rows);
						intPaginaAnticiposDevolucionCuentasPagar = data.pagina;
					},
			'json');
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_anticipos_devolucion_cuentas_pagar(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_pagar/anticipos_devolucion/';

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
			if ($('#chbImprimirDetalles_anticipos_devolucion_cuentas_pagar').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_anticipos_devolucion_cuentas_pagar').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_anticipos_devolucion_cuentas_pagar').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_anticipos_devolucion_cuentas_pagar').val()),	
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_anticipos_devolucion_cuentas_pagar').val()),
										'intProspectoID': $('#txtProspectoIDBusq_anticipos_devolucion_cuentas_pagar').val(),
										'strEstatus': $('#cmbEstatusBusq_anticipos_devolucion_cuentas_pagar').val(),
										'strBusqueda': $('#txtBusqueda_anticipos_devolucion_cuentas_pagar').val(), 
										'strDetalles': $('#chbImprimirDetalles_anticipos_devolucion_cuentas_pagar').val()
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}

		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_anticipos_devolucion_cuentas_pagar(id) 
		{	
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtAnticipoDevolucionID_anticipos_devolucion_cuentas_pagar').val();
			}
			else
			{
				intID = id;
			}

			
			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'cuentas_pagar/anticipos_devolucion/get_reporte_registro',
							'data' : {
										'intAnticipoDevolucionID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		

		/*******************************************************************************************************************
		Funciones del modal Devolución de Anticipos
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_anticipos_devolucion_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmAnticiposDevolucionCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_anticipos_devolucion_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmAnticiposDevolucionCuentasPagar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para inicializar elementos de las tablas detalles
			inicializar_detalles_anticipos_devolucion_cuentas_pagar();
			//Limpiar contenido de los siguientes controles del formulario
			$('#spnMonedaDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').text('');
	        $('#monedaDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').html('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_anticipos_devolucion_cuentas_pagar');
			//Habilitar todos los elementos del formulario
			$('#frmAnticiposDevolucionCuentasPagar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_anticipos_devolucion_cuentas_pagar').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
			$('#txtRfc_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
			$('#txtMoneda_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
			$('#txtReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
			$('#txtFecha_ant_relacionados_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
			$('#txtConcepto_ant_relacionados_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
			$('#txtSubtotalAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
			$('#txtIvaAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
			$('#txtIepsAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
			$('#txtImporteTotal_ant_relacionados_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_anticipos_devolucion_cuentas_pagar").show();
			$('#btnBuscarDoc_anticipos_devolucion_cuentas_pagar').show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_anticipos_devolucion_cuentas_pagar").hide();
			$("#btnDesactivar_anticipos_devolucion_cuentas_pagar").hide();
			//Deshabilitar botón Buscar anticipos
			$('#btnBuscarDoc_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
		}

		//Función para inicializar elementos del cliente
		function inicializar_cliente_anticipos_devolucion_cuentas_pagar()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#txtRfc_anticipos_devolucion_cuentas_pagar").val('');
	        $('#txtClienteCuentaBancaria_anticipos_devolucion_cuentas_pagar').val('');
	        $('#txtClienteBancoID_anticipos_devolucion_cuentas_pagar').val('');
	        $('#txtClienteBanco_anticipos_devolucion_cuentas_pagar').val('');
            //Deshabilitar botón Buscar anticipos
            $('#btnBuscarDoc_anticipos_devolucion_cuentas_pagar').attr('disabled','-1');
            //Hacer un llamado a la función para inicializar elementos de las tablas detalles
		    inicializar_detalles_anticipos_devolucion_cuentas_pagar();
		}


		//Función para inicializar elementos de la cuenta bancaria
		function inicializar_cuenta_bancaria_anticipos_devolucion_cuentas_pagar()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtMonedaID_anticipos_devolucion_cuentas_pagar').val('');
	        $('#txtMoneda_anticipos_devolucion_cuentas_pagar').val('');
	        $('#spnMonedaDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').text('');
	        $('#monedaDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').html('');
	        //Deshabilitar botón Buscar anticipos
            $('#btnBuscarDoc_anticipos_devolucion_cuentas_pagar').attr('disabled','-1');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_anticipos_devolucion_cuentas_pagar();

		}
		
		//Función para inicializar elementos de las tablas detalles
		function inicializar_detalles_anticipos_devolucion_cuentas_pagar()
		{
			//Hacer un llamado a la función para inicializar elementos del anticipo (detalle)
		    inicializar_detalle_ant_relacionados_anticipos_devolucion_cuentas_pagar();

			//Eliminar los datos de la tabla detalles de la devolución de anticipos
			$('#dg_detalles_anticipos_devolucion_cuentas_pagar tbody').empty();
			$('#numElementos_detalles_anticipos_devolucion_cuentas_pagar').html(0);
			$('#txtNumDetalles_anticipos_devolucion_cuentas_pagar').val('');
			$('#acumTotalAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').html('$0.00');
		    $('#acumDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').html('$0.00');
		    $('#acumSaldoAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').html('$0.00');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_anticipos_devolucion_cuentas_pagar()
		{
			try {
				//Hacer un llamado a la función para cerrar modal Relacionar Documentos (anticipos) de la Devolución
				cerrar_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar();
				//Cerrar modal
				objAnticiposDevolucionCuentasPagar.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_anticipos_devolucion_cuentas_pagar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_anticipos_devolucion_cuentas_pagar()
		{

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_anticipos_devolucion_cuentas_pagar();

			//Validación del formulario de campos obligatorios
			$('#frmAnticiposDevolucionCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_anticipos_devolucion_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strRazonSocial_anticipos_devolucion_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if($('#txtProspectoID_anticipos_devolucion_cuentas_pagar').val() === '')
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
										strCuentaBancaria_anticipos_devolucion_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cuenta bancaria
					                                    if($('#txtCuentaBancariaID_anticipos_devolucion_cuentas_pagar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una cuenta bancaria existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strClienteBanco_anticipos_devolucion_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                	//Verificar que exista id del banco
					                                    if(value !== '' && $('#txtClienteBancoID_anticipos_devolucion_cuentas_pagar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un banco existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMotivo_anticipos_devolucion_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un motivo'}
											}
										},
										intNumDetalles_anticipos_devolucion_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta devolución'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFecha_ant_relacionados_anticipos_devolucion_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strConcepto_ant_relacionados_anticipos_devolucion_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intSubtotalAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intIvaAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intIepsAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intImporteTotal_ant_relacionados_anticipos_devolucion_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										}

									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_anticipos_devolucion_cuentas_pagar = $('#frmAnticiposDevolucionCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_anticipos_devolucion_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_anticipos_devolucion_cuentas_pagar.isValid())
			{

				//Hacer un llamado a la función para guardar los datos del registro
				guardar_anticipos_devolucion_cuentas_pagar();

			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_anticipos_devolucion_cuentas_pagar()
		{
			try
			{
				$('#frmAnticiposDevolucionCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_anticipos_devolucion_cuentas_pagar()
		{
			
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_anticipos_devolucion_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrReferencias = [];
			var arrReferenciaID = [];
			var arrSubtotales = [];
			var arrTasaCuotaIva = [];
			var arrIvas = [];
			var arrTasaCuotaIeps = [];
			var arrIeps = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variable que se utiliza para asignar el subtotal
				var intSubtotal = 0;
				//Variable que se utiliza para asignar el importe de iva
				var intImporteIva = 0;
				//Variable que se utiliza para asignar el importe de ieps
				var intImporteIeps = 0;
				//Variable que se utiliza para asignar porcentaje del impuesto que se va a desglosar
				var intPorcentajeDesglose = 0;
				//Asignar NO para evitar calcular el impuesto de IEPS
				var strCalcularIEPS = 'NO';
				//Variable que se utiliza para asignar el total de impuestos correspondientes al importe
				var intTotalImpuestos = 0;
				//Variable que se utiliza para asignar el importe que le corresponde a la tasa
				var intImporteTasa = 0;
				//Variable que se utiliza para asignar el importe convertido al tipo de cambio pesos mexicanos
				var intImportePesos = 0;

				//Variables que se utilizan para asignar valores del detalle
				var intTipoCambio = parseFloat(objRen.cells[9].innerHTML);
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intImporte = parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				var intPorcentajeIvaAnticipo = objRen.cells[12].innerHTML;
				var intPorcentajeIepsAnticipo = objRen.cells[15].innerHTML;
			
				//Asignar porcentaje de IVA para su desglose
		        intPorcentajeDesglose = parseFloat(intPorcentajeIvaAnticipo);

		        //Si existe porcentaje de IEPS
				if(intPorcentajeIepsAnticipo != '')
				{	
					//Convertir cadena de texto a número decimal
					intPorcentajeIepsAnticipo = parseFloat(intPorcentajeIepsAnticipo);
					//Incremetar porcentaje de impuestos para su desglose
					intPorcentajeDesglose += intPorcentajeIepsAnticipo;
					//Asignar SI para calcular el impuesto de IEPS
					strCalcularIEPS = 'SI';
					
				}
				
				//Calcular porcentaje de impuestos (para su desglose)
			    intPorcentajeDesglose += 1;

			    //Convertir cantidad a pesos mexicanos
			    intImportePesos =  intImporte * intTipoCambio;

			    //Calcular precio de la referencia (desglosar IVA y/o IEPS)
                intSubtotal =  intImportePesos / intPorcentajeDesglose;

                //Redondear cantidad a decimales
				intSubtotal = intSubtotal.toFixed(2);
				intSubtotal = parseFloat(intSubtotal);

				//Calcular importe de IVA
	        	intImporteIva = intSubtotal *  intPorcentajeIvaAnticipo;
	        	//Redondear cantidad a decimales
				intImporteIva = intImporteIva.toFixed(2);
				intImporteIva = parseFloat(intImporteIva);

				//Si se cumple la regla de validación
				if(strCalcularIEPS == 'SI')
				{
					//Calcular importe de IEPS
            		intImporteIeps = intSubtotal * intPorcentajeIepsAnticipo;
            		//Redondear cantidad a decimales
					intImporteIeps = intImporteIeps.toFixed(2);
					intImporteIeps = parseFloat(intImporteIeps);
				}

				//Calcular el total de impuestos por pagar
				intTotalImpuestos = intImporteIva + intImporteIeps;

				//Calcular el total del abono por su tasa (que se va a guardar en la BD)
				intImporteTasa = intSubtotal + intTotalImpuestos;
				//Redondear cantidad a decimales
				intImporteTasa = intImporteTasa.toFixed(2);
				intImporteTasa = parseFloat(intImporteTasa);

				//Verificar que el abono que le corresponde a la tasa no sea distinto al que se ingresa
				if(intImporteTasa != intImportePesos)
				{
					//Calcular precio nuevamente para evitar más decimales 
					intSubtotal = intImportePesos - intTotalImpuestos;
					intSubtotal = intSubtotal.toFixed(2);
					intSubtotal = parseFloat(intSubtotal);
				}


				//Asignar valores a los arrays
				arrReferencias.push(objRen.cells[7].innerHTML);
				arrReferenciaID.push(objRen.cells[8].innerHTML);
				arrSubtotales.push(intSubtotal);
				arrTasaCuotaIva.push(objRen.cells[11].innerHTML);
				arrIvas.push(intImporteIva);
				arrTasaCuotaIeps.push(objRen.cells[14].innerHTML);
				arrIeps.push(intImporteIeps);
			}


			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_pagar/anticipos_devolucion/guardar',
			{ 
				//Datos de la devolución de anticipos
				intAnticipoDevolucionID: $('#txtAnticipoDevolucionID_anticipos_devolucion_cuentas_pagar').val(),
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				dteFecha: $.formatFechaMysql($('#txtFecha_anticipos_devolucion_cuentas_pagar').val()),
				intProspectoID: $('#txtProspectoID_anticipos_devolucion_cuentas_pagar').val(),
				strRazonSocial: $('#txtRazonSocial_anticipos_devolucion_cuentas_pagar').val(),
				strRfc: $('#txtRfc_anticipos_devolucion_cuentas_pagar').val(),
				strClienteCuentaBancaria: $('#txtClienteCuentaBancaria_anticipos_devolucion_cuentas_pagar').val(),
				intClienteBancoID: $('#txtClienteBancoID_anticipos_devolucion_cuentas_pagar').val(),
				intCuentaBancariaID: $('#txtCuentaBancariaID_anticipos_devolucion_cuentas_pagar').val(),
				strMotivo: $('#txtMotivo_anticipos_devolucion_cuentas_pagar').val(),
				strObservaciones: $('#txtObservaciones_anticipos_devolucion_cuentas_pagar').val(),
				intProcesoMenuID: $('#txtProcesoMenuID_anticipos_devolucion_cuentas_pagar').val(),
				//Datos de los detalles
				strReferencias: arrReferencias.join('|'),
				strReferenciaID: arrReferenciaID.join('|'),
				strSubtotales: arrSubtotales.join('|'),
				strTasaCuotaIva: arrTasaCuotaIva.join('|'),
				strIvas: arrIvas.join('|'),
				strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
				strIeps: arrIeps.join('|')
			},
				function(data) {
					if (data.resultado)
					{
						
						//Hacer un llamado a la función para cerrar modal
	                    cerrar_anticipos_devolucion_cuentas_pagar();
						//Hacer llamado a la función para cargar  los registros en el grid
						paginacion_anticipos_devolucion_cuentas_pagar();
					}

				    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_anticipos_devolucion_cuentas_pagar(data.tipo_mensaje, data.mensaje);

				},
			'json');

		}


		//Función para mostrar mensaje de éxito o error
		function mensaje_anticipos_devolucion_cuentas_pagar(tipoMensaje, mensaje)
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
												$('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').focus();
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
		function cambiar_estatus_anticipos_devolucion_cuentas_pagar(id)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtAnticipoDevolucionID_anticipos_devolucion_cuentas_pagar').val();

			}
			else
			{
				intID = id;
			}

		   
			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
					             {'type':     'question',
					              'title':    'Devolución de Anticipos a Clientes',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('cuentas_pagar/anticipos_devolucion/set_estatus',
					                                     {intAnticipoDevolucionID: intID
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                          	//Hacer llamado a la función  para cargar  los registros en el grid
					                                          	paginacion_anticipos_devolucion_cuentas_pagar();

					                                          	//Si el id del registro se obtuvo del modal
																if(id == '')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_anticipos_devolucion_cuentas_pagar();     
																}
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_anticipos_devolucion_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_anticipos_devolucion_cuentas_pagar(id)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_pagar/anticipos_devolucion/get_datos',
			       {
			       	 intAnticipoDevolucionID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_anticipos_devolucion_cuentas_pagar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el código de la moneda
	                        strMonedaAnticiposDevolucionCuentasPagar = data.row.codigo_moneda;
	                        //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';

				          	//Recuperar valores
				            $('#txtAnticipoDevolucionID_anticipos_devolucion_cuentas_pagar').val(data.row.anticipo_devolucion_id);
				            $('#txtFolio_anticipos_devolucion_cuentas_pagar').val(data.row.folio);
				            $('#txtFecha_anticipos_devolucion_cuentas_pagar').val(data.row.fecha);
				            $('#txtProspectoID_anticipos_devolucion_cuentas_pagar').val(data.row.prospecto_id);
						    $('#txtRazonSocial_anticipos_devolucion_cuentas_pagar').val(data.row.razon_social);
						    $('#txtRfc_anticipos_devolucion_cuentas_pagar').val(data.row.rfc);
						    $('#txtClienteCuentaBancaria_anticipos_devolucion_cuentas_pagar').val(data.row.cliente_cuenta_bancaria);
						    $('#txtClienteBancoID_anticipos_devolucion_cuentas_pagar').val(data.row.cliente_banco_id);
						    $('#txtClienteBanco_anticipos_devolucion_cuentas_pagar').val(data.row.cliente_banco);
						    $('#txtCuentaBancariaID_anticipos_devolucion_cuentas_pagar').val(data.row.cuenta_bancaria_id);
				          	$('#txtCuentaBancaria_anticipos_devolucion_cuentas_pagar').val(data.row.cuenta_bancaria);
				          	$('#txtMonedaID_anticipos_devolucion_cuentas_pagar').val(data.row.moneda_id);
				          	$('#txtMoneda_anticipos_devolucion_cuentas_pagar').val(data.row.moneda);
				          	$('#txtMotivo_anticipos_devolucion_cuentas_pagar').val(data.row.motivo);
				            $('#txtObservaciones_anticipos_devolucion_cuentas_pagar').val(data.row.observaciones);
				            $('#txtEstatus_anticipos_devolucion_cuentas_pagar').val(strEstatus);
				            //Asignar el código de la moneda de la devolución
							$('#spnMonedaDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').text(strMonedaAnticiposDevolucionCuentasPagar);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_anticipos_devolucion_cuentas_pagar').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_anticipos_devolucion_cuentas_pagar").show();

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
													" onclick='editar_renglon_ant_relacionados_anticipos_devolucion_cuentas_pagar(this)'>" + 
													"<span class='glyphicon glyphicon-edit'></span></button>" + 
													"<button class='btn btn-default btn-xs' title='Eliminar'" +
													" onclick='eliminar_renglon_ant_relacionados_anticipos_devolucion_cuentas_pagar(this)'>" + 
													"<span class='glyphicon glyphicon-trash'></span></button>" + 
													"<button class='btn btn-default btn-xs up' title='Subir'>" + 
													"<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													"<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													"<span class='glyphicon glyphicon-arrow-down'></span></button>";


							    //Habilitar botón Buscar anticipos
								$('#btnBuscarDoc_anticipos_devolucion_cuentas_pagar').removeAttr('disabled');
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_anticipos_devolucion_cuentas_pagar").show();
							}
							else 
							{

								//Deshabilitar todos los elementos del formulario
				            	$('#frmAnticiposDevolucionCuentasPagar').find('input, textarea, select').attr('disabled','disabled');
					            //Ocultar los siguientes botones
								$("#btnGuardar_anticipos_devolucion_cuentas_pagar").hide();
								$("#btnBuscarDoc_anticipos_devolucion_cuentas_pagar").hide();
							}
				          
				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {

				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_anticipos_devolucion_cuentas_pagar').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaFolio = objRenglon.insertCell(0);
								var objCeldaFecha = objRenglon.insertCell(1);
								var objCeldaConcepto = objRenglon.insertCell(2);
								var objCeldaImpAnticipo = objRenglon.insertCell(3);
								var objCeldaDevolucion = objRenglon.insertCell(4);
								var objCeldaSaldoInsoluto = objRenglon.insertCell(5);
								var objCeldaAcciones = objRenglon.insertCell(6);
								//Columnas ocultas
								var objCeldaTipoReferencia = objRenglon.insertCell(7);
								var objCeldaReferenciaID = objRenglon.insertCell(8);
								var objCeldaTipoCambio = objRenglon.insertCell(9);
								var objCeldaSubtotalAnticipo = objRenglon.insertCell(10);
								var objCeldaTasaCuotaIvaAnticipo = objRenglon.insertCell(11);
								var objCeldaPorcentajeIvaAnticipo = objRenglon.insertCell(12);
								var objCeldaIvaAnticipo = objRenglon.insertCell(13);
								var objCeldaTasaCuotaIepsAnticipo = objRenglon.insertCell(14);
								var objCeldaPorcentajeIepsAnticipo = objRenglon.insertCell(15);
								var objCeldaIepsAnticipo = objRenglon.insertCell(16);
								var objCeldaSaldoAnticipo = objRenglon.insertCell(17);

								//Variables que se utilizan para asignar valores del detalle
								var intReferenciaID = data.detalles[intCon].referencia_id;
								var strTipoReferencia = data.detalles[intCon].referencia;
								var intSaldoAnticipo = parseFloat(data.detalles[intCon].saldo_anticipo);
								//Variable que se utiliza para asignar la devolución 
								var intDevolucion = parseFloat(data.detalles[intCon].devolucion);
								//Variable que se utiliza para asignar el id del detalle
								var strDetalleID = intReferenciaID+'_'+strTipoReferencia;

								
								//Incrementar el saldo de la factura
								intSaldoAnticipo =  intSaldoAnticipo + intDevolucion;

								//Redondear cantidad a dos decimales
								intSaldoAnticipo = intSaldoAnticipo.toFixed(2);
								intSaldoAnticipo = parseFloat(intSaldoAnticipo);


						        //Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', strDetalleID);
								objCeldaFolio.setAttribute('class', 'movil c1');
								objCeldaFolio.innerHTML = data.detalles[intCon].folio;
								objCeldaFecha.setAttribute('class', 'movil c2');
								objCeldaFecha.innerHTML = data.detalles[intCon].fecha;
								objCeldaConcepto.setAttribute('class', 'movil c3');
								objCeldaConcepto.innerHTML = data.detalles[intCon].concepto;
								objCeldaImpAnticipo.setAttribute('class', 'movil c4');
								objCeldaImpAnticipo.innerHTML = formatMoney(data.detalles[intCon].total_anticipo, 2, '');
								objCeldaDevolucion.setAttribute('class', 'movil c5');
								objCeldaDevolucion.innerHTML = formatMoney(intDevolucion, 2, '');
								objCeldaSaldoInsoluto.setAttribute('class', 'movil c6');
								objCeldaSaldoInsoluto.innerHTML = formatMoney(data.detalles[intCon].saldo_anticipo, 2, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil c7');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
								objCeldaTipoReferencia.innerHTML = strTipoReferencia; 
								objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
								objCeldaReferenciaID.innerHTML = intReferenciaID; 
								objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
								objCeldaTipoCambio.innerHTML = data.detalles[intCon].tipo_cambio;
								objCeldaSubtotalAnticipo.setAttribute('class', 'no-mostrar');
								objCeldaSubtotalAnticipo.innerHTML = formatMoney(data.detalles[intCon].subtotal_anticipo, 2, '');
								objCeldaTasaCuotaIvaAnticipo.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIvaAnticipo.innerHTML = data.detalles[intCon].tasa_cuota_iva;
								objCeldaPorcentajeIvaAnticipo.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIvaAnticipo.innerHTML = data.detalles[intCon].porcentaje_iva;
								objCeldaIvaAnticipo.setAttribute('class', 'no-mostrar');
								objCeldaIvaAnticipo.innerHTML = formatMoney(data.detalles[intCon].iva_anticipo, 2, '');
								objCeldaTasaCuotaIepsAnticipo.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIepsAnticipo.innerHTML = data.detalles[intCon].tasa_cuota_ieps;
								objCeldaPorcentajeIepsAnticipo.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIepsAnticipo.innerHTML = data.detalles[intCon].porcentaje_ieps;
								objCeldaIepsAnticipo.setAttribute('class', 'no-mostrar');
								objCeldaIepsAnticipo.innerHTML = formatMoney(data.detalles[intCon].ieps_anticipo, 2, '');
								objCeldaSaldoAnticipo.setAttribute('class', 'no-mostrar');
								objCeldaSaldoAnticipo.innerHTML = intSaldoAnticipo;

				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_ant_relacionados_anticipos_devolucion_cuentas_pagar();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_anticipos_devolucion_cuentas_pagar tr").length - 2;
							$('#numElementos_detalles_anticipos_devolucion_cuentas_pagar').html(intFilas);
							$('#txtNumDetalles_anticipos_devolucion_cuentas_pagar').val(intFilas);

			            	//Abrir modal
				            objAnticiposDevolucionCuentasPagar = $('#AnticiposDevolucionCuentasPagarBox').bPopup({
														  appendTo: '#AnticiposDevolucionCuentasPagarContent', 
							                              contentContainer: 'AnticiposDevolucionCuentasPagarM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtRazonSocial_anticipos_devolucion_cuentas_pagar').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar obtener los datos de un cliente
		function get_datos_cliente_anticipos_devolucion_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los datos del cliente
            $.post('cuentas_cobrar/clientes/get_datos',
                  { 
                  	intProspectoID:$("#txtProspectoID_anticipos_devolucion_cuentas_pagar").val()
                  },
                  function(data) {
                    if(data.row){
                       
                       //Asignar datos del registro seleccionado
                       $("#txtRazonSocial_anticipos_devolucion_cuentas_pagar").val(data.row.razon_social);
                       $("#txtRfc_anticipos_devolucion_cuentas_pagar").val(data.row.rfc);
                        //Si existe id de la moneda
			            if($('#txtMonedaID_anticipos_devolucion_cuentas_pagar').val() !== '')
			            {
			            	//Habilitar botón Buscar anticipos
			            	$('#btnBuscarDoc_anticipos_devolucion_cuentas_pagar').removeAttr('disabled');
			            }

                    }
                  }
                 ,
                'json');
		}

		//Función para regresar obtener los datos de una cuenta bancaria
		function get_datos_cuenta_bancaria_anticipos_devolucion_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
            $.post('cuentas_pagar/cuentas_bancarias/get_datos',
                  { 
                  	strBusqueda:$('#txtCuentaBancariaID_anticipos_devolucion_cuentas_pagar').val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){	
                    	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
						inicializar_detalles_anticipos_devolucion_cuentas_pagar();                    	
                        //Asignar datos del registro seleccionado
                        $("#txtMonedaID_anticipos_devolucion_cuentas_pagar").val(data.row.moneda_id);
                        $("#txtMoneda_anticipos_devolucion_cuentas_pagar").val(data.row.moneda);
                        //Asignar el código de la moneda
                        strMonedaAnticiposDevolucionCuentasPagar = data.row.codigo_moneda;

						$('#spnMonedaDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').text(strMonedaAnticiposDevolucionCuentasPagar);
						$('#monedaDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').html(strMonedaAnticiposDevolucionCuentasPagar);

                       	//Si existe id del prospecto
	              	  	if($("#txtProspectoID_anticipos_devolucion_cuentas_pagar").val() !== '')
                        {
                        	//Habilitar botón Buscar anticipos
							$('#btnBuscarDoc_anticipos_devolucion_cuentas_pagar').removeAttr('disabled');
                        }
                      
                    }
                  }
                 ,
                'json');
		}




		/*******************************************************************************************************************
		Funciones de la tabla anticipos relacionados
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_ant_relacionados_anticipos_devolucion_cuentas_pagar()
		{
		
			//Mostramos las anticipos relacionados (seleccionados)
			for (var intCon in objAntRelacionadosAnticiposDevolucionCuentasPagar.getAnticipos()) 
            {
            	//Crear instancia del objeto Anticipo a relacionar 
            	objAntRelacionarAnticiposDevolucionCuentasPagar = new AntRelacionarAnticiposDevolucionCuentasPagar();
            	//Asignar datos del anticipo corespondiente al indice
            	objAntRelacionarAnticiposDevolucionCuentasPagar = objAntRelacionadosAnticiposDevolucionCuentasPagar.getAnticipo(intCon);
            	
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_detalles_anticipos_devolucion_cuentas_pagar').getElementsByTagName('tbody')[0];


			   //Variable que se utiliza para asignar el id del detalle
				var strDetalleID =  objAntRelacionarAnticiposDevolucionCuentasPagar.intReferenciaID+'_'+objAntRelacionarAnticiposDevolucionCuentasPagar.strTipoReferencia;

				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
				if (!objTabla.rows.namedItem(strDetalleID))
				{
					
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaFolio = objRenglon.insertCell(0);
					var objCeldaFecha = objRenglon.insertCell(1);
					var objCeldaConcepto = objRenglon.insertCell(2);
					var objCeldaImpAnticipo = objRenglon.insertCell(3);
					var objCeldaDevolucion = objRenglon.insertCell(4);
					var objCeldaSaldoInsoluto = objRenglon.insertCell(5);
					var objCeldaAcciones = objRenglon.insertCell(6);
					//Columnas ocultas
					var objCeldaTipoReferencia = objRenglon.insertCell(7);
					var objCeldaReferenciaID = objRenglon.insertCell(8);
					var objCeldaTipoCambio = objRenglon.insertCell(9);
					var objCeldaSubtotalAnticipo = objRenglon.insertCell(10);
					var objCeldaTasaCuotaIvaAnticipo = objRenglon.insertCell(11);
					var objCeldaPorcentajeIvaAnticipo = objRenglon.insertCell(12);
					var objCeldaIvaAnticipo = objRenglon.insertCell(13);
					var objCeldaTasaCuotaIepsAnticipo = objRenglon.insertCell(14);
					var objCeldaPorcentajeIepsAnticipo = objRenglon.insertCell(15);
					var objCeldaIepsAnticipo = objRenglon.insertCell(16);
					var objCeldaSaldoAnticipo = objRenglon.insertCell(17);
					
					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strDetalleID);
					objCeldaFolio.setAttribute('class', 'movil c1');
					objCeldaFolio.innerHTML = objAntRelacionarAnticiposDevolucionCuentasPagar.strFolio;
					objCeldaFecha.setAttribute('class', 'movil c2');
					objCeldaFecha.innerHTML = objAntRelacionarAnticiposDevolucionCuentasPagar.dteFecha;
					objCeldaConcepto.setAttribute('class', 'movil c3');
					objCeldaConcepto.innerHTML = objAntRelacionarAnticiposDevolucionCuentasPagar.strConcepto;
					objCeldaImpAnticipo.setAttribute('class', 'movil c4');
					objCeldaImpAnticipo.innerHTML = objAntRelacionarAnticiposDevolucionCuentasPagar.intTotalAnticipo;
					objCeldaDevolucion.setAttribute('class', 'movil c5');
					objCeldaDevolucion.innerHTML = objAntRelacionarAnticiposDevolucionCuentasPagar.intDevolucion;
					objCeldaSaldoInsoluto.setAttribute('class', 'movil c6');
					objCeldaSaldoInsoluto.innerHTML = formatMoney(objAntRelacionarAnticiposDevolucionCuentasPagar.intSaldoInsoluto, 2, '');
					objCeldaAcciones.setAttribute('class', 'movil c7');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_ant_relacionados_anticipos_devolucion_cuentas_pagar(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_ant_relacionados_anticipos_devolucion_cuentas_pagar(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
					objCeldaReferenciaID.innerHTML = objAntRelacionarAnticiposDevolucionCuentasPagar.intReferenciaID; 
					objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
					objCeldaTipoReferencia.innerHTML = objAntRelacionarAnticiposDevolucionCuentasPagar.strTipoReferencia; 
					objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
					objCeldaTipoCambio.innerHTML =  objAntRelacionarAnticiposDevolucionCuentasPagar.intTipoCambio;
					objCeldaSubtotalAnticipo.setAttribute('class', 'no-mostrar');
					objCeldaSubtotalAnticipo.innerHTML =  objAntRelacionarAnticiposDevolucionCuentasPagar.intSubtotalAnticipo;
					objCeldaTasaCuotaIvaAnticipo.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIvaAnticipo.innerHTML =  objAntRelacionarAnticiposDevolucionCuentasPagar.intTasaCuotaIvaAnticipo;
					objCeldaPorcentajeIvaAnticipo.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIvaAnticipo.innerHTML =  objAntRelacionarAnticiposDevolucionCuentasPagar.intPorcentajeIvaAnticipo;
					objCeldaIvaAnticipo.setAttribute('class', 'no-mostrar');
					objCeldaIvaAnticipo.innerHTML =  objAntRelacionarAnticiposDevolucionCuentasPagar.intIvaAnticipo;
					objCeldaTasaCuotaIepsAnticipo.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIepsAnticipo.innerHTML =  objAntRelacionarAnticiposDevolucionCuentasPagar.intTasaCuotaIepsAnticipo;
					objCeldaPorcentajeIepsAnticipo.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIepsAnticipo.innerHTML =  objAntRelacionarAnticiposDevolucionCuentasPagar.intPorcentajeIepsAnticipo;
					objCeldaIepsAnticipo.setAttribute('class', 'no-mostrar');
					objCeldaIepsAnticipo.innerHTML =  objAntRelacionarAnticiposDevolucionCuentasPagar.intIepsAnticipo;
					objCeldaSaldoAnticipo.setAttribute('class', 'no-mostrar');
					objCeldaSaldoAnticipo.innerHTML =  objAntRelacionarAnticiposDevolucionCuentasPagar.intSaldoAnticipo;
				}
            }
           
            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_anticipos_devolucion_cuentas_pagar tr").length - 2;
			$('#numElementos_detalles_anticipos_devolucion_cuentas_pagar').html(intFilas);
			$('#txtNumDetalles_anticipos_devolucion_cuentas_pagar').val(intFilas);
		
			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_ant_relacionados_anticipos_devolucion_cuentas_pagar();
		}

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_ant_relacionados_anticipos_devolucion_cuentas_pagar()
		{
			//Variable que se utiliza para asignar el saldo insoluto
			var intSaldoInsoluto = 0;
			//Variable que se utiliza para asignar el mensaje informativo
			var strMensaje = '';

			//Obtenemos los datos de las cajas de texto
			var intReferenciaID = $('#txtReferenciaID_ant_relacionados_anticipos_devolucion_cuentas_pagar').val();
			var strTipoReferencia = $('#txtTipoReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar').val();
			var intSubtotalAnticipo = $('#txtSubtotalAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').val();
		    var intSaldoAnticipo = $('#txtSaldoAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').val();
			var intDevolucion = $('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').val();
			
			//Variable que se utiliza para asignar el id del detalle
			var strDetalleID = intReferenciaID+'_'+strTipoReferencia;

			

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_anticipos_devolucion_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intDevolucion == '')
			{
				//Enfocar caja de texto
				$('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').focus();
			}
			else
			{
				//Convertir cadena de texto a número decimal
				intSaldoAnticipo =  parseFloat(intSaldoAnticipo);
				intDevolucion =  parseFloat($.reemplazar(intDevolucion, ",", ""));
				
				//Verificar que la devolución sea menor o igual que el saldo del anticipo
				if(intDevolucion <= intSaldoAnticipo)
				{	
					//Hacer un llamado a la función para inicializar elementos del detalle
					inicializar_detalle_ant_relacionados_anticipos_devolucion_cuentas_pagar();
					
					//Calcular el saldo insoluto del anticipo
					intSaldoInsoluto =  intSaldoAnticipo  - intDevolucion;

					//Revisamos si existe el ID proporcionado, si es así, editamos los datos
					if (objTabla.rows.namedItem(strDetalleID))
					{
						objTabla.rows.namedItem(strDetalleID).cells[4].innerHTML =  formatMoney(intDevolucion, 2, '');
						objTabla.rows.namedItem(strDetalleID).cells[5].innerHTML =  formatMoney(intSaldoInsoluto, 2, '');
					}

					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_ant_relacionados_anticipos_devolucion_cuentas_pagar();

					//Enfocar caja de texto
					$('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').focus();
				}
				else
				{
					//Cambiar cantidad a formato moneda
			    	intSaldoAnticipo = formatMoney(intSaldoAnticipo, 2, '');

					//Asignar saldo del anticipo
					$('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(intSaldoAnticipo);

					/*Mensaje que se utiliza para informar al usuario que la devolución no debe ser mayor que el saldo del anticipo*/
					strMensaje = 'La devolución sobrepasa el saldo del anticipo.';
					strMensaje += '<br>Saldo restante: <b>'+intSaldoAnticipo+'</b>';
					//Hacer un llamado a la función para mostrar mensaje de información
				    mensaje_anticipos_devolucion_cuentas_pagar('informacion', strMensaje);

				}
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_anticipos_devolucion_cuentas_pagar tr").length - 2;
			$('#numElementos_detalles_anticipos_devolucion_cuentas_pagar').html(intFilas);
			$('#txtNumDetalles_anticipos_devolucion_cuentas_pagar').val(intFilas);
		}

		//Función para inicializar elementos del detalle
		function inicializar_detalle_ant_relacionados_anticipos_devolucion_cuentas_pagar() 
		{
			//Limpiar las siguientes cajas de texto
			$('#txtReferenciaID_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
			$('#txtReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
			$('#txtFecha_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
		    $('#txtTipoReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
		    $('#txtConcepto_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
		    $('#txtSubtotalAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
		    $('#txtIvaAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
		    $('#txtIepsAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
		    $('#txtImporteTotal_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
		    $('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
		    $('#txtSaldoAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
		}

		
		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_ant_relacionados_anticipos_devolucion_cuentas_pagar(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtReferenciaID_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[8].innerHTML);
			$('#txtReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtTipoReferencia_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[7].innerHTML);
			$('#txtFecha_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtConcepto_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtImporteTotal_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			$('#txtSubtotalAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtIvaAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtIepsAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtSaldoAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);
			//Enfocar caja de texto
			$('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').focus();

		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_ant_relacionados_anticipos_devolucion_cuentas_pagar(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_anticipos_devolucion_cuentas_pagar").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_ant_relacionados_anticipos_devolucion_cuentas_pagar();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_anticipos_devolucion_cuentas_pagar tr").length - 2;
			$('#numElementos_detalles_anticipos_devolucion_cuentas_pagar').html(intFilas);
			$('#txtNumDetalles_anticipos_devolucion_cuentas_pagar').val(intFilas);

		}

		//Función para calcular totales de la tabla
		function calcular_totales_ant_relacionados_anticipos_devolucion_cuentas_pagar()
		{

			//Hacer un llamado a la función para inicializar elementos del detalle
			inicializar_detalle_ant_relacionados_anticipos_devolucion_cuentas_pagar();

			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_anticipos_devolucion_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumTotalAnticipo = 0;
			var intAcumDevolucion = 0;
			var intAcumSaldoAnticipo = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intTotalAnticipo = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intImporte = parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				var intSaldoAnticipo = $.reemplazar(objRen.cells[5].innerHTML, ",", "");

				//Incrementar acumulado
				intAcumTotalAnticipo += parseFloat(intTotalAnticipo);
				intAcumDevolucion += parseFloat(intImporte);
				intAcumSaldoAnticipo += parseFloat(intSaldoAnticipo);
			}

			//Convertir cantidad a formato moneda
			intAcumTotalAnticipo =  '$'+formatMoney(intAcumTotalAnticipo, 2, '');
			intAcumDevolucion =  '$'+formatMoney(intAcumDevolucion, 2, '');
			intAcumSaldoAnticipo =  '$'+formatMoney(intAcumSaldoAnticipo, 2, '');

			//Asignar los valores
			$('#acumTotalAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').html(intAcumTotalAnticipo);
			$('#acumDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').html(intAcumDevolucion);
			$('#acumSaldoAnticipo_ant_relacionados_anticipos_devolucion_cuentas_pagar').html(intAcumSaldoAnticipo);
			$('#monedaDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').html(strMonedaAnticiposDevolucionCuentasPagar);
		}


		/*******************************************************************************************************************
		Funciones del modal Relacionar Documentos (anticipos) de la Devolución
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmRelacionarAntAnticiposDevolucionCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarAntAnticiposDevolucionCuentasPagar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar');
			//Eliminar los datos de la tabla documentos (anticipos) a relacionar
		    $('#dg_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar tbody').empty();
		    $('#numElementos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').html(0);
		    $('#acumSaldo_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').html('$0.00');
		    //Deshabilitar la siguiente caja de texto
			$('#txtRazonSocialBusq_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').attr("disabled", "disabled");
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar();
			//Variables que se utilizan para asignar los datos del registro
			var strEstatus =  $('#txtEstatus_anticipos_devolucion_cuentas_pagar').val();
			var strRazonSocial =  $('#txtRazonSocial_anticipos_devolucion_cuentas_pagar').val();
			var intProspectoID =  $('#txtProspectoID_anticipos_devolucion_cuentas_pagar').val();

			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').addClass("estatus-"+strEstatus);
		    //Asignar los datos del cliente
		    $('#txtProspectoIDBusq_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(intProspectoID);
		    $('#txtRazonSocialBusq_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(strRazonSocial);

			//Abrir modal
			objRelacionarFrasAnticiposDevolucionCuentasPagar = $('#RelacionarAntAnticiposDevolucionCuentasPagarBox').bPopup({
														  appendTo: '#AnticiposDevolucionCuentasPagarContent', 
						                              	  contentContainer: 'AnticiposDevolucionCuentasPagarM', 
						                              	  zIndex: 2, 
						                              	  modalClose: false, 
						                              	  modal: true, 
						                              	  follow: [true,false], 
						                              	  followEasing : "linear", 
						                              	  easing: "linear", 
						                             	  modalColor: ('#F0F0F0')});

			//Hacer un llamado a la función  para cargar las anticipos con saldos en el grid
			lista_anticipos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objRelacionarFrasAnticiposDevolucionCuentasPagar.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar()
		{

			//Hacer un llamado a la función para agregar las anticipos seleccionados al  objeto Anticipos relacionados
			agregar_anticipos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarAntAnticiposDevolucionCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumAnticipos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccionar al menos un anticipo para esta devolución.'
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
			var bootstrapValidator_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar = $('#frmRelacionarAntAnticiposDevolucionCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar();
				//Hacer un llamado a la función para agregar las anticipos en la tabla anticipos relacionados
		  		agregar_ant_relacionados_anticipos_devolucion_cuentas_pagar();
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar()
		{
			try
			{
				$('#frmRelacionarAntAnticiposDevolucionCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar anticipos
		*********************************************************************************************************************/
		//Función para la búsqueda de anticipos
		function lista_anticipos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar() 
		{
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/anticipos/get_anticipos_saldo',
					{	
						intProspectoID: $('#txtProspectoIDBusq_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(), 
						intMonedaID: $('#txtMonedaID_anticipos_devolucion_cuentas_pagar').val()
					},
					function(data){
						$('#dg_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar tbody').empty();
						var tmpRelacionarFrasAnticiposDevolucionCuentasPagar = Mustache.render($('#plantilla_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').html(),data);
						$('#numElementos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').html(data.rows.length);	
						}
						$('#acumSaldo_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').html(data.acumulado_saldo);
						$('#dg_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar tbody').html(tmpRelacionarFrasAnticiposDevolucionCuentasPagar);
					
						
					},
			'json');

			
		}

		//Función para agregar los anticipos seleccionados al objeto Anticipos relacionados
		function agregar_anticipos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar()
		{
			//Variable que se utiliza para asignar la razón social del cliente
			var strRazonSocial =  $('#txtRazonSocialBusq_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').val();
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
		    //Crear instancia del objeto Anticipos relacionados (seleccionados)
			objAntRelacionadosAnticiposDevolucionCuentasPagar = new AntRelacionadosAnticiposDevolucionCuentasPagar([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
					//Crear instancia del objeto Anticipo a relacionar
					objAntRelacionarAnticiposDevolucionCuentasPagar = new AntRelacionarAnticiposDevolucionCuentasPagar(null, '', '', '', '', '',
																	 '', '', '', '', '', '',
																	 '', '', '', '', '');

				
                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.intReferenciaID = strValor;
							        break;
							    case 1:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.strTipoReferencia = strValor;
							        break;
							    case 2:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.intTipoCambio = strValor;
							        break;
							    case 3:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.intSubtotalAnticipo = strValor;
							        break;
							    case 4:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.intTasaCuotaIvaAnticipo = strValor;
							        break;
							    case 5:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.intPorcentajeIvaAnticipo = strValor;
							        break; 
							    case 6:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.intIvaAnticipo = strValor;
							        break;   
							    case 7:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.intTasaCuotaIepsAnticipo = strValor;
							        break;
							    case 8:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.intPorcentajeIepsAnticipo = strValor;
							        break;
							    case 9:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.intIepsAnticipo = strValor;
							        break;
							    case 10:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.strFolio = strValor;
							        break;
							    case 11:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.dteFecha = strValor;
							        break;
							    case 12:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.strConcepto = strValor;
							        break;
							     case 13:
							        objAntRelacionarAnticiposDevolucionCuentasPagar.intTotalAnticipo = strValor;
							        break;
							    case 14:
							     		 objAntRelacionarAnticiposDevolucionCuentasPagar.intDevolucion = strValor;
							     		 objAntRelacionarAnticiposDevolucionCuentasPagar.intSaldoInsoluto = 0;
							     		 //Hacer un llamado a la función para reemplazar ',' por cadena vacia
							       		 strValor = $.reemplazar(strValor, ",", "");
										 objAntRelacionarAnticiposDevolucionCuentasPagar.intSaldoAnticipo = strValor;
							    	break;
							}
							
					      	intCol++;
					    });

                	//Agregar datos del anticipo a relacionar
                	objAntRelacionadosAnticiposDevolucionCuentasPagar.setAnticipo(objAntRelacionarAnticiposDevolucionCuentasPagar);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumAnticipos_relacionar_ant_relacionados_anticipos_devolucion_cuentas_pagar').val(intContador);

		}

		
		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Devolución de Anticipos
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').numeric();
			//Validar campos númericos (solamente valores enteros y positivos)
			$('#txtClienteCuentaBancaria_anticipos_devolucion_cuentas_pagar').numeric({decimal: false, negative: false});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_anticipos_devolucion_cuentas_pagar').blur(function(){
				$('.moneda_anticipos_devolucion_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 2 });
			});


			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_anticipos_devolucion_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
		
			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_anticipos_devolucion_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_anticipos_devolucion_cuentas_pagar').val('');
	               //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_anticipos_devolucion_cuentas_pagar();
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
	             $('#txtProspectoID_anticipos_devolucion_cuentas_pagar').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos del cliente
	              get_datos_cliente_anticipos_devolucion_cuentas_pagar();
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
	        $('#txtRazonSocial_anticipos_devolucion_cuentas_pagar').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_anticipos_devolucion_cuentas_pagar').val() == '' || $('#txtRazonSocial_anticipos_devolucion_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_anticipos_devolucion_cuentas_pagar').val('');
	               $('#txtRazonSocial_anticipos_devolucion_cuentas_pagar').val('');
	               //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_anticipos_devolucion_cuentas_pagar();
                 
	            }
	        });

	        //Autocomplete para recuperar los datos de una cuenta bancaria 
	        $('#txtCuentaBancaria_anticipos_devolucion_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaBancariaID_anticipos_devolucion_cuentas_pagar').val('');
	               //Hacer un llamado a la función para inicializar elementos de la cuenta bancaria
	               inicializar_cuenta_bancaria_anticipos_devolucion_cuentas_pagar();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/cuentas_bancarias/autocomplete",
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
	             $('#txtCuentaBancariaID_anticipos_devolucion_cuentas_pagar').val(ui.item.data);
	             //Hacer un llamado a la función para regresar los datos de la cuenta bancaria
	             get_datos_cuenta_bancaria_anticipos_devolucion_cuentas_pagar();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	      	//Verificar que exista id de la cuenta bancaria cuando pierda el enfoque la caja de texto
	        $('#txtCuentaBancaria_anticipos_devolucion_cuentas_pagar').focusout(function(e){
	            //Si no existe id de la cuenta bancaria
	            if($('#txtCuentaBancariaID_anticipos_devolucion_cuentas_pagar').val() == '' ||
	               $('#txtCuentaBancaria_anticipos_devolucion_cuentas_pagar').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtCuentaBancariaID_anticipos_devolucion_cuentas_pagar').val('');
	                $('#txtCuentaBancaria_anticipos_devolucion_cuentas_pagar').val('');
	                //Hacer un llamado a la función para inicializar elementos de la cuenta bancaria
	                inicializar_cuenta_bancaria_anticipos_devolucion_cuentas_pagar();
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una cuenta bancaria del cliente 
	        $('#txtClienteCuentaBancaria_anticipos_devolucion_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete_cuentas_bancarias",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   intProspectoID: $('#txtProspectoID_anticipos_devolucion_cuentas_pagar').val(),
	                   strDescripcion: request.term
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar valores del registro seleccionado
	             $('#txtClienteBancoID_anticipos_devolucion_cuentas_pagar').val(ui.item.banco_id);
	             $('#txtClienteBanco_anticipos_devolucion_cuentas_pagar').val(ui.item.banco);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        
	        //Autocomplete para recuperar los datos de un banco
	        $('#txtClienteBanco_anticipos_devolucion_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtClienteBancoID_anticipos_devolucion_cuentas_pagar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_bancos/autocomplete",
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
	             $('#txtClienteBancoID_anticipos_devolucion_cuentas_pagar').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del banco cuando pierda el enfoque la caja de texto
	        $('#txtClienteBanco_anticipos_devolucion_cuentas_pagar').focusout(function(e){
	            //Si no existe id del banco
	            if($('#txtClienteBancoID_anticipos_devolucion_cuentas_pagar').val() == '' ||
	               $('#txtClienteBanco_anticipos_devolucion_cuentas_pagar').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtClienteBancoID_anticipos_devolucion_cuentas_pagar').val('');
	                $('#txtClienteBanco_anticipos_devolucion_cuentas_pagar').val('');
	            }
	            
	        });
	 
	        //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });


	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_anticipos_devolucion_cuentas_pagar').on('click','button.btn',function(){
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
	        $('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').focusout(function(e){
	            //Si el importe es un valor negativo
	            if(parseInt($('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').val()) <= 0)
	            { 
	            	//Limpiar caja de texto
	             	$('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
	             	//Enfocar caja de texto
				    $('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').focus();
	            }

	        });

	        
			//Validar que exista importe de la devolución cuando se pulse la tecla enter 
			$('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe importe del pago
		            if($('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').val() == '' ||
	                   parseInt($('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').val()) <= 0)
			   	    {
			   	    	//Limpiar caja de texto
	             		$('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').val('');
			   	   		//Enfocar caja de texto
					    $('#txtDevolucion_ant_relacionados_anticipos_devolucion_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_ant_relacionados_anticipos_devolucion_cuentas_pagar();
			   	    }
		        }
		    });
	       

	        /*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_anticipos_devolucion_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_anticipos_devolucion_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_anticipos_devolucion_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_anticipos_devolucion_cuentas_pagar').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_anticipos_devolucion_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_anticipos_devolucion_cuentas_pagar').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un prospecto 
	        $('#txtRazonSocialBusq_anticipos_devolucion_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_anticipos_devolucion_cuentas_pagar').val('');
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
	             $('#txtProspectoIDBusq_anticipos_devolucion_cuentas_pagar').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_anticipos_devolucion_cuentas_pagar').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_anticipos_devolucion_cuentas_pagar').val() == '' ||
	               $('#txtRazonSocialBusq_anticipos_devolucion_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_anticipos_devolucion_cuentas_pagar').val('');
	               $('#txtRazonSocialBusq_anticipos_devolucion_cuentas_pagar').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_anticipos_devolucion_cuentas_pagar').on('click','a',function(event){
				event.preventDefault();
				intPaginaAnticiposDevolucionCuentasPagar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_anticipos_devolucion_cuentas_pagar();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_anticipos_devolucion_cuentas_pagar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_anticipos_devolucion_cuentas_pagar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_anticipos_devolucion_cuentas_pagar').addClass("estatus-NUEVO");
				//Abrir modal
				 objAnticiposDevolucionCuentasPagar = $('#AnticiposDevolucionCuentasPagarBox').bPopup({
												   appendTo: '#AnticiposDevolucionCuentasPagarContent', 
					                               contentContainer: 'AnticiposDevolucionCuentasPagarM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtRazonSocial_anticipos_devolucion_cuentas_pagar').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_anticipos_devolucion_cuentas_pagar').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_anticipos_devolucion_cuentas_pagar();

		});
	</script>