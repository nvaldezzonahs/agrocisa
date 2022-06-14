
    <div id="MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculosContent">  
        <!--Barra de herramientas-->
        <div class="panel-toolbar">
            <!--Diseño del formulario de Búsquedas-->
            <form class="form-horizontal" id="frmBusqueda_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" action="#" method="post" tabindex="-5" 
                  onsubmit="return(false)">
                <div class="row">
                    <!--Fecha inicial-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="txtFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Fecha inicial</label>
                            </div>
                            <div class="col-md-12">
                                <div class='input-group date' id='dteFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos'>
                                    <input class="form-control" 
                                            id="txtFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"
                                            name= "strFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
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
                                <label for="txtFechaFinalBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Fecha final</label>
                            </div>
                            <div class="col-md-12">
                                <div class='input-group date' id='dteFechaFinalBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos'>
                                    <input class="form-control" 
                                            id="txtFechaFinalBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"
                                            name= "strFechaFinalBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                            type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Autocomplete que contiene los departamentos activos-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- Caja de texto oculta que se utiliza para recuperar el id del departamento seleccionado-->
                                <input id="txtDepartamentoIDBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                       name="intDepartamentoIDBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"  
                                       type="hidden" value="">
                                </input>
                                <label for="txtDepartamentoBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Departamento</label>
                            </div>
                            <div class="col-md-12">
                                <input  class="form-control" id="txtDepartamentoBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                        name="strDepartamentoBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese departamento" maxlength="250">
                                </input>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="cmbEstatusBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Estatus</label>
                            </div>
                            <div class="col-md-12">
                                <select class="form-control" id="cmbEstatusBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                        name="strEstatusBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" tabindex="1">
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
                                <label for="txtBusqueda_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Descripción</label>
                            </div>
                            <div class="col-md-12">
                                <input  class="form-control" id="txtBusqueda_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                        name="strBusqueda_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
                                </input>
                            </div>
                        </div>
                    </div>
                    <!--Mostrar detalles de los registros en el reporte PDF--> 
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
                        <div class="checkbox">
                            <label id="label-checkbox">
                                <input class="form-control" 
                                        id="chbImprimirDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                        name="strImprimirDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
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
                            <button class="btn btn-primary" id="btnBuscar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"
                                    onclick="paginacion_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();" 
                                    title="Buscar coincidencias" tabindex="1" disabled> 
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                            <!--Dar de alta un nuevo registro-->
                            <button class="btn btn-info" id="btnNuevo_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                    title="Nuevo registro" tabindex="1" disabled> 
                                <span class="glyphicon glyphicon-list-alt"></span>
                            </button>   
                             <!--Generar PDF con el listado de registros-->
                            <button class="btn btn-default"  id="btnImprimir_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"
                                    onclick="reporte_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
                                <span class="glyphicon glyphicon-print"></span>
                            </button> 
                            <!--Descargar archivo XLS con el listado de registros-->
                            <button class="btn btn-success"  id="btnDescargarXLS_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"
                                    onclick="reporte_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
                                <span class="fa fa-file-excel-o"></span>
                            </button>  
                        </div>
                    </div>
                </div>
                <div class="row">

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
                td.movil.a3:nth-of-type(3):before {content: "Departamento"; font-weight: bold;}
                td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
                td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

                /*
                Definir columnas de la tabla detalles del movimiento
                */
                td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
                td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
                td.movil.b3:nth-of-type(3):before {content: "Gasto"; font-weight: bold;}
                td.movil.b4:nth-of-type(4):before {content: "Cantidad"; font-weight: bold;}
                td.movil.b5:nth-of-type(5):before {content: "Costo Unit."; font-weight: bold;}
                td.movil.b6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
                td.movil.b7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

                /*
                Definir columnas de los totales (acumulados) de la tabla detalles del movimiento
                */
                td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
                td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
                td.movil.t3:nth-of-type(3):before {content: ""; font-weight: bold;}
                td.movil.t4:nth-of-type(4):before {content: "Cantidad"; font-weight: bold;}
                td.movil.t5:nth-of-type(5):before {content: ""; font-weight: bold;}
                td.movil.t6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
            }
        </style>
        <!--Panel que contiene la tabla con los registros encontrados-->
        <div class="panel-content">
            <div class="container-fluid">
                <!-- Diseño de la tabla-->
                <table class="table-hover movil" id="dg_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">
                    <thead class="movil">
                        <tr class="movil">
                            <th class="movil">Folio</th>
                            <th class="movil">Fecha</th>
                            <th class="movil">Departamento</th>
                            <th class="movil">Estatus</th>
                            <th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="movil"></tbody>
                    <script id="plantilla_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" type="text/template"> 
                    {{#rows}}
                        <tr class="movil {{estiloRegistro}}">   
                            <td class="movil a1">{{folio}}</td>
                            <td class="movil a2">{{fecha}}</td>
                            <td class="movil a3">{{departamento}}</td>
                            <td class="movil a4">{{estatus}}</td>
                            <td class="td-center movil a5"> 
                                <!--Editar registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
                                        onclick="editar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos({{movimiento_refacciones_internas_id}}, 'Editar')"  title="Editar">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </button>
                                <!--Ver registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
                                        onclick="editar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos({{movimiento_refacciones_internas_id}}, 'Ver')"  title="Ver">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </button>
                                <!--Generar PDF con los datos del registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
                                        onclick="reporte_registro_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos({{movimiento_refacciones_internas_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
                                </button>
                                  <button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
                                        onclick="generar_poliza_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos({{movimiento_refacciones_internas_id}}, 'principal')"  title="Generar póliza">
                                    <span class="glyphicon glyphicon-tags"></span>
                                </button>
                                <!--Desactivar registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
                                        onclick="cambiar_estatus_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos({{movimiento_refacciones_internas_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
                    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"></div>
                    <!--Número de registros encontrados-->
                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                        <button class="btn btn-default btn-sm disabled pull-right">
                            <strong id="numElementos_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">0</strong> encontrados
                        </button>
                    </div>
                </div> <!--Cierre del diseño de la paginación-->
            </div><!--#container-fluid-->
        </div><!--Cierre del contenedor de la tabla-->
        <!--Circulo de progreso-->
        <div id="divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
            <div class="loader">Loading...</div>
            <br><br>
            <div align=center><b>Espere un momento por favor.</b></div>
        </div>  

        <!-- Diseño del modal-->
        <div id="MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculosBox" class="ModalBody">
            <!--Título-->
            <div id="divEncabezadoModal_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"  class="ModalBodyTitle">
            <h1>Salidas por Consumo Interno</h1>
            </div>
            <!--Contenido-->
            <div class="ModalBodyContent">
                <!--Diseño del formulario-->
                <form id="frmMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
                      name="frmMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos"  onsubmit="return(false)" autocomplete="off">
                    <div class="row">
                        <!-- Folio -->
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
                                    <input id="txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                           name="intMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                           type="hidden" value="" />
                                    <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
                                    <input id="txtPolizaID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                           name="intPolizaID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" type="hidden" value="" />
                                    <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
                                    <input id="txtFolioPoliza_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                           name="strFolioPoliza_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" type="hidden" value="" />
                                    <label for="txtFolio_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Folio</label>
                                </div>
                                <div class="col-md-12">
                                    <input  class="form-control" id="txtFolio_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                            name="strFolio_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                            type="text" value="" placeholder="Autogenerado" disabled />
                                </div>
                            </div>
                        </div>
                        <!-- Fecha -->
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="txtFecha_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Fecha</label>
                                </div>
                                <div id="divFechaMsjValidacion" class="col-md-12">
                                    <div class='input-group date' id='dteFecha_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos'>
                                        <input class="form-control" 
                                                id="txtFecha_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"
                                                name= "strFecha_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Autocomplete que contiene los departamentos activos-->
                        <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <!-- Caja de texto oculta que se utiliza para recuperar el id del departamento  seleccionado-->
                                    <input id="txtDepartamentoID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                           name="intDepartamentoID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"  
                                           type="hidden"  value="">
                                    </input>
                                    <label for="txtDepartamento_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Departamento</label>
                                </div>  
                                <div class="col-md-12">
                                    <input  class="form-control" 
                                            id="txtDepartamento_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                            name="strDepartamento_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                            type="text" value="" tabindex="1" placeholder="Ingrese departamento" maxlength="250" />
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <!-- Observaciones -->
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="txtObservaciones_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Observaciones</label>
                                </div>  
                                <div class="col-md-12">
                                    <input  class="form-control" 
                                            id="txtObservaciones_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                            name="strObservaciones_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
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
                                    <input id="txtNumDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                           name="intNumDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" type="hidden" value="">
                                    </input>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Detalles de la salida por consumo interno</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                <div class="row">
                                                    <!--Tipo de gasto-->
                                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Tipo de gasto</label>
                                                            </div>
                                                            <div id="divCmbMsjValidacion" class="col-md-12">
                                                                <select class="form-control" id="cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        name="strTipo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" tabindex="1">
                                                                    <option value="">Seleccione una opción</option>
                                                                    <option value="GASTOS DE VENTA">GASTOS DE VENTA</option>
                                                                    <option value="GASTOS DE ADMINISTRACION">GASTOS DE ADMINISTRACION</option>
                                                                    <option value="GASTOS CORPORATIVOS">GASTOS CORPORATIVOS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Combobox que contiene las sucursales activas-->
                                                    <div id="divCmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Sucursal</label>
                                                            </div>
                                                            <div id="divCmbMsjValidacion" class="col-md-12">
                                                                <select class="form-control" id="cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        name="intSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" tabindex="1">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Combobox que contiene los módulos activos-->
                                                    <div id="divCmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" class="col-sm-3 col-md-3 col-lg-3 col-xs-12 no-mostrar">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Departamento</label>
                                                            </div>
                                                            <div id="divCmbMsjValidacion" class="col-md-12">
                                                                <select class="form-control" id="cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        name="intModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" tabindex="1">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Combobox que contiene los tipos de gastos activos (correspondientes al tipo)-->
                                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Gasto</label>
                                                            </div>
                                                            <div id="divCmbMsjValidacion" class="col-md-12">
                                                                <select class="form-control" id="cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        name="strGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" tabindex="1">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!--Autocomplete que contiene las refacciones activas-->
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <!-- Caja de texto oculta para recuperar el id de la  refacción seleccionada-->
                                                                <input id="txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                       name="intRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                <!-- Caja de texto oculta para recuperar el código de la línea de refacción de la refacción seleccionada-->
                                                                <input id="txtCodigoLinea_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                       name="strCodigoLinea_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                <!-- Caja de texto oculta para recuperar la existencia actual  de la refacción (en el inventario)  seleccionada-->
                                                                <input id="txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                       name="intActualExistencia_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                <label for="txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">
                                                                    Código
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control" 
                                                                        id="txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        name="strCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        type="text" value="" tabindex="1" 
                                                                        placeholder="Ingrese código" maxlength="250" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Autocomplete que contiene las refacciones activas-->
                                                    <div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">
                                                                    Descripción
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control" 
                                                                        id="txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        name="strDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        type="text" value="" tabindex="1" 
                                                                        placeholder="Ingrese descripción" maxlength="250" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Cantidad-->
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">
                                                                    Cantidad
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control cantidad_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        id="txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        name="intCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        type="text" value="" tabindex="1"
                                                                        placeholder="Ingrese cantidad" maxlength="14" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Costo unitario-->
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">Costo unitario</label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control" 
                                                                        id="txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        name="intCostoUnitario_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                        type="text" value="" disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Botón agregar-->
                                                    <div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                                                        <button class="btn btn-primary btn-toolBtns pull-right" 
                                                                id="btnAgregar_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" 
                                                                onclick="agregar_renglon_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();" 
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
                                                    <table class="table-hover movil" id="dg_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">
                                                        <thead class="movil">
                                                            <tr class="movil">
                                                                <th class="movil">Código</th>
                                                                <th class="movil">Descripción</th>
                                                                <th class="movil">Gasto</th>
                                                                <th class="movil">Cantidad</th>
                                                                <th class="movil">Costo Unit.</th>
                                                                <th class="movil">Subtotal</th>
                                                                <th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="movil"></tbody>
                                                        <tfoot class="movil">
                                                            <tr class="movil">
                                                                <td class="movil t1">
                                                                    <strong>Total</strong>
                                                                </td>
                                                                <td class="movil t2"></td>
                                                                <td class="movil t3"></td>
                                                                <td  class="movil t4">
                                                                    <strong id="acumCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"></strong>
                                                                </td>
                                                                <td class="movil t5"></td>
                                                                <td class="movil t6">
                                                                    <strong id="acumSubtotal_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"></strong>
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
                                                                <strong id="numElementos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos">0</strong> encontrados
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
                    <div id="divCirculoBarProgreso_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
                        <div class="loader">Loading...</div>
                        <br><br>
                        <div align=center><b>Espere un momento por favor.</b></div>
                    </div> 
                    <!--Botones de acción (barra de tareas)-->
                    <div class="btn-group row footerModal">
                        <div class="col-md-12">
                            <!--Guardar registro-->
                            <button class="btn btn-success" id="btnGuardar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"  
                                    onclick="validar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
                                <span class="fa fa-floppy-o"></span>
                            </button>
                            <!--Generar PDF con los datos del registro-->
                            <button class="btn btn-default" 
                                    id="btnImprimirRegistro_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"  
                                    onclick="reporte_registro_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos('');"  
                                    title="Imprimir" tabindex="3" disabled>
                                <span class="glyphicon glyphicon-print"></span>
                            </button>
                            <!--Desactivar registro-->
                            <button class="btn btn-default" id="btnDesactivar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"  
                                    onclick="cambiar_estatus_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos('','','');"  title="Desactivar" tabindex="4" disabled>
                                <span class="glyphicon glyphicon-ban-circle"></span>
                            </button>
                            <!--Cerrar modal-->
                            <button class="btn  btn-cerrar"  id="btnCerrar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"
                                    type="reset" aria-hidden="true" onclick="cerrar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();" 
                                    title="Cerrar"  tabindex="5">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    </div>
                </form><!--Cierre del formulario-->
            </div><!--Cierre del contenido-->
        </div><!--Cierre del modal-->
    </div><!--#MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculosContent -->

    <!-- /.Plantilla para cargar las sucursales en el combobox-->  
    <script id="sucursales_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" type="text/template">
        <option value="">Seleccione una opción</option>
        {{#sucursales}}
        <option value="{{value}}">{{nombre}}</option>
        {{/sucursales}} 
    </script>
    <!-- /.Plantilla para cargar los módulos en el combobox-->  
    <script id="modulos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" type="text/template">
        <option value="">Seleccione una opción</option>
        {{#modulos}}
        <option value="{{value}}">{{nombre}}</option>
        {{/modulos}} 
    </script>
    <!-- /.Plantilla para cargar los tipos de gastos en el combobox-->  
    <script id="gastos_tipos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos" type="text/template">
        <option value="">Seleccione una opción</option>
        {{#gastos_tipos}}
        <option value="{{value}}">{{nombre}}</option>
        {{/gastos_tipos}} 
    </script>

    <!--Javascript con las funciones del formulario-->
    <script type="text/javascript">
        /*******************************************************************************************************************
        Funciones del formulario principal
        *********************************************************************************************************************/
        //Variables que se utilizan para la paginación de registros
        var intPaginaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = 0;
        var strUltimaBusquedaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = "";
          /*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
        var strTipoReferenciaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = "MOVIMIENTO DE REFACCIONES INTERNAS";
        //Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
        var intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
        //Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
        var intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = <?php echo NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES ?>;
        //Variable que se utiliza para asignar la descripción de la cuenta 602
        var strCuenta602MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = <?php echo DESCRIPCION_CUENTA_602 ?>;
        //Variable que se utiliza para asignar la descripción de la cuenta 603
        var strCuenta603MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = <?php echo DESCRIPCION_CUENTA_603 ?>;

        //Variable que se utiliza para asignar el id de la moneda base
        var intMonedaBaseIDMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = <?php echo MONEDA_BASE ?>;
        //Variable que se utiliza para asignar objeto del modal
        var objMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = null;

        //Permisos  de acceso del usuario (Acciones Generales)
        function permisos_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
            //Hacer un llamado al método del controlador para regresar los permisos de acceso
            $.post('control_vehiculos/movimientos_salidas_refacciones_internas_consumo_interno/get_permisos_acceso',
            { 
                strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()
            },
            function(data){
                //Si existen permisos de acceso del usuario para este proceso
                if (data.row)
                {
                    //Asignar a la variable la cadena concatenada con los permisos de acceso
                    //del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
                    var strPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = data.row;
                    //Separar la cadena 
                    var arrPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = strPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos.split('|');

                    //Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
                    for (var i=0; i < arrPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos.length; i++)
                    {
                        //Habilitar Acción si se cuenta con  permiso de acceso
                        if(arrPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
                        {
                            //Habilitar el control (botón nuevo)
                            $('#btnNuevo_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').removeAttr('disabled');
                        }
                        //Si el indice es GUARDAR ó EDITAR (modificar)
                        else if((arrPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos[i]=='GUARDAR') || (arrPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos[i]=='EDITAR'))
                        {
                            //Habilitar el control (botón guardar)
                            $('#btnGuardar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
                        {
                            //Habilitar el control (botón buscar)
                            $('#btnBuscar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').removeAttr('disabled');
                            //Hacer llamado a la función  para cargar  los registros en el grid
                            paginacion_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                        }
                        else if(arrPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
                        {
                            //Habilitar los siguientes controles
                            $('#btnDesactivar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
                        {
                            //Habilitar el control (botón imprimir)
                            $('#btnImprimir_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
                        {
                            //Habilitar el control (botón imprimir)
                            $('#btnImprimirRegistro_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
                        {
                            //Habilitar el control (botón descargar XLS)
                            $('#btnDescargarXLS_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').removeAttr('disabled');
                        }
                    }//Cerrar for
                }
            },
            'json');
        }

        //Función para la búsqueda de registros
        function paginacion_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos() 
        {
           //Concatenar datos para la nueva búsqueda
            var strNuevaBusquedaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos =($('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()+$('#txtFechaFinalBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()+$('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()+$('#cmbEstatusBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()+$('#txtBusqueda_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val());
            //Verificar si hubo cambios en la búsqueda
            if(strNuevaBusquedaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos != strUltimaBusquedaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos)
            {
                intPaginaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = 0;
                strUltimaBusquedaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = strNuevaBusquedaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos;
            }

            //Hacer un llamado al método del controlador para regresar listado de registros
            $.post('control_vehiculos/movimientos_salidas_refacciones_internas_consumo_interno/get_paginacion',
                    { //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
                      dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()),
                      dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()),
                      intDepartamentoID: $('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(),
                      strEstatus:     $('#cmbEstatusBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(),
                      strBusqueda:    $('#txtBusqueda_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(),
                      intPagina: intPaginaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos,
                      strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()
                    },
                    function(data){
                        $('#dg_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos tbody').empty();
                        var tmpMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = Mustache.render($('#plantilla_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(),data);
                        $('#dg_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos tbody').html(tmpMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos);
                        $('#pagLinks_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(data.paginacion);
                        $('#numElementos_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(data.total_rows);
                        intPaginaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = data.pagina;
                    },
            'json');
        }

         //Función para cargar/descargar el reporte general en PDF/XLS
        function reporte_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(strTipo) 
        {
            //Variable que se utiliza para asignar URL (ruta del controlador)
            var strUrl = 'control_vehiculos/movimientos_salidas_refacciones_internas_consumo_interno/';

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
            if ($('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').is(':checked')) {
                //Asignar SI para incluir detalles en el reporte
                $('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('SI');
            }
            else
            { 
               //Asignar NO para  no incluir detalles en el reporte
               $('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('NO');
            }


            //Definir encapsulamiento de datos que son necesarios para generar el reporte
            objReporte = {'url': strUrl,
                            'data' : {
                                        'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()),
                                        'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()),
                                        'intDepartamentoID': $('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(),
                                        'strEstatus': $('#cmbEstatusBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(), 
                                        'strBusqueda': $('#txtBusqueda_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(),
                                        'strDetalles': $('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()       
                                     }
                           };


            //Hacer un llamado a la función para imprimir/descargar el reporte
            $.imprimirReporte(objReporte);

        }

        //Función para cargar el reporte de un registro en PDF
        function reporte_registro_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(id) 
        {
            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Si no existe id, significa que se realizará la impresión desde el modal
            if(id == '')
            {
                intID = $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
            }
            else
            {
                intID = id;
            }


            //Definir encapsulamiento de datos que son necesarios para generar el reporte
            objReporte = {'url': 'control_vehiculos/movimientos_salidas_refacciones_internas_consumo_interno/get_reporte_registro',
                            'data' : {
                                        'intMovimientoRefaccionesInternasID': intID
                                     }
                           };

            //Hacer un llamado a la función para imprimir el reporte
            $.imprimirReporte(objReporte);
        }

        
        //Regresar sucursales activas para cargarlas en el combobox
        function cargar_sucursales_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
            //Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
            $.post('administracion/sucursales/get_combo_box', {},
                function(data)
                {
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').empty();
                    var temp = Mustache.render($('#sucursales_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(), data);
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(temp);
                },
                'json');
        }


        //Regresar módulos activos para cargarlos en el combobox
        function cargar_modulos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
            //Hacer un llamado al método del controlador para regresar los módulos que se encuentran activos 
            $.post('crm/modulos/get_combo_box', {},
                function(data)
                {
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').empty();
                    var temp = Mustache.render($('#modulos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(), data);
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(temp);
                },
                'json');
        }

        //Regresar gastos activos para cargarlos en el combobox
        function cargar_gastos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(intGastoTipoID = 0)
        {   
            //Asignar el tipo de gasto
            var strTipo = $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
           
            //Hacer un llamado al método del controlador para regresar los gastos que se encuentran activos 
            $.post('cuentas_pagar/gastos_tipos/get_combo_box/'+strTipo, {},
                function(data)
                {
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').empty();
                    var temp = Mustache.render($('#gastos_tipos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(), data);
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(temp);

                    //Si existe id del tipo de gasto
                    if(intGastoTipoID > 0)
                    {
                        //Asignar el id del tipo de gasto
                        $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(intGastoTipoID);
                    }
                },
                'json');
        }


        /*******************************************************************************************************************
        Funciones del modal
        *********************************************************************************************************************/
        // Función para limpiar los campos del formulario
        function nuevo_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
            //Incializar formulario
            $('#frmMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos')[0].reset();
            //Hacer un llamado a la función para limpiar los mensajes de error 
            limpiar_mensajes_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
            //Limpiar cajas de texto ocultas
            $('#frmMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos').find('input[type=hidden]').val('');
            //Asignar la fecha actual
            $('#txtFecha_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(fechaActual()); 
             //Eliminar los datos de la tabla detalles del movimiento
            $('#dg_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos tbody').empty();
            $('#acumCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html('');
            $('#acumSubtotal_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html('');
            $('#numElementos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(0);
            //Limpiar contenido de los siguientes combobox
            $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
            $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').empty();
            //Hacer un llamado a la función para mostrar u ocultar sucursal y/o módulo
            mostrar_cmb_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
            //Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
            $.removerClasesEncabezado('divEncabezadoModal_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos');

            //Habilitar todos los elementos del formulario
            $('#frmMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
            //Deshabilitar las siguientes cajas de texto
            $('#txtFolio_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').attr("disabled", "disabled");
            $("#txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").attr('disabled','disabled');
            //Habilitar botón Agregar
            $('#btnAgregar_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').prop('disabled', false);
            //Mostrar los siguientes botones
            $("#btnGuardar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").show();
            //Ocultar los siguientes botones
            $("#btnImprimirRegistro_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").hide();
            $("#btnDesactivar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").hide();
        }

        //Función que se utiliza para cerrar el modal
        function cerrar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
            try {
                //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
                ocultar_circulo_carga_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos('');
                //Cerrar modal
                objMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos.close();
                //Enfocar caja de texto 
                $('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                
            }
            catch(err) {}
        }

        //Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
        function validar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
            //Hacer un llamado a la función para limpiar los mensajes de error 
            limpiar_mensajes_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
            //Validación del formulario de campos obligatorios
            $('#frmMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos')
                .bootstrapValidator({   excluded: [':disabled'],
                                        container: 'popover',
                                        feedbackIcons: {
                                            valid: 'glyphicon glyphicon-ok',
                                            invalid: 'glyphicon glyphicon-remove',
                                            validating: 'glyphicon glyphicon-refresh'
                                        },
                                        fields: {
                                            strFecha_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos: {
                                                validators: {
                                                    notEmpty: {message: 'Seleccione una fecha'}
                                                }
                                            },
                                            strDepartamento_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos: {
                                                validators: {
                                                    callback: {
                                                        callback: function(value, validator, $field) {
                                                            //Verificar que exista id del departamento
                                                            if($('#txtDepartamentoID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() === '')
                                                            {
                                                                return {
                                                                    valid: false,
                                                                    message: 'Escriba un departamento existente'
                                                                };
                                                            }
                                                            return true;
                                                        }
                                                    }
                                                }
                                            },
                                            intNumDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos: {
                                                validators: {
                                                    callback: {
                                                        callback: function(value, validator, $field) {
                                                            //Verificar que existan detalles
                                                            if(parseInt(value) === 0 || value === '')
                                                            {
                                                                return {
                                                                    valid: false,
                                                                    message: 'Agregar al menos un detalle para esta salida por consumo interno.'
                                                                };
                                                            }
                                                            return true;
                                                        }
                                                    }
                                                }
                                            },
                                            strCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos: {
                                                excluded: true  // Ignorar (no valida el campo)    
                                            },
                                            strDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos:{
                                                excluded: true  // Ignorar (no valida el campo)    
                                            },
                                            intCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos: {
                                                excluded: true  // Ignorar (no valida el campo)    
                                            }
                                        }
                                    });
            //Variable que se utiliza para asignar el objeto bootstrapValidator
            var bootstrapValidator_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos = $('#frmMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos').data('bootstrapValidator');
            bootstrapValidator_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos.validate();
            //Si se cumplen las reglas de validación
            if(bootstrapValidator_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos.isValid())
            {
                //Hacer un llamado a la función para validar que los detalles cuenten con tipo de gasto
                validar_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
            }
            else 
                return;
        }


        //Función que se utiliza para validar que los detalles cuenten con gasto
        function validar_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
            //Obtenemos el objeto de la tabla detalles
            var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').getElementsByTagName('tbody')[0];

            //Inicializamos las variables que obtendrán los datos de la tabla
            var arrRefaccionID = [];
            var arrCodigos = [];
            var arrDescripciones = [];
            var arrCodigosLineas = [];
            var arrCantidades = [];
            var arrCostosUnitarios = [];
            var arrSucursalID = [];
            var arrModuloID = [];
            var arrGastoTipoID = [];

            //Array que se utiliza para agregar los detalles que no tienen: gasto
            var arrDatosFaltantes = [];

             //Recorrer los renglones de la tabla para obtener los valores
            for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
            {
                //Variables que se utilizan para asignar valores del detalle
                var strCodigo = objRen.cells[0].innerHTML;
                var strDescripcion = objRen.cells[1].innerHTML;
                //Hacer un llamado a la función para reemplazar ',' por cadena vacia
                var intCantidad =  $.reemplazar(objRen.cells[3].innerHTML, ",", "");
                var intCostoUnitario = $.reemplazar(objRen.cells[9].innerHTML, ",", "");
                var intGastoTipoID = parseInt(objRen.cells[13].innerHTML);

                //Concatenar los datos de la referencia
                var strReferencia = strCodigo+' - '+strDescripcion;

                //Si existe id del tipo de gasto 
                if(intGastoTipoID > 0)
                {
                    //Asignar valores a los arrays
                    arrRefaccionID.push(objRen.getAttribute('id'));
                    arrCodigos.push(strCodigo);
                    arrDescripciones.push(strDescripcion);
                    arrCodigosLineas.push(objRen.cells[7].innerHTML);
                    arrCantidades.push(intCantidad);
                    arrCostosUnitarios.push(intCostoUnitario);
                    arrSucursalID.push(objRen.cells[11].innerHTML);
                    arrModuloID.push(objRen.cells[12].innerHTML);
                    arrGastoTipoID.push(objRen.cells[13].innerHTML);
                }
                else
                {
                    //Agregar referencia en el array, de esta manera, el usuario identificara los detalles sin tipo de gasto
                    arrDatosFaltantes.push(strReferencia);
                }
               
            }

            //Si existen referencias sin tipo de gasto
            if(arrDatosFaltantes.length > 0)
            {
                //Mensaje que se utiliza para informar al usuario la lista de referencias sin tipo de gasto
                var strMensaje = 'La salida por consumo interno no puede guardarse. ';
                strMensaje += 'Los siguientes <b>detalles</b> no tienen asignado un tipo de gasto:<br>'

                //Hacer recorrido para obtener referencias sin concepto
                for(var intCont = 0; intCont < arrDatosFaltantes.length; intCont++)
                {
                    //Agregar concepto en el mensaje
                    strMensaje = strMensaje + arrDatosFaltantes[intCont] + '<br/>';
                }

                //Hacer un llamado a la función para mostrar mensaje de error
                mensaje_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos('gastos_faltantes', strMensaje);
            }
            else
            {
                //Hacer un llamado a la función para guardar los datos del registro
                guardar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(arrRefaccionID, arrCodigos, 
                                                                                    arrDescripciones, arrCodigosLineas,
                                                                                    arrCantidades, arrCostosUnitarios, 
                                                                                    arrSucursalID, arrModuloID,
                                                                                    arrGastoTipoID);
            }
        }

        //Función para limpiar mensajes de validación del formulario
        function limpiar_mensajes_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
            try
            {
                $('#frmMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos').data('bootstrapValidator').resetForm();

            }
            catch(err) {}
        }

        //Función para guardar o modificar los datos de un registro
        function guardar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(arrRefaccionID, arrCodigos, 
                                                                                     arrDescripciones, arrCodigosLineas,
                                                                                     arrCantidades, arrCostosUnitarios, 
                                                                                     arrSucursalID, arrModuloID,
                                                                                     arrGastoTipoID)
        {
           

            //Hacer un llamado al método del controlador para guardar los datos del registro
            $.post('control_vehiculos/movimientos_salidas_refacciones_internas_consumo_interno/guardar',
                    { 
                        //Datos del movimiento
                        intMovimientoRefaccionesInternasID: $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(),
                        //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
                        dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()),
                        intReferenciaID: $('#txtDepartamentoID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(),
                        strObservaciones: $('#txtObservaciones_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(),
                        intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(),
                        //Datos de los detalles
                        strRefaccionID: arrRefaccionID.join('|'),
                        strCodigos: arrCodigos.join('|'),
                        strDescripciones: arrDescripciones.join('|'),
                        strCodigosLineas: arrCodigosLineas.join('|'),
                        strCantidades: arrCantidades.join('|'),
                        strCostosUnitarios: arrCostosUnitarios.join('|'),
                        strSucursalID: arrSucursalID.join('|'),
                        strModuloID: arrModuloID.join('|'),
                        strGastoTipoID: arrGastoTipoID.join('|')

                    },
                    function(data) {
                        if (data.resultado)
                        {   
                           //Si no existe id del movimiento, significa que es un nuevo registro   
                            if($('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                            {
                                //Asignar el id del movimiento registrado en la base de datos
                                $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(data.movimiento_refacciones_internas_id);
                            }

                            //Hacer llamado a la función  para cargar  los registros en el grid
                            paginacion_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();   

                            //Hacer un llamado a la función para generar póliza con los datos del registro
                            generar_poliza_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos('', '');
                        }

                        //Si existe mensaje de error
                        if(data.tipo_mensaje == 'error')
                        {

                            //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                            mensaje_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(data.tipo_mensaje, data.mensaje);
                        }
                    },
            'json');
        }

        //Función para mostrar mensaje de éxito o error
        function mensaje_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(tipoMensaje, mensaje)
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
            else if(tipoMensaje == 'gastos_faltantes')
            { 
                //Indicar al usuario el mensaje de error
                new $.Zebra_Dialog(mensaje, 
                              {'type': 'error',
                               'title': 'Error',
                               'width': 600
                              });
            }
            else if(tipoMensaje == 'informacion')
            { 
                //Indicar al usuario el mensaje de información
                new  $.Zebra_Dialog(mensaje, {
                                'type': 'information',
                                'title': 'Información',
                                'buttons': [{caption: 'Aceptar',
                                             callback: function () {
                                                //Enfocar caja de texto
                                                $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
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
        function cambiar_estatus_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(id, polizaID, folioPoliza)
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
                intID = $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
                intPolizaID = $('#txtPolizaID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
                strFolioPoliza = $('#txtFolioPoliza_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();

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
                          'title':    'Salidas por Consumo Interno',
                          'buttons':  ['Aceptar', 'Cancelar'],
                          'onClose':  function(caption) {
                                        if(caption == 'Aceptar')
                                        {
                                          //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
                                          $.post('control_vehiculos/movimientos_salidas_refacciones_internas_consumo_interno/set_estatus',
                                                 {intMovimientoRefaccionesInternasID: intID,
                                                    intPolizaID: intPolizaID
                                                 },
                                                 function(data) {
                                                    if(data.resultado)
                                                    {
                                                        //Hacer llamado a la función  para cargar  los registros en el grid
                                                        paginacion_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();

                                                        //Si el id del registro se obtuvo del modal
                                                        if(id == '')
                                                        {
                                                            //Hacer un llamado a la función para cerrar modal
                                                            cerrar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();     
                                                        }
                                                    }
                                                    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                                                    mensaje_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(data.tipo_mensaje, data.mensaje);
                                                 },
                                                'json');
                                        }
                                      }
                          });

        }

        //Función para regresar los datos (al formulario) del registro seleccionado
        function editar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(id, tipoAccion)
        {
            //Hacer un llamado al método del controlador para regresar los datos del registro
            $.post('control_vehiculos/movimientos_salidas_refacciones_internas_consumo_interno/get_datos',
                   {intMovimientoRefaccionesInternasID:id
                   },
                   function(data) {
                        //Si hay datos del registro
                        if(data.row)
                        {
                            //Hacer un llamado a la función para limpiar los campos del formulario
                            nuevo_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                            //Asignar estatus del registro
                            var strEstatus = data.row.estatus;
                            //Asignar el id de la póliza
                            var intPolizaID = parseInt(data.row.poliza_id);
                            //Variable que se utiliza para asignar las acciones del grid view
                            var strAccionesTabla = '';
                            
                            //Recuperar valores
                            $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(data.row.movimiento_refacciones_internas_id);
                            $('#txtFolio_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(data.row.folio);
                            $('#txtFecha_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(data.row.fecha);
                            $('#txtDepartamentoID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(data.row.referencia_id);
                            $('#txtDepartamento_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(data.row.departamento);
                            $('#txtObservaciones_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(data.row.observaciones);
                            $('#txtPolizaID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(intPolizaID);
                            $('#txtFolioPoliza_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(data.row.folio_poliza);
                            //Dependiendo del estatus cambiar el color del encabezado 
                            $('#divEncabezadoModal_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').addClass("estatus-"+strEstatus);
                            //Mostrar botón Imprimir  
                            $("#btnImprimirRegistro_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").show();

                          
                            //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
                            if(tipoAccion == 'Ver')
                            {
                                //Deshabilitar todos los elementos del formulario
                                $('#frmMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
                                //Ocultar los siguientes botones
                                $("#btnGuardar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").hide();
                                //Deshabilitar botón Agregar
                                $('#btnAgregar_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').prop('disabled', true);

                                //Si existe el id de la póliza
                                if(strEstatus == 'ACTIVO' && intPolizaID > 0)
                                {
                                    //Mostrar el botón Desactivar
                                    $("#btnDesactivar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").show();
                                }

                            }
                            else
                            {
                                strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
                                                   " onclick='editar_renglon_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(this)'>" + 
                                                   "<span class='glyphicon glyphicon-edit'></span></button>" + 
                                                   "<button class='btn btn-default btn-xs' title='Eliminar'" +
                                                   " onclick='eliminar_renglon_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(this)'>" + 
                                                   "<span class='glyphicon glyphicon-trash'></span></button>" + 
                                                   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
                                                   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
                                                   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
                                                   "<span class='glyphicon glyphicon-arrow-down'></span></button>";
                            }

                            //Mostramos los detalles del registro
                            for (var intCon in data.detalles) 
                            {
                                //Obtenemos el objeto de la tabla
                                var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').getElementsByTagName('tbody')[0];

                                //Insertamos el renglón con sus celdas en el objeto de la tabla
                                var objRenglon = objTabla.insertRow();
                                var objCeldaCodigo = objRenglon.insertCell(0);
                                var objCeldaDescripcion = objRenglon.insertCell(1);
                                var objCeldaGastoTipo = objRenglon.insertCell(2);
                                var objCeldaCantidad = objRenglon.insertCell(3);
                                var objCeldaCostoUnitario = objRenglon.insertCell(4);
                                var objCeldaSubtotal = objRenglon.insertCell(5);
                                var objCeldaAcciones = objRenglon.insertCell(6);
                                //Columnas ocultas
                                var objCeldaCodigoLinea = objRenglon.insertCell(7);
                                var objCeldaActualExistencia = objRenglon.insertCell(8);
                                var objCeldaCostoUnitarioBD = objRenglon.insertCell(9);
                                var objCeldaTipoGasto = objRenglon.insertCell(10);
                                var objCeldaSucursalID = objRenglon.insertCell(11);
                                var objCeldaModuloID = objRenglon.insertCell(12);
                                var objCeldaGastoTipoID = objRenglon.insertCell(13);


                                //Variables que se utilizan para asignar valores del detalle
                                var intSubtotal = parseFloat(data.detalles[intCon].costo_unitario);
                                var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
                                var intCostoUnitario = parseFloat(data.detalles[intCon].costo_unitario);

                                //Calcular existencia disponible 
                                var intActualExistencia = intCantidad + parseFloat(data.detalles[intCon].actual_existencia);

                                //Calcular subtotal
                                intSubtotal = intCantidad * intSubtotal;

                                //Cambiar cantidad a  formato moneda (a visualizar)
                                intCantidad =  formatMoney(intCantidad, 2, '');


                                var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos, '');


                                var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos, '');

                                //Cambiar cantidad a  formato moneda (a guardar en la  BD)
                                var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos, '');

                                //Asignar valores
                                objRenglon.setAttribute('class', 'movil');
                                objRenglon.setAttribute('id', data.detalles[intCon].refaccion_id);
                                objCeldaCodigo.setAttribute('class', 'movil b1');
                                objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
                                objCeldaDescripcion.setAttribute('class', 'movil b2');
                                objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
                                objCeldaGastoTipo.setAttribute('class', 'movil b3');
                                objCeldaGastoTipo.innerHTML = data.detalles[intCon].gasto;
                                objCeldaCantidad.setAttribute('class', 'movil b4');
                                objCeldaCantidad.innerHTML = intCantidad;
                                objCeldaCostoUnitario.setAttribute('class', 'movil b5');
                                objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
                                objCeldaSubtotal.setAttribute('class', 'movil b6');
                                objCeldaSubtotal.innerHTML = intSubtotalMostrar;
                                objCeldaAcciones.setAttribute('class', 'td-center movil b7');
                                objCeldaAcciones.innerHTML = strAccionesTabla;
                                objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
                                objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea;
                                objCeldaActualExistencia.setAttribute('class', 'no-mostrar');
                                objCeldaActualExistencia.innerHTML = intActualExistencia;
                                objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
                                objCeldaCostoUnitarioBD.innerHTML = intCostoUnitarioBD;
                                objCeldaTipoGasto.setAttribute('class', 'no-mostrar');
                                objCeldaTipoGasto.innerHTML = data.detalles[intCon].tipo_gasto;
                                objCeldaSucursalID.setAttribute('class', 'no-mostrar');
                                objCeldaSucursalID.innerHTML = data.detalles[intCon].sucursal_id;
                                objCeldaModuloID.setAttribute('class', 'no-mostrar');
                                objCeldaModuloID.innerHTML =  data.detalles[intCon].modulo_id;
                                objCeldaGastoTipoID.setAttribute('class', 'no-mostrar');
                                objCeldaGastoTipoID.innerHTML = data.detalles[intCon].gasto_tipo_id;

                            }

                            //Hacer un llamado a la función para calcular totales de la tabla
                            calcular_totales_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
                            var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos tr").length - 2;
                            $('#numElementos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(intFilas);
                            $('#txtNumDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(intFilas);
                            
                           

                            //Abrir modal
                            objMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = $('#MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculosBox').bPopup({
                                                           appendTo: '#MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculosContent', 
                                                           contentContainer: 'MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculosM', 
                                                           zIndex: 2, 
                                                           modalClose: false, 
                                                           modal: true, 
                                                           follow: [true,false], 
                                                           followEasing : "linear", 
                                                           easing: "linear", 
                                                           modalColor: ('#F0F0F0')});

                            //Enfocar caja de texto
                            $('#txtDepartamento_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                        }
                   },
                   'json');
        }

        
         //Función para generar póliza con los datos de un registro
        function generar_poliza_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(id, formulario)
        {   

            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Variable que se utiliza para saber si el id se obtuvo desde el modal
            var strTipo = 'modal';
            //Si no existe id, significa que se realizará la modificación desde el modal
            if(id == '')
            {
                intID = $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
            }
            else
            {
                intID = id;
                strTipo = 'gridview';
            }

            //Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
            mostrar_circulo_carga_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(formulario);
            //Hacer un llamado al método del controlador para timbrar los datos del registro
            $.post('contabilidad/generar_polizas/generar_poliza',
             {
                intReferenciaID: intID,
                strTipoReferencia: strTipoReferenciaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos, 
                intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val()
             },
             function(data) {

                //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
                ocultar_circulo_carga_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(formulario);
                
                //Si existe resultado
                if (data.resultado)
                {
                    //Hacer llamado a la función para cargar  los registros en el grid
                    paginacion_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();

                    //Si el id del registro se obtuvo del modal
                    if(strTipo == 'modal')
                    {
                        //Hacer un llamado a la función para cerrar modal
                        cerrar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
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
                                                        cerrar_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                                                     }
                                                    }]
                                      });
                }
                else
                {
                    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                    mensaje_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(data.tipo_mensaje, data.mensaje);
                }
                
             },
             'json');

        }

        //Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function mostrar_circulo_carga_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos';
            }

            //Remover clase para mostrar div que contiene la barra de carga
            $("#"+strCampoID).removeClass('no-mostrar');
        }


        //Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function ocultar_circulo_carga_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos';
            }

            //Agregar clase para ocultar div que contiene la barra de carga
            $("#"+strCampoID).addClass('no-mostrar');
        }


        
        /*******************************************************************************************************************
        Funciones de la tabla detalles
        *********************************************************************************************************************/
        //Función para mostrar u ocultar div que contiene el combobox de la sucursal (módulo)
        function mostrar_cmb_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(intSucursalID = null, intModuloID = null)
        {
            //Asignar el texto del combobox
            var strTipo = $('select[name="strTipo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"] option:selected').text();

        
            //Dependiendo  del tipo de gasto mostar u ocultar div´s que contienen combobox
            if(strTipo == 'GASTOS CORPORATIVOS')
            {
                //Agregar clase no-mostrar para ocultar div que contiene el combobox del módulo
                $('#divCmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').addClass("no-mostrar");
                //Agregar clase no-mostrar para ocultar div que contiene el combobox de la sucursal
                $('#divCmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').addClass("no-mostrar");
            }
            else if(strTipo == strCuenta602MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos)//Cuenta 602
            {
                //Quitar clase no-mostrar para mostrar div que contiene el combobox del módulo
                $('#divCmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').removeClass("no-mostrar");
                //Quitar clase no-mostrar para mostrar div que contiene el combobox de la sucursal
                $('#divCmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').removeClass("no-mostrar");

            }
            else //Cuenta 603
            {
                //Quitar clase no-mostrar para mostrar div que contiene el combobox de la sucursal
                $('#divCmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').removeClass("no-mostrar");
                //Agregar clase no-mostrar para ocultar div que contiene el combobox del módulo
                $('#divCmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').addClass("no-mostrar");
            }

            //Asignar el id de la sucursal
            $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(intSucursalID);
             //Asignar el id del módulo
            $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(intModuloID);

        }

        //Función para inicializar elementos de la refacción
        function inicializar_refaccion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
            //Limpiar contenido de las siguientes cajas de texto
            $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
            $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
            $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
            $('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
            $("#txtCodigoLinea_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").val('');
            $("#txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").val('');
            $("#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").val('');
            
        }

        //Función para regresar obtener los datos de una refacción
        function get_datos_refaccion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
             //Hacer un llamado al método del controlador para regresar los datos de la refacción
            $.post('refacciones/refacciones/get_datos',
                  { 
                    strBusqueda:$("#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").val(),
                    strTipo: 'id'
                  },
                  function(data) {
                        if(data.row)
                        {
                           $("#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").val(data.row.descripcion);
                           $("#txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").val(data.row.actual_costo_interno);
                           //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
                            $('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos });
                           $("#txtCodigoLinea_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").val(data.row.codigo_linea);
                           $("#txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").val(data.row.actual_existencia_interno);
                           $("#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").val(data.row.actual_existencia_interno);
                           //Enfocar caja de texto
                           $("#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").focus();
                        }
                  }
                 ,
                'json');
        }

        //Función para agregar renglón a la tabla
        function agregar_renglon_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
            //Variable que se utiliza para asignar el subtotal (costo unitario en la tabla movimientos_refacciones_detalles)
            var intSubtotal = 0;
            //Variable que se utiliza para asigna el descuento unitario
            var intDescuentoUnitario = 0;
            //Variable que se utiliza para asignar el importe de iva
            var intImporteIva = 0;
            //Variable que se utiliza para asignar el importe de ieps
            var intImporteIeps = 0;
            //Variable que se utiliza para asignar el importe total
            var intTotal = 0;

            //Obtenemos los datos de las cajas de texto
            var intRefaccionID = $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
            var strCodigo = $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
            var strDescripcion = $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
            var strCodigoLinea = $('#txtCodigoLinea_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
            var intCantidad = $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
            var intActualExistencia = $('#txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
            var intCostoUnitario = $('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
           
            //Asignar el texto del combobox
            var strGastoTipo = $('select[name="strGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"] option:selected').text();
            var strTipoGasto = $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
            var intSucursalID = $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
            var intModuloID = $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();
            var intGastoTipoID = $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val();


            //Obtenemos el objeto de la tabla
            var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').getElementsByTagName('tbody')[0];

            //Validamos que se capturaron datos
            if (strTipoGasto == '')
            {
                //Enfocar combobox
                $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
            }
            else if (strTipoGasto == strCuenta602MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos && intSucursalID == '')
            {
                //Enfocar combobox
                $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
            }
            else if (strTipoGasto == strCuenta602MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos && intModuloID == '')
            {
                //Enfocar combobox
                $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
            }
            else if (strTipoGasto == strCuenta603MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos && intSucursalID == '')
            {
                //Enfocar combobox
                $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
            }
            else if (intGastoTipoID == '')
            {
                //Enfocar caja de texto
                $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
            }
            else if (intRefaccionID == '' || strCodigo == '')
            {
                //Enfocar caja de texto
                $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
            }
            else if (intRefaccionID == '' || strDescripcion == '')
            {
                //Enfocar caja de texto
                $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
            }
            else if (intCantidad == '')
            {
                //Enfocar caja de texto
                $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
            }
            else
            {
                //Convertir cadena de texto a número decimal
                intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
                intCostoUnitario =  parseFloat($.reemplazar(intCostoUnitario, ",", ""));
                intSubtotal =  intCostoUnitario;
                intActualExistencia = parseFloat(intActualExistencia);

                //Verificar que la cantidad sea menor o igual que la existencia disponible 
                if(intCantidad <= intActualExistencia)
                {
                    //Hacer un llamado a la función para inicializar elementos de la refacción
                    inicializar_refaccion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                    //Limpiar contenido de los siguientes combobox
                    $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').empty();
                    //Hacer un llamado a la función para mostrar u ocultar sucursal y/ módulo
                    mostrar_cmb_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                    
                    //Calcular subtotal
                    intSubtotal = intCantidad * intSubtotal;

                    //Calcular importe total
                    intTotal = intSubtotal + intImporteIva + intImporteIeps;

                    //Cambiar cantidad a  formato moneda (a visualizar)
                    intCantidad =  formatMoney(intCantidad, 2, '');

                    var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos, '');

                    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos, '');


                    //Cambiar cantidad a  formato moneda (a guardar en la  BD)
                    var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos, '');

                    //Revisamos si existe el ID proporcionado, si es así, editamos los datos
                    if (objTabla.rows.namedItem(intRefaccionID))
                    {
                        objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = strGastoTipo;
                        objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML = intCantidad;
                        objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML = intCostoUnitarioMostrar;
                        objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML =  intSubtotalMostrar;
                        objTabla.rows.namedItem(intRefaccionID).cells[9].innerHTML = intCostoUnitarioBD;
                        objTabla.rows.namedItem(intRefaccionID).cells[10].innerHTML = strTipoGasto;
                        objTabla.rows.namedItem(intRefaccionID).cells[11].innerHTML = intSucursalID;
                        objTabla.rows.namedItem(intRefaccionID).cells[12].innerHTML = intModuloID;
                        objTabla.rows.namedItem(intRefaccionID).cells[13].innerHTML = intGastoTipoID;
                    }
                    else
                    {

                        //Insertamos el renglón con sus celdas en el objeto de la tabla
                        var objRenglon = objTabla.insertRow();
                        var objCeldaCodigo = objRenglon.insertCell(0);
                        var objCeldaDescripcion = objRenglon.insertCell(1);
                        var objCeldaGastoTipo = objRenglon.insertCell(2);
                        var objCeldaCantidad = objRenglon.insertCell(3);
                        var objCeldaCostoUnitario = objRenglon.insertCell(4);
                        var objCeldaSubtotal = objRenglon.insertCell(5);
                        var objCeldaAcciones = objRenglon.insertCell(6);
                        //Columnas ocultas
                        var objCeldaCodigoLinea = objRenglon.insertCell(7);
                        var objCeldaActualExistencia = objRenglon.insertCell(8);
                        var objCeldaCostoUnitarioBD = objRenglon.insertCell(9);
                        var objCeldaTipoGasto = objRenglon.insertCell(10);
                        var objCeldaSucursalID = objRenglon.insertCell(11);
                        var objCeldaModuloID = objRenglon.insertCell(12);
                        var objCeldaGastoTipoID = objRenglon.insertCell(13);
                        
                        //Asignar valores
                        objRenglon.setAttribute('class', 'movil');
                        objRenglon.setAttribute('id', intRefaccionID);
                        objCeldaCodigo.setAttribute('class', 'movil b1');
                        objCeldaCodigo.innerHTML = strCodigo;
                        objCeldaDescripcion.setAttribute('class', 'movil b2');
                        objCeldaDescripcion.innerHTML = strDescripcion;
                        objCeldaGastoTipo.setAttribute('class', 'movil b3');
                        objCeldaGastoTipo.innerHTML = strGastoTipo;
                        objCeldaCantidad.setAttribute('class', 'movil b4');
                        objCeldaCantidad.innerHTML = intCantidad;
                        objCeldaCostoUnitario.setAttribute('class', 'movil b5');
                        objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
                        objCeldaSubtotal.setAttribute('class', 'movil b6');
                        objCeldaSubtotal.innerHTML = intSubtotalMostrar;
                        objCeldaAcciones.setAttribute('class', 'td-center movil b7');
                        objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
                                                     " onclick='editar_renglon_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(this)'>" + 
                                                     "<span class='glyphicon glyphicon-edit'></span></button>" + 
                                                     "<button class='btn btn-default btn-xs' title='Eliminar'" +
                                                     " onclick='eliminar_renglon_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(this)'>" + 
                                                     "<span class='glyphicon glyphicon-trash'></span></button>" + 
                                                     "<button class='btn btn-default btn-xs up' title='Subir'>" + 
                                                     "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
                                                     "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
                                                     "<span class='glyphicon glyphicon-arrow-down'></span></button>";
                        objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
                        objCeldaCodigoLinea.innerHTML = strCodigoLinea; 
                        objCeldaActualExistencia.setAttribute('class', 'no-mostrar');
                        objCeldaActualExistencia.innerHTML = intActualExistencia;
                        objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
                        objCeldaCostoUnitarioBD.innerHTML = intCostoUnitarioBD;
                        objCeldaTipoGasto.setAttribute('class', 'no-mostrar');
                        objCeldaTipoGasto.innerHTML = strTipoGasto;
                        objCeldaSucursalID.setAttribute('class', 'no-mostrar');
                        objCeldaSucursalID.innerHTML = intSucursalID;
                        objCeldaModuloID.setAttribute('class', 'no-mostrar');
                        objCeldaModuloID.innerHTML =  intModuloID;
                        objCeldaGastoTipoID.setAttribute('class', 'no-mostrar');
                        objCeldaGastoTipoID.innerHTML = intGastoTipoID;
                        
                    }

                    //Hacer un llamado a la función para calcular totales de la tabla
                    calcular_totales_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                    
                    //Enfocar caja de texto
                    $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                }
                else
                {
                    //Cambiar cantidad a formato moneda
                    intActualExistencia = formatMoney(intActualExistencia, 2, '');

                    //Asignar existencia disponible 
                    $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(intActualExistencia);

                    //Hacer un llamado a la función para mostrar mensaje de información
                    mensaje_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos('informacion', 'La cantidad no debe exceder de ' + intActualExistencia);
                }
                
            }

            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
            var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos tr").length - 2;
            $('#numElementos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(intFilas);
            $('#txtNumDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(intFilas);
        }

        //Función para regresar los datos (al formulario) del renglón seleccionado
        function editar_renglon_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(objRenglon)
        {

            //Variable que se utiliza para asignar el id de la sucursal
            var intSucursalID = objRenglon.parentNode.parentNode.cells[11].innerHTML;
            //Variable que se utiliza para asignar el id del módulo
            var intModuloID = objRenglon.parentNode.parentNode.cells[12].innerHTML;
            //Variable que se utiliza para asignar el id del tipo de gasto
            var intGastoTipoID = objRenglon.parentNode.parentNode.cells[13].innerHTML;

            //Asignar los valores a las cajas de texto
            $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(objRenglon.parentNode.parentNode.getAttribute("id"));
            $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
            $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
            $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
            $('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
            $('#txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[8].innerHTML);

            //Asignar el tipo de gasto
            $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);

            //Hacer un llamado a la función para cargar gastos en el combobox
            cargar_gastos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(intGastoTipoID);
            //Hacer un llamado a la función para mostrar u ocultar módulo
            mostrar_cmb_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(intSucursalID, intModuloID);

            //Enfocar caja de texto
            $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
        }

        //Función para quitar renglón de la tabla
        function eliminar_renglon_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos(objRenglon)
        {
            //Obtener el indice del objeto renglón que se envía
            var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
            
            //Eliminar el renglón indicado
            document.getElementById("dg_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").deleteRow(intRenglon);

            //Hacer un llamado a la función para calcular totales de la tabla
            calcular_totales_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
            
            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
            var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos tr").length - 2;
            $('#numElementos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(intFilas);
            $('#txtNumDetalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(intFilas);

            //Enfocar caja de texto
            $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
        }

        //Función para calcular totales de la tabla
        function calcular_totales_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos()
        {
            //Obtenemos el objeto de la tabla 
            var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').getElementsByTagName('tbody')[0];

            //Inicializamos las variables que se utilizan para los acumulados
            var intAcumUnidades = 0;
            var intAcumSubtotal = 0;

            //Recorrer los renglones de la tabla para obtener los valores
            for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
            {
                //Incrementar acumulados
                //Hacer un llamado a la función para reemplazar ',' por cadena vacia
                intAcumUnidades += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
                intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
            }

            //Convertir total de unidades a 2 decimales
            intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

            //Convertir cantidad a formato moneda
            intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos, '');

            //Asignar los valores
            $('#acumCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(intAcumUnidades);
            $('#acumSubtotal_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').html(intAcumSubtotal);
            
        }

        //Controles o Eventos del Modal
        $(document).ready(function() 
        {
            /*******************************************************************************************************************
            Controles correspondientes al modal
            *********************************************************************************************************************/
            //Validar campos decimales (no hay necesidad de poner '.')
            $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').numeric();
          
            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').blur(function(){
                $('.cantidad_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
            });

            //Agregar datepicker para seleccionar fecha
            $('#dteFecha_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
          
            //Autocomplete para recuperar los datos de un departamento
            $('#txtDepartamento_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').autocomplete({
                source: function( request, response ) {
                   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtDepartamentoID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                   $.ajax({
                     //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                     url: "recursos_humanos/departamentos/autocomplete",
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
                 $('#txtDepartamentoID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(ui.item.data);

               },
               open: function() {
                   $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                 },
                 close: function() {
                   $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
                 },
               minLength: 1
            });
            
            //Verificar que exista id del departamento cuando pierda el enfoque la caja de texto
            $('#txtDepartamento_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focusout(function(e){
                //Si no existe id del departamento
                if($('#txtDepartamentoID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '' ||
                   $('#txtDepartamento_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtDepartamentoID_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                   $('#txtDepartamento_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                }

            });


            //Cargar tipos de gastos cuando se modifique la selección del combo
            $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').change(function(e){
                //Si no existe tipo de gasto
                if($('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                {
                    //Limpiar contenido de los siguientes combobox
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').empty();

                }
                else
                {

                    //Limpiar contenido de los siguientes combobox
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                    //Hacer un llamado a la función para cargar gastos en el combobox
                    cargar_gastos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();

                    //Enfocar comobox
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                }


               //Hacer un llamado a la función para mostrar u ocultar sucursal y/o módulo
               mostrar_cmb_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                
                
            });

            //Enfocar módulo ó tipo de gasto cuando se modifique la selección del combo
            $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').change(function(e){
                
                //Asignar el texto del combobox
                var strTipo = $('select[name="strTipo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos"] option:selected').text();

                //Si el tipo de gasto  corresponde a la cuenta 602
                if(strTipo == strCuenta602MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos)
                {
                    //Enfocar comobox
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                }
                else
                {
                    //Enfocar comobox
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();

                }
                
            
            });

            //Enfocar tipo de gasto cuando se modifique la selección del combo
            $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').change(function(e){
                
                //Enfocar comobox
                $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
            });

            
            //Enfocar concepto cuando se modifique la selección del combo
            $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').change(function(e){
                //Si no existe id del tipo de gasto
                if($('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                {
                    //Enfocar comobox
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                }
                else
                {

                    //Enfocar caja de texto
                    $('#txtConcepto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                }


            });
            
            //Autocomplete para recuperar los datos de una refacción
            $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').autocomplete({
                  source: function( request, response ) {
                     //Limpiar caja de texto que hace referencia al id del registro 
                     $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                     $.ajax({
                       //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                       url: "refacciones/refacciones/autocomplete",
                       type: "post",
                       dataType: "json",
                       data: {
                         strDescripcion: request.term,
                         strTipo: 'codigo', 
                         strTipoMovimiento: 'salida_interna'
                       },
                       success: function( data ) {
                         response( data );
                       }
                     });
                 },
                 select: function( event, ui ) {
                    //Asignar id del registro seleccionado
                    $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(ui.item.data);
                    //Hacer un llamado a la función para regresar los datos de la refacción
                    get_datos_refaccion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                    //Elegir código desde el valor devuelto en el autocomplete
                    ui.item.value = ui.item.value.split(" - ")[0];
                 },
                 open: function() {
                     $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                   },
                   close: function() {
                     $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
                   },
                 minLength: 1
            });

            //Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
            $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focusout(function(e){
                //Si no existe id de la refacción
                if($('#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '' ||
                   $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                { 
                    //Hacer un llamado a la función para inicializar elementos de la refacción
                    inicializar_refaccion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                }

            });

            //Autocomplete para recuperar los datos de una refacción
            $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').autocomplete({
                  source: function( request, response ) {
                     //Limpiar caja de texto que hace referencia al id del registro 
                     $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                     $.ajax({
                       //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                       url: "refacciones/refacciones/autocomplete",
                       type: "post",
                       dataType: "json",
                       data: {
                         strDescripcion: request.term,
                         strTipo: 'descripcion',
                         strTipoMovimiento: 'salida_interna'
                       },
                       success: function( data ) {
                         response( data );
                       }
                     });
                 },
                 select: function( event, ui ) {
                    //Asignar id del registro seleccionado
                    $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(ui.item.data);
                    //Elegir código desde el valor devuelto en el autocomplete
                    var strCodigo = ui.item.value.split(" - ")[0];
                    $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(strCodigo);
                    //Hacer un llamado a la función para regresar los datos de la refacción
                    get_datos_refaccion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                 },
                 open: function() {
                     $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                   },
                   close: function() {
                     $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
                   },
                 minLength: 1
            });

            //Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
            $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focusout(function(e){
                //Si no existe id de la refacción
                if($('#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '' ||
                   $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                { 
                    //Hacer un llamado a la función para inicializar elementos de la refacción
                    inicializar_refaccion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                }

            });


            //Función para mover renglones arriba y abajo en la tabla
            $('#dg_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').on('click','button.btn',function(){
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


            //Validar que exista tipo de gasto cuando se pulse la tecla enter 
            $("#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").keydown(function(e){
                var key = e.charCode || e.keyCode;
                if (key == 13)
                { 
                    //Si no existe tipo de gasto
                    if($('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                    {
                        //Enfocar combobox
                        $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                    else
                    {
                        //Enfocar combobox
                        $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                
                }  
            });


            //Validar que exista sucursal cuando se pulse la tecla enter 
            $("#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").keydown(function(e){
                var key = e.charCode || e.keyCode;
                if (key == 13)
                { 
                    //Si no existe sucursal
                    if($('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                    {
                        //Enfocar combobox
                        $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                    else
                    {
                        //Enfocar combobox
                        $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                
                }  
            });


            //Validar que exista módulo cuando se pulse la tecla enter 
            $("#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").keydown(function(e){
                var key = e.charCode || e.keyCode;
                if (key == 13)
                { 
                    //Si no existe módulo
                    if($('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                    {
                        //Enfocar combobox
                        $('#cmbModuloID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                    else
                    {
                        //Enfocar combobox
                        $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                
                }  
            });


            //Validar que exista gasto cuando se pulse la tecla enter 
            $("#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos").keydown(function(e){
                var key = e.charCode || e.keyCode;
                if (key == 13)
                { 
                    //Si no existe id del tipo de gasto
                    if($('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                    {
                        //Enfocar combobox
                        $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                    else
                    {
                        //Enfocar caja de texto
                        $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                
                }  
            });


            //Validar que exista código de la refacción cuando se pulse la tecla enter 
            $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe código de la refacción
                    if($('#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '' || $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                    else
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                }
            });

            //Validar que exista descripción de la refacción cuando se pulse la tecla enter 
            $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe descripción de la refacción
                    if($('#txtRefaccionID_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '' || $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                    else
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                }
            });

            //Validar que exista cantidad cuando se pulse la tecla enter 
            $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe cantidad
                    if($('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                    else
                    {
                        //Enfocar botón Agregar
                        $('#btnAgregar_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
                    }
                }
            });

           

            /*******************************************************************************************************************
            Controles correspondientes al formulario principal
            *********************************************************************************************************************/
            //Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
            $('#dteFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
            $('#dteFechaFinalBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
                                                                                                                useCurrent: false});
            //Deshabilitar los días posteriores a la fecha final
            $('#dteFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').on('dp.change', function (e) {
                $('#dteFechaFinalBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').data('DateTimePicker').minDate(e.date);
            });

            //Deshabilitar los días anteriores a la fecha inicial
            $('#dteFechaFinalBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').on('dp.change', function (e) {
                $('#dteFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').data('DateTimePicker').maxDate(e.date);
            });
            
            //Autocomplete para recuperar los datos de un departamento
            $('#txtDepartamentoBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').autocomplete({
                source: function( request, response ) {
                   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                   $.ajax({
                     //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                     url: "recursos_humanos/departamentos/autocomplete",
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
                 $('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val(ui.item.data);
               },
               open: function() {
                   $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                 },
                 close: function() {
                   $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
                 },
               minLength: 1
            });
            
            //Verificar que exista id del departamento cuando pierda el enfoque la caja de texto
            $('#txtDepartamentoBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focusout(function(e){
                //Si no existe id del departamento
                if($('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '' ||
                   $('#txtDepartamentoBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                   $('#txtDepartamentoBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').val('');
                }

            });

            //Paginación de registros
            $('#pagLinks_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').on('click','a',function(event){
                event.preventDefault();
                intPaginaMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = $(this).attr('href').replace('/','');
                //Hacer llamado a la función  para cargar  los registros en el grid
                paginacion_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
            });

            //Abrir modal cuando se de clic en el botón
            $('#btnNuevo_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').bind('click', function(e) {
                e.preventDefault();
                //Hacer un llamado a la función para limpiar los campos del formulario
                nuevo_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
                //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
                $('#divEncabezadoModal_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').addClass("estatus-NUEVO");
                //Abrir modal
                objMovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculos = $('#MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculosBox').bPopup({
                                               appendTo: '#MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculosContent', 
                                               contentContainer: 'MovimientosSalidasRefaccionesInternasConsumoInternoControlVehiculosM', 
                                               zIndex: 2, 
                                               modalClose: false, 
                                               modal: true, 
                                               follow: [true,false], 
                                               followEasing : "linear", 
                                               easing: "linear", 
                                               modalColor: ('#F0F0F0')});

                //Enfocar caja de texto
                $('#txtDepartamento_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
            });

            //Enfocar caja de texto
            $('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos').focus();
            //Hacer un llamado a la función para obtener los permisos de acceso
            permisos_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
            //Hacer un llamado a la función para cargar sucursales en el combobox del modal
            cargar_sucursales_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();
            //Hacer un llamado a la función para cargar módulos en el combobox del modal
            cargar_modulos_detalles_movimientos_salidas_refacciones_internas_consumo_interno_control_vehiculos();

        });
    </script>