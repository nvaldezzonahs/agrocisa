	<div id="ClientesCuentasCobrarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_general_clientes_cuentas_cobrar" action="#" method="post" 
				  tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_clientes_cuentas_cobrar" 
								   name="strBusqueda_clientes_cuentas_cobrar"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_clientes_cuentas_cobrar"
										onclick="paginacion_clientes_cuentas_cobrar();" 
										title="Buscar coincidencias" tabindex="1"> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group"> 
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_clientes_cuentas_cobrar"
									onclick="reporte_clientes_cuentas_cobrar('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_clientes_cuentas_cobrar"
									onclick="reporte_clientes_cuentas_cobrar('XLS');" title="Descargar reporte general en XLS" tabindex="1">
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
				Definir columnas de la tabla clientes
				*/
				td.movil.a1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Nombre"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Contacto"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Domicilio"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla documentos
				*/
				td.movil.b1:nth-of-type(1):before {content: "Documento"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla personas autorizadas
				*/
				td.movil.c1:nth-of-type(1):before {content: "Nombre"; font-weight: bold;}
				td.movil.c2:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.c3:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla cuentas bancarias
				*/
				td.movil.d1:nth-of-type(1):before {content: "Cuenta"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Banco"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla referencias
				*/
				td.movil.e1:nth-of-type(1):before {content: "Nombre"; font-weight: bold;}
				td.movil.e2:nth-of-type(2):before {content: "Tipo"; font-weight: bold;}
				td.movil.e3:nth-of-type(3):before {content: "Calificación"; font-weight: bold;}
				td.movil.e4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.e5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_clientes_cuentas_cobrar">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Nombre</th>
							<th class="movil">Contacto</th>
							<th class="movil">Domicilio</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:15em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_clientes_cuentas_cobrar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil a1">{{codigo}}</td>
							<td class="movil a2">{{nombre_comercial}}</td>
							<td class="movil a3">{{contacto_nombre}}</td>
							<td class="movil a4">{{domicilio}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="movil a6 td-center"> 
								<!--Editar datos generales del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_general_clientes_cuentas_cobrar({{prospecto_id}}, '');"  
										title="Datos generales">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
							    <!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_general_clientes_cuentas_cobrar({{prospecto_id}},'');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_clientes_cuentas_cobrar({{prospecto_id}},'');"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Editar datos crediticios del registro-->
								<button class="btn btn-default btn-xs"  
										onclick="editar_credito_clientes_cuentas_cobrar({{prospecto_id}},'');"  
										title="Datos crediticios">
									<span class="fa fa-credit-card"></span>
								</button>
								<!--Expediente del registro-->
								<button class="btn btn-default btn-xs"  
										onclick="abrir_expediente_clientes_cuentas_cobrar({{prospecto_id}},'');"  
										title="Expediente">
									<span class="fa fa-file-text-o"></span>
								</button>
								<!--Personas autorizadas a solicitar y recibir producto -->
								<button class="btn btn-default btn-xs"  
										onclick="abrir_autorizar_clientes_cuentas_cobrar({{prospecto_id}},'');"  
										title="Personas autorizadas a solicitar y recibir producto">
									<span class="fa fa-drivers-license-o"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_general_clientes_cuentas_cobrar({{prospecto_id}},'{{estatus}}','')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_general_clientes_cuentas_cobrar({{prospecto_id}},'{{estatus}}','')"  
										title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_clientes_cuentas_cobrar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_clientes_cuentas_cobrar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Clientes - Datos Generales-->
		<div id="GeneralClientesCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_general_clientes_cuentas_cobrar" class="ModalBodyTitle">
				<h1>Clientes - Datos Generales</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmGeneralClientesCuentasCobrar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmGeneralClientesCuentasCobrar" onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Código-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtProspectoID_general_clientes_cuentas_cobrar" 
										   name="intProspectoID_general_clientes_cuentas_cobrar" 
										   type="hidden" value="">
									</input>
									<label for="txtCodigo_general_clientes_cuentas_cobrar">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_general_clientes_cuentas_cobrar" 
											name="strCodigo_general_clientes_cuentas_cobrar" type="text" value="" 
											placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Razón social-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRazonSocial_general_clientes_cuentas_cobrar">Razón social</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRazonSocial_general_clientes_cuentas_cobrar"
										   name="strRazonSocial_general_clientes_cuentas_cobrar" 
										   type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--RFC-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRfc_general_clientes_cuentas_cobrar">RFC</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRfc_general_clientes_cuentas_cobrar"
										   name="strRfc_general_clientes_cuentas_cobrar" 
										   type="text" value="" tabindex="1" placeholder="Ingrese RFC" maxlength="13">
									</input>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<!--Tipo de persona-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipoPersona_general_clientes_cuentas_cobrar">Tipo de persona</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbTipoPersona_general_clientes_cuentas_cobrar" 
									 		name="strTipoPersona_general_clientes_cuentas_cobrar" tabindex="1">
									    <option value="FISICA">FISICA</option>
	                      				<option value="MORAL">MORAL</option>
	                 				</select>
								</div>
							</div>
						</div>
						<!--Nombre comercial-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									
									<label for="txtNombreComercial_general_clientes_cuentas_cobrar">Nombre comercial</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtNombreComercial_general_clientes_cuentas_cobrar"
										   name="strNombreComercial_general_clientes_cuentas_cobrar" 
										   type="text" value="" tabindex="1" placeholder="Ingrese nombre comercial" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Representante legal-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									
									<label for="txtRepresentanteLegal_general_clientes_cuentas_cobrar">Representante legal</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRepresentanteLegal_general_clientes_cuentas_cobrar"
										   name="strRepresentanteLegal_general_clientes_cuentas_cobrar" 
										   type="text" value="" tabindex="1" placeholder="Ingrese representante legal" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
				    	<!--Autocomplete que contiene los regímenes fiscales activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRegimenFiscal_general_clientes_cuentas_cobrar">Régimen fiscal</label>
								</div>
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del régimen fiscal seleccionado-->
									<input id="txtRegimenFiscalID_general_clientes_cuentas_cobrar" 
										   name="intRegimenFiscalID_general_clientes_cuentas_cobrar"  
										   type="hidden" value="">
								    </input>
									<input  class="form-control" id="txtRegimenFiscal_general_clientes_cuentas_cobrar" 
											name="strRegimenFiscal_general_clientes_cuentas_cobrar" type="text" 
											value="" tabindex="1" placeholder="Ingrese régimen fiscal" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<div class="row">
						<!--Teléfonos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
	              			<!--Div que contiene los campos de los teléfonos-->
	                        <div class="form-group row">
	                            <!--Etiqueta del encabezado-->
	                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
	                                <label for="txtTelefonoPrincipal_general_clientes_cuentas_cobrar">Teléfonos</label>
	                            </div>
	                            <!--Teléfono principal-->
	                            <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
	                                <input  class="form-control" id="txtTelefonoPrincipal_general_clientes_cuentas_cobrar" 
	                                 		name="strTelefonoPrincipal_general_clientes_cuentas_cobrar" 
	                                 		type="text" value="" tabindex="1" placeholder="Principal" maxlength="10">
	                                </input>
	                            </div>
	                            <!--Teléfono secundario-->
	                            <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
	                                <input  class="form-control" id="txtTelefonoSecundario_general_clientes_cuentas_cobrar" 
	                                  		name="strTelefonoSecundario_general_clientes_cuentas_cobrar" 
	                                  		type="text" value="" tabindex="1" placeholder="Secundario" maxlength="10">
	                            	</input>
	                            </div>
	                        </div>
	              		</div>
						<!--Correo electrónico-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCorreoElectronico_general_clientes_cuentas_cobrar">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtCorreoElectronico_general_clientes_cuentas_cobrar"
										   name="strCorreoElectronico_general_clientes_cuentas_cobrar" 
										   type="text" value="" tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
		    			<!--Domicilio-->
	           			<h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Domicilio</h4>
	           			<!--Calle-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCalle_general_clientes_cuentas_cobrar">Calle</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCalle_general_clientes_cuentas_cobrar" 
											name="strCalle_general_clientes_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese calle" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Número exterior-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNumeroExterior_general_clientes_cuentas_cobrar">Número exterior</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNumeroExterior_general_clientes_cuentas_cobrar" 
											name="strNumeroExterior_general_clientes_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese número" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Número interior-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNumeroInterior_general_clientes_cuentas_cobrar">Número interior</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNumeroInterior_general_clientes_cuentas_cobrar" 
											name="strNumeroInterior_general_clientes_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese número" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los códigos postales activos-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del código postal seleccionado-->
									<input id="txtCodigoPostalID_general_clientes_cuentas_cobrar" 
									       name="intCodigoPostalID_general_clientes_cuentas_cobrar" type="hidden" value="">
									</input>
									<label for="txtCodigoPostal_general_clientes_cuentas_cobrar">Código postal</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigoPostal_general_clientes_cuentas_cobrar" 
											name="strCodigoPostal_general_clientes_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese código postal" maxlength="5">
									</input>
								</div>
							</div>
						</div>
	           		</div>
	           		<div class="row">
						<!--Colonia-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtColonia_general_clientes_cuentas_cobrar">Colonia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtColonia_general_clientes_cuentas_cobrar" 
											name="strColonia_general_clientes_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese colonia" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--localidad-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtLocalidad_general_clientes_cuentas_cobrar">Localidad</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtLocalidad_general_clientes_cuentas_cobrar" 
											name="strLocalidad_general_clientes_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese localidad" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Referencia-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtReferencia_general_clientes_cuentas_cobrar">Referencia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtReferencia_general_clientes_cuentas_cobrar" 
											name="strReferencia_general_clientes_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese referencia" maxlength="50">
									</input>
								</div>
							</div>
						</div>
	           		</div>
	           		<div class="row">
						<!--Autocomplete que contiene los municipios activos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del municipio seleccionado-->
									<input id="txtMunicipioID_general_clientes_cuentas_cobrar" 
									       name="intMunicipioID_general_clientes_cuentas_cobrar" type="hidden" value="">
									</input>
									<label for="txtMunicipio_general_clientes_cuentas_cobrar">Municipio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMunicipio_general_clientes_cuentas_cobrar" 
											name="strMunicipio_general_clientes_cuentas_cobrar" type="text" 
											value="" tabindex="1" placeholder="Ingrese municipio" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Estado-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtEstado_general_clientes_cuentas_cobrar">Estado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEstado_general_clientes_cuentas_cobrar" 
											name="strEstado_general_clientes_cuentas_cobrar" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--País-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPais_general_clientes_cuentas_cobrar">País</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPais_general_clientes_cuentas_cobrar" 
											name="strPais_general_clientes_cuentas_cobrar" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
	           		</div>
				    <div class="row">
		    			<!--Datos de contacto-->
	           			<h4 class="col-sm-10 col-md-10 col-lg-10 col-xs-10">Datos de contacto</h4>
	           			<!---Copiar datos del prospecto-->
	                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
	                        <button class="btn btn-copy pull-right" type="button" id="btnCopiar_general_clientes_cuentas_cobrar" onclick="copiar_general_clientes_cuentas_cobrar();" title="Copiar datos del prospecto"><span class="fa fa-files-o"></span></button> 
	                    </div>
	                </div>
	                <div class="row">
	           			<!--Nombre-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtContactoNombre_general_clientes_cuentas_cobrar">Nombre</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtContactoNombre_general_clientes_cuentas_cobrar" 
											name="strContactoNombre_general_clientes_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese nombre" maxlength="250">
									</input>
								</div>
							</div>
						</div>
	           		</div>
	           		<div class="row">
	               		<!--Teléfonos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
	              			<!--Div que contiene los campos de los teléfonos-->
	                        <div class="form-group row">
	                            <!--Etiqueta del encabezado-->
	                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
	                                <label for="txtContactoTelefono_general_clientes_cuentas_cobrar">Teléfonos</label>
	                            </div>
	                            <!--Teléfono de oficina-->
	                            <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
	                                <input  class="form-control" id="txtContactoTelefono_general_clientes_cuentas_cobrar" 
	                                 		name="strContactoTelefono_general_clientes_cuentas_cobrar" 
	                                 		type="text" value="" tabindex="1" placeholder="Oficina" maxlength="10">
	                                </input>
	                            </div>
	                            <!--Celular-->
	                            <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
	                                <input  class="form-control" id="txtContactoCelular_general_clientes_cuentas_cobrar" 
	                                  		name="strContactoCelular_general_clientes_cuentas_cobrar" 
	                                  		type="text" value="" tabindex="1" placeholder="Celular" maxlength="10">
	                            	</input>
	                            </div>
	                        </div>
	              		</div>
	              		<!--Extensión-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtContactoExtension_general_clientes_cuentas_cobrar">Extensión</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtContactoExtension_general_clientes_cuentas_cobrar" 
											name="strContactoExtension_general_clientes_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese extensión" maxlength="5">
									</input>
								</div>
							</div>
						</div>
						<!--Correo electrónico-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtContactoCorreoElectronico_general_clientes_cuentas_cobrar">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtContactoCorreoElectronico_general_clientes_cuentas_cobrar"
										   name="strContactoCorreoElectronico_general_clientes_cuentas_cobrar" 
										   type="text" value="" tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_general_clientes_cuentas_cobrar"  
									onclick="validar_general_clientes_cuentas_cobrar();"  title="Guardar" tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_general_clientes_cuentas_cobrar"  
									onclick="reporte_registro_clientes_cuentas_cobrar('','Datos Generales');"  title="Imprimir registro en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Editar datos crediticios del registro-->
							<button class="btn btn-default" id="btnDatosCrediticios_general_clientes_cuentas_cobrar"  
									onclick="editar_credito_clientes_cuentas_cobrar('','Datos Generales');"  title="Datos crediticios" tabindex="1">
								<span class="fa fa-credit-card"></span>
							</button>
							<!--Expediente del registro-->
							<button class="btn btn-default" id="btnExpediente_general_clientes_cuentas_cobrar"  
									onclick="abrir_expediente_clientes_cuentas_cobrar('', 'Datos Generales');"  title="Expediente" tabindex="1">
								<span class="fa fa-file-text-o"></span>
							</button>
							<!--Personas autorizadas a solicitar y recibir producto del registro-->
							<button class="btn btn-default" id="btnSolicitarRecibirProducto_general_clientes_cuentas_cobrar"  
									onclick="abrir_autorizar_clientes_cuentas_cobrar('', 'Datos Generales');"  title="Personas autorizadas a solicitar y recibir producto" tabindex="1">
								<span class="fa fa-drivers-license-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_general_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_general_clientes_cuentas_cobrar('','ACTIVO','Datos Generales');"  title="Desactivar" tabindex="1">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_general_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_general_clientes_cuentas_cobrar('','INACTIVO','Datos Generales');"  title="Restaurar" tabindex="1">
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_general_clientes_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_general_clientes_cuentas_cobrar();" title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Clientes - Datos Generales-->

		<!-- Diseño del modal Clientes - Datos Crediticios-->
		<div id="CreditoClientesCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_credito_clientes_cuentas_cobrar" class="ModalBodyTitle">
				<h1>Clientes - Datos Crediticios</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_credito_clientes_cuentas_cobrar" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_credito_clientes_cuentas_cobrar" class="active">
									<a data-toggle="tab" href="#informacion_general_credito_clientes_cuentas_cobrar">Información General</a>
								</li>
								<!--Tab que contiene la información de las cuentas bancarias-->
								<li id="tabCuentasBancarias_credito_clientes_cuentas_cobrar">
									<a data-toggle="tab" href="#cuentas_bancarias_credito_clientes_cuentas_cobrar">Cuentas Bancarias</a>
								</li>
								<!--Tab que contiene la información de las referencias-->
								<li id="tabReferencias_credito_clientes_cuentas_cobrar">
									<a data-toggle="tab" href="#referencias_credito_clientes_cuentas_cobrar">Referencias</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmCreditoClientesCuentasCobrar" method="post" action="#" class="form-horizontal" role="form"
					  name="frmCreditoClientesCuentasCobrar"  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_credito_clientes_cuentas_cobrar" class="tab-pane fade in active">
							<div class="row">
								<!--Código-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtProspectoID_credito_clientes_cuentas_cobrar" 
												   name="intProspectoID_credito_clientes_cuentas_cobrar" 
												   type="hidden" value="">
											</input>
											<label for="txtCodigo_credito_clientes_cuentas_cobrar">Código</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigo_credito_clientes_cuentas_cobrar" 
													name="strCodigo_credito_clientes_cuentas_cobrar" type="text" value="" 
													placeholder="Autogenerado" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Razón social-->
								<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRazonSocial_credito_clientes_cuentas_cobrar">Razón social</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRazonSocial_credito_clientes_cuentas_cobrar"
												   name="strRazonSocial_credito_clientes_cuentas_cobrar" 
												   type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Nombre comercial-->
								<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNombreComercial_credito_clientes_cuentas_cobrar">Nombre comercial</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtNombreComercial_credito_clientes_cuentas_cobrar"
												   name="strNombreComercial_credito_clientes_cuentas_cobrar" 
												   type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Solicitud de crédito-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCreditoSolicitud_credito_clientes_cuentas_cobrar">Solicitud de crédito</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtCreditoSolicitud_credito_clientes_cuentas_cobrar"
												   name="strCreditoSolicitud_credito_clientes_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese solicitud de crédito" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Fecha inicio de crédito-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFechaInicioCredito_credito_clientes_cuentas_cobrar">Fecha inicio de crédito</label>
										</div>
										<div class="col-md-12">
											<div class='input-group date' id='dteFechaInicioCredito_credito_clientes_cuentas_cobrar'>
							                    <input class="form-control" id="txtFechaInicioCredito_credito_clientes_cuentas_cobrar"
							                    		name="strFechaInicioCredito_credito_clientes_cuentas_cobrar" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los usos de cfdi activos-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del uso de cfdi seleccionado-->
											<input id="txtUsoCfdiID_credito_clientes_cuentas_cobrar" 
												   name="intUsoCfdiID_credito_clientes_cuentas_cobrar" 
												   type="hidden" value="" />
											<label for="txtUsoCfdi_credito_clientes_cuentas_cobrar">
												Uso del CFDI
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtUsoCfdi_credito_clientes_cuentas_cobrar" 
													name="strUsoCfdi_credito_clientes_cuentas_cobrar" 
													type="text" 
													value=""  
													tabindex="1" 
													placeholder="Ingrese uso del CFDI" 
													maxlength="250" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Días de revisión-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtDiasRevision_credito_clientes_cuentas_cobrar">Días de revisión</label>
										</div>
										<div class="col-md-12">
											<input id="txtDiasRevision_credito_clientes_cuentas_cobrar"
												   class="form-control" 
												   name="strDiasRevision_credito_clientes_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese días de revisión" maxlength="50" />
										</div>
									</div>
								</div>
								<!--Días de pago-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtDiasPago_credito_clientes_cuentas_cobrar">Días de pago</label>
										</div>
										<div class="col-md-12">
											<input id="txtDiasPago_credito_clientes_cuentas_cobrar"
												   class="form-control" 
												   name="strDiasPago_credito_clientes_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese días de pago" maxlength="50" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Encargado de compras-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtEncargadoCompras_credito_clientes_cuentas_cobrar">Encargado de compras</label>
										</div>
										<div class="col-md-12">
											<input 	id="txtEncargadoCompras_credito_clientes_cuentas_cobrar"
													class="form-control" 
												   	name="strEncargadoCompras_credito_clientes_cuentas_cobrar" 
												   	type="text" value="" tabindex="1" placeholder="Ingrese encargado de compras" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Encargado de pagos-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtEncargadoPagos_credito_clientes_cuentas_cobrar">Encargado de pagos</label>
										</div>
										<div class="col-md-12">
											<input 	id="txtEncargadoPagos_credito_clientes_cuentas_cobrar" 
													class="form-control" 
												   	name="strEncargadoPagos_credito_clientes_cuentas_cobrar" 
												   	type="text" value="" tabindex="1" placeholder="Ingrese encargado de pagos" maxlength="250" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Comentarios del crédito-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtComentarios_credito_clientes_cuentas_cobrar">Comentarios</label>
										</div>
										<div class="col-md-12">
											<input 	id="txtComentarios_credito_clientes_cuentas_cobrar"
													class="form-control" 
												   	name="strComentarios_credito_clientes_cuentas_cobrar" 
												   	type="text" value="" tabindex="1" 
												   	placeholder="Ingrese comentarios para el crédito" maxlength="250" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
				    			<!--Maquinaria-->
                       			<h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Maquinaria</h4>
                       			<!--Límite de crédito-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMaquinariaCreditoLimite_credito_clientes_cuentas_cobrar">Límite de crédito</label>
										</div>
										<div class="col-md-12">
											<input class="form-control moneda_clientes_cuentas_cobrar" id="txtMaquinariaCreditoLimite_credito_clientes_cuentas_cobrar"
												   name="intMaquinariaCreditoLimite_credito_clientes_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese límite de crédito" maxlength="23">
											</input>
										</div>
									</div>
								</div>
								<!--Días de crédito-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMaquinariaCreditoDias_credito_clientes_cuentas_cobrar">Días de crédito</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtMaquinariaCreditoDias_credito_clientes_cuentas_cobrar"
												   name="intMaquinariaCreditoDias_credito_clientes_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese días de crédito" maxlength="3">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las listas de precios de maquinaria activas-->
								<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la lista de precios de maquinaria seleccionada-->
											<input id="txtMaquinariaListaPrecioID_credito_clientes_cuentas_cobrar" 
											       name="intMaquinariaListaPrecioID_credito_clientes_cuentas_cobrar" type="hidden" value="">
											</input>
											<label for="txtMaquinariaListaPrecio_credito_clientes_cuentas_cobrar">Lista de precios</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMaquinariaListaPrecio_credito_clientes_cuentas_cobrar" 
													name="strMaquinariaListaPrecio_credito_clientes_cuentas_cobrar" type="text" value="" 
													tabindex="1" placeholder="Ingrese lista de precios" maxlength="250">
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
				    			<!--Refacciones-->
                       			<h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Refacciones</h4>
                       			<!--Límite de crédito-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRefaccionesCreditoLimite_credito_clientes_cuentas_cobrar">Límite de crédito</label>
										</div>
										<div class="col-md-12">
											<input class="form-control moneda_clientes_cuentas_cobrar" id="txtRefaccionesCreditoLimite_credito_clientes_cuentas_cobrar"
												   name="intRefaccionesCreditoLimite_credito_clientes_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese límite de crédito" maxlength="23">
											</input>
										</div>
									</div>
								</div>
								<!--Días de crédito-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRefaccionesCreditoDias_credito_clientes_cuentas_cobrar">Días de crédito</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRefaccionesCreditoDias_credito_clientes_cuentas_cobrar"
												   name="intRefaccionesCreditoDias_credito_clientes_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese días de crédito" maxlength="3">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las listas de precios de refacciones activas-->
								<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la lista de precios de refacciones seleccionada-->
											<input id="txtRefaccionesListaPrecioID_credito_clientes_cuentas_cobrar" 
											       name="intRefaccionesListaPrecioID_credito_clientes_cuentas_cobrar" type="hidden" value="">
											</input>
											<label for="txtRefaccionesListaPrecio_credito_clientes_cuentas_cobrar">Lista de precios</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRefaccionesListaPrecio_credito_clientes_cuentas_cobrar" 
													name="strRefaccionesListaPrecio_credito_clientes_cuentas_cobrar" type="text" value="" 
													tabindex="1" placeholder="Ingrese lista de precios" maxlength="250">
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
				    			<!--Servicio-->
                       			<h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Servicio</h4>
                       			<!--Límite de crédito-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtServicioCreditoLimite_credito_clientes_cuentas_cobrar">Límite de crédito</label>
										</div>
										<div class="col-md-12">
											<input class="form-control moneda_clientes_cuentas_cobrar" id="txtServicioCreditoLimite_credito_clientes_cuentas_cobrar"
												   name="intServicioCreditoLimite_credito_clientes_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese límite de crédito" maxlength="23">
											</input>
										</div>
									</div>
								</div>
								<!--Días de crédito-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtServicioCreditoDias_credito_clientes_cuentas_cobrar">Días de crédito</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtServicioCreditoDias_credito_clientes_cuentas_cobrar"
												   name="intServicioCreditoDias_credito_clientes_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese días de crédito" maxlength="3">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las listas de precios de servicios activas-->
								<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la lista de precios de servicios seleccionada-->
											<input id="txtServicioListaPrecioID_credito_clientes_cuentas_cobrar" 
											       name="intServicioListaPrecioID_credito_clientes_cuentas_cobrar" type="hidden" value="">
											</input>
											<label for="txtServicioListaPrecio_credito_clientes_cuentas_cobrar">Lista de precios</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtServicioListaPrecio_credito_clientes_cuentas_cobrar" 
											name="strServicioListaPrecio_credito_clientes_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese lista de precios" maxlength="250">
											</input>
										</div>
									</div>
								</div>
                       		</div>
						</div><!--Cierre del contenido del tab - Información General-->
						<!--Tab -  Cuentas Bancarias-->
						<div id="cuentas_bancarias_credito_clientes_cuentas_cobrar" class="tab-pane fade">
							<div class="row">
                       			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                            <div id="ToolBtns" class="btn-group" >
		                                <!--Dar de alta un nuevo registro-->
										<button class="btn btn-info" id="btnNuevo_cuentas_bancarias_credito_clientes_cuentas_cobrar" title="Nuevo registro" tabindex="1"> 
											<span class="glyphicon glyphicon-list-alt"></span>
										</button>    
		                            </div>
		                        </div>
                       		</div>
                       		<br>
							<div class="form-group row">
								<!--Tabla con el listado de cuentas bancarias-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_cuentas_bancarias_credito_clientes_cuentas_cobrar">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Cuenta</th>
												<th class="movil">Banco</th>
												<th class="movil">Estatus</th>
												<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_cuentas_bancarias_credito_clientes_cuentas_cobrar" type="text/template"> 
											{{#rows}}
												<tr class="movil {{estiloRegistro}}">  
													<td class="movil d1">{{cuenta}}</td>
													<td class="movil d2">{{banco}}</td>
													<td class="movil d3">{{estatus}}</td>
													<td class="td-center movil d4"> 
														<!--Editar registro-->
														<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
																onclick="editar_cuentas_bancarias_credito_clientes_cuentas_cobrar({{renglon}}, 'id', 'Editar')"  title="Editar">
															<span class="glyphicon glyphicon-edit"></span>
														</button>
														<!--Ver registro-->
						                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
						                            			 onclick="editar_cuentas_bancarias_credito_clientes_cuentas_cobrar({{renglon}},'id','Ver');" title="Ver">
						                            		<span class="glyphicon glyphicon-eye-open"></span>
						                            	</button>
														<!--Desactivar registro-->
														<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
																onclick="cambiar_estatus_cuentas_bancarias_credito_clientes_cuentas_cobrar({{renglon}},'{{estatus}}')" title="Desactivar">
															<span class="glyphicon glyphicon-ban-circle"></span>
														</button>
														<!--Restaurar registro-->
														<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
																onclick="cambiar_estatus_cuentas_bancarias_credito_clientes_cuentas_cobrar({{renglon}},'{{estatus}}')"  title="Restaurar">
															<span class="fa fa-exchange"></span>
														</button>
													</td>
												</tr>
											{{/rows}}
											{{^rows}}
												<tr class="movil"> 
													<td class="movil" colspan="2">No se encontraron resultados.</td>
												</tr> 
											{{/rows}}
										</script>
									</table>
									<br>
									<!--Diseño de la paginación-->
									<div class="row">
										<!--Páginas-->
										<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_cuentas_bancarias_credito_clientes_cuentas_cobrar"></div>
										<!--Número de registros encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_cuentas_bancarias_credito_clientes_cuentas_cobrar">0</strong> encontrados
											</button>
										</div>
									</div><!--Cierre del diseño de la paginación-->
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Cuentas Bancarias-->
						<!--Tab - Referencias-->
						<div id="referencias_credito_clientes_cuentas_cobrar" class="tab-pane fade">
							<div class="row">
                       			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                            <div id="ToolBtns" class="btn-group" >
		                                <!--Dar de alta un nuevo registro-->
										<button class="btn btn-info" id="btnNuevo_referencias_credito_clientes_cuentas_cobrar" title="Nuevo registro" tabindex="1"> 
											<span class="glyphicon glyphicon-list-alt"></span>
										</button>    
		                            </div>
		                        </div>
                       		</div>
                       		<br>
							<div class="form-group row">
								<!--Tabla con el listado de referencias-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_referencias_credito_clientes_cuentas_cobrar">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Nombre</th>
												<th class="movil">Tipo</th>
												<th class="movil">Calificación</th>
												<th class="movil">Estatus</th>
												<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_referencias_credito_clientes_cuentas_cobrar" type="text/template"> 
											{{#rows}}
												<tr class="movil {{estiloRegistro}}">  
													<td class="movil e1">{{nombre}}</td>
													<td class="movil e2">{{tipo}}</td>
													<td class="movil e3">{{calificacion}}</td>
													<td class="movil e4">{{estatus}}</td>
													<td class="td-center movil e5"> 
														<!--Editar registro-->
														<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
																onclick="editar_referencias_credito_clientes_cuentas_cobrar({{renglon}}, 'id', 'Editar')"  title="Editar">
															<span class="glyphicon glyphicon-edit"></span>
														</button>
														<!--Ver registro-->
						                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
						                            			 onclick="editar_referencias_credito_clientes_cuentas_cobrar({{renglon}},'id','Ver');" title="Ver">
						                            		<span class="glyphicon glyphicon-eye-open"></span>
						                            	</button>
														<!--Desactivar registro-->
														<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
																onclick="cambiar_estatus_referencias_credito_clientes_cuentas_cobrar({{renglon}},'{{estatus}}')" title="Desactivar">
															<span class="glyphicon glyphicon-ban-circle"></span>
														</button>
														<!--Restaurar registro-->
														<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
																onclick="cambiar_estatus_referencias_credito_clientes_cuentas_cobrar({{renglon}},'{{estatus}}')"  title="Restaurar">
															<span class="fa fa-exchange"></span>
														</button>
													</td>
												</tr>
											{{/rows}}
											{{^rows}}
												<tr class="movil"> 
													<td class="movil" colspan="2">No se encontraron resultados.</td>
												</tr> 
											{{/rows}}
										</script>
									</table>
									<br>
									<!--Diseño de la paginación-->
									<div class="row">
										<!--Páginas-->
										<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_referencias_credito_clientes_cuentas_cobrar"></div>
										<!--Número de registros encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_referencias_credito_clientes_cuentas_cobrar">0</strong> encontrados
											</button>
										</div>
									</div><!--Cierre del diseño de la paginación-->
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Referencias-->
					</div><!--Cierre del contenedor de tabs-->
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_credito_clientes_cuentas_cobrar"  
									onclick="modificar_credito_clientes_cuentas_cobrar();"  title="Guardar" tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Editar datos generales del registro-->
							<button class="btn btn-default" id="btnDatosGenerales_credito_clientes_cuentas_cobrar"  
									onclick="editar_general_clientes_cuentas_cobrar('','Datos Crediticios');"  title="Datos generales" tabindex="1">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_credito_clientes_cuentas_cobrar"  
									onclick="reporte_registro_clientes_cuentas_cobrar('','Datos Crediticios');"  title="Imprimir registro en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Expediente del registro-->
							<button class="btn btn-default" id="btnExpediente_credito_clientes_cuentas_cobrar"  
									onclick="abrir_expediente_clientes_cuentas_cobrar('', 'Datos Crediticios');"  title="Expediente" tabindex="1">
								<span class="fa fa-file-text-o"></span>
							</button>
							<!--Personas autorizadas a solicitar y recibir producto del registro-->
							<button class="btn btn-default" id="btnSolicitarRecibirProducto_credito_clientes_cuentas_cobrar"  
									onclick="abrir_autorizar_clientes_cuentas_cobrar('', 'Datos Crediticios');"  title="Personas autorizadas a solicitar y recibir producto" tabindex="1">
								<span class="fa fa-drivers-license-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_credito_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_general_clientes_cuentas_cobrar('','ACTIVO','Datos Crediticios');"  title="Desactivar" tabindex="1">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_credito_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_general_clientes_cuentas_cobrar('','INACTIVO','Datos Crediticios');"  title="Restaurar" tabindex="1">
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_credito_clientes_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_credito_clientes_cuentas_cobrar();" title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Clientes - Datos Crediticios-->

		<!-- Diseño del modal Cuentas Bancarias-->
		<div id="CuentasBancariasCreditoClientesCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_cuentas_bancarias_credito_clientes_cuentas_cobrar"  class="ModalBodyTitle">
			<h1>Cuentas Bancarias</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCuentasBancariasCreditoClientesCuentasCobrar" method="post" action="#" class="form-horizontal" role="form" name="frmCuentasBancariasCreditoClientesCuentasCobrar" 
					  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Cuenta-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
									<input id="txtRenglon_cuentas_bancarias_credito_clientes_cuentas_cobrar" name="cuentas_bancarias_credito_clientes_cuentas_cobrar"  
										   type="hidden" value="">
									<!-- Caja de texto oculta que se utiliza para recuperar la cuenta anterior y así evitar duplicidad en caso de que exista otro registro con la misma cuenta-->
									<input id="txtCuentaAnterior_cuentas_bancarias_credito_clientes_cuentas_cobrar" 
										   name="strCuentaAnterior_cuentas_bancarias_credito_clientes_cuentas_cobrar" type="hidden" value="">
									</input>
									<label for="txtCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar">Cuenta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar" 
											name="strCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese cuenta" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los bancos activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del banco seleccionado-->
									<input id="txtBancoID_cuentas_bancarias_credito_clientes_cuentas_cobrar" 
										   name="intBancoID_cuentas_bancarias_credito_clientes_cuentas_cobrar"  
										   type="hidden" value="">
									</input>
									<label for="txtBanco_cuentas_bancarias_credito_clientes_cuentas_cobrar">Banco</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtBanco_cuentas_bancarias_credito_clientes_cuentas_cobrar" 
											name="strBanco_cuentas_bancarias_credito_clientes_cuentas_cobrar" type="text" value="" tabindex="1" placeholder="Ingrese banco" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_cuentas_bancarias_credito_clientes_cuentas_cobrar"  
									onclick="validar_cuentas_bancarias_credito_clientes_cuentas_cobrar();" title="Guardar" tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_cuentas_bancarias_credito_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_cuentas_bancarias_credito_clientes_cuentas_cobrar('','ACTIVO');"  title="Desactivar" tabindex="1">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_cuentas_bancarias_credito_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_cuentas_bancarias_credito_clientes_cuentas_cobrar('','INACTIVO');"  title="Restaurar" tabindex="1">
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar" id="btnCerrar_cuentas_bancarias_credito_clientes_cuentas_cobrar" type="reset" aria-hidden="true" 
									onclick="cerrar_cuentas_bancarias_credito_clientes_cuentas_cobrar();" title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cuentas Bancarias-->

		<!-- Diseño del modal Referencias-->
		<div id="ReferenciasCreditoClientesCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_referencias_credito_clientes_cuentas_cobrar"  class="ModalBodyTitle">
			<h1>Referencias</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmReferenciasCreditoClientesCuentasCobrar" method="post" action="#" class="form-horizontal" role="form" name="frmReferenciasCreditoClientesCuentasCobrar" 
					  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Nombre-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
									<input id="txtRenglon_referencias_credito_clientes_cuentas_cobrar" name="intRenglon_referencias_credito_clientes_cuentas_cobrar"  
										   type="hidden" value="">
									<!-- Caja de texto oculta que se utiliza para recuperar el nombre anterior y así evitar duplicidad en caso de que exista otro registro con el mismo nombre-->
									<input id="txtNombreAnterior_referencias_credito_clientes_cuentas_cobrar" 
										   name="strNombreAnterior_referencias_credito_clientes_cuentas_cobrar" type="hidden" value="">
									</input>
									<label for="txtNombre_referencias_credito_clientes_cuentas_cobrar">Nombre</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNombre_referencias_credito_clientes_cuentas_cobrar" 
											name="strNombre_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese nombre" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Contacto-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtContacto_referencias_credito_clientes_cuentas_cobrar">Contacto</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtContacto_referencias_credito_clientes_cuentas_cobrar" 
											name="strContacto_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese contacto" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Teléfono-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTelefono_referencias_credito_clientes_cuentas_cobrar">Teléfono</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTelefono_referencias_credito_clientes_cuentas_cobrar" 
											name="strTelefono_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese teléfono" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Extensión-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtExtension_referencias_credito_clientes_cuentas_cobrar">Extensión</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtExtension_referencias_credito_clientes_cuentas_cobrar" 
											name="strExtension_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese extensión" maxlength="5">
									</input>
								</div>
							</div>
						</div>
						<!--Calificación-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCalificacion_referencias_credito_clientes_cuentas_cobrar">Calificación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCalificacion_referencias_credito_clientes_cuentas_cobrar" 
										    name="strCalificacion_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese calificación" maxlength="20">
									</input>
								</div>
							</div>
						</div>
						<!--Tipo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipo_referencias_credito_clientes_cuentas_cobrar">Tipo</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbTipo_referencias_credito_clientes_cuentas_cobrar" 
									 		name="strTipo_referencias_credito_clientes_cuentas_cobrar" tabindex="1">
                          				<option value="BANCARIA">BANCARIA</option>
                          				<option value="COMERCIAL">COMERCIAL</option>
                     				</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Cliente desde-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtClienteDesde_referencias_credito_clientes_cuentas_cobrar">¿Desde cuando es su cliente?</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtClienteDesde_referencias_credito_clientes_cuentas_cobrar" 
											name="strClienteDesde_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese respuesta" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Maneja crédito-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbManejaCredito_referencias_credito_clientes_cuentas_cobrar">¿Maneja crédito con usted?</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbManejaCredito_referencias_credito_clientes_cuentas_cobrar" 
									 		name="strManejaCredito_referencias_credito_clientes_cuentas_cobrar" tabindex="1">
                          				<option value="SI">SI</option>
                          				<option value="NO">NO</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Importe del crédito-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteCredito_referencias_credito_clientes_cuentas_cobrar">Importe</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_clientes_cuentas_cobrar" id="txtImporteCredito_referencias_credito_clientes_cuentas_cobrar" 
												name="intImporteCredito_referencias_credito_clientes_cuentas_cobrar" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="15">
										</input>
									</div>
								</div>
							</div>
						</div>
						<!--Plazo del crédito-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPlazoCredito_referencias_credito_clientes_cuentas_cobrar">Plazo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPlazoCredito_referencias_credito_clientes_cuentas_cobrar" 
											name="intPlazoCredito_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese plazo" maxlength="3">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--forma de pago-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFormaPago_referencias_credito_clientes_cuentas_cobrar">Forma de pago</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFormaPago_referencias_credito_clientes_cuentas_cobrar" 
											name="strFormaPago_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese forma de pago" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Cheque sin fondos-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbChequeSinFondos_referencias_credito_clientes_cuentas_cobrar">¿Ha dado cheque sin fondos?</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbChequeSinFondos_referencias_credito_clientes_cuentas_cobrar" 
									 		name="strChequeSinFondos_referencias_credito_clientes_cuentas_cobrar" tabindex="1">
									 	<option value="NO">NO</option>
                          				<option value="SI">SI</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Atrasos-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbAtrasos_referencias_credito_clientes_cuentas_cobrar">¿Ha presentado atrasos?</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbAtrasos_referencias_credito_clientes_cuentas_cobrar" 
									 		name="strAtrasos_referencias_credito_clientes_cuentas_cobrar" tabindex="1">
									 	<option value="NO">NO</option>
                          				<option value="SI">SI</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Garantía Adicional-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbGarantiaAdicional_referencias_credito_clientes_cuentas_cobrar">¿Requiere garantía adicional?</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbGarantiaAdicional_referencias_credito_clientes_cuentas_cobrar" 
									 		name="strGarantiaAdicional_referencias_credito_clientes_cuentas_cobrar" tabindex="1">
									 	<option value="NO">NO</option>
                          				<option value="SI">SI</option>
                     				</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Experiencia general-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtExperienciaGeneral_referencias_credito_clientes_cuentas_cobrar">Experiencia general</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtExperienciaGeneral_referencias_credito_clientes_cuentas_cobrar" 
											name="strExperienciaGeneral_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese experiencia general" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Tipo de servicio-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoServicio_referencias_credito_clientes_cuentas_cobrar">Tipo de servicios o productos que le ofrece</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTipoServicio_referencias_credito_clientes_cuentas_cobrar" 
											name="strTipoServicio_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese tipo de servicios o productos que le ofrece" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Comentarios-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtComentarios_referencias_credito_clientes_cuentas_cobrar">Comentarios</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtComentarios_referencias_credito_clientes_cuentas_cobrar" 
											name="strComentarios_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese comentarios" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Nombre de quien proporciona la referencia-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNombreReferencia_referencias_credito_clientes_cuentas_cobrar">Nombre de quien proporciona la referencia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNombreReferencia_referencias_credito_clientes_cuentas_cobrar" 
											name="strNombreReferencia_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese nombre" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Puesto-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPuestoReferencia_referencias_credito_clientes_cuentas_cobrar">Puesto</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPuestoReferencia_referencias_credito_clientes_cuentas_cobrar" 
											name="strPuestoReferencia_referencias_credito_clientes_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese puesto" maxlength="50">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_referencias_credito_clientes_cuentas_cobrar"  
									onclick="validar_referencias_credito_clientes_cuentas_cobrar();" title="Guardar" tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_referencias_credito_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_referencias_credito_clientes_cuentas_cobrar('','ACTIVO');"  title="Desactivar" tabindex="1">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_referencias_credito_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_referencias_credito_clientes_cuentas_cobrar('','INACTIVO');"  title="Restaurar" tabindex="1">
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar" id="btnCerrar_referencias_credito_clientes_cuentas_cobrar" type="reset" aria-hidden="true" 
									onclick="cerrar_referencias_credito_clientes_cuentas_cobrar();" title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Referencias-->

		<!-- Diseño del modal Clientes - Expediente-->
		<div id="ExpedienteClientesCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_expediente_clientes_cuentas_cobrar" class="ModalBodyTitle">
				<h1>Clientes - Expediente</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmExpedienteClientesCuentasCobrar" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmExpedienteClientesCuentasCobrar" onsubmit="return(false)" autocomplete="off">
				    <div class="row">
						<!--Código-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtProspectoID_expediente_clientes_cuentas_cobrar" 
										   name="intProspectoID_expediente_clientes_cuentas_cobrar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
									<input id="txtEstatus_expediente_clientes_cuentas_cobrar" 
										   name="strEstatus_expediente_clientes_cuentas_cobrar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el tipo de persona del registro seleccionado-->
									<input id="txtTipoPersona_expediente_clientes_cuentas_cobrar" 
										   name="strTipoPersona_expediente_clientes_cuentas_cobrar" 
										   type="hidden" value="">
									</input>
									<label for="txtCodigo_expediente_clientes_cuentas_cobrar">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_expediente_clientes_cuentas_cobrar" 
											name="strCodigo_expediente_clientes_cuentas_cobrar" type="text" value="" 
											placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Razón social-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRazonSocial_expediente_clientes_cuentas_cobrar">Razón social</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRazonSocial_expediente_clientes_cuentas_cobrar"
										   name="strRazonSocial_expediente_clientes_cuentas_cobrar" 
										   type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Nombre comercial-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNombreComercial_expediente_clientes_cuentas_cobrar">Nombre comercial</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtNombreComercial_expediente_clientes_cuentas_cobrar"
										   name="strNombreComercial_expediente_clientes_cuentas_cobrar" 
										   type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<!--Tabla con el listado de documentos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_expediente_clientes_cuentas_cobrar">
								<thead class="movil">
									<tr class="movil">
										<th class="movil">Documento</th>
										<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
									</tr>
								</thead>
								<tbody class="movil"></tbody>
								<script id="plantilla_expediente_clientes_cuentas_cobrar" type="text/template"> 
									{{#rows}}
										<tr class="movil">
											<td class="movil b1">{{descripcion}}</td>
											<td class="td-center movil b2"> 
												<!--Subir archivo-->
												<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
													<span class="btn  btn-default btn-xs fileinput-button ">
												    	<span class="fa fa-upload"></span>
														<input type="file" name="archivo_clientes_cuentas_cobrar{{documento_cliente_id}}" id="archivo_clientes_cuentas_cobrar{{documento_cliente_id}}"  
															   onchange="subir_archivo_expediente_clientes_cuentas_cobrar({{documento_cliente_id}})">
												  		</input>
												    </span>
												</span>
				                            	<!--Descargar archivo-->
				                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
				                            			 onmousedown="descargar_archivo_expediente_clientes_cuentas_cobrar({{documento_cliente_id}})" title="Descargar archivo">
				                            		<span class="glyphicon glyphicon-download-alt"></span>
				                            	</button>
				                            	<!--Eliminar archivo-->
												<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}"  
														onclick="eliminar_archivo_expediente_clientes_cuentas_cobrar({{documento_cliente_id}})"  title="Eliminar archivo">
													<span class="glyphicon glyphicon-export"></span>
												</button>
											</td>
										</tr>
									{{/rows}}
									{{^rows}}
										<tr class="movil"> 
											<td class="movil" colspan="2">No se encontraron resultados.</td>
										</tr> 
									{{/rows}}
								</script>
							</table>
							<br>
							<div class="row">
								<!--Número de registros encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<button class="btn btn-default btn-sm disabled pull-right">
										<strong id="numElementos_expediente_clientes_cuentas_cobrar">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Editar datos generales del registro-->
							<button class="btn btn-default" id="btnDatosGenerales_expediente_clientes_cuentas_cobrar"  
									onclick="editar_general_clientes_cuentas_cobrar('','Expediente');"  title="Datos generales" tabindex="1">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_expediente_clientes_cuentas_cobrar"  
									onclick="reporte_registro_clientes_cuentas_cobrar('','Expediente');"  title="Imprimir registro en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Editar datos crediticios del registro-->
							<button class="btn btn-default" id="btnDatosCrediticios_expediente_clientes_cuentas_cobrar"  
									onclick="editar_credito_clientes_cuentas_cobrar('','Expediente');"  title="Datos crediticios" tabindex="1">
								<span class="fa fa-credit-card"></span>
							</button>
							<!--Personas autorizadas a solicitar y recibir producto del registro-->
							<button class="btn btn-default" id="btnSolicitarRecibirProducto_expediente_clientes_cuentas_cobrar"  
									onclick="abrir_autorizar_clientes_cuentas_cobrar('', 'Expediente');"  title="Personas autorizadas a solicitar y recibir producto" tabindex="1">
								<span class="fa fa-drivers-license-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_expediente_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_general_clientes_cuentas_cobrar('','ACTIVO','Expediente');"  title="Desactivar" tabindex="1">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_expediente_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_general_clientes_cuentas_cobrar('','INACTIVO','Expediente');"  title="Restaurar" tabindex="1">
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_expediente_clientes_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_expediente_clientes_cuentas_cobrar();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Clientes - Expediente-->

		<!-- Diseño del modal Clientes - Personas Autorizadas para Solicitar y Recibir-->
		<div id="PersonasAutorizadasSolicitarRecibirClientesCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_personas_autorizadas_clientes_cuentas_cobrar" class="ModalBodyTitle">
				<h1>Clientes - Personas autorizadas a solicitar y recibir producto</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmPersonasAutorizadasSolicitarRecibirClientesCuentasCobrar" 
					  method="post" 
					  action="#" 
					  class="form-horizontal" 
					  role="form" 
					  name="frmPersonasAutorizadasSolicitarRecibirClientesCuentasCobrar" 
					  onsubmit="return(false)" 
					  autocomplete="off">
				    
				    <div class="row">
						<!--Código-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar" 
										   name="intProspectoID_personas_autorizadas_clientes_cuentas_cobrar" 
										   type="hidden" value="">
									</input>
									<label for="txtCodigo_personas_autorizadas_clientes_cuentas_cobrar">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_personas_autorizadas_clientes_cuentas_cobrar" 
											name="strCodigo_personas_autorizadas_clientes_cuentas_cobrar" type="text" value="" 
											placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Razón social-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRazonSocial_personas_autorizadas_clientes_cuentas_cobrar">Razón social</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRazonSocial_personas_autorizadas_clientes_cuentas_cobrar"
										   name="strRazonSocial_personas_autorizadas_clientes_cuentas_cobrar" 
										   type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Nombre comercial-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNombreComercial_personas_autorizadas_clientes_cuentas_cobrar">Nombre comercial</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtNombreComercial_personas_autorizadas_clientes_cuentas_cobrar"
										   name="strNombreComercial_personas_autorizadas_clientes_cuentas_cobrar" 
										   type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
					</div>
				    <!--Personas autorizadas a solicitar y recibir producto-->
					<div class="row">
						<div class="col-sm-8 col-md-8 col-lg-8 col-xs-10">
	               			<h4>Personas autorizadas</h4>
	           			</div>
	           			<div class="col-sm-4 col-md-4 col-lg-4 col-xs-2">
	                        <div id="ToolBtns" class="btn-group" >
	                            <!--Dar de alta un nuevo registro-->
								<button class="btn btn-info" id="btnNuevo_personas_autorizadas_clientes_cuentas_cobrar" title="Nuevo registro" tabindex="1"> 
									<span class="glyphicon glyphicon-list-alt"></span>
								</button>    
	                        </div>
	                    </div>
	           		</div>
	           		<br>
					<div class="form-group row">
						<!--Tabla con el listado de referencias-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_personas_autorizadas_clientes_cuentas_cobrar">
								<thead class="movil">
									<tr class="movil">
										<th class="movil">Nombre</th>
										<th class="movil">Estatus</th>
										<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
									</tr>
								</thead>
								<tbody class="movil"></tbody>
								<script id="plantilla_personas_autorizadas_clientes_cuentas_cobrar" type="text/template"> 
									{{#rows}}
										<tr class="movil {{estiloRegistro}}">  
											<td class="movil c1">{{nombre}}</td>
											<td class="movil c2">{{estatus}}</td>
											<td class="td-center movil c3"> 
												<!--Editar registro-->
												<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
														onclick="editar_registro_personas_autorizadas_clientes_cuentas_cobrar({{renglon}}, 'id', 'Editar')"  title="Editar">
													<span class="glyphicon glyphicon-edit"></span>
												</button>
												<!--Ver registro-->
				                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
				                            			 onclick="editar_registro_personas_autorizadas_clientes_cuentas_cobrar({{renglon}},'id','Ver');" title="Ver">
				                            		<span class="glyphicon glyphicon-eye-open"></span>
				                            	</button>
												<!--Descargar archivo IFE-->
				                            	<button class="btn btn-default btn-xs {{mostrarAccionVerIFE}}" 
				                            			 onmousedown="descargar_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar({{renglon}},'ife')" title="Descargar IFE">
				                            		<span class="glyphicon glyphicon-download-alt"></span>
				                            	</button>
				                            	<!--Descargar archivo Carta-->
				                            	<button class="btn btn-default btn-xs {{mostrarAccionVerCarta}}" 
				                            			 onmousedown="descargar_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar({{renglon}}, 'carta')" title="Descargar Carta">
				                            		<span class="glyphicon glyphicon-download-alt"></span>
				                            	</button>
												<!--Desactivar registro-->
												<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
														onclick="cambiar_estatus_registro_personas_autorizadas_clientes_cuentas_cobrar({{renglon}},'{{estatus}}')" title="Desactivar">
													<span class="glyphicon glyphicon-ban-circle"></span>
												</button>
												<!--Restaurar registro-->
												<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
														onclick="cambiar_estatus_registro_personas_autorizadas_clientes_cuentas_cobrar({{renglon}},'{{estatus}}')"  title="Restaurar">
													<span class="fa fa-exchange"></span>
												</button>
											</td>
										</tr>
									{{/rows}}
									{{^rows}}
										<tr class="movil"> 
											<td class="movil" colspan="2">No se encontraron resultados.</td>
										</tr> 
									{{/rows}}
								</script>
							</table>
							<br>
							<!--Diseño de la paginación-->
							<div class="row">
								<!--Páginas-->
								<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_personas_autorizadas_clientes_cuentas_cobrar"></div>
								<!--Número de registros encontrados-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<button class="btn btn-default btn-sm disabled pull-right">
										<strong id="numElementos_personas_autorizadas_clientes_cuentas_cobrar">0</strong> encontrados
									</button>
								</div>
							</div><!--Cierre del diseño de la paginación-->
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Editar datos generales del registro-->
							<button class="btn btn-default" id="btnDatosGenerales_personas_autorizadas_clientes_cuentas_cobrar"  
									onclick="editar_general_clientes_cuentas_cobrar('','Personas autorizadas');"  title="Datos generales" tabindex="1">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_personas_autorizadas_clientes_cuentas_cobrar"  
									onclick="reporte_registro_clientes_cuentas_cobrar('','Personas autorizadas');"  title="Imprimir registro en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Editar datos crediticios del registro-->
							<button class="btn btn-default" id="btnDatosCrediticios_personas_autorizadas_clientes_cuentas_cobrar"  
									onclick="editar_credito_clientes_cuentas_cobrar('','Personas autorizadas');"  title="Datos crediticios" tabindex="1">
								<span class="fa fa-credit-card"></span>
							</button>
							<!--Expediente del registro-->
							<button class="btn btn-default" id="btnExpediente_personas_autorizadas_clientes_cuentas_cobrar"  
									onclick="abrir_expediente_clientes_cuentas_cobrar('', 'Personas autorizadas');"  title="Expediente" tabindex="1">
								<span class="fa fa-file-text-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_personas_autorizadas_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_general_clientes_cuentas_cobrar('','ACTIVO', 'Personas autorizadas');"  title="Desactivar" tabindex="1">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_personas_autorizadas_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_general_clientes_cuentas_cobrar('','INACTIVO', 'Personas autorizadas');"  title="Restaurar" tabindex="1">
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_personas_autorizadas_clientes_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_autorizar_clientes_cuentas_cobrar();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Clientes - Personas Autorizadas para Solicitar y Recibir-->

		<!-- Diseño del modal Personas Autorizadas-->
		<div id="RegistroPersonasAutorizadasCreditoClientesCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_registro_personas_autorizadas_clientes_cuentas_cobrar"  class="ModalBodyTitle">
			<h1>Personas Autorizadas</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRegistroPersonasAutorizadasCreditoClientesCuentasCobrar" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmRegistroPersonasAutorizadasCreditoClientesCuentasCobrar" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Nombre-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza guardar el estatus-->
									<input id="txtEstatus_general_clientes_cuentas_cobrar" name="strEstatus_general_clientes_cuentas_cobrar"  
										   type="hidden" value="">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
									<input id="txtRenglon_registro_personas_autorizadas_clientes_cuentas_cobrar" name="intRenglon_registro_personas_autorizadas_clientes_cuentas_cobrar"  
										   type="hidden" value="">
									<!-- Caja de texto oculta que se utiliza para recuperar el nombre anterior y así evitar duplicidad en caso de que exista otro registro con el mismo nombre-->
									<input id="txtNombreAnterior_registro_personas_autorizadas_clientes_cuentas_cobrar" 
										   name="strNombreAnterior_registro_personas_autorizadas_clientes_cuentas_cobrar" type="hidden" value="">
									</input>
									<label for="txtNombre_registro_personas_autorizadas_clientes_cuentas_cobrar">Nombre</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNombre_registro_personas_autorizadas_clientes_cuentas_cobrar" 
											name="strNombre_registro_personas_autorizadas_clientes_cuentas_cobrar" type="text" value="" 
											tabindex="1" placeholder="Ingrese nombre" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div id="ToolBtns" class="btn-group btn-toolBtns">
		                        <!--Subir archivo IFE-->
			                    <span  class="fileupload-buttonbar" tabindex="1">
			                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntarIFE_registro_personas_autorizadas_clientes_cuentas_cobrar">
			                        	<span class="fa fa-upload"> IFE</span>
			                        	<input id="ife_registro_personas_autorizadas_clientes_cuentas_cobrar" 
			                        		   name="ife_registro_personas_autorizadas_clientes_cuentas_cobrar" type="file"  
			                        		   onchange="subir_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar('ife', 'Editar');">
			                        	</input>
			                        </span>
			                    </span>
		                         <!--Subir archivo Carta-->
		                        <span  class="fileupload-buttonbar" tabindex="1">
			                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntarCarta_registro_personas_autorizadas_clientes_cuentas_cobrar">
			                        	<span class="fa fa-upload"> Carta</span>
			                        	<input id="carta_registro_personas_autorizadas_clientes_cuentas_cobrar" 
			                        		   name="carta_registro_personas_autorizadas_clientes_cuentas_cobrar" type="file"  
			                        		   onchange="subir_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar('carta', 'Editar');">
			                        	</input>
			                        </span>
			                    </span>
		                    </div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_registro_personas_autorizadas_clientes_cuentas_cobrar"  
									onclick="validar_registro_personas_autorizadas_clientes_cuentas_cobrar();"  title="Guardar" tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Descargar archivo IFE-->
		                    <button class="btn btn-default" id="btnDescargarArchivoIFE_registro_personas_autorizadas_clientes_cuentas_cobrar"  
									onclick="descargar_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar('','ife');"  title="Descargar IFE" tabindex="1">
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Descargar archivo Carta-->
		                    <button class="btn btn-default" id="btnDescargarArchivoCarta_registro_personas_autorizadas_clientes_cuentas_cobrar"  
									onclick="descargar_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar('','carta');"  title="Descargar Carta" tabindex="1">
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_registro_personas_autorizadas_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_registro_personas_autorizadas_clientes_cuentas_cobrar('','ACTIVO');"  title="Desactivar" tabindex="1">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_registro_personas_autorizadas_clientes_cuentas_cobrar"  
									onclick="cambiar_estatus_registro_personas_autorizadas_clientes_cuentas_cobrar('','INACTIVO');"  title="Restaurar" tabindex="1">
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_registro_personas_autorizadas_clientes_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_registro_personas_autorizadas_clientes_cuentas_cobrar();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Personas Autorizadas-->
	</div><!--#ClientesCuentasCobrarContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de clientes
		var intPaginaClientesCuentasCobrar = 0;
		var strUltimaBusquedaClientesCuentasCobrar = "";
		//Variables que se utilizan para la paginación de cuentas bancarias
		var intPaginaCuentasBancariasCreditoClientesCuentasCobrar = 0;
		//Variables que se utilizan para la paginación de referencias
		var intPaginaReferenciasCreditoClientesCuentasCobrar = 0;
		//Variables que se utilizan para la paginación de personas autorizadas
		var intPaginaPersonasAutorizadasCreditoClientesCuentasCobrar = 0;
		//Variable que se utiliza para asignar objeto del modal Clientes - Datos Generales
		var objGeneralClientesCuentasCobrar = null;
	    //Variable que se utiliza para asignar objeto del modal Clientes - Datos Crediticios
		var objCreditoClientesCuentasCobrar = null;
		//Variable que se utiliza para asignar objeto del modal Cuentas Bancarias
		var objCuentasBancariasCreditoClientesCuentasCobrar = null;
		//Variable que se utiliza para asignar objeto del modal Referencias
		var objReferenciasCreditoClientesCuentasCobrar = null;
		 //Variable que se utiliza para asignar objeto del modal Clientes - Expediente
		var objExpedienteClientesCuentasCobrar = null;
		//Variable que se utiliza para asignar objeto del modal Personas Autorizadas
		var objPersonasAutorizadasCreditoClientesCuentasCobrar = null;
		//Variable que se utiliza para asignar objeto del modal Agregar Registro de Personas Autorizadas
		var objRegistroPersonasAutorizadasCreditoClientesCuentasCobrar = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_clientes_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_cobrar/clientes/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_clientes_cuentas_cobrar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosClientesCuentasCobrar = data.row;
					//Separar la cadena 
					var arrPermisosClientesCuentasCobrar = strPermisosClientesCuentasCobrar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosClientesCuentasCobrar.length; i++)
					{
						
						//Si el indice es ADJUNTAR
						if(arrPermisosClientesCuentasCobrar[i]=='ADJUNTAR')
						{
							//Habilitar el control (botón Adjuntar)
							$('#btnAdjuntarIFE_personas_autorizadas_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnAdjuntarCarta_personas_autorizadas_clientes_cuentas_cobrar').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosClientesCuentasCobrar[i]=='VER REGISTRO')
						{
							//Habilitar los siguientes controles
							$('#btnDescargarArchivoIFE_personas_autorizadas_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnDescargarArchivoCarta_personas_autorizadas_clientes_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosClientesCuentasCobrar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_clientes_cuentas_cobrar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_clientes_cuentas_cobrar();
						}
						else if(arrPermisosClientesCuentasCobrar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_general_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnRestaurar_general_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnDesactivar_credito_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnRestaurar_credito_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnDesactivar_personas_autorizadas_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnRestaurar_personas_autorizadas_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnDesactivar_cuentas_bancarias_credito_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnRestaurar_cuentas_bancarias_credito_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnDesactivar_referencias_credito_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnRestaurar_referencias_credito_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnDesactivar_expediente_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnRestaurar_expediente_clientes_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosClientesCuentasCobrar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_clientes_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosClientesCuentasCobrar[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_general_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnImprimirRegistro_credito_clientes_cuentas_cobrar').removeAttr('disabled');
							$('#btnImprimirRegistro_expediente_clientes_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosClientesCuentasCobrar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_clientes_cuentas_cobrar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_clientes_cuentas_cobrar() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_clientes_cuentas_cobrar').val() != strUltimaBusquedaClientesCuentasCobrar)
			{
				intPaginaClientesCuentasCobrar = 0;
				strUltimaBusquedaClientesCuentasCobrar = $('#txtBusqueda_clientes_cuentas_cobrar').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/clientes/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_clientes_cuentas_cobrar').val(),
						intPagina:intPaginaClientesCuentasCobrar,
						strPermisosAcceso: $('#txtAcciones_clientes_cuentas_cobrar').val()
					},
					function(data){
						$('#dg_clientes_cuentas_cobrar tbody').empty();
						var tmpClientesCuentasCobrar = Mustache.render($('#plantilla_clientes_cuentas_cobrar').html(),data);
						$('#dg_clientes_cuentas_cobrar tbody').html(tmpClientesCuentasCobrar);
						$('#pagLinks_clientes_cuentas_cobrar').html(data.paginacion);
						$('#numElementos_clientes_cuentas_cobrar').html(data.total_rows);
						intPaginaClientesCuentasCobrar = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_clientes_cuentas_cobrar(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_cobrar/clientes/';

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
										'strBusqueda': $('#txtBusqueda_clientes_cuentas_cobrar').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_clientes_cuentas_cobrar(id, tipoFormulario) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Dependiendo del tipo de formulario asignar id
			if(tipoFormulario == 'Datos Generales')
			{
				intID = $('#txtProspectoID_general_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Datos Crediticios')
			{
				intID = $('#txtProspectoID_credito_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Expediente')
			{
				intID = $('#txtProspectoID_expediente_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Personas autorizadas')
			{
				intID = $('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'cuentas_cobrar/clientes/get_reporte_registro',
							'data' : {
										'intProspectoID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);

		}

	

		/*******************************************************************************************************************
		Funciones del modal Clientes - Datos Generales
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_general_clientes_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmGeneralClientesCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_general_clientes_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmGeneralClientesCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_general_clientes_cuentas_cobrar');
			//Habilitar todos los elementos del formulario
			$('#frmGeneralClientesCuentasCobrar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtCodigo_general_clientes_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtEstado_general_clientes_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtPais_general_clientes_cuentas_cobrar').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_general_clientes_cuentas_cobrar").show();
			
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_general_clientes_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objGeneralClientesCuentasCobrar.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_clientes_cuentas_cobrar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_general_clientes_cuentas_cobrar ()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_general_clientes_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmGeneralClientesCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strRazonSocial_general_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba una razón social'}
											}
										},
										strRegimenFiscal_general_clientes_cuentas_cobrar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del régimen fiscal
					                                    if($('#txtRegimenFiscalID_general_clientes_cuentas_cobrar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un régimen fiscal existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strNombreComercial_general_clientes_cuentas_cobrar: {
											excluded: true  // Ignorar (no valida el campo)
										},										
										strTelefonoPrincipal_general_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba un número telefónico'},
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strTelefonoSecundario_general_clientes_cuentas_cobrar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strCorreoElectronico_general_clientes_cuentas_cobrar: {
				                        	excluded: true  // Ignorar (no valida el campo)
					                    },
										strCalle_general_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba una calle'}
											}
										},
										strNumeroExterior_general_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba un número exterior'}
											}
										},
										strNumeroInterior_general_clientes_cuentas_cobrar: {
				                        	excluded: true  // Ignorar (no valida el campo)
					                    },
										strCodigoPostal_general_clientes_cuentas_cobrar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if($('#txtCodigoPostalID_general_clientes_cuentas_cobrar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un código postal existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strColonia_general_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba una colonia'}
											}
										},
										strLocalidad_general_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba una localidad'}
											}
										},
										strReferencia_general_clientes_cuentas_cobrar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strMunicipio_general_clientes_cuentas_cobrar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del municipio
					                                    if($('#txtMunicipioID_general_clientes_cuentas_cobrar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un municipio existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strContactoNombre_general_clientes_cuentas_cobrar: {
				                        	excluded: true  // Ignorar (no valida el campo)
					                    },
					                    strContactoTelefono_general_clientes_cuentas_cobrar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strContactoCelular_general_clientes_cuentas_cobrar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strContactoExtension_general_clientes_cuentas_cobrar: {
				                        	excluded: true  // Ignorar (no valida el campo)
					                    },
					                    strContactoCorreoElectronico_general_clientes_cuentas_cobrar: {
				                        	excluded: true  // Ignorar (no valida el campo)
					                    }
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_general_clientes_cuentas_cobrar = $('#frmGeneralClientesCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_general_clientes_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_general_clientes_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para modificar los datos generales del registro
				modificar_general_clientes_cuentas_cobrar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_general_clientes_cuentas_cobrar()
		{
			try
			{
				$('#frmGeneralClientesCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para modificar los datos generales de un registro
		function modificar_general_clientes_cuentas_cobrar()
		{			
			//Hacer un llamado al método del controlador para modificar los datos del registro
			$.post('cuentas_cobrar/clientes/modificar_datos_generales',
					{ 
						intProspectoID: $('#txtProspectoID_general_clientes_cuentas_cobrar').val(),
						strTipoPersona: $('#cmbTipoPersona_general_clientes_cuentas_cobrar').val(),
						strRazonSocial: $('#txtRazonSocial_general_clientes_cuentas_cobrar').val(),
						strRfc: $('#txtRfc_general_clientes_cuentas_cobrar').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_general_clientes_cuentas_cobrar').val(),
						strNombreComercial: $('#txtNombreComercial_general_clientes_cuentas_cobrar').val(),
						strRepresentanteLegal: $('#txtRepresentanteLegal_general_clientes_cuentas_cobrar').val(),
						strTelefonoPrincipal: $('#txtTelefonoPrincipal_general_clientes_cuentas_cobrar').val(),
						strTelefonoSecundario: $('#txtTelefonoSecundario_general_clientes_cuentas_cobrar').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_general_clientes_cuentas_cobrar').val(),
						strCalle: $('#txtCalle_general_clientes_cuentas_cobrar').val(),
						strNumeroExterior: $('#txtNumeroExterior_general_clientes_cuentas_cobrar').val(),
						strNumeroInterior: $('#txtNumeroInterior_general_clientes_cuentas_cobrar').val(),
						intCodigoPostalID: $('#txtCodigoPostalID_general_clientes_cuentas_cobrar').val(),
						strColonia: $('#txtColonia_general_clientes_cuentas_cobrar').val(),
						strLocalidad: $('#txtLocalidad_general_clientes_cuentas_cobrar').val(),
						strReferencia: $('#txtReferencia_general_clientes_cuentas_cobrar').val(),
						intMunicipioID: $('#txtMunicipioID_general_clientes_cuentas_cobrar').val(),
						strContactoNombre: $('#txtContactoNombre_general_clientes_cuentas_cobrar').val(),
						strContactoTelefono: $('#txtContactoTelefono_general_clientes_cuentas_cobrar').val(),
						strContactoExtension: $('#txtContactoExtension_general_clientes_cuentas_cobrar').val(),
						strContactoCelular: $('#txtContactoCelular_general_clientes_cuentas_cobrar').val(),
						strContactoCorreoElectronico: $('#txtContactoCorreoElectronico_general_clientes_cuentas_cobrar').val(),
						strEstatus: $('#txtEstatus_general_clientes_cuentas_cobrar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_clientes_cuentas_cobrar();
							//Hacer un llamado a la función para cerrar modal
							cerrar_general_clientes_cuentas_cobrar();   
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_general_clientes_cuentas_cobrar(tipoMensaje, mensaje)
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
		
		//Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_general_clientes_cuentas_cobrar(id,estatus,tipoFormulario)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Dependiendo del tipo de formulario asignar id
			if(tipoFormulario == 'Datos Generales')
			{
				intID = $('#txtProspectoID_general_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Datos Crediticios')
			{
				intID = $('#txtProspectoID_credito_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Expediente')
			{
				intID = $('#txtProspectoID_expediente_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Personas autorizadas')
			{
				intID = $('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val();
			}
			else
			{
				intID = id;
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
				             {'type':     'question',
				              'title':    'Clientes',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                             	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_general_clientes_cuentas_cobrar(intID, tipoFormulario, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_general_clientes_cuentas_cobrar(intID, tipoFormulario, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_general_clientes_cuentas_cobrar(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('cuentas_cobrar/clientes/set_estatus',
			      {intProspectoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
		        		//Hacer llamado a la función para cargar  los registros en el grid
		      			paginacion_clientes_cuentas_cobrar();

			      		//Si existe descripción del formulario
						if(tipo != '')
						{
							//Dependiendo del tipo de formulario cerrar el modal
							if(tipo == 'Datos Generales')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_general_clientes_cuentas_cobrar();     
							}
							else if(tipo == 'Datos Crediticios')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_credito_clientes_cuentas_cobrar();
							}
							else if(tipo == 'Personas autorizadas')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_autorizar_clientes_cuentas_cobrar();
							}
							else 
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_expediente_clientes_cuentas_cobrar();
							}
						}
			     	}
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos generales (al formulario) del registro seleccionado
		function editar_general_clientes_cuentas_cobrar(id, tipoFormulario)
		{	
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_general_clientes_cuentas_cobrar").hide();
			$("#btnDatosCrediticios_general_clientes_cuentas_cobrar").hide();
			$("#btnExpediente_general_clientes_cuentas_cobrar").hide();
			$("#btnSolicitarRecibirProducto_general_clientes_cuentas_cobrar").hide();
			$("#btnDesactivar_general_clientes_cuentas_cobrar").hide();
			$("#btnRestaurar_general_clientes_cuentas_cobrar").hide();
			
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Dependiendo del tipo de formulario asignar id
			if(tipoFormulario == 'Datos Crediticios')
			{
				intID = $('#txtProspectoID_credito_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Expediente')
			{
				intID = $('#txtProspectoID_expediente_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Personas autorizadas')
			{
				intID = $('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val();
			}
			else
			{
				intID = id;
				//Mostrar los siguientes botones
				$("#btnImprimirRegistro_general_clientes_cuentas_cobrar").show();
				$("#btnDatosCrediticios_general_clientes_cuentas_cobrar").show();
				$("#btnExpediente_general_clientes_cuentas_cobrar").show();
				$("#btnSolicitarRecibirProducto_general_clientes_cuentas_cobrar").show();
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/clientes/get_datos',
			       {
			       	intProspectoID: intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_general_clientes_cuentas_cobrar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

				          	//Recuperar valores
				            $('#txtProspectoID_general_clientes_cuentas_cobrar').val(data.row.prospecto_id);
				            $('#txtCodigo_general_clientes_cuentas_cobrar').val(data.row.codigo);
				            $('#cmbTipoPersona_general_clientes_cuentas_cobrar').val(data.row.tipo_persona);
				            $('#txtRazonSocial_general_clientes_cuentas_cobrar').val(data.row.razon_social);
				            $('#txtRfc_general_clientes_cuentas_cobrar').val(data.row.rfc);
				            $('#txtRegimenFiscalID_general_clientes_cuentas_cobrar').val(data.row.regimen_fiscal_id);
				            $('#txtRegimenFiscal_general_clientes_cuentas_cobrar').val(data.row.regimen_fiscal);
						    $('#txtNombreComercial_general_clientes_cuentas_cobrar').val(data.row.nombre_comercial);
						    $('#txtRepresentanteLegal_general_clientes_cuentas_cobrar').val(data.row.representante_legal);
						    $('#txtTelefonoPrincipal_general_clientes_cuentas_cobrar').val(data.row.telefono_principal);
						    $('#txtTelefonoSecundario_general_clientes_cuentas_cobrar').val(data.row.telefono_secundario);
						    $('#txtCorreoElectronico_general_clientes_cuentas_cobrar').val(data.row.correo_electronico);
						    $('#txtCalle_general_clientes_cuentas_cobrar').val(data.row.calle);
						    $('#txtNumeroExterior_general_clientes_cuentas_cobrar').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_general_clientes_cuentas_cobrar').val(data.row.numero_interior);
						    $('#txtCodigoPostalID_general_clientes_cuentas_cobrar').val(data.row.codigo_postal_id);
						    $('#txtCodigoPostal_general_clientes_cuentas_cobrar').val(data.row.codigo_postal);
						    $('#txtColonia_general_clientes_cuentas_cobrar').val(data.row.colonia);
						    $('#txtLocalidad_general_clientes_cuentas_cobrar').val(data.row.localidad);
						    $('#txtMunicipioID_general_clientes_cuentas_cobrar').val(data.row.municipio_id);
						    $('#txtMunicipio_general_clientes_cuentas_cobrar').val(data.row.municipio);
						    $('#txtEstado_general_clientes_cuentas_cobrar').val(data.row.estado);
						    $('#txtPais_general_clientes_cuentas_cobrar').val(data.row.pais);
						    $('#txtReferencia_general_clientes_cuentas_cobrar').val(data.row.referencia);
						    $('#txtContactoNombre_general_clientes_cuentas_cobrar').val(data.row.contacto_nombre);
						    $('#txtContactoTelefono_general_clientes_cuentas_cobrar').val(data.row.contacto_telefono);
						    $('#txtContactoExtension_general_clientes_cuentas_cobrar').val(data.row.contacto_extension);
						    $('#txtContactoCelular_general_clientes_cuentas_cobrar').val(data.row.contacto_celular);
						    $('#txtContactoCorreoElectronico_general_clientes_cuentas_cobrar').val(data.row.contacto_correo_electronico);
						    $('#txtEstatus_general_clientes_cuentas_cobrar').val(data.row.estatus);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_general_clientes_cuentas_cobrar').addClass("estatus-"+strEstatus);

				           	//Si no existe tipo de formulario, significa que el id se obtuvo del grid view
				            if(tipoFormulario == '')
				            {
				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
								{
									//Mostrar botón Desactivar
					            	$("#btnDesactivar_general_clientes_cuentas_cobrar").show();
								}
								else 
								{	
									//Deshabilitar todos los elementos del formulario
				            		$('#frmGeneralClientesCuentasCobrar').find('input, textarea, select').attr('disabled','disabled');
				            		//Ocultar botón Guardar
					           		$("#btnGuardar_general_clientes_cuentas_cobrar").hide();
									//Mostrar botón Restaurar
									$("#btnRestaurar_general_clientes_cuentas_cobrar").show();
								}

				            }
				            
			            	//Abrir modal
				            objGeneralClientesCuentasCobrar = $('#GeneralClientesCuentasCobrarBox').bPopup({
														  appendTo: '#ClientesCuentasCobrarContent', 
							                              contentContainer: 'ClientesCuentasCobrarM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtRazonSocial_general_clientes_cuentas_cobrar').focus();
					        
			       	    }
			       },
			       'json');
		}

		//Función que se utiliza para copiar los datos del prospecto
		function copiar_general_clientes_cuentas_cobrar()
		{	
			//Asignar valores del prospecto a los datos del contacto
			$('#txtContactoNombre_general_clientes_cuentas_cobrar').val(document.getElementById("txtNombreComercial_general_clientes_cuentas_cobrar").value);
	        $('#txtContactoTelefono_general_clientes_cuentas_cobrar').val(document.getElementById("txtTelefonoPrincipal_general_clientes_cuentas_cobrar").value);
	        $('#txtContactoCelular_general_clientes_cuentas_cobrar').val(document.getElementById("txtTelefonoSecundario_general_clientes_cuentas_cobrar").value);
	        $('#txtContactoCorreoElectronico_general_clientes_cuentas_cobrar').val(document.getElementById("txtCorreoElectronico_general_clientes_cuentas_cobrar").value);
		}

		/********************************************************************************************************************
		Funciones del modal Clientes - Datos Crediticios
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_credito_clientes_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmCreditoClientesCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_credito_clientes_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmCreditoClientesCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_credito_clientes_cuentas_cobrar');
		    //Habilitar todos los elementos del formulario
		    $('#frmCreditoClientesCuentasCobrar').find('input, textarea, select').removeAttr('disabled','disabled');
		    //Seleccionar tab que contiene la información general
		    $('a[href="#informacion_general_credito_clientes_cuentas_cobrar"]').click();
		    //Deshabilitar las siguientes cajas de texto
			$('#txtCodigo_credito_clientes_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtRazonSocial_credito_clientes_cuentas_cobrar').attr("disabled", "disabled");
			$('#txtNombreComercial_credito_clientes_cuentas_cobrar').attr("disabled", "disabled");
		    //Mostrar los siguientes botones
			$("#btnGuardar_credito_clientes_cuentas_cobrar").show();
			$("#btnNuevo_referencias_credito_clientes_cuentas_cobrar").show();
			$("#btnNuevo_cuentas_bancarias_credito_clientes_cuentas_cobrar").show();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_credito_clientes_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objCreditoClientesCuentasCobrar.close();
			}
			catch(err) {}
		}
		
		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_credito_clientes_cuentas_cobrar()
		{
			try
			{
				$('#frmGeneralClientesCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para modificar los datos crediticios de un registro
		function modificar_credito_clientes_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para modificar los datos del registro
			$.post('cuentas_cobrar/clientes/modificar_datos_crediticios',
					{ 
						intProspectoID: $('#txtProspectoID_credito_clientes_cuentas_cobrar').val(),
						strCreditoSolicitud: $('#txtCreditoSolicitud_credito_clientes_cuentas_cobrar').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteCreditoInicio: $.formatFechaMysql($('#txtFechaInicioCredito_credito_clientes_cuentas_cobrar').val()),
						intUsoCFDIID: $('#txtUsoCfdiID_credito_clientes_cuentas_cobrar').val(),
						strDiasRevision: $('#txtDiasRevision_credito_clientes_cuentas_cobrar').val(),
						strDiasPago: $('#txtDiasPago_credito_clientes_cuentas_cobrar').val(),
						strEncargadoCompras: $('#txtEncargadoCompras_credito_clientes_cuentas_cobrar').val(),
						strEncargadoPagos: $('#txtEncargadoPagos_credito_clientes_cuentas_cobrar').val(),
						strComentariosCredito: $('#txtComentarios_credito_clientes_cuentas_cobrar').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intMaquinariaCreditoLimite: $.reemplazar($('#txtMaquinariaCreditoLimite_credito_clientes_cuentas_cobrar').val(), ",", ""),
						intMaquinariaCreditoDias: $('#txtMaquinariaCreditoDias_credito_clientes_cuentas_cobrar').val(),
						intMaquinariaListaPrecioID: $('#txtMaquinariaListaPrecioID_credito_clientes_cuentas_cobrar').val(),
						intRefaccionesCreditoLimite: $.reemplazar($('#txtRefaccionesCreditoLimite_credito_clientes_cuentas_cobrar').val(), ",", ""),
						intRefaccionesCreditoDias: $('#txtRefaccionesCreditoDias_credito_clientes_cuentas_cobrar').val(),
						intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioID_credito_clientes_cuentas_cobrar').val(),
						intServicioCreditoLimite: $.reemplazar($('#txtServicioCreditoLimite_credito_clientes_cuentas_cobrar').val(), ",", ""),
						intServicioCreditoDias: $('#txtServicioCreditoDias_credito_clientes_cuentas_cobrar').val(),
						intServicioListaPrecioID: $('#txtServicioListaPrecioID_credito_clientes_cuentas_cobrar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_clientes_cuentas_cobrar();
							//Hacer un llamado a la función para cerrar modal
							cerrar_credito_clientes_cuentas_cobrar();   
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para regresar los datos crediticios (al formulario) del registro seleccionado
		function editar_credito_clientes_cuentas_cobrar(id, tipoFormulario)
		{	
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_credito_clientes_cuentas_cobrar").hide();
			$("#btnDatosGenerales_credito_clientes_cuentas_cobrar").hide();
			$("#btnExpediente_credito_clientes_cuentas_cobrar").hide();
			$("#btnSolicitarRecibirProducto_credito_clientes_cuentas_cobrar").hide();
			$("#btnDesactivar_credito_clientes_cuentas_cobrar").hide();
			$("#btnRestaurar_credito_clientes_cuentas_cobrar").hide();

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Dependiendo del tipo de formulario asignar id
			if(tipoFormulario == 'Datos Generales')
			{
				intID = $('#txtProspectoID_general_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Expediente')
			{
				intID = $('#txtProspectoID_expediente_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Personas autorizadas')
			{
				intID = $('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val();
			}
			else
			{
				intID = id;
				//Mostrar los siguientes botones
				$("#btnImprimirRegistro_credito_clientes_cuentas_cobrar").show();
				$("#btnDatosGenerales_credito_clientes_cuentas_cobrar").show();
				$("#btnExpediente_credito_clientes_cuentas_cobrar").show();
				$("#btnSolicitarRecibirProducto_credito_clientes_cuentas_cobrar").show();
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/clientes/get_datos',
			       {
			       	intProspectoID: intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_credito_clientes_cuentas_cobrar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

				          	//Recuperar valores
				            $('#txtProspectoID_credito_clientes_cuentas_cobrar').val(data.row.prospecto_id);
				            $('#txtCodigo_credito_clientes_cuentas_cobrar').val(data.row.codigo);
				            $('#txtRazonSocial_credito_clientes_cuentas_cobrar').val(data.row.razon_social);
				            $('#txtNombreComercial_credito_clientes_cuentas_cobrar').val(data.row.nombre_comercial);
				            $('#txtCreditoSolicitud_credito_clientes_cuentas_cobrar').val(data.row.credito_solicitud);
						    $('#txtFechaInicioCredito_credito_clientes_cuentas_cobrar').val(data.row.credito_inicio); 
						    $('#txtUsoCfdiID_credito_clientes_cuentas_cobrar').val(data.row.uso_cfdi_id);
						    $('#txtUsoCfdi_credito_clientes_cuentas_cobrar').val(data.row.uso_cfdi);
						    $('#txtDiasRevision_credito_clientes_cuentas_cobrar').val(data.row.dias_revision);
						    $('#txtDiasPago_credito_clientes_cuentas_cobrar').val(data.row.dias_pago);
						    $('#txtEncargadoCompras_credito_clientes_cuentas_cobrar').val(data.row.encargado_compras);
						    $('#txtEncargadoPagos_credito_clientes_cuentas_cobrar').val(data.row.encargado_pagos);
						    $('#txtComentarios_credito_clientes_cuentas_cobrar').val(data.row.comentarios_credito);
						    $('#txtMaquinariaCreditoLimite_credito_clientes_cuentas_cobrar').val(data.row.maquinaria_credito_limite);
						    $('#txtMaquinariaCreditoDias_credito_clientes_cuentas_cobrar').val(data.row.maquinaria_credito_dias);
						    $('#txtMaquinariaListaPrecioID_credito_clientes_cuentas_cobrar').val(data.row.maquinaria_lista_precio_id);
						    $('#txtMaquinariaListaPrecio_credito_clientes_cuentas_cobrar').val(data.row.maquinaria_lista_precio);
						    $('#txtRefaccionesCreditoLimite_credito_clientes_cuentas_cobrar').val(data.row.refacciones_credito_limite);
						    $('#txtRefaccionesCreditoDias_credito_clientes_cuentas_cobrar').val(data.row.refacciones_credito_dias);
						    $('#txtRefaccionesListaPrecioID_credito_clientes_cuentas_cobrar').val(data.row.refacciones_lista_precio_id);
						    $('#txtRefaccionesListaPrecio_credito_clientes_cuentas_cobrar').val(data.row.refacciones_lista_precio);
						    $('#txtServicioCreditoLimite_credito_clientes_cuentas_cobrar').val(data.row.servicio_credito_limite);
						    $('#txtServicioCreditoDias_credito_clientes_cuentas_cobrar').val(data.row.servicio_credito_dias);
						    $('#txtServicioListaPrecio_credito_clientes_cuentas_cobrar').val(data.row.servicio_lista_precio);
						    $('#txtServicioListaPrecioID_credito_clientes_cuentas_cobrar').val(data.row.servicio_lista_precio_id);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_credito_clientes_cuentas_cobrar').addClass("estatus-"+strEstatus);
				            //Hacer llamado a la función  para cargar las personas autorizadas en el grid
				            paginacion_personas_autorizadas_clientes_cuentas_cobrar();
				            //Hacer llamado a la función  para cargar las cuentas bancarias en el grid
				            paginacion_cuentas_bancarias_credito_clientes_cuentas_cobrar();
				            //Hacer llamado a la función  para cargar las referencias en el grid
				            paginacion_referencias_credito_clientes_cuentas_cobrar();

				            //Si el estatus del registro es INACTIVO
			            	if(strEstatus == 'INACTIVO')
			            	{
			            		//Deshabilitar todos los elementos del formulario
			            		$('#frmCreditoClientesCuentasCobrar').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar los siguientes botones
				           		$("#btnGuardar_credito_clientes_cuentas_cobrar").hide(); 
								$("#btnNuevo_referencias_credito_clientes_cuentas_cobrar").hide();
								$("#btnNuevo_cuentas_bancarias_credito_clientes_cuentas_cobrar").hide();
								
			            	}

				            //Si no existe tipo de formulario, significa que el id se obtuvo del grid view
				            if(tipoFormulario == '')
				            {	
				            	//Si el estatus del registro es ACTIVO
				            	if(strEstatus == 'ACTIVO')
				            	{
				            		//Mostrar botón Desactivar
				            		$("#btnDesactivar_credito_clientes_cuentas_cobrar").show();
				            	}
				            	else
				            	{

				            		//Mostrar botón Restaurar
									$("#btnRestaurar_credito_clientes_cuentas_cobrar").show();
				            	}
				            }
				            
			            	//Abrir modal
				            objCreditoClientesCuentasCobrar = $('#CreditoClientesCuentasCobrarBox').bPopup({
														  appendTo: '#ClientesCuentasCobrarContent', 
							                              contentContainer: 'ClientesCuentasCobrarM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtCreditoSolicitud_credito_clientes_cuentas_cobrar').focus();
					        
			       	    }
			       },
			       'json');
		}

		/*******************************************************************************************************************
		Funciones del Tab - Cuentas Bancarias
		*********************************************************************************************************************/
		/*******************************************************************************************************************
		Funciones de modal Cuentas Bancarias
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_cuentas_bancarias_credito_clientes_cuentas_cobrar() 
		{
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/clientes/get_paginacion_cuentas_bancarias',
					{	intProspectoID:$('#txtProspectoID_credito_clientes_cuentas_cobrar').val(),
						intPagina:intPaginaCuentasBancariasCreditoClientesCuentasCobrar,
						strPermisosAcceso: $('#txtAcciones_clientes_cuentas_cobrar').val()
					},
					function(data){
						$('#dg_cuentas_bancarias_credito_clientes_cuentas_cobrar tbody').empty();
						var tmpCuentasBancariasCreditoClientesCuentasCobrar = Mustache.render($('#plantilla_cuentas_bancarias_credito_clientes_cuentas_cobrar').html(),data);
						$('#dg_cuentas_bancarias_credito_clientes_cuentas_cobrar tbody').html(tmpCuentasBancariasCreditoClientesCuentasCobrar);
						$('#pagLinks_cuentas_bancarias_credito_clientes_cuentas_cobrar').html(data.paginacion);
						$('#numElementos_cuentas_bancarias_credito_clientes_cuentas_cobrar').html(data.total_rows);
						intPaginaCuentasBancariasCreditoClientesCuentasCobrar = data.pagina;
					},
			'json');
		}

		//Función para limpiar los campos del formulario
		function nuevo_cuentas_bancarias_credito_clientes_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmCuentasBancariasCreditoClientesCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cuentas_bancarias_credito_clientes_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmCuentasBancariasCreditoClientesCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cuentas_bancarias_credito_clientes_cuentas_cobrar');
			//Habilitar todos los elementos del formulario
			$('#frmCuentasBancariasCreditoClientesCuentasCobrar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_cuentas_bancarias_credito_clientes_cuentas_cobrar").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_cuentas_bancarias_credito_clientes_cuentas_cobrar").hide();
			$("#btnRestaurar_cuentas_bancarias_credito_clientes_cuentas_cobrar").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cuentas_bancarias_credito_clientes_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objCuentasBancariasCreditoClientesCuentasCobrar.close();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cuentas_bancarias_credito_clientes_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cuentas_bancarias_credito_clientes_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmCuentasBancariasCreditoClientesCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba una cuenta'}
											}
										},
										strBanco_cuentas_bancarias_credito_clientes_cuentas_cobrar: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                	//Verificar que exista id del banco
					                                    if($('#txtBancoID_cuentas_bancarias_credito_clientes_cuentas_cobrar').val() === '')
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
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cuentas_bancarias_credito_clientes_cuentas_cobrar = $('#frmCuentasBancariasCreditoClientesCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_cuentas_bancarias_credito_clientes_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cuentas_bancarias_credito_clientes_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_cuentas_bancarias_credito_clientes_cuentas_cobrar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cuentas_bancarias_credito_clientes_cuentas_cobrar()
		{
			try
			{
				$('#frmCuentasBancariasCreditoClientesCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_cuentas_bancarias_credito_clientes_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_cobrar/clientes/guardar_cuentas_bancarias',
					{ 
						intProspectoID: $('#txtProspectoID_credito_clientes_cuentas_cobrar').val(),
						intRenglon: $('#txtRenglon_cuentas_bancarias_credito_clientes_cuentas_cobrar').val(),
						intBancoID: $('#txtBancoID_cuentas_bancarias_credito_clientes_cuentas_cobrar').val(),
						strCuenta: $('#txtCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar').val(),
						strCuentaAnterior: $('#txtCuentaAnterior_cuentas_bancarias_credito_clientes_cuentas_cobrar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_cuentas_bancarias_credito_clientes_cuentas_cobrar();
							//Hacer un llamado a la función para cerrar modal
							cerrar_cuentas_bancarias_credito_clientes_cuentas_cobrar();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		// Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_cuentas_bancarias_credito_clientes_cuentas_cobrar(renglon,estatus)
		{
			//Variable que se utiliza para asignar el renglón del registro
			var intRenglonID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe renglón, significa que se realizará la modificación desde el modal
			if(renglon == '')
			{
				intRenglonID = $('#txtRenglon_cuentas_bancarias_credito_clientes_cuentas_cobrar').val();

			}
			else
			{
				intRenglonID = renglon;
				strTipo = 'gridview';
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
				             {'type':     'question',
				              'title':    'Cuentas Bancarias',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_cuentas_bancarias_credito_clientes_cuentas_cobrar(intRenglonID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_cuentas_bancarias_credito_clientes_cuentas_cobrar(intRenglonID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_cuentas_bancarias_credito_clientes_cuentas_cobrar(renglon, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('cuentas_cobrar/clientes/set_estatus_cuentas_bancarias',
			      {intProspectoID: $('#txtProspectoID_credito_clientes_cuentas_cobrar').val(),
			       intRenglon: renglon,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_cuentas_bancarias_credito_clientes_cuentas_cobrar();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cuentas_bancarias_credito_clientes_cuentas_cobrar();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_cuentas_bancarias_credito_clientes_cuentas_cobrar(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/clientes/get_datos_cuentas_bancarias',
			       {intProspectoID: $('#txtProspectoID_credito_clientes_cuentas_cobrar').val(),
			       	strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cuentas_bancarias_credito_clientes_cuentas_cobrar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

				          	//Recuperar valores
				            $('#txtRenglon_cuentas_bancarias_credito_clientes_cuentas_cobrar').val(data.row.renglon);
				            $('#txtBancoID_cuentas_bancarias_credito_clientes_cuentas_cobrar').val(data.row.banco_id);
				            $('#txtBanco_cuentas_bancarias_credito_clientes_cuentas_cobrar').val(data.row.banco);
				            $('#txtCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar').val(data.row.cuenta);
				            $('#txtCuentaAnterior_cuentas_bancarias_credito_clientes_cuentas_cobrar').val(data.row.cuenta);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_cuentas_bancarias_credito_clientes_cuentas_cobrar').addClass("estatus-"+strEstatus);
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_cuentas_bancarias_credito_clientes_cuentas_cobrar").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmCuentasBancariasCreditoClientesCuentasCobrar').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_cuentas_bancarias_credito_clientes_cuentas_cobrar").hide(); 
								
								//Mostrar botón Restaurar
								$("#btnRestaurar_cuentas_bancarias_credito_clientes_cuentas_cobrar").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
								objCuentasBancariasCreditoClientesCuentasCobrar = $('#CuentasBancariasCreditoClientesCuentasCobrarBox').bPopup({
																				  appendTo: '#ClientesCuentasCobrarContent', 
													                              contentContainer: 'ClientesCuentasCobrarM', 
													                              zIndex: 2, 
													                              modalClose: false, 
													                              modal: true, 
													                              follow: [true,false], 
													                              followEasing : "linear", 
													                              easing: "linear", 
													                              modalColor: ('#F0F0F0')});
								//Enfocar caja de texto
								$('#txtCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar').focus();
					        }
			       	    }
			       },
			       'json');
		}


		/*******************************************************************************************************************
		Funciones del Tab - Referencias
		*********************************************************************************************************************/
		/*******************************************************************************************************************
		Funciones de modal Referencias
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_referencias_credito_clientes_cuentas_cobrar() 
		{
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/clientes/get_paginacion_referencias',
					{	intProspectoID:$('#txtProspectoID_credito_clientes_cuentas_cobrar').val(),
						intPagina:intPaginaReferenciasCreditoClientesCuentasCobrar,
						strPermisosAcceso: $('#txtAcciones_clientes_cuentas_cobrar').val()
					},
					function(data){
						$('#dg_referencias_credito_clientes_cuentas_cobrar tbody').empty();
						var tmpReferenciasCreditoClientesCuentasCobrar = Mustache.render($('#plantilla_referencias_credito_clientes_cuentas_cobrar').html(),data);
						$('#dg_referencias_credito_clientes_cuentas_cobrar tbody').html(tmpReferenciasCreditoClientesCuentasCobrar);
						$('#pagLinks_referencias_credito_clientes_cuentas_cobrar').html(data.paginacion);
						$('#numElementos_referencias_credito_clientes_cuentas_cobrar').html(data.total_rows);
						intPaginaReferenciasCreditoClientesCuentasCobrar = data.pagina;
					},
			'json');
		}

		//Función para limpiar los campos del formulario
		function nuevo_referencias_credito_clientes_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmReferenciasCreditoClientesCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_referencias_credito_clientes_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmReferenciasCreditoClientesCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_referencias_credito_clientes_cuentas_cobrar');
			//Habilitar todos los elementos del formulario
			$('#frmReferenciasCreditoClientesCuentasCobrar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_referencias_credito_clientes_cuentas_cobrar").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_referencias_credito_clientes_cuentas_cobrar").hide();
			$("#btnRestaurar_referencias_credito_clientes_cuentas_cobrar").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_referencias_credito_clientes_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objReferenciasCreditoClientesCuentasCobrar.close();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_referencias_credito_clientes_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_referencias_credito_clientes_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmReferenciasCreditoClientesCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strNombre_referencias_credito_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba un nombre'}
											}
										},
										strTelefono_referencias_credito_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba un número telefónico'},
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strCalificacion_referencias_credito_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba una calificación'}
											}
										},
										strNombreReferencia_referencias_credito_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba un nombre'}
											}
										},
										strPuestoReferencia_referencias_credito_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba un puesto'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_referencias_credito_clientes_cuentas_cobrar = $('#frmReferenciasCreditoClientesCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_referencias_credito_clientes_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_referencias_credito_clientes_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_referencias_credito_clientes_cuentas_cobrar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_referencias_credito_clientes_cuentas_cobrar()
		{
			try
			{
				$('#frmReferenciasCreditoClientesCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_referencias_credito_clientes_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_cobrar/clientes/guardar_referencias',
					{ 
						intProspectoID: $('#txtProspectoID_credito_clientes_cuentas_cobrar').val(),
						intRenglon: $('#txtRenglon_referencias_credito_clientes_cuentas_cobrar').val(),
						strNombre: $('#txtNombre_referencias_credito_clientes_cuentas_cobrar').val(),
						strNombreAnterior: $('#txtNombreAnterior_referencias_credito_clientes_cuentas_cobrar').val(),
						strContacto: $('#txtContacto_referencias_credito_clientes_cuentas_cobrar').val(),
						strTelefono: $('#txtTelefono_referencias_credito_clientes_cuentas_cobrar').val(),
					    strExtension: $('#txtExtension_referencias_credito_clientes_cuentas_cobrar').val(),
					    strCalificacion: $('#txtCalificacion_referencias_credito_clientes_cuentas_cobrar').val(),
					    strTipo: $('#cmbTipo_referencias_credito_clientes_cuentas_cobrar').val(),
					    strClienteDesde: $('#txtClienteDesde_referencias_credito_clientes_cuentas_cobrar').val(),
					    strManejaCredito: $('#cmbManejaCredito_referencias_credito_clientes_cuentas_cobrar').val(),
					    //Hacer un llamado a la función para reemplazar ',' por cadena vacia
					    intImporteCredito: $.reemplazar($('#txtImporteCredito_referencias_credito_clientes_cuentas_cobrar').val(), ",", ""),
					    intPlazoCredito: $('#txtPlazoCredito_referencias_credito_clientes_cuentas_cobrar').val(),
					    strFormaPago: $('#txtFormaPago_referencias_credito_clientes_cuentas_cobrar').val(),
					    strChequeSinFondos: $('#cmbChequeSinFondos_referencias_credito_clientes_cuentas_cobrar').val(),
					    strAtrasos: $('#cmbAtrasos_referencias_credito_clientes_cuentas_cobrar').val(),
					    strGarantiaAdicional: $('#cmbGarantiaAdicional_referencias_credito_clientes_cuentas_cobrar').val(),
					    strExperienciaGeneral: $('#txtExperienciaGeneral_referencias_credito_clientes_cuentas_cobrar').val(),
					    strTipoServicio: $('#txtTipoServicio_referencias_credito_clientes_cuentas_cobrar').val(),
					    strComentarios: $('#txtComentarios_referencias_credito_clientes_cuentas_cobrar').val(),
					    strNombreReferencia: $('#txtNombreReferencia_referencias_credito_clientes_cuentas_cobrar').val(),
					    strPuestoReferencia: $('#txtPuestoReferencia_referencias_credito_clientes_cuentas_cobrar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_referencias_credito_clientes_cuentas_cobrar();
							//Hacer un llamado a la función para cerrar modal
							cerrar_referencias_credito_clientes_cuentas_cobrar();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		// Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_referencias_credito_clientes_cuentas_cobrar(renglon,estatus)
		{
			//Variable que se utiliza para asignar el renglón del registro
			var intRenglonID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe renglón, significa que se realizará la modificación desde el modal
			if(renglon == '')
			{
				intRenglonID = $('#txtRenglon_referencias_credito_clientes_cuentas_cobrar').val();

			}
			else
			{
				intRenglonID = renglon;
				strTipo = 'gridview';
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
				             {'type':     'question',
				              'title':    'Referencias',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                             	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_referencias_credito_clientes_cuentas_cobrar(intRenglonID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_referencias_credito_clientes_cuentas_cobrar(intRenglonID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_referencias_credito_clientes_cuentas_cobrar(renglon, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('cuentas_cobrar/clientes/set_estatus_referencias',
			      {intProspectoID: $('#txtProspectoID_credito_clientes_cuentas_cobrar').val(),
			       intRenglon: renglon,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_referencias_credito_clientes_cuentas_cobrar();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_referencias_credito_clientes_cuentas_cobrar();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_referencias_credito_clientes_cuentas_cobrar(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/clientes/get_datos_referencias',
			       {intProspectoID: $('#txtProspectoID_credito_clientes_cuentas_cobrar').val(),
			       	strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_referencias_credito_clientes_cuentas_cobrar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

				          	//Recuperar valores
				            $('#txtRenglon_referencias_credito_clientes_cuentas_cobrar').val(data.row.renglon);
				            $('#txtNombre_referencias_credito_clientes_cuentas_cobrar').val(data.row.nombre);
				            $('#txtNombreAnterior_referencias_credito_clientes_cuentas_cobrar').val(data.row.nombre);
				            $('#txtContacto_referencias_credito_clientes_cuentas_cobrar').val(data.row.contacto);
						    $('#txtTelefono_referencias_credito_clientes_cuentas_cobrar').val(data.row.telefono);
					        $('#txtExtension_referencias_credito_clientes_cuentas_cobrar').val(data.row.extension);
					        $('#txtCalificacion_referencias_credito_clientes_cuentas_cobrar').val(data.row.calificacion);
					        $('#cmbTipo_referencias_credito_clientes_cuentas_cobrar').val(data.row.tipo);
					        $('#txtClienteDesde_referencias_credito_clientes_cuentas_cobrar').val(data.row.cliente_desde);
					        $('#cmbManejaCredito_referencias_credito_clientes_cuentas_cobrar').val(data.row.maneja_credito);
					        $('#txtImporteCredito_referencias_credito_clientes_cuentas_cobrar').val(data.row.importe_credito);
					        //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporteCredito_referencias_credito_clientes_cuentas_cobrar').formatCurrency({ roundToDecimalPlace: 2 });
					        $('#txtPlazoCredito_referencias_credito_clientes_cuentas_cobrar').val(data.row.plazo_credito);
					        $('#txtFormaPago_referencias_credito_clientes_cuentas_cobrar').val(data.row.forma_pago);
					        $('#cmbChequeSinFondos_referencias_credito_clientes_cuentas_cobrar').val(data.row.cheque_sin_fondos);
					        $('#cmbAtrasos_referencias_credito_clientes_cuentas_cobrar').val(data.row.atrasos);
					        $('#cmbGarantiaAdicional_referencias_credito_clientes_cuentas_cobrar').val(data.row.garantia_adicional);
					        $('#txtExperienciaGeneral_referencias_credito_clientes_cuentas_cobrar').val(data.row.experiencia_general);
					        $('#txtTipoServicio_referencias_credito_clientes_cuentas_cobrar').val(data.row.tipo_servicio);
					        $('#txtComentarios_referencias_credito_clientes_cuentas_cobrar').val(data.row.comentarios);
					        $('#txtNombreReferencia_referencias_credito_clientes_cuentas_cobrar').val(data.row.nombre_referencia);
					        $('#txtPuestoReferencia_referencias_credito_clientes_cuentas_cobrar').val(data.row.puesto_referencia);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_referencias_credito_clientes_cuentas_cobrar').addClass("estatus-"+strEstatus);
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_referencias_credito_clientes_cuentas_cobrar").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmReferenciasCreditoClientesCuentasCobrar').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_referencias_credito_clientes_cuentas_cobrar").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_referencias_credito_clientes_cuentas_cobrar").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
								objReferenciasCreditoClientesCuentasCobrar = $('#ReferenciasCreditoClientesCuentasCobrarBox').bPopup({
																			  appendTo: '#ClientesCuentasCobrarContent', 
												                              contentContainer: 'ClientesCuentasCobrarM', 
												                              zIndex: 2, 
												                              modalClose: false, 
												                              modal: true, 
												                              follow: [true,false], 
												                              followEasing : "linear", 
												                              easing: "linear", 
												                              modalColor: ('#F0F0F0')});
								//Enfocar caja de texto
								$('#txtNombre_referencias_credito_clientes_cuentas_cobrar').focus();
					        }
			       	    }
			       },
			       'json');
		}


		/*******************************************************************************************************************
		Funciones del modal Clientes - Expediente
		*********************************************************************************************************************/
		//Función que se utiliza para cerrar el modal
		function cerrar_expediente_clientes_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objExpedientesClientesCuentasCobrar.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para abrir el modal
		function abrir_expediente_clientes_cuentas_cobrar(id, tipoFormulario)
		{
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_expediente_clientes_cuentas_cobrar');
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_expediente_clientes_cuentas_cobrar").hide();
			$("#btnDatosGenerales_expediente_clientes_cuentas_cobrar").hide();
			$("#btnDatosCrediticios_expediente_clientes_cuentas_cobrar").hide();
			$("#btnSolicitarRecibirProducto_expediente_clientes_cuentas_cobrar").hide();
			$("#btnDesactivar_expediente_clientes_cuentas_cobrar").hide();
			$("#btnRestaurar_expediente_clientes_cuentas_cobrar").hide();

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Dependiendo del tipo de formulario asignar id
			if(tipoFormulario == 'Datos Generales')
			{
				intID = $('#txtProspectoID_general_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Datos Crediticios')
			{
				intID = $('#txtProspectoID_credito_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Personas autorizadas')
			{

				intID = $('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val();
			}
			else
			{
				intID = id;
				//Mostrar los siguientes botones
				$("#btnImprimirRegistro_expediente_clientes_cuentas_cobrar").show();
				$("#btnDatosGenerales_expediente_clientes_cuentas_cobrar").show();
				$("#btnDatosCrediticios_expediente_clientes_cuentas_cobrar").show();
				$("#btnSolicitarRecibirProducto_expediente_clientes_cuentas_cobrar").show();
			}


			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/clientes/get_datos',
			       {
			       	intProspectoID: intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

				          	//Recuperar valores
				            $('#txtProspectoID_expediente_clientes_cuentas_cobrar').val(data.row.prospecto_id);
				            $('#txtTipoPersona_expediente_clientes_cuentas_cobrar').val(data.row.tipo_persona);
				            $('#txtCodigo_expediente_clientes_cuentas_cobrar').val(data.row.codigo);
				            $('#txtRazonSocial_expediente_clientes_cuentas_cobrar').val(data.row.razon_social);
				            $('#txtNombreComercial_expediente_clientes_cuentas_cobrar').val(data.row.nombre_comercial);
				            $('#txtEstatus_expediente_clientes_cuentas_cobrar').val(strEstatus);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_expediente_clientes_cuentas_cobrar').addClass("estatus-"+strEstatus);
				            //Hacer llamado a la función  para cargar los documentos activos en el grid
				            documentos_expediente_clientes_cuentas_cobrar();

				            //Si no existe tipo de formulario, significa que el id se obtuvo del grid view
				            if(tipoFormulario == '')
				            {
				            	//Si el estatus del registro es ACTIVO
				            	if(strEstatus == 'ACTIVO')
				            	{
				            		//Mostrar botón Desactivar
				            		$("#btnDesactivar_expediente_clientes_cuentas_cobrar").show();
				            	}
				            	else
				            	{

				            		//Mostrar botón Restaurar
									$("#btnRestaurar_expediente_clientes_cuentas_cobrar").show();
				            	}
				            }

			            	//Abrir modal
				            objExpedientesClientesCuentasCobrar = $('#ExpedienteClientesCuentasCobrarBox').bPopup({
																  appendTo: '#ClientesCuentasCobrarContent', 
									                              contentContainer: 'ClientesCuentasCobrarM', 
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

		//Función para la búsqueda de documentos activos
		function documentos_expediente_clientes_cuentas_cobrar() 
		{	
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/documentos_clientes/get_activos',
					{	
						strTipo: 'Cliente',
						intID: $('#txtProspectoID_expediente_clientes_cuentas_cobrar').val(),
						strEstatus: $('#txtEstatus_expediente_clientes_cuentas_cobrar').val(),
						strTipoPersona: $('#txtTipoPersona_expediente_clientes_cuentas_cobrar').val(),
						strPermisosAcceso: $('#txtAcciones_clientes_cuentas_cobrar').val()
					},
					function(data){
						$('#dg_expediente_clientes_cuentas_cobrar tbody').empty();
						var tmpExpedienteClientesCuentasCobrar = Mustache.render($('#plantilla_expediente_clientes_cuentas_cobrar').html(),data);
						$('#dg_expediente_clientes_cuentas_cobrar tbody').html(tmpExpedienteClientesCuentasCobrar);
						$('#numElementos_expediente_clientes_cuentas_cobrar').html(data.total_rows);
					},
			'json');
			
		}

		//Función para subir archivo (o imagen) de un registro desde el grid view
		function subir_archivo_expediente_clientes_cuentas_cobrar(documentoID)
		{
			//Variable que se utiliza para asignar archivo
			var strBotonArchivoIDExpedienteClientesCuentasCobrar="archivo_clientes_cuentas_cobrar"+documentoID;
			//Obtenemos un array con los datos del archivo
	        var file = $("#"+strBotonArchivoIDExpedienteClientesCuentasCobrar)[0].files[0];
	        //Variable que se utiliza para asignar la extensión del archivo seleccionado
   			var fileExtension = "";
	        //Obtenemos el nombre del archivo
	        var fileName = file.name;
	        //Obtenemos la extensión del archivo
	        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
	        //Obtenemos el tamaño del archivo
	        var fileSize = file.size;
	        //Obtenemos el tipo de archivo image/png ejemplo
	        var fileType = file.type;

	        //Comprobar extensión del archivo
	        $.post('cuentas_cobrar/clientes/comprobar_extension_archivo',
				     {strExtension: fileExtension
				     },
				     function(data) {
					    //Si el tipo de mensaje es un error
						if(data.tipo_mensaje == 'error')
						{
							//Limpia ruta del archivo cargado
			  				$('#'+strBotonArchivoIDExpedienteClientesCuentasCobrar).val('');
						   	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_general_clientes_cuentas_cobrar('error', data.mensaje);
						}
						else
						{	
							//Hacer un llamado al método del controlador para subir archivo del registro
							$('#'+strBotonArchivoIDExpedienteClientesCuentasCobrar).upload('cuentas_cobrar/clientes/subir_archivo',
									{ intDocumentoID:documentoID,
						      		  intProspectoID:$('#txtProspectoID_expediente_clientes_cuentas_cobrar').val(),
						      		  strBotonArchivoID: strBotonArchivoIDExpedienteClientesCuentasCobrar
									},
									function(data) {
										//Limpia ruta del archivo cargado
						         		$('#'+strBotonArchivoIDExpedienteClientesCuentasCobrar).val('');
										//Subida finalizada.
										if (data.resultado)
										{
						         			//Hacer llamado a la función  para cargar  los registros de los documentos (expediente) en el grid
						          	        documentos_expediente_clientes_cuentas_cobrar();
										}
										//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
										mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
									});
						}
				     },
				     'json');
		}

		//Función que se utiliza para descargar el archivo (o imagen) del registro seleccionado
		function descargar_archivo_expediente_clientes_cuentas_cobrar(documentoID)
		{
			
			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'cuentas_cobrar/clientes/descargar_archivo',
							'data' : {
										'intProspectoID': $('#txtProspectoID_expediente_clientes_cuentas_cobrar').val(),
										'intDocumentoID': documentoID				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}


		//Función que se utiliza para eliminar el archivo (o imagen) del registro seleccionado
		function eliminar_archivo_expediente_clientes_cuentas_cobrar(documentoID)
		{
			//Hacer un llamado al método del controlador para eliminar el archivo del registro
			$.post('cuentas_cobrar/clientes/eliminar_archivo',
			     {intProspectoID: $('#txtProspectoID_expediente_clientes_cuentas_cobrar').val(),
			      intDocumentoID: documentoID
			     },
			     function(data) {
			        if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros de los documentos (expediente) en el grid
		          	    documentos_expediente_clientes_cuentas_cobrar();
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}


		/*******************************************************************************************************************
		Funciones del modal Clientes - Personas autorizadas a solicitar y recibir producto
		*********************************************************************************************************************/
		//Función que se utiliza para cerrar el modal
		function cerrar_autorizar_clientes_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objPersonasAutorizadasSolicitarRecibirClientesCuentasCobrar.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para abrir el modal
		function abrir_autorizar_clientes_cuentas_cobrar(id, tipoFormulario){

			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_personas_autorizadas_clientes_cuentas_cobrar');

			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_personas_autorizadas_clientes_cuentas_cobrar").hide();
			$("#btnDatosGenerales_personas_autorizadas_clientes_cuentas_cobrar").hide();
			$("#btnExpediente_personas_autorizadas_clientes_cuentas_cobrar").hide();
			$("#btnDatosCrediticios_personas_autorizadas_clientes_cuentas_cobrar").hide();
			$("#btnDesactivar_personas_autorizadas_clientes_cuentas_cobrar").hide();
			$("#btnRestaurar_personas_autorizadas_clientes_cuentas_cobrar").hide();
			//Mostrar el siguiente botón
			$("#btnNuevo_personas_autorizadas_clientes_cuentas_cobrar").show();

            //Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Dependiendo del tipo de formulario asignar id
			if(tipoFormulario == 'Datos Generales')
			{
				intID = $('#txtProspectoID_general_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Datos Crediticios')
			{
				intID = $('#txtProspectoID_credito_clientes_cuentas_cobrar').val();
			}
			else if(tipoFormulario == 'Expediente')
			{
				intID = $('#txtProspectoID_expediente_clientes_cuentas_cobrar').val();
			}
			else
			{
				intID = id;
				//Mostrar los siguientes botones
				$("#btnImprimirRegistro_personas_autorizadas_clientes_cuentas_cobrar").show();
				$("#btnDatosGenerales_personas_autorizadas_clientes_cuentas_cobrar").show();
				$("#btnExpediente_personas_autorizadas_clientes_cuentas_cobrar").show();
				$("#btnDatosCrediticios_personas_autorizadas_clientes_cuentas_cobrar").show();
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/clientes/get_datos',
			       {
			       		intProspectoID: intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

			            	//Hacer un llamado a la función para limpiar los campos del formulario
							//nuevo_credito_clientes_cuentas_cobrar();
				          	//Recuperar valores
				            $('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val(data.row.prospecto_id);
				            $('#txtCodigo_personas_autorizadas_clientes_cuentas_cobrar').val(data.row.codigo);
				            $('#txtRazonSocial_personas_autorizadas_clientes_cuentas_cobrar').val(data.row.razon_social);
				            $('#txtNombreComercial_personas_autorizadas_clientes_cuentas_cobrar').val(data.row.nombre_comercial);

				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_personas_autorizadas_clientes_cuentas_cobrar').addClass("estatus-"+strEstatus);
				            //Hacer llamado a la función  para cargar las personas autorizadas en el grid
				            paginacion_personas_autorizadas_clientes_cuentas_cobrar();

				            //Si el estatus del registro es INACTIVO
			            	if(strEstatus == 'INACTIVO')
			            	{
			            		$("#btnNuevo_personas_autorizadas_clientes_cuentas_cobrar").hide();
			            	}

				            //Si no existe tipo de formulario, significa que el id se obtuvo del grid view
				            if(tipoFormulario == '')
				            {
				            	//Si el estatus del registro es ACTIVO
				            	if(strEstatus == 'ACTIVO')
				            	{
				            		//Mostrar botón Desactivar
				            		$("#btnDesactivar_personas_autorizadas_clientes_cuentas_cobrar").show();
				            	}
				            	else
				            	{

				            		//Mostrar botón Restaurar
									$("#btnRestaurar_personas_autorizadas_clientes_cuentas_cobrar").show();
				            	}
				            }
				            
				            //Abrir modal
            				objPersonasAutorizadasSolicitarRecibirClientesCuentasCobrar = $('#PersonasAutorizadasSolicitarRecibirClientesCuentasCobrarBox').bPopup({
												  appendTo: '#ClientesCuentasCobrarContent', 
					                              contentContainer: 'ClientesCuentasCobrarM', 
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
		
		/*******************************************************************************************************************
		Funciones del modal Personas Autorizadas
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_personas_autorizadas_clientes_cuentas_cobrar() 
		{
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/clientes/get_paginacion_personas_autorizadas',
					{	intProspectoID:$('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val(),
						intPagina:intPaginaPersonasAutorizadasCreditoClientesCuentasCobrar,
						strPermisosAcceso: $('#txtAcciones_clientes_cuentas_cobrar').val()
					},
					function(data){
						$('#dg_personas_autorizadas_clientes_cuentas_cobrar tbody').empty();
						var tmpPersonasAutorizadasCreditoClientesCuentasCobrar = Mustache.render($('#plantilla_personas_autorizadas_clientes_cuentas_cobrar').html(),data);
						$('#dg_personas_autorizadas_clientes_cuentas_cobrar tbody').html(tmpPersonasAutorizadasCreditoClientesCuentasCobrar);
						$('#pagLinks_personas_autorizadas_clientes_cuentas_cobrar').html(data.paginacion);
						$('#numElementos_personas_autorizadas_clientes_cuentas_cobrar').html(data.total_rows);
						intPaginaPersonasAutorizadasCreditoClientesCuentasCobrar = data.pagina;
					},
			'json');

		}

		/*******************************************************************************************************************
		Funciones del modal de Registro Personas Autorizadas (SUBMODAL)
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_registro_personas_autorizadas_clientes_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmRegistroPersonasAutorizadasCreditoClientesCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_registro_personas_autorizadas_clientes_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmRegistroPersonasAutorizadasCreditoClientesCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_registro_personas_autorizadas_clientes_cuentas_cobrar');
			//Habilitar todos los elementos del formulario
			$('#frmRegistroPersonasAutorizadasCreditoClientesCuentasCobrar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_registro_personas_autorizadas_clientes_cuentas_cobrar").show();
			//Ocultar los siguientes botones
			$("#btnDescargarArchivoIFE_registro_personas_autorizadas_clientes_cuentas_cobrar").hide();
			$("#btnDescargarArchivoCarta_registro_personas_autorizadas_clientes_cuentas_cobrar").hide();
			$("#btnDesactivar_registro_personas_autorizadas_clientes_cuentas_cobrar").hide();
			$("#btnRestaurar_registro_personas_autorizadas_clientes_cuentas_cobrar").hide();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_registro_personas_autorizadas_clientes_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objRegistroPersonasAutorizadasCreditoClientesCuentasCobrar.close();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_registro_personas_autorizadas_clientes_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_registro_personas_autorizadas_clientes_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmRegistroPersonasAutorizadasCreditoClientesCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strNombre_registro_personas_autorizadas_clientes_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba un nombre'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_registro_personas_autorizadas_clientes_cuentas_cobrar = $('#frmRegistroPersonasAutorizadasCreditoClientesCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_registro_personas_autorizadas_clientes_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_registro_personas_autorizadas_clientes_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_registro_personas_autorizadas_clientes_cuentas_cobrar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_registro_personas_autorizadas_clientes_cuentas_cobrar()
		{
			try
			{
				$('#frmRegistroPersonasAutorizadasCreditoClientesCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_registro_personas_autorizadas_clientes_cuentas_cobrar()
		{
			
			//Obtenemos un array con los datos del archivo
    		var arrArchivoIFERegistroPersonasAutorizadasCreditoClientesCuentasCobrar = $("#ife_registro_personas_autorizadas_clientes_cuentas_cobrar")[0].files[0];
    		var arrArchivoCartaRegistroPersonasAutorizadasCreditoClientesCuentasCobrar = $("#carta_registro_personas_autorizadas_clientes_cuentas_cobrar")[0].files[0];
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_cobrar/clientes/guardar_personas_autorizadas',
					{ 
						intProspectoID: $('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val(),
						intRenglon: $('#txtRenglon_registro_personas_autorizadas_clientes_cuentas_cobrar').val(),
						strNombre: $('#txtNombre_registro_personas_autorizadas_clientes_cuentas_cobrar').val(),
						strNombreAnterior: $('#txtNombreAnterior_registro_personas_autorizadas_clientes_cuentas_cobrar').val()
					},
					function(data) {

						if (data.resultado)
						{	
							//Si existe archivo seleccionado y no existe renglón, significa que es un nuevo registro
							if($('#txtRenglon_registro_personas_autorizadas_clientes_cuentas_cobrar').val() == '' && (arrArchivoIFERegistroPersonasAutorizadasCreditoClientesCuentasCobrar != undefined || arrArchivoCartaRegistroPersonasAutorizadasCreditoClientesCuentasCobrar != undefined))
			                {
			                	//Asignar el renglón registrado en la base de datos
                     			$('#txtRenglon_registro_personas_autorizadas_clientes_cuentas_cobrar').val(data.renglon);

                     			//Si se cargaron los archivos ife y carta
                     			if(arrArchivoIFERegistroPersonasAutorizadasCreditoClientesCuentasCobrar != undefined && arrArchivoCartaRegistroPersonasAutorizadasCreditoClientesCuentasCobrar != undefined)
                     			{

                     				//Hacer un llamado a las funciones para subir los archivos
			                    	subir_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar('ife','Nuevo_todos');
			                    	subir_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar('carta','Nuevo');
                     			}
                     			else if(arrArchivoIFERegistroPersonasAutorizadasCreditoClientesCuentasCobrar != undefined)
                     			{
                     				//Hacer un llamado a la función para subir el archivo
                     				subir_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar('ife','Nuevo');
                     			}
                     			else
                     			{	//Hacer un llamado a la función para subir el archivo
                     				subir_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar('carta','Nuevo');
                     			}
			                }
			                else
			                {
								//Hacer un llamado a la función para cerrar modal
								cerrar_registro_personas_autorizadas_clientes_cuentas_cobrar();
			                }

			                //Hacer llamado a la función  para cargar los registros en el grid
							paginacion_personas_autorizadas_clientes_cuentas_cobrar();           
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
						
					},
			'json');
			
		}

		// Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_registro_personas_autorizadas_clientes_cuentas_cobrar(renglon,estatus)
		{
			//Variable que se utiliza para asignar el renglón del registro
			var intRenglonID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe renglón, significa que se realizará la modificación desde el modal
			if(renglon == '')
			{
				intRenglonID = $('#txtRenglon_registro_personas_autorizadas_clientes_cuentas_cobrar').val();

			}
			else
			{
				intRenglonID = renglon;
				strTipo = 'gridview';
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
				             {'type':     'question',
				              'title':    'Personas Autorizadas',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_registro_personas_autorizadas_clientes_cuentas_cobrar(intRenglonID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_registro_personas_autorizadas_clientes_cuentas_cobrar(intRenglonID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_registro_personas_autorizadas_clientes_cuentas_cobrar(renglon, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('cuentas_cobrar/clientes/set_estatus_personas_autorizadas',
			      {intProspectoID: $('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val(),
			       intRenglon: renglon,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_personas_autorizadas_clientes_cuentas_cobrar();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_registro_personas_autorizadas_clientes_cuentas_cobrar();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}
		


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_registro_personas_autorizadas_clientes_cuentas_cobrar(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/clientes/get_datos_personas_autorizadas',
			       {
			       		intProspectoID: $('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val(),
			       		strBusqueda:busqueda,
			       		strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_registro_personas_autorizadas_clientes_cuentas_cobrar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtRenglon_registro_personas_autorizadas_clientes_cuentas_cobrar').val(data.row.renglon);
				            $('#txtNombre_registro_personas_autorizadas_clientes_cuentas_cobrar').val(data.row.nombre);
				            $('#txtNombreAnterior_registro_personas_autorizadas_clientes_cuentas_cobrar').val(data.row.nombre);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_registro_personas_autorizadas_clientes_cuentas_cobrar').addClass("estatus-"+strEstatus);

				            //Si existe archivo IFE del registro
				           	if(data.archivo_ife != '')
				           	{
				           		//Mostrar botón Descargar Archivo IFE
				            	$("#btnDescargarArchivoIFE_registro_personas_autorizadas_clientes_cuentas_cobrar").show();
				           	}

				           	//Si existe archivo Carta del registro
				           	if(data.archivo_carta != '')
				           	{
				           		//Mostrar botón Descargar Archivo Carta
				            	$("#btnDescargarArchivoCarta_registro_personas_autorizadas_clientes_cuentas_cobrar").show();
				           	}

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_registro_personas_autorizadas_clientes_cuentas_cobrar").show();
							}
							else 
							{	
							
								//Deshabilitar todos los elementos del formulario
			            		$('#frmRegistroPersonasAutorizadasCreditoClientesCuentasCobrar').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_registro_personas_autorizadas_clientes_cuentas_cobrar").hide();
								//Mostrar botón Restaurar
								$("#btnRestaurar_registro_personas_autorizadas_clientes_cuentas_cobrar").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
								objRegistroPersonasAutorizadasCreditoClientesCuentasCobrar = $('#RegistroPersonasAutorizadasCreditoClientesCuentasCobrarBox').bPopup({
																			  appendTo: '#ClientesCuentasCobrarContent', 
												                              contentContainer: 'ClientesCuentasCobrarM', 
												                              zIndex: 2, 
												                              modalClose: false, 
												                              modal: true, 
												                              follow: [true,false], 
												                              followEasing : "linear", 
												                              easing: "linear", 
												                              modalColor: ('#F0F0F0')});
								//Enfocar caja de texto
								$('#txtNombre_registro_personas_autorizadas_clientes_cuentas_cobrar').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Función para subir archivo (o imagen) de un registro
		function subir_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar(tipoArchivo,tipoAccion)
		{
			//Variable que se utiliza para asignar archivo
			var strBotonArchivoIDRegistroPersonasAutorizadasCreditoClientesCuentasCobrar = "";
    		//Dependiendo del tipo asignar archivo
			if(tipoArchivo == 'ife')
			{
				strBotonArchivoIDRegistroPersonasAutorizadasCreditoClientesCuentasCobrar ="ife_registro_personas_autorizadas_clientes_cuentas_cobrar";
			}
			else
			{
				strBotonArchivoIDRegistroPersonasAutorizadasCreditoClientesCuentasCobrar ="carta_registro_personas_autorizadas_clientes_cuentas_cobrar";
			}

			//Obtenemos un array con los datos del archivo
	        var file = $("#"+strBotonArchivoIDRegistroPersonasAutorizadasCreditoClientesCuentasCobrar)[0].files[0];
	        //Variable que se utiliza para asignar la extensión del archivo seleccionado
   			var fileExtension = "";
	        //Obtenemos el nombre del archivo
	        var fileName = file.name;
	        //Obtenemos la extensión del archivo
	        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
	        //Obtenemos el tamaño del archivo
	        var fileSize = file.size;
	        //Obtenemos el tipo de archivo image/png ejemplo
	        var fileType = file.type;
	        //Comprobar extensión del archivo
	        $.post('cuentas_cobrar/clientes/comprobar_extension_archivo',
				     {strExtension: fileExtension
				     },
				     function(data) {
					    //Si el tipo de mensaje es un error
						if(data.tipo_mensaje == 'error')
						{
							//Limpia ruta del archivo cargado
			  				$('#'+strBotonArchivoIDRegistroPersonasAutorizadasCreditoClientesCuentasCobrar).val('');
						   	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_general_clientes_cuentas_cobrar('error', data.mensaje);
						}
						else
						{	
							//Si existe renglón subir el archivo
							if($('#txtRenglon_registro_personas_autorizadas_clientes_cuentas_cobrar').val() != '')
				        	{	
								//Hacer un llamado al método del controlador para subir archivo del registro
								$('#'+strBotonArchivoIDRegistroPersonasAutorizadasCreditoClientesCuentasCobrar).upload('cuentas_cobrar/clientes/subir_archivo_personas_autorizadas',
										{ 
											intProspectoID:$('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val(),
						                  	intRenglon:$('#txtRenglon_registro_personas_autorizadas_clientes_cuentas_cobrar').val(),
						                  	strBotonArchivoID: strBotonArchivoIDRegistroPersonasAutorizadasCreditoClientesCuentasCobrar,
						                  	strTipoArchivo: tipoArchivo
										},
										function(data) {
											//Limpia ruta del archivo cargado
							         		$('#'+strBotonArchivoIDRegistroPersonasAutorizadasCreditoClientesCuentasCobrar).val('');
											
											//Subida finalizada.
											if (data.resultado)
											{
												//Dependiendo del tipo mostrar botón para descargar el archivo
												if(tipoArchivo == 'ife')
												{
													//Mostrar botón Descargar Archivo IFE
				            						$("#btnDescargarArchivoIFE_registro_personas_autorizadas_clientes_cuentas_cobrar").show();
												}
												else
												{
													//Mostrar botón Descargar Archivo Carta
				            						$("#btnDescargarArchivoCarta_registro_personas_autorizadas_clientes_cuentas_cobrar").show();
												}

												//Hacer llamado a la función  para cargar  los registros en el grid
									        	paginacion_personas_autorizadas_clientes_cuentas_cobrar(); 
											}

											//Si la acción corresponde a un nuevo registro
						                    if(tipoAccion == 'Nuevo' || tipoAccion == 'Nuevo_todos')
						                    {
								                //Si el tipo de mensaje es un éxito
								                if(data.tipo_mensaje == 'éxito' && tipoAccion == 'Nuevo')
								                {
									                //Hacer un llamado a la función para cerrar modal
									                cerrar_registro_personas_autorizadas_clientes_cuentas_cobrar();
								                }

								               	//Si el tipo de mensaje es un error
								                if(data.tipo_mensaje == 'error')
								                {
								                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
									    			mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
								                }
						                    }
						                    else
						                    {
						                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
									    		mensaje_general_clientes_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
						                    }

										});
							}
						}
				     },
				     'json');
		}

		//Función que se utiliza para descargar el archivo (o imagen) del registro seleccionado
		function descargar_archivo_registro_personas_autorizadas_clientes_cuentas_cobrar(renglon, tipoArchivo)
		{
			//Variable que se utiliza para asignar el renglón del registro
			var intRenglonID = 0;
			//Si no existe renglón, significa que se descargara el archivo desde el modal
			if(renglon == '')
			{
				intRenglonID = $('#txtRenglon_registro_personas_autorizadas_clientes_cuentas_cobrar').val();

			}
			else
			{
				intRenglonID = renglon;
			}

			
			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'cuentas_cobrar/clientes/descargar_archivo_personas_autorizadas',
							'data' : {
										'intProspectoID': $('#txtProspectoID_personas_autorizadas_clientes_cuentas_cobrar').val(),
										'intRenglon': intRenglonID, 
										'strTipoArchivo':	tipoArchivo		
									 }
						   };

			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}
		

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Clientes - Datos Generales
			*********************************************************************************************************************/
        	//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtCodigoPostal_general_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtTelefonoPrincipal_general_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtTelefonoSecundario_general_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtContactoTelefono_general_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtContactoCelular_general_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtContactoExtension_general_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	

        	//Autocomplete para recuperar los datos de un régimen fiscal 
	        $('#txtRegimenFiscal_general_clientes_cuentas_cobrar').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRegimenFiscalID_general_clientes_cuentas_cobrar').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_regimen_fiscal/autocomplete",
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
	               $('#txtRegimenFiscalID_general_clientes_cuentas_cobrar').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del régimen fiscal cuando pierda el enfoque la caja de texto
	        $('#txtRegimenFiscal_general_clientes_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del régimen fiscal 
	            if($('#txtRegimenFiscalID_general_clientes_cuentas_cobrar').val() == '' || 
	               $('#txtRegimenFiscal_general_clientes_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de la caja de texto
	               $('#txtRegimenFiscalID_general_clientes_cuentas_cobrar').val('');
	               $('#txtRegimenFiscal_general_clientes_cuentas_cobrar').val('');
	            }
	            
	        });

			//Autocomplete para recuperar los datos de un código postal 
	        $('#txtCodigoPostal_general_clientes_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCodigoPostalID_general_clientes_cuentas_cobrar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_codigos_postales/autocomplete",
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
	             $('#txtCodigoPostalID_general_clientes_cuentas_cobrar').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del código postal cuando pierda el enfoque la caja de texto
	        $('#txtCodigoPostal_general_clientes_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del código postal
	            if($('#txtCodigoPostalID_general_clientes_cuentas_cobrar').val() == '' ||
	               $('#txtCodigoPostal_general_clientes_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCodigoPostalID_general_clientes_cuentas_cobrar').val('');
	               $('#txtCodigoPostal_general_clientes_cuentas_cobrar').val('');
	            }

	        });

			//Autocomplete para recuperar los datos de un municipio 
	        $('#txtMunicipio_general_clientes_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtMunicipioID_general_clientes_cuentas_cobrar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/municipios/autocomplete",
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
	             $('#txtMunicipioID_general_clientes_cuentas_cobrar').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/municipios/get_datos',
	                  { 
	                  	strBusqueda:$("#txtMunicipioID_general_clientes_cuentas_cobrar").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtMunicipio_general_clientes_cuentas_cobrar").val(data.row.municipio);
	                       $("#txtEstado_general_clientes_cuentas_cobrar").val(data.row.estado);
	                       $("#txtPais_general_clientes_cuentas_cobrar").val(data.row.pais);
	                    }
	                  }
	                 ,
	                'json');
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	         //Verificar que exista id del municipio cuando pierda el enfoque la caja de texto
	        $('#txtMunicipio_general_clientes_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del municipio
	            if($('#txtMunicipioID_general_clientes_cuentas_cobrar').val() == '' || 
	            	$('#txtMunicipio_general_clientes_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMunicipioID_general_clientes_cuentas_cobrar').val('');
	               $('#txtMunicipio_general_clientes_cuentas_cobrar').val('');
	               $('#txtEstado_general_clientes_cuentas_cobrar').val('');
	               $('#txtPais_general_clientes_cuentas_cobrar').val('');
	            }
	            
	        });

	        /*******************************************************************************************************************
			Controles correspondientes al modal Clientes - Datos Crediticios
			*********************************************************************************************************************/
			 /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Información General
        	*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
			$('#txtNumeroCuenta_credito_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtMaquinariaCreditoDias_credito_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtRefaccionesCreditoDias_credito_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtServicioCreditoDias_credito_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtMaquinariaCreditoLimite_credito_clientes_cuentas_cobrar').numeric();
        	$('#txtRefaccionesCreditoLimite_credito_clientes_cuentas_cobrar').numeric();
        	$('#txtServicioCreditoLimite_credito_clientes_cuentas_cobrar').numeric();
			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_clientes_cuentas_cobrar').blur(function(){
				$('.moneda_clientes_cuentas_cobrar').formatCurrency({ roundToDecimalPlace: 2 });
			});
        	//Agregar datepicker para seleccionar fecha
			$('#dteFechaInicioCredito_credito_clientes_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});


			//Autocomplete para recuperar los datos de un uso del CFDI
	        $('#txtUsoCfdi_credito_clientes_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsoCfdiID_credito_clientes_cuentas_cobrar').val('');
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
	             $('#txtUsoCfdiID_credito_clientes_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtUsoCfdi_credito_clientes_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del uso de CFDI
	            if($('#txtUsoCfdiID_credito_clientes_cuentas_cobrar').val() == '' ||
	               $('#txtUsoCfdi_credito_clientes_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUsoCfdiID_credito_clientes_cuentas_cobrar').val('');
	               $('#txtUsoCfdi_credito_clientes_cuentas_cobrar').val('');
	            }
	            
	        });

			//Autocomplete para recuperar los datos de una lista de precios de maquinaria
	        $('#txtMaquinariaListaPrecio_credito_clientes_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMaquinariaListaPrecioID_credito_clientes_cuentas_cobrar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "maquinaria/maquinaria_listas_precios/autocomplete",
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
	             $('#txtMaquinariaListaPrecioID_credito_clientes_cuentas_cobrar').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del lista de precio de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMaquinariaListaPrecio_credito_clientes_cuentas_cobrar').focusout(function(e){
	            //Si no existe id de la lista de precios de maquinaria
	            if($('#txtMaquinariaListaPrecioID_credito_clientes_cuentas_cobrar').val() == '' ||
	               $('#txtMaquinariaListaPrecio_credito_clientes_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaListaPrecioID_credito_clientes_cuentas_cobrar').val('');
	               $('#txtMaquinariaListaPrecio_credito_clientes_cuentas_cobrar').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una lista de precios de refacciones
	        $('#txtRefaccionesListaPrecio_credito_clientes_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtRefaccionesListaPrecioID_credito_clientes_cuentas_cobrar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/refacciones_listas_precios/autocomplete",
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
	             $('#txtRefaccionesListaPrecioID_credito_clientes_cuentas_cobrar').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del lista de precios de refacciones cuando pierda el enfoque la caja de texto
	        $('#txtRefaccionesListaPrecio_credito_clientes_cuentas_cobrar').focusout(function(e){
	            //Si no existe id de la lista de precios de refacciones
	            if($('#txtRefaccionesListaPrecioID_credito_clientes_cuentas_cobrar').val() == '' ||
	               $('#txtRefaccionesListaPrecio_credito_clientes_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtRefaccionesListaPrecioID_credito_clientes_cuentas_cobrar').val('');
	               $('#txtRefaccionesListaPrecio_credito_clientes_cuentas_cobrar').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una lista de precios de servicio
			$('#txtServicioListaPrecio_credito_clientes_cuentas_cobrar').autocomplete({
			    source: function( request, response ) {
			       //Limpiar caja de texto que hace referencia al id del registro 
			       $('#txtServicioListaPrecioID_credito_clientes_cuentas_cobrar').val('');
			       $.ajax({
			         //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
			         url: "refacciones/refacciones_listas_precios/autocomplete",
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
			     $('#txtServicioListaPrecioID_credito_clientes_cuentas_cobrar').val(ui.item.data);
			   },
			   open: function() {
			       $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			     },
			     close: function() {
			       $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			     },
			   minLength: 1
			});

			//Verificar que exista id del lista de precios de refacciones cuando pierda el enfoque la caja de texto
			$('#txtServicioListaPrecio_credito_clientes_cuentas_cobrar').focusout(function(e){
			    //Si no existe id de la lista de precios de refacciones
			    if($('#txtServicioListaPrecioID_credito_clientes_cuentas_cobrar').val() == '' ||
			       $('#txtServicioListaPrecio_credito_clientes_cuentas_cobrar').val() == '')
			    { 
			       //Limpiar contenido de las siguientes cajas de texto
			       $('#txtServicioListaPrecioID_credito_clientes_cuentas_cobrar').val('');
			       $('#txtServicioListaPrecio_credito_clientes_cuentas_cobrar').val('');
			    }

			});

	        //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter)
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });

	        /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Cuentas Bancarias
        	*********************************************************************************************************************/
        	/*******************************************************************************************************************
			Funciones del modal Cuentas Bancarias
			*********************************************************************************************************************/
        	//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});

        	//Comprobar la existencia de la cuenta bancaria en la BD cuando pierda el enfoque la caja de texto
			$('#txtCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtRenglon_cuentas_bancarias_credito_clientes_cuentas_cobrar').val() == '' && $('#txtCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el nombre 
					editar_cuentas_bancarias_credito_clientes_cuentas_cobrar($('#txtCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar').val(), 'cuenta', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de un banco
	        $('#txtBanco_cuentas_bancarias_credito_clientes_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtBancoID_cuentas_bancarias_credito_clientes_cuentas_cobrar').val('');
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
	             $('#txtBancoID_cuentas_bancarias_credito_clientes_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtBanco_cuentas_bancarias_credito_clientes_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del banco
	            if($('#txtBancoID_cuentas_bancarias_credito_clientes_cuentas_cobrar').val() == '' ||
	               $('#txtBanco_cuentas_bancarias_credito_clientes_cuentas_cobrar').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtBancoID_cuentas_bancarias_credito_clientes_cuentas_cobrar').val('');
	                $('#txtBanco_cuentas_bancarias_credito_clientes_cuentas_cobrar').val('');
	            }
	            
	        });

        	//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_cuentas_bancarias_credito_clientes_cuentas_cobrar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_cuentas_bancarias_credito_clientes_cuentas_cobrar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_cuentas_bancarias_credito_clientes_cuentas_cobrar').addClass("estatus-NUEVO");
				//Abrir modal
				objCuentasBancariasCreditoClientesCuentasCobrar = $('#CuentasBancariasCreditoClientesCuentasCobrarBox').bPopup({
																  appendTo: '#ClientesCuentasCobrarContent', 
									                              contentContainer: 'ClientesCuentasCobrarM', 
									                              zIndex: 2, 
									                              modalClose: false, 
									                              modal: true, 
									                              follow: [true,false], 
									                              followEasing : "linear", 
									                              easing: "linear", 
									                              modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCuenta_cuentas_bancarias_credito_clientes_cuentas_cobrar').focus();
			});

			//Paginación de registros
			$('#pagLinks_cuentas_bancarias_credito_clientes_cuentas_cobrar').on('click','a',function(event){
				event.preventDefault();
				intPaginaCuentasBancariasCreditoClientesCuentasCobrar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar los registros en el grid
				paginacion_cuentas_bancarias_credito_clientes_cuentas_cobrar();
			});

	        /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Referencias
        	*********************************************************************************************************************/
        	/*******************************************************************************************************************
			Funciones del modal Referencias
			*********************************************************************************************************************/
        	//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtTelefono_referencias_credito_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtExtension_referencias_credito_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtPlazoCredito_referencias_credito_clientes_cuentas_cobrar').numeric({decimal: false, negative: false});
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporteCredito_referencias_credito_clientes_cuentas_cobrar').numeric();

        	//Comprobar la existencia del nombre en la BD cuando pierda el enfoque la caja de texto
			$('#txtNombre_referencias_credito_clientes_cuentas_cobrar').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtRenglon_referencias_credito_clientes_cuentas_cobrar').val() == '' && $('#txtNombre_referencias_credito_clientes_cuentas_cobrar').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el nombre 
					editar_referencias_credito_clientes_cuentas_cobrar($('#txtNombre_referencias_credito_clientes_cuentas_cobrar').val(), 'nombre', 'Nuevo');
				}
			});


        	//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_referencias_credito_clientes_cuentas_cobrar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_referencias_credito_clientes_cuentas_cobrar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_referencias_credito_clientes_cuentas_cobrar').addClass("estatus-NUEVO");
				//Abrir modal
				objReferenciasCreditoClientesCuentasCobrar = $('#ReferenciasCreditoClientesCuentasCobrarBox').bPopup({
															  appendTo: '#ClientesCuentasCobrarContent', 
								                              contentContainer: 'ClientesCuentasCobrarM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtNombre_referencias_credito_clientes_cuentas_cobrar').focus();
			});

			//Paginación de registros
			$('#pagLinks_referencias_credito_clientes_cuentas_cobrar').on('click','a',function(event){
				event.preventDefault();
				intPaginaReferenciasCreditoClientesCuentasCobrar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar los registros en el grid
				paginacion_referencias_credito_clientes_cuentas_cobrar();
			});


        	/*******************************************************************************************************************
			Funciones del modal Personas Autorizadas
			*********************************************************************************************************************/
			//Comprobar la existencia del nombre en la BD cuando pierda el enfoque la caja de texto
			$('#txtNombre_registro_personas_autorizadas_clientes_cuentas_cobrar').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtRenglon_registro_personas_autorizadas_clientes_cuentas_cobrar').val() == '' && $('#txtNombre_registro_personas_autorizadas_clientes_cuentas_cobrar').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el nombre 
					editar_registro_personas_autorizadas_clientes_cuentas_cobrar($('#txtNombre_registro_personas_autorizadas_clientes_cuentas_cobrar').val(), 'nombre', 'Nuevo');
				}
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_personas_autorizadas_clientes_cuentas_cobrar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_registro_personas_autorizadas_clientes_cuentas_cobrar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_registro_personas_autorizadas_clientes_cuentas_cobrar').addClass("estatus-NUEVO");
				//Abrir modal
				objRegistroPersonasAutorizadasCreditoClientesCuentasCobrar = $('#RegistroPersonasAutorizadasCreditoClientesCuentasCobrarBox').bPopup({
																	  appendTo: '#ClientesCuentasCobrarContent', 
										                              contentContainer: 'ClientesCuentasCobrarM', 
										                              zIndex: 2, 
										                              modalClose: false, 
										                              modal: true, 
										                              follow: [true,false], 
										                              followEasing : "linear", 
										                              easing: "linear", 
										                              modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtNombre_registro_personas_autorizadas_clientes_cuentas_cobrar').focus();
			});

			//Paginación de registros
			$('#pagLinks_personas_autorizadas_clientes_cuentas_cobrar').on('click','a',function(event){
				event.preventDefault();
				intPaginaPersonasAutorizadasCreditoClientesCuentasCobrar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar los registros en el grid
				paginacion_personas_autorizadas_clientes_cuentas_cobrar();
			});


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_clientes_cuentas_cobrar').on('click','a',function(event){
				event.preventDefault();
				intPaginaClientesCuentasCobrar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_clientes_cuentas_cobrar();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_clientes_cuentas_cobrar').focus();

			//Deshabilitar los siguientes botones (funciones de permisos de acceso)
			$('#btnImprimir_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnDescargarXLS_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnBuscar_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnImprimirRegistro_general_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnDesactivar_general_clientes_cuentas_cobrar').attr('disabled','-1'); 
			$('#btnRestaurar_general_clientes_cuentas_cobrar').attr('disabled','-1');   
			$('#btnImprimirRegistro_credito_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnDesactivar_credito_clientes_cuentas_cobrar').attr('disabled','-1'); 
			$('#btnRestaurar_credito_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnAdjuntarIFE_personas_autorizadas_clientes_cuentas_cobrar').attr('disabled','-1'); 
			$('#btnAdjuntarCarta_personas_autorizadas_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnDescargarArchivoIFE_personas_autorizadas_clientes_cuentas_cobrar').attr('disabled','-1'); 
			$('#btnDescargarArchivoCarta_personas_autorizadas_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnDesactivar_personas_autorizadas_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnRestaurar_personas_autorizadas_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnDesactivar_cuentas_bancarias_credito_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnRestaurar_cuentas_bancarias_credito_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnDesactivar_referencias_credito_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnRestaurar_referencias_credito_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnImprimirRegistro_expediente_clientes_cuentas_cobrar').attr('disabled','-1');
			$('#btnRestaurar_expediente_clientes_cuentas_cobrar').attr('disabled','-1'); 
			$('#btnDesactivar_expediente_clientes_cuentas_cobrar').attr('disabled','-1'); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_clientes_cuentas_cobrar();
		});
	</script>