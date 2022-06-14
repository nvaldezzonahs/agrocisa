
    <div id="MovimientosEntradasRefaccionesAjusteRefaccionesContent">  
        <!--Barra de herramientas-->
        <div class="panel-toolbar">
            <!--Diseño del formulario de Búsquedas-->
            <form class="form-horizontal" id="frmBusqueda_movimientos_entradas_refacciones_ajuste_refacciones" action="#" method="post" tabindex="-5" 
                  onsubmit="return(false)">
                <div class="row">
                    <!--Fecha inicial-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="txtFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones">Fecha inicial</label>
                            </div>
                            <div class="col-md-12">
                                <div class='input-group date' id='dteFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones'>
                                    <input class="form-control" 
                                            id="txtFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones"
                                            name= "strFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones" 
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
                                <label for="txtFechaFinalBusq_movimientos_entradas_refacciones_ajuste_refacciones">Fecha final</label>
                            </div>
                            <div class="col-md-12">
                                <div class='input-group date' id='dteFechaFinalBusq_movimientos_entradas_refacciones_ajuste_refacciones'>
                                    <input class="form-control" 
                                            id="txtFechaFinalBusq_movimientos_entradas_refacciones_ajuste_refacciones"
                                            name= "strFechaFinalBusq_movimientos_entradas_refacciones_ajuste_refacciones" 
                                            type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Autocomplete que contiene los empleados activos-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
                                <input id="txtEmpleadoIDBusq_movimientos_entradas_refacciones_ajuste_refacciones" 
                                       name="intEmpleadoIDBusq_movimientos_entradas_refacciones_ajuste_refacciones"  
                                       type="hidden" value="">
                                </input>
                                <label for="txtEmpleadoBusq_movimientos_entradas_refacciones_ajuste_refacciones">Empleado</label>
                            </div>
                            <div class="col-md-12">
                                <input  class="form-control" id="txtEmpleadoBusq_movimientos_entradas_refacciones_ajuste_refacciones" 
                                        name="strEmpleadoBusq_movimientos_entradas_refacciones_ajuste_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
                                </input>
                            </div>
                        </div>
                    </div>
                    <!--Estatus-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="cmbEstatusBusq_movimientos_entradas_refacciones_ajuste_refacciones">Estatus</label>
                            </div>
                            <div class="col-md-12">
                                <select class="form-control" id="cmbEstatusBusq_movimientos_entradas_refacciones_ajuste_refacciones" 
                                        name="strEstatusBusq_movimientos_entradas_refacciones_ajuste_refacciones" tabindex="1">
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
                                <label for="txtBusqueda_movimientos_entradas_refacciones_ajuste_refacciones">Descripción</label>
                            </div>
                            <div class="col-md-12">
                                <input  class="form-control" id="txtBusqueda_movimientos_entradas_refacciones_ajuste_refacciones" 
                                        name="strBusqueda_movimientos_entradas_refacciones_ajuste_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
                                </input>
                            </div>
                        </div>
                    </div>
                    <!--Mostrar detalles de los registros en el reporte PDF--> 
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
                        <div class="checkbox">
                            <label id="label-checkbox">
                                <input class="form-control" 
                                        id="chbImprimirDetalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                        name="strImprimirDetalles_movimientos_entradas_refacciones_ajuste_refacciones" 
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
                            <button class="btn btn-primary" id="btnBuscar_movimientos_entradas_refacciones_ajuste_refacciones"
                                    onclick="paginacion_movimientos_entradas_refacciones_ajuste_refacciones();" 
                                    title="Buscar coincidencias" tabindex="1" disabled> 
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                            <!--Dar de alta un nuevo registro-->
                            <button class="btn btn-info" id="btnNuevo_movimientos_entradas_refacciones_ajuste_refacciones" 
                                    title="Nuevo registro" tabindex="1" disabled> 
                                <span class="glyphicon glyphicon-list-alt"></span>
                            </button>   
                            <!--Generar PDF con el listado de registros-->
                            <button class="btn btn-default"  id="btnImprimir_movimientos_entradas_refacciones_ajuste_refacciones"
                                    onclick="reporte_movimientos_entradas_refacciones_ajuste_refacciones('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
                                <span class="glyphicon glyphicon-print"></span>
                            </button> 
                            <!--Descargar archivo XLS con el listado de registros-->
                            <button class="btn btn-success"  id="btnDescargarXLS_movimientos_entradas_refacciones_ajuste_refacciones"
                                    onclick="reporte_movimientos_entradas_refacciones_ajuste_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
                td.movil.a3:nth-of-type(3):before {content: "Autoriza"; font-weight: bold;}
                td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
                td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

                /*
                Definir columnas de la tabla detalles del movimiento
                */
                td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
                td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
                td.movil.b3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
                td.movil.b4:nth-of-type(4):before {content: "Costo Unit."; font-weight: bold;}
                td.movil.b5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
                td.movil.b6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

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
                <table class="table-hover movil" id="dg_movimientos_entradas_refacciones_ajuste_refacciones">
                    <thead class="movil">
                        <tr class="movil">
                            <th class="movil">Folio</th>
                            <th class="movil">Fecha</th>
                            <th class="movil">Empleado</th>
                            <th class="movil">Estatus</th>
                            <th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="movil"></tbody>
                    <script id="plantilla_movimientos_entradas_refacciones_ajuste_refacciones" type="text/template"> 
                    {{#rows}}
                        <tr class="movil {{estiloRegistro}}">   
                            <td class="movil a1">{{folio}}</td>
                            <td class="movil a2">{{fecha}}</td>
                            <td class="movil a3">{{empleado}}</td>
                            <td class="movil a4">{{estatus}}</td>
                            <td class="td-center movil a5"> 
                                <!--Editar registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
                                        onclick="editar_movimientos_entradas_refacciones_ajuste_refacciones({{movimiento_refacciones_id}}, 'Editar')"  title="Editar">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </button>
                                <!--Ver registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
                                        onclick="editar_movimientos_entradas_refacciones_ajuste_refacciones({{movimiento_refacciones_id}}, 'Ver')"  title="Ver">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </button>
                                <!--Generar PDF con los datos del registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
                                        onclick="reporte_registro_movimientos_entradas_refacciones_ajuste_refacciones({{movimiento_refacciones_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
                                </button>
                                <!--Generar póliza-->
                                <button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
                                        onclick="generar_poliza_movimientos_entradas_refacciones_ajuste_refacciones({{movimiento_refacciones_id}}, 'principal')"  title="Generar póliza">
                                    <span class="glyphicon glyphicon-tags"></span>
                                </button>
                                <!--Desactivar registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
                                        onclick="cambiar_estatus_movimientos_entradas_refacciones_ajuste_refacciones({{movimiento_refacciones_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
                    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_entradas_refacciones_ajuste_refacciones"></div>
                    <!--Número de registros encontrados-->
                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                        <button class="btn btn-default btn-sm disabled pull-right">
                            <strong id="numElementos_movimientos_entradas_refacciones_ajuste_refacciones">0</strong> encontrados
                        </button>
                    </div>
                </div> <!--Cierre del diseño de la paginación-->
            </div><!--#container-fluid-->
        </div><!--Cierre del contenedor de la tabla-->
        <!--Circulo de progreso-->
        <div id="divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_ajuste_refacciones" class="load-container load5 circulo_bar no-mostrar">
            <div class="loader">Loading...</div>
            <br><br>
            <div align=center><b>Espere un momento por favor.</b></div>
        </div>  

        <!-- Diseño del modal-->
        <div id="MovimientosEntradasRefaccionesAjusteRefaccionesBox" class="ModalBody">
            <!--Título-->
            <div id="divEncabezadoModal_movimientos_entradas_refacciones_ajuste_refacciones"  class="ModalBodyTitle">
            <h1>Entradas por Ajuste</h1>
            </div>
            <!--Contenido-->
            <div class="ModalBodyContent">
                <!--Diseño del formulario-->
                <form id="frmMovimientosEntradasRefaccionesAjusteRefacciones" method="post" action="#" class="form-horizontal" role="form" 
                      name="frmMovimientosEntradasRefaccionesAjusteRefacciones"  onsubmit="return(false)" autocomplete="off">
                    <div class="row">
                        <!-- Folio -->
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
                                    <input id="txtMovimientoRefaccionesID_movimientos_entradas_refacciones_ajuste_refacciones" 
                                           name="intMovimientoRefaccionesID_movimientos_entradas_refacciones_ajuste_refacciones" 
                                           type="hidden" value="" />
                                    <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
                                    <input id="txtPolizaID_movimientos_entradas_refacciones_ajuste_refacciones" 
                                           name="intPolizaID_movimientos_entradas_refacciones_ajuste_refacciones" type="hidden" value="" />
                                    <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
                                    <input id="txtFolioPoliza_movimientos_entradas_refacciones_ajuste_refacciones" 
                                           name="strFolioPoliza_movimientos_entradas_refacciones_ajuste_refacciones" type="hidden" value="" />
                                    <label for="txtFolio_movimientos_entradas_refacciones_ajuste_refacciones">Folio</label>
                                </div>
                                <div class="col-md-12">
                                    <input  class="form-control" id="txtFolio_movimientos_entradas_refacciones_ajuste_refacciones" 
                                            name="strFolio_movimientos_entradas_refacciones_ajuste_refacciones" 
                                            type="text" value="" placeholder="Autogenerado" disabled />
                                </div>
                            </div>
                        </div>
                        <!-- Fecha -->
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="txtFecha_movimientos_entradas_refacciones_ajuste_refacciones">Fecha</label>
                                </div>
                                <div id="divFechaMsjValidacion" class="col-md-12">
                                    <div class='input-group date' id='dteFecha_movimientos_entradas_refacciones_ajuste_refacciones'>
                                        <input class="form-control" 
                                                id="txtFecha_movimientos_entradas_refacciones_ajuste_refacciones"
                                                name= "strFecha_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Autocomplete que contiene los empleados activos-->
                        <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <!-- Caja de texto oculta que se utiliza para recuperar el id del empleado  seleccionado-->
                                    <input id="txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_ajuste_refacciones" 
                                           name="intEmpleadoAutorizacionID_movimientos_entradas_refacciones_ajuste_refacciones"  
                                           type="hidden"  value="">
                                    </input>
                                    <label for="txtEmpleadoAutorizacion_movimientos_entradas_refacciones_ajuste_refacciones">Autoriza</label>
                                </div>  
                                <div class="col-md-12">
                                    <input  class="form-control" 
                                            id="txtEmpleadoAutorizacion_movimientos_entradas_refacciones_ajuste_refacciones" 
                                            name="strEmpleadoAutorizacion_movimientos_entradas_refacciones_ajuste_refacciones" 
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
                                    <label for="txtObservaciones_movimientos_entradas_refacciones_ajuste_refacciones">Observaciones</label>
                                </div>  
                                <div class="col-md-12">
                                    <input  class="form-control" 
                                            id="txtObservaciones_movimientos_entradas_refacciones_ajuste_refacciones" 
                                            name="strObservaciones_movimientos_entradas_refacciones_ajuste_refacciones" 
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
                                    <input id="txtNumDetalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                           name="intNumDetalles_movimientos_entradas_refacciones_ajuste_refacciones" type="hidden" value="">
                                    </input>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Detalles de la entrada por ajuste</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                <div class="row">
                                                    <!--Autocomplete que contiene las refacciones activas-->
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <!-- Caja de texto oculta para recuperar el id de la  refacción seleccionada-->
                                                                <input id="txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                       name="intRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                <!-- Caja de texto oculta para recuperar el código de la línea de refacción de la refacción seleccionada-->
                                                                <input id="txtCodigoLinea_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                       name="strCodigoLinea_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                <label for="txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones">
                                                                    Código
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control" 
                                                                        id="txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                        name="strCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                        type="text" value="" tabindex="1" 
                                                                        placeholder="Ingrese código" maxlength="250" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Autocomplete que contiene las refacciones activas-->
                                                    <div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones">
                                                                    Descripción
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control" 
                                                                        id="txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                        name="strDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                        type="text" value="" tabindex="1" 
                                                                        placeholder="Ingrese descripción" maxlength="250" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Cantidad-->
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones">
                                                                    Cantidad
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control cantidad_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                        id="txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                        name="intCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                        type="text" value="" tabindex="1"
                                                                        placeholder="Ingrese cantidad" maxlength="14" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Costo unitario-->
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones">Costo unitario</label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control moneda_movimientos_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                        id="txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                        name="intCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                        type="text" value="" tabindex="1" 
                                                                        placeholder="Ingrese costo unitario"  maxlength="18"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Botón agregar-->
                                                    <div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                                                        <button class="btn btn-primary btn-toolBtns pull-right" 
                                                                id="btnAgregar_detalles_movimientos_entradas_refacciones_ajuste_refacciones" 
                                                                onclick="agregar_renglon_detalles_movimientos_entradas_refacciones_ajuste_refacciones();" 
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
                                                    <table class="table-hover movil" id="dg_detalles_movimientos_entradas_refacciones_ajuste_refacciones">
                                                        <thead class="movil">
                                                            <tr class="movil">
                                                                <th class="movil">Código</th>
                                                                <th class="movil">Descripción</th>
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
                                                                <td  class="movil t3">
                                                                    <strong id="acumCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones"></strong>
                                                                </td>
                                                                <td class="movil t4"></td>
                                                                <td class="movil t5">
                                                                    <strong id="acumSubtotal_detalles_movimientos_entradas_refacciones_ajuste_refacciones"></strong>
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
                                                                <strong id="numElementos_detalles_movimientos_entradas_refacciones_ajuste_refacciones">0</strong> encontrados
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
                    <div id="divCirculoBarProgreso_movimientos_entradas_refacciones_ajuste_refacciones" class="load-container load5 circulo_bar no-mostrar">
                        <div class="loader">Loading...</div>
                        <br><br>
                        <div align=center><b>Espere un momento por favor.</b></div>
                    </div> 
                    <!--Botones de acción (barra de tareas)-->
                    <div class="btn-group row footerModal">
                        <div class="col-md-12">
                            <!--Guardar registro-->
                            <button class="btn btn-success" id="btnGuardar_movimientos_entradas_refacciones_ajuste_refacciones"  
                                    onclick="validar_movimientos_entradas_refacciones_ajuste_refacciones();"  title="Guardar" tabindex="2" disabled>
                                <span class="fa fa-floppy-o"></span>
                            </button>
                            <!--Generar PDF con los datos del registro-->
                            <button class="btn btn-default" 
                                    id="btnImprimirRegistro_movimientos_entradas_refacciones_ajuste_refacciones"  
                                    onclick="reporte_registro_movimientos_entradas_refacciones_ajuste_refacciones('');"  
                                    title="Imprimir" tabindex="3" disabled>
                                <span class="glyphicon glyphicon-print"></span>
                            </button>
                            <!--Desactivar registro-->
                            <button class="btn btn-default" id="btnDesactivar_movimientos_entradas_refacciones_ajuste_refacciones"  
                                    onclick="cambiar_estatus_movimientos_entradas_refacciones_ajuste_refacciones('','','');"  title="Desactivar" tabindex="4" disabled>
                                <span class="glyphicon glyphicon-ban-circle"></span>
                            </button>
                            <!--Cerrar modal-->
                            <button class="btn  btn-cerrar"  id="btnCerrar_movimientos_entradas_refacciones_ajuste_refacciones"
                                    type="reset" aria-hidden="true" onclick="cerrar_movimientos_entradas_refacciones_ajuste_refacciones();" 
                                    title="Cerrar"  tabindex="5">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    </div>
                </form><!--Cierre del formulario-->
            </div><!--Cierre del contenido-->
        </div><!--Cierre del modal-->
    </div><!--#MovimientosEntradasRefaccionesAjusteRefaccionesContent -->

    <!--Javascript con las funciones del formulario-->
    <script type="text/javascript">
        /*******************************************************************************************************************
        Funciones del formulario principal
        *********************************************************************************************************************/
        //Variables que se utilizan para la paginación de registros
        var intPaginaMovimientosEntradasRefaccionesAjusteRefacciones = 0;
        var strUltimaBusquedaMovimientosEntradasRefaccionesAjusteRefacciones = "";
        /*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
        var strTipoReferenciaMovimientosEntradasRefaccionesAjusteRefacciones = "MOVIMIENTO DE REFACCIONES";
        //Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
        var intNumDecimalesMostrarMovimientosEntradasRefaccionesAjusteRefacciones = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
        //Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
        var intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesAjusteRefacciones = <?php echo NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES ?>;
        //Variable que se utiliza para asignar objeto del modal
        var objMovimientosEntradasRefaccionesAjusteRefacciones = null;

        //Permisos  de acceso del usuario (Acciones Generales)
        function permisos_movimientos_entradas_refacciones_ajuste_refacciones()
        {
            //Hacer un llamado al método del controlador para regresar los permisos de acceso
            $.post('refacciones/movimientos_entradas_refacciones_ajuste/get_permisos_acceso',
            { 
                strPermisosAcceso: $('#txtAcciones_movimientos_entradas_refacciones_ajuste_refacciones').val()
            },
            function(data){
                //Si existen permisos de acceso del usuario para este proceso
                if (data.row)
                {
                    //Asignar a la variable la cadena concatenada con los permisos de acceso
                    //del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
                    var strPermisosMovimientosEntradasRefaccionesAjusteRefacciones = data.row;
                    //Separar la cadena 
                    var arrPermisosMovimientosEntradasRefaccionesAjusteRefacciones = strPermisosMovimientosEntradasRefaccionesAjusteRefacciones.split('|');

                    //Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
                    for (var i=0; i < arrPermisosMovimientosEntradasRefaccionesAjusteRefacciones.length; i++)
                    {
                        //Habilitar Acción si se cuenta con  permiso de acceso
                        if(arrPermisosMovimientosEntradasRefaccionesAjusteRefacciones[i]=='NUEVO')//Si el indice es NUEVO
                        {
                            //Habilitar el control (botón nuevo)
                            $('#btnNuevo_movimientos_entradas_refacciones_ajuste_refacciones').removeAttr('disabled');
                        }
                        //Si el indice es GUARDAR ó EDITAR (modificar)
                        else if((arrPermisosMovimientosEntradasRefaccionesAjusteRefacciones[i]=='GUARDAR') || (arrPermisosMovimientosEntradasRefaccionesAjusteRefacciones[i]=='EDITAR'))
                        {
                            //Habilitar el control (botón guardar)
                            $('#btnGuardar_movimientos_entradas_refacciones_ajuste_refacciones').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosEntradasRefaccionesAjusteRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
                        {
                            //Habilitar el control (botón buscar)
                            $('#btnBuscar_movimientos_entradas_refacciones_ajuste_refacciones').removeAttr('disabled');
                            //Hacer llamado a la función  para cargar  los registros en el grid
                            paginacion_movimientos_entradas_refacciones_ajuste_refacciones();
                        }
                        else if(arrPermisosMovimientosEntradasRefaccionesAjusteRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
                        {
                            //Habilitar los siguientes controles
                            $('#btnDesactivar_movimientos_entradas_refacciones_ajuste_refacciones').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosEntradasRefaccionesAjusteRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
                        {
                            //Habilitar el control (botón imprimir)
                            $('#btnImprimir_movimientos_entradas_refacciones_ajuste_refacciones').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosEntradasRefaccionesAjusteRefacciones[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
                        {
                            //Habilitar el control (botón imprimir)
                            $('#btnImprimirRegistro_movimientos_entradas_refacciones_ajuste_refacciones').removeAttr('disabled');
                        }
                        else if(arrPermisosMovimientosEntradasRefaccionesAjusteRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
                        {
                            //Habilitar el control (botón descargar XLS)
                            $('#btnDescargarXLS_movimientos_entradas_refacciones_ajuste_refacciones').removeAttr('disabled');
                        }
                    }//Cerrar for
                }
            },
            'json');
        }

        //Función para la búsqueda de registros
        function paginacion_movimientos_entradas_refacciones_ajuste_refacciones() 
        {
           //Concatenar datos para la nueva búsqueda
            var strNuevaBusquedaMovimientosEntradasRefaccionesAjusteRefacciones =($('#txtFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones').val()+$('#txtFechaFinalBusq_movimientos_entradas_refacciones_ajuste_refacciones').val()+$('#txtEmpleadoIDBusq_movimientos_entradas_refacciones_ajuste_refacciones').val()+$('#cmbEstatusBusq_movimientos_entradas_refacciones_ajuste_refacciones').val()+$('#txtBusqueda_movimientos_entradas_refacciones_ajuste_refacciones').val());
            //Verificar si hubo cambios en la búsqueda
            if(strNuevaBusquedaMovimientosEntradasRefaccionesAjusteRefacciones != strUltimaBusquedaMovimientosEntradasRefaccionesAjusteRefacciones)
            {
                intPaginaMovimientosEntradasRefaccionesAjusteRefacciones = 0;
                strUltimaBusquedaMovimientosEntradasRefaccionesAjusteRefacciones = strNuevaBusquedaMovimientosEntradasRefaccionesAjusteRefacciones;
            }

            //Hacer un llamado al método del controlador para regresar listado de registros
            $.post('refacciones/movimientos_entradas_refacciones_ajuste/get_paginacion',
                    { //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
                      dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones').val()),
                      dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_refacciones_ajuste_refacciones').val()),
                      intEmpleadoID: $('#txtEmpleadoIDBusq_movimientos_entradas_refacciones_ajuste_refacciones').val(),
                      strEstatus:     $('#cmbEstatusBusq_movimientos_entradas_refacciones_ajuste_refacciones').val(),
                      strBusqueda:    $('#txtBusqueda_movimientos_entradas_refacciones_ajuste_refacciones').val(),
                      intPagina: intPaginaMovimientosEntradasRefaccionesAjusteRefacciones,
                      strPermisosAcceso: $('#txtAcciones_movimientos_entradas_refacciones_ajuste_refacciones').val()
                    },
                    function(data){
                        $('#dg_movimientos_entradas_refacciones_ajuste_refacciones tbody').empty();
                        var tmpMovimientosEntradasRefaccionesAjusteRefacciones = Mustache.render($('#plantilla_movimientos_entradas_refacciones_ajuste_refacciones').html(),data);
                        $('#dg_movimientos_entradas_refacciones_ajuste_refacciones tbody').html(tmpMovimientosEntradasRefaccionesAjusteRefacciones);
                        $('#pagLinks_movimientos_entradas_refacciones_ajuste_refacciones').html(data.paginacion);
                        $('#numElementos_movimientos_entradas_refacciones_ajuste_refacciones').html(data.total_rows);
                        intPaginaMovimientosEntradasRefaccionesAjusteRefacciones = data.pagina;
                    },
            'json');
        }

        
        //Función para cargar/descargar el reporte general en PDF/XLS
        function reporte_movimientos_entradas_refacciones_ajuste_refacciones(strTipo) 
        {


            //Variable que se utiliza para asignar URL (ruta del controlador)
            var strUrl = 'refacciones/movimientos_entradas_refacciones_ajuste/';

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
            if ($('#chbImprimirDetalles_movimientos_entradas_refacciones_ajuste_refacciones').is(':checked')) {
                //Asignar SI para incluir detalles en el reporte
                $('#chbImprimirDetalles_movimientos_entradas_refacciones_ajuste_refacciones').val('SI');
            }
            else
            { 
               //Asignar NO para  no incluir detalles en el reporte
               $('#chbImprimirDetalles_movimientos_entradas_refacciones_ajuste_refacciones').val('NO');
            }


            //Definir encapsulamiento de datos que son necesarios para generar el reporte
            objReporte = {'url': strUrl,
                            'data' : {
                                        'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones').val()),
                                        'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_refacciones_ajuste_refacciones').val()),
                                        'intEmpleadoID': $('#txtEmpleadoIDBusq_movimientos_entradas_refacciones_ajuste_refacciones').val(),
                                        'strEstatus': $('#cmbEstatusBusq_movimientos_entradas_refacciones_ajuste_refacciones').val(), 
                                        'strBusqueda': $('#txtBusqueda_movimientos_entradas_refacciones_ajuste_refacciones').val(),
                                        'strDetalles': $('#chbImprimirDetalles_movimientos_entradas_refacciones_ajuste_refacciones').val()           
                                     }
                           };


            //Hacer un llamado a la función para imprimir/descargar el reporte
            $.imprimirReporte(objReporte);
           
        }

        //Función para cargar el reporte de un registro en PDF
        function reporte_registro_movimientos_entradas_refacciones_ajuste_refacciones(id) 
        {
            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Si no existe id, significa que se realizará la impresión desde el modal
            if(id == '')
            {
                intID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_ajuste_refacciones').val();
            }
            else
            {
                intID = id;
            }


            //Definir encapsulamiento de datos que son necesarios para generar el reporte
            objReporte = {'url': 'refacciones/movimientos_entradas_refacciones_ajuste/get_reporte_registro',
                            'data' : {
                                        'intMovimientoRefaccionesID': intID
                                     }
                           };

            //Hacer un llamado a la función para imprimir el reporte
            $.imprimirReporte(objReporte);
        }

        
        

        /*******************************************************************************************************************
        Funciones del modal
        *********************************************************************************************************************/
        // Función para limpiar los campos del formulario
        function nuevo_movimientos_entradas_refacciones_ajuste_refacciones()
        {
            //Incializar formulario
            $('#frmMovimientosEntradasRefaccionesAjusteRefacciones')[0].reset();
            //Hacer un llamado a la función para limpiar los mensajes de error 
            limpiar_mensajes_movimientos_entradas_refacciones_ajuste_refacciones();
            //Limpiar cajas de texto ocultas
            $('#frmMovimientosEntradasRefaccionesAjusteRefacciones').find('input[type=hidden]').val('');
            //Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
            $.removerClasesEncabezado('divEncabezadoModal_movimientos_entradas_refacciones_ajuste_refacciones');
            //Eliminar los datos de la tabla detalles del movimiento
            $('#dg_detalles_movimientos_entradas_refacciones_ajuste_refacciones tbody').empty();
            $('#acumCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones').html('');
            $('#acumSubtotal_detalles_movimientos_entradas_refacciones_ajuste_refacciones').html('');
            $('#numElementos_detalles_movimientos_entradas_refacciones_ajuste_refacciones').html(0);
            //Habilitar todos los elementos del formulario
            $('#frmMovimientosEntradasRefaccionesAjusteRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
             //Asignar la fecha actual
            $('#txtFecha_movimientos_entradas_refacciones_ajuste_refacciones').val(fechaActual()); 
            //Deshabilitar las siguientes cajas de texto
            $('#txtFolio_movimientos_entradas_refacciones_ajuste_refacciones').attr("disabled", "disabled");
            //Habilitar botón Agregar
            $('#btnAgregar_detalles_movimientos_entradas_refacciones_ajuste_refacciones').prop('disabled', false);
            //Mostrar los siguientes botones
            $("#btnGuardar_movimientos_entradas_refacciones_ajuste_refacciones").show();
            //Ocultar los siguientes botones
            $("#btnImprimirRegistro_movimientos_entradas_refacciones_ajuste_refacciones").hide();
            $("#btnDesactivar_movimientos_entradas_refacciones_ajuste_refacciones").hide();
        }

        //Función que se utiliza para cerrar el modal
        function cerrar_movimientos_entradas_refacciones_ajuste_refacciones()
        {
            try {
                //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
                ocultar_circulo_carga_movimientos_entradas_refacciones_ajuste_refacciones('');
                //Cerrar modal
                objMovimientosEntradasRefaccionesAjusteRefacciones.close();
                //Enfocar caja de texto 
                $('#txtFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones').focus();
                
            }
            catch(err) {}
        }

        //Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
        function validar_movimientos_entradas_refacciones_ajuste_refacciones()
        {
            //Hacer un llamado a la función para limpiar los mensajes de error 
            limpiar_mensajes_movimientos_entradas_refacciones_ajuste_refacciones();
            //Validación del formulario de campos obligatorios
            $('#frmMovimientosEntradasRefaccionesAjusteRefacciones')
                .bootstrapValidator({   excluded: [':disabled'],
                                        container: 'popover',
                                        feedbackIcons: {
                                            valid: 'glyphicon glyphicon-ok',
                                            invalid: 'glyphicon glyphicon-remove',
                                            validating: 'glyphicon glyphicon-refresh'
                                        },
                                        fields: {
                                            strFecha_movimientos_entradas_refacciones_ajuste_refacciones: {
                                                validators: {
                                                    notEmpty: {message: 'Seleccione una fecha'}
                                                }
                                            },
                                            strEmpleadoAutorizacion_movimientos_entradas_refacciones_ajuste_refacciones: {
                                                validators: {
                                                    callback: {
                                                        callback: function(value, validator, $field) {
                                                            //Verificar que exista id del empleado
                                                            if($('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_ajuste_refacciones').val() === '')
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
                                            intNumDetalles_movimientos_entradas_refacciones_ajuste_refacciones: {
                                                validators: {
                                                    callback: {
                                                        callback: function(value, validator, $field) {
                                                            //Verificar que existan detalles
                                                            if(parseInt(value) === 0 || value === '')
                                                            {
                                                                return {
                                                                    valid: false,
                                                                    message: 'Agregar al menos un detalle para esta entrada por ajuste.'
                                                                };
                                                            }
                                                            return true;
                                                        }
                                                    }
                                                }
                                            },
                                            strCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones: {
                                                excluded: true  // Ignorar (no valida el campo)    
                                            },
                                            strDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones:{
                                                excluded: true  // Ignorar (no valida el campo)    
                                            },
                                            intCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones: {
                                                excluded: true  // Ignorar (no valida el campo)    
                                            }
                                        }
                                    });
            //Variable que se utiliza para asignar el objeto bootstrapValidator
            var bootstrapValidator_movimientos_entradas_refacciones_ajuste_refacciones = $('#frmMovimientosEntradasRefaccionesAjusteRefacciones').data('bootstrapValidator');
            bootstrapValidator_movimientos_entradas_refacciones_ajuste_refacciones.validate();
            //Si se cumplen las reglas de validación
            if(bootstrapValidator_movimientos_entradas_refacciones_ajuste_refacciones.isValid())
            {
                //Hacer un llamado a la función para guardar los datos del registro
                guardar_movimientos_entradas_refacciones_ajuste_refacciones();
            }
            else 
                return;
        }

        //Función para limpiar mensajes de validación del formulario
        function limpiar_mensajes_movimientos_entradas_refacciones_ajuste_refacciones()
        {
            try
            {
                $('#frmMovimientosEntradasRefaccionesAjusteRefacciones').data('bootstrapValidator').resetForm();

            }
            catch(err) {}
        }

        //Función para guardar o modificar los datos de un registro
        function guardar_movimientos_entradas_refacciones_ajuste_refacciones()
        {
            //Obtenemos el objeto de la tabla detalles
            var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_ajuste_refacciones').getElementsByTagName('tbody')[0];

            //Inicializamos las variables que obtendrán los datos de la tabla
            var arrRefaccionID = [];
            var arrCodigos = [];
            var arrDescripciones = [];
            var arrCodigosLineas = [];
            var arrCantidades = [];
            var arrCostosUnitarios = [];

            //Recorrer los renglones de la tabla para obtener los valores
            for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
            {
                //Variables que se utilizan para asignar valores del detalle
                //Hacer un llamado a la función para reemplazar ',' por cadena vacia
                var intCantidad =  $.reemplazar(objRen.cells[2].innerHTML, ",", "");
                var intCostoUnitario = $.reemplazar(objRen.cells[7].innerHTML, ",", "");
              
                //Asignar valores a los arrays
                arrRefaccionID.push(objRen.getAttribute('id'));
                arrCodigos.push(objRen.cells[0].innerHTML);
                arrDescripciones.push(objRen.cells[1].innerHTML);
                arrCodigosLineas.push(objRen.cells[6].innerHTML);
                arrCantidades.push(intCantidad);
                arrCostosUnitarios.push(intCostoUnitario);
            }

            //Hacer un llamado al método del controlador para guardar los datos del registro
            $.post('refacciones/movimientos_entradas_refacciones_ajuste/guardar',
                    { 
                        //Datos del movimiento
                        intMovimientoRefaccionesID: $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_ajuste_refacciones').val(),
                        //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
                        dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_entradas_refacciones_ajuste_refacciones').val()),
                        intEmpleadoAutorizacion: $('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_ajuste_refacciones').val(),
                        strObservaciones: $('#txtObservaciones_movimientos_entradas_refacciones_ajuste_refacciones').val(),
                        intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_refacciones_ajuste_refacciones').val(),
                        //Datos de los detalles
                        strRefaccionID: arrRefaccionID.join('|'),
                        strCodigos: arrCodigos.join('|'),
                        strDescripciones: arrDescripciones.join('|'),
                        strCodigosLineas: arrCodigosLineas.join('|'),
                        strCantidades: arrCantidades.join('|'),
                        strCostosUnitarios: arrCostosUnitarios.join('|')

                    },
                    function(data) {
                        if (data.resultado)
                        {   

                            //Si no existe id del movimiento, significa que es un nuevo registro   
                            if($('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_ajuste_refacciones').val() == '')
                            {
                                //Asignar el id del movimiento registrado en la base de datos
                                $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_ajuste_refacciones').val(data.movimiento_refacciones_id);
                            }

                            //Hacer llamado a la función  para cargar  los registros en el grid
                            paginacion_movimientos_entradas_refacciones_ajuste_refacciones();  

                            //Hacer un llamado a la función para generar póliza con los datos del registro
                            generar_poliza_movimientos_entradas_refacciones_ajuste_refacciones('', '');


                        }

                        //Si existe mensaje de error
                        if(data.tipo_mensaje == 'error')
                        {
                            //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                            mensaje_movimientos_entradas_refacciones_ajuste_refacciones(data.tipo_mensaje, data.mensaje);
                        }
                    },
            'json');
        }

        //Función para mostrar mensaje de éxito o error
        function mensaje_movimientos_entradas_refacciones_ajuste_refacciones(tipoMensaje, mensaje)
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
        function cambiar_estatus_movimientos_entradas_refacciones_ajuste_refacciones(id, polizaID, folioPoliza)
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
                intID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_ajuste_refacciones').val();
                intPolizaID = $('#txtPolizaID_movimientos_entradas_refacciones_ajuste_refacciones').val();
                strFolioPoliza = $('#txtFolioPoliza_movimientos_entradas_refacciones_ajuste_refacciones').val();

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
                                  'title':    'Entradas por Ajuste',
                                  'buttons':  ['Aceptar', 'Cancelar'],
                                  'onClose':  function(caption) {
                                                if(caption == 'Aceptar')
                                                {
                                                  //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
                                                  $.post('refacciones/movimientos_entradas_refacciones_ajuste/set_estatus',
                                                         {intMovimientoRefaccionesID: intID,
                                                          intPolizaID: intPolizaID
                                                         },
                                                         function(data) {
                                                            if(data.resultado)
                                                            {
                                                                //Hacer llamado a la función  para cargar  los registros en el grid
                                                                paginacion_movimientos_entradas_refacciones_ajuste_refacciones();

                                                                //Si el id del registro se obtuvo del modal
                                                                if(id == '')
                                                                {
                                                                    //Hacer un llamado a la función para cerrar modal
                                                                    cerrar_movimientos_entradas_refacciones_ajuste_refacciones();     
                                                                }
                                                            }
                                                            //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                                                            mensaje_movimientos_entradas_refacciones_ajuste_refacciones(data.tipo_mensaje, data.mensaje);
                                                         },
                                                        'json');
                                                }
                                              }
                                  });

        }

        //Función para regresar los datos (al formulario) del registro seleccionado
        function editar_movimientos_entradas_refacciones_ajuste_refacciones(id, tipoAccion)
        {
            //Hacer un llamado al método del controlador para regresar los datos del registro
            $.post('refacciones/movimientos_entradas_refacciones_ajuste/get_datos',
                   {intMovimientoRefaccionesID:id
                   },
                   function(data) {
                        //Si hay datos del registro
                        if(data.row)
                        {
                            //Hacer un llamado a la función para limpiar los campos del formulario
                            nuevo_movimientos_entradas_refacciones_ajuste_refacciones();
                            //Asignar estatus del registro
                            var strEstatus = data.row.estatus;
                             //Asignar el id de la póliza
                            var intPolizaID = parseInt(data.row.poliza_id); 
                            //Variable que se utiliza para asignar las acciones del grid view
                            var strAccionesTabla = '';
                            
                            //Recuperar valores
                            $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_ajuste_refacciones').val(data.row.movimiento_refacciones_id);
                            $('#txtFolio_movimientos_entradas_refacciones_ajuste_refacciones').val(data.row.folio);
                            $('#txtFecha_movimientos_entradas_refacciones_ajuste_refacciones').val(data.row.fecha);
                            $('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_ajuste_refacciones').val(data.row.empleado_autorizacion);
                            $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_ajuste_refacciones').val(data.row.empleado);
                            $('#txtObservaciones_movimientos_entradas_refacciones_ajuste_refacciones').val(data.row.observaciones);
                            $('#txtPolizaID_movimientos_entradas_refacciones_ajuste_refacciones').val(intPolizaID);
                            $('#txtFolioPoliza_movimientos_entradas_refacciones_ajuste_refacciones').val(data.row.folio_poliza);

                            //Dependiendo del estatus cambiar el color del encabezado 
                            $('#divEncabezadoModal_movimientos_entradas_refacciones_ajuste_refacciones').addClass("estatus-"+strEstatus);
                            //Mostrar botón Imprimir  
                            $("#btnImprimirRegistro_movimientos_entradas_refacciones_ajuste_refacciones").show();


                            //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
                            if(tipoAccion == 'Ver')
                            {
                                //Deshabilitar todos los elementos del formulario
                                $('#frmMovimientosEntradasRefaccionesAjusteRefacciones').find('input, textarea, select').attr('disabled','disabled');
                                //Ocultar los siguientes botones
                                $("#btnGuardar_movimientos_entradas_refacciones_ajuste_refacciones").hide();
                                //Deshabilitar botón Agregar
                                $('#btnAgregar_detalles_movimientos_entradas_refacciones_ajuste_refacciones').prop('disabled', true);

                                //Si existe el id de la póliza
                                if(strEstatus == 'ACTIVO' && intPolizaID > 0)
                                {
                                    //Mostrar el botón Desactivar
                                    $("#btnDesactivar_movimientos_entradas_refacciones_ajuste_refacciones").show();
                                }

                            }
                            else
                            {

                                strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
                                                   " onclick='editar_renglon_detalles_movimientos_entradas_refacciones_ajuste_refacciones(this)'>" + 
                                                   "<span class='glyphicon glyphicon-edit'></span></button>" + 
                                                   "<button class='btn btn-default btn-xs' title='Eliminar'" +
                                                   " onclick='eliminar_renglon_detalles_movimientos_entradas_refacciones_ajuste_refacciones(this)'>" + 
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
                                var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_ajuste_refacciones').getElementsByTagName('tbody')[0];

                                //Insertamos el renglón con sus celdas en el objeto de la tabla
                                var objRenglon = objTabla.insertRow();
                                var objCeldaCodigo = objRenglon.insertCell(0);
                                var objCeldaDescripcion = objRenglon.insertCell(1);
                                var objCeldaCantidad = objRenglon.insertCell(2);
                                var objCeldaCostoUnitario = objRenglon.insertCell(3);
                                var objCeldaSubtotal = objRenglon.insertCell(4);
                                var objCeldaAcciones = objRenglon.insertCell(5);
                                //Columnas ocultas
                                var objCeldaCodigoLinea = objRenglon.insertCell(6);
                                var objCeldaCostoUnitarioBD = objRenglon.insertCell(7);

                                //Variables que se utilizan para asignar valores del detalle
                                var intSubtotal = parseFloat(data.detalles[intCon].costo_unitario);
                                var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
                                var intCostoUnitario = parseFloat(data.detalles[intCon].costo_unitario);

                                //Calcular subtotal
                                intSubtotal = intCantidad * intSubtotal;

                                //Cambiar cantidad a  formato moneda (a visualizar)
                                intCantidad =  formatMoney(intCantidad, 2, '');


                                var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosEntradasRefaccionesAjusteRefacciones, '');


                                var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesAjusteRefacciones, '');

                                //Cambiar cantidad a  formato moneda (a guardar en la  BD)
                                var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesAjusteRefacciones, '');

                                //Asignar valores
                                objRenglon.setAttribute('class', 'movil');
                                objRenglon.setAttribute('id', data.detalles[intCon].refaccion_id);
                                objCeldaCodigo.setAttribute('class', 'movil b1');
                                objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
                                objCeldaDescripcion.setAttribute('class', 'movil b2');
                                objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
                                objCeldaCantidad.setAttribute('class', 'movil b3');
                                objCeldaCantidad.innerHTML = intCantidad;
                                objCeldaCostoUnitario.setAttribute('class', 'movil b4');
                                objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
                                objCeldaSubtotal.setAttribute('class', 'movil b5');
                                objCeldaSubtotal.innerHTML = intSubtotalMostrar;
                                objCeldaAcciones.setAttribute('class', 'td-center movil b6');
                                objCeldaAcciones.innerHTML = strAccionesTabla;
                                objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
                                objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea;
                                objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
                                objCeldaCostoUnitarioBD.innerHTML = intCostoUnitarioBD;

                            }

                            //Hacer un llamado a la función para calcular totales de la tabla
                            calcular_totales_detalles_movimientos_entradas_refacciones_ajuste_refacciones();
                            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
                            var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_ajuste_refacciones tr").length - 2;
                            $('#numElementos_detalles_movimientos_entradas_refacciones_ajuste_refacciones').html(intFilas);
                            $('#txtNumDetalles_movimientos_entradas_refacciones_ajuste_refacciones').val(intFilas);
                            
                           

                            //Abrir modal
                            objMovimientosEntradasRefaccionesAjusteRefacciones = $('#MovimientosEntradasRefaccionesAjusteRefaccionesBox').bPopup({
                                                           appendTo: '#MovimientosEntradasRefaccionesAjusteRefaccionesContent', 
                                                           contentContainer: 'MovimientosEntradasRefaccionesAjusteRefaccionesM', 
                                                           zIndex: 2, 
                                                           modalClose: false, 
                                                           modal: true, 
                                                           follow: [true,false], 
                                                           followEasing : "linear", 
                                                           easing: "linear", 
                                                           modalColor: ('#F0F0F0')});

                            //Enfocar caja de texto
                            $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_ajuste_refacciones').focus();
                        }
                   },
                   'json');
        }

        //Función para generar póliza con los datos de un registro
        function generar_poliza_movimientos_entradas_refacciones_ajuste_refacciones(id, formulario)
        {   

            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Variable que se utiliza para saber si el id se obtuvo desde el modal
            var strTipo = 'modal';
            //Si no existe id, significa que se realizará la modificación desde el modal
            if(id == '')
            {
                intID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_ajuste_refacciones').val();
            }
            else
            {
                intID = id;
                strTipo = 'gridview';
            }

            //Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
            mostrar_circulo_carga_movimientos_entradas_refacciones_ajuste_refacciones(formulario);
            //Hacer un llamado al método del controlador para timbrar los datos del registro
            $.post('contabilidad/generar_polizas/generar_poliza',
             {
                intReferenciaID: intID,
                strTipoReferencia: strTipoReferenciaMovimientosEntradasRefaccionesAjusteRefacciones, 
                intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_refacciones_ajuste_refacciones').val()
             },
             function(data) {

                //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
                ocultar_circulo_carga_movimientos_entradas_refacciones_ajuste_refacciones(formulario);
                
                //Si existe resultado
                if (data.resultado)
                {
                    //Hacer llamado a la función para cargar  los registros en el grid
                    paginacion_movimientos_entradas_refacciones_ajuste_refacciones();

                    //Si el id del registro se obtuvo del modal
                    if(strTipo == 'modal')
                    {
                        //Hacer un llamado a la función para cerrar modal
                        cerrar_movimientos_entradas_refacciones_ajuste_refacciones();
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
                                                        cerrar_movimientos_entradas_refacciones_ajuste_refacciones();
                                                     }
                                                    }]
                                      });
                }
                else
                {

                    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                    mensaje_movimientos_entradas_refacciones_ajuste_refacciones(data.tipo_mensaje, data.mensaje);
                }
                
             },
             'json');

        }


        //Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function mostrar_circulo_carga_movimientos_entradas_refacciones_ajuste_refacciones(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_refacciones_ajuste_refacciones';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_ajuste_refacciones';
            }

            //Remover clase para mostrar div que contiene la barra de carga
            $("#"+strCampoID).removeClass('no-mostrar');
        }


        //Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function ocultar_circulo_carga_movimientos_entradas_refacciones_ajuste_refacciones(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_refacciones_ajuste_refacciones';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_ajuste_refacciones';
            }

            //Agregar clase para ocultar div que contiene la barra de carga
            $("#"+strCampoID).addClass('no-mostrar');
        }
    

        
        
        /*******************************************************************************************************************
        Funciones de la tabla detalles
        *********************************************************************************************************************/
        //Función para inicializar elementos de la refacción
        function inicializar_refaccion_detalles_movimientos_entradas_refacciones_ajuste_refacciones()
        {
            //Limpiar contenido de las siguientes cajas de texto
            $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val('');
            $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val('');
            $('#txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val('');
            $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val('');
            $("#txtCodigoLinea_detalles_movimientos_entradas_refacciones_ajuste_refacciones").val('');
            $("#txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones").val('');
            
        }

        //Función para regresar obtener los datos de una refacción
        function get_datos_refaccion_detalles_movimientos_entradas_refacciones_ajuste_refacciones()
        {
             //Hacer un llamado al método del controlador para regresar los datos de la refacción
            $.post('refacciones/refacciones/get_datos',
                  { 
                    strBusqueda:$("#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones").val(),
                    strTipo: 'id'
                  },
                  function(data) {
                        if(data.row)
                        {
                           $("#txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones").val(data.row.descripcion);
                           $("#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones").val(data.row.actual_costo);
                           //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
                            $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarMovimientosEntradasRefaccionesAjusteRefacciones });
                           $("#txtCodigoLinea_detalles_movimientos_entradas_refacciones_ajuste_refacciones").val(data.row.codigo_linea);
                           //Enfocar caja de texto
                           $("#txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones").focus();
                        }
                  }
                 ,
                'json');
        }

        //Función para agregar renglón a la tabla
        function agregar_renglon_detalles_movimientos_entradas_refacciones_ajuste_refacciones()
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
            var intRefaccionID = $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val();
            var strCodigo = $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val();
            var strDescripcion = $('#txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val();
            var strCodigoLinea = $('#txtCodigoLinea_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val();
            var intCantidad = $('#txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val();
            var intCostoUnitario = $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val();
           
            //Obtenemos el objeto de la tabla
            var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_ajuste_refacciones').getElementsByTagName('tbody')[0];

            //Validamos que se capturaron datos
            if (intRefaccionID == '' || strCodigo == '')
            {
                //Enfocar caja de texto
                $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
            }
            else if (intRefaccionID == '' || strDescripcion == '')
            {
                //Enfocar caja de texto
                $('#txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
            }
            else if (intCantidad == '')
            {
                //Enfocar caja de texto
                $('#txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
            }
            else if (intCostoUnitario == '')
            {
                //Enfocar caja de texto
                $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
            }
            else if (parseFloat(intCostoUnitario) == 0)
            {
                //Limpiar caja de texto
                $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val('');
                //Enfocar caja de texto
                $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
            }
            else
            {
                //Convertir cadena de texto a número decimal
                intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
                intCostoUnitario =  parseFloat($.reemplazar(intCostoUnitario, ",", ""));
                intSubtotal =  intCostoUnitario;
                
                //Hacer un llamado a la función para inicializar elementos de la refacción
                inicializar_refaccion_detalles_movimientos_entradas_refacciones_ajuste_refacciones();
                
                //Calcular subtotal
                intSubtotal = intCantidad * intSubtotal;

                //Calcular importe total
                intTotal = intSubtotal + intImporteIva + intImporteIeps;

                //Cambiar cantidad a  formato moneda (a visualizar)
                intCantidad =  formatMoney(intCantidad, 2, '');

                var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosEntradasRefaccionesAjusteRefacciones, '');

                var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesAjusteRefacciones, '');


                //Cambiar cantidad a  formato moneda (a guardar en la  BD)
                var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesAjusteRefacciones, '');

                //Revisamos si existe el ID proporcionado, si es así, editamos los datos
                if (objTabla.rows.namedItem(intRefaccionID))
                {
                    objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = intCantidad;
                    objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML = intCostoUnitarioMostrar;
                    objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML =  intSubtotalMostrar;
                    objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML = intCostoUnitarioBD;
                }
                else
                {

                    //Insertamos el renglón con sus celdas en el objeto de la tabla
                    var objRenglon = objTabla.insertRow();
                    var objCeldaCodigo = objRenglon.insertCell(0);
                    var objCeldaDescripcion = objRenglon.insertCell(1);
                    var objCeldaCantidad = objRenglon.insertCell(2);
                    var objCeldaCostoUnitario = objRenglon.insertCell(3);
                    var objCeldaSubtotal = objRenglon.insertCell(4);
                    var objCeldaAcciones = objRenglon.insertCell(5);
                    //Columnas ocultas
                    var objCeldaCodigoLinea = objRenglon.insertCell(6);
                    var objCeldaCostoUnitarioBD = objRenglon.insertCell(7);
                    
                    //Asignar valores
                    objRenglon.setAttribute('class', 'movil');
                    objRenglon.setAttribute('id', intRefaccionID);
                    objCeldaCodigo.setAttribute('class', 'movil b1');
                    objCeldaCodigo.innerHTML = strCodigo;
                    objCeldaDescripcion.setAttribute('class', 'movil b2');
                    objCeldaDescripcion.innerHTML = strDescripcion;
                    objCeldaCantidad.setAttribute('class', 'movil b3');
                    objCeldaCantidad.innerHTML = intCantidad;
                    objCeldaCostoUnitario.setAttribute('class', 'movil b4');
                    objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
                    objCeldaSubtotal.setAttribute('class', 'movil b5');
                    objCeldaSubtotal.innerHTML = intSubtotalMostrar;
                    objCeldaAcciones.setAttribute('class', 'td-center movil b6');
                    objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
                                                 " onclick='editar_renglon_detalles_movimientos_entradas_refacciones_ajuste_refacciones(this)'>" + 
                                                 "<span class='glyphicon glyphicon-edit'></span></button>" + 
                                                 "<button class='btn btn-default btn-xs' title='Eliminar'" +
                                                 " onclick='eliminar_renglon_detalles_movimientos_entradas_refacciones_ajuste_refacciones(this)'>" + 
                                                 "<span class='glyphicon glyphicon-trash'></span></button>" + 
                                                 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
                                                 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
                                                 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
                                                 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
                    objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
                    objCeldaCodigoLinea.innerHTML = strCodigoLinea; 
                    objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
                    objCeldaCostoUnitarioBD.innerHTML = intCostoUnitarioBD;
                    
                }

                //Hacer un llamado a la función para calcular totales de la tabla
                calcular_totales_detalles_movimientos_entradas_refacciones_ajuste_refacciones();
                
                //Enfocar caja de texto
                $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
                
                
            }

            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
            var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_ajuste_refacciones tr").length - 2;
            $('#numElementos_detalles_movimientos_entradas_refacciones_ajuste_refacciones').html(intFilas);
            $('#txtNumDetalles_movimientos_entradas_refacciones_ajuste_refacciones').val(intFilas);
        }

        //Función para regresar los datos (al formulario) del renglón seleccionado
        function editar_renglon_detalles_movimientos_entradas_refacciones_ajuste_refacciones(objRenglon)
        {
            //Asignar los valores a las cajas de texto
            $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
            $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
            $('#txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
            $('#txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
            $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
            //Enfocar caja de texto
            $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
        }

        //Función para quitar renglón de la tabla
        function eliminar_renglon_detalles_movimientos_entradas_refacciones_ajuste_refacciones(objRenglon)
        {
            //Obtener el indice del objeto renglón que se envía
            var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
            
            //Eliminar el renglón indicado
            document.getElementById("dg_detalles_movimientos_entradas_refacciones_ajuste_refacciones").deleteRow(intRenglon);

            //Hacer un llamado a la función para calcular totales de la tabla
            calcular_totales_detalles_movimientos_entradas_refacciones_ajuste_refacciones();
            
            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
            var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_ajuste_refacciones tr").length - 2;
            $('#numElementos_detalles_movimientos_entradas_refacciones_ajuste_refacciones').html(intFilas);
            $('#txtNumDetalles_movimientos_entradas_refacciones_ajuste_refacciones').val(intFilas);

            //Enfocar caja de texto
            $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
        }

        //Función para calcular totales de la tabla
        function calcular_totales_detalles_movimientos_entradas_refacciones_ajuste_refacciones()
        {
            //Obtenemos el objeto de la tabla 
            var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_ajuste_refacciones').getElementsByTagName('tbody')[0];

            //Inicializamos las variables que se utilizan para los acumulados
            var intAcumUnidades = 0;
            var intAcumSubtotal = 0;

            //Recorrer los renglones de la tabla para obtener los valores
            for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
            {
                //Incrementar acumulados
                //Hacer un llamado a la función para reemplazar ',' por cadena vacia
                intAcumUnidades += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
                intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
            }

            //Convertir total de unidades a 2 decimales
            intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

            //Convertir cantidad a formato moneda
            intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesAjusteRefacciones, '');

            //Asignar los valores
            $('#acumCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones').html(intAcumUnidades);
            $('#acumSubtotal_detalles_movimientos_entradas_refacciones_ajuste_refacciones').html(intAcumSubtotal);
            
        }

        //Controles o Eventos del Modal
        $(document).ready(function() 
        {
            /*******************************************************************************************************************
            Controles correspondientes al modal
            *********************************************************************************************************************/
            //Validar campos decimales (no hay necesidad de poner '.')
            $('#txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones').numeric();
            $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').numeric();
          
            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_entradas_refacciones_ajuste_refacciones').blur(function(){
                $('.cantidad_movimientos_entradas_refacciones_ajuste_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
            });


            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 1800 será 1,800.00*/
            $('.moneda_movimientos_entradas_refacciones_ajuste_refacciones').blur(function(){
                $('.moneda_movimientos_entradas_refacciones_ajuste_refacciones').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarMovimientosEntradasRefaccionesAjusteRefacciones });
            });

            //Agregar datepicker para seleccionar fecha
            $('#dteFecha_movimientos_entradas_refacciones_ajuste_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
          
            
            //Autocomplete para recuperar los datos de un empleado
            $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_ajuste_refacciones').autocomplete({
                source: function( request, response ) {
                   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_ajuste_refacciones').val('');
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
                 $('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_ajuste_refacciones').val(ui.item.data);

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
            $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_ajuste_refacciones').focusout(function(e){
                //Si no existe id del empleado
                if($('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_ajuste_refacciones').val() == '' ||
                   $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_ajuste_refacciones').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtEmpleadoAutorizacionID_movimientos_entradas_refacciones_ajuste_refacciones').val('');
                   $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_ajuste_refacciones').val('');
                }

            });

            
            //Autocomplete para recuperar los datos de una refacción
            $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').autocomplete({
                  source: function( request, response ) {
                     //Limpiar caja de texto que hace referencia al id del registro 
                     $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val('');
                     $.ajax({
                       //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                       url: "refacciones/refacciones/autocomplete",
                       type: "post",
                       dataType: "json",
                       data: {
                         strDescripcion: request.term,
                         strTipo: 'codigo', 
                         strTipoMovimiento: 'entrada'
                       },
                       success: function( data ) {
                         response( data );
                       }
                     });
                 },
                 select: function( event, ui ) {
                    //Asignar id del registro seleccionado
                    $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val(ui.item.data);
                    //Hacer un llamado a la función para regresar los datos de la refacción
                    get_datos_refaccion_detalles_movimientos_entradas_refacciones_ajuste_refacciones();
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
            $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focusout(function(e){
                //Si no existe id de la refacción
                if($('#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val() == '' ||
                   $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val() == '')
                { 
                    //Hacer un llamado a la función para inicializar elementos de la refacción
                    inicializar_refaccion_detalles_movimientos_entradas_refacciones_ajuste_refacciones();
                }

            });

            //Autocomplete para recuperar los datos de una refacción
            $('#txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones').autocomplete({
                  source: function( request, response ) {
                     //Limpiar caja de texto que hace referencia al id del registro 
                     $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val('');
                     $.ajax({
                       //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                       url: "refacciones/refacciones/autocomplete",
                       type: "post",
                       dataType: "json",
                       data: {
                         strDescripcion: request.term,
                         strTipo: 'descripcion',
                         strTipoMovimiento: 'entrada'
                       },
                       success: function( data ) {
                         response( data );
                       }
                     });
                 },
                 select: function( event, ui ) {
                    //Asignar id del registro seleccionado
                    $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val(ui.item.data);
                    //Elegir código desde el valor devuelto en el autocomplete
                    var strCodigo = ui.item.value.split(" - ")[0];
                    $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val(strCodigo);
                    //Hacer un llamado a la función para regresar los datos de la refacción
                    get_datos_refaccion_detalles_movimientos_entradas_refacciones_ajuste_refacciones();
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
            $('#txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focusout(function(e){
                //Si no existe id de la refacción
                if($('#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val() == '' ||
                   $('#txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val() == '')
                { 
                    //Hacer un llamado a la función para inicializar elementos de la refacción
                    inicializar_refaccion_detalles_movimientos_entradas_refacciones_ajuste_refacciones();
                }

            });


            //Función para mover renglones arriba y abajo en la tabla
            $('#dg_detalles_movimientos_entradas_refacciones_ajuste_refacciones').on('click','button.btn',function(){
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


            //Validar que exista código de la refacción cuando se pulse la tecla enter 
            $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe código de la refacción
                    if($('#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val() == '' || $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtCodigo_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
                    }
                    else
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
                    }
                }
            });

            //Validar que exista descripción de la refacción cuando se pulse la tecla enter 
            $('#txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe descripción de la refacción
                    if($('#txtRefaccionID_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val() == '' || $('#txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtDescripcion_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
                    }
                    else
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
                    }
                }
            });

            //Validar que exista cantidad cuando se pulse la tecla enter 
            $('#txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe cantidad
                    if($('#txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
                    }
                    else
                    {
                        //Enfocar caja de texto
                        $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
                    }
                }
            });


            //Validar que exista costo unitario cuando se pulse la tecla enter 
            $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe cantidad
                    if($('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
                    }
                    else
                    {
                        //Enfocar botón Agregar
                        $('#btnAgregar_detalles_movimientos_entradas_refacciones_ajuste_refacciones').focus();
                    }
                }
            });

           

            /*******************************************************************************************************************
            Controles correspondientes al formulario principal
            *********************************************************************************************************************/
            //Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
            $('#dteFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
            $('#dteFechaFinalBusq_movimientos_entradas_refacciones_ajuste_refacciones').datetimepicker({format: 'DD/MM/YYYY',
                                                                                                                useCurrent: false});
            //Deshabilitar los días posteriores a la fecha final
            $('#dteFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones').on('dp.change', function (e) {
                $('#dteFechaFinalBusq_movimientos_entradas_refacciones_ajuste_refacciones').data('DateTimePicker').minDate(e.date);
            });

            //Deshabilitar los días anteriores a la fecha inicial
            $('#dteFechaFinalBusq_movimientos_entradas_refacciones_ajuste_refacciones').on('dp.change', function (e) {
                $('#dteFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones').data('DateTimePicker').maxDate(e.date);
            });
            
            //Autocomplete para recuperar los datos de un empleado
            $('#txtEmpleadoBusq_movimientos_entradas_refacciones_ajuste_refacciones').autocomplete({
                source: function( request, response ) {
                   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtEmpleadoIDBusq_movimientos_entradas_refacciones_ajuste_refacciones').val('');
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
                 //Asignar id del registro seleccionado
                 $('#txtEmpleadoIDBusq_movimientos_entradas_refacciones_ajuste_refacciones').val(ui.item.data);
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
            $('#txtEmpleadoBusq_movimientos_entradas_refacciones_ajuste_refacciones').focusout(function(e){
                //Si no existe id del empleado
                if($('#txtEmpleadoIDBusq_movimientos_entradas_refacciones_ajuste_refacciones').val() == '' ||
                   $('#txtEmpleadoBusq_movimientos_entradas_refacciones_ajuste_refacciones').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtEmpleadoIDBusq_movimientos_entradas_refacciones_ajuste_refacciones').val('');
                   $('#txtEmpleadoBusq_movimientos_entradas_refacciones_ajuste_refacciones').val('');
                }

            });

            //Paginación de registros
            $('#pagLinks_movimientos_entradas_refacciones_ajuste_refacciones').on('click','a',function(event){
                event.preventDefault();
                intPaginaMovimientosEntradasRefaccionesAjusteRefacciones = $(this).attr('href').replace('/','');
                //Hacer llamado a la función  para cargar  los registros en el grid
                paginacion_movimientos_entradas_refacciones_ajuste_refacciones();
            });

            //Abrir modal cuando se de clic en el botón
            $('#btnNuevo_movimientos_entradas_refacciones_ajuste_refacciones').bind('click', function(e) {
                e.preventDefault();
                //Hacer un llamado a la función para limpiar los campos del formulario
                nuevo_movimientos_entradas_refacciones_ajuste_refacciones();
                //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
                $('#divEncabezadoModal_movimientos_entradas_refacciones_ajuste_refacciones').addClass("estatus-NUEVO");
                //Abrir modal
                objMovimientosEntradasRefaccionesAjusteRefacciones = $('#MovimientosEntradasRefaccionesAjusteRefaccionesBox').bPopup({
                                               appendTo: '#MovimientosEntradasRefaccionesAjusteRefaccionesContent', 
                                               contentContainer: 'MovimientosEntradasRefaccionesAjusteRefaccionesM', 
                                               zIndex: 2, 
                                               modalClose: false, 
                                               modal: true, 
                                               follow: [true,false], 
                                               followEasing : "linear", 
                                               easing: "linear", 
                                               modalColor: ('#F0F0F0')});

                //Enfocar caja de texto
                $('#txtEmpleadoAutorizacion_movimientos_entradas_refacciones_ajuste_refacciones').focus();
            });

            //Enfocar caja de texto
            $('#txtFechaInicialBusq_movimientos_entradas_refacciones_ajuste_refacciones').focus();
            //Hacer un llamado a la función para obtener los permisos de acceso
            permisos_movimientos_entradas_refacciones_ajuste_refacciones();

        });
    </script>