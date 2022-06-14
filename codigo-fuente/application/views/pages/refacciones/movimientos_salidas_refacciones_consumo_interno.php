
    <div id="MovimientosSalidasRefaccionesConsumoInternoRefaccionesContent">  
        <!--Barra de herramientas-->
        <div class="panel-toolbar">
            <!--Diseño del formulario de Búsquedas-->
            <form class="form-horizontal" id="frmBusqueda_movimientos_salidas_refacciones_consumo_interno_refacciones" action="#" method="post" tabindex="-5" 
                  onsubmit="return(false)">
                <div class="row">
                    <!--Fecha inicial-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="txtFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones">Fecha inicial</label>
                            </div>
                            <div class="col-md-12">
                                <div class='input-group date' id='dteFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones'>
                                    <input class="form-control" 
                                            id="txtFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones"
                                            name= "strFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones" 
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
                                <label for="txtFechaFinalBusq_movimientos_salidas_refacciones_consumo_interno_refacciones">Fecha final</label>
                            </div>
                            <div class="col-md-12">
                                <div class='input-group date' id='dteFechaFinalBusq_movimientos_salidas_refacciones_consumo_interno_refacciones'>
                                    <input class="form-control" 
                                            id="txtFechaFinalBusq_movimientos_salidas_refacciones_consumo_interno_refacciones"
                                            name= "strFechaFinalBusq_movimientos_salidas_refacciones_consumo_interno_refacciones" 
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
                                <input id="txtDepartamentoIDBusq_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                       name="intDepartamentoIDBusq_movimientos_salidas_refacciones_consumo_interno_refacciones"  
                                       type="hidden" value="">
                                </input>
                                <label for="txtDepartamentoBusq_movimientos_salidas_refacciones_consumo_interno_refacciones">Departamento</label>
                            </div>
                            <div class="col-md-12">
                                <input  class="form-control" id="txtDepartamentoBusq_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                        name="strDepartamentoBusq_movimientos_salidas_refacciones_consumo_interno_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese departamento" maxlength="250">
                                </input>
                            </div>
                        </div>
                    </div>
                    <!--Estatus-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="cmbEstatusBusq_movimientos_salidas_refacciones_consumo_interno_refacciones">Estatus</label>
                            </div>
                            <div class="col-md-12">
                                <select class="form-control" id="cmbEstatusBusq_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                        name="strEstatusBusq_movimientos_salidas_refacciones_consumo_interno_refacciones" tabindex="1">
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
                                <label for="txtBusqueda_movimientos_salidas_refacciones_consumo_interno_refacciones">Descripción</label>
                            </div>
                            <div class="col-md-12">
                                <input  class="form-control" id="txtBusqueda_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                        name="strBusqueda_movimientos_salidas_refacciones_consumo_interno_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
                                </input>
                            </div>
                        </div>
                    </div>
                    <!--Mostrar detalles de los registros en el reporte PDF--> 
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
                        <div class="checkbox">
                            <label id="label-checkbox">
                                <input class="form-control" 
                                        id="chbImprimirDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                        name="strImprimirDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
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
                            <button class="btn btn-primary" id="btnBuscar_movimientos_salidas_refacciones_consumo_interno_refacciones"
                                    onclick="paginacion_movimientos_salidas_refacciones_consumo_interno_refacciones();" 
                                    title="Buscar coincidencias" tabindex="1" disabled> 
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                            <!--Dar de alta un nuevo registro-->
                            <button class="btn btn-info" id="btnNuevo_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                    title="Nuevo registro" tabindex="1" disabled> 
                                <span class="glyphicon glyphicon-list-alt"></span>
                            </button>   
                            <!--Generar PDF con el listado de registros-->
                            <button class="btn btn-default"  id="btnImprimir_movimientos_salidas_refacciones_consumo_interno_refacciones"
                                    onclick="reporte_movimientos_salidas_refacciones_consumo_interno_refacciones('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
                                <span class="glyphicon glyphicon-print"></span>
                            </button> 
                            <!--Descargar archivo XLS con el listado de registros-->
                            <button class="btn btn-success"  id="btnDescargarXLS_movimientos_salidas_refacciones_consumo_interno_refacciones"
                                    onclick="reporte_movimientos_salidas_refacciones_consumo_interno_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
                <table class="table-hover movil" id="dg_movimientos_salidas_refacciones_consumo_interno_refacciones">
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
                    <script id="plantilla_movimientos_salidas_refacciones_consumo_interno_refacciones" type="text/template"> 
                    {{#rows}}
                        <tr class="movil {{estiloRegistro}}">   
                            <td class="movil a1">{{folio}}</td>
                            <td class="movil a2">{{fecha}}</td>
                            <td class="movil a3">{{departamento}}</td>
                            <td class="movil a4">{{estatus}}</td>
                            <td class="td-center movil a5"> 
                                <!--Editar registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
                                        onclick="editar_movimientos_salidas_refacciones_consumo_interno_refacciones({{movimiento_refacciones_id}}, 'Editar')"  title="Editar">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </button>
                                <!--Ver registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
                                        onclick="editar_movimientos_salidas_refacciones_consumo_interno_refacciones({{movimiento_refacciones_id}}, 'Ver')"  title="Ver">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </button>
                                <!--Generar PDF con los datos del registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
                                        onclick="reporte_registro_movimientos_salidas_refacciones_consumo_interno_refacciones({{movimiento_refacciones_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
                                </button>
                                <!--Generar póliza-->
                                <button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
                                        onclick="generar_poliza_movimientos_salidas_refacciones_consumo_interno_refacciones({{movimiento_refacciones_id}}, 'principal')"  title="Generar póliza">
                                    <span class="glyphicon glyphicon-tags"></span>
                                </button>
                                <!--Desactivar registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
                                        onclick="cambiar_estatus_movimientos_salidas_refacciones_consumo_interno_refacciones({{movimiento_refacciones_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
                    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_salidas_refacciones_consumo_interno_refacciones"></div>
                    <!--Número de registros encontrados-->
                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                        <button class="btn btn-default btn-sm disabled pull-right">
                            <strong id="numElementos_movimientos_salidas_refacciones_consumo_interno_refacciones">0</strong> encontrados
                        </button>
                    </div>
                </div> <!--Cierre del diseño de la paginación-->
            </div><!--#container-fluid-->
        </div><!--Cierre del contenedor de la tabla-->
        <!--Circulo de progreso-->
        <div id="divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_consumo_interno_refacciones" class="load-container load5 circulo_bar no-mostrar">
            <div class="loader">Loading...</div>
            <br><br>
            <div align=center><b>Espere un momento por favor.</b></div>
        </div>  

        <!-- Diseño del modal-->
        <div id="MovimientosSalidasRefaccionesConsumoInternoRefaccionesBox" class="ModalBody">
            <!--Título-->
            <div id="divEncabezadoModal_movimientos_salidas_refacciones_consumo_interno_refacciones"  class="ModalBodyTitle">
            <h1>Salidas por Consumo Interno</h1>
            </div>
            <!--Contenido-->
            <div class="ModalBodyContent">
                <!--Diseño del formulario-->
                <form id="frmMovimientosSalidasRefaccionesConsumoInternoRefacciones" method="post" action="#" class="form-horizontal" role="form" 
                      name="frmMovimientosSalidasRefaccionesConsumoInternoRefacciones"  onsubmit="return(false)" autocomplete="off">
                    <div class="row">
                        <!-- Folio -->
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
                                    <input id="txtMovimientoRefaccionesID_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                           name="intMovimientoRefaccionesID_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                           type="hidden" value="" />
                                     <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
                                    <input id="txtPolizaID_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                           name="intPolizaID_movimientos_salidas_refacciones_consumo_interno_refacciones" type="hidden" value="" />
                                    <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
                                    <input id="txtFolioPoliza_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                           name="strFolioPoliza_movimientos_salidas_refacciones_consumo_interno_refacciones" type="hidden" value="" />
                                    <label for="txtFolio_movimientos_salidas_refacciones_consumo_interno_refacciones">Folio</label>
                                </div>
                                <div class="col-md-12">
                                    <input  class="form-control" id="txtFolio_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                            name="strFolio_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                            type="text" value="" placeholder="Autogenerado" disabled />
                                </div>
                            </div>
                        </div>
                        <!-- Fecha -->
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="txtFecha_movimientos_salidas_refacciones_consumo_interno_refacciones">Fecha</label>
                                </div>
                                <div id="divFechaMsjValidacion" class="col-md-12">
                                    <div class='input-group date' id='dteFecha_movimientos_salidas_refacciones_consumo_interno_refacciones'>
                                        <input class="form-control" 
                                                id="txtFecha_movimientos_salidas_refacciones_consumo_interno_refacciones"
                                                name= "strFecha_movimientos_salidas_refacciones_consumo_interno_refacciones" 
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
                                    <input id="txtDepartamentoID_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                           name="intDepartamentoID_movimientos_salidas_refacciones_consumo_interno_refacciones"  
                                           type="hidden"  value="">
                                    </input>
                                    <label for="txtDepartamento_movimientos_salidas_refacciones_consumo_interno_refacciones">Departamento</label>
                                </div>  
                                <div class="col-md-12">
                                    <input  class="form-control" 
                                            id="txtDepartamento_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                            name="strDepartamento_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                            type="text" value="" tabindex="1" placeholder="Ingrese departamento" maxlength="250" />
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
                                    <input id="txtEmpleadoAutorizacionID_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                           name="intEmpleadoAutorizacionID_movimientos_salidas_refacciones_consumo_interno_refacciones"  type="hidden" 
                                           value="">
                                    </input>
                                    <label for="txtEmpleadoAutorizacion_movimientos_salidas_refacciones_consumo_interno_refacciones">Autoriza</label>
                                </div>  
                                <div class="col-md-12">
                                    <input  class="form-control" 
                                            id="txtEmpleadoAutorizacion_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                            name="strEmpleadoAutorizacion_movimientos_salidas_refacciones_consumo_interno_refacciones" 
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
                                    <label for="txtObservaciones_movimientos_salidas_refacciones_consumo_interno_refacciones">Observaciones</label>
                                </div>  
                                <div class="col-md-12">
                                    <input  class="form-control" 
                                            id="txtObservaciones_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                            name="strObservaciones_movimientos_salidas_refacciones_consumo_interno_refacciones" 
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
                                    <input id="txtNumDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                           name="intNumDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones" type="hidden" value="">
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
                                                                <label for="cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones">Tipo de gasto</label>
                                                            </div>
                                                            <div id="divCmbMsjValidacion" class="col-md-12">
                                                                <select class="form-control" id="cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        name="strTipo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" tabindex="1">
                                                                    <option value="">Seleccione una opción</option>
                                                                    <option value="GASTOS DE VENTA">GASTOS DE VENTA</option>
                                                                    <option value="GASTOS DE ADMINISTRACION">GASTOS DE ADMINISTRACION</option>
                                                                    <option value="GASTOS CORPORATIVOS">GASTOS CORPORATIVOS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Combobox que contiene las sucursales activas-->
                                                    <div id="divCmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones">Sucursal</label>
                                                            </div>
                                                            <div id="divCmbMsjValidacion" class="col-md-12">
                                                                <select class="form-control" id="cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        name="intSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" tabindex="1">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Combobox que contiene los módulos activos-->
                                                    <div id="divCmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" class="col-sm-3 col-md-3 col-lg-3 col-xs-12 no-mostrar">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones">Departamento</label>
                                                            </div>
                                                            <div id="divCmbMsjValidacion" class="col-md-12">
                                                                <select class="form-control" id="cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        name="intModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" tabindex="1">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Combobox que contiene los tipos de gastos activos (correspondientes al tipo)-->
                                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones">Gasto</label>
                                                            </div>
                                                            <div id="divCmbMsjValidacion" class="col-md-12">
                                                                <select class="form-control" id="cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        name="strGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" tabindex="1">
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
                                                                <input id="txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                       name="intRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                <!-- Caja de texto oculta para recuperar el código de la línea de refacción de la refacción seleccionada-->
                                                                <input id="txtCodigoLinea_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                       name="strCodigoLinea_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                <!-- Caja de texto oculta para recuperar la existencia disponible  de la refacción (en el inventario)  seleccionada-->
                                                                <input id="txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                       name="intDisponibleExistencia_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                <label for="txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones">
                                                                    Código
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control" 
                                                                        id="txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        name="strCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        type="text" value="" tabindex="1" 
                                                                        placeholder="Ingrese código" maxlength="250" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Autocomplete que contiene las refacciones activas-->
                                                    <div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones">
                                                                    Descripción
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control" 
                                                                        id="txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        name="strDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        type="text" value="" tabindex="1" 
                                                                        placeholder="Ingrese descripción" maxlength="250" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Cantidad-->
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones">
                                                                    Cantidad
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control cantidad_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        id="txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        name="intCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        type="text" value="" tabindex="1"
                                                                        placeholder="Ingrese cantidad" maxlength="14" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Costo unitario-->
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="txtCostoUnitario_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones">Costo unitario</label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control" 
                                                                        id="txtCostoUnitario_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        name="intCostoUnitario_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                        type="text" value="" disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Botón agregar-->
                                                    <div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                                                        <button class="btn btn-primary btn-toolBtns pull-right" 
                                                                id="btnAgregar_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" 
                                                                onclick="agregar_renglon_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();" 
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
                                                    <table class="table-hover movil" id="dg_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones">
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
                                                                    <strong id="acumCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones"></strong>
                                                                </td>
                                                                <td class="movil t5"></td>
                                                                <td class="movil t6">
                                                                    <strong id="acumSubtotal_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones"></strong>
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
                                                                <strong id="numElementos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones">0</strong> encontrados
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
                    <div id="divCirculoBarProgreso_movimientos_salidas_refacciones_consumo_interno_refacciones" class="load-container load5 circulo_bar no-mostrar">
                        <div class="loader">Loading...</div>
                        <br><br>
                        <div align=center><b>Espere un momento por favor.</b></div>
                    </div> 
                    <!--Botones de acción (barra de tareas)-->
                    <div class="btn-group row footerModal">
                        <div class="col-md-12">
                            <!--Guardar registro-->
                            <button class="btn btn-success" id="btnGuardar_movimientos_salidas_refacciones_consumo_interno_refacciones"  
                                    onclick="validar_movimientos_salidas_refacciones_consumo_interno_refacciones();"  title="Guardar" tabindex="2" disabled>
                                <span class="fa fa-floppy-o"></span>
                            </button>
                            <!--Generar PDF con los datos del registro-->
                            <button class="btn btn-default" 
                                    id="btnImprimirRegistro_movimientos_salidas_refacciones_consumo_interno_refacciones"  
                                    onclick="reporte_registro_movimientos_salidas_refacciones_consumo_interno_refacciones('');"  
                                    title="Imprimir" tabindex="3" disabled>
                                <span class="glyphicon glyphicon-print"></span>
                            </button>
                            <!--Desactivar registro-->
                            <button class="btn btn-default" id="btnDesactivar_movimientos_salidas_refacciones_consumo_interno_refacciones"  
                                    onclick="cambiar_estatus_movimientos_salidas_refacciones_consumo_interno_refacciones('','','');"  title="Desactivar" tabindex="4" disabled>
                                <span class="glyphicon glyphicon-ban-circle"></span>
                            </button>
                            <!--Cerrar modal-->
                            <button class="btn  btn-cerrar"  id="btnCerrar_movimientos_salidas_refacciones_consumo_interno_refacciones"
                                    type="reset" aria-hidden="true" onclick="cerrar_movimientos_salidas_refacciones_consumo_interno_refacciones();" 
                                    title="Cerrar"  tabindex="5">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    </div>
                </form><!--Cierre del formulario-->
            </div><!--Cierre del contenido-->
        </div><!--Cierre del modal-->
    </div><!--#MovimientosSalidasRefaccionesConsumoInternoRefaccionesContent -->

    <!-- /.Plantilla para cargar las sucursales en el combobox-->  
    <script id="sucursales_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" type="text/template">
        <option value="">Seleccione una opción</option>
        {{#sucursales}}
        <option value="{{value}}">{{nombre}}</option>
        {{/sucursales}} 
    </script>
    <!-- /.Plantilla para cargar los módulos en el combobox-->  
    <script id="modulos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" type="text/template">
        <option value="">Seleccione una opción</option>
        {{#modulos}}
        <option value="{{value}}">{{nombre}}</option>
        {{/modulos}} 
    </script>
    <!-- /.Plantilla para cargar los tipos de gastos en el combobox-->  
    <script id="gastos_tipos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones" type="text/template">
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
        var intPaginaMovimientosSalidasRefaccionesConsumoInternoRefacciones = 0;
        var strUltimaBusquedaMovimientosSalidasRefaccionesConsumoInternoRefacciones = "";
         /*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
        var strTipoReferenciaMovimientosSalidasRefaccionesConsumoInternoRefacciones = "MOVIMIENTO DE REFACCIONES";
        //Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
        var intNumDecimalesMostrarMovimientosSalidasRefaccionesConsumoInternoRefacciones = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
        //Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
        var intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesConsumoInternoRefacciones = <?php echo NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES ?>;
        //Variable que se utiliza para asignar la descripción de la cuenta 602
        var strCuenta602MovimientosSalidasRefaccionesConsumoInternoRefacciones = <?php echo DESCRIPCION_CUENTA_602 ?>;
        //Variable que se utiliza para asignar la descripción de la cuenta 603
        var strCuenta603MovimientosSalidasRefaccionesConsumoInternoRefacciones = <?php echo DESCRIPCION_CUENTA_603 ?>;

        //Variable que se utiliza para asignar el id de la moneda base
        var intMonedaBaseIDMovimientosSalidasRefaccionesConsumoInternoRefacciones = <?php echo MONEDA_BASE ?>;

        //Variable que se utiliza para asignar objeto del modal
        var objMovimientosSalidasRefaccionesConsumoInternoRefacciones = null;

        //Permisos  de acceso del usuario (Acciones Generales)
        function permisos_movimientos_salidas_refacciones_consumo_interno_refacciones()
        {
            //Hacer un llamado al método del controlador para regresar los permisos de acceso
            $.post('refacciones/movimientos_salidas_refacciones_consumo_interno/get_permisos_acceso',
            { 
                strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_consumo_interno_refacciones').val()
            },
            function(data){
                //Si existen permisos de acceso del usuario para este proceso
                if (data.row)
                {
                    //Asignar a la variable la cadena concatenada con los permisos de acceso
                    //del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
                    var strPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones = data.row;
                    //Separar la cadena 
                    var arrPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones = strPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones.split('|');

                    //Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
                    for (var i=0; i < arrPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones.length; i++)
                    {
                        //Habilitar Acción si se cuenta con  permiso de acceso
                        if(arrPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones[i]=='NUEVO')//Si el indice es NUEVO
                        {
                            //Habilitar el control (botón nuevo)
                            $('#btnNuevo_movimientos_salidas_refacciones_consumo_interno_refacciones').removeAttr('disabled');
                        }
                        //Si el indice es GUARDAR ó EDITAR (modificar)
                        else if((arrPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones[i]=='GUARDAR') || (arrPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones[i]=='EDITAR'))
                        {
                            //Habilitar el control (botón guardar)
                            $('#btnGuardar_movimientos_salidas_refacciones_consumo_interno_refacciones').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
                        {
                            //Habilitar el control (botón buscar)
                            $('#btnBuscar_movimientos_salidas_refacciones_consumo_interno_refacciones').removeAttr('disabled');
                            //Hacer llamado a la función  para cargar  los registros en el grid
                            paginacion_movimientos_salidas_refacciones_consumo_interno_refacciones();
                        }
                        else if(arrPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
                        {
                            //Habilitar los siguientes controles
                            $('#btnDesactivar_movimientos_salidas_refacciones_consumo_interno_refacciones').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
                        {
                            //Habilitar el control (botón imprimir)
                            $('#btnImprimir_movimientos_salidas_refacciones_consumo_interno_refacciones').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
                        {
                            //Habilitar el control (botón imprimir)
                            $('#btnImprimirRegistro_movimientos_salidas_refacciones_consumo_interno_refacciones').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosSalidasRefaccionesConsumoInternoRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
                        {
                            //Habilitar el control (botón descargar XLS)
                            $('#btnDescargarXLS_movimientos_salidas_refacciones_consumo_interno_refacciones').removeAttr('disabled');
                        }
                    }//Cerrar for
                }
            },
            'json');
        }

        //Función para la búsqueda de registros
        function paginacion_movimientos_salidas_refacciones_consumo_interno_refacciones() 
        {
           //Concatenar datos para la nueva búsqueda
            var strNuevaBusquedaMovimientosSalidasRefaccionesConsumoInternoRefacciones =($('#txtFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val()+$('#txtFechaFinalBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val()+$('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val()+$('#cmbEstatusBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val()+$('#txtBusqueda_movimientos_salidas_refacciones_consumo_interno_refacciones').val());
            //Verificar si hubo cambios en la búsqueda
            if(strNuevaBusquedaMovimientosSalidasRefaccionesConsumoInternoRefacciones != strUltimaBusquedaMovimientosSalidasRefaccionesConsumoInternoRefacciones)
            {
                intPaginaMovimientosSalidasRefaccionesConsumoInternoRefacciones = 0;
                strUltimaBusquedaMovimientosSalidasRefaccionesConsumoInternoRefacciones = strNuevaBusquedaMovimientosSalidasRefaccionesConsumoInternoRefacciones;
            }

            //Hacer un llamado al método del controlador para regresar listado de registros
            $.post('refacciones/movimientos_salidas_refacciones_consumo_interno/get_paginacion',
                    { //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
                      dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val()),
                      dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val()),
                      intDepartamentoID: $('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val(),
                      strEstatus:     $('#cmbEstatusBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val(),
                      strBusqueda:    $('#txtBusqueda_movimientos_salidas_refacciones_consumo_interno_refacciones').val(),
                      intPagina: intPaginaMovimientosSalidasRefaccionesConsumoInternoRefacciones,
                      strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_consumo_interno_refacciones').val()
                    },
                    function(data){
                        $('#dg_movimientos_salidas_refacciones_consumo_interno_refacciones tbody').empty();
                        var tmpMovimientosSalidasRefaccionesConsumoInternoRefacciones = Mustache.render($('#plantilla_movimientos_salidas_refacciones_consumo_interno_refacciones').html(),data);
                        $('#dg_movimientos_salidas_refacciones_consumo_interno_refacciones tbody').html(tmpMovimientosSalidasRefaccionesConsumoInternoRefacciones);
                        $('#pagLinks_movimientos_salidas_refacciones_consumo_interno_refacciones').html(data.paginacion);
                        $('#numElementos_movimientos_salidas_refacciones_consumo_interno_refacciones').html(data.total_rows);
                        intPaginaMovimientosSalidasRefaccionesConsumoInternoRefacciones = data.pagina;
                    },
            'json');
        }

        //Función para cargar/descargar el reporte general en PDF/XLS
        function reporte_movimientos_salidas_refacciones_consumo_interno_refacciones(strTipo) 
        {

            //Variable que se utiliza para asignar URL (ruta del controlador)
            var strUrl = 'refacciones/movimientos_salidas_refacciones_consumo_interno/';

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
            if ($('#chbImprimirDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones').is(':checked')) {
                //Asignar SI para incluir detalles en el reporte
                $('#chbImprimirDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('SI');
            }
            else
            { 
               //Asignar NO para  no incluir detalles en el reporte
               $('#chbImprimirDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('NO');
            }


            //Definir encapsulamiento de datos que son necesarios para generar el reporte
            objReporte = {'url': strUrl,
                            'data' : {
                                        'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val()),
                                        'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val()),
                                        'intDepartamentoID': $('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val(),
                                        'strEstatus': $('#cmbEstatusBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val(), 
                                        'strBusqueda': $('#txtBusqueda_movimientos_salidas_refacciones_consumo_interno_refacciones').val(),
                                        'strDetalles': $('#chbImprimirDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val()       
                                     }
                           };


            //Hacer un llamado a la función para imprimir/descargar el reporte
            $.imprimirReporte(objReporte);
        }

        //Función para cargar el reporte de un registro en PDF
        function reporte_registro_movimientos_salidas_refacciones_consumo_interno_refacciones(id) 
        {
            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Si no existe id, significa que se realizará la impresión desde el modal
            if(id == '')
            {
                intID = $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
            }
            else
            {
                intID = id;
            }

           
            //Definir encapsulamiento de datos que son necesarios para generar el reporte
            objReporte = {'url': 'refacciones/movimientos_salidas_refacciones_consumo_interno/get_reporte_registro',
                            'data' : {
                                        'intMovimientoRefaccionesID': intID
                                     }
                           };

            //Hacer un llamado a la función para imprimir el reporte
            $.imprimirReporte(objReporte);
        }

       

        //Regresar sucursales activas para cargarlas en el combobox
        function cargar_sucursales_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones()
        {
            //Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
            $.post('administracion/sucursales/get_combo_box', {},
                function(data)
                {
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').empty();
                    var temp = Mustache.render($('#sucursales_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(), data);
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(temp);
                },
                'json');
        }


        //Regresar módulos activos para cargarlos en el combobox
        function cargar_modulos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones()
        {
            //Hacer un llamado al método del controlador para regresar los módulos que se encuentran activos 
            $.post('crm/modulos/get_combo_box', {},
                function(data)
                {
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').empty();
                    var temp = Mustache.render($('#modulos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(), data);
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(temp);
                },
                'json');
        }

        //Regresar gastos activos para cargarlos en el combobox
        function cargar_gastos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones(intGastoTipoID = 0)
        {   
            //Asignar el tipo de gasto
            var strTipo = $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
           
            //Hacer un llamado al método del controlador para regresar los gastos que se encuentran activos 
            $.post('cuentas_pagar/gastos_tipos/get_combo_box/'+strTipo, {},
                function(data)
                {
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').empty();
                    var temp = Mustache.render($('#gastos_tipos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(), data);
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(temp);

                    //Si existe id del tipo de gasto
                    if(intGastoTipoID > 0)
                    {
                        //Asignar el id del tipo de gasto
                        $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(intGastoTipoID);
                    }
                },
                'json');
        }


        /*******************************************************************************************************************
        Funciones del modal
        *********************************************************************************************************************/
        // Función para limpiar los campos del formulario
        function nuevo_movimientos_salidas_refacciones_consumo_interno_refacciones()
        {
            //Incializar formulario
            $('#frmMovimientosSalidasRefaccionesConsumoInternoRefacciones')[0].reset();
            //Hacer un llamado a la función para limpiar los mensajes de error 
            limpiar_mensajes_movimientos_salidas_refacciones_consumo_interno_refacciones();
            //Limpiar cajas de texto ocultas
            $('#frmMovimientosSalidasRefaccionesConsumoInternoRefacciones').find('input[type=hidden]').val('');
            //Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
            $.removerClasesEncabezado('divEncabezadoModal_movimientos_salidas_refacciones_consumo_interno_refacciones');

            //Eliminar los datos de la tabla detalles del movimiento
            $('#dg_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones tbody').empty();
            $('#acumCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html('');
            $('#acumSubtotal_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html('');
            $('#numElementos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(0);
            //Limpiar contenido de los siguientes combobox
            $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
            $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').empty();
           
            //Habilitar todos los elementos del formulario
            $('#frmMovimientosSalidasRefaccionesConsumoInternoRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
             //Asignar la fecha actual
            $('#txtFecha_movimientos_salidas_refacciones_consumo_interno_refacciones').val(fechaActual()); 
            //Hacer un llamado a la función para mostrar u ocultar sucursal y/o módulo
            mostrar_cmb_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
            //Deshabilitar las siguientes cajas de texto
            $('#txtFolio_movimientos_salidas_refacciones_consumo_interno_refacciones').attr("disabled", "disabled");
            $("#txtCostoUnitario_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").attr('disabled','disabled');
            //Habilitar botón Agregar
            $('#btnAgregar_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').prop('disabled', false);
            //Mostrar los siguientes botones
            $("#btnGuardar_movimientos_salidas_refacciones_consumo_interno_refacciones").show();
            //Ocultar los siguientes botones
            $("#btnImprimirRegistro_movimientos_salidas_refacciones_consumo_interno_refacciones").hide();
            $("#btnDesactivar_movimientos_salidas_refacciones_consumo_interno_refacciones").hide();
        }

        //Función que se utiliza para cerrar el modal
        function cerrar_movimientos_salidas_refacciones_consumo_interno_refacciones()
        {
            try {
                //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
                ocultar_circulo_carga_movimientos_salidas_refacciones_consumo_interno_refacciones('');
                //Cerrar modal
                objMovimientosSalidasRefaccionesConsumoInternoRefacciones.close();
                //Enfocar caja de texto 
                $('#txtFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                
            }
            catch(err) {}
        }

        //Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
        function validar_movimientos_salidas_refacciones_consumo_interno_refacciones()
        {
            //Hacer un llamado a la función para limpiar los mensajes de error 
            limpiar_mensajes_movimientos_salidas_refacciones_consumo_interno_refacciones();
            //Validación del formulario de campos obligatorios
            $('#frmMovimientosSalidasRefaccionesConsumoInternoRefacciones')
                .bootstrapValidator({   excluded: [':disabled'],
                                        container: 'popover',
                                        feedbackIcons: {
                                            valid: 'glyphicon glyphicon-ok',
                                            invalid: 'glyphicon glyphicon-remove',
                                            validating: 'glyphicon glyphicon-refresh'
                                        },
                                        fields: {
                                            strFecha_movimientos_salidas_refacciones_consumo_interno_refacciones: {
                                                validators: {
                                                    notEmpty: {message: 'Seleccione una fecha'}
                                                }
                                            },
                                            strDepartamento_movimientos_salidas_refacciones_consumo_interno_refacciones: {
                                                validators: {
                                                    callback: {
                                                        callback: function(value, validator, $field) {
                                                            //Verificar que exista id del departamento
                                                            if($('#txtDepartamentoID_movimientos_salidas_refacciones_consumo_interno_refacciones').val() === '')
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
                                            strEmpleadoAutorizacion_movimientos_salidas_refacciones_consumo_interno_refacciones: {
                                                validators: {
                                                    callback: {
                                                        callback: function(value, validator, $field) {
                                                            //Verificar que exista id del empleado
                                                            if($('#txtEmpleadoAutorizacionID_movimientos_salidas_refacciones_consumo_interno_refacciones').val() === '')
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
                                            intNumDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones: {
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
                                            strCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones: {
                                                excluded: true  // Ignorar (no valida el campo)    
                                            },
                                            strDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones:{
                                                excluded: true  // Ignorar (no valida el campo)    
                                            },
                                            intCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones: {
                                                excluded: true  // Ignorar (no valida el campo)    
                                            }
                                        }
                                    });
            //Variable que se utiliza para asignar el objeto bootstrapValidator
            var bootstrapValidator_movimientos_salidas_refacciones_consumo_interno_refacciones = $('#frmMovimientosSalidasRefaccionesConsumoInternoRefacciones').data('bootstrapValidator');
            bootstrapValidator_movimientos_salidas_refacciones_consumo_interno_refacciones.validate();
            //Si se cumplen las reglas de validación
            if(bootstrapValidator_movimientos_salidas_refacciones_consumo_interno_refacciones.isValid())
            {
                //Hacer un llamado a la función para validar que los detalles cuenten con tipo de gasto
                validar_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
            }
            else 
                return;
        }


        //Función que se utiliza para validar que los detalles cuenten con gasto
        function validar_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones()
        {
            //Obtenemos el objeto de la tabla detalles
            var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').getElementsByTagName('tbody')[0];

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
                mensaje_movimientos_salidas_refacciones_consumo_interno_refacciones('gastos_faltantes', strMensaje);
            }
            else
            {
                //Hacer un llamado a la función para guardar los datos del registro
                guardar_movimientos_salidas_refacciones_consumo_interno_refacciones(arrRefaccionID, arrCodigos, 
                                                                                    arrDescripciones, arrCodigosLineas,
                                                                                    arrCantidades, arrCostosUnitarios, 
                                                                                    arrSucursalID, arrModuloID,
                                                                                    arrGastoTipoID);
            }
        }

        //Función para limpiar mensajes de validación del formulario
        function limpiar_mensajes_movimientos_salidas_refacciones_consumo_interno_refacciones()
        {
            try
            {
                $('#frmMovimientosSalidasRefaccionesConsumoInternoRefacciones').data('bootstrapValidator').resetForm();

            }
            catch(err) {}
        }

        //Función para guardar o modificar los datos de un registro
        function guardar_movimientos_salidas_refacciones_consumo_interno_refacciones(arrRefaccionID, arrCodigos, 
                                                                                     arrDescripciones, arrCodigosLineas,
                                                                                     arrCantidades, arrCostosUnitarios, 
                                                                                     arrSucursalID, arrModuloID,
                                                                                     arrGastoTipoID)
        {
           

            //Hacer un llamado al método del controlador para guardar los datos del registro
            $.post('refacciones/movimientos_salidas_refacciones_consumo_interno/guardar',
                    { 
                        //Datos del movimiento
                        intMovimientoRefaccionesID: $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_consumo_interno_refacciones').val(),
                        //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
                        dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_salidas_refacciones_consumo_interno_refacciones').val()),
                        intReferenciaID: $('#txtDepartamentoID_movimientos_salidas_refacciones_consumo_interno_refacciones').val(),
                        intEmpleadoAutorizacion: $('#txtEmpleadoAutorizacionID_movimientos_salidas_refacciones_consumo_interno_refacciones').val(),
                        strObservaciones: $('#txtObservaciones_movimientos_salidas_refacciones_consumo_interno_refacciones').val(),
                        intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_consumo_interno_refacciones').val(),
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
                            if($('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                            {
                                //Asignar el id del movimiento registrado en la base de datos
                                $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_consumo_interno_refacciones').val(data.movimiento_refacciones_id);
                            }

                            //Hacer llamado a la función  para cargar  los registros en el grid
                            paginacion_movimientos_salidas_refacciones_consumo_interno_refacciones();   

                            //Hacer un llamado a la función para generar póliza con los datos del registro
                            generar_poliza_movimientos_salidas_refacciones_consumo_interno_refacciones('', '');
                        }

                        //Si existe mensaje de error
                        if(data.tipo_mensaje == 'error')
                        {

                            //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                            mensaje_movimientos_salidas_refacciones_consumo_interno_refacciones(data.tipo_mensaje, data.mensaje);
                        }
                    },
            'json');
        }

        //Función para mostrar mensaje de éxito o error
        function mensaje_movimientos_salidas_refacciones_consumo_interno_refacciones(tipoMensaje, mensaje)
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
                new $.Zebra_Dialog(mensaje, {
                                    'type': 'information',
                                    'title': 'Información',
                                    'buttons': [{caption: 'Aceptar',
                                                 callback: function () {
                                                    //Enfocar caja de texto
                                                    $('#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
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
        function cambiar_estatus_movimientos_salidas_refacciones_consumo_interno_refacciones(id, polizaID, folioPoliza)
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
                intID = $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
                intPolizaID = $('#txtPolizaID_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
                strFolioPoliza = $('#txtFolioPoliza_movimientos_salidas_refacciones_consumo_interno_refacciones').val();

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
                                              $.post('refacciones/movimientos_salidas_refacciones_consumo_interno/set_estatus',
                                                     {intMovimientoRefaccionesID: intID,
                                                      intPolizaID: intPolizaID
                                                     },
                                                     function(data) {
                                                        if(data.resultado)
                                                        {
                                                            //Hacer llamado a la función  para cargar  los registros en el grid
                                                            paginacion_movimientos_salidas_refacciones_consumo_interno_refacciones();

                                                            //Si el id del registro se obtuvo del modal
                                                            if(id == '')
                                                            {
                                                                //Hacer un llamado a la función para cerrar modal
                                                                cerrar_movimientos_salidas_refacciones_consumo_interno_refacciones();     
                                                            }
                                                        }
                                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                                                        mensaje_movimientos_salidas_refacciones_consumo_interno_refacciones(data.tipo_mensaje, data.mensaje);
                                                     },
                                                    'json');
                                            }
                                          }
                              });

        }

        //Función para regresar los datos (al formulario) del registro seleccionado
        function editar_movimientos_salidas_refacciones_consumo_interno_refacciones(id, tipoAccion)
        {
            //Hacer un llamado al método del controlador para regresar los datos del registro
            $.post('refacciones/movimientos_salidas_refacciones_consumo_interno/get_datos',
                   {intMovimientoRefaccionesID:id
                   },
                   function(data) {
                        //Si hay datos del registro
                        if(data.row)
                        {
                            //Hacer un llamado a la función para limpiar los campos del formulario
                            nuevo_movimientos_salidas_refacciones_consumo_interno_refacciones();
                            //Asignar estatus del registro
                            var strEstatus = data.row.estatus;
                            //Asignar el id de la póliza
                            var intPolizaID = parseInt(data.row.poliza_id);
                            //Variable que se utiliza para asignar las acciones del grid view
                            var strAccionesTabla = '';
                            
                            //Recuperar valores
                            $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_consumo_interno_refacciones').val(data.row.movimiento_refacciones_id);
                            $('#txtFolio_movimientos_salidas_refacciones_consumo_interno_refacciones').val(data.row.folio);
                            $('#txtFecha_movimientos_salidas_refacciones_consumo_interno_refacciones').val(data.row.fecha);
                            $('#txtDepartamentoID_movimientos_salidas_refacciones_consumo_interno_refacciones').val(data.row.referencia_id);
                             $('#txtDepartamento_movimientos_salidas_refacciones_consumo_interno_refacciones').val(data.row.departamento);
                            $('#txtEmpleadoAutorizacionID_movimientos_salidas_refacciones_consumo_interno_refacciones').val(data.row.empleado_autorizacion);
                            $('#txtEmpleadoAutorizacion_movimientos_salidas_refacciones_consumo_interno_refacciones').val(data.row.empleado);
                            $('#txtObservaciones_movimientos_salidas_refacciones_consumo_interno_refacciones').val(data.row.observaciones);
                            $('#txtPolizaID_movimientos_salidas_refacciones_consumo_interno_refacciones').val(intPolizaID);
                            $('#txtFolioPoliza_movimientos_salidas_refacciones_consumo_interno_refacciones').val(data.row.folio_poliza);
                            //Dependiendo del estatus cambiar el color del encabezado 
                            $('#divEncabezadoModal_movimientos_salidas_refacciones_consumo_interno_refacciones').addClass("estatus-"+strEstatus);
                            //Mostrar botón Imprimir  
                            $("#btnImprimirRegistro_movimientos_salidas_refacciones_consumo_interno_refacciones").show();

                          
                            //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
                            if(tipoAccion == 'Ver')
                            {
                                //Deshabilitar todos los elementos del formulario
                                $('#frmMovimientosSalidasRefaccionesConsumoInternoRefacciones').find('input, textarea, select').attr('disabled','disabled');
                                //Ocultar los siguientes botones
                                $("#btnGuardar_movimientos_salidas_refacciones_consumo_interno_refacciones").hide();
                                //Deshabilitar botón Agregar
                                $('#btnAgregar_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').prop('disabled', true);

                                //Si existe el id de la póliza
                                if(strEstatus == 'ACTIVO' && intPolizaID > 0)
                                {
                                    //Mostrar el botón Desactivar
                                    $("#btnDesactivar_movimientos_salidas_refacciones_consumo_interno_refacciones").show();
                                }

                            }
                            else
                            {
                                strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
                                                   " onclick='editar_renglon_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones(this)'>" + 
                                                   "<span class='glyphicon glyphicon-edit'></span></button>" + 
                                                   "<button class='btn btn-default btn-xs' title='Eliminar'" +
                                                   " onclick='eliminar_renglon_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones(this)'>" + 
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
                                var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').getElementsByTagName('tbody')[0];

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
                                var objCeldaDisponibleExistencia = objRenglon.insertCell(8);
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
                                var intDisponibleExistencia = intCantidad + parseFloat(data.detalles[intCon].disponible_existencia);

                                //Calcular subtotal
                                intSubtotal = intCantidad * intSubtotal;

                                //Cambiar cantidad a  formato moneda (a visualizar)
                                intCantidad =  formatMoney(intCantidad, 2, '');


                                var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosSalidasRefaccionesConsumoInternoRefacciones, '');


                                var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesConsumoInternoRefacciones, '');

                                //Cambiar cantidad a  formato moneda (a guardar en la  BD)
                                var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesConsumoInternoRefacciones, '');

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
                                objCeldaDisponibleExistencia.setAttribute('class', 'no-mostrar');
                                objCeldaDisponibleExistencia.innerHTML = intDisponibleExistencia;
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
                            calcular_totales_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
                            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
                            var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones tr").length - 2;
                            $('#numElementos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(intFilas);
                            $('#txtNumDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(intFilas);
                            
                           

                            //Abrir modal
                            objMovimientosSalidasRefaccionesConsumoInternoRefacciones = $('#MovimientosSalidasRefaccionesConsumoInternoRefaccionesBox').bPopup({
                                                           appendTo: '#MovimientosSalidasRefaccionesConsumoInternoRefaccionesContent', 
                                                           contentContainer: 'MovimientosSalidasRefaccionesConsumoInternoRefaccionesM', 
                                                           zIndex: 2, 
                                                           modalClose: false, 
                                                           modal: true, 
                                                           follow: [true,false], 
                                                           followEasing : "linear", 
                                                           easing: "linear", 
                                                           modalColor: ('#F0F0F0')});

                            //Enfocar caja de texto
                            $('#txtDepartamento_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                        }
                   },
                   'json');
        }  


        //Función para generar póliza con los datos de un registro
        function generar_poliza_movimientos_salidas_refacciones_consumo_interno_refacciones(id, formulario)
        {   

            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Variable que se utiliza para saber si el id se obtuvo desde el modal
            var strTipo = 'modal';
            //Si no existe id, significa que se realizará la modificación desde el modal
            if(id == '')
            {
                intID = $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
            }
            else
            {
                intID = id;
                strTipo = 'gridview';
            }

            //Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
            mostrar_circulo_carga_movimientos_salidas_refacciones_consumo_interno_refacciones(formulario);
            //Hacer un llamado al método del controlador para timbrar los datos del registro
            $.post('contabilidad/generar_polizas/generar_poliza',
             {
                intReferenciaID: intID,
                strTipoReferencia: strTipoReferenciaMovimientosSalidasRefaccionesConsumoInternoRefacciones, 
                intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_consumo_interno_refacciones').val()
             },
             function(data) {

                //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
                ocultar_circulo_carga_movimientos_salidas_refacciones_consumo_interno_refacciones(formulario);
                
                //Si existe resultado
                if (data.resultado)
                {
                    //Hacer llamado a la función para cargar  los registros en el grid
                    paginacion_movimientos_salidas_refacciones_consumo_interno_refacciones();

                    //Si el id del registro se obtuvo del modal
                    if(strTipo == 'modal')
                    {
                        //Hacer un llamado a la función para cerrar modal
                        cerrar_movimientos_salidas_refacciones_consumo_interno_refacciones();
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
                                                        cerrar_movimientos_salidas_refacciones_consumo_interno_refacciones();
                                                     }
                                                    }]
                                      });
                }
                else
                {
                    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                    mensaje_movimientos_salidas_refacciones_consumo_interno_refacciones(data.tipo_mensaje, data.mensaje);
                }
                
             },
             'json');

        }

        //Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function mostrar_circulo_carga_movimientos_salidas_refacciones_consumo_interno_refacciones(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_salidas_refacciones_consumo_interno_refacciones';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_consumo_interno_refacciones';
            }

            //Remover clase para mostrar div que contiene la barra de carga
            $("#"+strCampoID).removeClass('no-mostrar');
        }


        //Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function ocultar_circulo_carga_movimientos_salidas_refacciones_consumo_interno_refacciones(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_salidas_refacciones_consumo_interno_refacciones';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_consumo_interno_refacciones';
            }

            //Agregar clase para ocultar div que contiene la barra de carga
            $("#"+strCampoID).addClass('no-mostrar');
        }

        
        
        /*******************************************************************************************************************
        Funciones de la tabla detalles
        *********************************************************************************************************************/
        //Función para mostrar u ocultar div que contiene el combobox de la sucursal (módulo)
        function mostrar_cmb_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones(intSucursalID = null, intModuloID = null)
        {
            //Asignar el texto del combobox
            var strTipo = $('select[name="strTipo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones"] option:selected').text();

        
            //Dependiendo  del tipo de gasto mostar u ocultar div´s que contienen combobox
            if(strTipo == 'GASTOS CORPORATIVOS')
            {
                //Agregar clase no-mostrar para ocultar div que contiene el combobox del módulo
                $('#divCmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').addClass("no-mostrar");
                //Agregar clase no-mostrar para ocultar div que contiene el combobox de la sucursal
                $('#divCmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').addClass("no-mostrar");
            }
            else if(strTipo == strCuenta602MovimientosSalidasRefaccionesConsumoInternoRefacciones)//Cuenta 602
            {
                //Quitar clase no-mostrar para mostrar div que contiene el combobox del módulo
                $('#divCmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').removeClass("no-mostrar");
                //Quitar clase no-mostrar para mostrar div que contiene el combobox de la sucursal
                $('#divCmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').removeClass("no-mostrar");

            }
            else //Cuenta 603
            {
                //Quitar clase no-mostrar para mostrar div que contiene el combobox de la sucursal
                $('#divCmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').removeClass("no-mostrar");
                //Agregar clase no-mostrar para ocultar div que contiene el combobox del módulo
                $('#divCmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').addClass("no-mostrar");
            }

            //Asignar el id de la sucursal
            $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(intSucursalID);
             //Asignar el id del módulo
            $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(intModuloID);

        }

        //Función para inicializar elementos de la refacción
        function inicializar_refaccion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones()
        {
            //Limpiar contenido de las siguientes cajas de texto
            $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
            $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
            $('#txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
            $('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
            $("#txtCodigoLinea_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").val('');
            $("#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").val('');
            $("#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").val('');
            
        }

        //Función para regresar obtener los datos de una refacción
        function get_datos_refaccion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones()
        {
             //Hacer un llamado al método del controlador para regresar los datos de la refacción
            $.post('refacciones/refacciones/get_datos',
                  { 
                    strBusqueda:$("#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").val(),
                    strTipo: 'id'
                  },
                  function(data) {
                        if(data.row)
                        {
                           $("#txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").val(data.row.descripcion);
                           $("#txtCostoUnitario_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").val(data.row.actual_costo);
                           //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
                            $('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarMovimientosSalidasRefaccionesConsumoInternoRefacciones });
                           $("#txtCodigoLinea_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").val(data.row.codigo_linea);
                           $("#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").val(data.row.disponible_existencia);
                           $("#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").val(data.row.disponible_existencia);
                           //Enfocar caja de texto
                           $("#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").focus();
                        }
                  }
                 ,
                'json');
        }

        //Función para agregar renglón a la tabla
        function agregar_renglon_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones()
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
            var intRefaccionID = $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
            var strCodigo = $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
            var strDescripcion = $('#txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
            var strCodigoLinea = $('#txtCodigoLinea_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
            var intCantidad = $('#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
            var intDisponibleExistencia = $('#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
            var intCostoUnitario = $('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
           
            //Asignar el texto del combobox
            var strGastoTipo = $('select[name="strGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones"] option:selected').text();
            var strTipoGasto = $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
            var intSucursalID = $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
            var intModuloID = $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();
            var intGastoTipoID = $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val();


            //Obtenemos el objeto de la tabla
            var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').getElementsByTagName('tbody')[0];

            //Validamos que se capturaron datos
            if (strTipoGasto == '')
            {
                //Enfocar combobox
                $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
            }
            else if (strTipoGasto == strCuenta602MovimientosSalidasRefaccionesConsumoInternoRefacciones && intSucursalID == '')
            {
                //Enfocar combobox
                $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
            }
            else if (strTipoGasto == strCuenta602MovimientosSalidasRefaccionesConsumoInternoRefacciones && intModuloID == '')
            {
                //Enfocar combobox
                $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
            }
            else if (strTipoGasto == strCuenta603MovimientosSalidasRefaccionesConsumoInternoRefacciones && intSucursalID == '')
            {
                //Enfocar combobox
                $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
            }
            else if (intGastoTipoID == '')
            {
                //Enfocar caja de texto
                $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
            }
            else if (intRefaccionID == '' || strCodigo == '')
            {
                //Enfocar caja de texto
                $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
            }
            else if (intRefaccionID == '' || strDescripcion == '')
            {
                //Enfocar caja de texto
                $('#txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
            }
            else if (intCantidad == '')
            {
                //Enfocar caja de texto
                $('#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
            }
            else
            {
                //Convertir cadena de texto a número decimal
                intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
                intCostoUnitario =  parseFloat($.reemplazar(intCostoUnitario, ",", ""));
                intSubtotal =  intCostoUnitario;
                intDisponibleExistencia = parseFloat(intDisponibleExistencia);

                //Verificar que la cantidad sea menor o igual que la existencia disponible 
                if(intCantidad <= intDisponibleExistencia)
                {
                    //Hacer un llamado a la función para inicializar elementos de la refacción
                    inicializar_refaccion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
                    //Limpiar contenido de los siguientes combobox
                    $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').empty();
                    //Hacer un llamado a la función para mostrar u ocultar sucursal y/ módulo
                    mostrar_cmb_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
                    
                    //Calcular subtotal
                    intSubtotal = intCantidad * intSubtotal;

                    //Calcular importe total
                    intTotal = intSubtotal + intImporteIva + intImporteIeps;

                    //Cambiar cantidad a  formato moneda (a visualizar)
                    intCantidad =  formatMoney(intCantidad, 2, '');

                    var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosSalidasRefaccionesConsumoInternoRefacciones, '');

                    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesConsumoInternoRefacciones, '');


                    //Cambiar cantidad a  formato moneda (a guardar en la  BD)
                    var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesConsumoInternoRefacciones, '');

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
                        var objCeldaDisponibleExistencia = objRenglon.insertCell(8);
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
                                                     " onclick='editar_renglon_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones(this)'>" + 
                                                     "<span class='glyphicon glyphicon-edit'></span></button>" + 
                                                     "<button class='btn btn-default btn-xs' title='Eliminar'" +
                                                     " onclick='eliminar_renglon_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones(this)'>" + 
                                                     "<span class='glyphicon glyphicon-trash'></span></button>" + 
                                                     "<button class='btn btn-default btn-xs up' title='Subir'>" + 
                                                     "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
                                                     "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
                                                     "<span class='glyphicon glyphicon-arrow-down'></span></button>";
                        objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
                        objCeldaCodigoLinea.innerHTML = strCodigoLinea; 
                        objCeldaDisponibleExistencia.setAttribute('class', 'no-mostrar');
                        objCeldaDisponibleExistencia.innerHTML = intDisponibleExistencia;
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
                    calcular_totales_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
                    
                    //Enfocar caja de texto
                    $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                }
                else
                {
                    //Cambiar cantidad a formato moneda
                    intDisponibleExistencia = formatMoney(intDisponibleExistencia, 2, '');

                    //Asignar existencia disponible 
                    $('#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(intDisponibleExistencia);

                    //Hacer un llamado a la función para mostrar mensaje de información
                    mensaje_movimientos_salidas_refacciones_consumo_interno_refacciones('informacion', 'La cantidad no debe exceder de ' + intDisponibleExistencia);
                }
                
            }

            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
            var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones tr").length - 2;
            $('#numElementos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(intFilas);
            $('#txtNumDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(intFilas);
        }

        //Función para regresar los datos (al formulario) del renglón seleccionado
        function editar_renglon_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones(objRenglon)
        {

            //Variable que se utiliza para asignar el id de la sucursal
            var intSucursalID = objRenglon.parentNode.parentNode.cells[11].innerHTML;
            //Variable que se utiliza para asignar el id del módulo
            var intModuloID = objRenglon.parentNode.parentNode.cells[12].innerHTML;
            //Variable que se utiliza para asignar el id del tipo de gasto
            var intGastoTipoID = objRenglon.parentNode.parentNode.cells[13].innerHTML;

            //Asignar los valores a las cajas de texto
            $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
            $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
            $('#txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
            $('#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
            $('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
            $('#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(objRenglon.parentNode.parentNode.cells[8].innerHTML);

            //Asignar el tipo de gasto
            $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);

            //Hacer un llamado a la función para cargar gastos en el combobox
            cargar_gastos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones(intGastoTipoID);
            //Hacer un llamado a la función para mostrar u ocultar módulo
            mostrar_cmb_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones(intSucursalID, intModuloID);

            //Enfocar caja de texto
            $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
        }

        //Función para quitar renglón de la tabla
        function eliminar_renglon_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones(objRenglon)
        {
            //Obtener el indice del objeto renglón que se envía
            var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
            
            //Eliminar el renglón indicado
            document.getElementById("dg_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").deleteRow(intRenglon);

            //Hacer un llamado a la función para calcular totales de la tabla
            calcular_totales_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
            
            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
            var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones tr").length - 2;
            $('#numElementos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(intFilas);
            $('#txtNumDetalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(intFilas);

            //Enfocar caja de texto
            $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
        }

        //Función para calcular totales de la tabla
        function calcular_totales_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones()
        {
            //Obtenemos el objeto de la tabla 
            var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').getElementsByTagName('tbody')[0];

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
            intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesConsumoInternoRefacciones, '');

            //Asignar los valores
            $('#acumCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(intAcumUnidades);
            $('#acumSubtotal_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').html(intAcumSubtotal);
            
        }

        //Controles o Eventos del Modal
        $(document).ready(function() 
        {
            /*******************************************************************************************************************
            Controles correspondientes al modal
            *********************************************************************************************************************/
            //Validar campos decimales (no hay necesidad de poner '.')
            $('#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').numeric();
          
            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_salidas_refacciones_consumo_interno_refacciones').blur(function(){
                $('.cantidad_movimientos_salidas_refacciones_consumo_interno_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
            });

            //Agregar datepicker para seleccionar fecha
            $('#dteFecha_movimientos_salidas_refacciones_consumo_interno_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
          
            //Autocomplete para recuperar los datos de un departamento
            $('#txtDepartamento_movimientos_salidas_refacciones_consumo_interno_refacciones').autocomplete({
                source: function( request, response ) {
                   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtDepartamentoID_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
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
                 $('#txtDepartamentoID_movimientos_salidas_refacciones_consumo_interno_refacciones').val(ui.item.data);

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
            $('#txtDepartamento_movimientos_salidas_refacciones_consumo_interno_refacciones').focusout(function(e){
                //Si no existe id del departamento
                if($('#txtDepartamentoID_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '' ||
                   $('#txtDepartamento_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtDepartamentoID_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                   $('#txtDepartamento_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                }

            });

            //Autocomplete para recuperar los datos de un empleado
            $('#txtEmpleadoAutorizacion_movimientos_salidas_refacciones_consumo_interno_refacciones').autocomplete({
                source: function( request, response ) {
                   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtEmpleadoAutorizacionID_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
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
                 $('#txtEmpleadoAutorizacionID_movimientos_salidas_refacciones_consumo_interno_refacciones').val(ui.item.data);

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
            $('#txtEmpleadoAutorizacion_movimientos_salidas_refacciones_consumo_interno_refacciones').focusout(function(e){
                //Si no existe id del empleado
                if($('#txtEmpleadoAutorizacionID_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '' ||
                   $('#txtEmpleadoAutorizacion_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtEmpleadoAutorizacionID_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                   $('#txtEmpleadoAutorizacion_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                }

            });


            //Cargar tipos de gastos cuando se modifique la selección del combo
            $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').change(function(e){
                //Si no existe tipo de gasto
                if($('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                {
                    //Limpiar contenido de los siguientes combobox
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').empty();

                }
                else
                {

                    //Limpiar contenido de los siguientes combobox
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                    //Hacer un llamado a la función para cargar gastos en el combobox
                    cargar_gastos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();

                    //Enfocar comobox
                    $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                }


               //Hacer un llamado a la función para mostrar u ocultar sucursal y/o módulo
               mostrar_cmb_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
                
                
            });

            //Enfocar módulo ó tipo de gasto cuando se modifique la selección del combo
            $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').change(function(e){
                
                //Asignar el texto del combobox
                var strTipo = $('select[name="strTipo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones"] option:selected').text();

                //Si el tipo de gasto  corresponde a la cuenta 602
                if(strTipo == strCuenta602MovimientosSalidasRefaccionesConsumoInternoRefacciones)
                {
                    //Enfocar comobox
                    $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                }
                else
                {
                    //Enfocar comobox
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();

                }
                
            
            });

            //Enfocar tipo de gasto cuando se modifique la selección del combo
            $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').change(function(e){
                
                //Enfocar comobox
                $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
            });

            
            //Enfocar concepto cuando se modifique la selección del combo
            $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').change(function(e){
                //Si no existe id del tipo de gasto
                if($('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                {
                    //Enfocar comobox
                    $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                }
                else
                {

                    //Enfocar caja de texto
                    $('#txtConcepto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                }


            });
            
            //Autocomplete para recuperar los datos de una refacción
            $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').autocomplete({
                  source: function( request, response ) {
                     //Limpiar caja de texto que hace referencia al id del registro 
                     $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                     $.ajax({
                       //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                       url: "refacciones/refacciones/autocomplete",
                       type: "post",
                       dataType: "json",
                       data: {
                         strDescripcion: request.term,
                         strTipo: 'codigo', 
                         strTipoMovimiento: 'salida'
                       },
                       success: function( data ) {
                         response( data );
                       }
                     });
                 },
                 select: function( event, ui ) {
                    //Asignar id del registro seleccionado
                    $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(ui.item.data);
                    //Hacer un llamado a la función para regresar los datos de la refacción
                    get_datos_refaccion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
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
            $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focusout(function(e){
                //Si no existe id de la refacción
                if($('#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '' ||
                   $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                { 
                    //Hacer un llamado a la función para inicializar elementos de la refacción
                    inicializar_refaccion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
                }

            });

            //Autocomplete para recuperar los datos de una refacción
            $('#txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').autocomplete({
                  source: function( request, response ) {
                     //Limpiar caja de texto que hace referencia al id del registro 
                     $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                     $.ajax({
                       //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                       url: "refacciones/refacciones/autocomplete",
                       type: "post",
                       dataType: "json",
                       data: {
                         strDescripcion: request.term,
                         strTipo: 'descripcion',
                         strTipoMovimiento: 'salida'
                       },
                       success: function( data ) {
                         response( data );
                       }
                     });
                 },
                 select: function( event, ui ) {
                    //Asignar id del registro seleccionado
                    $('#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(ui.item.data);
                    //Elegir código desde el valor devuelto en el autocomplete
                    var strCodigo = ui.item.value.split(" - ")[0];
                    $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val(strCodigo);
                    //Hacer un llamado a la función para regresar los datos de la refacción
                    get_datos_refaccion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
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
            $('#txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focusout(function(e){
                //Si no existe id de la refacción
                if($('#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '' ||
                   $('#txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                { 
                    //Hacer un llamado a la función para inicializar elementos de la refacción
                    inicializar_refaccion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
                }

            });


            //Función para mover renglones arriba y abajo en la tabla
            $('#dg_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').on('click','button.btn',function(){
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
            $("#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").keydown(function(e){
                var key = e.charCode || e.keyCode;
                if (key == 13)
                { 
                    //Si no existe tipo de gasto
                    if($('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                    {
                        //Enfocar combobox
                        $('#cmbTipoGasto_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                    else
                    {
                        //Enfocar combobox
                        $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                
                }  
            });


            //Validar que exista sucursal cuando se pulse la tecla enter 
            $("#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").keydown(function(e){
                var key = e.charCode || e.keyCode;
                if (key == 13)
                { 
                    //Si no existe sucursal
                    if($('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                    {
                        //Enfocar combobox
                        $('#cmbSucursalID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                    else
                    {
                        //Enfocar combobox
                        $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                
                }  
            });


            //Validar que exista módulo cuando se pulse la tecla enter 
            $("#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").keydown(function(e){
                var key = e.charCode || e.keyCode;
                if (key == 13)
                { 
                    //Si no existe módulo
                    if($('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                    {
                        //Enfocar combobox
                        $('#cmbModuloID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                    else
                    {
                        //Enfocar combobox
                        $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                
                }  
            });


            //Validar que exista gasto cuando se pulse la tecla enter 
            $("#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones").keydown(function(e){
                var key = e.charCode || e.keyCode;
                if (key == 13)
                { 
                    //Si no existe id del tipo de gasto
                    if($('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                    {
                        //Enfocar combobox
                        $('#cmbGastoTipoID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                    else
                    {
                        //Enfocar caja de texto
                        $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                
                }  
            });


            //Validar que exista código de la refacción cuando se pulse la tecla enter 
            $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe código de la refacción
                    if($('#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '' || $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtCodigo_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                    else
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                }
            });

            //Validar que exista descripción de la refacción cuando se pulse la tecla enter 
            $('#txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe descripción de la refacción
                    if($('#txtRefaccionID_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '' || $('#txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtDescripcion_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                    else
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                }
            });

            //Validar que exista cantidad cuando se pulse la tecla enter 
            $('#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe cantidad
                    if($('#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                    else
                    {
                        //Enfocar botón Agregar
                        $('#btnAgregar_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
                    }
                }
            });

           

            /*******************************************************************************************************************
            Controles correspondientes al formulario principal
            *********************************************************************************************************************/
            //Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
            $('#dteFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
            $('#dteFechaFinalBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').datetimepicker({format: 'DD/MM/YYYY',
                                                                                                                useCurrent: false});
            //Deshabilitar los días posteriores a la fecha final
            $('#dteFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').on('dp.change', function (e) {
                $('#dteFechaFinalBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').data('DateTimePicker').minDate(e.date);
            });

            //Deshabilitar los días anteriores a la fecha inicial
            $('#dteFechaFinalBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').on('dp.change', function (e) {
                $('#dteFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').data('DateTimePicker').maxDate(e.date);
            });
            
            //Autocomplete para recuperar los datos de un departamento
            $('#txtDepartamentoBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').autocomplete({
                source: function( request, response ) {
                   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
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
                 $('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val(ui.item.data);
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
            $('#txtDepartamentoBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').focusout(function(e){
                //Si no existe id del departamento
                if($('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '' ||
                   $('#txtDepartamentoBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtDepartamentoIDBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                   $('#txtDepartamentoBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').val('');
                }

            });

            //Paginación de registros
            $('#pagLinks_movimientos_salidas_refacciones_consumo_interno_refacciones').on('click','a',function(event){
                event.preventDefault();
                intPaginaMovimientosSalidasRefaccionesConsumoInternoRefacciones = $(this).attr('href').replace('/','');
                //Hacer llamado a la función  para cargar  los registros en el grid
                paginacion_movimientos_salidas_refacciones_consumo_interno_refacciones();
            });

            //Abrir modal cuando se de clic en el botón
            $('#btnNuevo_movimientos_salidas_refacciones_consumo_interno_refacciones').bind('click', function(e) {
                e.preventDefault();
                //Hacer un llamado a la función para limpiar los campos del formulario
                nuevo_movimientos_salidas_refacciones_consumo_interno_refacciones();
                //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
                $('#divEncabezadoModal_movimientos_salidas_refacciones_consumo_interno_refacciones').addClass("estatus-NUEVO");
                //Abrir modal
                objMovimientosSalidasRefaccionesConsumoInternoRefacciones = $('#MovimientosSalidasRefaccionesConsumoInternoRefaccionesBox').bPopup({
                                               appendTo: '#MovimientosSalidasRefaccionesConsumoInternoRefaccionesContent', 
                                               contentContainer: 'MovimientosSalidasRefaccionesConsumoInternoRefaccionesM', 
                                               zIndex: 2, 
                                               modalClose: false, 
                                               modal: true, 
                                               follow: [true,false], 
                                               followEasing : "linear", 
                                               easing: "linear", 
                                               modalColor: ('#F0F0F0')});

                //Enfocar caja de texto
                $('#txtDepartamento_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
            });

            //Enfocar caja de texto
            $('#txtFechaInicialBusq_movimientos_salidas_refacciones_consumo_interno_refacciones').focus();
            //Hacer un llamado a la función para obtener los permisos de acceso
            permisos_movimientos_salidas_refacciones_consumo_interno_refacciones();
            //Hacer un llamado a la función para cargar sucursales en el combobox del modal
            cargar_sucursales_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();
            //Hacer un llamado a la función para cargar módulos en el combobox del modal
            cargar_modulos_detalles_movimientos_salidas_refacciones_consumo_interno_refacciones();

        });
    </script>