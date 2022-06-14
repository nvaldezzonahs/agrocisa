	<div id="CuentasBancariasCuentasPagarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_cuentas_bancarias_cuentas_pagar" action="#" method="post" tabindex="-5"
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_cuentas_bancarias_cuentas_pagar" 
								   name="strBusqueda_cuentas_bancarias_cuentas_pagar"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_cuentas_bancarias_cuentas_pagar"
										onclick="paginacion_cuentas_bancarias_cuentas_pagar();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_cuentas_bancarias_cuentas_pagar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_cuentas_bancarias_cuentas_pagar"
									onclick="reporte_cuentas_bancarias_cuentas_pagar();" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_cuentas_bancarias_cuentas_pagar"
									onclick="descargar_xls_cuentas_bancarias_cuentas_pagar();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas
				*/
				td.movil:nth-of-type(1):before {content: "Cuenta"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "CLABE"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Moneda"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Banco"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Contacto"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_cuentas_bancarias_cuentas_pagar">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Cuenta</th>
							<th class="movil">CLABE</th>
							<th class="movil">Moneda</th>
							<th class="movil">Banco</th>
							<th class="movil">Contacto</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_cuentas_bancarias_cuentas_pagar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{cuenta}}</td>
							<td class="movil">{{clabe}}</td>
							<td class="movil">{{moneda}}</td>
							<td class="movil">{{banco}}</td>
							<td class="movil">{{contacto_nombre}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_cuentas_bancarias_cuentas_pagar({{cuenta_bancaria_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_cuentas_bancarias_cuentas_pagar({{cuenta_bancaria_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_cuentas_bancarias_cuentas_pagar({{cuenta_bancaria_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_cuentas_bancarias_cuentas_pagar({{cuenta_bancaria_id}},'{{estatus}}')"  
										title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
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
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_cuentas_bancarias_cuentas_pagar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_cuentas_bancarias_cuentas_pagar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="CuentasBancariasCuentasPagarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_cuentas_bancarias_cuentas_pagar"  class="ModalBodyTitle">
			<h1>Cuentas Bancarias</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCuentasBancariasCuentasPagar" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmCuentasBancariasCuentasPagar"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Cuenta-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCuentaBancariaID_cuentas_bancarias_cuentas_pagar" 
										   name="intCuentaBancariaID_cuentas_bancarias_cuentas_pagar" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la cuenta anterior y así evitar duplicidad en caso de que exista otro registro con la misma cuenta-->
									<input id="txtCuentaAnterior_cuentas_bancarias_cuentas_pagar" 
										   name="strCuentaAnterior_cuentas_bancarias_cuentas_pagar" type="hidden" value="">
									</input>
									<label for="txtCuenta_cuentas_bancarias_cuentas_pagar">Cuenta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuenta_cuentas_bancarias_cuentas_pagar" 
											name="strCuenta_cuentas_bancarias_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese cuenta" maxlength="20">
									</input>
								</div>
							</div>
						</div>
						<!--Clabe-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtClabe_cuentas_bancarias_cuentas_pagar">CLABE</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtClabe_cuentas_bancarias_cuentas_pagar" 
											name="strClabe_cuentas_bancarias_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese CLABE" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Combobox que contiene las monedas activas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbMonedaID_cuentas_bancarias_cuentas_pagar">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_cuentas_bancarias_cuentas_pagar" 
									 		name="intMonedaID_cuentas_bancarias_cuentas_pagar" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene los bancos activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id del banco seleccionado-->
									<input id="txtBancoID_cuentas_bancarias_cuentas_pagar" 
										   name="intBancoID_cuentas_bancarias_cuentas_pagar" type="hidden" value="">
									</input>
									<label for="txtBanco_cuentas_bancarias_cuentas_pagar">Banco</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtBanco_cuentas_bancarias_cuentas_pagar" 
											name="strBanco_cuentas_bancarias_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese un banco" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_cuentas_bancarias_cuentas_pagar">Nombre</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_cuentas_bancarias_cuentas_pagar" 
											name="strDescripcion_cuentas_bancarias_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese nombre" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Datos de contacto-->
                        <h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Datos de contacto</h4>
                        <!--Nombre-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtContactoNombre_cuentas_bancarias_cuentas_pagar">Nombre</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtContactoNombre_cuentas_bancarias_cuentas_pagar" 
											name="strContactoNombre_cuentas_bancarias_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese nombre" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Teléfono de oficina-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtContactoTelefono_cuentas_bancarias_cuentas_pagar">Teléfono de oficina</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtContactoTelefono_cuentas_bancarias_cuentas_pagar" 
											name="strContactoTelefono_cuentas_bancarias_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese teléfono" maxlength="10">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Extensión-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtContactoExtension_cuentas_bancarias_cuentas_pagar">Extensión</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtContactoExtension_cuentas_bancarias_cuentas_pagar" 
											name="strContactoExtension_cuentas_bancarias_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese extensión" maxlength="5">
									</input>
								</div>
							</div>
						</div>
						<!--Celular-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtContactoCelular_cuentas_bancarias_cuentas_pagar">Celular</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtContactoCelular_cuentas_bancarias_cuentas_pagar" 
											name="strContactoCelular_cuentas_bancarias_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese celular" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Correo electrónico-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtContactoCorreoElectronico_cuentas_bancarias_cuentas_pagar">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtContactoCorreoElectronico_cuentas_bancarias_cuentas_pagar" 
											name="strContactoCorreoElectronico_cuentas_bancarias_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
				    </div>				    
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_cuentas_bancarias_cuentas_pagar"  
									onclick="validar_cuentas_bancarias_cuentas_pagar();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_cuentas_bancarias_cuentas_pagar"  
									onclick="cambiar_estatus_cuentas_bancarias_cuentas_pagar('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_cuentas_bancarias_cuentas_pagar"  
									onclick="cambiar_estatus_cuentas_bancarias_cuentas_pagar('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cuentas_bancarias_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_cuentas_bancarias_cuentas_pagar();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#CuentasBancariasCuentasPagarContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_cuentas_bancarias_cuentas_pagar" type="text/template">
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
		var intPaginaCuentasBancariasCuentasPagar = 0;
		var strUltimaBusquedaCuentasBancariasCuentasPagar = "";
		//Variable que se utiliza para asignar objeto del modal
		var objCuentasBancariasCuentasPagar = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_cuentas_bancarias_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_pagar/cuentas_bancarias/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_cuentas_bancarias_cuentas_pagar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCuentasBancariasCuentasPagar = data.row;
					//Separar la cadena 
					var arrPermisosCuentasBancariasCuentasPagar = strPermisosCuentasBancariasCuentasPagar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCuentasBancariasCuentasPagar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCuentasBancariasCuentasPagar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_cuentas_bancarias_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosCuentasBancariasCuentasPagar[i]=='GUARDAR') || (arrPermisosCuentasBancariasCuentasPagar[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_cuentas_bancarias_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosCuentasBancariasCuentasPagar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_cuentas_bancarias_cuentas_pagar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_cuentas_bancarias_cuentas_pagar();
						}
						else if(arrPermisosCuentasBancariasCuentasPagar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_cuentas_bancarias_cuentas_pagar').removeAttr('disabled');
							$('#btnRestaurar_cuentas_bancarias_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosCuentasBancariasCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_cuentas_bancarias_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosCuentasBancariasCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_cuentas_bancarias_cuentas_pagar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_cuentas_bancarias_cuentas_pagar() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_cuentas_bancarias_cuentas_pagar').val() != strUltimaBusquedaCuentasBancariasCuentasPagar)
			{
				intPaginaCuentasBancariasCuentasPagar = 0;
				strUltimaBusquedaCuentasBancariasCuentasPagar = $('#txtBusqueda_cuentas_bancarias_cuentas_pagar').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_pagar/cuentas_bancarias/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_cuentas_bancarias_cuentas_pagar').val(),
						intPagina:intPaginaCuentasBancariasCuentasPagar,
						strPermisosAcceso: $('#txtAcciones_cuentas_bancarias_cuentas_pagar').val()
					},
					function(data){
						$('#dg_cuentas_bancarias_cuentas_pagar tbody').empty();
						var tmpCuentasBancariasCuentasPagar = Mustache.render($('#plantilla_cuentas_bancarias_cuentas_pagar').html(),data);
						$('#dg_cuentas_bancarias_cuentas_pagar tbody').html(tmpCuentasBancariasCuentasPagar);
						$('#pagLinks_cuentas_bancarias_cuentas_pagar').html(data.paginacion);
						$('#numElementos_cuentas_bancarias_cuentas_pagar').html(data.total_rows);
						intPaginaCuentasBancariasCuentasPagar = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_cuentas_bancarias_cuentas_pagar() 
		{
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("cuentas_pagar/cuentas_bancarias/get_reporte/"+$('#txtBusqueda_cuentas_bancarias_cuentas_pagar').val());
			
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_cuentas_bancarias_cuentas_pagar()  
		{
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
			window.open("cuentas_pagar/cuentas_bancarias/get_xls/"+$('#txtBusqueda_cuentas_bancarias_cuentas_pagar').val());
		}
		
		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_cuentas_bancarias_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_cuentas_bancarias_cuentas_pagar').empty();
					var temp = Mustache.render($('#monedas_cuentas_bancarias_cuentas_pagar').html(), data);
					$('#cmbMonedaID_cuentas_bancarias_cuentas_pagar').html(temp);
				},
				'json');
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_cuentas_bancarias_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmCuentasBancariasCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cuentas_bancarias_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmCuentasBancariasCuentasPagar').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_cuentas_bancarias_cuentas_pagar').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_cuentas_bancarias_cuentas_pagar').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_cuentas_bancarias_cuentas_pagar').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmCuentasBancariasCuentasPagar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtCuentaContable_cuentas_bancarias_cuentas_pagar').attr("disabled", "disabled");			
			//Mostrar botón Guardar
			$("#btnGuardar_cuentas_bancarias_cuentas_pagar").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_cuentas_bancarias_cuentas_pagar").hide();
			$("#btnRestaurar_cuentas_bancarias_cuentas_pagar").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cuentas_bancarias_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objCuentasBancariasCuentasPagar.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_cuentas_bancarias_cuentas_pagar').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cuentas_bancarias_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cuentas_bancarias_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmCuentasBancariasCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCuenta_cuentas_bancarias_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba una cuenta bancaria'}
											}
										},
										strClabe_cuentas_bancarias_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba una clabe'}
											}
										},
										intMonedaID_cuentas_bancarias_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										strBanco_cuentas_bancarias_cuentas_pagar: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id del banco
						                                    if($('#txtBancoID_cuentas_bancarias_cuentas_pagar').val() === '')
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
										strDescripcion_cuentas_bancarias_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un nombre'}
											}
										},
										strContactoNombre_cuentas_bancarias_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un nombre de contacto'}
											}
										},
										strContactoTelefono_cuentas_bancarias_cuentas_pagar: {
											validators: {
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strContactoCelular_cuentas_bancarias_cuentas_pagar: {
											validators: {
												stringLength: {
													min: 10,
													message: 'El número de celular debe tener 10 caracteres de longitud'
												}
											}
										},
										strContactoCorreoElectronico_cuentas_bancarias_cuentas_pagar: {
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
			var bootstrapValidator_cuentas_bancarias_cuentas_pagar = $('#frmCuentasBancariasCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_cuentas_bancarias_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cuentas_bancarias_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_cuentas_bancarias_cuentas_pagar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cuentas_bancarias_cuentas_pagar()
		{
			try
			{
				$('#frmCuentasBancariasCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_cuentas_bancarias_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_pagar/cuentas_bancarias/guardar',
					{ 
						intCuentaBancariaID: $('#txtCuentaBancariaID_cuentas_bancarias_cuentas_pagar').val(),
						intBancoID: $('#txtBancoID_cuentas_bancarias_cuentas_pagar').val(),
						strCuenta: $('#txtCuenta_cuentas_bancarias_cuentas_pagar').val(),
						strCuentaAnterior: $('#txtCuentaAnterior_cuentas_bancarias_cuentas_pagar').val(),
						strClabe: $('#txtClabe_cuentas_bancarias_cuentas_pagar').val(),
						strDescripcion: $('#txtDescripcion_cuentas_bancarias_cuentas_pagar').val(),
						intMonedaID: $('#cmbMonedaID_cuentas_bancarias_cuentas_pagar').val(),
						strContactoNombre: $('#txtContactoNombre_cuentas_bancarias_cuentas_pagar').val(),
						strContactoTelefono: $('#txtContactoTelefono_cuentas_bancarias_cuentas_pagar').val(),
						strContactoExtension: $('#txtContactoExtension_cuentas_bancarias_cuentas_pagar').val(),
						strContactoCelular: $('#txtContactoCelular_cuentas_bancarias_cuentas_pagar').val(),
						strContactoCorreoElectronico: $('#txtContactoCorreoElectronico_cuentas_bancarias_cuentas_pagar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_cuentas_bancarias_cuentas_pagar();
							//Hacer un llamado a la función para cerrar modal
							cerrar_cuentas_bancarias_cuentas_pagar();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cuentas_bancarias_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cuentas_bancarias_cuentas_pagar(tipoMensaje, mensaje)
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
		function cambiar_estatus_cuentas_bancarias_cuentas_pagar(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCuentaBancariaID_cuentas_bancarias_cuentas_pagar').val();

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
						              'title':    'Cuentas Bancarias',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
						                              $.post('cuentas_pagar/cuentas_bancarias/set_estatus',
						                                     {intCuentaBancariaID: intID,
						                                      strEstatus: estatus
						                                     },
						                                     function(data) {
						                                        if(data.resultado)
						                                        {
						                                          	//Hacer llamado a la función  para cargar  los registros en el grid
						                                          	paginacion_cuentas_bancarias_cuentas_pagar();

						                                          	//Si el id del registro se obtuvo del modal
																	if(id == '')
																	{
																		//Hacer un llamado a la función para cerrar modal
																		cerrar_cuentas_bancarias_cuentas_pagar();     
																	}
						                                        }
						                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						                                        mensaje_cuentas_bancarias_cuentas_pagar(data.tipo_mensaje, data.mensaje);
						                                     },
						                                    'json');
						                            }
						                          }
						              });
				    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('cuentas_pagar/cuentas_bancarias/set_estatus',
				     {intCuentaBancariaID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_cuentas_bancarias_cuentas_pagar();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_cuentas_bancarias_cuentas_pagar();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_cuentas_bancarias_cuentas_pagar(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_cuentas_bancarias_cuentas_pagar(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_pagar/cuentas_bancarias/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cuentas_bancarias_cuentas_pagar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtCuentaBancariaID_cuentas_bancarias_cuentas_pagar').val(data.row.cuenta_bancaria_id);
				            $('#txtBancoID_cuentas_bancarias_cuentas_pagar').val(data.row.banco_id);
				            $('#txtBanco_cuentas_bancarias_cuentas_pagar').val(data.row.banco);
				            $('#txtCuenta_cuentas_bancarias_cuentas_pagar').val(data.row.cuenta);
				            $('#txtCuentaAnterior_cuentas_bancarias_cuentas_pagar').val(data.row.cuenta);
				            $('#txtClabe_cuentas_bancarias_cuentas_pagar').val(data.row.clabe);
				            $('#txtDescripcion_cuentas_bancarias_cuentas_pagar').val(data.row.descripcion);
				            $('#cmbMonedaID_cuentas_bancarias_cuentas_pagar').val(data.row.moneda_id);
				            $('#txtContactoNombre_cuentas_bancarias_cuentas_pagar').val(data.row.contacto_nombre);
				            $('#txtContactoTelefono_cuentas_bancarias_cuentas_pagar').val(data.row.contacto_telefono);
				            $('#txtContactoExtension_cuentas_bancarias_cuentas_pagar').val(data.row.contacto_extension);
				            $('#txtContactoCelular_cuentas_bancarias_cuentas_pagar').val(data.row.contacto_celular);
				            $('#txtContactoCorreoElectronico_cuentas_bancarias_cuentas_pagar').val(data.row.contacto_correo_electronico);
				            $('#txtCuentaContable_cuentas_bancarias_cuentas_pagar').val(data.row.cuenta_contable);
				            
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_cuentas_bancarias_cuentas_pagar').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_cuentas_bancarias_cuentas_pagar").show();
							}
							else 
							{	
								//Ocultar botón Guardar
					           	$("#btnGuardar_cuentas_bancarias_cuentas_pagar").hide(); 
								//Deshabilitar todos los elementos del formulario
				            	$('#frmCuentasBancariasCuentasPagar').find('input, textarea, select').attr('disabled','disabled');
								//Mostrar botón Restaurar
								$("#btnRestaurar_cuentas_bancarias_cuentas_pagar").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objCuentasBancariasCuentasPagar = $('#CuentasBancariasCuentasPagarBox').bPopup({
															  appendTo: '#CuentasBancariasCuentasPagarContent', 
								                              contentContainer: 'CuentasBancariasCuentasPagarM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCuenta_cuentas_bancarias_cuentas_pagar').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtCuenta_cuentas_bancarias_cuentas_pagar').numeric({decimal: false, negative: false});
        	$('#txtClabe_cuentas_bancarias_cuentas_pagar').numeric({decimal: false, negative: false});
        	$('#txtContactoTelefono_cuentas_bancarias_cuentas_pagar').numeric({decimal: false, negative: false});
        	$('#txtContactoExtension_cuentas_bancarias_cuentas_pagar').numeric({decimal: false, negative: false});
        	$('#txtContactoCelular_cuentas_bancarias_cuentas_pagar').numeric({decimal: false, negative: false});
        	
			//Comprobar la existencia de la cuenta en la BD cuando pierda el enfoque la caja de texto
			$('#txtCuenta_cuentas_bancarias_cuentas_pagar').focusout(function(e){
				//Si no existe id, verificar la existencia de la cuenta
				if ($('#txtCuentaBancariaID_cuentas_bancarias_cuentas_pagar').val() == '' && $('#txtCuenta_cuentas_bancarias_cuentas_pagar').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la cuenta 
					editar_cuentas_bancarias_cuentas_pagar($('#txtCuenta_cuentas_bancarias_cuentas_pagar').val(), 'cuenta', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de un cliente
	        $('#txtBanco_cuentas_bancarias_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtBancoID_cuentas_bancarias_cuentas_pagar').val('');
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
	             $('#txtBancoID_cuentas_bancarias_cuentas_pagar').val(ui.item.data);
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
	        $('#txtBanco_cuentas_bancarias_cuentas_pagar').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtBancoID_cuentas_bancarias_cuentas_pagar').val() == '' ||
	               $('#txtBanco_cuentas_bancarias_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtBancoID_cuentas_bancarias_cuentas_pagar').val('');
	               $('#txtBanco_cuentas_bancarias_cuentas_pagar').val('');
	            }

	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_cuentas_bancarias_cuentas_pagar').on('click','a',function(event){
				event.preventDefault();
				intPaginaCuentasBancariasCuentasPagar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_cuentas_bancarias_cuentas_pagar();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_cuentas_bancarias_cuentas_pagar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_cuentas_bancarias_cuentas_pagar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_cuentas_bancarias_cuentas_pagar').addClass("estatus-NUEVO");
				//Abrir modal
				 objCuentasBancariasCuentasPagar = $('#CuentasBancariasCuentasPagarBox').bPopup({
											   appendTo: '#CuentasBancariasCuentasPagarContent', 
				                               contentContainer: 'CuentasBancariasCuentasPagarM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCuenta_cuentas_bancarias_cuentas_pagar').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_cuentas_bancarias_cuentas_pagar').focus();

			   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_cuentas_bancarias_cuentas_pagar();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_cuentas_bancarias_cuentas_pagar();
		});
	</script>